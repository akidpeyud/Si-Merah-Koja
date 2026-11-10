<?php

namespace App\Imports;

use App\Models\LaporanPenyelamatan;
use App\Models\LpDokumentasi;
use App\Models\LpKategoriKhusus;
use App\Models\LpTeknisLogistik;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Import;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;

class EvakuasiLengkapImport implements Import, WithMultipleSheets
{
    /**
     * Menyimpan instance sheet import untuk rekapitulasi statistik.
     */
    public array $sheetInstances = [];

    /**
     * @param int $userId ID User pemilik data laporan
     * @param bool $dryRun Mode simulasi tanpa menyimpan ke database
     * @param array $availableSheets Daftar nama sheet yang ingin diproses (jika kosong, proses sheet utama)
     */
    public function __construct(
        protected int $userId = 1,
        protected bool $dryRun = false,
        protected array $availableSheets = []
    ) {}

    /**
     * Mendaftarkan seluruh sheet pada file Excel menggunakan WithMultipleSheets.
     */
    public function sheets(): array
    {
        $candidates = ! empty($this->availableSheets) ? $this->availableSheets : ['Sheet1'];
        $sheetNames = [];

        foreach ($candidates as $name) {
            $lower = strtolower(trim((string) $name));
            // Abaikan sheet rekap mingguan, grafik, dsb. yang bukan format buku agenda harian
            if (
                str_contains($lower, 'mingguan') ||
                str_contains($lower, 'rekap') ||
                str_contains($lower, 'grafik') ||
                str_contains($lower, 'chart') ||
                str_contains($lower, 'dashboard')
            ) {
                continue;
            }
            $sheetNames[] = (string) $name;
        }

        // Fallback jika seluruh sheet tersaring
        if (empty($sheetNames)) {
            $sheetNames = $candidates;
        }

        $sheets = [];
        foreach ($sheetNames as $name) {
            $instance = new EvakuasiLengkapSheetImport(
                sheetName: $name,
                userId: $this->userId,
                dryRun: $this->dryRun
            );
            $this->sheetInstances[$name] = $instance;
            $sheets[$name] = $instance;
        }

        return $sheets;
    }
}

class EvakuasiLengkapSheetImport implements ToCollection, WithCalculatedFormulas, WithStartRow
{
    public int $totalDibaca = 0;

    public int $totalDisimpan = 0;

    public int $totalDuplikat = 0;

    public int $totalDilewati = 0;

    /**
     * Cache in-memory untuk mencegah duplikasi antar baris pada sheet yang sama.
     */
    private array $seenInSheet = [];

    /**
     * Pemetaan kata kunci hewan/objek penyelamatan ke slug kategori internal sistem.
     */
    private const PETA_NON_KEBAKARAN = [
        'water_rescue' => '/tenggelam|sungai|danau|banjir|perairan|terjun ke sungai|parit besar|hanyut|sumur/i',
        'evakuasi_liar' => '/ular|sanca|kobra|piton|koros|tali picis|kadut|biawak|tawon|lebah|musang|buaya|monyet|kera|serangga|hewan liar/i',
        'evakuasi_piaraan' => '/kucing|anjing/i',
        'evakuasi_ternak' => '/sapi|kambing|kerbau|kuda/i',
        'evakuasi_cincin' => '/cincin|anting/i',
        'evakuasi_kendaraan' => '/mobil|motor|truk|kendaraan|laka lantas|terperosok/i',
        'land_rescue' => '/gembok|kunci|terjepit|pohon tumbang|longsor|fraktur|pasien/i',
    ];

    /**
     * @param string $sheetName Nama sheet saat ini
     * @param int $userId ID User pemilik data laporan
     * @param bool $dryRun Mode simulasi tanpa menyimpan ke database
     */
    public function __construct(
        public string $sheetName = '',
        protected int $userId = 1,
        protected bool $dryRun = false
    ) {}

    /**
     * Baris data aktual dimulai dari baris ke-4/5.
     */
    public function startRow(): int
    {
        return 4;
    }

    /**
     * Memproses seluruh koleksi baris dari sheet.
     */
    public function collection(Collection $rows): void
    {
        if ($rows->isEmpty()) {
            return;
        }

        // Periksa apakah sheet ini memiliki struktur Buku Agenda yang memadai (minimal 15 kolom)
        $maxColumns = 0;
        foreach ($rows->take(20) as $r) {
            $maxColumns = max($maxColumns, count($r->toArray()));
        }

        if ($maxColumns < 15) {
            // Sheet ini bukan format Buku Agenda Evakuasi Lengkap, lewati
            return;
        }

        // 1. Kelompokkan multi-baris per insiden berdasarkan kolom NO
        $incidents = [];
        $currentIncident = null;

        foreach ($rows as $row) {
            $rowArr = $row->toArray();
            $col0 = isset($rowArr[0]) ? trim((string) $rowArr[0]) : '';
            $col1 = isset($rowArr[1]) ? trim((string) $rowArr[1]) : '';

            // Abaikan baris sub-header penomoran kolom (contoh: baris yang berisi 1, 2, 3... 22)
            if ($col0 === '1' && ($col1 === '2' || $col1 === 'Hari/Tanggal' || $col1 === '')) {
                continue;
            }

            // Abaikan baris header teks
            if (preg_match('/^(no|hari|tanggal|buku agenda|bulan)/i', $col0) || preg_match('/^(hari\/tanggal|waktu)/i', $col1)) {
                continue;
            }

            if ($col0 !== '' && is_numeric($col0)) {
                // Awal nomor insiden baru
                if ($currentIncident !== null) {
                    $incidents[] = $currentIncident;
                }

                $currentIncident = [
                    'no' => (int) $col0,
                    'main_row' => $rowArr,
                    'sub_rows' => [],
                ];
            } elseif ($currentIncident !== null) {
                // Baris lanjutan dari insiden yang sama
                $hasContent = false;
                foreach ($rowArr as $cell) {
                    if ($cell !== null && trim((string) $cell) !== '') {
                        $hasContent = true;
                        break;
                    }
                }
                if ($hasContent) {
                    $currentIncident['sub_rows'][] = $rowArr;
                }
            }
        }

        if ($currentIncident !== null) {
            $incidents[] = $currentIncident;
        }

        // 2. Proses setiap insiden hasil pengelompokan
        foreach ($incidents as $incident) {
            $this->totalDibaca++;

            $main = $incident['main_row'];
            $subs = $incident['sub_rows'];

            // a. Parsing Hari & Tanggal Kejadian (Kolom 1 / B)
            $tglInfo = $this->parseHariDanTanggal($main, $subs);
            if (! $tglInfo) {
                $this->totalDilewati++;

                continue;
            }

            $carbonTanggal = Carbon::parse($tglInfo['tanggal']);
            $tglKejadian = $tglInfo['tanggal'];
            $hariKejadian = $tglInfo['hari'];
            $bulanKejadian = $tglInfo['bulan'];
            $tahunKejadian = (int) $tglInfo['tahun'];

            // b. Parsing Waktu Terima, Berangkat, Tiba, Lama Operasi, dan Selesai (Kolom 2, 4, 17)
            $rawWaktu = isset($main[2]) ? trim((string) $main[2]) : '';
            $rawTiba = isset($main[4]) ? trim((string) $main[4]) : '';
            $rawLama = isset($main[17]) ? trim((string) $main[17]) : '';

            $waktuTerima = $this->parseWaktuTerima($rawWaktu, $carbonTanggal);
            $waktuBerangkat = $this->parseWaktuBerangkat($rawWaktu, $carbonTanggal) ?? $waktuTerima;
            $waktuTiba = $this->parseWaktuTiba($rawTiba, $carbonTanggal) ?? $waktuBerangkat ?? $waktuTerima;
            $waktuSelesai = $this->hitungWaktuSelesai($waktuTiba ?? $waktuTerima, $rawLama);

            $waktuTerimaStr = $waktuTerima ? $waktuTerima->format('Y-m-d H:i:s') : $carbonTanggal->format('Y-m-d 00:00:00');
            $waktuBerangkatStr = $waktuBerangkat ? $waktuBerangkat->format('Y-m-d H:i:s') : $waktuTerimaStr;
            $waktuTibaStr = $waktuTiba ? $waktuTiba->format('Y-m-d H:i:s') : $waktuBerangkatStr;
            $waktuSelesaiStr = $waktuSelesai ? $waktuSelesai->format('Y-m-d H:i:s') : null;

            // c. Media Pelaporan, Jarak Tempuh, Respon Time (Kolom 3, 5, 6)
            $mediaPelaporan = isset($main[3]) && trim((string) $main[3]) !== '' ? trim((string) $main[3]) : 'Operator Layanan Damkar';
            $rawJarak = isset($main[5]) && trim((string) $main[5]) !== '-' && trim((string) $main[5]) !== '' ? trim((string) $main[5]) : null;
            $jarakTempuh = $this->bersihkanJarakTempuh($rawJarak);
            $responTime = isset($main[6]) && trim((string) $main[6]) !== '-' && trim((string) $main[6]) !== '' ? trim((string) $main[6]) : null;

            // d. Pelapor (Kolom 7, 8)
            $namaPelapor = isset($main[7]) && trim((string) $main[7]) !== '-' && trim((string) $main[7]) !== '' ? trim((string) $main[7]) : 'Masyarakat';
            $teleponPelapor = isset($main[8]) && trim((string) $main[8]) !== '-' && trim((string) $main[8]) !== '' ? trim((string) $main[8]) : '-';

            // e. Objek & Lokasi Penyelamatan (Kolom 9, 10)
            $rawObjek = isset($main[9]) && trim((string) $main[9]) !== '-' && trim((string) $main[9]) !== '' ? trim((string) $main[9]) : 'Evakuasi Penyelamatan';
            $alamat = isset($main[10]) && trim((string) $main[10]) !== '-' && trim((string) $main[10]) !== '' ? trim((string) $main[10]) : 'Kota Jambi';

            $kategoriNonKebakaran = $this->petaKategoriNonKebakaran($rawObjek);
            $jenisHewan = $this->deteksiJenisHewan($rawObjek);

            // f. Korban & Jiwa (Kolom 11, 12, 13)
            $namaKorban = $this->gabungTeksKolom(11, $main, $subs);
            if ($namaKorban === '-') {
                $namaKorban = null;
            }
            $jumlahJiwa = $this->ekstrakAngka($main[12] ?? null);

            // Kronologi & Hambatan (Kolom 18, 19)
            $kronologi = $this->gabungTeksKolom(18, $main, $subs);
            if (empty($kronologi) || $kronologi === '-') {
                $kronologi = "Telah dilaksanakan penanganan dan {$rawObjek} oleh tim satgas Damkar Kota Jambi dalam keadaan aman dan terkendali.";
            }
            $hambatan = $this->gabungTeksKolom(19, $main, $subs);

            $korbanData = $this->parseKorban($main[13] ?? null, $namaKorban, $kronologi);

            $totalKorban = $korbanData['meninggal'] + $korbanData['berat'] + $korbanData['ringan'];
            if ($jumlahJiwa === 0 && $totalKorban > 0) {
                $jumlahJiwa = $totalKorban;
            }
            if ($jumlahJiwa > $totalKorban) {
                $korbanData['selamat'] = $jumlahJiwa - $totalKorban;
            }

            // g. Pimpinan Operasi, Satgas, Personil (Kolom 14, 15, 16)
            $rawPimpinan = isset($main[14]) && trim((string) $main[14]) !== '-' ? trim((string) $main[14]) : null;
            $rawSatgas = isset($main[15]) && trim((string) $main[15]) !== '-' ? trim((string) $main[15]) : null;

            $pimpinanData = $this->bersihkanPrefixPimpinan($rawPimpinan);
            $pimpinanOperasi = $pimpinanData['pimpinan'];
            $pendampingOperasi = $pimpinanData['pendamping'];
            $satuanTugas = $this->bersihkanPrefixSatgas($rawSatgas) ?? 'Tim Rescue Damkar';
            $jumlahPersonel = $this->ekstrakAngka($main[16] ?? null);

            // h. Sarana Yang Digunakan (Kolom 20)
            $saranaRaw = $this->gabungTeksKolom(20, $main, $subs);
            $saranaData = $this->parseSarana($saranaRaw);

            // i. Tim Quick Respon (Kolom 21)
            $quickResponRaw = $this->gabungTeksKolom(21, $main, $subs);
            $instansiData = $this->parseInstansi($quickResponRaw);

            // j. Deteksi Duplikasi
            $hashKunci = md5($tglKejadian.'|'.$waktuTerimaStr.'|'.strtolower(trim($alamat)).'|'.strtolower(trim($rawObjek)));
            if (isset($this->seenInSheet[$hashKunci])) {
                $this->totalDuplikat++;

                continue;
            }
            $this->seenInSheet[$hashKunci] = true;

            $existing = LaporanPenyelamatan::where('kategori_kejadian', '!=', 'kebakaran')
                ->where('tanggal_kejadian', $tglKejadian)
                ->where('waktu_terima', $waktuTerimaStr)
                ->where('alamat', $alamat)
                ->first();

            if ($existing) {
                if ($this->dryRun) {
                    $this->totalDisimpan++;

                    continue;
                }

                // Update data jika sudah ada (sinkronisasi in-place)
                DB::transaction(function () use (
                    $existing, $namaPelapor, $teleponPelapor, $mediaPelaporan,
                    $kategoriNonKebakaran, $rawObjek, $waktuBerangkatStr, $waktuTibaStr, $waktuSelesaiStr,
                    $jarakTempuh, $namaKorban, $jumlahJiwa, $korbanData, $kronologi, $hambatan,
                    $saranaData, $instansiData, $pimpinanOperasi, $pendampingOperasi, $satuanTugas, $responTime, $rawLama,
                    $jumlahPersonel, $jenisHewan
                ) {
                    $existing->update([
                        'nama_pelapor' => Str::limit($namaPelapor, 250, ''),
                        'telepon_pelapor' => Str::limit($teleponPelapor, 50, ''),
                        'media_pelaporan' => $mediaPelaporan,
                        'kategori_kejadian' => 'penyelamatan',
                        'kategori_non_kebakaran' => $kategoriNonKebakaran,
                        'rincian_kategori_non_kebakaran' => Str::limit($rawObjek, 250, ''),
                        'objek_terdampak' => Str::limit($rawObjek, 250, ''),
                        'prioritas' => $korbanData['meninggal'] > 0 ? 'tinggi' : ($existing->prioritas ?? 'rendah'),
                        'waktu_berangkat' => $waktuBerangkatStr,
                        'waktu_tiba' => $waktuTibaStr,
                        'waktu_selesai' => $waktuSelesaiStr,
                        'jarak_tempuh' => $jarakTempuh ? Str::limit($jarakTempuh, 50, '') : null,
                        'nama_korban' => $namaKorban ? Str::limit($namaKorban, 250, '') : null,
                        'jumlah_jiwa' => $jumlahJiwa,
                        'korban_selamat' => $korbanData['selamat'],
                        'korban_ringan' => $korbanData['ringan'],
                        'korban_berat' => $korbanData['berat'],
                        'korban_meninggal' => $korbanData['meninggal'],
                        'kronologi_lengkap' => $kronologi,
                        'hambatan_lapangan' => $hambatan,
                        'armada' => $this->toJsonSafe($saranaData['armada']),
                        'peralatan_lain' => $saranaData['teks'],
                        'instansi_pendukung' => $this->toJsonSafe($instansiData['list']),
                        'tindakan_instansi' => $instansiData['teks'],
                    ]);

                    LpTeknisLogistik::updateOrCreate(
                        ['laporan_id' => $existing->id],
                        [
                            'pimpinan_operasi' => $pimpinanOperasi,
                            'pendamping_operasi' => $pendampingOperasi,
                            'satuan_tugas' => $satuanTugas,
                            'tim_respontime' => ! empty($instansiData['teks']) ? Str::limit($instansiData['teks'], 250, '') : Str::limit($responTime, 250, ''),
                            'jumlah_personel' => $jumlahPersonel,
                            'langkah_penanganan' => ! empty($rawLama) ? "Lama Operasi: {$rawLama}" : 'Penanganan dan evakuasi objek',
                            'hambatan_lapangan' => $hambatan,
                            'hasil_tindakan' => 'Evakuasi dan penanganan berhasil diselesaikan dengan aman.',
                            'nama_korban' => $namaKorban ? Str::limit($namaKorban, 250, '') : null,
                            'jumlah_jiwa' => $jumlahJiwa,
                            'objek_terdampak' => Str::limit($rawObjek, 250, ''),
                            'korban_selamat' => $korbanData['selamat'],
                            'korban_ringan' => $korbanData['ringan'],
                            'korban_berat' => $korbanData['berat'],
                            'korban_meninggal' => $korbanData['meninggal'],
                            'armada' => $saranaData['armada'],
                            'peralatan_lain' => $saranaData['teks'],
                        ]
                    );

                    LpDokumentasi::updateOrCreate(
                        ['laporan_id' => $existing->id],
                        [
                            'kronologi_lengkap' => $kronologi,
                            'instansi_pendukung' => $instansiData['list'],
                            'tindakan_instansi' => $instansiData['teks'],
                        ]
                    );

                    if ($jenisHewan) {
                        LpKategoriKhusus::updateOrCreate(
                            ['laporan_id' => $existing->id],
                            ['jenis_hewan' => $jenisHewan]
                        );
                    }
                });

                $this->totalDisimpan++;

                continue;
            }

            if ($this->dryRun) {
                $this->totalDisimpan++;

                continue;
            }

            // k. Simpan Transaksional ke Database (4 Tabel)
            DB::transaction(function () use (
                $carbonTanggal, $tglKejadian, $hariKejadian, $bulanKejadian, $tahunKejadian,
                $namaPelapor, $teleponPelapor, $mediaPelaporan, $kategoriNonKebakaran, $rawObjek,
                $waktuTerimaStr, $waktuBerangkatStr, $waktuTibaStr, $waktuSelesaiStr, $alamat, $jarakTempuh,
                $namaKorban, $jumlahJiwa, $korbanData,
                $pimpinanOperasi, $pendampingOperasi, $satuanTugas, $jumlahPersonel, $responTime, $rawLama,
                $kronologi, $hambatan, $saranaData, $instansiData, $jenisHewan
            ) {
                $nomorLaporan = $this->buatNomorLaporan($carbonTanggal);

                // TAB 1: laporan_penyelamatans
                $laporan = LaporanPenyelamatan::create([
                    'nomor_laporan' => $nomorLaporan,
                    'id_laporan' => Str::uuid()->toString(),
                    'user_id' => $this->userId,
                    'tanggal_kejadian' => $tglKejadian,
                    'hari_kejadian' => $hariKejadian,
                    'bulan_kejadian' => $bulanKejadian,
                    'tahun_kejadian' => $tahunKejadian,

                    'nama_pelapor' => Str::limit($namaPelapor, 250, ''),
                    'telepon_pelapor' => Str::limit($teleponPelapor, 50, ''),
                    'media_pelaporan' => $mediaPelaporan,

                    'kategori_kejadian' => 'penyelamatan',
                    'kategori_non_kebakaran' => $kategoriNonKebakaran,
                    'rincian_kategori_non_kebakaran' => Str::limit($rawObjek, 250, ''),
                    'prioritas' => $korbanData['meninggal'] > 0 ? 'tinggi' : 'rendah',

                    'waktu_kejadian' => $waktuTerimaStr,
                    'waktu_terima' => $waktuTerimaStr,
                    'waktu_berangkat' => $waktuBerangkatStr,
                    'waktu_tiba' => $waktuTibaStr,
                    'waktu_selesai' => $waktuSelesaiStr,
                    'waktu_kembali' => null,

                    'alamat' => $alamat,
                    'jarak_tempuh' => $jarakTempuh ? Str::limit($jarakTempuh, 50, '') : null,
                    'nama_korban' => $namaKorban ? Str::limit($namaKorban, 250, '') : null,
                    'jumlah_jiwa' => $jumlahJiwa,
                    'warga_terdampak' => 0,
                    'korban_selamat' => $korbanData['selamat'],
                    'korban_ringan' => $korbanData['ringan'],
                    'korban_berat' => $korbanData['berat'],
                    'korban_meninggal' => $korbanData['meninggal'],
                    'status_evakuasi' => 'Selesai',
                    'objek_terdampak' => Str::limit($rawObjek, 250, ''),

                    'hambatan_lapangan' => $hambatan,
                    'liter_air' => 0,
                    'liter_foam' => 0,
                    'armada' => $this->toJsonSafe($saranaData['armada']),
                    'peralatan_lain' => $saranaData['teks'],
                    'jumlah_personel' => $jumlahPersonel,

                    'kronologi_lengkap' => $kronologi,
                    'instansi_pendukung' => $this->toJsonSafe($instansiData['list']),
                    'tindakan_instansi' => $instansiData['teks'],
                ]);

                // TAB 2: lp_teknis_logistiks
                LpTeknisLogistik::create([
                    'laporan_id' => $laporan->id,
                    'pimpinan_operasi' => $pimpinanOperasi,
                    'pendamping_operasi' => $pendampingOperasi,
                    'satuan_tugas' => $satuanTugas,
                    'tim_respontime' => ! empty($instansiData['teks']) ? Str::limit($instansiData['teks'], 250, '') : Str::limit($responTime, 250, ''),
                    'jumlah_personel' => $jumlahPersonel,
                    'langkah_penanganan' => ! empty($rawLama) ? "Lama Operasi: {$rawLama}" : 'Penanganan dan evakuasi objek',
                    'hambatan_lapangan' => $hambatan,
                    'hasil_tindakan' => 'Evakuasi dan penanganan berhasil diselesaikan dengan aman.',
                    'nama_korban' => $namaKorban ? Str::limit($namaKorban, 250, '') : null,
                    'jumlah_jiwa' => $jumlahJiwa,
                    'warga_terdampak' => 0,
                    'status_evakuasi' => 'Selesai',
                    'objek_terdampak' => Str::limit($rawObjek, 250, ''),
                    'korban_selamat' => $korbanData['selamat'],
                    'korban_ringan' => $korbanData['ringan'],
                    'korban_berat' => $korbanData['berat'],
                    'korban_meninggal' => $korbanData['meninggal'],
                    'armada' => $saranaData['armada'],
                    'peralatan_lain' => $saranaData['teks'],
                ]);

                // TAB 3: lp_dokumentasis
                LpDokumentasi::create([
                    'laporan_id' => $laporan->id,
                    'kronologi_lengkap' => $kronologi,
                    'instansi_pendukung' => $instansiData['list'],
                    'tindakan_instansi' => $instansiData['teks'],
                ]);

                // TAB 4: lp_kategori_khusus (jika evakuasi hewan)
                if ($jenisHewan) {
                    LpKategoriKhusus::create([
                        'laporan_id' => $laporan->id,
                        'jenis_hewan' => $jenisHewan,
                    ]);
                }
            });

            $this->totalDisimpan++;
        }
    }

    /**
     * Parsing gabungan hari dan tanggal (contoh: "Kamis, 1 Januari 2026").
     */
    protected function parseHariDanTanggal(array $main, array $subs): ?array
    {
        $kandidatTeks = [];
        if (isset($main[1]) && trim((string) $main[1]) !== '') {
            $kandidatTeks[] = trim((string) $main[1]);
        }
        foreach ($subs as $sub) {
            if (isset($sub[1]) && trim((string) $sub[1]) !== '') {
                $kandidatTeks[] = trim((string) $sub[1]);
            }
        }

        $bulanMap = [
            'januari' => 1, 'jan' => 1,
            'februari' => 2, 'feb' => 2,
            'maret' => 3, 'mar' => 3,
            'april' => 4, 'apr' => 4,
            'mei' => 5, 'may' => 5,
            'juni' => 6, 'jun' => 6,
            'juli' => 7, 'jul' => 7,
            'agustus' => 8, 'ags' => 8, 'agu' => 8,
            'september' => 9, 'sep' => 9,
            'oktober' => 10, 'okt' => 10,
            'november' => 11, 'nov' => 11,
            'desember' => 12, 'des' => 12,
        ];

        $hariList = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', "jum'at", 'jumaat', 'sabtu', 'minggu'];

        $teksUtuh = implode(' ', $kandidatTeks);
        $teksUtuh = preg_replace('/[\x00-\x1F\x7F\p{C}]/u', '', $teksUtuh);
        $teksUtuh = str_replace(["\r", "\n", "\t"], ' ', $teksUtuh);
        $teksUtuh = preg_replace('/\s+/', ' ', trim($teksUtuh));

        if ($teksUtuh === '' || $teksUtuh === '-') {
            return null;
        }

        $hariDitemukan = 'Senin';
        foreach ($hariList as $h) {
            if (stripos($teksUtuh, $h) !== false) {
                $hariDitemukan = ucfirst($h === "jum'at" || $h === 'jumaat' ? 'Jumat' : $h);
                break;
            }
        }

        $polaBulan = implode('|', array_keys($bulanMap));
        if (preg_match('/(?:(\d{1,2})\s*)?('.$polaBulan.')(?:\s*(\d{4}))?/i', $teksUtuh, $matches)) {
            $tgl = ! empty($matches[1]) ? (int) $matches[1] : 1;
            $namaBulan = strtolower($matches[2]);
            $bulan = $bulanMap[$namaBulan] ?? 1;
            $tahun = ! empty($matches[3]) ? (int) $matches[3] : 2026;

            if ($tgl < 1 || $tgl > 31) {
                $tgl = 1;
            }

            try {
                $dt = Carbon::createFromDate($tahun, $bulan, $tgl);
                $daftarBulanIndo = [
                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
                ];

                return [
                    'tanggal' => $dt->format('Y-m-d'),
                    'hari' => $hariDitemukan,
                    'bulan' => $daftarBulanIndo[$bulan] ?? 'Januari',
                    'tahun' => $tahun,
                ];
            } catch (\Throwable) {
                // Lanjut ke fallback
            }
        }

        return null;
    }

    /**
     * Parsing Waktu Terima dari format teks (contoh: "Terima:12.19 Berangkat:12.22").
     */
    protected function parseWaktuTerima(string $raw, Carbon $tanggal): ?Carbon
    {
        if (preg_match('/terima[:;\s]*(\d{1,2}[:.]\d{2})/i', $raw, $m)) {
            return $this->buatCarbonWaktu($m[1], $tanggal);
        }

        if (preg_match('/(\d{1,2}[:.]\d{2})/', $raw, $m)) {
            return $this->buatCarbonWaktu($m[1], $tanggal);
        }

        return null;
    }

    /**
     * Parsing Waktu Berangkat dari format teks (contoh: "Terima:12.19 Berangkat:12.22").
     */
    protected function parseWaktuBerangkat(string $raw, Carbon $tanggal): ?Carbon
    {
        if (preg_match('/berangkat[:;\s]*(\d{1,2}[:.]\d{2})/i', $raw, $m)) {
            return $this->buatCarbonWaktu($m[1], $tanggal);
        }

        return null;
    }

    /**
     * Parsing Waktu Tiba dari format teks (contoh: "Tiba:12.28").
     */
    protected function parseWaktuTiba(string $raw, Carbon $tanggal): ?Carbon
    {
        if (preg_match('/tiba[:;\s]*(\d{1,2}[:.]\d{2})/i', $raw, $m)) {
            return $this->buatCarbonWaktu($m[1], $tanggal);
        }

        if (preg_match('/(\d{1,2}[:.]\d{2})/', $raw, $m)) {
            return $this->buatCarbonWaktu($m[1], $tanggal);
        }

        return null;
    }

    /**
     * Membuat objek Carbon waktu kejadian.
     */
    protected function buatCarbonWaktu(string $waktuStr, Carbon $tanggal): ?Carbon
    {
        $waktuStr = str_replace('.', ':', trim($waktuStr));
        if (preg_match('/(\d{1,2}):(\d{2})/', $waktuStr, $m)) {
            $jam = str_pad($m[1], 2, '0', STR_PAD_LEFT);
            $menit = str_pad($m[2], 2, '0', STR_PAD_LEFT);

            try {
                return Carbon::parse($tanggal->format('Y-m-d')." {$jam}:{$menit}:00");
            } catch (\Throwable) {
                return null;
            }
        }

        return null;
    }

    /**
     * Menghitung perkiraan waktu selesai berdasarkan lama operasi.
     */
    protected function hitungWaktuSelesai(?Carbon $waktuTiba, ?string $lamaOperasi): ?Carbon
    {
        if (! $waktuTiba) {
            return null;
        }

        if (empty($lamaOperasi) || $lamaOperasi === '-') {
            return $waktuTiba->copy()->addMinutes(20);
        }

        $menitTambahan = 0;
        if (preg_match('/(\d+)\s*jam/i', $lamaOperasi, $jm)) {
            $menitTambahan += ((int) $jm[1]) * 60;
        }
        if (preg_match('/(\d+)\s*menit/i', $lamaOperasi, $mm)) {
            $menitTambahan += (int) $mm[1];
        }

        if ($menitTambahan <= 0) {
            $menitTambahan = 20;
        }

        return $waktuTiba->copy()->addMinutes($menitTambahan);
    }

    /**
     * Memetakan teks objek ke kategori dropdown non-kebakaran.
     */
    protected function petaKategoriNonKebakaran(string $teks): string
    {
        foreach (self::PETA_NON_KEBAKARAN as $kunci => $pola) {
            if (preg_match($pola, $teks)) {
                return $kunci;
            }
        }

        return 'lainnya';
    }

    /**
     * Mendeteksi jenis hewan jika laporan merupakan evakuasi satwa/hewan.
     */
    protected function deteksiJenisHewan(string $teks): ?string
    {
        if (preg_match('/ular\s*([a-z\s]+)?/i', $teks, $m)) {
            return trim($m[0]);
        }
        if (preg_match('/biawak/i', $teks)) {
            return 'Biawak';
        }
        if (preg_match('/kucing/i', $teks)) {
            return 'Kucing';
        }
        if (preg_match('/anjing/i', $teks)) {
            return 'Anjing';
        }
        if (preg_match('/tawon\s*([a-z\s]+)?|lebah\s*([a-z\s]+)?/i', $teks, $m)) {
            return trim($m[0]);
        }
        if (preg_match('/musang/i', $teks)) {
            return 'Musang';
        }
        if (preg_match('/buaya/i', $teks)) {
            return 'Buaya';
        }
        if (preg_match('/kera|monyet/i', $teks)) {
            return 'Monyet / Kera';
        }
        if (preg_match('/sapi|kambing/i', $teks, $m)) {
            return ucfirst(strtolower(trim($m[0])));
        }

        return null;
    }

    /**
     * Parsing status korban (meninggal/cidera/luka).
     */
    protected function parseKorban(mixed $value, ?string $namaKorban = null, ?string $kronologi = null): array
    {
        $res = [
            'selamat' => 0,
            'ringan' => 0,
            'berat' => 0,
            'meninggal' => 0,
        ];

        $col13Raw = (! empty($value) && $value !== '-') ? trim((string) $value) : '';
        $angkaCol13 = $this->ekstrakAngka($col13Raw);

        // Jika angka terlalu besar (> 1000), ini bukan jumlah korban (kemungkinan NIK, nomor telepon, atau ID)
        if ($angkaCol13 > 1000) {
            $angkaCol13 = 0;
        }

        $teksNama = Str::lower($namaKorban ?? '');
        $teksCol13 = Str::lower($col13Raw);

        if ($angkaCol13 > 0 || ($teksCol13 !== '' && $teksCol13 !== '-')) {
            $teksKonteks = Str::lower($col13Raw.' '.$teksNama.' '.($kronologi ?? ''));

            $isMeninggal = (bool) preg_match('/meninggal|tewas|\bmd\b|tutup usia/i', $teksKonteks);
            $isLukaBerat = (bool) preg_match('/luka berat|cidera berat|cedera berat|kritis/i', $teksKonteks);

            if ($isMeninggal) {
                $res['meninggal'] = min($angkaCol13 ?: 1, 9999);
            } elseif ($isLukaBerat) {
                $res['berat'] = min($angkaCol13 ?: 1, 9999);
            } else {
                // Abaikan jika hanya berupa deretan angka panjang (seperti NIK) tanpa indikasi luka
                if ($angkaCol13 === 0 && preg_match('/^\d{5,}$/', $col13Raw)) {
                    return $res;
                }
                $res['ringan'] = min($angkaCol13 ?: 1, 9999);
            }

            return $res;
        }

        if ($teksNama !== '') {
            if (preg_match('/meninggal|tewas|\bmd\b|tutup usia/i', $teksNama)) {
                $res['meninggal'] = 1;
            } elseif (preg_match('/luka berat|cidera berat|cedera berat|kritis/i', $teksNama)) {
                $res['berat'] = 1;
            } elseif (preg_match('/luka bakar|\bluka\b|\bcidera\b|\bcedera\b|\bpatah\b|\blecet\b/i', $teksNama)) {
                $res['ringan'] = 1;
            }
        }

        return $res;
    }

    /**
     * Parsing sarana dan armada yang digunakan dari teks kolom 20.
     */
    protected function parseSarana(?string $teks): array
    {
        if (empty($teks) || $teks === '-') {
            return [
                'armada' => ['R2 Rescue'],
                'teks' => null,
            ];
        }

        $armada = [];
        $lower = strtolower($teks);

        if (preg_match('/r2|roda 2|motor/i', $lower)) {
            $armada[] = 'R2 Rescue';
        }
        if (preg_match('/apv|rescue apv/i', $lower)) {
            $armada[] = 'APV Rescue';
        }
        if (preg_match('/fire ?jeep|jeep/i', $lower)) {
            $armada[] = 'Fire Jeep';
        }
        if (preg_match('/speedboat|speed boat|perahu/i', $lower)) {
            $armada[] = 'Speedboat Rescue';
        }
        if (preg_match('/armada 013/i', $lower)) {
            $armada[] = 'Armada 013';
        }
        if (empty($armada) && preg_match('/armada|mobil|kendaraan/i', $lower)) {
            $armada[] = 'Kendaraan Rescue';
        }

        if (empty($armada)) {
            $armada[] = 'R2 Rescue';
        }

        return [
            'armada' => array_values(array_unique($armada)),
            'teks' => $teks,
        ];
    }

    /**
     * Parsing instansi pendukung dari kolom 21 (Tim Quick Respon).
     */
    protected function parseInstansi(?string $teks): array
    {
        if (empty($teks) || $teks === '-') {
            return [
                'list' => null,
                'teks' => null,
            ];
        }

        $list = [];
        $lower = strtolower($teks);

        if (str_contains($lower, 'polsek') || str_contains($lower, 'polisi') || str_contains($lower, 'polresta')) {
            $list[] = 'Kepolisian';
        }
        if (str_contains($lower, 'babinsa') || str_contains($lower, 'koramil') || str_contains($lower, 'tni')) {
            $list[] = 'TNI / Babinsa';
        }
        if (str_contains($lower, 'psc') || str_contains($lower, '119') || str_contains($lower, 'medis') || str_contains($lower, 'ambulans')) {
            $list[] = 'PSC 119 / Tim Medis';
        }
        if (str_contains($lower, 'basarnas')) {
            $list[] = 'Basarnas';
        }
        if (str_contains($lower, 'pln')) {
            $list[] = 'PLN';
        }
        if (str_contains($lower, 'tagana') || str_contains($lower, 'relawan')) {
            $list[] = 'Tagana / Relawan';
        }

        if (empty($list)) {
            $list[] = trim($teks);
        }

        return [
            'list' => array_values(array_unique($list)),
            'teks' => $teks,
        ];
    }

    /**
     * Membersihkan prefix "Pimpinan Operasi : " dari teks pimpinan dan memisahkan Pendamping Operasi jika ada.
     *
     * @return array{pimpinan: ?string, pendamping: ?string}
     */
    protected function bersihkanPrefixPimpinan(?string $teks): array
    {
        if (empty($teks) || $teks === '-') {
            return ['pimpinan' => null, 'pendamping' => null];
        }

        $clean = preg_replace('/^pimpinan\s*operasi\s*[:;]\s*/i', '', trim($teks));
        $clean = preg_replace('/,\s*satuan\s*tugas.*$/i', '', $clean);

        $pendamping = null;
        if (preg_match('/,\s*pendamping\s*operasi\s*[:;]\s*(.*)$/i', $clean, $m)) {
            $clean = preg_replace('/,\s*pendamping\s*operasi\s*[:;].*$/i', '', $clean);
            $pendamping = Str::limit(trim($m[1]), 250, '');
        }

        return [
            'pimpinan' => Str::limit(trim($clean), 250, '') ?: null,
            'pendamping' => $pendamping,
        ];
    }

    /**
     * Membersihkan prefix "Satuan Tugas : " dari teks satgas.
     */
    protected function bersihkanPrefixSatgas(?string $teks): ?string
    {
        if (empty($teks) || $teks === '-') {
            return null;
        }

        $clean = preg_replace('/^satuan\s*tugas\s*[:;]\s*/i', '', trim($teks));

        return Str::limit(trim($clean), 250, '') ?: null;
    }

    /**
     * Menggabungkan teks dari baris utama dan anak untuk kolom tertentu.
     */
    protected function gabungTeksKolom(int $colIndex, array $main, array $subs): ?string
    {
        $parts = [];
        if (isset($main[$colIndex]) && trim((string) $main[$colIndex]) !== '' && trim((string) $main[$colIndex]) !== '-') {
            $val = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F\p{C}]/u', '', (string) $main[$colIndex]);
            $val = trim($val);
            if ($val !== '') {
                $parts[] = $val;
            }
        }

        foreach ($subs as $sub) {
            if (isset($sub[$colIndex]) && trim((string) $sub[$colIndex]) !== '' && trim((string) $sub[$colIndex]) !== '-') {
                $val = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F\p{C}]/u', '', (string) $sub[$colIndex]);
                $val = trim($val);
                if ($val !== '' && ! in_array($val, $parts, true)) {
                    $parts[] = $val;
                }
            }
        }

        return ! empty($parts) ? implode("\n", $parts) : null;
    }

    /**
     * Konversi data array ke format JSON aman untuk kolom MySQL JSON.
     */
    protected function toJsonSafe(mixed $data): ?string
    {
        if (empty($data)) {
            return null;
        }

        $encoded = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);

        return ($encoded !== false && $encoded !== '') ? $encoded : null;
    }

    /**
     * Ekstraksi angka dari teks dengan proteksi integer overflow.
     */
    protected function ekstrakAngka(mixed $value): int
    {
        if (empty($value) || $value === '-') {
            return 0;
        }

        if (preg_match('/(\d+)/', (string) $value, $m)) {
            $val = (int) $m[1];

            // Cegah integer overflow (max 9999 untuk jumlah korban / personil)
            return ($val >= 0 && $val <= 9999) ? $val : 0;
        }

        return 0;
    }

    /**
     * Membersihkan dan menormalisasi string jarak tempuh dari Excel.
     * Mengatasi anomali seperti "4 Orang", "100m2", ": 4,2 KM", "± 6 Km", "4,2M", "350 Meter", dll.
     */
    protected function bersihkanJarakTempuh(?string $raw): ?string
    {
        if ($raw === null) {
            return null;
        }

        $raw = trim($raw);
        if ($raw === '' || $raw === '-' || $raw === '?') {
            return null;
        }

        // Anomali: jika tertulis jumlah personel/korban atau luas area
        if (preg_match('/(orang|personel|personil|jiwa|m2|persegi)/i', $raw)) {
            return null;
        }

        // Hapus simbol awalan seperti :, ±, ~, spasi
        $cleaned = preg_replace('/^[:\s±~]+/', '', $raw);
        $cleaned = rtrim($cleaned, " .\t\n\r\0\x0B");

        if ($cleaned === '') {
            return null;
        }

        // Normalisasi koma desimal ke titik: "4,2" -> "4.2"
        $cleaned = str_replace(',', '.', $cleaned);

        // Kasus 1: Pola angka m / meter (misal: "350 Meter", "850 m", "25 M")
        if (preg_match('/^(\d+(?:\.\d+)?)\s*(?:meter|m)$/i', $cleaned, $matches)) {
            $val = (float) $matches[1];
            // Typo penulisan Km (contoh: 4.2M, 3.1 m, 1 m)
            if (str_contains($matches[1], '.') || $val < 20) {
                return (string) ((float) $val);
            }

            // Konversi meter ke Km: 350 Meter -> 0.35
            return (string) round($val / 1000, 3);
        }

        // Kasus 2: Pola angka Km (misal: "4.2 KM", "1.7  KM", "4Km")
        if (preg_match('/^(\d+(?:\.\d+)?)\s*km$/i', $cleaned, $matches)) {
            return (string) ((float) $matches[1]);
        }

        // Kasus 3: Angka murni
        if (is_numeric($cleaned)) {
            return (string) ((float) $cleaned);
        }

        // Kasus 4: String yang masih mengandung angka
        if (preg_match('/(\d+(?:\.\d+)?)/', $cleaned, $matches)) {
            $val = (float) $matches[1];
            if (preg_match('/meter/i', $cleaned)) {
                return (string) round($val / 1000, 3);
            }

            return (string) ((float) $val);
        }

        return null;
    }

    /**
     * Format penomoran otomatis REG-YYYYMMDD-0001 (sesuai DamtanController).
     */
    protected function buatNomorLaporan(Carbon $tanggal): string
    {
        $prefix = 'REG-'.$tanggal->format('Ymd').'-';

        $terakhir = LaporanPenyelamatan::where('nomor_laporan', 'like', $prefix.'%')
            ->orderByDesc('nomor_laporan')
            ->value('nomor_laporan');

        $urut = $terakhir ? ((int) substr($terakhir, -4)) + 1 : 1;

        return $prefix.str_pad((string) $urut, 4, '0', STR_PAD_LEFT);
    }
}

<?php

namespace App\Imports;

use App\Models\LaporanPenyelamatan;
use App\Models\LpDokumentasi;
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
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class LaporanKebakaran2026Import implements Import, WithMultipleSheets
{
    /**
     * @var array<string, LaporanKebakaran2026SheetImport>
     */
    public array $sheetInstances = [];

    /**
     * @param int $userId ID User pemilik data laporan
     * @param bool $dryRun Mode simulasi tanpa menyimpan perubahan ke database
     * @param array $availableSheets Daftar seluruh sheet di file Excel
     */
    public function __construct(
        protected int $userId = 1,
        protected bool $dryRun = false,
        protected array $availableSheets = []
    ) {}

    /**
     * Menentukan sheet yang akan diimpor.
     * Secara default membaca "JANUARI-OKTOBER" dan "Sheet2".
     *
     * @return array<string, LaporanKebakaran2026SheetImport>
     */
    public function sheets(): array
    {
        $sheetNames = [];

        if (! empty($this->availableSheets)) {
            foreach ($this->availableSheets as $sheetName) {
                $lower = strtolower(trim((string) $sheetName));
                if (str_contains($lower, 'rekap') || str_contains($lower, 'grafik')) {
                    continue;
                }
                $sheetNames[] = (string) $sheetName;
            }
        }

        if (empty($sheetNames)) {
            $sheetNames = ['JANUARI-OKTOBER', 'Sheet2'];
        }

        $sheets = [];
        foreach ($sheetNames as $name) {
            $instance = new LaporanKebakaran2026SheetImport(
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

class LaporanKebakaran2026SheetImport implements ToCollection, WithCalculatedFormulas, WithStartRow
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
     * Pemetaan kata kunci objek kebakaran ke slug kategori internal sistem.
     */
    private const PETA_OBJEK = [
        'tempat_sampah' => '/sampah|\btpa\b|\btps\b/i',
        'rumah_ibadah' => '/masjid|mushola|musholla|surau|gereja|vihara|klenteng|kelenteng|\bpura\b|ibadah/i',
        'sarana_kesehatan' => '/rumah sakit|\brs\b|\brsud\b|puskesmas|klinik|posyandu/i',
        'sekolah' => '/sekolah|\b(sd|sdn|smp|smpn|sma|sman|smk|smkn|mts|man|paud|tk)\b|madrasah|kampus|universitas|\buin\b|pesantren|ponpes/i',
        'gudang' => '/gudang/i',
        'ruko' => '/\bruko\b|kios|toko|warung/i',
        'pasar_tempat_usaha' => '/pasar|bengkel|restoran|rumah makan|kedai|cafe|kafe|salon|pabrik|mini ?market|alfamart|indomaret|hotel|dealer|spbu|pom bensin|studio|\bmall\b|mebel|kopra/i',
        'kantor' => '/kantor|\bdinas\b|\bbalai\b/i',
        'rumah' => '/rumah|bedeng|\bkost\b|\bkos\b|asrama|kontrakan|\bmess\b|\bmes\b/i',
        'kendaraan_bermotor' => '/motor|mobil|kendaraan|truk|truck|\bbus\b|angkot|pick ?up|ambulans|ekspedisi|canter/i',
        'gardu_listrik' => '/gardu|trafo|kabel|tiang|listrik|amper|meteran|\bkwh\b/i',
        'lahan_pohon' => '/lahan|pohon|semak|kebun|rumput|hutan|gambut|belukar|ilalang|sawit|kelapa/i',
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
     * Baris data dimulai pada baris ke-7 (header ada di baris 3-6).
     */
    public function startRow(): int
    {
        return 7;
    }

    /**
     * Memproses seluruh koleksi baris dari sheet.
     */
    public function collection(Collection $rows): void
    {
        // 1. Kelompokkan multi-baris per insiden berdasarkan kolom NO
        $incidents = [];
        $currentIncident = null;

        foreach ($rows as $row) {
            $rowArr = $row->toArray();
            $col0 = isset($rowArr[0]) ? trim((string) $rowArr[0]) : '';
            $col1 = isset($rowArr[1]) ? trim((string) $rowArr[1]) : '';

            // Lewati baris bantuan nomor kolom (1, 2, 3, 4, ... 24)
            if (is_numeric($col0) && is_numeric($col1) && (int) $col1 === 2) {
                continue;
            }

            // Jika kolom NO berupa angka positif, tandai sebagai awal insiden baru
            if (is_numeric($col0) && (int) $col0 > 0) {
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

            // a. Parsing Hari & Tanggal Kejadian
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

            // b. Parsing Waktu Laporan, Tiba, dan Selesai
            $rawTerima = isset($main[2]) ? trim((string) $main[2]) : '';
            $rawTiba = isset($main[4]) ? trim((string) $main[4]) : '';
            $rawLama = isset($main[18]) ? trim((string) $main[18]) : '';

            $waktuTerima = $this->parseWaktu($rawTerima, $carbonTanggal);
            $waktuTiba = $this->parseWaktu($rawTiba, $carbonTanggal) ?? $waktuTerima;
            $waktuSelesai = $this->hitungWaktuSelesai($waktuTiba, $rawLama);

            $waktuTerimaStr = $waktuTerima ? $waktuTerima->format('Y-m-d H:i:s') : $carbonTanggal->format('Y-m-d 00:00:00');
            $waktuTibaStr = $waktuTiba ? $waktuTiba->format('Y-m-d H:i:s') : $waktuTerimaStr;
            $waktuSelesaiStr = $waktuSelesai ? $waktuSelesai->format('Y-m-d H:i:s') : null;

            // c. Media Pelaporan, Jarak Tempuh, Respon Time
            $mediaPelaporan = isset($main[3]) && trim((string) $main[3]) !== '' ? trim((string) $main[3]) : 'Operator Layanan Damkar';
            $jarakTempuh = isset($main[5]) && trim((string) $main[5]) !== '-' ? trim((string) $main[5]) : null;
            $responTime = isset($main[6]) && trim((string) $main[6]) !== '-' ? trim((string) $main[6]) : null;

            // d. Pelapor & Lokasi
            $namaPelapor = isset($main[7]) && trim((string) $main[7]) !== '-' ? trim((string) $main[7]) : 'Masyarakat';
            $teleponPelapor = isset($main[8]) && trim((string) $main[8]) !== '-' ? trim((string) $main[8]) : '-';
            $rawObjek = isset($main[9]) && trim((string) $main[9]) !== '-' ? trim((string) $main[9]) : 'Kebakaran';
            $alamat = isset($main[10]) && trim((string) $main[10]) !== '-' ? trim((string) $main[10]) : 'Kota Jambi';

            // e. Korban & Dampak
            $namaKorban = $this->gabungTeksKolom(11, $main, $subs);
            if ($namaKorban === '-') {
                $namaKorban = null;
            }
            $jumlahJiwa = $this->ekstrakAngka($main[12] ?? null);
            $wargaTerdampak = $this->ekstrakAngka($main[14] ?? null);

            // f. Pimpinan Operasi & Satuan Tugas
            $pimpinanOperasi = isset($main[15]) && trim((string) $main[15]) !== '-' ? trim((string) $main[15]) : null;
            $satuanTugas = isset($main[16]) && trim((string) $main[16]) !== '-' ? trim((string) $main[16]) : 'Pleton Mako Damkar';
            $jumlahPersonel = $this->ekstrakAngka($main[17] ?? null);

            // g. Kronologi, Hambatan, Penyebab
            $kronologi = $this->gabungTeksKolom(19, $main, $subs);
            $penyebabRaw = isset($main[20]) && trim((string) $main[20]) !== '-' ? trim((string) $main[20]) : 'Dalam Penyelidikan';
            $hambatan = $this->gabungTeksKolom(21, $main, $subs);

            $penyebabMap = $this->petaPenyebab($penyebabRaw);
            $kategoriKebakaran = $this->petaObjek($rawObjek);

            $korbanData = $this->parseKorban($main[13] ?? null, $namaKorban, $kronologi);

            // Jika jumlah jiwa masih 0 tetapi terdeteksi ada korban (meninggal/luka),
            // sesuaikan jumlah jiwa minimal sama dengan total korban
            $totalKorban = $korbanData['meninggal'] + $korbanData['berat'] + $korbanData['ringan'];
            if ($jumlahJiwa === 0 && $totalKorban > 0) {
                $jumlahJiwa = $totalKorban;
            }

            // Jika ada total jiwa tercatat dan lebih besar dari yang cedera/meninggal,
            // sisanya adalah korban selamat
            if ($jumlahJiwa > $totalKorban) {
                $korbanData['selamat'] = $jumlahJiwa - $totalKorban;
            }

            // h. Sarana yang Digunakan (Air, Foam, Armada)
            $saranaData = $this->parseSaranaMultiBaris($main, $subs);

            // i. Tim Quick Respon (Instansi Pendukung)
            $instansiData = $this->parseInstansiMultiBaris($main, $subs);

            // j. Deteksi Duplikasi
            $hashKunci = md5($tglKejadian.'|'.$waktuTerimaStr.'|'.strtolower(trim($alamat)));
            if (isset($this->seenInSheet[$hashKunci])) {
                $this->totalDuplikat++;

                continue;
            }
            $this->seenInSheet[$hashKunci] = true;

            $existing = LaporanPenyelamatan::where('kategori_kejadian', 'kebakaran')
                ->where('tanggal_kejadian', $tglKejadian)
                ->where('waktu_terima', $waktuTerimaStr)
                ->where('alamat', $alamat)
                ->first();

            if ($existing) {
                if ($this->dryRun) {
                    $this->totalDisimpan++;

                    continue;
                }

                // Update data agar data korban jiwa dan perbaikan sinkronisasi langsung terbarui
                DB::transaction(function () use (
                    $existing, $namaKorban, $jumlahJiwa, $korbanData, $wargaTerdampak,
                    $rawObjek, $hambatan, $saranaData, $pimpinanOperasi, $satuanTugas,
                    $jumlahPersonel, $responTime, $rawLama, $kronologi, $penyebabMap, $instansiData
                ) {
                    $existing->update([
                        'nama_korban' => $namaKorban,
                        'jumlah_jiwa' => $jumlahJiwa,
                        'warga_terdampak' => $wargaTerdampak,
                        'korban_selamat' => $korbanData['selamat'],
                        'korban_ringan' => $korbanData['ringan'],
                        'korban_berat' => $korbanData['berat'],
                        'korban_meninggal' => $korbanData['meninggal'],
                        'prioritas' => $korbanData['meninggal'] > 0 ? 'tinggi' : ($existing->prioritas ?? 'sedang'),
                        'dugaan_penyebab' => $penyebabMap['dugaan'],
                        'dugaan_penyebab_lainnya' => $penyebabMap['lainnya'],
                        'kronologi_lengkap' => $kronologi,
                        'hambatan_lapangan' => $hambatan,
                        'instansi_pendukung' => $this->toJsonSafe($instansiData['list']),
                        'tindakan_instansi' => $instansiData['teks'],
                    ]);

                    LpTeknisLogistik::updateOrCreate(
                        ['laporan_id' => $existing->id],
                        [
                            'pimpinan_operasi' => $pimpinanOperasi,
                            'satuan_tugas' => $satuanTugas,
                            'tim_respontime' => $responTime,
                            'jumlah_personel' => $jumlahPersonel,
                            'langkah_penanganan' => ! empty($rawLama) ? "Lama Operasi: {$rawLama}" : 'Pemadaman dan pendinginan',
                            'hambatan_lapangan' => $hambatan,
                            'hasil_tindakan' => 'Pemadaman berhasil diselesaikan dengan aman.',
                            'nama_korban' => $namaKorban,
                            'jumlah_jiwa' => $jumlahJiwa,
                            'warga_terdampak' => $wargaTerdampak,
                            'status_evakuasi' => 'Selesai',
                            'objek_terdampak' => $rawObjek,
                            'korban_selamat' => $korbanData['selamat'],
                            'korban_ringan' => $korbanData['ringan'],
                            'korban_berat' => $korbanData['berat'],
                            'korban_meninggal' => $korbanData['meninggal'],
                            'armada' => $saranaData['armada'],
                            'liter_air' => $saranaData['liter_air'],
                            'liter_foam' => $saranaData['liter_foam'],
                            'peralatan_lain' => $saranaData['ringkasan'],
                            'tim_respontime' => ! empty($instansiData['teks']) ? $instansiData['teks'] : null,
                        ]
                    );

                    LpDokumentasi::updateOrCreate(
                        ['laporan_id' => $existing->id],
                        [
                            'dugaan_penyebab' => $penyebabMap['dugaan'],
                            'dugaan_penyebab_lainnya' => $penyebabMap['lainnya'],
                            'kronologi_lengkap' => $kronologi,
                            'instansi_pendukung' => $instansiData['list'],
                            'tindakan_instansi' => $instansiData['teks'],
                        ]
                    );
                });

                $this->totalDisimpan++;

                continue;
            }

            if ($this->dryRun) {
                $this->totalDisimpan++;

                continue;
            }

            // k. Simpan Transaksional ke Database (3 Tabel)
            DB::transaction(function () use (
                $carbonTanggal, $tglKejadian, $hariKejadian, $bulanKejadian, $tahunKejadian,
                $namaPelapor, $teleponPelapor, $mediaPelaporan, $kategoriKebakaran, $rawObjek,
                $waktuTerimaStr, $waktuTibaStr, $waktuSelesaiStr, $alamat, $jarakTempuh,
                $namaKorban, $jumlahJiwa, $korbanData, $wargaTerdampak,
                $pimpinanOperasi, $satuanTugas, $jumlahPersonel, $responTime, $rawLama,
                $kronologi, $penyebabMap, $hambatan, $saranaData, $instansiData
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

                    'nama_pelapor' => $namaPelapor,
                    'telepon_pelapor' => $teleponPelapor,
                    'media_pelaporan' => $mediaPelaporan,

                    'kategori_kejadian' => 'kebakaran',
                    'kategori_kebakaran' => $kategoriKebakaran,
                    'keterangan_objek_kebakaran' => $rawObjek,
                    'prioritas' => $korbanData['meninggal'] > 0 ? 'tinggi' : 'sedang',

                    'waktu_kejadian' => $waktuTerimaStr,
                    'waktu_terima' => $waktuTerimaStr,
                    'waktu_berangkat' => $waktuTerimaStr,
                    'waktu_tiba' => $waktuTibaStr,
                    'waktu_selesai' => $waktuSelesaiStr,
                    'waktu_kembali' => null,

                    'alamat' => $alamat,
                    'jarak_tempuh' => $jarakTempuh,
                    'nama_korban' => $namaKorban,
                    'jumlah_jiwa' => $jumlahJiwa,
                    'warga_terdampak' => $wargaTerdampak,
                    'korban_selamat' => $korbanData['selamat'],
                    'korban_ringan' => $korbanData['ringan'],
                    'korban_berat' => $korbanData['berat'],
                    'korban_meninggal' => $korbanData['meninggal'],
                    'status_evakuasi' => 'Selesai',
                    'objek_terdampak' => $rawObjek,

                    'hambatan_lapangan' => $hambatan,
                    'liter_air' => $saranaData['liter_air'],
                    'liter_foam' => $saranaData['liter_foam'],
                    'armada' => $this->toJsonSafe($saranaData['armada']),
                    'jumlah_personel' => $jumlahPersonel,

                    'dugaan_penyebab' => $penyebabMap['dugaan'],
                    'dugaan_penyebab_lainnya' => $penyebabMap['lainnya'],
                    'kronologi_lengkap' => $kronologi,
                    'instansi_pendukung' => $this->toJsonSafe($instansiData['list']),
                    'tindakan_instansi' => $instansiData['teks'],
                ]);

                // TAB 2: lp_teknis_logistiks
                LpTeknisLogistik::create([
                    'laporan_id' => $laporan->id,
                    'pimpinan_operasi' => $pimpinanOperasi,
                    'satuan_tugas' => $satuanTugas,
                    'tim_respontime' => ! empty($instansiData['teks']) ? $instansiData['teks'] : null,
                    'jumlah_personel' => $jumlahPersonel,
                    'langkah_penanganan' => ! empty($rawLama) ? "Lama Operasi: {$rawLama}" : 'Pemadaman dan pendinginan',
                    'hambatan_lapangan' => $hambatan,
                    'hasil_tindakan' => 'Pemadaman berhasil diselesaikan dengan aman.',
                    'nama_korban' => $namaKorban,
                    'jumlah_jiwa' => $jumlahJiwa,
                    'warga_terdampak' => $wargaTerdampak,
                    'status_evakuasi' => 'Selesai',
                    'objek_terdampak' => $rawObjek,
                    'korban_selamat' => $korbanData['selamat'],
                    'korban_ringan' => $korbanData['ringan'],
                    'korban_berat' => $korbanData['berat'],
                    'korban_meninggal' => $korbanData['meninggal'],
                    'armada' => $saranaData['armada'],
                    'liter_air' => $saranaData['liter_air'],
                    'liter_foam' => $saranaData['liter_foam'],
                    'peralatan_lain' => $saranaData['ringkasan'],
                ]);

                // TAB 3: lp_dokumentasis
                LpDokumentasi::create([
                    'laporan_id' => $laporan->id,
                    'dugaan_penyebab' => $penyebabMap['dugaan'],
                    'dugaan_penyebab_lainnya' => $penyebabMap['lainnya'],
                    'kronologi_lengkap' => $kronologi,
                    'instansi_pendukung' => $instansiData['list'],
                    'tindakan_instansi' => $instansiData['teks'],
                ]);
            });

            $this->totalDisimpan++;
        }
    }

    /**
     * Parsing gabungan hari dan tanggal dari baris utama dan baris-baris anak.
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
            'januari' => 1, 'jan' => 1, 'janiari' => 1,
            'februari' => 2, 'feb' => 2,
            'maret' => 3, 'mar' => 3,
            'april' => 4, 'apr' => 4,
            'mei' => 5, 'may' => 5,
            'juni' => 6, 'jun' => 6,
            'juli' => 7, 'jul' => 7,
            'agustus' => 8, 'agu' => 8, 'agt' => 8, 'agust' => 8,
            'september' => 9, 'sep' => 9, 'sept' => 9,
            'oktober' => 10, 'okt' => 10, 'oct' => 10,
            'november' => 11, 'nov' => 11, 'nopember' => 11, 'nop' => 11,
            'desember' => 12, 'des' => 12, 'dec' => 12,
        ];

        $polaBulan = implode('|', array_keys($bulanMap));

        $hariDitemukan = null;
        $tanggalCarbon = null;

        foreach ($kandidatTeks as $teks) {
            // Cek nama hari
            if (! $hariDitemukan) {
                if (preg_match('/(senin|selasa|rabu|kamis|jum\'?at|sabtu|minggu)/i', $teks, $hm)) {
                    $hariDitemukan = ucfirst(strtolower($hm[1]));
                }
            }

            // Cek serial Excel
            if (is_numeric($teks) && (float) $teks > 30000 && (float) $teks < 60000) {
                try {
                    $dt = ExcelDate::excelToDateTimeObject((float) $teks);
                    $tanggalCarbon = Carbon::instance($dt)->locale('id');
                    break;
                } catch (\Throwable) {
                }
            }

            // Bersihkan kutip dan spasi
            $cleaned = trim(str_replace(["'", '"'], '', $teks));

            // Pola pencarian bulan spesifik: "02 Maret 2026", "26Juli 2026", "juli 2026", "7 Januari 2026"
            if (preg_match('/(?:(\d{1,2})\s*)?(' . $polaBulan . ')(?:\s*(\d{4}))?/i', $cleaned, $m)) {
                $namaBulan = strtolower($m[2]);
                if (isset($bulanMap[$namaBulan])) {
                    $day = ! empty($m[1]) ? (int) $m[1] : 1;
                    $month = $bulanMap[$namaBulan];
                    $year = ! empty($m[3]) ? (int) $m[3] : 2026;

                    try {
                        $tanggalCarbon = Carbon::createFromDate($year, $month, $day)->locale('id');
                        break;
                    } catch (\Throwable) {
                    }
                }
            }
        }

        if (! $tanggalCarbon) {
            return null;
        }

        return [
            'tanggal' => $tanggalCarbon->toDateString(),
            'hari' => $hariDitemukan ?: $tanggalCarbon->translatedFormat('l'),
            'bulan' => $tanggalCarbon->translatedFormat('F'),
            'tahun' => $tanggalCarbon->year,
        ];
    }

    /**
     * Parsing teks waktu laporan (contoh: "23.20 WIB", "02.50 WIB", "17:05:00", "13,44 WIB").
     */
    protected function parseWaktu(?string $raw, Carbon $tanggal): ?Carbon
    {
        if (empty($raw) || $raw === '-') {
            return null;
        }

        $s = str_replace([',', 'WIB', 'wib', 'Wib'], ['.', '', '', ''], trim($raw));
        $s = trim(preg_replace('/\s+/', '', $s), " .:\t\n\r");

        if (preg_match('/(\d{1,2})[:.](\d{2})(?:[:.](\d{2}))?/', $s, $m)) {
            $jam = str_pad($m[1], 2, '0', STR_PAD_LEFT);
            $menit = str_pad($m[2], 2, '0', STR_PAD_LEFT);
            $detik = ! empty($m[3]) ? str_pad($m[3], 2, '0', STR_PAD_LEFT) : '00';

            try {
                return Carbon::parse($tanggal->format('Y-m-d')." {$jam}:{$menit}:{$detik}");
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
            return $waktuTiba->copy()->addMinutes(30);
        }

        $menitTambahan = 0;
        if (preg_match('/(\d+)\s*jam/i', $lamaOperasi, $jm)) {
            $menitTambahan += ((int) $jm[1]) * 60;
        }
        if (preg_match('/(\d+)\s*menit/i', $lamaOperasi, $mm)) {
            $menitTambahan += (int) $mm[1];
        }

        if ($menitTambahan <= 0) {
            $menitTambahan = 30;
        }

        return $waktuTiba->copy()->addMinutes($menitTambahan);
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
     * Parsing rincian sarana yang digunakan (Air, Foam, Armada) dari seluruh baris insiden.
     */
    protected function parseSaranaMultiBaris(array $main, array $subs): array
    {
        $lines = [];
        if (isset($main[22]) && trim((string) $main[22]) !== '' && trim((string) $main[22]) !== '-') {
            $lines[] = trim((string) $main[22]);
        }

        foreach ($subs as $sub) {
            if (isset($sub[22]) && trim((string) $sub[22]) !== '' && trim((string) $sub[22]) !== '-') {
                $lines[] = trim((string) $sub[22]);
            }
        }

        $literAir = 0;
        $literFoam = 0;
        $armada = [];

        foreach ($lines as $line) {
            $lower = strtolower($line);

            // Deteksi Liquid Foam
            if (str_contains($lower, 'foam')) {
                if (preg_match('/(\d[\d.,]*)\s*(?:liter|ltr)?/i', $line, $fm)) {
                    $num = (int) preg_replace('/[^\d]/', '', $fm[1]);
                    if ($num > 0) {
                        $literFoam += $num;
                    }
                }

                continue;
            }

            // Deteksi Air
            if (preg_match('/(\d[\d.,]*)\s*(?:liter|ltr)/i', $line, $am)) {
                $num = (int) preg_replace('/[^\d]/', '', $am[1]);
                if ($num > 0) {
                    $literAir += $num;
                }
            }

            // Deteksi Unit Armada / Kendaraan
            if (preg_match('/armada|unit|rescue|tempur|supply|suplay|comando|komando|apv|jeep|motor|ambulance|apar|08|09|010|011|012|013|014|015|016/i', $line)) {
                $bersih = preg_replace('/[\x00-\x1F\x7F\p{C}]/u', '', (string) $line);
                $bersih = trim($bersih, " \t\n\r\0\x0B,;*-");
                if (! empty($bersih) && ! in_array($bersih, $armada, true)) {
                    $armada[] = $bersih;
                }
            }
        }

        return [
            'liter_air' => $literAir,
            'liter_foam' => $literFoam,
            'armada' => ! empty($armada) ? $armada : null,
            'ringkasan' => ! empty($lines) ? implode('; ', $lines) : null,
        ];
    }

    /**
     * Parsing instansi pendukung / Tim Quick Respon (Kolom V / Index 21).
     */
    protected function parseInstansiMultiBaris(array $main, array $subs): array
    {
        $rawItems = [];
        $valMain = isset($main[21]) && trim((string) $main[21]) !== '' && trim((string) $main[21]) !== '-'
            ? trim((string) $main[21])
            : (isset($main[23]) && trim((string) $main[23]) !== '' && trim((string) $main[23]) !== '-' ? trim((string) $main[23]) : null);
        if ($valMain) {
            $rawItems[] = $valMain;
        }

        foreach ($subs as $sub) {
            $valSub = isset($sub[21]) && trim((string) $sub[21]) !== '' && trim((string) $sub[21]) !== '-'
                ? trim((string) $sub[21])
                : (isset($sub[23]) && trim((string) $sub[23]) !== '' && trim((string) $sub[23]) !== '-' ? trim((string) $sub[23]) : null);
            if ($valSub) {
                $rawItems[] = $valSub;
            }
        }

        $list = [];
        foreach ($rawItems as $item) {
            $pecah = preg_split('/[\r\n,]+/', $item);
            foreach ($pecah as $p) {
                $bersih = preg_replace('/[\x00-\x1F\x7F\p{C}]/u', '', (string) $p);
                $bersih = trim($bersih, " \t\n\r\0\x0B*•-");
                if ($bersih !== '' && ! in_array($bersih, $list, true)) {
                    $list[] = $bersih;
                }
            }
        }

        return [
            'list' => ! empty($list) ? $list : null,
            'teks' => ! empty($list) ? implode(', ', $list) : null,
        ];
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
     * Memetakan teks jenis terbakar ke slug kategori objek kebakaran.
     */
    protected function petaObjek(string $teks): string
    {
        foreach (self::PETA_OBJEK as $kunci => $pola) {
            if (preg_match($pola, $teks)) {
                return $kunci;
            }
        }

        return 'lainnya';
    }

    /**
     * Memetakan teks penyebab kebakaran ke kategori dropdown aplikasi.
     */
    protected function petaPenyebab(string $teks): array
    {
        $s = Str::lower($teks);

        if (preg_match('/konsleting|korslet|korsleting|listrik|arus pendek|kabel|kipas|colokan|\bac\b|magic ?com|setrika|charger|stop ?kontak|steker|trafo|genset|amper|meteran/', $s)) {
            return ['dugaan' => 'arus_pendek', 'lainnya' => null];
        }
        if (str_contains($s, 'petir')) {
            return ['dugaan' => 'sambaran_petir', 'lainnya' => null];
        }
        if (str_contains($s, 'gas') || str_contains($s, 'regulator')) {
            return ['dugaan' => 'kebocoran_gas', 'lainnya' => null];
        }
        if (preg_match('/sampah|puntung|rokok|obat nyamuk|korek|lilin|lalai|kelalaian|bakar|membakar|pembakaran|kembang api|anglo|tungku|odgj|batubara/', $s)) {
            return ['dugaan' => 'kelalaian_manusia', 'lainnya' => null];
        }
        if (preg_match('/faktor alam|cuaca|kemarau/', $s)) {
            return ['dugaan' => 'faktor_alam', 'lainnya' => null];
        }

        return ['dugaan' => 'lainnya', 'lainnya' => $teks ?: null];
    }

    /**
     * Parsing angka dari nilai teks (contoh: "5 orang" -> 5).
     */
    protected function ekstrakAngka(mixed $value): int
    {
        if (empty($value) || $value === '-') {
            return 0;
        }

        if (preg_match('/(\d+)/', (string) $value, $m)) {
            return (int) $m[1];
        }

        return 0;
    }

    /**
     * Parsing status korban (meninggal/cidera/luka) dengan pengecekan komprehensif
     * pada Kolom 13, Kolom 11 (Nama/Catatan Korban), serta Kolom 19 (Kronologi).
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

        $teksNama = Str::lower($namaKorban ?? '');
        $teksCol13 = Str::lower($col13Raw);

        // Jika di Kolom 13 ada angka atau catatan terkait korban (contoh: "1 Jiwa", "1 Orang", "1"):
        if ($angkaCol13 > 0 || ($teksCol13 !== '' && $teksCol13 !== '-')) {
            $teksKonteks = Str::lower($col13Raw.' '.$teksNama.' '.($kronologi ?? ''));

            $isMeninggal = (bool) preg_match('/meninggal|tewas|\bmd\b|tutup usia/i', $teksKonteks);
            $isLukaBerat = (bool) preg_match('/luka berat|cidera berat|cedera berat|kritis/i', $teksKonteks);

            if ($isMeninggal) {
                $res['meninggal'] = $angkaCol13 ?: 1;
            } elseif ($isLukaBerat) {
                $res['berat'] = $angkaCol13 ?: 1;
            } else {
                // Default korban luka/cidera jika ada angka di kolom 13
                $res['ringan'] = $angkaCol13 ?: 1;
            }

            return $res;
        }

        // Jika Kolom 13 kosong / '-', periksa apakah pada Kolom 11 (Nama/Keterangan Korban) terdapat catatan luka/meninggal:
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

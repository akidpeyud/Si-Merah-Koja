<?php

namespace App\Imports;

use App\Models\LaporanPenyelamatan;
use App\Models\LpDokumentasi;
use App\Models\LpTeknisLogistik;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class LaporanKebakaranBulananImport implements ToCollection, WithCalculatedFormulas, WithMultipleSheets, WithStartRow
{
    public int $totalDibaca = 0;
    public int $totalDisimpan = 0;
    public int $totalDuplikat = 0;
    public int $totalDilewati = 0;

    /**
     * Cache internal untuk mencegah duplikasi jika ada rekap tahunan di bagian bawah sheet yang sama.
     */
    private array $seenInFile = [];

    /**
     * Pemetaan kata kunci objek kebakaran ke slug kategori internal sistem.
     */
    private const PETA_OBJEK = [
        'tempat_sampah'      => '/sampah|\btpa\b|\btps\b/i',
        'rumah_ibadah'       => '/masjid|mushola|musholla|surau|gereja|vihara|klenteng|kelenteng|\bpura\b|ibadah/i',
        'sarana_kesehatan'   => '/rumah sakit|\brs\b|\brsud\b|puskesmas|klinik|posyandu/i',
        'sekolah'            => '/sekolah|\b(sd|sdn|smp|smpn|sma|sman|smk|smkn|mts|man|paud|tk)\b|madrasah|kampus|universitas|\buin\b|pesantren|ponpes/i',
        'gudang'             => '/gudang/i',
        'ruko'               => '/\bruko\b|kios|toko|warung/i',
        'pasar_tempat_usaha' => '/pasar|bengkel|restoran|rumah makan|kedai|cafe|kafe|salon|pabrik|mini ?market|alfamart|indomaret|hotel|dealer|spbu|pom bensin|studio|\bmall\b|mebel|kopra/i',
        'kantor'             => '/kantor|\bdinas\b|\bbalai\b/i',
        'rumah'              => '/rumah|bedeng|\bkost\b|\bkos\b|asrama|kontrakan|\bmess\b|\bmes\b/i',
        'kendaraan_bermotor' => '/motor|mobil|kendaraan|truk|truck|\bbus\b|angkot|pick ?up|ambulans|ekspedisi/i',
        'gardu_listrik'      => '/gardu|trafo|kabel|tiang|listrik|amper|meteran|\bkwh\b/i',
        'lahan_pohon'        => '/lahan|pohon|semak|kebun|rumput|hutan|gambut|belukar|ilalang|sawit|kelapa/i',
    ];

    /**
     * @param int $userId ID User pemilik data laporan
     * @param array $availableSheets Daftar seluruh sheet di file Excel
     * @param bool $dryRun Mode simulasi tanpa menyimpan ke database
     */
    public function __construct(
        protected int $userId = 1,
        protected array $availableSheets = [],
        protected bool $dryRun = false
    ) {}

    /**
     * Hanya membaca sheet "BULANAN" (case-insensitive).
     */
    public function sheets(): array
    {
        if (!empty($this->availableSheets)) {
            foreach ($this->availableSheets as $sheetName) {
                if (strcasecmp(trim((string) $sheetName), 'BULANAN') === 0) {
                    return [$sheetName => $this];
                }
            }
        }

        return [
            'BULANAN' => $this,
        ];
    }

    /**
     * Baris data dimulai pada baris ke-5.
     */
    public function startRow(): int
    {
        return 5;
    }

    /**
     * Proses seluruh baris data dari sheet BULANAN.
     */
    public function collection(Collection $rows): void
    {
        foreach ($rows as $index => $row) {
            $this->totalDibaca++;

            // 1. Validasi Kolom 0 (A - NO): Harus numerik
            // Melewati baris judul bulan (misal "LAPORAN KEBAKARAN BULAN FEBRUARI 2026") dan baris kosong
            $rawNo = isset($row[0]) ? trim((string) $row[0]) : '';
            if (!is_numeric($rawNo)) {
                $this->totalDilewati++;
                continue;
            }

            // 2. Ambil nilai mentah tiap kolom sesuai instruksi
            $rawTanggal   = isset($row[1]) ? trim((string) $row[1]) : ''; // Kolom 1 (B): Tanggal Kejadian
            $rawJam       = isset($row[2]) ? trim((string) $row[2]) : ''; // Kolom 2 (C): Jam
            $rawJenis     = isset($row[3]) ? trim((string) $row[3]) : ''; // Kolom 3 (D): Jenis yang terbakar
            $rawPenyebab  = isset($row[4]) ? trim((string) $row[4]) : ''; // Kolom 4 (E): Penyebab
            $rawLokasi    = isset($row[5]) ? trim((string) $row[5]) : ''; // Kolom 5 (F): Lokasi Kejadian
            $rawPelapor   = isset($row[6]) ? trim((string) $row[6]) : ''; // Kolom 6 (G): Nama Pelapor/No HP
            $rawKorban    = isset($row[7]) ? trim((string) $row[7]) : ''; // Kolom 7 (H): KORBAN
            $rawArmada    = isset($row[8]) ? trim((string) $row[8]) : ''; // Kolom 8 (I): Armada
            $rawAir       = isset($row[9]) ? trim((string) $row[9]) : ''; // Kolom 9 (J): Jumlah Air
            $rawKerugian  = isset($row[10]) ? trim((string) $row[10]) : ''; // Kolom 10 (K): Jumlah Kerugian
            $rawRespon    = isset($row[11]) ? trim((string) $row[11]) : ''; // Kolom 11 (L): Respon Time
            $rawSatuanRsp = isset($row[12]) ? trim((string) $row[12]) : ''; // Kolom 12 (M): Satuan (Menit)
            $rawKepuasan  = isset($row[13]) ? trim((string) $row[13]) : ''; // Kolom 13 (N): Tingkat Kepuasan
            $rawKet       = isset($row[14]) ? trim((string) $row[14]) : ''; // Kolom 14 (O): Keterangan

            if (empty($rawTanggal) || empty($rawLokasi)) {
                $this->totalDilewati++;
                continue;
            }

            // 3. Parsing Tanggal & Waktu
            $dtTanggal = $this->parseTanggal($rawTanggal);
            if (!$dtTanggal) {
                $this->totalDilewati++;
                continue;
            }

            $jamParsed = $this->parseJam($rawJam);
            $waktuKejadianStr = $jamParsed
                ? $dtTanggal->copy()->format('Y-m-d') . ' ' . $jamParsed
                : $dtTanggal->copy()->format('Y-m-d') . ' 08:00:00';

            // Respon Time (Menit)
            $responMenit = $this->parseAngka($rawRespon);
            $waktuTerima = Carbon::parse($waktuKejadianStr);
            $waktuTiba = $responMenit > 0 ? $waktuTerima->copy()->addMinutes($responMenit) : null;
            $waktuSelesai = $waktuTiba ? $waktuTiba->copy()->addMinutes(45) : null;

            // 4. Deteksi Duplikat di dalam sheet yang sama (mencegah duplikasi dari bagian rekap bawah)
            $dedupKey = md5($dtTanggal->toDateString() . '|' . $jamParsed . '|' . Str::lower($rawLokasi));
            if (isset($this->seenInFile[$dedupKey])) {
                $this->totalDuplikat++;
                continue;
            }
            $this->seenInFile[$dedupKey] = true;

            // 5. Cek Apakah Data Sudah Ada di Database
            $existsInDb = LaporanPenyelamatan::where('kategori_kejadian', 'kebakaran')
                ->where('tanggal_kejadian', $dtTanggal->toDateString())
                ->where(function ($q) use ($rawLokasi, $waktuKejadianStr) {
                    $q->where('alamat', $rawLokasi)
                      ->orWhere('waktu_kejadian', $waktuKejadianStr);
                })
                ->exists();

            if ($existsInDb) {
                $this->totalDuplikat++;
                continue;
            }

            // Jika mode Dry-Run, catat sebagai akan masuk dan lanjutkan
            if ($this->dryRun) {
                $this->totalDisimpan++;
                continue;
            }

            // 6. Parsing Field Terkait
            $pelaporData = $this->parsePelapor($rawPelapor);
            $kategoriKebakaran = $this->petaObjek($rawJenis);
            $penyebabData = $this->petaPenyebab($rawPenyebab);
            $airData = $this->parseAir($rawAir);
            $korbanData = $this->parseKorban($rawKorban);

            // Buat Kronologi Lengkap untuk dokumentasi
            $kronologiParts = [
                "Kejadian kebakaran objek " . ($rawJenis ?: 'tidak diketahui') . " pada tanggal " . $dtTanggal->translatedFormat('d F Y') . " sekitar pukul " . ($jamParsed ?: '-') . " WIB.",
                "Lokasi kejadian: " . $rawLokasi . ".",
                "Dugaan penyebab: " . ($rawPenyebab ?: 'Dalam penyelidikan') . ".",
            ];
            if (!empty($rawKerugian) && $rawKerugian !== '-') {
                $kronologiParts[] = "Estimasi jumlah kerugian: Rp " . number_format((float) preg_replace('/[^\d]/', '', $rawKerugian), 0, ',', '.') . ".";
            }
            if (!empty($rawKorban) && $rawKorban !== '-') {
                $kronologiParts[] = "Keterangan korban: " . $rawKorban . ".";
            }
            if (!empty($rawKet) && $rawKet !== '-') {
                $kronologiParts[] = "Petugas penanganan: " . $rawKet . ".";
            }
            $kronologiTeks = implode(" ", $kronologiParts);

            // 7. Simpan Transaksional ke Database
            DB::transaction(function () use (
                $dtTanggal, $pelaporData, $kategoriKebakaran, $rawJenis,
                $waktuKejadianStr, $waktuTerima, $waktuTiba, $waktuSelesai,
                $rawLokasi, $korbanData, $rawArmada, $airData, $penyebabData,
                $rawPenyebab, $kronologiTeks, $rawKet, $rawKepuasan, $rawKerugian
            ) {
                $nomorLaporan = $this->buatNomorLaporan($dtTanggal);

                // TAB 1: Tabel Utama (laporan_penyelamatans)
                $laporan = LaporanPenyelamatan::create([
                    'nomor_laporan'              => $nomorLaporan,
                    'id_laporan'                 => Str::uuid()->toString(),
                    'user_id'                    => $this->userId,
                    'tanggal_kejadian'           => $dtTanggal->toDateString(),
                    'hari_kejadian'              => $dtTanggal->copy()->locale('id')->translatedFormat('l'),
                    'bulan_kejadian'             => $dtTanggal->copy()->locale('id')->translatedFormat('F'),
                    'tahun_kejadian'             => $dtTanggal->year,

                    'nama_pelapor'               => $pelaporData['nama'],
                    'telepon_pelapor'            => $pelaporData['telepon'],
                    'media_pelaporan'            => 'WhatsApp / Telepon',

                    'kategori_kejadian'          => 'kebakaran',
                    'kategori_kebakaran'         => $kategoriKebakaran,
                    'keterangan_objek_kebakaran' => $rawJenis ?: 'Kebakaran',
                    'prioritas'                  => $korbanData['meninggal'] > 0 ? 'tinggi' : 'sedang',

                    'waktu_kejadian'             => $waktuKejadianStr,
                    'waktu_terima'               => $waktuTerima->format('Y-m-d H:i:s'),
                    'waktu_berangkat'            => $waktuTerima->format('Y-m-d H:i:s'),
                    'waktu_tiba'                 => $waktuTiba ? $waktuTiba->format('Y-m-d H:i:s') : null,
                    'waktu_selesai'              => $waktuSelesai ? $waktuSelesai->format('Y-m-d H:i:s') : null,
                    'waktu_kembali'              => null,

                    'alamat'                     => $rawLokasi,
                    'korban_selamat'             => $korbanData['selamat'],
                    'korban_ringan'              => $korbanData['ringan'],
                    'korban_berat'               => $korbanData['berat'],
                    'korban_meninggal'           => $korbanData['meninggal'],
                    'korban_hewan_aset'          => $korbanData['keterangan'],
                    'status_evakuasi'            => 'Selesai',
                    'objek_terdampak'            => $rawKerugian !== '-' ? $rawKerugian : null,

                    'armada'                     => !empty($rawArmada) && $rawArmada !== '-' ? json_encode([$rawArmada]) : null,
                    'liter_air'                  => $airData['liter'],
                    'dugaan_penyebab'            => $penyebabData['dugaan'],
                    'dugaan_penyebab_lainnya'    => $penyebabData['lainnya'],
                    'kronologi_lengkap'          => $kronologiTeks,
                ]);

                // TAB 2: Tabel Teknis & Logistik (lp_teknis_logistiks)
                LpTeknisLogistik::create([
                    'laporan_id'       => $laporan->id,
                    'pimpinan_operasi' => null,
                    'satuan_tugas'     => (!empty($rawKet) && $rawKet !== '-') ? $rawKet : 'Mako Damkar',
                    'hasil_tindakan'   => (!empty($rawKepuasan) && $rawKepuasan !== '-') ? $rawKepuasan : 'Terlayani',
                    'status_evakuasi'  => 'Selesai',
                    'objek_terdampak'  => $rawJenis ?: null,
                    'korban_selamat'   => $korbanData['selamat'],
                    'korban_ringan'    => $korbanData['ringan'],
                    'korban_berat'     => $korbanData['berat'],
                    'korban_meninggal' => $korbanData['meninggal'],
                    'korban_hewan_aset'=> $korbanData['keterangan'],
                    'armada'           => !empty($rawArmada) && $rawArmada !== '-' ? [$rawArmada] : null,
                    'liter_air'        => $airData['liter'],
                    'konsumsi_alat'    => $airData['konsumsi_alat'],
                ]);

                // TAB 3: Tabel Dokumentasi (lp_dokumentasis)
                LpDokumentasi::create([
                    'laporan_id'              => $laporan->id,
                    'dugaan_penyebab'         => $penyebabData['dugaan'],
                    'dugaan_penyebab_lainnya' => $penyebabData['lainnya'],
                    'kronologi_lengkap'       => $kronologiTeks,
                ]);
            });

            $this->totalDisimpan++;
        }
    }

    /**
     * Parsing Tanggal dari format teks Indonesia atau format Excel.
     */
    private function parseTanggal(mixed $value): ?Carbon
    {
        if (empty($value) || $value === '-') {
            return null;
        }

        // Angka serial Excel
        if (is_numeric($value) && !is_string($value) && $value > 30000) {
            return Carbon::instance(ExcelDate::excelToDateTimeObject((float) $value));
        }

        $s = trim(preg_replace('/\s+/', ' ', (string) $value), " \t\n\r\0\x0B\"'");

        // Format YYYY-MM-DD
        if (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $s, $m)) {
            return Carbon::createFromDate((int) $m[1], (int) $m[2], (int) $m[3]);
        }

        // Format DD Bulan YYYY (contoh: "07 Januari 2026" atau "5 Agustus 2026")
        $bulanMap = [
            'januari' => 1, 'februari' => 2, 'maret' => 3, 'april' => 4,
            'mei' => 5, 'juni' => 6, 'juli' => 7, 'agustus' => 8,
            'september' => 9, 'oktober' => 10, 'november' => 11, 'desember' => 12,
        ];

        if (preg_match('/^(\d{1,2})\s+([A-Za-z]+)(?:\s+(\d{4}))?$/', $s, $m)) {
            $hari = (int) $m[1];
            $blnNama = strtolower($m[2]);
            $tahun = !empty($m[3]) ? (int) $m[3] : 2026;

            if (isset($bulanMap[$blnNama]) && checkdate($bulanMap[$blnNama], $hari, $tahun)) {
                return Carbon::createFromDate($tahun, $bulanMap[$blnNama], $hari);
            }
        }

        try {
            return Carbon::parse($s);
        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * Parsing Jam (format HH.mm atau HH:mm).
     */
    private function parseJam(mixed $value): ?string
    {
        if (empty($value) || $value === '-') {
            return null;
        }

        // Desimal waktu Excel (0 <= val < 1)
        if (is_numeric($value) && !is_string($value) && $value >= 0 && $value < 1) {
            $totalMenit = (int) round($value * 1440) % 1440;
            $jam = intdiv($totalMenit, 60);
            $menit = $totalMenit % 60;
            return sprintf('%02d:%02d:00', $jam, $menit);
        }

        $s = trim((string) $value, " \t\n\r\0\x0B\"'");
        if (preg_match('/^(\d{1,2})[.:](\d{2})(?:[.:](\d{2}))?$/', $s, $m)) {
            $jam = (int) $m[1];
            $menit = (int) $m[2];
            $detik = isset($m[3]) ? (int) $m[3] : 0;
            if ($jam < 24 && $menit < 60 && $detik < 60) {
                return sprintf('%02d:%02d:%02d', $jam, $menit, $detik);
            }
        }

        return null;
    }

    /**
     * Memisahkan Nama Pelapor dan Nomor Telepon.
     */
    private function parsePelapor(mixed $value): array
    {
        if (empty($value) || $value === '-') {
            return ['nama' => 'Masyarakat', 'telepon' => '-'];
        }

        $s = trim(preg_replace('/\s+/', ' ', (string) $value));
        $telepon = '-';

        if (preg_match('/(?:\(|\b)((?:\+?62|0)[\d\s\-]{8,16})(?:\)|\b)/', $s, $m)) {
            $telepon = preg_replace('/[^\d\+]/', '', $m[1]);
            $nama = trim(str_replace($m[0], '', $s), " \t\n\r\0\x0B(),-");
        } else {
            $nama = $s;
        }

        return [
            'nama' => !empty($nama) ? $nama : 'Masyarakat',
            'telepon' => !empty($telepon) ? $telepon : '-',
        ];
    }

    /**
     * Memetakan teks jenis terbakar ke slug kategori objek kebakaran.
     */
    private function petaObjek(string $teks): string
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
    private function petaPenyebab(string $teks): array
    {
        $s = Str::lower($teks);

        if (preg_match('/konsleting|korslet|korsleting|listrik|arus pendek|kabel|kipas|colokan|\bac\b|magic ?com|setrika|charger|stop ?kontak|steker|trafo|genset/', $s)) {
            return ['dugaan' => 'arus_pendek', 'lainnya' => null];
        }
        if (str_contains($s, 'petir')) {
            return ['dugaan' => 'sambaran_petir', 'lainnya' => null];
        }
        if (str_contains($s, 'gas') || str_contains($s, 'regulator')) {
            return ['dugaan' => 'kebocoran_gas', 'lainnya' => null];
        }
        if (preg_match('/sampah|puntung|rokok|obat nyamuk|korek|lilin|lalai|kelalaian|bakar|membakar|pembakaran|kembang api|anglo|tungku|odgj/', $s)) {
            return ['dugaan' => 'kelalaian_manusia', 'lainnya' => null];
        }
        if (preg_match('/faktor alam|cuaca|kemarau/', $s)) {
            return ['dugaan' => 'faktor_alam', 'lainnya' => null];
        }

        return ['dugaan' => 'lainnya', 'lainnya' => $teks ?: null];
    }

    /**
     * Parsing jumlah liter air dan alat pendukung (APAR, dsb).
     */
    private function parseAir(mixed $value): array
    {
        if (empty($value) || $value === '-') {
            return ['liter' => 0, 'konsumsi_alat' => null];
        }

        $s = trim((string) $value);
        $liter = 0;
        $konsumsiAlat = null;

        if (preg_match('/(\d[\d.,]*)\s*liter/i', $s, $m)) {
            $numStr = preg_replace('/[^\d]/', '', $m[1]);
            $liter = (int) $numStr;
        }

        if ($liter === 0 || stripos($s, 'apar') !== false || stripos($s, 'powder') !== false || stripos($s, 'apv') !== false) {
            $konsumsiAlat = $s;
        }

        return ['liter' => $liter, 'konsumsi_alat' => $konsumsiAlat];
    }

    /**
     * Parsing data korban jiwa.
     */
    private function parseKorban(mixed $value): array
    {
        $result = [
            'selamat' => 0,
            'ringan' => 0,
            'berat' => 0,
            'meninggal' => 0,
            'keterangan' => null,
        ];

        if (empty($value) || $value === '-') {
            return $result;
        }

        $s = trim((string) $value);
        $result['keterangan'] = $s;

        if (preg_match('/(\d+)\s*orang\s*meninggal/i', $s, $m)) {
            $result['meninggal'] = (int) $m[1];
        } elseif (stripos($s, 'meninggal') !== false) {
            $result['meninggal'] = 1;
        }

        if (stripos($s, 'luka') !== false) {
            $result['ringan'] = 1;
        }

        return $result;
    }

    /**
     * Mengambil angka pertama dari string (contoh: "8" atau "8 Menit" -> 8).
     */
    private function parseAngka(mixed $value): int
    {
        if (empty($value) || $value === '-') {
            return 0;
        }

        if (preg_match('/\d+/', (string) $value, $m)) {
            return (int) $m[0];
        }

        return 0;
    }

    /**
     * Membuat Nomor Laporan otomatis format standar sistem: REG-YYYYMMDD-0001
     */
    private function buatNomorLaporan(Carbon $tanggal): string
    {
        $prefix = 'REG-' . $tanggal->format('Ymd') . '-';

        $terakhir = LaporanPenyelamatan::where('nomor_laporan', 'like', $prefix . '%')
            ->orderByDesc('nomor_laporan')
            ->value('nomor_laporan');

        $urut = $terakhir ? ((int) substr($terakhir, -4)) + 1 : 1;

        return $prefix . str_pad((string) $urut, 4, '0', STR_PAD_LEFT);
    }
}

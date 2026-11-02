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
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class Evakuasi2026Import implements ToCollection, WithCalculatedFormulas, WithMultipleSheets, WithStartRow
{
    public int $totalDibaca = 0;
    public int $totalDisimpan = 0;
    public int $totalDuplikat = 0;
    public int $totalDilewati = 0;

    /**
     * Cache in-memory untuk mencegah duplikasi antar-sheet dalam satu kali import.
     */
    private array $seenInFile = [];

    /**
     * @param int $userId ID User pemilik data laporan
     * @param ?string $targetSheet Nama sheet tertentu yang ingin diimpor
     * @param bool $allSheets Impor seluruh sheet mingguan yang valid
     * @param array $availableSheets Daftar seluruh sheet di file Excel
     * @param bool $dryRun Mode simulasi tanpa menyimpan ke database
     */
    public function __construct(
        protected int $userId = 1,
        protected ?string $targetSheet = null,
        protected bool $allSheets = false,
        protected array $availableSheets = [],
        protected bool $dryRun = false
    ) {}

    /**
     * Pilihan sheet yang akan diproses.
     */
    public function sheets(): array
    {
        // 1. Jika pengguna menentukan sheet spesifik
        if ($this->targetSheet) {
            return [
                $this->targetSheet => $this,
            ];
        }

        // 2. Jika opsi --all-sheets aktif: baca seluruh sheet mingguan, lewati sheet rekapitulasi/grafik
        if ($this->allSheets && !empty($this->availableSheets)) {
            $sheetMap = [];
            foreach ($this->availableSheets as $name) {
                $lower = strtolower(trim((string) $name));
                // Lewati sheet rekap tahunan/ringkasan kecamatan agar tidak menduplikasi data
                if (
                    str_contains($lower, 'rincian') ||
                    str_contains($lower, 'kecamatan') ||
                    str_contains($lower, 'grafik') ||
                    str_contains($lower, 'rekap')
                ) {
                    continue;
                }
                $sheetMap[$name] = $this;
            }

            return !empty($sheetMap) ? $sheetMap : [0 => $this];
        }

        // 3. Default: baca sheet pertama saja (index 0)
        return [
            0 => $this,
        ];
    }

    /**
     * Baris data aktual dimulai dari baris ke-5.
     */
    public function startRow(): int
    {
        return 5;
    }

    /**
     * Proses baris-baris data dari sheet yang dipilih.
     */
    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            $this->totalDibaca++;

            // 1. Validasi Kolom 0 (NO): Harus berupa angka numerik
            // Melewati baris judul, tanda tangan pejabat, atau baris kosong
            $rawNo = isset($row[0]) ? trim((string) $row[0]) : '';
            if (!is_numeric($rawNo)) {
                $this->totalDilewati++;
                continue;
            }

            // 2. Deteksi Kolom Dinamis:
            // Pada beberapa sheet, terdapat kolom 'Nama Korban' di index 4 sehingga kolom telepon bergeser ke index 5.
            $rawTanggal = isset($row[1]) ? trim((string) $row[1]) : '';
            $rawJam     = isset($row[2]) ? trim((string) $row[2]) : '';
            $rawPelapor = isset($row[3]) ? trim((string) $row[3]) : '';

            $col4 = isset($row[4]) ? trim((string) $row[4]) : '';
            $col5 = isset($row[5]) ? trim((string) $row[5]) : '';

            // Cek apakah col4 atau col5 adalah nomor telepon
            $isCol4Phone = preg_match('/^(?:\+?62|08|\(?0\d)/', str_replace([' ', '-', '(', ')', '.'], '', $col4));
            $isCol5Phone = preg_match('/^(?:\+?62|08|\(?0\d)/', str_replace([' ', '-', '(', ')', '.'], '', $col5));

            if ($isCol4Phone || (!$isCol5Phone && !empty($col4) && empty($col5))) {
                // Format Standar (tanpa kolom korban):
                $namaKorban = null;
                $rawTelepon = $col4;
                $rawAlamat  = isset($row[5]) ? trim((string) $row[5]) : '';
                $rawKec     = isset($row[6]) ? trim((string) $row[6]) : '';
                $rawJenis   = isset($row[7]) ? trim((string) $row[7]) : '';
                $rawSatgas  = isset($row[8]) ? trim((string) $row[8]) : '';
                $rawDurasi  = isset($row[9]) ? trim((string) $row[9]) : '';
            } else {
                // Format Bergeser (ada kolom nama korban di index 4):
                $namaKorban = (!empty($col4) && $col4 !== '-') ? $col4 : null;
                $rawTelepon = $col5;
                $rawAlamat  = isset($row[6]) ? trim((string) $row[6]) : '';
                $rawKec     = isset($row[7]) ? trim((string) $row[7]) : '';
                $rawJenis   = isset($row[8]) ? trim((string) $row[8]) : '';
                $rawSatgas  = isset($row[9]) ? trim((string) $row[9]) : '';
                $rawDurasi  = isset($row[10]) ? trim((string) $row[10]) : '';
            }

            // Abaikan jika data esensial kosong
            if (empty($rawTanggal) && empty($rawJenis)) {
                $this->totalDilewati++;
                continue;
            }

            // 3. Parsing Tanggal
            $parsedTgl = $this->parseTanggal($rawTanggal, 2026);
            if (!$parsedTgl) {
                $this->totalDilewati++;
                continue;
            }

            $tglKejadian  = $parsedTgl['tanggal'];
            $hariKejadian = $parsedTgl['hari'];
            $bulanKejadian= $parsedTgl['bulan'];
            $tahunKejadian= $parsedTgl['tahun'];

            // 4. Normalisasi Pelapor & Telepon
            $namaPelapor = !empty($rawPelapor) && $rawPelapor !== '-' ? $rawPelapor : 'Masyarakat';
            $teleponPelapor = preg_replace('/[^0-9+]/', '', $rawTelepon);
            if (empty($teleponPelapor)) {
                $teleponPelapor = '-';
            }

            // 5. Normalisasi Alamat & Kecamatan
            $alamatLengkap = $rawAlamat;
            if (!empty($rawKec) && $rawKec !== '-' && !str_contains(strtolower($alamatLengkap), strtolower($rawKec))) {
                $alamatLengkap = rtrim($alamatLengkap, ', ') . ', Kec. ' . $rawKec;
            }
            if (empty($alamatLengkap) || $alamatLengkap === '-') {
                $alamatLengkap = 'Kota Jambi';
            }

            // 6. Parsing Waktu & Durasi
            $parsedWaktu = $this->parseWaktu($rawJam, $tglKejadian, $rawDurasi);

            // 7. Parsing Klasifikasi Pelayanan Non-Kebakaran
            $parsedKategori = $this->parseJenisPelayanan($rawJenis);

            // 8. Parsing Pimpinan & Satgas Rescue
            [$pimpinanOperasi, $satuanTugas, $pendampingOperasi] = $this->parseSatgas($rawSatgas);

            // 9. Deteksi Duplikat Dalam File & Database
            $dedupKey = md5($tglKejadian . '|' . $parsedWaktu['waktu_terima'] . '|' . Str::lower($rawAlamat) . '|' . Str::lower($rawJenis));
            if (isset($this->seenInFile[$dedupKey])) {
                $this->totalDuplikat++;
                continue;
            }
            $this->seenInFile[$dedupKey] = true;

            $existsInDb = LaporanPenyelamatan::where('tanggal_kejadian', $tglKejadian)
                ->where(function ($q) use ($alamatLengkap, $namaPelapor, $parsedWaktu) {
                    $q->where('alamat', $alamatLengkap)
                      ->orWhere(function ($q2) use ($namaPelapor, $parsedWaktu) {
                          $q2->where('nama_pelapor', $namaPelapor)
                             ->where('waktu_terima', $parsedWaktu['waktu_terima']);
                      });
                })
                ->exists();

            if ($existsInDb) {
                $this->totalDuplikat++;
                continue;
            }

            // Jika mode Simulasi (Dry Run), hitung dan lanjut ke baris berikutnya
            if ($this->dryRun) {
                $this->totalDisimpan++;
                continue;
            }

            // 10. Simpan Transaksional ke Database (4 Tabel)
            DB::transaction(function () use (
                $tglKejadian, $hariKejadian, $bulanKejadian, $tahunKejadian,
                $namaPelapor, $teleponPelapor, $alamatLengkap, $parsedWaktu,
                $parsedKategori, $pimpinanOperasi, $satuanTugas, $pendampingOperasi,
                $rawDurasi, $rawSatgas, $rawJenis, $namaKorban
            ) {
                $tanggalCarbon = Carbon::parse($tglKejadian);
                $nomorLaporan = $this->buatNomorLaporan($tanggalCarbon);

                // TAB 1: Tabel Utama (laporan_penyelamatans)
                $laporan = LaporanPenyelamatan::create([
                    'nomor_laporan'                  => $nomorLaporan,
                    'id_laporan'                     => Str::uuid()->toString(),
                    'user_id'                        => $this->userId,
                    'tanggal_kejadian'               => $tglKejadian,
                    'hari_kejadian'                  => $hariKejadian,
                    'bulan_kejadian'                 => $bulanKejadian,
                    'tahun_kejadian'                 => $tahunKejadian,

                    'nama_pelapor'                   => $namaPelapor,
                    'telepon_pelapor'                => $teleponPelapor,
                    'media_pelaporan'                => 'WhatsApp / Telepon',

                    'kategori_kejadian'              => $parsedKategori['kategori_kejadian'],
                    'kategori_non_kebakaran'         => $parsedKategori['kategori_non_kebakaran'],
                    'rincian_kategori_non_kebakaran' => $parsedKategori['rincian_kategori_non_kebakaran'],
                    'prioritas'                      => 'rendah',

                    'waktu_kejadian'                 => $parsedWaktu['waktu_kejadian'],
                    'waktu_terima'                   => $parsedWaktu['waktu_terima'],
                    'waktu_berangkat'                => $parsedWaktu['waktu_berangkat'],
                    'waktu_tiba'                     => $parsedWaktu['waktu_tiba'],
                    'waktu_selesai'                  => $parsedWaktu['waktu_selesai'],
                    'waktu_kembali'                  => null,

                    'alamat'                         => $alamatLengkap,
                    'status_evakuasi'                => 'Selesai',
                    'objek_terdampak'                => $rawJenis ?: null,
                    'korban_hewan_aset'              => $namaKorban,
                ]);

                // TAB 2: Tabel Teknis & Logistik (lp_teknis_logistiks)
                LpTeknisLogistik::create([
                    'laporan_id'         => $laporan->id,
                    'pimpinan_operasi'   => $pimpinanOperasi,
                    'pendamping_operasi' => $pendampingOperasi,
                    'satuan_tugas'       => $satuanTugas ?: 'Mako Damkar',
                    'langkah_penanganan' => !empty($rawDurasi) ? "Lamanya penanganan: {$rawDurasi}" : null,
                    'hasil_tindakan'     => 'Selesai ditangani dengan aman.',
                    'status_evakuasi'    => 'Selesai',
                    'objek_terdampak'    => $rawJenis ?: null,
                    'korban_hewan_aset'  => $namaKorban,
                ]);

                // TAB 3: Tabel Dokumentasi (lp_dokumentasis)
                LpDokumentasi::create([
                    'laporan_id'        => $laporan->id,
                    'kronologi_lengkap' => "Pelayanan evakuasi {$rawJenis} di {$alamatLengkap}. Petugas: {$rawSatgas}." . (!empty($rawDurasi) ? " Durasi: {$rawDurasi}." : ''),
                ]);

                // TAB 4: Tabel Kategori Khusus (lp_kategori_khusus)
                LpKategoriKhusus::create([
                    'laporan_id'          => $laporan->id,
                    'jenis_hewan'         => $parsedKategori['jenis_hewan'],
                    'spesies_hewan'       => $parsedKategori['spesies_hewan'],
                    'jenis_objek_tumbang' => $parsedKategori['jenis_objek_tumbang'],
                    'jenis_benda_bahaya'  => $parsedKategori['jenis_benda_bahaya'],
                    'kondisi_perairan'    => $parsedKategori['kondisi_perairan'],
                ]);
            });

            $this->totalDisimpan++;
        }
    }

    /**
     * Parsing tanggal Bahasa Indonesia dan serial Excel.
     */
    protected function parseTanggal(string $rawDate, int $defaultYear = 2026): ?array
    {
        $raw = trim($rawDate);
        if (empty($raw) || $raw === '-') {
            return null;
        }

        // Jika angka serial Excel
        if (is_numeric($raw) && (float) $raw > 30000 && (float) $raw < 60000) {
            try {
                $dt = ExcelDate::excelToDateTimeObject((float) $raw);
                $carbon = Carbon::instance($dt)->locale('id');

                return [
                    'tanggal' => $carbon->toDateString(),
                    'hari'    => $carbon->translatedFormat('l'),
                    'bulan'   => $carbon->translatedFormat('F'),
                    'tahun'   => $carbon->year,
                ];
            } catch (\Throwable) {
                // lanjut
            }
        }

        $bulanMap = [
            'januari' => 1, 'janiari' => 1, 'februari' => 2, 'maret' => 3, 'april' => 4,
            'mei' => 5, 'juni' => 6, 'juli' => 7, 'agustus' => 8,
            'september' => 9, 'oktober' => 10, 'nopember' => 11, 'november' => 11, 'desember' => 12,
        ];

        // Buang nama hari di depan (misal: "Kamis, 1 Januari 2026" atau "Minggu. 4 Januari 2026")
        $clean = preg_replace('/^[a-zA-Z\']+\s*[,.:\-]\s*/i', '', $raw);
        $clean = preg_replace('/\s+/', ' ', trim($clean));

        // Format DD NamaBulan YYYY
        if (preg_match('/(\d{1,2})\s+([a-zA-Z]+)(?:\s+(\d{4}))?/i', $clean, $m)) {
            $tgl = (int) $m[1];
            $namaBln = strtolower($m[2]);
            $thn = !empty($m[3]) ? (int) $m[3] : $defaultYear;

            if (isset($bulanMap[$namaBln])) {
                $blnAngka = $bulanMap[$namaBln];
                try {
                    $carbon = Carbon::createFromDate($thn, $blnAngka, $tgl, 'Asia/Jakarta')->locale('id');

                    return [
                        'tanggal' => $carbon->toDateString(),
                        'hari'    => $carbon->translatedFormat('l'),
                        'bulan'   => $carbon->translatedFormat('F'),
                        'tahun'   => $thn,
                    ];
                } catch (\Throwable) {
                    return null;
                }
            }
        }

        // Format standar Carbon (Y-m-d atau d/m/Y)
        try {
            $carbon = Carbon::parse($clean)->locale('id');

            return [
                'tanggal' => $carbon->toDateString(),
                'hari'    => $carbon->translatedFormat('l'),
                'bulan'   => $carbon->translatedFormat('F'),
                'tahun'   => $carbon->year,
            ];
        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * Normalisasi jam dan menit menjadi datetime valid (Y-m-d H:i:s).
     */
    protected function normalisasiWaktu(string $tanggalKejadian, int $jam, int $menit): ?string
    {
        if ($menit >= 60) {
            $jam += intdiv($menit, 60);
            $menit = $menit % 60;
        }

        try {
            return Carbon::parse($tanggalKejadian . ' 00:00:00')->addHours($jam)->addMinutes($menit)->format('Y-m-d H:i:s');
        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * Parsing Jam Evakuasi (Terima, Berangkat, Tiba).
     */
    protected function parseWaktu(string $rawJam, string $tanggalKejadian, string $rawDurasi = ''): array
    {
        $res = [
            'waktu_kejadian'  => null,
            'waktu_terima'    => null,
            'waktu_berangkat' => null,
            'waktu_tiba'      => null,
            'waktu_selesai'   => null,
        ];

        $raw = trim($rawJam);

        // Pola: Terima: HH.MM atau HH:MM atau HH,MM
        if (preg_match('/Terima\s*[:;]+\s*(\d{1,2})[\s.:,]+(\d{2})/i', $raw, $mT)) {
            $res['waktu_terima'] = $this->normalisasiWaktu($tanggalKejadian, (int) $mT[1], (int) $mT[2]);
            $res['waktu_kejadian'] = $res['waktu_terima'];
        }

        // Pola: Berangkat: HH.MM atau HH:MM
        if (preg_match('/Berangkat\s*[:;]+\s*(\d{1,2})[\s.:,]+(\d{2})/i', $raw, $mB)) {
            $res['waktu_berangkat'] = $this->normalisasiWaktu($tanggalKejadian, (int) $mB[1], (int) $mB[2]);
        }

        // Pola: Tiba: HH.MM atau HH:MM
        if (preg_match('/Tiba\s*[:;]+\s*(\d{1,2})[\s.:,]+(\d{2})/i', $raw, $mTi)) {
            $res['waktu_tiba'] = $this->normalisasiWaktu($tanggalKejadian, (int) $mTi[1], (int) $mTi[2]);
        }

        // Fallback jika tidak ada label Terima
        if (!$res['waktu_terima']) {
            if ($res['waktu_berangkat']) {
                $res['waktu_terima'] = $res['waktu_berangkat'];
                $res['waktu_kejadian'] = $res['waktu_berangkat'];
            } elseif ($res['waktu_tiba']) {
                $res['waktu_terima'] = $res['waktu_tiba'];
                $res['waktu_kejadian'] = $res['waktu_tiba'];
            } elseif (preg_match('/(\d{1,2})[\s.:,]+(\d{2})/', $raw, $mS)) {
                $jamFormat = $this->normalisasiWaktu($tanggalKejadian, (int) $mS[1], (int) $mS[2]);
                $res['waktu_terima'] = $jamFormat;
                $res['waktu_kejadian'] = $jamFormat;
            } else {
                $res['waktu_terima'] = $tanggalKejadian . ' 08:00:00';
                $res['waktu_kejadian'] = $res['waktu_terima'];
            }
        }

        // Hitung estimasi waktu selesai dari durasi
        if (!empty($rawDurasi) && $res['waktu_tiba']) {
            $menitTotal = 0;
            if (preg_match('/(\d+)\s*Jam/i', $rawDurasi, $mJam)) {
                $menitTotal += ((int) $mJam[1]) * 60;
            }
            if (preg_match('/(\d+)\s*Menit/i', $rawDurasi, $mMenit)) {
                $menitTotal += (int) $mMenit[1];
            }
            if ($menitTotal > 0) {
                try {
                    $res['waktu_selesai'] = Carbon::parse($res['waktu_tiba'])->addMinutes($menitTotal)->format('Y-m-d H:i:s');
                } catch (\Throwable) {
                    $res['waktu_selesai'] = null;
                }
            }
        }

        return $res;
    }

    /**
     * Memetakan jenis pelayanan ke kategori database.
     */
    protected function parseJenisPelayanan(string $rawJenis): array
    {
        $raw = trim($rawJenis);
        $lower = strtolower($raw);

        $kategoriKejadian = 'penyelamatan_hewan';
        $kategoriNonKebakaran = 'evakuasi_liar';
        $jenisHewan = null;
        $spesiesHewan = null;
        $jenisBenda = null;
        $objekTumbang = null;
        $kondisiPerairan = null;

        if (str_contains($lower, 'ular')) {
            $kategoriKejadian = 'penyelamatan_hewan';
            $kategoriNonKebakaran = 'evakuasi_liar';
            $jenisHewan = 'Ular';
            if (str_contains($lower, 'sanca')) {
                $spesiesHewan = 'Ular Sanca';
            } elseif (str_contains($lower, 'kobra') || str_contains($lower, 'cobra')) {
                $spesiesHewan = 'Ular Kobra';
            } elseif (str_contains($lower, 'piton')) {
                $spesiesHewan = 'Ular Piton';
            } elseif (str_contains($lower, 'koros') || str_contains($lower, 'coros')) {
                $spesiesHewan = 'Ular Koros';
            } elseif (str_contains($lower, 'sawo') || str_contains($lower, 'sowo')) {
                $spesiesHewan = 'Ular Sawo Kopi';
            } elseif (str_contains($lower, 'tali') || str_contains($lower, 'picis')) {
                $spesiesHewan = 'Ular Tali Picis';
            } elseif (str_contains($lower, 'lidi')) {
                $spesiesHewan = 'Ular Lidi';
            } elseif (str_contains($lower, 'daun') || str_contains($lower, 'ijo') || str_contains($lower, 'terbang') || str_contains($lower, 'hijau')) {
                $spesiesHewan = 'Ular Daun Hijau';
            } elseif (str_contains($lower, 'air') || str_contains($lower, 'kadut')) {
                $spesiesHewan = 'Ular Air';
            } else {
                $spesiesHewan = 'Ular Lainnya';
            }
        } elseif (str_contains($lower, 'biawak')) {
            $kategoriKejadian = 'penyelamatan_hewan';
            $kategoriNonKebakaran = 'evakuasi_liar';
            $jenisHewan = 'Biawak';
        } elseif (str_contains($lower, 'kucing')) {
            $kategoriKejadian = 'penyelamatan_hewan';
            $kategoriNonKebakaran = 'evakuasi_liar';
            $jenisHewan = 'Kucing';
        } elseif (str_contains($lower, 'tawon') || str_contains($lower, 'lebah') || str_contains($lower, 'vespa')) {
            $kategoriKejadian = 'penyelamatan_hewan';
            $kategoriNonKebakaran = 'sarang_tawon';
            $jenisHewan = 'Tawon / Lebah';
            $spesiesHewan = str_contains($lower, 'vespa') ? 'Tawon Vespa' : 'Lebah Madu';
        } elseif (str_contains($lower, 'musang')) {
            $kategoriKejadian = 'penyelamatan_hewan';
            $kategoriNonKebakaran = 'evakuasi_liar';
            $jenisHewan = 'Musang';
        } elseif (str_contains($lower, 'monyet') || str_contains($lower, 'kera') || str_contains($lower, 'beruk') || str_contains($lower, 'siamang') || str_contains($lower, 'lutung')) {
            $kategoriKejadian = 'penyelamatan_hewan';
            $kategoriNonKebakaran = 'evakuasi_liar';
            $jenisHewan = 'Monyet / Kera';
        } elseif (str_contains($lower, 'anjing')) {
            $kategoriKejadian = 'penyelamatan_hewan';
            $kategoriNonKebakaran = 'evakuasi_liar';
            $jenisHewan = 'Anjing';
        } elseif (str_contains($lower, 'sapi') || str_contains($lower, 'kambing')) {
            $kategoriKejadian = 'penyelamatan_hewan';
            $kategoriNonKebakaran = 'evakuasi_liar';
            $jenisHewan = str_contains($lower, 'sapi') ? 'Sapi' : 'Kambing';
        } elseif (str_contains($lower, 'buaya')) {
            $kategoriKejadian = 'penyelamatan_hewan';
            $kategoriNonKebakaran = 'evakuasi_liar';
            $jenisHewan = 'Buaya';
        } elseif (str_contains($lower, 'berang')) {
            $kategoriKejadian = 'penyelamatan_hewan';
            $kategoriNonKebakaran = 'evakuasi_liar';
            $jenisHewan = 'Berang-Berang';
        } elseif (str_contains($lower, 'cincin') || str_contains($lower, 'anting') || str_contains($lower, 'piercing') || str_contains($lower, 'kunci') || str_contains($lower, 'borgol') || str_contains($lower, 'gembok') || str_contains($lower, 'seng')) {
            $kategoriKejadian = 'penyelamatan_manusia';
            $kategoriNonKebakaran = 'pelepasan_cincin';
            $jenisBenda = $raw;
        } elseif (str_contains($lower, 'pohon')) {
            $kategoriKejadian = 'bencana_alam';
            $kategoriNonKebakaran = 'pohon_tumbang';
            $objekTumbang = 'Pohon Tumbang';
        } elseif (str_contains($lower, 'tenggelam') || str_contains($lower, 'sungai') || str_contains($lower, 'terjun')) {
            $kategoriKejadian = 'penyelamatan_manusia';
            $kategoriNonKebakaran = 'pencarian_air';
            $kondisiPerairan = 'Sungai / Perairan';
        } elseif (str_contains($lower, 'obesitas') || str_contains($lower, 'stroke') || str_contains($lower, 'fraktur') || str_contains($lower, 'terjepit') || str_contains($lower, 'terkunci')) {
            $kategoriKejadian = 'penyelamatan_manusia';
            $kategoriNonKebakaran = 'evakuasi_manusia';
        } else {
            $kategoriKejadian = 'penyelamatan_lainnya';
            $kategoriNonKebakaran = 'layanan_lainnya';
        }

        return [
            'kategori_kejadian'              => $kategoriKejadian,
            'kategori_non_kebakaran'         => $kategoriNonKebakaran,
            'rincian_kategori_non_kebakaran' => $raw ?: 'Pelayanan Evakuasi',
            'jenis_hewan'                    => $jenisHewan,
            'spesies_hewan'                  => $spesiesHewan,
            'jenis_benda_bahaya'             => $jenisBenda,
            'jenis_objek_tumbang'            => $objekTumbang,
            'kondisi_perairan'               => $kondisiPerairan,
        ];
    }

    /**
     * Parsing Pimpinan Operasi dan Satuan Tugas.
     */
    protected function parseSatgas(string $rawSatgas): array
    {
        $pimpinan = null;
        $satgas = null;
        $pendamping = null;

        if (empty($rawSatgas) || $rawSatgas === '-') {
            return [$pimpinan, 'Mako Damkar', $pendamping];
        }

        $raw = trim($rawSatgas);

        // Ambil Pimpinan Operasi
        if (preg_match('/Pimpinan\s*Operasi\s*:\s*([^,;.]+?)(?=(?:Satuan\s*Tugas|Regu|Pendamping|\.|$))/i', $raw, $mP)) {
            $pimpinan = trim(rtrim($mP[1], '.,; '));
        }

        // Ambil Satuan Tugas
        if (preg_match('/(?:Satuan\s*Tugas|Satuan\s*Regu)\s*[:;]?\s*([^.]+?)(?=(?:Pimpinan|Pendamping|\.|$))/i', $raw, $mS)) {
            $satgas = trim(rtrim($mS[1], '.,; '));
        }

        // Ambil Pendamping Operasi
        if (preg_match('/Pendamping(?:\s*Operasi)?\s*:\s*([^,;.]+?)(?=(?:Satuan\s*Tugas|Pimpinan|\.|$))/i', $raw, $mD)) {
            $pendamping = trim(rtrim($mD[1], '.,; '));
        }

        if (!$satgas) {
            $satgas = $raw;
        }

        return [$pimpinan, $satgas, $pendamping];
    }

    /**
     * Membuat nomor laporan otomatis berurutan: REG-YYYYMMDD-XXXX
     */
    protected function buatNomorLaporan(Carbon $tanggal): string
    {
        $prefix = 'REG-' . $tanggal->format('Ymd') . '-';

        $terakhir = LaporanPenyelamatan::where('nomor_laporan', 'like', $prefix . '%')
            ->orderByDesc('nomor_laporan')
            ->value('nomor_laporan');

        $urut = $terakhir ? ((int) substr($terakhir, -4)) + 1 : 1;

        return $prefix . str_pad((string) $urut, 4, '0', STR_PAD_LEFT);
    }
}

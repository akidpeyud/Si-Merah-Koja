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

class LaporanEvakuasiImport implements ToCollection, WithCalculatedFormulas, WithMultipleSheets, WithStartRow
{
    public int $totalDibaca = 0;

    public int $totalDisimpan = 0;

    public int $totalDuplikat = 0;

    public int $totalDilewati = 0;

    public array $riwayatImport = [];

    /**
     * @param  int  $userId  ID User pemilik data laporan
     * @param  ?string  $targetSheet  Nama sheet target spesifik
     * @param  bool  $allSheets  Impor semua sheet data yang valid
     * @param  array  $availableSheets  Daftar seluruh sheet di file Excel
     * @param  bool  $dryRun  Mode simulasi tanpa menyimpan ke database
     */
    public function __construct(
        protected int $userId = 1,
        protected ?string $targetSheet = null,
        protected bool $allSheets = false,
        protected array $availableSheets = [],
        protected bool $dryRun = false
    ) {}

    /**
     * Daftarkan sheet yang akan diproses oleh Maatwebsite/Excel
     */
    public function sheets(): array
    {
        if ($this->targetSheet) {
            return [
                $this->targetSheet => $this,
            ];
        }

        if ($this->allSheets && ! empty($this->availableSheets)) {
            $sheetMap = [];
            foreach ($this->availableSheets as $name) {
                // Lewatkan sheet ringkasan/rekapitulasi jika ada
                $lower = strtolower($name);
                if (str_contains($lower, 'rincian') || str_contains($lower, 'perkecamatan') || str_contains($lower, 'grafik')) {
                    continue;
                }
                $sheetMap[$name] = $this;
            }

            return ! empty($sheetMap) ? $sheetMap : [0 => $this];
        }

        // Default: sheet pertama apa pun judulnya
        return [
            0 => $this,
        ];
    }

    /**
     * Baris data asli dimulai dari baris ke-5 (baris 3: header, baris 4: nomor kolom 1-10)
     */
    public function startRow(): int
    {
        return 5;
    }

    /**
     * Proses baris-baris data dari sheet
     */
    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            $this->totalDibaca++;

            // 1. Kolom NO (Indeks 0): harus berupa angka (1, 2, 3...)
            $rawNo = isset($row[0]) ? trim((string) $row[0]) : '';
            if (! is_numeric($rawNo)) {
                $this->totalDilewati++;

                continue;
            }

            // Ambil nilai setiap kolom
            $rawTanggal = isset($row[1]) ? trim((string) $row[1]) : '';
            $rawJam = isset($row[2]) ? trim((string) $row[2]) : '';
            $rawPelapor = isset($row[3]) ? trim((string) $row[3]) : '';
            $rawTelepon = isset($row[4]) ? trim((string) $row[4]) : '';
            $rawAlamat = isset($row[5]) ? trim((string) $row[5]) : '';
            $rawKec = isset($row[6]) ? trim((string) $row[6]) : '';
            $rawJenis = isset($row[7]) ? trim((string) $row[7]) : '';
            $rawSatgas = isset($row[8]) ? trim((string) $row[8]) : '';
            $rawDurasi = isset($row[9]) ? trim((string) $row[9]) : '';

            // Jika tanggal dan jenis pelayanan kosong, abaikan
            if (empty($rawTanggal) && empty($rawJenis)) {
                $this->totalDilewati++;

                continue;
            }

            // 2. Parsing Tanggal
            $parsedTgl = $this->parseTanggal($rawTanggal);
            if (! $parsedTgl) {
                $this->totalDilewati++;

                continue;
            }

            $tglKejadian = $parsedTgl['tanggal'];
            $hariKejadian = $parsedTgl['hari'];
            $bulanKejadian = $parsedTgl['bulan'];
            $tahunKejadian = $parsedTgl['tahun'];

            // 3. Normalisasi Nama & Telepon Pelapor
            $namaPelapor = ! empty($rawPelapor) && $rawPelapor !== '-' ? $rawPelapor : 'Masyarakat / Warga';
            $teleponPelapor = preg_replace('/[^0-9+]/', '', $rawTelepon);
            if (empty($teleponPelapor)) {
                $teleponPelapor = '-';
            }

            // 4. Normalisasi Alamat & Kecamatan
            $alamatLengkap = $rawAlamat;
            if (! empty($rawKec) && ! str_contains(strtolower($alamatLengkap), strtolower($rawKec))) {
                $alamatLengkap = rtrim($alamatLengkap, ', ').', Kec. '.$rawKec;
            }
            if (empty($alamatLengkap)) {
                $alamatLengkap = 'Kota Jambi';
            }

            // 5. Parsing Jam & Durasi Evakuasi
            $parsedWaktu = $this->parseWaktu($rawJam, $tglKejadian, $rawDurasi);

            // 6. Parsing Jenis Pelayanan ke Kategori Kejadian
            $parsedKategori = $this->parseJenisPelayanan($rawJenis);

            // 7. Parsing Satgas & Pimpinan Operasi
            [$pimpinanOperasi, $satuanTugas, $pendampingOperasi] = $this->parseSatgas($rawSatgas);

            // 8. Cek Duplikasi (berdasarkan tanggal, nama pelapor, dan alamat)
            $duplikat = LaporanPenyelamatan::where('tanggal_kejadian', $tglKejadian)
                ->where('nama_pelapor', $namaPelapor)
                ->where(function ($q) use ($rawAlamat) {
                    if (! empty($rawAlamat) && strlen($rawAlamat) > 5) {
                        $q->where('alamat', 'like', '%'.substr($rawAlamat, 0, 20).'%');
                    }
                })
                ->exists();

            if ($duplikat) {
                $this->totalDuplikat++;

                continue;
            }

            // 9. Simpan ke Database (atau catat pratinjau jika mode dry-run)
            if ($this->dryRun) {
                $this->totalDisimpan++;
                $this->riwayatImport[] = [
                    'Tanggal' => $tglKejadian,
                    'Pelapor' => $namaPelapor,
                    'Jenis Evakuasi' => Str::limit($rawJenis, 25),
                    'Kecamatan' => $rawKec ?: '-',
                    'Status' => 'SIMULASI (Valid)',
                ];

                continue;
            }

            DB::transaction(function () use (
                $tglKejadian, $hariKejadian, $bulanKejadian, $tahunKejadian,
                $namaPelapor, $teleponPelapor, $alamatLengkap, $parsedWaktu,
                $parsedKategori, $pimpinanOperasi, $satuanTugas, $pendampingOperasi,
                $rawDurasi, $rawSatgas, $rawJenis
            ) {
                $tanggalCarbon = Carbon::parse($tglKejadian);
                $nomorLaporan = $this->generateNomorLaporan($tanggalCarbon);

                // A. Insert Tabel Utama: laporan_penyelamatans
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
                    'media_pelaporan' => 'WhatsApp / Telepon',

                    'kategori_kejadian' => $parsedKategori['kategori_kejadian'],
                    'kategori_non_kebakaran' => $parsedKategori['kategori_non_kebakaran'],
                    'rincian_kategori_non_kebakaran' => $parsedKategori['rincian_kategori_non_kebakaran'],
                    'prioritas' => 'rendah',

                    'waktu_kejadian' => $parsedWaktu['waktu_kejadian'],
                    'waktu_terima' => $parsedWaktu['waktu_terima'],
                    'waktu_berangkat' => $parsedWaktu['waktu_berangkat'],
                    'waktu_tiba' => $parsedWaktu['waktu_tiba'],
                    'waktu_selesai' => $parsedWaktu['waktu_selesai'],
                    'waktu_kembali' => null,

                    'alamat' => $alamatLengkap,
                ]);

                // B. Insert Tabel Teknis & Logistik: lp_teknis_logistiks
                LpTeknisLogistik::create([
                    'laporan_id' => $laporan->id,
                    'pimpinan_operasi' => $pimpinanOperasi,
                    'pendamping_operasi' => $pendampingOperasi,
                    'satuan_tugas' => $satuanTugas,
                    'tim_respontime' => null,
                    'jumlah_personel' => 0,
                    'daftar_personel' => null,
                    'langkah_penanganan' => ! empty($rawDurasi) ? "Lamanya penanganan: {$rawDurasi}" : null,
                    'hambatan_lapangan' => null,
                    'hasil_tindakan' => 'Selesai ditangani dengan aman.',
                    'status_evakuasi' => 'Selesai',
                    'objek_terdampak' => $rawJenis,
                ]);

                // C. Insert Tabel Dokumentasi: lp_dokumentasis
                LpDokumentasi::create([
                    'laporan_id' => $laporan->id,
                    'kronologi_lengkap' => "Pelayanan evakuasi {$rawJenis} di {$alamatLengkap}. Petugas: {$rawSatgas}.".(! empty($rawDurasi) ? " Durasi: {$rawDurasi}." : ''),
                ]);

                // D. Insert Tabel Kategori Khusus: lp_kategori_khusus
                LpKategoriKhusus::create([
                    'laporan_id' => $laporan->id,
                    'jenis_hewan' => $parsedKategori['jenis_hewan'],
                    'spesies_hewan' => $parsedKategori['spesies_hewan'],
                    'jenis_objek_tumbang' => $parsedKategori['jenis_objek_tumbang'],
                    'jenis_benda_bahaya' => $parsedKategori['jenis_benda_bahaya'],
                    'kondisi_perairan' => $parsedKategori['kondisi_perairan'],
                ]);
            });

            $this->totalDisimpan++;
            $this->riwayatImport[] = [
                'Tanggal' => $tglKejadian,
                'Pelapor' => $namaPelapor,
                'Jenis Evakuasi' => Str::limit($rawJenis, 25),
                'Kecamatan' => $rawKec ?: '-',
                'Status' => 'Berhasil Disimpan',
            ];
        }
    }

    /**
     * Generate format nomor laporan berurutan: REG-YYYYMMDD-XXXX
     */
    protected function generateNomorLaporan(Carbon $tanggal): string
    {
        $prefix = 'REG-'.$tanggal->format('Ymd').'-';

        $terakhir = LaporanPenyelamatan::where('nomor_laporan', 'like', $prefix.'%')
            ->lockForUpdate()
            ->orderByDesc('nomor_laporan')
            ->value('nomor_laporan');

        $urut = $terakhir ? ((int) substr($terakhir, -4)) + 1 : 1;

        return $prefix.str_pad((string) $urut, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Parsing tanggal fleksibel Bahasa Indonesia & format serial Excel
     */
    protected function parseTanggal(string $rawDate, int $defaultYear = 2025): ?array
    {
        $raw = trim($rawDate);

        // Jika numeric serial date dari Excel
        if (is_numeric($raw) && (float) $raw > 30000 && (float) $raw < 60000) {
            try {
                $dt = ExcelDate::excelToDateTimeObject((float) $raw);
                $carbon = Carbon::instance($dt)->locale('id');

                return [
                    'tanggal' => $carbon->toDateString(),
                    'hari' => $carbon->translatedFormat('l'),
                    'bulan' => $carbon->translatedFormat('F'),
                    'tahun' => $carbon->year,
                ];
            } catch (\Throwable) {
                // Lanjut ke parser teks
            }
        }

        $bulanMap = [
            'januari' => 1, 'februari' => 2, 'maret' => 3, 'april' => 4,
            'mei' => 5, 'juni' => 6, 'juli' => 7, 'agustus' => 8,
            'september' => 9, 'oktober' => 10, 'nopember' => 11, 'november' => 11,
            'desember' => 12,
        ];

        // Bersihkan tanda baca titik/koma berlebih
        $clean = preg_replace('/\s+/', ' ', str_replace(['.', ',', "'"], ['', '', ''], $raw));

        // Cari pola: (angka tgl) (nama bulan) (opsional tahun)
        if (preg_match('/(\d{1,2})\s+([a-zA-Z]+)(?:\s+(\d{4}))?/i', $clean, $m)) {
            $tgl = (int) $m[1];
            $namaBln = strtolower($m[2]);
            $thn = ! empty($m[3]) ? (int) $m[3] : $defaultYear;

            if (isset($bulanMap[$namaBln])) {
                $blnAngka = $bulanMap[$namaBln];
                try {
                    $carbon = Carbon::createFromDate($thn, $blnAngka, $tgl, 'Asia/Jakarta')->locale('id');

                    return [
                        'tanggal' => $carbon->toDateString(),
                        'hari' => $carbon->translatedFormat('l'),
                        'bulan' => $carbon->translatedFormat('F'),
                        'tahun' => $thn,
                    ];
                } catch (\Throwable) {
                    return null;
                }
            }
        }

        // Coba parser standar Carbon jika format Y-m-d atau d-m-Y
        try {
            $carbon = Carbon::parse($raw)->locale('id');

            return [
                'tanggal' => $carbon->toDateString(),
                'hari' => $carbon->translatedFormat('l'),
                'bulan' => $carbon->translatedFormat('F'),
                'tahun' => $carbon->year,
            ];
        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * Parsing teks jam evakuasi (Terima, Berangkat, Tiba, Selesai)
     */
    protected function parseWaktu(string $rawJam, string $tanggalKejadian, string $rawDurasi = ''): array
    {
        $res = [
            'waktu_kejadian' => null,
            'waktu_terima' => null,
            'waktu_berangkat' => null,
            'waktu_tiba' => null,
            'waktu_selesai' => null,
        ];

        $raw = trim($rawJam);

        // Pola: Terima: HH.MM / HH:MM
        if (preg_match('/Terima\s*:\s*(\d{1,2})[\s.:]+(\d{2})/i', $raw, $mT)) {
            $res['waktu_terima'] = $tanggalKejadian.' '.sprintf('%02d:%02d:00', $mT[1], $mT[2]);
            $res['waktu_kejadian'] = $res['waktu_terima'];
        }

        // Pola: Berangkat: HH.MM / HH:MM
        if (preg_match('/Berangkat\s*:\s*(\d{1,2})[\s.:]+(\d{2})/i', $raw, $mB)) {
            $res['waktu_berangkat'] = $tanggalKejadian.' '.sprintf('%02d:%02d:00', $mB[1], $mB[2]);
        }

        // Pola: Tiba: HH.MM / HH:MM
        if (preg_match('/Tiba\s*:\s*(\d{1,2})[\s.:]+(\d{2})/i', $raw, $mTi)) {
            $res['waktu_tiba'] = $tanggalKejadian.' '.sprintf('%02d:%02d:00', $mTi[1], $mTi[2]);
        }

        // Jika format jam tunggal, misal "07.50 WIB" atau "08.18"
        if (! $res['waktu_terima']) {
            if (preg_match('/(\d{1,2})[\s.:]+(\d{2})/i', $raw, $mS)) {
                $jamFormat = $tanggalKejadian.' '.sprintf('%02d:%02d:00', $mS[1], $mS[2]);
                $res['waktu_terima'] = $jamFormat;
                $res['waktu_kejadian'] = $jamFormat;
            } else {
                // Fallback default
                $res['waktu_terima'] = $tanggalKejadian.' 08:00:00';
                $res['waktu_kejadian'] = $res['waktu_terima'];
            }
        }

        // Hitung estimasi waktu selesai dari durasi jika ada
        if (! empty($rawDurasi) && $res['waktu_tiba']) {
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
     * Parsing jenis pelayanan ke kategori kejadian, non-kebakaran, dan relasi khusus
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
            } elseif (str_contains($lower, 'koros') || str_contains($lower, 'coros')) {
                $spesiesHewan = 'Ular Koros';
            } elseif (str_contains($lower, 'piton')) {
                $spesiesHewan = 'Ular Piton';
            } elseif (str_contains($lower, 'pelangi')) {
                $spesiesHewan = 'Ular Pelangi';
            } elseif (str_contains($lower, 'lidi')) {
                $spesiesHewan = 'Ular Lidi';
            } elseif (str_contains($lower, 'kopi') || str_contains($lower, 'sawo')) {
                $spesiesHewan = 'Ular Sawo Kopi';
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
        } elseif (str_contains($lower, 'tawon') || str_contains($lower, 'lebah')) {
            $kategoriKejadian = 'penyelamatan_hewan';
            $kategoriNonKebakaran = 'evakuasi_liar';
            $jenisHewan = 'Tawon / Lebah';
            $spesiesHewan = str_contains($lower, 'vespa') ? 'Tawon Vespa' : 'Lebah Madu';
        } elseif (str_contains($lower, 'monyet') || str_contains($lower, 'kera')) {
            $kategoriKejadian = 'penyelamatan_hewan';
            $kategoriNonKebakaran = 'evakuasi_liar';
            $jenisHewan = 'Monyet';
        } elseif (str_contains($lower, 'musang')) {
            $kategoriKejadian = 'penyelamatan_hewan';
            $kategoriNonKebakaran = 'evakuasi_liar';
            $jenisHewan = 'Musang';
        } elseif (str_contains($lower, 'anjing')) {
            $kategoriKejadian = 'penyelamatan_hewan';
            $kategoriNonKebakaran = 'evakuasi_liar';
            $jenisHewan = 'Anjing';
        } elseif (str_contains($lower, 'kambing') || str_contains($lower, 'sapi')) {
            $kategoriKejadian = 'penyelamatan_hewan';
            $kategoriNonKebakaran = 'evakuasi_liar';
            $jenisHewan = str_contains($lower, 'sapi') ? 'Sapi' : 'Kambing';
        } elseif (str_contains($lower, 'cincin') || str_contains($lower, 'anting') || str_contains($lower, 'borgol') || str_contains($lower, 'sendok') || str_contains($lower, 'kunci')) {
            $kategoriKejadian = 'penyelamatan_manusia';
            $kategoriNonKebakaran = 'pelepasan_cincin';
            $jenisBenda = $raw;
        } elseif (str_contains($lower, 'pohon')) {
            $kategoriKejadian = 'bencana_alam';
            $kategoriNonKebakaran = 'pohon_tumbang';
            $objekTumbang = 'Pohon Tumbang';
        } elseif (str_contains($lower, 'tenggelam')) {
            $kategoriKejadian = 'penyelamatan_manusia';
            $kategoriNonKebakaran = 'pertolongan_korban';
            $kondisiPerairan = 'Sungai / Perairan';
        } elseif (str_contains($lower, 'banjir') || str_contains($lower, 'roboh') || str_contains($lower, 'terjebak') || str_contains($lower, 'lift') || str_contains($lower, 'obesitas')) {
            $kategoriKejadian = 'penyelamatan_manusia';
            $kategoriNonKebakaran = 'pertolongan_korban';
        } else {
            $kategoriKejadian = 'penyelamatan_lainnya';
            $kategoriNonKebakaran = 'layanan_lainnya';
        }

        return [
            'kategori_kejadian' => $kategoriKejadian,
            'kategori_non_kebakaran' => $kategoriNonKebakaran,
            'rincian_kategori_non_kebakaran' => $raw,
            'jenis_hewan' => $jenisHewan,
            'spesies_hewan' => $spesiesHewan,
            'jenis_benda_bahaya' => $jenisBenda,
            'jenis_objek_tumbang' => $objekTumbang,
            'kondisi_perairan' => $kondisiPerairan,
        ];
    }

    /**
     * Parsing string pimpinan operasi, satuan tugas, dan pendamping operasi
     */
    protected function parseSatgas(string $rawSatgas): array
    {
        $pimpinan = null;
        $satgas = null;
        $pendamping = null;

        if (empty($rawSatgas)) {
            return [$pimpinan, $satgas, $pendamping];
        }

        $raw = trim($rawSatgas);

        // Ambil Pimpinan Operasi
        if (preg_match('/Pimpinan\s*Operasi\s*:\s*([^.]+?)(?=(?:Satuan\s*Tugas|Regu\s*Evakuasi|Satuan\s*Regu|Pendamping|\.|$))/i', $raw, $mP)) {
            $pimpinan = trim(rtrim($mP[1], '.,; '));
        }

        // Ambil Satuan Tugas / Regu Evakuasi
        if (preg_match('/(?:Satuan\s*Tugas|Regu\s*Evakuasi|Satuan\s*Regu)\s*:\s*([^.]+?)(?=(?:Pimpinan|Pendamping|\.|$))/i', $raw, $mS)) {
            $satgas = trim(rtrim($mS[1], '.,; '));
        }

        // Ambil Pendamping Operasi
        if (preg_match('/Pendamping(?:\s*Operasi)?\s*:\s*([^.]+?)(?=(?:Satuan\s*Tugas|Regu\s*Evakuasi|Pimpinan|\.|$))/i', $raw, $mD)) {
            $pendamping = trim(rtrim($mD[1], '.,; '));
        }

        if (! $pimpinan && ! $satgas) {
            $pimpinan = $raw;
        }

        return [$pimpinan, $satgas, $pendamping];
    }
}

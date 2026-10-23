<?php

namespace App\Imports;

use App\Models\RekapNonKebakaran;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;

class RekapNonKebakaranImport implements ToCollection, WithCalculatedFormulas, WithMultipleSheets, WithStartRow
{
    public function __construct(
        protected int $tahun = 2024,
        protected bool $truncateFirst = false,
        protected ?string $targetSheet = null,
        protected bool $syncToRekapLayanan = true
    ) {}

    /**
     * Tentukan sheet yang diproses (jika targetSheet diisi spesifik atau sheet pertama)
     */
    public function sheets(): array
    {
        if ($this->targetSheet) {
            return [
                $this->targetSheet => $this,
            ];
        }

        // 0 = sheet pertama apa pun judulnya
        return [
            0 => $this,
        ];
    }

    /**
     * Mulai membaca data baris.
     * Menggunakan startRow 5 agar kita dapat membaca header di baris 5 dan 7 secara dinamis,
     * serta membaca baris data (Januari, Februari, dst) mulai baris ke-6 s.d. 20.
     */
    public function startRow(): int
    {
        return 5;
    }

    /**
     * Map nama bulan teks ke angka
     */
    private const BULAN_MAP = [
        'JANUARI' => 1,
        'FEBRUARI' => 2,
        'MARET' => 3,
        'APRIL' => 4,
        'MEI' => 5,
        'JUNI' => 6,
        'JULI' => 7,
        'AGUSTUS' => 8,
        'SEPTEMBER' => 9,
        'OKTOBER' => 10,
        'NOVEMBER' => 11,
        'NOPEMBER' => 11,
        'DESEMBER' => 12,
    ];

    /**
     * Normalisasi nama bencana dan pemetaannya ke kategori tabel rekap_layanan
     */
    private function mapBencanaToKategoriLayanan(string $namaBencana): string
    {
        $b = strtoupper($namaBencana);

        if (str_contains($b, 'HEWAN') || str_contains($b, 'ANIMAL')) {
            return 'evakuasi_hewan';
        }
        if (str_contains($b, 'TAWON') || str_contains($b, 'LEBAH')) {
            return 'sarang_tawon';
        }
        if (str_contains($b, 'CINCIN') || str_contains($b, 'ANTING')) {
            return 'pelepasan_cincin';
        }
        if (str_contains($b, 'POHON TUMBANG')) {
            return 'pohon_tumbang';
        }
        if (str_contains($b, 'WATER RESCUE') || str_contains($b, 'TENGGELAM') || str_contains($b, 'AIR')) {
            return 'pencarian_air';
        }
        if (str_contains($b, 'OPERASI') || str_contains($b, 'LAINNYA')) {
            return 'layanan_lainnya';
        }

        return 'evakuasi_manusia';
    }

    public function collection(Collection $rows): void
    {
        if ($this->truncateFirst) {
            RekapNonKebakaran::where('tahun', $this->tahun)->delete();
            if ($this->syncToRekapLayanan) {
                DB::table('rekap_layanan')
                    ->whereYear('tanggal', $this->tahun)
                    ->where('kategori', '!=', 'kebakaran')
                    ->delete();
            }
        }

        // Ambil header baris 5 (indeks 0 pada collection jika startRow 5)
        // dan header baris 7 (indeks 2 pada collection)
        $row5 = $rows->get(0)?->toArray() ?? [];
        $row7 = $rows->get(2)?->toArray() ?? [];

        // Deteksi kolom jenis bencana dan kolom kecamatan secara dinamis
        $bencanaCols = [];
        $kecamatanCols = [];
        $foundKecamatan = false;

        $maxCol = max(count($row5), count($row7));
        for ($col = 3; $col < $maxCol; $col++) {
            $h5 = trim((string) ($row5[$col] ?? ''));
            $h7 = trim((string) ($row7[$col] ?? ''));

            if (stripos($h5, 'LOKASI') !== false || stripos($h5, 'KECAMATAN') !== false || stripos($h7, 'ALAM BARAJO') !== false) {
                $foundKecamatan = true;
            }

            $label = $h7 ?: $h5;
            if (empty($label)) {
                continue;
            }

            // Bersihkan whitespace berlebih
            $cleanLabel = trim(preg_replace('/\s+/', ' ', $label));

            if ($foundKecamatan) {
                $kecamatanCols[$col] = $cleanLabel;
            } else {
                $bencanaCols[$col] = $cleanLabel;
            }
        }

        // Fallback jika tidak terdeteksi dari header: gunakan pemetaan default (kolom D s.d. S dan U s.d. AF)
        if (empty($bencanaCols)) {
            $bencanaCols = [
                3 => 'Kecelakaan Transportasi', 4 => 'Beda Ketinggian', 5 => 'Bangunan Runtuh',
                6 => 'Percobaan Bunuh Diri', 7 => 'Rumah Roboh / Retak', 8 => 'Angin Puting Beliung',
                9 => 'Tanah Longsor', 10 => 'Water Rescue', 11 => 'Meninggal Kesetrum',
                12 => 'Meninggal Tersambar Petir', 13 => 'Meninggal Korban Kebakaran',
                14 => 'Meninggal Tertimpa Pohon', 15 => 'Animal Rescue (Hewan)',
                16 => 'Pelepasan Cincin/Anting', 17 => 'Pohon Tumbang', 18 => 'Operasi Lainnya',
            ];
        }
        if (empty($kecamatanCols)) {
            $kecamatanCols = [
                20 => 'Alam Barajo', 21 => 'Jambi Selatan', 22 => 'Pasar Jambi', 23 => 'Jambi Timur',
                24 => 'Telanaipura', 25 => 'Paal Merah', 26 => 'Kota Baru', 27 => 'Pelayangan',
                28 => 'Danau Teluk', 29 => 'Danau Sipin', 30 => 'Jelutung', 31 => 'Perbatasan (Muaro Jambi)',
            ];
        }

        foreach ($rows as $row) {
            $colB = trim((string) ($row[1] ?? ''));
            $bulanUpper = strtoupper($colB);

            // Cek apakah baris ini adalah baris nama bulan yang valid
            if (empty($bulanUpper) || $bulanUpper === 'TOTAL' || ! isset(self::BULAN_MAP[$bulanUpper])) {
                continue;
            }

            $bulanAngka = self::BULAN_MAP[$bulanUpper];

            // Kolom C (indeks 2) adalah total kejadian
            $rawTotal = $row[2] ?? 0;
            $totalKejadian = is_numeric($rawTotal) ? (int) $rawTotal : 0;

            // Rincian jenis bencana
            $rincianBencana = [];
            foreach ($bencanaCols as $colIdx => $namaBencana) {
                $val = trim((string) ($row[$colIdx] ?? ''));
                $rincianBencana[$namaBencana] = is_numeric($val) ? (int) $val : 0;
            }

            // Rincian per kecamatan
            $rincianKecamatan = [];
            foreach ($kecamatanCols as $colIdx => $namaKecamatan) {
                $val = trim((string) ($row[$colIdx] ?? ''));
                $rincianKecamatan[$namaKecamatan] = is_numeric($val) ? (int) $val : 0;
            }

            // Simpan ke tabel rekap_non_kebakarans
            RekapNonKebakaran::updateOrCreate(
                [
                    'tahun' => $this->tahun,
                    'bulan' => $bulanUpper,
                ],
                [
                    'bulan_angka' => $bulanAngka,
                    'total_kejadian' => $totalKejadian,
                    'rincian_bencana' => $rincianBencana,
                    'rincian_kecamatan' => $rincianKecamatan,
                ]
            );

            // Sync ke tabel rekap_layanan
            if ($this->syncToRekapLayanan) {
                $tanggalBulan = Carbon::create($this->tahun, $bulanAngka, 1)->endOfMonth()->toDateString();

                foreach ($rincianBencana as $namaBencana => $jumlah) {
                    if ($jumlah <= 0) {
                        continue;
                    }

                    $kategoriLayanan = $this->mapBencanaToKategoriLayanan($namaBencana);

                    DB::table('rekap_layanan')->updateOrInsert(
                        [
                            'tanggal' => $tanggalBulan,
                            'kategori' => $kategoriLayanan,
                            'keterangan' => "Rekap {$namaBencana} - {$bulanUpper} {$this->tahun}",
                        ],
                        [
                            'jumlah' => $jumlah,
                            'kecamatan' => 'Kota Jambi',
                            'lokasi' => 'Kota Jambi',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
                }
            }
        }
    }
}

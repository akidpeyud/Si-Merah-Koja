<?php

namespace App\Imports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;

class RekapObjekKebakaranImport implements ToCollection, WithCalculatedFormulas, WithMultipleSheets, WithStartRow
{
    public function __construct(
        protected int $tahun = 2024,
        protected bool $truncateFirst = false,
        protected ?string $targetSheet = null
    ) {}

    /**
     * Target sheet
     */
    public function sheets(): array
    {
        if ($this->targetSheet) {
            return [
                $this->targetSheet => $this,
            ];
        }

        return [
            0 => $this,
        ];
    }

    /**
     * Start row di baris ke-6 (baris sub-header untuk deteksi kolom dinamis)
     */
    public function startRow(): int
    {
        return 6;
    }

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
     * Pemetaan nama kolom jenis bangunan di Excel ke kategori tabel rekap_layanan
     */
    private function mapBangunanToKategori(string $namaBangunan): string
    {
        $b = strtoupper(trim($namaBangunan));

        if (str_contains($b, 'PERUMAHAN') || str_contains($b, 'RUMAH')) {
            return 'objek_rumah';
        }
        if (str_contains($b, 'GUDANG')) {
            return 'objek_gudang';
        }
        if (str_contains($b, 'RUKO') || str_contains($b, 'TOKO') || str_contains($b, 'KIOS')) {
            return 'objek_ruko';
        }
        if (str_contains($b, 'KANTOR')) {
            return 'objek_kantor';
        }
        if (str_contains($b, 'SEKOLAH')) {
            return 'objek_sekolah';
        }
        if (str_contains($b, 'IBADAH')) {
            return 'objek_rumah_ibadah';
        }
        if (str_contains($b, 'PASAR') || str_contains($b, 'USAHA')) {
            return 'objek_pasar';
        }
        if (str_contains($b, 'KENDARAAN') || str_contains($b, 'MOBIL') || str_contains($b, 'MOTOR')) {
            return 'objek_kendaraan';
        }
        if (str_contains($b, 'KESEHATAN') || str_contains($b, 'RUMAH SAKIT')) {
            return 'objek_sarana_kesehatan';
        }
        if (str_contains($b, 'LAHAN') || str_contains($b, 'POHON')) {
            return 'objek_lahan_pohon';
        }
        if (str_contains($b, 'GARDU') || str_contains($b, 'LISTRIK')) {
            return 'objek_gardu_listrik';
        }
        if (str_contains($b, 'SAMPAH') || str_contains($b, 'TPA')) {
            return 'objek_tpa_sampah';
        }
        if (str_contains($b, 'GEDUNG')) {
            return 'objek_gudang';
        }
        if (str_contains($b, 'INDUSTRI') || str_contains($b, 'UMUM') || str_contains($b, 'BANGUNAN')) {
            return 'objek_pasar';
        }

        return 'objek_rumah';
    }

    public function collection(Collection $rows): void
    {
        $objekKeys = [
            'objek_rumah', 'objek_gudang', 'objek_ruko', 'objek_kantor', 'objek_sekolah',
            'objek_rumah_ibadah', 'objek_pasar', 'objek_kendaraan', 'objek_vital',
            'objek_sarana_kesehatan', 'objek_lahan_pohon', 'objek_gardu_listrik', 'objek_tpa_sampah',
        ];

        if ($this->truncateFirst) {
            DB::table('rekap_layanan')
                ->whereYear('tanggal', $this->tahun)
                ->whereIn('kategori', $objekKeys)
                ->delete();
        }

        // Baris pertama collection (Excel row 6) adalah sub-header
        $subHeaderRow = $rows->get(0)?->toArray() ?? [];

        // Deteksi kolom jenis bangunan secara dinamis
        $bangunanCols = [];
        foreach ($subHeaderRow as $colIdx => $colName) {
            $name = trim((string) $colName);
            if ($colIdx < 3 || empty($name)) {
                continue;
            }
            if (stripos($name, 'ALAM BARAJO') !== false || stripos($name, 'LOKASI') !== false) {
                break;
            }
            $bangunanCols[$colIdx] = $name;
        }

        // Fallback jika tidak terdeteksi
        if (empty($bangunanCols)) {
            $bangunanCols = [
                3 => 'PERUMAHAN',
                4 => 'BANGUNAN',
                5 => 'UMUM',
                6 => 'INDUSTRI',
                7 => 'Lahan',
                8 => 'GEDUNG/GUDANG',
                9 => 'LAINNYA',
            ];
        }

        // Baris data bulanan dimulai dari row ke-3 dalam collection (Excel row 8)
        foreach ($rows as $row) {
            $colB = trim((string) ($row[1] ?? ''));
            $bulanUpper = strtoupper($colB);

            if (empty($bulanUpper) || $bulanUpper === 'TOTAL' || ! isset(self::BULAN_MAP[$bulanUpper])) {
                continue;
            }

            $bulanAngka = self::BULAN_MAP[$bulanUpper];
            $tanggalBulan = Carbon::create($this->tahun, $bulanAngka, 1)->endOfMonth()->toDateString();

            foreach ($bangunanCols as $colIdx => $namaBangunan) {
                $rawVal = trim((string) ($row[$colIdx] ?? ''));
                if (! is_numeric($rawVal) || (int) $rawVal <= 0) {
                    continue;
                }

                $jumlah = (int) $rawVal;
                $kategoriKey = $this->mapBangunanToKategori($namaBangunan);

                DB::table('rekap_layanan')->updateOrInsert(
                    [
                        'tanggal' => $tanggalBulan,
                        'kategori' => $kategoriKey,
                        'keterangan' => "Rekap Objek {$namaBangunan} - {$bulanUpper} {$this->tahun}",
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

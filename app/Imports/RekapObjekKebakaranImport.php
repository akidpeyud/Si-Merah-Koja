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
    public int $totalBulan = 0;
    public int $totalDisimpan = 0;
    public int $totalDilewati = 0;
    public array $importedDetails = [];

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
     * Pemetaan indeks kolom Excel (0-based) ke kategori tabel rekap_layanan
     */
    private const MAPPING_KATEGORI = [
        3 => ['label' => 'Perumahan', 'kategori' => 'objek_rumah'],
        4 => ['label' => 'Bangunan Umum', 'kategori' => 'objek_ruko'],
        6 => ['label' => 'Industri', 'kategori' => 'objek_vital'],
        7 => ['label' => 'Lahan', 'kategori' => 'objek_lahan_pohon'],
        8 => ['label' => 'Gedung/Gudang', 'kategori' => 'objek_gudang'],
        9 => ['label' => 'Lainnya', 'kategori' => 'objek_pasar'],
    ];

    public function __construct(
        protected int $tahun,
        protected int $userId = 1,
        protected bool $dryRun = false,
        protected bool $truncateFirst = false,
        protected ?string $targetSheet = null
    ) {}

    /**
     * Membaca sheet pertama (atau sheet target jika ditentukan)
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
     * Data aktual dimulai dari baris ke-6 (baris 6 s.d. 8 berisi sub-header & nomor kolom, baris 8 data Januari)
     */
    public function startRow(): int
    {
        return 6;
    }

    public function collection(Collection $rows): void
    {
        $objekKeys = array_unique(array_column(self::MAPPING_KATEGORI, 'kategori'));

        if ($this->truncateFirst && ! $this->dryRun) {
            DB::table('rekap_layanan')
                ->whereYear('tanggal', $this->tahun)
                ->whereIn('kategori', $objekKeys)
                ->delete();
        }

        foreach ($rows as $row) {
            $colB = trim((string) ($row[1] ?? ''));
            $bulanUpper = strtoupper($colB);

            // Lewati jika bukan nama bulan (misal: header baris 6/7, kosong, atau baris TOTAL)
            if (empty($bulanUpper) || $bulanUpper === 'TOTAL' || ! isset(self::BULAN_MAP[$bulanUpper])) {
                continue;
            }

            $this->totalBulan++;
            $bulanAngka = self::BULAN_MAP[$bulanUpper];
            $tanggal = Carbon::create($this->tahun, $bulanAngka, 1)->toDateString();

            foreach (self::MAPPING_KATEGORI as $colIdx => $meta) {
                $rawVal = trim((string) ($row[$colIdx] ?? ''));

                // Jika berisi strip (-), kosong, atau bukan angka
                if ($rawVal === '-' || $rawVal === '' || ! is_numeric($rawVal)) {
                    $this->totalDilewati++;
                    continue;
                }

                $jumlah = (int) $rawVal;
                if ($jumlah <= 0) {
                    $this->totalDilewati++;
                    continue;
                }

                $kategoriKey = $meta['kategori'];
                $label = $meta['label'];
                $keterangan = "Rekap Objek {$label} - {$bulanUpper} {$this->tahun}";

                if (! $this->dryRun) {
                    DB::table('rekap_layanan')->updateOrInsert(
                        [
                            'tanggal' => $tanggal,
                            'kategori' => $kategoriKey,
                        ],
                        [
                            'jumlah' => $jumlah,
                            'kecamatan' => 'Kota Jambi',
                            'lokasi' => 'Kota Jambi',
                            'keterangan' => $keterangan,
                            'dibuat_oleh' => $this->userId,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
                }

                $this->totalDisimpan++;
                $this->importedDetails[] = [
                    'bulan' => $bulanUpper,
                    'kategori' => $label,
                    'key' => $kategoriKey,
                    'jumlah' => $jumlah,
                ];
            }
        }
    }
}

<?php

namespace App\Exports;

use Closure;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Export;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RekapAktivitasBulananExport implements Export, WithMultipleSheets
{
    public function __construct(
        private readonly Collection $monthlyInternal,
        private readonly Collection $monthlyPemohon,
        private readonly Collection $moduleDetails,
        private readonly string $category = 'all'
    ) {}

    /**
     * Susun worksheet terpisah untuk Ringkasan Internal, Ringkasan Pemohon, dan Rincian Per Modul.
     *
     * @return array<int, Export>
     */
    public function sheets(): array
    {
        $sheets = [];

        if ($this->category !== 'pemohon') {
            $sheets[] = $this->makeSheet(
                sheetTitle: 'Ringkasan Internal',
                headings: [
                    'No',
                    'Periode',
                    'Tambah',
                    'Ubah',
                    'Hapus',
                    'Lainnya',
                    'Total Aktivitas',
                    'Modul Teratas',
                    'Sumber Data',
                ],
                items: $this->monthlyInternal->values(),
                mapper: static function (array $row, int $no): array {
                    $topMods = '-';
                    if (! empty($row['top_modules'])) {
                        $topMods = implode(', ', array_map(
                            static fn (array $mod): string => "{$mod['module']} ({$mod['total']})",
                            $row['top_modules']
                        ));
                    }

                    return [
                        $no,
                        $row['period_label'],
                        (int) $row['tambah'],
                        (int) $row['ubah'],
                        (int) $row['hapus'],
                        (int) $row['lainnya'],
                        (int) $row['total'],
                        $topMods,
                        $row['source'],
                    ];
                }
            );
        }

        if ($this->category !== 'internal') {
            $sheets[] = $this->makeSheet(
                sheetTitle: 'Ringkasan Pemohon',
                headings: [
                    'No',
                    'Periode',
                    'RPKBGL',
                    'SKK',
                    'Izin Keramaian',
                    'Sarana Damkar',
                    'Edukasi & Sosialisasi',
                    'Lainnya',
                    'Total Permohonan',
                    'Sumber Data',
                ],
                items: $this->monthlyPemohon->values(),
                mapper: static fn (array $row, int $no): array => [
                    $no,
                    $row['period_label'],
                    (int) $row['rpkbgl'],
                    (int) $row['skk'],
                    (int) $row['izin'],
                    (int) $row['sarana'],
                    (int) $row['edukasi'],
                    (int) $row['lainnya'],
                    (int) $row['total'],
                    $row['source'],
                ]
            );
        }

        $sheets[] = $this->makeSheet(
            sheetTitle: 'Rincian Per Modul',
            headings: [
                'No',
                'Periode',
                'Kategori',
                'Modul / Layanan',
                'Aksi',
                'Arsip Permanen',
                'Data Live',
                'Total Aktivitas',
                'Sumber Data',
            ],
            items: $this->moduleDetails->values(),
            mapper: static fn (array $row, int $no): array => [
                $no,
                $row['period_label'],
                $row['category_label'],
                $row['module'],
                $row['action'],
                (int) $row['archived_total'],
                (int) $row['live_total'],
                (int) $row['total'],
                $row['source'],
            ]
        );

        return $sheets;
    }

    /**
     * Buat sheet seragam dengan header bergaya navy.
     *
     * @param  array<int, string>  $headings
     * @param  Closure(array<string, mixed>, int): array<int, mixed>  $mapper
     */
    private function makeSheet(string $sheetTitle, array $headings, Collection $items, Closure $mapper): Export
    {
        return new class($sheetTitle, $headings, $items, $mapper) implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping, WithStyles, WithTitle
        {
            private int $nomor = 0;

            /**
             * @param  array<int, string>  $headings
             * @param  Closure(array<string, mixed>, int): array<int, mixed>  $mapper
             */
            public function __construct(
                private readonly string $sheetTitle,
                private readonly array $headings,
                private readonly Collection $items,
                private readonly Closure $mapper
            ) {}

            public function title(): string
            {
                return $this->sheetTitle;
            }

            public function collection(): Collection
            {
                return $this->items;
            }

            /**
             * @return array<int, string>
             */
            public function headings(): array
            {
                return $this->headings;
            }

            /**
             * @param  array<string, mixed>  $row
             * @return array<int, mixed>
             */
            public function map($row): array
            {
                $this->nomor++;

                return ($this->mapper)($row, $this->nomor);
            }

            /**
             * @return array<int|string, array<string, mixed>>
             */
            public function styles(Worksheet $sheet): array
            {
                return [
                    1 => [
                        'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => '163A63'],
                        ],
                    ],
                ];
            }
        };
    }
}

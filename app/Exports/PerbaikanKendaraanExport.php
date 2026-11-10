<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Export;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;

class PerbaikanKendaraanExport implements Export, WithMultipleSheets
{
    public function __construct(private readonly Collection $dataPerbaikan) {}

    /**
     * Buat daftar sheet: Sheet pertama "Semua Tahun", diikuti sheet per tahun sesuai data yang tersedia.
     *
     * @return array<int, object>
     */
    public function sheets(): array
    {
        $sheets = [];

        // 1. Sheet Utama: Semua Tahun
        $sheets[] = $this->makeSheet('Semua Tahun', $this->dataPerbaikan->values());

        // 2. Sheet per Tahun sesuai data yang ada (urut tahun terbaru ke terlama)
        $groupedByYear = $this->dataPerbaikan
            ->groupBy(fn ($item) => $item->tahun_perbaikan ?? Carbon::parse($item->tgl_perbaikan)->format('Y'))
            ->sortKeysDesc();

        foreach ($groupedByYear as $tahun => $items) {
            $sheets[] = $this->makeSheet('Tahun '.$tahun, $items->values());
        }

        return $sheets;
    }

    private function makeSheet(string $sheetTitle, Collection $items): object
    {
        return new class($sheetTitle, $items) implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping, WithTitle
        {
            private int $nomor = 0;

            public function __construct(
                private readonly string $sheetTitle,
                private readonly Collection $items
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
                return [
                    'No',
                    'Nopol Kendaraan',
                    'Jenis Kendaraan',
                    'Merk Kendaraan',
                    'Tgl Perbaikan',
                    'Jenis Kerusakan / Penggantian Barang',
                    'Merek / Tipe Barang',
                    'Satuan',
                    'Total Harga (Rp)',
                    'Keterangan Ganti Barang Berulang',
                ];
            }

            /**
             * @param  object  $row
             * @return array<int, mixed>
             */
            public function map($row): array
            {
                $this->nomor++;

                $catatanBerulang = '-';
                if (! empty($row->barang_berulang)) {
                    $detail = [];
                    foreach ($row->barang_berulang as $dup) {
                        $detail[] = sprintf(
                            'Ganti "%s" %dx di Tahun %s (%s)',
                            $dup['barang'],
                            $dup['count'],
                            $dup['tahun'],
                            implode(', ', $dup['tanggal_list'])
                        );
                    }
                    $catatanBerulang = implode(' | ', $detail);
                }

                return [
                    $this->nomor,
                    $row->nopol_kendaraan,
                    strtoupper($row->jenis_kendaraan),
                    $row->merk_kendaraan,
                    Carbon::parse($row->tgl_perbaikan)->format('d-m-Y'),
                    $row->jenis_kerusakan,
                    $row->merek_tipe_barang ?? '-',
                    $row->satuan ?? '-',
                    (int) $row->total_harga,
                    $catatanBerulang,
                ];
            }
        };
    }
}

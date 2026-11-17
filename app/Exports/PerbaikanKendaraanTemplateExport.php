<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Export;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class PerbaikanKendaraanTemplateExport implements Export, FromCollection, ShouldAutoSize, WithHeadings, WithMapping, WithTitle
{
    public function title(): string
    {
        return 'Format Impor Perbaikan';
    }

    public function collection(): Collection
    {
        return collect([
            [
                'no' => 1,
                'nopol' => 'BH 1184 A',
                'jenis' => 'R4',
                'merk' => 'APV SUZUKI',
                'tgl' => '2026-05-26',
                'kerusakan' => 'PENGANTIAN AKI N-40, SENTRAL KOPLING',
                'merek_barang' => 'GS, -',
                'satuan' => '1, 1',
                'rincian_harga' => '320496, 43704',
                'total_harga' => 364200,
            ],
            [
                'no' => 2,
                'nopol' => 'BH 8395 Z',
                'jenis' => 'R6',
                'merk' => 'Hyno Drtro',
                'tgl' => '2026-04-13',
                'kerusakan' => 'PENGANTIAN AKI N70, PENGISIAN AIR AKI',
                'merek_barang' => 'GS, -',
                'satuan' => '2, 50',
                'rincian_harga' => '1700000, 24000',
                'total_harga' => 1724000,
            ],
            [
                'no' => 3,
                'nopol' => 'BH 9129 A',
                'jenis' => 'R10',
                'merk' => 'Mitsubishi Fuso',
                'tgl' => '2026-04-01',
                'kerusakan' => 'KLAHAR PTO ( GEARBOX ), GIGI GEARBOX',
                'merek_barang' => '-, -',
                'satuan' => '1, 2',
                'rincian_harga' => '5600000, 1700000',
                'total_harga' => 7300000,
            ],
        ]);
    }

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
            'Rincian Harga Item',
            'Total Harga (Rp)',
        ];
    }

    public function map($row): array
    {
        return [
            $row['no'],
            $row['nopol'],
            $row['jenis'],
            $row['merk'],
            $row['tgl'],
            $row['kerusakan'],
            $row['merek_barang'],
            $row['satuan'],
            $row['rincian_harga'],
            $row['total_harga'],
        ];
    }
}

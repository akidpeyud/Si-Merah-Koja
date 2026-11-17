<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HidranKotaExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    public function collection(): Collection
    {
        // Ambil semua data hidrant kota, urutkan dari yang pertama masuk
        return DB::table('hidran_kota')->orderBy('id', 'asc')->get();
    }

    // Bikin baris paling atas (Judul Kolom Excel)
    public function headings(): array
    {
        return [
            'No',
            'Jalan',
            'Kecamatan',
            'Kelurahan',
            'RT',
            'Lokasi Terdekat',
            'Kode Map',
            'Kondisi Hidran',
            'Tekanan Air',
            'Machino',
            'Keterangan',
        ];
    }

    // Cocokin data dari database ke kolom Excel
    public function map($row): array
    {
        static $nomor = 0;
        $nomor++;

        return [
            $nomor,
            $row->jalan,
            $row->kecamatan,
            $row->kelurahan,
            $row->rt ?? '-',
            $row->lokasi_terdekat,
            $row->kode_map ?? '-',
            $row->kondisi_hidran ?? '-',
            $row->tekanan ?? '-',
            $row->machino ?? '-',
            $row->keterangan ?? '-',
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\TitikSigap;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TitikSigapExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection(): Collection
    {
        return TitikSigap::orderBy('created_at', 'desc')->get();
    }

    /**
     * Mendefinisikan judul kolom di baris pertama Excel
     */
    public function headings(): array
    {
        return [
            'ID',
            'Kategori',
            'Nama Titik',
            'Tanggal',
            'Lokasi',
            'Keterangan',
            'Latitude',
            'Longitude',
        ];
    }

    /**
     * Memetakan data dari database ke dalam kolom Excel
     * Pastikan parameter ditambahkan tipe datanya jika error di versi selanjutnya
     */
    public function map($titik): array
    {
        return [
            $titik->id,
            ucwords(str_replace('_', ' ', $titik->kategori)),
            $titik->nama,
            $titik->tanggal ? Carbon::parse($titik->tanggal)->format('d M Y') : '-',
            $titik->lokasi,
            $titik->keterangan,
            $titik->latitude,
            $titik->longitude,
        ];
    }
}

<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection; // <-- Tambahan ini
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class HidranExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection(): Collection // <-- Tambahan : Collection di sini
    {
        // Ambil semua data prasarana (hidrant, embung, danau)
        // Diurutkan berdasarkan kategori, lalu no urut
        return DB::table('prasaranas')
                 ->orderBy('kategori', 'asc')
                 ->orderBy('no_urut', 'asc')
                 ->get();
    }

    // Ini buat bikin baris paling atas (Judul Kolom)
    public function headings(): array
    {
        return [
            'Kategori Tab',
            'No Urut',
            'Nama Lokasi / Gedung',
            'Alamat Lengkap',
            'Kode Maps',
            'Jumlah (Unit)',
            'Luas Area'
        ];
    }

    // Ini buat nyocokin data dari database ke kolom Excel
    public function map($row): array
    {
        return [
            $row->kategori,
            $row->no_urut,
            $row->nama_gedung,
            $row->alamat,
            $row->kode_maps ?? '-',
            $row->jumlah ? $row->jumlah . ' Unit' : '-',
            $row->luas ?? '-'
        ];
    }
}
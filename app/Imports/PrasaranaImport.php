<?php

namespace App\Imports;

use App\Models\Prasarana;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

// Hapus implementasi WithStartRow agar kita filter manual dengan aman
class PrasaranaImport implements ToCollection
{
    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            $noUrut    = $row[0] ?? null;
            $namaGedung = trim($row[1] ?? '');

            // FILTER SUPER AMAN:
            // 1. Pastikan NAMA GEDUNG tidak kosong
            // 2. Pastikan NAMA GEDUNG bukan "NAMA GEDUNG" (header Excel)
            // 3. Pastikan NAMA GEDUNG bukan "TOTAL" (rumus SUM)
            // 4. Pastikan NO URUT adalah angka (membuang kata "NO" atau baris kosong)
            if (!empty($namaGedung) 
                && strtoupper($namaGedung) !== 'NAMA GEDUNG' 
                && strtoupper($namaGedung) !== 'TOTAL'
                && is_numeric($noUrut)
            ) {
                Prasarana::create([
                    'no_urut'     => $noUrut,
                    'nama_gedung' => $namaGedung,
                    'alamat'      => trim($row[2] ?? ''),
                    'kode_maps'   => trim($row[3] ?? ''),
                    'jumlah'      => is_numeric($row[4]) ? $row[4] : null,
                ]);
            }
        }
    }
}
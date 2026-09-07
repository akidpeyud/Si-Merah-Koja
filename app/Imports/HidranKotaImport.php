<?php

namespace App\Imports;

use App\Models\HidranKota;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class HidranKotaImport implements ToCollection, WithStartRow, WithCalculatedFormulas
{
    /**
     * Mulai membaca data dari baris ke-4 (mengabaikan header yang digabung/di-merge)
     */
    public function startRow(): int
    {
        return 4;
    }

    public function collection(Collection $rows)
    {
        // Daftar string yang ada di baris bawah (keterangan/summary) agar dilewati
        $invalid_jalans = [
            'keterangan', 'kondisi baik', 'kondisi rusak', 'tekanan kuat', 
            'tekanan sedang', 'tekanan lemah', 'bisa di pakai', 
            'tidak bisa di pakai', 'tergantung listrik', 'tidak keluar air', 'total hidrant'
        ];

        foreach ($rows as $row) {
            // Hentikan proses jika kolom kecamatan kosong atau berisi keterangan summary
            $kecamatan = trim(strtolower($row[2] ?? ''));
            if (empty($kecamatan) || str_starts_with($kecamatan, ':')) {
                continue;
            }

            $jalan = trim(strtolower($row[1] ?? ''));
            if (in_array($jalan, $invalid_jalans)) {
                continue;
            }

            // Normalisasi Kondisi
            $kondisi = null;
            if (!empty($row[7])) { $kondisi = 'Baik'; }
            elseif (!empty($row[8])) { $kondisi = 'Rusak'; }

            // Normalisasi Tekanan
            $tekanan = null;
            if (!empty($row[9])) { $tekanan = 'Kuat'; }
            elseif (!empty($row[10])) { $tekanan = 'Sedang'; }
            elseif (!empty($row[11])) { $tekanan = 'Lemah'; }

            // Normalisasi Machino
            $machino = null;
            if (!empty($row[12])) { $machino = 'Baik'; }
            elseif (!empty($row[13])) { $machino = 'Rusak'; }

            HidranKota::create([
                'jalan'           => $row[1] ?? null,
                'kecamatan'       => $row[2] ?? null,
                'kelurahan'       => $row[3] ?? null,
                'rt'              => $row[4] ?? null,
                'lokasi_terdekat' => $row[5] ?? null,
                'kode_map'        => $row[6] ?? null,
                'kondisi_hidran'  => $kondisi,
                'tekanan'         => $tekanan,
                'machino'         => $machino,
                'keterangan'      => $row[14] ?? null,
            ]);
        }
    }
}
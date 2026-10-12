<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataAsn;
use Illuminate\Support\Facades\DB;

class DataAsnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bersihkan tabel terlebih dahulu agar tidak ada data ganda jika dijalankan ulang
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DataAsn::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            ['nama_jabatan' => 'STRUKTURAL', 'pns' => 11, 'pppk' => 0],
            ['nama_jabatan' => 'ANALIS KEBAKARAN AHLI MUDA', 'pns' => 2, 'pppk' => 0],
            ['nama_jabatan' => 'ARSIPARIS AHLI PERTAMA', 'pns' => 1, 'pppk' => 1],
            ['nama_jabatan' => 'ANALIS KEBAKARAN AHLI PERTAMA', 'pns' => 2, 'pppk' => 14],
            ['nama_jabatan' => 'PEMADAM KEBAKARAN MAHIR', 'pns' => 2, 'pppk' => 0],
            ['nama_jabatan' => 'PEMADAM KEBAKARAN TERAMPIL', 'pns' => 5, 'pppk' => 4],
            ['nama_jabatan' => 'PEMADAM KEBAKARAN PEMULA', 'pns' => 0, 'pppk' => 174],
            ['nama_jabatan' => 'PENELAAH TEKNIS KEBIJAKAN', 'pns' => 8, 'pppk' => 0],
            ['nama_jabatan' => 'PENATA LAYANAN OPERASIONAL', 'pns' => 3, 'pppk' => 5],
            ['nama_jabatan' => 'PENGADMINISTRASI PERKANTORAN', 'pns' => 16, 'pppk' => 8],
        ];

        foreach ($data as $item) {
            DataAsn::create([
                'nama_jabatan' => $item['nama_jabatan'],
                'pns'          => $item['pns'],
                'pppk'         => $item['pppk'],
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
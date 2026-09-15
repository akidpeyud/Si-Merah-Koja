<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DashcamSeeder extends Seeder
{
    public function run()
    {
        $dashcams = [
            ['lokasi_pemasangan' => 'Armada water suply 04 Mako', 'jumlah' => '1 Set', 'tahun' => '2025', 'kondisi' => 'Baik', 'keterangan' => null],
            ['lokasi_pemasangan' => 'Armada water suply 07 Mako', 'jumlah' => '1 Set', 'tahun' => '2025', 'kondisi' => 'Baik', 'keterangan' => null],
            ['lokasi_pemasangan' => 'Armada Pump Unit 09 Mako', 'jumlah' => '1 Set', 'tahun' => '2025', 'kondisi' => 'Baik', 'keterangan' => null],
            ['lokasi_pemasangan' => 'Armada Pump Unit 11 Mako', 'jumlah' => '1 Set', 'tahun' => '2025', 'kondisi' => 'Baik', 'keterangan' => null],
            ['lokasi_pemasangan' => 'Armada Pump Unit 16 Mako', 'jumlah' => '1 Set', 'tahun' => '2025', 'kondisi' => 'Baik', 'keterangan' => null],
            ['lokasi_pemasangan' => 'Armada Pump Unit 08 Kota Baru', 'jumlah' => '1 Set', 'tahun' => '2025', 'kondisi' => 'Baik', 'keterangan' => null],
            ['lokasi_pemasangan' => 'Armada Pump Unit 012 Jambi Timur', 'jumlah' => '1 Set', 'tahun' => '2025', 'kondisi' => 'Baik', 'keterangan' => null],
            ['lokasi_pemasangan' => 'Armada Pump Unit 013 Palmerah', 'jumlah' => '1 Set', 'tahun' => '2025', 'kondisi' => 'Baik', 'keterangan' => null],
            ['lokasi_pemasangan' => 'Armada Pump Unit 014 Jamkose', 'jumlah' => '1 Set', 'tahun' => '2025', 'kondisi' => 'Baik', 'keterangan' => null],
            ['lokasi_pemasangan' => 'Armada Pump Unit 015 Alam Barajo', 'jumlah' => '1 Set', 'tahun' => '2025', 'kondisi' => 'Baik', 'keterangan' => null],
        ];

        DB::table('dashcams')->insert($dashcams);
    }
}
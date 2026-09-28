<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuntingBesiSeeder extends Seeder
{
    public function run()
    {
        $gunting_besis = [
            ['nama_penerima' => 'Kms. Muammar', 'jabatan' => 'Danpos Alam Barajo', 'jumlah' => '1 Unit', 'tahun' => '', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'M. Rusdi', 'jabatan' => 'Danpos Jamkose', 'jumlah' => '1 Unit', 'tahun' => '', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Wilopo', 'jabatan' => 'Danpos Jambi Timur', 'jumlah' => '1 Unit', 'tahun' => '', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Hermanyanto', 'jabatan' => 'Danpos Palmerah', 'jumlah' => '1 Unit', 'tahun' => '', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Dwi Wahyudi', 'jabatan' => 'Danpos Kota Baru', 'jumlah' => '1 Unit', 'tahun' => '', 'kondisi' => 'Baik', 'keterangan' => null],
        ];
        
        DB::table('gunting_besis')->insert($gunting_besis);
    }
}
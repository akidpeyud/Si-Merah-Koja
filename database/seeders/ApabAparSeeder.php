<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApabAparSeeder extends Seeder
{
    public function run()
    {
        $apab_apars = [
            ['nama_penerima' => 'BIDANG PENCEGAHAN', 'jenis_barang' => 'APAB 25 KG', 'jumlah' => 2, 'tahun_pengadaan' => 2024, 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'BIDANG PENCEGAHAN', 'jenis_barang' => 'APAR (LIQUID GAS 3.5 KG)', 'jumlah' => 1, 'tahun_pengadaan' => 2023, 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'BIDANG PENCEGAHAN', 'jenis_barang' => 'APAR (ABC POWDER 2KG)', 'jumlah' => 3, 'tahun_pengadaan' => 2023, 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'BIDANG PENCEGAHAN', 'jenis_barang' => 'APAR CO2 (2KG)', 'jumlah' => 1, 'tahun_pengadaan' => 2023, 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'BENGKEL', 'jenis_barang' => 'APAR (ABC POWDER 12 KG)', 'jumlah' => 1, 'tahun_pengadaan' => 2024, 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'BENGKEL', 'jenis_barang' => 'APAR (ABC POWDER 12 KG)', 'jumlah' => 1, 'tahun_pengadaan' => 2024, 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'BENGKEL', 'jenis_barang' => 'APAR (ABC POWDER 12 KG)', 'jumlah' => 1, 'tahun_pengadaan' => 2024, 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'BENGKEL', 'jenis_barang' => 'APAR (ABC POWDER 12 KG)', 'jumlah' => 1, 'tahun_pengadaan' => 2024, 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'BENGKEL', 'jenis_barang' => 'APAR (ABC POWDER 12 KG)', 'jumlah' => 1, 'tahun_pengadaan' => 2024, 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'BENGKEL', 'jenis_barang' => 'APAR (ABC POWDER 12 KG)', 'jumlah' => 1, 'tahun_pengadaan' => 2024, 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'BENGKEL', 'jenis_barang' => 'APAR (ABC POWDER 12 KG)', 'jumlah' => 1, 'tahun_pengadaan' => 2024, 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'BENGKEL', 'jenis_barang' => 'APAR (ABC POWDER 12 KG)', 'jumlah' => 1, 'tahun_pengadaan' => 2024, 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'BENGKEL', 'jenis_barang' => 'APAR (ABC POWDER 12 KG)', 'jumlah' => 1, 'tahun_pengadaan' => 2024, 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'BENGKEL', 'jenis_barang' => 'APAR (ABC POWDER 12 KG)', 'jumlah' => 1, 'tahun_pengadaan' => 2024, 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'BENGKEL', 'jenis_barang' => 'APAR (ABC POWDER 12 KG)', 'jumlah' => 1, 'tahun_pengadaan' => 2024, 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'BENGKEL', 'jenis_barang' => 'APAR (ABC POWDER 12 KG)', 'jumlah' => 1, 'tahun_pengadaan' => 2024, 'kondisi' => 'Baik', 'keterangan' => null],
        ];

        DB::table('apab_apars')->insert($apab_apars);
    }
}
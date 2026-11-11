<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerbaikanKendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds for Data Perbaikan Kendaraan Operasional (/sapra/perbaikan-kendaraan).
     */
    public function run(): void
    {
        $dataPerbaikan = [
            [
                'id'                => 1,
                'nopol_kendaraan'   => 'BH 8395 Z',
                'jenis_kendaraan'   => 'R6',
                'merk_kendaraan'    => 'Hyno Drtro',
                'tgl_perbaikan'     => '2026-02-04',
                'jenis_kerusakan'   => 'Pengantian AKI N70, Mater Kopling Atas, Sarung Jok',
                'merek_tipe_barang' => 'GS, -, -',
                'satuan'            => '4, 1, 1',
                'rincian_harga'     => '6848000, 1350000, 2250000',
                'total_harga'       => 10448000,
                'foto'              => null,
            ],
            [
                'id'                => 2,
                'nopol_kendaraan'   => 'BH 9130 A',
                'jenis_kendaraan'   => 'R10',
                'merk_kendaraan'    => 'Mitsubishi Fuso',
                'tgl_perbaikan'     => '2026-02-27',
                'jenis_kerusakan'   => 'Batre Charger, Servvo Kopling, Miyak Rem',
                'merek_tipe_barang' => 'Wipro, -, -',
                'satuan'            => '1, 1, 4',
                'rincian_harga'     => '3300000, 1350000, 35000',
                'total_harga'       => 4685000,
                'foto'              => null,
            ],
            [
                'id'                => 3,
                'nopol_kendaraan'   => 'BH 8241 A',
                'jenis_kendaraan'   => 'R6',
                'merk_kendaraan'    => 'Hyno Drtro',
                'tgl_perbaikan'     => '2026-03-30',
                'jenis_kerusakan'   => 'Blok Rem, Kampas Rem, Gemuk, Miyak Rem, Seal As PTO',
                'merek_tipe_barang' => '-, -, Nippon, -, -',
                'satuan'            => '4, 1, 1, 2, 2',
                'rincian_harga'     => '2486000, 1111000, 368000, 342000, 1215000',
                'total_harga'       => 5522000,
                'foto'              => null,
            ],
            [
                'id'                => 4,
                'nopol_kendaraan'   => 'BH 9129 A',
                'jenis_kendaraan'   => 'R10',
                'merk_kendaraan'    => 'Mitsubishi Fuso',
                'tgl_perbaikan'     => '2026-04-01',
                'jenis_kerusakan'   => 'Klahar PTO ( Gearbox ), Gigi Gearbox',
                'merek_tipe_barang' => null,
                'satuan'            => '1, 2',
                'rincian_harga'     => '5600000, 1700000',
                'total_harga'       => 7300000,
                'foto'              => null,
            ],
            [
                'id'                => 5,
                'nopol_kendaraan'   => 'BH 8395 Z',
                'jenis_kendaraan'   => 'R6',
                'merk_kendaraan'    => 'Hyno Drtro',
                'tgl_perbaikan'     => '2026-04-13',
                'jenis_kerusakan'   => 'Pengantian AKI N70, Pengisian Air AKI',
                'merek_tipe_barang' => 'GS, -',
                'satuan'            => '2, 50',
                'rincian_harga'     => '1700000, 24000',
                'total_harga'       => 1724000,
                'foto'              => null,
            ],
            [
                'id'                => 6,
                'nopol_kendaraan'   => 'BH 1184 A',
                'jenis_kendaraan'   => 'R4',
                'merk_kendaraan'    => 'APV SUZUKI',
                'tgl_perbaikan'     => '2026-05-26',
                'jenis_kerusakan'   => 'Pengantian AKI N-40, Sentral Kopling',
                'merek_tipe_barang' => 'GS, -',
                'satuan'            => '1, 1',
                'rincian_harga'     => '320496, 43704',
                'total_harga'       => 364200,
                'foto'              => null,
            ],
        ];

        foreach ($dataPerbaikan as $item) {
            DB::table('perbaikan_kendaraans')->updateOrInsert(
                ['id' => $item['id']],
                [
                    'nopol_kendaraan'   => $item['nopol_kendaraan'],
                    'jenis_kendaraan'   => $item['jenis_kendaraan'],
                    'merk_kendaraan'    => $item['merk_kendaraan'],
                    'tgl_perbaikan'     => $item['tgl_perbaikan'],
                    'jenis_kerusakan'   => $item['jenis_kerusakan'],
                    'merek_tipe_barang' => $item['merek_tipe_barang'],
                    'satuan'            => $item['satuan'],
                    'rincian_harga'     => $item['rincian_harga'],
                    'total_harga'       => $item['total_harga'],
                    'foto'              => $item['foto'],
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]
            );
        }
    }
}

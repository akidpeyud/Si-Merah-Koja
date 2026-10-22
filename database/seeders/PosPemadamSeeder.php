<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PosPemadamSeeder extends Seeder
{
    /**
     * Run the database seeds for Kelola Data Pos & Mako (sapra/kelola-pos).
     */
    public function run(): void
    {
        $posPemadam = [
            [
                'id_pos'   => 1,
                'nama_pos' => 'MAKO',
                'alamat'   => 'Jl. HOS. Cokroaminoto, Suka Karya, Kec. Kota Baru, Kota Jambi',
                'kode_map' => '9JJ2+Q76',
            ],
            [
                'id_pos'   => 2,
                'nama_pos' => 'POS ALAM BARAJO',
                'alamat'   => 'JL. Sailendra Rw. Sari, Kec. Kota Baru, Kota Jambi',
                'kode_map' => '9HGG+H2M',
            ],
            [
                'id_pos'   => 3,
                'nama_pos' => 'POS JAMKOSE',
                'alamat'   => 'Jl. Kh. M. Saleh Pasir Panjang, Kec. Danau Tlk., Kota Jambi',
                'kode_map' => 'CH9G+48M',
            ],
            [
                'id_pos'   => 4,
                'nama_pos' => 'POS JAMBI TIMUR',
                'alamat'   => 'Jl. Prabu Siliwangi, Tj. Sari, Kec. Jambi Tim., Kota Jambi',
                'kode_map' => 'CJ5P+RPG',
            ],
            [
                'id_pos'   => 5,
                'nama_pos' => 'POS PALMERAH',
                'alamat'   => 'Jl. Rb. Siagian, Talang Bakung, Kec. Jambi Sel., Kota Jambi',
                'kode_map' => '9M93+9PR',
            ],
            [
                'id_pos'   => 6,
                'nama_pos' => 'POS KOTA BARU',
                'alamat'   => 'Jl. Lingkar Selatan, Kenali Asam Bawah, Kec. Kota Baru, Kota Jambi',
                'kode_map' => '8JG4+PFG',
            ],
        ];

        foreach ($posPemadam as $pos) {
            DB::table('pos_pemadam')->updateOrInsert(
                ['id_pos' => $pos['id_pos']],
                [
                    'nama_pos' => $pos['nama_pos'],
                    'alamat'   => $pos['alamat'],
                    'kode_map' => $pos['kode_map'],
                ]
            );
        }
    }
}

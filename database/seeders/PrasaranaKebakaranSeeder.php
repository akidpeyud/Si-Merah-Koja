<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrasaranaKebakaranSeeder extends Seeder
{
    /**
     * Run the database seeds for Data Prasarana Pemadam Kebakaran (sapra/prasarana-mako).
     */
    public function run(): void
    {
        // 1. Pastikan data Pos Pemadam tersedia
        $posPemadam = [
            ['id_pos' => 1, 'nama_pos' => 'MAKO', 'alamat' => 'Jl. HOS. Cokroaminoto, Suka Karya, Kec. Kota Baru, Kota Jambi', 'kode_map' => '9JJ2+Q76'],
            ['id_pos' => 2, 'nama_pos' => 'POS ALAM BARAJO', 'alamat' => 'JL. Sailendra Rw. Sari, Kec. Kota Baru, Kota Jambi', 'kode_map' => '9HGG+H2M'],
            ['id_pos' => 3, 'nama_pos' => 'POS JAMKOSE', 'alamat' => 'Jl. Kh. M. Saleh Pasir Panjang, Kec. Danau Tlk., Kota Jambi', 'kode_map' => 'CH9G+48M'],
            ['id_pos' => 4, 'nama_pos' => 'POS JAMBI TIMUR', 'alamat' => 'Jl. Prabu Siliwangi, Tj. Sari, Kec. Jambi Tim., Kota Jambi', 'kode_map' => 'CJ5P+RPG'],
            ['id_pos' => 5, 'nama_pos' => 'POS PALMERAH', 'alamat' => 'Jl. Rb. Siagian, Talang Bakung, Kec. Jambi Sel., Kota Jambi', 'kode_map' => '9M93+9PR'],
            ['id_pos' => 6, 'nama_pos' => 'POS KOTA BARU', 'alamat' => 'Jl. Lingkar Selatan, Kenali Asam Bawah, Kec. Kota Baru, Kota Jambi', 'kode_map' => '8JG4+PFG'],
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

        // 2. Data Prasarana Pemadam Kebakaran (Mako & Pos)
        $prasaranaList = [
            [
                'id_prasarana'    => 1,
                'id_pos'          => 1,
                'jenis_prasarana' => 'GEDUNG KANTOR DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN',
                'luas_bangunan'   => '200 m2',
                'path_gambar'     => 'uploads/prasarana/1788918209_mako 1.jpg',
            ],
            [
                'id_prasarana'    => 2,
                'id_pos'          => 1,
                'jenis_prasarana' => 'BARAK PERSONIL MAKO',
                'luas_bangunan'   => '70m2',
                'path_gambar'     => 'uploads/prasarana/1788918253_mako2.png',
            ],
            [
                'id_prasarana'    => 3,
                'id_pos'          => 1,
                'jenis_prasarana' => 'POS PIKET JAGA DAN RUANG OPERATOR',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788918490_mako3.jpg',
            ],
            [
                'id_prasarana'    => 4,
                'id_pos'          => 1,
                'jenis_prasarana' => 'BANGUNAN BENGKEL',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788918558_mako4.jpg',
            ],
            [
                'id_prasarana'    => 5,
                'id_pos'          => 1,
                'jenis_prasarana' => 'GUDANG PEMADAM KEBAKARAN',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788918841_mako6.png',
            ],
            [
                'id_prasarana'    => 6,
                'id_pos'          => 1,
                'jenis_prasarana' => 'MUSHOLA',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788918872_mako56.png',
            ],
            [
                'id_prasarana'    => 7,
                'id_pos'          => 1,
                'jenis_prasarana' => 'RUANG DAPUR',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788918971_mako7.png',
            ],
            [
                'id_prasarana'    => 8,
                'id_pos'          => 1,
                'jenis_prasarana' => 'LEMARI APD PERSONIL',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788919064_mako8.jpg',
            ],
            [
                'id_prasarana'    => 9,
                'id_pos'          => 1,
                'jenis_prasarana' => 'MES SUPIR',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788919081_mako9.png',
            ],
            [
                'id_prasarana'    => 10,
                'id_pos'          => 1,
                'jenis_prasarana' => 'PARKIR ARMADA',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788919095_mako10.jpg',
            ],
            [
                'id_prasarana'    => 11,
                'id_pos'          => 1,
                'jenis_prasarana' => 'FIRE GROUND',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788919112_mako11.png',
            ],
            [
                'id_prasarana'    => 12,
                'id_pos'          => 1,
                'jenis_prasarana' => 'MENARA REPLING',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788919126_mako12.jpg',
            ],
            [
                'id_prasarana'    => 13,
                'id_pos'          => 1,
                'jenis_prasarana' => 'HIDRANT',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788919140_mako13.jpg',
            ],
            [
                'id_prasarana'    => 14,
                'id_pos'          => 1,
                'jenis_prasarana' => 'AULA KAPASITAS 250 ORANG',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788919158_mako14.jpg',
            ],
            [
                'id_prasarana'    => 15,
                'id_pos'          => 2,
                'jenis_prasarana' => 'GEDUNG POSYANKAR ALAM BARAJO',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920127_alam1.jpg',
            ],
            [
                'id_prasarana'    => 16,
                'id_pos'          => 2,
                'jenis_prasarana' => 'BARAK PERSONIL',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920205_alam2.jpg',
            ],
            [
                'id_prasarana'    => 17,
                'id_pos'          => 2,
                'jenis_prasarana' => 'RUANG OPERATOR',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920450_alam3.jpg',
            ],
            [
                'id_prasarana'    => 18,
                'id_pos'          => 2,
                'jenis_prasarana' => 'PARKIR ARMADA',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920461_alam4.jpg',
            ],
            [
                'id_prasarana'    => 19,
                'id_pos'          => 2,
                'jenis_prasarana' => 'RUANG DAPUR',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920475_alam5.jpg',
            ],
            [
                'id_prasarana'    => 20,
                'id_pos'          => 2,
                'jenis_prasarana' => 'LEMARI APD PERSONIL',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920487_alam6.jpg',
            ],
            [
                'id_prasarana'    => 21,
                'id_pos'          => 2,
                'jenis_prasarana' => 'HIDRANT',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920499_alam7.jpg',
            ],
            [
                'id_prasarana'    => 22,
                'id_pos'          => 3,
                'jenis_prasarana' => 'GEDUNG POSYANKAR JAMKOSE',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920570_jam1.jpg',
            ],
            [
                'id_prasarana'    => 23,
                'id_pos'          => 3,
                'jenis_prasarana' => 'BARAK PERSONIL',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920581_jam2.jpg',
            ],
            [
                'id_prasarana'    => 24,
                'id_pos'          => 3,
                'jenis_prasarana' => 'RUANG OPERATOR',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920592_jam3.jpg',
            ],
            [
                'id_prasarana'    => 25,
                'id_pos'          => 3,
                'jenis_prasarana' => 'PARKIR ARMADA',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920606_jam4.jpg',
            ],
            [
                'id_prasarana'    => 26,
                'id_pos'          => 3,
                'jenis_prasarana' => 'RUANG DAPUR',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920616_jam5.jpg',
            ],
            [
                'id_prasarana'    => 27,
                'id_pos'          => 3,
                'jenis_prasarana' => 'LEMARI APD PERSONIL',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920625_jam6.jpg',
            ],
            [
                'id_prasarana'    => 28,
                'id_pos'          => 4,
                'jenis_prasarana' => 'GEDUNG POSYANKAR ALAM BARAJO',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920711_timur1.jpg',
            ],
            [
                'id_prasarana'    => 29,
                'id_pos'          => 4,
                'jenis_prasarana' => 'BARAK PERSONIL',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920719_timur 2.jpg',
            ],
            [
                'id_prasarana'    => 30,
                'id_pos'          => 4,
                'jenis_prasarana' => 'RUANG OPERATOR',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920727_timur3.jpg',
            ],
            [
                'id_prasarana'    => 31,
                'id_pos'          => 4,
                'jenis_prasarana' => 'PARKIR ARMADA',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920736_timur4.jpg',
            ],
            [
                'id_prasarana'    => 32,
                'id_pos'          => 4,
                'jenis_prasarana' => 'RUANG DAPUR',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920745_timur5.jpg',
            ],
            [
                'id_prasarana'    => 33,
                'id_pos'          => 4,
                'jenis_prasarana' => 'LEMARI APD PERSONIL',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920755_timur6.jpg',
            ],
            [
                'id_prasarana'    => 34,
                'id_pos'          => 4,
                'jenis_prasarana' => 'HIDRANT',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788920768_timur7.jpg',
            ],
            [
                'id_prasarana'    => 35,
                'id_pos'          => 5,
                'jenis_prasarana' => 'GEDUNG POSYANKAR ALAM BARAJO',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788921076_merah1.jpg',
            ],
            [
                'id_prasarana'    => 36,
                'id_pos'          => 5,
                'jenis_prasarana' => 'BARAK PERSONIL',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788921085_merah2.jpg',
            ],
            [
                'id_prasarana'    => 37,
                'id_pos'          => 5,
                'jenis_prasarana' => 'RUANG OPERATOR',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788921092_merah3.jpg',
            ],
            [
                'id_prasarana'    => 38,
                'id_pos'          => 5,
                'jenis_prasarana' => 'PARKIR ARMADA',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788921099_merah4.jpg',
            ],
            [
                'id_prasarana'    => 39,
                'id_pos'          => 5,
                'jenis_prasarana' => 'RUANG DAPUR',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788921114_merah5.jpg',
            ],
            [
                'id_prasarana'    => 40,
                'id_pos'          => 5,
                'jenis_prasarana' => 'LEMARI APD PERSONIL',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788921128_merah6.jpg',
            ],
            [
                'id_prasarana'    => 41,
                'id_pos'          => 5,
                'jenis_prasarana' => 'HIDRANT',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788921136_merah7.jpg',
            ],
            [
                'id_prasarana'    => 42,
                'id_pos'          => 6,
                'jenis_prasarana' => 'GEDUNG POSYANKAR ALAM BARAJO',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788921213_baru1.jpg',
            ],
            [
                'id_prasarana'    => 43,
                'id_pos'          => 6,
                'jenis_prasarana' => 'BARAK PERSONIL',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788921220_baru2.jpg',
            ],
            [
                'id_prasarana'    => 44,
                'id_pos'          => 6,
                'jenis_prasarana' => 'RUANG OPERATOR',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788921227_baru3.jpg',
            ],
            [
                'id_prasarana'    => 45,
                'id_pos'          => 6,
                'jenis_prasarana' => 'PARKIR ARMADA',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788921234_baru4.jpg',
            ],
            [
                'id_prasarana'    => 46,
                'id_pos'          => 6,
                'jenis_prasarana' => 'RUANG DAPUR',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788921242_baru5.jpg',
            ],
            [
                'id_prasarana'    => 47,
                'id_pos'          => 6,
                'jenis_prasarana' => 'LEMARI APD PERSONIL',
                'luas_bangunan'   => NULL,
                'path_gambar'     => 'uploads/prasarana/1788921252_baru6.jpg',
            ],
        ];

        foreach ($prasaranaList as $item) {
            DB::table('prasarana')->updateOrInsert(
                ['id_prasarana' => $item['id_prasarana']],
                [
                    'id_pos'          => $item['id_pos'],
                    'jenis_prasarana' => $item['jenis_prasarana'],
                    'luas_bangunan'   => $item['luas_bangunan'],
                    'path_gambar'     => $item['path_gambar'],
                ]
            );
        }
    }
}

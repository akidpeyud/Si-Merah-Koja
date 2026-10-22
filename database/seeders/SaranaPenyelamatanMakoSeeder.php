<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaranaPenyelamatanMakoSeeder extends Seeder
{
    /**
     * Run the database seeds for Data Sarana Penyelamatan & Evakuasi (sapra/sarana-penyelamatan).
     */
    public function run(): void
    {
        // 1. Pastikan data Pos Pemadam tersedia
        $this->call(PosPemadamSeeder::class);

        // 2. Data Sarana Penyelamatan & Evakuasi (Mako & Pos)
        $saranaList = [
            [
                'id_sarana_penyelamatan' => 1,
                'id_pos'                 => 1,
                'jenis_sarana'           => 'ALAT PELINDUNG DIRI (RESCUE)',
                'jumlah'                 => 12,
                'path_gambar'            => 'uploads/penyelamatan/1789541280_sape 1.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 2,
                'id_pos'                 => 1,
                'jenis_sarana'           => 'ALAT PELINDUNG DIRI (BAJU TAWON)',
                'jumlah'                 => 3,
                'path_gambar'            => 'uploads/penyelamatan/1789541292_sape 2.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 3,
                'id_pos'                 => 1,
                'jenis_sarana'           => 'MOBIL AVP RESCUE',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1789541311_sape 3.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 4,
                'id_pos'                 => 1,
                'jenis_sarana'           => 'MOBIL FIRE JEEP',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1789541324_sape 4.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 5,
                'id_pos'                 => 1,
                'jenis_sarana'           => 'STIK ULAR',
                'jumlah'                 => 6,
                'path_gambar'            => 'uploads/penyelamatan/1789541332_sape 5.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 6,
                'id_pos'                 => 1,
                'jenis_sarana'           => 'STIK TAWON',
                'jumlah'                 => 3,
                'path_gambar'            => 'uploads/penyelamatan/1789541344_sape 6.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 7,
                'id_pos'                 => 1,
                'jenis_sarana'           => 'MESIN PEMOTONG CINCIN',
                'jumlah'                 => 3,
                'path_gambar'            => 'uploads/penyelamatan/1789541356_sape 7.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 8,
                'id_pos'                 => 1,
                'jenis_sarana'           => 'GUNTING BESI',
                'jumlah'                 => 6,
                'path_gambar'            => 'uploads/penyelamatan/1789541377_sape 8.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 9,
                'id_pos'                 => 1,
                'jenis_sarana'           => 'BAJU PELAMPUNG',
                'jumlah'                 => 10,
                'path_gambar'            => 'uploads/penyelamatan/1789541390_sape 9.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 10,
                'id_pos'                 => 1,
                'jenis_sarana'           => 'BAJU SELAM',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1789541401_sape 10.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 11,
                'id_pos'                 => 1,
                'jenis_sarana'           => 'SCUBA TANK',
                'jumlah'                 => 5,
                'path_gambar'            => 'uploads/penyelamatan/1789541413_sape 11.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 12,
                'id_pos'                 => 1,
                'jenis_sarana'           => 'TANGGA',
                'jumlah'                 => 2,
                'path_gambar'            => 'uploads/penyelamatan/1789541425_sape 12.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 13,
                'id_pos'                 => 1,
                'jenis_sarana'           => 'TALI KARMANTEL',
                'jumlah'                 => 2,
                'path_gambar'            => 'uploads/penyelamatan/1789541439_sape 13.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 14,
                'id_pos'                 => 1,
                'jenis_sarana'           => 'PULE TANDEM',
                'jumlah'                 => 3,
                'path_gambar'            => 'uploads/penyelamatan/1789541453_sape 14.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 15,
                'id_pos'                 => 1,
                'jenis_sarana'           => 'SEAT HARNES',
                'jumlah'                 => 3,
                'path_gambar'            => 'uploads/penyelamatan/1789541462_sape 15.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 16,
                'id_pos'                 => 1,
                'jenis_sarana'           => 'CARABINER',
                'jumlah'                 => 10,
                'path_gambar'            => 'uploads/penyelamatan/1789541471_sape 16.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 17,
                'id_pos'                 => 1,
                'jenis_sarana'           => 'TANDU',
                'jumlah'                 => 2,
                'path_gambar'            => 'uploads/penyelamatan/1789541479_sape 17.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 18,
                'id_pos'                 => 1,
                'jenis_sarana'           => 'ZUMAR',
                'jumlah'                 => 6,
                'path_gambar'            => 'uploads/penyelamatan/1789541488_sape 18.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 19,
                'id_pos'                 => 2,
                'jenis_sarana'           => 'ALAT PELINDUNG DIRI (RESCUE)',
                'jumlah'                 => 4,
                'path_gambar'            => 'uploads/penyelamatan/1792548477_alam1.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 20,
                'id_pos'                 => 2,
                'jenis_sarana'           => 'ALAT PELINDUNG DIRI (BAJU TAWON)',
                'jumlah'                 => 2,
                'path_gambar'            => 'uploads/penyelamatan/1792548487_alam2.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 21,
                'id_pos'                 => 2,
                'jenis_sarana'           => 'MOTOR RESCUE',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792548496_alam3.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 22,
                'id_pos'                 => 2,
                'jenis_sarana'           => 'STIK ULAR',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792548504_alam4.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 23,
                'id_pos'                 => 2,
                'jenis_sarana'           => 'STIK TAWON',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792548513_alam5.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 24,
                'id_pos'                 => 2,
                'jenis_sarana'           => 'TANGGA',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792548527_alam6.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 25,
                'id_pos'                 => 2,
                'jenis_sarana'           => 'BOX ULAR',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792548536_alam7.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 26,
                'id_pos'                 => 3,
                'jenis_sarana'           => 'ALAT PELINDUNG DIRI (RESCUE)',
                'jumlah'                 => 2,
                'path_gambar'            => 'uploads/penyelamatan/1792548738_kose1.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 27,
                'id_pos'                 => 3,
                'jenis_sarana'           => 'ALAT PELINDUNG DIRI (BAJU TAWON)',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792548759_kose2.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 28,
                'id_pos'                 => 3,
                'jenis_sarana'           => 'MOTOR RESCUE',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792548781_kose3.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 29,
                'id_pos'                 => 3,
                'jenis_sarana'           => 'SPEED BOAT',
                'jumlah'                 => 2,
                'path_gambar'            => 'uploads/penyelamatan/1792548804_kose4.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 30,
                'id_pos'                 => 3,
                'jenis_sarana'           => 'SCUBA TANK',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792548819_kose5.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 31,
                'id_pos'                 => 3,
                'jenis_sarana'           => 'BAJU SELAM',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792548843_kose6.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 32,
                'id_pos'                 => 3,
                'jenis_sarana'           => 'BAJU PELAMPUNG',
                'jumlah'                 => 4,
                'path_gambar'            => 'uploads/penyelamatan/1792548856_kose7.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 33,
                'id_pos'                 => 3,
                'jenis_sarana'           => 'STIK ULAR',
                'jumlah'                 => 2,
                'path_gambar'            => 'uploads/penyelamatan/1792548875_kose8.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 34,
                'id_pos'                 => 3,
                'jenis_sarana'           => 'STIK TAWON',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792548886_kose9.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 35,
                'id_pos'                 => 3,
                'jenis_sarana'           => 'TANGGA',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792548897_kose10.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 36,
                'id_pos'                 => 3,
                'jenis_sarana'           => 'BOX ULAR',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792548907_kose11.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 37,
                'id_pos'                 => 4,
                'jenis_sarana'           => 'ALAT PELINDUNG DIRI (RESCUE)',
                'jumlah'                 => 2,
                'path_gambar'            => 'uploads/penyelamatan/1792550214_jatim1.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 38,
                'id_pos'                 => 4,
                'jenis_sarana'           => 'ALAT PELINDUNG DIRI (BAJU TAWON)',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792550225_jatim2.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 39,
                'id_pos'                 => 4,
                'jenis_sarana'           => 'MOTOR RESCUE',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792550236_jatim3.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 40,
                'id_pos'                 => 4,
                'jenis_sarana'           => 'STIK ULAR',
                'jumlah'                 => 2,
                'path_gambar'            => 'uploads/penyelamatan/1792550246_jatim4.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 41,
                'id_pos'                 => 4,
                'jenis_sarana'           => 'STIK TAWON',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792550256_jatim5.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 42,
                'id_pos'                 => 4,
                'jenis_sarana'           => 'TANGGA',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792550268_jatim6.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 43,
                'id_pos'                 => 4,
                'jenis_sarana'           => 'BOX ULAR',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792550278_jatim7.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 44,
                'id_pos'                 => 5,
                'jenis_sarana'           => 'ALAT PELINDUNG DIRI (RESCUE)',
                'jumlah'                 => 3,
                'path_gambar'            => 'uploads/penyelamatan/1792550289_merah1.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 45,
                'id_pos'                 => 5,
                'jenis_sarana'           => 'ALAT PELINDUNG DIRI (BAJU TAWON)',
                'jumlah'                 => 3,
                'path_gambar'            => 'uploads/penyelamatan/1792550296_merah2.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 46,
                'id_pos'                 => 5,
                'jenis_sarana'           => 'MOTOR RESCUE',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792550360_merah3.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 47,
                'id_pos'                 => 5,
                'jenis_sarana'           => 'STIK ULAR',
                'jumlah'                 => 2,
                'path_gambar'            => 'uploads/penyelamatan/1792550426_merah4.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 48,
                'id_pos'                 => 5,
                'jenis_sarana'           => 'STIK TAWON',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792550438_merah5.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 49,
                'id_pos'                 => 5,
                'jenis_sarana'           => 'TANGGA',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792550448_merah6.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 50,
                'id_pos'                 => 5,
                'jenis_sarana'           => 'BOX ULAR',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792550457_merah7.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 51,
                'id_pos'                 => 6,
                'jenis_sarana'           => 'ALAT PELINDUNG DIRI (RESCUE)',
                'jumlah'                 => 2,
                'path_gambar'            => 'uploads/penyelamatan/1792550541_kobar1.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 52,
                'id_pos'                 => 6,
                'jenis_sarana'           => 'ALAT PELINDUNG DIRI (BAJU TAWON)',
                'jumlah'                 => 2,
                'path_gambar'            => 'uploads/penyelamatan/1792550551_kobar2.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 53,
                'id_pos'                 => 6,
                'jenis_sarana'           => 'MOTOR RESCUE',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792550559_kobar3.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 54,
                'id_pos'                 => 6,
                'jenis_sarana'           => 'STIK ULAR',
                'jumlah'                 => 2,
                'path_gambar'            => 'uploads/penyelamatan/1792550613_kobar4.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 55,
                'id_pos'                 => 6,
                'jenis_sarana'           => 'STIK TAWON',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792550623_kobar5.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 56,
                'id_pos'                 => 6,
                'jenis_sarana'           => 'TANGGA',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792550635_kobar6.jpg',
            ],
            [
                'id_sarana_penyelamatan' => 57,
                'id_pos'                 => 6,
                'jenis_sarana'           => 'BOX ULAR',
                'jumlah'                 => 1,
                'path_gambar'            => 'uploads/penyelamatan/1792550644_kobar7.jpg',
            ],
        ];

        foreach ($saranaList as $item) {
            DB::table('sarana_penyelamatan')->updateOrInsert(
                ['id_sarana_penyelamatan' => $item['id_sarana_penyelamatan']],
                [
                    'id_pos'       => $item['id_pos'],
                    'jenis_sarana' => $item['jenis_sarana'],
                    'jumlah'       => $item['jumlah'],
                    'path_gambar'  => $item['path_gambar'],
                ]
            );
        }
    }
}

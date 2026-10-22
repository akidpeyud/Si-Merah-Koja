<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengadaanSarprasSeeder extends Seeder
{
    /**
     * Run the database seeds for Riwayat Pengadaan Sarpras (/sapra/kebutuhan-sarpras tab Riwayat Pengadaan).
     */
    public function run(): void
    {
        $pengadaanSarpras = [
            [
                'id'           => 1,
                'kebutuhan_id' => 16,
                'tahun'        => 2022,
                'jumlah'       => 22,
            ],
            [
                'id'           => 2,
                'kebutuhan_id' => 17,
                'tahun'        => 2019,
                'jumlah'       => 2,
            ],
            [
                'id'           => 3,
                'kebutuhan_id' => 17,
                'tahun'        => 2020,
                'jumlah'       => 2,
            ],
            [
                'id'           => 4,
                'kebutuhan_id' => 17,
                'tahun'        => 2022,
                'jumlah'       => 11,
            ],
            [
                'id'           => 5,
                'kebutuhan_id' => 17,
                'tahun'        => 2023,
                'jumlah'       => 16,
            ],
            [
                'id'           => 6,
                'kebutuhan_id' => 18,
                'tahun'        => 2021,
                'jumlah'       => 1,
            ],
            [
                'id'           => 7,
                'kebutuhan_id' => 20,
                'tahun'        => 2019,
                'jumlah'       => 10,
            ],
            [
                'id'           => 8,
                'kebutuhan_id' => 20,
                'tahun'        => 2020,
                'jumlah'       => 15,
            ],
            [
                'id'           => 9,
                'kebutuhan_id' => 20,
                'tahun'        => 2021,
                'jumlah'       => 10,
            ],
            [
                'id'           => 10,
                'kebutuhan_id' => 20,
                'tahun'        => 2022,
                'jumlah'       => 22,
            ],
            [
                'id'           => 11,
                'kebutuhan_id' => 20,
                'tahun'        => 2023,
                'jumlah'       => 6,
            ],
            [
                'id'           => 12,
                'kebutuhan_id' => 20,
                'tahun'        => 2024,
                'jumlah'       => 30,
            ],
            [
                'id'           => 13,
                'kebutuhan_id' => 20,
                'tahun'        => 2025,
                'jumlah'       => 31,
            ],
            [
                'id'           => 15,
                'kebutuhan_id' => 22,
                'tahun'        => 2021,
                'jumlah'       => 2,
            ],
            [
                'id'           => 16,
                'kebutuhan_id' => 23,
                'tahun'        => 2019,
                'jumlah'       => 2,
            ],
            [
                'id'           => 17,
                'kebutuhan_id' => 23,
                'tahun'        => 2020,
                'jumlah'       => 2,
            ],
            [
                'id'           => 18,
                'kebutuhan_id' => 24,
                'tahun'        => 2019,
                'jumlah'       => 2,
            ],
            [
                'id'           => 19,
                'kebutuhan_id' => 24,
                'tahun'        => 2020,
                'jumlah'       => 2,
            ],
            [
                'id'           => 20,
                'kebutuhan_id' => 24,
                'tahun'        => 2024,
                'jumlah'       => 8,
            ],
            [
                'id'           => 21,
                'kebutuhan_id' => 26,
                'tahun'        => 2022,
                'jumlah'       => 11,
            ],
            [
                'id'           => 22,
                'kebutuhan_id' => 26,
                'tahun'        => 2025,
                'jumlah'       => 10,
            ],
            [
                'id'           => 23,
                'kebutuhan_id' => 27,
                'tahun'        => 2022,
                'jumlah'       => 1,
            ],
            [
                'id'           => 24,
                'kebutuhan_id' => 28,
                'tahun'        => 2022,
                'jumlah'       => 2,
            ],
            [
                'id'           => 25,
                'kebutuhan_id' => 29,
                'tahun'        => 2022,
                'jumlah'       => 1,
            ],
            [
                'id'           => 26,
                'kebutuhan_id' => 31,
                'tahun'        => 2024,
                'jumlah'       => 15,
            ],
            [
                'id'           => 27,
                'kebutuhan_id' => 32,
                'tahun'        => 2019,
                'jumlah'       => 2,
            ],
            [
                'id'           => 28,
                'kebutuhan_id' => 32,
                'tahun'        => 2020,
                'jumlah'       => 2,
            ],
            [
                'id'           => 29,
                'kebutuhan_id' => 32,
                'tahun'        => 2021,
                'jumlah'       => 10,
            ],
            [
                'id'           => 30,
                'kebutuhan_id' => 33,
                'tahun'        => 2024,
                'jumlah'       => 6,
            ],
            [
                'id'           => 31,
                'kebutuhan_id' => 34,
                'tahun'        => 2020,
                'jumlah'       => 5,
            ],
            [
                'id'           => 32,
                'kebutuhan_id' => 34,
                'tahun'        => 2023,
                'jumlah'       => 16,
            ],
            [
                'id'           => 33,
                'kebutuhan_id' => 35,
                'tahun'        => 2021,
                'jumlah'       => 3,
            ],
            [
                'id'           => 34,
                'kebutuhan_id' => 35,
                'tahun'        => 2022,
                'jumlah'       => 8,
            ],
            [
                'id'           => 35,
                'kebutuhan_id' => 35,
                'tahun'        => 2023,
                'jumlah'       => 16,
            ],
            [
                'id'           => 36,
                'kebutuhan_id' => 35,
                'tahun'        => 2024,
                'jumlah'       => 23,
            ],
            [
                'id'           => 37,
                'kebutuhan_id' => 36,
                'tahun'        => 2023,
                'jumlah'       => 6,
            ],
            [
                'id'           => 38,
                'kebutuhan_id' => 36,
                'tahun'        => 2024,
                'jumlah'       => 30,
            ],
            [
                'id'           => 39,
                'kebutuhan_id' => 36,
                'tahun'        => 2025,
                'jumlah'       => 31,
            ],
            [
                'id'           => 40,
                'kebutuhan_id' => 36,
                'tahun'        => 2026,
                'jumlah'       => 24,
            ],
            [
                'id'           => 41,
                'kebutuhan_id' => 37,
                'tahun'        => 2019,
                'jumlah'       => 2,
            ],
            [
                'id'           => 42,
                'kebutuhan_id' => 37,
                'tahun'        => 2020,
                'jumlah'       => 2,
            ],
            [
                'id'           => 43,
                'kebutuhan_id' => 39,
                'tahun'        => 2022,
                'jumlah'       => 15,
            ],
            [
                'id'           => 44,
                'kebutuhan_id' => 41,
                'tahun'        => 2021,
                'jumlah'       => 6,
            ],
            [
                'id'           => 45,
                'kebutuhan_id' => 41,
                'tahun'        => 2024,
                'jumlah'       => 15,
            ],
            [
                'id'           => 46,
                'kebutuhan_id' => 42,
                'tahun'        => 2019,
                'jumlah'       => 6,
            ],
            [
                'id'           => 47,
                'kebutuhan_id' => 42,
                'tahun'        => 2020,
                'jumlah'       => 6,
            ],
            [
                'id'           => 48,
                'kebutuhan_id' => 42,
                'tahun'        => 2023,
                'jumlah'       => 10,
            ],
            [
                'id'           => 49,
                'kebutuhan_id' => 42,
                'tahun'        => 2024,
                'jumlah'       => 5,
            ],
            [
                'id'           => 50,
                'kebutuhan_id' => 42,
                'tahun'        => 2025,
                'jumlah'       => 20,
            ],
            [
                'id'           => 51,
                'kebutuhan_id' => 43,
                'tahun'        => 2019,
                'jumlah'       => 4,
            ],
            [
                'id'           => 52,
                'kebutuhan_id' => 43,
                'tahun'        => 2024,
                'jumlah'       => 8,
            ],
            [
                'id'           => 53,
                'kebutuhan_id' => 43,
                'tahun'        => 2025,
                'jumlah'       => 15,
            ],
            [
                'id'           => 54,
                'kebutuhan_id' => 44,
                'tahun'        => 2024,
                'jumlah'       => 15,
            ],
            [
                'id'           => 55,
                'kebutuhan_id' => 45,
                'tahun'        => 2020,
                'jumlah'       => 30,
            ],
            [
                'id'           => 56,
                'kebutuhan_id' => 45,
                'tahun'        => 2021,
                'jumlah'       => 7,
            ],
            [
                'id'           => 57,
                'kebutuhan_id' => 45,
                'tahun'        => 2023,
                'jumlah'       => 22,
            ],
            [
                'id'           => 58,
                'kebutuhan_id' => 45,
                'tahun'        => 2024,
                'jumlah'       => 10,
            ],
            [
                'id'           => 59,
                'kebutuhan_id' => 45,
                'tahun'        => 2025,
                'jumlah'       => 80,
            ],
            [
                'id'           => 60,
                'kebutuhan_id' => 50,
                'tahun'        => 2019,
                'jumlah'       => 2,
            ],
            [
                'id'           => 61,
                'kebutuhan_id' => 50,
                'tahun'        => 2020,
                'jumlah'       => 2,
            ],
            [
                'id'           => 62,
                'kebutuhan_id' => 50,
                'tahun'        => 2023,
                'jumlah'       => 3,
            ],
            [
                'id'           => 63,
                'kebutuhan_id' => 50,
                'tahun'        => 2024,
                'jumlah'       => 3,
            ],
            [
                'id'           => 64,
                'kebutuhan_id' => 7,
                'tahun'        => 2021,
                'jumlah'       => 1,
            ],
            [
                'id'           => 65,
                'kebutuhan_id' => 52,
                'tahun'        => 2022,
                'jumlah'       => 10,
            ],
            [
                'id'           => 66,
                'kebutuhan_id' => 54,
                'tahun'        => 2019,
                'jumlah'       => 5,
            ],
            [
                'id'           => 67,
                'kebutuhan_id' => 54,
                'tahun'        => 2020,
                'jumlah'       => 1,
            ],
            [
                'id'           => 68,
                'kebutuhan_id' => 54,
                'tahun'        => 2021,
                'jumlah'       => 6,
            ],
            [
                'id'           => 69,
                'kebutuhan_id' => 54,
                'tahun'        => 2022,
                'jumlah'       => 7,
            ],
            [
                'id'           => 70,
                'kebutuhan_id' => 55,
                'tahun'        => 2025,
                'jumlah'       => 6,
            ],
            [
                'id'           => 71,
                'kebutuhan_id' => 53,
                'tahun'        => 2024,
                'jumlah'       => 15,
            ],
            [
                'id'           => 72,
                'kebutuhan_id' => 53,
                'tahun'        => 2025,
                'jumlah'       => 18,
            ],
            [
                'id'           => 73,
                'kebutuhan_id' => 56,
                'tahun'        => 2019,
                'jumlah'       => 5,
            ],
            [
                'id'           => 74,
                'kebutuhan_id' => 57,
                'tahun'        => 2020,
                'jumlah'       => 17,
            ],
            [
                'id'           => 75,
                'kebutuhan_id' => 57,
                'tahun'        => 2021,
                'jumlah'       => 15,
            ],
            [
                'id'           => 76,
                'kebutuhan_id' => 57,
                'tahun'        => 2022,
                'jumlah'       => 10,
            ],
            [
                'id'           => 77,
                'kebutuhan_id' => 57,
                'tahun'        => 2024,
                'jumlah'       => 8,
            ],
            [
                'id'           => 78,
                'kebutuhan_id' => 58,
                'tahun'        => 2019,
                'jumlah'       => 6,
            ],
            [
                'id'           => 79,
                'kebutuhan_id' => 58,
                'tahun'        => 2026,
                'jumlah'       => 5,
            ],
            [
                'id'           => 80,
                'kebutuhan_id' => 61,
                'tahun'        => 2021,
                'jumlah'       => 4,
            ],
            [
                'id'           => 81,
                'kebutuhan_id' => 62,
                'tahun'        => 2019,
                'jumlah'       => 162,
            ],
            [
                'id'           => 82,
                'kebutuhan_id' => 62,
                'tahun'        => 2024,
                'jumlah'       => 30,
            ],
            [
                'id'           => 83,
                'kebutuhan_id' => 63,
                'tahun'        => 2019,
                'jumlah'       => 5,
            ],
            [
                'id'           => 84,
                'kebutuhan_id' => 63,
                'tahun'        => 2020,
                'jumlah'       => 1,
            ],
            [
                'id'           => 85,
                'kebutuhan_id' => 63,
                'tahun'        => 2021,
                'jumlah'       => 6,
            ],
            [
                'id'           => 86,
                'kebutuhan_id' => 63,
                'tahun'        => 2022,
                'jumlah'       => 6,
            ],
            [
                'id'           => 87,
                'kebutuhan_id' => 63,
                'tahun'        => 2023,
                'jumlah'       => 10,
            ],
            [
                'id'           => 88,
                'kebutuhan_id' => 63,
                'tahun'        => 2025,
                'jumlah'       => 18,
            ],
            [
                'id'           => 89,
                'kebutuhan_id' => 65,
                'tahun'        => 2022,
                'jumlah'       => 1,
            ],
            [
                'id'           => 90,
                'kebutuhan_id' => 65,
                'tahun'        => 2024,
                'jumlah'       => 2,
            ],
            [
                'id'           => 91,
                'kebutuhan_id' => 68,
                'tahun'        => 2022,
                'jumlah'       => 1,
            ],
            [
                'id'           => 92,
                'kebutuhan_id' => 70,
                'tahun'        => 2025,
                'jumlah'       => 6,
            ],
            [
                'id'           => 111,
                'kebutuhan_id' => 20,
                'tahun'        => 2026,
                'jumlah'       => 24,
            ],
        ];

        foreach ($pengadaanSarpras as $item) {
            DB::table('pengadaan_sarpras')->updateOrInsert(
                ['id' => $item['id']],
                [
                    'kebutuhan_id' => $item['kebutuhan_id'],
                    'tahun'        => $item['tahun'],
                    'jumlah'       => $item['jumlah'],
                    'updated_at'   => now(),
                ]
            );
        }
    }
}

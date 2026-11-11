<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeroBackgroundSeeder extends Seeder
{
    /**
     * Run the database seeds for Background Beranda Publik (/internal/operator/background-beranda).
     */
    public function run(): void
    {
        $backgrounds = [
            [
                'id'          => 1,
                'judul'       => 'Gedung Mako Damkartan Kota Jambi (Background Utama 1)',
                'path_gambar' => 'images/background1.png',
                'urutan'      => 1,
                'is_active'   => true,
            ],
            [
                'id'          => 2,
                'judul'       => 'Armada & Operasional Damkartan Kota Jambi (Background Utama 2)',
                'path_gambar' => 'images/background2.jpeg',
                'urutan'      => 2,
                'is_active'   => true,
            ],
            [
                'id'          => 3,
                'judul'       => 'background api',
                'path_gambar' => 'uploads/backgrounds/bg_1794361691_CjpEvzhA.jpg',
                'urutan'      => 3,
                'is_active'   => true,
            ],
        ];

        foreach ($backgrounds as $bg) {
            DB::table('hero_backgrounds')->updateOrInsert(
                ['id' => $bg['id']],
                [
                    'judul'       => $bg['judul'],
                    'path_gambar' => $bg['path_gambar'],
                    'urutan'      => $bg['urutan'],
                    'is_active'   => $bg['is_active'],
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]
            );
        }
    }
}

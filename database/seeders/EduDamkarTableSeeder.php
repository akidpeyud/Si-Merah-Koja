<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EduDamkarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('edu_damkar')->truncate();

        DB::table('edu_damkar')->insert(array (
  0 => 
  array (
    'id' => 1,
    'judul' => 'International Firefighter\'s Day, Pertaruhkan Nyawa Demi Keselamatan Orang Lain',
    'youtube_id' => 'ID5hN5Jkkws',
    'link_asli' => 'https://youtu.be/ID5hN5Jkkws?si=oS1JTSBrhg_5DePL',
    'created_at' => '2026-11-17 01:41:13',
    'updated_at' => '2026-11-17 01:41:13',
  ),
  1 => 
  array (
    'id' => 2,
    'judul' => 'Racun Api Pembunuh Api | UJUNG-UJUNGNYA DAMKAR (14/05/25) P2',
    'youtube_id' => '9z-jhHB9djc',
    'link_asli' => 'https://youtu.be/9z-jhHB9djc?si=9jQTmrgKq6NGkzpu',
    'created_at' => '2026-11-17 01:41:13',
    'updated_at' => '2026-11-17 01:41:13',
  ),
  2 => 
  array (
    'id' => 3,
    'judul' => 'Damkar 2025: Kinerja, inovasi, dan kisah di balik penyelamatan Kota jambi',
    'youtube_id' => 'oFgOc0_CxCQ',
    'link_asli' => 'https://youtu.be/oFgOc0_CxCQ?si=wQMZMNYzHg80q0JK',
    'created_at' => '2026-11-17 01:41:13',
    'updated_at' => '2026-11-17 01:41:13',
  ),
));
    }
}

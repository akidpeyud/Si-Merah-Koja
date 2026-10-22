<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FireDrillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menghapus data lama agar tidak duplikat saat di-seed ulang
        DB::table('fire_drills')->truncate();

        $data = [
            [
                'nama_instansi' => 'Rumah Sakit Ibu dan Anak Annisa',
                'tahun' => 2026,
                'tanggal_pelaksanaan' => 'Sabtu, 6 Juni 2026', 
                'tempat_pelaksanaan' => 'Aula Rumah Sakit Ibu dan Anak Annisa',
                'peserta_laki_laki' => 8,
                'peserta_perempuan' => 32,
                'nama_peserta_laki_laki' => null,
                'nama_peserta_perempuan' => null,
                'total_peserta' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_instansi' => 'Kwarda Jambi',
                'tahun' => 2026,
                'tanggal_pelaksanaan' => 'Minggu, 21 Juni 2026',
                'tempat_pelaksanaan' => 'Bumi Perkemahan ASM Sungai Gelam',
                'peserta_laki_laki' => 40,
                'peserta_perempuan' => 45,
                'nama_peserta_laki_laki' => null,
                'nama_peserta_perempuan' => null,
                'total_peserta' => 85,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_instansi' => 'Mako Binda Jambi',
                'tahun' => 2026,
                'tanggal_pelaksanaan' => 'Kamis, 25 Juni 2026',
                'tempat_pelaksanaan' => 'Mako Binda Jambi',
                'peserta_laki_laki' => 5,
                'peserta_perempuan' => 30,
                'nama_peserta_laki_laki' => null,
                'nama_peserta_perempuan' => null,
                'total_peserta' => 35,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('fire_drills')->insert($data);
    }
}
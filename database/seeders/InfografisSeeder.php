<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class InfografisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sourceDir = storage_path('app/public/seed-files/infografis');
        $targetDir = storage_path('app/public/infografis');

        if (! File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $items = [
            [
                'judul' => 'ASN BerAKHLAK Disdamkartan Kota Jambi',
                'file' => 'ig_Dd6K3V4JJk7.jpg',
            ],
            [
                'judul' => 'Penyaluran Air Bersih Gratis Call Center 112',
                'file' => 'ig_Dc8hzsuyWY3.jpg',
            ],
            [
                'judul' => 'Waspada Musim Kemarau - Hemat Air Bersih',
                'file' => 'ig_Dcik8qRyRU0.jpg',
            ],
            [
                'judul' => 'Waspada Kabut Asap - Kualitas Udara Kota Jambi',
                'file' => 'ig_Dce9dRTpQzt.jpg',
            ],
            [
                'judul' => 'Lomba Domino HUT Kemerdekaan RI Ke-81 Damkar Kota Jambi',
                'file' => 'ig_DcSMWE5JJme.jpg',
            ],
            [
                'judul' => 'Dirgahayu Republik Indonesia Ke-81',
                'file' => 'ig_DcH8t1rJEh8.jpg',
            ],
            [
                'judul' => 'Selamat Hari Pahlawan 10 November 2026',
                'file' => 'ig_Dfi1cHHp89G.jpg',
            ],
            [
                'judul' => 'Cegah Kebakaran Hutan dan Lahan (Karhutla)',
                'file' => 'ig_De6DiPsEapB.jpg',
            ],
            [
                'judul' => 'Ucapan Selamat Ulang Tahun Kepala Dinas Damkar Kota Jambi',
                'file' => 'ig_DcFGwMoysx3.jpg',
            ],
        ];

        $now = now();

        foreach ($items as $item) {
            $sourcePath = $sourceDir.DIRECTORY_SEPARATOR.$item['file'];
            $targetPath = $targetDir.DIRECTORY_SEPARATOR.$item['file'];

            if (File::exists($sourcePath) && ! File::exists($targetPath)) {
                File::copy($sourcePath, $targetPath);
            }

            $gambar = 'infografis/'.$item['file'];

            DB::table('infografis')->updateOrInsert(
                ['gambar' => $gambar],
                [
                    'judul' => $item['judul'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}

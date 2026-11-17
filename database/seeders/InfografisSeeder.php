<?php

namespace Database\Seeders;

use App\Models\Infografis;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class InfografisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        @set_time_limit(0);

        $seedDir = storage_path('app/public/seed-files/infografis');
        $publicImgDir = public_path('images/infografis');
        $targetDir = storage_path('app/public/infografis');

        foreach ([$seedDir, $publicImgDir, $targetDir] as $dir) {
            if (! File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
        }

        $items = [
            [
                'code' => 'Dd6K3V4JJk7',
                'judul' => 'ASN BerAKHLAK Disdamkartan Kota Jambi',
                'file' => 'ig_Dd6K3V4JJk7.jpg',
            ],
            [
                'code' => 'Dc8hzsuyWY3',
                'judul' => 'Penyaluran Air Bersih Gratis Call Center 112',
                'file' => 'ig_Dc8hzsuyWY3.jpg',
            ],
            [
                'code' => 'Dcik8qRyRU0',
                'judul' => 'Waspada Musim Kemarau - Hemat Air Bersih',
                'file' => 'ig_Dcik8qRyRU0.jpg',
            ],
            [
                'code' => 'Dce9dRTpQzt',
                'judul' => 'Waspada Kabut Asap - Kualitas Udara Kota Jambi',
                'file' => 'ig_Dce9dRTpQzt.jpg',
            ],
            [
                'code' => 'DcSMWE5JJme',
                'judul' => 'Lomba Domino HUT Kemerdekaan RI Ke-81 Damkar Kota Jambi',
                'file' => 'ig_DcSMWE5JJme.jpg',
            ],
            [
                'code' => 'DcH8t1rJEh8',
                'judul' => 'Dirgahayu Republik Indonesia Ke-81',
                'file' => 'ig_DcH8t1rJEh8.jpg',
            ],
            [
                'code' => 'Dfi1cHHp89G',
                'judul' => 'Selamat Hari Pahlawan 10 November 2026',
                'file' => 'ig_Dfi1cHHp89G.jpg',
            ],
            [
                'code' => 'De6DiPsEapB',
                'judul' => 'Cegah Kebakaran Hutan dan Lahan (Karhutla)',
                'file' => 'ig_De6DiPsEapB.jpg',
            ],
            [
                'code' => 'DcFGwMoysx3',
                'judul' => 'Ucapan Selamat Ulang Tahun Kepala Dinas Damkar Kota Jambi',
                'file' => 'ig_DcFGwMoysx3.jpg',
            ],
        ];

        $now = now();
        $disk = Storage::disk('public');

        foreach ($items as $item) {
            $gambar = 'infografis/'.$item['file'];
            $seedPath = $seedDir.DIRECTORY_SEPARATOR.$item['file'];
            $pubImgPath = $publicImgDir.DIRECTORY_SEPARATOR.$item['file'];

            if (! $disk->exists($gambar)) {
                $bin = null;
                if (File::exists($seedPath)) {
                    $bin = File::get($seedPath);
                } elseif (File::exists($pubImgPath)) {
                    $bin = File::get($pubImgPath);
                } else {
                    $bin = Infografis::downloadInstagramMedia($item['code']);
                }

                if ($bin) {
                    $disk->put($gambar, $bin);
                }
            }

            if ($disk->exists($gambar) && ! File::exists($pubImgPath)) {
                File::put($pubImgPath, $disk->get($gambar));
            }

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


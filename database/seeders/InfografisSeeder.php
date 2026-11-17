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

        foreach ($items as $item) {
            $seedPath = $seedDir . DIRECTORY_SEPARATOR . $item['file'];
            $pubImgPath = $publicImgDir . DIRECTORY_SEPARATOR . $item['file'];
            $targetPath = $targetDir . DIRECTORY_SEPARATOR . $item['file'];

            // 1. Salin dari seed-files atau public/images jika belum ada di storage/app/public/infografis
            if (! File::exists($targetPath)) {
                if (File::exists($seedPath)) {
                    File::copy($seedPath, $targetPath);
                } elseif (File::exists($pubImgPath)) {
                    File::copy($pubImgPath, $targetPath);
                } else {
                    // Fallback unduh otomatis dari Instagram jika file lokal belum ter-pull
                    $this->downloadFromInstagram($item['code'], $targetPath);
                }
            }

            // Pastikan public/images/infografis juga terisi sebagai fallback tanpa storage:link
            if (File::exists($targetPath) && ! File::exists($pubImgPath)) {
                File::copy($targetPath, $pubImgPath);
            }

            $gambar = 'infografis/' . $item['file'];

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

    private function downloadFromInstagram(string $code, string $destPath): void
    {
        if (! function_exists('curl_init')) {
            return;
        }

        $ch = curl_init("https://www.instagram.com/p/{$code}/media/?size=l");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
        $bin = curl_exec($ch);
        curl_close($ch);

        if (is_string($bin) && strlen($bin) > 1000) {
            File::put($destPath, $bin);
        }
    }
}

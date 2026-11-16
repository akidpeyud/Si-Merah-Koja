<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class VisiMisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $targetDir = storage_path('app/public/profil-instansi/visi-misi');
        if (! File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $sourceDir = storage_path('app/public/seed-files/visi_misi');
        if (! File::exists($sourceDir)) {
            $sourceDir = public_path('storage/seed-files/visi_misi');
        }

        $detectedName = 'Visi_Misi_Kota_Jambi_2025_2029.pdf';
        if (File::exists($sourceDir.'/'.$detectedName)) {
            $fileName = $detectedName;
        } else {
            $allFiles = File::glob($sourceDir.'/*.{pdf,jpg,jpeg,png}', GLOB_BRACE);
            $fileName = ! empty($allFiles) ? basename($allFiles[0]) : $detectedName;
        }

        $visiMisiList = [
            [
                'judul' => 'Visi dan Misi Kota Jambi Tahun 2025-2029',
                'kategori' => 'visi-misi',
                'tahun' => 2025,
                'keterangan' => 'Dokumen Visi dan Misi Pemerintah Kota Jambi Tahun 2025-2029 pada Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.',
                'file_dokumen' => 'profil-instansi/visi-misi/'.$fileName,
                'source_file' => 'seed-files/visi_misi/'.$fileName,
            ],
        ];

        $now = Carbon::now();

        foreach ($visiMisiList as $item) {
            $sourceRelative = $item['source_file'];
            unset($item['source_file']);

            $sourcePath = storage_path('app/public/'.$sourceRelative);
            if (! File::exists($sourcePath)) {
                $sourcePath = public_path('storage/'.$sourceRelative);
            }

            if (File::exists($sourcePath)) {
                $destinationPath = storage_path('app/public/'.$item['file_dokumen']);
                File::copy($sourcePath, $destinationPath);
            }

            $item['created_at'] = $now;
            $item['updated_at'] = $now;

            DB::table('profil_instansis')->updateOrInsert(
                [
                    'kategori' => $item['kategori'],
                ],
                $item
            );
        }
    }
}

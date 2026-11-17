<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProgramKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $targetDir = storage_path('app/public/profil-instansi/program-kegiatan');
        if (! File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $sourceDir = storage_path('app/public/seed-files/program_kegiatan');
        if (! File::exists($sourceDir)) {
            $sourceDir = public_path('storage/seed-files/program_kegiatan');
        }

        $detectedName = 'Program_Kegiatan_dan_Anggaran.jpg';
        if (File::exists($sourceDir.'/'.$detectedName)) {
            $fileName = $detectedName;
        } else {
            $allFiles = File::glob($sourceDir.'/*.{jpg,jpeg,png,webp,pdf}', GLOB_BRACE);
            $fileName = ! empty($allFiles) ? basename($allFiles[0]) : $detectedName;
        }

        $items = [
            [
                'judul' => 'Program, Kegiatan, dan Alokasi Anggaran Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi',
                'kategori' => 'program-kegiatan',
                'tahun' => 2026,
                'keterangan' => 'Informasi Program Penunjang Urusan Pemerintahan, Program Pencegahan/Penyelamatan Kebakaran dan Non-Kebakaran, serta Total Alokasi Anggaran Rp.19.912.876.000,00.',
                'file_dokumen' => 'profil-instansi/program-kegiatan/'.$fileName,
                'source_file' => 'seed-files/program_kegiatan/'.$fileName,
            ],
        ];

        $now = Carbon::now();

        foreach ($items as $item) {
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

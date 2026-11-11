<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class PerjanjianKerjasamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! Schema::hasTable('perjanjian_kerjasamas')) {
            return;
        }

        $now = now();

        $rows = [
            [
                'nama_perusahaan' => 'PT.KINARYA SELARAS PIRANTI',
                'nomor_pks' => '005/SBS-KSP/PKS/XI/2026',
                'tanggal_perjanjian' => '2026-11-03',
                'tahun' => 2026,
                'lama_kerjasama' => '5 Tahun',
                'pihak_pertama' => 'RIKHI ARNOLD DEFATMAN',
                'pihak_kedua' => 'MUSTARI AFFANDI,AP,ME',
                'file_dokumen' => '1794290661_6af2b3e53cee0_pks.pdf',
                'keterangan' => null,
                'created_at' => '2026-11-10 06:04:21',
                'updated_at' => '2026-11-10 06:06:33',
            ],
            [
                'nama_perusahaan' => 'RS. ST.THERESIA JAMBI',
                'nomor_pks' => '1303/RSST/TU/VIII/2025',
                'tanggal_perjanjian' => '2025-08-27',
                'tahun' => 2025,
                'lama_kerjasama' => '5 Tahun',
                'pihak_pertama' => 'Dr.Lilian Trisnawati Prasetya,MPH',
                'pihak_kedua' => 'MUSTARI AFFANDI,AP,ME',
                'file_dokumen' => '1794290763_6af2b44bbc6bd_pks.pdf',
                'keterangan' => null,
                'created_at' => '2026-11-10 06:06:03',
                'updated_at' => '2026-11-10 06:06:03',
            ],
        ];

        // Pastikan direktori tujuan upload ada
        $targetDir = public_path('uploads/pks');
        if (! File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        // Salin file dokumen dari seed-files jika ada
        $sourceDir = storage_path('app/public/seed-files/pks');
        if (! File::exists($sourceDir)) {
            $sourceDir = public_path('storage/seed-files/pks');
        }

        foreach ($rows as $item) {
            if (! empty($item['file_dokumen'])) {
                $sourcePath = $sourceDir.DIRECTORY_SEPARATOR.$item['file_dokumen'];
                $destPath = $targetDir.DIRECTORY_SEPARATOR.$item['file_dokumen'];

                if (File::exists($sourcePath) && ! File::exists($destPath)) {
                    File::copy($sourcePath, $destPath);
                }
            }
        }

        DB::table('perjanjian_kerjasamas')->truncate();
        DB::table('perjanjian_kerjasamas')->insert($rows);
    }
}

<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TupoksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $targetDir = storage_path('app/public/profil-instansi/tupoksi');
        if (! File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        // 1. Dokumen PDF Resmi Tupoksi
        $pdfFileName = 'SOTK_Dinas_Pemadam_Kebakaran_dan_Penyelamatan_Kota_Jambi_Perwal_50_2025 (1).pdf';
        $pdfSource = storage_path('app/public/seed-files/cascade_tupoksi/'.$pdfFileName);
        if (! File::exists($pdfSource)) {
            $pdfSource = public_path('storage/seed-files/cascade_tupoksi/'.$pdfFileName);
        }

        $pdfDestination = storage_path('app/public/profil-instansi/tupoksi/'.$pdfFileName);
        if (File::exists($pdfSource) && ! File::exists($pdfDestination)) {
            File::copy($pdfSource, $pdfDestination);
        }

        // 2. File Gambaran Besar Visual Tupoksi
        $imageName = 'gambaran-besar-tupoksi.jpg';
        $imageSource = storage_path('app/public/seed-files/tupoksi/'.$imageName);
        if (! File::exists($imageSource)) {
            $imageSource = public_path('storage/seed-files/tupoksi/'.$imageName);
        }

        $imageDestination = storage_path('app/public/profil-instansi/tupoksi/'.$imageName);
        if (File::exists($imageSource)) {
            File::copy($imageSource, $imageDestination);
        }

        // 3. Masukkan record Tupoksi ke database jika belum ada
        $now = Carbon::now();
        DB::table('profil_instansis')->updateOrInsert(
            [
                'kategori' => 'tupoksi',
            ],
            [
                'judul' => 'Tugas Pokok dan Fungsi (Tupoksi) Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Tugas Pokok dan Fungsi (Tupoksi) Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.',
                'file_dokumen' => 'profil-instansi/tupoksi/'.$pdfFileName,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );
    }
}

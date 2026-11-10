<?php

namespace Database\Seeders;

use App\Models\PetaJabatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PetaJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fileName = 'Peta_Jabatan_Damkartan_2026_Update.pdf';
        $sourcePath = database_path('seeders/files/'.$fileName);
        $targetDir = storage_path('app/public/peta_jabatan');
        $targetPath = $targetDir.'/'.$fileName;

        // Pastikan direktori tujuan di storage publik tersedia
        if (! File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        // Salin file dari database/seeders/files ke storage jika belum ada
        if (File::exists($sourcePath) && ! File::exists($targetPath)) {
            File::copy($sourcePath, $targetPath);
        }

        // Simpan data Peta Jabatan ke database
        PetaJabatan::updateOrCreate(
            ['judul' => 'Peta Jabatan Disdamkartan Kota Jambi 2026'],
            [
                'tahun' => '2026',
                'keterangan' => 'Dokumen resmi Peta Jabatan Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi Tahun 2026.',
                'file_dokumen' => 'peta_jabatan/'.$fileName,
            ]
        );
    }
}

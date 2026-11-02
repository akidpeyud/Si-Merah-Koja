<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CascadeTupoksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $directories = [
            storage_path('app/public/profil-instansi/cascading'),
            storage_path('app/public/profil-instansi/tupoksi'),
        ];

        foreach ($directories as $dir) {
            if (! File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
        }

        $items = [
            [
                'judul' => 'Cascading Kinerja Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi',
                'kategori' => 'cascading',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Cascading Kinerja Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.',
                'file_dokumen' => 'profil-instansi/cascading/Cascade-Renstra-1791796186239_compressed.pdf',
                'source_file' => 'seed-files/cascade_tupoksi/Cascade-Renstra-1791796186239_compressed.pdf',
            ],
            [
                'judul' => 'Tugas Pokok dan Fungsi (Tupoksi) Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi',
                'kategori' => 'tupoksi',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Tugas Pokok dan Fungsi (Tupoksi) Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.',
                'file_dokumen' => 'profil-instansi/tupoksi/SOTK_Dinas_Pemadam_Kebakaran_dan_Penyelamatan_Kota_Jambi_Perwal_50_2025 (1).pdf',
                'source_file' => 'seed-files/cascade_tupoksi/SOTK_Dinas_Pemadam_Kebakaran_dan_Penyelamatan_Kota_Jambi_Perwal_50_2025 (1).pdf',
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

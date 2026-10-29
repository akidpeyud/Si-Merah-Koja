<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SotkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $targetDir = storage_path('app/public/profil-instansi/sotk');
        if (! File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $sotkList = [
            [
                'judul' => 'Struktur Organisasi dan Tata Kerja (SOTK) Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi Tahun 2026',
                'kategori' => 'sotk',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi dan Tata Kerja (SOTK) Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi Tahun 2026.',
                'file_dokumen' => 'profil-instansi/sotk/Struktur_Organisasi_DAMKAR_Jambi_2026_dengan_Staf_kecil.pdf',
                'source_file' => 'seed-files/sotk/Struktur_Organisasi_DAMKAR_Jambi_2026_dengan_Staf_kecil.pdf',
            ],
        ];

        $now = Carbon::now();

        foreach ($sotkList as $item) {
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
                    'tahun' => $item['tahun'],
                ],
                $item
            );
        }
    }
}

<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DokumenPublikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $targetDir = storage_path('app/public/dokumen_publik');
        if (! File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $dokumens = [
            [
                'judul_dokumen' => 'RENSTRA DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA JAMBI TAHUN 2025-2029',
                'kategori'      => 'Renstra',
                'nama_file'     => 'dokumen_publik/RENSTRA DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA JAMBI TAHUN 2025-2029 (1).pdf',
                'tahun'         => 2025,
                'deskripsi'     => 'Dokumen Rencana Strategis (Renstra) Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi Tahun 2025-2029.',
                'source_file'   => 'seed-files/renja_renstra/RENSTRA DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA JAMBI TAHUN 2025-2029 (1).pdf',
            ],
            [
                'judul_dokumen' => 'DISDAMKARTAN-RENJA TAHUN 2026',
                'kategori'      => 'Renja',
                'nama_file'     => 'dokumen_publik/DISDAMKARTAN-RENJA TAHUN 2026.pdf',
                'tahun'         => 2026,
                'deskripsi'     => 'Dokumen Rencana Kerja (Renja) Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi Tahun 2026.',
                'source_file'   => 'seed-files/renja_renstra/DISDAMKARTAN-RENJA TAHUN 2026.pdf',
            ],
        ];

        $now = Carbon::now();

        foreach ($dokumens as $item) {
            $sourceRelative = $item['source_file'];
            unset($item['source_file']);

            $sourcePath = storage_path('app/public/' . $sourceRelative);
            if (! File::exists($sourcePath)) {
                $sourcePath = public_path('storage/' . $sourceRelative);
            }

            if (File::exists($sourcePath)) {
                $destinationPath = storage_path('app/public/' . $item['nama_file']);
                File::copy($sourcePath, $destinationPath);
            }

            $item['created_at'] = $now;
            $item['updated_at'] = $now;

            DB::table('dokumen_publik')->updateOrInsert(
                [
                    'kategori'      => $item['kategori'],
                    'judul_dokumen' => $item['judul_dokumen'],
                ],
                $item
            );
        }
    }
}

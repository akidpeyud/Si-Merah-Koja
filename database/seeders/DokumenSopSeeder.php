<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenSopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dokumen = [
            // ==========================================
            // Kategori: Pemadaman Kebakaran
            // (kategori = 'SOP', sub_kategori = 'Pemadaman Kebakaran')
            // ==========================================
            [
                'judul_dokumen' => 'Salinan Salinan SK KADIS-174-24 SOP PEMADAMAN',
                'kategori' => 'SOP',
                'sub_kategori' => 'Pemadaman Kebakaran',
                'nama_file' => 'Salinan Salinan SK KADIS-174-24 SOP PEMADAMAN.pdf',
                'file_path' => 'dokumen/Salinan Salinan SK KADIS-174-24 SOP PEMADAMAN.pdf',
            ],
            [
                'judul_dokumen' => 'Salinan Salinan SK KADIS-173-24 SOP LAYANAN OBJEK VITAL',
                'kategori' => 'SOP',
                'sub_kategori' => 'Pemadaman Kebakaran',
                'nama_file' => 'Salinan Salinan SK KADIS-173-24 SOP LAYANAN OBJEK VITAL.pdf',
                'file_path' => 'dokumen/Salinan Salinan SK KADIS-173-24 SOP LAYANAN OBJEK VITAL.pdf',
            ],
            [
                'judul_dokumen' => 'Salinan SOP 51 PENYELENGGARAAN DI GEDUNG DAN LAPANGAN',
                'kategori' => 'SOP',
                'sub_kategori' => 'Pemadaman Kebakaran',
                'nama_file' => 'Salinan SOP 51 PENYELENGGARAAN DI GEDUNG DAN LAPANGAN.pdf',
                'file_path' => 'dokumen/Salinan SOP 51 PENYELENGGARAAN DI GEDUNG DAN LAPANGAN.pdf',
            ],
            [
                'judul_dokumen' => 'Salinan Salinan SK SOP Pengaman Bahaya Kebakaran pd Akai DemonstrasiUnjuk Rs di Koja',
                'kategori' => 'SOP',
                'sub_kategori' => 'Pemadaman Kebakaran',
                'nama_file' => 'Salinan Salinan SK SOP Pengaman Bahaya Kebakaran pd Akai DemonstrasiUnjuk Rs di Koja.pdf',
                'file_path' => 'dokumen/Salinan Salinan SK SOP Pengaman Bahaya Kebakaran pd Akai DemonstrasiUnjuk Rs di Koja.pdf',
            ],

            // ==========================================
            // Kategori: Penyelamatan & Evakuasi
            // (kategori = 'SOP', sub_kategori = 'Penyelamatan dan Evakuasi')
            // ==========================================
            [
                'judul_dokumen' => 'Salinan SOP TAWON 174 (1)',
                'kategori' => 'SOP',
                'sub_kategori' => 'Penyelamatan dan Evakuasi',
                'nama_file' => 'Salinan SOP TAWON 174 (1).pdf',
                'file_path' => 'dokumen/Salinan SOP TAWON 174 (1).pdf',
            ],
            [
                'judul_dokumen' => 'Salinan Salinan SK 226 TIM PENANGGUNGALANGN BENCANA',
                'kategori' => 'SOP',
                'sub_kategori' => 'Penyelamatan dan Evakuasi',
                'nama_file' => 'Salinan Salinan SK 226 TIM PENANGGUNGALANGN BENCANA.pdf',
                'file_path' => 'dokumen/Salinan Salinan SK 226 TIM PENANGGUNGALANGN BENCANA.pdf',
            ],
            [
                'judul_dokumen' => 'Salinan Salinan SK KADIS-49-23 SOP INVES DAN VERIFIKASI',
                'kategori' => 'SOP',
                'sub_kategori' => 'Penyelamatan dan Evakuasi',
                'nama_file' => 'Salinan Salinan SK KADIS-49-23 SOP INVES DAN VERIFIKASI.pdf',
                'file_path' => 'dokumen/Salinan Salinan SK KADIS-49-23 SOP INVES DAN VERIFIKASI.pdf',
            ],
            [
                'judul_dokumen' => 'Salinan Salinan SK 178 KADIS SOP ADM SLRN KBKRN',
                'kategori' => 'SOP',
                'sub_kategori' => 'Penyelamatan dan Evakuasi',
                'nama_file' => 'Salinan Salinan SK 178 KADIS SOP ADM SLRN KBKRN.pdf',
                'file_path' => 'dokumen/Salinan Salinan SK 178 KADIS SOP ADM SLRN KBKRN.pdf',
            ],
        ];

        $now = Carbon::now();

        foreach ($dokumen as $item) {
            DB::table('dokumen_sop')->updateOrInsert(
                ['nama_file' => $item['nama_file']],
                array_merge($item, [
                    'updated_at' => $now,
                    'created_at' => $now,
                ])
            );
        }
    }
}

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
        $now = Carbon::now()->format('Y-m-d H:i:s');

        $dokumenSop = [
            // ==========================================================
            // DATA DOKUMEN SOP EKSISTING (Sarpras, Kepegawaian, Keuangan, Pencegahan)
            // ==========================================================
            [
                'judul_dokumen' => 'Sop sarana dan prasarana',
                'nama_file' => '1792836055_SOP_SAPRA_1.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Sarana dan Prasarana',
            ],
            [
                'judul_dokumen' => 'Sop sarana dan prasarana 2',
                'nama_file' => '1792836075_SOP_SAPRAS_2-compressed.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Sarana dan Prasarana',
            ],
            [
                'judul_dokumen' => 'Sop Umpeg',
                'nama_file' => '1792836208_SOP_UMPEG_(1)_compressed.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Kepegawaian',
            ],
            [
                'judul_dokumen' => '1. SOP RKA',
                'nama_file' => '1792836397_1._SOP_RKA_-_Copy.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Keuangan',
            ],
            [
                'judul_dokumen' => '2. SOP DPA',
                'nama_file' => '1792836419_2._SOP_DPA_-_Copy.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Keuangan',
            ],
            [
                'judul_dokumen' => '3. SOP RENSTRA OK',
                'nama_file' => '1792836446_3._SOP_RENSTRA_OK.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Keuangan',
            ],
            [
                'judul_dokumen' => '4. SOP RENJA',
                'nama_file' => '1792836464_4._SOP_RENJA.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Keuangan',
            ],
            [
                'judul_dokumen' => '5. SOP LKjIP 2023',
                'nama_file' => '1792836481_5._SOP_LKjIP_2023.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Keuangan',
            ],
            [
                'judul_dokumen' => '6. SOP Laporan Tahunan',
                'nama_file' => '1792836495_6._SOP_Laporan_Tahunan.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Keuangan',
            ],
            [
                'judul_dokumen' => '6. SOP PEMBAYARAN GAJI',
                'nama_file' => '1792836518_6._SOP_PEMBAYARAN_GAJI.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Keuangan',
            ],
            [
                'judul_dokumen' => '7. SOP PENGAJUAN DAN PEMBAYARAN TAMBAHAN PENGHASILAN',
                'nama_file' => '1792836532_7._SOP_PENGAJUAN_DAN_PEMBAYARAN_TAMBAHAN_PENGHASILAN.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Keuangan',
            ],
            [
                'judul_dokumen' => 'SOP Pemberdayaan masyarakat dan dunia usaha',
                'nama_file' => '1792836656_SOP_Pemberdayaan_masyarakat_dan_dunia_usaha_compressed.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Pencegahan',
            ],
            [
                'judul_dokumen' => 'SOP Kasi Peningkatan Kapasitas Aparatur',
                'nama_file' => '1792836703_SOP_Kasi_Peningkatan_Kapasitas_Aparatur_compressed.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Pencegahan',
            ],
            [
                'judul_dokumen' => 'SOP Kasi pencegahan dan inspeksi',
                'nama_file' => '1792836773_SOP_Kasi_pencegahan_dan_inspeksi_compressed.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Pencegahan',
            ],

            // ==========================================================
            // 8 DOKUMEN SOP BARU
            // Kategori: Pemadaman Kebakaran
            // ==========================================================
            [
                'judul_dokumen' => 'Salinan Salinan SK KADIS-174-24 SOP PEMADAMAN',
                'nama_file' => 'Salinan Salinan SK KADIS-174-24 SOP PEMADAMAN.pdf',
                'file_path' => 'dokumen/Salinan Salinan SK KADIS-174-24 SOP PEMADAMAN.pdf',
                'kategori' => 'SOP',
                'sub_kategori' => 'Pemadaman Kebakaran',
            ],
            [
                'judul_dokumen' => 'Salinan Salinan SK KADIS-173-24 SOP LAYANAN OBJEK VITAL',
                'nama_file' => 'Salinan Salinan SK KADIS-173-24 SOP LAYANAN OBJEK VITAL.pdf',
                'file_path' => 'dokumen/Salinan Salinan SK KADIS-173-24 SOP LAYANAN OBJEK VITAL.pdf',
                'kategori' => 'SOP',
                'sub_kategori' => 'Pemadaman Kebakaran',
            ],
            [
                'judul_dokumen' => 'Salinan SOP 51 PENYELENGGARAAN DI GEDUNG DAN LAPANGAN',
                'nama_file' => 'Salinan SOP 51 PENYELENGGARAAN DI GEDUNG DAN LAPANGAN.pdf',
                'file_path' => 'dokumen/Salinan SOP 51 PENYELENGGARAAN DI GEDUNG DAN LAPANGAN.pdf',
                'kategori' => 'SOP',
                'sub_kategori' => 'Pemadaman Kebakaran',
            ],
            [
                'judul_dokumen' => 'Salinan Salinan SK SOP Pengaman Bahaya Kebakaran pd Akai DemonstrasiUnjuk Rs di Koja',
                'nama_file' => 'Salinan Salinan SK SOP Pengaman Bahaya Kebakaran pd Akai DemonstrasiUnjuk Rs di Koja.pdf',
                'file_path' => 'dokumen/Salinan Salinan SK SOP Pengaman Bahaya Kebakaran pd Akai DemonstrasiUnjuk Rs di Koja.pdf',
                'kategori' => 'SOP',
                'sub_kategori' => 'Pemadaman Kebakaran',
            ],

            // ==========================================================
            // Kategori: Penyelamatan & Evakuasi
            // ==========================================================
            [
                'judul_dokumen' => 'Salinan SOP TAWON 174 (1)',
                'nama_file' => 'Salinan SOP TAWON 174 (1).pdf',
                'file_path' => 'dokumen/Salinan SOP TAWON 174 (1).pdf',
                'kategori' => 'SOP',
                'sub_kategori' => 'Penyelamatan dan Evakuasi',
            ],
            [
                'judul_dokumen' => 'Salinan Salinan SK 226 TIM PENANGGUNGALANGN BENCANA',
                'nama_file' => 'Salinan Salinan SK 226 TIM PENANGGUNGALANGN BENCANA.pdf',
                'file_path' => 'dokumen/Salinan Salinan SK 226 TIM PENANGGUNGALANGN BENCANA.pdf',
                'kategori' => 'SOP',
                'sub_kategori' => 'Penyelamatan dan Evakuasi',
            ],
            [
                'judul_dokumen' => 'Salinan Salinan SK KADIS-49-23 SOP INVES DAN VERIFIKASI',
                'nama_file' => 'Salinan Salinan SK KADIS-49-23 SOP INVES DAN VERIFIKASI.pdf',
                'file_path' => 'dokumen/Salinan Salinan SK KADIS-49-23 SOP INVES DAN VERIFIKASI.pdf',
                'kategori' => 'SOP',
                'sub_kategori' => 'Penyelamatan dan Evakuasi',
            ],
            [
                'judul_dokumen' => 'Salinan Salinan SK 178 KADIS SOP ADM SLRN KBKRN',
                'nama_file' => 'Salinan Salinan SK 178 KADIS SOP ADM SLRN KBKRN.pdf',
                'file_path' => 'dokumen/Salinan Salinan SK 178 KADIS SOP ADM SLRN KBKRN.pdf',
                'kategori' => 'SOP',
                'sub_kategori' => 'Penyelamatan dan Evakuasi',
            ],
        ];

        foreach ($dokumenSop as $item) {
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

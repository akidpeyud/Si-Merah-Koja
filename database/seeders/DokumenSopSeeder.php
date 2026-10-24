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
        $dokumenSop = [
            // ==========================================
            // Kategori: Pemadaman Kebakaran
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

            // ==========================================
            // Kategori: Sarana dan Prasarana
            // ==========================================
            [
                'id' => 1,
                'judul_dokumen' => 'Sop sarana dan prasarana',
                'nama_file' => '1792836055_SOP_SAPRA_1.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Sarana dan Prasarana',
                'created_at' => '2026-10-24 10:00:55',
                'updated_at' => '2026-10-24 10:00:55',
            ],
            [
                'id' => 2,
                'judul_dokumen' => 'Sop sarana dan prasarana 2',
                'nama_file' => '1792836075_SOP_SAPRAS_2-compressed.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Sarana dan Prasarana',
                'created_at' => '2026-10-24 10:01:15',
                'updated_at' => '2026-10-24 10:01:15',
            ],

            // ==========================================
            // Kategori: Kepegawaian
            // ==========================================
            [
                'id' => 3,
                'judul_dokumen' => 'Sop Umpeg',
                'nama_file' => '1792836208_SOP_UMPEG_(1)_compressed.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Kepegawaian',
                'created_at' => '2026-10-24 10:03:28',
                'updated_at' => '2026-10-24 10:03:28',
            ],

            // ==========================================
            // Kategori: Keuangan
            // ==========================================
            [
                'id' => 4,
                'judul_dokumen' => '1. SOP RKA',
                'nama_file' => '1792836397_1._SOP_RKA_-_Copy.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Keuangan',
                'created_at' => '2026-10-24 10:06:37',
                'updated_at' => '2026-10-24 10:06:37',
            ],
            [
                'id' => 5,
                'judul_dokumen' => '2. SOP DPA',
                'nama_file' => '1792836419_2._SOP_DPA_-_Copy.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Keuangan',
                'created_at' => '2026-10-24 10:06:59',
                'updated_at' => '2026-10-24 10:06:59',
            ],
            [
                'id' => 6,
                'judul_dokumen' => '3. SOP RENSTRA OK',
                'nama_file' => '1792836446_3._SOP_RENSTRA_OK.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Keuangan',
                'created_at' => '2026-10-24 10:07:26',
                'updated_at' => '2026-10-24 10:07:26',
            ],
            [
                'id' => 7,
                'judul_dokumen' => '4. SOP RENJA',
                'nama_file' => '1792836464_4._SOP_RENJA.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Keuangan',
                'created_at' => '2026-10-24 10:07:44',
                'updated_at' => '2026-10-24 10:07:44',
            ],
            [
                'id' => 8,
                'judul_dokumen' => '5. SOP LKjIP 2023',
                'nama_file' => '1792836481_5._SOP_LKjIP_2023.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Keuangan',
                'created_at' => '2026-10-24 10:08:01',
                'updated_at' => '2026-10-24 10:08:01',
            ],
            [
                'id' => 9,
                'judul_dokumen' => '6. SOP Laporan Tahunan',
                'nama_file' => '1792836495_6._SOP_Laporan_Tahunan.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Keuangan',
                'created_at' => '2026-10-24 10:08:15',
                'updated_at' => '2026-10-24 10:08:15',
            ],
            [
                'id' => 10,
                'judul_dokumen' => '6. SOP PEMBAYARAN GAJI',
                'nama_file' => '1792836518_6._SOP_PEMBAYARAN_GAJI.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Keuangan',
                'created_at' => '2026-10-24 10:08:38',
                'updated_at' => '2026-10-24 10:08:38',
            ],
            [
                'id' => 11,
                'judul_dokumen' => '7. SOP PENGAJUAN DAN PEMBAYARAN TAMBAHAN PENGHASILAN',
                'nama_file' => '1792836532_7._SOP_PENGAJUAN_DAN_PEMBAYARAN_TAMBAHAN_PENGHASILAN.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Keuangan',
                'created_at' => '2026-10-24 10:08:52',
                'updated_at' => '2026-10-24 10:08:52',
            ],

            // ==========================================
            // Kategori: Pencegahan
            // ==========================================
            [
                'id' => 12,
                'judul_dokumen' => 'SOP Pemberdayaan masyarakat dan dunia usaha',
                'nama_file' => '1792836656_SOP_Pemberdayaan_masyarakat_dan_dunia_usaha_compressed.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Pencegahan',
                'created_at' => '2026-10-24 10:10:56',
                'updated_at' => '2026-10-24 10:12:01',
            ],
            [
                'id' => 13,
                'judul_dokumen' => 'SOP Kasi Peningkatan Kapasitas Aparatur',
                'nama_file' => '1792836703_SOP_Kasi_Peningkatan_Kapasitas_Aparatur_compressed.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Pencegahan',
                'created_at' => '2026-10-24 10:11:43',
                'updated_at' => '2026-10-24 10:11:43',
            ],
            [
                'id' => 14,
                'judul_dokumen' => 'SOP Kasi pencegahan dan inspeksi',
                'nama_file' => '1792836773_SOP_Kasi_pencegahan_dan_inspeksi_compressed.pdf',
                'file_path' => null,
                'kategori' => 'SOP',
                'sub_kategori' => 'Pencegahan',
                'created_at' => '2026-10-24 10:12:53',
                'updated_at' => '2026-10-24 10:12:53',
            ],
        ];

        $now = Carbon::now();

        foreach ($dokumenSop as $item) {
            // Jika data memiliki 'id', gunakan 'id' sebagai kunci pencarian updateOrInsert
            // Jika tidak, gunakan 'nama_file'
            $uniqueKey = isset($item['id']) ? ['id' => $item['id']] : ['nama_file' => $item['nama_file']];

            // Tambahkan timestamp otomatis jika belum ada di dalam array item
            if (!isset($item['created_at'])) {
                $item['created_at'] = $now;
            }
            if (!isset($item['updated_at'])) {
                $item['updated_at'] = $now;
            }

            DB::table('dokumen_sop')->updateOrInsert($uniqueKey, $item);
        }
    }
}
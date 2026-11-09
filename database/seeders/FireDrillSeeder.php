<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class FireDrillSeeder extends Seeder
{
    /**
     * Isi data pelatihan pemadam kebakaran (Fire Drill) tahun 2023, 2024, 2025, dan 2026 beserta SPT 2026.
     */
    public function run(): void
    {
        if (! Schema::hasTable('fire_drills')) {
            return;
        }

        $now = now();

        /**
         * Format ringkas tiap baris:
         * [tahun, nama_instansi, tanggal_pelaksanaan, tempat_pelaksanaan, total_peserta, nama_penanggung_jawab?, no_telepon?, surat_perintah_tugas?]
         *
         * @var array<int, array{0: int, 1: string, 2: string, 3: string, 4: int, 5?: string|null, 6?: string|null, 7?: string|null}>
         */
        $rows = [
            // =========================================================
            // TAHUN 2023 (19 Instansi - 1.358 Peserta)
            // =========================================================
            [2023, 'Menara Mahligai', '10 Desember 2023', 'Jambi Paradise', 48],
            [2023, 'Kantor Pencarian dan Pertolongan Kelas B Jambi', '19 September 2023', 'Aula Kantor Pencarian dan Pertolongan Kelas B Jambi', 30],
            [2023, 'BPJS Kesehatan Cabang Jambi', '11 Agustus 2023', 'Aula Kantor BPJS Kesehatan Cabang Jambi', 35],
            [2023, 'BPSDM Provinsi Jambi', '29 November – 07 Desember 2023', 'Kantor BPSDM Provinsi Jambi', 30],
            [2023, 'Yello Hotel Jambi', '06 – 07 Agustus 2023', 'Yello Hotel Jambi', 45],
            [2023, 'Kantor Pelayanan Pajak Pratama Jambi Cabang Pelayangan', '21 September 2023', 'Kantor Pelayanan Pajak Pratama Jambi Cabang Pelayangan', 40],
            [2023, 'Kantor Pelayanan Pajak Pratama Jambi Telanaipura', '29 September 2023', 'Kantor Pelayanan Pajak Pratama Jambi Telanaipura', 45],
            [2023, 'Kejaksaan Tinggi Jambi', '23 Agustus 2023', 'Aula Jaksa Agung Lantai IV Kejaksaan Tinggi Jambi', 30],
            [2023, 'Perumdam Tirta Mayang Kota Jambi', '30 September - 07 Oktober 2023', 'Aula Perumdam Tirta Mayang Kota Jambi', 60],
            [2023, 'PT. Mutiara Medical Service (PERMEDIC)', '17- 26 Agustus 2023', 'Abadi Hotel dan Convention Jambi', 120],
            [2023, 'PT. PLN Indonesia Power (UPDK Jambi)', '25-26 September 2023', 'PT. PLN Indonesia Power (UPDK Jambi) ULPL Payo Selincah dan ULPL Sei. Gelam', 60],
            [2023, 'PT. Rimba Palma Sejahtera Lestari', '12 Oktober 2023', 'PT. Rimba Palma Sejahtera Lestari', 30],
            [2023, 'RSUD H. Abdul Manap Kota Jambi', '17 Oktober 2023', 'RSUD H. Abdul Manap Kota Jambi', 55],
            [2023, 'RS. Baiturrahim Jambi', '23-24 September 2023', 'Aula RS. Baiturrahim Jambi', 300],
            [2023, 'RS. Siloam', '16 Desember 2023', 'RS. Siloam', 45],
            [2023, 'RSUD H. Aburrahman Sayoeti', '28 Oktober - 02 November 2023', 'Aula RSUD H. Aburrahman Sayoeti', 300],
            [2023, 'Rumah Kito Resort Hotel Jambi BYWH', '23 Oktober 2023', 'Rumah Kito Resort Hotel Jambi BYWH', 30],
            [2023, 'PT. Anugerah Ilahi Sentiana SPBU 24.461.51', '28 September 2023', 'PT. Anugerah Ilahi Sentiana SPBU 24.461.51', 20],
            [2023, 'PT. Unilever Indonesia. Tbk.', '08 September 2023', 'PT. Unilever Indonesia. Tbk.', 35],

            // =========================================================
            // TAHUN 2024 (15 Instansi - 803 Peserta)
            // =========================================================
            [2024, 'PT. HUTAMA-WIKA-BAP KSO', '3 Februari 2024', 'Kantor HUTAMA-WIKA-BAP KSO Paal 18 Sebapo.', 50],
            [2024, 'PT. PLN (Persero) UPT Jambi', '5 & 6 Februari 2024', 'Kantor PT. PLN (Persera) UPT Jambi..', 35],
            [2024, 'PT. PLN UP3 Jambi', '12 Februari 2024', 'Kantor PLN UP3 Jambi Jl. Urip Sumoharjo No.2 Sei Putri Kota Jambi', 40],
            [2024, 'UMKM Pertamina Patra Niaga', '26 Februari 2024', 'Halaman Kantor Camat Paal Merah Kota Jambi', 25],
            [2024, 'Direktorat Kepolisian Perairan dan Udara Polda Jambi', '2 Mei 2024', 'Kepolisian Perairan dan Udara Polda Jambi', 20],
            [2024, 'Klinik Pratama KB Angso Duo', '14 Mei 2024', 'Halaman Kantor DPPKB Kota Jambi.', 30],
            [2024, 'BPJS Cabang Jambi', '22 Agustus 2024', 'Kantor BPJS cabang Jambi', 30],
            [2024, 'PLN Indonesia Power UBP Jambi', '3 & 5 September 2024', 'PLN Indonesia Power UBP Jambi', 60],
            [2024, 'Lembaga Pemasyarakatan Kelas II A Jambi', '3 Oktober 2024', 'LP Kelas IIA Jambi', 30],
            [2024, 'PT. Cabang Jasa Rahaja', '4 Oktober 2024', 'Kantor Cabang PT. Jasa Rahaja', 28],
            [2024, 'Yello Hotel Jambi', '5 Oktober 2024', 'Hotel Yellow', 40],
            [2024, 'RSUD HAS Jambi', '23 & 24 Oktober 2024', 'RSUD HAS Jambi', 300],
            [2024, 'Pengawasan dan Pelayanan Bea dan Cukai', '24 Nopember 2024', 'Kantor Pengawasan dan Pelayanan Bea dan Cukai', 45],
            [2024, 'PT. Daqing Jaya Petroleum Enginering', '25 & 26 Nopember 2024', 'PT. Daqing Jaya', 40],
            [2024, 'Redkar Muaro Sabak', '24 Desember 2024', 'Kantor Camat Gragai Muaro Sabak Tanjabtim', 30],

            // =========================================================
            // TAHUN 2025 (22 Instansi - 1.841 Peserta)
            // =========================================================
            [2025, 'PT. PLN UPT Jambi', '3 & 4 Februari 2025', 'Aula PLN UPT Jambi', 40],
            [2025, 'PT. PLN UP3 Jambi', '7 Februari 2025', 'Aula PT. PLN UP3 Jambi', 50],
            [2025, 'PT. Sungai Bahar Pasific Utama', '25 Februari 2025', 'Aula PT. Sungai Bahar Pasific Utama', 35],
            [2025, 'PT Pertamina Gas Central Sumatera Area', '26 & 27 Februari 2025', 'Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi', 30],
            [2025, 'BPKP Perwakilan Provinsi Jambi', '26 April 2025', 'Aula BPKP Provinsi Jambi', 45],
            [2025, 'Lembaga Pemasyarakatan Kelas IIa Jambi', '16 Juni 2025', 'Lapangan LP. Kelas IIa Jambi', 60],
            [2025, 'BPJS Kesehatan Cabang Jambi', '20 Juli 2025', 'Aula BPJS Cabang Jambi', 40],
            [2025, 'PT. Hutama Karya (Persero) Divisi Pembangunan Jalan Tol Ruas Betung-Tempino-Jambi', '30 Juli 2025', 'Aula PT. Hutama Karya', 30],
            [2025, 'Rumah Sakit Umum Kambang', '7 Agustus 2025', 'Aula Rumah Sakit Umum Kambang', 100],
            [2025, 'PDAM Tirta Mayang', '23 Agustus 2025', 'Aula PDAM Tirta Mayang', 35],
            [2025, 'PT. Kinarya Selaras Piranti (KSP) TTC Jambi', '16 September 2025', 'Aula TTC Jambi', 30],
            [2025, 'RSUD H. Abdurrahman Sayoeti Kota Jamb', '20 & 22 September 2025', 'Aula RSUD HAS Kota Jambi', 300],
            [2025, 'SPPG Kota Baru', '8 November 2025', 'SPPG Kota Baru', 45],
            [2025, 'Hotel Yellow Jambi', '11 November 2025', 'Aula Yellow Jambi', 40],
            [2025, 'Pengadilan Negeri Jambi', '28 November 2025', 'Aula Pengadilan Negeri Jambi', 50],
            [2025, 'RSUD H. Abdul Manap', '2, 3 & 4 Desember 2025', 'Aula RSUD. H. Abdul Manap', 450],
            [2025, 'PT. Jambi Bangun Bara Persada ( SPBU 24.361.08 )', '6 Desember 2025', 'SPBU 24.361.08', 12],
            [2025, 'RS. Baiturrahim Jambi', '10 & 11 Desember 2025', 'Aula RS. Baiturrahim Jambi', 280],
            [2025, 'PT. Jambi Lestari Internasional.', '11 Desember 2025', 'Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi', 35],
            [2025, 'Siloam Hospital Jambi', '13 Desember 2025', 'Siloam Hospital', 60],
            [2025, 'SPPG Sijenjang Jambi Timur', '19 Desember 2025', 'SPPG Sijenjang Jambi Timur', 45],
            [2025, 'PT. Intisumber Hasil Sempurna Global.', '5 Desember 2025', 'PT. Intisumber Hasil Sempurna Global.', 29],

            // =========================================================
            // TAHUN 2026 (19 Instansi - 807 Peserta - 16 SPT)
            // =========================================================
            [2026, 'SPPG Paal Merah Jambi Selatan Polresta Jambi', 'Senin, 16 Maret 2026', 'SPPG Paal Merah Jambi Selatan Polresta Jambi', 14, 'Belum ad', '0000', '1794193325_6af137ad07ff6_spt.pdf'],
            [2026, 'Pengadilan Tata Usaha Negara Jambi', 'Jumat, 05 Juni 2026', 'Lapangan Tengah Pengadilan Tata Usaha Negara Jambi', 25, 'Maya Sari', '081278261024', '1794193379_6af137e3bb244_spt.pdf'],
            [2026, 'Rumah Sakit Ibu dan Anak Annisa', 'Sabtu, 6 Juni 2026', 'Aula Rumah Sakit Ibu dan Anak Annisa', 40, 'Belum ad', '0000', '1794193419_6af1380b5f9ed_spt.pdf'],
            [2026, 'BKPSDMD Kota Jambi', 'Senin, 08 Juni 2026', 'Aula BKPSDMD Kota Jambi', 25],
            [2026, 'Rumah Sakit TK. III 02.06.01 dr. Bratanata', "Jum'at, 12 Juni 2026", 'Lapangan Apel Denkesyah 02.04.02 Jambi', 35, 'Belum ad', '00000', '1794195036_6af13e5c05f06_spt.pdf'],
            [2026, 'Kwarda Jambi', 'Minggu, 21 Juni 2026', 'Bumi Kerkemahan ASM Sungai Gelam', 85, 'Ranti Ernawati, S.Pt.,M.Pd', '081335125387', '1794194964_6af13e1463135_spt.pdf'],
            [2026, 'Mako Binda Jambi', 'Kamis, 25 Juni 2026', 'Mako Binda Jambi', 35, 'Belum ad', '00000', '1794194888_6af13dc826649_spt.pdf'],
            [2026, 'Komando Daerah Militer XX/Tuanku Imam Bonjol Komando Resor Militer 042/Garuda Putih.', "Jum'at, 3 Juli 2026", 'Rupat Sopsrem 042/Gapu dan Lapangan Korem 042/Gapu', 40, 'Belum ad', '00000', '1794194818_6af13d829c083_spt.pdf'],
            [2026, 'Rumah Sakit Mitra Jambi', "Jum'at, 14 Agustus 2026", 'Rumah Sakit Mitra Jambi', 30, 'Belum ad', '00000', '1794194753_6af13d41ca878_spt.pdf'],
            [2026, 'RTMC Ditlantas Polda Jambi', 'Kamis, 27 Agustus 2026', 'Ruang Vicon Gedung RTMC Ditlantas Polda Jambi', 50, 'Belum ad', '00000', '1794194716_6af13d1cc4b4c_spt.pdf'],
            [2026, 'Pertamina EP Field Jambi', 'Kamis, 27 Agustus 2026', 'Rumah Dinas Perusahaan Pertamina EP Field Jambi', 40, 'Belum ad', '00000', '1794194448_6af13c10e4a13_spt.pdf'],
            [2026, 'Polda Jambi', "Jum'at, 11 September 2026", 'Aula Lantai 4 Gedung A Polda Jambi dan Lapangan Hitam Polda Jambi', 40, 'Belum ad', '00000', '1794194540_6af13c6cbbdba_spt.pdf'],
            [2026, 'PLN Indonesia Power UPB Jambi', 'Selasa, Kamis, 22.24 September 2026', 'Kantor UPB Jambi dan UP Payo Selincah dan UP PLTMG Sei Gelam', 57],
            [2026, 'SMK Teknologi Penerbangan Indonesia Jambi', 'Jumat, 25 September 2026', 'SMK Teknologi Penerbangan Indonesia Jambi', 30],
            [2026, 'Dinas Pekerjaan Umum dan Tata Ruang Prov. Jambi', 'Kamis, 22 Oktober 2026', 'Dinas Pekerjaan Umum dan Tata Ruang Prov. Jambi', 35, 'Belum ad', '00000', '1794194262_6af13b563646e_spt.pdf'],
            [2026, 'Yellow Hotel Jambi', 'Selasa, 13 Oktober 2026', 'Yellow Hotel Jambi', 35, 'Belum ad', '00000', '1794194151_6af13ae70f8e7_spt.pdf'],
            [2026, 'DWP Dinas Pekerjaan Umum dan Tata Ruang Prov. Jambi', 'Senin, 2 November 2026', 'Dinas Pekerjaan Umum dan Tata Ruang Prov. Jambi', 160, 'Belum ad', '00000', '1794194066_6af13a92cc2b3_spt.pdf'],
            [2026, 'PT. Kinarya Selaras Piranti (PT.KSP) TTC Jambi', 'Selasa, 3 November 2026', 'PT. Kinarya Selaras Piranti (PT.KSP) TTC Jambi', 31, 'Belum ad', '00000', '1794193980_6af13a3c63512_spt.pdf'],
            [2026, 'SMA Negeri 11 Kota Jambi', 'Jumat, 6 November 2026', 'SMA Negeri 11 Kota Jambi', 0, 'Belum ad', '0000', '1794193827_6af139a3c865b_spt.pdf'],
        ];

        $hasPenanggungJawab = Schema::hasColumn('fire_drills', 'nama_penanggung_jawab');
        $hasNoTelepon = Schema::hasColumn('fire_drills', 'no_telepon');
        $hasSpt = Schema::hasColumn('fire_drills', 'surat_perintah_tugas');

        $targetDir = public_path('uploads/fire_drill');
        if ($hasSpt && ! File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $sourceDir = storage_path('app/public/seed-files/fire_drill');
        if (! File::exists($sourceDir)) {
            $sourceDir = public_path('storage/seed-files/fire_drill');
        }

        $payload = [];
        foreach ($rows as $row) {
            $sptFile = $row[7] ?? null;

            if ($hasSpt && $sptFile !== null) {
                $sourcePath = $sourceDir.DIRECTORY_SEPARATOR.$sptFile;
                $destPath = $targetDir.DIRECTORY_SEPARATOR.$sptFile;

                if (File::exists($sourcePath)) {
                    File::copy($sourcePath, $destPath);
                }
            }

            $item = [
                'tahun' => $row[0],
                'nama_instansi' => $row[1],
                'tanggal_pelaksanaan' => $row[2],
                'tempat_pelaksanaan' => $row[3],
                'total_peserta' => $row[4],
                'created_at' => $now,
                'updated_at' => $now,
            ];

            if ($hasPenanggungJawab) {
                $item['nama_penanggung_jawab'] = $row[5] ?? null;
            }
            if ($hasNoTelepon) {
                $item['no_telepon'] = $row[6] ?? null;
            }
            if ($hasSpt) {
                $item['surat_perintah_tugas'] = $sptFile;
            }

            $payload[] = $item;
        }

        DB::table('fire_drills')->truncate();
        DB::table('fire_drills')->insert($payload);
    }
}

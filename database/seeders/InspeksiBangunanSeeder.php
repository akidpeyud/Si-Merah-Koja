<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InspeksiBangunanSeeder extends Seeder
{
    /**
     * Isi data Inspeksi Bangunan Gedung dan Lingkungan dari sheet tahun 2025 (118 bangunan).
     */
    public function run(): void
    {
        if (! Schema::hasTable('inspeksi_bangunans')) {
            return;
        }

        $now = now();

        /**
         * Format tiap baris:
         * [nama_tempat, jenis_usaha, kualifikasi_bangunan, resiko_kebakaran, luas_bangunan, alamat, nama_penanggung_jawab, no_telepon, sistem_proteksi_kebakaran, tanggal_inspeksi]
         *
         * @var array<int, array{0: string, 1: string, 2: string|null, 3: string|null, 4: string|null, 5: string|null, 6: string|null, 7: string|null, 8: string|null, 9: string|null}>
         */
        $rows = [
            ['TK PEMBINA 2', 'SEKOLAH', 'Rendah', 'Rendah', '328 m²', 'Jalan P.Hidayat Lrg. Siswa RT.06 Kel. Suka Karya Kec.Kota Baru', null, null, 'Tidak Memenuhi Syarat', '2025-01-22'],
            ['TK AL AHSAN', 'SEKOLAH', 'Rendah', 'Rendah', '128 m²', 'Jl. Sunan Gunung Jati RT. 29 Kel. Kenali Asam Bawah Kec. Kota Baru', null, null, 'Tidak Memenuhi Syarat', '2025-01-22'],
            ['TK MUTIARA HATI', 'SEKOLAH', 'Rendah', 'Rendah', '160 m²', 'Jl. Sunan Kali Jaga RT. 16 NO. 79 Kel. Simpang III Sipin Kec. Kota Baru', null, null, 'Tidak Memenuhi Syarat', '2025-01-22'],
            ['TK-KB-TPA AS-SHOFA', 'SEKOLAH', 'Rendah', 'Rendah', '210 m²', 'Jl. Sari Bakti III RT.37 Kelurahan Bagan Pete Kecamatan Alam Barajo.', null, null, 'Tidak Memenuhi Syarat', '2025-01-30'],
            ['TK RAUDATUL ATFAL BAITURRAHMAH', 'SEKOLAH', 'Rendah', 'Rendah', '120 m²', 'Perumahan Baugenville Blok FG RT.25 RW.03 Kelurahan Kenali Besar Kecamatan Alam Barajo', null, null, 'Tidak Memenuhi Syarat', '2025-01-30'],
            ['TK As-Salam', 'SEKOLAH', 'Rendah', 'Rendah', '428 m²', 'Jl. SK. Syahbuddin, Mayang Mangurai, Kec. Alam Barajo, Kota Jambi, Jambi.', null, null, 'Tidak Memenuhi Syarat', '2025-01-30'],
            ['HOLYKIDS', 'SEKOLAH', 'Rendah', 'Rendah', '256 m²', 'Jl.Lingkar Barat 3 Rt.20 Kel.Simpang Rimbo Kec.Alam Barajo, Kota Jambi Jambi.', null, null, 'Tidak Memenuhi Syarat', '2025-01-30'],
            ['TK RAUDAHTUL ATFAL AL IRSYAD', 'SEKOLAH', 'Rendah', 'Rendah', '126 m²', 'Jl.Abdul Muis RT.12 No.39 Kelurahan Lingkar Selatan, Kota Jambi.', null, null, 'Tidak Memenuhi Syarat', '2025-02-02'],
            ['SDS STELLA MARIS SCHOOL', 'SEKOLAH', 'Sedang', 'Sedang', '1800 m²', 'Jl.Kol. Pol. M. Taher No. 03, Talang Banjar, Kecamatan Jambi Timur, Kota Jambi', 'Yayasan Cahaya Trinitas Kudus', null, 'Memenuhi Syarat dengan Catatan', '2025-02-02'],
            ['TK YAYASAN NURUL YAQIN', 'SEKOLAH', 'Rendah', 'Rendah', '36 m²', 'Jl. Soekarno Hatta Lrt. Karya Budaya No.20 Kel. Paal Merah', null, null, 'Tidak Memenuhi Syarat', '2025-02-02'],
            ['TK Aisyiyah Bustanul Athfal 1', 'SEKOLAH', 'Rendah', 'Rendah', null, null, null, null, null, '2025-02-02'],
            ['INFINITY HOTEL', 'HOTEL', 'Tinggi', 'Tinggi', '4309.985 m²', 'Jl. Sultan Thaha Syaifuddin RT. 06 Kelurahan Pasar Jambi Kecamatan Pasar Jambi Kota Jambi', 'PT. Fortuna Halim Jaya Abadi', null, 'Memenuhi Syarat dengan Catatan', '2025-02-06'],
            ['Sekolah TK Qur’an Alifatma', 'SEKOLAH', 'Rendah', 'Rendah', '256 m²', 'Jl. Sunan Gn. Jati, Kenali Asam Bawah, Kec. Kota Baru, Kota Jambi Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-02-10'],
            ['SDN 63/IV KOTA JAMBI', 'SEKOLAH', 'Rendah', 'Rendah', '151.5 m²', 'Jl. Sunan Giri RT.09 Kelurahan Simpang III Sipin', null, null, 'Tidak Memenuhi Syarat', '2025-02-10'],
            ['RSUD RADEN MATAHER', 'RUMAH SAKIT', 'Sedang', 'Tinggi', '41590 m²', 'Jl. Letjen Suprapto Kelurahan Teanaipura Kecamatan Telanaipura Kota Jambi.', 'Pemerintah Provinsi Jambi', null, 'Tidak Memenuhi Syarat', '2025-02-13'],
            ['SLB NEGERI PROVINSI', 'SEKOLAH', 'Rendah', 'Rendah', '5242 m²', 'Jl. Depati Parbo, Pematang Sulur, Kec. Telanaipura, Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-02-13'],
            ['PT. Trona sentosa lestari', 'GUDANG', 'Rendah', 'Tinggi', '5120 m²', 'Jl. Orang Kayo Pingai Lrg. Masjid No. 64 RT.009 Kelurahan Talang Banjar Kecamatan Jambi Timur Kota Jambi.', 'Eddy Sugiman', null, 'Tidak Memenuhi Syarat', '2025-02-20'],
            ['Mandala Swalayan Pasar', 'MALL', 'Rendah', 'Tinggi', '1776 m²', 'Jl. Mr. Assa’at No.10 Blok A RT.22 Kelurahan Sungai Asam Kecamatan Pasar Jambi Kota Jambi', 'Didi Bongsu', null, 'Memenuhi Syarat dengan Catatan', '2025-03-04'],
            ['Mandala Mart', 'MALL', 'Rendah', 'Tinggi', '5000 m²', 'Jl. Sultan Hasanuddin RT.25 Kel. Talang Bakung Kec. Paal Merah, Kota Jambi', 'Evi Bongsu', null, 'Memenuhi Syarat dengan Catatan', '2025-03-04'],
            ['Meranti Swalayan', 'MALL', 'Sedang', 'Tinggi', '6634 m²', 'Jl. Guru Djamin Datuk Bagindo Kelurahan Talang Banjar Kecamatan Jambi Timur Kota Jambi', 'Didi Bongsu', null, 'Memenuhi Syarat dengan Catatan', '2025-03-04'],
            ['PT. baja abadi indonesia', 'GUDANG', 'Rendah', 'Sedang', '2863 m²', 'Jl. Yos Sudarso Kel. Sijinjang Kec. Jambi Timur, Kota Jambi', 'PT. Baja Abadi Indonesia', null, 'Tidak Memenuhi Syarat', '2025-03-05'],
            ['sekolah adhyaksa', 'SEKOLAH', 'Rendah', 'Rendah', '7286 m²', 'Jl. Jenderal Urip Sumoharjo No.33, Sungai Putri, Kec. Telanaipura, Kota Jambi', 'Yayasan Tridaya Warga Kejaksaan RI Perwakilan Jambi', null, 'Memenuhi Syarat dengan Catatan', '2025-03-14'],
            ['TK AL FALAH', 'SEKOLAH', 'Rendah', 'Rendah', '3969 m²', 'Jl. HOS.Cokroaminoto No.4, Kelurahan Selamat, Kecamatan Danau Sipin, Kota Jambi, Jambi.', null, null, 'Tidak Memenuhi Syarat', '2025-04-04'],
            ['TK Raudatul Athfal Al-Ikhlash', 'SEKOLAH', 'Rendah', 'Rendah', '90 m²', 'Jl. Serunai Malam III RT. 05 No. 268 Kel. Suka Karya Kec. Kota Baru Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-04-05'],
            ['TK NURUL ILMI 2', 'SEKOLAH', 'Rendah', 'Rendah', '171 m²', 'Jl. Syech Mahmud RT. 16 Kel. Kenali Besar Kec. Alam Barajo Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-04-15'],
            ['BKKBN PROVINSI', 'KANTOR', 'Rendah', 'Tinggi', '9029 m²', 'Jl. Jenderal Urip Sumoharjo No.33, Kel. Sungai Putri, Kec. Telanaipura, Kota Jambi', 'Kementerian Kependudukan dan Pembangunan Keluarga', null, 'Tidak Memenuhi Syarat', '2025-04-15'],
            ['TK,SD,SMP,SMA KARUNIA GLOBAL', 'SEKOLAH', 'Rendah', 'Rendah', '1054 m²', 'Jl. Tidore No.08 RT 23 Kelurahan Kebun Handil Kec. Jelutung, Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-04-16'],
            ['RS RAPHA THERESIA', 'RUMAH SAKIT', 'Sedang', 'Tinggi', '11377 m²', 'Jl. Kardinal Damojuwono, Kelurahan Kenali Asam Atas, Kec. Kota Baru, Kota Jambi.', 'Maria Marcia L. Marimba', null, 'Memenuhi Syarat', '2025-04-24'],
            ['TK PEMBINA 1', 'SEKOLAH', 'Rendah', 'Rendah', '144 m²', 'Jl. Ade Irma Kel.Sungai putri Kec. Danau Sipin', null, null, 'Tidak Memenuhi Syarat', '2025-04-25'],
            ['HW HELEN\'S PLAY MART', 'HIBURAN', 'Rendah', 'Tinggi', '34000 m²', 'Jl.Sultan Thaha No.17 Kelurahan Pasar Kecamatan Pasar, Kota Jambi', 'PT. BATANGHARI PROPERTINDO', null, 'Tidak Memenuhi Syarat', '2025-05-04'],
            ['KB ISLAM AL-WARDAH', 'SEKOLAH', 'Rendah', 'Rendah', '25 m²', 'Jl. KH. Hasan Anang RT.03 Kel. Olak Kemang Kec. Danau Teluk, Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-05-06'],
            ['MC Donald\'s The Hok', 'RESTORAN', 'Rendah', 'Tinggi', '468.63 m²', 'Jl. Jend. Sudirman, Kel. Talang Jauh, Kec. Jelutung, Kota Jambi', 'Caroline Djajadiningrat', null, 'Memenuhi Syarat', '2025-05-07'],
            ['MC Donald\'s Sipin', 'RESTORAN', 'Rendah', 'Tinggi', '490.49 m²', 'Jl. Sumantri Brojonegoro No.54, Kel. Sungai Putri, Kec. Danau Teluk, Kota Jamb', 'Caroline Djajadiningrat', null, 'Memenuhi Syarat dengan Catatan', '2025-05-07'],
            ['CERIA BIMBLE', 'SEKOLAH', 'Rendah', 'Rendah', '95 m²', 'Jl. Untung Suropati No.46 RT.45 Kel. Jelutung Kec. Jelutung, Kota Jamb', null, null, 'Tidak Memenuhi Syarat', '2025-05-08'],
            ['TPA DAN PAMI ISLAM ALWARDAH', 'SEKOLAH', 'Rendah', 'Rendah', '25 m²', 'Jl. KH. Hasan Anang RT.03 Kel. Olak Kemang Kec. Danau Teluk, Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-05-08'],
            ['RA An-Najihah', 'SEKOLAH', 'Rendah', 'Rendah', '63.5 m²', 'Jl. Raden Hamzan Kel. Pakuan Baru Kec. Jambi Selatan, Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-05-08'],
            ['TK NURUL ILMI JAMBI', 'SEKOLAH', 'Rendah', 'Rendah', '587 m²', 'Jl. Yulius Usman No.RT.18 Kel. Pematang Sulur Kec. Telanaipura, Kota Jambi.', null, null, 'Tidak Memenuhi Syarat', '2025-05-08'],
            ['LABORATORIUM KESEHATAN PROVINSI', 'LABORATORIUM', 'Rendah', 'Tinggi', '600 m²', 'R. Moh. Nuradma Dibrata No. 6A, Telanaipura,Kec. Telanaipura, Kota Jambi,', 'Pemerintah Provinsi Jambi', null, 'Tidak Memenuhi Syarat', '2025-05-08'],
            ['PT FAANZA JAYA SUKSES', 'PERUMAHAN', 'Rendah', 'Sedang', '18720 m²', 'Jl. Lingkar Barat 1 No.338, Kenali Asam Bawah, Kec. Kota Baru, Kota Jambi, Jambi 36129', 'EDWAR HARUN', null, 'Tidak Memenuhi Syarat', '2025-05-15'],
            ['TK ARRAHMAN', 'SEKOLAH', 'Rendah', 'Rendah', null, null, null, null, null, '2025-05-20'],
            ['TK HARAPAN BUNDA', 'SEKOLAH', 'Rendah', 'Rendah', '125 m²', 'Jl. Aurduri No.301 Blok D Kec. Telanaipura, Kota Jamb', null, null, 'Tidak Memenuhi Syarat', '2025-05-20'],
            ['TK BHAYANGKARA', 'SEKOLAH', 'Rendah', 'Rendah', null, null, null, null, null, '2025-05-20'],
            ['TK PAUD AR-RAHIMAH', 'SEKOLAH', 'Rendah', 'Rendah', '155 m²', 'Komplek Pinang Merah RT. 16 Blok E4 Kel. Bagan Pete Kec. Kota Baru, Kota Jambi.', null, null, 'Tidak Memenuhi Syarat', '2025-05-22'],
            ['TK Preschool Kids House', 'SEKOLAH', 'Rendah', 'Rendah', '50 m²', 'Jl. Kapten Pattimura Simpang IV Sipin, Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-05-22'],
            ['TK,SD,SMP,SMA DIAN HARAPAN', 'SEKOLAH', 'Rendah', 'Sedang', '10406 m²', 'Jl. Lombok Kel. Kebun Handil Kec. Jelutung Kota Jambi.', 'Yayasan Pendidikan Pelita Harapan', null, 'Tidak Memenuhi Syarat', '2025-05-22'],
            ['BPS PROVINSI JAMBI', 'KANTOR', 'Rendah', 'Sedang', '1606.39 m²', 'Jl. Ahmad Yani No. 04 Kec. Telanaipura Kota Jambi', 'Pemerintah Daerah Provinsi Jambi', null, 'Tidak Memenuhi Syarat', '2025-06-06'],
            ['PT. Karya Nature Biomas', 'INDUSTRI', 'Rendah', 'Tinggi', '465 m²', 'Jl. Lintas Timur Jambi Kelurahan Penyengat Rendah Kecamatan Telanai Pura Kota Jambi', 'A. Wira Tonikusuma', null, 'Tidak Memenuhi Syarat', '2025-06-10'],
            ['GRAND HOTEL', 'HOTEL', 'Sedang', 'Tinggi', '9132.42 m²', 'Jl. Kapten Patimura Jambi Kelurahan Simpang IV Sipin Kecamatan Kota Baru, Kota Jambi', 'PT. Grand Putra Jaya', null, 'Tidak Memenuhi Syarat', '2025-06-10'],
            ['ALKANA LAB', 'LABORATORIUM', 'Rendah', 'Tinggi', '125.38 m²', 'Jl. Dharma Karya II, RT. 28 Kel. Kenali Asam Bawah, Kec. Kota Baru, Kota Jambi', 'Denny Setya Cipta Hadi', null, 'Tidak Memenuhi Syarat', '2025-06-18'],
            ['DINAS KEARSIPAN', 'KANTOR', 'Sedang', 'Tinggi', '7200 m²', 'Jl. Prof Dr. Soemantri Brodjonegoro Kel.Sei Putri Kec.Danau Sipin', 'Dinas Kearsipan dan Perpustakaan Kota Jambi', null, 'Tidak Memenuhi Syarat', '2025-06-19'],
            ['HOTEL YELLO', 'HOTEL', 'Tinggi', 'Tinggi', '8031 m²', 'Jl. Jendral Sudirman Kelurahan Tambak Sari Kecamatan Jambi Selatan Kota Jambi.', 'Yello Hotel Jambi', null, 'Memenuhi Syarat', '2025-06-25'],
            ['PT. SANCAYA MANDIRI CIPTA', 'HIBURAN', 'Rendah', 'Sedang', '2208 m²', 'Jl. Abunjani RT.19 Kel. Selamat Kec. Danau Sipin Kota Jambi', 'M. Robby Juliansyah', null, 'Tidak Memenuhi Syarat', '2025-07-21'],
            ['RS ERNI MEDIKA', 'RUMAH SAKIT', 'Rendah', 'Tinggi', '3306 m²', 'Lrg. Perjuangan RT.12 Kel. Talang Bakung Kec. Paal Merah Kota Jambi', 'ERNIANA', null, 'Tidak Memenuhi Syarat', '2025-07-21'],
            ['PT HM SAMPOERNA', 'GUDANG', null, null, null, null, null, null, null, '2025-07-21'],
            ['KONSULTAN PELAYANAN GIZI', 'HOTEL & CAFE', 'Rendah', 'Tinggi', '492 m²', 'Jl. H. Badar Kelurahan Pasar Putih Kecamatan Jambi Timur Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-07-22'],
            ['JB HERITAGE HOTEL & CONVENTION', 'HOTEL & CAFE', 'Sedang', 'Tinggi', '5000 m²', 'Jl. Prof. DR. Moh. Yamin No. 7 Payo Lebar, Kecamatan Jelutung, Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-07-29'],
            ['MI NURSAADAH', 'SEKOLAH', 'Rendah', 'Sedang', '375 m²', 'Jl. Kol. Tarmizi Kodir No.13, Pakuan Baru, Kecamatan Jambi Selatan, Kota Jambi', 'M. Basit, S.Pd.I', null, 'Tidak Memenuhi Syarat', '2024-07-24'],
            ['SD SMP ASSYIPA', 'SEKOLAH', 'Rendah', 'Rendah', null, null, null, null, null, '2024-07-25'],
            ['PDAM TIRTA MAYANG', 'INDUSTRI', 'Rendah', 'Sedang', '22161 m²', 'Jl. Letkol Slamet Riyadi, Kel. Solok Sipin, Kec. Danau Sipin , Kota Jambi.', 'Perumda Air Minum Tirta Mayang Kota Jambi', null, 'Tidak Memenuhi Syarat', '2025-08-07'],
            ['RS KAMBANG', 'RUMAH SAKIT', null, 'Tinggi', null, null, null, null, null, '2025-08-11'],
            ['TK Unggul Sakti', 'SEKOLAH', 'Sedang', 'Rendah', '609 m²', 'Jl. Jaya Wijaya No. 18 Kel. Talang Banjar, Kec. Jambi Timur, Kota Jambi', 'Yayasan Pendidikan Unggul Sakti', null, 'Tidak Memenuhi Syarat', '2025-08-13'],
            ['SLB NEGERI 2', 'SEKOLAH', 'Rendah', 'Sedang', '8045 m²', 'Jl. Pro. Dr. Sri Soedewi Maschun Sofyan, Lorong Cattelya, Sungai Putri, Telanaipura, Jambi', 'Hj. Sri Suryati, S.Pd., M.Pd', null, 'Tidak Memenuhi Syarat', '2025-08-20'],
            ['TK LOKOMOTIF', 'SEKOLAH', 'Rendah', 'Rendah', null, null, 'EVA HARYATI', '0821 8043 8164', null, '2025-08-27'],
            ['KANTOR WALIKOTA', 'KANTOR', 'Sedang', 'Sedang', '9000 m²', 'Jl. Jenderal Basuki Rachmat, Kelurahan Paal Lima,Kecamatan Kota Baru, Kota Jambi', 'Pemerintah Kota Jambi', null, 'Memenuhi Syarat dengan Catatan', '2025-09-01'],
            ['DPMPTSP', 'KANTOR', null, null, null, null, null, null, null, '2025-09-01'],
            ['DPRD KOTA JAMBI', 'KANTOR', null, null, null, null, null, null, null, '2025-09-01'],
            ['DPRD PROVINSI', 'KANTOR', null, null, null, null, null, null, null, '2025-09-01'],
            ['TK ALHIDAYAH', 'SEKOLAH', 'Rendah', 'Rendah', '300 m²', 'Jl. Marsda Surya Dharma No.KM.10, Kenali Asam Bawah, Kec. Kota Baru, Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-09-02'],
            ['GUANG MING SCHOOL', 'SEKOLAH', 'Sedang', 'Rendah', '8868 m²', 'Jl. H. Badar No. 48A RT. 22 Kel. Pasir Putih, Kec. Jambi Selatan, Kota Jambi', 'YAYASAN AKAR DHARMA YULIN', null, 'Tidak Memenuhi Syarat', '2025-09-08'],
            ['MADRASAH IBTIDAIYAH TA\'AWUNIYAH IKHLAS', 'SEKOLAH', 'Rendah', 'Rendah', '800 m²', 'Jl. Nusa Indah 1 RT. 04 Kel. Rawasari, Kec. Alam Barajo, Kota Jambi', 'Yayasan Ta\'awuniyah Ikhlas', null, 'Tidak Memenuhi Syarat', '2025-09-08'],
            ['RS HJ ADURRAHMAN SAYOETI', 'RUMAH SAKIT', 'Sedang', 'Tinggi', '7554.45 m²', 'Jl. K.H. Hasan Anang No. 33 RT. 08 Kel. Olak Kemang, Kec. Danau Teluk, Kota Jambi', 'Dinas Kesehatan Kota Jambi', null, 'Memenuhi Syarat dengan Catatan', '2025-09-15'],
            ['TK ALFALAH 2', 'SEKOLAH', 'Rendah', 'Rendah', '3969 m²', 'Jl. HOS.Cokroaminoto No.4, Kelurahan Selamat, Kecamatan Danau Sipin, Kota Jambi, Jambi.', null, null, 'Tidak Memenuhi Syarat', '2025-09-15'],
            ['PT. LUMBUNG MAS PRATAMA', 'HOTEL', 'Rendah', 'Tinggi', '522.75 m²', 'Jl. Sersan Zuraida No.12 RT 15 RW 07 Kelurahan Sei Asam Kecamatan Pasar Jambi Kota Jambi', 'John Harry Wijaya', null, 'Tidak Memenuhi Syarat', '2025-09-17'],
            ['GEDUNG TTC TELKOMSEL', 'KANTOR', 'Sedang', 'Tinggi', '1772.59 m²', 'Jl. Slamet Riyadi Nomor. 03 RT. 18 Kelurahan Solok Sipin Kecamatan Danau Sipin Kota Jambi', 'PT. Telekomunikasi Selular', null, 'Tidak Memenuhi Syarat', '2025-09-18'],
            ['SD 204/IV Kota Jambi', 'SEKOLAH', 'Rendah', 'Rendah', '1135 m²', 'Jl. Hutan Kota Kelurahan Kenali Asam Bawah Kecamatan Kota Baru Kota Jambi', 'Pemerintah Kota Jambi', null, 'Tidak Memenuhi Syarat', '2025-09-26'],
            ['TK CBC MAWADAH', 'SEKOLAH', 'Rendah', 'Rendah', '1432 m²', 'Jl. Jend. Basuki Rahmat, Paal Lima, Kec. Kota Baru, Kota Jambi.', null, null, 'Memenuhi Syarat', '2025-09-26'],
            ['SMP IT AN-NAHL', 'SEKOLAH', 'Rendah', 'Rendah', '2250 m²', 'Jl. Dr Tazar RT.14 Kelurahan Buluran Kenali Kecamatan Telanaipura Kota Jambi', 'Yayasan An-Nahl Percikan Iman', null, 'Tidak Memenuhi Syarat', '2025-09-26'],
            ['TK ISLAM AHSAN', 'SEKOLAH', 'Rendah', 'Rendah', '128 m²', 'Jl. Sunan Gunung Jati RT. 29 Kel. Kenali Asam Bawah Kec. Kota Baru', null, null, 'Tidak Memenuhi Syarat', '2025-09-29'],
            ['HOTEL BW LUXURY', 'HOTEL', 'Tinggi', 'Tinggi', '31182 m²', 'Jl. Soekarno-Hatta Kelurahan Pasar Putih Kecamatan Jambi Selatan Kota Jambi.', 'HANSE LIE', null, 'Memenuhi Syarat', '2025-10-04'],
            ['JASA RAHARJA', 'KANTOR', 'Rendah', 'Sedang', '227.7 m²', 'Jl. Prof Sri Sudewi No.19 Telanaipura, Kota Jambi', 'PT. Jasa Raharja Wilayah Jambi', null, 'Tidak Memenuhi Syarat', '2025-10-08'],
            ['TK ROUDHOTU ASH SHIBYAN', 'SEKOLAH', 'Rendah', 'Rendah', '160 m²', 'Jl. Rajawali I RT.19 Kelurahan Tambak Sari Kecamatan Jambi Selatan Kota Jambi', 'Yayasan Ar Roudhoh', null, 'Tidak Memenuhi Syarat', '2025-10-09'],
            ['MI MAHABBATULLAH', 'SEKOLAH', 'Rendah', 'Rendah', '800 m²', 'Jl. Liposos 2 RT.39 Kelurahan Eka Jaya Kecamatan Paal Merah Kota Jambi', 'Yayasan Pendidikan Islam Mahabatullah', null, 'Tidak Memenuhi Syarat', '2025-10-09'],
            ['SMA XAVERIUS 1', 'SEKOLAH', 'Sedang', 'Sedang', '5151 m²', 'Jl. Marsa Abdul Rahman Saleh-Lorong Uka No.76 Kota Jambi', 'Yayasan SMA Xaverius 1 Kota Jambi', null, 'Tidak Memenuhi Syarat', '2025-10-14'],
            ['SHANG RATU', 'HOTEL', 'Sedang', 'Tinggi', '4530.05 m²', 'Jl. Slamet Riyadi No.24 Kelurahan Sungai Putri Kecamatan Telanaipura Kota Jambi', 'MERINA ROSANTY', null, 'Memenuhi Syarat dengan Catatan', '2025-10-29'],
            ['HOTEL RATU', 'HOTEL', 'Sedang', 'Tinggi', null, 'Jl. Slamet Riyadi No.24 Kelurahan Sungai Putri Kecamatan Telanaipura Kota Jambi', 'Jl. Marsa Abdul Rahman Saleh-Lorong Uka No.76', null, 'Memenuhi Syarat dengan Catatan', '2025-10-29'],
            ['BPJS KETENAGAKERJAAN', 'KANTOR', 'Rendah', 'Tinggi', '1309 m²', 'Jl. Slamet Riyadi No. 16 Kelurahan Solok Sipin Kecamatan Telanaipura Kota Jambi', 'Zulhar Abdullah', null, 'Tidak Memenuhi Syarat', '2025-10-29'],
            ['TK Pembina 2', 'SEKOLAH', 'Rendah', 'Rendah', '328 m²', 'Jalan P.Hidayat Lrg. Siswa RT.06 Kel. Suka Karya Kec.Kota Baru', null, null, 'Tidak Memenuhi Syarat', '2025-10-29'],
            ['SDN 25', 'SEKOLAH', 'Rendah', 'Rendah', '1951 m²', 'Jl. Kimaja RT 24 RW 08 Kel. Simpang III Sipin Kec. Kota Baru Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-10-29'],
            ['BANK 9 JAMBI CABANG SUTOMO', 'BANK', 'Rendah', 'Sedang', '520 m²', 'Jl. Dokter Soetomo No.8 Kel. Pasar, Kec. Pasar, Kota Jambi', 'PT. Bank Pembangunan Daerah Jambi', null, 'Tidak Memenuhi Syarat', '2025-10-30'],
            ['HOTEL DUTA', 'HOTEL', 'Sedang', 'Tinggi', '3425 m²', 'Jl. Dr, Sam Ratulangi No.65-68 Kel. Pasar, Kec. Pasar, Kota Jambi', 'PT. Duta Rezeki Kencana', null, 'Memenuhi Syarat dengan Catatan', '2025-10-30'],
            ['TK ISLAM MUSLIMAT', 'SEKOLAH', 'Rendah', 'Rendah', '160 m²', 'Jl. Bangka RT.08 Kel.Handil Jaya Kec.Jelutung Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-10-30'],
            ['TK KIRANA', 'SEKOLAH', 'Rendah', 'Rendah', '120 m²', 'Jl. Berbah Dalam RT.16 Kel.Eka Jaya, Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-10-30'],
            ['SDIT ISLAMIC SCHOOL', 'SEKOLAH', 'Rendah', 'Rendah', '1557 m²', 'Jalan Dharma Bhakti RT. 46 Kelurahan Jelutung Kecamatan Jelutung Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-11-11'],
            ['TK NOVA', 'SEKOLAH', 'Rendah', 'Rendah', '135 m²', 'Jl. Angkasa Puri No.2 RT.21/06 Kel. Pasir Putih, Kota Jamb', null, null, 'Tidak Memenuhi Syarat', '2025-11-11'],
            ['KB CENDIKA THE FIRST', 'SEKOLAH', 'Rendah', 'Rendah', '400 m²', 'Jl. Darmawangsa RT.16 Kel.Kenali Asam Atas Kec. Kota Baru Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-11-11'],
            ['PT. INTISUMBER HASIL SAMPURNA GOBAL', 'GUDANG', 'Rendah', 'Sedang', '144 m²', 'Jl. Lingkar Selatan 2 RT. 46. Kel. Lingkar Selatan, Paal Merah, Kota Jambi', 'PT. Intisumber Hasil Sempurna Global', null, 'Tidak Memenuhi Syarat', '2025-11-13'],
            ['TK PERTIWI 2', 'SEKOLAH', 'Rendah', 'Rendah', '540 m²', 'Jl.Letjen Soeprapto No. 63 Telanaipura, Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-11-13'],
            ['SD 95', 'SEKOLAH', 'Rendah', 'Rendah', '1296 m²', 'Jl.Kaca Piring II RT.30 Kel.Simpang IV Sipin Kec.Telanaipura Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-11-13'],
            ['SD Kartika II-4', 'SEKOLAH', 'Rendah', 'Rendah', '1200 m²', 'Jl.Urip Sumoharjo Kel.Sungai Putri Kec.Danau Sipin Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-11-13'],
            ['GRAHA SIGINJAI', 'KANTOR', 'Sedang', 'Sedang', '9000 m²', 'Jl. Jenderal Basuki Rachmat, Kelurahan Paal Lima,Kecamatan Kota Baru, Kota Jambi', 'Pemerintah Kota Jambi', null, 'Memenuhi Syarat dengan Catatan', '2025-11-24'],
            ['SMK TARUNA INDONESIA', 'SEKOLAH', 'Rendah', 'Sedang', '3500 m²', 'Jl. Marsda Surya Dharma No.24 Kel. Kenali Asam Bawah Kec. Kota Baru, Kota Jambi', 'Yayasan Pendidikan Nusantara', null, 'Memenuhi Syarat dengan Catatan', '2025-11-25'],
            ['SPBU 24.361.08', 'SPBU', 'Rendah', 'Tinggi', '317.85 m²', 'Jl. Soekarno-Hatta Kel.Pasir Putih Kec.Jambi Selatan Kota Jambi', 'PT. Jambi Bangun Bara Persada', null, 'Memenuhi Syarat', '2025-12-02'],
            ['Pengadilan Tinggi Negeri Jambi', 'Pemerintah', 'Sedang', 'Tinggi', '2771 m²', 'Jalan Arief Rahman Hakim No.55, Simpang IV Sipin, Kecamatan Telanaipura, Kota Jambi', 'Mahkamah Agung Republik Indonesia Direktorat Jenderal Badan Peradilan Umum Pengadilan Tinggi Jambi', null, 'Tidak Memenuhi Syarat', '2025-12-05'],
            ['Inul Vista', 'Hiburan', 'Rendah', 'Sedang', '216 m²', 'Jl. Sultan Thaha No.17, Kelurahan Pasar Jambi, Kecamatan Pasar Jambi, Kota Jambi', 'Masriyadi', null, 'Tidak Memenuhi Syarat', '2025-12-08'],
            ['Masterpiece Karaoke', 'Hiburan', 'Rendah', 'Sedang', '216 m²', 'Jl. Sultan Thaha, Kelurahan Pasar Jambi, Kecamatan Pasar Jambi, Kota Jambi', 'PT. Irama Pratama', null, 'Tidak Memenuhi Syarat', '2025-12-08'],
            ['Pos Jambi Soetomo', 'Kantor', 'Rendah', 'Sedang', '2393 m²', 'Jl. Sultan Thaha No.5, Kelurahan Pasar Jambi, Kecamatan Pasar Jambi, Kota Jambi', 'Kantor Pos Indonesia', null, 'Tidak Memenuhi Syarat', '2025-12-08'],
            ['PT. Jambi Lestari Internasional', 'LABORATORIUM', 'Rendah', 'Tinggi', '2304 m²', 'Jl. Nusa Indah I , kelurahan Rawa Sari, Kecamatan Alam Barajo, Kota Jambi', 'PT. Jambi Lestari Internasional', null, 'Tidak Memenuhi Syarat', '2025-12-12'],
            ['RS Siloam', 'RUMAH SAKIT', 'Rendah', 'Tinggi', '7461 m²', 'Jl. Soekarno-Hatta Kecamatan Paal Merah Kota Jambi', 'PT. Golden First Atlanta', null, 'Memenuhi Syarat', '2025-12-12'],
            ['RS Adhyaksa', 'RUMAH SAKIT', 'Sedang', 'Tinggi', '14410 m²', 'Jl. Tomok, Kelurahan Arab Melayu, Kecamatan Pelayangan, Kota Jambi', 'Rumah Sakit Adhyaksa Jambi', null, 'Tidak Memenuhi Syarat', '2025-12-13'],
            ['PT. Azka Sentosa', 'SPBU', 'Rendah', 'Tinggi', '2500 m²', 'Jl. Jambi No. 111 RT. 05 Kel. Simpang III Sipin Kec. Kota Baru', 'PT. Azka Sentosa', null, 'Tidak Memenuhi Syarat', '2025-12-17'],
            ['RS Baiturrahim', 'RUMAH SAKIT', 'Sedang', 'Tinggi', '2000 m²', 'Jl. Prof. DR. Moh. Yamin No. 30 Kel. Lebak Bandung Kec. Jelutung Kota Jambi', 'Dr. Filius Chandra, SE., MM', null, 'Memenuhi Syarat dengan Catatan', '2025-12-17'],
            ['RS H. Abdul Manap', 'RUMAH SAKIT', 'Sedang', 'Tinggi', '20449.26 m²', 'Jl. Sk. Rd. Syahbuddin Kelurahan Mayang Mangurai Kecamatan Alam Barajo Kota Jambi', 'Pemerintah Kota Jambi', null, 'Memenuhi Syarat dengan Catatan', '2025-12-18'],
            ['SURIA HARAPAN SCHOOL', 'SEKOLAH', 'Rendah', 'Rendah', '9016 m²', 'Jl. Hayam Wuruk No.171 RT.010 Kel.Talang Jauh Kec.Jelutung Kota Jambi', 'SURIA HARAPAN SCHOOL', null, 'Tidak Memenuhi Syarat', '2025-12-18'],
            ['TK AL HIKMAH', 'SEKOLAH', 'Rendah', 'Rendah', '54.5 m²', 'Komplek Villa Kenali Permai Blok L1 No.1 Kel.Mayang Mangurai, Kec.Alam Barajo, Kota Jambi', null, null, 'Tidak Memenuhi Syarat', '2025-12-18'],
            ['Pabrik Kopi AAA', 'INDUSTRI', 'Rendah', 'Tinggi', '3380 m²', 'Jl. Berdikari No.13 RT.23 Kel. Payo Selincah Kec. Jambi Timur', 'Kristonsen Tanuar', null, 'Tidak Memenuhi Syarat', '2025-12-24'],
            ['Pabrik Kopi Paman', 'INDUSTRI', 'Rendah', 'Tinggi', '2296 m²', 'Jl. Gunung Semeru Kel. Payo Selincah Kec. Paal Merah Kota Jambi', 'CV. Perusahaan Kopi Bubuk NEFO', null, 'Memenuhi Syarat dengan Catatan', '2025-12-24'],
            ['TK AL IRSYAD', 'SEKOLAH', 'Rendah', 'Rendah', '126 m²', 'Jl.Abdul Muis RT.12 No.39 Kelurahan Lingkar Selatan, Kota Jambi.', null, null, 'Tidak Memenuhi Syarat', '2025-12-29'],
            ['Sucofindo', 'LABORATORIUM', 'Rendah', 'Tinggi', '1437 m²', 'Jl. Sari Bakti Kel. Bagan Pete Kec. Kota Baru Kota Jambi', 'Zuber Kertapati', null, 'Memenuhi Syarat dengan Catatan', '2025-12-30'],
        ];

        $optionalColumns = [
            'kualifikasi_bangunan' => 2,
            'resiko_kebakaran' => 3,
            'luas_bangunan' => 4,
            'alamat' => 5,
            'nama_penanggung_jawab' => 6,
            'no_telepon' => 7,
            'sistem_proteksi_kebakaran' => 8,
        ];

        $availableOptional = [];
        foreach ($optionalColumns as $col => $index) {
            if (Schema::hasColumn('inspeksi_bangunans', $col)) {
                $availableOptional[$col] = $index;
            }
        }

        $hasTahun = Schema::hasColumn('inspeksi_bangunans', 'tahun');
        $hasSpt = Schema::hasColumn('inspeksi_bangunans', 'surat_perintah_tugas');
        $hasRekomendasi = Schema::hasColumn('inspeksi_bangunans', 'rekomendasi');

        $payload = [];
        foreach ($rows as $row) {
            $item = [
                'nama_tempat' => $row[0],
                'jenis_usaha' => $row[1],
                'tanggal_inspeksi' => $row[9],
                'created_at' => $now,
                'updated_at' => $now,
            ];

            if ($hasTahun) {
                $item['tahun'] = 2025;
            }

            foreach ($availableOptional as $col => $index) {
                $item[$col] = $row[$index];
            }

            if ($hasSpt) {
                $item['surat_perintah_tugas'] = null;
            }
            if ($hasRekomendasi) {
                $item['rekomendasi'] = null;
            }

            $payload[] = $item;
        }

        DB::table('inspeksi_bangunans')->truncate();
        DB::table('inspeksi_bangunans')->insert($payload);
    }
}

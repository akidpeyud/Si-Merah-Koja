<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SosialisasiPenyuluhanSeeder extends Seeder
{
    /**
     * Isi data Sosialisasi dan Penyuluhan (ke luar Damkar) tahun 2025 (27 kegiatan) dan 2026 (50 kegiatan).
     */
    public function run(): void
    {
        if (! Schema::hasTable('sosialisasi_edukasi') || ! Schema::hasColumn('sosialisasi_edukasi', 'nama_instansi')) {
            return;
        }

        $now = now();

        /**
         * Format tiap baris:
         * [nama_instansi, tempat_pelaksanaan, alamat, tanggal_pelaksanaan, jumlah_peserta, nama_penanggung_jawab, no_telepon, surat_perintah_tugas?]
         *
         * @var array<int, array{0: string, 1: string, 2: string, 3: string, 4: int, 5: string, 6: string, 7?: string|null}>
         */
        $rows = [
            // =========================================================
            // TAHUN 2025 (27 Kegiatan - 1.073 Peserta)
            // =========================================================
            ['01, 03, 05, 06, 07, 09, 10, 12 dan 14', 'Ruang Serbaguna RT 01', 'RT 01 Kel. Kasang Jaya Kec. Jambi Timur', '2025-03-20', 43, 'Toni', '081284958921', 'spt_sosialisasi_2025_01.pdf'],
            ['11', 'Rumah Ketua RT 11', 'RT 11 Kel. Sulanjana Kec. Jambi Timur', '2025-04-10', 25, 'Husen', '081368754673', 'spt_sosialisasi_2025_02.pdf'],
            ['19', 'Rumah Pujiarti Siregar RT 19', 'RT 19 Kel. Rawasari Kec. Alam Barajo', '2025-04-12', 25, 'Juairiah', '082379092203', 'spt_sosialisasi_2025_03.pdf'],
            ['16', 'Ruang Kelas SMK Batanghari', 'RT 16 Kel. Rawasari Kec. Alam Barajo', '2025-04-17', 32, 'Zarwani', '082184635910', 'spt_sosialisasi_2025_04.pdf'],
            ['28', 'Rumah Ketua RT 28', 'RT 28 Kel. Kenali Asam Atas Kec. Kota Baru', '2025-04-27', 40, 'Sudarwati', '081366653336', 'spt_sosialisasi_2025_05.pdf'],
            ['32', 'Rumah Ketua RT 32', 'RT 32 Kel. Talang Banjar Kec. Jambi Timur', '2025-05-05', 45, 'Wulan', '08984320291', 'spt_sosialisasi_2025_06.pdf'],
            ['PKK', 'Aula Kantor Lurah Beliung', 'Jl. TP. Sriwijaya Kel. Beliung Kec. Kota Baru', '2025-05-07', 36, 'Fadel', '081271468700', 'spt_sosialisasi_2025_07.pdf'],
            ['11', 'Ruang Pertemuan RT 11', 'RT 11 Kel. Mayang Mangurai Kec. Alam Barajo', '2025-05-10', 39, 'Dewi Chandra', '081366572821', 'spt_sosialisasi_2025_08.pdf'],
            ['8, 9 dan 10', 'Balai Pertemuan RT 09', 'RT 09 Kel. Kenali Asam Kec. Kota Baru', '2025-05-18', 59, 'Nuriyani', '08973388062', 'spt_sosialisasi_2025_09.pdf'],
            ['1, 5 dan 12', 'Pendopo RT 01', 'RT 01 Kel. Kenali Asam Kec. Kota Baru', '2025-06-15', 53, 'Kasam', '085266097844', 'spt_sosialisasi_2025_10.pdf'],
            ['30, 31, 32, 33 dan 34', 'Pendopo Eko', 'Kel. Jelutung Kec. Jelutung', '2025-06-21', 30, 'Purbocaroko', '081385299846', 'spt_sosialisasi_2025_11.pdf'],
            ['01, 06, 12 dan 40', 'Rumah Ketua RT 12', 'RT 12 Kel. Kenali Besar Kec. Alam Barajo', '2025-07-19', 43, 'Lujeng', '081367751348', 'spt_sosialisasi_2025_12.pdf'],
            ['07, 08, 09, 14 dan 40', 'SD Negeri 182 Kota Jambi', 'Kel. Payo Lebar Kec. Jelutung', '2025-08-12', 31, 'Reni', '08117414407', 'spt_sosialisasi_2025_13.pdf'],
            ['12, 26 dan 32', 'Rumah Ketua RT 26', 'RT 26 Kel. Rawasari Kec. Alam Barajo', '2025-09-20', 37, 'Partinem', '085215081721', 'spt_sosialisasi_2025_14.pdf'],
            ['01, 02, 03, 04 dan 05', 'Rumah Ibu Sriyati RT 01', 'RT 01 Kel. Tanjung Sari Kec. Jambi Timur', '2025-10-21', 41, 'Fatmawati', '08277124872', 'spt_sosialisasi_2025_15.pdf'],
            ['22, 23 dan 24', 'Rumah Ketua RT 24', 'RT 24 Kel. Tanjung Sari Kec. Jambi Timur', '2025-10-21', 28, 'Sari Febriyanti', '089667474433', 'spt_sosialisasi_2025_16.pdf'],
            ['Posyandu Sari Melati (RT 22, 23, 25, 26 dan 28)', 'Rumah Ketua RT 26', 'Jl. Irmija RT 26 Kel. Kenali Asam Atas Kec. Kota Baru', '2025-10-28', 26, 'Jumiah', '081278274744', 'spt_sosialisasi_2025_17.pdf'],
            ['Posyandu Beringin Jaya (RT 18)', 'Rumah Ketua RT 18', 'Jl. Sunang Bonang no 97 RT. 18 Kel. Simpang III Sipin Kec. Kota Baru', '2025-10-28', 42, 'Sutinah', '082311430859', 'spt_sosialisasi_2025_18.pdf'],
            ['Pertamina EP', 'Kantor Lurah Kenali Asam', 'Kel. Kenali Asam Atas Kec. Kota Baru', '2025-11-06', 25, 'Rozita', '085268945294', 'spt_sosialisasi_2025_19.pdf'],
            ['Posyandu Jeruk dan Sirsak (RT 09, 10, 19 dan 20)', 'Posyandu Jeruk', 'Jl. Gatot Subroto RT 21 Kel. Sungai Asam Kec. Pasar Jambi', '2025-12-01', 70, 'Maryam Hasan', '089624508706', 'spt_sosialisasi_2025_20.pdf'],
            ['Posyandu Nuri VIII (RT 04)', 'Posyandu Nuri VIII', 'RT 04 Kel. Kasang Kec. Jambi Timur', '2025-12-01', 49, 'Aminatus Zaimah', '089652051082', 'spt_sosialisasi_2025_21.pdf'],
            ['Posyandu Alamanda (RT 23, 24, 25, 26 dan 27)', 'Posyandu Alamanda', 'Jl. Raja Yamin Lorong Gotong Royong RT. 27 Kel. Selamat Kec. Danau Sipin', '2025-12-02', 37, 'Emi Yuliani', '082268609283', 'spt_sosialisasi_2025_22.pdf'],
            ['Posyandu Mawar III (RT 07, 08 dan 09)', 'Posyandu Mawar III', 'Jl. RB Siagian RT 09 Kel. Pasir Putih Kec. Jambi Selatan', '2025-12-03', 35, 'Fitriani', '082388965979', 'spt_sosialisasi_2025_23.pdf'],
            ['Posyandu Melati (RT 01, 02, 03 dan 04)', 'Posyandu Melati', 'Jl. Erlangga RT 03 Kel. Budiman Kec. Jambi Timur', '2025-12-04', 43, 'Dewi Suswita', '085366780273', 'spt_sosialisasi_2025_24.pdf'],
            ['09, 11 dan 12', 'Rumah Ibu Bule RT 12', 'RT 12 Kel. Olak Kemang Kec. Danau Teluk', '2025-12-05', 71, 'Muhammad Suhendro', '0895342775605', 'spt_sosialisasi_2025_25.pdf'],
            ['Posyandu Bakung VI (RT 40 dan 41)', 'Posyandu Bakung VI', 'Jl. Sultan Hasanuddin Perumahan Korem RT 40 Kel. Bakung Jaya Kec. Paal Merah', '2025-12-08', 34, 'Aida Nursanti', '085195901973', 'spt_sosialisasi_2025_26.pdf'],
            ['Posyandu Anggrek III (RT 01, 02, 03, 04, 05, 06, 10 dan 15)', 'Posyandu Anggrek III', 'Jl. S. Parman, RT 15 Kel. Buluran Kenali Kec. Telanaipura', '2025-12-17', 34, 'Rostina', '082375533265', 'spt_sosialisasi_2025_27.pdf'],

            // =========================================================
            // TAHUN 2026 (50 Kegiatan - 1.684 Peserta)
            // =========================================================
            ['RT 05 Kelurahan Rawasari', 'Posko Kampung Bebas Narkoba Polresta RT 05', 'Jl. Sailendra Kel. Rawasari Kec. Alam Barajo', '2026-01-19', 31, 'Wiwin', '081288391352', 'spt_sosialisasi_2026_01.pdf'],
            ['Posyandu Beringin (RT 03, 12, 14, 15, 16, 17, 18 dan 19) Kel. Kenali Asam Bawah Kec. Kota Baru', 'Posyandu Beringin', 'Jl. SP II RT 03 Kel. Kenali Asam Bawah Kec. Kota Baru', '2026-02-06', 30, 'Kasmini Hariyati', '082374628659', 'spt_sosialisasi_2026_02.pdf'],
            ['PT. Pertamina Patra Niaga AFT Sultan Thaha', 'Kantor Kecamatan Paal Merah', 'Jl. Sultan Syahrir No. 73 Kelurahan', '2026-02-11', 44, 'Abdul Salim, S.Pd.', '082160051161', 'spt_sosialisasi_2026_03.pdf'],
            ['Kecamatan Danau Teluk', 'Kantor Lurah Olak Kemang', 'Jl. KH. Hasan Anang RT 08 Kel. Olak Kemang Kec. Danau Teluk', '2026-02-13', 50, 'Amin', '08527962269', 'spt_sosialisasi_2026_04.pdf'],
            ['Kelurahan Kenali Besar', 'Taman Wisata Kampung Raja', 'Jl. Lkr. Barat 3 No.108 Kel. Kenali Besar Kec. Kota Baru', '2026-02-15', 48, 'Yudi', '08221887114', 'spt_sosialisasi_2026_05.pdf'],
            ['Posyandu Bougenvile VI (RT 05 dan 06)', 'Posyandu Bougenvile VI', 'Jl. Kamboja 3 No 32 RT 05 Kel. Sungai Putri Kec. Danau Sipin', '2026-04-06', 35, 'Novitasari Al Salsabila', '089604380988', 'spt_sosialisasi_2026_06.pdf'],
            ['Posyandu Anggrek IV (RT 15 dan 17)', 'Posyandu Anggrek IV', 'Jl. Mpu Gandring No 37 RT 17 Kel. Solok Sipin Kec. Danau Sipin', '2026-04-06', 33, 'Winda Aprida', '085273022630', 'spt_sosialisasi_2026_07.pdf'],
            ['Posyandu Cempaka Kuning (RT 16, 17, 18, 29 dan 30)', 'Posyandu Cempaka Kuning RT 18', 'Jl. DI Panjaitan Lorong Panduman RT 18 No 03 Kel. Kebun Handil Kec. Jelutung', '2026-04-13', 42, 'Linda', '085287503248', 'spt_sosialisasi_2026_08.pdf'],
            ['Posyandu Aster (RT 20, 23, 24, 25 dan 37)', 'Posyandu Aster RT 24', 'Jl. Batam RT 24 Kel. Lebak Bandung Kec. Jelutung', '2026-04-13', 29, 'Sri Mindaryati', '085357679945', 'spt_sosialisasi_2026_09.pdf'],
            ['Posyandu Harapan Ibu V (RT 37, 38, 39, 40, 41, 42 dan 43)', 'Posyandu Harapan Ibu IV', 'Jl. DI Panjaitan RT 37 Kel. Jelutung Kec. Jelutung', '2026-04-13', 48, 'Rita Aryani', '081278198687', 'spt_sosialisasi_2026_10.pdf'],
            ['Posyandu Anggrek (RT 01, 02, 03, 04, 05, 29, 30, 31 dan 32)', 'Posyandu Anggrek RT 01', 'Jl. Majapahit RT 01 Kel. Payo Selincah Kec. Paal Merah', '2026-04-20', 35, 'Ponimah', '085215431964', 'spt_sosialisasi_2026_11.pdf'],
            ['Posyandu Melati V (RT 23, 24, 30 dan 31)', 'Posyandu Melati V RT 30', 'Jl. Kopral Ramli Perumahan Ratu Daha RT 30 Kel. Talang Bakung Kec. Paal Merah', '2026-04-20', 21, 'Iriani', '088276230299', 'spt_sosialisasi_2026_12.pdf'],
            ['Posyandu Melati I (RT 01, 02, 03 dan 04)', 'Posyandu Melati I RT 01', 'Jl. Kh M Jaafar RT 01 Kel. Mudung Laut Kec. Pelayangan', '2026-05-11', 18, 'Dawiyah', '085381671007', 'spt_sosialisasi_2026_13.pdf'],
            ['Posyandu Cempaka II (RT 01, 02, 03, 04, 05 dan 06)', 'Posyandu Cempaka II RT 06', 'Jl. Kh. M. Jakfar RT 06 Kel. Arab Melayu Kec. Pelayangan', '2026-05-11', 31, 'Ari Kusuma Dewi', '085368567785', 'spt_sosialisasi_2026_14.pdf'],
            ['Posyandu Mawar (RT 02, 03, 04, 05 dan 06)', 'Posyandu Mawar RT 05', 'Jl. Kh. A. Majid RT 05 Kel. Tanjung Johor Kec. Pelayangan', '2026-05-11', 32, 'Fatima', '085369217463', 'spt_sosialisasi_2026_15.pdf'],
            ['Posyandu Cempaka IV (RT 08, 09, 10, 11 dan 12)', 'Posyandu Cempaka IV RT 01', 'RT 08 Kel. Olak Kemang Kec. Danau Teluk', '2026-05-18', 31, 'Wahyuni', '081272621225', 'spt_sosialisasi_2026_16.pdf'],
            ['Posyandu Matahari I dan Matahari II (RT 01, 02, 03, 04, 05, 06, 07, 08, 09 dan 10)', 'Posyandu Matahari II RT 07', 'RT 10 Kel. Tanjung Raden Kec. Danau Teluk', '2026-05-18', 17, 'Rts Santi', '081279668755', 'spt_sosialisasi_2026_17.pdf'],
            ['Posyandu Mawar I (RT 01, 02, 03, 04, 05, 06, 07, 08 dan 09)', 'Kantor Lurah Ulu Gedong', 'Jl. KH. Abdus Somad RT 07 Kel. Ulu Gedong Kec. Danau Teluk', '2026-05-18', 33, 'Hikmawati', '085266078940', 'spt_sosialisasi_2026_18.pdf'],
            ['Himpunan Perempuan Melayu Jambi', 'Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi', 'Jl. Hos Cokroaminoto No 113 Kel. Suka Karya Kec. Kota Baru', '2026-06-03', 28, 'Yeni Marlina', '085363486268', 'spt_sosialisasi_2026_19.pdf'],
            ['Posyandu Bougenville I (RT 31, 32, 33 dan 35)', 'Posyandu Bougenville I RT 32', 'Perum Bougenville RT 32 Kel. Kenali Besar Kec. Alam Barajo', '2026-06-08', 35, 'Suswanti', '0895621868195', 'spt_sosialisasi_2026_20.pdf'],
            ['Posyandu Bunga Popi (26, 27 dan 28)', 'Posyandu Bunga Popi RT 28', 'Jl. Sersan Anwar Bay RT 28 Perum Telaga Beliung Regency Kel. Simpang Rimbo Kec. Alam Barajo', '2026-06-08', 34, 'Siska Handayani', '085769447656', 'spt_sosialisasi_2026_21.pdf'],
            ['Posyandu Kemuning (01, 02, 03, 04, 05, 06, 07, 08, 09, 10 dan 11)', 'Posyandu Kemuning RT 11', 'Jl. Raden Sayuti Lorong Salam Kel. Bagan Pete Kec. Alam Barajo', '2026-06-08', 27, 'Desi Selfia', '085363638793', 'spt_sosialisasi_2026_22.pdf'],
            ['Posyandu Jami\'ul Ikhsan (RT 40)', 'Posyandu Jami\'ul Ikhsan RT 40', 'Jl. Lingkar Barat Lorong Kitek Perumahan Graha Athena RT 40 Kel. Mayang Mangurai Kec. Alam Barajo', '2026-06-15', 35, 'Richa Fradilla', '083128016754', 'spt_sosialisasi_2026_23.pdf'],
            ['Posyandu Seruni (27)', 'Aula RT 27', 'Jl. Lingkar Barat Lorong Kitek Perumahan Graha Athena RT 27 Kel. Mayang Mangurai Kec. Alam Barajo', '2026-06-15', 34, 'Zulkipli', '085266027212', 'spt_sosialisasi_2026_24.pdf'],
            ['Posyandu Melati Putih (RT 16, 17, 18 dan 24)', 'Posyandu Melati Putih RT 17', 'Jl. TP Sriwijaya RT 16 Kel. Rawasari Kec. Alam Barajo', '2026-06-15', 33, 'Ani Lestari', '082185841333', 'spt_sosialisasi_2026_25.pdf'],
            ['Posyandu Cendrawasih VIII (RT 04, 05, 06, 07 dan 15)', 'Pendopo RT 05', 'RT 07 Kel. Kasang Jaya Kec. Jambi Timur', '2026-07-06', 40, 'Miratun', '081366629676', 'spt_sosialisasi_2026_26.pdf'],
            ['Posyandu Kamboja (RT 29 dan 32)', 'Posyandu Kamboja RT 32', 'Jl. Pangeran Antasari RT 32 No 14 Kel. Talang Banjar Kec. Jambi Timur', '2026-07-06', 16, 'Dasri Murniati', '081366334025', 'spt_sosialisasi_2026_27.pdf'],
            ['Posyandu Merpati 05 (RT 20, 21 dan 22)', 'Rumah Ketua RT 20', 'RT 21 Kel. Tanjung Pinang Kec. Jambi Timur', '2026-07-06', 20, 'Sariah', '082184525353', 'spt_sosialisasi_2026_28.pdf'],
            ['Posyandu Amanah (RT 09, 10, 11 dan 12)', 'Posyandu Amanah RT 09', 'Perumnas Aur Duri Blok C RT 09 Kel. Aur Kenali Kec. Telanaipura', '2026-07-17', 40, 'Ida Royani', '085266225280', 'spt_sosialisasi_2026_29.pdf'],
            ['RT 32', 'Lapangan Volly RT 32', 'Jl. Ismail Malik Perumahan Grand Kenali Mayang Mangurai Kel. Mayang Mangurai Kec. Alam Barajo', '2026-07-18', 43, 'Muhammad Akta', '08117441203', 'spt_sosialisasi_2026_30.pdf'],
            ['Posyandu Kecubung (RT 04, 05 dan 06)', 'Masjid Al Jabbar', 'Jl. RE Martadinata RT 05 Kel. Telanaipura Kec. Telanaipura', '2026-07-20', 34, 'Jatmi Asmarani', '085379698826', 'spt_sosialisasi_2026_31.pdf'],
            ['Posyandu Melati I (RT 04, 05 dan 06)', 'Rumah Ketua RT 05', 'Jl. Rd. Suhur RT 05 Kel. Penyengat Rendah Kec. Telanaipura', '2026-07-20', 22, 'Rts Marlina', '088706997214', 'spt_sosialisasi_2026_32.pdf'],
            ['Posyandu Serindit 1 (RT 01, 02, 03, 04, 05, 06, 07, 08, 09 dan 10)', 'Kantor Lurah Sijenjang', 'Jl. Raden Fatah RT 08 Kel. Sijenjang Kec. Jambi Timur', '2026-08-03', 32, 'Halimah Tussakdiah', '081278829466', 'spt_sosialisasi_2026_33.pdf'],
            ['Posyandu Aster (RT 01, 02, 06 dan 09)', 'Rumah Ketua RT 06', 'Jl. H Agus Salim RT 06 Kel. Handil Jaya Kec. Jelutung', '2026-09-07', 16, 'Mami Rahayu', '082377358182', 'spt_sosialisasi_2026_34.pdf'],
            ['Posyandu Cemara 2 (RT 04, 05, 06 dan 07)', 'Rumah Ketua RT 05', 'Jl. Jendral Sudirman RT 05 Kel. Talang Jauh Kec. Jelutung', '2026-09-07', 27, 'Sundari', '0895382077997', 'spt_sosialisasi_2026_35.pdf'],
            ['Posyandu Kenanga 3 (RT 06, 07, 08 dan 24)', 'Rumah Ketua RT 08', 'Jl. Kirana 2 RT 08 Kel. Cempaka Putih Kec. Jelutung', '2026-09-07', 31, 'Palupi', '085382194021', 'spt_sosialisasi_2026_36.pdf'],
            ['Posyandu Melati (RT 08, 09, 16 dan 19)', 'Rumah Ketua RT 09', 'Jl. Pangeran Hidayat Lorong Gado-Gado RT 09 Kel. Suka Karya Kec. Kota Baru', '2026-09-14', 23, 'Patonah', '082376367828', 'spt_sosialisasi_2026_37.pdf'],
            ['Posyandu Rosella (RT 04, 05 dan 06)', 'Posyandu Rosella RT 04', 'Jl. Surya Manis RT 04 Kel. Talang Gulo Kec. Kota Baru', '2026-09-14', 21, 'Nurhayati', '082281153785', 'spt_sosialisasi_2026_38.pdf'],
            ['Posyandu Widuri VII (RT 09, 10 dan 11)', 'Posyandu Widuri VII RT 10', 'Jl. Kol. Inf. M. Kukuh RT 19 No 21 Kel. Paal Lima Kec. Kota Baru', '2026-09-14', 34, 'Party', '085319200747', 'spt_sosialisasi_2026_39.pdf'],
            ['Posyandu Dahlia 4 (Forum RT)', 'Posyandu Dahlia 4 RT 28', 'Jl. Raden Wijaya RT 28 Kel. Thehok Kec. Jambi Selatan', '2026-09-21', 29, 'Fujiati', '085213080180', 'spt_sosialisasi_2026_40.pdf'],
            ['Posyandu Mawar 9 (RT 07, 11, 12, 13, 14 dan 17)', 'Rumah Ketua RT 17', 'Jl. Tarmizi Kadir RT 11 Kel. Pakuan Baru Kec. Jambi Selatan', '2026-09-21', 37, 'Maneka Rahmani', '085366447888', 'spt_sosialisasi_2026_41.pdf'],
            ['Posyandu Melati 10 (RT 01 sampai 34)', 'Lapangan RT 02', 'Jl. H. Syamsudin Uban RT 02 Kel. Tambak Sari Kec. Jambi Selatan', '2026-09-21', 41, 'Sumini', '085377932855', 'spt_sosialisasi_2026_42.pdf'],
            ['Posyandu Melati III (RT 16, 17 dan 18)', 'Posyandu Melati III RT 16', 'Jl. KH Mas Mansyur RT 16 Kel. Murni Kec. Danau Sipin', '2026-10-05', 33, 'Nining Suningsih S', '081270362978', 'spt_sosialisasi_2026_43.pdf'],
            ['Posyandu Sirsak (RT 09, 10, 19 dan 23)', 'Perkarangan Kelenteng RT 23', 'Jl. Kana III No 55 Kel. Cempaka Putih Kec. Jelutung', '2026-10-05', 27, 'Mini Yusnita', '085266707154', 'spt_sosialisasi_2026_44.pdf'],
            ['Posyandu Teratai 5 (RT 25, 26 dan 27)', 'Rumah Ketua RT 25', 'Jl. Danau Sipin RT 25 Kel. Legok Kec. Danau Sipin', '2026-10-05', 37, 'Sumiaty', '082299466197', 'spt_sosialisasi_2026_45.pdf'],
            ['Pokja IV Tim Penggerak PKK (RT 06)', 'Jl. A. Chatib Lrg. Bunga Raya RT 06 Kel. Pematang Sulur', 'Jl. A. Chatib Lrg. Bunga Raya RT 06 Kel. Pematang Sulur', '2026-10-09', 38, 'Wati Gustenti', '082378026627', 'spt_sosialisasi_2026_46.pdf'],
            ['Posyandu Melati IV (RT 13, 14, 15, 16, 17, 18 dan 19)', 'Lapangan Sepak Bola RT 18', 'Jl. Yuka RT 18 Kel. Paal Merah Kec. Paal Merah', '2026-10-15', 14, 'Sri Yani Astuti', '085379356042', 'spt_sosialisasi_2026_47.pdf'],
            ['Posyandu Melati VIII (RT 26, 27, 28 dan 29)', 'Rumah Ketua RT 28', 'Jl.Siswa Bakti Abri RT 28 Kel. Paal Merah Kec. Paal Merah', '2026-10-15', 23, 'Sariah', '085357111357', 'spt_sosialisasi_2026_48.pdf'],
            ['Usaha Mikro, Kecil, dan Menengah (UMKM) Kota Jambi', 'Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi', 'Jl. Hos Cokroaminoto No 113 Kel. Suka Karya Kec. Kota Baru', '2026-11-03', 150, 'Vivi', '081366228094', 'spt_sosialisasi_2026_49.pdf'],
            ['RT 01 Kel. Beliung', 'Madrasah Masjid Al Muhandisin', 'Lorong Hasanah 3 RT 01 Kel. Beliung Kec. Alam Barajo', '2026-11-07', 22, 'Vonny Oliviasari, SE', '08127307227', 'spt_sosialisasi_2026_50.pdf'],
        ];

        $payload = [];
        foreach ($rows as $row) {
            $payload[] = [
                'jenis_kegiatan' => 'Luar',
                'no_tanggal_surat_permohonan' => null,
                'nama_instansi' => $row[0],
                'tempat_pelaksanaan' => $row[1],
                'alamat' => $row[2],
                'tanggal_pelaksanaan' => $row[3],
                'jumlah_peserta' => $row[4],
                'nama_penanggung_jawab' => $row[5],
                'no_telepon' => $row[6],
                'surat_perintah_tugas' => $row[7] ?? null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('sosialisasi_edukasi')->where('jenis_kegiatan', 'Luar')->delete();
        DB::table('sosialisasi_edukasi')->insert($payload);
    }
}

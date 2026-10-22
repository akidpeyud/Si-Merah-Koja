<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TitikSigapSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // ------------------------------------------------------------------
        // SESUAIKAN nilai kategori di bawah dengan key pada
        // \App\Models\TitikSigap::KATEGORI
        // ------------------------------------------------------------------
        $K_KOTA = 'hydrant';
        $K_PILAR = 'hydrant_pilar';
        $K_TRUCK = 'water_truck';
        $K_POS = 'pos';
        $K_AIR = 'sumber_air';

        // Format: [kategori, nama, lokasi, keterangan, latitude, longitude]
        $rows = [
            // ===== HYDRANT KOTA (hidran Prof M Yamin dihapus: machino rusak / tidak bisa dipakai) =====
            [$K_KOTA, 'Hidran Jl. Slamet Riyadi (Murni)', 'Jl. Slamet riyadi, Kel. Murni, Kec. Danau sipin, RT -, Depan musium perjuangan', 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai', -1.593688, 103.607313],
            [$K_KOTA, 'Hidran Mayjen HM.J Singedekane', 'Jln. Mayjen HM.J Singedekane, Kel. Sungai Putri, Kec. Danau Sipin, RT -, depan Telkom sto telanai', 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai', -1.606438, 103.589813],
            [$K_KOTA, 'Hidran Jl. Selamet Riyadi (Legok)', 'Jl selamet riyadi, Kel. Legok, Kec. Danau Sipin, RT 24, Lorong remaja', 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai', -1.588938, 103.598688],
            [$K_KOTA, 'Hidran Raden Pamuk', 'Jln.Raden Pamuk, Kel. Beringin, Kec. Pasar Jambi, RT 17, depan ex BTN/angso duo', 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai', -1.588938, 103.613688],
            [$K_KOTA, 'Hidran Lorong Merpati', 'lorong merpati, Kel. Beringin, Kec. Pasar Jambi, RT 08, Sebelah pos jaga masjid', 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai', -1.594438, 103.611188],
            [$K_KOTA, 'Hidran Husni Thamrin', 'Jln Husni Thamrin, Kel. Beringin, Kec. Pasar Jambi, RT 13, Sebrang hotel Makmur', 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai', -1.591438, 103.613688],
            [$K_KOTA, 'Hidran Mako Damkar (HOS Cokroaminoto)', 'Jln Hoscokro aminoto, Kel. Suka karya, Kec. Kota Baru, RT -, Halaman mako damkar', 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai', -1.632438, 103.600188],
            [$K_KOTA, 'Hidran KH Msaleh (PDAM Pasir Panjang)', 'Jln. KH Msaleh, Kel. Pasir Panjang, Kec. Danau Teluk, RT 02, PDAM Pasir Panjang', 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai', -1.583938, 103.588688],
            [$K_KOTA, 'Hidran Taruma Negara', 'Jln. Taruma Negara, Kel. Tanjung Pinang, Kec. Jambi Timur, RT 12, depan KUA Jambi Timur', 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai', -1.588688, 103.632438],
            [$K_KOTA, 'Hidran Prabu Siliwangi (Pos Damkar)', 'Jln. Prabu siliwangi, Kel. Tanjung Pinang, Kec. Jambi timur, RT 20, depan pos damkar', 'Hidran Kota | Kondisi: Rusak | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai', -1.588938, 103.638688],
            [$K_KOTA, 'Hidran Gr. Djamin Datuk Bagindo', 'Jl. Gr.Djamin Datuk Bagindo, Kel. Talang Banjar, Kec. Jambi timur, RT 06, Indomart', 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai/Kode Map Tidak Sesuai', -1.597438, 103.627688],
            [$K_KOTA, 'Hidran Bhayangkara', 'Jl. Bhayangkara, Kel. Talang Banjar, Kec. Jambi timur, RT 13, Simpang Meranti', 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai', -1.603938, 103.628688],
            [$K_KOTA, 'Hidran Pakubuwono/Saman', 'Jl. Pakubuwono/saman, Kel. Tanjung Pinang, Kec. Jambi timur, RT 22, belakang Pasar Baru Lama', 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai', -1.596188, 103.633688],
            [$K_KOTA, 'Hidran Pos Yankar Alam Barajo', 'Pos yankar alam barajo, Kel. Rawasari, Kec. Alam Barajo, RT 25, Posyankar Alam barajo', 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai', -1.626438, 103.577688],

            // ===== HYDRANT PILAR (sumber: DATA_HIDRAN_PILAR_HALAMAN.xlsx) =====
            [$K_PILAR, 'Hidran Pilar - Mitra 10', 'Jl. Kapten Pattimura, Simpang III Sipin, Kec. Kota Baru, Kota Jambi, Jambi 36361', 'Hidran Pilar | Jumlah: 3 unit | Telp: (0741) 7391004', -1.619987, 103.5883],
            [$K_PILAR, 'Hidran Pilar - PT United Tractor', 'Jl. Patimura KM. 10, Simpang Rimbo, Kenali Besar, Kec. Kota Baru, Kota Jambi, Jambi 36129', 'Hidran Pilar | Jumlah: 7 unit | Telp: 08211010072', -1.622219, 103.551036],
            [$K_PILAR, 'Hidran Pilar - RS Abdurrahman Sayoeti', 'CJ92+JQ9, Olak Kemang, Kec. Danau Tlk., Kota Jambi, Jambi 36124', 'Hidran Pilar | Jumlah: 2 unit | Telp: 07413058734', -1.580866, 103.602044],
            [$K_PILAR, 'Hidran Pilar - WTC Batanghari', 'Jl. Sultan Thaha No.17, Ps. Jambi, Kec. Ps. Jambi, Kota Jambi, Jambi 36111', 'Hidran Pilar | Jumlah: 2 unit | Telp: 07417837028', -1.589049, 103.615289],
            [$K_PILAR, 'Hidran Pilar - Ramayana', 'Jl. Sultan Thaha, Ps. Jambi, Kec. Ps. Jambi, Kota Jambi, Jambi 36123', 'Hidran Pilar | Jumlah: 2 unit | Telp: 07417837038', -1.589447, 103.614808],
            [$K_PILAR, 'Hidran Pilar - du Palais Hotel', 'Jl. Rajawali I, Jelutung, Kec. Jelutung, Kota Jambi, Jambi 36138', 'Hidran Pilar | Jumlah: 2 unit | Telp: 082385576119', -1.610134, 103.619212],
            [$K_PILAR, 'Hidran Pilar - RS Mitra', 'Jl. Jend. Basuki Rahmat No.77, RT.07, Paal Lima, Kec. Kota Baru, Kota Jambi, Jambi 36129', 'Hidran Pilar | Jumlah: 3 unit | Telp: 08117433888', -1.631524, 103.605837],
            [$K_PILAR, 'Hidran Pilar - RS Rapha Theresia', 'Jalan Kardinal J. Darmojuwono, Jl. Lingkar Selatan, Kelurahan Talang, Gulo, Kec. Kota Baru, Kota Jambi, Jambi 36128', 'Hidran Pilar | Jumlah: 6 unit | Telp: 07413620888', -1.679349, 103.613642],
            [$K_PILAR, 'Hidran Pilar - RS St Theresia', 'Jl. Dokter Sutomo No.19, Ps. Jambi, Kec. Ps. Jambi, Kota Jambi, Jambi 36123', 'Hidran Pilar | Jumlah: 3 unit | Telp: 074123119', -1.591979, 103.617198],
            [$K_PILAR, 'Hidran Pilar - TPA Talang Gulo', '8J68+JW, Kenali Asam Bawah, Kec. Kota Baru, Kota Jambi, Jambi 36361', 'Hidran Pilar | Jumlah: 3 unit', -1.68827, 103.617347],
            [$K_PILAR, 'Hidran Pilar - Lippo Mall', 'Jl. Mayor Abd. Karta Wirana No.RT.15, Budiman, Kec. Jambi Tim., Kota Jambi, Jambi 36123', 'Hidran Pilar | Jumlah: 3 unit | Telp: 082177717890', -1.596787, 103.625548],
            [$K_PILAR, 'Hidran Pilar - Kantor PTPN IV', '8HMM+2RX, Kenali Asam Bawah, Kec. Kota Baru, Kota Jambi, Jambi 36129', 'Hidran Pilar | Jumlah: 4 unit | Telp: 0741445603', -1.662063, 103.58667],
            [$K_PILAR, 'Hidran Pilar - UPTD Spal-D', '9MCJ+MXJ, Tangkit, Kec. Sungai Gelam, Kabupaten Muaro Jambi, Jambi 36139', 'Hidran Pilar | Jumlah: 3 unit', -1.62809, 103.682389],
            [$K_PILAR, 'Hidran Pilar - Yello Hotel', 'Komplek Transmart, Jl. Jend. Sudirman, Tambak Sari, Kec. Jambi Sel., Kota Jambi, Jambi 36148', 'Hidran Pilar | Jumlah: 2 unit | Telp: 07413618888', -1.61257, 103.627458],
            [$K_PILAR, 'Hidran Pilar - Transmart', 'Tambak Sari, Kec. Jambi Sel., Kota Jambi, Jambi 36138', 'Hidran Pilar | Jumlah: 2 unit | Telp: 082255563343', -1.614013, 103.626208],
            [$K_PILAR, 'Hidran Pilar - Telkomsel Telecomunication Center', 'Jl. Slamet Riyadi No.24, Sungai Putri, Kec. Telanaipura, Kota Jambi, Jambi 36124', 'Hidran Pilar | Jumlah: 3 unit', -1.601189, 103.59432],
            [$K_PILAR, 'Hidran Pilar - JPM Trona', 'Jl. Jend. Sudirman No.90, Talang Jauh, Kec. Jelutung, Kota Jambi, Jambi 36133', 'Hidran Pilar | Jumlah: 3 unit', -1.601228, 103.619793],
            [$K_PILAR, 'Hidran Pilar - Infinity Hotel', 'Jl. Sultan Thaha No.60, Beringin, Kec. Ps. Jambi, Kota Jambi, Jambi 36124', 'Hidran Pilar | Jumlah: 1 unit | Telp: 07413066888', -1.589731, 103.614938],
            [$K_PILAR, 'Hidran Pilar - RSUD Raden Mattaher', 'Jl. Letjen Suprapto No.31, Telanaipura, Kec. Telanaipura, Kota Jambi, Jambi 36361', 'Hidran Pilar | Jumlah: 3 unit | Telp: 08117444747', -1.602709, 103.580331],
            [$K_PILAR, 'Hidran Pilar - Mandala Mart', 'CJ38+W8G, Jl. Camar I No.94-93, Sungai Asam, Kec. Ps. Jambi, Kota Jambi, Jambi 36123', 'Hidran Pilar | Jumlah: 4 unit | Telp: 0714146253', -1.59521, 103.615296],
            [$K_PILAR, 'Hidran Pilar - Meranti Swalayan', 'Jl. Gr. Djamin Datuk Bagindo No.52, Talang Banjar, Kec. Jambi Tim., Kota Jambi, Jambi 36121', 'Hidran Pilar | Jumlah: 1 unit | Telp: 074131702', -1.603052, 103.628177],
            [$K_PILAR, 'Hidran Pilar - Grand Hotel', 'Jl. Kapten Pattimura No.28, Simpang IV Sipin, Kec. Kota Baru, Kota Jambi, Jambi 36124', 'Hidran Pilar | Jumlah: 2 unit | Telp: 0741668899', -1.620075, 103.582691],
            [$K_PILAR, 'Hidran Pilar - Hotel BW Luxury', 'Jl. Soekarno-Hatta, Pasir Putih, Kec. Jambi Sel., Kota Jambi, Jambi 36139', 'Hidran Pilar | Jumlah: 6 unit | Telp: 07413072222', -1.619104, 103.629728],
            [$K_PILAR, 'Hidran Pilar - Hotel Shang Ratu', 'Jl. Slamet Riyadi No.24, Sungai Putri, Kec. Telanaipura, Kota Jambi, Jambi 36124', 'Hidran Pilar | Jumlah: 2 unit | Telp: 0741667788', -1.601221, 103.594395],
            [$K_PILAR, 'Hidran Pilar - Hotel Ratu', 'Komplek Mall Kapuk, Jl. M. Husni Thamrin No.18, Kebun Jahe, Kec. Jelutung, Kota Jambi, Jambi 36112', 'Hidran Pilar | Jumlah: 2 unit | Telp: 07413621888', -1.599698, 103.608786],
            [$K_PILAR, 'Hidran Pilar - RS Siloam', 'Jl. Soekarno-Hatta, Paal Merah, Kec. Jambi Sel., Kota Jambi, Jambi 36139', 'Hidran Pilar | Jumlah: 5 unit | Telp: 1500911', -1.627754, 103.635935],
            [$K_PILAR, 'Hidran Pilar - RS Adhyaksa', 'CJ99+9HM, Arab Melayu, Kec. Pelayangan, Kota Jambi, Jambi 36123', 'Hidran Pilar | Jumlah: 6 unit', -1.581323, 103.618909],
            [$K_PILAR, 'Hidran Pilar - RS H. Abdul Manap', 'Jl. Sk. Rd. Syahbudin, Mayang Mangurai, Alam Barajo, Kota Jambi, Jambi 36129', 'Hidran Pilar | Jumlah: 4 unit | Telp: 07415910190', -1.640483, 103.57965],
            [$K_PILAR, 'Hidran Pilar - Sucofindo', 'Jl. Sari Bakti, Bagan Pete, Kec. Kota Baru, Kota Jambi, Jambi 36361', 'Hidran Pilar | Jumlah: 2 unit | Telp: 07415783009', -1.649256, 103.560744],
            [$K_PILAR, 'Hidran Pilar - RSJD Kolonel H.M. Syukur Jambi', 'Jl. Dr. Purwadi No.KM. 9,5, Kenali Besar, Alam Barajo, Kota Jambi, Jambi 36129', 'Hidran Pilar | Jumlah: 6 unit | Telp: 0741580254', -1.609893, 103.553857],
            [$K_PILAR, 'Hidran Pilar - Mahligai 9', '9HRM+6H6, Jl. A Yani No.18, Telanaipura, Kec. Telanaipura, Kota Jambi, Jambi 36122', 'Hidran Pilar | Jumlah: 2 unit', -1.609115, 103.584204],
            [$K_PILAR, 'Hidran Pilar - Gedung FKIK Unja', '9HQM+P7P, Telanaipura, Kec. Telanaipura, Kota Jambi, Jambi 36361', 'Hidran Pilar | Jumlah: 2 unit', -1.610451, 103.583176],
            [$K_PILAR, 'Hidran Pilar - Gedung Pasca Sarjana Unja', 'Jl. H. Abdul Manaf, Telanaipura, Kec. Telanaipura, Kota Jambi, Jambi 36122', 'Hidran Pilar | Jumlah: 2 unit | Telp: 074160285', -1.610298, 103.580242],
            [$K_PILAR, 'Hidran Pilar - RS Bhayangkara', 'Jl. Raden Mattaher No.3, Rajawali, Jambi, Kota Jambi, Jambi 36361', 'Hidran Pilar | Jumlah: 2 unit | Telp: 074123246', -1.588919, 103.617881],
            [$K_PILAR, 'Hidran Pilar - Aston Hotel', '9JX3+4H6, Jl, Lebak Bandung, Jelutung, Jambi City, Jambi 36124', 'Hidran Pilar | Jumlah: 2 unit | Telp: 074133777', -1.601882, 103.603933],
            [$K_PILAR, 'Hidran Pilar - Swiss-Bell Hotel', 'Jl. Prof. Dr. Sumantri Brojonegoro Jl. Sumantri Brojonegoro No.1, Solok Sipin, Kec. Telanaipura, Kota Jambi, Jambi 36124', 'Hidran Pilar | Jumlah: 2 unit | Telp: 07415913388', -1.604356, 103.600941],
            [$K_PILAR, 'Hidran Pilar - Luminor Hotel', 'Jl. Mpu Gandring No.72, Kebun Jeruk, Kec. Telanaipura, Kota Jambi, Jambi 36121', 'Hidran Pilar | Jumlah: 1 unit | Telp: 082282888810', -1.603066, 103.601564],
            [$K_PILAR, 'Hidran Pilar - Abadi Suite Hotel', 'Jl. Prof. HMO Bafadhal No.111, Sungai Asam, Kec. Ps. Jambi, Kota Jambi, Jambi 36134', 'Hidran Pilar | Jumlah: 1 unit | Telp: 07417555800', -1.595529, 103.613379],
            [$K_PILAR, 'Hidran Pilar - Grha Siginjai / Kantor Walikota', 'Jl. Jenderal Basuki Rachmat No.01, Paal Lima, Kec. Kota Baru, Kota Jambi, Jambi 36129', 'Hidran Pilar | Jumlah: 2 unit', -1.628667, 103.608197],
            [$K_PILAR, 'Hidran Pilar - PDAM Tirta Mayang', 'CH2X+HJ8, Jl. Letkol Jl. Slamet Riyadi, Solok Sipin, Kec. Telanaipura, Kota Jambi, Jambi 36121', 'Hidran Pilar | Jumlah: 2 unit | Telp: 07417550126', -1.598489, 103.599063],
            [$K_PILAR, 'Hidran Pilar - Bank BRI Cabang Pasar', 'Jl. Halim Perdana Kusuma No.45, Sungai Asam, Kec. Ps. Jambi, Kota Jambi, Jambi 36381', 'Hidran Pilar | Jumlah: 2 unit | Telp: 07417552340', -1.597116, 103.61822],
            [$K_PILAR, 'Hidran Pilar - Bank BCA Cabang Pasar', 'Will Top Trade Center 1, Jl. Sultan Thaha No.17, Ps. Jambi, Kec. Ps. Jambi, Kota Jambi, Jambi 36000', 'Hidran Pilar | Jumlah: 2 unit | Telp: 0741500888', -1.591836, 103.616758],
            [$K_PILAR, 'Hidran Pilar - Resort Rumah Kito', 'Jl. Mayang Raya, Mayang Mangurai, Kec. Kota Baru, Kota Jambi, Jambi 36361', 'Hidran Pilar | Jumlah: 1 unit | Telp: 07415913199', -1.643083, 103.57708],
            [$K_PILAR, 'Hidran Pilar - Fresh Zone', 'Jl. Kol Pol M Thaher No.RT.11, RW.No.53, Tambak Sari, Kec. Jambi Sel., Kota Jambi, Jambi 36129', 'Hidran Pilar | Jumlah: 1 unit | Telp: 085283685588', -1.617829, 103.629731],
            [$K_PILAR, 'Hidran Pilar - Pertamina Patra Niaga', 'Jl. Raden Pamuk No.02, Kasang, Kec. Jambi Tim., Kota Jambi, Jambi 36265', 'Hidran Pilar | Jumlah: 1 unit | Telp: 074123240', -1.581183, 103.622847],
            [$K_PILAR, 'Hidran Pilar - PLN UP3', 'Jl. Jenderal Urip Sumoharjo No.02, Sungai Putri, Kec. Danau Tlk., Kota Jambi, Jambi 36122', 'Hidran Pilar | Jumlah: 1 unit', -1.607441, 103.592648],
            [$K_PILAR, 'Hidran Pilar - PT. Indofood CBP', '8HPH+VCP, Kenali Asam Bawah, Kec. Kota Baru, Kota Jambi, Jambi 36129', 'Hidran Pilar | Jumlah: 1 unit | Telp: 0741444800', -1.66263, 103.578494],
            [$K_PILAR, 'Hidran Pilar - Jamtos', 'Jl. Kapt. A. Bakaruddin No.88, Simpang IV Sipin, Kec. Telanaipura, Kota Jambi, Jambi 36361', 'Hidran Pilar | Jumlah: 3 unit | Telp: 074166595', -1.621497, 103.586877],
            [$K_PILAR, 'Hidran Pilar - PDAM Pasir Panjang', 'CH9G+M64, Pasir Panjang, Kec. Danau Tlk., Kota Jambi, Jambi 36361', 'Hidran Pilar | Jumlah: 1 unit', -1.580628, 103.575496],
            [$K_PILAR, 'Hidran Pilar - PDAM AURDURI', 'CG2X+PWV, Penyengat Rendah, Kec. Telanaipura, Kota Jambi, Jambi 36361', 'Hidran Pilar | Jumlah: 1 unit', -1.597896, 103.549903],

            // ===== POS DAMKAR =====
            [$K_POS, 'MAKO', 'Jl. HOS. Cokroaminoto, Suka Karya, Kec. Kota Baru, Kota Jambi', 'Markas Komando Damkar Kota Jambi (Kode Map: 9JJ2+Q76)', -1.633063, 103.600688],
            [$K_POS, 'POS ALAM BARAJO', 'JL. Sailendra Rw. Sari, Kec. Kota Baru, Kota Jambi', 'Pos Damkar Alam Barajo (Kode Map: 9HGG+H2M)', -1.623563, 103.575063],
            [$K_POS, 'POS JAMKOSE', 'Jl. Kh. M. Saleh Pasir Panjang, Kec. Danau Tlk., Kota Jambi', 'Pos Damkar Jambi Kota Seberang (Kode Map: CH9G+48M)', -1.582188, 103.575813],
            [$K_POS, 'POS JAMBI TIMUR', 'Jl. Prabu Siliwangi, Tj. Sari, Kec. Jambi Tim., Kota Jambi', 'Pos Damkar Jambi Timur (Kode Map: CJ5P+RPG)', -1.590438, 103.636813],
            [$K_POS, 'POS PALMERAH', 'Jl. Rb. Siagian, Talang Bakung, Kec. Jambi Sel., Kota Jambi', 'Pos Damkar Palmerah (Kode Map: 9M93+9PR)', -1.631563, 103.654313],
            [$K_POS, 'POS KOTA BARU', 'Jl. Lingkar Selatan, Kenali Asam Bawah, Kec. Kota Baru, Kota Jambi', 'Pos Damkar Kota Baru (Kode Map: 8JG4+PFG)', -1.673188, 103.606188],

            // ===== SUMBER AIR =====
            [$K_AIR, 'Embung Alam Barajo', 'Bagan Pete, Kec. Alam Barajo, Kota Jambi', 'Kategori: Embung | Luas: - | Kode Map: 8HG6+RM', -1.672875, 103.561688],
            [$K_AIR, 'Danau Sipin', 'Legok, Kec. Telanaipura, Kota Jambi, Jambi 36124', 'Kategori: Danau | Luas: - | Kode Map: CH2V+MR7', -1.598313, 103.594563],
            [$K_AIR, 'Danau Teluk', 'Kecamatan Danau Teluk, perbatasan Kelurahan Pasir Panjang, Tanjung Pasir, dan Olak Kemang', 'Kategori: Danau | Luas: - | Kode Map: CHCW+QRM', -1.578063, 103.597063],
            [$K_AIR, 'PT. REMCO', 'PT. REMCO, Tanjung Johor, Pelayangan, Jambi City, Jambi 36382', 'Sumber air industri', -1.5599130192842543, 103.630807419327],
            [$K_AIR, 'UPTD SPAL-D Kota Jambi', 'UPTD SPAL-D Kota Jambi Kasang Jaya, Kec. Jambi Tim., Kota Jambi, Jambi 36265', 'Sumber air pengolahan limbah (SPAL-D)', -1.5824433474245898, 103.62934369233535],

            // ===== WATER TRUCK =====
            [$K_TRUCK, 'PDAM Tirta Mayang', 'CH2X+HJ8, Jl. Letkol Jl. Slamet Riyadi, Solok Sipin, Kec. Telanaipura, Kota Jambi, Jambi 36121', 'Telp: (0741) 7550126', -1.5982957094930919, 103.59909562851657],
            [$K_TRUCK, 'RS BRATANATA / DKT', 'Jl. Raden Mattaher No.33, Sulanjana, Kec. Jambi Tim., Kota Jambi, Jambi 36144', 'Telp: 081267976023', -1.5929101317802739, 103.61837210970168],
            [$K_TRUCK, 'POLDA JAMBI', 'Jl. Jend. Sudirman No.45, Tambak Sari, Kec. Jambi Sel., Kota Jambi, Jambi 36138', 'Telp: 074134382', -1.6102740287373838, 103.62348348368893],
            [$K_TRUCK, 'KOREM 0415 GARUDA PUTIH', 'Jl. Jenderal Urip Sumoharjo No.3, Sungai Putri, Kec. Telanaipura, Kota Jambi, Jambi 36124', 'Telp: 074163053', -1.6101660555856856, 103.59203680970174],
            [$K_TRUCK, 'KODIM 142 / KJ KASANG', 'CJ8M+FMH, Kasang Jaya, East Jambi, Jambi City, Jambi 36264', 'Telp: 082282448112', -1.5836151010481663, 103.63423855462474],
            [$K_TRUCK, 'Pertamina Patra Niaga', 'CJ8F+27 Kasang, Jambi City, Jambi', 'Telp: 074123240', -1.5848183691610367, 103.6231715423203],
            [$K_TRUCK, 'BANDARA SULTAN THAHA SAIFUDDIN', '9J7V+5PC, Jl. Jawa, Paal Merah, Kec. Jambi Sel., Kota Jambi, Jambi 36127', 'Telp: 0741572344', -1.6368461091928153, 103.64437821340158],
            [$K_TRUCK, 'DLH', '9J94+HQ8, Paal Lima, Kota Baru, Jambi City, Jambi 36129', '-', -1.6309369199948167, 103.6069711833065],
            [$K_TRUCK, 'DENPAL', 'Jl. Raya Palembang - Jambi No.RT.01, RT.Pall/RW.17/RW, Pd. Meja, Kec. Mestong, Kabupaten Muaro Jambi, Jambi 36364', '-', -1.720617771307402, 103.57326159182345],
        ];

        $data = array_map(fn ($r) => [
            'kategori' => $r[0],
            'nama' => $r[1],
            'lokasi' => $r[2],
            'keterangan' => $r[3],
            'latitude' => $r[4],
            'longitude' => $r[5],
            'created_at' => $now,
            'updated_at' => $now,
        ], $rows);

        // Kosongkan tabel agar tidak duplikat saat seed ulang
        DB::table('titik_sigaps')->truncate();

        foreach (array_chunk($data, 50) as $chunk) {
            DB::table('titik_sigaps')->insert($chunk);
        }
    }
}

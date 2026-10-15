<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TitikSigapSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Kosongkan tabel terlebih dahulu agar tidak duplikat saat seed ulang
        DB::table('titik_sigaps')->truncate();

        $data = [
            // =========================================================
            // 1A. KATEGORI: HYDRANT KOTA (15 Titik - Tekanan Kuat)
            // =========================================================
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidran Jl. Slamet Riyadi (Murni)',
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Slamet riyadi, Kel. Murni, Kec. Danau sipin, RT -, Depan musium perjuangan',
                'keterangan'  => 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai',
                'latitude'    => -1.593688,
                'longitude'   => 103.607313,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidran Mayjen HM.J Singedekane',
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jln. Mayjen HM.J Singedekane, Kel. Sungai Putri, Kec. Danau Sipin, RT -, depan Telkom sto telanai',
                'keterangan'  => 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai',
                'latitude'    => -1.606438,
                'longitude'   => 103.589813,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidran Jl. Selamet Riyadi (Legok)',
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl selamet riyadi, Kel. Legok, Kec. Danau Sipin, RT 24, Lorong remaja',
                'keterangan'  => 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai',
                'latitude'    => -1.588938,
                'longitude'   => 103.598688,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidran Raden Pamuk',
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jln.Raden Pamuk, Kel. Beringin, Kec. Pasar Jambi, RT 17, depan ex BTN/angso duo',
                'keterangan'  => 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai',
                'latitude'    => -1.588938,
                'longitude'   => 103.613688,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidran Lorong Merpati',
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'lorong merpati, Kel. Beringin, Kec. Pasar Jambi, RT 08, Sebelah pos jaga masjid',
                'keterangan'  => 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai',
                'latitude'    => -1.594438,
                'longitude'   => 103.611188,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidran Husni Thamrin',
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jln Husni Thamrin, Kel. Beringin, Kec. Pasar Jambi, RT 13, Sebrang hotel Makmur',
                'keterangan'  => 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai',
                'latitude'    => -1.591438,
                'longitude'   => 103.613688,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidran Mako Damkar (HOS Cokroaminoto)',
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jln Hoscokro aminoto, Kel. Suka karya, Kec. Kota Baru, RT -, Halaman mako damkar',
                'keterangan'  => 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai',
                'latitude'    => -1.632438,
                'longitude'   => 103.600188,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidran Prof M Yamin',
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jln.Prof M Yamin, Kel. Payo lebar, Kec. Jelutung, RT 18, Depan Hotel Aini',
                'keterangan'  => 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Rusak | Ket: Tidak Bisa Dipakai/ Machino Rusak',
                'latitude'    => -1.621438,
                'longitude'   => 103.606188,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidran KH Msaleh (PDAM Pasir Panjang)',
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jln. KH Msaleh, Kel. Pasir Panjang, Kec. Danau Teluk, RT 02, PDAM Pasir Panjang',
                'keterangan'  => 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai',
                'latitude'    => -1.583938,
                'longitude'   => 103.588688,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidran Taruma Negara',
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jln. Taruma Negara, Kel. Tanjung Pinang, Kec. Jambi Timur, RT 12, depan KUA Jambi Timur',
                'keterangan'  => 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai',
                'latitude'    => -1.588688,
                'longitude'   => 103.632438,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidran Prabu Siliwangi (Pos Damkar)',
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jln. Prabu siliwangi, Kel. Tanjung Pinang, Kec. Jambi timur, RT 20, depan pos damkar',
                'keterangan'  => 'Hidran Kota | Kondisi: Rusak | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai',
                'latitude'    => -1.588938,
                'longitude'   => 103.638688,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidran Gr. Djamin Datuk Bagindo',
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Gr.Djamin Datuk Bagindo, Kel. Talang Banjar, Kec. Jambi timur, RT 06, Indomart',
                'keterangan'  => 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai/Kode Map Tidak Sesuai',
                'latitude'    => -1.597438,
                'longitude'   => 103.627688,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidran Bhayangkara',
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Bhayangkara, Kel. Talang Banjar, Kec. Jambi timur, RT 13, Simpang Meranti',
                'keterangan'  => 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai',
                'latitude'    => -1.603938,
                'longitude'   => 103.628688,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidran Pakubuwono/Saman',
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Pakubuwono/saman, Kel. Tanjung Pinang, Kec. Jambi timur, RT 22, belakang Pasar Baru Lama',
                'keterangan'  => 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai',
                'latitude'    => -1.596188,
                'longitude'   => 103.633688,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidran Pos Yankar Alam Barajo',
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Pos yankar alam barajo, Kel. Rawasari, Kec. Alam Barajo, RT 25, Posyankar Alam barajo',
                'keterangan'  => 'Hidran Kota | Kondisi: Baik | Tekanan: Kuat | Machino: Baik | Ket: Bisa Dipakai',
                'latitude'    => -1.626438,
                'longitude'   => 103.577688,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],

            // =========================================================
            // 1B. KATEGORI: HIDRANT PILAR (ID 1 - 16 dari prasaranas.sql)
            // =========================================================
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Pilar - INFINITY HOTEL', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Sultan Thaha No.60, Beringin, Kec. Ps. Jambi, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Pilar | Jumlah: 1 unit | Kode Map: CJ67+2X', //[cite: 2]
                'latitude'    => -1.589875,
                'longitude'   => 103.614938,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Pilar - RSUD RADEN MATAHER', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Letjen Suprapto No.31, Telanaipura, Kec. Telanaipura, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Pilar | Jumlah: 3 unit | Kode Map: 9HWJ+R3', //[cite: 2]
                'latitude'    => -1.602938,
                'longitude'   => 103.580188,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Pilar - mandala Mart', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Talang Bakung, Kec. Jambi Sel., Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Pilar | Jumlah: 4 unit | Kode Map: 9M76+PRG', //[cite: 2]
                'latitude'    => -1.635688,
                'longitude'   => 103.662063,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Pilar - Meranti', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Gr. Djamin Datuk Bagindo No.52, Talang Banjar, Kec. Jambi Tim., Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Pilar | Jumlah: 1 unit | Kode Map: 9JWH+P6', //[cite: 2]
                'latitude'    => -1.603188,
                'longitude'   => 103.628063,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Pilar - sekolah adiyaksa', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Jenderal Urip Sumoharjo No.33, Sungai Putri, Kec. Telanaipura, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Pilar | Jumlah: 1 unit | Kode Map: 9HQV+7H', //[cite: 2]
                'latitude'    => -1.611813,
                'longitude'   => 103.593938,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Pilar - RS RAPHA THERESIA', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jalan Kardinal J. Darmojuwono, Jl. Lingkar Selatan, Kelurahan Talang, Gulo, Kec. Kota Baru, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Pilar | Jumlah: 6 unit | Kode Map: 8JC7+6C', //[cite: 2]
                'latitude'    => -1.679438,
                'longitude'   => 103.613563,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Pilar - GRAND HOTEL', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Kapten Pattimura No.28, Simpang IV Sipin, Kec. Kota Baru, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Pilar | Jumlah: 2 unit | Kode Map: 9HHM+W3', //[cite: 2]
                'latitude'    => -1.620188,
                'longitude'   => 103.582688,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Pilar - HOTEL YELLO', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Komplek Transmart, Jl. Jend. Sudirman, Tambak Sari, Kec. Jambi Sel., Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Pilar | Jumlah: 2 unit | Kode Map: 9JPG+VX', //[cite: 2]
                'latitude'    => -1.612813,
                'longitude'   => 103.627438,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Pilar - RS HJ ADURRAHMAN SAYOOETI', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Olak Kemang, Kec. Danau Tlk., Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Pilar | Jumlah: 2 unit | Kode Map: CJ92+JQ9', //[cite: 2]
                'latitude'    => -1.580938,
                'longitude'   => 103.601938,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Pilar - HOTEL BW LUXURI', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Soekarno-Hatta, Pasir Putih, Kec. Jambi Sel., Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Pilar | Jumlah: 6 unit | Kode Map: 9JJH+7W', //[cite: 2]
                'latitude'    => -1.619313,
                'longitude'   => 103.629813,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Pilar - SHANG RATU', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Slamet Riyadi No.24, Sungai Putri, Kec. Telanaipura, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Pilar | Jumlah: 2 unit | Kode Map: 9HXV+CP', //[cite: 2]
                'latitude'    => -1.601438,
                'longitude'   => 103.594313,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Pilar - HOTEL DUTA', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Dr. Sam Ratulangi No.65-68, Ps. Jambi, Kec. Ps. Jambi, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Pilar | Jumlah: 1 unit | Kode Map: CJ58+5G', //[cite: 2]
                'latitude'    => -1.592063,
                'longitude'   => 103.616313,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Pilar - RS Siloam', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Soekarno-Hatta, Paal Merah, Kec. Jambi Sel., Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Pilar | Jumlah: 5 unit | Kode Map: 9JCP+R8', //[cite: 2]
                'latitude'    => -1.627938,
                'longitude'   => 103.635813,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Pilar - RS Adhyaksa', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Arab Melayu, Kec. Pelayangan, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Pilar | Jumlah: 6 unit | Kode Map: CJ99+9HM', //[cite: 2]
                'latitude'    => -1.581563,
                'longitude'   => 103.618938,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Pilar - RS H. Abdul Manap', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Sk. Rd. Syahbudin, Mayang Mangurai, Alam Barajo, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Pilar | Jumlah: 4 unit | Kode Map: 9H5H+MV', //[cite: 2]
                'latitude'    => -1.640813,
                'longitude'   => 103.579688,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Pilar - Sucofindo', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Sari Bakti, Bagan Pete, Kec. Kota Baru, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Pilar | Jumlah: 2 unit | Kode Map: 9H26+78', //[cite: 2]
                'latitude'    => -1.649313,
                'longitude'   => 103.560813,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],

            // =========================================================
            // 1C. KATEGORI: HIDRANT GEDUNG (ID 17 - 31 dari prasaranas.sql)
            // =========================================================
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Gedung - INFINITY HOTEL', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Sultan Thaha No.60, Beringin, Kec. Ps. Jambi, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Gedung | Jumlah: 9 unit | Kode Map: CJ67+2X', //[cite: 2]
                'latitude'    => -1.589875,
                'longitude'   => 103.614938,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Gedung - RSUD RADEN MATAHER', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Letjen Suprapto No.31, Telanaipura, Kec. Telanaipura, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Gedung | Jumlah: 24 unit | Kode Map: 9HWJ+R3', //[cite: 2]
                'latitude'    => -1.602938,
                'longitude'   => 103.580188,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Gedung - mandala Mart', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Talang Bakung, Kec. Jambi Sel., Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Gedung | Jumlah: 4 unit | Kode Map: 9M76+PRG', //[cite: 2]
                'latitude'    => -1.635688,
                'longitude'   => 103.662063,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Gedung - Meranti', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Gr. Djamin Datuk Bagindo No.52, Talang Banjar, Kec. Jambi Tim., Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Gedung | Jumlah: 5 unit | Kode Map: 9JWH+P6', //[cite: 2]
                'latitude'    => -1.603188,
                'longitude'   => 103.628063,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Gedung - sekolah adiyaksa', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Jenderal Urip Sumoharjo No.33, Sungai Putri, Kec. Telanaipura, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Gedung | Jumlah: 14 unit | Kode Map: 9HQV+7H', //[cite: 2]
                'latitude'    => -1.611813,
                'longitude'   => 103.593938,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Gedung - RS RAPHA THERESIA', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jalan Kardinal J. Darmojuwono, Jl. Lingkar Selatan, Kelurahan Talang, Gulo, Kec. Kota Baru, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Gedung | Jumlah: 14 unit | Kode Map: 8JC7+6C', //[cite: 2]
                'latitude'    => -1.679438,
                'longitude'   => 103.613563,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Gedung - GRAND HOTEL', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Kapten Pattimura No.28, Simpang IV Sipin, Kec. Kota Baru, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Gedung | Jumlah: 8 unit | Kode Map: 9HHM+W3', //[cite: 2]
                'latitude'    => -1.620188,
                'longitude'   => 103.582688,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Gedung - HOTEL YELLO', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Komplek Transmart, Jl. Jend. Sudirman, Tambak Sari, Kec. Jambi Sel., Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Gedung | Jumlah: 13 unit | Kode Map: 9JPG+VX', //[cite: 2]
                'latitude'    => -1.612813,
                'longitude'   => 103.627438,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Gedung - RS HJ ADURRAHMAN SAYOOETI', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Olak Kemang, Kec. Danau Tlk., Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Gedung | Jumlah: 4 unit | Kode Map: CJ92+JQ9', //[cite: 2]
                'latitude'    => -1.580938,
                'longitude'   => 103.601938,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Gedung - HOTEL BW LUXURI', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Soekarno-Hatta, Pasir Putih, Kec. Jambi Sel., Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Gedung | Jumlah: 34 unit | Kode Map: 9JJH+7W', //[cite: 2]
                'latitude'    => -1.619313,
                'longitude'   => 103.629813,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Gedung - SHANG RATU', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Slamet Riyadi No.24, Sungai Putri, Kec. Telanaipura, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Gedung | Jumlah: 12 unit | Kode Map: 9HXV+CP', //[cite: 2]
                'latitude'    => -1.601438,
                'longitude'   => 103.594313,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Gedung - HOTEL DUTA', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Dr. Sam Ratulangi No.65-68, Ps. Jambi, Kec. Ps. Jambi, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Gedung | Jumlah: 12 unit | Kode Map: CJ58+5G', //[cite: 2]
                'latitude'    => -1.592063,
                'longitude'   => 103.616313,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Gedung - RS Siloam', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Soekarno-Hatta, Paal Merah, Kec. Jambi Sel., Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Gedung | Jumlah: 9 unit | Kode Map: 9JCP+R8', //[cite: 2]
                'latitude'    => -1.627938,
                'longitude'   => 103.635813,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Gedung - RS Adhyaksa', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Arab Melayu, Kec. Pelayangan, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Gedung | Jumlah: 5 unit | Kode Map: CJ99+9HM', //[cite: 2]
                'latitude'    => -1.581563,
                'longitude'   => 103.618938,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'hydrant',
                'nama'        => 'Hidrant Gedung - RS H. Abdul Manap', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Sk. Rd. Syahbudin, Mayang Mangurai, Alam Barajo, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Hidrant Gedung | Jumlah: 8 unit | Kode Map: 9H5H+MV', //[cite: 2]
                'latitude'    => -1.640813,
                'longitude'   => 103.579688,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],

            // =========================================================
            // 2. KATEGORI: POS DAMKAR (6 Pos)
            // =========================================================
            [
                'kategori'    => 'pos',
                'nama'        => 'MAKO', //[cite: 1]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. HOS. Cokroaminoto, Suka Karya, Kec. Kota Baru, Kota Jambi', //[cite: 1]
                'keterangan'  => 'Markas Komando Damkar Kota Jambi (Kode Map: 9JJ2+Q76)', //[cite: 1]
                'latitude'    => -1.633063,
                'longitude'   => 103.600688,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'pos',
                'nama'        => 'POS ALAM BARAJO', //[cite: 1]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'JL. Sailendra Rw. Sari, Kec. Kota Baru, Kota Jambi', //[cite: 1]
                'keterangan'  => 'Pos Damkar Alam Barajo (Kode Map: 9HGG+H2M)', //[cite: 1]
                'latitude'    => -1.623563,
                'longitude'   => 103.575063,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'pos',
                'nama'        => 'POS JAMKOSE', //[cite: 1]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Kh. M. Saleh Pasir Panjang, Kec. Danau Tlk., Kota Jambi', //[cite: 1]
                'keterangan'  => 'Pos Damkar Jambi Kota Seberang (Kode Map: CH9G+48M)', //[cite: 1]
                'latitude'    => -1.582188,
                'longitude'   => 103.575813,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'pos',
                'nama'        => 'POS JAMBI TIMUR', //[cite: 1]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Prabu Siliwangi, Tj. Sari, Kec. Jambi Tim., Kota Jambi', //[cite: 1]
                'keterangan'  => 'Pos Damkar Jambi Timur (Kode Map: CJ5P+RPG)', //[cite: 1]
                'latitude'    => -1.590438,
                'longitude'   => 103.636813,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'pos',
                'nama'        => 'POS PALMERAH', //[cite: 1]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Rb. Siagian, Talang Bakung, Kec. Jambi Sel., Kota Jambi', //[cite: 1]
                'keterangan'  => 'Pos Damkar Palmerah (Kode Map: 9M93+9PR)', //[cite: 1]
                'latitude'    => -1.631563,
                'longitude'   => 103.654313,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'pos',
                'nama'        => 'POS KOTA BARU', //[cite: 1]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Jl. Lingkar Selatan, Kenali Asam Bawah, Kec. Kota Baru, Kota Jambi', //[cite: 1]
                'keterangan'  => 'Pos Damkar Kota Baru (Kode Map: 8JG4+PFG)', //[cite: 1]
                'latitude'    => -1.673188,
                'longitude'   => 103.606188,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],

            // =========================================================
            // 3. KATEGORI: SUMBER AIR (3 Titik Valid dari prasaranas.sql)
            // Catatan: Embung Kota Baru dilewati karena kode_maps NULL
            // =========================================================
            [
                'kategori'    => 'sumber_air',
                'nama'        => 'Embung Alam Barajo', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Bagan Pete, Kec. Alam Barajo, Kota Jambi', //[cite: 2]
                'keterangan'  => 'Kategori: Embung | Luas: - | Kode Map: 8HG6+RM', //[cite: 2]
                'latitude'    => -1.672875,
                'longitude'   => 103.561688,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'sumber_air',
                'nama'        => 'Danau Sipin', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Legok, Kec. Telanaipura, Kota Jambi, Jambi 36124', //[cite: 2]
                'keterangan'  => 'Kategori: Danau | Luas: - | Kode Map: CH2V+MR7', //[cite: 2]
                'latitude'    => -1.598313,
                'longitude'   => 103.594563,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'kategori'    => 'sumber_air',
                'nama'        => 'Danau Teluk', //[cite: 2]
                'tanggal'     => $now->toDateString(),
                'lokasi'      => 'Kecamatan Danau Teluk, perbatasan Kelurahan Pasir Panjang, Tanjung Pasir, dan Olak Kemang', //[cite: 2]
                'keterangan'  => 'Kategori: Danau | Luas: - | Kode Map: CHCW+QRM', //[cite: 2]
                'latitude'    => -1.578063,
                'longitude'   => 103.597063,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        DB::table('titik_sigaps')->insert($data);
    }
}
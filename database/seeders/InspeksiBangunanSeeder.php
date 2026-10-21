<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InspeksiBangunanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menghapus data lama agar tidak duplikat saat dijalankan ulang
        DB::table('inspeksi_bangunans')->truncate();

        $data = [
            [
                'nama_tempat' => 'INFINITY HOTEL',
                'tanggal_inspeksi' => '2025-02-06',
                'jenis_usaha' => 'HOTEL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'RSUD RADEN MATAHER',
                'tanggal_inspeksi' => '2025-02-13',
                'jenis_usaha' => 'RUMAH SAKIT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'PT. Trona sentosa lestari',
                'tanggal_inspeksi' => '2025-02-20',
                'jenis_usaha' => 'Mall',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'Mandala ',
                'tanggal_inspeksi' => '2025-03-04',
                'jenis_usaha' => 'MALL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'mandala Mart',
                'tanggal_inspeksi' => '2025-03-04',
                'jenis_usaha' => 'MALL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'Meranti',
                'tanggal_inspeksi' => '2025-03-04',
                'jenis_usaha' => 'MALL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'PT. baja abadi indonesia',
                'tanggal_inspeksi' => '2025-03-05',
                'jenis_usaha' => 'Industri',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'sekolah adiyaksa',
                'tanggal_inspeksi' => '2025-03-14',
                'jenis_usaha' => 'Sekolah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'BPKBN PROVINSI',
                'tanggal_inspeksi' => '2025-04-15',
                'jenis_usaha' => 'Kantor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'RS RAPHA THERESIA',
                'tanggal_inspeksi' => '2025-04-24',
                'jenis_usaha' => 'RUMAH SAKIT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'HW HELEN\'S PLAY MART',
                'tanggal_inspeksi' => '2025-05-04',
                'jenis_usaha' => 'HIBURAN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'MCDonal\'s The Hok',
                'tanggal_inspeksi' => '2025-05-07',
                'jenis_usaha' => 'Resto',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'MCDonal\'s Sipin',
                'tanggal_inspeksi' => '2025-05-07',
                'jenis_usaha' => 'Resto',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'LABORATORIUM KESEHATAN PROVINSI',
                'tanggal_inspeksi' => '2025-05-08',
                'jenis_usaha' => 'LABOR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'PT FAANZA JAYA SUKSES',
                'tanggal_inspeksi' => '2025-05-15',
                'jenis_usaha' => 'PERUMAHAN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'BPS PROVINSI JAMBI',
                'tanggal_inspeksi' => '2025-06-06',
                'jenis_usaha' => 'kantor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'PT. Karya Nature Biomas',
                'tanggal_inspeksi' => '2025-06-10',
                'jenis_usaha' => 'Gudang Produksi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'GRAND HOTEL',
                'tanggal_inspeksi' => '2025-06-10',
                'jenis_usaha' => 'HOTEL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'LABOR ALKANA  LAB',
                'tanggal_inspeksi' => '2025-06-18',
                'jenis_usaha' => 'LABOR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'DINAS KEARSIPAN',
                'tanggal_inspeksi' => '2025-06-19',
                'jenis_usaha' => 'KANTOR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'HOTEL YELLO',
                'tanggal_inspeksi' => '2025-06-25',
                'jenis_usaha' => 'HOTEL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'PT. SANCAYA MANDIRI CIPTA',
                'tanggal_inspeksi' => '2025-07-21',
                'jenis_usaha' => 'NH',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'RS ERNI MEDIKA',
                'tanggal_inspeksi' => '2025-07-21',
                'jenis_usaha' => 'RUMAH SAKIT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'PT Sampoerna',
                'tanggal_inspeksi' => '2025-07-21',
                'jenis_usaha' => 'Gudang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'KONSULTAN PELAYANAN GIJI',
                'tanggal_inspeksi' => '2025-07-22',
                'jenis_usaha' => 'HOTEL & CAPE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'JB HERITAGE HOTEL & CONVENTION',
                'tanggal_inspeksi' => '2025-07-29',
                'jenis_usaha' => 'HOTEL & CAPE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'PDAM TIRTA MAYANG',
                'tanggal_inspeksi' => '2025-08-07',
                'jenis_usaha' => 'PDAM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'RS KAMBANG',
                'tanggal_inspeksi' => '2025-08-11',
                'jenis_usaha' => 'RUMAH SAKIT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'KANTOR WALIKOTA  ',
                'tanggal_inspeksi' => '2025-09-01',
                'jenis_usaha' => 'kantor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'DPTSP',
                'tanggal_inspeksi' => '2025-09-01',
                'jenis_usaha' => 'kantor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'DPRD KOTA JAMBI',
                'tanggal_inspeksi' => '2025-09-01',
                'jenis_usaha' => 'kantor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'DPRD PROVINSI',
                'tanggal_inspeksi' => '2025-09-01',
                'jenis_usaha' => 'kantor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'RS HJ ADURRAHMAN SAYOOETI',
                'tanggal_inspeksi' => '2025-09-15',
                'jenis_usaha' => 'RUMAH SAKIT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'PT. LUMBUNG MAS PRATAMA',
                'tanggal_inspeksi' => '2025-09-17',
                'jenis_usaha' => 'Hotel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'GEDUNG TTC TELKOMSEL',
                'tanggal_inspeksi' => '2025-09-18',
                'jenis_usaha' => 'TELKOMSEL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'HOTEL BW LUXURI',
                'tanggal_inspeksi' => '2025-10-04',
                'jenis_usaha' => 'Hotel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'JASA RAHARA',
                'tanggal_inspeksi' => '2025-10-08',
                'jenis_usaha' => 'kantor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'SHANG RATU',
                'tanggal_inspeksi' => '2025-10-29',
                'jenis_usaha' => 'Hotel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'HOTEL RATU',
                'tanggal_inspeksi' => '2025-10-29',
                'jenis_usaha' => 'Hotel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'BPJS KETENAGAKERJAAN',
                'tanggal_inspeksi' => '2025-10-29',
                'jenis_usaha' => 'kantor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'BANK 9 JAMBI CABANG SUTOMO',
                'tanggal_inspeksi' => '2025-10-30',
                'jenis_usaha' => 'Bank',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'HOTEL DUTA',
                'tanggal_inspeksi' => '2025-10-30',
                'jenis_usaha' => 'Hotel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'PT. INTISUMBER HASIL SAMPURNA GOBAL',
                'tanggal_inspeksi' => '2025-11-13',
                'jenis_usaha' => 'gudang hotel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'GRAHA SIGINJAI',
                'tanggal_inspeksi' => '2025-11-24',
                'jenis_usaha' => 'kantor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'PT. Jambi Bangun Bara Persada SPBU 24.361.08 ',
                'tanggal_inspeksi' => '2025-12-02',
                'jenis_usaha' => 'SPBU ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'Pengadilan Tinggi Negeri Jambi',
                'tanggal_inspeksi' => '2025-12-05',
                'jenis_usaha' => 'Pemerintah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'Inul Vista',
                'tanggal_inspeksi' => '2025-12-08',
                'jenis_usaha' => 'Hiburan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'Masterpiece Karaoke',
                'tanggal_inspeksi' => '2025-12-08',
                'jenis_usaha' => 'Hiburan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'Pos Jambi Soetomo',
                'tanggal_inspeksi' => '2025-12-08',
                'jenis_usaha' => 'Kantor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'PT. Jambi Lestari Internasional',
                'tanggal_inspeksi' => '2025-12-12',
                'jenis_usaha' => 'LABOR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'RS Siloam',
                'tanggal_inspeksi' => '2025-12-12',
                'jenis_usaha' => 'RUMAH SAKIT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'RS Adhyaksa',
                'tanggal_inspeksi' => '2025-12-13',
                'jenis_usaha' => 'RUMAH SAKIT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'SPBU PT AZKA LESTARI',
                'tanggal_inspeksi' => '2025-12-17',
                'jenis_usaha' => 'SPBU ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'RS Baiturrahim',
                'tanggal_inspeksi' => '2025-12-17',
                'jenis_usaha' => 'RUMAH SAKIT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'RS H. Abdul Manap',
                'tanggal_inspeksi' => '2025-12-18',
                'jenis_usaha' => 'RUMAH SAKIT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'Pabrik Kopi AAA',
                'tanggal_inspeksi' => '2025-12-24',
                'jenis_usaha' => 'INDUSTRI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'Pabrik Kopi Paman',
                'tanggal_inspeksi' => '2025-12-24',
                'jenis_usaha' => 'INDUSTRI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'Sucofindo',
                'tanggal_inspeksi' => '2025-12-30',
                'jenis_usaha' => 'LABOR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'PT Taspen',
                'tanggal_inspeksi' => '2025-12-31',
                'jenis_usaha' => 'ASURANSI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'BTN Telanaipura',
                'tanggal_inspeksi' => '2025-12-31',
                'jenis_usaha' => 'BANK',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // Menyaring data yang tidak memiliki nama_tempat (karena di excel ada baris kosong)
        $filteredData = array_filter($data, function($item) {
            return !empty($item['nama_tempat']);
        });

        DB::table('inspeksi_bangunans')->insert($filteredData);
    }
}
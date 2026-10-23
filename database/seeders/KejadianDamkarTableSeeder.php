<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KejadianDamkarTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('kejadian_damkar')->delete();
        
        \DB::table('kejadian_damkar')->insert(array (
            0 => 
            array (
                'id' => 49,
                'judul' => 'RESPON CEPAT PEMKOT JAMBI, DAMKARTAN SIAGA LAYANI MASYARAKAT!',
                'jenis' => 'pemadaman',
                'lokasi' => 'Kecamatan Alam Barajo, Kota Jambi',
                'tanggal' => '2026-10-22 14:30:00',
                'deskripsi' => 'Respon cepat peleton pemadam kebakaran Kota Jambi menangani kebakaran rumah warga. Api berhasil dipadamkan sebelum merambat ke bangunan sekitar.',
                'link' => 'https://www.instagram.com/reel/DetgoT6SHcT/?exln=NnFhd3E1emZ4Zml3',
                'sumber' => 'Instagram',
                'gambar' => 'kejadian/tA2ewsOoQ3acDAAoVwAFxHq33v3WdsxhazmWhvqe.jpg',
                'youtube_id' => NULL,
                'created_at' => '2026-10-23 02:36:07',
                'updated_at' => '2026-10-23 02:39:46',
            ),
            1 => 
            array (
                'id' => 50,
                'judul' => 'Evakuasi Biawak',
                'jenis' => 'evakuasi',
                'lokasi' => 'Kecamatan Paal Merah, Kota Jambi',
                'tanggal' => '2026-10-21 09:15:00',
                'deskripsi' => 'Evakuasi Biawak
Alamat Pelapor : Perumahan Sawang Asri A3 Lorong Ambarawa, Simpang III Sipin. Kota Baru, Jambi
Satuan Tugas : 
 - Pleton 3 Mako',
                'link' => 'https://www.instagram.com/reel/Dd7sUxWt_pK/?exln=NTh2eW9wMXhqaGVm',
                'sumber' => 'Instagram',
                'gambar' => 'kejadian/y0KcdSgfhvoFQox5y3whkgJD4th3ogbkcaAVjPGX.jpg',
                'youtube_id' => NULL,
                'created_at' => '2026-10-23 02:36:14',
                'updated_at' => '2026-10-23 02:42:27',
            ),
            2 => 
            array (
                'id' => 51,
                'judul' => 'Evakuasi Anak Kucing',
                'jenis' => 'penyelamatan',
                'lokasi' => 'Perum. Villa Ratu Emas Blok F.13 RT.19 Kelurahan. Bakung Jaya Kecamatan. Paal merah',
                'tanggal' => '2026-10-20 16:45:00',
                'deskripsi' => 'Evakuasi Anak Kucing
Alamat Pelapor : Perum. Villa Ratu Emas Blok F.13 RT.19 Kelurahan. Bakung Jaya Kecamatan. Paal merah
Satuan Tugas : 
 - Regu 2 Posyankar Paal Merah

Hasil Tindakan : Berjalan dengan lancar sesuai SOP',
                'link' => 'https://www.instagram.com/reel/Dd5JVGktay7/?cplk=MWo5NTg3Z2hzZnFqdQ==',
                'sumber' => 'Instagram',
                'gambar' => 'kejadian/dFy4JeJrF1czei570Aa1x62QfAxymZNIakyXBx5L.jpg',
                'youtube_id' => NULL,
                'created_at' => '2026-10-23 02:36:20',
                'updated_at' => '2026-10-23 02:43:54',
            ),
            3 => 
            array (
                'id' => 52,
                'judul' => 'Evakuasi Biawak',
                'jenis' => 'evakuasi',
                'lokasi' => 'Jl. Slamet Riyadi, lorong skip 2 no. 40. RT. 21. Kel. Solok Sipin',
                'tanggal' => '2026-10-20 11:20:00',
                'deskripsi' => 'Satuan Tugas : 
 - Pleton 1 Mako

Hasil Tindakan : Berjalan dengan lancar sesuai SOP',
                'link' => 'https://www.instagram.com/p/Dd5GIf7kscV/?exln=MXJhaGdqMWNxeWE5dA==',
                'sumber' => 'Instagram',
                'gambar' => 'kejadian/eG0Uz3pmZVF2903qa8JhMW5s7qau5slh4LxYytVX.jpg',
                'youtube_id' => NULL,
                'created_at' => '2026-10-23 02:36:27',
                'updated_at' => '2026-10-23 02:46:36',
            ),
            4 => 
            array (
                'id' => 53,
                'judul' => 'Kebakaran Lahan',
                'jenis' => 'pemadaman',
                'lokasi' => 'Jl. Raden Patah RT 04 Kel. Sejinjang, Kec. Jambi Timur',
                'tanggal' => '2026-10-19 20:00:00',
                'deskripsi' => 'Satuan Tugas : 
 - Regu 3 Posyankar Jambi Timur 

Hasil Tindakan : Berjalan dengan lancar sesuai SOP',
                'link' => 'https://www.instagram.com/p/DdncU2ZidkL/?vrfl=aWwyaWZoM3lwbXgw',
                'sumber' => 'Instagram',
                'gambar' => 'kejadian/hcnTcuFvl8GXRFJL1vsrnto2BFFNLJwBMCZbZknD.jpg',
                'youtube_id' => NULL,
                'created_at' => '2026-10-23 02:36:34',
                'updated_at' => '2026-10-23 02:46:12',
            ),
            5 => 
            array (
                'id' => 54,
                'judul' => 'Evakuasi Lebah Madu',
                'jenis' => 'evakuasi',
                'lokasi' => 'Jl. Jendral Sudirman No.45 Kel. Tambak Sari Kec. Jambi Selatan',
                'tanggal' => '2026-10-19 10:10:00',
                'deskripsi' => 'Satuan Tugas : 
 - Regu 3 Mako

Hasil Tindakan : Berjalan dengan lancar sesuai SOP',
                'link' => 'https://www.instagram.com/p/DdnbTeRiT_L/?exln=MXF3ZjZnOGhnZGd6Yg==',
                'sumber' => 'Instagram',
                'gambar' => 'kejadian/FnCmijoxQUNhB2b1Kem9t0dCih0erq5Ncpo8zrd2.jpg',
                'youtube_id' => NULL,
                'created_at' => '2026-10-23 02:36:41',
                'updated_at' => '2026-10-23 02:47:36',
            ),
            6 => 
            array (
                'id' => 55,
                'judul' => 'Kebakaran Rumah',
                'jenis' => 'pemadaman',
                'lokasi' => 'RT.28 Kel. Talang Banjar Kec. Jambi Timur',
                'tanggal' => '2026-10-18 18:30:00',
                'deskripsi' => 'Satuan Tugas :
 - Regu 3 Posyankar Jambi Timur

Hasil Tindakan : Berjalan dengan lancar sesuai SOP',
                'link' => 'https://www.instagram.com/p/Ddlzk41pcnJ/?xtok=dmc2YnAxeDB0dnQy',
                'sumber' => 'Instagram',
                'gambar' => 'kejadian/wuu05UNhbiuTMaHM5mp8MuQlxWitr4PUs1Lpf0aT.jpg',
                'youtube_id' => NULL,
                'created_at' => '2026-10-23 02:36:47',
                'updated_at' => '2026-10-23 02:48:44',
            ),
            7 => 
            array (
                'id' => 56,
                'judul' => 'Kebakaran Bagian Atap 1 Unit Bangunan Permanen',
                'jenis' => 'pemadaman',
                'lokasi' => 'Jl. HM Yusuf Nasri Lrg. Mangga Besar Rt. 07 No. 01 Kel. Wijaya Pura Kec. Jambi Selatan',
                'tanggal' => '2026-10-17 07:45:00',
                'deskripsi' => 'Pimpinan Operasi : Sekretaris Damkartan Kota Jambi
Pendamping Operasi : 
 - Danton 2 Mako
 - Danpos Jambi Timur
Satuan Tugas : 
 - Pleton 2 mako
 - Regu 2 Posyankar Jambi Timur
 - Regu 2 Posyankar Paal Merah

Hasil Tindakan : Berjalan dengan lancar sesuai SOP',
                'link' => 'https://www.instagram.com/p/DdSgMLfCcLQ/?obrf=Y2pycW91NnM0YjYx',
                'sumber' => 'Instagram',
                'gambar' => 'kejadian/xxnyt6fA3doa0F33xe7UHuJ120izrcmOnOkTja2T.jpg',
                'youtube_id' => NULL,
                'created_at' => '2026-10-23 02:36:56',
                'updated_at' => '2026-10-23 02:51:44',
            ),
            8 => 
            array (
                'id' => 57,
                'judul' => 'Kebakaran lahan',
                'jenis' => 'pemadaman',
                'lokasi' => 'Lrg tukang jait Rt.07 Kel.lebak bandung',
                'tanggal' => '2026-10-17 15:20:00',
                'deskripsi' => 'Satuan Tugas :
- Pleton 1 Mako

Hasil Tindakan : Berjalan dengan lancar sesuai SOP',
                'link' => 'https://www.instagram.com/p/DdQFCXAiVmY/?rpxt=MTBueXExNmliMzM3OQ==',
                'sumber' => 'Instagram',
                'gambar' => 'kejadian/c5xoI7QfGEUZuZjJhpUaM4b119Jk1EOso8d7tpkx.jpg',
                'youtube_id' => NULL,
                'created_at' => '2026-10-23 02:37:03',
                'updated_at' => '2026-10-23 02:51:32',
            ),
            9 => 
            array (
                'id' => 58,
                'judul' => 'Evakuasi Kucing',
                'jenis' => 'evakuasi',
                'lokasi' => 'Jl. Flores No.3 Kel. Jelutung Kec. Jelutung',
                'tanggal' => '2026-10-16 22:10:00',
                'deskripsi' => 'Satuan Tugas : 
 - Regu 3 Mako

Hasil Tindakan : Berjalan dengan lancar sesuai SOP',
                'link' => 'https://www.instagram.com/p/Dcui73qCU7E/?psln=cHpjb205bms2aDEy',
                'sumber' => 'Instagram',
                'gambar' => 'kejadian/Jkpd4sXjfJC0IWCkG526s4qu923naxvgP8rx5jTm.jpg',
                'youtube_id' => NULL,
                'created_at' => '2026-10-23 02:37:10',
                'updated_at' => '2026-10-23 02:52:35',
            ),
            10 => 
            array (
                'id' => 59,
                'judul' => 'Kebakaran Ruko',
                'jenis' => 'pemadaman',
                'lokasi' => 'Simpang 3 Kebun Kopi, Kel. Handil jaya Kec. Jelutung',
                'tanggal' => '2026-10-16 08:00:00',
                'deskripsi' => 'Satuan Tugas : 
 - Regu 3 Mako

Hasil Tindakan : Berjalan dengan lancar sesuai SOP',
                'link' => 'https://www.instagram.com/p/DcugV6MCXtM/?rpxt=dXVpbGZrMGNzaXQy',
                'sumber' => 'Instagram',
                'gambar' => 'kejadian/iaGKpbiFBDuQHmRjLTtujonUJNm8xl7ULiQudlZt.jpg',
                'youtube_id' => NULL,
                'created_at' => '2026-10-23 02:37:17',
                'updated_at' => '2026-10-23 02:53:14',
            ),
            11 => 
            array (
                'id' => 60,
                'judul' => 'kebakaran di cempaka putih',
                'jenis' => 'pemadaman',
                'lokasi' => 'RT 23 Cempaka Putih, Kecamatan Jelutung, Kota Jambi',
                'tanggal' => '2026-10-15 17:30:00',
            'deskripsi' => 'Butuh 60 personel, 12 unit armada, dan 95.000 liter air untuk menangani kebakaran di RT 23 Cempaka Putih, Kecamatan Jelutung, Kota Jambi, Sabtu (29/08/2026).

Laporan diterima petugas pada pukul 13.51 WIB dengan response time delapan menit. Operasi pemadaman yang dipimpin Kepala Dinas Damkartan berlangsung selama 3 jam 15 menit',
            'link' => 'https://www.instagram.com/reel/Dcn2xC4PcL2/?psln=MTN4aGlxdG5oZGM1aA==',
            'sumber' => 'Instagram',
            'gambar' => 'kejadian/ndJVPPJhVDLDByrqDBb0BVn08lO2vPjZPtGgg1tl.jpg',
            'youtube_id' => NULL,
            'created_at' => '2026-10-23 02:37:25',
            'updated_at' => '2026-10-23 02:54:58',
        ),
        12 => 
        array (
            'id' => 61,
            'judul' => 'waspada kabut asap',
            'jenis' => 'penyelamatan',
            'lokasi' => 'l. HOS. Cokroaminoto, Suka Karya, Kec. Kota Baru, Kota Jambi, Jambi',
            'tanggal' => '2026-10-14 13:20:00',
            'deskripsi' => 'kualitas udara kota jambi sedang TIDAK SEHAT',
            'link' => 'https://www.instagram.com/p/Dce9dRTpQzt/?dlrf=MXNlcDBrNTZwZGE1eg==',
            'sumber' => 'Instagram',
            'gambar' => 'kejadian/kb6VSPFqGIpXSgbbWm2s9qnXQr16vIasArGx5Pg4.jpg',
            'youtube_id' => NULL,
            'created_at' => '2026-10-23 02:37:32',
            'updated_at' => '2026-10-23 02:56:59',
        ),
        13 => 
        array (
            'id' => 62,
            'judul' => 'Evakuasi Ular Sanca',
            'jenis' => 'evakuasi',
            'lokasi' => 'Jl. R. SYABUDIN KOMP. VILLA KENALI PERMAI BLOK M 4 NO 12 RT.018 KEL.MAYANG MANGURAI KEC. ALAM BARAJO',
            'tanggal' => '2026-10-13 16:00:00',
            'deskripsi' => 'Satuan Tugas :
- Pleton 3 Mako

Hasil Tindakan : Berjalan dengan lancar sesuai SOP',
            'link' => 'https://www.instagram.com/p/DcQgKWSCYbr/?obrf=MWtqem9qYXRqYzd3dA==',
            'sumber' => 'Instagram',
            'gambar' => 'kejadian/Ed0ePZutuvA4Cl4nUOoUVXiuzSqxnCAEeExDaFU3.jpg',
            'youtube_id' => NULL,
            'created_at' => '2026-10-23 02:37:37',
            'updated_at' => '2026-10-23 02:57:55',
        ),
        14 => 
        array (
            'id' => 63,
            'judul' => 'Kebakaran Lahan',
            'jenis' => 'pemadaman',
            'lokasi' => 'Jl. Kh. Hasan Anang RT.04 kelurahan Olak Kemang',
            'tanggal' => '2026-10-13 09:45:00',
            'deskripsi' => 'Satuan Tugas :
- Posyankar Regu 1 Jamkose 

Hasil Tindakan : Berjalan dengan lancar sesuai SOP',
            'link' => 'https://www.instagram.com/p/DcQfGfyCY8D/?rpxt=NzFpMWxvY3ZrcjZi',
            'sumber' => 'Instagram',
            'gambar' => 'kejadian/H4CObpWwEln8kiGgFlg7LgjxO3EO4iAXi7YNOWo8.jpg',
            'youtube_id' => NULL,
            'created_at' => '2026-10-23 02:37:42',
            'updated_at' => '2026-10-23 02:58:50',
        ),
    ));
        
        
    }
}
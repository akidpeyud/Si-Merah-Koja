<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemuaAlatPenyelamatanSeeder extends Seeder
{
    public function run()
    {
        $apd_rescues = [
            ['nama_penerima' => 'Edi Bambang ', 'jabatan' => 'Danton I Mako', 'jumlah' => '2 Set', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Bambang Sugiono', 'jabatan' => 'Danton II Mako', 'jumlah' => '2 Set', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Kasianto', 'jabatan' => 'Danton III Mako', 'jumlah' => '2 Set', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'M. Hafis ', 'jabatan' => 'Danpos Alam Barajo', 'jumlah' => '2 Set', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'M. Rusdi', 'jabatan' => 'Danpos Jamkose', 'jumlah' => '2 Set', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Wilopo', 'jabatan' => 'Danpos Jambi Timur', 'jumlah' => '2 Set', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Herman Yanto', 'jabatan' => 'Danpos Palmerah', 'jumlah' => '2 Set', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Dwi Wahyudi ', 'jabatan' => 'Danpos Kota Baru', 'jumlah' => '2 Set', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Julianto', 'jabatan' => 'Komandan Kompi', 'jumlah' => '3 Set', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => 'Di tempatkan di Armada Komando'],
            ['nama_penerima' => 'M. Sanusi', 'jabatan' => 'Danru Ton I Mako', 'jumlah' => '2 Set', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Bambang Sugiono', 'jabatan' => 'Danton II Mako', 'jumlah' => '2 Set', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Adriansyah', 'jabatan' => 'Danru Ton III Mako', 'jumlah' => '2 Set', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Kms. Muammar', 'jabatan' => 'Danpos Alam Barajo', 'jumlah' => '2 Set', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Dwi Wahyudi ', 'jabatan' => 'Danpos Kota Baru', 'jumlah' => '1 Set', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'M. Nasir', 'jabatan' => 'Anggota Pos Palmerah', 'jumlah' => '1 Set', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'M. Syafiq', 'jabatan' => 'Anggota Pos Palmerah', 'jumlah' => '1 Set', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Misbah', 'jabatan' => 'Anggota Pos Jambi Timur', 'jumlah' => '1 Set', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Nanda', 'jabatan' => 'Anggota Pos Jambi Timur', 'jumlah' => '1 Set', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Dedi Agung Pambudi', 'jabatan' => 'Anggota Pos Jamkose', 'jumlah' => '1 Set', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Bambang Sugiono', 'jabatan' => 'Danton II Mako', 'jumlah' => '1 Set', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
        ];
        DB::table('apd_rescues')->insert($apd_rescues);

        $baju_evakuasi_lebahs = [
            ['nama_penerima' => 'Edi Bambang ', 'jabatan' => 'Danton I Mako', 'jumlah' => '1 BUAH', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Bambang Sugiono', 'jabatan' => 'Danton II Mako', 'jumlah' => '1 BUAH', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Kasianto', 'jabatan' => 'Danton III Mako', 'jumlah' => '1 BUAH', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'M. Hafis ', 'jabatan' => 'Danpos Alam Barajo', 'jumlah' => '1 BUAH', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'M. Rusdi', 'jabatan' => 'Danpos Jamkose', 'jumlah' => '1 BUAH', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Wilopo', 'jabatan' => 'Danpos Jambi Timur', 'jumlah' => '1 BUAH', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Herman Yanto', 'jabatan' => 'Danpos Palmerah', 'jumlah' => '1 BUAH', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Dwi Wahyudi ', 'jabatan' => 'Danpos Kota Baru', 'jumlah' => '1 BUAH', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
        ];
        DB::table('baju_evakuasi_lebahs')->insert($baju_evakuasi_lebahs);

        $box_tempat_ulars = [
            ['nama_penerima' => 'Edi Bambang ', 'jabatan' => 'Danton I Mako', 'jumlah' => '1 Unit', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Bambang Sugiono', 'jabatan' => 'Danton II Mako', 'jumlah' => '1 Unit', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Kasianto', 'jabatan' => 'Danton III Mako', 'jumlah' => '1 Unit', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'M. Hafis ', 'jabatan' => 'Danpos Alam Barajo', 'jumlah' => '1 Unit', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'M. Rusdi', 'jabatan' => 'Danpos Jamkose', 'jumlah' => '1 Unit', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Wilopo', 'jabatan' => 'Danpos Jambi Timur', 'jumlah' => '1 Unit', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Herman Yanto', 'jabatan' => 'Danpos Palmerah', 'jumlah' => '1 Unit', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Dwi Wahyudi ', 'jabatan' => 'Danpos Kota Baru', 'jumlah' => '1 Unit', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
        ];
        DB::table('box_tempat_ulars')->insert($box_tempat_ulars);

        $helm_climbings = [
            ['nama_penerima' => 'Juliansyah Sulaiman', 'jabatan' => 'Danru I Ton II Mako', 'jumlah' => '1', 'tahun' => '2025', 'kondisi' => 'Baik', 'keterangan' => 'Digunakan Untuk Penyelamatan sebanyak 4 unit'],
        ];
        DB::table('helm_climbings')->insert($helm_climbings);

        $stik_ulars = [
            ['nama_penerima' => 'Edi Bambang ', 'jabatan' => 'Danton I Mako', 'jumlah' => '1 Unit', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Bambang Sugiono', 'jabatan' => 'Danton II Mako', 'jumlah' => '1 Unit', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Kasianto', 'jabatan' => 'Danton III Mako', 'jumlah' => '1 Unit', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'M. Hafis ', 'jabatan' => 'Danpos Alam Barajo', 'jumlah' => '1 Unit', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'M. Rusdi', 'jabatan' => 'Danpos Jamkose', 'jumlah' => '1 Unit', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Wilopo', 'jabatan' => 'Danpos Jambi Timur', 'jumlah' => '1 Unit', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Herman Yanto', 'jabatan' => 'Danpos Palmerah', 'jumlah' => '1 Unit', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Dwi Wahyudi ', 'jabatan' => 'Danpos Kota Baru', 'jumlah' => '1 Unit', 'tahun' => '2023', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Edi Bambang ', 'jabatan' => 'Danton I Mako', 'jumlah' => '2 Unit', 'tahun' => '2025', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Bambang Sugiono', 'jabatan' => 'Danton II Mako', 'jumlah' => '2 Unit', 'tahun' => '2025', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Kasianto', 'jabatan' => 'Danton III Mako', 'jumlah' => '2 Unit', 'tahun' => '2025', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Kms. Muammar', 'jabatan' => 'Danpos Alam Barajo', 'jumlah' => '2 Unit', 'tahun' => '2025', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'M. Rusdi', 'jabatan' => 'Danpos Jamkose', 'jumlah' => '2 Unit', 'tahun' => '2025', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Wilopo', 'jabatan' => 'Danpos Jambi Timur', 'jumlah' => '2 Unit', 'tahun' => '2025', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Herman Yanto', 'jabatan' => 'Danpos Palmerah', 'jumlah' => '2 Unit', 'tahun' => '2025', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Dwi Wahyudi ', 'jabatan' => 'Danpos Kota Baru', 'jumlah' => '2 Unit', 'tahun' => '2025', 'kondisi' => 'Baik', 'keterangan' => null],
        ];
        DB::table('stik_ulars')->insert($stik_ulars);

        $alat_evakuasi_lebahs = [
            ['nama_penerima' => 'Edi Bambang ', 'jabatan' => 'Danton I Mako', 'jumlah' => '1', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Bambang Sugiono', 'jabatan' => 'Danton II Mako', 'jumlah' => '1', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Kasianto', 'jabatan' => 'Danton III Mako', 'jumlah' => '1', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'M. Hafis ', 'jabatan' => 'Danpos Alam Barajo', 'jumlah' => '1', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'M. Rusdi', 'jabatan' => 'Danpos Jamkose', 'jumlah' => '1', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Wilopo', 'jabatan' => 'Danpos Jambi Timur', 'jumlah' => '1', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Herman Yanto', 'jabatan' => 'Danpos Palmerah', 'jumlah' => '1', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Dwi Wahyudi ', 'jabatan' => 'Danpos Kota Baru', 'jumlah' => '1', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
        ];
        DB::table('alat_evakuasi_lebahs')->insert($alat_evakuasi_lebahs);

        $alat_pemotong_cincins = [
            ['nama_penerima' => 'Edi Bambang ', 'jabatan' => 'Danton I Mako', 'jumlah' => '1', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Bambang Sugiono', 'jabatan' => 'Danton II Mako', 'jumlah' => '1', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Kasianto', 'jabatan' => 'Danton III Mako', 'jumlah' => '1', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'M. Hafis ', 'jabatan' => 'Danpos Alam Barajo', 'jumlah' => '1', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'M. Rusdi', 'jabatan' => 'Danpos Jamkose', 'jumlah' => '1', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Wilopo', 'jabatan' => 'Danpos Jambi Timur', 'jumlah' => '1', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Herman Yanto', 'jabatan' => 'Danpos Palmerah', 'jumlah' => '1', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
            ['nama_penerima' => 'Dwi Wahyudi ', 'jabatan' => 'Danpos Kota Baru', 'jumlah' => '1', 'tahun' => '2024', 'kondisi' => 'Baik', 'keterangan' => null],
        ];
        DB::table('alat_pemotong_cincins')->insert($alat_pemotong_cincins);
    }
}
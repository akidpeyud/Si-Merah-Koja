<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WisataEdukasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $insertData = [];

        // ========================================================
        // 1. DATA KUNJUNGAN KE LUAR (GOES TO SCHOOL)
        // Masuk ke Tab Kiri (Penyuluhan ke Lokasi)
        // ========================================================
        $dataLuar = [
            ['tanggal' => '2026-01-28', 'instansi' => 'SMPS SINAR BIJAKSANA GUANG MING', 'kecamatan' => 'Jambi Timur', 'kelurahan' => 'Pasir Putih', 'pr' => 59, 'lk' => 119],
            ['tanggal' => '2026-02-02', 'instansi' => 'SMK NEGERI 1 KOTA JAMBI', 'kecamatan' => 'Telanaipura', 'kelurahan' => 'Simpang IV Sipin', 'pr' => 112, 'lk' => 38],
            ['tanggal' => '2026-07-15', 'instansi' => 'MADRASAH ALIYAH LABORATORIUM', 'kecamatan' => 'Tidak Diketahui', 'kelurahan' => '-', 'pr' => 63, 'lk' => 47],
            ['tanggal' => '2026-07-30', 'instansi' => 'SMA YADIKA KOTA JAMBI', 'kecamatan' => 'Tidak Diketahui', 'kelurahan' => '-', 'pr' => 15, 'lk' => 15],
            ['tanggal' => '2026-08-10', 'instansi' => 'SMP IT NURUL ILMI 2 KOTA JAMBI', 'kecamatan' => 'Tidak Diketahui', 'kelurahan' => '-', 'pr' => 60, 'lk' => 70],
        ];

        foreach ($dataLuar as $item) {
            $insertData[] = [
                'tanggal_pelaksanaan'    => $item['tanggal'],
                'kecamatan'              => $item['kecamatan'],
                'kelurahan'              => $item['kelurahan'],
                'rt'                     => '-',
                'posyandu_sekolah'       => $item['instansi'],
                'peserta_perempuan'      => $item['pr'],
                'peserta_laki_laki'      => $item['lk'],
                'guru'                   => 0, // Kunjungan ke luar guru/ortu di-set 0 dari Excel
                'orang_tua'              => 0,
                'nama_peserta_perempuan' => null,
                'nama_peserta_laki_laki' => null,
                'link_dokumentasi'       => null,
                'created_at'             => $now,
                'updated_at'             => $now,
            ];
        }

        // ========================================================
        // 2. DATA WISATA EDUKASI (KUNJUNGAN KE MAKO DAMKAR)
        // Masuk ke Tab Kanan (Otomatis karena set Kecamatan = Mako Damkar)
        // ========================================================
        $dataDalam = [
            ['tanggal' => '2026-01-14', 'instansi' => 'TK ISLAM MUSLIMAT', 'pr' => 27, 'lk' => 41, 'guru' => 5, 'ortu' => 50],
            ['tanggal' => '2026-01-27', 'instansi' => 'SD IT JAMBI ISLAMIC SCHOOL', 'pr' => 26, 'lk' => 37, 'guru' => 14, 'ortu' => 0],
            ['tanggal' => '2026-01-29', 'instansi' => 'TK RA AL-IKHLASH', 'pr' => 35, 'lk' => 38, 'guru' => 8, 'ortu' => 72],
            ['tanggal' => '2026-02-03', 'instansi' => 'TK NOVA', 'pr' => 22, 'lk' => 23, 'guru' => 7, 'ortu' => 55],
            ['tanggal' => '2026-04-29', 'instansi' => 'RA & MI NURUSSIBIYAN', 'pr' => 17, 'lk' => 23, 'guru' => 7, 'ortu' => 26],
            ['tanggal' => '2026-05-05', 'instansi' => 'RA AL-IRSYAD', 'pr' => 38, 'lk' => 32, 'guru' => 5, 'ortu' => 50],
            ['tanggal' => '2026-05-07', 'instansi' => 'TK ILHAM', 'pr' => 9, 'lk' => 12, 'guru' => 4, 'ortu' => 12],
            ['tanggal' => '2026-05-12', 'instansi' => 'TK ASH SHIDDIIQI 2 (PEMAYUNG)', 'pr' => 9, 'lk' => 14, 'guru' => 6, 'ortu' => 15],
            ['tanggal' => '2026-05-13', 'instansi' => 'TK TELKOM', 'pr' => 18, 'lk' => 23, 'guru' => 5, 'ortu' => 35],
            ['tanggal' => '2026-05-19', 'instansi' => 'TK KARTIKA II-25', 'pr' => 20, 'lk' => 16, 'guru' => 5, 'ortu' => 26],
            ['tanggal' => '2026-05-20', 'instansi' => 'TK AS-SALAM', 'pr' => 35, 'lk' => 30, 'guru' => 6, 'ortu' => 42],
            ['tanggal' => '2026-05-25', 'instansi' => 'SD AHMAD DAHLAN', 'pr' => 12, 'lk' => 13, 'guru' => 1, 'ortu' => 17],
            ['tanggal' => '2026-05-26', 'instansi' => 'TK AS-SHOFA', 'pr' => 27, 'lk' => 31, 'guru' => 5, 'ortu' => 46],
            ['tanggal' => '2026-06-03', 'instansi' => 'TK AL-HIKMAH', 'pr' => 29, 'lk' => 29, 'guru' => 6, 'ortu' => 55],
            ['tanggal' => '2026-06-03', 'instansi' => 'HIMPUNAN PEREMPUAN MELAYU JAMBI', 'pr' => 0, 'lk' => 0, 'guru' => 0, 'ortu' => 28],
            ['tanggal' => '2026-06-09', 'instansi' => 'HIMPUNAN MAHASISWA JAMBI (HIMAJA) UNIVERSITAS SRIWIJAYA', 'pr' => 0, 'lk' => 0, 'guru' => 0, 'ortu' => 20],
            ['tanggal' => '2026-06-10', 'instansi' => 'TK MUTIARA IBU', 'pr' => 23, 'lk' => 16, 'guru' => 5, 'ortu' => 32],
            ['tanggal' => '2026-06-17', 'instansi' => 'TK GOLDEN STAR JAMBI', 'pr' => 37, 'lk' => 51, 'guru' => 8, 'ortu' => 76],
            ['tanggal' => '2026-06-21', 'instansi' => 'PESERTA PRAMUKA PENGGALANG', 'pr' => 20, 'lk' => 24, 'guru' => 0, 'ortu' => 0],
            ['tanggal' => '2026-07-07', 'instansi' => "QUR'AN RAJAWALI", 'pr' => 30, 'lk' => 48, 'guru' => 6, 'ortu' => 55],
            ['tanggal' => '2026-08-19', 'instansi' => 'RA TAUFIQURRAHMAN', 'pr' => 4, 'lk' => 6, 'guru' => 4, 'ortu' => 7],
        ];

        foreach ($dataDalam as $item) {
            $insertData[] = [
                'tanggal_pelaksanaan'    => $item['tanggal'],
                'kecamatan'              => 'Mako Damkar', // Logic kunci untuk masuk ke tab kanan
                'kelurahan'              => 'Mako Damkar',
                'rt'                     => '-',
                'posyandu_sekolah'       => $item['instansi'],
                'peserta_perempuan'      => $item['pr'],
                'peserta_laki_laki'      => $item['lk'],
                'guru'                   => $item['guru'],
                'orang_tua'              => $item['ortu'],
                'nama_peserta_perempuan' => null,
                'nama_peserta_laki_laki' => null,
                'link_dokumentasi'       => null,
                'created_at'             => $now,
                'updated_at'             => $now,
            ];
        }

        // Insert semua data sekaligus
        DB::table('sosialisasi_edukasi')->insert($insertData);
    }
}
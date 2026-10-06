<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ========================================================
        // 1. SEEDER AKUN INTERNAL (PEGAWAI/ADMIN)
        // ========================================================
        DB::table('users')->insert([
            [
                'id' => 1,
                'nama_lengkap' => 'Andika Dwi Putra',
                'email' => 'dwiputdika@gmail.com',
                'nomor_pegawai' => '23112021',
                'role' => 'super_user',
                'email_verified_at' => null,
                'password' => '$2y$12$24dyBXpDKc0buZaC7WtU6u6GC5ZjphCUP5kPKvCA7N014vLGoGGha',
                'remember_token' => null,
                'created_at' => '2026-09-03 00:13:52',
                'updated_at' => '2026-09-07 18:33:45',
            ],
            [
                'id' => 2,
                'nama_lengkap' => 'Dhimas Zaky Abiyyu',
                'email' => 'dhimaszaky102005@gmail.com',
                'nomor_pegawai' => '23112018',
                'role' => 'user',
                'email_verified_at' => null,
                'password' => '$2y$12$oGpz.VPskPJC6h98elnN3ee7qZIZl2Cgrw2V0o8CP/e/29BQrtvgC',
                'remember_token' => null,
                'created_at' => '2026-09-04 09:40:30',
                'updated_at' => '2026-09-07 18:38:31',
            ],
            [
                'id' => 3,
                'nama_lengkap' => 'Ananda Gita April',
                'email' => 'siipooke@gmail.com',
                'nomor_pegawai' => '23112017',
                'role' => 'super_user',
                'email_verified_at' => null,
                'password' => '$2y$12$A3o8N4rpvAo1EXhsOmZdvOtfi/mvPrlFE33OTCtH1rvI5wtMzvPj.',
                'remember_token' => null,
                'created_at' => '2026-09-06 20:59:14',
                'updated_at' => '2026-09-06 20:59:14',
            ],
            [
                'id' => 4,
                'nama_lengkap' => 'M. Suwanda',
                'email' => 'mebius3105@gmail.com',
                'nomor_pegawai' => '23111006',
                'role' => 'user',
                'email_verified_at' => null,
                'password' => '$2y$12$rxJR5GflWyTvaq8e5lst2O5UmayMaXykgTNGtxXaBWvTjgfubmJ3C',
                'remember_token' => null,
                'created_at' => '2026-09-06 20:59:54',
                'updated_at' => '2026-09-07 18:38:31',
            ],
            [
                'id' => 5,
                'nama_lengkap' => 'M Ariffan Hidayah',
                'email' => 'erikpramana68@gmail.com',
                'nomor_pegawai' => '23112007',
                'role' => 'user',
                'email_verified_at' => null,
                'password' => '$2y$12$ZIbd10RDcZYZEFISoTBMz.jDnb8UssyhHza1Ye.OEqL5eBqamtdzO',
                'remember_token' => null,
                'created_at' => '2026-09-06 21:03:09',
                'updated_at' => '2026-09-07 18:38:31',
            ],
            [
                'id' => 6,
                'nama_lengkap' => 'Natasha Romanoff',
                'email' => 'adingbing11@gmail.com',
                'nomor_pegawai' => '231120xx',
                'role' => 'user',
                'email_verified_at' => null,
                'password' => '$2y$12$3WPQSivRZFK7OlN8/EaBBuywUGFeoOUp/00GC/bDmhMpeKXoTXyZi',
                'remember_token' => null,
                'created_at' => '2026-09-06 23:12:02',
                'updated_at' => '2026-09-07 18:38:31',
            ],
            [
                'id' => 7,
                'nama_lengkap' => 'Operator Berita',
                'email' => 'berita.damkar@gmail.com',
                'nomor_pegawai' => '23113001',
                'role' => 'operator',
                'email_verified_at' => null,
                'password' => '$2y$12$/FjxJDSVPbjOM.byocQqY.T.cYKP6M39dVUo8Q63FBN/U1nsFafBi',
                'remember_token' => null,
                'created_at' => '2026-09-06 23:35:56',
                'updated_at' => '2026-09-06 23:35:56',
            ],
        ]);

        // ========================================================
        // 2. SEEDER AKUN REDKAR (BERDASARKAN STRUKTUR TABEL)
        // ========================================================
        DB::table('redkar_registrations')->insert([
            [
                'id'                        => 'RDKR-' . time() . '-' . rand(100, 999), 
                'username'                  => 'natasha',
                'password'                  => Hash::make('password123'), 
                'nik'                       => '1571234567890001',
                'nama_lengkap'              => 'Natasha Romanoff',
                'jenis_kelamin'             => 'Perempuan',
                'tempat_lahir'              => 'Rusia',
                'tanggal_lahir'             => '1984-11-22',
                'status_perkawinan'         => 'Belum Kawin',
                'agama'                     => 'Kristen',
                'nomor_telp'                => '081234567890',
                'file_ktp'                  => null, // Nullable sesuai tabel
                'alamat'                    => 'Jl. Avengers No. 1',
                'rt_rw'                     => '01/01',
                'kode_pos'                  => '36123',
                'provinsi'                  => 'JAMBI', // Default value JAMBI
                'kabupaten_kota'            => 'KOTA JAMBI', // Default value KOTA JAMBI
                'kecamatan'                 => 'Telanaipura',
                'kelurahan'                 => 'Telanaipura',
                'pendidikan_terakhir'       => 'S1',
                'latar_belakang_pendidikan' => 'Spionase',
                'pekerjaan'                 => 'Karyawan Swasta',
                'sehat_jasmani'             => 'Ya',
                'buta_warna'                => 'Tidak', // Menambahkan field yang sebelumnya hilang
                'golongan_darah'            => 'AB',
                'status_akun'               => 'Aktif', // Menyesuaikan dengan kebutuhan agar bisa login
                'status_pendaftaran'        => 'Diterima',
                'created_at'                => now(),
                'updated_at'                => now(),
            ],
            [
                'id'                        => 'RDKR-' . (time() + 1) . '-' . rand(100, 999), 
                'username'                  => 'budi_redkar',
                'password'                  => Hash::make('password123'), 
                'nik'                       => '1571234567890002',
                'nama_lengkap'              => 'Budi Santoso',
                'jenis_kelamin'             => 'Laki-laki',
                'tempat_lahir'              => 'Jambi',
                'tanggal_lahir'             => '1990-05-15',
                'status_perkawinan'         => 'Kawin',
                'agama'                     => 'Islam',
                'nomor_telp'                => '085211223344',
                'file_ktp'                  => null,
                'alamat'                    => 'Jl. Pahlawan No. 45',
                'rt_rw'                     => '02/05',
                'kode_pos'                  => '36124',
                'provinsi'                  => 'JAMBI',
                'kabupaten_kota'            => 'KOTA JAMBI',
                'kecamatan'                 => 'Jambi Selatan',
                'kelurahan'                 => 'Pakuan Baru',
                'pendidikan_terakhir'       => 'SMA',
                'latar_belakang_pendidikan' => 'IPS',
                'pekerjaan'                 => 'Wiraswasta',
                'sehat_jasmani'             => 'Ya',
                'buta_warna'                => 'Tidak',
                'golongan_darah'            => 'O',
                'status_akun'               => 'Nonaktif', // Sesuai default di tabel
                'status_pendaftaran'        => 'Pending', // Sesuai default di tabel
                'created_at'                => now(),
                'updated_at'                => now(),
            ],
            [
                'id'                        => 'RDKR-' . (time() + 2) . '-' . rand(100, 999), 
                'username'                  => 'siti_relawan',
                'password'                  => Hash::make('password123'), 
                'nik'                       => '1571234567890003',
                'nama_lengkap'              => 'Siti Aminah',
                'jenis_kelamin'             => 'Perempuan',
                'tempat_lahir'              => 'Muaro Jambi',
                'tanggal_lahir'             => '1995-08-20',
                'status_perkawinan'         => 'Belum Kawin',
                'agama'                     => 'Islam',
                'nomor_telp'                => '082133445566',
                'file_ktp'                  => null,
                'alamat'                    => 'Jl. Sudirman Blok C',
                'rt_rw'                     => '04/02',
                'kode_pos'                  => '36125',
                'provinsi'                  => 'JAMBI',
                'kabupaten_kota'            => 'KOTA JAMBI',
                'kecamatan'                 => 'Danau Sipin',
                'kelurahan'                 => 'Legok',
                'pendidikan_terakhir'       => 'D3',
                'latar_belakang_pendidikan' => 'Keperawatan',
                'pekerjaan'                 => 'Perawat',
                'sehat_jasmani'             => 'Ya',
                'buta_warna'                => 'Tidak',
                'golongan_darah'            => 'A',
                'status_akun'               => 'Aktif',
                'status_pendaftaran'        => 'Diterima',
                'created_at'                => now(),
                'updated_at'                => now(),
            ]
        ]);

        // ========================================================
        // 3. SEEDER AKUN PEMOHON PUBLIK (NATASHA)
        // ========================================================
        DB::table('pemohons')->insert([
            'nik'          => '1571234567890002', 
            'nama_lengkap' => 'Natasha Romanoff', 
            'email'        => 'natasha@gmail.com',
            'no_whatsapp'  => '081234567890',
            'password'     => Hash::make('password123'), 
            'role'         => 'pemohon', 
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
    }
}
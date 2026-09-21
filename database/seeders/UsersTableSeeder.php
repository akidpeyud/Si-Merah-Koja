<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <-- Baris ini sangat penting agar tidak error

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
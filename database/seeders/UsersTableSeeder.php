<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
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
            'password' => '$2y$12$24dyBXpDKc0buZaC7WtU6u6GC5ZjphCUP5kPKvCA7N014vLGoGGha',
            'created_at' => '2026-09-03 00:13:52',
            'updated_at' => '2026-09-07 18:33:45',
        ],
        // Masukkan data user lainnya dengan format yang sama jika ingin manual
    ]);
}
}
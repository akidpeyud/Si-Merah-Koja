<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama_lengkap' => 'Andika Dwi Putra',
            'email' => 'admin@simerah.com',
            'nomor_pegawai' => '199001012026011001',
            'role' => 'admin',
            'password' => Hash::make('password123'), // Password default
        ]);
    }
}
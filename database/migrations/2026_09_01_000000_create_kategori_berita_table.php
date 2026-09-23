<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // <-- Jangan lupa tambahkan baris ini di atas

return new class extends Migration
{
    public function up(): void
    {
        // 1. Membuat tabel kategori_berita
        Schema::create('kategori_berita', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->timestamps();
        });

        // 2. Memasukkan data kategori secara otomatis saat migrasi berjalan
        DB::table('kategori_berita')->insert([
            ['nama_kategori' => 'Kebakaran Rumah', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Kebakaran Benda', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Kebakaran Lahan', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Pemberian Bantuan', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Evakuasi Hewan', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Edukasi', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Bencana Alam', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Penyelamatan Warga', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Prestasi', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Lainya', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_berita');
    }
};
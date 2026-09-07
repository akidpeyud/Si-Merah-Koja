<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengadaan_sarpras', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang', 255);
            
            // Kolom untuk setiap tahun (dibuat nullable agar bisa dikosongkan jika tidak ada pengadaan)
            $table->integer('tahun_2019')->nullable();
            $table->integer('tahun_2020')->nullable();
            $table->integer('tahun_2021')->nullable();
            $table->integer('tahun_2022')->nullable();
            $table->integer('tahun_2023')->nullable();
            $table->integer('tahun_2024')->nullable();
            $table->integer('tahun_2025')->nullable();
            $table->integer('tahun_2026')->nullable();
            
            $table->integer('stok')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengadaan_sarpras');
    }
};
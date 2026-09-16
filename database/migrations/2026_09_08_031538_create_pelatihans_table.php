<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelatihan', function (Blueprint $table) {
            $table->id();
            
            // Data Utama Pelatihan
            $table->string('nama_pelatihan');
            $table->string('lokasi');
            $table->date('tanggal_pelaksanaan');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            
            // Peserta
            $table->string('kategori_peserta');
            $table->integer('jumlah_peserta');
            
            // File & Keterangan Tambahan
            $table->string('modul_pelatihan')->nullable(); // Untuk path upload file
            $table->text('catatan')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelatihan');
    }
};
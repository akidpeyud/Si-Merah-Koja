<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sosialisasi', function (Blueprint $table) {
            $table->id();
            
            // Detail Kegiatan
            $table->string('nama_kegiatan');
            $table->string('lokasi');
            $table->date('tanggal_pelaksanaan');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            
            // Sasaran & Peserta
            $table->string('sasaran_peserta');
            $table->integer('jumlah_peserta');
            
            // File & Catatan
            $table->string('surat_permohonan')->nullable(); // Untuk path upload Surat Permohonan
            $table->text('catatan')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sosialisasi');
    }
};
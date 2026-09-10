<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembinaan', function (Blueprint $table) {
            $table->id();
            
            // Detail Kegiatan
            $table->string('nama_program');
            $table->string('lokasi');
            $table->date('tanggal_pelaksanaan');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            
            // Sasaran & Target
            $table->string('sasaran_pembinaan');
            $table->integer('target_peserta');
            
            // File & Catatan
            $table->string('dokumen_pendukung')->nullable(); // Untuk path upload file dokumen/KAK
            $table->text('catatan')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembinaan');
    }
};
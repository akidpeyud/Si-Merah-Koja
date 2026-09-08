<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peningkatan_kapasitas', function (Blueprint $table) {
            $table->id();
            
            // Detail Kegiatan
            $table->string('nama_kegiatan');
            $table->string('penyelenggara');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('jenis_kegiatan');
            
            // Peserta
            $table->integer('jumlah_pegawai');
            
            // File & Catatan
            $table->string('dokumen_terkait')->nullable(); // Untuk path upload Surat Tugas/Sertifikat
            $table->text('catatan')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peningkatan_kapasitas');
    }
};
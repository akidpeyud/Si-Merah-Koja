<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_inspeksi', function (Blueprint $table) {
            $table->id();
            
            // Informasi Dasar
            $table->string('nama_instansi');
            $table->date('tanggal_inspeksi');
            $table->string('tim_petugas');
            $table->text('alamat');
            
            // Klasifikasi Gedung
            $table->integer('jml_gedung_tinggi')->default(0);
            $table->integer('jml_gedung_sedang')->default(0);
            $table->integer('jml_gedung_rendah')->default(0);
            
            // Data Tambahan (Bisa kosong/nullable)
            $table->string('dokumen_pendukung')->nullable(); // Untuk nyimpen nama/path file
            $table->text('catatan')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_inspeksi');
    }
};
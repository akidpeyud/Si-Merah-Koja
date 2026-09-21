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
        Schema::create('edukasis', function (Blueprint $table) {
            $table->id();
            
            // Informasi Institusi & Pemohon
            $table->string('institusi');
            $table->string('kecamatan');
            $table->string('nama_pemohon');
            $table->string('no_kontak');
            
            // Jadwal Kegiatan
            $table->date('tgl_kegiatan');
            
            // Rincian Peserta Berdasarkan Usia
            $table->integer('usia_3_6')->default(0);
            $table->integer('usia_7_12')->default(0);
            $table->integer('usia_13_18')->default(0);
            $table->integer('usia_18_keatas')->default(0);
            
            // Status & File Lampiran
            $table->enum('status_permohonan', ['Pending', 'Disetujui', 'Ditolak'])->default('Pending');
            $table->string('surat_permohonan')->nullable(); // Path/Nama file surat
            $table->string('syarat_lainnya')->nullable();   // Path/Nama file syarat lainnya
            
            $table->timestamps(); // create_at digunakan untuk 'Diajukan Pada'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edukasis');
    }
};
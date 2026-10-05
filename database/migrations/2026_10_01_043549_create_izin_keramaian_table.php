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
        Schema::create('izin_keramaian', function (Blueprint $table) {
            $table->id();
            
            // 1. Data Pemohon
            $table->string('nama');
            $table->char('nik', 16);
            $table->string('no_hp');
            $table->text('alamat');
            
            // 2. Data Usaha
            $table->string('nama_direktur');
            $table->string('nama_usaha');
            $table->string('no_izin_usaha');
            
            // 3. Data Lokasi Acara
            $table->string('nama_acara');
            $table->string('lokasi_acara');
            $table->date('tgl_pelaksanaan');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->integer('jumlah_penonton');
            $table->string('foto_jalur_evakuasi'); // Path file
            
            // 4. Data Peralatan
            $table->integer('jumlah_apar')->default(8);
            $table->integer('jumlah_staff')->default(4);
            
            // 5. Berkas Persyaratan
            $table->string('surat_pernyataan'); // Path file

            // Status Permohonan (Pending, Proses, Disetujui, Ditolak)
            $table->string('status_permohonan')->default('Pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izin_keramaian');
    }
};
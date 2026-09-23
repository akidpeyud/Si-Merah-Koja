<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pegawai', function (Blueprint $table) {
            // 1. NOMOR URUT DI AWAL
            $table->integer('no_urut')->nullable();
            
            // 2. NIP TETAP JADI PRIMARY KEY (Agar data tidak duplikat)
            $table->string('nip')->primary();
            
            // 3. SISA DATA BERDASARKAN EXCEL
            $table->string('nama');
            $table->string('pangkat_gol_ruang')->nullable();
            $table->date('pangkat_tmt')->nullable();
            $table->string('jabatan_nama')->nullable();
            $table->date('jabatan_tmt')->nullable();
            $table->integer('masa_kerja_th')->nullable();
            $table->integer('masa_kerja_bln')->nullable();
            $table->string('latihan_jabatan_nama')->nullable();
            $table->string('latihan_jabatan_tahun_lulus')->nullable();
            $table->string('latihan_jabatan_tempat')->nullable();
            $table->string('pendidikan_nama')->nullable();
            $table->string('pendidikan_tahun_lulus')->nullable();
            $table->string('pendidikan_tingkat_ijazah')->nullable();
            $table->string('tempat_tanggal_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable(); 
            $table->text('catatan_mutasi_pegawai')->nullable();
            $table->string('status_pegawai')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
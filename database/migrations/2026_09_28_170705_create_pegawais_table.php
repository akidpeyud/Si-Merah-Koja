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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            
            // Data Pribadi
            $table->integer('no_urut')->nullable();
            $table->string('nip', 20)->unique();
            $table->string('nama');
            $table->string('tempat_tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->enum('status_pegawai', ['Aktif', 'Cuti', 'Pensiun', 'Pindah'])->default('Aktif');
            
            // Kepangkatan & Jabatan
            $table->string('pangkat_gol_ruang')->nullable();
            $table->date('pangkat_tmt')->nullable();
            $table->string('jabatan_nama')->nullable();
            $table->date('jabatan_tmt')->nullable();
            $table->integer('masa_kerja_th')->nullable();
            $table->integer('masa_kerja_bln')->nullable();
            
            // Pendidikan Formal
            $table->string('pendidikan_tingkat_ijazah')->nullable();
            $table->string('pendidikan_nama')->nullable();
            $table->string('pendidikan_tahun_lulus', 4)->nullable();
            
            // Diklat / Latihan Jabatan
            $table->string('latihan_jabatan_nama')->nullable();
            $table->string('latihan_jabatan_tahun_lulus', 4)->nullable();
            $table->string('latihan_jabatan_tempat')->nullable();
            
            // Lain-lain
            $table->text('catatan_mutasi_pegawai')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
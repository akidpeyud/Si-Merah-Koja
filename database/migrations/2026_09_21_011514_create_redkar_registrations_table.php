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
        Schema::create('redkar_registrations', function (Blueprint $table) {
            // ID diubah jadi string karena controllermu memakai format "RDK-..."
            $table->string('id')->primary();
            
            // Autentikasi Relawan (Ini yang bikin error Unknown Column tadi)
            $table->string('username')->unique();
            $table->string('password');
            
            // Data Pribadi Dasar
            $table->string('nik', 16)->unique();
            $table->string('nama_lengkap', 150);
            $table->string('jenis_kelamin'); 
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->string('status_perkawinan');
            $table->string('agama');
            $table->string('nomor_telp', 20);
            
            // Berkas KTP (Nama kolom disesuaikan dengan controller: 'file_ktp')
            $table->string('file_ktp')->nullable();
            
            // Domisili
            $table->text('alamat');
            $table->string('rt_rw', 10);
            $table->string('kode_pos', 10);
            $table->string('provinsi')->default('JAMBI');
            $table->string('kabupaten_kota')->default('KOTA JAMBI');
            $table->string('kecamatan', 50);
            $table->string('kelurahan', 50);
            
            // Latar Belakang & Fisik
            $table->string('pendidikan_terakhir');
            $table->string('latar_belakang_pendidikan', 255);
            $table->string('pekerjaan', 255);
            $table->string('sehat_jasmani');
            $table->string('buta_warna')->nullable(); // Dibuat nullable karena tidak ada di form validasi controller
            $table->string('golongan_darah');
            
            // Status Sistem
            $table->string('status_akun')->default('Nonaktif');
            $table->string('status_pendaftaran')->default('Pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redkar_registrations');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftar_redkars', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin']);
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']);
            $table->string('nomor_telp', 20);
            
            // Menyimpan path/lokasi file KTP setelah diunggah
            $table->string('file_ktp');
            
            $table->text('alamat');
            $table->string('rt_rw', 10);
            $table->string('kode_pos', 10);
            $table->string('provinsi', 50)->default('JAMBI');
            $table->string('kabupaten_kota', 50)->default('KOTA JAMBI');
            $table->string('kecamatan', 50);
            $table->string('kelurahan', 50);
            
            $table->string('pekerjaan', 100);
            $table->enum('pendidikan_terakhir', ['SMA/SMK', 'D3', 'S1']);
            $table->enum('sehat_jasmani', ['Ya', 'Tidak']);
            $table->enum('buta_warna', ['Tidak', 'Ya']);
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O']);
            
            // Status pendaftaran untuk dashboard admin
            $table->enum('status_pendaftaran', ['Pending', 'Diterima', 'Ditolak'])->default('Pending');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftar_redkars');
    }
};
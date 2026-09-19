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
            $table->string('id', 50)->primary();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('nik', 16)->unique();
            $table->string('nama_lengkap', 150);
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']);
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->string('nomor_telp', 20);
            $table->string('file_ktp');
            $table->text('alamat');
            $table->string('rt_rw', 10);
            $table->string('kode_pos', 10);
            $table->string('provinsi', 50)->default('JAMBI');
            $table->string('kabupaten_kota', 50)->default('KOTA JAMBI');
            $table->string('kecamatan', 50);
            $table->string('kelurahan', 50);
            $table->string('pekerjaan', 100);
            $table->enum('pendidikan_terakhir', ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2']);
            $table->string('latar_belakang_pendidikan');
            $table->enum('sehat_jasmani', ['Ya', 'Tidak']);
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O', 'Tidak Tahu']);
            $table->enum('status_pendaftaran', ['Pending', 'Diterima', 'Ditolak'])->default('Pending');
            $table->string('status_akun', 20)->nullable()->default('Aktif');
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

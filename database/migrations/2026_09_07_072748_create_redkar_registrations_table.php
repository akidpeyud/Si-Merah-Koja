<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('redkar_registrations', function (Blueprint $table) {
        $table->id();
        $table->string('nik')->unique();
        $table->string('nama_lengkap');
        $table->enum('jenis_kelamin', ['L', 'P']);
        $table->string('tempat_lahir');
        $table->date('tanggal_lahir');
        $table->string('status_perkawinan');
        $table->string('agama');
        $table->string('nomor_telp');
        $table->string('ktp')->nullable(); // Menyimpan path file gambar/pdf KTP
        $table->text('alamat');
        $table->string('rt_rw');
        $table->string('kode_pos');
        $table->string('provinsi')->default('JAMBI');
        $table->string('kabupaten_kota')->default('KOTA JAMBI');
        $table->string('kecamatan');
        $table->string('kelurahan');
        $table->string('pekerjaan');
        $table->string('pendidikan_terakhir');
        $table->enum('sehat_jasmani', ['Ya', 'Tidak']);
        $table->enum('buta_warna', ['Ya', 'Tidak']);
        $table->string('golongan_darah');
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

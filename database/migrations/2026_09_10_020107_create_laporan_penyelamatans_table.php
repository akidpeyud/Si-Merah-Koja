<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laporan_penyelamatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->uuid('id_laporan')->unique();
            $table->string('nomor_laporan')->unique();
            
            // Tab 1: Informasi Dasar
            $table->string('nama_pelapor')->nullable();
            $table->string('media_pelaporan')->nullable();
            $table->string('kategori_kejadian')->nullable();
            $table->string('kategori_kebakaran')->nullable();
            $table->string('kategori_non_kebakaran')->nullable();
            $table->text('rincian_kategori_non_kebakaran')->nullable();
            $table->string('prioritas')->default('rendah');
            
            $table->dateTime('waktu_kejadian')->nullable();
            $table->dateTime('waktu_terima')->nullable();
            $table->dateTime('waktu_berangkat')->nullable();
            $table->dateTime('waktu_tiba')->nullable();
            $table->dateTime('waktu_selesai')->nullable();
            $table->dateTime('waktu_kembali')->nullable();
            
            $table->text('alamat')->nullable();
            $table->string('koordinat')->nullable();
            $table->decimal('jarak_tempuh', 8, 2)->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_penyelamatans');
    }
};
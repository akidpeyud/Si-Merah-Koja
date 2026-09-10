<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('laporan_penyelamatans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_laporan')->unique();
            $table->uuid('id_laporan')->unique();
            $table->string('kategori_kebakaran')->nullable();
            $table->string('kategori_non_kebakaran')->nullable();
            $table->string('rincian_kategori_non_kebakaran')->nullable();
            $table->string('kategori_kejadian')->nullable();
            $table->enum('prioritas', ['rendah', 'sedang', 'tinggi', 'darurat'])->default('rendah');
            $table->dateTime('waktu_kejadian')->nullable();
            $table->dateTime('waktu_terima')->nullable();
            $table->dateTime('waktu_berangkat')->nullable();
            $table->dateTime('waktu_tiba')->nullable();
            $table->dateTime('waktu_selesai')->nullable();
            $table->text('alamat')->nullable();
            $table->string('koordinat')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('laporan_penyelamatans');
    }
};
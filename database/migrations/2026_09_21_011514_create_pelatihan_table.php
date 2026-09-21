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
        Schema::create('pelatihan', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('nama_pelatihan');
            $table->string('lokasi');
            $table->date('tanggal_pelaksanaan');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('kategori_peserta');
            $table->integer('jumlah_peserta');
            $table->string('modul_pelatihan')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatihan');
    }
};

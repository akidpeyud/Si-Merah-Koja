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
        Schema::create('sosialisasi', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('nama_kegiatan');
            $table->string('lokasi');
            $table->date('tanggal_pelaksanaan');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('sasaran_peserta');
            $table->integer('jumlah_peserta');
            $table->string('surat_permohonan')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sosialisasi');
    }
};

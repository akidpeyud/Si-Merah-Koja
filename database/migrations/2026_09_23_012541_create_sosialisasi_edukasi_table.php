<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sosialisasi_edukasi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pelaksanaan');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('rt');
            $table->string('posyandu')->nullable();
            $table->integer('peserta_perempuan')->default(0);
            $table->integer('peserta_laki_laki')->default(0);
            $table->string('foto_video')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sosialisasi_edukasi');
    }
};
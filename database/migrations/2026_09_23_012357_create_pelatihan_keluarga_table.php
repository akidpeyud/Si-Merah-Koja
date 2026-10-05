<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelatihan_keluarga', function (Blueprint $table) {
            $table->id();

            // Informasi pelaksanaan
            $table->date('tanggal_pelaksanaan');
            $table->string('kecamatan', 100);   // dari dropdown
            $table->string('kelurahan', 100);   // dari dropdown
            $table->string('rt');               // contoh: "03, 12, 14 dan 19"

            // Jumlah peserta
            $table->unsignedInteger('peserta_perempuan')->default(0);
            $table->unsignedInteger('peserta_laki_laki')->default(0);

            // Dokumentasi (path file foto/video)
            $table->string('foto_video')->nullable();

            $table->timestamps();

            $table->index('tanggal_pelaksanaan');
            $table->index(['kecamatan', 'kelurahan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelatihan_keluarga');
    }
};
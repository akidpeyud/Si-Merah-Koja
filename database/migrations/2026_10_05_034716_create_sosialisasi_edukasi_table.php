<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sosialisasi_edukasi', function (Blueprint $table) {
            $table->id();
            $table->string('judul_kegiatan');
            $table->date('tanggal_pelaksanaan');
            $table->string('lokasi'); // Kelurahan / Posyandu
            $table->integer('jumlah_peserta')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sosialisasi_edukasi');
    }
};
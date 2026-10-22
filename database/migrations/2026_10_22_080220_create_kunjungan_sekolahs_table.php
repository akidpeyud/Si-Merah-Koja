<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kunjungan_sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->string('tanggal_kunjungan'); // Pakai string karena formatnya bisa "14 dan 15 Januari 2026"
            $table->integer('siswa_perempuan')->default(0);
            $table->integer('siswa_laki_laki')->default(0);
            $table->integer('guru')->default(0);
            $table->integer('orang_tua')->default(0);
            $table->integer('total_kunjungan')->default(0); // Total keseluruhan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kunjungan_sekolahs');
    }
};
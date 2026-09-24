<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('apab_apars', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penerima')->nullable();
            $table->string('jenis_barang');
            $table->integer('jumlah')->default(1);
            $table->year('tahun_pengadaan')->nullable();
            $table->string('kondisi')->default('Baik');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('apab_apars');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('gunting_besis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penerima')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('tahun')->nullable();
            $table->string('kondisi')->default('Baik');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gunting_besis');
    }
};
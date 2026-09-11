<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('baju_tahan_panas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penerima');
            $table->string('warna_baju')->nullable();
            $table->integer('tahun_baju')->nullable();
            $table->boolean('helm')->default(0);
            $table->integer('tahun_helm')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('baju_tahan_panas');
    }
};
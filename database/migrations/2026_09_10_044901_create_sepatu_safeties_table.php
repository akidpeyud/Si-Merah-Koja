<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sepatu_safety', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penerima');
            $table->boolean('sepatu_safety')->default(0);
            $table->integer('tahun')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sepatu_safety');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hidran_kota', function (Blueprint $table) {
            $table->id();
            $table->string('jalan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('rt', 50)->nullable();
            $table->string('lokasi_terdekat')->nullable();
            $table->string('kode_map', 100)->nullable();
            $table->string('kondisi_hidran', 50)->nullable();
            $table->string('tekanan', 50)->nullable();
            $table->string('machino', 50)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hidran_kota');
    }
};
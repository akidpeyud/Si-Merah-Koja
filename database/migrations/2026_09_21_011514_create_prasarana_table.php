<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prasarana', function (Blueprint $table) {
            $table->integer('id_prasarana', true);
            $table->integer('id_pos')->nullable()->index('id_pos');
            $table->string('jenis_prasarana')->nullable();
            $table->string('path_gambar')->nullable();
            $table->integer('no_urut')->nullable();
            $table->string('nama_gedung')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kode_maps')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('kategori', 100)->nullable();
            $table->string('luas', 100)->nullable();
            $table->string('luas_bangunan', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prasarana');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prasaranas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('no_urut')->nullable();
            $table->string('nama_gedung')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kode_maps')->nullable();
            $table->integer('jumlah')->nullable();
            $table->timestamps();
            $table->string('kategori', 100)->nullable();
            $table->string('luas', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prasaranas');
    }
};

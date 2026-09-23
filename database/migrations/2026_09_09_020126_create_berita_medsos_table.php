<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita_medsos', function (Blueprint $table) {
            $table->id();
            // Menambahkan foreign key kategori_id
            $table->unsignedBigInteger('kategori_id')->nullable(); 

            $table->string('judul');
            $table->dateTime('tanggal');
            $table->string('sumber');
            $table->string('link')->nullable();
            $table->string('gambar');
            $table->timestamps();

            // Relasi ke tabel kategori_berita
            $table->foreign('kategori_id')->references('id')->on('kategori_berita')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita_medsos');
    }
};
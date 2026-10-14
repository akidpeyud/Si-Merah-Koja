<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk_hukums', function (Blueprint $table) {
            $table->id();
            // Menyimpan slug kategori: undang-undang, peraturan-pemerintah, peraturan-menteri, peraturan-daerah, peraturan-kepala-daerah
            $table->string('kategori')->index();
            $table->string('nomor')->nullable(); // Contoh: Nomor 24 Tahun 2007
            $table->year('tahun')->nullable();   // Contoh: 2007
            $table->string('judul');             // Tentang / Nama Produk Hukum
            $table->text('keterangan')->nullable();
            $table->string('file_dokumen');      // Path file PDF
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_hukums');
    }
};
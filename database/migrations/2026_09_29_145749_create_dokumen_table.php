<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumen_sop', function (Blueprint $table) {
            $table->id();
            $table->string('judul_dokumen');
            $table->string('nama_file');
            
            // Kolom kategori utama
            $table->enum('kategori', [
                'SOTK', 
                'SOP', 
                'Perencanaan', 
                'Pelaporan', 
                'Produk Hukum'
            ]);
            
            // Kolom sub-kategori khusus SOP disesuaikan menjadi 6 bagian
            $table->enum('sub_kategori', [
                'Pencegahan', 
                'Pemadaman Kebakaran', 
                'Penyelamatan dan Evakuasi', 
                'Sarana dan Prasarana', 
                'Kepegawaian', 
                'Keuangan'
            ])->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};
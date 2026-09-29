<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumen', function (Blueprint $table) {
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
            
            // Kolom sub-kategori khusus SOP (nullable karena tidak semua punya sub)
            $table->enum('sub_kategori', [
                'Sekretariat', 
                'Sapra', 
                'Damtan', 
                'Pencegahan'
            ])->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};
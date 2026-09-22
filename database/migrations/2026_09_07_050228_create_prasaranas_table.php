<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prasaranas', function (Blueprint $table) {
            $table->id(); // 1. id
            $table->integer('no_urut')->nullable(); // 2. no_urut
            $table->string('nama_gedung')->nullable(); // 3. nama_gedung
            $table->text('alamat')->nullable(); // 4. alamat
            $table->string('kode_maps')->nullable(); // 5. kode_maps
            $table->integer('jumlah')->nullable(); // 6. jumlah
            $table->timestamps(); // 7 & 8. created_at & updated_at
            
            // Kolom baru yang ditambahkan sesuai gambar
            $table->string('kategori')->nullable(); // 9. kategori
            $table->string('luas')->nullable(); // 10. luas
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prasaranas');
    }
};
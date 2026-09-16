<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prasarana_pos', function (Blueprint $table) {
            $table->id();
            
            // Relasi (Foreign Key) ke tabel lokasi_pos
            $table->foreignId('lokasi_pos_id')->constrained('lokasi_pos')->onDelete('cascade');
            
            $table->string('jenis_prasarana', 255);
            $table->string('gambar')->nullable(); // Disiapkan untuk upload gambar
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prasarana_pos');
    }
};
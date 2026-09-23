<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sarana_pos', function (Blueprint $table) {
            $table->id();
            
            // Menginduk ke tabel lokasi yang sama dengan prasarana
            $table->foreignId('lokasi_pos_id')->constrained('lokasi_pos')->onDelete('cascade');
            
            $table->string('jenis_sarana', 255);
            $table->integer('jumlah')->default(0);
            $table->string('gambar')->nullable(); // Untuk upload gambar
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sarana_pos');
    }
};
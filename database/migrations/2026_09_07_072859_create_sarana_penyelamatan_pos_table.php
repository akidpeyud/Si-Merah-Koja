<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sarana_penyelamatan_pos', function (Blueprint $table) {
            $table->id();
            
            // Menginduk ke tabel lokasi_pos
            $table->foreignId('lokasi_pos_id')->constrained('lokasi_pos')->onDelete('cascade');
            
            $table->string('jenis_sarana_penyelamatan', 255);
            $table->integer('jumlah')->default(0);
            $table->string('gambar')->nullable(); // Untuk menyimpan path/nama file gambar
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sarana_penyelamatan_pos');
    }
};
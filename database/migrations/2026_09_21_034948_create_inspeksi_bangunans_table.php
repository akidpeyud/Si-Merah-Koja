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
        Schema::create('inspeksi_bangunans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tempat');
            // Menggunakan string/date. Karena di view ditulis "6 FEBRUARI 2025", 
            // tipe date lebih disarankan, namun jika input manual berupa teks bebas, gunakan string.
            $table->date('tanggal_inspeksi')->nullable(); 
            $table->string('jenis_usaha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspeksi_bangunans');
    }
};
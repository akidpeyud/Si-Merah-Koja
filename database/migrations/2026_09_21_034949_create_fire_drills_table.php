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
        Schema::create('fire_drills', function (Blueprint $table) {
            $table->id();
            $table->string('nama_instansi');
            $table->year('tahun'); // Mengambil tahun dari badge (misal: 2024, 2025)
            
            // Tipe data string digunakan karena format tanggal bisa berupa rentang, 
            // contoh: "3 & 4 Februari 2025" seperti pada desain.
            $table->string('tanggal_pelaksanaan'); 
            $table->string('tempat_pelaksanaan');
            
            // Dibuat nullable karena data tahun 2023-2024 hanya menyimpan total peserta
            $table->integer('peserta_laki_laki')->nullable()->default(0);
            $table->integer('peserta_perempuan')->nullable()->default(0);
            
            $table->integer('total_peserta'); // Jumlah Total
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fire_drills');
    }
};
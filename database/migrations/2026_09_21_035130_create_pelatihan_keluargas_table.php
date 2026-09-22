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
        Schema::create('pelatihan_keluargas', function (Blueprint $table) {
            $table->id();
            
            // Disarankan menggunakan date, format harinya (Kamis, dll) bisa di-handle oleh Carbon di blade
            $table->date('tanggal_pelaksanaan'); 
            
            $table->string('posyandu')->nullable(); // Nullable karena di view ada yang strip "-"
            
            // Menggunakan string karena RT bisa berisi banyak nomor seperti "01, 03, 05, 06..."
            $table->string('rt'); 
            $table->string('kelurahan');
            $table->string('kecamatan');
            
            // Jumlah Peserta
            $table->integer('peserta_perempuan')->default(0);
            $table->integer('peserta_laki_laki')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatihan_keluargas');
    }
};
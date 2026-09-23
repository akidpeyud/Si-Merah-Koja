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
        Schema::create('pelatihan_keluarga', function (Blueprint $table) {
            $table->id();
            
            // Informasi Pelaksanaan
            $table->date('tanggal_pelaksanaan');
            $table->string('kecamatan');
            $table->string('kelurahan');
            
            // Menggunakan string untuk RT karena di input ada contoh: "01, 03, 05, 06"
            $table->string('rt'); 
            
            // Posyandu bersifat opsional (boleh dikosongkan)
            $table->string('posyandu')->nullable(); 
            
            // Jumlah Peserta
            $table->integer('peserta_perempuan')->default(0);
            $table->integer('peserta_laki_laki')->default(0);
            
            // Dokumen/Media (Foto dan Video di tabel dashboard)
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatihan_keluarga');
    }
};
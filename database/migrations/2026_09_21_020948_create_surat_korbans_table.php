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
        Schema::create('surat_korbans', function (Blueprint $table) {
            $table->id();
            
            // A. Data Diri Korban
            $table->string('nama_korban');
            $table->string('status_kepemilikan');
            $table->string('nik', 16); // Menggunakan string panjang 16 untuk NIK agar angka 0 di depan tidak hilang
            $table->string('pekerjaan');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('status_perkawinan');
            $table->text('alamat');
            
            // B. Detail Kejadian & Surat
            $table->string('objek_terbakar');
            $table->string('hari_kejadian');
            $table->date('tanggal_kejadian');
            $table->time('waktu_kejadian');
            $table->string('tembusan_camat')->nullable(); // Nullable karena tidak ada atribut 'required' di HTML
            $table->string('tembusan_lurah')->nullable(); // Nullable karena tidak ada atribut 'required' di HTML
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_korbans');
    }
};
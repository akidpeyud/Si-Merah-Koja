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
        
        $table->string('nomor_surat'); // <-- TAMBAHKAN BARIS INI
        
        // Pastikan kolom-kolom ini juga sudah ada sesuai form-mu:
        $table->string('nama_korban');
        $table->string('status_kepemilikan');
        $table->string('nik');
        $table->string('pekerjaan');
        $table->string('tempat_lahir');
        $table->date('tanggal_lahir');
        $table->string('status_perkawinan');
        $table->text('alamat');
        $table->string('objek_terbakar');
        $table->string('hari_kejadian');
        $table->date('tanggal_kejadian');
        $table->time('waktu_kejadian');
        $table->string('tembusan_camat');
        $table->string('tembusan_lurah');
        $table->dateTime('tanggal_surat');
        
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
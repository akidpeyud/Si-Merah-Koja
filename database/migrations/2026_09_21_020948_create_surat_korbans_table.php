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
            
            // Dibuat unique() agar tidak ada nomor surat yang sama persis
            $table->string('nomor_surat')->unique(); 
            
            // Ditambahkan nullable() agar tidak error jika ada field form yang terlewat/kosong
            $table->string('nama_korban')->nullable();
            $table->string('status_kepemilikan')->nullable();
            $table->string('nik')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('objek_terbakar')->nullable();
            $table->string('hari_kejadian')->nullable();
            $table->date('tanggal_kejadian')->nullable();
            $table->time('waktu_kejadian')->nullable();
            $table->string('tembusan_camat')->nullable();
            $table->string('tembusan_lurah')->nullable();
            
            // Wajib nullable() karena di Controller kamu tidak mengirimkan data 'tanggal_surat'
            $table->dateTime('tanggal_surat')->nullable();
            
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
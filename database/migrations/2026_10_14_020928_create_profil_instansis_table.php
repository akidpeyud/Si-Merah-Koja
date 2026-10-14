<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_instansis', function (Blueprint $table) {
            $table->id();
            // Menyimpan slug kategori: visi-misi, sotk, tupoksi, program-kegiatan, cascading
            $table->string('kategori')->index();
            $table->string('judul');                  // Judul dokumen / informasi profil
            $table->year('tahun')->nullable();        // Tahun periode / penetapan (opsional)
            $table->text('keterangan')->nullable();   // Isi teks / deskripsi / uraian
            $table->string('file_dokumen')->nullable(); // Path file PDF (opsional/wajib sesuai kebutuhan)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_instansis');
    }
};
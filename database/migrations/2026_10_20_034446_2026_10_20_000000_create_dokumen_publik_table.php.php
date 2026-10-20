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
        Schema::create('dokumen_publik', function (Blueprint $table) {
            $table->id();
            $table->string('judul_dokumen');
            $table->string('kategori')->nullable(); // Contoh: Renstra, Renja, SPM, SAKIP, LPPD, dll.
            $table->string('nama_file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_publik');
    }
};
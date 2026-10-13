<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumen_publik', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            // Kategori mencakup Renstra, Renja, SPM, SAKIP, LPPD
            $table->enum('kategori', ['Renstra', 'Renja', 'SPM', 'SAKIP', 'LPPD']);
            $table->year('tahun')->nullable();
            $table->string('file_path'); // Menyimpan path file PDF/dokumen
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_publik');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('dokumen_sop')) {
            Schema::create('dokumen_sop', function (Blueprint $table) {
                $table->id();
                $table->string('judul_dokumen');
                $table->string('kategori', 100)->default('SOP');
                $table->string('sub_kategori', 100)->nullable();
                $table->string('nama_file');
                $table->string('file_path')->nullable();
                $table->timestamps();
            });

            return;
        }

        // Tabel sudah ada dari versi lama: tambahkan kolom yang kurang
        if (! Schema::hasColumn('dokumen_sop', 'file_path')) {
            Schema::table('dokumen_sop', function (Blueprint $table) {
                $table->string('file_path')->nullable()->after('nama_file');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_sop');
    }
};

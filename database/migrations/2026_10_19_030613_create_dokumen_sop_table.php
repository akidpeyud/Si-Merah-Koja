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
    Schema::create('dokumen_sop', function (Blueprint $table) {
        $table->id();
        $table->string('judul_dokumen');
        $table->string('kategori', 100)->default('SOP');
        $table->string('sub_kategori', 100)->nullable();
        $table->string('nama_file');
        $table->string('file_path')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_sop');
    }
};

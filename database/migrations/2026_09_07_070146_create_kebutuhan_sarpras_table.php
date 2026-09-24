<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kebutuhan_sarpras', function (Blueprint $table) {
            $table->id();
            $table->string('uraian', 255); // Uraian barang/jasa
            $table->integer('jumlah_dibutuhkan')->default(0);
            $table->integer('jumlah_tersedia')->default(0);
            $table->integer('jumlah_belum_tersedia')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kebutuhan_sarpras');
    }
};
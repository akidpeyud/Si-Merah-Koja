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
        Schema::create('kebutuhan_sarpras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uraian');
            $table->integer('jumlah_dibutuhkan')->default(0);
            $table->integer('jumlah_tersedia')->default(0);
            $table->integer('jumlah_belum_tersedia')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kebutuhan_sarpras');
    }
};

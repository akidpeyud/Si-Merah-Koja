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
        Schema::create('baju_tahan_panas', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('nama_penerima');
            $table->string('warna_baju')->nullable();
            $table->integer('tahun_baju')->nullable();
            $table->boolean('helm')->default(false);
            $table->integer('tahun_helm')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baju_tahan_panas');
    }
};

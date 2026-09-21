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
        Schema::create('lokasi_pos', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('nama_lokasi', 100);
            $table->enum('tipe', ['MAKO', 'POS'])->default('POS');
            $table->text('alamat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi_pos');
    }
};

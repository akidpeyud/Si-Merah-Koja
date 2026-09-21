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
        Schema::create('pembinaan', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('nama_program');
            $table->string('lokasi');
            $table->date('tanggal_pelaksanaan');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('sasaran_pembinaan');
            $table->integer('target_peserta');
            $table->string('dokumen_pendukung')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembinaan');
    }
};

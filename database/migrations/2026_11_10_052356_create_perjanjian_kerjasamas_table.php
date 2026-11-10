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
        Schema::create('perjanjian_kerjasamas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->string('nomor_pks');
            $table->date('tanggal_perjanjian')->nullable();
            $table->integer('tahun')->nullable()->index();
            $table->string('lama_kerjasama')->nullable();
            $table->string('pihak_pertama')->nullable();
            $table->string('pihak_kedua')->nullable();
            $table->string('file_dokumen')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perjanjian_kerjasamas');
    }
};

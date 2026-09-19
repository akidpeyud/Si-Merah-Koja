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
        Schema::create('apab_apars', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('nama_penerima')->nullable();
            $table->string('jenis_barang');
            $table->integer('jumlah')->default(1);
            $table->year('tahun_pengadaan')->nullable();
            $table->string('kondisi')->default('Baik');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apab_apars');
    }
};

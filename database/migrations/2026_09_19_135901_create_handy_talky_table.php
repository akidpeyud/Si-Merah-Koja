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
        Schema::create('handy_talky', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('nama_penerima')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('tahun')->nullable();
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
        Schema::dropIfExists('handy_talky');
    }
};

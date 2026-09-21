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
        Schema::create('data_sepatu_safety', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('no_urut')->nullable();
            $table->string('nama_penerima')->nullable();
            $table->string('sepatu_safety', 50)->nullable();
            $table->integer('tahun')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_sepatu_safety');
    }
};

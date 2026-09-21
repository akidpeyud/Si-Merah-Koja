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
        Schema::create('sarana_pemeriksaan', function (Blueprint $table) {
            $table->integer('id_sarana_pemeriksaan', true);
            $table->integer('id_pos')->nullable();
            $table->string('jenis_sarana')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('path_gambar')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sarana_pemeriksaan');
    }
};

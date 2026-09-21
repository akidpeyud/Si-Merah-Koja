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
        Schema::create('pos_pemadam', function (Blueprint $table) {
            $table->integer('id_pos', true);
            $table->string('nama_pos', 50);
            $table->text('alamat')->nullable();
            $table->string('kode_map', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_pemadam');
    }
};

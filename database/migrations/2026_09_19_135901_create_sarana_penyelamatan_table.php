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
        Schema::create('sarana_penyelamatan', function (Blueprint $table) {
            $table->integer('id_sarana_penyelamatan', true);
            $table->integer('id_pos')->nullable()->index('id_pos');
            $table->string('jenis_sarana');
            $table->integer('jumlah');
            $table->string('path_gambar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sarana_penyelamatan');
    }
};

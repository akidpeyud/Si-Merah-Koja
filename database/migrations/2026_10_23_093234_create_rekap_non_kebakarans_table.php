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
        Schema::create('rekap_non_kebakarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('tahun')->default(2023)->index();
            $table->string('bulan', 20)->index();
            $table->unsignedTinyInteger('bulan_angka')->nullable()->index();
            $table->unsignedInteger('total_kejadian')->default(0);
            $table->json('rincian_bencana')->nullable();
            $table->json('rincian_kecamatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_non_kebakarans');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ikm_respondens', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100)->nullable();
            $table->string('jenis_layanan', 100);

            // 9 unsur pelayanan (Permenpan RB No. 14 Tahun 2017), nilai 1-4
            for ($i = 1; $i <= 9; $i++) {
                $table->unsignedTinyInteger("u{$i}");
            }

            $table->text('saran')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ikm_respondens');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kejadian_damkar', function (Blueprint $t) {
            $t->id();
            $t->string('judul');
            $t->enum('jenis', ['pemadaman', 'penyelamatan', 'evakuasi']);
            $t->string('lokasi')->nullable();
            $t->dateTime('tanggal');
            $t->text('deskripsi')->nullable();
            $t->string('link', 2000)->nullable();
            $t->string('sumber')->nullable();
            $t->string('gambar')->nullable();
            $t->string('youtube_id', 20)->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kejadian_damkar');
    }
};
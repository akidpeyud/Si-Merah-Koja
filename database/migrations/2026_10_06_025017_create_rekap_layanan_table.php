<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekap_layanan', function (Blueprint $t) {
            $t->id();
            $t->date('tanggal');
            $t->string('kategori', 40)->index();
            $t->unsignedSmallInteger('jumlah')->default(1);
            $t->string('kecamatan', 100)->nullable();
            $t->string('lokasi', 255)->nullable();
            $t->text('keterangan')->nullable();
            $t->unsignedBigInteger('dibuat_oleh')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekap_layanan');
    }
};
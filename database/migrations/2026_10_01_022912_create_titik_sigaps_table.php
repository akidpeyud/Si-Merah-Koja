<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('titik_sigaps', function (Blueprint $table) {
            $table->id();
            // Kategori memakai string (bukan enum) agar menambah / mengubah kategori
            // tidak perlu migration baru. Nilai yang valid dikendalikan oleh
            // TitikSigap::KATEGORI dan validasi di PetaController.
            // Saat ini: sumber_air, hydrant, hydrant_pilar, water_truck, pos, zona_rawan
            $table->string('kategori', 50)->index();
            $table->string('nama');
            $table->text('lokasi');
            $table->text('keterangan')->nullable();
            // Tipe data decimal untuk presisi koordinat peta (Latitude dan Longitude)
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('titik_sigaps');
    }
};
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
            // Enum kategori sesuai dengan pilihan di form HTML
            $table->enum('kategori', ['kebakaran', 'sumber_air', 'hydrant', 'penyelamatan', 'pos']);
            $table->string('nama');
            $table->date('tanggal')->nullable();
            $table->text('lokasi');
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
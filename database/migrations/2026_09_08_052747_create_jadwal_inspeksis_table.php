<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jadwal_inspeksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_instansi')->nullable();
            $table->date('tanggal_inspeksi')->nullable();
            $table->string('tim_petugas')->nullable();
            $table->text('alamat')->nullable();
            $table->string('jml_gedung_tinggi')->nullable();
            $table->string('jml_gedung_sedang')->nullable();
            $table->string('jml_gedung_rendah')->nullable();
            $table->text('catatan')->nullable();
            $table->string('dokumen_pendukung')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_inspeksis');
    }
};
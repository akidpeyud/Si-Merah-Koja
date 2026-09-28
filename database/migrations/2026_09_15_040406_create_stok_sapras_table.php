<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stok_sapras', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_barang');
            $table->integer('jumlah')->default(0);
            $table->string('kondisi')->default('Baik'); // 'Baik' atau 'Rusak'
            $table->string('tahun_anggaran')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stok_sapras');
    }
};
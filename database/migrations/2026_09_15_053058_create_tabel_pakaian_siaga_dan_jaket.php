<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $tables = [
            'baju_siaga_celana_training',
            'jaket_waterproof'
        ];

        foreach ($tables as $tableName) {
            Schema::dropIfExists($tableName); // Hapus dulu kalau sudah ada
            Schema::create($tableName, function (Blueprint $table) {
                $table->id();
                $table->string('nama_penerima')->nullable();
                $table->string('ukuran')->nullable(); // Diperbaiki dari jabatan ke ukuran
                $table->string('jumlah')->default('1');
                $table->string('tahun')->nullable();
                $table->string('kondisi')->default('Baik');
                $table->text('keterangan')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('baju_siaga_celana_training');
        Schema::dropIfExists('jaket_waterproof');
    }
};
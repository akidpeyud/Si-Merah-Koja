<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Daftar 7 tabel yang akan dibuat masing-masing
        $tables = [
            'apd_rescues', 
            'baju_evakuasi_lebahs', 
            'box_tempat_ulars', 
            'helm_climbings', 
            'stik_ulars', 
            'alat_evakuasi_lebahs', 
            'alat_pemotong_cincins'
        ];

        // Looping untuk membuat ke-7 tabel dengan struktur yang sama
        foreach ($tables as $tableName) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->id();
                $table->string('nama_penerima');
                $table->string('jabatan')->nullable();
                $table->string('jumlah')->nullable();
                $table->string('tahun')->nullable();
                $table->string('kondisi')->default('Baik');
                $table->text('keterangan')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        $tables = [
            'apd_rescues', 'baju_evakuasi_lebahs', 'box_tempat_ulars', 
            'helm_climbings', 'stik_ulars', 'alat_evakuasi_lebahs', 'alat_pemotong_cincins'
        ];

        foreach ($tables as $tableName) {
            Schema::dropIfExists($tableName);
        }
    }
};
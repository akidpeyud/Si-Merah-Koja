<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 8 Tabel Baru Sesuai File Excel
        $tables = [
            'fireman_hood',
            'handy_talky',
            'masker_asap',
            'sepatu_safety',
            'baju_driver_dan_baju_mekanik',
            'baju_tahan_panas_dan_helm_pemadam_kebakaran',
            'filter_atau_catridge_masker_asap',
            'fire_blanket'
        ];

        foreach ($tables as $tableName) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->id();
                $table->string('nama_penerima')->nullable();
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
            'fireman_hood', 'handy_talky', 'masker_asap', 'sepatu_safety',
            'baju_driver_dan_baju_mekanik', 'baju_tahan_panas_dan_helm_pemadam_kebakaran',
            'filter_atau_catridge_masker_asap', 'fire_blanket'
        ];

        foreach ($tables as $tableName) {
            Schema::dropIfExists($tableName);
        }
    }
};
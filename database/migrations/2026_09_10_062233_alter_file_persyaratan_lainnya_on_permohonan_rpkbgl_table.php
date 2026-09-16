<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('permohonan_rpkbgl', function (Blueprint $table) {
            // Mengubah kolom menjadi nullable
            $table->string('file_persyaratan_lainnya', 255)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('permohonan_rpkbgl', function (Blueprint $table) {
            $table->string('file_persyaratan_lainnya', 255)->nullable(false)->change();
        });
    }
};

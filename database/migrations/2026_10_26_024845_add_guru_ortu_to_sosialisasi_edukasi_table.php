<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sosialisasi_edukasi', function (Blueprint $table) {
            $table->integer('guru')->default(0)->after('nama_peserta_laki_laki');
            $table->integer('orang_tua')->default(0)->after('guru');
        });
    }

    public function down()
    {
        Schema::table('sosialisasi_edukasi', function (Blueprint $table) {
            $table->dropColumn(['guru', 'orang_tua']);
        });
    }
};

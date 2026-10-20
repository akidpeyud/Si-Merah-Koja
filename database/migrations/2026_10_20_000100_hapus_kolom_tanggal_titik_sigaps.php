<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Untuk database yang SUDAH berjalan: hapus kolom "tanggal" dari titik_sigaps.
 * Database baru (dari migration create_titik_sigaps_table versi terbaru)
 * sudah tidak punya kolom ini, jadi dilewati.
 */
return new class extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('titik_sigaps', 'tanggal')) {
            Schema::table('titik_sigaps', function (Blueprint $table) {
                $table->dropColumn('tanggal');
            });
        }
    }

    public function down()
    {
        if (!Schema::hasColumn('titik_sigaps', 'tanggal')) {
            Schema::table('titik_sigaps', function (Blueprint $table) {
                $table->date('tanggal')->nullable()->after('nama');
            });
        }
    }
};
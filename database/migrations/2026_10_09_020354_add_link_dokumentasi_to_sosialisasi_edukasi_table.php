<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sosialisasi_edukasi', function (Blueprint $table) {
            if (!Schema::hasColumn('sosialisasi_edukasi', 'link_dokumentasi')) {
                $table->text('link_dokumentasi')->nullable()->after('peserta_laki_laki');
            }
        });
    }

    public function down(): void
    {
        Schema::table('sosialisasi_edukasi', function (Blueprint $table) {
            if (Schema::hasColumn('sosialisasi_edukasi', 'link_dokumentasi')) {
                $table->dropColumn('link_dokumentasi');
            }
        });
    }
};
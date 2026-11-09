<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('inspeksi_bangunans')) {
            return;
        }

        if (! Schema::hasColumn('inspeksi_bangunans', 'tahun')) {
            Schema::table('inspeksi_bangunans', function (Blueprint $table) {
                $table->year('tahun')->nullable()->after('nama_tempat');
            });
        }

        DB::table('inspeksi_bangunans')
            ->whereNull('tahun')
            ->whereNotNull('tanggal_inspeksi')
            ->update([
                'tahun' => DB::raw('GREATEST(2025, YEAR(tanggal_inspeksi))'),
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('inspeksi_bangunans') && Schema::hasColumn('inspeksi_bangunans', 'tahun')) {
            Schema::table('inspeksi_bangunans', function (Blueprint $table) {
                $table->dropColumn('tahun');
            });
        }
    }
};

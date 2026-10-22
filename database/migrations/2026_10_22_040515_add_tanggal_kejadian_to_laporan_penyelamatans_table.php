<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporan_penyelamatans', function (Blueprint $table) {
            if (!Schema::hasColumn('laporan_penyelamatans', 'tanggal_kejadian')) {
                $table->date('tanggal_kejadian')->nullable()->index();
            }
            if (!Schema::hasColumn('laporan_penyelamatans', 'hari_kejadian')) {
                $table->string('hari_kejadian', 20)->nullable();
            }
            if (!Schema::hasColumn('laporan_penyelamatans', 'bulan_kejadian')) {
                $table->string('bulan_kejadian', 20)->nullable();
            }
            if (!Schema::hasColumn('laporan_penyelamatans', 'tahun_kejadian')) {
                $table->smallInteger('tahun_kejadian')->nullable()->index();
            }
        });

        // Isi data lama: utamakan waktu_kejadian, lalu waktu_terima, terakhir created_at
        DB::table('laporan_penyelamatans')
            ->whereNull('tanggal_kejadian')
            ->orderBy('id')
            ->each(function ($row) {
                $sumber = $row->waktu_kejadian ?: ($row->waktu_terima ?: $row->created_at);
                $t = Carbon::parse($sumber)->locale('id');
                DB::table('laporan_penyelamatans')->where('id', $row->id)->update([
                    'tanggal_kejadian' => $t->toDateString(),
                    'hari_kejadian'    => $t->translatedFormat('l'),
                    'bulan_kejadian'   => $t->translatedFormat('F'),
                    'tahun_kejadian'   => $t->year,
                ]);
            });
    }

    public function down(): void
    {
        Schema::table('laporan_penyelamatans', function (Blueprint $table) {
            $table->dropColumn(['tanggal_kejadian', 'hari_kejadian', 'bulan_kejadian', 'tahun_kejadian']);
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('laporan_penyelamatans', function (Blueprint $table) {
            if (! Schema::hasColumn('laporan_penyelamatans', 'nama_korban')) {
                $table->string('nama_korban')->nullable()->after('koordinat');
            }
            if (! Schema::hasColumn('laporan_penyelamatans', 'jumlah_jiwa')) {
                $table->integer('jumlah_jiwa')->default(0)->after('nama_korban');
            }
            if (! Schema::hasColumn('laporan_penyelamatans', 'warga_terdampak')) {
                $table->integer('warga_terdampak')->default(0)->after('jumlah_jiwa');
            }
        });

        Schema::table('lp_teknis_logistiks', function (Blueprint $table) {
            if (! Schema::hasColumn('lp_teknis_logistiks', 'nama_korban')) {
                $table->string('nama_korban')->nullable()->after('hasil_tindakan');
            }
            if (! Schema::hasColumn('lp_teknis_logistiks', 'jumlah_jiwa')) {
                $table->integer('jumlah_jiwa')->default(0)->after('nama_korban');
            }
            if (! Schema::hasColumn('lp_teknis_logistiks', 'warga_terdampak')) {
                $table->integer('warga_terdampak')->default(0)->after('jumlah_jiwa');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_penyelamatans', function (Blueprint $table) {
            $table->dropColumn(['nama_korban', 'jumlah_jiwa', 'warga_terdampak']);
        });

        Schema::table('lp_teknis_logistiks', function (Blueprint $table) {
            $table->dropColumn(['nama_korban', 'jumlah_jiwa', 'warga_terdampak']);
        });
    }
};

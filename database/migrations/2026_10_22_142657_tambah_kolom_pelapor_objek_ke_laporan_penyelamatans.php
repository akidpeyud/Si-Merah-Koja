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
            if (! Schema::hasColumn('laporan_penyelamatans', 'telepon_pelapor')) {
                $table->string('telepon_pelapor')->nullable()->after('nama_pelapor');
            }
            if (! Schema::hasColumn('laporan_penyelamatans', 'keterangan_objek_kebakaran')) {
                $table->string('keterangan_objek_kebakaran')->nullable()->after('kategori_kebakaran');
            }
            if (! Schema::hasColumn('laporan_penyelamatans', 'rincian_objek')) {
                $table->json('rincian_objek')->nullable()->after('keterangan_objek_kebakaran');
            }
        });
    }

    public function down(): void
    {
        Schema::table('laporan_penyelamatans', function (Blueprint $table) {
            $table->dropColumn(['telepon_pelapor', 'keterangan_objek_kebakaran', 'rincian_objek']);
        });
    }
};

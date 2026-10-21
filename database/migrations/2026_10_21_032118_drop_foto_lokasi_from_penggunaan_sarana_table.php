<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penggunaan_sarana', function (Blueprint $table) {
            // 1. Hapus kolom foto_lokasi jika masih ada di database
            if (Schema::hasColumn('penggunaan_sarana', 'foto_lokasi')) {
                $table->dropColumn('foto_lokasi');
            }

            // 2. Pastikan 3 kolom berkas yang baru sudah ada (jaga-jaga jika belum masuk ke tabel)
            if (!Schema::hasColumn('penggunaan_sarana', 'surat_permohonan')) {
                $table->string('surat_permohonan')->after('waktu_selesai');
            }
            if (!Schema::hasColumn('penggunaan_sarana', 'fotokopi_ktp')) {
                $table->string('fotokopi_ktp')->after('surat_permohonan');
            }
            if (!Schema::hasColumn('penggunaan_sarana', 'sket_denah_lokasi')) {
                $table->string('sket_denah_lokasi')->after('fotokopi_ktp');
            }
        });
    }

    public function down(): void
    {
        Schema::table('penggunaan_sarana', function (Blueprint $table) {
            if (!Schema::hasColumn('penggunaan_sarana', 'foto_lokasi')) {
                $table->string('foto_lokasi')->nullable();
            }
        });
    }
};
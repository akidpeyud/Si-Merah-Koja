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
        Schema::table('izin_keramaian', function (Blueprint $table) {
            if (!Schema::hasColumn('izin_keramaian', 'jenis_event')) {
                $table->enum('jenis_event', ['hiburan', 'non_hiburan'])
                      ->default('non_hiburan')->after('nama_acara');
            }
            
            if (!Schema::hasColumn('izin_keramaian', 'surat_permohonan')) {
                $table->string('surat_permohonan')->nullable()->after('jumlah_staff');
            }
            
            if (!Schema::hasColumn('izin_keramaian', 'fotokopi_ktp')) {
                $table->string('fotokopi_ktp')->nullable()->after('surat_permohonan');
            }
            
            if (!Schema::hasColumn('izin_keramaian', 'bukti_pajak_bpprd')) {
                $table->string('bukti_pajak_bpprd')->nullable()->after('foto_jalur_evakuasi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('izin_keramaian', function (Blueprint $table) {
            $columns = [];
            
            if (Schema::hasColumn('izin_keramaian', 'jenis_event')) {
                $columns[] = 'jenis_event';
            }
            if (Schema::hasColumn('izin_keramaian', 'surat_permohonan')) {
                $columns[] = 'surat_permohonan';
            }
            if (Schema::hasColumn('izin_keramaian', 'fotokopi_ktp')) {
                $columns[] = 'fotokopi_ktp';
            }
            if (Schema::hasColumn('izin_keramaian', 'bukti_pajak_bpprd')) {
                $columns[] = 'bukti_pajak_bpprd';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('permohonan_rpkbgl', function (Blueprint $table) {
            if (!Schema::hasColumn('permohonan_rpkbgl', 'ada_lift')) {
                $table->enum('ada_lift', ['ya', 'tidak'])->nullable()->after('tinggi_bangunan');
            }
            if (!Schema::hasColumn('permohonan_rpkbgl', 'tgl_pemeriksaan')) {
                $table->date('tgl_pemeriksaan')->nullable()->after('ada_lift');
            }
            if (!Schema::hasColumn('permohonan_rpkbgl', 'file_fotokopi_ktp')) {
                $table->string('file_fotokopi_ktp')->nullable()->after('file_surat_permohonan');
            }
            if (!Schema::hasColumn('permohonan_rpkbgl', 'file_nib')) {
                $table->string('file_nib')->nullable()->after('file_fotokopi_ktp');
            }
            if (!Schema::hasColumn('permohonan_rpkbgl', 'file_pbg_imb')) {
                $table->string('file_pbg_imb')->nullable()->after('file_nib');
            }
            if (!Schema::hasColumn('permohonan_rpkbgl', 'file_slo_listrik')) {
                $table->string('file_slo_listrik')->nullable()->after('file_pbg_imb');
            }
            if (!Schema::hasColumn('permohonan_rpkbgl', 'file_slf_bangunan')) {
                $table->string('file_slf_bangunan')->nullable()->after('file_slo_listrik');
            }
            if (!Schema::hasColumn('permohonan_rpkbgl', 'file_denah_bangunan')) {
                $table->string('file_denah_bangunan')->nullable()->after('file_slf_bangunan');
            }
            if (!Schema::hasColumn('permohonan_rpkbgl', 'file_pjk3')) {
                $table->string('file_pjk3')->nullable()->after('file_denah_bangunan');
            }
            if (!Schema::hasColumn('permohonan_rpkbgl', 'file_data_teknis_proteksi')) {
                $table->text('file_data_teknis_proteksi')->nullable()->after('file_pjk3');
            }
        });

        // Ubah tipe kolom jika kolom tersebut sudah ada di tabel
        if (Schema::hasColumn('permohonan_rpkbgl', 'file_persyaratan_lainnya')) {
            Schema::table('permohonan_rpkbgl', function (Blueprint $table) {
                $table->text('file_persyaratan_lainnya')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        $columnsToDrop = [
            'ada_lift', // Ditambahkan agar konsisten saat rollback
            'tgl_pemeriksaan',
            'file_fotokopi_ktp',
            'file_nib',
            'file_pbg_imb',
            'file_slo_listrik',
            'file_slf_bangunan',
            'file_denah_bangunan',
            'file_pjk3',
            'file_data_teknis_proteksi',
        ];

        Schema::table('permohonan_rpkbgl', function (Blueprint $table) use ($columnsToDrop) {
            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('permohonan_rpkbgl', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        if (Schema::hasColumn('permohonan_rpkbgl', 'file_persyaratan_lainnya')) {
            Schema::table('permohonan_rpkbgl', function (Blueprint $table) {
                $table->string('file_persyaratan_lainnya')->nullable()->change();
            });
        }
    }
};
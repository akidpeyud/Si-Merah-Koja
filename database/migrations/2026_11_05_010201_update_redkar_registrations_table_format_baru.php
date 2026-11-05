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
        // 1. Ubah Primary Key dari VARCHAR ('RDK-...') menjadi BIGINT UNSIGNED AUTO_INCREMENT biasa
        DB::statement('ALTER TABLE redkar_registrations DROP PRIMARY KEY');
        DB::statement('ALTER TABLE redkar_registrations DROP COLUMN id');
        DB::statement('ALTER TABLE redkar_registrations ADD COLUMN id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST');

        // 2. Tambah kolom tanggal pembentukan dan pengukuhan REDKAR
        Schema::table('redkar_registrations', function (Blueprint $table) {
            if (! Schema::hasColumn('redkar_registrations', 'tanggal_pembentukan')) {
                $table->date('tanggal_pembentukan')->nullable()->after('nomor_telp');
            }
            if (! Schema::hasColumn('redkar_registrations', 'tanggal_pengukuhan')) {
                $table->date('tanggal_pengukuhan')->nullable()->after('tanggal_pembentukan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('redkar_registrations', function (Blueprint $table) {
            if (Schema::hasColumn('redkar_registrations', 'tanggal_pengukuhan')) {
                $table->dropColumn('tanggal_pengukuhan');
            }
            if (Schema::hasColumn('redkar_registrations', 'tanggal_pembentukan')) {
                $table->dropColumn('tanggal_pembentukan');
            }
        });

        DB::statement('ALTER TABLE redkar_registrations DROP PRIMARY KEY');
        DB::statement('ALTER TABLE redkar_registrations DROP COLUMN id');
        DB::statement('ALTER TABLE redkar_registrations ADD COLUMN id VARCHAR(255) NOT NULL PRIMARY KEY FIRST');
    }
};

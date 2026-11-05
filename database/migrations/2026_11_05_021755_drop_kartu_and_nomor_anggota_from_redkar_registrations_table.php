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
        Schema::table('redkar_registrations', function (Blueprint $table) {
            $dropCols = [];
            if (Schema::hasColumn('redkar_registrations', 'kartu_anggota')) {
                $dropCols[] = 'kartu_anggota';
            }
            if (Schema::hasColumn('redkar_registrations', 'nomor_anggota')) {
                $dropCols[] = 'nomor_anggota';
            }
            if (! empty($dropCols)) {
                $table->dropColumn($dropCols);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('redkar_registrations', function (Blueprint $table) {
            if (! Schema::hasColumn('redkar_registrations', 'kartu_anggota')) {
                $table->string('kartu_anggota', 30)->nullable();
            }
            if (! Schema::hasColumn('redkar_registrations', 'nomor_anggota')) {
                $table->string('nomor_anggota', 30)->nullable();
            }
        });
    }
};

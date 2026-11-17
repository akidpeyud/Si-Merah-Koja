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
            if (Schema::hasColumn('redkar_registrations', 'kartu_anggota')) {
                $table->dropColumn('kartu_anggota');
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
                $table->string('kartu_anggota', 50)->nullable()->after('golongan_darah');
            }
        });
    }
};

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
        Schema::table('pegawais', function (Blueprint $table) {
            $table->string('pendidikan_tahun_lulus', 255)->nullable()->change();
            $table->string('latihan_jabatan_tahun_lulus', 255)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->string('pendidikan_tahun_lulus', 4)->nullable()->change();
            $table->string('latihan_jabatan_tahun_lulus', 4)->nullable()->change();
        });
    }
};

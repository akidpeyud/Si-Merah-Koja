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
        Schema::table('pengadaan_sarpras', function (Blueprint $table) {
            $table->foreign(['kebutuhan_id'], 'pengadaan_sarpras_ibfk_1')->references(['id'])->on('kebutuhan_sarpras')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengadaan_sarpras', function (Blueprint $table) {
            $table->dropForeign('pengadaan_sarpras_ibfk_1');
        });
    }
};

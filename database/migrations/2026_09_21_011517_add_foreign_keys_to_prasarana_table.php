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
        Schema::table('prasarana', function (Blueprint $table) {
            $table->foreign(['id_pos'], 'prasarana_ibfk_1')->references(['id_pos'])->on('pos_pemadam')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prasarana', function (Blueprint $table) {
            $table->dropForeign('prasarana_ibfk_1');
        });
    }
};

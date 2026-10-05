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
        Schema::table('sessions', function (Blueprint $table) {
            // Mengubah tipe kolom user_id dari integer menjadi string
            // agar bisa menampung ID seperti "RDK-1111111111111111"
            $table->string('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sessions', function (Blueprint $table) {
            // Jika di-rollback, kembalikan ke tipe awalnya (bigInteger)
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }
};
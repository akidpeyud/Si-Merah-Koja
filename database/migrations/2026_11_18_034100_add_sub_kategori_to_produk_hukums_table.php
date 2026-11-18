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
        Schema::table('produk_hukums', function (Blueprint $table) {
            $table->string('sub_kategori', 100)->nullable()->after('kategori')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk_hukums', function (Blueprint $table) {
            $table->dropIndex(['sub_kategori']);
            $table->dropColumn('sub_kategori');
        });
    }
};

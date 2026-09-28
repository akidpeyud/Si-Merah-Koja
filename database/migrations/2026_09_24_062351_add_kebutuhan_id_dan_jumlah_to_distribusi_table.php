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
        Schema::table('distribusi_barang_staff', function (Blueprint $table) {
            // Tambahkan nullable() agar data lama yang sudah ada tidak error saat dimigrasi
            $table->unsignedBigInteger('kebutuhan_id')->nullable()->after('nama_penerima');
            $table->integer('jumlah')->default(1)->after('nama_barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('distribusi_barang_staff', function (Blueprint $table) {
            $table->dropColumn(['kebutuhan_id', 'jumlah']);
        });
    }
};
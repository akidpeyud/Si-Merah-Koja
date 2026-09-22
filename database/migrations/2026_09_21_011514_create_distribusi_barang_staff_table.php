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
        Schema::create('distribusi_barang_staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_penerima');
            $table->string('nama_barang');
            $table->string('detail_barang')->nullable();
            $table->dateTime('waktu_terima');
            $table->text('keterangan')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribusi_barang_staff');
    }
};

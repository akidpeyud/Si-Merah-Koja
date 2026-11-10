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
        Schema::create('perbaikan_kendaraans', function (Blueprint $table) {
            $table->id();
            $table->string('nopol_kendaraan');
            $table->string('jenis_kendaraan', 20);
            $table->string('merk_kendaraan');
            $table->date('tgl_perbaikan');
            $table->string('jenis_kerusakan');
            $table->string('merek_tipe_barang')->nullable();
            $table->string('satuan', 100)->nullable();
            $table->bigInteger('total_harga')->default(0);
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbaikan_kendaraans');
    }
};

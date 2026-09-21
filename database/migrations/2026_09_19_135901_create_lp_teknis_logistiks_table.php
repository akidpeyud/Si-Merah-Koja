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
        Schema::create('lp_teknis_logistiks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('laporan_id');
            $table->string('pimpinan_operasi')->nullable();
            $table->string('satuan_tugas')->nullable();
            $table->integer('korban_selamat')->default(0);
            $table->integer('korban_ringan')->default(0);
            $table->integer('korban_berat')->default(0);
            $table->integer('korban_meninggal')->default(0);
            $table->string('korban_hewan_aset')->nullable();
            $table->string('status_evakuasi')->nullable();
            $table->string('objek_terdampak')->nullable();
            $table->longText('metode_evakuasi')->nullable();
            $table->longText('metode_penyelamatan')->nullable();
            $table->text('hambatan_lapangan')->nullable();
            $table->text('langkah_penanganan')->nullable();
            $table->string('hasil_tindakan')->nullable();
            $table->longText('peralatan')->nullable();
            $table->string('peralatan_lain')->nullable();
            $table->string('konsumsi_alat')->nullable();
            $table->integer('liter_air')->default(0);
            $table->integer('liter_foam')->default(0);
            $table->integer('liter_bbm')->default(0);
            $table->longText('armada')->nullable();
            $table->integer('jumlah_personel')->default(0);
            $table->text('daftar_personel')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lp_teknis_logistiks');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lp_teknis_logistiks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->constrained('laporan_penyelamatans')->onDelete('cascade');
            
            // Personel
            $table->string('pimpinan_operasi')->nullable();
            $table->string('pendamping_operasi')->nullable();
            $table->string('satuan_tugas')->nullable();
            $table->string('tim_respontime')->nullable();
            $table->integer('jumlah_personel')->default(0);
            $table->text('daftar_personel')->nullable();
            
            // Teknis Evakuasi
            $table->text('langkah_penanganan')->nullable();
            $table->text('hambatan_lapangan')->nullable();
            $table->text('hasil_tindakan')->nullable();
            $table->string('status_evakuasi')->nullable();
            $table->string('objek_terdampak')->nullable();
            $table->json('metode_evakuasi')->nullable();
            $table->json('metode_penyelamatan')->nullable();
            
            // Korban
            $table->integer('korban_selamat')->default(0);
            $table->integer('korban_ringan')->default(0);
            $table->integer('korban_berat')->default(0);
            $table->integer('korban_meninggal')->default(0);
            $table->string('korban_hewan_aset')->nullable();
            
            // Logistik & Armada
            $table->json('armada')->nullable();
            $table->json('peralatan')->nullable();
            $table->text('peralatan_lain')->nullable();
            $table->text('konsumsi_alat')->nullable();
            $table->integer('liter_air')->default(0);
            $table->integer('liter_foam')->default(0);
            $table->integer('liter_bbm')->default(0);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lp_teknis_logistiks');
    }
};
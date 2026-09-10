<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('lp_teknis_logistiks', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel utama
            $table->foreignId('laporan_id')->constrained('laporan_penyelamatans')->onDelete('cascade');
            
            $table->integer('korban_selamat')->default(0);
            $table->integer('korban_ringan')->default(0);
            $table->integer('korban_berat')->default(0);
            $table->integer('korban_meninggal')->default(0);
            $table->string('korban_hewan_aset')->nullable();
            
            $table->string('status_evakuasi')->nullable();
            $table->string('objek_terdampak')->nullable();
            $table->json('metode_evakuasi')->nullable();
            $table->json('metode_penyelamatan')->nullable();
            $table->text('hambatan_lapangan')->nullable();
            
            $table->json('peralatan')->nullable();
            $table->string('peralatan_lain')->nullable();
            $table->string('konsumsi_alat')->nullable();
            $table->integer('liter_air')->default(0);
            $table->integer('liter_foam')->default(0);
            $table->integer('liter_bbm')->default(0);
            $table->json('armada')->nullable();
            $table->integer('jumlah_personel')->default(0);
            $table->text('daftar_personel')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('lp_teknis_logistiks');
    }
};
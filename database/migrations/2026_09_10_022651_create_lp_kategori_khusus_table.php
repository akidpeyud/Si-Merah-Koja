<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('lp_kategori_khusus', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel utama
            $table->foreignId('laporan_id')->constrained('laporan_penyelamatans')->onDelete('cascade');
            
            // Animal Rescue
            $table->string('jenis_hewan')->nullable();
            $table->string('spesies_hewan')->nullable();
            $table->string('dimensi_hewan')->nullable();
            $table->string('status_hewan_pasca')->nullable();
            $table->string('lokasi_pelepasan')->nullable();
            
            // Pohon Tumbang
            $table->string('jenis_objek_tumbang')->nullable();
            $table->decimal('dimensi_objek', 10, 2)->nullable();
            $table->string('status_utilitas')->nullable();
            $table->text('dampak_properti')->nullable();
            
            // Water Rescue
            $table->string('kondisi_perairan')->nullable();
            $table->integer('radius_pencarian')->nullable();
            $table->string('metode_pencarian_air')->nullable();
            $table->text('daftar_penyelam')->nullable();
            
            // Cincin & Geografis
            $table->string('jenis_benda_bahaya')->nullable();
            $table->string('kondisi_anggota_tubuh')->nullable();
            $table->string('alat_potong_cincin')->nullable();
            $table->string('cuaca_operasi')->nullable();
            $table->string('jenis_medan')->nullable();
            $table->string('akses_lokasi')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('lp_kategori_khusus');
    }
};
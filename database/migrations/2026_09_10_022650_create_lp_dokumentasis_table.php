<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('lp_dokumentasis', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel utama
            $table->foreignId('laporan_id')->constrained('laporan_penyelamatans')->onDelete('cascade');
            
            $table->string('dugaan_penyebab')->nullable();
            $table->string('dugaan_penyebab_lainnya')->nullable();
            $table->string('sumber_api')->nullable();
            $table->decimal('luas_area', 10, 2)->nullable();
            
            $table->json('instansi_pendukung')->nullable();
            $table->text('tindakan_instansi')->nullable();
            $table->string('kontak_saksi', 20)->nullable();
            $table->text('kebutuhan_tambahan')->nullable();
            $table->text('saran_mitigasi')->nullable();
            $table->text('kronologi_lengkap')->nullable();
            
            $table->json('foto')->nullable();
            $table->string('video')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('lp_dokumentasis');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laporan_penyelamatans', function (Blueprint $table) {
            $table->id();
            
            // Tab 1: Informasi Dasar
            $table->string('nomor_laporan')->unique();
            $table->uuid('id_laporan')->unique();
            $table->string('kategori_kebakaran')->nullable();
            $table->string('kategori_non_kebakaran')->nullable();
            $table->string('rincian_kategori_non_kebakaran')->nullable();
            $table->string('kategori_kejadian')->nullable();
            $table->enum('prioritas', ['rendah', 'sedang', 'tinggi', 'darurat'])->nullable();
            $table->dateTime('waktu_kejadian')->nullable();
            $table->dateTime('waktu_terima')->nullable();
            $table->dateTime('waktu_berangkat')->nullable();
            $table->dateTime('waktu_tiba')->nullable();
            $table->dateTime('waktu_selesai')->nullable();
            $table->text('alamat')->nullable();
            $table->string('koordinat')->nullable();

            // Tab 2: Teknis & Logistik
            $table->integer('korban_selamat')->default(0);
            $table->integer('korban_ringan')->default(0);
            $table->integer('korban_berat')->default(0);
            $table->integer('korban_meninggal')->default(0);
            $table->string('korban_hewan_aset')->nullable();
            
            $table->string('status_evakuasi')->nullable();
            $table->string('objek_terdampak')->nullable();
            $table->json('metode_evakuasi')->nullable(); // Array checkbox
            $table->json('metode_penyelamatan')->nullable(); // Array checkbox
            $table->text('hambatan_lapangan')->nullable();
            
            $table->json('peralatan')->nullable(); // Array checkbox
            $table->string('peralatan_lain')->nullable();
            $table->string('konsumsi_alat')->nullable();
            $table->integer('liter_air')->nullable();
            $table->integer('liter_foam')->nullable();
            $table->integer('liter_bbm')->nullable();
            
            $table->json('armada')->nullable(); // Array checkbox
            $table->integer('jumlah_personel')->nullable();
            $table->text('daftar_personel')->nullable();

            // Tab 3: Dokumentasi & Validasi
            $table->string('dugaan_penyebab')->nullable();
            $table->string('dugaan_penyebab_lainnya')->nullable();
            $table->string('sumber_api')->nullable();
            $table->float('luas_area')->nullable();
            
            $table->json('instansi_pendukung')->nullable(); // Array checkbox
            $table->text('tindakan_instansi')->nullable();
            $table->string('kontak_saksi')->nullable();
            $table->text('kebutuhan_tambahan')->nullable();
            $table->text('saran_mitigasi')->nullable();
            $table->text('kronologi_lengkap')->nullable();
            
            $table->json('foto')->nullable(); // Array nama file foto
            $table->string('video')->nullable(); // Nama file video

            // Tab 4: Kategori Khusus
            // Animal Rescue
            $table->string('jenis_hewan')->nullable();
            $table->string('spesies_hewan')->nullable();
            $table->string('dimensi_hewan')->nullable();
            $table->string('status_hewan_pasca')->nullable();
            $table->string('lokasi_pelepasan')->nullable();
            // Pohon Tumbang
            $table->string('jenis_objek_tumbang')->nullable();
            $table->float('dimensi_objek')->nullable();
            $table->string('status_utilitas')->nullable();
            $table->text('dampak_properti')->nullable();
            // Water Rescue
            $table->string('kondisi_perairan')->nullable();
            $table->integer('radius_pencarian')->nullable();
            $table->string('metode_pencarian_air')->nullable();
            $table->text('daftar_penyelam')->nullable();
            // Ring Removal / Geografis
            $table->string('jenis_benda_bahaya')->nullable();
            $table->string('kondisi_anggota_tubuh')->nullable();
            $table->string('alat_potong_cincin')->nullable();
            $table->string('cuaca_operasi')->nullable();
            $table->string('jenis_medan')->nullable();
            $table->string('akses_lokasi')->nullable();

            // Relasi ke tabel users (siapa yang input)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_penyelamatans');
    }
};
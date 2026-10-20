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
        Schema::create('izin_keramaian', function (Blueprint $table) {
            $table->id();
            
            // 1. Data Pemohon
            $table->string('nama');
            $table->char('nik', 16);
            $table->string('no_hp');
            $table->text('alamat');
            
            // 2. Data Usaha
            $table->string('nama_direktur');
            $table->string('nama_usaha');
            $table->string('no_izin_usaha');
            
            // 3. Data Lokasi Acara
            $table->string('nama_acara');
            $table->enum('jenis_event', ['hiburan', 'non_hiburan']); // TAMBAHAN BARU
            $table->string('lokasi_acara');
            $table->date('tgl_pelaksanaan');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->integer('jumlah_penonton');
            
            // 4. Data Peralatan
            $table->integer('jumlah_apar')->default(8);
            $table->integer('jumlah_staff')->default(4);
            
            // 5. Berkas Persyaratan (Path file)
            $table->string('surat_permohonan'); // TAMBAHAN BARU
            $table->string('fotokopi_ktp'); // TAMBAHAN BARU
            $table->string('foto_jalur_evakuasi'); 
            $table->string('bukti_pajak_bpprd')->nullable(); // TAMBAHAN BARU (Nullable karena khusus hiburan)
            $table->string('surat_pernyataan'); 

            // Status Permohonan (Pending, Proses, Disetujui, Ditolak)
            $table->string('status_permohonan')->default('Pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izin_keramaian');
    }
};
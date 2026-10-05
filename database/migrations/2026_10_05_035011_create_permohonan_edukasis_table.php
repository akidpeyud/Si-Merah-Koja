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
        // Nama tabel disesuaikan menjadi 'permohonan_edukasi' agar sinkron dengan Model
        Schema::create('permohonan_edukasi', function (Blueprint $table) {
            $table->id();
            
            // Data Institusi & Lokasi
            $table->string('institusi', 150);
            $table->text('alamat_institusi');
            $table->string('kecamatan');
            $table->string('kelurahan');
            
            // Data Pemohon
            $table->string('nama_pemohon', 150);
            $table->string('jabatan_pemohon', 100);
            $table->string('nik', 30);
            $table->string('no_kontak', 25);
            
            // Data Kegiatan & Peserta
            $table->date('tgl_kegiatan');
            $table->integer('usia_3_6')->nullable()->default(0);
            $table->integer('usia_7_12')->nullable()->default(0);
            $table->integer('usia_13_18')->nullable()->default(0);
            $table->integer('usia_18_keatas')->nullable()->default(0);
            
            // Data Berkas (File Uploads)
            $table->string('surat_permohonan'); // Wajib
            $table->json('syarat_lainnya')->nullable(); // Disimpan sebagai JSON array
            
            // Status Pengajuan
            $table->enum('status_permohonan', ['Pending', 'Disetujui', 'Ditolak'])->default('Pending');
            
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Sesuaikan juga pada bagian down
        Schema::dropIfExists('permohonan_edukasi');
    }
};
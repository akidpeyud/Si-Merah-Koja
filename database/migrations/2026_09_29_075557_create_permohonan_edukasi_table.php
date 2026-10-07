<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Lewati jika tabel sudah ada di database
        if (Schema::hasTable('permohonan_edukasi')) {
            return;
        }

        Schema::create('permohonan_edukasi', function (Blueprint $table) {
            $table->id();

            // Data Institusi
            $table->string('institusi');
            $table->text('alamat_institusi');
            $table->string('kecamatan');
            $table->string('kelurahan');

            // Data Penanggung Jawab
            $table->string('nama_pemohon');
            $table->string('jabatan_pemohon');
            $table->char('nik', 16);
            $table->string('no_kontak');

            // Rincian Kegiatan & Peserta
            $table->date('tgl_kegiatan');
            $table->integer('usia_3_6')->default(0);
            $table->integer('usia_7_12')->default(0);
            $table->integer('usia_13_18')->default(0);
            $table->integer('usia_18_keatas')->default(0);

            // Berkas Lampiran
            $table->string('surat_permohonan'); // Nama file surat
            $table->json('syarat_lainnya')->nullable(); // JSON untuk multiple files (opsional)

            // Status Sistem
            $table->string('status_permohonan')->default('Pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permohonan_edukasi');
    }
};
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
        Schema::create('permohonan_edukasi', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('institusi', 150);
            $table->text('alamat_institusi');
            $table->string('kecamatan', 100);
            $table->string('kelurahan', 100);
            $table->string('nama_pemohon', 150);
            $table->string('jabatan_pemohon', 100);
            $table->string('nik', 30);
            $table->string('no_kontak', 25);
            $table->date('tgl_kegiatan');
            $table->integer('usia_3_6')->nullable()->default(0);
            $table->integer('usia_7_12')->nullable()->default(0);
            $table->integer('usia_13_18')->nullable()->default(0);
            $table->integer('usia_18_keatas')->nullable()->default(0);
            $table->string('surat_permohonan');
            $table->string('syarat_lainnya')->nullable();
            $table->enum('status_permohonan', ['Pending', 'Disetujui', 'Ditolak'])->nullable()->default('Pending');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_edukasi');
    }
};

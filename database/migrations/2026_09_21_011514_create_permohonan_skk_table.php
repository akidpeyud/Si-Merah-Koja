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
        Schema::create('permohonan_skk', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nama_pemohon', 150);
            $table->string('email_pemohon', 100);
            $table->string('no_whatsapp', 25);
            $table->string('nama_usaha', 150);
            $table->string('nik_pemilik_usaha', 30);
            $table->text('alamat_pemilik_usaha');
            $table->string('kategori_bangunan', 100);
            $table->text('alamat_bangunan');
            $table->string('kecamatan', 100);
            $table->string('kelurahan', 100);
            $table->decimal('luas_lahan', 10);
            $table->decimal('luas_bangunan', 10);
            $table->decimal('tinggi_bangunan');
            $table->string('file_surat_permohonan');
            $table->string('file_persyaratan_lainnya')->nullable();
            $table->enum('status_permohonan', ['Pending', 'Diproses', 'Memenuhi Syarat', 'Tidak Memenuhi Syarat'])->nullable()->default('Pending');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_skk');
    }
};

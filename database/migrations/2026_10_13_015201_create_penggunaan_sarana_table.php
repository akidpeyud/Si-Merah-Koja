<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penggunaan_sarana', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemohon_id')->nullable()->index();

            $table->string('nama');
            $table->string('nik', 16);
            $table->string('no_hp', 20);
            $table->string('alamat');

            $table->string('jenis_pemohon', 20);
            $table->string('nama_penanggung_jawab');
            $table->string('nama_instansi');
            $table->string('alamat_instansi');

            $table->string('sarana');
            $table->text('kegunaan');

            $table->string('nama_kegiatan');
            $table->string('lokasi_kegiatan');
            $table->date('tgl_pelaksanaan');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('foto_lokasi');

            $table->string('surat_permohonan');

            $table->string('status', 30)->default('Menunggu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penggunaan_sarana');
    }
};
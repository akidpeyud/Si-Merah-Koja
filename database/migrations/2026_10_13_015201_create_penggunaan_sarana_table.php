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

            // Dari session('pemohon_id'); kosong jika pemohon tidak login
            $table->unsignedBigInteger('pemohon_id')->nullable()->index();

            // 1. Data pemohon
            $table->string('nama');
            $table->string('nik', 16)->index();      // dipakai pencarian Cek Status
            $table->string('no_hp', 20)->index();    // dipakai pencarian Cek Status
            $table->string('alamat');

            // 2. Data instansi / fasilitas umum / perorangan
            $table->string('jenis_pemohon', 20);     // perorangan | fasum | instansi
            $table->string('nama_penanggung_jawab');
            $table->string('nama_instansi');
            $table->string('alamat_instansi');

            // 3. Sarana yang diajukan
            $table->string('sarana');
            $table->text('kegunaan');

            // 4. Data lokasi kegiatan
            $table->string('nama_kegiatan');
            $table->string('lokasi_kegiatan');
            $table->date('tgl_pelaksanaan');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');

            // 5. Berkas persyaratan administrasi (path file di storage/public)
            $table->string('surat_permohonan');      // pdf/jpg/png/zip/rar
            $table->string('fotokopi_ktp');          // pdf/jpg/png
            $table->string('sket_denah_lokasi');     // pdf/jpg/png

            // Status permohonan
            $table->string('status', 30)->default('Menunggu')->index();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penggunaan_sarana');
    }
};
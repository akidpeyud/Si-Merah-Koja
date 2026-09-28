<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inspeksi_bangunans', function (Blueprint $table) {
            // Nambahin 5 kolom dokumen dan dibikin nullable (boleh kosong)
            $table->string('surat_perintah_tugas')->nullable();
            $table->string('berita_acara')->nullable();
            $table->string('hasil_penilaian')->nullable();
            $table->string('rekomendasi')->nullable();
            $table->string('skk')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('inspeksi_bangunans', function (Blueprint $table) {
            // Kalau di-rollback, kolomnya dihapus
            $table->dropColumn([
                'surat_perintah_tugas', 
                'berita_acara', 
                'hasil_penilaian', 
                'rekomendasi', 
                'skk'
            ]);
        });
    }
};
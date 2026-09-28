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
        Schema::table('inspeksi_bangunans', function (Blueprint $table) {
            // Nambahin 5 kolom untuk nyimpen nama file foto/dokumen (Boleh kosong/nullable)
            $table->string('surat_perintah_tugas')->nullable()->after('jenis_usaha');
            $table->string('berita_acara')->nullable()->after('surat_perintah_tugas');
            $table->string('hasil_penilaian')->nullable()->after('berita_acara');
            $table->string('rekomendasi')->nullable()->after('hasil_penilaian');
            $table->string('skk')->nullable()->after('rekomendasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inspeksi_bangunans', function (Blueprint $table) {
            // Hapus kolom kalau migration di-rollback
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
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
    Schema::table('izin_keramaian', function (Blueprint $table) {
        $table->enum('jenis_event', ['hiburan', 'non_hiburan'])
              ->default('non_hiburan')->after('nama_acara');
        $table->string('surat_permohonan')->nullable()->after('jumlah_staff');
        $table->string('fotokopi_ktp')->nullable()->after('surat_permohonan');
        $table->string('bukti_pajak_bpprd')->nullable()->after('foto_jalur_evakuasi');
    });
}

public function down(): void
{
    Schema::table('izin_keramaian', function (Blueprint $table) {
        $table->dropColumn(['jenis_event', 'surat_permohonan', 'fotokopi_ktp', 'bukti_pajak_bpprd']);
    });
}
};

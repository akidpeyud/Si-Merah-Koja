<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $kolomBerkas = [
        'surat_permohonan',
        'fotokopi_ktp',
        'sket_denah_lokasi',
    ];

    public function up(): void
    {
        Schema::table('penggunaan_sarana', function (Blueprint $table) {
            foreach ($this->kolomBerkas as $kolom) {
                if (!Schema::hasColumn('penggunaan_sarana', $kolom)) {
                    $table->string($kolom)->nullable();
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('penggunaan_sarana', function (Blueprint $table) {
            foreach ($this->kolomBerkas as $kolom) {
                if (Schema::hasColumn('penggunaan_sarana', $kolom)) {
                    $table->dropColumn($kolom);
                }
            }
        });
    }
};
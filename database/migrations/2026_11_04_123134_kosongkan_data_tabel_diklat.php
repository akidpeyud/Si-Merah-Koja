<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel Peningkatan Kapasitas Aparatur yang dikosongkan.
     *
     * @var array<int, string>
     */
    private array $tabelDiklat = [
        'tbl_diksar',
        'tbl_diklat_f1',
        'tbl_diklat_f2',
        'tbl_diklat_rescue',
        'tbl_diklat_mfr',
        'tbl_diklat_operator',
        'tbl_diklat_inspektur',
        'tbl_diklat_ppl',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach ($this->tabelDiklat as $namaTabel) {
            if (Schema::hasTable($namaTabel)) {
                DB::table($namaTabel)->truncate();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Data lama sengaja dikosongkan dan akan diganti dengan data baru.
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('surat_korbans')
            ->whereNull('tanggal_surat')
            ->update(['tanggal_surat' => DB::raw('created_at')]);

        Schema::table('surat_korbans', function (Blueprint $table) {
            $table->index('tanggal_surat');
        });
    }

    public function down(): void
    {
        Schema::table('surat_korbans', function (Blueprint $table) {
            $table->dropIndex(['tanggal_surat']);
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\PermohonanPerpanjangSkk;

/**
 * Memperbaiki tabel perpanjangan SKK:
 *  1. Kolom `id` dijadikan AUTO_INCREMENT + PRIMARY KEY (jika belum).
 *  2. Menambah kolom data SKK lama (jika belum ada).
 *
 * Aman dijalankan berulang: setiap langkah dicek dulu.
 */
return new class extends Migration
{
    private function tabel(): string
    {
        // Nama tabel diambil dari model, jadi tidak perlu ditebak.
        return (new PermohonanPerpanjangSkk)->getTable();
    }

    public function up(): void
    {
        $tabel = $this->tabel();

        $this->perbaikiKolomId($tabel);
        $this->tambahKolomSkkLama($tabel);
    }

    private function perbaikiKolomId(string $tabel): void
    {
        $kolom = collect(DB::select("SHOW COLUMNS FROM `{$tabel}` WHERE Field = 'id'"))->first();

        if (!$kolom) {
            // Tabel belum punya kolom id sama sekali.
            Schema::table($tabel, function (Blueprint $table) {
                $table->id()->first();
            });
            return;
        }

        if (stripos($kolom->Extra ?? '', 'auto_increment') !== false) {
            return; // sudah benar
        }

        $sudahPrimary = !empty(DB::select("SHOW KEYS FROM `{$tabel}` WHERE Key_name = 'PRIMARY'"));

        // Pakai tipe asli kolom (int / bigint unsigned, dst.) supaya tidak berubah.
        $tipe = $kolom->Type;

        $sql = "ALTER TABLE `{$tabel}` MODIFY `id` {$tipe} NOT NULL AUTO_INCREMENT";
        if (!$sudahPrimary) {
            $sql .= ', ADD PRIMARY KEY (`id`)';
        }

        DB::statement($sql);
    }

    private function tambahKolomSkkLama(string $tabel): void
    {
        Schema::table($tabel, function (Blueprint $table) use ($tabel) {
            if (!Schema::hasColumn($tabel, 'nomor_skk_lama')) {
                $table->string('nomor_skk_lama', 100)->nullable();
            }
            if (!Schema::hasColumn($tabel, 'tanggal_terbit_skk_lama')) {
                $table->date('tanggal_terbit_skk_lama')->nullable();
            }
            if (!Schema::hasColumn($tabel, 'masa_berlaku_skk_lama')) {
                $table->date('masa_berlaku_skk_lama')->nullable();
            }
            if (!Schema::hasColumn($tabel, 'file_skk_lama')) {
                $table->string('file_skk_lama')->nullable();
            }
        });
    }

    public function down(): void
    {
        // Sengaja kosong: perbaikan struktur ini tidak untuk di-rollback.
    }
};
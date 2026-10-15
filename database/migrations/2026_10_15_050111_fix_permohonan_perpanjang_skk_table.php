<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\PermohonanPerpanjangSkk;

/**
 * Menyiapkan tabel perpanjangan SKK:
 *  0. Jika tabel belum ada, tabel dibuat lengkap.
 *  1. Kolom `id` dijadikan AUTO_INCREMENT + PRIMARY KEY (jika belum).
 *  2. Menambah kolom data SKK lama (jika belum ada).
 *
 * Aman dijalankan berulang: setiap langkah dicek dulu.
 */
return new class extends Migration
{
    private function tabel(): string
    {
        return (new PermohonanPerpanjangSkk)->getTable();
    }

    public function up(): void
    {
        $tabel = $this->tabel();

        if (!Schema::hasTable($tabel)) {
            $this->buatTabel($tabel);
            return; // tabel baru sudah lengkap (id auto increment + kolom SKK lama)
        }

        $this->perbaikiKolomId($tabel);
        $this->tambahKolomSkkLama($tabel);
    }

    private function buatTabel(string $tabel): void
    {
        Schema::create($tabel, function (Blueprint $table) {
            $table->id();
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
            $table->decimal('luas_lahan', 12, 2)->default(0);
            $table->decimal('luas_bangunan', 12, 2)->default(0);
            $table->decimal('tinggi_bangunan', 12, 2)->default(0);
            $table->string('status_permohonan', 50)->default('Pending');
            $table->string('file_surat_permohonan')->nullable();
            $table->text('file_persyaratan_lainnya')->nullable();

            // Data SKK sebelumnya (khusus perpanjangan)
            $table->string('nomor_skk_lama', 100)->nullable();
            $table->date('tanggal_terbit_skk_lama')->nullable();
            $table->date('masa_berlaku_skk_lama')->nullable();
            $table->string('file_skk_lama')->nullable();

            $table->timestamps();
        });
    }

    private function perbaikiKolomId(string $tabel): void
    {
        $kolom = collect(DB::select("SHOW COLUMNS FROM `{$tabel}` WHERE Field = 'id'"))->first();

        if (!$kolom) {
            Schema::table($tabel, function (Blueprint $table) {
                $table->id()->first();
            });
            return;
        }

        if (stripos($kolom->Extra ?? '', 'auto_increment') !== false) {
            return;
        }

        $sudahPrimary = !empty(DB::select("SHOW KEYS FROM `{$tabel}` WHERE Key_name = 'PRIMARY'"));

        $sql = "ALTER TABLE `{$tabel}` MODIFY `id` {$kolom->Type} NOT NULL AUTO_INCREMENT";
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
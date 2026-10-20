<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $tabel = 'pelatihan_keluarga';

    public function up(): void
    {
        // 1) Kalau tabel belum ada -> buat lengkap dari awal
        if (!Schema::hasTable($this->tabel)) {
            Schema::create($this->tabel, function (Blueprint $table) {
                $table->id();

                // Informasi pelaksanaan
                $table->date('tanggal_pelaksanaan');
                $table->string('kecamatan', 100);   // dari dropdown
                $table->string('kelurahan', 100);   // dari dropdown
                $table->string('rt');               // contoh: "03, 12, 14 dan 19"

                // Jumlah & Daftar Peserta
                $table->unsignedInteger('peserta_perempuan')->default(0);
                $table->text('nama_peserta_perempuan')->nullable();
                $table->unsignedInteger('peserta_laki_laki')->default(0);
                $table->text('nama_peserta_laki_laki')->nullable();

                // Dokumentasi (link Google Drive, satu link per baris)
                $table->text('link_dokumentasi')->nullable();

                $table->timestamps();

                $table->index('tanggal_pelaksanaan');
                $table->index(['kecamatan', 'kelurahan']);
            });
            return;
        }

        // 2) Kalau tabel sudah ada -> pastikan kolom nama peserta ditambahkan
        Schema::table($this->tabel, function (Blueprint $table) {
            if (!Schema::hasColumn($this->tabel, 'nama_peserta_perempuan')) {
                $table->text('nama_peserta_perempuan')->nullable()->after('peserta_perempuan');
            }

            if (!Schema::hasColumn($this->tabel, 'nama_peserta_laki_laki')) {
                $table->text('nama_peserta_laki_laki')->nullable()->after('peserta_laki_laki');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->tabel);
    }
};
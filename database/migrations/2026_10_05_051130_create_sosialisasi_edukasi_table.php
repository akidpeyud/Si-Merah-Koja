<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $tabel = 'sosialisasi_edukasi';

    public function up()
    {
        // 1) Tabel belum ada -> buat lengkap
        if (!Schema::hasTable($this->tabel)) {
            Schema::create($this->tabel, function (Blueprint $table) {
                $table->id();
                $table->date('tanggal_pelaksanaan');
                $table->string('rt');                                  // contoh: "03, 12, 14 dan 19"
                $table->string('posyandu_sekolah', 150)->nullable();   // Posyandu / Nama Sekolah
                $table->string('kelurahan', 100);
                $table->string('kecamatan', 100);
                $table->unsignedInteger('peserta_perempuan')->default(0);
                $table->text('nama_peserta_perempuan')->nullable();    // Daftar nama peserta perempuan
                $table->unsignedInteger('peserta_laki_laki')->default(0);
                $table->text('nama_peserta_laki_laki')->nullable();    // Daftar nama peserta laki-laki
                $table->string('foto_video')->nullable();
                $table->text('link_dokumentasi')->nullable();
                $table->text('keterangan')->nullable();
                $table->timestamps();

                $table->index('tanggal_pelaksanaan');
                $table->index(['kecamatan', 'kelurahan']);
            });
            return;
        }

        // 2) Tabel sudah ada, kolom lama "posyandu" -> rename (data tetap aman)
        if (Schema::hasColumn($this->tabel, 'posyandu')
            && !Schema::hasColumn($this->tabel, 'posyandu_sekolah')) {
            Schema::table($this->tabel, function (Blueprint $table) {
                $table->renameColumn('posyandu', 'posyandu_sekolah');
            });
        }

        // 3) Tabel sudah ada -> tambahkan kolom yang belum ada (data lama tetap aman)
        Schema::table($this->tabel, function (Blueprint $table) {
            if (!Schema::hasColumn($this->tabel, 'posyandu_sekolah')) {
                $table->string('posyandu_sekolah', 150)->nullable()->after('rt');
            }

            if (!Schema::hasColumn($this->tabel, 'nama_peserta_perempuan')) {
                $table->text('nama_peserta_perempuan')->nullable()->after('peserta_perempuan');
            }

            if (!Schema::hasColumn($this->tabel, 'nama_peserta_laki_laki')) {
                $table->text('nama_peserta_laki_laki')->nullable()->after('peserta_laki_laki');
            }

            if (!Schema::hasColumn($this->tabel, 'link_dokumentasi')) {
                $table->text('link_dokumentasi')->nullable()->after('foto_video');
            }
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->tabel);
    }
};
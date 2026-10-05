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
                $table->unsignedInteger('peserta_laki_laki')->default(0);
                $table->string('foto_video')->nullable();
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
            return;
        }

        // 3) Tabel sudah ada, belum ada kolomnya -> tambah setelah rt
        if (!Schema::hasColumn($this->tabel, 'posyandu_sekolah')) {
            Schema::table($this->tabel, function (Blueprint $table) {
                $table->string('posyandu_sekolah', 150)->nullable()->after('rt');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists($this->tabel);
    }
};
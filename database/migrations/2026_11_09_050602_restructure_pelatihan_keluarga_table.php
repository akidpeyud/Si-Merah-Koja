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
        Schema::dropIfExists('pelatihan_keluarga');

        Schema::create('pelatihan_keluarga', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peserta');
            $table->string('jenis_kelamin', 20);
            $table->string('kelurahan', 100);
            $table->string('kecamatan', 100);
            $table->date('tanggal_pelaksanaan');
            $table->string('tempat_pelaksanaan');
            $table->string('alamat_pelaksanaan', 500);
            $table->timestamps();

            $table->index('tanggal_pelaksanaan');
            $table->index(['kecamatan', 'kelurahan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatihan_keluarga');

        Schema::create('pelatihan_keluarga', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pelaksanaan');
            $table->string('kecamatan', 100);
            $table->string('kelurahan', 100);
            $table->string('rt');
            $table->unsignedInteger('peserta_perempuan')->default(0);
            $table->text('nama_peserta_perempuan')->nullable();
            $table->unsignedInteger('peserta_laki_laki')->default(0);
            $table->text('nama_peserta_laki_laki')->nullable();
            $table->text('link_dokumentasi')->nullable();
            $table->timestamps();

            $table->index('tanggal_pelaksanaan');
            $table->index(['kecamatan', 'kelurahan']);
        });
    }
};

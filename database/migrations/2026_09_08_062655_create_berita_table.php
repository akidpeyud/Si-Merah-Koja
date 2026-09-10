<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
{
    Schema::create('berita', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->string('lokasi');
        $table->date('tanggal_kejadian');
        $table->time('waktu_kejadian');
        $table->string('pelapor');
        $table->string('sumber_informasi');
        $table->text('keterangan_singkat');
        $table->longText('detail_lengkap');
        $table->string('gambar')->nullable();
        $table->timestamps();
    });
}
};

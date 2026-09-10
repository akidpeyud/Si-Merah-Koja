<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('berita', function (Blueprint $table) {
        $table->id();
        $table->string('judul'); // Cth: Evakuasi Pemotongan Cincin
        $table->string('lokasi'); // Cth: Jl. AR. SALEH...
        $table->date('tanggal_kejadian'); // Cth: 2023-08-09
        $table->time('waktu_kejadian'); // Cth: 09:00:00
        $table->string('pelapor'); // Cth: Warga RT. 07
        $table->string('sumber_informasi'); // Cth: Lainnya (Ke Kantor Mako)
        $table->text('keterangan_singkat'); // Muncul di halaman list depan
        $table->longText('detail_lengkap'); // Muncul saat diklik "Selengkapnya"
        $table->string('gambar')->nullable(); // Foto kejadian
        $table->timestamps();
    });
}
};

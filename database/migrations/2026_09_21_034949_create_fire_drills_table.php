<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fire_drills', function (Blueprint $table) {
            $table->id();
            $table->string('nama_instansi');
            $table->year('tahun');
            $table->string('tanggal_pelaksanaan'); 
            $table->string('tempat_pelaksanaan');
            $table->integer('peserta_laki_laki')->nullable()->default(0);
            $table->integer('peserta_perempuan')->nullable()->default(0);
            $table->text('nama_peserta_laki_laki')->nullable(); // Daftar nama Laki-laki (per baris)
            $table->text('nama_peserta_perempuan')->nullable(); // Daftar nama Perempuan (per baris)
            $table->integer('total_peserta')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fire_drills');
    }
};
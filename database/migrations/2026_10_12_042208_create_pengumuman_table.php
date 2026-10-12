<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumumans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori', 50)->default('Umum');
            $table->longText('isi');
            $table->string('lampiran')->nullable();          // path file di storage/app/public
            $table->boolean('penting')->default(false);      // tampil paling atas + label "Penting"
            $table->boolean('dipublikasikan')->default(true);
            $table->date('tanggal');
            $table->timestamps();

            $table->index(['dipublikasikan', 'penting', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumumans');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemohons', function (Blueprint $table) {
            $table->id();
            $table->char('nik', 16)->unique();
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('no_whatsapp');
            $table->string('password');
            $table->string('role')->default('pemohon'); // Penanda khusus masyarakat umum
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemohons');
    }
};

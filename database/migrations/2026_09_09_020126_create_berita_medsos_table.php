<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
<<<<<<< HEAD
    /**
     * Run the migrations.
     */
=======
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
    public function up(): void
    {
        Schema::create('berita_medsos', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
=======
            // Menambahkan foreign key kategori_id
            $table->unsignedBigInteger('kategori_id')->nullable(); 

            $table->string('judul');
            $table->dateTime('tanggal');
            $table->string('sumber');
            $table->string('link')->nullable();
            $table->string('gambar');
            $table->timestamps();

            // Relasi ke tabel kategori_berita
            $table->foreign('kategori_id')->references('id')->on('kategori_berita')->onDelete('set null');
        });
    }

>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
    public function down(): void
    {
        Schema::dropIfExists('berita_medsos');
    }
<<<<<<< HEAD
};
=======
};
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573

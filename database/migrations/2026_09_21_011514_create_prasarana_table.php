<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prasarana', function (Blueprint $table) {
            // 1. id_prasarana (Primary Key, Auto Increment)
            $table->integer('id_prasarana', true); 
            
            // 2. id_pos (Index / Foreign Key)
            $table->integer('id_pos')->nullable()->index('id_pos'); 
            
            // 3. jenis_prasarana (Varchar)
            $table->string('jenis_prasarana')->nullable(); 
            
            // 4. luas_bangunan (Varchar)
            $table->string('luas_bangunan')->nullable(); 
            
            // 5. path_gambar (Varchar)
            $table->string('path_gambar')->nullable(); 
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prasarana');
    }
};
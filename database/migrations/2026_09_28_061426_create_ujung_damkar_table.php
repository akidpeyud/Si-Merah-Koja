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
    Schema::create('ujung_damkar', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->string('youtube_id');
        $table->string('link_asli');
        $table->timestamps();
    });
}
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ujung_damkar');
    }
};

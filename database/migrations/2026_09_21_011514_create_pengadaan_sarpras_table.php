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
        Schema::create('pengadaan_sarpras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kebutuhan_id')->index('kebutuhan_id');
            $table->integer('tahun');
            $table->integer('jumlah')->default(0);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengadaan_sarpras');
    }
};

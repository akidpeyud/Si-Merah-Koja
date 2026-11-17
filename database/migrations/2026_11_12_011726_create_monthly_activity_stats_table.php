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
        Schema::create('monthly_activity_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('year');
            $table->unsignedTinyInteger('month');
            $table->string('category', 20);
            $table->string('module', 100);
            $table->string('action', 50);
            $table->unsignedBigInteger('total')->default(0);
            $table->timestamps();

            $table->unique(
                ['year', 'month', 'category', 'module', 'action'],
                'monthly_activity_stats_unique'
            );
            $table->index(['category', 'year', 'month'], 'monthly_activity_stats_lookup');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_activity_stats');
    }
};

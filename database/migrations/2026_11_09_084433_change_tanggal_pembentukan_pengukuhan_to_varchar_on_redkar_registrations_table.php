<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE redkar_registrations MODIFY tanggal_pembentukan VARCHAR(50) NULL');
        DB::statement('ALTER TABLE redkar_registrations MODIFY tanggal_pengukuhan VARCHAR(50) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE redkar_registrations MODIFY tanggal_pembentukan DATE NULL');
        DB::statement('ALTER TABLE redkar_registrations MODIFY tanggal_pengukuhan DATE NULL');
    }
};

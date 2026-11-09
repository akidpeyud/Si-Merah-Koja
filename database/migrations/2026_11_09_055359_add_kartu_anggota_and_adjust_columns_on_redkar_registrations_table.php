<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tambah kolom kartu_anggota jika belum ada
        Schema::table('redkar_registrations', function (Blueprint $table) {
            if (! Schema::hasColumn('redkar_registrations', 'kartu_anggota')) {
                $table->string('kartu_anggota', 50)->nullable()->after('golongan_darah');
            }
        });

        // 2. Drop unique index NIK jika ada agar data dengan NIK kosong/duplikat dari lapangan tidak error
        $indexes = DB::select("SHOW INDEX FROM redkar_registrations WHERE Key_name = 'redkar_registrations_nik_unique'");
        if (! empty($indexes)) {
            DB::statement('ALTER TABLE redkar_registrations DROP INDEX redkar_registrations_nik_unique');
        }

        // 3. Modifikasi kolom agar nullable dan menampung variasi data dari Excel
        DB::statement('ALTER TABLE redkar_registrations MODIFY nik VARCHAR(30) NULL');
        DB::statement('ALTER TABLE redkar_registrations MODIFY tempat_lahir VARCHAR(100) NULL');
        DB::statement('ALTER TABLE redkar_registrations MODIFY tanggal_lahir DATE NULL');
        DB::statement('ALTER TABLE redkar_registrations MODIFY status_perkawinan VARCHAR(255) NULL');
        DB::statement('ALTER TABLE redkar_registrations MODIFY agama VARCHAR(255) NULL');
        DB::statement('ALTER TABLE redkar_registrations MODIFY nomor_telp VARCHAR(30) NULL');
        DB::statement('ALTER TABLE redkar_registrations MODIFY alamat TEXT NULL');
        DB::statement('ALTER TABLE redkar_registrations MODIFY rt_rw VARCHAR(50) NULL');
        DB::statement('ALTER TABLE redkar_registrations MODIFY kecamatan VARCHAR(50) NULL');
        DB::statement('ALTER TABLE redkar_registrations MODIFY kelurahan VARCHAR(50) NULL');
        DB::statement('ALTER TABLE redkar_registrations MODIFY pendidikan_terakhir VARCHAR(255) NULL');
        DB::statement('ALTER TABLE redkar_registrations MODIFY latar_belakang_pendidikan VARCHAR(255) NULL');
        DB::statement('ALTER TABLE redkar_registrations MODIFY pekerjaan VARCHAR(255) NULL');
        DB::statement('ALTER TABLE redkar_registrations MODIFY sehat_jasmani VARCHAR(255) NULL');
        DB::statement('ALTER TABLE redkar_registrations MODIFY buta_warna VARCHAR(255) NULL');
        DB::statement('ALTER TABLE redkar_registrations MODIFY golongan_darah VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('redkar_registrations', function (Blueprint $table) {
            if (Schema::hasColumn('redkar_registrations', 'kartu_anggota')) {
                $table->dropColumn('kartu_anggota');
            }
        });
    }
};

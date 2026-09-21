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
        // Daftar semua tabel yang ingin dibuat dengan struktur yang sama
        $tables = [
            'tbl_diksar',
            'tbl_diklat_f1',
            'tbl_diklat_f2',
            'tbl_diklat_rescue',
            'tbl_diklat_mfr',
            'tbl_diklat_operator',
            'tbl_diklat_inspektur',
            'tbl_diklat_ppl',
        ];

        foreach ($tables as $tableName) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->id(); // Membuat kolom 'id' INT AUTO_INCREMENT PRIMARY KEY
                
                // Gunakan nullable() agar tidak error jika ada data kosong dari Excel
                $table->string('no_urut', 50)->nullable();
                $table->string('nama', 255)->nullable();
                $table->string('tempat_lahir', 255)->nullable();
                $table->string('tgl_lahir', 100)->nullable();
                $table->string('nik', 100)->nullable();
                $table->string('jabatan', 255)->nullable();
                $table->string('instansi', 255)->nullable();
                $table->string('ditandatangani_oleh', 255)->nullable();
                $table->string('tanggal_pelaksanaan', 255)->nullable();
                $table->string('jumlah_jam_pelajaran', 100)->nullable();
                $table->string('instansi_penyelenggara', 255)->nullable();
                $table->string('provinsi', 100)->nullable();
                $table->string('kota', 100)->nullable();
                $table->string('nomor_sertifikat', 255)->nullable();
                $table->string('kode_verifikasi', 255)->nullable();
                $table->string('persentasi_penilaian', 100)->nullable();
                $table->string('jenis_diklat', 255)->nullable();
                
                // Karena di SQL kamu menggunakan VARCHAR(100) untuk tanggal, kita pakai string()
                // Jika ingin memakai format bawaan Laravel (TIMESTAMP), ganti 2 baris di bawah dengan: $table->timestamps();
                $table->string('created_at', 100)->nullable();
                $table->string('updated_at', 100)->nullable();
                
                $table->string('ttl', 100)->nullable();
                $table->text('ket')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'tbl_diksar',
            'tbl_diklat_f1',
            'tbl_diklat_f2',
            'tbl_diklat_rescue',
            'tbl_diklat_mfr',
            'tbl_diklat_operator',
            'tbl_diklat_inspektur',
            'tbl_diklat_ppl',
        ];

        // Hapus semua tabel jika menjalankan php artisan migrate:rollback
        foreach ($tables as $tableName) {
            Schema::dropIfExists($tableName);
        }
    }
};
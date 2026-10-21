<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Untuk database yang SUDAH berjalan dengan kolom enum lama
 * ('kebakaran','sumber_air','hydrant','penyelamatan','pos').
 * Enum itu menolak nilai baru (hydrant_pilar, water_truck, zona_rawan),
 * jadi kolom diubah menjadi VARCHAR. Data yang sudah ada tidak berubah.
 *
 * Catatan: memakai perintah MySQL / MariaDB.
 * Database baru (yang dibuat dari migration create_titik_sigaps_table versi terbaru)
 * sudah memakai string, perintah ini aman dijalankan dan tidak mengubah apa pun.
 */
return new class extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE titik_sigaps MODIFY kategori VARCHAR(50) NOT NULL');
    }

    public function down()
    {
        // Sengaja dikosongkan: mengembalikan ke enum lama akan gagal
        // bila sudah ada data berkategori baru.
    }
};
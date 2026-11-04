<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel Peningkatan Kapasitas Aparatur yang memakai struktur yang sama.
     *
     * @var array<int, string>
     */
    private array $tabelDiklat = [
        'tbl_diksar',
        'tbl_diklat_f1',
        'tbl_diklat_f2',
        'tbl_diklat_rescue',
        'tbl_diklat_mfr',
        'tbl_diklat_operator',
        'tbl_diklat_inspektur',
        'tbl_diklat_ppl',
    ];

    /**
     * Kolom lama yang tidak dipakai lagi pada format baru.
     *
     * @var array<int, string>
     */
    private array $kolomLama = [
        'no_urut',
        'nik',
        'instansi',
        'instansi_penyelenggara',
        'provinsi',
        'kota',
        'nomor_sertifikat',
        'kode_verifikasi',
        'persentasi_penilaian',
        'jenis_diklat',
        'ttl',
        'ket',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach ($this->tabelDiklat as $namaTabel) {
            if (! Schema::hasTable($namaTabel)) {
                continue;
            }

            Schema::table($namaTabel, function (Blueprint $table) use ($namaTabel) {
                if (! Schema::hasColumn($namaTabel, 'nip')) {
                    $table->string('nip', 100)->nullable();
                }
                $table->string('pangkat_golongan', 255)->nullable();
                $table->string('kualifikasi', 255)->nullable();
                $table->string('tempat_pelaksanaan', 255)->nullable();
                $table->date('tanggal_selesai_pelaksanaan')->nullable();
                $table->string('no_sttp', 255)->nullable();
                $table->date('tanggal_sttp')->nullable();
                $table->string('file_sertifikat', 255)->nullable();
            });

            // Pindahkan nilai kolom lama yang padanannya ada di format baru
            DB::table($namaTabel)->update([
                'tempat_pelaksanaan' => DB::raw('kota'),
                'no_sttp' => DB::raw('nomor_sertifikat'),
            ]);

            Schema::table($namaTabel, function (Blueprint $table) {
                $table->dropColumn($this->kolomLama);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->tabelDiklat as $namaTabel) {
            if (! Schema::hasTable($namaTabel)) {
                continue;
            }

            Schema::table($namaTabel, function (Blueprint $table) {
                $table->string('no_urut', 50)->nullable();
                $table->string('nik', 100)->nullable();
                $table->string('instansi', 255)->nullable();
                $table->string('instansi_penyelenggara', 255)->nullable();
                $table->string('provinsi', 100)->nullable();
                $table->string('kota', 100)->nullable();
                $table->string('nomor_sertifikat', 255)->nullable();
                $table->string('kode_verifikasi', 255)->nullable();
                $table->string('persentasi_penilaian', 100)->nullable();
                $table->string('jenis_diklat', 255)->nullable();
                $table->string('ttl', 100)->nullable();
                $table->text('ket')->nullable();
            });

            Schema::table($namaTabel, function (Blueprint $table) {
                $table->dropColumn([
                    'nip',
                    'pangkat_golongan',
                    'kualifikasi',
                    'tempat_pelaksanaan',
                    'tanggal_selesai_pelaksanaan',
                    'no_sttp',
                    'tanggal_sttp',
                    'file_sertifikat',
                ]);
            });
        }
    }
};

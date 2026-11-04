<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kolom dokumen lama yang tidak dipakai lagi pada format baru.
     *
     * @var array<int, string>
     */
    private array $kolomDokumenLama = [
        'berita_acara',
        'hasil_penilaian',
        'skk',
    ];

    /**
     * Kolom baru pada format 13 kolom Inspeksi Bangunan.
     *
     * @var array<int, string>
     */
    private array $kolomBaru = [
        'kualifikasi_bangunan',
        'resiko_kebakaran',
        'luas_bangunan',
        'alamat',
        'nama_penanggung_jawab',
        'no_telepon',
        'sistem_proteksi_kebakaran',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('inspeksi_bangunans')) {
            return;
        }

        DB::table('inspeksi_bangunans')->truncate();

        Schema::table('inspeksi_bangunans', function (Blueprint $table) {
            if (! Schema::hasColumn('inspeksi_bangunans', 'kualifikasi_bangunan')) {
                $table->string('kualifikasi_bangunan', 100)->nullable()->after('jenis_usaha');
            }
            if (! Schema::hasColumn('inspeksi_bangunans', 'resiko_kebakaran')) {
                $table->string('resiko_kebakaran', 100)->nullable()->after('kualifikasi_bangunan');
            }
            if (! Schema::hasColumn('inspeksi_bangunans', 'luas_bangunan')) {
                $table->string('luas_bangunan', 100)->nullable()->after('resiko_kebakaran');
            }
            if (! Schema::hasColumn('inspeksi_bangunans', 'alamat')) {
                $table->text('alamat')->nullable()->after('luas_bangunan');
            }
            if (! Schema::hasColumn('inspeksi_bangunans', 'nama_penanggung_jawab')) {
                $table->string('nama_penanggung_jawab', 255)->nullable()->after('alamat');
            }
            if (! Schema::hasColumn('inspeksi_bangunans', 'no_telepon')) {
                $table->string('no_telepon', 50)->nullable()->after('nama_penanggung_jawab');
            }
            if (! Schema::hasColumn('inspeksi_bangunans', 'sistem_proteksi_kebakaran')) {
                $table->string('sistem_proteksi_kebakaran', 100)->nullable()->after('no_telepon');
            }
        });

        $kolomDihapus = array_values(array_filter(
            $this->kolomDokumenLama,
            fn (string $kolom): bool => Schema::hasColumn('inspeksi_bangunans', $kolom)
        ));

        if ($kolomDihapus !== []) {
            Schema::table('inspeksi_bangunans', function (Blueprint $table) use ($kolomDihapus) {
                $table->dropColumn($kolomDihapus);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('inspeksi_bangunans')) {
            return;
        }

        Schema::table('inspeksi_bangunans', function (Blueprint $table) {
            if (! Schema::hasColumn('inspeksi_bangunans', 'berita_acara')) {
                $table->string('berita_acara')->nullable()->after('surat_perintah_tugas');
            }
            if (! Schema::hasColumn('inspeksi_bangunans', 'hasil_penilaian')) {
                $table->string('hasil_penilaian')->nullable()->after('berita_acara');
            }
            if (! Schema::hasColumn('inspeksi_bangunans', 'skk')) {
                $table->string('skk')->nullable()->after('rekomendasi');
            }
        });

        $kolomDihapus = array_values(array_filter(
            $this->kolomBaru,
            fn (string $kolom): bool => Schema::hasColumn('inspeksi_bangunans', $kolom)
        ));

        if ($kolomDihapus !== []) {
            Schema::table('inspeksi_bangunans', function (Blueprint $table) use ($kolomDihapus) {
                $table->dropColumn($kolomDihapus);
            });
        }
    }
};

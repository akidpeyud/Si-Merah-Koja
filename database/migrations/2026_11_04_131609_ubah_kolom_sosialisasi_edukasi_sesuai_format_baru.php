<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kolom lama yang tidak dipakai lagi pada format baru.
     *
     * @var array<int, string>
     */
    private array $kolomLama = [
        'kecamatan',
        'kelurahan',
        'rt',
        'posyandu_sekolah',
        'peserta_perempuan',
        'nama_peserta_perempuan',
        'peserta_laki_laki',
        'nama_peserta_laki_laki',
        'guru',
        'orang_tua',
        'foto_video',
        'link_dokumentasi',
        'keterangan',
    ];

    /**
     * Kolom baru untuk Sosialisasi & Penyuluhan (9 kolom) dan Kunjungan & Edukasi (10 kolom).
     *
     * @var array<int, string>
     */
    private array $kolomBaru = [
        'jenis_kegiatan',
        'no_tanggal_surat_permohonan',
        'nama_instansi',
        'tempat_pelaksanaan',
        'alamat',
        'jumlah_peserta',
        'nama_penanggung_jawab',
        'no_telepon',
        'surat_perintah_tugas',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('sosialisasi_edukasi')) {
            return;
        }

        DB::table('sosialisasi_edukasi')->truncate();

        Schema::table('sosialisasi_edukasi', function (Blueprint $table) {
            if (! Schema::hasColumn('sosialisasi_edukasi', 'jenis_kegiatan')) {
                $table->string('jenis_kegiatan', 20)->default('Luar')->after('id')->index();
            }
            if (! Schema::hasColumn('sosialisasi_edukasi', 'no_tanggal_surat_permohonan')) {
                $table->string('no_tanggal_surat_permohonan', 255)->nullable()->after('jenis_kegiatan');
            }
            if (! Schema::hasColumn('sosialisasi_edukasi', 'nama_instansi')) {
                $table->string('nama_instansi', 255)->nullable()->after('no_tanggal_surat_permohonan');
            }
            if (! Schema::hasColumn('sosialisasi_edukasi', 'tempat_pelaksanaan')) {
                $table->string('tempat_pelaksanaan', 255)->nullable()->after('nama_instansi');
            }
            if (! Schema::hasColumn('sosialisasi_edukasi', 'alamat')) {
                $table->text('alamat')->nullable()->after('tempat_pelaksanaan');
            }
            if (! Schema::hasColumn('sosialisasi_edukasi', 'jumlah_peserta')) {
                $table->unsignedInteger('jumlah_peserta')->default(0)->after('tanggal_pelaksanaan');
            }
            if (! Schema::hasColumn('sosialisasi_edukasi', 'nama_penanggung_jawab')) {
                $table->string('nama_penanggung_jawab', 255)->nullable()->after('jumlah_peserta');
            }
            if (! Schema::hasColumn('sosialisasi_edukasi', 'no_telepon')) {
                $table->string('no_telepon', 50)->nullable()->after('nama_penanggung_jawab');
            }
            if (! Schema::hasColumn('sosialisasi_edukasi', 'surat_perintah_tugas')) {
                $table->string('surat_perintah_tugas', 255)->nullable()->after('no_telepon');
            }
        });

        if (Schema::hasIndex('sosialisasi_edukasi', ['kecamatan', 'kelurahan'])) {
            Schema::table('sosialisasi_edukasi', function (Blueprint $table) {
                $table->dropIndex(['kecamatan', 'kelurahan']);
            });
        }

        $kolomDihapus = array_values(array_filter(
            $this->kolomLama,
            fn (string $kolom): bool => Schema::hasColumn('sosialisasi_edukasi', $kolom)
        ));

        if ($kolomDihapus !== []) {
            Schema::table('sosialisasi_edukasi', function (Blueprint $table) use ($kolomDihapus) {
                $table->dropColumn($kolomDihapus);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('sosialisasi_edukasi')) {
            return;
        }

        Schema::table('sosialisasi_edukasi', function (Blueprint $table) {
            if (! Schema::hasColumn('sosialisasi_edukasi', 'kecamatan')) {
                $table->string('kecamatan', 100)->default('-')->after('tanggal_pelaksanaan');
            }
            if (! Schema::hasColumn('sosialisasi_edukasi', 'kelurahan')) {
                $table->string('kelurahan', 100)->default('-')->after('kecamatan');
            }
            if (! Schema::hasColumn('sosialisasi_edukasi', 'rt')) {
                $table->string('rt')->default('-')->after('kelurahan');
            }
            if (! Schema::hasColumn('sosialisasi_edukasi', 'posyandu_sekolah')) {
                $table->string('posyandu_sekolah', 150)->nullable()->after('rt');
            }
            if (! Schema::hasColumn('sosialisasi_edukasi', 'peserta_perempuan')) {
                $table->unsignedInteger('peserta_perempuan')->default(0)->after('posyandu_sekolah');
            }
            if (! Schema::hasColumn('sosialisasi_edukasi', 'nama_peserta_perempuan')) {
                $table->text('nama_peserta_perempuan')->nullable()->after('peserta_perempuan');
            }
            if (! Schema::hasColumn('sosialisasi_edukasi', 'peserta_laki_laki')) {
                $table->unsignedInteger('peserta_laki_laki')->default(0)->after('nama_peserta_perempuan');
            }
            if (! Schema::hasColumn('sosialisasi_edukasi', 'nama_peserta_laki_laki')) {
                $table->text('nama_peserta_laki_laki')->nullable()->after('peserta_laki_laki');
            }
            if (! Schema::hasColumn('sosialisasi_edukasi', 'guru')) {
                $table->integer('guru')->default(0)->after('nama_peserta_laki_laki');
            }
            if (! Schema::hasColumn('sosialisasi_edukasi', 'orang_tua')) {
                $table->integer('orang_tua')->default(0)->after('guru');
            }
            if (! Schema::hasColumn('sosialisasi_edukasi', 'link_dokumentasi')) {
                $table->text('link_dokumentasi')->nullable()->after('orang_tua');
            }
        });

        if (Schema::hasIndex('sosialisasi_edukasi', ['jenis_kegiatan'])) {
            Schema::table('sosialisasi_edukasi', function (Blueprint $table) {
                $table->dropIndex(['jenis_kegiatan']);
            });
        }

        $kolomDihapus = array_values(array_filter(
            $this->kolomBaru,
            fn (string $kolom): bool => Schema::hasColumn('sosialisasi_edukasi', $kolom)
        ));

        if ($kolomDihapus !== []) {
            Schema::table('sosialisasi_edukasi', function (Blueprint $table) use ($kolomDihapus) {
                $table->dropColumn($kolomDihapus);
            });
        }
    }
};

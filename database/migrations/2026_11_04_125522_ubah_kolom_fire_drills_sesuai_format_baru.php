<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kolom lama rincian peserta yang tidak dipakai lagi pada format baru.
     *
     * @var array<int, string>
     */
    private array $kolomLama = [
        'peserta_laki_laki',
        'peserta_perempuan',
        'nama_peserta_laki_laki',
        'nama_peserta_perempuan',
    ];

    /**
     * Kolom baru pada format 8 kolom Fire Drill.
     *
     * @var array<int, string>
     */
    private array $kolomBaru = [
        'nama_penanggung_jawab',
        'no_telepon',
        'surat_perintah_tugas',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('fire_drills')) {
            return;
        }

        DB::table('fire_drills')->truncate();

        Schema::table('fire_drills', function (Blueprint $table) {
            if (! Schema::hasColumn('fire_drills', 'nama_penanggung_jawab')) {
                $table->string('nama_penanggung_jawab', 255)->nullable()->after('total_peserta');
            }
            if (! Schema::hasColumn('fire_drills', 'no_telepon')) {
                $table->string('no_telepon', 50)->nullable()->after('nama_penanggung_jawab');
            }
            if (! Schema::hasColumn('fire_drills', 'surat_perintah_tugas')) {
                $table->string('surat_perintah_tugas', 255)->nullable()->after('no_telepon');
            }
        });

        $kolomDihapus = array_values(array_filter(
            $this->kolomLama,
            fn (string $kolom): bool => Schema::hasColumn('fire_drills', $kolom)
        ));

        if ($kolomDihapus !== []) {
            Schema::table('fire_drills', function (Blueprint $table) use ($kolomDihapus) {
                $table->dropColumn($kolomDihapus);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('fire_drills')) {
            return;
        }

        Schema::table('fire_drills', function (Blueprint $table) {
            if (! Schema::hasColumn('fire_drills', 'peserta_laki_laki')) {
                $table->integer('peserta_laki_laki')->nullable()->default(0)->after('tempat_pelaksanaan');
            }
            if (! Schema::hasColumn('fire_drills', 'peserta_perempuan')) {
                $table->integer('peserta_perempuan')->nullable()->default(0)->after('peserta_laki_laki');
            }
            if (! Schema::hasColumn('fire_drills', 'nama_peserta_laki_laki')) {
                $table->text('nama_peserta_laki_laki')->nullable()->after('peserta_perempuan');
            }
            if (! Schema::hasColumn('fire_drills', 'nama_peserta_perempuan')) {
                $table->text('nama_peserta_perempuan')->nullable()->after('nama_peserta_laki_laki');
            }
        });

        $kolomDihapus = array_values(array_filter(
            $this->kolomBaru,
            fn (string $kolom): bool => Schema::hasColumn('fire_drills', $kolom)
        ));

        if ($kolomDihapus !== []) {
            Schema::table('fire_drills', function (Blueprint $table) use ($kolomDihapus) {
                $table->dropColumn($kolomDihapus);
            });
        }
    }
};

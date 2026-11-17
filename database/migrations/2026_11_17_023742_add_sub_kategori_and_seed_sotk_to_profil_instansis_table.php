<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('profil_instansis', function (Blueprint $table) {
            if (! Schema::hasColumn('profil_instansis', 'sub_kategori')) {
                $table->string('sub_kategori')->nullable()->after('kategori')->index();
            }
            if (! Schema::hasColumn('profil_instansis', 'urutan')) {
                $table->integer('urutan')->default(0)->after('file_dokumen');
            }
        });

        $now = Carbon::now();

        // 1. Update data eksisting SOTK utama (jika ada) agar terpetakan ke Container 1 (dinas)
        $existing = DB::table('profil_instansis')
            ->where('kategori', 'sotk')
            ->where(function ($q) {
                $q->whereNull('sub_kategori')
                    ->orWhere('sub_kategori', 'dinas');
            })
            ->first();

        if ($existing) {
            DB::table('profil_instansis')->where('id', $existing->id)->update([
                'sub_kategori' => 'dinas',
                'judul' => 'Struktur Organisasi Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi',
                'urutan' => 1,
                'updated_at' => $now,
            ]);
        } else {
            DB::table('profil_instansis')->insert([
                'kategori' => 'sotk',
                'sub_kategori' => 'dinas',
                'judul' => 'Struktur Organisasi Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.',
                'file_dokumen' => 'profil-instansi/sotk/Struktur_Organisasi_DAMKAR_Jambi_2026_tanpa_NIP.pdf',
                'urutan' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 2. Daftar struktur SOTK container 2 s/d 7
        $items = [
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'komando',
                'judul' => 'Struktur Organisasi Komando Kebakaran dan Penyelamatan Regu 1, Regu 2, Regu 3',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Komando Kebakaran dan Penyelamatan Regu 1, Regu 2, Regu 3.',
                'file_dokumen' => null,
                'urutan' => 2,
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'sekretariat',
                'judul' => 'Struktur Organisasi Sekretariat',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Sekretariat.',
                'file_dokumen' => null,
                'urutan' => 3,
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'bidang_pencegahan',
                'judul' => 'Struktur Organisasi Bidang Pencegahan',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Bidang Pencegahan.',
                'file_dokumen' => null,
                'urutan' => 4,
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'bidang_sapra',
                'judul' => 'Struktur Organisasi Bidang Sapra',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Bidang Sarana dan Prasarana (Sapra).',
                'file_dokumen' => null,
                'urutan' => 5,
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'bidang_damtan',
                'judul' => 'Struktur Organisasi Bidang Damtan',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Bidang Pemadaman dan Penyelamatan (Damtan).',
                'file_dokumen' => null,
                'urutan' => 6,
            ],
            // Sub-pos pelayanan di bawah Container 7
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'pos_pelayanan',
                'judul' => 'Struktur Organisasi Pos Pelayanan Alam Barajo',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Pos Pelayanan Alam Barajo.',
                'file_dokumen' => null,
                'urutan' => 7,
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'pos_pelayanan',
                'judul' => 'Struktur Organisasi Pos Pelayanan Paal Merah',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Pos Pelayanan Paal Merah.',
                'file_dokumen' => null,
                'urutan' => 8,
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'pos_pelayanan',
                'judul' => 'Struktur Organisasi Pos Pelayanan Jambi Kota Seberang',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Pos Pelayanan Jambi Kota Seberang.',
                'file_dokumen' => null,
                'urutan' => 9,
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'pos_pelayanan',
                'judul' => 'Struktur Organisasi Pos Pelayanan Jambi Timur',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Pos Pelayanan Jambi Timur.',
                'file_dokumen' => null,
                'urutan' => 10,
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'pos_pelayanan',
                'judul' => 'Struktur Organisasi Pos Pelayanan Kota Baru',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Pos Pelayanan Kota Baru.',
                'file_dokumen' => null,
                'urutan' => 11,
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'pos_pelayanan',
                'judul' => 'Struktur Organisasi Pos Pelayanan Pelayangan',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Pos Pelayanan Pelayangan.',
                'file_dokumen' => null,
                'urutan' => 12,
            ],
        ];

        foreach ($items as $item) {
            DB::table('profil_instansis')->updateOrInsert(
                [
                    'kategori' => $item['kategori'],
                    'judul' => $item['judul'],
                ],
                [
                    'sub_kategori' => $item['sub_kategori'],
                    'tahun' => $item['tahun'],
                    'keterangan' => $item['keterangan'],
                    'urutan' => $item['urutan'],
                    'updated_at' => $now,
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('profil_instansis')
            ->where('kategori', 'sotk')
            ->whereIn('sub_kategori', ['komando', 'sekretariat', 'bidang_pencegahan', 'bidang_sapra', 'bidang_damtan', 'pos_pelayanan'])
            ->delete();

        Schema::table('profil_instansis', function (Blueprint $table) {
            if (Schema::hasColumn('profil_instansis', 'sub_kategori')) {
                $table->dropColumn('sub_kategori');
            }
            if (Schema::hasColumn('profil_instansis', 'urutan')) {
                $table->dropColumn('urutan');
            }
        });
    }
};

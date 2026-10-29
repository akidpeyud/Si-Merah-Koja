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
        $visiMisiData = [
            'visi' => 'Mewujudkan Kota Perdagangan dan Jasa yang Bersih, Aman, Harmonis, Agamis, Inovatif dan Sejahtera',
            'misi' => [
                'Penguatan Kualitas Sumberdaya Manusia;',
                'Penguatan Kapasitas Ekonomi Perkotaan;',
                'Penguatan Tata Kelola Pemerintah Yang Baik;',
                'Penguatan Ketertiban dan Ketentraman Lingkungan serta Partisipasi Masyarakat dalam Pembangunan; dan',
                'Penguatan Pengelolaan Infrastruktur dan Lingkungan Hidup yang Merata, Berkualitas dan Berkelanjutan.',
            ],
        ];

        DB::table('profil_instansis')->updateOrInsert(
            ['kategori' => 'visi-misi'],
            [
                'judul' => 'Visi & Misi Kota Jambi',
                'tahun' => '2026',
                'keterangan' => json_encode($visiMisiData, JSON_UNESCAPED_UNICODE),
                'file_dokumen' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('profil_instansis')->where('kategori', 'visi-misi')->delete();
    }
};

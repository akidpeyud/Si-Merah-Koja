<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SotkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $targetDir = storage_path('app/public/profil-instansi/sotk');
        if (! File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        // Cari file sumber di folder seed-files/sotk
        $sourceDir = storage_path('app/public/seed-files/sotk');
        if (! File::exists($sourceDir)) {
            $sourceDir = public_path('storage/seed-files/sotk');
        }

        $sotkList = [
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'dinas',
                'judul' => 'Struktur Organisasi Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi Tahun 2026.',
                'urutan' => 1,
                'source_file' => 'Struktur_Organisasi_DAMKAR_Jambi_2026_tanpa_NIP.pdf',
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'komando',
                'judul' => 'Struktur Organisasi Komando Kebakaran dan Penyelamatan Regu 1, Regu 2, Regu 3',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Komando Kebakaran dan Penyelamatan Regu 1, Regu 2, Regu 3 Tahun 2026.',
                'urutan' => 2,
                'source_file' => 'Struktur_Organisasi_Komando_Kebakaran_dan_Penyelamatan_2026.pdf',
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'sekretariat',
                'judul' => 'Struktur Organisasi Sekretariat',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Sekretariat.',
                'urutan' => 3,
                'source_file' => null,
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'bidang_pencegahan',
                'judul' => 'Struktur Organisasi Bidang Pencegahan',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Bidang Pencegahan.',
                'urutan' => 4,
                'source_file' => null,
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'bidang_sapra',
                'judul' => 'Struktur Organisasi Bidang Sapra',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Bidang Sarana dan Prasarana (Sapra).',
                'urutan' => 5,
                'source_file' => null,
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'bidang_damtan',
                'judul' => 'Struktur Organisasi Bidang Damtan',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Bidang Pemadaman dan Penyelamatan (Damtan).',
                'urutan' => 6,
                'source_file' => null,
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'pos_pelayanan',
                'judul' => 'Struktur Organisasi Pos Pelayanan Alam Barajo',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Pos Pelayanan Alam Barajo.',
                'urutan' => 7,
                'source_file' => 'Struktur_Organisasi_Pos_Pelayanan_Alam_Barajo_2026.pdf',
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'pos_pelayanan',
                'judul' => 'Struktur Organisasi Pos Pelayanan Paal Merah',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Pos Pelayanan Paal Merah.',
                'urutan' => 8,
                'source_file' => null,
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'pos_pelayanan',
                'judul' => 'Struktur Organisasi Pos Pelayanan Jambi Kota Seberang',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Pos Pelayanan Jambi Kota Seberang.',
                'urutan' => 9,
                'source_file' => 'Struktur_Organisasi_Pos_Pelayanan_Jambi_Kota_Seberang_2026.pdf',
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'pos_pelayanan',
                'judul' => 'Struktur Organisasi Pos Pelayanan Jambi Timur',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Pos Pelayanan Jambi Timur.',
                'urutan' => 10,
                'source_file' => 'Struktur_Organisasi_Pos_Pelayanan_Jambi_Timur_2026.pdf',
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'pos_pelayanan',
                'judul' => 'Struktur Organisasi Pos Pelayanan Kota Baru',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Pos Pelayanan Kota Baru.',
                'urutan' => 11,
                'source_file' => null,
            ],
            [
                'kategori' => 'sotk',
                'sub_kategori' => 'pos_pelayanan',
                'judul' => 'Struktur Organisasi Pos Pelayanan Pelayangan',
                'tahun' => 2026,
                'keterangan' => 'Dokumen Struktur Organisasi Pos Pelayanan Pelayangan.',
                'urutan' => 12,
                'source_file' => null,
            ],
        ];

        $now = Carbon::now();

        foreach ($sotkList as $item) {
            $sourceFile = $item['source_file'] ?? null;
            unset($item['source_file']);

            $fileDokumen = null;
            if ($sourceFile) {
                $sourcePath = $sourceDir.'/'.$sourceFile;
                if (File::exists($sourcePath)) {
                    $destinationPath = $targetDir.'/'.$sourceFile;
                    File::copy($sourcePath, $destinationPath);
                    $fileDokumen = 'profil-instansi/sotk/'.$sourceFile;
                }
            }

            $existing = DB::table('profil_instansis')
                ->where('kategori', $item['kategori'])
                ->where('urutan', $item['urutan'])
                ->first();

            if (! $fileDokumen && $existing?->file_dokumen) {
                $item['file_dokumen'] = $existing->file_dokumen;
            } else {
                $item['file_dokumen'] = $fileDokumen;
            }

            if (! $existing) {
                $item['created_at'] = $now;
            }
            $item['updated_at'] = $now;

            DB::table('profil_instansis')->updateOrInsert(
                [
                    'kategori' => $item['kategori'],
                    'urutan' => $item['urutan'],
                ],
                $item
            );
        }
    }
}

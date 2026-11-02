<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RekapLayananTableSeeder extends Seeder
{
    /**
     * Jalankan seeder data rekap layanan dan rekap objek kebakaran (2020 - 2026).
     */
    public function run(): void
    {
        $jsonPath = database_path('seeders/data/rekap_layanan.json');

        if (! File::exists($jsonPath)) {
            $this->command?->error("File dataset rekap_layanan.json tidak ditemukan di: {$jsonPath}");

            return;
        }

        $content = File::get($jsonPath);
        $dataset = json_decode($content, true);

        if (! is_array($dataset) || empty($dataset)) {
            $this->command?->warn('Dataset rekap_layanan.json kosong atau tidak valid.');

            return;
        }

        $totalRecords = count($dataset);
        $this->command?->info("Memuat dataset rekap_layanan ({$totalRecords} data dari tahun 2020 - 2026)...");

        $inserted = 0;
        $updated = 0;

        $chunks = array_chunk($dataset, 50);
        foreach ($chunks as $chunk) {
            DB::transaction(function () use ($chunk, &$inserted, &$updated) {
                foreach ($chunk as $row) {
                    $tanggal = $row['tanggal'] ?? null;
                    $kategori = $row['kategori'] ?? null;

                    if (! $tanggal || ! $kategori) {
                        continue;
                    }

                    $exists = DB::table('rekap_layanan')
                        ->where('tanggal', $tanggal)
                        ->where('kategori', $kategori)
                        ->exists();

                    DB::table('rekap_layanan')->updateOrInsert(
                        [
                            'tanggal' => $tanggal,
                            'kategori' => $kategori,
                        ],
                        [
                            'jumlah' => (int) ($row['jumlah'] ?? 0),
                            'kecamatan' => $row['kecamatan'] ?? 'Kota Jambi',
                            'lokasi' => $row['lokasi'] ?? 'Kota Jambi',
                            'keterangan' => $row['keterangan'] ?? null,
                            'dibuat_oleh' => $row['dibuat_oleh'] ?? 1,
                            'created_at' => $row['created_at'] ?? now(),
                            'updated_at' => now(),
                        ]
                    );

                    if ($exists) {
                        $updated++;
                    } else {
                        $inserted++;
                    }
                }
            });
        }

        $this->command?->info("Seeder Rekap Layanan & Objek selesai. Insert baru: {$inserted}, Diperbarui: {$updated}. Total: {$totalRecords}.");
    }
}

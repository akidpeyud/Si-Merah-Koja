<?php

namespace App\Console\Commands;

use App\Imports\RekapNonKebakaranImport;
use App\Models\RekapNonKebakaran;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class ImportNonKebakaran extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:nonkebakaran
                            {file? : Path ke file Excel .xlsx}
                            {--sheet= : Nama sheet target di Excel (opsional, default: sheet pertama)}
                            {--tahun= : Tahun data rekap (opsional, jika tidak diisi akan dideteksi dari nama file/header)}
                            {--truncate : Hapus data rekap tahun bersangkutan terlebih dahulu}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Impor data rekap bulanan bencana non-kebakaran dari file Excel ke database';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $filePath = $this->argument('file');
        $sheetName = $this->option('sheet') ? (string) $this->option('sheet') : null;
        $tahunOption = $this->option('tahun');
        $truncate = (bool) $this->option('truncate');

        // Jika path tidak diisi, coba cari default file
        if (! $filePath) {
            $defaultPaths = [
                base_path('DATA NON KEBAKARAN 2024-YG DIPAKAI.xlsx'),
                base_path('DATA NON KEBAKARAN 2023-YG DIPAKAI.xlsx'),
                storage_path('app/import/DATA NON KEBAKARAN 2024-YG DIPAKAI.xlsx'),
                storage_path('app/import/DATA NON KEBAKARAN 2023-YG DIPAKAI.xlsx'),
            ];

            foreach ($defaultPaths as $path) {
                if (File::exists($path)) {
                    $filePath = $path;
                    break;
                }
            }

            if (! $filePath) {
                $filePath = base_path('DATA NON KEBAKARAN 2024-YG DIPAKAI.xlsx');
            }
        }

        if (! File::exists($filePath)) {
            $this->error("File Excel tidak ditemukan di path: [{$filePath}]");
            $this->line('Silakan salin file ke direktori project atau tentukan path file secara eksplisit:');
            $this->line('  php artisan import:nonkebakaran "path/ke/file.xlsx"');

            return self::FAILURE;
        }

        // Deteksi tahun otomatis jika tidak diberikan via opsi --tahun
        $tahun = null;
        if ($tahunOption && is_numeric($tahunOption)) {
            $tahun = (int) $tahunOption;
        } else {
            // Cek angka 4 digit 20xx di nama file
            if (preg_match('/(20[2-9][0-9])/', basename($filePath), $m)) {
                $tahun = (int) $m[1];
            } else {
                $tahun = 2024;
            }
        }

        $this->info("Memulai impor data dari file: {$filePath}");
        $this->line('Sheet: '.($sheetName ?: '(Sheet Pertama)')." | Tahun: {$tahun}");

        try {
            $import = new RekapNonKebakaranImport(
                tahun: $tahun,
                truncateFirst: $truncate,
                targetSheet: $sheetName
            );

            Excel::import($import, $filePath);

            $count = RekapNonKebakaran::where('tahun', $tahun)->count();
            $this->info("Impor berhasil! Total data tersimpan untuk tahun {$tahun}: {$count} bulan.");

            // Tampilkan preview ringkasan tabel
            $rows = RekapNonKebakaran::where('tahun', $tahun)
                ->orderBy('bulan_angka')
                ->get(['bulan', 'total_kejadian'])
                ->map(fn (RekapNonKebakaran $item) => [
                    'Bulan' => $item->bulan,
                    'Total Kejadian' => $item->total_kejadian,
                ]);

            if ($rows->isNotEmpty()) {
                $this->table(['Bulan', 'Total Kejadian'], $rows->toArray());
            }

            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error('Gagal mengimpor data: '.$e->getMessage());

            return self::FAILURE;
        }
    }
}

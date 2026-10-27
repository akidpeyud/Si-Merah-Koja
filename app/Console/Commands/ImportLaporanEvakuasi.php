<?php

namespace App\Console\Commands;

use App\Imports\LaporanEvakuasiImport;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportLaporanEvakuasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:laporan-evakuasi
                            {file? : Path ke file Excel .xlsx (contoh: "laporan evakuasi 2025.xlsx")}
                            {--sheet= : Nama sheet target di Excel (opsional, contoh: "BULAN JANUARI")}
                            {--all-sheets : Impor semua sheet data bulanan/mingguan di workbook}
                            {--user= : ID user pemilik data hasil import (default: ID akun Damtan/Super User)}
                            {--dry-run : Mode simulasi tanpa menyimpan apa pun ke database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Impor data laporan evakuasi / penyelamatan non-kebakaran dari file Excel ke database';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $filePath = $this->argument('file');
        $sheetOption = $this->option('sheet') ? (string) $this->option('sheet') : null;
        $allSheets = (bool) $this->option('all-sheets');
        $dryRun = (bool) $this->option('dry-run');

        // 1. Tentukan Path File Excel
        if (! $filePath) {
            $candidatePaths = [
                base_path('laporan evakuasi 2025.xlsx'),
                base_path('Laporan Evakuasi 2025.xlsx'),
                base_path('LAPORAN EVAKUASI 2025.xlsx'),
                storage_path('app/import/laporan evakuasi 2025.xlsx'),
                storage_path('app/laporan evakuasi 2025.xlsx'),
            ];

            foreach ($candidatePaths as $p) {
                if (File::exists($p)) {
                    $filePath = $p;
                    break;
                }
            }

            if (! $filePath) {
                $filePath = base_path('laporan evakuasi 2025.xlsx');
            }
        }

        if (! File::exists($filePath)) {
            $this->error("File Excel tidak ditemukan di path: [{$filePath}]");
            $this->line('');
            $this->line('Silakan letakkan file Excel di root folder project, atau tentukan path file secara eksplisit:');
            $this->info('  php artisan import:laporan-evakuasi "path/ke/laporan evakuasi 2025.xlsx"');
            $this->line('');
            $this->line('Contoh jika ditaruh di folder project:');
            $this->info('  php artisan import:laporan-evakuasi "laporan evakuasi 2025.xlsx"');

            return self::FAILURE;
        }

        // 2. Tentukan User ID Pemilik Laporan
        $userId = $this->option('user');
        if (! $userId) {
            $user = User::whereHas('roles', fn ($q) => $q->whereIn('name', ['Damtan', 'Super User']))->first() ?? User::first();
            $userId = $user ? $user->id : 1;
        } else {
            $userId = (int) $userId;
            if (! User::where('id', $userId)->exists()) {
                $this->error("User dengan ID [{$userId}] tidak ditemukan di database.");

                return self::FAILURE;
            }
        }

        // 3. Deteksi Daftar Sheet Menggunakan PhpSpreadsheet
        $availableSheets = [];
        try {
            $reader = IOFactory::createReaderForFile($filePath);
            $availableSheets = $reader->listWorksheetNames($filePath);
        } catch (\Throwable $e) {
            $this->warn('Tidak dapat membaca daftar sheet secara otomatis: '.$e->getMessage());
        }

        $this->info('========================================================');
        $this->info('    IMPOR DATA LAPORAN EVAKUASI / NON-KEBAKARAN        ');
        $this->info('========================================================');
        $this->line("File Target : <comment>{$filePath}</comment>");
        $this->line("User ID     : <comment>{$userId}</comment>");

        if ($sheetOption) {
            $this->line("Mode Sheet  : <comment>Sheet Spesifik [{$sheetOption}]</comment>");
        } elseif ($allSheets) {
            $this->line('Mode Sheet  : <comment>Semua Sheet ('.count($availableSheets).' sheet)</comment>');
        } else {
            $this->line('Mode Sheet  : <comment>Sheet Pertama ('.($availableSheets[0] ?? 'Index 0').')</comment>');
        }

        if ($dryRun) {
            $this->warn('[SIMULASI]: Data hanya dipratinjau, tidak disimpan ke database.');
        }

        $this->line('');

        // 4. Eksekusi Import menggunakan Maatwebsite/Excel
        try {
            $import = new LaporanEvakuasiImport(
                userId: $userId,
                targetSheet: $sheetOption,
                allSheets: $allSheets,
                availableSheets: $availableSheets,
                dryRun: $dryRun
            );

            Excel::import($import, $filePath);

            $this->info('Proses impor selesai!');
            $this->line('--------------------------------------------------------');
            $this->line("Total Baris Dibaca   : <info>{$import->totalDibaca}</info>");
            $this->line("Berhasil Disimpan    : <info>{$import->totalDisimpan}</info>");
            $this->line("Duplikat (Dilewati)  : <comment>{$import->totalDuplikat}</comment>");
            $this->line("Header/Baris Kosong  : {$import->totalDilewati}");
            $this->line('--------------------------------------------------------');

            // Pratinjau 10 baris pertama
            if (! empty($import->riwayatImport)) {
                $this->line('');
                $this->info('Pratinjau Data Hasil Impor (Maks 10 baris):');
                $preview = array_slice($import->riwayatImport, 0, 10);
                $this->table(['Tanggal', 'Pelapor', 'Jenis Evakuasi', 'Kecamatan', 'Status'], $preview);
            }

            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error('Terjadi kesalahan saat mengimpor data: '.$e->getMessage());
            $this->line($e->getTraceAsString());

            return self::FAILURE;
        }
    }
}

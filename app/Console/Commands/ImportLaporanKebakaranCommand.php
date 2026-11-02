<?php

namespace App\Console\Commands;

use App\Imports\LaporanKebakaranBulananImport;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportLaporanKebakaranCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:laporan-kebakaran
                            {file : Path ke file Excel (.xlsx)}
                            {--user= : ID user yang mencatat laporan (opsional, default: Super User / Damtan)}
                            {--dry-run : Simulasi import tanpa menyimpan perubahan ke database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Impor data laporan kebakaran dari sheet BULANAN file Excel ke tabel database laporan_penyelamatans';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $filePath = $this->argument('file');

        // 1. Validasi Keberadaan File dengan pencarian cerdas di lokasi umum
        if (! File::exists($filePath)) {
            $userHome = getenv('USERPROFILE') ?: 'C:\\Users\\ADVAN';
            $cleanedName = str_ireplace(['Laporann', 'Bulanann'], ['Laporan', 'Bulanan'], $filePath);

            $candidatePaths = [
                base_path($filePath),
                base_path($cleanedName),
                base_path('storage/app/import/' . $filePath),
                base_path('storage/app/import/' . $cleanedName),
                base_path('storage/app/' . $filePath),
                base_path('storage/app/' . $cleanedName),
                $userHome . '\\Downloads\\' . $filePath,
                $userHome . '\\Downloads\\' . $cleanedName,
                $userHome . '\\Desktop\\' . $filePath,
                $userHome . '\\Desktop\\' . $cleanedName,
            ];

            $found = null;
            foreach ($candidatePaths as $candidate) {
                if (File::exists($candidate)) {
                    $found = $candidate;
                    break;
                }
            }

            if ($found) {
                $filePath = $found;
            } else {
                $this->error("File Excel tidak ditemukan di lokasi: {$filePath}");
                $this->line("Tips:");
                $this->line("1. Pastikan file berada di folder: " . base_path());
                $this->line("2. Atau gunakan path lengkap, contoh: php artisan import:laporan-kebakaran \"{$userHome}\\Downloads\\{$cleanedName}\"");
                $this->line("3. Periksa ejaan nama file (apakah ada huruf ganda seperti 'Laporann' atau 'Bulanann').");

                return self::FAILURE;
            }
        }

        // 2. Tentukan User Pemilik Data
        $userId = $this->option('user');
        if ($userId) {
            if (! User::where('id', $userId)->exists()) {
                $this->error("User dengan ID {$userId} tidak ditemukan di database.");

                return self::FAILURE;
            }
        } else {
            $user = User::whereHas('roles', fn ($q) => $q->whereIn('name', ['Damtan', 'Super User']))->first() ?? User::first();
            $userId = $user ? $user->id : 1;
        }

        $dryRun = (bool) $this->option('dry-run');

        $this->newLine();
        $this->info('================================================================');
        $this->info('  PROSES IMPOR LAPORAN KEBAKARAN (SHEET BULANAN) KE DATABASE  ');
        $this->info('================================================================');
        $this->line("File Target : <comment>{$filePath}</comment>");
        $this->line("User ID     : <comment>{$userId}</comment>");
        $this->line('Mode        : '.($dryRun ? '<fg=yellow;options=bold>SIMULASI (DRY-RUN - Tidak ada data yang disimpan)</>' : '<fg=green;options=bold>EKSEKUSI NYATA KE DATABASE</>'));
        $this->newLine();

        // 3. Baca Daftar Sheet yang Tersedia di File Excel
        $availableSheets = [];
        try {
            $reader = IOFactory::createReaderForFile($filePath);
            $availableSheets = $reader->listWorksheetNames($filePath);
        } catch (\Throwable $e) {
            $this->warn('Gagal membaca daftar sheet dengan PhpSpreadsheet: '.$e->getMessage());
        }

        // 4. Inisialisasi Class Import Maatwebsite/Excel
        $import = new LaporanKebakaranBulananImport(
            userId: (int) $userId,
            availableSheets: $availableSheets,
            dryRun: $dryRun
        );

        $this->comment('Sedang memproses dan membaca sheet BULANAN...');

        try {
            Excel::import($import, $filePath);
        } catch (\Throwable $e) {
            $this->error('Terjadi kesalahan saat proses impor: '.$e->getMessage());

            return self::FAILURE;
        }

        // 5. Tampilkan Rangkuman Hasil Impor
        $this->newLine();
        $this->info('Laporan Hasil Impor:');
        $this->table(
            ['Metrik', 'Jumlah'],
            [
                ['Total Baris Dibaca', $import->totalDibaca],
                ['Berhasil Disimpan', $import->totalDisimpan],
                ['Duplikat (Dilewati)', $import->totalDuplikat],
                ['Baris Header/Kosong (Dilewati)', $import->totalDilewati],
            ]
        );

        if ($dryRun) {
            $this->warn('Mode simulasi aktif: data tidak disimpan ke database. Jalankan tanpa flag --dry-run untuk menyimpan data sebenarnya.');
        } else {
            $this->info('Proses impor selesai dengan sukses! Silakan periksa menu Kelola Data Laporan di panel Bagian Pemadaman.');
        }

        return self::SUCCESS;
    }
}

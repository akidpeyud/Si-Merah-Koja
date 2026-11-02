<?php

namespace App\Console\Commands;

use App\Imports\Evakuasi2026Import;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportEvakuasi2026Command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:evakuasi-2026
                            {file : Path ke file Excel (.xlsx)}
                            {--sheet= : Nama sheet spesifik yang ingin diimpor}
                            {--all-sheets : Impor semua sheet mingguan yang ada di file Excel}
                            {--user= : ID user yang mencatat laporan (opsional, default: Super User / Damtan)}
                            {--dry-run : Simulasi import tanpa menyimpan perubahan ke database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Impor data laporan evakuasi / non-kebakaran tahun 2026 dari file Excel ke database';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $filePath = $this->argument('file');

        // 1. Validasi Keberadaan File dengan pencarian cerdas di lokasi umum
        if (! File::exists($filePath)) {
            $userHome = getenv('USERPROFILE') ?: 'C:\\Users\\ADVAN';

            $candidatePaths = [
                base_path($filePath),
                base_path('storage/app/import/'.$filePath),
                base_path('storage/app/'.$filePath),
                $userHome.'\\Downloads\\'.$filePath,
                $userHome.'\\Desktop\\'.$filePath,
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
                $this->line('Tips:');
                $this->line('1. Pastikan file berada di folder project ini: '.base_path());
                $this->line("2. Atau gunakan path lengkap, contoh: php artisan import:evakuasi-2026 \"{$userHome}\\Downloads\\{$filePath}\"");

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
        $allSheets = (bool) $this->option('all-sheets');
        $targetSheet = $this->option('sheet');

        $this->newLine();
        $this->info('========================================================================');
        $this->info('  PROSES IMPOR LAPORAN EVAKUASI / NON-KEBAKARAN 2026 KE DATABASE  ');
        $this->info('========================================================================');
        $this->line("File Target : <comment>{$filePath}</comment>");
        $this->line("User ID     : <comment>{$userId}</comment>");
        $this->line('Lingkup     : '.($targetSheet ? "<comment>Sheet '{$targetSheet}'</comment>" : ($allSheets ? '<comment>Semua Sheet Mingguan (--all-sheets)</comment>' : '<comment>Sheet Pertama (Default)</comment>')));
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
        $import = new Evakuasi2026Import(
            userId: (int) $userId,
            targetSheet: $targetSheet,
            allSheets: $allSheets,
            availableSheets: $availableSheets,
            dryRun: $dryRun
        );

        $this->comment('Sedang membaca dan memproses data Excel...');

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
                ['Baris Header/Kosong/Ttd (Dilewati)', $import->totalDilewati],
            ]
        );

        if ($dryRun) {
            $this->warn('Mode simulasi aktif: data tidak disimpan ke database. Jalankan tanpa flag --dry-run untuk menyimpan data sebenarnya.');
        } else {
            $this->info('Proses impor selesai dengan sukses! Silakan periksa menu Kelola Data Laporan (Non-Kebakaran) di panel Bagian Pemadaman.');
        }

        return self::SUCCESS;
    }
}

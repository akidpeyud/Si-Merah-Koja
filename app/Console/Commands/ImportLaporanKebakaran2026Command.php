<?php

namespace App\Console\Commands;

use App\Imports\LaporanKebakaran2026Import;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportLaporanKebakaran2026Command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:laporan-kebakaran-2026
                            {file? : Path file Excel (default: LAPORAN KEBAKARAN SIMERAH KOJA TAHUN 2026.xlsx)}
                            {--user= : ID user pemilik data laporan (default: Super User / Damtan)}
                            {--dry-run : Simulasi import tanpa menyimpan perubahan ke database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Impor data Laporan Kebakaran Tahun 2026 (Multi-sheet & Multi-row) ke database SIMERAH KOJA';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $inputPath = $this->argument('file') ?? 'LAPORAN KEBAKARAN SIMERAH KOJA TAHUN 2026.xlsx';
        $userHome = getenv('USERPROFILE') ?: 'C:\\Users\\ADVAN';

        // 1. Pencarian cerdas lokasi file Excel
        $candidatePaths = [
            $inputPath,
            base_path($inputPath),
            base_path('storage/app/import/'.$inputPath),
            base_path('storage/app/'.$inputPath),
            $userHome.'\\Downloads\\'.$inputPath,
            $userHome.'\\Desktop\\'.$inputPath,
            $userHome.'\\Documents\\'.$inputPath,
        ];

        $filePath = null;
        foreach ($candidatePaths as $candidate) {
            if (File::exists($candidate)) {
                $filePath = $candidate;
                break;
            }
        }

        if (! $filePath) {
            $this->error("File Excel tidak ditemukan: {$inputPath}");
            $this->newLine();
            $this->line('Petunjuk:');
            $this->line('1. Letakkan file di folder project: '.base_path());
            $this->line('2. Atau di folder storage: '.base_path('storage/app/import/'));
            $this->line("3. Atau jalankan dengan path lengkap tanda kutip:\n   php artisan import:laporan-kebakaran-2026 \"{$userHome}\\Downloads\\{$inputPath}\"");

            return self::FAILURE;
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
        $this->info('========================================================================');
        $this->info('  PROSES IMPOR LAPORAN KEBAKARAN 2026 (MULTI-SHEET & MULTI-ROW) ');
        $this->info('========================================================================');
        $this->line("File Target : <comment>{$filePath}</comment>");
        $this->line("User ID     : <comment>{$userId}</comment>");
        $this->line('Mode        : '.($dryRun ? '<fg=yellow;options=bold>SIMULASI (DRY-RUN - Tidak ada data yang disimpan)</>' : '<fg=green;options=bold>EKSEKUSI NYATA KE DATABASE</>'));
        $this->newLine();

        // 3. Baca Daftar Sheet yang Tersedia di File Excel
        $availableSheets = [];
        try {
            $reader = IOFactory::createReaderForFile($filePath);
            $availableSheets = $reader->listWorksheetNames($filePath);
            $this->line('Sheet ditemukan: <info>'.implode(', ', $availableSheets).'</info>');
        } catch (\Throwable $e) {
            $this->warn('Catatan: Tidak dapat membaca list sheet via PhpSpreadsheet: '.$e->getMessage());
        }

        // 4. Inisialisasi Class Import Maatwebsite/Excel
        $import = new LaporanKebakaran2026Import(
            userId: (int) $userId,
            dryRun: $dryRun,
            availableSheets: $availableSheets
        );

        $this->output->write('Sedang memproses dan mengelompokkan baris insiden per sheet...');

        $startTime = microtime(true);
        try {
            Excel::import($import, $filePath);
        } catch (\Throwable $e) {
            $this->newLine(2);
            $this->error('Gagal saat proses impor: '.$e->getMessage());
            $this->line($e->getTraceAsString());

            return self::FAILURE;
        }
        $elapsed = round(microtime(true) - $startTime, 2);

        $this->output->writeln(' <fg=green;options=bold>SELESAI</>');
        $this->newLine();

        // 5. Tampilkan Tabel Rekapitulasi Hasil Impor Per Sheet
        $tableRows = [];
        $grandTotalDibaca = 0;
        $grandTotalDisimpan = 0;
        $grandTotalDuplikat = 0;
        $grandTotalDilewati = 0;

        foreach ($import->sheetInstances as $sheetName => $instance) {
            $tableRows[] = [
                $sheetName,
                number_format($instance->totalDibaca),
                number_format($instance->totalDisimpan),
                number_format($instance->totalDuplikat),
                number_format($instance->totalDilewati),
            ];

            $grandTotalDibaca += $instance->totalDibaca;
            $grandTotalDisimpan += $instance->totalDisimpan;
            $grandTotalDuplikat += $instance->totalDuplikat;
            $grandTotalDilewati += $instance->totalDilewati;
        }

        $tableRows[] = [
            '<fg=yellow;options=bold>TOTAL KESELURUHAN</>',
            '<fg=yellow;options=bold>'.number_format($grandTotalDibaca).'</>',
            '<fg=green;options=bold>'.number_format($grandTotalDisimpan).'</>',
            '<fg=cyan;options=bold>'.number_format($grandTotalDuplikat).'</>',
            '<fg=red;options=bold>'.number_format($grandTotalDilewati).'</>',
        ];

        $this->table(
            ['Nama Sheet', 'Insiden Dibaca', 'Berhasil Disimpan', 'Duplikat (Dilewati)', 'Dilewati/Header'],
            $tableRows
        );

        $this->info("Waktu eksekusi: {$elapsed} detik.");

        if ($dryRun) {
            $this->newLine();
            $this->warn('Mode DRY-RUN selesai. Tidak ada data yang dimasukkan ke database.');
            $this->line('Jalankan tanpa flag --dry-run untuk menyimpan data secara permanen.');
        }

        return self::SUCCESS;
    }
}

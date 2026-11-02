<?php

namespace App\Console\Commands;

use App\Imports\RekapObjekKebakaranImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class ImportRekapObjekKebakaranCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:rekap-objek-kebakaran
                            {file : Path ke file Excel .xlsx}
                            {tahun : Tahun data rekap (contoh: 2025 atau 2026)}
                            {--user=1 : ID User pembuat data (default: 1)}
                            {--dry-run : Simulasi baca file tanpa menyimpan ke database}
                            {--truncate : Hapus data rekap objek tahun ini sebelum mengimpor}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Impor data rekap matriks objek kebakaran bulanan ke tabel rekap_layanan';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $rawPath = (string) $this->argument('file');
        $tahunArg = (string) $this->argument('tahun');
        $userId = (int) $this->option('user');
        $isDryRun = (bool) $this->option('dry-run');
        $isTruncate = (bool) $this->option('truncate');

        if (! is_numeric($tahunArg) || (int) $tahunArg < 2000 || (int) $tahunArg > 2100) {
            $this->error("Tahun '{$tahunArg}' tidak valid. Masukkan tahun 4 digit, misal: 2025 atau 2026.");

            return self::FAILURE;
        }

        $tahun = (int) $tahunArg;

        $resolvedPath = $this->resolveFilePath($rawPath);
        if (! $resolvedPath || ! File::exists($resolvedPath)) {
            $this->error("File Excel tidak ditemukan di lokasi: {$rawPath}");
            $this->line('Tips: Pastikan path file benar atau letakkan file di folder Downloads / root proyek.');

            return self::FAILURE;
        }

        $this->info('================================================================');
        $this->info('  PROSES IMPOR REKAP OBJEK KEBAKARAN KE TABEL REKAP_LAYANAN    ');
        $this->info('================================================================');
        $this->line("File Target : <comment>{$resolvedPath}</comment>");
        $this->line("Tahun Data  : <comment>{$tahun}</comment>");
        $this->line("User ID     : <comment>{$userId}</comment>");
        $this->line('Mode        : '.($isDryRun ? '<fg=yellow>SIMULASI (DRY-RUN - Tidak ada data yang disimpan)</>' : '<fg=green>EKSEKUSI NYATA KE DATABASE</>'));
        if ($isTruncate) {
            $this->line('Opsi        : <fg=red>TRUNCATE AKTIF (Data rekap tahun '.$tahun.' akan dihapus dulu)</>');
        }
        $this->newLine();

        $this->line('Sedang membaca Sheet 1 matriks rekap bulanan...');

        try {
            $import = new RekapObjekKebakaranImport(
                tahun: $tahun,
                userId: $userId,
                dryRun: $isDryRun,
                truncateFirst: $isTruncate
            );

            Excel::import($import, $resolvedPath);

            $this->newLine();
            $this->info('Laporan Hasil Impor Rekap Objek Kebakaran:');
            $this->table(
                ['Metrik', 'Jumlah'],
                [
                    ['Total Baris Bulan Dibaca', $import->totalBulan],
                    ['Total Entri Objek Disimpan', $import->totalDisimpan],
                    ['Sel Kosong / Nol (Dilewati)', $import->totalDilewati],
                ]
            );

            if (! empty($import->importedDetails)) {
                $this->newLine();
                $this->line('<fg=cyan>Ringkasan Objek Terbakar per Bulan:</>');
                $previewData = array_map(function ($item) {
                    return [
                        'Bulan' => $item['bulan'],
                        'Kategori' => $item['kategori'],
                        'Key Database' => $item['key'],
                        'Jumlah Terbakar' => $item['jumlah'],
                    ];
                }, array_slice($import->importedDetails, 0, 15));

                $this->table(['Bulan', 'Kategori', 'Key Database', 'Jumlah Terbakar'], $previewData);

                if (count($import->importedDetails) > 15) {
                    $this->line('... dan '.(count($import->importedDetails) - 15).' baris lainnya.');
                }
            }

            if ($isDryRun) {
                $this->newLine();
                $this->warn('Mode simulasi aktif: Tidak ada perubahan yang disimpan ke database.');
                $this->line("Jalankan tanpa flag --dry-run untuk menyimpan data: php artisan import:rekap-objek-kebakaran \"{$rawPath}\" {$tahun}");
            } else {
                $this->newLine();
                $this->info("Data rekap objek kebakaran tahun {$tahun} berhasil disimpan ke database!");
            }

            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error('Terjadi kesalahan saat proses impor: '.$e->getMessage());

            return self::FAILURE;
        }
    }

    /**
     * Menemukan lokasi file di filesystem
     */
    protected function resolveFilePath(string $path): ?string
    {
        $candidates = [
            $path,
            base_path($path),
            base_path('storage/app/'.$path),
            'C:\\Users\\ADVAN\\Downloads\\'.basename($path),
            'C:\\Users\\ADVAN\\Desktop\\'.basename($path),
        ];

        foreach ($candidates as $cand) {
            if (File::exists($cand)) {
                return $cand;
            }
        }

        return null;
    }
}

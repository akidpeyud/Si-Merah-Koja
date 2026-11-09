<?php

namespace App\Console\Commands;

use App\Imports\EvakuasiLengkapImport;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportEvakuasiLengkapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:evakuasi-lengkap
                            {file? : Path file Excel atau folder yang berisi file-file Excel laporan evakuasi}
                            {--user= : ID user pemilik data laporan (default: Super User / Damtan)}
                            {--sheet= : Nama sheet tertentu yang ingin diimpor secara spesifik}
                            {--dry-run : Simulasi import tanpa menyimpan perubahan ke database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Impor data Laporan Evakuasi / Penyelamatan (Non-Kebakaran) dari file/folder Excel ke database SIMERAH KOJA';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $rawInput = (string) ($this->argument('file') ?? '');
        $inputPath = trim($rawInput, " \t\n\r\0\x0B\"'");
        $userHome = getenv('USERPROFILE') ?: 'C:\\Users\\ADVAN';

        // 1. Tentukan User Pemilik Data
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

        // 2. Pencarian lokasi file / folder target
        $targetFiles = [];

        if (! empty($inputPath)) {
            // Cek apakah inputPath adalah folder
            if (File::isDirectory($inputPath)) {
                $targetFiles = $this->ambilSemuaExcelDariFolder($inputPath, 'evakuasi');
                if (empty($targetFiles)) {
                    $targetFiles = $this->ambilSemuaExcelDariFolder($inputPath);
                }
            } elseif (File::isFile($inputPath)) {
                $targetFiles = [$inputPath];
            } else {
                // Cari di kandidat lokasi
                $candidatePaths = [
                    base_path($inputPath),
                    base_path('storage/app/import/'.$inputPath),
                    base_path('storage/app/'.$inputPath),
                    $userHome.'\\Downloads\\'.$inputPath,
                    $userHome.'\\Desktop\\'.$inputPath,
                    $userHome.'\\Documents\\'.$inputPath,
                ];

                foreach ($candidatePaths as $candidate) {
                    if (File::isDirectory($candidate)) {
                        $targetFiles = $this->ambilSemuaExcelDariFolder($candidate, 'evakuasi');
                        if (empty($targetFiles)) {
                            $targetFiles = $this->ambilSemuaExcelDariFolder($candidate);
                        }
                        break;
                    }
                    if (File::isFile($candidate)) {
                        $targetFiles = [$candidate];
                        break;
                    }
                }

                // Jika belum ketemu, coba pencarian pencocokan nama file di Downloads (case-insensitive)
                if (empty($targetFiles) && File::isDirectory($userHome.'\\Downloads')) {
                    $baseNameOnly = basename($inputPath);
                    $allDownloads = $this->ambilSemuaExcelDariFolder($userHome.'\\Downloads');
                    foreach ($allDownloads as $df) {
                        if (strcasecmp(basename($df), $baseNameOnly) === 0) {
                            $targetFiles = [$df];
                            break;
                        }
                    }
                }
            }
        } else {
            // Default jika tanpa argumen: Cari file EVAKUASI di Downloads
            $downloadsDir = $userHome.'\\Downloads';
            if (File::isDirectory($downloadsDir)) {
                $targetFiles = $this->ambilSemuaExcelDariFolder($downloadsDir, 'evakuasi');
            }

            if (empty($targetFiles)) {
                $defaultDirs = [
                    base_path('storage/app/import'),
                    $userHome.'\\Downloads\\Laporan Evakuasi',
                    $userHome.'\\Downloads\\Evakuasi',
                ];

                foreach ($defaultDirs as $dir) {
                    if (File::isDirectory($dir)) {
                        $found = $this->ambilSemuaExcelDariFolder($dir, 'evakuasi');
                        if (empty($found)) {
                            $found = $this->ambilSemuaExcelDariFolder($dir);
                        }
                        if (! empty($found)) {
                            $targetFiles = $found;
                            break;
                        }
                    }
                }
            }
        }

        if (empty($targetFiles)) {
            $this->error("File atau folder Excel evakuasi tidak ditemukan: \"{$inputPath}\"");
            $this->newLine();

            // Deteksi dan tampilkan daftar file Excel yang ada di Downloads agar pengguna bisa memilih langsung
            $downloadsDir = $userHome.'\\Downloads';
            if (File::isDirectory($downloadsDir)) {
                $allExcel = $this->ambilSemuaExcelDariFolder($downloadsDir);
                if (! empty($allExcel)) {
                    $this->warn('Daftar file Excel (.xlsx/.xls) yang terdeteksi di folder Downloads Anda:');
                    foreach (array_slice($allExcel, 0, 20) as $f) {
                        $this->line('  • <info>'.basename($f).'</info>');
                    }
                    $this->newLine();
                }
            }

            $this->line('Petunjuk Penggunaan:');
            $this->line('1. Untuk satu file:');
            $this->line('   php artisan import:evakuasi-lengkap "C:\\Users\\ADVAN\\Downloads\\<NAMA_FILE_SEBENARNYA>.xlsx"');
            $this->line('2. Untuk sekaligus 10 file dalam satu folder:');
            $this->line('   php artisan import:evakuasi-lengkap "C:\\Users\\ADVAN\\Downloads\\<NAMA_FOLDER>"');

            return self::FAILURE;
        }

        $this->newLine();
        $this->info('========================================================================');
        $this->info('  PROSES IMPOR LAPORAN PENYELAMATAN & EVAKUASI (NON-KEBAKARAN) ');
        $this->info('========================================================================');
        $this->line('Total File Ditemukan : <comment>'.count($targetFiles).' file</comment>');
        $this->line("User ID Pemilik      : <comment>{$userId}</comment>");
        $this->line('Mode                 : '.($dryRun ? '<fg=yellow;options=bold>SIMULASI (DRY-RUN - Tidak ada data yang disimpan)</>' : '<fg=green;options=bold>EKSEKUSI NYATA KE DATABASE</>'));
        $this->newLine();

        $grandTotalDibaca = 0;
        $grandTotalDisimpan = 0;
        $grandTotalDuplikat = 0;
        $grandTotalDilewati = 0;

        $rekapPerFile = [];

        foreach ($targetFiles as $index => $filePath) {
            $nomor = $index + 1;
            $namaFile = basename($filePath);
            $this->line("[{$nomor}/".count($targetFiles)."] Memproses: <comment>{$namaFile}</comment>...");

            // Deteksi daftar sheet
            $availableSheets = $this->deteksiDaftarSheet($filePath);
            if (! empty($availableSheets)) {
                $this->line('   Sheet ditemukan: <info>'.implode(', ', $availableSheets).'</info>');
            }

            $targetSheet = $this->option('sheet');
            if ($targetSheet) {
                $matchedSheets = array_values(array_filter($availableSheets, fn ($s) => strcasecmp($s, $targetSheet) === 0));
                if (empty($matchedSheets)) {
                    $this->warn("   Sheet '{$targetSheet}' tidak ditemukan di file {$namaFile}, dilewati.");

                    continue;
                }
                $availableSheets = $matchedSheets;
            }

            $import = new EvakuasiLengkapImport(
                userId: (int) $userId,
                dryRun: $dryRun,
                availableSheets: $availableSheets
            );

            $startTime = microtime(true);
            try {
                Excel::import($import, $filePath);
            } catch (\Throwable $e) {
                $this->error("   Gagal saat mengimpor {$namaFile}: ".$e->getMessage());

                continue;
            }
            $elapsed = round(microtime(true) - $startTime, 2);

            $fileDibaca = 0;
            $fileDisimpan = 0;
            $fileDuplikat = 0;
            $fileDilewati = 0;

            foreach ($import->sheetInstances as $sheetName => $instance) {
                $fileDibaca += $instance->totalDibaca;
                $fileDisimpan += $instance->totalDisimpan;
                $fileDuplikat += $instance->totalDuplikat;
                $fileDilewati += $instance->totalDilewati;
            }

            $grandTotalDibaca += $fileDibaca;
            $grandTotalDisimpan += $fileDisimpan;
            $grandTotalDuplikat += $fileDuplikat;
            $grandTotalDilewati += $fileDilewati;

            $rekapPerFile[] = [
                'nama' => $namaFile,
                'dibaca' => $fileDibaca,
                'disimpan' => $fileDisimpan,
                'duplikat' => $fileDuplikat,
                'dilewati' => $fileDilewati,
                'waktu' => $elapsed.'s',
            ];

            $this->line("   <fg=green>Selesai dalam {$elapsed} detik</> (Disimpan: {$fileDisimpan}, Duplikat/Update: {$fileDuplikat}, Dilewati: {$fileDilewati})");
            $this->newLine();
        }

        // Tampilkan Tabel Rekapitulasi Keseluruhan
        $this->info('========================================================================');
        $this->info('                      REKAPITULASI HASIL IMPOR                         ');
        $this->info('========================================================================');

        $tableRows = [];
        foreach ($rekapPerFile as $r) {
            $tableRows[] = [
                $r['nama'],
                number_format($r['dibaca']),
                number_format($r['disimpan']),
                number_format($r['duplikat']),
                number_format($r['dilewati']),
                $r['waktu'],
            ];
        }

        $tableRows[] = [
            '<fg=yellow;options=bold>TOTAL KESELURUHAN</>',
            '<fg=yellow;options=bold>'.number_format($grandTotalDibaca).'</>',
            '<fg=green;options=bold>'.number_format($grandTotalDisimpan).'</>',
            '<fg=cyan;options=bold>'.number_format($grandTotalDuplikat).'</>',
            '<fg=white;options=bold>'.number_format($grandTotalDilewati).'</>',
            '-',
        ];

        $this->table(
            ['Nama File', 'Dibaca', 'Berhasil Disimpan', 'Duplikat (Update)', 'Dilewati/Header', 'Durasi'],
            $tableRows
        );

        $this->newLine();
        if ($dryRun) {
            $this->warn('CATATAN: Ini adalah SIMULASI (DRY-RUN). Tidak ada perubahan yang disimpan ke database.');
            $this->line('Jalankan tanpa flag --dry-run untuk mengeksekusi penyimpanan nyata:');
            $this->line("php artisan import:evakuasi-lengkap \"{$inputPath}\"");
        } else {
            $this->info('Proses impor seluruh laporan evakuasi berhasil diselesaikan!');
            $this->line('Silakan buka menu: <comment>Bidang Pemadaman > Kelola Data Laporan (Non-Kebakaran)</comment>');
        }
        $this->newLine();

        return self::SUCCESS;
    }

    /**
     * Mengambil seluruh file Excel (.xlsx / .xls) dari direktori tertentu dengan opsi filter kata kunci.
     */
    protected function ambilSemuaExcelDariFolder(string $folderPath, string $filter = ''): array
    {
        $files = File::files($folderPath);
        $excelFiles = [];

        foreach ($files as $file) {
            $ext = strtolower($file->getExtension());
            if (in_array($ext, ['xlsx', 'xls'])) {
                // Abaikan file sementara Excel (~$)
                if (! str_starts_with($file->getFilename(), '~$')) {
                    if ($filter === '' || stripos($file->getFilename(), $filter) !== false) {
                        $excelFiles[] = $file->getRealPath();
                    }
                }
            }
        }

        // Urutkan berdasarkan urutan bulan kalender (Januari -> Desember)
        usort($excelFiles, function ($a, $b) {
            return $this->urutanBulan(basename($a)) <=> $this->urutanBulan(basename($b));
        });

        return $excelFiles;
    }

    /**
     * Menentukan indeks urutan bulan dari nama file.
     */
    protected function urutanBulan(string $filename): int
    {
        $lower = strtolower($filename);
        $map = [
            'januari' => 1, 'jan' => 1,
            'februari' => 2, 'feb' => 2,
            'maret' => 3, 'mar' => 3,
            'april' => 4, 'apr' => 4,
            'mei' => 5, 'may' => 5,
            'juni' => 6, 'jun' => 6,
            'juli' => 7, 'jul' => 7,
            'agustus' => 8, 'agu' => 8, 'ags' => 8,
            'september' => 9, 'sep' => 9,
            'oktober' => 10, 'okt' => 10,
            'nopember' => 11, 'nopemeber' => 11, 'november' => 11, 'nov' => 11,
            'desember' => 12, 'des' => 12,
        ];

        foreach ($map as $key => $order) {
            if (str_contains($lower, $key)) {
                return $order;
            }
        }

        return 99;
    }

    /**
     * Mendeteksi daftar sheet menggunakan PhpSpreadsheet dengan fallback ke ZipArchive.
     */
    protected function deteksiDaftarSheet(string $filePath): array
    {
        try {
            $reader = IOFactory::createReaderForFile($filePath);

            return $reader->listWorksheetNames($filePath);
        } catch (\Throwable) {
            // Fallback via ZipArchive untuk format .xlsx
            $sheets = [];
            $zip = new \ZipArchive();
            if ($zip->open($filePath) === true) {
                if ($xml = $zip->getFromName('xl/workbook.xml')) {
                    $sxml = simplexml_load_string($xml);
                    if ($sxml && isset($sxml->sheets->sheet)) {
                        foreach ($sxml->sheets->sheet as $sh) {
                            $sheets[] = (string) $sh['name'];
                        }
                    }
                }
                $zip->close();
            }

            return $sheets;
        }
    }
}

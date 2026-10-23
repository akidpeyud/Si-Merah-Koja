<?php

namespace App\Console\Commands;

use App\Imports\RekapObjekKebakaranImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class ImportRekapKebakaran extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:rekap-kebakaran
                            {file? : Path ke file Excel .xlsx}
                            {--sheet= : Nama sheet target (opsional, default: sheet pertama)}
                            {--tahun= : Tahun data rekap (opsional, otomatis dideteksi dari nama file jika tidak diisi)}
                            {--truncate : Hapus data rekap objek tahun bersangkutan terlebih dahulu}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Impor data rekap bulanan objek kebakaran dari file Excel ke tabel rekap_layanan';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $filePath = $this->argument('file');
        $sheetName = $this->option('sheet') ? (string) $this->option('sheet') : null;
        $tahunOption = $this->option('tahun');
        $truncate = (bool) $this->option('truncate');

        if (! $filePath) {
            $defaultPaths = [
                base_path('REKAP KBKRN 2024.xlsx'),
                base_path('REKAP KEBAKARAN 2023.xlsx'),
                base_path('REKAP KEBAKARAN 2022.xlsx'),
                base_path('REKAP KEBAKARAN 2021.xlsx'),
                base_path('REKAP KEBAKARAN 2020.xlsx'),
            ];

            foreach ($defaultPaths as $path) {
                if (File::exists($path)) {
                    $filePath = $path;
                    break;
                }
            }
        }

        if (! $filePath || ! File::exists($filePath)) {
            $this->error("File Excel tidak ditemukan di path: [{$filePath}]");
            $this->line('Silakan tentukan path file secara eksplisit:');
            $this->line('  php artisan import:rekap-kebakaran "path/ke/file.xlsx"');

            return self::FAILURE;
        }

        // Deteksi tahun dari nama file
        $tahun = null;
        if ($tahunOption && is_numeric($tahunOption)) {
            $tahun = (int) $tahunOption;
        } else {
            if (preg_match('/(20[2-9][0-9])/', basename($filePath), $m)) {
                $tahun = (int) $m[1];
            } else {
                $tahun = 2024;
            }
        }

        $this->info("Memulai impor rekap objek kebakaran dari file: {$filePath}");
        $this->line('Sheet: '.($sheetName ?: '(Sheet Pertama)')." | Tahun: {$tahun}");

        try {
            $import = new RekapObjekKebakaranImport(
                tahun: $tahun,
                truncateFirst: $truncate,
                targetSheet: $sheetName
            );

            Excel::import($import, $filePath);

            $objekKeys = [
                'objek_rumah', 'objek_gudang', 'objek_ruko', 'objek_kantor', 'objek_sekolah',
                'objek_rumah_ibadah', 'objek_pasar', 'objek_kendaraan', 'objek_vital',
                'objek_sarana_kesehatan', 'objek_lahan_pohon', 'objek_gardu_listrik', 'objek_tpa_sampah',
            ];

            $count = DB::table('rekap_layanan')
                ->whereYear('tanggal', $tahun)
                ->whereIn('kategori', $objekKeys)
                ->count();

            $sum = DB::table('rekap_layanan')
                ->whereYear('tanggal', $tahun)
                ->whereIn('kategori', $objekKeys)
                ->sum('jumlah');

            $this->info("Impor berhasil! Tersimpan {$count} entri data rekap objek dengan total {$sum} unit kejadian untuk tahun {$tahun}.");

            // Tampilkan preview per kategori
            $summary = DB::table('rekap_layanan')
                ->whereYear('tanggal', $tahun)
                ->whereIn('kategori', $objekKeys)
                ->select('kategori', DB::raw('SUM(jumlah) as total'))
                ->groupBy('kategori')
                ->get()
                ->map(fn ($r) => [
                    'Kategori' => $r->kategori,
                    'Total Kejadian' => $r->total,
                ]);

            if ($summary->isNotEmpty()) {
                $this->table(['Kategori', 'Total Kejadian'], $summary->toArray());
            }

            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error('Gagal mengimpor data: '.$e->getMessage());

            return self::FAILURE;
        }
    }
}

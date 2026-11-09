<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FreshLaporanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laporan:fresh {--force : Jalankan pengosongan data tanpa konfirmasi interaktif}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengosongkan (truncate) seluruh data Laporan Kebakaran dan Penyelamatan serta mereset auto-increment ID';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if (! $this->option('force')) {
            $confirmed = $this->confirm(
                'PERINGATAN: Tindakan ini akan MENGHAPUS SEMUA DATA Laporan Kebakaran dan Penyelamatan serta mereset ID auto-increment ke 1. Lanjutkan?',
                false
            );

            if (! $confirmed) {
                $this->warn('Operasi pengosongan data dibatalkan.');

                return self::SUCCESS;
            }
        }

        $tables = [
            'lp_kategori_khusus',
            'lp_teknis_logistiks',
            'lp_dokumentasis',
            'laporan_penyelamatans',
        ];

        $this->info('Memulai pengosongan data Laporan Kebakaran & Penyelamatan...');

        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            foreach ($tables as $table) {
                DB::table($table)->truncate();
                $this->line(" [OK] Tabel <comment>{$table}</comment> berhasil dikosongkan (truncated).");
            }

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $this->newLine();
            $this->info('Sukses! Seluruh data Laporan Kebakaran dan Penyelamatan telah dikosongkan.');
            $this->info('Auto-increment ID pada tabel terkait telah di-reset ke 1.');

            return self::SUCCESS;
        } catch (\Throwable $e) {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            $this->error('Terjadi kesalahan saat mengosongkan data: '.$e->getMessage());

            return self::FAILURE;
        }
    }
}

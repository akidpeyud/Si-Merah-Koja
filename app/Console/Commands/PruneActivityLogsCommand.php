<?php

namespace App\Console\Commands;

use App\Services\ActivityRecapService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('activity:prune {--internal-months= : Retensi bulan log internal} {--pemohon-months= : Retensi bulan log pemohon} {--dry-run : Simulasikan tanpa menyimpan arsip atau menghapus log}')]
#[Description('Ringkas log activity_logs lama ke monthly_activity_stats lalu hapus baris detail yang melewati batas retensi')]
class PruneActivityLogsCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(ActivityRecapService $recapService): int
    {
        $internalOpt = $this->option('internal-months');
        $pemohonOpt = $this->option('pemohon-months');

        $internalMonths = ($internalOpt !== null && $internalOpt !== '') ? max(1, (int) $internalOpt) : null;
        $pemohonMonths = ($pemohonOpt !== null && $pemohonOpt !== '') ? max(1, (int) $pemohonOpt) : null;
        $dryRun = (bool) $this->option('dry-run');

        $result = $recapService->pruneAndSummarize(
            internalMonths: $internalMonths,
            pemohonMonths: $pemohonMonths,
            dryRun: $dryRun
        );

        $prefix = $dryRun ? '[DRY-RUN] ' : '';

        $this->info(sprintf(
            '%sInternal: %d log (%d bulan) sebelum %s %s.',
            $prefix,
            $result['internal']['deleted'],
            $result['internal']['months_affected'],
            $result['internal']['cutoff']->toDateTimeString(),
            $dryRun ? 'akan diringkas & dihapus' : 'diringkas & dihapus'
        ));

        $this->info(sprintf(
            '%sPemohon: %d log (%d bulan) sebelum %s %s.',
            $prefix,
            $result['pemohon']['deleted'],
            $result['pemohon']['months_affected'],
            $result['pemohon']['cutoff']->toDateTimeString(),
            $dryRun ? 'akan diringkas & dihapus' : 'diringkas & dihapus'
        ));

        $this->info("{$prefix}Total diproses: {$result['total_deleted']} baris.");

        return self::SUCCESS;
    }
}

<?php

namespace App\Console\Commands;

use App\Models\PageVisit;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PruneVisitsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visits:prune';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus log page_visits yang lebih tua dari masa retensi tanpa menghapus monthly_visit_stats';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $timezone = (string) config('visits.timezone', 'Asia/Jakarta');
        $retentionDays = max(1, (int) config('visits.retention_days', 7));
        $cooldownHours = max(1, (int) config('visits.cooldown_hours', 6));
        $cooldownDays = (int) ceil($cooldownHours / 24);

        $daysToKeep = max($retentionDays, $cooldownDays);
        $cutoff = Carbon::now($timezone)->subDays($daysToKeep);

        $deleted = PageVisit::query()
            ->where('visited_at', '<', $cutoff)
            ->delete();

        $this->info("Berhasil menghapus {$deleted} log kunjungan lama (sebelum {$cutoff->toDateTimeString()}).");

        return self::SUCCESS;
    }
}

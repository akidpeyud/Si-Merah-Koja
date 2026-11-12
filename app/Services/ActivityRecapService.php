<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\MonthlyActivityStat;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ActivityRecapService
{
    public const CATEGORY_INTERNAL = MonthlyActivityStat::CATEGORY_INTERNAL;

    public const CATEGORY_PEMOHON = MonthlyActivityStat::CATEGORY_PEMOHON;

    /**
     * Pemetaan modul permohonan pemohon ke key ringkasan UI/ekspor.
     *
     * @var array<string, string>
     */
    public const PEMOHON_MODULE_KEYS = [
        'Permohonan RPKBGL' => 'rpkbgl',
        'Permohonan SKK' => 'skk',
        'Permohonan Izin Keramaian' => 'izin',
        'Permohonan Sarana Damkar' => 'sarana',
        'Permohonan Edukasi & Sosialisasi' => 'edukasi',
    ];

    /**
     * Nama bulan Bahasa Indonesia.
     *
     * @var array<int, string>
     */
    public const MONTH_NAMES = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    /**
     * Timezone operasional untuk penentuan batas bulan riwayat aktivitas.
     */
    public function timezone(): string
    {
        return (string) config('activity.timezone', 'Asia/Jakarta');
    }

    /**
     * Timezone penyimpanan timestamp pada database aplikasi.
     */
    public function storageTimezone(): string
    {
        return (string) config('app.timezone', 'UTC');
    }

    /**
     * Konversi timestamp ke timezone penyimpanan database.
     */
    public function toStorageTimezone(Carbon $dateTime): Carbon
    {
        return $dateTime->copy()->timezone($this->storageTimezone());
    }

    /**
     * Ambil batas retensi bulan berdasarkan kategori ('internal' atau 'pemohon').
     */
    public function retentionMonths(string $category): int
    {
        return max(1, (int) config("activity.retention_months.{$category}", 6));
    }

    /**
     * Hitung batas awal bulan (dalam timezone operasional) yang tetap disimpan di activity_logs.
     * Log dengan created_at < batas ini akan diringkas ke rekap bulanan lalu dihapus.
     */
    public function cutoffForCategory(string $category, ?Carbon $reference = null, ?int $overrideMonths = null): Carbon
    {
        $tz = $this->timezone();
        $ref = $reference ? $reference->copy()->timezone($tz) : Carbon::now($tz);
        $months = $overrideMonths !== null ? max(1, $overrideMonths) : $this->retentionMonths($category);

        return $ref->startOfMonth()->subMonthsNoOverflow($months);
    }

    /**
     * Rentang waktu awal & akhir bulan dalam timezone penyimpanan database.
     *
     * @return array{0: Carbon, 1: Carbon}
     */
    public function monthStorageBounds(int $year, int $month): array
    {
        $start = Carbon::create($year, $month, 1, 0, 0, 0, $this->timezone())->startOfMonth();
        $end = $start->copy()->endOfMonth();

        return [$this->toStorageTimezone($start), $this->toStorageTimezone($end)];
    }

    /**
     * Rentang waktu awal & akhir tahun dalam timezone penyimpanan database.
     *
     * @return array{0: Carbon, 1: Carbon}
     */
    public function yearStorageBounds(int $year): array
    {
        $start = Carbon::create($year, 1, 1, 0, 0, 0, $this->timezone())->startOfYear();
        $end = $start->copy()->endOfYear();

        return [$this->toStorageTimezone($start), $this->toStorageTimezone($end)];
    }

    /**
     * Rentang waktu hari ini dalam timezone penyimpanan database.
     *
     * @return array{0: Carbon, 1: Carbon}
     */
    public function todayStorageBounds(): array
    {
        $now = Carbon::now($this->timezone());

        return [
            $this->toStorageTimezone($now->copy()->startOfDay()),
            $this->toStorageTimezone($now->copy()->endOfDay()),
        ];
    }

    /**
     * Terapkan filter kategori ('internal' atau 'pemohon') ke query ActivityLog.
     */
    public function applyCategoryScope(Builder $query, string $category): Builder
    {
        if ($category === self::CATEGORY_PEMOHON) {
            return $query->where('user_role', 'Pemohon');
        }

        return $query->where(function (Builder $q): void {
            $q->whereNull('user_role')->orWhere('user_role', '!=', 'Pemohon');
        });
    }

    /**
     * Tentukan kategori rekap dari user_role pada baris activity_logs.
     */
    public function resolveCategoryFromRole(?string $role): string
    {
        return $role === 'Pemohon' ? self::CATEGORY_PEMOHON : self::CATEGORY_INTERNAL;
    }

    /**
     * Label nama bulan dan tahun Bahasa Indonesia (misal: "November 2026").
     */
    public function formatPeriodLabel(int $year, int $month): string
    {
        $monthName = self::MONTH_NAMES[$month] ?? sprintf('%02d', $month);

        return "{$monthName} {$year}";
    }

    /**
     * Resolusi filter bulan/tahun/rentang tanggal pada halaman log detail.
     * Secara default menampilkan bulan & tahun berjalan saat halaman dibuka tanpa parameter periode.
     *
     * @return array{
     *     selected_month: string,
     *     selected_year: string,
     *     date_start: ?string,
     *     date_end: ?string,
     *     has_date_range: bool,
     *     is_default_current_month: bool,
     *     period_label: string
     * }
     */
    public function resolveDetailPeriod(Request $request): array
    {
        $now = Carbon::now($this->timezone());
        $dateStart = $request->filled('date_start') ? trim((string) $request->input('date_start')) : null;
        $dateEnd = $request->filled('date_end') ? trim((string) $request->input('date_end')) : null;
        $hasDateRange = $dateStart !== null || $dateEnd !== null;

        if ($hasDateRange) {
            $startText = $dateStart ? Carbon::parse($dateStart)->format('d M Y') : '...';
            $endText = $dateEnd ? Carbon::parse($dateEnd)->format('d M Y') : '...';

            return [
                'selected_month' => 'all',
                'selected_year' => 'all',
                'date_start' => $dateStart,
                'date_end' => $dateEnd,
                'has_date_range' => true,
                'is_default_current_month' => false,
                'period_label' => "Rentang Tanggal ({$startText} - {$endText})",
            ];
        }

        $hasExplicitPeriod = $request->has('month') || $request->has('year');

        $rawMonth = $hasExplicitPeriod
            ? (string) $request->input('month', 'all')
            : (string) $now->month;

        $rawYear = $hasExplicitPeriod
            ? (string) $request->input('year', 'all')
            : (string) $now->year;

        $selectedMonth = ($rawMonth !== 'all' && (int) $rawMonth >= 1 && (int) $rawMonth <= 12)
            ? (string) (int) $rawMonth
            : 'all';

        $selectedYear = ($rawYear !== 'all' && preg_match('/^\d{4}$/', $rawYear) === 1)
            ? $rawYear
            : 'all';

        $isDefaultCurrentMonth = ! $hasExplicitPeriod
            || ($selectedMonth === (string) $now->month && $selectedYear === (string) $now->year);

        if ($selectedYear !== 'all' && $selectedMonth !== 'all') {
            $periodLabel = $this->formatPeriodLabel((int) $selectedYear, (int) $selectedMonth);
        } elseif ($selectedYear !== 'all') {
            $periodLabel = "Tahun {$selectedYear}";
        } elseif ($selectedMonth !== 'all') {
            $periodName = self::MONTH_NAMES[(int) $selectedMonth] ?? $selectedMonth;
            $periodLabel = "Bulan {$periodName} (Semua Tahun)";
        } else {
            $periodLabel = 'Semua Log Detail Tersimpan';
        }

        return [
            'selected_month' => $selectedMonth,
            'selected_year' => $selectedYear,
            'date_start' => null,
            'date_end' => null,
            'has_date_range' => false,
            'is_default_current_month' => $isDefaultCurrentMonth,
            'period_label' => $periodLabel,
        ];
    }

    /**
     * Terapkan filter periode (bulan/tahun atau rentang tanggal) ke query ActivityLog.
     *
     * @param  array{selected_month: string, selected_year: string, date_start: ?string, date_end: ?string, has_date_range: bool}  $period
     */
    public function applyDetailPeriodToQuery(Builder $query, array $period): Builder
    {
        if ($period['has_date_range']) {
            if ($period['date_start'] !== null) {
                $startBound = $this->toStorageTimezone(
                    Carbon::parse($period['date_start'], $this->timezone())->startOfDay()
                );
                $query->where('created_at', '>=', $startBound);
            }

            if ($period['date_end'] !== null) {
                $endBound = $this->toStorageTimezone(
                    Carbon::parse($period['date_end'], $this->timezone())->endOfDay()
                );
                $query->where('created_at', '<=', $endBound);
            }

            return $query;
        }

        $selectedYear = $period['selected_year'];
        $selectedMonth = $period['selected_month'];

        if ($selectedYear !== 'all' && $selectedMonth !== 'all') {
            return $query->whereBetween(
                'created_at',
                $this->monthStorageBounds((int) $selectedYear, (int) $selectedMonth)
            );
        }

        if ($selectedYear !== 'all') {
            return $query->whereBetween(
                'created_at',
                $this->yearStorageBounds((int) $selectedYear)
            );
        }

        if ($selectedMonth !== 'all') {
            return $query->whereMonth('created_at', (int) $selectedMonth);
        }

        return $query;
    }

    /**
     * Ambil daftar tahun unik dari log detail kategori tertentu + tahun berjalan.
     *
     * @return array<int, int>
     */
    public function availableDetailYears(string $category): array
    {
        $tz = $this->timezone();
        $years = [Carbon::now($tz)->year];

        $query = $this->applyCategoryScope(ActivityLog::query(), $category)
            ->select(['id', 'created_at'])
            ->whereNotNull('created_at');

        $query->chunkById(1000, function (Collection $rows) use (&$years, $tz): void {
            foreach ($rows as $row) {
                if ($row->created_at) {
                    $years[] = $row->created_at->copy()->timezone($tz)->year;
                }
            }
        });

        $years = array_values(array_unique(array_map('intval', $years)));
        rsort($years);

        return $years;
    }

    /**
     * Hitung jumlah log lama yang siap diringkas & dihapus per kategori.
     *
     * @return array{
     *     internal: int,
     *     pemohon: int,
     *     total: int,
     *     internal_cutoff: Carbon,
     *     pemohon_cutoff: Carbon,
     *     internal_months: int,
     *     pemohon_months: int
     * }
     */
    public function countPrunable(?int $internalMonths = null, ?int $pemohonMonths = null, ?Carbon $reference = null): array
    {
        $internalCutoff = $this->cutoffForCategory(self::CATEGORY_INTERNAL, $reference, $internalMonths);
        $pemohonCutoff = $this->cutoffForCategory(self::CATEGORY_PEMOHON, $reference, $pemohonMonths);

        $internalCount = $this->applyCategoryScope(ActivityLog::query(), self::CATEGORY_INTERNAL)
            ->where('created_at', '<', $this->toStorageTimezone($internalCutoff))
            ->count();

        $pemohonCount = $this->applyCategoryScope(ActivityLog::query(), self::CATEGORY_PEMOHON)
            ->where('created_at', '<', $this->toStorageTimezone($pemohonCutoff))
            ->count();

        return [
            'internal' => $internalCount,
            'pemohon' => $pemohonCount,
            'total' => $internalCount + $pemohonCount,
            'internal_cutoff' => $internalCutoff,
            'pemohon_cutoff' => $pemohonCutoff,
            'internal_months' => $internalMonths !== null ? max(1, $internalMonths) : $this->retentionMonths(self::CATEGORY_INTERNAL),
            'pemohon_months' => $pemohonMonths !== null ? max(1, $pemohonMonths) : $this->retentionMonths(self::CATEGORY_PEMOHON),
        ];
    }

    /**
     * Ringkas log lama melewati masa retensi ke monthly_activity_stats lalu hapus baris detailnya secara atomik.
     *
     * @return array{
     *     dry_run: bool,
     *     internal: array{deleted: int, months_affected: int, cutoff: Carbon},
     *     pemohon: array{deleted: int, months_affected: int, cutoff: Carbon},
     *     total_deleted: int
     * }
     */
    public function pruneAndSummarize(
        ?int $internalMonths = null,
        ?int $pemohonMonths = null,
        bool $dryRun = false,
        ?Carbon $reference = null
    ): array {
        $internalCutoff = $this->cutoffForCategory(self::CATEGORY_INTERNAL, $reference, $internalMonths);
        $pemohonCutoff = $this->cutoffForCategory(self::CATEGORY_PEMOHON, $reference, $pemohonMonths);

        $internalResult = $this->pruneCategory(self::CATEGORY_INTERNAL, $internalCutoff, $dryRun);
        $pemohonResult = $this->pruneCategory(self::CATEGORY_PEMOHON, $pemohonCutoff, $dryRun);

        return [
            'dry_run' => $dryRun,
            'internal' => $internalResult,
            'pemohon' => $pemohonResult,
            'total_deleted' => $internalResult['deleted'] + $pemohonResult['deleted'],
        ];
    }

    /**
     * Ringkas dan hapus log lama untuk satu kategori secara bertahap per chunk.
     *
     * @return array{deleted: int, months_affected: int, cutoff: Carbon}
     */
    private function pruneCategory(string $category, Carbon $cutoffLocal, bool $dryRun): array
    {
        $cutoffStorage = $this->toStorageTimezone($cutoffLocal);
        $chunkSize = max(50, (int) config('activity.prune_chunk_size', 500));
        $tz = $this->timezone();
        $deletedCount = 0;
        $monthsTouched = [];

        if ($dryRun) {
            $this->applyCategoryScope(ActivityLog::query(), $category)
                ->where('created_at', '<', $cutoffStorage)
                ->select(['id', 'created_at'])
                ->chunkById($chunkSize, function (Collection $batch) use (&$deletedCount, &$monthsTouched, $tz, $cutoffLocal): void {
                    foreach ($batch as $row) {
                        $deletedCount++;
                        $dt = ($row->created_at ?? $cutoffLocal)->copy()->timezone($tz);
                        $monthsTouched["{$dt->year}-{$dt->month}"] = true;
                    }
                });

            return [
                'deleted' => $deletedCount,
                'months_affected' => count($monthsTouched),
                'cutoff' => $cutoffLocal,
            ];
        }

        while (true) {
            $processedInBatch = DB::transaction(function () use ($category, $cutoffStorage, $chunkSize, $tz, $cutoffLocal, &$monthsTouched): int {
                $batch = $this->applyCategoryScope(ActivityLog::query(), $category)
                    ->where('created_at', '<', $cutoffStorage)
                    ->orderBy('id')
                    ->limit($chunkSize)
                    ->select(['id', 'action', 'module', 'created_at'])
                    ->lockForUpdate()
                    ->get();

                if ($batch->isEmpty()) {
                    return 0;
                }

                $buckets = [];
                foreach ($batch as $row) {
                    $dt = ($row->created_at ?? $cutoffLocal)->copy()->timezone($tz);
                    $year = (int) $dt->year;
                    $month = (int) $dt->month;
                    $module = Str::limit(trim((string) ($row->module ?: 'Lainnya')), 100, '');
                    $action = Str::limit(trim((string) ($row->action ?: 'Proses')), 50, '');

                    $key = "{$year}|{$month}|{$module}|{$action}";
                    if (! isset($buckets[$key])) {
                        $buckets[$key] = [
                            'year' => $year,
                            'month' => $month,
                            'category' => $category,
                            'module' => $module,
                            'action' => $action,
                            'count' => 0,
                        ];
                    }

                    $buckets[$key]['count']++;
                    $monthsTouched["{$year}-{$month}"] = true;
                }

                $nowStorage = Carbon::now($this->storageTimezone());

                foreach ($buckets as $bucket) {
                    MonthlyActivityStat::query()->insertOrIgnore([
                        'year' => $bucket['year'],
                        'month' => $bucket['month'],
                        'category' => $bucket['category'],
                        'module' => $bucket['module'],
                        'action' => $bucket['action'],
                        'total' => 0,
                        'created_at' => $nowStorage,
                        'updated_at' => $nowStorage,
                    ]);

                    MonthlyActivityStat::query()
                        ->where('year', $bucket['year'])
                        ->where('month', $bucket['month'])
                        ->where('category', $bucket['category'])
                        ->where('module', $bucket['module'])
                        ->where('action', $bucket['action'])
                        ->increment('total', $bucket['count'], ['updated_at' => $nowStorage]);
                }

                ActivityLog::query()
                    ->whereIn('id', $batch->pluck('id')->all())
                    ->delete();

                return $batch->count();
            });

            if ($processedInBatch === 0) {
                break;
            }

            $deletedCount += $processedInBatch;
        }

        return [
            'deleted' => $deletedCount,
            'months_affected' => count($monthsTouched),
            'cutoff' => $cutoffLocal,
        ];
    }

    /**
     * Gabungkan arsip monthly_activity_stats dan log detail live dari activity_logs
     * untuk menyusun data Rekap Bulanan, Ekspor Excel, dan Ekspor PDF.
     *
     * @return array{
     *     monthly_internal: Collection<int, array<string, mixed>>,
     *     monthly_pemohon: Collection<int, array<string, mixed>>,
     *     module_details: Collection<int, array<string, mixed>>,
     *     available_years: array<int, int>,
     *     summary: array<string, int>
     * }
     */
    public function getRecapData(?int $year = null, string $category = 'all'): array
    {
        $normalizedCategory = in_array($category, [self::CATEGORY_INTERNAL, self::CATEGORY_PEMOHON], true)
            ? $category
            : 'all';

        $buckets = [];
        $yearsFound = [Carbon::now($this->timezone())->year];

        // 1. Kumpulkan seluruh tahun tersedia dari arsip + live
        foreach (MonthlyActivityStat::query()->select('year')->distinct()->pluck('year') as $y) {
            $yearsFound[] = (int) $y;
        }

        // 2. Ambil data arsip permanen sesuai filter
        $archiveQuery = MonthlyActivityStat::query();
        if ($year !== null) {
            $archiveQuery->where('year', $year);
        }
        if ($normalizedCategory !== 'all') {
            $archiveQuery->where('category', $normalizedCategory);
        }

        foreach ($archiveQuery->get() as $stat) {
            $this->accumulateRecapBucket(
                buckets: $buckets,
                year: (int) $stat->year,
                month: (int) $stat->month,
                category: (string) $stat->category,
                module: (string) $stat->module,
                action: (string) $stat->action,
                count: (int) $stat->total,
                isArchived: true
            );
        }

        // 3. Ambil data detail live yang masih tersisa di activity_logs (maks. 6 bulan terakhir)
        $tz = $this->timezone();
        $liveYearsQuery = ActivityLog::query()->select(['id', 'created_at'])->whereNotNull('created_at');
        $liveYearsQuery->chunkById(1000, function (Collection $rows) use (&$yearsFound, $tz): void {
            foreach ($rows as $row) {
                if ($row->created_at) {
                    $yearsFound[] = $row->created_at->copy()->timezone($tz)->year;
                }
            }
        });

        $liveQuery = ActivityLog::query()
            ->select(['id', 'user_role', 'action', 'module', 'created_at'])
            ->whereNotNull('created_at');

        if ($normalizedCategory !== 'all') {
            $this->applyCategoryScope($liveQuery, $normalizedCategory);
        }

        if ($year !== null) {
            $liveQuery->whereBetween('created_at', $this->yearStorageBounds($year));
        }

        $liveQuery->chunkById(1000, function (Collection $rows) use (&$buckets, $tz): void {
            foreach ($rows as $row) {
                $dt = $row->created_at->copy()->timezone($tz);
                $this->accumulateRecapBucket(
                    buckets: $buckets,
                    year: (int) $dt->year,
                    month: (int) $dt->month,
                    category: $this->resolveCategoryFromRole($row->user_role),
                    module: Str::limit(trim((string) ($row->module ?: 'Lainnya')), 100, ''),
                    action: Str::limit(trim((string) ($row->action ?: 'Proses')), 50, ''),
                    count: 1,
                    isArchived: false
                );
            }
        });

        $yearsFound = array_values(array_unique(array_map('intval', $yearsFound)));
        rsort($yearsFound);

        return $this->buildStructuredRecap($buckets, $yearsFound);
    }

    /**
     * Akumulasi jumlah per (tahun, bulan, kategori, modul, aksi).
     *
     * @param  array<string, array<string, mixed>>  $buckets
     */
    private function accumulateRecapBucket(
        array &$buckets,
        int $year,
        int $month,
        string $category,
        string $module,
        string $action,
        int $count,
        bool $isArchived
    ): void {
        if ($count <= 0) {
            return;
        }

        $key = "{$year}|{$month}|{$category}|{$module}|{$action}";
        if (! isset($buckets[$key])) {
            $buckets[$key] = [
                'year' => $year,
                'month' => $month,
                'period_label' => $this->formatPeriodLabel($year, $month),
                'category' => $category,
                'category_label' => $category === self::CATEGORY_PEMOHON ? 'Permohonan Surat (Pemohon)' : 'Aktivitas Internal',
                'module' => $module,
                'action' => $action,
                'archived_total' => 0,
                'live_total' => 0,
                'total' => 0,
            ];
        }

        if ($isArchived) {
            $buckets[$key]['archived_total'] += $count;
        } else {
            $buckets[$key]['live_total'] += $count;
        }
        $buckets[$key]['total'] += $count;
    }

    /**
     * Susun koleksi bulanan terpisah untuk Internal, Pemohon, dan Rincian Per Modul.
     *
     * @param  array<string, array<string, mixed>>  $buckets
     * @param  array<int, int>  $yearsFound
     * @return array{
     *     monthly_internal: Collection<int, array<string, mixed>>,
     *     monthly_pemohon: Collection<int, array<string, mixed>>,
     *     module_details: Collection<int, array<string, mixed>>,
     *     available_years: array<int, int>,
     *     summary: array<string, int>
     * }
     */
    private function buildStructuredRecap(array $buckets, array $yearsFound): array
    {
        $internalByMonth = [];
        $pemohonByMonth = [];
        $moduleDetails = [];

        $summary = [
            'total_all' => 0,
            'total_internal' => 0,
            'internal_tambah' => 0,
            'internal_ubah' => 0,
            'internal_hapus' => 0,
            'internal_lainnya' => 0,
            'total_pemohon' => 0,
            'archived_count' => 0,
            'live_count' => 0,
            'months_count' => 0,
        ];

        $distinctMonths = [];

        foreach ($buckets as $item) {
            $ymKey = sprintf('%04d-%02d', $item['year'], $item['month']);
            $distinctMonths[$ymKey] = true;

            $item['source'] = $this->resolveSourceLabel($item['archived_total'], $item['live_total']);
            $moduleDetails[] = $item;

            $summary['total_all'] += $item['total'];
            $summary['archived_count'] += $item['archived_total'];
            $summary['live_count'] += $item['live_total'];

            if ($item['category'] === self::CATEGORY_INTERNAL) {
                if (! isset($internalByMonth[$ymKey])) {
                    $internalByMonth[$ymKey] = [
                        'year' => $item['year'],
                        'month' => $item['month'],
                        'period_label' => $item['period_label'],
                        'tambah' => 0,
                        'ubah' => 0,
                        'hapus' => 0,
                        'lainnya' => 0,
                        'total' => 0,
                        'archived_total' => 0,
                        'live_total' => 0,
                        'modules' => [],
                    ];
                }

                $act = strtolower($item['action']);
                if (in_array($act, ['tambah', 'ubah', 'hapus'], true)) {
                    $internalByMonth[$ymKey][$act] += $item['total'];
                    $summary["internal_{$act}"] += $item['total'];
                } else {
                    $internalByMonth[$ymKey]['lainnya'] += $item['total'];
                    $summary['internal_lainnya'] += $item['total'];
                }

                $internalByMonth[$ymKey]['total'] += $item['total'];
                $internalByMonth[$ymKey]['archived_total'] += $item['archived_total'];
                $internalByMonth[$ymKey]['live_total'] += $item['live_total'];
                $internalByMonth[$ymKey]['modules'][$item['module']] = ($internalByMonth[$ymKey]['modules'][$item['module']] ?? 0) + $item['total'];

                $summary['total_internal'] += $item['total'];
            } else {
                if (! isset($pemohonByMonth[$ymKey])) {
                    $pemohonByMonth[$ymKey] = [
                        'year' => $item['year'],
                        'month' => $item['month'],
                        'period_label' => $item['period_label'],
                        'rpkbgl' => 0,
                        'skk' => 0,
                        'izin' => 0,
                        'sarana' => 0,
                        'edukasi' => 0,
                        'lainnya' => 0,
                        'total' => 0,
                        'archived_total' => 0,
                        'live_total' => 0,
                    ];
                }

                $moduleKey = self::PEMOHON_MODULE_KEYS[$item['module']] ?? 'lainnya';
                $pemohonByMonth[$ymKey][$moduleKey] += $item['total'];
                $pemohonByMonth[$ymKey]['total'] += $item['total'];
                $pemohonByMonth[$ymKey]['archived_total'] += $item['archived_total'];
                $pemohonByMonth[$ymKey]['live_total'] += $item['live_total'];

                $summary['total_pemohon'] += $item['total'];
            }
        }

        $summary['months_count'] = count($distinctMonths);

        krsort($internalByMonth);
        foreach ($internalByMonth as &$row) {
            arsort($row['modules']);
            $topModules = [];
            foreach (array_slice($row['modules'], 0, 3, true) as $modName => $modTotal) {
                $topModules[] = ['module' => $modName, 'total' => $modTotal];
            }
            $row['top_modules'] = $topModules;
            $row['source'] = $this->resolveSourceLabel($row['archived_total'], $row['live_total']);
            unset($row['modules']);
        }
        unset($row);

        krsort($pemohonByMonth);
        foreach ($pemohonByMonth as &$row) {
            $row['source'] = $this->resolveSourceLabel($row['archived_total'], $row['live_total']);
        }
        unset($row);

        usort($moduleDetails, static function (array $a, array $b): int {
            return [$b['year'], $b['month'], $a['category'], $b['total'], $a['module']]
                <=> [$a['year'], $a['month'], $b['category'], $a['total'], $b['module']];
        });

        return [
            'monthly_internal' => collect(array_values($internalByMonth)),
            'monthly_pemohon' => collect(array_values($pemohonByMonth)),
            'module_details' => collect($moduleDetails),
            'available_years' => $yearsFound,
            'summary' => $summary,
        ];
    }

    /**
     * Label asal data rekap (Arsip Permanen / Live / Campuran).
     */
    private function resolveSourceLabel(int $archivedTotal, int $liveTotal): string
    {
        if ($archivedTotal > 0 && $liveTotal > 0) {
            return 'Arsip + Live';
        }

        if ($archivedTotal > 0) {
            return 'Arsip Permanen';
        }

        return 'Data Live';
    }
}

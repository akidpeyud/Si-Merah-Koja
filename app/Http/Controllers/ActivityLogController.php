<?php

namespace App\Http\Controllers;

use App\Exports\RekapAktivitasBulananExport;
use App\Models\ActivityLog;
use App\Services\ActivityRecapService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ActivityLogController extends Controller
{
    public function __construct(
        private readonly ActivityRecapService $recapService
    ) {}

    /**
     * Menampilkan daftar riwayat aktivitas operasional internal (pegawai).
     */
    public function index(Request $request): View
    {
        $category = ActivityRecapService::CATEGORY_INTERNAL;
        $period = $this->recapService->resolveDetailPeriod($request);

        $query = $this->buildFilteredLogsQuery($request, $category, $period, withUser: true)
            ->latest();

        $logs = $query->paginate(20)->withQueryString();

        $modules = $this->recapService->applyCategoryScope(ActivityLog::query(), $category)
            ->select('module')
            ->distinct()
            ->whereNotNull('module')
            ->orderBy('module')
            ->pluck('module');

        $periodStatsQuery = fn (): Builder => $this->recapService->applyDetailPeriodToQuery(
            $this->recapService->applyCategoryScope(ActivityLog::query(), $category),
            $period
        );

        $stats = [
            'total' => $periodStatsQuery()->count(),
            'today' => $this->recapService->applyCategoryScope(ActivityLog::query(), $category)
                ->whereBetween('created_at', $this->recapService->todayStorageBounds())
                ->count(),
            'tambah' => $periodStatsQuery()->where('action', 'Tambah')->count(),
            'ubah' => $periodStatsQuery()->where('action', 'Ubah')->count(),
            'hapus' => $periodStatsQuery()->where('action', 'Hapus')->count(),
        ];

        $availableYears = $this->recapService->availableDetailYears($category);
        $monthOptions = ActivityRecapService::MONTH_NAMES;
        $retentionMonths = $this->recapService->retentionMonths($category);

        return view('internal.riwayat_aktivitas', compact(
            'logs',
            'modules',
            'stats',
            'period',
            'availableYears',
            'monthOptions',
            'retentionMonths'
        ));
    }

    /**
     * Menampilkan daftar riwayat penginputan permohonan surat oleh pemohon.
     */
    public function pemohon(Request $request): View
    {
        $category = ActivityRecapService::CATEGORY_PEMOHON;
        $period = $this->recapService->resolveDetailPeriod($request);

        $query = $this->buildFilteredLogsQuery($request, $category, $period, withUser: false)
            ->latest();

        $logs = $query->paginate(20)->withQueryString();

        $modules = $this->recapService->applyCategoryScope(ActivityLog::query(), $category)
            ->select('module')
            ->distinct()
            ->whereNotNull('module')
            ->orderBy('module')
            ->pluck('module');

        $periodStatsQuery = fn (): Builder => $this->recapService->applyDetailPeriodToQuery(
            $this->recapService->applyCategoryScope(ActivityLog::query(), $category),
            $period
        );

        $stats = [
            'total' => $periodStatsQuery()->count(),
            'today' => $this->recapService->applyCategoryScope(ActivityLog::query(), $category)
                ->whereBetween('created_at', $this->recapService->todayStorageBounds())
                ->count(),
            'rpkbgl' => $periodStatsQuery()->where('module', 'Permohonan RPKBGL')->count(),
            'skk' => $periodStatsQuery()->where('module', 'Permohonan SKK')->count(),
            'izin' => $periodStatsQuery()->where('module', 'Permohonan Izin Keramaian')->count(),
            'sarana' => $periodStatsQuery()->where('module', 'Permohonan Sarana Damkar')->count(),
            'edukasi' => $periodStatsQuery()->where('module', 'Permohonan Edukasi & Sosialisasi')->count(),
        ];

        $availableYears = $this->recapService->availableDetailYears($category);
        $monthOptions = ActivityRecapService::MONTH_NAMES;
        $retentionMonths = $this->recapService->retentionMonths($category);

        return view('internal.riwayat_aktivitas_pemohon', compact(
            'logs',
            'modules',
            'stats',
            'period',
            'availableYears',
            'monthOptions',
            'retentionMonths'
        ));
    }

    /**
     * Menampilkan halaman Rekap Bulanan Riwayat Aktivitas (Internal & Pemohon terpisah).
     */
    public function rekap(Request $request): View
    {
        [$selectedYear, $yearFilter, $selectedCategory] = $this->resolveRecapFilters($request);

        $recap = $this->recapService->getRecapData($yearFilter, $selectedCategory);
        $prunable = $this->recapService->countPrunable();
        $retentionInternal = $this->recapService->retentionMonths(ActivityRecapService::CATEGORY_INTERNAL);
        $retentionPemohon = $this->recapService->retentionMonths(ActivityRecapService::CATEGORY_PEMOHON);

        return view('internal.riwayat_aktivitas_rekap', compact(
            'recap',
            'prunable',
            'selectedYear',
            'selectedCategory',
            'retentionInternal',
            'retentionPemohon'
        ));
    }

    /**
     * Ekspor Rekap Bulanan Riwayat Aktivitas ke file Excel (.xlsx).
     */
    public function exportRekapExcel(Request $request): BinaryFileResponse
    {
        [, $yearFilter, $selectedCategory] = $this->resolveRecapFilters($request);
        $recap = $this->recapService->getRecapData($yearFilter, $selectedCategory);

        $suffixTahun = $yearFilter ? "_{$yearFilter}" : '_Semua_Tahun';
        $suffixKategori = $selectedCategory !== 'all' ? '_'.ucfirst($selectedCategory) : '';

        return Excel::download(
            new RekapAktivitasBulananExport(
                monthlyInternal: $recap['monthly_internal'],
                monthlyPemohon: $recap['monthly_pemohon'],
                moduleDetails: $recap['module_details'],
                category: $selectedCategory
            ),
            "Rekap_Bulanan_Riwayat_Aktivitas{$suffixTahun}{$suffixKategori}.xlsx"
        );
    }

    /**
     * Ekspor Rekap Bulanan Riwayat Aktivitas ke file PDF.
     */
    public function exportRekapPdf(Request $request): Response
    {
        [, $yearFilter, $selectedCategory] = $this->resolveRecapFilters($request);
        $recap = $this->recapService->getRecapData($yearFilter, $selectedCategory);

        $labelTahun = $yearFilter ? "TAHUN {$yearFilter}" : 'SEMUA TAHUN';
        $labelKategori = match ($selectedCategory) {
            ActivityRecapService::CATEGORY_INTERNAL => 'AKTIVITAS INTERNAL PEGAWAI',
            ActivityRecapService::CATEGORY_PEMOHON => 'PERMOHONAN SURAT PEMOHON',
            default => 'INTERNAL & PERMOHONAN PEMOHON',
        };

        $nowLocal = Carbon::now($this->recapService->timezone())->locale('id');
        $printedAt = $nowLocal->translatedFormat('d F Y H:i');
        $printedDate = $nowLocal->translatedFormat('d F Y');
        $printedBy = (string) (Auth::user()?->nama_lengkap ?? Auth::user()?->name ?? 'Petugas');

        $pdf = Pdf::loadView('internal.riwayat_aktivitas_rekap_pdf', compact(
            'recap',
            'selectedCategory',
            'labelTahun',
            'labelKategori',
            'printedAt',
            'printedDate',
            'printedBy'
        ))->setPaper('a4', 'landscape');

        $suffixTahun = $yearFilter ? "_{$yearFilter}" : '_Semua_Tahun';
        $suffixKategori = $selectedCategory !== 'all' ? '_'.ucfirst($selectedCategory) : '';

        return $pdf->download("Rekap_Bulanan_Riwayat_Aktivitas{$suffixTahun}{$suffixKategori}.pdf");
    }

    /**
     * Ringkas dan arsipkan log detail yang melewati batas retensi (khusus Super User).
     */
    public function prune(): RedirectResponse
    {
        if (! Auth::user()?->hasRole('Super User')) {
            abort(403, 'Akses ditolak. Hanya Super User yang dapat mengarsipkan log aktivitas.');
        }

        $result = $this->recapService->pruneAndSummarize();

        if ($result['total_deleted'] === 0) {
            $internalMonths = $this->recapService->retentionMonths(ActivityRecapService::CATEGORY_INTERNAL);
            $pemohonMonths = $this->recapService->retentionMonths(ActivityRecapService::CATEGORY_PEMOHON);

            return back()->with(
                'success',
                "Tidak ada log detail yang melewati masa retensi ({$internalMonths} bulan internal / {$pemohonMonths} bulan pemohon)."
            );
        }

        return back()->with(
            'success',
            sprintf(
                'Berhasil meringkas & mengarsipkan %d log internal serta %d log pemohon ke Rekap Bulanan.',
                $result['internal']['deleted'],
                $result['pemohon']['deleted']
            )
        );
    }

    /**
     * Bangun query filter standar untuk halaman log detail internal maupun pemohon.
     *
     * @param  array{selected_month: string, selected_year: string, date_start: ?string, date_end: ?string, has_date_range: bool}  $period
     */
    private function buildFilteredLogsQuery(Request $request, string $category, array $period, bool $withUser): Builder
    {
        $query = $withUser ? ActivityLog::with('user') : ActivityLog::query();
        $this->recapService->applyCategoryScope($query, $category);

        if ($request->filled('q')) {
            $keyword = trim((string) $request->input('q'));
            $query->where(function (Builder $q) use ($keyword): void {
                $q->where('description', 'like', "%{$keyword}%")
                    ->orWhere('user_name', 'like', "%{$keyword}%")
                    ->orWhere('module', 'like', "%{$keyword}%")
                    ->orWhere('ip_address', 'like', "%{$keyword}%");
            });
        }

        if ($withUser && $request->filled('action')) {
            $query->where('action', $request->input('action'));
        }

        if ($request->filled('module')) {
            $query->where('module', $request->input('module'));
        }

        return $this->recapService->applyDetailPeriodToQuery($query, $period);
    }

    /**
     * Resolusi filter tahun & kategori untuk halaman serta ekspor Rekap Bulanan.
     *
     * @return array{0: string, 1: ?int, 2: string}
     */
    private function resolveRecapFilters(Request $request): array
    {
        $rawYear = trim((string) $request->input('year', 'all'));
        $selectedYear = ($rawYear !== 'all' && preg_match('/^\d{4}$/', $rawYear) === 1) ? $rawYear : 'all';
        $yearFilter = $selectedYear !== 'all' ? (int) $selectedYear : null;

        $rawCategory = trim((string) $request->input('category', 'all'));
        $selectedCategory = in_array(
            $rawCategory,
            [ActivityRecapService::CATEGORY_INTERNAL, ActivityRecapService::CATEGORY_PEMOHON],
            true
        ) ? $rawCategory : 'all';

        return [$selectedYear, $yearFilter, $selectedCategory];
    }
}

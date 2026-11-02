<?php

namespace App\Http\Controllers;

use App\Services\VisitCounter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function __construct(public VisitCounter $visitCounter) {}

    /**
     * Catat kunjungan halaman dan kembalikan total kunjungan bulan berjalan.
     */
    public function store(Request $request, string $page): JsonResponse
    {
        abort_unless($this->visitCounter->isAllowedPage($page), 404);

        $total = $this->visitCounter->recordVisit($request, $page);
        $period = $this->visitCounter->currentPeriod();

        $data = [
            'page' => $page,
            'year' => $period['year'],
            'month' => $period['month'],
            'total' => $total,
        ];

        if ($request->boolean('stats') || $request->has('stats') || $request->header('X-Detailed-Stats')) {
            $data['stats'] = $this->visitCounter->getStats($page);
        }

        return $this->noStoreJson($data);
    }

    /**
     * Baca total kunjungan bulan berjalan tanpa menambah hitungan.
     */
    public function show(Request $request, string $page): JsonResponse
    {
        abort_unless($this->visitCounter->isAllowedPage($page), 404);

        $total = $this->visitCounter->getMonthlyTotal($page);
        $period = $this->visitCounter->currentPeriod();

        $data = [
            'page' => $page,
            'year' => $period['year'],
            'month' => $period['month'],
            'total' => $total,
        ];

        if ($request->boolean('stats') || $request->has('stats') || $request->header('X-Detailed-Stats')) {
            $data['stats'] = $this->visitCounter->getStats($page);
        }

        return $this->noStoreJson($data);
    }

    /**
     * Ambil riwayat total kunjungan per bulan (khusus user terautentikasi).
     */
    public function history(string $page): JsonResponse
    {
        abort_unless($this->visitCounter->isAllowedPage($page), 404);

        $history = $this->visitCounter->getHistory($page);

        return $this->noStoreJson([
            'page' => $page,
            'history' => $history,
        ]);
    }

    /**
     * Buat response JSON dengan header Cache-Control: no-store.
     *
     * @param  array<string, mixed>  $data
     */
    private function noStoreJson(array $data, int $status = 200): JsonResponse
    {
        return response()
            ->json($data, $status)
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
    }
}

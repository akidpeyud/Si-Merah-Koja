<?php

namespace App\Services;

use App\Models\MonthlyVisitStat;
use App\Models\PageVisit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class VisitCounter
{
    /**
     * Periksa apakah nama halaman termasuk dalam daftar whitelist.
     */
    public function isAllowedPage(string $page): bool
    {
        $allowed = (array) config('visits.allowed_pages', ['simerahkoja']);

        return in_array($page, $allowed, true);
    }

    /**
     * Catat kunjungan unik (jika memenuhi syarat) dan kembalikan total bulan berjalan.
     */
    public function recordVisit(Request $request, string $page): int
    {
        $salt = $this->getIpSalt();
        $userAgent = trim((string) $request->userAgent());
        $ip = trim((string) $request->ip());

        if ($ip === '' || $userAgent === '' || $this->isBot($userAgent)) {
            return $this->getMonthlyTotal($page);
        }

        $ipHash = $this->hashIp($ip, $salt);
        $lockKey = "visit_lock:{$page}:{$ipHash}";

        return (int) Cache::lock($lockKey, 5)->block(3, function () use ($page, $ipHash, $userAgent): int {
            $now = Carbon::now($this->timezone());
            $cooldownHours = max(1, (int) config('visits.cooldown_hours', 6));
            $cutoff = $now->copy()->subHours($cooldownHours);

            $recentlyVisited = PageVisit::query()
                ->where('page', $page)
                ->where('ip_hash', $ipHash)
                ->where('visited_at', '>=', $cutoff)
                ->exists();

            if (! $recentlyVisited) {
                DB::transaction(function () use ($page, $ipHash, $userAgent, $now): void {
                    PageVisit::query()->create([
                        'page' => $page,
                        'ip_hash' => $ipHash,
                        'user_agent' => Str::limit($userAgent, 255, ''),
                        'visited_at' => $now,
                    ]);

                    $year = (int) $now->year;
                    $month = (int) $now->month;

                    MonthlyVisitStat::query()->insertOrIgnore([
                        'page' => $page,
                        'year' => $year,
                        'month' => $month,
                        'total' => 0,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);

                    MonthlyVisitStat::query()
                        ->where('page', $page)
                        ->where('year', $year)
                        ->where('month', $month)
                        ->increment('total', 1, ['updated_at' => $now]);
                });
            }

            return $this->getMonthlyTotal($page);
        });
    }

    /**
     * Ambil total kunjungan pada bulan berjalan.
     */
    public function getMonthlyTotal(string $page): int
    {
        $now = Carbon::now($this->timezone());

        $total = MonthlyVisitStat::query()
            ->where('page', $page)
            ->where('year', (int) $now->year)
            ->where('month', (int) $now->month)
            ->value('total');

        return (int) ($total ?? 0);
    }

    /**
     * Ambil riwayat total kunjungan per bulan (terbaru lebih dulu).
     *
     * @return Collection<int, MonthlyVisitStat>
     */
    public function getHistory(string $page): Collection
    {
        return MonthlyVisitStat::query()
            ->where('page', $page)
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get(['page', 'year', 'month', 'total']);
    }

    /**
     * Dapatkan tahun dan bulan saat ini sesuai timezone kunjungan.
     *
     * @return array{year: int, month: int}
     */
    public function currentPeriod(): array
    {
        $now = Carbon::now($this->timezone());

        return [
            'year' => (int) $now->year,
            'month' => (int) $now->month,
        ];
    }

    /**
     * Buat hash HMAC-SHA256 dari alamat IP.
     */
    public function hashIp(string $ip, ?string $salt = null): string
    {
        $key = $salt ?? $this->getIpSalt();

        return hash_hmac('sha256', $ip, $key);
    }

    /**
     * Periksa apakah User-Agent termasuk bot atau crawler.
     */
    public function isBot(string $userAgent): bool
    {
        if (trim($userAgent) === '') {
            return true;
        }

        $uaLower = strtolower($userAgent);
        $keywords = (array) config('visits.bot_keywords', []);

        foreach ($keywords as $keyword) {
            $keyword = strtolower(trim((string) $keyword));
            if ($keyword !== '' && str_contains($uaLower, $keyword)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Ambil dan validasi VISIT_IP_SALT dari konfigurasi.
     */
    private function getIpSalt(): string
    {
        $salt = trim((string) config('visits.ip_salt', ''));

        if ($salt === '') {
            throw new RuntimeException('VISIT_IP_SALT belum dikonfigurasi pada environment.');
        }

        return $salt;
    }

    /**
     * Ambil timezone perhitungan kunjungan.
     */
    private function timezone(): string
    {
        return (string) config('visits.timezone', 'Asia/Jakarta');
    }
}

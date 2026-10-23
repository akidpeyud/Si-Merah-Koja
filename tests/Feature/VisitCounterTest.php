<?php

namespace Tests\Feature;

use App\Models\MonthlyVisitStat;
use App\Models\PageVisit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use RuntimeException;
use Tests\TestCase;

class VisitCounterTest extends TestCase
{
    private const BROWSER_UA = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36';

    protected function setUp(): void
    {
        parent::setUp();

        $this->prepareTables();

        Config::set('visits.ip_salt', 'test-secret-ip-salt-simerahkoja-2026');
        Config::set('visits.cooldown_hours', 6);
        Config::set('visits.timezone', 'Asia/Jakarta');
        Config::set('visits.allowed_pages', ['simerahkoja']);
        Config::set('visits.rate_limit_per_minute', 30);
        Config::set('visits.retention_days', 7);

        Carbon::setTestNow(Carbon::create(2026, 10, 23, 9, 0, 0, 'Asia/Jakarta'));
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    private function prepareTables(): void
    {
        Schema::dropIfExists('page_visits');
        Schema::dropIfExists('monthly_visit_stats');

        $pageVisitsMigration = require base_path('database/migrations/2026_10_23_000001_create_page_visits_table.php');
        $pageVisitsMigration->up();

        $monthlyStatsMigration = require base_path('database/migrations/2026_10_23_000002_create_monthly_visit_stats_table.php');
        $monthlyStatsMigration->up();

        if (! Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table): void {
                $table->id();
                $table->string('nama_lengkap');
                $table->string('email')->unique();
                $table->string('nomor_pegawai')->unique();
                $table->string('role')->default('pegawai');
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    public function test_new_ip_increments_monthly_total(): void
    {
        $response1 = $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.10'])
            ->withHeaders(['User-Agent' => self::BROWSER_UA])
            ->postJson('/api/visits/simerahkoja');

        $response1->assertOk()
            ->assertHeader('Cache-Control', 'max-age=0, must-revalidate, no-cache, no-store, private')
            ->assertExactJson([
                'page' => 'simerahkoja',
                'year' => 2026,
                'month' => 10,
                'total' => 1,
            ]);

        $response2 = $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.11'])
            ->withHeaders(['User-Agent' => self::BROWSER_UA])
            ->postJson('/api/visits/simerahkoja');

        $response2->assertOk()
            ->assertJsonPath('total', 2);
    }

    public function test_same_ip_within_cooldown_does_not_increment_total(): void
    {
        $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.20'])
            ->withHeaders(['User-Agent' => self::BROWSER_UA])
            ->postJson('/api/visits/simerahkoja')
            ->assertOk()
            ->assertJsonPath('total', 1);

        // 3 jam kemudian (masih dalam cooldown 6 jam)
        Carbon::setTestNow(Carbon::create(2026, 10, 23, 12, 0, 0, 'Asia/Jakarta'));

        $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.20'])
            ->withHeaders(['User-Agent' => self::BROWSER_UA])
            ->postJson('/api/visits/simerahkoja')
            ->assertOk()
            ->assertJsonPath('total', 1);

        // 5 jam 59 menit dari kunjungan pertama (harus tetap tidak dihitung; cooldown dihitung dari kunjungan terakhir yang DIHITUNG)
        Carbon::setTestNow(Carbon::create(2026, 10, 23, 14, 59, 0, 'Asia/Jakarta'));

        $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.20'])
            ->withHeaders(['User-Agent' => self::BROWSER_UA])
            ->postJson('/api/visits/simerahkoja')
            ->assertOk()
            ->assertJsonPath('total', 1);

        $this->assertSame(1, PageVisit::query()->count());
    }

    public function test_same_ip_after_cooldown_increments_total(): void
    {
        $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.30'])
            ->withHeaders(['User-Agent' => self::BROWSER_UA])
            ->postJson('/api/visits/simerahkoja')
            ->assertOk()
            ->assertJsonPath('total', 1);

        // Tepat lewat 6 jam 1 detik kemudian
        Carbon::setTestNow(Carbon::create(2026, 10, 23, 15, 0, 1, 'Asia/Jakarta'));

        $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.30'])
            ->withHeaders(['User-Agent' => self::BROWSER_UA])
            ->postJson('/api/visits/simerahkoja')
            ->assertOk()
            ->assertJsonPath('total', 2);

        $this->assertSame(2, PageVisit::query()->count());
    }

    public function test_bot_and_empty_user_agents_are_ignored(): void
    {
        $botAgents = [
            'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
            'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)',
            'curl/8.4.0',
            'Wget/1.21.4',
            'python-requests/2.31.0',
            '',
        ];

        foreach ($botAgents as $index => $ua) {
            $this->withServerVariables(['REMOTE_ADDR' => '198.51.100.'.($index + 1)])
                ->withHeaders(['User-Agent' => $ua])
                ->postJson('/api/visits/simerahkoja')
                ->assertOk()
                ->assertJsonPath('total', 0);
        }

        $this->assertSame(0, PageVisit::query()->count());
        $this->assertSame(0, MonthlyVisitStat::query()->count());
    }

    public function test_month_rollover_starts_from_zero_and_keeps_previous_month_data(): void
    {
        // Bulan Oktober 2026: 2 kunjungan unik
        $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.41'])
            ->withHeaders(['User-Agent' => self::BROWSER_UA])
            ->postJson('/api/visits/simerahkoja')
            ->assertOk()
            ->assertJsonPath('total', 1);

        $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.42'])
            ->withHeaders(['User-Agent' => self::BROWSER_UA])
            ->postJson('/api/visits/simerahkoja')
            ->assertOk()
            ->assertJsonPath('total', 2);

        // Masuk awal bulan November 2026 (00:05 WIB)
        Carbon::setTestNow(Carbon::create(2026, 11, 1, 0, 5, 0, 'Asia/Jakarta'));

        // Cek GET sebelum ada kunjungan di bulan baru -> harus 0
        $this->getJson('/api/visits/simerahkoja')
            ->assertOk()
            ->assertExactJson([
                'page' => 'simerahkoja',
                'year' => 2026,
                'month' => 11,
                'total' => 0,
            ]);

        // Kunjungan pertama di bulan November -> mulai dari 1
        $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.43'])
            ->withHeaders(['User-Agent' => self::BROWSER_UA])
            ->postJson('/api/visits/simerahkoja')
            ->assertOk()
            ->assertExactJson([
                'page' => 'simerahkoja',
                'year' => 2026,
                'month' => 11,
                'total' => 1,
            ]);

        // Pastikan data bulan Oktober 2026 tetap tersimpan utuh di database
        $octoberStat = MonthlyVisitStat::query()
            ->where('page', 'simerahkoja')
            ->where('year', 2026)
            ->where('month', 10)
            ->first();

        $novemberStat = MonthlyVisitStat::query()
            ->where('page', 'simerahkoja')
            ->where('year', 2026)
            ->where('month', 11)
            ->first();

        $this->assertNotNull($octoberStat);
        $this->assertSame(2, $octoberStat->total);
        $this->assertNotNull($novemberStat);
        $this->assertSame(1, $novemberStat->total);
    }

    public function test_raw_ip_is_never_stored_in_database(): void
    {
        $rawIp = '203.0.113.99';

        $this->withServerVariables(['REMOTE_ADDR' => $rawIp])
            ->withHeaders(['User-Agent' => self::BROWSER_UA])
            ->postJson('/api/visits/simerahkoja')
            ->assertOk();

        $visit = PageVisit::query()->first();
        $this->assertNotNull($visit);
        $this->assertNotSame($rawIp, $visit->ip_hash);
        $this->assertStringNotContainsString($rawIp, $visit->ip_hash);
        $this->assertSame(64, strlen($visit->ip_hash));
        $this->assertSame(
            hash_hmac('sha256', $rawIp, (string) config('visits.ip_salt')),
            $visit->ip_hash
        );
    }

    public function test_page_outside_whitelist_returns_404(): void
    {
        $this->withHeaders(['User-Agent' => self::BROWSER_UA])
            ->postJson('/api/visits/halaman-palsu')
            ->assertNotFound();

        $this->getJson('/api/visits/halaman-palsu')
            ->assertNotFound();

        $this->assertSame(0, PageVisit::query()->count());
        $this->assertSame(0, MonthlyVisitStat::query()->count());
    }

    public function test_rate_limit_returns_429_when_exceeded(): void
    {
        Config::set('visits.rate_limit_per_minute', 3);
        $ip = '203.0.113.77';
        RateLimiter::clear($ip);

        for ($i = 0; $i < 3; $i++) {
            $this->withServerVariables(['REMOTE_ADDR' => $ip])
                ->withHeaders(['User-Agent' => self::BROWSER_UA])
                ->postJson('/api/visits/simerahkoja')
                ->assertOk();
        }

        $this->withServerVariables(['REMOTE_ADDR' => $ip])
            ->withHeaders(['User-Agent' => self::BROWSER_UA])
            ->postJson('/api/visits/simerahkoja')
            ->assertStatus(429);
    }

    public function test_get_endpoint_never_increments_total(): void
    {
        $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.88'])
            ->withHeaders(['User-Agent' => self::BROWSER_UA])
            ->getJson('/api/visits/simerahkoja')
            ->assertOk()
            ->assertJsonPath('total', 0);

        $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.88'])
            ->withHeaders(['User-Agent' => self::BROWSER_UA])
            ->getJson('/api/visits/simerahkoja')
            ->assertOk()
            ->assertJsonPath('total', 0);

        $this->assertSame(0, PageVisit::query()->count());
        $this->assertSame(0, MonthlyVisitStat::query()->count());
    }

    public function test_history_endpoint_rejects_unauthenticated_users_and_allows_authenticated_users(): void
    {
        MonthlyVisitStat::query()->create([
            'page' => 'simerahkoja',
            'year' => 2026,
            'month' => 9,
            'total' => 45,
        ]);

        MonthlyVisitStat::query()->create([
            'page' => 'simerahkoja',
            'year' => 2026,
            'month' => 10,
            'total' => 128,
        ]);

        // Tanpa login -> ditolak (401 pada request JSON)
        $this->getJson('/api/visits/simerahkoja/history')
            ->assertUnauthorized();

        // Dengan user login -> diizinkan
        $user = User::query()->create([
            'nama_lengkap' => 'Petugas Uji',
            'email' => 'petugas-uji@simerahkoja.test',
            'nomor_pegawai' => '199901012026011001',
            'role' => 'Operator',
            'password' => Hash::make('password123'),
        ]);

        $this->actingAs($user)
            ->getJson('/api/visits/simerahkoja/history')
            ->assertOk()
            ->assertJsonPath('page', 'simerahkoja')
            ->assertJsonCount(2, 'history')
            ->assertJsonPath('history.0.month', 10)
            ->assertJsonPath('history.0.total', 128)
            ->assertJsonPath('history.1.month', 9)
            ->assertJsonPath('history.1.total', 45);
    }

    public function test_visits_prune_command_only_deletes_old_page_visits_and_keeps_monthly_stats(): void
    {
        // Log kunjungan 10 hari lalu (harus terhapus)
        PageVisit::query()->create([
            'page' => 'simerahkoja',
            'ip_hash' => str_repeat('a', 64),
            'user_agent' => self::BROWSER_UA,
            'visited_at' => Carbon::now('Asia/Jakarta')->subDays(10),
        ]);

        // Log kunjungan 2 hari lalu (harus tetap ada)
        PageVisit::query()->create([
            'page' => 'simerahkoja',
            'ip_hash' => str_repeat('b', 64),
            'user_agent' => self::BROWSER_UA,
            'visited_at' => Carbon::now('Asia/Jakarta')->subDays(2),
        ]);

        // Rekap bulanan lama dan baru (TIDAK BOLEH terhapus)
        MonthlyVisitStat::query()->create([
            'page' => 'simerahkoja',
            'year' => 2025,
            'month' => 1,
            'total' => 500,
        ]);

        MonthlyVisitStat::query()->create([
            'page' => 'simerahkoja',
            'year' => 2026,
            'month' => 10,
            'total' => 120,
        ]);

        $this->artisan('visits:prune')->assertSuccessful();

        $this->assertSame(1, PageVisit::query()->count());
        $this->assertSame(str_repeat('b', 64), PageVisit::query()->first()?->ip_hash);
        $this->assertSame(2, MonthlyVisitStat::query()->count());
    }

    public function test_missing_ip_salt_throws_runtime_exception(): void
    {
        Config::set('visits.ip_salt', '');

        $this->withoutExceptionHandling();
        $this->expectException(RuntimeException::class);

        $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.55'])
            ->withHeaders(['User-Agent' => self::BROWSER_UA])
            ->postJson('/api/visits/simerahkoja');
    }
}

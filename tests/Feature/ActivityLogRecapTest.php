<?php

namespace Tests\Feature;

use App\Exports\RekapAktivitasBulananExport;
use App\Models\User;
use App\Services\ActivityRecapService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Maatwebsite\Excel\Excel as ExcelWriter;
use Maatwebsite\Excel\Facades\Excel;
use Mockery;
use ReflectionMethod;
use Tests\TestCase;
use ZipArchive;

class ActivityLogRecapTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow(Carbon::create(2026, 11, 12, 8, 30, 0, 'Asia/Jakarta'));
        Config::set('activity.timezone', 'Asia/Jakarta');
        Config::set('activity.retention_months.internal', 6);
        Config::set('activity.retention_months.pemohon', 6);
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        Mockery::close();

        parent::tearDown();
    }

    public function test_guest_is_redirected_from_rekap_export_and_prune_endpoints(): void
    {
        $this->get('/internal/riwayat-aktivitas-rekap')->assertRedirect('/login');
        $this->get('/internal/riwayat-aktivitas-rekap/excel')->assertRedirect('/login');
        $this->get('/internal/riwayat-aktivitas-rekap/pdf')->assertRedirect('/login');
        $this->post('/internal/riwayat-aktivitas-rekap/prune')->assertRedirect('/login');
    }

    public function test_cutoff_and_default_period_resolution_behave_accurately(): void
    {
        $service = new ActivityRecapService;

        $internalCutoff = $service->cutoffForCategory(ActivityRecapService::CATEGORY_INTERNAL);
        $this->assertSame('2026-05-01 00:00:00', $internalCutoff->format('Y-m-d H:i:s'));

        Config::set('activity.retention_months.pemohon', 3);
        $pemohonCutoff = $service->cutoffForCategory(ActivityRecapService::CATEGORY_PEMOHON);
        $this->assertSame('2026-08-01 00:00:00', $pemohonCutoff->format('Y-m-d H:i:s'));

        // Halaman dibuka tanpa parameter filter -> otomatis bulan & tahun berjalan (November 2026)
        $defaultPeriod = $service->resolveDetailPeriod(Request::create('/internal/riwayat-aktivitas', 'GET'));
        $this->assertSame('11', $defaultPeriod['selected_month']);
        $this->assertSame('2026', $defaultPeriod['selected_year']);
        $this->assertTrue($defaultPeriod['is_default_current_month']);
        $this->assertSame('November 2026', $defaultPeriod['period_label']);

        // Mengisi rentang tanggal manual mengabaikan dropdown bulan/tahun agar pencarian lama tetap ditemukan
        $rangePeriod = $service->resolveDetailPeriod(Request::create('/internal/riwayat-aktivitas', 'GET', [
            'month' => '11',
            'year' => '2026',
            'date_start' => '2026-09-01',
            'date_end' => '2026-09-30',
        ]));
        $this->assertTrue($rangePeriod['has_date_range']);
        $this->assertSame('all', $rangePeriod['selected_month']);
        $this->assertSame('all', $rangePeriod['selected_year']);
    }

    public function test_structured_recap_combines_archive_and_live_data_and_separates_internal_from_pemohon(): void
    {
        $service = new ActivityRecapService;
        $accumulate = new ReflectionMethod(ActivityRecapService::class, 'accumulateRecapBucket');
        $build = new ReflectionMethod(ActivityRecapService::class, 'buildStructuredRecap');

        $buckets = [];
        // Arsip permanen April 2026 (internal + pemohon)
        $accumulate->invokeArgs($service, [&$buckets, 2026, 4, 'internal', 'Berita', 'Tambah', 5, true]);
        $accumulate->invokeArgs($service, [&$buckets, 2026, 4, 'internal', 'Berita', 'Ubah', 3, true]);
        $accumulate->invokeArgs($service, [&$buckets, 2026, 4, 'pemohon', 'Permohonan SKK', 'Tambah', 7, true]);

        // Live November 2026
        $accumulate->invokeArgs($service, [&$buckets, 2026, 11, 'internal', 'Sarana & Prasarana', 'Hapus', 2, false]);
        $accumulate->invokeArgs($service, [&$buckets, 2026, 11, 'pemohon', 'Permohonan RPKBGL', 'Tambah', 4, false]);

        /** @var array<string, mixed> $recap */
        $recap = $build->invoke($service, $buckets, [2026]);

        $this->assertSame(21, $recap['summary']['total_all']);
        $this->assertSame(10, $recap['summary']['total_internal']);
        $this->assertSame(11, $recap['summary']['total_pemohon']);
        $this->assertSame(15, $recap['summary']['archived_count']);
        $this->assertSame(6, $recap['summary']['live_count']);

        $this->assertCount(2, $recap['monthly_internal']);
        $this->assertSame('November 2026', $recap['monthly_internal']->first()['period_label']);
        $this->assertSame('Data Live', $recap['monthly_internal']->first()['source']);
        $this->assertSame('Arsip Permanen', $recap['monthly_internal']->last()['source']);

        $this->assertCount(2, $recap['monthly_pemohon']);
        $this->assertSame(4, $recap['monthly_pemohon']->first()['rpkbgl']);
        $this->assertSame(7, $recap['monthly_pemohon']->last()['skk']);
    }

    public function test_rekap_page_renders_separated_tables_and_super_user_only_prune_button(): void
    {
        $sampleRecap = $this->sampleRecapPayload();

        $mockService = Mockery::mock(ActivityRecapService::class);
        $mockService->shouldReceive('getRecapData')->with(2026, 'all')->twice()->andReturn($sampleRecap);
        $mockService->shouldReceive('countPrunable')->twice()->andReturn([
            'internal' => 9,
            'pemohon' => 3,
            'total' => 12,
            'internal_cutoff' => Carbon::create(2026, 5, 1, 0, 0, 0, 'Asia/Jakarta'),
            'pemohon_cutoff' => Carbon::create(2026, 5, 1, 0, 0, 0, 'Asia/Jakarta'),
            'internal_months' => 6,
            'pemohon_months' => 6,
        ]);
        $mockService->shouldReceive('retentionMonths')->with('internal')->twice()->andReturn(6);
        $mockService->shouldReceive('retentionMonths')->with('pemohon')->twice()->andReturn(6);

        $this->app->instance(ActivityRecapService::class, $mockService);

        $superUserResponse = $this->actingAs($this->makeUserWithRole('Super User'))
            ->get('/internal/riwayat-aktivitas-rekap?year=2026&category=all');

        $superUserResponse->assertOk();
        $superUserResponse->assertSee('Rekap Bulanan Aktivitas Internal Pegawai');
        $superUserResponse->assertSee('Rekap Bulanan Permohonan Surat (Pemohon)');
        $superUserResponse->assertSee('Ringkas &amp; Arsipkan Log Lama (12)', false);
        $superUserResponse->assertSee('/internal/riwayat-aktivitas-rekap/excel?year=2026&amp;category=all', false);
        $superUserResponse->assertSee('/internal/riwayat-aktivitas-rekap/pdf?year=2026&amp;category=all', false);

        $operatorResponse = $this->actingAs($this->makeUserWithRole('Operator'))
            ->get('/internal/riwayat-aktivitas-rekap?year=2026&category=all');

        $operatorResponse->assertOk();
        $operatorResponse->assertDontSee('Ringkas &amp; Arsipkan Log Lama', false);
    }

    public function test_non_super_user_cannot_trigger_manual_prune(): void
    {
        $this->actingAs($this->makeUserWithRole('Operator'))
            ->post('/internal/riwayat-aktivitas-rekap/prune')
            ->assertForbidden();
    }

    public function test_super_user_can_trigger_manual_prune(): void
    {
        $mockService = Mockery::mock(ActivityRecapService::class);
        $mockService->shouldReceive('pruneAndSummarize')->once()->andReturn([
            'dry_run' => false,
            'internal' => ['deleted' => 8, 'months_affected' => 2, 'cutoff' => Carbon::create(2026, 5, 1)],
            'pemohon' => ['deleted' => 4, 'months_affected' => 1, 'cutoff' => Carbon::create(2026, 5, 1)],
            'total_deleted' => 12,
        ]);
        $this->app->instance(ActivityRecapService::class, $mockService);

        $response = $this->actingAs($this->makeUserWithRole('Super User'))
            ->from('/internal/riwayat-aktivitas-rekap')
            ->post('/internal/riwayat-aktivitas-rekap/prune');

        $response->assertRedirect('/internal/riwayat-aktivitas-rekap');
        $response->assertSessionHas('success', 'Berhasil meringkas & mengarsipkan 8 log internal serta 4 log pemohon ke Rekap Bulanan.');
    }

    public function test_excel_and_pdf_exports_produce_valid_separated_documents(): void
    {
        $sampleRecap = $this->sampleRecapPayload();

        // 1. Verifikasi real binary .xlsx berisi 3 worksheet terpisah saat category = 'all'
        $binaryAll = Excel::raw(
            new RekapAktivitasBulananExport(
                $sampleRecap['monthly_internal'],
                $sampleRecap['monthly_pemohon'],
                $sampleRecap['module_details'],
                'all'
            ),
            ExcelWriter::XLSX
        );

        $workbookXmlAll = $this->readXlsxEntry($binaryAll, 'xl/workbook.xml');
        $this->assertStringContainsString('Ringkasan Internal', $workbookXmlAll);
        $this->assertStringContainsString('Ringkasan Pemohon', $workbookXmlAll);
        $this->assertStringContainsString('Rincian Per Modul', $workbookXmlAll);

        $sharedStrings = $this->readXlsxEntry($binaryAll, 'xl/sharedStrings.xml');
        $this->assertStringContainsString('November 2026', $sharedStrings);
        $this->assertStringContainsString('Permohonan RPKBGL', $sharedStrings);

        // 2. Verifikasi category = 'internal' tidak menyertakan sheet Pemohon
        $binaryInternalOnly = Excel::raw(
            new RekapAktivitasBulananExport(
                $sampleRecap['monthly_internal'],
                collect(),
                $sampleRecap['module_details']->where('category', 'internal')->values(),
                'internal'
            ),
            ExcelWriter::XLSX
        );
        $workbookXmlInternal = $this->readXlsxEntry($binaryInternalOnly, 'xl/workbook.xml');
        $this->assertStringContainsString('Ringkasan Internal', $workbookXmlInternal);
        $this->assertStringNotContainsString('Ringkasan Pemohon', $workbookXmlInternal);

        // 3. Verifikasi endpoint controller download Excel & PDF
        $mockService = Mockery::mock(ActivityRecapService::class);
        $mockService->shouldReceive('getRecapData')->with(2026, 'all')->twice()->andReturn($sampleRecap);
        $mockService->shouldReceive('timezone')->once()->andReturn('Asia/Jakarta');
        $this->app->instance(ActivityRecapService::class, $mockService);

        Excel::fake();
        $this->actingAs($this->makeUserWithRole('Operator'))
            ->get('/internal/riwayat-aktivitas-rekap/excel?year=2026&category=all')
            ->assertOk();
        Excel::assertDownloaded('Rekap_Bulanan_Riwayat_Aktivitas_2026.xlsx');

        $pdfResponse = $this->actingAs($this->makeUserWithRole('Operator'))
            ->get('/internal/riwayat-aktivitas-rekap/pdf?year=2026&category=all');

        $pdfResponse->assertOk();
        $this->assertStringContainsString('application/pdf', (string) $pdfResponse->headers->get('content-type'));
        $this->assertStringContainsString(
            'Rekap_Bulanan_Riwayat_Aktivitas_2026.pdf',
            (string) $pdfResponse->headers->get('content-disposition')
        );
        $this->assertStringStartsWith('%PDF-', $pdfResponse->getContent());
    }

    public function test_prune_command_forwards_separate_retention_options_and_dry_run_flag(): void
    {
        $mockService = Mockery::mock(ActivityRecapService::class);
        $mockService->shouldReceive('pruneAndSummarize')
            ->with(6, 3, true)
            ->once()
            ->andReturn([
                'dry_run' => true,
                'internal' => [
                    'deleted' => 12,
                    'months_affected' => 2,
                    'cutoff' => Carbon::create(2026, 5, 1, 0, 0, 0, 'Asia/Jakarta'),
                ],
                'pemohon' => [
                    'deleted' => 5,
                    'months_affected' => 1,
                    'cutoff' => Carbon::create(2026, 8, 1, 0, 0, 0, 'Asia/Jakarta'),
                ],
                'total_deleted' => 17,
            ]);
        $this->app->instance(ActivityRecapService::class, $mockService);

        $this->artisan('activity:prune --internal-months=6 --pemohon-months=3 --dry-run')
            ->expectsOutputToContain('[DRY-RUN] Internal: 12 log (2 bulan)')
            ->expectsOutputToContain('[DRY-RUN] Pemohon: 5 log (1 bulan)')
            ->expectsOutputToContain('[DRY-RUN] Total diproses: 17 baris.')
            ->assertSuccessful();
    }

    /**
     * @return array<string, mixed>
     */
    private function sampleRecapPayload(): array
    {
        return [
            'monthly_internal' => collect([
                [
                    'year' => 2026,
                    'month' => 11,
                    'period_label' => 'November 2026',
                    'tambah' => 10,
                    'ubah' => 5,
                    'hapus' => 2,
                    'lainnya' => 0,
                    'total' => 17,
                    'archived_total' => 0,
                    'live_total' => 17,
                    'top_modules' => [
                        ['module' => 'Sarana & Prasarana', 'total' => 10],
                    ],
                    'source' => 'Data Live',
                ],
            ]),
            'monthly_pemohon' => collect([
                [
                    'year' => 2026,
                    'month' => 11,
                    'period_label' => 'November 2026',
                    'rpkbgl' => 4,
                    'skk' => 3,
                    'izin' => 1,
                    'sarana' => 0,
                    'edukasi' => 2,
                    'lainnya' => 0,
                    'total' => 10,
                    'archived_total' => 0,
                    'live_total' => 10,
                    'source' => 'Data Live',
                ],
            ]),
            'module_details' => collect([
                [
                    'year' => 2026,
                    'month' => 11,
                    'period_label' => 'November 2026',
                    'category' => 'internal',
                    'category_label' => 'Aktivitas Internal',
                    'module' => 'Sarana & Prasarana',
                    'action' => 'Tambah',
                    'archived_total' => 0,
                    'live_total' => 10,
                    'total' => 10,
                    'source' => 'Data Live',
                ],
                [
                    'year' => 2026,
                    'month' => 11,
                    'period_label' => 'November 2026',
                    'category' => 'pemohon',
                    'category_label' => 'Permohonan Surat (Pemohon)',
                    'module' => 'Permohonan RPKBGL',
                    'action' => 'Tambah',
                    'archived_total' => 0,
                    'live_total' => 4,
                    'total' => 4,
                    'source' => 'Data Live',
                ],
            ]),
            'available_years' => [2026],
            'summary' => [
                'total_all' => 27,
                'total_internal' => 17,
                'internal_tambah' => 10,
                'internal_ubah' => 5,
                'internal_hapus' => 2,
                'internal_lainnya' => 0,
                'total_pemohon' => 10,
                'archived_count' => 0,
                'live_count' => 27,
                'months_count' => 1,
            ],
        ];
    }

    private function makeUserWithRole(string $role): User
    {
        $user = new class extends User
        {
            public string $assignedRole = '';

            public function getRoleNames(): Collection
            {
                return collect([$this->assignedRole]);
            }

            public function hasRole($roles, ?string $guard = null): bool
            {
                return in_array($this->assignedRole, (array) $roles, true);
            }

            public function hasAnyRole(...$roles): bool
            {
                $flat = collect($roles)->flatten()->all();

                return in_array($this->assignedRole, $flat, true);
            }
        };

        $user->assignedRole = $role;
        $user->id = 1;
        $user->nama_lengkap = 'Penguji '.$role;
        $user->email = 'test@damkar.go.id';
        $user->role = $role;

        return $user;
    }

    private function readXlsxEntry(string $binaryXlsx, string $entryName): string
    {
        $tmpPath = tempnam(sys_get_temp_dir(), 'xlsx_test_');
        $this->assertNotFalse($tmpPath);
        file_put_contents($tmpPath, $binaryXlsx);

        $zip = new ZipArchive;
        $opened = $zip->open($tmpPath);
        $this->assertTrue($opened === true, 'Generated Excel file should be a valid ZIP archive.');

        $content = $zip->getFromName($entryName);
        $zip->close();
        @unlink($tmpPath);

        $this->assertIsString($content, "Missing entry {$entryName} in XLSX.");

        return $content;
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Mockery;
use Tests\TestCase;
use ZipArchive;

class DistribusiPersonilCetakTest extends TestCase
{
    public function test_guest_cannot_download_per_person_bast(): void
    {
        $response = $this->get('/sapra/distribusi-staff/cetak-personil?nama=Kasianto&format=pdf');

        $response->assertRedirect('/login');
    }

    public function test_viewer_and_sapra_can_see_per_person_pdf_and_word_buttons(): void
    {
        $rows = collect([
            (object) [
                'id' => 1,
                'nama_penerima' => 'KASIANTO',
                'kebutuhan_id' => 1,
                'nama_barang' => 'SEKOP',
                'jumlah' => 2,
                'detail_barang' => 'Gagang Fiber',
                'waktu_terima' => '2024-07-26 08:00:00',
                'keterangan' => 'Pinjam Barang',
            ],
        ]);
        $barang = collect([
            (object) ['id' => 1, 'uraian' => 'Sekop'],
        ]);

        $this->mockDistribusiAndBarang($rows, $barang);
        $viewerResponse = $this->actingAs($this->makeUserWithRole('Sekretariat'))
            ->get('/sapra/distribusi-staff');

        $viewerResponse->assertOk();
        $viewerResponse->assertSee('/sapra/distribusi-staff/cetak-personil?nama=KASIANTO&amp;format=pdf', false);
        $viewerResponse->assertSee('/sapra/distribusi-staff/cetak-personil?nama=KASIANTO&amp;format=word', false);
        $viewerResponse->assertDontSee('<i class="fas fa-plus"></i> Tambah Barang', false);

        $this->mockDistribusiAndBarang($rows, $barang);
        $sapraResponse = $this->actingAs($this->makeUserWithRole('Sapra'))
            ->get('/sapra/distribusi-staff');

        $sapraResponse->assertOk();
        $sapraResponse->assertSee('/sapra/distribusi-staff/cetak-personil?nama=KASIANTO&amp;format=pdf', false);
        $sapraResponse->assertSee('/sapra/distribusi-staff/cetak-personil?nama=KASIANTO&amp;format=word', false);
        $sapraResponse->assertSee('<i class="fas fa-plus"></i> Tambah Barang', false);
    }

    public function test_can_download_per_person_bast_pdf_all_years_and_filtered_year(): void
    {
        $allItems = collect([
            (object) [
                'id' => 1,
                'nama_penerima' => 'KASIANTO',
                'nama_barang' => 'SEKOP',
                'jumlah' => 2,
                'detail_barang' => 'Gagang Fiber',
                'waktu_terima' => '2024-07-26 08:00:00',
                'keterangan' => 'Pinjam Barang',
            ],
            (object) [
                'id' => 2,
                'nama_penerima' => 'Kasianto',
                'nama_barang' => 'PENGANTIAN APAR ARMADA 011',
                'jumlah' => 1,
                'detail_barang' => null,
                'waktu_terima' => '2026-03-16 08:00:00',
                'keterangan' => 'Kondisi Baik ( Baru )',
            ],
        ]);

        $this->mockPerPersonQuery('KASIANTO', $allItems, []);
        $allYearsResponse = $this->actingAs($this->makeUserWithRole('Sapra'))
            ->get('/sapra/distribusi-staff/cetak-personil?nama=Kasianto&format=pdf');

        $allYearsResponse->assertOk();
        $this->assertStringContainsString('application/pdf', (string) $allYearsResponse->headers->get('content-type'));
        $this->assertStringContainsString(
            'Berita_Acara_Serah_Terima_kasianto_semua_tahun.pdf',
            (string) $allYearsResponse->headers->get('content-disposition')
        );
        $this->assertStringStartsWith('%PDF-', $allYearsResponse->getContent());

        $this->mockPerPersonQuery('KASIANTO', $allItems->where('id', 2)->values(), ['2026']);
        $filteredResponse = $this->actingAs($this->makeUserWithRole('Sapra'))
            ->get('/sapra/distribusi-staff/cetak-personil?nama=Kasianto&format=pdf&tahun=2026');

        $filteredResponse->assertOk();
        $this->assertStringContainsString(
            'Berita_Acara_Serah_Terima_kasianto_2026.pdf',
            (string) $filteredResponse->headers->get('content-disposition')
        );
        $this->assertStringStartsWith('%PDF-', $filteredResponse->getContent());
    }

    public function test_can_download_per_person_bast_docx_all_years_with_dates_and_empty_pihak_pertama(): void
    {
        $items = collect([
            (object) [
                'id' => 1,
                'nama_penerima' => 'KASIANTO',
                'nama_barang' => 'SEKOP',
                'jumlah' => 2,
                'detail_barang' => 'Gagang Fiber',
                'waktu_terima' => '2024-07-26 08:00:00',
                'keterangan' => 'Pinjam Barang',
            ],
            (object) [
                'id' => 2,
                'nama_penerima' => 'Kasianto',
                'nama_barang' => 'PENGANTIAN APAR ARMADA 011',
                'jumlah' => 1,
                'detail_barang' => null,
                'waktu_terima' => '2026-03-16 08:00:00',
                'keterangan' => 'Kondisi Baik ( Baru )',
            ],
        ]);

        $this->mockPerPersonQuery('KASIANTO', $items, []);
        $response = $this->actingAs($this->makeUserWithRole('Sekretariat'))
            ->get('/sapra/distribusi-staff/cetak-personil?nama=Kasianto&format=word');

        $response->assertOk();
        $this->assertStringContainsString(
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            (string) $response->headers->get('content-type')
        );
        $this->assertStringContainsString(
            'Berita_Acara_Serah_Terima_kasianto_semua_tahun.docx',
            (string) $response->headers->get('content-disposition')
        );

        $filePath = $response->baseResponse->getFile()->getPathname();
        $xml = $this->readDocxDocumentXml($filePath);
        @unlink($filePath);

        $this->assertStringContainsString('BERITA ACARA SERAH TERIMA BARANG', $xml);
        $this->assertStringContainsString('PIHAK PERTAMA', $xml);
        $this->assertStringContainsString('PIHAK KEDUA', $xml);
        $this->assertStringContainsString('KASIANTO', $xml);
        $this->assertStringContainsString('Semua Tahun (2024, 2026)', $xml);
        $this->assertStringContainsString('26 Juli 2024', $xml);
        $this->assertStringContainsString('16 Maret 2026', $xml);
        $this->assertStringContainsString('SEKOP', $xml);
        $this->assertStringContainsString('PENGANTIAN APAR ARMADA 011', $xml);
        $this->assertStringNotContainsString('FIRDAUS', $xml);
    }

    public function test_per_person_bast_docx_respects_year_filter_and_escapes_special_characters(): void
    {
        $filteredItems = collect([
            (object) [
                'id' => 2,
                'nama_penerima' => 'KASIANTO',
                'nama_barang' => 'PENGANTIAN APAR ARMADA 011',
                'jumlah' => 1,
                'detail_barang' => null,
                'waktu_terima' => '2026-03-16 08:00:00',
                'keterangan' => 'Kondisi Baik ( Baru )',
            ],
        ]);

        $this->mockPerPersonQuery('KASIANTO', $filteredItems, ['2026']);
        $filteredResponse = $this->actingAs($this->makeUserWithRole('Sapra'))
            ->get('/sapra/distribusi-staff/cetak-personil?nama=Kasianto&format=word&tahun=2026');

        $filteredResponse->assertOk();
        $filteredPath = $filteredResponse->baseResponse->getFile()->getPathname();
        $filteredXml = $this->readDocxDocumentXml($filteredPath);
        @unlink($filteredPath);

        $this->assertStringContainsString('Tahun 2026', $filteredXml);
        $this->assertStringContainsString('PENGANTIAN APAR ARMADA 011', $filteredXml);
        $this->assertStringNotContainsString('SEKOP', $filteredXml);

        $firdausItems = collect([
            (object) [
                'id' => 3,
                'nama_penerima' => 'FIRDAUS',
                'nama_barang' => 'SENTER KEPALA & CHARGER',
                'jumlah' => 1,
                'detail_barang' => 'Waterproof',
                'waktu_terima' => '2025-12-12 08:00:00',
                'keterangan' => 'Pos Palmerah',
            ],
        ]);

        $this->mockPerPersonQuery('FIRDAUS', $firdausItems, []);
        $ampersandResponse = $this->actingAs($this->makeUserWithRole('Sapra'))
            ->get('/sapra/distribusi-staff/cetak-personil?nama=Firdaus&format=word');

        $ampersandResponse->assertOk();
        $ampersandPath = $ampersandResponse->baseResponse->getFile()->getPathname();
        $ampersandXml = $this->readDocxDocumentXml($ampersandPath);
        @unlink($ampersandPath);

        $this->assertStringContainsString('SENTER KEPALA &amp; CHARGER', $ampersandXml);
    }

    public function test_per_person_bast_redirects_with_error_when_data_missing(): void
    {
        $emptyNameResponse = $this->actingAs($this->makeUserWithRole('Sapra'))
            ->from('/sapra/distribusi-staff')
            ->get('/sapra/distribusi-staff/cetak-personil?format=pdf');

        $emptyNameResponse->assertRedirect('/sapra/distribusi-staff');
        $emptyNameResponse->assertSessionHas('error');

        $this->mockPerPersonQuery('TIDAKADA', collect(), []);
        $unknownPersonResponse = $this->actingAs($this->makeUserWithRole('Sapra'))
            ->from('/sapra/distribusi-staff')
            ->get('/sapra/distribusi-staff/cetak-personil?nama=TidakAda&format=word');

        $unknownPersonResponse->assertRedirect('/sapra/distribusi-staff');
        $unknownPersonResponse->assertSessionHas('error');
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

    private function mockDistribusiAndBarang(Collection $distribusiRows, Collection $barangRows): void
    {
        $distribusiBuilder = Mockery::mock(Builder::class);
        $distribusiBuilder->shouldReceive('orderBy')->with('nama_penerima', 'asc')->once()->andReturnSelf();
        $distribusiBuilder->shouldReceive('orderBy')->with('waktu_terima', 'desc')->once()->andReturnSelf();
        $distribusiBuilder->shouldReceive('get')->once()->andReturn($distribusiRows);

        $barangBuilder = Mockery::mock(Builder::class);
        $barangBuilder->shouldReceive('orderBy')->with('uraian', 'asc')->once()->andReturnSelf();
        $barangBuilder->shouldReceive('get')->once()->andReturn($barangRows);

        DB::shouldReceive('table')->with('distribusi_barang_staff')->once()->andReturn($distribusiBuilder);
        DB::shouldReceive('table')->with('kebutuhan_sarpras')->once()->andReturn($barangBuilder);
    }

    /**
     * @param  list<string>  $expectedYears
     */
    private function mockPerPersonQuery(string $expectedNamaKey, Collection $items, array $expectedYears): void
    {
        $queryBuilder = Mockery::mock(Builder::class);
        $queryBuilder->shouldReceive('whereRaw')
            ->with('UPPER(TRIM(nama_penerima)) = ?', [$expectedNamaKey])
            ->once()
            ->andReturnSelf();

        if (! empty($expectedYears)) {
            $queryBuilder->shouldReceive('where')
                ->with(Mockery::on(function (callable $closure) use ($expectedYears): bool {
                    $subQuery = Mockery::mock(Builder::class);
                    foreach ($expectedYears as $year) {
                        $subQuery->shouldReceive('orWhereYear')->with('waktu_terima', $year)->once()->andReturnSelf();
                    }
                    $closure($subQuery);

                    return true;
                }))
                ->once()
                ->andReturnSelf();
        }

        $queryBuilder->shouldReceive('orderBy')->with('waktu_terima', 'asc')->once()->andReturnSelf();
        $queryBuilder->shouldReceive('orderBy')->with('id', 'asc')->once()->andReturnSelf();
        $queryBuilder->shouldReceive('get')->once()->andReturn($items);

        DB::shouldReceive('table')->with('distribusi_barang_staff')->once()->andReturn($queryBuilder);
    }

    private function readDocxDocumentXml(string $docxPath): string
    {
        $zip = new ZipArchive;
        $opened = $zip->open($docxPath);
        $this->assertTrue($opened === true, 'Generated Word file should be a valid ZIP archive.');

        $documentXml = $zip->getFromName('word/document.xml');
        $zip->close();

        $this->assertIsString($documentXml);

        return $documentXml;
    }
}

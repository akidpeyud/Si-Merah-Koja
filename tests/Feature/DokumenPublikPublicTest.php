<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DokumenPublikPublicTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::dropIfExists('dokumen_publik');
        Schema::create('dokumen_publik', function (Blueprint $table) {
            $table->id();
            $table->string('judul_dokumen')->nullable();
            $table->string('kategori')->nullable();
            $table->string('nama_file')->nullable();
            $table->year('tahun')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Test redirect dari /dokumen ke /dokumen/renstra.
     */
    public function test_dokumen_url_redirects_to_renstra(): void
    {
        $response = $this->get('/dokumen');

        $response->assertRedirect('/dokumen/renstra');
    }

    /**
     * Test halaman publik renstra hanya menampilkan tab & navigasi Renstra dan SPM.
     */
    public function test_public_renstra_shows_only_renstra_and_spm(): void
    {
        $response = $this->get('/dokumen/renstra');

        $response->assertStatus(200);
        $response->assertSee('/dokumen/renstra');
        $response->assertSee('/dokumen/spm');
        $response->assertDontSee('/dokumen/renja');
        $response->assertDontSee('/dokumen/sakip');
        $response->assertDontSee('/dokumen/lppd');
    }

    /**
     * Test halaman publik spm hanya menampilkan tab & navigasi Renstra dan SPM.
     */
    public function test_public_spm_shows_only_renstra_and_spm(): void
    {
        $response = $this->get('/dokumen/spm');

        $response->assertStatus(200);
        $response->assertSee('/dokumen/renstra');
        $response->assertSee('/dokumen/spm');
        $response->assertDontSee('/dokumen/renja');
        $response->assertDontSee('/dokumen/sakip');
        $response->assertDontSee('/dokumen/lppd');
    }

    /**
     * Test akses URL /dokumen/renja, /dokumen/sakip, /dokumen/lppd menghasilkan 404 Not Found.
     */
    public function test_removed_dokumen_urls_return_404(): void
    {
        $this->get('/dokumen/renja')->assertNotFound();
        $this->get('/dokumen/sakip')->assertNotFound();
        $this->get('/dokumen/lppd')->assertNotFound();
    }

    /**
     * Test card statistik pada internal/dokumen-publik berfungsi sebagai filter yang bisa diklik.
     */
    public function test_internal_dokumen_publik_cards_have_clickable_filter_links(): void
    {
        $kategoriList = ['Renstra', 'Renja', 'SPM', 'SAKIP', 'LPPD'];
        $dokumens = new LengthAwarePaginator([], 0, 10);
        $totalDokumen = 15;
        $statistikKategori = [
            'Renstra' => 5,
            'Renja' => 3,
            'SPM' => 2,
            'SAKIP' => 2,
            'LPPD' => 3,
        ];

        // 1. Tanpa filter: card Total Dokumen aktif, card kategori punya link filter ?kategori=...
        request()->query->replace([]);
        $htmlWithoutFilter = view('internal.dokumen-publik.index', compact('dokumens', 'kategoriList', 'totalDokumen', 'statistikKategori'))->render();

        $this->assertStringContainsString('class="rekap-item rekap-total active"', $htmlWithoutFilter);
        $this->assertStringContainsString('kategori=Renstra', $htmlWithoutFilter);
        $this->assertStringContainsString('kategori=SPM', $htmlWithoutFilter);

        // 2. Dengan filter kategori=Renstra: card Renstra aktif
        request()->query->replace(['kategori' => 'Renstra']);
        $htmlWithFilter = view('internal.dokumen-publik.index', compact('dokumens', 'kategoriList', 'totalDokumen', 'statistikKategori'))->render();

        $this->assertStringContainsString('class="rekap-item rekap-renstra active"', $htmlWithFilter);
        $this->assertStringNotContainsString('class="rekap-item rekap-total active"', $htmlWithFilter);
    }
}

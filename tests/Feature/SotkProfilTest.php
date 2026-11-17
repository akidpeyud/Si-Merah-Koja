<?php

namespace Tests\Feature;

use App\Models\ProfilInstansi;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ViewErrorBag;
use Tests\TestCase;

class SotkProfilTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::dropIfExists('profil_instansis');

        Schema::create('profil_instansis', function (Blueprint $table) {
            $table->id();
            $table->string('kategori')->index();
            $table->string('sub_kategori')->nullable()->index();
            $table->string('judul');
            $table->year('tahun')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('file_dokumen')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // Seed 7 struktur SOTK
        ProfilInstansi::create([
            'kategori' => 'sotk',
            'sub_kategori' => 'dinas',
            'judul' => 'Struktur Organisasi Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi',
            'tahun' => 2026,
            'file_dokumen' => 'profil-instansi/sotk/test.pdf',
            'urutan' => 1,
        ]);

        ProfilInstansi::create([
            'kategori' => 'sotk',
            'sub_kategori' => 'komando',
            'judul' => 'Struktur Organisasi Komando Kebakaran dan Penyelamatan Regu 1, Regu 2, Regu 3',
            'tahun' => 2026,
            'file_dokumen' => null,
            'urutan' => 2,
        ]);

        ProfilInstansi::create([
            'kategori' => 'sotk',
            'sub_kategori' => 'sekretariat',
            'judul' => 'Struktur Organisasi Sekretariat',
            'tahun' => 2026,
            'file_dokumen' => null,
            'urutan' => 3,
        ]);

        ProfilInstansi::create([
            'kategori' => 'sotk',
            'sub_kategori' => 'bidang_pencegahan',
            'judul' => 'Struktur Organisasi Bidang Pencegahan',
            'tahun' => 2026,
            'file_dokumen' => null,
            'urutan' => 4,
        ]);

        ProfilInstansi::create([
            'kategori' => 'sotk',
            'sub_kategori' => 'bidang_sapra',
            'judul' => 'Struktur Organisasi Bidang Sapra',
            'tahun' => 2026,
            'file_dokumen' => null,
            'urutan' => 5,
        ]);

        ProfilInstansi::create([
            'kategori' => 'sotk',
            'sub_kategori' => 'bidang_damtan',
            'judul' => 'Struktur Organisasi Bidang Damtan',
            'tahun' => 2026,
            'file_dokumen' => null,
            'urutan' => 6,
        ]);

        $posList = [
            'Struktur Organisasi Pos Pelayanan Alam Barajo',
            'Struktur Organisasi Pos Pelayanan Paal Merah',
            'Struktur Organisasi Pos Pelayanan Jambi Kota Seberang',
            'Struktur Organisasi Pos Pelayanan Jambi Timur',
            'Struktur Organisasi Pos Pelayanan Kota Baru',
            'Struktur Organisasi Pos Pelayanan Pelayangan',
        ];

        foreach ($posList as $idx => $posJudul) {
            ProfilInstansi::create([
                'kategori' => 'sotk',
                'sub_kategori' => 'pos_pelayanan',
                'judul' => $posJudul,
                'tahun' => 2026,
                'file_dokumen' => null,
                'urutan' => 7 + $idx,
            ]);
        }
    }

    /**
     * Uji halaman SOTK memiliki 7 container dan 1 preview iframe besar di container pertama.
     */
    public function test_halaman_sotk_menampilkan_7_container_dan_sub_pos_pelayanan(): void
    {
        $response = $this->get('/profil/sotk');

        $response->assertStatus(200);

        // Pastikan ke-7 judul container muncul tanpa angka
        $response->assertSee('Struktur Organisasi Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi');
        $response->assertSee('Struktur Organisasi Komando Kebakaran dan Penyelamatan Regu 1, Regu 2, Regu 3');
        $response->assertSee('Struktur Organisasi Sekretariat');
        $response->assertSee('Struktur Organisasi Bidang Pencegahan');
        $response->assertSee('Struktur Organisasi Bidang Sapra');
        $response->assertSee('Struktur Organisasi Bidang Damtan');
        $response->assertSee('Struktur Organisasi Pos Pelayanan');

        // Pastikan kategori pos pelayanan muncul
        $response->assertSee('Kategori: Pos Pelayanan Alam Barajo');
        $response->assertSee('Kategori: Pos Pelayanan Paal Merah');
        $response->assertSee('Kategori: Pos Pelayanan Jambi Kota Seberang');
        $response->assertSee('Kategori: Pos Pelayanan Jambi Timur');
        $response->assertSee('Kategori: Pos Pelayanan Kota Baru');
        $response->assertSee('Kategori: Pos Pelayanan Pelayangan');

        // Pastikan tombol filter kategori pos muncul termasuk "Semua Pos"
        $response->assertSee('Semua Pos');
        $response->assertSee('data-pos="all"', false);
        $response->assertSee('data-pos="Alam Barajo"', false);
        $response->assertSee('data-pos-name="Alam Barajo"', false);

        // Pastikan hanya container pertama yang memiliki preview view besar (iframe)
        $content = $response->getContent();
        preg_match_all('/<li class="doc-preview-item"[^>]*>.*?<\/li>/s', $content, $matches);
        $this->assertCount(1, $matches[0]);
        $this->assertStringContainsString('sotk-container-1', $content);
        $this->assertStringContainsString('sotk-container-7', $content);
    }

    /**
     * Uji form tambah SOTK internal menampilkan dropdown kontainer & pos pelayanan.
     */
    public function test_form_tambah_sotk_menampilkan_pilihan_kategori_dan_pos(): void
    {
        $view = view('internal.profil-instansi.create', [
            'kategori' => 'sotk',
            'judulKategori' => 'SOTK',
            'errors' => new ViewErrorBag,
        ])->render();

        $this->assertStringContainsString('Kategori Kontainer SOTK', $view);
        $this->assertStringContainsString('Kategori Pos Pelayanan', $view);
        $this->assertStringContainsString('Pos Pelayanan Alam Barajo', $view);
        $this->assertStringContainsString('Pos Pelayanan Paal Merah', $view);
    }
}

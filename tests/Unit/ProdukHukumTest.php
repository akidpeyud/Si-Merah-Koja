<?php

namespace Tests\Unit;

use App\Models\ProdukHukum;
use PHPUnit\Framework\TestCase;

class ProdukHukumTest extends TestCase
{
    public function test_daftar_sub_kategori_menteri_memiliki_lima_kategori(): void
    {
        $subKategori = ProdukHukum::daftarSubKategoriMenteri();

        $this->assertCount(5, $subKategori);
        $this->assertArrayHasKey('permendagri', $subKategori);
        $this->assertArrayHasKey('permen-pu', $subKategori);
        $this->assertArrayHasKey('permenkes', $subKategori);
        $this->assertArrayHasKey('permenaker', $subKategori);
        $this->assertArrayHasKey('permen-panrb', $subKategori);

        $this->assertSame('PERMENDAGRI', $subKategori['permendagri']);
        $this->assertSame('PERMEN PU', $subKategori['permen-pu']);
        $this->assertSame('PERMENKES', $subKategori['permenkes']);
        $this->assertSame('PERMENAKER', $subKategori['permenaker']);
        $this->assertSame('PERMEN PANRB', $subKategori['permen-panrb']);
    }

    public function test_fillable_mencakup_sub_kategori(): void
    {
        $model = new ProdukHukum;

        $this->assertContains('sub_kategori', $model->getFillable());
    }

    public function test_accessor_nama_sub_kategori(): void
    {
        $model = new ProdukHukum(['sub_kategori' => 'permendagri']);
        $this->assertSame('PERMENDAGRI', $model->nama_sub_kategori);

        $modelNull = new ProdukHukum;
        $this->assertNull($modelNull->nama_sub_kategori);
    }
}

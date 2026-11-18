<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukHukum extends Model
{
    use HasFactory;

    protected $table = 'produk_hukums';

    protected $fillable = [
        'kategori',
        'sub_kategori',
        'nomor',
        'tahun',
        'judul',
        'keterangan',
        'file_dokumen',
    ];

    /**
     * Daftar sub kategori / kementerian khusus untuk Peraturan Menteri
     */
    public static function daftarSubKategoriMenteri(): array
    {
        return [
            'permendagri' => 'PERMENDAGRI',
            'permen-pu' => 'PERMEN PU',
            'permenkes' => 'PERMENKES',
            'permenaker' => 'PERMENAKER',
            'permen-panrb' => 'PERMEN PANRB',
        ];
    }

    /**
     * Daftar kategori produk hukum yang valid beserta label tampilannya
     */
    public static function daftarKategori(): array
    {
        return [
            'undang-undang' => 'Undang-Undang',
            'peraturan-pemerintah' => 'Peraturan Pemerintah',
            'peraturan-presiden' => 'Peraturan Presiden', // BARU
            'peraturan-menteri' => 'Peraturan Menteri',
            'peraturan-daerah' => 'Peraturan Daerah',
            'peraturan-kepala-daerah' => 'Peraturan Kepala Daerah',
        ];
    }

    /**
     * Helper untuk mengambil nama label dari slug kategori
     */
    public function getNamaKategoriAttribute(): string
    {
        return self::daftarKategori()[$this->kategori] ?? 'Produk Hukum';
    }

    /**
     * Helper untuk mengambil nama label dari slug sub kategori
     */
    public function getNamaSubKategoriAttribute(): ?string
    {
        if (! $this->sub_kategori) {
            return null;
        }

        return self::daftarSubKategoriMenteri()[$this->sub_kategori] ?? strtoupper(str_replace('-', ' ', $this->sub_kategori));
    }
}

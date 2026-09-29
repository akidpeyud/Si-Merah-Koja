<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenyelamatan extends Model
{
    use HasFactory;

    protected $table = 'laporan_penyelamatans';
    
    // Mengizinkan semua kolom diisi (mass-assignment)
    protected $guarded = ['id'];

    // Relasi One-to-One ke tabel Teknis & Logistik
    public function teknisLogistik()
    {
        return $this->hasOne(LpTeknisLogistik::class, 'laporan_id');
    }

    // Relasi One-to-One ke tabel Dokumentasi
    public function dokumentasi()
    {
        return $this->hasOne(LpDokumentasi::class, 'laporan_id');
    }

    // Relasi One-to-One ke tabel Kategori Khusus
    public function kategoriKhusus()
    {
        return $this->hasOne(LpKategoriKhusus::class, 'laporan_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenyelamatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke Tabel Teknis & Logistik
    public function teknisLogistik()
    {
        return $this->hasOne(LpTeknisLogistik::class, 'laporan_id');
    }

    // Relasi ke Tabel Dokumentasi
    public function dokumentasi()
    {
        return $this->hasOne(LpDokumentasi::class, 'laporan_id');
    }

    // Relasi ke Tabel Kategori Khusus
    public function kategoriKhusus()
    {
        return $this->hasOne(LpKategoriKhusus::class, 'laporan_id');
    }
}
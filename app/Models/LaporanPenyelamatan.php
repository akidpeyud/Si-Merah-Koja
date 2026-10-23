<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenyelamatan extends Model
{
    use HasFactory;

    protected $table = 'laporan_penyelamatans';

    // Mengizinkan semua kolom diisi (mass-assignment)
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_kejadian' => 'date',
        'tahun_kejadian'   => 'integer',
    ];

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

    /**
     * Filter berdasarkan tahun kejadian.
     * Pemakaian: LaporanPenyelamatan::tahun(2027)->get();
     * Jika $tahun kosong, semua tahun diambil.
     */
    public function scopeTahun($query, $tahun)
    {
        return $tahun ? $query->where('tahun_kejadian', (int) $tahun) : $query;
    }

    /**
     * Respon Time (menit) = Waktu Tiba di Lokasi - Waktu Terima Laporan.
     * Tidak disimpan di database, dihitung otomatis.
     * Pemakaian di Blade: $row->respon_time
     */
    public function getResponTimeAttribute()
    {
        if (!$this->waktu_terima || !$this->waktu_tiba) {
            return null;
        }

        return (int) Carbon::parse($this->waktu_terima)
            ->diffInMinutes(Carbon::parse($this->waktu_tiba), false);
    }
}
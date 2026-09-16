<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LpTeknisLogistik extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Ubah tipe data JSON dari database menjadi Array di Laravel
    protected $casts = [
        'metode_evakuasi' => 'array',
        'metode_penyelamatan' => 'array',
        'peralatan' => 'array',
        'armada' => 'array',
    ];

    // Relasi balik ke Laporan Utama
    public function laporan()
    {
        return $this->belongsTo(LaporanPenyelamatan::class, 'laporan_id');
    }
} 
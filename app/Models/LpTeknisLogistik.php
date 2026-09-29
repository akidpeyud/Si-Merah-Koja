<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LpTeknisLogistik extends Model
{
    use HasFactory;

    protected $table = 'lp_teknis_logistiks';
    protected $guarded = ['id'];

    // Relasi balik (Belongs To) ke tabel Laporan
    public function laporan()
    {
        return $this->belongsTo(LaporanPenyelamatan::class, 'laporan_id');
    }

    // Mengubah JSON dari database menjadi Array otomatis saat ditarik
    protected $casts = [
        'metode_evakuasi' => 'array',
        'metode_penyelamatan' => 'array',
        'armada' => 'array',
        'peralatan' => 'array',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LpDokumentasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'instansi_pendukung' => 'array',
        'foto' => 'array',
    ];

    public function laporan()
    {
        return $this->belongsTo(LaporanPenyelamatan::class, 'laporan_id');
    }
}
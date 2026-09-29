<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LpKategoriKhusus extends Model
{
    use HasFactory;

    protected $table = 'lp_kategori_khusus';
    protected $guarded = ['id'];

    public function laporan()
    {
        return $this->belongsTo(LaporanPenyelamatan::class, 'laporan_id');
    }
}
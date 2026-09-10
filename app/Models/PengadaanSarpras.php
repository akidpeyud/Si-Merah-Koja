<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengadaanSarpras extends Model
{
    use HasFactory;

    protected $table = 'pengadaan_sarpras';

    protected $fillable = [
        'nama_barang',
        'tahun_2019',
        'tahun_2020',
        'tahun_2021',
        'tahun_2022',
        'tahun_2023',
        'tahun_2024',
        'tahun_2025',
        'tahun_2026',
        'stok',
    ];
}
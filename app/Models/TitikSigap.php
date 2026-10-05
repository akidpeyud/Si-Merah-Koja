<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitikSigap extends Model
{
    use HasFactory;

    protected $table = 'titik_sigaps';

    // Kolom-kolom yang diizinkan untuk diisi dari form request
    protected $fillable = [
        'kategori',
        'nama',
        'tanggal',
        'lokasi',
        'latitude',
        'longitude',
    ];
}
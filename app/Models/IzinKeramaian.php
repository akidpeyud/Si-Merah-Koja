<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IzinKeramaian extends Model
{
    use HasFactory;

    // Menyesuaikan dengan nama tabel di migration
    protected $table = 'izin_keramaian';

    // Mengizinkan semua kolom untuk diisi (Mass Assignment)
    protected $guarded = ['id'];
}
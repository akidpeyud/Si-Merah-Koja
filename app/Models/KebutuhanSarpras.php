<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KebutuhanSarpras extends Model
{
    use HasFactory;

    protected $table = 'kebutuhan_sarpras';

    protected $fillable = [
        'uraian',
        'jumlah_dibutuhkan',
        'jumlah_tersedia',
        'jumlah_belum_tersedia',
    ];
}
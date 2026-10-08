<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelatihanKeluarga extends Model
{
    use HasFactory;

    protected $table = 'pelatihan_keluarga';

    protected $fillable = [
        'tanggal_pelaksanaan',
        'kecamatan',
        'kelurahan',
        'rt',
        'peserta_perempuan',
        'peserta_laki_laki',
        'link_dokumentasi',
    ];
}
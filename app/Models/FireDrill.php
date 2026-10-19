<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FireDrill extends Model
{
    use HasFactory;

    protected $table = 'fire_drills';

    protected $fillable = [
        'nama_instansi',
        'tahun',
        'tanggal_pelaksanaan',
        'tempat_pelaksanaan',
        'peserta_laki_laki',
        'peserta_perempuan',
        'nama_peserta_laki_laki',
        'nama_peserta_perempuan',
        'total_peserta',
    ];
}
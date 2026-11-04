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
        'total_peserta',
        'nama_penanggung_jawab',
        'no_telepon',
        'surat_perintah_tugas',
    ];
}

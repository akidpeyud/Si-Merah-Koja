<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SosialisasiEdukasi extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel secara manual karena menggunakan bahasa Indonesia
    protected $table = 'sosialisasi_edukasi';

    // Kolom-kolom yang diizinkan untuk diisi secara massal (Mass Assignment)
    protected $fillable = [
        'tanggal_pelaksanaan',
        'kecamatan',
        'kelurahan',
        'rt',
        'posyandu',
        'peserta_perempuan',
        'peserta_laki_laki',
        'foto_video',
    ];
}
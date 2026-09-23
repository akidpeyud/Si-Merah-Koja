<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelatihanKeluarga extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel secara manual
    protected $table = 'pelatihan_keluarga';

    // Kolom-kolom yang diizinkan untuk diisi secara massal
    protected $fillable = [
        'tanggal_pelaksanaan',
        'kecamatan',
        'kelurahan',
        'rt',
        'posyandu',
        'peserta_perempuan',
        'peserta_laki_laki',
    ];
}
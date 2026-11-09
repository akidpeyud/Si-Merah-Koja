<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelatihanKeluarga extends Model
{
    use HasFactory;

    protected $table = 'pelatihan_keluarga';

    protected $fillable = [
        'nama_peserta',
        'jenis_kelamin',
        'kelurahan',
        'kecamatan',
        'tanggal_pelaksanaan',
        'tempat_pelaksanaan',
        'alamat_pelaksanaan',
    ];
}

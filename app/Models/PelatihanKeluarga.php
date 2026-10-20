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
        'nama_peserta_perempuan', // <-- Tambahkan ini
        'peserta_laki_laki',
        'nama_peserta_laki_laki', // <-- Tambahkan ini
        'link_dokumentasi',
    ];
}
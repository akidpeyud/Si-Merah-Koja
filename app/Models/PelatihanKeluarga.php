<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> fac8c2d3240687cd120e43aeff59740648734865
use Illuminate\Database\Eloquent\Model;

class PelatihanKeluarga extends Model
{
<<<<<<< HEAD
    // Ganti 'pelatihan_keluargas' dengan nama tabel aslimu di database jika berbeda
    protected $table = 'pelatihan_keluargas'; 
    protected $guarded = [];
=======
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
>>>>>>> fac8c2d3240687cd120e43aeff59740648734865
}
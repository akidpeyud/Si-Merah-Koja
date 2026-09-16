<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    use HasFactory;

    // Tetapkan nama tabel
    protected $table = 'pelatihan';

    // Daftarkan kolom yang diizinkan untuk diisi dari form
    protected $fillable = [
        'nama_pelatihan',
        'lokasi',
        'tanggal_pelaksanaan',
        'waktu_mulai',
        'waktu_selesai',
        'kategori_peserta',
        'jumlah_peserta',
        'modul_pelatihan',
        'catatan',
    ];
}
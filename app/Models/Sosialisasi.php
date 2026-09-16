<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sosialisasi extends Model
{
    use HasFactory;

    // Tetapkan nama tabel
    protected $table = 'sosialisasi';

    // Daftarkan name input yang diizinkan masuk ke database
    protected $fillable = [
        'nama_kegiatan',
        'lokasi',
        'tanggal_pelaksanaan',
        'waktu_mulai',
        'waktu_selesai',
        'sasaran_peserta',
        'jumlah_peserta',
        'surat_permohonan',
        'catatan',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeningkatanKapasitas extends Model
{
    use HasFactory;

    // Tetapkan nama tabel
    protected $table = 'peningkatan_kapasitas';

    // Daftarkan name input yang diizinkan masuk ke database
    protected $fillable = [
        'nama_kegiatan',
        'penyelenggara',
        'tanggal_mulai',
        'tanggal_selesai',
        'jenis_kegiatan',
        'jumlah_pegawai',
        'dokumen_terkait',
        'catatan',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembinaan extends Model
{
    use HasFactory;

    // Tetapkan nama tabel
    protected $table = 'pembinaan';

    // Daftarkan name input yang diizinkan masuk ke database
    protected $fillable = [
        'nama_program',
        'lokasi',
        'tanggal_pelaksanaan',
        'waktu_mulai',
        'waktu_selesai',
        'sasaran_pembinaan',
        'target_peserta',
        'dokumen_pendukung',
        'catatan',
    ];
}
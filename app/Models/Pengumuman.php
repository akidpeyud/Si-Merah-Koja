<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    // KASIH TAHU LARAVEL NAMA TABEL YANG BENAR
    protected $table = 'pengumumans';

    // Kategori bawaan sesuai controller Anda
    public const KATEGORI = ['Umum', 'Kepegawaian', 'Layanan', 'Penting']; 

    // Kolom-kolom yang diizinkan untuk diisi dari form
    protected $fillable = [
        'judul',
        'kategori',
        'isi',
        'lampiran',
        'penting',
        'dipublikasikan',
        'tanggal',
    ];

    // Filter khusus (scope) untuk menampilkan pengumuman yang sudah terbit saja
    public function scopeTerbit($query)
    {
        return $query->where('dipublikasikan', true);
    }
}
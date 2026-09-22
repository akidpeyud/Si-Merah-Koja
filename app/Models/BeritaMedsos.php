<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaMedsos extends Model
{
    use HasFactory;

    protected $table = 'berita_medsos';

<<<<<<< HEAD
    // Tambahkan baris ini agar diizinkan menyimpan data
    protected $fillable = ['judul', 'tanggal', 'sumber', 'link', 'gambar'];
=======
    // Tambahkan 'kategori_id' agar diizinkan menyimpan data kategori
    protected $fillable = ['kategori_id', 'judul', 'tanggal', 'sumber', 'link', 'gambar'];

    /**
     * Relasi ke model KategoriBerita
     * Setiap berita medsos memiliki satu kategori
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id');
    }
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
}
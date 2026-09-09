<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaMedsos extends Model
{
    use HasFactory;

    protected $table = 'berita_medsos';

    // Tambahkan baris ini agar diizinkan menyimpan data
    protected $fillable = ['judul', 'tanggal', 'sumber', 'link', 'gambar'];
}
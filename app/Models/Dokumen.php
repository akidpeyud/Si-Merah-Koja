<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit (karena default laravel adalah 'dokumens')
    protected $table = 'dokumen';

    // Menentukan kolom apa saja yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'judul_dokumen',
        'nama_file',
        'kategori',
        'sub_kategori'
    ];
}
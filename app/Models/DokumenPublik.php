<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPublik extends Model
{
    use HasFactory;

    protected $table = 'dokumen_publik';

    protected $fillable = [
        'judul_dokumen',
        'kategori',
        'nama_file',
    ];
}
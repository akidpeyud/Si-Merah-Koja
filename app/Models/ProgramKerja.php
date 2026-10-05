<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKerja extends Model
{
    use HasFactory;

    // Ganti 'program_kerja' dengan nama tabel yang sebenarnya di database kamu
    protected $table = 'program_kerja'; 

    // Kolom-kolom yang diizinkan untuk diisi data
    protected $fillable = [
        'judul_dokumen',
        'kategori',
        'sub_kategori',
        'file_dokumen'
    ];
}
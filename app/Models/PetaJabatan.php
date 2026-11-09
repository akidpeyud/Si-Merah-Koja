<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetaJabatan extends Model
{
    use HasFactory;

    protected $table = 'peta_jabatans';

    protected $fillable = [
        'judul',
        'tahun',
        'keterangan',
        'file_dokumen',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerjanjianKerjasama extends Model
{
    use HasFactory;

    protected $table = 'perjanjian_kerjasamas';

    protected $fillable = [
        'nama_perusahaan',
        'nomor_pks',
        'tanggal_perjanjian',
        'tahun',
        'lama_kerjasama',
        'pihak_pertama',
        'pihak_kedua',
        'file_dokumen',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_perjanjian' => 'date',
        'tahun' => 'integer',
    ];
}

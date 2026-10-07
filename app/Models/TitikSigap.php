<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitikSigap extends Model
{
    use HasFactory;

    // Tambahkan 'keterangan' ke dalam fillable
    protected $fillable = [
        'kategori', 
        'nama', 
        'tanggal', 
        'lokasi', 
        'keterangan', // <--- Kolom baru
        'latitude', 
        'longitude'
    ];
}
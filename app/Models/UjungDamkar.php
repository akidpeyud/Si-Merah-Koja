<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjungDamkar extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel secara eksplisit sesuai migration
    protected $table = 'ujung_damkar';

    // Kolom yang diizinkan untuk diisi secara massal (mass assignment)
    protected $fillable = [
        'judul',
        'youtube_id',
        'link_asli',
    ];
}
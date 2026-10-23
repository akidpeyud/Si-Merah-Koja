<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganSekolah extends Model
{
    use HasFactory;

    protected $table = 'kunjungan_sekolahs';
    protected $guarded = [];
}
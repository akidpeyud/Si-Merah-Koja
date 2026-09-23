<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiklatF1 extends Model
{
    use HasFactory;

    // Arahkan spesifik ke tabel lu
    protected $table = 'tbl_diklat_f1';

    // Izinkan semua kolom diisi kecuali ID
    protected $guarded = ['id'];
}
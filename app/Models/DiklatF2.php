<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiklatF2 extends Model
{
    use HasFactory;

    // Asumsi nama tabel lu di phpMyAdmin adalah tbl_diklat_f2
    protected $table = 'tbl_diklat_f2';
    protected $guarded = ['id'];
}
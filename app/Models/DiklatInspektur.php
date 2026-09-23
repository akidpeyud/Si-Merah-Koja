<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiklatInspektur extends Model
{
    use HasFactory;

    // Asumsi nama tabelnya tbl_diklat_inspektur (sesuaikan kalau beda)
    protected $table = 'tbl_diklat_inspektur';
    protected $guarded = ['id'];
}
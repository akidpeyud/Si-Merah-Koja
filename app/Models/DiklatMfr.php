<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiklatMfr extends Model
{
    use HasFactory;

    // Asumsi nama tabel di database adalah tbl_diklat_mfr
    protected $table = 'tbl_diklat_mfr';
    protected $guarded = ['id'];
}
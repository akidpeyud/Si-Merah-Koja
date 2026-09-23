<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiklatRescue extends Model
{
    use HasFactory;

    // Asumsi nama tabel di database lu adalah tbl_diklat_rescue
    protected $table = 'tbl_diklat_rescue';
    protected $guarded = ['id'];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiklatPpl extends Model
{
    use HasFactory;

    // Sesuai dengan nama tabel di database lu
    protected $table = 'tbl_diklat_ppl';
    protected $guarded = ['id'];
}
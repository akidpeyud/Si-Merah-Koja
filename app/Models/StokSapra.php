<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokSapra extends Model
{
    use HasFactory;

    protected $table = 'stok_sapras';
    protected $guarded = ['id']; // Memperbolehkan mass assignment selain ID
}
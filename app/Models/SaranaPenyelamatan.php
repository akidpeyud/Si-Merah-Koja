<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaranaPenyelamatan extends Model
{
    use HasFactory;

    protected $table = 'sarana_penyelamatans';
    protected $guarded = ['id'];
}
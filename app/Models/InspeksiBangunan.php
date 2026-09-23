<?php

namespace App\Models; // <- Ini wajib ada dan huruf besar 'A' & 'M'

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspeksiBangunan extends Model // <- Nama class harus sama persis dengan nama file
{
    use HasFactory;

    protected $table = 'inspeksi_bangunans';
    protected $guarded = [];
}
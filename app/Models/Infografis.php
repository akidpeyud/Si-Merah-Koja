<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infografis extends Model
{
    use HasFactory;

    protected $table = 'infografis';

    // Tambahkan baris ini untuk mengizinkan mass assignment
    protected $fillable = ['judul', 'gambar'];
}
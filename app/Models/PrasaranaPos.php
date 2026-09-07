<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrasaranaPos extends Model
{
    use HasFactory;

    protected $table = 'prasarana_pos';
    protected $fillable = ['lokasi_pos_id', 'jenis_prasarana', 'gambar'];

    // Relasi Belongs-To: 1 Prasarana hanya milik 1 Lokasi
    public function lokasi()
    {
        return $this->belongsTo(LokasiPos::class, 'lokasi_pos_id', 'id');
    }
}
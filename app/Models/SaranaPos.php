<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaranaPos extends Model
{
    use HasFactory;

    protected $table = 'sarana_pos';
    protected $fillable = ['lokasi_pos_id', 'jenis_sarana', 'jumlah', 'gambar'];

    // Relasi: 1 Sarana hanya milik 1 Lokasi Pos
    public function lokasi()
    {
        return $this->belongsTo(LokasiPos::class, 'lokasi_pos_id', 'id');
    }
}
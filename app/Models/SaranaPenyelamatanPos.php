<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaranaPenyelamatanPos extends Model
{
    use HasFactory;

    protected $table = 'sarana_penyelamatan_pos';
    
    protected $fillable = [
        'lokasi_pos_id', 
        'jenis_sarana_penyelamatan', 
        'jumlah', 
        'gambar'
    ];

    // Relasi: 1 Sarana Penyelamatan hanya milik 1 Lokasi Pos
    public function lokasi()
    {
        return $this->belongsTo(LokasiPos::class, 'lokasi_pos_id', 'id');
    }
}
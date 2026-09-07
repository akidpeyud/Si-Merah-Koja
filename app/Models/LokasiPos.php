<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiPos extends Model
{
    use HasFactory;

    protected $table = 'lokasi_pos';
    protected $fillable = ['nama_lokasi', 'tipe', 'alamat'];

    // Anak Ke-1 (Prasarana)
    public function prasarana()
    {
        return $this->hasMany(PrasaranaPos::class, 'lokasi_pos_id', 'id');
    }

    // Anak Ke-2 (Sarana Kebakaran)
    public function sarana()
    {
        return $this->hasMany(SaranaPos::class, 'lokasi_pos_id', 'id');
    }

    // Anak Ke-3 (Sarana Penyelamatan)
    public function saranaPenyelamatan()
    {
        return $this->hasMany(SaranaPenyelamatanPos::class, 'lokasi_pos_id', 'id');
    }
}
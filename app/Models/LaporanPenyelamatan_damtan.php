<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenyelamatan extends Model
{
    use HasFactory;

    protected $guarded = ['id']; // Membuka semua field untuk mass-assignment (kecuali ID)

    // Casting array ke JSON secara otomatis
    protected $casts = [
        'metode_evakuasi' => 'array',
        'metode_penyelamatan' => 'array',
        'peralatan' => 'array',
        'armada' => 'array',
        'instansi_pendukung' => 'array',
        'foto' => 'array', // Jika menyimpan banyak foto
        
        'waktu_kejadian' => 'datetime',
        'waktu_terima' => 'datetime',
        'waktu_berangkat' => 'datetime',
        'waktu_tiba' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    // Relasi ke user yang menginput
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
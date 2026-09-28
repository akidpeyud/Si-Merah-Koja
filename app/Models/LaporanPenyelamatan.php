<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenyelamatan extends Model
{
    use HasFactory;

    protected $guarded = ['id']; // Membuka semua field untuk mass-assignment

    // Casting array ke JSON secara otomatis
    protected $casts = [
        'metode_evakuasi' => 'array',
        'metode_penyelamatan' => 'array',
        'peralatan' => 'array',
        'armada' => 'array',
        'instansi_pendukung' => 'array',
        'foto' => 'array', 
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

    // ====================================================
    // TAMBAHKAN KODE RELASI INI AGAR CONTROLLER BISA JALAN
    // ====================================================

    public function teknisLogistik()
    {
        // Sesuaikan 'id_laporan' jika foreign key di tabel teknis_logistik bernama lain
        return $this->hasOne(LpTeknisLogistik::class, 'laporan_penyelamatan_id', 'id');
    }

    public function dokumentasi()
    {
        return $this->hasOne(LpDokumentasi::class, 'laporan_penyelamatan_id', 'id');
    }

    public function kategoriKhusus()
    {
        return $this->hasOne(LpKategoriKhusus::class, 'laporan_penyelamatan_id', 'id');
    }
}
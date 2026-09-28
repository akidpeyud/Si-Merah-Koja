<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenyelamatan extends Model
{
    use HasFactory;

    // Ubah menjadi 'laporan_penyelamatans' (pakai 's') agar cocok dengan migration
    protected $table = 'laporan_penyelamatans';

    // Mengizinkan mass-assignment untuk semua kolom kecuali 'id'
    protected $guarded = ['id'];

    // Casting tipe data secara otomatis
    protected $casts = [
        'metode_evakuasi' => 'array',
        'metode_penyelamatan' => 'array',
        'peralatan' => 'array',
        'armada' => 'array',
        'instansi_pendukung' => 'array',
        'foto' => 'array', 
    ];

    // ==========================================
    // RELASI KE TABEL / MODEL LAIN
    // ==========================================

    // Relasi ke user yang menginput laporan
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teknisLogistik()
    {
        return $this->hasOne(LpTeknisLogistik::class, 'laporan_penyelamatans_id', 'id');
    }

    public function dokumentasi()
    {
        return $this->hasOne(LpDokumentasi::class, 'laporan_penyelamatans_id', 'id');
    }

    public function kategoriKhusus()
    {
        return $this->hasOne(LpKategoriKhusus::class, 'laporan_penyelamatans_id', 'id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalInspeksi extends Model
{
    use HasFactory;

    // Arahkan ke nama tabel yang benar
    protected $table = 'jadwal_inspeksi';

    // Daftarkan semua name input dari form yang boleh diisi
    protected $fillable = [
        'nama_instansi',
        'tanggal_inspeksi',
        'tim_petugas',
        'alamat',
        'jml_gedung_tinggi',
        'jml_gedung_sedang',
        'jml_gedung_rendah',
        'dokumen_pendukung',
        'catatan',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKorban extends Model
{
    use HasFactory;

    // Menghubungkan model ini ke tabel 'surat_korbans' di database
    protected $table = 'surat_korbans';

    // Mendaftarkan kolom apa saja yang diizinkan untuk diisi data (Security Laravel)
    protected $fillable = [
        'nomor_surat',
        'nama_korban',
        'status_kepemilikan',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'status_perkawinan',
        'pekerjaan',
        'alamat',
        'objek_terbakar',
        'hari_kejadian',
        'tanggal_kejadian',
        'waktu_kejadian',
        'tembusan_camat',
        'tembusan_lurah',
        'tanggal_surat',
    ];
}
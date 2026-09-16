<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanRpkbgl extends Model
{
    use HasFactory;

    protected $table = 'permohonan_rpkbgl';

    protected $fillable = [
        'nama_pemohon',
        'email_pemohon',
        'no_whatsapp',
        'nama_usaha',
        'nik_pemilik_usaha',
        'alamat_pemilik_usaha',
        'kategori_bangunan',
        'alamat_bangunan',
        'kecamatan',  // Menggunakan nama kecamatan
        'kelurahan',  // Menggunakan nama kelurahan
        'luas_lahan',
        'luas_bangunan',
        'tinggi_bangunan',
        'file_surat_permohonan',
        'file_persyaratan_lainnya',
        'status_permohonan',
    ];
}
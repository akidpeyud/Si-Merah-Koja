<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanPerpanjangSkk extends Model
{
    use HasFactory;

    protected $table = 'permohonan_perpanjang_skk';

    protected $fillable = [
        'nama_pemohon', 'email_pemohon', 'no_whatsapp', 'nama_usaha',
        'nik_pemilik_usaha', 'alamat_pemilik_usaha', 'kategori_bangunan',
        'alamat_bangunan', 'kecamatan', 'kelurahan', 'luas_lahan',
        'luas_bangunan', 'tinggi_bangunan', 'nomor_skk_lama',
        'tanggal_terbit_skk_lama', 'masa_berlaku_skk_lama', 'file_skk_lama',
        'file_surat_permohonan', 'file_persyaratan_lainnya', 'status_permohonan',
    ];
}

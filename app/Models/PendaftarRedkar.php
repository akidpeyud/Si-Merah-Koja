<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftarRedkar extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika diperlukan (opsional, Laravel otomatis mendeteksi 'pendaftar_redkars')
    protected $table = 'pendaftar_redkars';

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'status_perkawinan',
        'agama',
        'nomor_telp',
        'file_ktp',
        'alamat',
        'rt_rw',
        'kode_pos',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'kelurahan',
        'pekerjaan',
        'pendidikan_terakhir',
        'sehat_jasmani',
        'buta_warna',
        'golongan_darah',
        'status_pendaftaran',
    ];
}
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class RedkarRegistration extends Authenticatable
{
    use Notifiable;

    protected $table = 'redkar_registrations';

    // ========================================================
    // KODE WAJIB UNTUK PRIMARY KEY STRING (CUSTOM ID)
    // ========================================================
    public $incrementing = false; // Matikan auto-increment (1, 2, 3...)
    protected $keyType = 'string'; // Beritahu Laravel bahwa ID berbentuk huruf/string
    // ========================================================

    protected $fillable = [
        'id', // Wajib dimasukkan ke fillable agar bisa diisi manual (RDK-...)
        'username',
        'password',
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
        'pendidikan_terakhir',
        'latar_belakang_pendidikan',
        'pekerjaan',
        'sehat_jasmani',
        'buta_warna',
        'golongan_darah',
        'status_akun',
        'status_pendaftaran',
    ];

    protected $hidden = [
        'password',
    ];
}
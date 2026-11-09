<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class RedkarRegistration extends Authenticatable
{
    use Notifiable;

    protected $table = 'redkar_registrations';

    protected $fillable = [
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
        'tanggal_pembentukan',
        'tanggal_pengukuhan',
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
        'kartu_anggota',
        'status_akun',
        'status_pendaftaran',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_pembentukan' => 'date',
        'tanggal_pengukuhan' => 'date',
    ];
}

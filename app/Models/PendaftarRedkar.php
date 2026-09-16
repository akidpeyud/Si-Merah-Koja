<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftarRedkar extends Model
{
    use HasFactory;

    protected $table = 'redkar_registrations';

    // BAGIAN PENTING: Mencegah PHP/Laravel mengubah ID string menjadi angka 0
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',                        
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
        'pekerjaan',
        'pendidikan_terakhir',
        'latar_belakang_pendidikan', 
        'sehat_jasmani',
        'golongan_darah',
        'status_pendaftaran',
        'status_akun',
    ];

    protected $hidden = [
        'password',
    ];
}
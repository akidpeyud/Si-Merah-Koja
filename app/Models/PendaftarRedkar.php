<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PendaftarRedkar extends Authenticatable
{
    use HasFactory;

    protected $table = 'redkar_registrations';

    // Mencegah PHP/Laravel mengubah ID string menjadi angka 0
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

    // ========================================================
    // PERBAIKAN: Menonaktifkan fitur remember_token bawaan
    // karena tabel redkar_registrations tidak punya kolom tersebut.
    // ========================================================
    public function getRememberTokenName()
    {
        return null; // Mematikan remember token
    }

    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute) {
            parent::setAttribute($key, $value);
        }
    }
}
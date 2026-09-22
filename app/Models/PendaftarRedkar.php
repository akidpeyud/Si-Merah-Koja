<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;

class PendaftarRedkar extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika diperlukan (opsional, Laravel otomatis mendeteksi 'pendaftar_redkars')
    protected $table = 'pendaftar_redkars';

    protected $fillable = [
=======
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
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
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
<<<<<<< HEAD
        'sehat_jasmani',
        'buta_warna',
        'golongan_darah',
        'status_pendaftaran',
    ];
=======
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
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PendaftarRedkar extends Model
{
    use HasFactory;

    protected $table = 'redkar_registrations';

    // Mencegah PHP/Laravel mengubah ID string ("RDK-...") menjadi angka 0
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
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
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'kelurahan',
        'pekerjaan',
        'pendidikan_terakhir',
        'latar_belakang_pendidikan',
        'sehat_jasmani',
        'buta_warna',
        'golongan_darah',
        'status_pendaftaran',
    ];

    /**
     * Accessor untuk mengubah nilai L / P di database 
     * menjadi Laki-Laki / Perempuan saat dipanggil.
     */
    protected function jenisKelamin(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value === 'L' ? 'Laki-Laki' : 'Perempuan',
        );
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftarRedkar extends Model
{
    use HasFactory;

    protected $table = 'redkar_registrations';

    protected $fillable = [
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
        'kartu_anggota',
        'status_pendaftaran',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Accessor jenis kelamin.
     * Menerima format lama (L / P) maupun format baru (Laki-Laki / Perempuan)
     * dan selalu mengembalikan "Laki-Laki" atau "Perempuan".
     */
    protected function jenisKelamin(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => match (strtoupper(trim((string) $value))) {
                'L', 'LAKI-LAKI' => 'Laki-Laki',
                'P', 'PEREMPUAN' => 'Perempuan',
                default => $value,
            },
        );
    }

    /**
     * Accessor sehat jasmani dan rohani.
     * Mengembalikan "Sehat" atau "Tidak".
     */
    protected function sehatJasmani(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => match (strtoupper(trim((string) $value))) {
                'YA', 'SEHAT' => 'Sehat',
                'TIDAK' => 'Tidak',
                default => $value ?? 'Sehat',
            },
        );
    }

    /**
     * Accessor buta warna.
     * Mengembalikan "Iya" atau "Tidak".
     */
    protected function butaWarna(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => match (strtoupper(trim((string) $value))) {
                'IYA', 'YA' => 'Iya',
                'TIDAK' => 'Tidak',
                default => $value ?? 'Tidak',
            },
        );
    }
}

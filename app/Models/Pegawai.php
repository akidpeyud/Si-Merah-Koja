<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit (opsional jika mengikuti standar jamak bahasa Inggris, tapi disarankan)
    protected $table = 'pegawais'; 

    // Mendaftarkan kolom-kolom yang diizinkan untuk diisi secara massal (Mass Assignment)
    protected $fillable = [
        'no_urut',
        'nip',
        'nama',
        'tempat_tanggal_lahir',
        'jenis_kelamin',
        'status_pegawai',
        'pangkat_gol_ruang',
        'pangkat_tmt',
        'jabatan_nama',
        'jabatan_tmt',
        'masa_kerja_th',
        'masa_kerja_bln',
        'pendidikan_tingkat_ijazah',
        'pendidikan_nama',
        'pendidikan_tahun_lulus',
        'latihan_jabatan_nama',
        'latihan_jabatan_tahun_lulus',
        'latihan_jabatan_tempat',
        'catatan_mutasi_pegawai',
    ];
}
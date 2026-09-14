<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanEdukasi extends Model
{
    use HasFactory;

    protected $table = 'permohonan_edukasi';

    protected $fillable = [
        'institusi', 'alamat_institusi', 'kecamatan', 'kelurahan',
        'nama_pemohon', 'jabatan_pemohon', 'nik', 'no_kontak', 'tgl_kegiatan',
        'usia_3_6', 'usia_7_12', 'usia_13_18', 'usia_18_keatas',
        'surat_permohonan', 'syarat_lainnya', 'status_permohonan'
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SosialisasiEdukasi extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel secara manual karena menggunakan bahasa Indonesia
    protected $table = 'sosialisasi_edukasi';

    // Kolom-kolom yang diizinkan untuk diisi secara massal (Mass Assignment)
    protected $fillable = [
        'jenis_kegiatan',
        'no_tanggal_surat_permohonan',
        'nama_instansi',
        'tempat_pelaksanaan',
        'alamat',
        'tanggal_pelaksanaan',
        'jumlah_peserta',
        'nama_penanggung_jawab',
        'no_telepon',
        'surat_perintah_tugas',
    ];
}

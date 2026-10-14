<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenggunaanSarana extends Model
{
    // Samakan dengan nama tabel di file migration Anda
    // (Schema::create('...')). Cek dulu: 'penggunaan_sarana' atau 'penggunaan_saranas'.
    protected $table = 'penggunaan_sarana';

    protected $fillable = [
        'pemohon_id',
        'nama',
        'nik',
        'no_hp',
        'alamat',
        'jenis_pemohon',
        'nama_penanggung_jawab',
        'nama_instansi',
        'alamat_instansi',
        'sarana',
        'kegunaan',
        'nama_kegiatan',
        'lokasi_kegiatan',
        'tgl_pelaksanaan',
        'waktu_mulai',
        'waktu_selesai',
        'foto_lokasi',
        'surat_permohonan',
        'status',
    ];

    protected $casts = [
        'tgl_pelaksanaan' => 'date',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanRpkbgl extends Model
{
    use HasFactory;

    protected $table = 'permohonan_rpkbgl';

    /**
     * Semua kolom pada migration permohonan_rpkbgl (kecuali id, created_at, updated_at).
     * Kolom yang tidak ada di sini akan diabaikan diam-diam oleh Model::update()/create().
     */
    protected $fillable = [
        // Data pemohon & usaha
        'nama_pemohon',
        'email_pemohon',
        'no_whatsapp',
        'nama_usaha',
        'nik_pemilik_usaha',
        'alamat_pemilik_usaha',

        // Data bangunan
        'kategori_bangunan',
        'alamat_bangunan',
        'kecamatan',
        'kelurahan',
        'luas_lahan',
        'luas_bangunan',
        'tinggi_bangunan',
        'ada_lift',
        'tgl_pemeriksaan',

        // Berkas persyaratan administrasi
        'file_surat_permohonan',
        'file_fotokopi_ktp',
        'file_nib',
        'file_pbg_imb',
        'file_slo_listrik',
        'file_slf_bangunan',
        'file_denah_bangunan',
        'file_pjk3',
        'file_data_teknis_proteksi',
        'file_persyaratan_lainnya',

        // Status
        'status_permohonan',
    ];

    // Kolom JSON otomatis menjadi array saat dibaca, dan otomatis di-encode saat disimpan
    protected $casts = [
        'file_data_teknis_proteksi' => 'array',
        'file_persyaratan_lainnya'  => 'array',
        'tgl_pemeriksaan'           => 'date',
        'luas_lahan'                => 'decimal:2',
        'luas_bangunan'             => 'decimal:2',
        'tinggi_bangunan'           => 'decimal:2',
    ];
}
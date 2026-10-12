<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IkmResponden extends Model
{
    protected $table = 'ikm_respondens';

    protected $fillable = [
        'nama', 'jenis_layanan',
        'u1', 'u2', 'u3', 'u4', 'u5', 'u6', 'u7', 'u8', 'u9',
        'saran',
    ];

    /** 9 unsur pelayanan menurut Permenpan RB No. 14 Tahun 2017 */
    public const UNSUR = [
        1 => 'Persyaratan pelayanan',
        2 => 'Sistem, mekanisme, dan prosedur',
        3 => 'Waktu penyelesaian',
        4 => 'Biaya / tarif',
        5 => 'Produk spesifikasi jenis pelayanan',
        6 => 'Kompetensi pelaksana',
        7 => 'Perilaku pelaksana',
        8 => 'Penanganan pengaduan, saran, dan masukan',
        9 => 'Sarana dan prasarana',
    ];

    public const JENIS_LAYANAN = [
        'RPKBGL',
        'SKK & Perpanjang SKK',
        'Edukasi dan sosialisasi',
        'Izin keramaian',
        'Pemadaman & penyelamatan',
        'Redkar',
        'Lainnya',
    ];
}
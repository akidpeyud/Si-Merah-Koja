<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilInstansi extends Model
{
    use HasFactory;

    protected $table = 'profil_instansis';

    protected $fillable = [
        'kategori',
        'judul',
        'tahun',
        'keterangan',
        'file_dokumen',
    ];

    /**
     * Daftar kategori profil instansi yang dikelola melalui dashboard internal
     */
    public static function daftarKategori(): array
    {
        return [
            'visi-misi' => 'Visi Misi',
            'sotk' => 'SOTK',
            'tupoksi' => 'Tupoksi',
            'program-kegiatan' => 'Program Kegiatan',
            'cascading' => 'Cascading',
        ];
    }

    /**
     * Helper untuk mengambil nama label dari slug kategori
     */
    public function getNamaKategoriAttribute(): string
    {
        return self::daftarKategori()[$this->kategori] ?? 'Profil Instansi';
    }
}

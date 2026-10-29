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
     * Daftar 4 kategori profil instansi (tanpa Kepegawaian & Visi Misi yang statis)
     */
    public static function daftarKategori(): array
    {
        return [
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

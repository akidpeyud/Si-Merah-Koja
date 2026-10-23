<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kejadian extends Model
{
    protected $table = 'kejadian_damkar';

    protected $fillable = [
        'judul', 'jenis', 'lokasi', 'tanggal', 'deskripsi',
        'link', 'sumber', 'gambar', 'youtube_id',
    ];

    protected $casts = ['tanggal' => 'datetime'];

    public const JENIS = [
        'pemadaman'    => 'Pemadaman',
        'penyelamatan' => 'Penyelamatan',
        'evakuasi'     => 'Evakuasi',
    ];

    public function getJenisLabelAttribute()
    {
        return self::JENIS[$this->jenis] ?? ucfirst((string) $this->jenis);
    }

    public function getGambarSrcAttribute()
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : null;
    }

    public function getThumbAttribute()
    {
        return $this->gambar_src
            ?: ($this->youtube_id ? "https://i.ytimg.com/vi/{$this->youtube_id}/hqdefault.jpg" : '/images/placeholder.jpg');
    }
}
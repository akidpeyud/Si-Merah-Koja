<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pengumuman extends Model
{
    protected $table = 'pengumumans';

    protected $fillable = [
        'judul', 'kategori', 'isi', 'lampiran', 'penting', 'dipublikasikan', 'tanggal',
    ];

    protected $casts = [
        'penting'        => 'boolean',
        'dipublikasikan' => 'boolean',
        'tanggal'        => 'date',
    ];

    public const KATEGORI = ['Umum', 'Layanan', 'Kegiatan', 'Perizinan', 'Lowongan'];

    /** Hanya pengumuman yang sudah dipublikasikan */
    public function scopeTerbit(Builder $query): Builder
    {
        return $query->where('dipublikasikan', true);
    }

    /** Ringkasan isi tanpa tag HTML, untuk kartu daftar */
    public function getRingkasanAttribute(): string
    {
        return Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($this->isi))), 160);
    }
}
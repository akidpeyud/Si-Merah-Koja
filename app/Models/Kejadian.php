<?php

namespace App\Models;

use App\Http\Controllers\KejadianController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Kejadian extends Model
{
    protected $table = 'kejadian_damkar';

    protected $fillable = [
        'judul', 'jenis', 'lokasi', 'tanggal', 'deskripsi',
        'link', 'sumber', 'gambar', 'youtube_id',
    ];

    protected $casts = ['tanggal' => 'datetime'];

    public const JENIS = [
        'pemadaman' => 'Pemadaman',
        'penyelamatan' => 'Penyelamatan',
        'evakuasi' => 'Evakuasi',
    ];

    public function getJenisLabelAttribute()
    {
        return self::JENIS[$this->jenis] ?? ucfirst((string) $this->jenis);
    }

    /**
     * Kolom `gambar` bisa berisi:
     *  - path storage ("kejadian/abc.jpg")  -> hasil upload / Tarik Data
     *  - URL penuh ("https://images...")    -> data seeder
     * URL penuh dipakai apa adanya, path storage diberi asset('storage/...').
     */
    public function getGambarSrcAttribute()
    {
        $g = trim((string) $this->gambar);

        if ($g !== '') {
            if (preg_match('#^https?://#i', $g)) {
                return $g;
            }

            $clean = ltrim(preg_replace('#^/?(public/|storage/)#', '', $g), '/');
            if (Storage::disk('public')->exists($clean)) {
                return asset('storage/'.$clean);
            }
        }

        if (! empty($this->link)) {
            app(KejadianController::class)->syncImageFromLink($this);

            $g = trim((string) $this->gambar);
            if ($g !== '') {
                if (preg_match('#^https?://#i', $g)) {
                    return $g;
                }

                $clean = ltrim(preg_replace('#^/?(public/|storage/)#', '', $g), '/');
                if (Storage::disk('public')->exists($clean)) {
                    return asset('storage/'.$clean);
                }
            }
        }

        return null;
    }

    public function getThumbAttribute()
    {
        return $this->gambar_src
            ?: ($this->youtube_id ? "https://i.ytimg.com/vi/{$this->youtube_id}/hqdefault.jpg" : '/images/placeholder.jpg');
    }
}

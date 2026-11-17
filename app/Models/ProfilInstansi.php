<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProfilInstansi extends Model
{
    use HasFactory;

    protected $table = 'profil_instansis';

    protected $fillable = [
        'kategori',
        'sub_kategori',
        'judul',
        'tahun',
        'keterangan',
        'file_dokumen',
        'urutan',
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

    /**
     * Mendapatkan path dan URL file gambaran besar / infografis visual untuk kategori tertentu
     */
    public static function getGambaranBesar(string $kategori): ?array
    {
        $dir = "profil-instansi/{$kategori}";
        if (Storage::disk('public')->exists($dir)) {
            $files = Storage::disk('public')->files($dir);
            foreach ($files as $file) {
                $filename = basename($file);
                if (str_starts_with($filename, "gambaran-besar-{$kategori}.")) {
                    return [
                        'filename' => $filename,
                        'path' => $file,
                        'url' => asset('storage/'.$file),
                        'updated_at' => Storage::disk('public')->lastModified($file),
                    ];
                }
            }
        }

        // Cek juga di seed-files jika belum pernah di-copy ke folder aktif
        $seedDir = "seed-files/{$kategori}";
        if (Storage::disk('public')->exists($seedDir)) {
            $seedFiles = Storage::disk('public')->files($seedDir);
            foreach ($seedFiles as $file) {
                $filename = basename($file);
                if (str_starts_with($filename, "gambaran-besar-{$kategori}.")) {
                    $target = "profil-instansi/{$kategori}/{$filename}";
                    Storage::disk('public')->copy($file, $target);

                    return [
                        'filename' => $filename,
                        'path' => $target,
                        'url' => asset('storage/'.$target),
                        'updated_at' => Storage::disk('public')->lastModified($target),
                    ];
                }
            }
        }

        return null;
    }
}

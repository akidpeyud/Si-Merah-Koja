<?php

namespace App\Http\Controllers;

use App\Models\BeritaMedsos;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class KabarDamkarController extends Controller
{
    /**
     * Halaman publik Media Informasi (/media-informasi)
     * View : resources/views/galery/berita/media_informasi.blade.php
     *
     * Variabel yang dipakai view:
     *  - $medsos          : data berita medsos (paginate)
     *  - $daftar_kategori : daftar kategori untuk tab filter
     *  - $kategoriId      : id kategori yang sedang aktif (null = semua)
     */
    public function indexMediaInformasi(Request $request)
    {
        $kategoriId = $request->query('kategori');

        // Ambil model & kolom relasi kategori langsung dari relasi BeritaMedsos::kategori(),
        // jadi tidak perlu menebak nama model/kolom kategori.
        $relasi = (new BeritaMedsos)->kategori();
        $modelKategori = $relasi->getRelated();
        $kolomKategori = $relasi->getForeignKeyName();

        $daftar_kategori = $modelKategori->newQuery()
            ->where('nama_kategori', '!=', 'Lainya')
            ->orderBy('id')
            ->get();

        if ($kategoriId === 'pengumuman') {
            $q = trim((string) $request->query('q', ''));
            $katPengumuman = $request->query('kat_pengumuman');

            $pgQuery = Pengumuman::terbit();

            if ($q !== '') {
                $pgQuery->where(function ($w) use ($q) {
                    $w->where('judul', 'like', "%{$q}%")
                        ->orWhere('isi', 'like', "%{$q}%");
                });
            }

            if (! empty($katPengumuman) && in_array($katPengumuman, Pengumuman::KATEGORI, true)) {
                if ($katPengumuman === 'Penting') {
                    $pgQuery->where(function ($w) {
                        $w->where('kategori', 'Penting')
                            ->orWhere('penting', true);
                    });
                } else {
                    $pgQuery->where('kategori', $katPengumuman);
                }
            }

            $daftar_pengumuman = $pgQuery
                ->orderByDesc('penting')
                ->orderByDesc('tanggal')
                ->orderByDesc('id')
                ->paginate(9)
                ->withQueryString();

            $medsos = collect();
            $daftar_kategori_pengumuman = Pengumuman::KATEGORI;

            return view('galery.berita.media_informasi', compact(
                'medsos',
                'daftar_kategori',
                'kategoriId',
                'daftar_pengumuman',
                'daftar_kategori_pengumuman',
                'katPengumuman',
                'q'
            ));
        }

        $query = BeritaMedsos::with('kategori')->orderByDesc('tanggal');

        if (! empty($kategoriId)) {
            // Jika ada yang membuka kategori typo 'Lainya', alihkan ke 'Lainnya' yang valid
            $katCek = $modelKategori->find($kategoriId);
            if ($katCek && strcasecmp($katCek->nama_kategori, 'Lainya') === 0) {
                $katLainnya = $modelKategori->newQuery()->where('nama_kategori', 'Lainnya')->first();
                if ($katLainnya) {
                    return redirect()->route('media.informasi', ['kategori' => $katLainnya->id]);
                }
            }
            $query->where($kolomKategori, $kategoriId);
        }

        $medsos = $query->paginate(12)->withQueryString();

        app(OperatorMedsosController::class)->syncMissingImages($medsos->getCollection());

        $daftar_pengumuman = collect();

        return view('galery.berita.media_informasi', compact('medsos', 'daftar_kategori', 'kategoriId', 'daftar_pengumuman'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\BeritaMedsos;
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
        $relasi         = (new BeritaMedsos)->kategori();
        $modelKategori  = $relasi->getRelated();
        $kolomKategori  = $relasi->getForeignKeyName();

        $query = BeritaMedsos::with('kategori')->orderByDesc('tanggal');

        if (!empty($kategoriId)) {
            $query->where($kolomKategori, $kategoriId);
        }

        $medsos = $query->paginate(12)->withQueryString();

        $daftar_kategori = $modelKategori->newQuery()->orderBy('id')->get();

        return view('galery.berita.media_informasi', compact('medsos', 'daftar_kategori', 'kategoriId'));
    }
}
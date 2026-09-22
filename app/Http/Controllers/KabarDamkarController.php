<?php

namespace App\Http\Controllers;

use App\Models\BeritaMedsos;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;

class KabarDamkarController extends Controller
{
    /**
     * Menampilkan halaman Media Informasi (Berita Medsos) untuk publik
     */
    public function indexMediaInformasi(Request $request)
    {
        // 1. Ambil parameter 'kategori' dari URL (misal: situs.com/media-informasi?kategori=1)
        $kategoriId = $request->query('kategori');

        // 2. Ambil semua data kategori untuk ditampilkan sebagai tombol filter di atas halaman
        $daftar_kategori = KategoriBerita::all();

        // 3. Siapkan query dasar: Tarik data medsos beserta relasi kategorinya
        // Urutkan dari tanggal postingan yang paling baru (descending)
        $query = BeritaMedsos::with('kategori')->orderBy('tanggal', 'desc');

        // 4. Jika pengunjung mengklik salah satu tombol kategori, filter datanya
        if ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        }

        // 5. Eksekusi query dengan Pagination (tampil 12 kotak per halaman)
        // withQueryString() berguna agar saat pindah halaman (page=2), parameter filter kategori tidak hilang
        $medsos = $query->paginate(12)->withQueryString();

        // 6. Lempar semua data ke file blade view
        return view('kabardamkar.media_informasi', compact('medsos', 'daftar_kategori', 'kategoriId'));
    }
}
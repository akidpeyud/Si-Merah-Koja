<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    /** Daftar pengumuman publik (/pengumuman) */
    public function index(Request $request)
    {
        $q        = trim((string) $request->query('q', ''));
        $kategori = $request->query('kategori');

        $query = Pengumuman::terbit();

        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('judul', 'like', "%{$q}%")
                  ->orWhere('isi', 'like', "%{$q}%");
            });
        }

        if (!empty($kategori) && in_array($kategori, Pengumuman::KATEGORI, true)) {
            $query->where('kategori', $kategori);
        }

        // Penting dulu, lalu terbaru
        $daftar_pengumuman = $query
            ->orderByDesc('penting')
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->paginate(9)
            ->withQueryString();

        return view('galery.pengumuman.index', [
            'daftar_pengumuman' => $daftar_pengumuman,
            'daftar_kategori'   => Pengumuman::KATEGORI,
            'q'                 => $q,
            'kategori'          => $kategori,
        ]);
    }

    /** Detail pengumuman (/pengumuman/{id}) */
    public function show($id)
    {
        $pengumuman = Pengumuman::terbit()->findOrFail($id);

        $lainnya = Pengumuman::terbit()
            ->where('id', '!=', $pengumuman->id)
            ->orderByDesc('tanggal')->orderByDesc('id')
            ->take(3)->get();

        return view('galery.pengumuman.show', compact('pengumuman', 'lainnya'));
    }
}
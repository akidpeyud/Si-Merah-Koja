<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    // =========================================================================
    // 1. BAGIAN PUBLIK (Untuk Halaman Depan / Masyarakat)
    // =========================================================================

    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $kategori = $request->query('kategori');

        $query = Pengumuman::terbit();

        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('judul', 'like', "%{$q}%")
                    ->orWhere('isi', 'like', "%{$q}%");
            });
        }

        if (! empty($kategori) && in_array($kategori, Pengumuman::KATEGORI, true)) {
            $query->where('kategori', $kategori);
        }

        $daftar_pengumuman = $query
            ->orderByDesc('penting')
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->paginate(9)
            ->withQueryString();

        return view('galery.pengumuman.index', [
            'daftar_pengumuman' => $daftar_pengumuman,
            'daftar_kategori' => Pengumuman::KATEGORI,
            'q' => $q,
            'kategori' => $kategori,
        ]);
    }

    public function show($id)
    {
        $pengumuman = Pengumuman::terbit()->findOrFail($id);

        $lainnya = Pengumuman::terbit()
            ->where('id', '!=', $pengumuman->id)
            ->orderByDesc('tanggal')->orderByDesc('id')
            ->take(3)->get();

        return view('galery.pengumuman.show', compact('pengumuman', 'lainnya'));
    }

    // =========================================================================
    // 2. BAGIAN INTERNAL (Untuk Dashboard Operator / Admin)
    // =========================================================================

    public function indexInternal()
    {
        $pengumuman = Pengumuman::orderByDesc('tanggal')->orderByDesc('id')->get();

        return view('internal.operator.opratorpengumuman', compact('pengumuman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:50',
            'isi_pengumuman' => 'required',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'tanggal' => 'required|date',
        ]);

        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi_pengumuman,
            'kategori' => $request->kategori ?? 'Umum',
            'tanggal' => $request->tanggal,
            'penting' => $request->has('penting') ? true : false,
            'dipublikasikan' => true,
        ];

        // Pakai nama kolom 'lampiran' sesuai migration
        if ($request->hasFile('lampiran')) {
            $data['lampiran'] = $request->file('lampiran')->store('pengumuman', 'public');
        }

        Pengumuman::create($data);

        return redirect()->back()->with('success', 'Pengumuman berhasil dipublikasikan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:50',
            'isi_pengumuman' => 'required',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'tanggal' => 'required|date',
        ]);

        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->judul = $request->judul;
        $pengumuman->isi = $request->isi_pengumuman;
        $pengumuman->kategori = $request->kategori ?? 'Umum';
        $pengumuman->tanggal = $request->tanggal;
        $pengumuman->penting = $request->has('penting') ? true : false;

        if ($request->hasFile('lampiran')) {
            // Hapus file lama jika ada
            if ($pengumuman->lampiran && Storage::disk('public')->exists($pengumuman->lampiran)) {
                Storage::disk('public')->delete($pengumuman->lampiran);
            }
            // Simpan file baru
            $pengumuman->lampiran = $request->file('lampiran')->store('pengumuman', 'public');
        }

        $pengumuman->save();

        return redirect()->back()->with('success', 'Pengumuman berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        // Hapus file fisik dari server jika ada
        if ($pengumuman->lampiran && Storage::disk('public')->exists($pengumuman->lampiran)) {
            Storage::disk('public')->delete($pengumuman->lampiran);
        }

        $pengumuman->delete();

        return redirect()->back()->with('success', 'Pengumuman berhasil dihapus!');
    }
}

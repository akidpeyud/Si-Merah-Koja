<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    // Cek Hak Akses Operator
    private function cekAkses() {
        if (!Auth::check() || !in_array(Auth::user()->role, ['operator', 'super_user'])) {
            abort(403, 'Akses Ditolak! Halaman ini khusus untuk Operator.');
        }
    }

    // Read Publik (Detail Berita)
    public function showPublic($id)
    {
        $berita = Berita::findOrFail($id);
        return view('public.berita_detail', compact('berita'));
    }

    // Read Internal (Tabel Kelola Berita)
    public function indexInternal()
    {
        $this->cekAkses();
        $berita = Berita::orderBy('tanggal_kejadian', 'desc')->get();
        return view('internal.operator.kelola_berita', compact('berita'));
    }

    // Form Tambah Berita
    public function create()
    {
        $this->cekAkses();
        return view('internal.operator.form_berita');
    }

    // Simpan Data Baru (Create)
    public function store(Request $request)
    {
        $this->cekAkses();
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'tanggal_kejadian' => 'required|date',
            'waktu_kejadian' => 'required',
            'pelapor' => 'required|string',
            'sumber_informasi' => 'required|string',
            'keterangan_singkat' => 'required|string',
            'detail_lengkap' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita_images', 'public');
        }

        Berita::create($data);

        return redirect('/internal/operator/kelola-berita')->with('success', 'Berita berhasil ditambahkan!');
    }

    // Form Edit Berita (Update Part 1)
    public function edit($id)
    {
        $this->cekAkses();
        $berita = Berita::findOrFail($id);
        return view('internal.operator.form_berita', compact('berita'));
    }

    // Proses Update Data (Update Part 2)
    public function update(Request $request, $id)
    {
        $this->cekAkses();
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'tanggal_kejadian' => 'required|date',
            'waktu_kejadian' => 'required',
            'pelapor' => 'required|string',
            'sumber_informasi' => 'required|string',
            'keterangan_singkat' => 'required|string',
            'detail_lengkap' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita_images', 'public');
        }

        $berita->update($data);

        return redirect('/internal/operator/kelola-berita')->with('success', 'Berita berhasil diperbarui!');
    }

    // Hapus Berita (Delete)
    public function destroy($id)
    {
        $this->cekAkses();
        $berita = Berita::findOrFail($id);

        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect('/internal/operator/kelola-berita')->with('success', 'Berita berhasil dihapus!');
    }
}
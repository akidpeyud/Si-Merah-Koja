<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\KategoriBerita; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http; // Wajib untuk fitur tarik link otomatis

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
        $berita = Berita::with('kategori')->findOrFail($id);
        return view('public.berita_detail', compact('berita'));
    }

    // Read Publik (Daftar Berita Berdasarkan Kategori)
    public function showByKategori($slug)
    {
        $namaKategori = ucwords(str_replace('-', ' ', $slug));
        $kategori = KategoriBerita::where('nama_kategori', 'LIKE', "%{$namaKategori}%")->firstOrFail();
        
        $berita = Berita::where('kategori_id', $kategori->id)
                        ->orderBy('tanggal_kejadian', 'desc')
                        ->get();
                        
        return view('public.berita_kategori', compact('berita', 'kategori'));
    }

    // Read Internal (Tabel Kelola Berita)
    public function indexInternal()
    {
        $this->cekAkses();
        $berita = Berita::with('kategori')->orderBy('tanggal_kejadian', 'desc')->get();
        return view('internal.operator.kelola_berita', compact('berita'));
    }

    // Form Tambah Berita
    public function create()
    {
        $this->cekAkses();
        $kategori = KategoriBerita::all(); 
        return view('internal.operator.form_berita', compact('kategori'));
    }

    // Simpan Data Baru (Create)
    public function store(Request $request)
    {
        $this->cekAkses();
        
        $request->validate([
            'kategori_id' => 'required|exists:kategori_berita,id',
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
        $kategori = KategoriBerita::all();
        
        return view('internal.operator.form_berita', compact('berita', 'kategori'));
    }

    // Proses Update Data (Update Part 2)
    public function update(Request $request, $id)
    {
        $this->cekAkses();
        $berita = Berita::findOrFail($id);

        $request->validate([
            'kategori_id' => 'required|exists:kategori_berita,id',
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

    // ==============================================================
    // FUNGSI TARIK DATA (ANTI-CRASH) MENGGUNAKAN REGEX & THROWABLE
    // ==============================================================
    public function fetchLinkPreview(Request $request)
    {
        $this->cekAkses();
        $url = $request->input('url');

        if (!$url) {
            return response()->json(['error' => 'URL tidak valid'], 400);
        }

        try {
            // Gunakan Laravel HTTP client murni dengan penyamaran User-Agent
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0.0.0 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
            ])->withOptions([
                'verify' => false, // Bypass SSL Error Localhost
            ])->timeout(15)->get($url);

            if (!$response->successful()) {
                return response()->json(['error' => 'Website menolak akses. Kode Error: ' . $response->status()], 400);
            }

            $html = $response->body();
            $title = '';
            $image = '';

            // Ekstrak Judul menggunakan Regex (Aman dari struktur HTML rusak)
            if (preg_match('/<meta[^>]*property=[\'"]og:title[\'"][^>]*content=[\'"]([^\'"]+)[\'"]/i', $html, $matches) ||
                preg_match('/<title[^>]*>([^<]+)<\/title>/i', $html, $matches)) {
                $title = trim($matches[1]);
            }

            // Ekstrak Gambar menggunakan Regex
            if (preg_match('/<meta[^>]*property=[\'"]og:image[\'"][^>]*content=[\'"]([^\'"]+)[\'"]/i', $html, $matches)) {
                $image = trim($matches[1]);
            }

            // Bersihkan karakter (contoh: &amp; menjadi &)
            $title = html_entity_decode($title, ENT_QUOTES, 'UTF-8');

            return response()->json([
                'title' => $title,
                'image' => $image
            ]);

        } catch (\Throwable $e) { 
            // Menangkap SEGALA JENIS error termasuk Fatal Error PHP
            return response()->json(['error' => 'Sistem Error: Gagal mengakses URL. Pastikan link aktif.'], 500);
        }
    }
}
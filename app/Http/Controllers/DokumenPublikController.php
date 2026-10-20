<?php

namespace App\Http\Controllers;

use App\Models\DokumenPublik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenPublikController extends Controller
{
    // Menampilkan daftar dokumen publik di halaman dashboard internal
    public function index(Request $request)
{
    $kategoriList = ['Renstra', 'Renja', 'SPM', 'SAKIP', 'LPPD'];

    $query = DokumenPublik::query();

    if ($request->filled('kategori')) {
        $query->where('kategori', $request->kategori);
    }

    $dokumens = $query
        ->orderByDesc('created_at')
        ->orderByDesc('id')
        ->paginate(10)
        ->withQueryString();

    $totalDokumen = DokumenPublik::count();

    $statistikKategori = DokumenPublik::query()
        ->selectRaw('kategori, COUNT(*) as total')
        ->groupBy('kategori')
        ->pluck('total', 'kategori');

    return view('internal.dokumen-publik.index', compact(
        'dokumens',
        'kategoriList',
        'totalDokumen',
        'statistikKategori'
    ));
}
    // Menampilkan form tambah dokumen
    public function create()
    {
        $kategoriList = ['Renstra', 'Renja', 'SPM', 'SAKIP', 'LPPD'];
        return view('internal.dokumen-publik.create', compact('kategoriList'));
    }

    // Menyimpan data dokumen baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'judul_dokumen' => 'required|string|max:255',
            'kategori'      => 'required|in:Renstra,Renja,SPM,SAKIP,LPPD',
            'nama_file'     => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240', // Maksimal 10MB
        ]);

        $fileName = time() . '_' . str_replace([' ', '#', '%', '&'], '_', $request->file('nama_file')->getClientOriginalName());
        $request->file('nama_file')->storeAs('dokumen_publik', $fileName, 'public');

        DokumenPublik::create([
            'judul_dokumen' => $request->judul_dokumen,
            'kategori'      => $request->kategori,
            'nama_file'     => 'dokumen_publik/' . $fileName,
        ]);

        return redirect()->route('dokumen-publik.index')->with('success', 'Dokumen publik berhasil ditambahkan.');
    }

    // Menampilkan form edit dokumen
    public function edit(DokumenPublik $dokumenPublik)
    {
        $kategoriList = ['Renstra', 'Renja', 'SPM', 'SAKIP', 'LPPD'];
        return view('internal.dokumen-publik.edit', compact('dokumenPublik', 'kategoriList'));
    }

    // Memperbarui data dokumen
    public function update(Request $request, DokumenPublik $dokumenPublik)
    {
        $request->validate([
            'judul_dokumen' => 'required|string|max:255',
            'kategori'      => 'required|in:Renstra,Renja,SPM,SAKIP,LPPD',
            'nama_file'     => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        $fileName = $dokumenPublik->nama_file;

        if ($request->hasFile('nama_file')) {
            // Hapus file lama jika ada
            if ($fileName && Storage::disk('public')->exists($fileName)) {
                Storage::disk('public')->delete($fileName);
            }
            // Simpan file baru
            $newFileName = time() . '_' . str_replace([' ', '#', '%', '&'], '_', $request->file('nama_file')->getClientOriginalName());
            $request->file('nama_file')->storeAs('dokumen_publik', $newFileName, 'public');
            $fileName = 'dokumen_publik/' . $newFileName;
        }

        $dokumenPublik->update([
            'judul_dokumen' => $request->judul_dokumen,
            'kategori'      => $request->kategori,
            'nama_file'     => $fileName,
        ]);

        return redirect()->route('dokumen-publik.index')->with('success', 'Dokumen publik berhasil diperbarui.');
    }

    // Menghapus data dokumen
    public function destroy(DokumenPublik $dokumenPublik)
    {
        if ($dokumenPublik->nama_file && Storage::disk('public')->exists($dokumenPublik->nama_file)) {
            Storage::disk('public')->delete($dokumenPublik->nama_file);
        }

        $dokumenPublik->delete();

        return redirect()->route('dokumen-publik.index')->with('success', 'Dokumen publik berhasil dihapus.');
    }

    // Menampilkan dokumen ke Halaman Publik secara dinamis
    public function showPublic($kategori)
    {
        $allowed = ['renstra', 'renja', 'spm', 'sakip', 'lppd'];
        
        if (!in_array(strtolower($kategori), $allowed)) {
            abort(404);
        }

        $kategoriMapping = [
            'renstra' => 'Renstra',
            'renja'   => 'Renja',
            'spm'     => 'SPM',
            'sakip'   => 'SAKIP',
            'lppd'    => 'LPPD',
        ];

        $kategoriNama = $kategoriMapping[strtolower($kategori)];

        $dokumens = DokumenPublik::where('kategori', $kategoriNama)->latest()->get();

        return view('public.dokumen-publik.index', compact('dokumens', 'kategoriNama', 'kategori'));
    }

    // Menampilkan file langsung di browser (Inline)
    public function showFile($id)
    {
        $dokumen = DokumenPublik::findOrFail($id);
        
        $filePath = storage_path('app/public/' . $dokumen->nama_file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->file($filePath);
    }

    // Download file
    public function download($id)
    {
        $dokumen = DokumenPublik::findOrFail($id);
        
        $filePath = storage_path('app/public/' . $dokumen->nama_file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($filePath);
    }
}
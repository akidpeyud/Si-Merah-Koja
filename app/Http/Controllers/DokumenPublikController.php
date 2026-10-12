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
        $query = DokumenPublik::query();

        // Fitur filter berdasarkan kategori jika dipilih
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        $dokumens = $query->latest()->paginate(10);
        return view('internal.dokumen-publik.index', compact('dokumens'));
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
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|in:Renstra,Renja,SPM,SAKIP,LPPD',
            'tahun'     => 'nullable|digits:4',
            'file_dok'  => 'required|mimes:pdf,doc,docx|max:10240', // Maksimal 10MB
            'deskripsi' => 'nullable|string',
        ]);

        $filePath = $request->file('file_dok')->store('dokumen_publik', 'public');

        DokumenPublik::create([
            'judul'     => $request->judul,
            'kategori'  => $request->kategori,
            'tahun'     => $request->tahun,
            'file_path' => $filePath,
            'deskripsi' => $request->deskripsi,
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
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|in:Renstra,Renja,SPM,SAKIP,LPPD',
            'tahun'     => 'nullable|digits:4',
            'file_dok'  => 'nullable|mimes:pdf,doc,docx|max:10240',
            'deskripsi' => 'nullable|string',
        ]);

        $filePath = $dokumenPublik->file_path;

        if ($request->hasFile('file_dok')) {
            // Hapus file lama jika ada
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            // Simpan file baru
            $filePath = $request->file('file_dok')->store('dokumen_publik', 'public');
        }

        $dokumenPublik->update([
            'judul'     => $request->judul,
            'kategori'  => $request->kategori,
            'tahun'     => $request->tahun,
            'file_path' => $filePath,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('dokumen-publik.index')->with('success', 'Dokumen publik berhasil diperbarui.');
    }

    // Menghapus data dokumen
    public function destroy(DokumenPublik $dokumenPublik)
    {
        if ($dokumenPublik->file_path && Storage::disk('public')->exists($dokumenPublik->file_path)) {
            Storage::disk('public')->delete($dokumenPublik->file_path);
        }

        $dokumenPublik->delete();

        return redirect()->route('dokumen-publik.index')->with('success', 'Dokumen publik berhasil dihapus.');
    }

    // =========================================================================
    // TAMBAHAN: Method untuk menampilkan dokumen ke Halaman Publik secara dinamis
    // =========================================================================
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

        // Ambil data dokumen berdasarkan kategori yang dipilih
        $dokumens = DokumenPublik::where('kategori', $kategoriNama)->latest()->get();

        return view('public.dokumen-publik.index', compact('dokumens', 'kategoriNama', 'kategori'));
    }
    // Menampilkan file langsung di browser (Inline)
    public function showFile($id)
    {
        $dokumen = \App\Models\DokumenPublik::findOrFail($id);
        
        // Dapatkan lokasi absolut file di storage
        $filePath = storage_path('app/public/' . $dokumen->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        // response()->file() akan otomatis mengirim header 'Content-Disposition: inline' 
        // sehingga PDF akan terbuka di tab baru, bukan terunduh.
        return response()->file($filePath);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramKerjaController extends Controller
{
    // 1. Menampilkan Halaman Dashboard CRUD
    public function index()
    {
        $dokumen = Dokumen::latest()->get(); 
        return view('internal.program-kerja.index', compact('dokumen'));
    }

    // 2. Menyimpan Data dan Upload File
    public function store(Request $request)
    {
        $request->validate([
            'judul_dokumen' => 'required|string|max:255',
            'kategori'      => 'required|in:SOTK,SOP,Perencanaan,Pelaporan,Produk Hukum',
            'sub_kategori'  => 'required_if:kategori,SOP|nullable|in:Sekretariat,Sapra,Damtan,Pencegahan',
            'file_dokumen'  => 'required|mimes:pdf,jpg,jpeg,png|max:5120', 
        ]);

        try {
            $file = $request->file('file_dokumen');
            $namaFile = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            
            // CARA PALING AMPUH (Bypass Storage Facade)
            // Tentukan jalur pasti sesuai yang dicari oleh Detektor Error
            $tujuan_upload = storage_path('app/public/dokumen');
            
            // Pindahkan file secara fisik langsung ke folder tujuan
            $file->move($tujuan_upload, $namaFile);

            Dokumen::create([
                'judul_dokumen' => $request->judul_dokumen,
                'kategori'      => $request->kategori,
                'sub_kategori'  => $request->kategori === 'SOP' ? $request->sub_kategori : null,
                'nama_file'     => $namaFile,
            ]);

            return redirect()->back()->with('success', 'Dokumen berhasil diunggah!');
        } catch (\Exception $e) {
            // Memunculkan pesan error asli jika gagal memindahkan file
            return redirect()->back()->with('error', 'Gagal upload: ' . $e->getMessage());
        }
    }
    // 3. Menghapus Data
    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        // Hapus file fisik jika ada
        if (Storage::disk('public')->exists('dokumen/' . $dokumen->nama_file)) {
            Storage::disk('public')->delete('dokumen/' . $dokumen->nama_file);
        }

        $dokumen->delete();
        return redirect()->back()->with('success', 'Dokumen beserta filenya berhasil dihapus!');
    }
    
   // 4. Buka / Lihat File (Publik)
    public function viewFile($id)
    {
        $dokumen = Dokumen::find($id);
        
        if (!$dokumen) {
            return response('MOHON MAAF: Data dokumen tidak ditemukan di Database!', 404);
        }

        $path = storage_path('app/public/dokumen/' . $dokumen->nama_file);
        
        if (!file_exists($path)) {
            return response('ERROR DETEKTOR: Data di database ada, TAPI file fisiknya HILANG di dalam folder. Sistem mencari di: ' . $path, 404);
        }

        return response()->file($path);
    }

    // 5. Download File (Publik)
    public function download($id)
    {
        $dokumen = Dokumen::find($id);
        
        if (!$dokumen) {
            return response('MOHON MAAF: Data dokumen tidak ditemukan di Database!', 404);
        }

        $path = storage_path('app/public/dokumen/' . $dokumen->nama_file);
        
        if (!file_exists($path)) {
            return response('ERROR DETEKTOR: Tidak bisa diunduh karena file fisiknya HILANG di dalam folder: ' . $path, 404);
        }

        return response()->download($path);
    }
}
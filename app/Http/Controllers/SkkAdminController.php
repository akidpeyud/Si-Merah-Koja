<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermohonanSkk;
use App\Models\PermohonanPerpanjangSkk;
use Illuminate\Support\Facades\Storage;

class SkkAdminController extends Controller
{
    // 1. Menampilkan halaman rekap daftar permohonan SKK
    public function index()
    {
        $skk_baru = PermohonanSkk::orderBy('created_at', 'desc')->get();
        $skk_perpanjang = PermohonanPerpanjangSkk::orderBy('created_at', 'desc')->get();
        
        return view('internal.pencegahan.kelola_skk', compact('skk_baru', 'skk_perpanjang'));
    }

    // 2. Menampilkan Form Tambah Permohonan SKK
    public function create()
    {
        // Pastikan file view ini ada di folder resources/views/internal/pencegahan/
        return view('internal.pencegahan.tambah_skk');
    }

    // 3. Menyimpan Data Permohonan SKK Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'nama_pemohon'           => 'required|string|max:150',
            'email_pemohon'          => 'required|email|max:100',
            'no_whatsapp'            => 'required|string|max:25',
            'nama_usaha'             => 'required|string|max:150',
            'nik_pemilik_usaha'      => 'required|string|max:30',
            'alamat_pemilik_usaha'   => 'required|string',
            'kategori_bangunan'      => 'required|string|max:100',
            'alamat_bangunan'        => 'required|string',
            'kecamatan'              => 'required|string|max:100',
            'kelurahan'              => 'required|string|max:100',
            'luas_lahan'             => 'required|numeric',
            'luas_bangunan'          => 'required|numeric',
            'tinggi_bangunan'        => 'required|numeric',
            'status_permohonan'      => 'required|in:Pending,Diproses,Memenuhi Syarat,Tidak Memenuhi Syarat',
            'file_surat_permohonan'  => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('file_surat_permohonan')) {
            $data['file_surat_permohonan'] = $request->file('file_surat_permohonan')->store('skk_surat', 'public');
        } else {
            $data['file_surat_permohonan'] = 'offline_registered'; 
        }

        PermohonanSkk::create($data);

        return redirect('/internal/pencegahan/kelola-skk')->with('success', 'Data Permohonan SKK baru berhasil ditambahkan!');
    }

    // 4. Menampilkan Form Edit Data SKK
    public function edit(Request $request, $id)
    {
        $tipe = $request->query('tipe', 'baru');
        
        if ($tipe === 'perpanjang') {
            $p = PermohonanPerpanjangSkk::findOrFail($id);
        } else {
            $p = PermohonanSkk::findOrFail($id);
        }
        
        // Mengirim data ke view edit dengan variabel $p
        return view('internal.pencegahan.edit_skk', compact('p', 'tipe'));
    }

    // 5. Memproses Pembaruan (Update) Data SKK
    public function update(Request $request, $id)
    {
        $tipe = $request->query('tipe', 'baru');
        
        if ($tipe === 'perpanjang') {
            $p = PermohonanPerpanjangSkk::findOrFail($id);
        } else {
            $p = PermohonanSkk::findOrFail($id);
        }

        $request->validate([
            'nama_pemohon'           => 'required|string|max:150',
            'email_pemohon'          => 'required|email|max:100',
            'no_whatsapp'            => 'required|string|max:25',
            'nama_usaha'             => 'required|string|max:150',
            'nik_pemilik_usaha'      => 'required|string|max:30',
            'alamat_pemilik_usaha'   => 'required|string',
            'kategori_bangunan'      => 'required|string|max:100',
            'alamat_bangunan'        => 'required|string',
            'kecamatan'              => 'required|string|max:100',
            'kelurahan'              => 'required|string|max:100',
            'luas_lahan'             => 'required|numeric',
            'luas_bangunan'          => 'required|numeric',
            'tinggi_bangunan'        => 'required|numeric',
            'status_permohonan'      => 'required|in:Pending,Diproses,Memenuhi Syarat,Tidak Memenuhi Syarat',
            'file_surat_permohonan'  => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except(['_token', '_method', 'tipe']);

        // Cek dan proses jika ada file surat baru yang di-upload
        if ($request->hasFile('file_surat_permohonan')) {
            if ($p->file_surat_permohonan && $p->file_surat_permohonan !== 'offline_registered' && Storage::disk('public')->exists($p->file_surat_permohonan)) {
                Storage::disk('public')->delete($p->file_surat_permohonan);
            }
            $data['file_surat_permohonan'] = $request->file('file_surat_permohonan')->store('skk_surat', 'public');
        }

        $p->update($data);

        return redirect('/internal/pencegahan/kelola-skk')->with('success', 'Data Permohonan SKK berhasil diperbarui!');
    }

    // 6. Menghapus Data SKK dari Sistem
    public function destroy(Request $request, $id)
    {
        $tipe = $request->query('tipe', 'baru');
        
        if ($tipe === 'perpanjang') {
            $p = PermohonanPerpanjangSkk::findOrFail($id);
        } else {
            $p = PermohonanSkk::findOrFail($id);
        }
        
        if ($p->file_surat_permohonan && $p->file_surat_permohonan !== 'offline_registered' && Storage::disk('public')->exists($p->file_surat_permohonan)) {
            Storage::disk('public')->delete($p->file_surat_permohonan);
        }

        $p->delete();

        return back()->with('success', 'Data Permohonan SKK berhasil dihapus dari sistem.');
    }

    // 7. Menampilkan Detail Data SKK (Tampilan Read-only)
    public function show(Request $request, $id)
    {
        $tipe = $request->query('tipe', 'baru'); 
        
        if ($tipe === 'perpanjang') {
            $permohonan = PermohonanPerpanjangSkk::findOrFail($id);
            $jenis_layanan = "Perpanjangan SKK"; 
        } else { 
            $permohonan = PermohonanSkk::findOrFail($id);
            $jenis_layanan = "SKK Baru"; 
        } 
        
        return view('internal.pencegahan.detail_skk', compact('permohonan', 'tipe', 'jenis_layanan')); 
    }

    // 8. Update Status SKK Baru
    public function updateStatus(Request $request, $id)
    {
        PermohonanSkk::where('id', $id)->update(['status_permohonan' => $request->status_permohonan]); 
        return redirect()->back()->with('success', 'Status Permohonan SKK Baru berhasil diperbarui!'); 
    }

    // 9. Update Status SKK Perpanjang
    public function updateStatusPerpanjang(Request $request, $id)
    {
        PermohonanPerpanjangSkk::where('id', $id)->update(['status_permohonan' => $request->status_permohonan]); 
        return redirect()->back()->with('success', 'Status Permohonan Perpanjangan SKK berhasil diperbarui!'); 
    }
}
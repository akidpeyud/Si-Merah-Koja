<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermohonanSkk;
use App\Models\PermohonanPerpanjangSkk;
use Illuminate\Support\Facades\Storage;

class SkkAdminController extends Controller
{
    // 1. Menampilkan halaman rekap daftar permohonan SKK (Baru & Perpanjangan)
    public function index()
    {
        $skk_baru = PermohonanSkk::orderBy('created_at', 'desc')->get();
        $skk_perpanjang = PermohonanPerpanjangSkk::orderBy('created_at', 'desc')->get();
        
        return view('internal.pencegahan.kelola_skk', compact('skk_baru', 'skk_perpanjang'));
    }

    // 2. Menampilkan Form Tambah Permohonan SKK (Offline oleh Petugas)
    public function create()
    {
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

        // Menangani upload file surat permohonan
        if ($request->hasFile('file_surat_permohonan')) {
            $data['file_surat_permohonan'] = $request->file('file_surat_permohonan')->store('skk_surat', 'public');
        } else {
            // Nilai default jika petugas tidak mengunggah file lewat input offline kantor
            $data['file_surat_permohonan'] = 'offline_registered'; 
        }

        PermohonanSkk::create($data);

        return redirect('/internal/pencegahan/kelola-skk')->with('success', 'Data Permohonan SKK baru berhasil ditambahkan!');
    }

    // 4. Menampilkan Form Edit Data SKK
    public function edit($id)
    {
        $p = PermohonanSkk::findOrFail($id);
        
        // Pastikan Anda sudah membuat file view 'internal.pencegahan.edit_skk'
        return view('internal.pencegahan.edit_skk', compact('p'));
    }

    // 5. Memproses Pembaruan (Update) Data SKK
    public function update(Request $request, $id)
    {
        $p = PermohonanSkk::findOrFail($id);

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
    public function destroy($id)
    {
        $p = PermohonanSkk::findOrFail($id);
        
        // Hapus file lampiran dari storage jika ada
        if ($p->file_surat_permohonan && $p->file_surat_permohonan !== 'offline_registered' && Storage::disk('public')->exists($p->file_surat_permohonan)) {
            Storage::disk('public')->delete($p->file_surat_permohonan);
        }

        $p->delete();

        return back()->with('success', 'Data Permohonan SKK berhasil dihapus dari sistem.');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftarRedkar;
use Illuminate\Support\Facades\Storage;

class RedkarAdminController extends Controller
{
    // 1. Menampilkan Halaman Tabel Kelola Redkar
    public function index()
    {
        // Mengambil semua data pendaftar redkar diurutkan dari yang terbaru
        $relawan = PendaftarRedkar::orderBy('created_at', 'desc')->get();
        
        return view('internal.pencegahan.kelola_redkar', compact('relawan'));
    }

    // 2. Fungsi untuk Memperbarui Status Pendaftaran & Akun
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pendaftaran' => 'required|in:Pending,Diterima,Ditolak',
            'status_akun'        => 'required|in:Aktif,Nonaktif',
        ]);

        $redkar = PendaftarRedkar::findOrFail($id);

        $redkar->update([
            'status_pendaftaran' => $request->status_pendaftaran,
            'status_akun'        => $request->status_akun,
        ]);

        return redirect()->back()->with('success', 'Verifikasi akun dan status relawan ' . $redkar->nama_lengkap . ' berhasil disimpan!');
    }

    // 3. Menghapus Data Relawan REDKAR
    public function destroy($id)
    {
        $redkar = PendaftarRedkar::findOrFail($id);

        // Hapus file KTP dari storage jika ada dan bukan offline_registered
        if ($redkar->file_ktp && $redkar->file_ktp !== 'offline_registered' && Storage::disk('public')->exists($redkar->file_ktp)) {
            Storage::disk('public')->delete($redkar->file_ktp);
        }

        $redkar->delete();

        return redirect()->back()->with('success', 'Data relawan berhasil dihapus secara permanen.');
    }

    // ========================================================
    // FUNGSI TAMBAHAN (Untuk Form Tambah, Edit, dan Cetak)
    // ========================================================

    // Menampilkan Form Tambah Manual oleh Admin
    public function create()
    {
        return view('internal.pencegahan.tambah_redkar'); // Pastikan Anda memiliki view ini nanti
    }

    // Menampilkan Form Edit Redkar
    public function edit($id)
    {
        $redkar = PendaftarRedkar::findOrFail($id);
        return view('internal.pencegahan.edit_redkar', compact('redkar')); // Pastikan Anda memiliki view ini nanti
    }

    // Cetak PDF/Print Data Redkar
    public function cetak($id)
    {
        $r = PendaftarRedkar::findOrFail($id);
        return view('internal.pencegahan.cetak_redkar', compact('r')); // Pastikan Anda memiliki view ini nanti
    }
}
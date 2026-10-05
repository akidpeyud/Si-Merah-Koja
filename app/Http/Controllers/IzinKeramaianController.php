<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IzinKeramaian;

class IzinKeramaianController extends Controller
{
    /**
     * Menampilkan form Izin Keramaian
     */
   public function index()
    {
    // Gunakan titik (.) untuk masuk ke dalam folder
    return view('layanan-fasilitas.izin_keramaian', [
        'tab_aktif' => 'keramaian'
    ]);
    }

    /**
     * Menyimpan data pengajuan ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            
            'nama_direktur' => 'required|string|max:255',
            'nama_usaha' => 'required|string|max:255',
            'no_izin_usaha' => 'required|string|max:255',
            
            'nama_acara' => 'required|string|max:255',
            'lokasi_acara' => 'required|string|max:255',
            'tgl_pelaksanaan' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'jumlah_penonton' => 'required|integer|min:1',
            
            'jumlah_apar' => 'required|integer|min:8', // Validasi minimal 8 APAR
            'jumlah_staff' => 'required|integer|min:4', // Validasi minimal 4 Staff
            
            // Validasi file
            'foto_jalur_evakuasi' => 'required|image|mimes:jpeg,png,jpg|max:5120', // Max 5MB
            'surat_pernyataan' => 'required|mimes:pdf,jpeg,png,jpg|max:5120', // Max 5MB
        ], [
            // Kustomisasi pesan galat (opsional)
            'jumlah_apar.min' => 'Jumlah APAR minimal harus 8 buah sesuai persyaratan.',
            'jumlah_staff.min' => 'Jumlah staff terlatih minimal harus 4 orang.',
            'nik.digits' => 'NIK harus berjumlah tepat 16 digit.',
        ]);

        // 2. Proses upload file
        if ($request->hasFile('foto_jalur_evakuasi')) {
            $jalurEvakuasiPath = $request->file('foto_jalur_evakuasi')->store('uploads/izin_keramaian/jalur', 'public');
            $validatedData['foto_jalur_evakuasi'] = $jalurEvakuasiPath;
        }

        if ($request->hasFile('surat_pernyataan')) {
            $suratPernyataanPath = $request->file('surat_pernyataan')->store('uploads/izin_keramaian/surat', 'public');
            $validatedData['surat_pernyataan'] = $suratPernyataanPath;
        }

        // Set status default
        $validatedData['status_permohonan'] = 'Pending';

        // 3. Simpan ke database
        IzinKeramaian::create($validatedData);

        // 4. Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Permohonan Rekomendasi Izin Keramaian berhasil dikirim dan akan segera diproses.');
    }
}
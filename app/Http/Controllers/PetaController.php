<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TitikSigap;

class PetaController extends Controller
{
    // ==========================================
    // FUNGSI HALAMAN PUBLIK
    // ==========================================
    
    public function sigap()
    {
        return view('public.sigap');
    }

    // ==========================================
    // FUNGSI DASHBOARD ADMIN (CRUD)
    // ==========================================

    /**
     * READ: Tampilkan Halaman Daftar Data (Tabel)
     */
    public function data()
    {
        $titikSigaps = TitikSigap::orderBy('created_at', 'desc')->get();
        return view('internal.peta-sigap.data_peta', compact('titikSigaps'));
    }

    /**
     * CREATE: Tampilkan Halaman Input
     */
    public function input()
    {
        // Opsional: jika input dan tabel digabung dalam 1 halaman
        $titikSigaps = TitikSigap::orderBy('created_at', 'desc')->get();
        
        return view('internal.peta-sigap.inputdata_peta', compact('titikSigaps')); 
    }

    /**
     * CREATE: Simpan Data Titik Baru
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'kategori'   => 'required|in:kebakaran,sumber_air,hydrant,penyelamatan,pos',
            'nama'       => 'required|string|max:255',
            'tanggal'    => 'nullable|date',
            'lokasi'     => 'required|string',
            'keterangan' => 'nullable|string', // Validasi keterangan
            'latitude'   => 'required|numeric',
            'longitude'  => 'required|numeric',
        ]);

        TitikSigap::create([
            'kategori'   => $request->kategori,
            'nama'       => $request->nama,
            'tanggal'    => $request->tanggal,
            'lokasi'     => $request->lokasi,
            'keterangan' => $request->keterangan, // Masukkan keterangan
            'latitude'   => $request->latitude,
            'longitude'  => $request->longitude,
        ]);

        return redirect()->back()->with('success', 'Titik SIGAP berhasil ditambahkan!');
    }

    /**
     * UPDATE: Tampilkan Form Edit Data
     */
public function edit($id)
{
    $titik = TitikSigap::findOrFail($id);
    return view('internal.peta-sigap.edit_peta', compact('titik'));
}

    /**
     * UPDATE: Simpan Perubahan Data
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori'   => 'required|in:kebakaran,sumber_air,hydrant,penyelamatan,pos',
            'nama'       => 'required|string|max:255',
            'tanggal'    => 'nullable|date',
            'lokasi'     => 'required|string',
            'keterangan' => 'nullable|string', // Validasi keterangan
            'latitude'   => 'required|numeric',
            'longitude'  => 'required|numeric',
        ]);

        $titik = TitikSigap::findOrFail($id);
        
        $titik->update([
            'kategori'   => $request->kategori,
            'nama'       => $request->nama,
            'tanggal'    => $request->tanggal,
            'lokasi'     => $request->lokasi,
            'keterangan' => $request->keterangan, // Update keterangan
            'latitude'   => $request->latitude,
            'longitude'  => $request->longitude,
        ]);

        // Arahkan kembali ke halaman data setelah berhasil edit
        return redirect('/internal/peta-sigap/data')->with('success', 'Data Titik SIGAP berhasil diperbarui!');
    }

    /**
     * DELETE: Hapus Data Titik
     */
    public function destroy($id)
    {
        $titik = TitikSigap::findOrFail($id);
        $titik->delete();

        return redirect()->back()->with('success', 'Titik berhasil dihapus!');
    }

    // ==========================================
    // FUNGSI API (UNTUK PETA PUBLIK)
    // ==========================================

    /**
     * API Endpoint
     */
    public function apiData()
    {
        $titiks = TitikSigap::all();
        
        $formattedTitik = $titiks->map(function($titik) {
            return [
                'id'         => $titik->id,
                'kategori'   => $titik->kategori,
                'nama'       => $titik->nama,
                'tanggal'    => $titik->tanggal ? \Carbon\Carbon::parse($titik->tanggal)->format('d M Y') : 'Tidak diketahui',
                'lokasi'     => $titik->lokasi,
                'keterangan' => $titik->keterangan, // Tambahkan keterangan agar bisa dibaca di popup Maps Publik
                'lat'        => (float) $titik->latitude,
                'lng'        => (float) $titik->longitude,
            ];
        });

        return response()->json($formattedTitik);
    }
}
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
    // FUNGSI DASHBOARD ADMIN
    // ==========================================

    /**
     * Tampilkan Halaman Input (Dashboard Admin)
     */
    public function input()
    {
        // Ambil data untuk ditampilkan di tabel riwayat bagian bawah
        $titikSigaps = TitikSigap::orderBy('created_at', 'desc')->get();
        
        // Nama dalam compact harus sama persis dengan nama variabel di atas ($titikSigaps)
        return view('internal.peta-sigap.inputdata_peta', compact('titikSigaps')); 
    }

    /**
     * Simpan Data Titik Baru
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'kategori'  => 'required|in:kebakaran,sumber_air,hydrant,penyelamatan,pos',
            'nama'      => 'required|string|max:255',
            'tanggal'   => 'nullable|date',
            'lokasi'    => 'required|string',
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Simpan ke database secara spesifik agar input 'kecamatan' (yang tidak ada di DB) diabaikan
        TitikSigap::create([
            'kategori'  => $request->kategori,
            'nama'      => $request->nama,
            'tanggal'   => $request->tanggal,
            'lokasi'    => $request->lokasi,
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->back()->with('success', 'Titik SIGAP berhasil ditambahkan!');
    }

    /**
     * Hapus Data Titik
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
     * API Endpoint (Untuk memanggil titik-titik JSON di halaman peta Publik)
     */
    public function apiData()
    {
        $titiks = TitikSigap::all();
        
        // Format agar bisa dibaca dengan mudah oleh JavaScript Leaflet di halaman publik
        $formattedTitik = $titiks->map(function($titik) {
            return [
                'id'       => $titik->id,
                'kategori' => $titik->kategori,
                'nama'     => $titik->nama,
                'tanggal'  => $titik->tanggal ? \Carbon\Carbon::parse($titik->tanggal)->format('d M Y') : 'Tidak diketahui',
                'lokasi'   => $titik->lokasi,
                'lat'      => (float) $titik->latitude,
                'lng'      => (float) $titik->longitude,
            ];
        });

        return response()->json($formattedTitik);
    }
}
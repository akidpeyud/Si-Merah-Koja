<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PemberdayaanController extends Controller
{
    // 1. TAMPILKAN SEMUA DATA (INDEX) -> UNTUK TAB "SEMUA DATA" (STAT CARDS)
    public function index()
    {
        // Hitung total data untuk dimunculkan di kotak-kotak ringkasan (Stat Cards)
        $total_sosialisasi = DB::table('sosialisasi_edukasi')->count();
        // Asumsi nama tabel untuk pelatihan keluarga adalah 'pelatihan_keluarga'. Sesuaikan kalau beda!
        $total_pelatihan = DB::table('pelatihan_keluarga')->count(); 

        return view('internal.pencegahan.pemberdayaan_masyarakat', compact('total_sosialisasi', 'total_pelatihan'));
    }

    // 1.B TAMPILKAN TABEL -> UNTUK TAB "SOSIALISASI DAN EDUKASI"
    public function sosialisasi()
    {
        // Ambil data sosialisasi dari database
        $data_sosialisasi = DB::table('sosialisasi_edukasi')
                            ->orderBy('tanggal_pelaksanaan', 'desc')
                            ->get();
                            
        // Kirim data ke view pemberdayaan_masyarakat
        return view('internal.pencegahan.pemberdayaan_masyarakat', compact('data_sosialisasi'));
    }

    // 2. TAMPILKAN FORM TAMBAH DATA (CREATE)
    public function create()
    {
        return view('internal.pencegahan.create_pemberdayaan');
    }
    
    // 3. PROSES SIMPAN DATA KE DATABASE (STORE)
    public function store(Request $request)
    {
        $data = [
            // PERBAIKAN: Otomatis mencari input bernama 'tanggal_pelaksanaan' atau 'tanggal'
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan ?? $request->tanggal,
            'kecamatan'           => $request->kecamatan,
            'kelurahan'           => $request->kelurahan,
            'rt'                  => $request->rt,
            'posyandu'            => $request->posyandu,
            'peserta_perempuan'   => $request->peserta_perempuan ?? 0,
            'peserta_laki_laki'   => $request->peserta_laki_laki ?? 0,
            'created_at'          => now(),
            'updated_at'          => now(),
        ];

        // Cek kalau user upload foto/video
        if ($request->hasFile('foto_video')) {
            $file = $request->file('foto_video');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/pemberdayaan'), $namaFile);
            $data['foto_video'] = $namaFile;
        }

        DB::table('sosialisasi_edukasi')->insert($data);

        return redirect('/internal/pencegahan/pemberdayaan-masyarakat')
            ->with('success', 'Data Sosialisasi & Edukasi berhasil ditambahkan!');
    }

    // 4. TAMPILKAN FORM EDIT DATA (EDIT)
    public function edit($id)
    {
        $data = DB::table('sosialisasi_edukasi')->where('id', $id)->first();
        
        if (!$data) {
            return redirect('/internal/pencegahan/pemberdayaan-masyarakat')->with('error', 'Data tidak ditemukan!');
        }

        return view('internal.pencegahan.edit_pemberdayaan', compact('data'));
    }

    // 5. PROSES UPDATE DATA KE DATABASE (UPDATE)
    public function update(Request $request, $id)
    {
        $updateData = [
            // PERBAIKAN: Sama seperti di atas
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan ?? $request->tanggal,
            'kecamatan'           => $request->kecamatan,
            'kelurahan'           => $request->kelurahan,
            'rt'                  => $request->rt,
            'posyandu'            => $request->posyandu,
            'peserta_perempuan'   => $request->peserta_perempuan ?? 0,
            'peserta_laki_laki'   => $request->peserta_laki_laki ?? 0,
            'updated_at'          => now(),
        ];

        // Cek kalau user upload foto/video baru untuk mengganti yang lama
        if ($request->hasFile('foto_video')) {
            $file = $request->file('foto_video');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/pemberdayaan'), $namaFile);
            $updateData['foto_video'] = $namaFile;
        }

        DB::table('sosialisasi_edukasi')->where('id', $id)->update($updateData);

        return redirect('/internal/pencegahan/pemberdayaan-masyarakat')
            ->with('success', 'Data Sosialisasi & Edukasi berhasil diperbarui!');
    }

    // 6. PROSES HAPUS DATA (DESTROY)
    public function destroy($id)
    {
        DB::table('sosialisasi_edukasi')->where('id', $id)->delete();

        return redirect('/internal/pencegahan/pemberdayaan-masyarakat')
            ->with('success', 'Data Sosialisasi & Edukasi berhasil dihapus!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KebutuhanSarpras;
use Barryvdh\DomPDF\Facade\Pdf;


class SapraController extends Controller
{
    // === MENU LOGISTIK ===
    public function logistik()
    {
        $dataSarpras = KebutuhanSarpras::all();
        return view('internal.sapra.logistik', compact('dataSarpras'));
    }

    // === MENU DATA HIDRANT GEDUNG / PILAR ===
    public function dataHidrantGedung()
    {
        $hidranPilar  = DB::table('prasaranas')->where('kategori', 'Hidrant Pilar')->orderBy('no_urut', 'asc')->get();
        $hidranGedung = DB::table('prasaranas')->where('kategori', 'Hidrant Gedung')->orderBy('no_urut', 'asc')->get();
        $embung       = DB::table('prasaranas')->where('kategori', 'Embung')->orderBy('no_urut', 'asc')->get();
        $danau        = DB::table('prasaranas')->where('kategori', 'Danau')->orderBy('no_urut', 'asc')->get();

        return view('internal.sapra.data_hidrant_gedung', compact(
            'hidranPilar', 'hidranGedung', 'embung', 'danau'
        ));
    }

    public function storeHidran(Request $request)
    {
        $request->validate([
            'kategori'    => 'required|string',
            'no_urut'     => 'required|integer',
            'nama_gedung' => 'required|string|max:255',
            'alamat'      => 'required|string',
            'kode_maps'   => 'nullable|string|max:100',
            'jumlah'      => 'nullable|integer',
            'luas'        => 'nullable|string|max:100',
        ]);

        DB::table('prasaranas')->insert([
            'kategori'    => $request->kategori,
            'no_urut'     => $request->no_urut,
            'nama_gedung' => $request->nama_gedung,
            'alamat'      => $request->alamat,
            'kode_maps'   => $request->kode_maps,
            'jumlah'      => $request->jumlah,
            'luas'        => $request->luas,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function updateHidran(Request $request, $id)
    {
        $request->validate([
            'kategori'    => 'required|string',
            'no_urut'     => 'required|integer',
            'nama_gedung' => 'required|string|max:255',
            'alamat'      => 'required|string',
            'kode_maps'   => 'nullable|string|max:100',
            'jumlah'      => 'nullable|integer',
            'luas'        => 'nullable|string|max:100',
        ]);

        DB::table('prasaranas')->where('id', $id)->update([
            'kategori'    => $request->kategori,
            'no_urut'     => $request->no_urut,
            'nama_gedung' => $request->nama_gedung,
            'alamat'      => $request->alamat,
            'kode_maps'   => $request->kode_maps,
            'jumlah'      => $request->jumlah,
            'luas'        => $request->luas,
            'updated_at'  => now(),
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    public function destroyHidran($id)
    {
        DB::table('prasaranas')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    public function cetakPdfHidran()
    {
        $hidranPilar  = DB::table('prasaranas')->where('kategori', 'Hidrant Pilar')->orderBy('no_urut', 'asc')->get();
        $hidranGedung = DB::table('prasaranas')->where('kategori', 'Hidrant Gedung')->orderBy('no_urut', 'asc')->get();
        $embung       = DB::table('prasaranas')->where('kategori', 'Embung')->orderBy('no_urut', 'asc')->get();
        $danau        = DB::table('prasaranas')->where('kategori', 'Danau')->orderBy('no_urut', 'asc')->get();

        $pdf = Pdf::loadView('internal.sapra.hidran_gedung_pdf', compact(
            'hidranPilar', 'hidranGedung', 'embung', 'danau'
        ))->setPaper('a4', 'landscape');

        return $pdf->download('Data_Hidrant_Gedung.pdf');
    }
// Fungsi Cetak PDF Data Hidrant Gedung / Pilar
   // Fungsi Cetak PDF Data Hidrant Gedung / Pilar
    public function cetakPdfHidranGedung()
    {
        // Ubah nama variabelnya jadi $dataHidran biar cocok sama yang diminta di file blade
        $dataHidran = DB::table('prasaranas')->orderBy('no_urut', 'asc')->get();
        
        // Render PDF mengarah ke file hidran_pdf.blade.php
        $pdf = Pdf::loadView('internal.sapra.hidran_pdf', compact('dataHidran'))
                  ->setPaper('a4', 'landscape'); 
                  
        return $pdf->download('Data_Hidrant_Gedung.pdf');
    }
    // === MENU DATA HIDRANT KOTA JAMBI ===
    public function dataHidrantKota(Request $request)
    {
        $query = DB::table('hidran_kota');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('jalan', 'LIKE', "%{$search}%")
                  ->orWhere('kecamatan', 'LIKE', "%{$search}%")
                  ->orWhere('kelurahan', 'LIKE', "%{$search}%");
        }

        $dataMaintenance = $query->orderBy('id', 'asc')->get();

        $stats = [
            'kondisi_baik' => $dataMaintenance->filter(fn($q) => strcasecmp($q->kondisi_hidran, 'Baik') == 0)->count(),
            'kondisi_rusak' => $dataMaintenance->filter(fn($q) => strcasecmp($q->kondisi_hidran, 'Rusak') == 0)->count(),
            'tekanan_kuat' => $dataMaintenance->filter(fn($q) => strcasecmp($q->tekanan, 'Kuat') == 0)->count(),
            'tekanan_sedang' => $dataMaintenance->filter(fn($q) => strcasecmp($q->tekanan, 'Sedang') == 0)->count(),
            'tekanan_lemah' => $dataMaintenance->filter(fn($q) => strcasecmp($q->tekanan, 'Lemah') == 0)->count(),
            'bisa_dipakai' => $dataMaintenance->filter(fn($q) => stripos($q->keterangan, 'Bisa Dipakai') !== false && stripos($q->keterangan, 'Tidak') === false)->count(),
            'tidak_bisa_dipakai' => $dataMaintenance->filter(fn($q) => stripos($q->keterangan, 'Tidak Bisa Dipakai') !== false)->count(),
            'tergantung_listrik' => $dataMaintenance->filter(fn($q) => stripos($q->keterangan, 'listrik') !== false)->count(),
            'tidak_keluar_air' => $dataMaintenance->filter(fn($q) => stripos($q->keterangan, 'Tidak Keluar Air') !== false)->count(),
            'total' => $dataMaintenance->count(),
        ];

        return view('internal.sapra.data_hidrant_kota', compact('dataMaintenance', 'stats'));
    }

    public function cetakPdfKota()
    {
        $dataMaintenance = DB::table('hidran_kota')->orderBy('id', 'asc')->get();
        $pdf = Pdf::loadView('internal.sapra.hidran_kota_pdf', compact('dataMaintenance'))
                  ->setPaper('a4', 'landscape');
        return $pdf->download('Data_Hidrant_Kota_Jambi.pdf');
    }

    public function storeHidrantKota(Request $request)
    {
        DB::table('hidran_kota')->insert([
            'jalan' => $request->jalan,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'rt' => $request->rt,
            'lokasi_terdekat' => $request->lokasi_terdekat,
            'kode_map' => $request->kode_map,
            'kondisi_hidran' => $request->kondisi_hidran,
            'tekanan' => $request->tekanan,
            'machino' => $request->machino,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->back()->with('success', 'Data Hidrant Kota berhasil ditambahkan!');
    }

    public function updateHidrantKota(Request $request, $id)
    {
        DB::table('hidran_kota')->where('id', $id)->update([
            'jalan' => $request->jalan,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'rt' => $request->rt,
            'lokasi_terdekat' => $request->lokasi_terdekat,
            'kode_map' => $request->kode_map,
            'kondisi_hidran' => $request->kondisi_hidran,
            'tekanan' => $request->tekanan,
            'machino' => $request->machino,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->back()->with('success', 'Data Hidrant Kota berhasil diperbarui!');
    }

    public function destroyHidrantKota($id)
    {
        DB::table('hidran_kota')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data Hidrant Kota berhasil dihapus!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\HidranExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HidranKotaExport;
use Illuminate\Support\Facades\DB;
use App\Models\KebutuhanSarpras;
use Barryvdh\DomPDF\Facade\Pdf;


class SapraController extends Controller
{
    // ==========================================
    // === MENU LOGISTIK ===
    // ==========================================
    public function logistik()
    {
        $dataSarpras = KebutuhanSarpras::all();
        return view('internal.sapra.logistik', compact('dataSarpras'));
    }


    // ==========================================
    // === MENU DATA HIDRANT GEDUNG / PILAR ===
    // ==========================================
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
            'nama_gedung' => 'required|string|max:255',
            'alamat'      => 'required|string',
            'kode_maps'   => 'nullable|string|max:100',
            'jumlah'      => 'nullable|integer',
            'luas'        => 'nullable|string|max:100',
        ]);

        // CEK NO URUT OTOMATIS: Ambil angka terbesar di kategori ini, lalu tambah 1
        $noUrutTerakhir = DB::table('prasaranas')
                            ->where('kategori', $request->kategori)
                            ->max('no_urut');
                            
        $noUrutBaru = $noUrutTerakhir ? $noUrutTerakhir + 1 : 1;

        DB::table('prasaranas')->insert([
            'kategori'    => $request->kategori,
            'no_urut'     => $noUrutBaru, // Masukkan nomor yang dihitung otomatis
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

   public function cetakPdfHidranGedung()
    {
        $dataHidran = DB::table('prasaranas')->orderBy('no_urut', 'asc')->get();
        
        $pdf = Pdf::loadView('internal.sapra.hidran_pdf', compact('dataHidran'))
                  ->setPaper('a4', 'landscape'); 
                  
        return $pdf->download('Data_Hidrant_Gedung.pdf');
    }

    // Ini fungsi baru yang dicari sama web.php
    public function cetakExcelHidran()
    {
        return Excel::download(new HidranExport, 'Data_Hidrant_Danau_Embung.xlsx');
    }

    // ==========================================
    // === MENU DATA HIDRANT KOTA JAMBI ===
    // ==========================================
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
    public function cetakExcelKota()
{
    return Excel::download(new HidranKotaExport, 'Data_Hidrant_Kota_Jambi.xlsx');
}

    public function storeHidrantKota(Request $request)
    {
        DB::table('hidran_kota')->insert([
            'jalan'           => $request->jalan,
            'kecamatan'       => $request->kecamatan,
            'kelurahan'       => $request->kelurahan,
            'rt'              => $request->rt,
            'lokasi_terdekat' => $request->lokasi_terdekat,
            'kode_map'        => $request->kode_map,
            'kondisi_hidran'  => $request->kondisi_hidran,
            'tekanan'         => $request->tekanan,
            'machino'         => $request->machino,
            'keterangan'      => $request->keterangan,
        ]);
        return redirect()->back()->with('success', 'Data Hidrant Kota berhasil ditambahkan!');
    }

    public function updateHidrantKota(Request $request, $id)
    {
        DB::table('hidran_kota')->where('id', $id)->update([
            'jalan'           => $request->jalan,
            'kecamatan'       => $request->kecamatan,
            'kelurahan'       => $request->kelurahan,
            'rt'              => $request->rt,
            'lokasi_terdekat' => $request->lokasi_terdekat,
            'kode_map'        => $request->kode_map,
            'kondisi_hidran'  => $request->kondisi_hidran,
            'tekanan'         => $request->tekanan,
            'machino'         => $request->machino,
            'keterangan'      => $request->keterangan,
        ]);
        return redirect()->back()->with('success', 'Data Hidrant Kota berhasil diperbarui!');
    }

    public function destroyHidrantKota($id)
    {
        DB::table('hidran_kota')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data Hidrant Kota berhasil dihapus!');
    }
// ==========================================
    // === MENU PRASARANA MAKO & POS ===
    // ==========================================
    
    public function prasaranaMako()
    {
        $posPemadam = DB::table('pos_pemadam')->orderBy('id_pos', 'asc')->get();
        $dataPrasarana = DB::table('prasarana')->orderBy('id_prasarana', 'asc')->get();

        return view('internal.sapra.prasarana_mako', compact('posPemadam', 'dataPrasarana'));
    }

    public function storePrasaranaMako(Request $request)
    {
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/prasarana'), $filename); 
            $gambarPath = 'uploads/prasarana/' . $filename;
        }

        DB::table('prasarana')->insert([
            'id_pos'          => $request->id_pos,
            'jenis_prasarana' => $request->jenis_prasarana,
            'path_gambar'     => $gambarPath,
        ]);

        // Menyimpan id_pos ke session agar tab tidak reset
        return redirect()->back()
            ->with('success', 'Data Prasarana berhasil ditambahkan!')
            ->with('active_tab', $request->id_pos);
    }

    public function updatePrasaranaMako(Request $request, $id)
    {
        $dataLama = DB::table('prasarana')->where('id_prasarana', $id)->first();
        $gambarPath = $dataLama->path_gambar;

        if ($request->hasFile('gambar')) {
            if ($gambarPath && file_exists(public_path($gambarPath))) {
                unlink(public_path($gambarPath));
            }
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/prasarana'), $filename); 
            $gambarPath = 'uploads/prasarana/' . $filename;
        }

        DB::table('prasarana')->where('id_prasarana', $id)->update([
            'id_pos'          => $request->id_pos,
            'jenis_prasarana' => $request->jenis_prasarana,
            'path_gambar'     => $gambarPath,
        ]);

        // Menyimpan id_pos ke session agar tab tidak reset
        return redirect()->back()
            ->with('success', 'Data Prasarana berhasil diperbarui!')
            ->with('active_tab', $request->id_pos);
    }

    public function destroyPrasaranaMako($id)
    {
        $data = DB::table('prasarana')->where('id_prasarana', $id)->first();
        
        // Simpan id_pos ke variabel sebelum data dihapus dari database
        $id_pos_terakhir = $data->id_pos;
        
        if ($data && $data->path_gambar && file_exists(public_path($data->path_gambar))) {
            unlink(public_path($data->path_gambar));
        }

        DB::table('prasarana')->where('id_prasarana', $id)->delete();

        // Mengirimkan id_pos terakhir ke session
        return redirect()->back()
            ->with('success', 'Data Prasarana berhasil dihapus!')
            ->with('active_tab', $id_pos_terakhir);
    }

    public function cetakPdfMako()
    {
        $posPemadam = DB::table('pos_pemadam')->orderBy('id_pos', 'asc')->get();
        $dataPrasarana = DB::table('prasarana')->orderBy('id_prasarana', 'asc')->get();

        $pdf = Pdf::loadView('internal.sapra.prasarana_mako_pdf', compact('posPemadam', 'dataPrasarana'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('Data_Prasarana_Mako_Pos.pdf');
    }
    // ==========================================
    // === MENU SARANA MAKO & POS ===
    // ==========================================
    
    public function saranaMako()
    {
        $posPemadam = DB::table('pos_pemadam')->orderBy('id_pos', 'asc')->get();
        $dataSarana = DB::table('sarana_kebakaran')->orderBy('id_sarana', 'asc')->get();

        return view('internal.sapra.sarana_mako', compact('posPemadam', 'dataSarana'));
    }

    public function storeSaranaMako(Request $request)
    {
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/sarana'), $filename); 
            $gambarPath = 'uploads/sarana/' . $filename;
        }

        DB::table('sarana_kebakaran')->insert([
            'id_pos'       => $request->id_pos,
            'jenis_sarana' => $request->jenis_sarana,
            'jumlah'       => $request->jumlah,
            'path_gambar'  => $gambarPath,
        ]);

        return redirect()->back()
            ->with('success', 'Data Sarana berhasil ditambahkan!')
            ->with('active_tab', $request->id_pos);
    }

    public function updateSaranaMako(Request $request, $id)
    {
        $dataLama = DB::table('sarana_kebakaran')->where('id_sarana', $id)->first();
        $gambarPath = $dataLama->path_gambar;

        if ($request->hasFile('gambar')) {
            if ($gambarPath && file_exists(public_path($gambarPath))) {
                unlink(public_path($gambarPath));
            }
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/sarana'), $filename); 
            $gambarPath = 'uploads/sarana/' . $filename;
        }

        DB::table('sarana_kebakaran')->where('id_sarana', $id)->update([
            'id_pos'       => $request->id_pos,
            'jenis_sarana' => $request->jenis_sarana,
            'jumlah'       => $request->jumlah,
            'path_gambar'  => $gambarPath,
        ]);

        return redirect()->back()
            ->with('success', 'Data Sarana berhasil diperbarui!')
            ->with('active_tab', $request->id_pos);
    }

    public function destroySaranaMako($id)
    {
        $data = DB::table('sarana_kebakaran')->where('id_sarana', $id)->first();
        $id_pos_terakhir = $data->id_pos;
        
        if ($data && $data->path_gambar && file_exists(public_path($data->path_gambar))) {
            unlink(public_path($data->path_gambar));
        }

        DB::table('sarana_kebakaran')->where('id_sarana', $id)->delete();

        return redirect()->back()
            ->with('success', 'Data Sarana berhasil dihapus!')
            ->with('active_tab', $id_pos_terakhir);
    }

    public function cetakPdfSaranaMako()
    {
        $posPemadam = DB::table('pos_pemadam')->orderBy('id_pos', 'asc')->get();
        $dataSarana = DB::table('sarana_kebakaran')->orderBy('id_sarana', 'asc')->get();

        $pdf = Pdf::loadView('internal.sapra.sarana_mako_pdf', compact('posPemadam', 'dataSarana'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('Data_Sarana_Mako_Pos.pdf');
    }

} // Pastikan kurung kurawal ini tidak terhapus!
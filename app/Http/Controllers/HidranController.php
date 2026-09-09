<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HidranKota; // Pastikan model lu connect ke tabel 'prasaranas'
use Barryvdh\DomPDF\Facade\Pdf;

class HidranController extends Controller
{
    public function index()
    {
        // 1. Ambil data dari database dan pisahkan berdasarkan kategorinya
        $hidranPilar  = HidranKota::where('kategori', 'Hidrant Pilar')->orderBy('no_urut', 'asc')->get();
        $hidranGedung = HidranKota::where('kategori', 'Hidrant Gedung')->orderBy('no_urut', 'asc')->get();
        $embung       = HidranKota::where('kategori', 'Embung')->orderBy('no_urut', 'asc')->get();
        $danau        = HidranKota::where('kategori', 'Danau')->orderBy('no_urut', 'asc')->get();

        // 2. Lempar ke-4 variabel di atas ke file Blade (data_hidrant_gedung)
        return view('internal.sapra.data_hidrant_gedung', compact('hidranPilar', 'hidranGedung', 'embung', 'danau'));
    }

    public function store(Request $request)
    {
        HidranKota::create($request->all());
        return back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        HidranKota::findOrFail($id)->update($request->all());
        return back()->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        HidranKota::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus!');
    }

    public function cetakPdf()
    {
        $dataHidran = HidranKota::orderBy('no_urut', 'asc')->get();
        $pdf = Pdf::loadView('internal.sapra.hidran_pdf', compact('dataHidran'));
        return $pdf->download('data_prasarana_Hidrant.pdf');
    }
}
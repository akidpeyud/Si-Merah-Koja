<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiklatF1;
use App\Models\DiklatF2;
use App\Models\DiklatInspektur;
use App\Models\DiklatMfr;
use App\Models\DiklatRescue;
use App\Models\DiklatOperator;
use App\Models\DiklatPpl;
use App\Models\InspeksiBangunan;
use App\Models\FireDrill;
use App\Models\PelatihanKeluarga; // Sudah dipindah ke atas dengan benar

class PencegahanController extends Controller
{
    // ==========================================
    // BAGIAN PENINGKATAN KAPASITAS (DIKLAT)
    // ==========================================
    public function indexDiklatF1()
    {
        $data_diklat = DiklatF1::all(); 
        return view('internal.pencegahan.diklat_f1', compact('data_diklat'));
    }
    
    public function indexDiklatF2()
    {
        $data_diklat = DiklatF2::all(); 
        return view('internal.pencegahan.diklat_f2', compact('data_diklat'));
    }

    public function indexDiklatInspektur()
    {
        $data_diklat = DiklatInspektur::all(); 
        return view('internal.pencegahan.diklat_inspektur', compact('data_diklat'));
    }

    public function indexDiklatMfr()
    {
        $data_diklat = DiklatMfr::all(); 
        return view('internal.pencegahan.diklat_mfr', compact('data_diklat'));
    }

    public function indexDiklatRescue()
    {
        $data_diklat = DiklatRescue::all(); 
        return view('internal.pencegahan.diklat_rescue', compact('data_diklat'));
    }

    public function indexDiklatOperator()
    {
        $data_diklat = DiklatOperator::all(); 
        return view('internal.pencegahan.diklat_operator', compact('data_diklat'));
    }

    public function indexDiklatPpl()
    {
        $data_diklat = DiklatPpl::all(); 
        return view('internal.pencegahan.diklat_ppl', compact('data_diklat'));
    }

    public function indexPeningkatanKapasitas()
    {
        $dataF1        = DiklatF1::all();
        $dataF2        = DiklatF2::all();
        $dataInspektur = DiklatInspektur::all();
        $dataMfr       = DiklatMfr::all();
        $dataRescue    = DiklatRescue::all();
        $dataOperator  = DiklatOperator::all();
        $dataPpl       = DiklatPpl::all();

        return view('internal.pencegahan.peningkatan_kapasitas', compact(
            'dataF1', 'dataF2', 'dataInspektur', 'dataMfr', 'dataRescue', 'dataOperator', 'dataPpl'
        ));
    }


    // ==========================================
    // BAGIAN INSPEKSI BANGUNAN
    // ==========================================
    public function index()
    {
        $data_inspeksi = InspeksiBangunan::all();
        return view('internal.pencegahan.inspeksi_kebakaran', compact('data_inspeksi'));
    }

    public function indexInspeksiBangunan()
    {
        $data_inspeksi = InspeksiBangunan::all();
        return view('internal.pencegahan.inspeksi_bangunan', compact('data_inspeksi'));
    }

    public function create()
    {
        return view('internal.pencegahan.tambah_inspeksi_bangunan');
    }

    public function store(Request $request)
    {
        InspeksiBangunan::create([
            'nama_tempat'      => $request->nama_tempat,
            'tanggal_inspeksi' => $request->tanggal_inspeksi, 
            'jenis_usaha'      => $request->jenis_usaha,
        ]);

        return redirect('/internal/pencegahan/inspeksi-kebakaran/bangunan')->with('success', 'Data berhasil ditambahkan!');
    }

    public function editInspeksiBangunan($id)
    {
        $item = InspeksiBangunan::findOrFail($id);
        return view('internal.pencegahan.edit_inspeksi_bangunan', compact('item'));
    }

    public function updateInspeksiBangunan(Request $request, $id)
    {
        $item = InspeksiBangunan::findOrFail($id);
        $item->update([
            'nama_tempat' => $request->nama_tempat,
            'tanggal_inspeksi' => $request->tanggal_inspeksi,
            'jenis_usaha' => $request->jenis_usaha,
        ]);

        return redirect('/internal/pencegahan/inspeksi-kebakaran/bangunan')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroyInspeksiBangunan($id)
    {
        $item = InspeksiBangunan::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }


    // ==========================================
    // BAGIAN FIRE DRILL
    // ==========================================
    public function indexFireDrill()
    {
        $data_fire_drill = FireDrill::all();
        return view('internal.pencegahan.fire_drill', compact('data_fire_drill'));
    }

    public function createFireDrill()
    {
        return view('internal.pencegahan.tambah_fire_drill');
    }

    public function storeFireDrill(Request $request)
    {
        FireDrill::create([
            'nama_instansi'       => $request->nama_instansi,
            'tahun'               => $request->tahun,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'tempat_pelaksanaan'  => $request->tempat_pelaksanaan,
            'peserta_laki_laki'   => $request->peserta_laki_laki ?? 0,
            'peserta_perempuan'   => $request->peserta_perempuan ?? 0,
            'total_peserta'       => ($request->peserta_laki_laki + $request->peserta_perempuan),
        ]);

        return redirect('/internal/pencegahan/inspeksi-kebakaran/fire-drill')->with('success', 'Data Fire Drill berhasil ditambahkan!');
    }

    public function editFireDrill($id)
    {
        $item = FireDrill::findOrFail($id);
        return view('internal.pencegahan.edit_fire_drill', compact('item'));
    }

    public function updateFireDrill(Request $request, $id)
    {
        $item = FireDrill::findOrFail($id);
        $item->update([
            'nama_instansi'       => $request->nama_instansi,
            'tahun'               => $request->tahun,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'tempat_pelaksanaan'  => $request->tempat_pelaksanaan,
            'peserta_laki_laki'   => $request->peserta_laki_laki ?? 0,
            'peserta_perempuan'   => $request->peserta_perempuan ?? 0,
            'total_peserta'       => ($request->peserta_laki_laki + $request->peserta_perempuan),
        ]);

        return redirect('/internal/pencegahan/inspeksi-kebakaran/fire-drill')->with('success', 'Data Fire Drill berhasil diperbarui!');
    }

    public function destroyFireDrill($id)
    {
        $item = FireDrill::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Data Fire Drill berhasil dihapus!');
    }


    // ==========================================
    // BAGIAN PELATIHAN KELUARGA (DAMKAR GOES TO RT)
    // ==========================================
    public function indexPelatihanKeluarga()
    {
        $data_pelatihan = PelatihanKeluarga::orderBy('tanggal_pelaksanaan', 'desc')->get();
        // Path view sudah disesuaikan ke internal.pencegahan
        return view('internal.pencegahan.pelatihan_keluarga', compact('data_pelatihan')); 
    }

    public function createPelatihanKeluarga()
    {
        // Path view sudah disesuaikan ke internal.pencegahan
        return view('internal.pencegahan.tambah_pelatihan_keluarga'); 
    }

    public function storePelatihanKeluarga(Request $request)
    {
        PelatihanKeluarga::create([
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'posyandu'            => $request->posyandu,
            'rt'                  => $request->rt,
            'kelurahan'           => $request->kelurahan,
            'kecamatan'           => $request->kecamatan,
            'peserta_perempuan'   => $request->peserta_perempuan ?? 0,
            'peserta_laki_laki'   => $request->peserta_laki_laki ?? 0,
        ]);

        return redirect()->route('pelatihan_keluarga.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function editPelatihanKeluarga($id)
    {
        $item = PelatihanKeluarga::findOrFail($id);
        // Path view sudah disesuaikan ke internal.pencegahan
        return view('internal.pencegahan.edit_pelatihan_keluarga', compact('item')); 
    }

    public function updatePelatihanKeluarga(Request $request, $id)
    {
        $item = PelatihanKeluarga::findOrFail($id);
        $item->update([
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'posyandu'            => $request->posyandu,
            'rt'                  => $request->rt,
            'kelurahan'           => $request->kelurahan,
            'kecamatan'           => $request->kecamatan,
            'peserta_perempuan'   => $request->peserta_perempuan ?? 0,
            'peserta_laki_laki'   => $request->peserta_laki_laki ?? 0,
        ]);

        return redirect()->route('pelatihan_keluarga.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroyPelatihanKeluarga($id)
    {
        $item = PelatihanKeluarga::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class PencegahanController extends Controller
{
    // =========================================================================
    // BAGIAN PENINGKATAN KAPASITAS (DIKLAT)
    // =========================================================================

    public function indexDiksar()
    {
        $data_diklat = DB::table('tbl_diksar')->orderBy('id', 'desc')->get();
        return view('internal.pencegahan.diksar', compact('data_diklat'));
    }

    public function indexDiklatF1()
    {
        $data_diklat = DB::table('tbl_diklat_f1')->orderBy('id', 'desc')->get();
        return view('internal.pencegahan.diklat_f1', compact('data_diklat'));
    }

    public function indexDiklatF2()
    {
        $data_diklat = DB::table('tbl_diklat_f2')->orderBy('id', 'desc')->get();
        return view('internal.pencegahan.diklat_f2', compact('data_diklat'));
    }

    public function indexDiklatInspektur()
    {
        $data_diklat = DB::table('tbl_diklat_inspektur')->orderBy('id', 'desc')->get();
        return view('internal.pencegahan.diklat_inspektur', compact('data_diklat'));
    }

    public function indexDiklatMfr()
    {
        $data_diklat = DB::table('tbl_diklat_mfr')->orderBy('id', 'desc')->get();
        return view('internal.pencegahan.diklat_mfr', compact('data_diklat'));
    }

    public function indexDiklatRescue()
    {
        $data_diklat = DB::table('tbl_diklat_rescue')->orderBy('id', 'desc')->get();
        return view('internal.pencegahan.diklat_rescue', compact('data_diklat'));
    }

    public function indexDiklatOperator()
    {
        $data_diklat = DB::table('tbl_diklat_operator')->orderBy('id', 'desc')->get();
        return view('internal.pencegahan.diklat_operator', compact('data_diklat'));
    }

    public function indexDiklatPpl()
    {
        $data_diklat = DB::table('tbl_diklat_ppl')->orderBy('id', 'desc')->get();
        return view('internal.pencegahan.diklat_ppl', compact('data_diklat'));
    }

    // Halaman Utama "Peningkatan Kapasitas" yang menarik semua data
    public function indexPeningkatanKapasitas()
    {
        $dataDiksar    = DB::table('tbl_diksar')->orderBy('id', 'desc')->get();
        $dataF1        = DB::table('tbl_diklat_f1')->orderBy('id', 'desc')->get();
        $dataF2        = DB::table('tbl_diklat_f2')->orderBy('id', 'desc')->get();
        $dataInspektur = DB::table('tbl_diklat_inspektur')->orderBy('id', 'desc')->get();
        $dataMfr       = DB::table('tbl_diklat_mfr')->orderBy('id', 'desc')->get();
        $dataRescue    = DB::table('tbl_diklat_rescue')->orderBy('id', 'desc')->get();
        $dataOperator  = DB::table('tbl_diklat_operator')->orderBy('id', 'desc')->get();
        $dataPpl       = DB::table('tbl_diklat_ppl')->orderBy('id', 'desc')->get();

        return view('internal.pencegahan.peningkatan_kapasitas', compact(
            'dataDiksar',
            'dataF1', 
            'dataF2', 
            'dataInspektur', 
            'dataMfr', 
            'dataRescue', 
            'dataOperator', 
            'dataPpl'
        ));
    }

    // =========================================================================
    // BAGIAN PENCEGAHAN DAN INSPEKSI BANGUNAN
    // =========================================================================

    public function createInspeksiBangunan()
    {
        // Pastikan nama file blade-nya 'tambah_inspeksi_bangunan.blade.php'
        return view('internal.pencegahan.tambah_inspeksi_bangunan');
    }

    public function storeInspeksiBangunan(Request $request)
    {
        // Logika untuk menyimpan data ke database nanti
    }
}
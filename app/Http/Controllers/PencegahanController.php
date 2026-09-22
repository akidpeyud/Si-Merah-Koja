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

class PencegahanController extends Controller
{
    // ... kodingan lu (termasuk function F1, F2, dan Inspektur) di bawahnya ...
    public function indexDiklatF1()
    {
        $data_diklat = DiklatF1::all(); 
        return view('internal.pencegahan.diklat_f1', compact('data_diklat'));
    }

    
    public function indexDiklatF2()
    {
        $data_diklat = DiklatF2::all(); 
        // Menggunakan variabel yang sama ($data_diklat) agar HTML tidak perlu diubah
        return view('internal.pencegahan.diklat_f2', compact('data_diklat'));
    }

    public function indexDiklatInspektur()
    {
        $data_diklat = DiklatInspektur::all(); 
        return view('internal.pencegahan.diklat_inspektur', compact('data_diklat'));
    }
    // TAMBAHKAN FUNCTION INI
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
    // TAMBAHKAN FUNCTION INI UNTUK HALAMAN UTAMA "PENINGKATAN KAPASITAS"
    public function indexPeningkatanKapasitas()
    {
        // 1. Tarik semua data dari masing-masing model
        $dataF1        = DiklatF1::all();
        $dataF2        = DiklatF2::all();
        $dataInspektur = DiklatInspektur::all();
        $dataMfr       = DiklatMfr::all();
        $dataRescue    = DiklatRescue::all();
        $dataOperator  = DiklatOperator::all();
        $dataPpl       = DiklatPpl::all();
        // Tambahkan model Diksar jika ada: $dataDiksar = Diksar::all();

        // 2. Kirim semuanya ke file blade utama tempat tab "Semua Data" berada
        // Pastikan nama view-nya sesuai dengan file utamamu (misal: 'internal.pencegahan.peningkatan_kapasitas')
        return view('internal.pencegahan.peningkatan_kapasitas', compact(
            'dataF1', 
            'dataF2', 
            'dataInspektur', 
            'dataMfr', 
            'dataRescue', 
            'dataOperator', 
            'dataPpl'
        ));
    }
}
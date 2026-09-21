<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    // --- 1. FUNGSI BARU UNTUK HALAMAN LANDING UMUM ---
    public function indexLayanan()
    {
        return view('informasi_layanan.index_layanan'); 
    }

    // --- 2. NAMA FUNGSI DIUBAH JADI informasiSarana ---
    // Halaman Publik: Sarana Pemadam
    public function informasiSarana()
    {
        $posPemadam = DB::table('pos_pemadam')->orderBy('id_pos', 'asc')->get();
        $dataSarana = DB::table('sarana_kebakaran')->orderBy('id_sarana', 'asc')->get();

        // Nama view-nya juga disesuaikan jadi informasi_sarana
        return view('informasi_layanan.informasi_sarana', compact('posPemadam', 'dataSarana'));
    }

    // Halaman Publik: Prasarana Pemadam
    public function informasiPrasarana()
    {
        $posPemadam = DB::table('pos_pemadam')->orderBy('id_pos', 'asc')->get();
        $dataPrasarana = DB::table('prasarana')->orderBy('id_prasarana', 'asc')->get(); 

        return view('informasi_layanan.informasi_prasarana', compact('posPemadam', 'dataPrasarana'));
    }

    // Halaman Publik: Sarana Penyelamatan
    public function informasiPenyelamatan()
    {
        $posPemadam = DB::table('pos_pemadam')->orderBy('id_pos', 'asc')->get();
        $dataPenyelamatan = DB::table('sarana_penyelamatan')->get(); 

        return view('informasi_layanan.informasi_penyelamatan', compact('posPemadam', 'dataPenyelamatan'));
    }

    // Halaman Publik: Sarana Pemeriksaan
    public function informasiPemeriksaan()
    {
        $posPemadam = DB::table('pos_pemadam')->orderBy('id_pos', 'asc')->get();
        $dataPemeriksaan = DB::table('sarana_pemeriksaan')->get(); 

        return view('informasi_layanan.informasi_pemeriksaan', compact('posPemadam', 'dataPemeriksaan'));
    }
}
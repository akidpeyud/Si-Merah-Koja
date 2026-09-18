<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    // Halaman Publik: Sarana Pemadam
    public function informasiLayanan()
    {
        $posPemadam = DB::table('pos_pemadam')->orderBy('id_pos', 'asc')->get();
        $dataSarana = DB::table('sarana_kebakaran')->orderBy('id_sarana', 'asc')->get();

        // Pakai tanda titik buat manggil file di dalam folder
        return view('informasi_layanan.informasi_layanan', compact('posPemadam', 'dataSarana'));
    }

    // Halaman Publik: Prasarana Pemadam
    public function informasiPrasarana()
    {
        $posPemadam = DB::table('pos_pemadam')->orderBy('id_pos', 'asc')->get();
        $dataPrasarana = DB::table('prasarana')->orderBy('id_prasarana', 'asc')->get(); 

        // Pakai tanda titik buat manggil file di dalam folder
       return view('informasi_layanan.informasi_prasarana', compact('posPemadam', 'dataPrasarana'));
    }
    // Halaman Publik: Sarana Penyelamatan
    public function informasiPenyelamatan()
    {
        $posPemadam = DB::table('pos_pemadam')->orderBy('id_pos', 'asc')->get();
        
        // Sesuaikan nama tabelnya kalau beda ('sarana_penyelamatan' atau sejenisnya)
        $dataPenyelamatan = DB::table('sarana_penyelamatan')->get(); 

        return view('informasi_layanan.informasi_penyelamatan', compact('posPemadam', 'dataPenyelamatan'));
    }
    // Halaman Publik: Sarana Pemeriksaan
    public function informasiPemeriksaan()
    {
        $posPemadam = DB::table('pos_pemadam')->orderBy('id_pos', 'asc')->get();
        
        // Asumsi nama tabel lu di database 'sarana_pemeriksaan'
        $dataPemeriksaan = DB::table('sarana_pemeriksaan')->get(); 

        return view('informasi_layanan.informasi_pemeriksaan', compact('posPemadam', 'dataPemeriksaan'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformasiLayananController extends Controller
{
    public function index()
    {
        // Ambil semua data manual dari tabel rekap_layanan
        $rekapLayanan = DB::table('rekap_layanan')
            ->select('kategori', DB::raw('SUM(jumlah) as total'))
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        $dataStatistik = [
            // --- REKAP LAYANAN ---
            'layanan_kebakaran' => $rekapLayanan['kebakaran'] ?? 0,
            'layanan_ular'      => $rekapLayanan['evakuasi_ular'] ?? 0,
            'layanan_rescue'    => $rekapLayanan['rescue_darat_air'] ?? 0,
            'layanan_tawon'     => $rekapLayanan['evakuasi_tawon'] ?? 0,
            'layanan_edukasi'   => $rekapLayanan['edukasi_kunjungan'] ?? 0,
            'layanan_hewan'     => $rekapLayanan['evakuasi_hewan'] ?? 0,
            'layanan_gedung'    => $rekapLayanan['pemeriksaan_gedung'] ?? 0,
            'layanan_cincin'    => $rekapLayanan['evakuasi_cincin'] ?? 0,

            // --- OBJEK KEBAKARAN (Sekarang bersumber dari form manual juga) ---
            'objek_rumah'       => $rekapLayanan['objek_rumah'] ?? 0,
            'objek_kantor'      => $rekapLayanan['objek_kantor'] ?? 0,
            'objek_ruko'        => $rekapLayanan['objek_ruko'] ?? 0,
            'objek_gudang'      => $rekapLayanan['objek_gudang'] ?? 0,
            'objek_bengkel'     => $rekapLayanan['objek_bengkel'] ?? 0,
            'objek_mall'        => $rekapLayanan['objek_mall'] ?? 0,
            'objek_restoran'    => $rekapLayanan['objek_restoran'] ?? 0,
            'objek_toko'        => $rekapLayanan['objek_toko'] ?? 0,
            'objek_kandang'     => $rekapLayanan['objek_kandang'] ?? 0,
            'objek_kendaraan'   => $rekapLayanan['objek_kendaraan'] ?? 0,
            'objek_hotel'       => $rekapLayanan['objek_hotel'] ?? 0,
            'objek_hiburan'     => $rekapLayanan['objek_hiburan'] ?? 0,
            'objek_vital'       => $rekapLayanan['objek_vital'] ?? 0,
        ];

        return view('informasi_layanan.informasi_layanan', compact('dataStatistik'));
    }
}
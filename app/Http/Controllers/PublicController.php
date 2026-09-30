<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\InspeksiBangunan;
use App\Models\FireDrill;
use App\Models\PelatihanKeluarga;

class PublicController extends Controller
{
    // --- 1. HALAMAN LANDING INFORMASI LAYANAN (dengan total data Bagian pencegahan) ---
    public function indexLayanan()
    {
        // Hitung total dari tabel mentah. Kalau tabel belum ada, hasilnya 0 (tidak error).
        $hitung = function ($tabel) {
            return Schema::hasTable($tabel) ? DB::table($tabel)->count() : 0;
        };

        $stat = [
            // Peningkatan Kapasitas Aparatur (tabel sama dengan PencegahanController)
            'diksar'    => $hitung('tbl_diksar'),
            'f1'        => $hitung('tbl_diklat_f1'),
            'f2'        => $hitung('tbl_diklat_f2'),
            'rescue'    => $hitung('tbl_diklat_rescue'),
            'mfr'       => $hitung('tbl_diklat_mfr'),
            'operator'  => $hitung('tbl_diklat_operator'),
            'inspektur' => $hitung('tbl_diklat_inspektur'),
            'ppl'       => $hitung('tbl_diklat_ppl'),

            // Pencegahan Kebakaran & Inspeksi (pakai Model, sama seperti controller internal)
            'inspeksi'   => InspeksiBangunan::count(),
            'fire_drill' => FireDrill::count(),

            // Pemberdayaan Masyarakat
            'pelatihan'   => PelatihanKeluarga::count(),
            'sosialisasi' => $hitung('sosialisasi_edukasi'),
        ];

        return view('informasi_layanan.index_layanan', compact('stat'));
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

    // Halaman Publik: Sumber Air
    public function sumberAir()
    {
        // Query database dilengkapi
        $hidranPilar  = DB::table('prasaranas')->where('kategori', 'Hidrant Pilar')->orderBy('no_urut', 'asc')->get();
        $hidranGedung = DB::table('prasaranas')->where('kategori', 'Hidrant Gedung')->orderBy('no_urut', 'asc')->get();
        $embung       = DB::table('prasaranas')->where('kategori', 'Embung')->orderBy('no_urut', 'asc')->get();
        $danau        = DB::table('prasaranas')->where('kategori', 'Danau')->orderBy('no_urut', 'asc')->get();

        return view('informasi_layanan.sumber_air', compact('hidranPilar', 'hidranGedung', 'embung', 'danau'));
    }

    // Halaman Publik: Data Hidrant Kota Jambi
    public function hidrantKota()
    {
        $dataMaintenance = DB::table('hidran_kota')->orderBy('id', 'asc')->get();
        return view('informasi_layanan.hidrant_kota', compact('dataMaintenance'));
    }
}
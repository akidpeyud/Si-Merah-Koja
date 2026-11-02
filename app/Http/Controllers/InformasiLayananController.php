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

        // Cek data edukasi & inspeksi jika tabel tersedia
        $edukasiCount = 0;
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('sosialisasi_edukasi')) {
                $edukasiCount += DB::table('sosialisasi_edukasi')->count();
            }
            if (\Illuminate\Support\Facades\Schema::hasTable('permohonan_edukasi')) {
                $edukasiCount += DB::table('permohonan_edukasi')->count();
            }
        } catch (\Throwable $e) {
            $edukasiCount = 0;
        }

        $gedungCount = 0;
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('inspeksi_bangunans')) {
                $gedungCount = DB::table('inspeksi_bangunans')->count();
            }
        } catch (\Throwable $e) {
            $gedungCount = 0;
        }

        $ularCount = 0;
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('laporan_penyelamatans')) {
                $ularCount = DB::table('laporan_penyelamatans')
                    ->where(function ($q) {
                        $q->where('rincian_kategori_non_kebakaran', 'like', '%ular%')
                          ->orWhere('kategori_non_kebakaran', 'evakuasi_liar');
                    })->count();
            }
        } catch (\Throwable $e) {
            $ularCount = 0;
        }

        $totalHewan = (int) ($rekapLayanan['evakuasi_hewan'] ?? 0);
        $hewanLainnya = max(0, $totalHewan - $ularCount);

        $rescueTotal = (int) (($rekapLayanan['pencarian_air'] ?? 0)
            + ($rekapLayanan['evakuasi_manusia'] ?? 0)
            + ($rekapLayanan['pohon_tumbang'] ?? 0)
            + ($rekapLayanan['rescue_darat_air'] ?? 0));

        $dataStatistik = [
            // --- REKAP LAYANAN ---
            'layanan_kebakaran' => (int) ($rekapLayanan['kebakaran'] ?? 0),
            'layanan_ular'      => (int) ($rekapLayanan['evakuasi_ular'] ?? $ularCount),
            'layanan_rescue'    => $rescueTotal,
            'layanan_tawon'     => (int) ($rekapLayanan['sarang_tawon'] ?? ($rekapLayanan['evakuasi_tawon'] ?? 0)),
            'layanan_edukasi'   => (int) ($rekapLayanan['edukasi_kunjungan'] ?? $edukasiCount),
            'layanan_hewan'     => $hewanLainnya > 0 ? $hewanLainnya : $totalHewan,
            'layanan_gedung'    => (int) ($rekapLayanan['pemeriksaan_gedung'] ?? $gedungCount),
            'layanan_cincin'    => (int) ($rekapLayanan['pelepasan_cincin'] ?? ($rekapLayanan['evakuasi_cincin'] ?? 0)),

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
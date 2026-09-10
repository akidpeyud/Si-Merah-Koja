<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\LaporanPenyelamatan;
use App\Models\LpTeknisLogistik;
use App\Models\LpDokumentasi;
use App\Models\LpKategoriKhusus;

class DamtanController extends Controller
{
    // Menampilkan form input
    public function createPenyelamatan()
    {
        return view('internal.damtan.input_data');
    }

    // Menampilkan tabel data laporan
    public function indexPenyelamatan()
    {
        $laporans = LaporanPenyelamatan::with(['teknisLogistik', 'dokumentasi', 'kategoriKhusus'])
                    ->latest()
                    ->get();
                    
        return view('internal.damtan.data_laporan', compact('laporans'));
    }

    // Menyimpan data dari form
    public function storePenyelamatan(Request $request)
    {
        DB::beginTransaction();

        try {
            // 1. Simpan ke Tabel Utama (LaporanPenyelamatan)
            $laporan = LaporanPenyelamatan::create([
                'nomor_laporan' => 'REG-' . date('Ymd') . '-' . rand(1000, 9999),
                'id_laporan' => Str::uuid(),
                'kategori_kebakaran' => $request->kategori_kebakaran,
                'kategori_non_kebakaran' => $request->kategori_non_kebakaran,
                'rincian_kategori_non_kebakaran' => $request->rincian_kategori_non_kebakaran,
                'kategori_kejadian' => $request->kategori_kejadian,
                'prioritas' => $request->prioritas ?? 'rendah',
                'waktu_kejadian' => $request->waktu_kejadian,
                'waktu_terima' => $request->waktu_terima,
                'waktu_berangkat' => $request->waktu_berangkat,
                'waktu_tiba' => $request->waktu_tiba,
                'waktu_selesai' => $request->waktu_selesai,
                'alamat' => $request->alamat,
                'koordinat' => $request->koordinat,
            ]);

            // 2. Simpan ke Tabel Teknis & Logistik
            $laporan->teknisLogistik()->create([
                'korban_selamat' => $request->korban_selamat ?? 0,
                'korban_ringan' => $request->korban_ringan ?? 0,
                'korban_berat' => $request->korban_berat ?? 0,
                'korban_meninggal' => $request->korban_meninggal ?? 0,
                'korban_hewan_aset' => $request->korban_hewan_aset,
                'status_evakuasi' => $request->status_evakuasi,
                'objek_terdampak' => $request->objek_terdampak,
                'metode_evakuasi' => $request->metode_evakuasi,
                'metode_penyelamatan' => $request->metode_penyelamatan,
                'hambatan_lapangan' => $request->hambatan_lapangan,
                'peralatan' => $request->peralatan,
                'peralatan_lain' => $request->peralatan_lain,
                'konsumsi_alat' => $request->konsumsi_alat,
                'liter_air' => $request->liter_air ?? 0,
                'liter_foam' => $request->liter_foam ?? 0,
                'liter_bbm' => $request->liter_bbm ?? 0,
                'armada' => $request->armada,
                'jumlah_personel' => $request->jumlah_personel ?? 0,
                'daftar_personel' => $request->daftar_personel,
            ]);

            // 3. Proses File Upload (Foto & Video)
            $fotoPaths = [];
            if ($request->hasFile('foto')) {
                foreach ($request->file('foto') as $file) {
                    $fotoPaths[] = $file->store('uploads/penyelamatan/foto', 'public');
                }
            }

            $videoPath = null;
            if ($request->hasFile('video')) {
                $videoPath = $request->file('video')->store('uploads/penyelamatan/video', 'public');
            }

            // Simpan ke Tabel Dokumentasi
            $laporan->dokumentasi()->create([
                'dugaan_penyebab' => $request->dugaan_penyebab,
                'dugaan_penyebab_lainnya' => $request->dugaan_penyebab_lainnya,
                'sumber_api' => $request->sumber_api,
                'luas_area' => $request->luas_area,
                'instansi_pendukung' => $request->instansi_pendukung,
                'tindakan_instansi' => $request->tindakan_instansi,
                'kontak_saksi' => $request->kontak_saksi,
                'kebutuhan_tambahan' => $request->kebutuhan_tambahan,
                'saran_mitigasi' => $request->saran_mitigasi,
                'kronologi_lengkap' => $request->kronologi_lengkap,
                'foto' => !empty($fotoPaths) ? $fotoPaths : null,
                'video' => $videoPath,
            ]);

            // 4. Simpan ke Tabel Kategori Khusus
            $laporan->kategoriKhusus()->create([
                'jenis_hewan' => $request->jenis_hewan,
                'spesies_hewan' => $request->spesies_hewan,
                'dimensi_hewan' => $request->dimensi_hewan,
                'status_hewan_pasca' => $request->status_hewan_pasca,
                'lokasi_pelepasan' => $request->lokasi_pelepasan,
                'jenis_objek_tumbang' => $request->jenis_objek_tumbang,
                'dimensi_objek' => $request->dimensi_objek,
                'status_utilitas' => $request->status_utilitas,
                'dampak_properti' => $request->dampak_properti,
                'kondisi_perairan' => $request->kondisi_perairan,
                'radius_pencarian' => $request->radius_pencarian,
                'metode_pencarian_air' => $request->metode_pencarian_air,
                'daftar_penyelam' => $request->daftar_penyelam,
                'jenis_benda_bahaya' => $request->jenis_benda_bahaya,
                'kondisi_anggota_tubuh' => $request->kondisi_anggota_tubuh,
                'alat_potong_cincin' => $request->alat_potong_cincin,
                'cuaca_operasi' => $request->cuaca_operasi,
                'jenis_medan' => $request->jenis_medan,
                'akses_lokasi' => $request->akses_lokasi,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Data Laporan Penyelamatan berhasil disimpan ke database!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
}
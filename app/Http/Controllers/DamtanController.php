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
   public function indexPenyelamatan()
{
    // Mengambil 10 data per halaman
    $data_laporan = DB::table('laporan_penyelamatans')->orderBy('created_at', 'desc')->paginate(10);
    return view('internal.damtan.data_laporan', compact('data_laporan'));
}

    public function createPenyelamatan()
    {
        return view('internal.damtan.input_data');
    }

    public function storePenyelamatan(Request $request)
    {
        // A. SIMPAN KE TABEL 1 (Termasuk data pelapor baru)
        $laporan_id = DB::table('laporan_penyelamatans')->insertGetId([
            'nomor_laporan' => 'REG-' . date('Ymd') . '-' . rand(1000, 9999),
            'id_laporan' => 'UUID-' . strtoupper(Str::random(8)),
            'nama_pelapor' => $request->nama_pelapor,
            'media_pelaporan' => $request->media_pelaporan,
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
            'waktu_kembali' => $request->waktu_kembali,
            'alamat' => $request->alamat,
            'jarak_tempuh' => $request->jarak_tempuh,
            'koordinat' => $request->koordinat,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // B. SIMPAN KE TABEL 2 (Termasuk pimpinan, langkah penanganan)
        DB::table('lp_teknis_logistiks')->insert([
            'laporan_id' => $laporan_id,
            'pimpinan_operasi' => $request->pimpinan_operasi,
            'satuan_tugas' => $request->satuan_tugas,
            'korban_selamat' => $request->korban_selamat ?? 0,
            'korban_ringan' => $request->korban_ringan ?? 0,
            'korban_berat' => $request->korban_berat ?? 0,
            'korban_meninggal' => $request->korban_meninggal ?? 0,
            'korban_hewan_aset' => $request->korban_hewan_aset,
            'status_evakuasi' => $request->status_evakuasi,
            'objek_terdampak' => $request->objek_terdampak,
            'metode_evakuasi' => $request->has('metode_evakuasi') ? json_encode($request->metode_evakuasi) : null,
            'metode_penyelamatan' => $request->has('metode_penyelamatan') ? json_encode($request->metode_penyelamatan) : null,
            'hambatan_lapangan' => $request->hambatan_lapangan,
            'langkah_penanganan' => $request->langkah_penanganan,
            'hasil_tindakan' => $request->hasil_tindakan,
            'peralatan' => $request->has('peralatan') ? json_encode($request->peralatan) : null,
            'peralatan_lain' => $request->peralatan_lain,
            'konsumsi_alat' => $request->konsumsi_alat,
            'liter_air' => $request->liter_air ?? 0,
            'liter_foam' => $request->liter_foam ?? 0,
            'liter_bbm' => $request->liter_bbm ?? 0,
            'armada' => $request->has('armada') ? json_encode($request->armada) : null,
            'jumlah_personel' => $request->jumlah_personel ?? 0,
            'daftar_personel' => $request->daftar_personel,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $json_foto = null;
        if ($request->hasFile('foto')) {
            $foto_paths = [];
            foreach ($request->file('foto') as $file) {
                $namaFoto = time() . '_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/damtan/foto'), $namaFoto);
                $foto_paths[] = $namaFoto;
            }
            $json_foto = json_encode($foto_paths);
        }

        $namaVideo = null;
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $namaVideo = time() . '_vid_' . Str::random(5) . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('uploads/damtan/video'), $namaVideo);
        }

        // C. SIMPAN KE TABEL 3 (Termasuk Cara Bertindak)
        DB::table('lp_dokumentasis')->insert([
            'laporan_id' => $laporan_id,
            'dugaan_penyebab' => $request->dugaan_penyebab,
            'dugaan_penyebab_lainnya' => $request->dugaan_penyebab_lainnya,
            'sumber_api' => $request->sumber_api,
            'luas_area' => $request->luas_area,
            'instansi_pendukung' => $request->has('instansi_pendukung') ? json_encode($request->instansi_pendukung) : null,
            'tindakan_instansi' => $request->tindakan_instansi,
            'kontak_saksi' => $request->kontak_saksi,
            'kebutuhan_tambahan' => $request->kebutuhan_tambahan,
            'saran_mitigasi' => $request->saran_mitigasi,
            'cara_bertindak' => $request->cara_bertindak,
            'kronologi_lengkap' => $request->kronologi_lengkap,
            'foto' => $json_foto,
            'video' => $namaVideo,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // D. SIMPAN KE TABEL 4 (Termasuk Berat Hewan)
        DB::table('lp_kategori_khusus')->insert([
            'laporan_id' => $laporan_id,
            'jenis_hewan' => $request->jenis_hewan,
            'spesies_hewan' => $request->spesies_hewan,
            'dimensi_hewan' => $request->dimensi_hewan,
            'berat_hewan' => $request->berat_hewan,
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
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/internal/damtan/data-laporan')->with('success', 'Data Penyelamatan berhasil disimpan!');
    }

    public function showPenyelamatan($id)
    {
        $laporan = DB::table('laporan_penyelamatans')->where('id', $id)->first();
        $teknis = DB::table('lp_teknis_logistiks')->where('laporan_id', $id)->first();
        $dokumentasi = DB::table('lp_dokumentasis')->where('laporan_id', $id)->first();
        $khusus = DB::table('lp_kategori_khusus')->where('laporan_id', $id)->first();

        if (!$laporan) {
            return redirect('/internal/damtan/data-laporan')->with('error', 'Data tidak ditemukan.');
        }

        return view('internal.damtan.lihat_data', compact('laporan', 'teknis', 'dokumentasi', 'khusus'));
    }

    public function editPenyelamatan($id)
    {
        $laporans = LaporanPenyelamatan::with(['teknisLogistik', 'dokumentasi', 'kategoriKhusus'])
                    ->latest()
                    ->get();
                    
        return view('internal.damtan.data_laporan', compact('laporans'));
    }

    // Menyimpan data dari form
    public function storePenyelamatan(Request $request)
    {
        DB::table('laporan_penyelamatans')->where('id', $id)->update([
            'nama_pelapor' => $request->nama_pelapor,
            'media_pelaporan' => $request->media_pelaporan,
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
            'waktu_kembali' => $request->waktu_kembali,
            'alamat' => $request->alamat,
            'jarak_tempuh' => $request->jarak_tempuh,
            'koordinat' => $request->koordinat,
            'updated_at' => now(),
        ]);

        DB::table('lp_teknis_logistiks')->where('laporan_id', $id)->update([
            'pimpinan_operasi' => $request->pimpinan_operasi,
            'satuan_tugas' => $request->satuan_tugas,
            'korban_selamat' => $request->korban_selamat ?? 0,
            'korban_ringan' => $request->korban_ringan ?? 0,
            'korban_berat' => $request->korban_berat ?? 0,
            'korban_meninggal' => $request->korban_meninggal ?? 0,
            'korban_hewan_aset' => $request->korban_hewan_aset,
            'status_evakuasi' => $request->status_evakuasi,
            'objek_terdampak' => $request->objek_terdampak,
            'metode_evakuasi' => $request->has('metode_evakuasi') ? json_encode($request->metode_evakuasi) : null,
            'metode_penyelamatan' => $request->has('metode_penyelamatan') ? json_encode($request->metode_penyelamatan) : null,
            'hambatan_lapangan' => $request->hambatan_lapangan,
            'langkah_penanganan' => $request->langkah_penanganan,
            'hasil_tindakan' => $request->hasil_tindakan,
            'peralatan' => $request->has('peralatan') ? json_encode($request->peralatan) : null,
            'peralatan_lain' => $request->peralatan_lain,
            'konsumsi_alat' => $request->konsumsi_alat,
            'liter_air' => $request->liter_air ?? 0,
            'liter_foam' => $request->liter_foam ?? 0,
            'liter_bbm' => $request->liter_bbm ?? 0,
            'armada' => $request->has('armada') ? json_encode($request->armada) : null,
            'jumlah_personel' => $request->jumlah_personel ?? 0,
            'daftar_personel' => $request->daftar_personel,
            'updated_at' => now(),
        ]);

        $dokumentasiLama = DB::table('lp_dokumentasis')->where('laporan_id', $id)->first();
        
        $json_foto = $dokumentasiLama->foto ?? null;
        if ($request->hasFile('foto')) {
            $foto_paths = [];
            foreach ($request->file('foto') as $file) {
                $namaFoto = time() . '_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/damtan/foto'), $namaFoto);
                $foto_paths[] = $namaFoto;
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

        DB::table('lp_dokumentasis')->where('laporan_id', $id)->update([
            'dugaan_penyebab' => $request->dugaan_penyebab,
            'dugaan_penyebab_lainnya' => $request->dugaan_penyebab_lainnya,
            'sumber_api' => $request->sumber_api,
            'luas_area' => $request->luas_area,
            'instansi_pendukung' => $request->has('instansi_pendukung') ? json_encode($request->instansi_pendukung) : null,
            'tindakan_instansi' => $request->tindakan_instansi,
            'kontak_saksi' => $request->kontak_saksi,
            'kebutuhan_tambahan' => $request->kebutuhan_tambahan,
            'saran_mitigasi' => $request->saran_mitigasi,
            'cara_bertindak' => $request->cara_bertindak,
            'kronologi_lengkap' => $request->kronologi_lengkap,
            'foto' => $json_foto,
            'video' => $namaVideo,
            'updated_at' => now(),
        ]);

        DB::table('lp_kategori_khusus')->where('laporan_id', $id)->update([
            'jenis_hewan' => $request->jenis_hewan,
            'spesies_hewan' => $request->spesies_hewan,
            'dimensi_hewan' => $request->dimensi_hewan,
            'berat_hewan' => $request->berat_hewan,
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
            'updated_at' => now(),
        ]);

        return redirect('/internal/damtan/data-laporan')->with('success', 'Data Penyelamatan berhasil diperbarui!');
    }

    public function destroyPenyelamatan($id)
    {
        DB::table('lp_teknis_logistiks')->where('laporan_id', $id)->delete();
        DB::table('lp_dokumentasis')->where('laporan_id', $id)->delete();
        DB::table('lp_kategori_khusus')->where('laporan_id', $id)->delete();
        DB::table('laporan_penyelamatans')->where('id', $id)->delete();
        
        return redirect()->back()->with('success', 'Data Keseluruhan berhasil dihapus secara permanen!');
    }
}
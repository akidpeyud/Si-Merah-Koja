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
    // ==========================================
    // KELOLA DATA PENYELAMATAN
    // ==========================================

    // 1. Menampilkan form input
    public function createPenyelamatan()
    {
        return view('internal.damtan.input_data');
    }

    // 2. Menampilkan tabel data laporan
    public function indexPenyelamatan()
    {
        $data_laporan = LaporanPenyelamatan::latest()->paginate(10);
        return view('internal.damtan.data_laporan', compact('data_laporan'));
    }

    // 3. Menampilkan detail data spesifik (Lihat Data)
    public function showPenyelamatan($id)
    {
        // Tarik data laporan beserta relasinya dari 3 tabel lainnya
        $laporan = LaporanPenyelamatan::findOrFail($id);
        
        // Menggunakan relasi Eloquent atau Query Builder
        $teknis = LpTeknisLogistik::where('laporan_id', $id)->first();
        $dokumentasi = LpDokumentasi::where('laporan_id', $id)->first();
        $khusus = LpKategoriKhusus::where('laporan_id', $id)->first();
        
        return view('internal.damtan.lihat_data', compact('laporan', 'teknis', 'dokumentasi', 'khusus'));
    }

    // 4. Menyimpan data dari form (Create)
    public function storePenyelamatan(Request $request)
    {
        DB::beginTransaction();

        try {
            // PROSES UPLOAD FILE
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

            // TAB 1: INSERT TABEL UTAMA
            $laporan = LaporanPenyelamatan::create([
                'user_id' => auth()->id(), 
                'nomor_laporan' => 'REG-' . date('Ymd') . '-' . rand(1000, 9999),
                'id_laporan' => Str::uuid(),

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
            ]);

            // TAB 2: INSERT TABEL TEKNIS & LOGISTIK
            LpTeknisLogistik::create([
                'laporan_id' => $laporan->id,
                'pimpinan_operasi' => $request->pimpinan_operasi,
                'pendamping_operasi' => $request->pendamping_operasi,
                'satuan_tugas' => $request->satuan_tugas,
                'tim_respontime' => $request->tim_respontime,
                'langkah_penanganan' => $request->langkah_penanganan,
                'hambatan_lapangan' => $request->hambatan_lapangan,
                'hasil_tindakan' => $request->hasil_tindakan,
                
                'korban_selamat' => $request->korban_selamat ?? 0,
                'korban_ringan' => $request->korban_ringan ?? 0,
                'korban_berat' => $request->korban_berat ?? 0,
                'korban_meninggal' => $request->korban_meninggal ?? 0,
                'korban_hewan_aset' => $request->korban_hewan_aset,
                'status_evakuasi' => $request->status_evakuasi,
                'objek_terdampak' => $request->objek_terdampak,
                
                'metode_evakuasi' => $request->has('metode_evakuasi') ? json_encode($request->metode_evakuasi) : null,
                'metode_penyelamatan' => $request->has('metode_penyelamatan') ? json_encode($request->metode_penyelamatan) : null,
                'armada' => $request->has('armada') ? json_encode($request->armada) : null,
                'peralatan' => $request->has('peralatan') ? json_encode($request->peralatan) : null,
                
                'peralatan_lain' => $request->peralatan_lain,
                'konsumsi_alat' => $request->konsumsi_alat,
                'liter_air' => $request->liter_air ?? 0,
                'liter_foam' => $request->liter_foam ?? 0,
                'liter_bbm' => $request->liter_bbm ?? 0,
                'jumlah_personel' => $request->jumlah_personel ?? 0,
                'daftar_personel' => $request->daftar_personel,
            ]);

            // TAB 3: INSERT TABEL DOKUMENTASI
            LpDokumentasi::create([
                'laporan_id' => $laporan->id,
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
                'cara_bertindak_lainnya' => $request->cara_bertindak_lainnya,
                'kronologi_lengkap' => $request->kronologi_lengkap,
                
                'foto' => !empty($fotoPaths) ? json_encode($fotoPaths) : null,
                'video' => $videoPath,
            ]);

            // TAB 4: INSERT TABEL KATEGORI KHUSUS
            LpKategoriKhusus::create([
                'laporan_id' => $laporan->id,
                'jenis_hewan' => $request->jenis_hewan,
                'jenis_hewan_lainnya' => $request->jenis_hewan_lainnya,
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
            ]);

            DB::commit();

            return redirect('/internal/damtan/data-laporan')->with('success', 'Data Laporan Penyelamatan berhasil disimpan ke database!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    // 5. Menampilkan form edit laporan
    public function editPenyelamatan($id)
    {
        $laporan = LaporanPenyelamatan::findOrFail($id);
        
        $teknis = LpTeknisLogistik::where('laporan_id', $id)->first() ?? new LpTeknisLogistik();
        $dokumentasi = LpDokumentasi::where('laporan_id', $id)->first() ?? new LpDokumentasi();
        $khusus = LpKategoriKhusus::where('laporan_id', $id)->first() ?? new LpKategoriKhusus();
        
        return view('internal.damtan.edit_data', compact('laporan', 'teknis', 'dokumentasi', 'khusus'));
    }

    // 6. Menyimpan perubahan data (Update)
    public function updatePenyelamatan(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $laporan = LaporanPenyelamatan::findOrFail($id);

            // Update TAB 1
            $laporan->update([
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
            ]);

            // Update TAB 2
            LpTeknisLogistik::updateOrCreate(
                ['laporan_id' => $id],
                [
                    'pimpinan_operasi' => $request->pimpinan_operasi,
                    'pendamping_operasi' => $request->pendamping_operasi,
                    'satuan_tugas' => $request->satuan_tugas,
                    'tim_respontime' => $request->tim_respontime,
                    'langkah_penanganan' => $request->langkah_penanganan,
                    'hambatan_lapangan' => $request->hambatan_lapangan,
                    'hasil_tindakan' => $request->hasil_tindakan,
                    'korban_selamat' => $request->korban_selamat ?? 0,
                    'korban_ringan' => $request->korban_ringan ?? 0,
                    'korban_berat' => $request->korban_berat ?? 0,
                    'korban_meninggal' => $request->korban_meninggal ?? 0,
                    'korban_hewan_aset' => $request->korban_hewan_aset,
                    'status_evakuasi' => $request->status_evakuasi,
                    'objek_terdampak' => $request->objek_terdampak,
                    'metode_evakuasi' => $request->has('metode_evakuasi') ? json_encode($request->metode_evakuasi) : null,
                    'metode_penyelamatan' => $request->has('metode_penyelamatan') ? json_encode($request->metode_penyelamatan) : null,
                    'armada' => $request->has('armada') ? json_encode($request->armada) : null,
                    'peralatan' => $request->has('peralatan') ? json_encode($request->peralatan) : null,
                    'peralatan_lain' => $request->peralatan_lain,
                    'konsumsi_alat' => $request->konsumsi_alat,
                    'liter_air' => $request->liter_air ?? 0,
                    'liter_foam' => $request->liter_foam ?? 0,
                    'liter_bbm' => $request->liter_bbm ?? 0,
                    'jumlah_personel' => $request->jumlah_personel ?? 0,
                    'daftar_personel' => $request->daftar_personel,
                ]
            );

            // Update TAB 3 & Proses Ulang File
            $dokumentasi = LpDokumentasi::where('laporan_id', $id)->first();
            $dataDokumentasi = [
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
                'cara_bertindak_lainnya' => $request->cara_bertindak_lainnya,
                'kronologi_lengkap' => $request->kronologi_lengkap,
            ];

            if ($request->hasFile('foto')) {
                $fotoPaths = [];
                foreach ($request->file('foto') as $file) {
                    $fotoPaths[] = $file->store('uploads/penyelamatan/foto', 'public');
                }
                $dataDokumentasi['foto'] = json_encode($fotoPaths);
            }

            if ($request->hasFile('video')) {
                $dataDokumentasi['video'] = $request->file('video')->store('uploads/penyelamatan/video', 'public');
            }

            LpDokumentasi::updateOrCreate(['laporan_id' => $id], $dataDokumentasi);

            // Update TAB 4
            LpKategoriKhusus::updateOrCreate(
                ['laporan_id' => $id],
                [
                    'jenis_hewan' => $request->jenis_hewan,
                    'jenis_hewan_lainnya' => $request->jenis_hewan_lainnya,
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
                ]
            );

            DB::commit();
            
            return redirect('/internal/damtan/data-laporan')->with('success', 'Data Laporan Penyelamatan berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    // 7. Menghapus data laporan (Delete)
    public function destroyPenyelamatan($id)
    {
        $laporan = LaporanPenyelamatan::findOrFail($id);
        // Karena di migrations kita pakai onDelete('cascade'), 
        // cukup hapus parent-nya, tabel anaknya (Tab 2, 3, 4) akan ikut terhapus otomatis.
        $laporan->delete();

        return redirect()->back()->with('success', 'Data Laporan berhasil dihapus secara permanen!');
    }
    
    // ==========================================
    // KELOLA SURAT KORBAN
    // ==========================================

    public function createSurat()
    {
        return view('internal.damtan.input_surat');
    }

    public function storeSurat(Request $request)
    {
        DB::table('surat_korbans')->insert([
            'nomor_surat' => 'SKK-' . date('Ymd') . '-' . rand(1000, 9999),
            'tanggal_surat' => now(),
            'nama_korban' => $request->nama_korban,
            'status_kepemilikan' => $request->status_kepemilikan,
            'nik' => $request->nik,
            'pekerjaan' => $request->pekerjaan,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status_perkawinan' => $request->status_perkawinan,
            'alamat' => $request->alamat,
            'objek_terbakar' => $request->objek_terbakar,
            'hari_kejadian' => $request->hari_kejadian,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'waktu_kejadian' => $request->waktu_kejadian,
            'tembusan_camat' => $request->tembusan_camat,
            'tembusan_lurah' => $request->tembusan_lurah,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/internal/surat-korban/data')->with('success', 'Data Surat Keterangan Korban berhasil ditambahkan!');
    }

    public function indexSurat()
    {
        $surat = DB::table('surat_korbans')->orderBy('created_at', 'desc')->paginate(10);
        return view('internal.damtan.data_surat', compact('surat'));
    }

    public function editSurat($id)
    {
        $surat = DB::table('surat_korbans')->where('id', $id)->first();
        
        if (!$surat) {
            return redirect('/internal/surat-korban/data')->with('error', 'Data surat tidak ditemukan.');
        }

        return view('internal.damtan.edit_surat', compact('surat'));
    }

    public function updateSurat(Request $request, $id)
    {
        DB::table('surat_korbans')->where('id', $id)->update([
            'nama_korban' => $request->nama_korban,
            'status_kepemilikan' => $request->status_kepemilikan,
            'nik' => $request->nik,
            'pekerjaan' => $request->pekerjaan,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status_perkawinan' => $request->status_perkawinan,
            'alamat' => $request->alamat,
            'objek_terbakar' => $request->objek_terbakar,
            'hari_kejadian' => $request->hari_kejadian,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'waktu_kejadian' => $request->waktu_kejadian,
            'tembusan_camat' => $request->tembusan_camat,
            'tembusan_lurah' => $request->tembusan_lurah,
            'updated_at' => now(),
        ]);

        return redirect('/internal/surat-korban/data')->with('success', 'Data Surat Keterangan Korban berhasil diperbarui!');
    }

    public function destroySurat($id)
    {
        DB::table('surat_korbans')->where('id', $id)->delete();
        return redirect('/internal/surat-korban/data')->with('success', 'Data surat berhasil dihapus secara permanen!');
    }

    // 8. Mencetak Surat Korban (Cetak PDF / Print)
    public function cetakSurat($id)
    {
        $surat = DB::table('surat_korbans')->where('id', $id)->first();
        
        if (!$surat) {
            return redirect('/internal/surat-korban/data')->with('error', 'Data surat tidak ditemukan untuk dicetak.');
        }

        return view('internal.damtan.cetak_surat', compact('surat'));
    }
}
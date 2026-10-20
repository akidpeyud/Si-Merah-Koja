<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\LaporanPenyelamatan;
use App\Models\LpTeknisLogistik;
use App\Models\LpDokumentasi;
use App\Models\LpKategoriKhusus;

class DamtanController extends Controller
{
    // ==========================================
    // BATAS UKURAN FILE UPLOAD (dalam KB)
    // Ubah angka di sini jika ingin mengganti batas.
    // 10240 KB = 10 MB, 20480 KB = 20 MB, dst.
    // CATATAN: upload_max_filesize & post_max_size di php.ini
    // harus >= angka ini, kalau tidak upload tetap gagal.
    // ==========================================
    private const MAX_FOTO_KB  = 10240; // 10 MB per foto
    private const MAX_VIDEO_KB = 10240; // 10 MB untuk video

    /**
     * Validasi file foto & video (dipakai di store dan update).
     * Return Validator agar pesan error bisa dikirim lewat session 'error'.
     */
    private function validasiFile(Request $request)
    {
        return Validator::make($request->all(), [
            'foto'   => 'nullable|array',
            'foto.*' => 'file|mimes:jpg,jpeg,png|max:' . self::MAX_FOTO_KB,
            'video'  => 'nullable|file|mimes:mp4|max:' . self::MAX_VIDEO_KB,
        ], [
            'foto.*.mimes'    => 'Format foto harus JPG atau PNG.',
            'foto.*.max'      => 'Ukuran setiap foto maksimal ' . (self::MAX_FOTO_KB / 1024) . ' MB.',
            'foto.*.uploaded' => 'Foto gagal diunggah. Ukuran file melebihi batas server (cek upload_max_filesize di php.ini).',
            'foto.*.file'     => 'Foto yang diunggah tidak valid.',
            'video.mimes'     => 'Format video harus MP4.',
            'video.max'       => 'Ukuran video maksimal ' . (self::MAX_VIDEO_KB / 1024) . ' MB.',
            'video.uploaded'  => 'Video gagal diunggah. Ukuran file melebihi batas server (cek upload_max_filesize di php.ini).',
            'video.file'      => 'Video yang diunggah tidak valid.',
        ]);
    }

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
        // Hapus with(['teknis', 'dokumentasi']) karena kita sudah menggunakan leftJoin
        $data_laporan = LaporanPenyelamatan::leftJoin('lp_teknis_logistiks', 'laporan_penyelamatans.id', '=', 'lp_teknis_logistiks.laporan_id')
            ->leftJoin('lp_dokumentasis', 'laporan_penyelamatans.id', '=', 'lp_dokumentasis.laporan_id')
            ->leftJoin('lp_kategori_khusus', 'laporan_penyelamatans.id', '=', 'lp_kategori_khusus.laporan_id')
            ->select(
                'laporan_penyelamatans.*',
                'lp_teknis_logistiks.pimpinan_operasi',
                'lp_teknis_logistiks.pendamping_operasi',
                'lp_teknis_logistiks.satuan_tugas',
                'lp_teknis_logistiks.tim_respontime',
                'lp_teknis_logistiks.objek_terdampak',
                'lp_teknis_logistiks.armada',
                'lp_teknis_logistiks.peralatan',
                'lp_teknis_logistiks.peralatan_lain',
                'lp_teknis_logistiks.konsumsi_alat',
                'lp_teknis_logistiks.liter_air',
                'lp_teknis_logistiks.liter_foam',
                'lp_teknis_logistiks.liter_bbm',
                'lp_teknis_logistiks.jumlah_personel',
                'lp_teknis_logistiks.daftar_personel',
                'lp_dokumentasis.dugaan_penyebab',
                'lp_dokumentasis.dugaan_penyebab_lainnya',
                'lp_dokumentasis.sumber_api',
                'lp_dokumentasis.luas_area',
                'lp_dokumentasis.instansi_pendukung',
                'lp_dokumentasis.tindakan_instansi',
                'lp_dokumentasis.kontak_saksi',
                'lp_dokumentasis.cara_bertindak',
                'lp_dokumentasis.kronologi_lengkap',
                'lp_kategori_khusus.jenis_hewan',
                'lp_kategori_khusus.spesies_hewan',
                'lp_kategori_khusus.jenis_objek_tumbang',
                'lp_kategori_khusus.kondisi_perairan',
                'lp_kategori_khusus.jenis_benda_bahaya'
            )
            ->orderBy('laporan_penyelamatans.created_at', 'desc')
            ->paginate(10);

        return view('internal.damtan.data_laporan', compact('data_laporan'));
    }

    // 3. Menampilkan detail data spesifik (Lihat Data)
    public function showPenyelamatan($id)
    {
        // Tarik data laporan beserta relasinya dari 3 tabel lainnya
        $laporan = LaporanPenyelamatan::findOrFail($id);

        // Menggunakan relasi Eloquent atau Query Builder
        $teknis = LpTeknisLogistik::where('laporan_id', $id)->first() ?? new LpTeknisLogistik();
        $dokumentasi = LpDokumentasi::where('laporan_id', $id)->first() ?? new LpDokumentasi();
        $khusus = LpKategoriKhusus::where('laporan_id', $id)->first() ?? new LpKategoriKhusus();

        // ---- Data array (kolom JSON) ----
        $arr_evakuasi     = $this->decodeList($teknis->metode_evakuasi);
        $arr_penyelamatan = $this->decodeList($teknis->metode_penyelamatan);
        $arr_armada       = $this->decodeList($teknis->armada);
        $arr_peralatan    = $this->decodeList($teknis->peralatan);
        $arr_instansi     = $this->decodeList($dokumentasi->instansi_pendukung);
        $arr_foto         = $this->decodeList($dokumentasi->foto);

        // ---- Bagian II: Teknis & Logistik ----
        $has_teknis_dasar = $this->terisi($teknis, ['pimpinan_operasi', 'pendamping_operasi', 'satuan_tugas', 'tim_respontime', 'status_evakuasi', 'objek_terdampak', 'daftar_personel'])
            || $this->positif($teknis, ['jumlah_personel'])
            || !empty($arr_evakuasi) || !empty($arr_penyelamatan);
        $has_detail_lapangan = $this->terisi($teknis, ['langkah_penanganan', 'hambatan_lapangan', 'hasil_tindakan']);
        $has_korban = $this->positif($teknis, ['korban_selamat', 'korban_ringan', 'korban_berat', 'korban_meninggal'])
            || $this->terisi($teknis, ['korban_hewan_aset']);
        $has_logistik = !empty($arr_armada) || !empty($arr_peralatan)
            || $this->terisi($teknis, ['peralatan_lain', 'konsumsi_alat'])
            || $this->positif($teknis, ['liter_air', 'liter_foam', 'liter_bbm']);
        $show_section_ii = $has_teknis_dasar || $has_detail_lapangan || $has_korban || $has_logistik;

        // ---- Bagian III: Analisis, Evaluasi & Dokumentasi ----
        $has_investigasi = $this->terisi($dokumentasi, ['dugaan_penyebab', 'dugaan_penyebab_lainnya', 'sumber_api'])
            || $this->positif($dokumentasi, ['luas_area']);
        $has_lintas_sektoral = !empty($arr_instansi)
            || $this->terisi($dokumentasi, ['tindakan_instansi', 'kontak_saksi', 'cara_bertindak']);
        $has_evaluasi  = $this->terisi($dokumentasi, ['kebutuhan_tambahan', 'saran_mitigasi']);
        $has_kronologi = $this->terisi($dokumentasi, ['kronologi_lengkap']);
        $show_section_iii = $has_investigasi || $has_lintas_sektoral || $has_evaluasi || $has_kronologi;

        // ---- Bagian IV: Kategori Khusus ----
        $has_animal = $this->terisi($khusus, ['jenis_hewan', 'spesies_hewan', 'dimensi_hewan', 'status_hewan_pasca', 'lokasi_pelepasan'])
            || $this->positif($khusus, ['berat_hewan']);
        $has_pohon = $this->terisi($khusus, ['jenis_objek_tumbang', 'status_utilitas', 'dampak_properti'])
            || $this->positif($khusus, ['dimensi_objek']);
        $has_water = $this->terisi($khusus, ['kondisi_perairan', 'metode_pencarian_air', 'daftar_penyelam'])
            || $this->positif($khusus, ['radius_pencarian']);
        $has_ring = $this->terisi($khusus, ['jenis_benda_bahaya', 'kondisi_anggota_tubuh', 'alat_potong_cincin', 'cuaca_operasi', 'jenis_medan', 'akses_lokasi']);
        $show_section_iv = $has_animal || $has_pohon || $has_water || $has_ring;

        return view('internal.damtan.lihat_data', compact(
            'laporan', 'teknis', 'dokumentasi', 'khusus',
            'arr_evakuasi', 'arr_penyelamatan', 'arr_armada', 'arr_peralatan', 'arr_instansi', 'arr_foto',
            'has_teknis_dasar', 'has_detail_lapangan', 'has_korban', 'has_logistik', 'show_section_ii',
            'has_investigasi', 'has_lintas_sektoral', 'has_evaluasi', 'has_kronologi', 'show_section_iii',
            'has_animal', 'has_pohon', 'has_water', 'has_ring', 'show_section_iv'
        ));
    }

    // ---- Helper untuk halaman Lihat Data ----

    /** Ubah kolom JSON/array menjadi array bersih (tanpa nilai kosong). */
    private function decodeList($value): array
    {
        if (is_string($value)) {
            $value = json_decode($value, true);
        }
        if (!is_array($value)) {
            return [];
        }
        return array_values(array_filter($value, fn ($v) => $v !== null && $v !== ''));
    }

    /** True jika salah satu kolom terisi. */
    private function terisi($model, array $fields): bool
    {
        foreach ($fields as $f) {
            if (!empty($model->{$f})) {
                return true;
            }
        }
        return false;
    }

    /** True jika salah satu kolom berisi angka lebih dari 0. */
    private function positif($model, array $fields): bool
    {
        foreach ($fields as $f) {
            $v = $model->{$f};
            if (!empty($v) && $v > 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * Kumpulkan rincian objek kebakaran (jenis bangunan, unit, nama pasar, dst.)
     * sesuai objek yang dipilih. Field yang disembunyikan di form tidak terkirim,
     * jadi cukup ambil yang terisi saja. Hasilnya disimpan sebagai JSON.
     */
    private function rincianObjek(Request $request): ?string
    {
        $fields = [
            'tipe_bangunan_rumah', 'unit_rumah',
            'unit_gudang', 'unit_ruko', 'unit_kantor', 'unit_sekolah',
            'nama_pasar_tempat_usaha', 'jenis_kendaraan', 'jenis_objek_vital',
        ];

        $data = [];
        foreach ($fields as $f) {
            $v = $request->input($f);
            if ($v !== null && $v !== '') {
                $data[$f] = $v;
            }
        }

        return !empty($data) ? json_encode($data) : null;
    }

    // 4. Menyimpan data dari form (Create)
    public function storePenyelamatan(Request $request)
    {
        // VALIDASI UKURAN & FORMAT FILE
        $validator = $this->validasiFile($request);
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', $validator->errors()->first());
        }

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
                'telepon_pelapor' => $request->telepon_pelapor,
                'media_pelaporan' => $request->media_pelaporan,

                // Mendukung input kategori_kebakaran maupun objek_kebakaran
                'kategori_kebakaran' => $request->kategori_kebakaran ?? $request->objek_kebakaran,
                'keterangan_objek_kebakaran' => $request->keterangan_objek_kebakaran,
                'rincian_objek' => $this->rincianObjek($request),

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
                'satuan_tugas' => $request->satuan_tugas ?? $request->satgas_operasi,
                'tim_respontime' => $request->tim_respontime ?? $request->tim_quick_respon,
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
                'liter_air' => $request->liter_air ?? $request->jumlah_air ?? 0,
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
        // VALIDASI UKURAN & FORMAT FILE
        $validator = $this->validasiFile($request);
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $laporan = LaporanPenyelamatan::findOrFail($id);

            // Update TAB 1
            $laporan->update([
                'nama_pelapor' => $request->nama_pelapor,
                'telepon_pelapor' => $request->telepon_pelapor,
                'media_pelaporan' => $request->media_pelaporan,

                'kategori_kebakaran' => $request->kategori_kebakaran ?? $request->objek_kebakaran,
                'keterangan_objek_kebakaran' => $request->keterangan_objek_kebakaran,
                'rincian_objek' => $this->rincianObjek($request),

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
                    'satuan_tugas' => $request->satuan_tugas ?? $request->satgas_operasi,
                    'tim_respontime' => $request->tim_respontime ?? $request->tim_quick_respon,
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
                    'liter_air' => $request->liter_air ?? $request->jumlah_air ?? 0,
                    'liter_foam' => $request->liter_foam ?? 0,
                    'liter_bbm' => $request->liter_bbm ?? 0,
                    'jumlah_personel' => $request->jumlah_personel ?? 0,
                    'daftar_personel' => $request->daftar_personel,
                ]
            );

            // Update TAB 3 & Proses Ulang File
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

    // ==========================================
    // REKAP LAYANAN PEMADAMAN & PENYELAMATAN
    // ==========================================

    private function kategoriLayanan(): array
    {
        return [
            'kebakaran'       => ['Kebakaran',                 'fa-fire',          'ic-red'],
            'evakuasi_hewan'  => ['Evakuasi Hewan',            'fa-paw',           'ic-teal'],
            'sarang_tawon'    => ['Evakuasi Sarang Tawon',     'fa-bug',           'ic-amber'],
            'evakuasi_manusia'=> ['Evakuasi / Pertolongan',    'fa-person-falling','ic-blue'],
            'pohon_tumbang'   => ['Pohon Tumbang',             'fa-tree',          'ic-steel'],
            'pencarian_air'   => ['Pencarian di Perairan',     'fa-life-ring',     'ic-purple'],
            'pelepasan_cincin'=> ['Pelepasan Cincin',          'fa-ring',          'ic-pink'],
            'layanan_lainnya' => ['Layanan Lainnya',           'fa-truck-medical', 'ic-steel'],
        ];
    }

    public function rekapLayanan()
    {
        $kategori = $this->kategoriLayanan();
        $objekKeys = array_keys($this->kategoriObjek());

        $riwayat = DB::table('rekap_layanan')
            ->whereNotIn('kategori', $objekKeys)
            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $totals = DB::table('rekap_layanan')
            ->whereNotIn('kategori', $objekKeys)
            ->select('kategori', DB::raw('SUM(jumlah) as total'))
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        return view('internal.damtan.rekap_layanan', compact('riwayat', 'totals', 'kategori'));
    }

    public function storeRekapLayanan(Request $request)
    {
        $request->validate([
            'tanggal'  => 'required|date',
            'kategori' => ['required', 'in:' . implode(',', array_keys($this->kategoriLayanan()))],
            'jumlah'   => 'required|integer|min:1'
        ]);

        DB::table('rekap_layanan')->insert([
            'tanggal'    => $request->tanggal,
            'kategori'   => $request->kategori,
            'jumlah'     => $request->jumlah,
            'kecamatan'  => $request->kecamatan,
            'lokasi'     => $request->lokasi,
            'keterangan' => $request->keterangan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Data rekap layanan berhasil disimpan!');
    }

    public function destroyRekapLayanan($id)
    {
        DB::table('rekap_layanan')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data rekap berhasil dihapus!');
    }

    // ==========================================
    // REKAP OBJEK KEBAKARAN
    // ==========================================

    private function kategoriObjek(): array
    {
        return [
            'objek_rumah'     => ['Rumah / Hunian',       'fa-house',              'ic-red'],
            'objek_kantor'    => ['Kantor',               'fa-building',           'ic-blue'],
            'objek_ruko'      => ['Ruko',                 'fa-store',              'ic-amber'],
            'objek_gudang'    => ['Gudang',               'fa-warehouse',          'ic-steel'],
            'objek_bengkel'   => ['Bengkel',              'fa-screwdriver-wrench', 'ic-teal'],
            'objek_mall'      => ['Mall / Pusat Belanja', 'fa-bag-shopping',       'ic-pink'],
            'objek_restoran'  => ['Restoran / Warung',    'fa-utensils',           'ic-amber'],
            'objek_toko'      => ['Toko',                 'fa-shop',               'ic-purple'],
            'objek_kandang'   => ['Kandang',              'fa-paw',                'ic-teal'],
            'objek_kendaraan' => ['Kendaraan',            'fa-car',                'ic-red'],
            'objek_hotel'     => ['Hotel / Penginapan',   'fa-hotel',              'ic-blue'],
            'objek_hiburan'   => ['Tempat Hiburan',       'fa-masks-theater',      'ic-purple'],
            'objek_vital'     => ['Objek Vital',          'fa-shield-halved',      'ic-steel'],
        ];
    }

    public function rekapObjek()
    {
        $kategori = $this->kategoriObjek();
        $keys = array_keys($kategori);

        $riwayat = DB::table('rekap_layanan')
            ->whereIn('kategori', $keys)
            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $totals = DB::table('rekap_layanan')
            ->whereIn('kategori', $keys)
            ->select('kategori', DB::raw('SUM(jumlah) as total'))
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        return view('internal.damtan.rekap_objek', compact('riwayat', 'totals', 'kategori'));
    }

    public function storeRekapObjek(Request $request)
    {
        $request->validate([
            'tanggal'  => 'required|date',
            'kategori' => ['required', 'in:' . implode(',', array_keys($this->kategoriObjek()))],
            'jumlah'   => 'required|integer|min:1',
        ]);

        DB::table('rekap_layanan')->insert([
            'tanggal'    => $request->tanggal,
            'kategori'   => $request->kategori,
            'jumlah'     => $request->jumlah,
            'kecamatan'  => $request->kecamatan,
            'lokasi'     => $request->lokasi,
            'keterangan' => $request->keterangan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Data rekap objek kebakaran berhasil disimpan!');
    }

    public function destroyRekapObjek($id)
    {
        DB::table('rekap_layanan')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data rekap berhasil dihapus!');
    }
}
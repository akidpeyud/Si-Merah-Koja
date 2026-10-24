<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenyelamatan;
use App\Models\LpDokumentasi;
use App\Models\LpKategoriKhusus;
use App\Models\LpTeknisLogistik;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DamtanController extends Controller
{
    // ==========================================
    // BATAS UKURAN FILE UPLOAD (dalam KB)
    // 10240 KB = 10 MB, 20480 KB = 20 MB, dst.
    // CATATAN: upload_max_filesize & post_max_size di php.ini
    // harus >= angka ini, kalau tidak upload tetap gagal.
    // ==========================================
    private const MAX_FOTO_KB = 10240; // 10 MB per foto

    private const MAX_VIDEO_KB = 10240; // 10 MB untuk video

    /**
     * Validasi tanggal + file foto & video (dipakai di store dan update).
     * Return Validator agar pesan error bisa dikirim lewat session 'error'.
     */
    private function validasiFile(Request $request)
    {
        return Validator::make($request->all(), [
            'tanggal_kejadian' => 'required|date',
            'foto' => 'nullable|array',
            'foto.*' => 'file|mimes:jpg,jpeg,png|max:'.self::MAX_FOTO_KB,
            'video' => 'nullable|file|mimes:mp4|max:'.self::MAX_VIDEO_KB,
        ], [
            'tanggal_kejadian.required' => 'Tanggal kejadian wajib diisi.',
            'tanggal_kejadian.date' => 'Format tanggal kejadian tidak valid.',
            'foto.*.mimes' => 'Format foto harus JPG atau PNG.',
            'foto.*.max' => 'Ukuran setiap foto maksimal '.(self::MAX_FOTO_KB / 1024).' MB.',
            'foto.*.uploaded' => 'Foto gagal diunggah. Ukuran file melebihi batas server (cek upload_max_filesize di php.ini).',
            'foto.*.file' => 'Foto yang diunggah tidak valid.',
            'video.mimes' => 'Format video harus MP4.',
            'video.max' => 'Ukuran video maksimal '.(self::MAX_VIDEO_KB / 1024).' MB.',
            'video.uploaded' => 'Video gagal diunggah. Ukuran file melebihi batas server (cek upload_max_filesize di php.ini).',
            'video.file' => 'Video yang diunggah tidak valid.',
        ]);
    }

    /**
     * Hari/bulan/tahun dihitung dari tanggal kejadian yang diinput.
     * Server adalah sumber kebenaran, bukan field readonly di browser.
     */
    private function turunanTanggal(Request $request): array
    {
        $t = Carbon::parse($request->tanggal_kejadian)->locale('id');

        return [
            'tanggal_kejadian' => $t->toDateString(),
            'hari_kejadian' => $t->translatedFormat('l'),
            'bulan_kejadian' => $t->translatedFormat('F'),
            'tahun_kejadian' => $t->year,
        ];
    }

    /**
     * Nomor laporan mengikuti tanggal kejadian, urut per tanggal.
     * Harus dipanggil di dalam DB transaction (memakai lockForUpdate).
     * Format: REG-YYYYMMDD-0001
     */
    private function buatNomorLaporan(Carbon $tanggal): string
    {
        $prefix = 'REG-'.$tanggal->format('Ymd').'-';

        $terakhir = LaporanPenyelamatan::where('nomor_laporan', 'like', $prefix.'%')
            ->lockForUpdate()
            ->orderByDesc('nomor_laporan')
            ->value('nomor_laporan');

        $urut = $terakhir ? ((int) substr($terakhir, -4)) + 1 : 1;

        return $prefix.str_pad($urut, 4, '0', STR_PAD_LEFT);
    }

    // ==========================================
    // KELOLA DATA PENYELAMATAN
    // ==========================================

    // 1. Menampilkan form input
    public function createPenyelamatan()
    {
        return view('internal.damtan.input_data');
    }

    // 2. Menampilkan tabel data laporan (dengan tab Kebakaran / Non-Kebakaran)
    //    Filter tahun, tanggal & pencarian dijalankan di SERVER (query), bukan di JavaScript.
    public function indexPenyelamatan(Request $request)
    {
        // Tab aktif dari URL (?tab=kebakaran atau ?tab=non-kebakaran), default kebakaran
        $tab = $request->query('tab', 'kebakaran');
        if (! in_array($tab, ['kebakaran', 'non-kebakaran'])) {
            $tab = 'kebakaran';
        }

        $query = LaporanPenyelamatan::leftJoin('lp_teknis_logistiks', 'laporan_penyelamatans.id', '=', 'lp_teknis_logistiks.laporan_id')
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
            );

        // FILTER TAB (kolom diberi nama tabel agar tidak ambigu karena ada JOIN)
        if ($tab === 'kebakaran') {
            $query->whereRaw("LOWER(TRIM(laporan_penyelamatans.kategori_kejadian)) = 'kebakaran'");
        } else {
            $query->where(function ($w) {
                $w->whereRaw("LOWER(TRIM(laporan_penyelamatans.kategori_kejadian)) != 'kebakaran'")
                    ->orWhereNull('laporan_penyelamatans.kategori_kejadian');
            });
        }

        // Ekspresi tanggal efektif (sama dengan pola urutan): tanggal_kejadian, fallback created_at
        $tglEfektif = 'COALESCE(laporan_penyelamatans.tanggal_kejadian, DATE(laporan_penyelamatans.created_at))';

        // FILTER TAHUN
        if ($request->filled('tahun')) {
            $query->whereRaw("YEAR($tglEfektif) = ?", [(int) $request->tahun]);
        }

        // FILTER TANGGAL (format yyyy-mm-dd dari input type="date")
        if ($request->filled('tanggal')) {
            $query->whereRaw("DATE($tglEfektif) = ?", [$request->tanggal]);
        }

        // PENCARIAN
        if ($request->filled('q')) {
            $q = '%'.trim($request->q).'%';
            $query->where(function ($w) use ($q) {
                $w->where('laporan_penyelamatans.nomor_laporan', 'like', $q)
                    ->orWhere('laporan_penyelamatans.alamat', 'like', $q)
                    ->orWhere('laporan_penyelamatans.kategori_kebakaran', 'like', $q)
                    ->orWhere('laporan_penyelamatans.kategori_non_kebakaran', 'like', $q)
                    ->orWhere('laporan_penyelamatans.kategori_kejadian', 'like', $q)
                    ->orWhere('lp_dokumentasis.dugaan_penyebab', 'like', $q)
                    ->orWhere('lp_dokumentasis.dugaan_penyebab_lainnya', 'like', $q)
                    ->orWhere('lp_teknis_logistiks.armada', 'like', $q);
            });
        }

        $data_laporan = $query
            // Urut berdasarkan tanggal kejadian (data lama tanpa tanggal jatuh ke created_at)
            ->orderByRaw("$tglEfektif DESC")
            ->orderBy('laporan_penyelamatans.id', 'desc')
            ->paginate(20)
            ->withQueryString(); // supaya ?tab=, ?tahun=, ?q= tetap terbawa saat pindah halaman

        // Daftar tahun untuk dropdown: diambil dari SEMUA data (bukan hanya halaman ini)
        $tahunList = LaporanPenyelamatan::selectRaw('YEAR(COALESCE(tanggal_kejadian, created_at)) as tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        return view('internal.damtan.data_laporan', compact('data_laporan', 'tahunList', 'tab'));
    }

    // 3. Menampilkan detail data spesifik (Lihat Data)
    public function showPenyelamatan($id)
    {
        $laporan = LaporanPenyelamatan::findOrFail($id);

        $teknis = LpTeknisLogistik::where('laporan_id', $id)->first() ?? new LpTeknisLogistik;
        $dokumentasi = LpDokumentasi::where('laporan_id', $id)->first() ?? new LpDokumentasi;
        $khusus = LpKategoriKhusus::where('laporan_id', $id)->first() ?? new LpKategoriKhusus;

        // ---- Data array (kolom JSON) ----
        $arr_evakuasi = $this->decodeList($teknis->metode_evakuasi);
        $arr_penyelamatan = $this->decodeList($teknis->metode_penyelamatan);
        $arr_armada = $this->decodeList($teknis->armada);
        $arr_peralatan = $this->decodeList($teknis->peralatan);
        $arr_instansi = $this->decodeList($dokumentasi->instansi_pendukung);
        $arr_foto = $this->decodeList($dokumentasi->foto);

        // ---- Bagian II: Teknis & Logistik ----
        $has_teknis_dasar = $this->terisi($teknis, ['pimpinan_operasi', 'pendamping_operasi', 'satuan_tugas', 'tim_respontime', 'status_evakuasi', 'objek_terdampak', 'daftar_personel'])
            || $this->positif($teknis, ['jumlah_personel'])
            || ! empty($arr_evakuasi) || ! empty($arr_penyelamatan);
        $has_detail_lapangan = $this->terisi($teknis, ['langkah_penanganan', 'hambatan_lapangan', 'hasil_tindakan']);
        $has_korban = $this->positif($teknis, ['korban_selamat', 'korban_ringan', 'korban_berat', 'korban_meninggal'])
            || $this->terisi($teknis, ['korban_hewan_aset']);
        $has_logistik = ! empty($arr_armada) || ! empty($arr_peralatan)
            || $this->terisi($teknis, ['peralatan_lain', 'konsumsi_alat'])
            || $this->positif($teknis, ['liter_air', 'liter_foam', 'liter_bbm']);
        $show_section_ii = $has_teknis_dasar || $has_detail_lapangan || $has_korban || $has_logistik;

        // ---- Bagian III: Analisis, Evaluasi & Dokumentasi ----
        $has_investigasi = $this->terisi($dokumentasi, ['dugaan_penyebab', 'dugaan_penyebab_lainnya', 'sumber_api'])
            || $this->positif($dokumentasi, ['luas_area']);
        $has_lintas_sektoral = ! empty($arr_instansi)
            || $this->terisi($dokumentasi, ['tindakan_instansi', 'kontak_saksi', 'cara_bertindak']);
        $has_evaluasi = $this->terisi($dokumentasi, ['kebutuhan_tambahan', 'saran_mitigasi']);
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
        if (! is_array($value)) {
            return [];
        }

        return array_values(array_filter($value, fn ($v) => $v !== null && $v !== ''));
    }

    /** True jika salah satu kolom terisi. */
    private function terisi($model, array $fields): bool
    {
        foreach ($fields as $f) {
            if (! empty($model->{$f})) {
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
            if (! empty($v) && $v > 0) {
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

        return ! empty($data) ? json_encode($data) : null;
    }

    // 4. Menyimpan data dari form (Create)
    public function storePenyelamatan(Request $request)
    {
        // VALIDASI TANGGAL, UKURAN & FORMAT FILE
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

            // Tanggal kejadian = sumber untuk hari/bulan/tahun & nomor laporan
            $tanggal = Carbon::parse($request->tanggal_kejadian);

            // TAB 1: INSERT TABEL UTAMA
            $laporan = LaporanPenyelamatan::create(array_merge(
                $this->turunanTanggal($request),
                [
                    'user_id' => auth()->id(),
                    'nomor_laporan' => $this->buatNomorLaporan($tanggal),
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
                ]
            ));

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

                'foto' => ! empty($fotoPaths) ? json_encode($fotoPaths) : null,
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

            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: '.$e->getMessage());
        }
    }

    // 5. Menampilkan form edit laporan
    public function editPenyelamatan($id)
    {
        $laporan = LaporanPenyelamatan::findOrFail($id);

        $teknis = LpTeknisLogistik::where('laporan_id', $id)->first() ?? new LpTeknisLogistik;
        $dokumentasi = LpDokumentasi::where('laporan_id', $id)->first() ?? new LpDokumentasi;
        $khusus = LpKategoriKhusus::where('laporan_id', $id)->first() ?? new LpKategoriKhusus;

        return view('internal.damtan.edit_data', compact('laporan', 'teknis', 'dokumentasi', 'khusus'));
    }

    // 6. Menyimpan perubahan data (Update)
    public function updatePenyelamatan(Request $request, $id)
    {
        // VALIDASI TANGGAL, UKURAN & FORMAT FILE
        $validator = $this->validasiFile($request);
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $laporan = LaporanPenyelamatan::findOrFail($id);

            // Update TAB 1 (nomor_laporan sengaja tidak diubah)
            $laporan->update(array_merge(
                $this->turunanTanggal($request),
                [
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
                ]
            ));

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

            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data: '.$e->getMessage());
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

    /** Validasi form surat korban (dipakai di store dan update). */
    private function validasiSurat(Request $request)
    {
        return Validator::make($request->all(), [
            'nama_korban' => 'required|string|max:255',
            'status_kepemilikan' => 'required|string|max:255',
            'nik' => ['required', 'regex:/^[0-9]{1,20}$/'],
            'pekerjaan' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'status_perkawinan' => 'required|string|max:100',
            'alamat' => 'required|string',
            'objek_terbakar' => 'required|string|max:255',
            'tanggal_kejadian' => 'required|date',
            'waktu_kejadian' => 'required',
            'tanggal_surat' => 'nullable|date',
            'tembusan_camat' => 'nullable|string|max:255',
            'tembusan_lurah' => 'nullable|string|max:255',
        ], [
            'nama_korban.required' => 'Nama korban wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'tanggal_kejadian.required' => 'Tanggal kejadian wajib diisi.',
            'tanggal_kejadian.date' => 'Format tanggal kejadian tidak valid.',
            'waktu_kejadian.required' => 'Waktu kejadian wajib diisi.',
            'tanggal_surat.date' => 'Format tanggal surat tidak valid.',
        ]);
    }

    /**
     * Data surat yang disimpan. Hari kejadian dihitung dari tanggal kejadian
     * di server, jadi tidak bisa tidak cocok dengan tanggalnya.
     */
    private function dataSurat(Request $request): array
    {
        $kejadian = Carbon::parse($request->tanggal_kejadian)->locale('id');

        return [
            'nama_korban' => $request->nama_korban,
            'status_kepemilikan' => $request->status_kepemilikan,
            'nik' => $request->nik,
            'pekerjaan' => $request->pekerjaan,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status_perkawinan' => $request->status_perkawinan,
            'alamat' => $request->alamat,
            'objek_terbakar' => $request->objek_terbakar,
            'hari_kejadian' => $kejadian->translatedFormat('l'),
            'tanggal_kejadian' => $kejadian->toDateString(),
            'waktu_kejadian' => $request->waktu_kejadian,
            'tembusan_camat' => $request->tembusan_camat,
            'tembusan_lurah' => $request->tembusan_lurah,
        ];
    }

    /**
     * Nomor surat mengikuti TANGGAL SURAT, urut per tanggal.
     * Format: SKK-YYYYMMDD-0001. Panggil di dalam DB transaction.
     */
    private function buatNomorSurat(Carbon $tanggal): string
    {
        $prefix = 'SKK-'.$tanggal->format('Ymd').'-';

        $terakhir = DB::table('surat_korbans')
            ->where('nomor_surat', 'like', $prefix.'%')
            ->lockForUpdate()
            ->orderByDesc('nomor_surat')
            ->value('nomor_surat');

        $urut = $terakhir ? ((int) substr($terakhir, -4)) + 1 : 1;

        return $prefix.str_pad($urut, 4, '0', STR_PAD_LEFT);
    }

    public function createSurat()
    {
        return view('internal.damtan.input_surat');
    }

    public function storeSurat(Request $request)
    {
        $validator = $this->validasiSurat($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->errors()->first());
        }

        try {
            DB::transaction(function () use ($request) {
                // Tanggal surat = tanggal diterbitkan (default hari ini, boleh diisi manual)
                $tglSurat = $request->filled('tanggal_surat')
                    ? Carbon::parse($request->tanggal_surat)->setTimeFrom(now())
                    : now();

                DB::table('surat_korbans')->insert(array_merge($this->dataSurat($request), [
                    'nomor_surat' => $this->buatNomorSurat($tglSurat),
                    'tanggal_surat' => $tglSurat->toDateTimeString(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            });
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan surat: '.$e->getMessage());
        }

        return redirect('/internal/surat-korban/data')->with('success', 'Data Surat Keterangan Korban berhasil ditambahkan!');
    }

    public function indexSurat()
    {
        $surat = DB::table('surat_korbans')
            ->orderByRaw('COALESCE(tanggal_surat, created_at) DESC')
            ->orderByDesc('id')
            ->paginate(10);

        // Daftar tahun dinamis untuk pilihan ekspor
        $tahunList = DB::table('surat_korbans')
            ->selectRaw('YEAR(COALESCE(tanggal_surat, created_at)) as tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        return view('internal.damtan.data_surat', compact('surat', 'tahunList'));
    }

    public function editSurat($id)
    {
        $surat = DB::table('surat_korbans')->where('id', $id)->first();

        if (! $surat) {
            return redirect('/internal/surat-korban/data')->with('error', 'Data surat tidak ditemukan.');
        }

        return view('internal.damtan.edit_surat', compact('surat'));
    }

    public function updateSurat(Request $request, $id)
    {
        $validator = $this->validasiSurat($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->errors()->first());
        }

        $lama = DB::table('surat_korbans')->where('id', $id)->first();
        if (! $lama) {
            return redirect('/internal/surat-korban/data')->with('error', 'Data surat tidak ditemukan.');
        }

        $data = $this->dataSurat($request);

        // Tanggal surat hanya berubah jika tanggalnya memang diganti (jam lama dipertahankan)
        if ($request->filled('tanggal_surat')) {
            $baru = Carbon::parse($request->tanggal_surat);
            $tglLama = $lama->tanggal_surat ? Carbon::parse($lama->tanggal_surat) : null;
            if (! $tglLama || $tglLama->toDateString() !== $baru->toDateString()) {
                $data['tanggal_surat'] = $baru->setTimeFrom(now())->toDateTimeString();
            }
        }

        // nomor_surat sengaja tidak diubah: nomor yang sudah tercetak tidak boleh berganti
        $data['updated_at'] = now();
        DB::table('surat_korbans')->where('id', $id)->update($data);

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

        if (! $surat) {
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
            'kebakaran' => ['Kebakaran',                 'fa-fire',          'ic-red'],
            'evakuasi_hewan' => ['Evakuasi Hewan',            'fa-paw',           'ic-teal'],
            'sarang_tawon' => ['Evakuasi Sarang Tawon',     'fa-bug',           'ic-amber'],
            'evakuasi_manusia' => ['Evakuasi / Pertolongan',    'fa-person-falling', 'ic-blue'],
            'pohon_tumbang' => ['Pohon Tumbang',             'fa-tree',          'ic-steel'],
            'pencarian_air' => ['Pencarian di Perairan',     'fa-life-ring',     'ic-purple'],
            'pelepasan_cincin' => ['Pelepasan Cincin',          'fa-ring',          'ic-pink'],
            'layanan_lainnya' => ['Layanan Lainnya',           'fa-truck-medical', 'ic-steel'],
        ];
    }

    public function rekapLayanan(Request $request)
    {
        $kategori = $this->kategoriLayanan();
        $objekKeys = array_keys($this->kategoriObjek());

        $tahunTerpilih = $request->filled('tahun') ? (int) $request->tahun : null;

        // Ambil daftar tahun unik dari data rekap_layanan
        $tahunList = DB::table('rekap_layanan')
            ->whereNotIn('kategori', $objekKeys)
            ->selectRaw('YEAR(tanggal) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun')
            ->filter()
            ->values();

        $riwayatQuery = DB::table('rekap_layanan')
            ->whereNotIn('kategori', $objekKeys);

        $totalsQuery = DB::table('rekap_layanan')
            ->whereNotIn('kategori', $objekKeys);

        if ($tahunTerpilih) {
            $riwayatQuery->whereYear('tanggal', $tahunTerpilih);
            $totalsQuery->whereYear('tanggal', $tahunTerpilih);
        }

        $riwayat = $riwayatQuery
            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(20)
            ->withQueryString();

        $totals = $totalsQuery
            ->select('kategori', DB::raw('SUM(jumlah) as total'))
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        return view('internal.damtan.rekap_layanan', compact('riwayat', 'totals', 'kategori', 'tahunList', 'tahunTerpilih'));
    }

    public function storeRekapLayanan(Request $request)
    {
        if (! Auth::user()->hasAnyRole(['Damtan', 'Super User'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk menambah rekap layanan.');
        }

        $request->validate([
            'tanggal' => 'required|date',
            'kategori' => ['required', 'in:'.implode(',', array_keys($this->kategoriLayanan()))],
            'jumlah' => 'required|integer|min:1',
        ]);

        DB::table('rekap_layanan')->insert([
            'tanggal' => $request->tanggal,
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah,
            'kecamatan' => $request->kecamatan,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'dibuat_oleh' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Data rekap layanan berhasil disimpan!');
    }

    // Update data rekap layanan (PUT /internal/damtan/rekap-layanan/{id})
    public function updateRekapLayanan(Request $request, $id)
    {
        if (! Auth::user()->hasAnyRole(['Damtan', 'Super User'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengedit rekap layanan.');
        }

        $request->validate([
            'tanggal' => 'required|date',
            'kategori' => ['required', 'in:'.implode(',', array_keys($this->kategoriLayanan()))],
            'jumlah' => 'required|integer|min:1',
        ]);

        // Pastikan baris yang diedit memang data rekap layanan (bukan rekap objek)
        $objekKeys = array_keys($this->kategoriObjek());
        $ada = DB::table('rekap_layanan')
            ->where('id', $id)
            ->whereNotIn('kategori', $objekKeys)
            ->exists();

        if (! $ada) {
            return redirect()->back()->with('error', 'Data rekap layanan tidak ditemukan.');
        }

        DB::table('rekap_layanan')->where('id', $id)->update([
            'tanggal' => $request->tanggal,
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah,
            'kecamatan' => $request->kecamatan,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Data rekap layanan berhasil diperbarui!');
    }

    public function destroyRekapLayanan($id)
    {
        if (! Auth::user()->hasAnyRole(['Damtan', 'Super User'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk menghapus rekap layanan.');
        }

        DB::table('rekap_layanan')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data rekap berhasil dihapus!');
    }

    // ==========================================
    // REKAP OBJEK KEBAKARAN
    // ==========================================

    private function kategoriObjek(): array
    {
        return [
            'objek_rumah' => ['Rumah',                    'fa-house',            'ic-red'],
            'objek_gudang' => ['Gudang',                   'fa-warehouse',        'ic-steel'],
            'objek_ruko' => ['Ruko',                     'fa-store',            'ic-amber'],
            'objek_kantor' => ['Kantor',                   'fa-building',         'ic-blue'],
            'objek_sekolah' => ['Sekolah',                  'fa-school',           'ic-teal'],
            'objek_rumah_ibadah' => ['Rumah Ibadah',             'fa-place-of-worship', 'ic-purple'],
            'objek_pasar' => ['Pasar / Tempat Usaha',     'fa-shop',             'ic-pink'],
            'objek_kendaraan' => ['Kendaraan Bermotor',       'fa-car',              'ic-red'],
            'objek_vital' => ['Objek Vital',              'fa-shield-halved',    'ic-steel'],
            'objek_sarana_kesehatan' => ['Sarana Kesehatan',         'fa-hospital',         'ic-blue'],
            'objek_lahan_pohon' => ['Lahan, Pohon',             'fa-tree',             'ic-teal'],
            'objek_gardu_listrik' => ['Gardu Listrik',            'fa-bolt',             'ic-amber'],
            'objek_tpa_sampah' => ['Tempat Pembuangan Sampah', 'fa-trash',            'ic-purple'],
        ];
    }

    public function rekapObjek(Request $request)
    {
        $kategori = $this->kategoriObjek();
        $keys = array_keys($kategori);

        $tahunTerpilih = $request->filled('tahun') ? (int) $request->tahun : null;

        // Ambil daftar tahun unik khusus rekap objek kebakaran
        $tahunList = DB::table('rekap_layanan')
            ->whereIn('kategori', $keys)
            ->selectRaw('YEAR(tanggal) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun')
            ->filter()
            ->values();

        $riwayatQuery = DB::table('rekap_layanan')
            ->whereIn('kategori', $keys);

        $totalsQuery = DB::table('rekap_layanan')
            ->whereIn('kategori', $keys);

        if ($tahunTerpilih) {
            $riwayatQuery->whereYear('tanggal', $tahunTerpilih);
            $totalsQuery->whereYear('tanggal', $tahunTerpilih);
        }

        $riwayat = $riwayatQuery
            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(20)
            ->withQueryString();

        $totals = $totalsQuery
            ->select('kategori', DB::raw('SUM(jumlah) as total'))
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        return view('internal.damtan.rekap_objek', compact('riwayat', 'totals', 'kategori', 'tahunList', 'tahunTerpilih'));
    }

    public function storeRekapObjek(Request $request)
    {
        if (! Auth::user()->hasAnyRole(['Damtan', 'Super User'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk menambah rekap objek.');
        }

        $request->validate([
            'tanggal' => 'required|date',
            'kategori' => ['required', 'in:'.implode(',', array_keys($this->kategoriObjek()))],
            'jumlah' => 'required|integer|min:1',
        ]);

        DB::table('rekap_layanan')->insert([
            'tanggal' => $request->tanggal,
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah,
            'kecamatan' => $request->kecamatan,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'dibuat_oleh' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Data rekap objek kebakaran berhasil disimpan!');
    }

    // Update data rekap objek (PUT /internal/damtan/rekap-objek/{id})
    public function updateRekapObjek(Request $request, $id)
    {
        if (! Auth::user()->hasAnyRole(['Damtan', 'Super User'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengedit rekap objek.');
        }

        $request->validate([
            'tanggal' => 'required|date',
            'kategori' => ['required', 'in:'.implode(',', array_keys($this->kategoriObjek()))],
            'jumlah' => 'required|integer|min:1',
        ]);

        // Pastikan baris yang diedit memang data rekap objek
        $objekKeys = array_keys($this->kategoriObjek());
        $ada = DB::table('rekap_layanan')
            ->where('id', $id)
            ->whereIn('kategori', $objekKeys)
            ->exists();

        if (! $ada) {
            return redirect()->back()->with('error', 'Data rekap objek tidak ditemukan.');
        }

        DB::table('rekap_layanan')->where('id', $id)->update([
            'tanggal' => $request->tanggal,
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah,
            'kecamatan' => $request->kecamatan,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Data rekap objek kebakaran berhasil diperbarui!');
    }

    public function destroyRekapObjek($id)
    {
        if (! Auth::user()->hasAnyRole(['Damtan', 'Super User'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk menghapus rekap objek.');
        }

        DB::table('rekap_layanan')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data rekap berhasil dihapus!');
    }
}

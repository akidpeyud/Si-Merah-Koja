<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\PermohonanRpkbgl;

class PermohonanRpkbglController extends Controller
{
    /**
     * Berkas tunggal: nama field di form => [kolom DB, subfolder di public/uploads/rpkbgl, wajib?]
     */
    private const BERKAS_TUNGGAL = [
        'surat_permohonan' => ['file_surat_permohonan', 'surat',  true],
        'fotokopi_ktp'     => ['file_fotokopi_ktp',     'berkas', true],
        'nib'              => ['file_nib',              'berkas', true],
        'pbg_imb'          => ['file_pbg_imb',          'berkas', true],
        'slo_listrik'      => ['file_slo_listrik',      'berkas', true],
        'slf_bangunan'     => ['file_slf_bangunan',     'berkas', true],
        'denah_bangunan'   => ['file_denah_bangunan',   'berkas', true],
        'pjk3_lift'        => ['file_pjk3',             'berkas', false], // wajib hanya jika ada lift
    ];

    /**
     * Berkas jamak (disimpan sebagai JSON): nama field di form => [kolom DB, subfolder]
     */
    private const BERKAS_JAMAK = [
        'data_teknis_proteksi' => ['file_data_teknis_proteksi', 'berkas'],
        'persyaratan_lainnya'  => ['file_persyaratan_lainnya',  'persyaratan'],
    ];

    /** Penanda data lama yang diinput offline (tanpa lampiran). */
    private const OFFLINE = 'Tidak dilampirkan (Offline)';

    /** Kolom berkas tunggal yang boleh dihapus dari halaman edit (selain itu hanya boleh diganti). */
    private const BOLEH_HAPUS = ['file_pjk3'];

    /** Berkas jamak: kolom DB => nama input checkbox "hapus" di halaman edit. */
    private const KUNCI_HAPUS = [
        'file_data_teknis_proteksi' => 'hapus_proteksi',
        'file_persyaratan_lainnya'  => 'hapus_lainnya',
    ];

    // =========================================================================
    // 1. TAMPILKAN HALAMAN UTAMA (INDEX ADMIN)
    // =========================================================================
    public function index()
    {
        $permohonan = PermohonanRpkbgl::orderBy('created_at', 'desc')->get();

        return view('internal.pencegahan.kelola_rpkbgl', compact('permohonan'));
    }

    // =========================================================================
    // 2. TAMPILKAN FORM TAMBAH DATA (CREATE ADMIN)
    // =========================================================================
    public function create()
    {
        return view('internal.pencegahan.tambah_rpkbgl', [
            'dataWilayah' => $this->dataWilayah(),
        ]);
    }

    // =========================================================================
    // 3. PROSES SIMPAN DATA
    // =========================================================================
    public function store(Request $request)
    {
        $berkas5mb  = 'required|file|mimes:pdf,jpg,jpeg,png|max:5120';        // 5 MB
        $berkasJamak = 'file|mimes:pdf,jpg,jpeg,png,zip,rar|max:10240';        // 10 MB per berkas

        // Batas minimal tanggal pemeriksaan: hari ini + 14 hari (H-14)
        $minTanggal = now()->addDays(14)->toDateString();

        $request->validate([
            // Data pemohon & usaha
            'nama_pemohon'    => 'required|string|max:150',
            'email_pemohon'   => 'required|email|max:100',
            'no_wa'           => 'required|string|max:13|regex:/^[0-9]+$/',
            'nama_usaha'      => 'required|string|max:150',
            'nik'             => 'required|string|size:16|regex:/^[0-9]+$/',
            'alamat_pemilik'  => 'required|string',

            // Data bangunan
            'kategori'        => 'required|string|max:100',
            'alamat_bangunan' => 'required|string',
            'kecamatan'       => 'required|string|max:100',
            'kelurahan'       => 'required|string|max:100',
            'luas_lahan'      => 'required|numeric',
            'luas_bangunan'   => 'required|numeric',
            'tinggi_bangunan' => 'required|numeric',
            'ada_lift'        => 'required|in:ya,tidak',
            'tgl_pemeriksaan' => 'required|date|after_or_equal:' . $minTanggal,

            // Berkas persyaratan administrasi (tiap persyaratan 1 kolom unggah)
            'surat_permohonan' => $berkas5mb,
            'fotokopi_ktp'     => $berkas5mb,
            'nib'              => $berkas5mb,
            'pbg_imb'          => $berkas5mb,
            'slo_listrik'      => $berkas5mb,
            'slf_bangunan'     => $berkas5mb,
            'denah_bangunan'   => $berkas5mb,
            'pjk3_lift'        => 'required_if:ada_lift,ya|nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',

            // Data teknis sistem proteksi kebakaran (aktif, pasif, sarana penyelamatan, utilitas)
            'data_teknis_proteksi'   => 'required|array|min:1|max:10',
            'data_teknis_proteksi.*' => $berkasJamak,

            // Dokumen pendukung lainnya (opsional)
            'persyaratan_lainnya'    => 'nullable|array|max:10',
            'persyaratan_lainnya.*'  => $berkasJamak,
        ], [
            'required'    => 'Kolom :attribute wajib diisi.',
            'required_if' => 'Kolom :attribute wajib diisi karena bangunan memiliki lift.',
            'in'          => 'Pilihan :attribute tidak valid.',
            'email'       => 'Format email tidak valid.',
            'numeric'     => 'Kolom :attribute harus berupa angka.',
            'date'        => 'Format tanggal tidak valid.',
            'array'       => 'Kolom :attribute tidak valid.',
            'min.array'   => 'Unggah minimal :min berkas untuk :attribute.',
            'max.string'  => 'Kolom :attribute maksimal :max karakter.',
            'max.array'   => 'Jumlah berkas :attribute maksimal :max.',
            'max.file'    => 'Ukuran berkas :attribute melebihi batas maksimal (:max KB).',
            'mimes'       => 'Format berkas :attribute harus berupa :values.',
            'file'        => 'Kolom :attribute harus berupa berkas.',

            // Muncul jika PHP menolak berkas (umumnya karena melebihi upload_max_filesize di php.ini)
            'uploaded'    => 'Berkas :attribute gagal diunggah. Ukuran berkas kemungkinan melebihi batas server ('
                             . ini_get('upload_max_filesize') . ' per berkas). Perkecil ukuran berkas atau hubungi admin.',

            'no_wa.max'                     => 'Nomor WhatsApp maksimal 13 digit.',
            'no_wa.regex'                   => 'Nomor WhatsApp hanya boleh berisi angka.',
            'nik.size'                      => 'NIK harus berjumlah 16 digit.',
            'nik.regex'                     => 'NIK hanya boleh berisi angka.',
            'tgl_pemeriksaan.after_or_equal' => 'Tanggal pemeriksaan minimal 14 hari dari hari ini (surat permohonan selambat-lambatnya H-14).',
        ], [
            'nama_pemohon'           => 'nama pemohon',
            'email_pemohon'          => 'email pemohon',
            'no_wa'                  => 'nomor WhatsApp',
            'nama_usaha'             => 'nama usaha',
            'nik'                    => 'NIK',
            'alamat_pemilik'         => 'alamat pemilik usaha',
            'kategori'               => 'kategori bangunan',
            'alamat_bangunan'        => 'alamat bangunan',
            'luas_lahan'             => 'luas lahan',
            'luas_bangunan'          => 'luas bangunan',
            'tinggi_bangunan'        => 'tinggi bangunan',
            'ada_lift'               => 'keterangan lift',
            'tgl_pemeriksaan'        => 'tanggal pemeriksaan',
            'surat_permohonan'       => 'surat permohonan',
            'fotokopi_ktp'           => 'fotokopi KTP penanggung jawab gedung',
            'nib'                    => 'NIB',
            'pbg_imb'                => 'PBG atau IMB',
            'slo_listrik'            => 'SLO listrik',
            'slf_bangunan'           => 'SLF bangunan',
            'denah_bangunan'         => 'denah bangunan',
            'pjk3_lift'              => 'PJK3',
            'data_teknis_proteksi'   => 'data teknis sistem proteksi kebakaran',
            'data_teknis_proteksi.*' => 'data teknis sistem proteksi kebakaran',
            'persyaratan_lainnya'    => 'dokumen pendukung',
            'persyaratan_lainnya.*'  => 'dokumen pendukung',
        ]);

        $adaLift = $request->ada_lift === 'ya';
        $tersimpan = []; // path berkas yang sudah dipindahkan (dibersihkan jika proses gagal)

        try {
            $data = [
                'nama_pemohon'         => $request->nama_pemohon,
                'email_pemohon'        => $request->email_pemohon,
                'no_whatsapp'          => $request->no_wa,
                'nama_usaha'           => $request->nama_usaha,
                'nik_pemilik_usaha'    => $request->nik,
                'alamat_pemilik_usaha' => $request->alamat_pemilik,
                'kategori_bangunan'    => $request->kategori,
                'alamat_bangunan'      => $request->alamat_bangunan,
                'kecamatan'            => $request->kecamatan,
                'kelurahan'            => $request->kelurahan,
                'luas_lahan'           => $request->luas_lahan,
                'luas_bangunan'        => $request->luas_bangunan,
                'tinggi_bangunan'      => $request->tinggi_bangunan,
                'ada_lift'             => $request->ada_lift,
                'tgl_pemeriksaan'      => $request->tgl_pemeriksaan,
                'status_permohonan'    => 'Pending',
                'created_at'           => now(),
                'updated_at'           => now(),
            ];

            // Berkas tunggal
            foreach (self::BERKAS_TUNGGAL as $field => [$kolom, $folder]) {
                if ($field === 'pjk3_lift' && !$adaLift) {
                    $data[$kolom] = null;
                    continue;
                }
                $file = $request->file($field);
                $data[$kolom] = $file ? $this->simpanBerkas($file, $folder, $field, $tersimpan) : null;
            }

            // Berkas jamak (JSON)
            foreach (self::BERKAS_JAMAK as $field => [$kolom, $folder]) {
                $nama = [];
                foreach ((array) $request->file($field, []) as $file) {
                    $nama[] = $this->simpanBerkas($file, $folder, $field, $tersimpan);
                }
                $data[$kolom] = $nama ? json_encode($nama) : null;
            }

            DB::table('permohonan_rpkbgl')->insert($data);

            return redirect()->back()->with('success', 'Permohonan RPPKBGL Anda berhasil dikirim dan akan segera diproses dalam 14 hari kerja.');

        } catch (\Exception $e) {
            // Bersihkan berkas yang sudah terlanjur dipindahkan agar tidak menjadi sampah
            foreach ($tersimpan as $path) {
                if (is_file($path)) {
                    @unlink($path);
                }
            }

            return redirect()->back()->withInput()->withErrors(['Gagal mengirim permohonan: ' . $e->getMessage()]);
        }
    }

    // =========================================================================
    // 3b. TAMPILKAN FORM EDIT (ADMIN)
    // =========================================================================
    public function edit($id)
    {
        $permohonan = PermohonanRpkbgl::findOrFail($id);

        return view('internal.pencegahan.edit_rpkbgl', [
            'permohonan'  => $permohonan,
            'dataWilayah' => $this->dataWilayah(),
        ]);
    }

    // =========================================================================
    // 3c. PROSES UPDATE DATA (ADMIN)
    // =========================================================================
    public function update(Request $request, $id)
    {
        $permohonan = PermohonanRpkbgl::findOrFail($id);
        $wilayah    = $this->dataWilayah();

        $berkasTunggal = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120';        // 5 MB
        $berkasJamak   = 'file|mimes:pdf,jpg,jpeg,png,zip,rar|max:10240';        // 10 MB per berkas

        $rules = [
            'nama_pemohon'         => 'required|string|max:150',
            'email_pemohon'        => 'required|email|max:100',
            'no_whatsapp'          => 'required|string|max:13|regex:/^[0-9]+$/',
            'nama_usaha'           => 'required|string|max:150',
            'nik_pemilik_usaha'    => 'required|string|size:16|regex:/^[0-9]+$/',
            'alamat_pemilik_usaha' => 'required|string',
            'kategori_bangunan'    => 'required|string|max:100',
            'alamat_bangunan'      => 'required|string',
            'kecamatan'            => ['required', Rule::in(array_keys($wilayah))],
            'kelurahan'            => ['required', Rule::in($wilayah[$request->input('kecamatan')] ?? [])],
            'luas_lahan'           => 'required|numeric|min:0|max:99999999.99',   // decimal(10,2)
            'luas_bangunan'        => 'required|numeric|min:0|max:99999999.99',   // decimal(10,2)
            'tinggi_bangunan'      => 'required|numeric|min:0|max:999999.99',     // decimal(8,2)
            'ada_lift'             => 'required|in:ya,tidak',
            'tgl_pemeriksaan'      => 'required|date',                            // admin boleh mengubah (tanpa batas H-14)
            'status_permohonan'    => 'required|in:Pending,Diproses,Memenuhi Syarat,Tidak Memenuhi Syarat',
            'hapus_berkas'         => 'nullable|array',
        ];

        foreach (self::BERKAS_TUNGGAL as [$kolom]) {
            $rules[$kolom] = $berkasTunggal;
        }
        foreach (self::BERKAS_JAMAK as [$kolom]) {
            $rules[$kolom]        = 'nullable|array|max:10';
            $rules[$kolom . '.*'] = $berkasJamak;
        }

        $request->validate($rules, [
            'required'   => 'Kolom :attribute wajib diisi.',
            'in'         => 'Pilihan :attribute tidak valid.',
            'email'      => 'Format email tidak valid.',
            'numeric'    => 'Kolom :attribute harus berupa angka.',
            'date'       => 'Format tanggal tidak valid.',
            'mimes'      => 'Format berkas :attribute harus berupa :values.',
            'max.file'   => 'Ukuran berkas :attribute melebihi batas maksimal (:max KB).',
            'uploaded'   => 'Berkas :attribute gagal diunggah. Ukuran berkas kemungkinan melebihi batas server ('
                            . ini_get('upload_max_filesize') . ' per berkas).',
            'no_whatsapp.max'   => 'Nomor WhatsApp maksimal 13 digit.',
            'no_whatsapp.regex' => 'Nomor WhatsApp hanya boleh berisi angka.',
            'nik_pemilik_usaha.size'  => 'NIK harus berjumlah 16 digit.',
            'nik_pemilik_usaha.regex' => 'NIK hanya boleh berisi angka.',
            'kelurahan.in'      => 'Kelurahan tidak sesuai dengan kecamatan yang dipilih.',
        ], [
            'nama_pemohon'         => 'nama pemohon',
            'email_pemohon'        => 'email pemohon',
            'no_whatsapp'          => 'nomor WhatsApp',
            'nama_usaha'           => 'nama usaha',
            'nik_pemilik_usaha'    => 'NIK',
            'alamat_pemilik_usaha' => 'alamat pemilik usaha',
            'kategori_bangunan'    => 'kategori bangunan',
            'alamat_bangunan'      => 'alamat bangunan',
            'luas_lahan'           => 'luas lahan',
            'luas_bangunan'        => 'luas bangunan',
            'tinggi_bangunan'      => 'tinggi bangunan',
            'ada_lift'             => 'ketersediaan lift',
            'tgl_pemeriksaan'      => 'tanggal pemeriksaan',
            'status_permohonan'    => 'status permohonan',
            'file_surat_permohonan'     => 'surat permohonan',
            'file_fotokopi_ktp'         => 'fotokopi KTP',
            'file_nib'                  => 'NIB',
            'file_pbg_imb'              => 'PBG atau IMB',
            'file_slo_listrik'          => 'SLO listrik',
            'file_slf_bangunan'         => 'SLF bangunan',
            'file_denah_bangunan'       => 'denah bangunan',
            'file_pjk3'                 => 'PJK3',
            'file_data_teknis_proteksi'   => 'data teknis proteksi kebakaran',
            'file_data_teknis_proteksi.*' => 'data teknis proteksi kebakaran',
            'file_persyaratan_lainnya'    => 'dokumen pendukung',
            'file_persyaratan_lainnya.*'  => 'dokumen pendukung',
        ]);

        // Data teknis proteksi tidak boleh dikosongkan total (sama seperti aturan di form permohonan)
        $kolomProteksi = 'file_data_teknis_proteksi';
        $listProteksi  = array_values(array_filter((array) $permohonan->{$kolomProteksi}));
        $hapusProteksi = array_intersect((array) $request->input(self::KUNCI_HAPUS[$kolomProteksi], []), $listProteksi);
        $jumlahAkhir   = count($listProteksi) - count($hapusProteksi) + count((array) $request->file($kolomProteksi, []));
        if ($listProteksi && $jumlahAkhir < 1) {
            return redirect()->back()->withInput()
                ->withErrors(['file_data_teknis_proteksi' => 'Data teknis proteksi kebakaran minimal harus menyisakan 1 berkas.']);
        }

        $adaLift   = $request->ada_lift === 'ya';
        $hapusTgl  = (array) $request->input('hapus_berkas', []);
        $tersimpan = [];   // berkas baru (dibersihkan jika proses gagal)
        $akanHapus = [];   // [nama, folder] berkas lama (dihapus setelah DB sukses)

        try {
            $data = $request->only([
                'nama_pemohon', 'email_pemohon', 'no_whatsapp', 'nama_usaha', 'nik_pemilik_usaha',
                'alamat_pemilik_usaha', 'kategori_bangunan', 'alamat_bangunan', 'kecamatan', 'kelurahan',
                'luas_lahan', 'luas_bangunan', 'tinggi_bangunan', 'ada_lift', 'tgl_pemeriksaan', 'status_permohonan',
            ]);

            // Berkas tunggal: ganti jika ada unggahan baru
            foreach (self::BERKAS_TUNGGAL as $field => [$kolom, $folder]) {
                $lama = $permohonan->{$kolom};

                // Tanpa lift -> PJK3 tidak diperlukan (sama seperti saat permohonan dibuat)
                if ($kolom === 'file_pjk3' && !$adaLift) {
                    if ($lama) {
                        $akanHapus[] = [$lama, $folder];
                    }
                    $data[$kolom] = null;
                    continue;
                }

                if ($request->hasFile($kolom)) {
                    $data[$kolom] = $this->simpanBerkas($request->file($kolom), $folder, $field, $tersimpan);
                    if ($lama) {
                        $akanHapus[] = [$lama, $folder];
                    }
                } elseif (in_array($kolom, self::BOLEH_HAPUS, true) && in_array($kolom, $hapusTgl, true)) {
                    if ($lama) {
                        $akanHapus[] = [$lama, $folder];
                    }
                    $data[$kolom] = null;
                }
            }

            // Berkas jamak (JSON): hapus yang dicentang, tambahkan yang baru
            foreach (self::BERKAS_JAMAK as $field => [$kolom, $folder]) {
                $list  = array_values(array_filter((array) $permohonan->{$kolom}));
                $hapus = array_intersect((array) $request->input(self::KUNCI_HAPUS[$kolom], []), $list);
                $sisa  = array_values(array_diff($list, $hapus));

                foreach ($hapus as $nama) {
                    $akanHapus[] = [$nama, $folder];
                }

                $baru = (array) $request->file($kolom, []);
                if ($baru) {
                    $sisa = array_values(array_diff($sisa, [self::OFFLINE])); // ada berkas asli -> penanda offline dibuang
                    foreach ($baru as $file) {
                        $sisa[] = $this->simpanBerkas($file, $folder, $field, $tersimpan);
                    }
                }

                $data[$kolom] = $sisa ?: null;
            }

            $permohonan->update($data);

            // Berkas lama baru dihapus setelah data berhasil tersimpan
            foreach ($akanHapus as [$nama, $folder]) {
                $this->hapusBerkas($nama, $folder);
            }

            return redirect('/internal/pencegahan/kelola-rpkbgl')
                ->with('success', 'Data permohonan atas nama ' . e($permohonan->nama_pemohon) . ' berhasil diperbarui.');

        } catch (\Exception $e) {
            foreach ($tersimpan as $path) {
                if (is_file($path)) {
                    @unlink($path);
                }
            }

            return redirect()->back()->withInput()->withErrors(['Gagal memperbarui permohonan: ' . $e->getMessage()]);
        }
    }

    // =========================================================================
    // 4. PROSES UPDATE STATUS (ADMIN)
    // =========================================================================
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_permohonan' => 'required|in:Pending,Diproses,Memenuhi Syarat,Tidak Memenuhi Syarat',
        ]);

        DB::table('permohonan_rpkbgl')->where('id', $id)->update([
            'status_permohonan' => $request->status_permohonan,
            'updated_at'        => now(),
        ]);

        return redirect()->back()->with('success', 'Status permohonan berhasil diperbarui.');
    }

    // =========================================================================
    // 5. PROSES HAPUS DATA & FILE (DESTROY ADMIN)
    // =========================================================================
    public function destroy($id)
    {
        $rpkbgl = DB::table('permohonan_rpkbgl')->where('id', $id)->first();

        if ($rpkbgl) {
            // Berkas tunggal
            foreach (self::BERKAS_TUNGGAL as [$kolom, $folder]) {
                $this->hapusBerkas($rpkbgl->{$kolom} ?? null, $folder);
            }

            // Berkas jamak (decode JSON dulu ke array)
            foreach (self::BERKAS_JAMAK as [$kolom, $folder]) {
                $files = json_decode($rpkbgl->{$kolom} ?? '[]', true);
                if (is_array($files)) {
                    foreach ($files as $file) {
                        $this->hapusBerkas($file, $folder);
                    }
                }
            }

            DB::table('permohonan_rpkbgl')->where('id', $id)->delete();
        }

        return redirect()->back()->with('success', 'Data dan berkas permohonan berhasil dihapus selamanya.');
    }

    // =========================================================================
    // 6. TAMPILKAN DETAIL DATA (SHOW ADMIN)
    // =========================================================================
    public function show($id)
    {
        $permohonan = PermohonanRpkbgl::findOrFail($id);

        return view('internal.pencegahan.detail_rpkbgl', compact('permohonan'));
    }

    // =========================================================================
    // 7. CEK STATUS PERMOHONAN (PUBLIK VIA AJAX)
    // =========================================================================
    public function cekStatus(Request $request)
    {
        $request->validate([
            'kontak' => 'required|string|min:9|max:20',
        ], [
            'kontak.required' => 'Masukkan NIK atau Nomor WhatsApp.',
            'kontak.min'      => 'Masukkan minimal 9 digit angka.',
        ]);

        $kontak = trim($request->kontak);

        // Padanan status di DB dengan label badge di JavaScript (Menunggu, Proses, Disetujui, Ditolak)
        $statusMap = [
            'pending'               => 'Menunggu',
            'menunggu'              => 'Menunggu',
            'proses'                => 'Proses',
            'diproses'              => 'Proses',
            'disetujui'             => 'Disetujui',
            'selesai'               => 'Disetujui',
            'memenuhi syarat'       => 'Disetujui',
            'ditolak'               => 'Ditolak',
            'tidak memenuhi syarat' => 'Ditolak',
        ];

        $items = PermohonanRpkbgl::where('nik_pemilik_usaha', $kontak)
            ->orWhere('no_whatsapp', $kontak)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($row) use ($statusMap) {
                $rawStatus    = strtolower(trim($row->status_permohonan ?? 'pending'));
                $statusTampil = $statusMap[$rawStatus] ?? ucfirst($row->status_permohonan);

                return [
                    'nama_usaha'      => $row->nama_usaha,
                    'nama_pemohon'    => $row->nama_pemohon,
                    'alamat_bangunan' => $row->alamat_bangunan
                                         . ($row->kelurahan ? ', Kel. ' . $row->kelurahan : '')
                                         . ($row->kecamatan ? ', Kec. ' . $row->kecamatan : ''),
                    'tgl_pemeriksaan' => $row->tgl_pemeriksaan ? \Carbon\Carbon::parse($row->tgl_pemeriksaan)->format('d M Y') : null,
                    'diajukan'        => $row->created_at ? $row->created_at->format('d M Y H:i') : '-',
                    'status'          => $statusTampil,
                ];
            });

        return response()->json([
            'data' => $items,
        ]);
    }

    // =========================================================================
    // HELPER
    // =========================================================================

    /**
     * Daftar kecamatan => kelurahan Kota Jambi (dipakai form tambah & edit).
     */
    private function dataWilayah(): array
    {
        return [
            'Alam Barajo'   => ['Bagan Pete', 'Beliung', 'Kenali Besar', 'Mayang Mangurai', 'Pinang Merah', 'Rawa Sari', 'Simpang Rimbo'],
            'Danau Sipin'   => ['Legok', 'Murni', 'Selamat', 'Solok Sipin', 'Sungai Putri'],
            'Danau Teluk'   => ['Olak Kemang', 'Pasir Panjang', 'Tanjung Pasir', 'Tanjung Raden', 'Ulu Gedong'],
            'Jambi Selatan' => ['Pakuan Baru', 'Pasir Putih', 'Tambak Sari', 'The Hok', 'Wijaya Pura'],
            'Jambi Timur'   => ['Budiman', 'Kasang', 'Kasang Jaya', 'Rajawali', 'Sejinjang', 'Sulanjana', 'Talang Banjar', 'Tanjung Pinang', 'Tanjung Sari'],
            'Jelutung'      => ['Cempaka Putih', 'Handil Jaya', 'Jelutung', 'Kebun Handil', 'Lebak Bandung', 'Payo Lebar', 'Talang Jauh'],
            'Kota Baru'     => ['Kenali Asam', 'Kenali Asam Atas', 'Kenali Asam Bawah', 'Paal Lima', 'Simpang Tiga Sipin', 'Sukakarya', 'Talang Gulo'],
            'Paal Merah'    => ['Bakung Jaya', 'Eka Jaya', 'Lingkar Selatan', 'Paal Merah', 'Payo Selincah', 'Talang Bakung'],
            'Pasar Jambi'   => ['Beringin', 'Orang Kayo Hitam', 'Pasar Jambi', 'Sungai Asam'],
            'Pelayangan'    => ['Arab Melayu', 'Jelmu', 'Mudung Laut', 'Tahtul Yaman', 'Tanjung Johor', 'Tengah'],
            'Telanaipura'   => ['Aur Kenali', 'Buluran Kenali', 'Pematang Sulur', 'Penyengat Rendah', 'Simpang Empat Sipin', 'Telanaipura', 'Teluk Kenali'],
        ];
    }

    /**
     * Pindahkan berkas ke public/uploads/rpkbgl/{folder} dengan nama unik, lalu kembalikan nama berkasnya.
     * Nama diberi token acak agar berkas bernama sama (dalam detik yang sama) tidak saling menimpa.
     */
    private function simpanBerkas(UploadedFile $file, string $folder, string $prefix, array &$tersimpan): string
    {
        $dir = public_path('uploads/rpkbgl/' . $folder);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $bersih = preg_replace('/[^A-Za-z0-9._-]/', '_', $file->getClientOriginalName());
        $nama   = time() . '_' . $prefix . '_' . Str::random(6) . '_' . $bersih;

        $file->move($dir, $nama);
        $tersimpan[] = $dir . DIRECTORY_SEPARATOR . $nama;

        return $nama;
    }

    private function hapusBerkas(?string $nama, string $folder): void
    {
        if (!$nama) {
            return;
        }
        $path = public_path('uploads/rpkbgl/' . $folder . '/' . $nama);
        if (is_file($path)) {
            @unlink($path);
        }
    }
}
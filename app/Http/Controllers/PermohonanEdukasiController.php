<?php

namespace App\Http\Controllers;

use App\Models\PermohonanEdukasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PermohonanEdukasiController extends Controller
{
    private $dataWilayah = [
        "Alam Barajo"   => ["Bagan Pete", "Beliung", "Kenali Besar", "Mayang Mangurai", "Pinang Merah", "Rawa Sari", "Simpang Rimbo"],
        "Danau Sipin"   => ["Legok", "Murni", "Selamat", "Solok Sipin", "Sungai Putri"],
        "Danau Teluk"   => ["Olak Kemang", "Pasir Panjang", "Tanjung Pasir", "Tanjung Raden", "Ulu Gedong"],
        "Jambi Selatan" => ["Pakuan Baru", "Pasir Putih", "Tambak Sari", "The Hok", "Wijaya Pura"],
        "Jambi Timur"   => ["Budiman", "Kasang", "Kasang Jaya", "Rajawali", "Sejinjang", "Sulanjana", "Talang Banjar", "Tanjung Pinang", "Tanjung Sari"],
        "Jelutung"      => ["Cempaka Putih", "Handil Jaya", "Jelutung", "Kebun Handil", "Lebak Bandung", "Payo Lebar", "Talang Jauh"],
        "Kota Baru"     => ["Kenali Asam", "Kenali Asam Atas", "Kenali Asam Bawah", "Paal Lima", "Simpang Tiga Sipin", "Sukakarya", "Talang Gulo"],
        "Paal Merah"    => ["Bakung Jaya", "Eka Jaya", "Lingkar Selatan", "Paal Merah", "Payo Selincah", "Talang Bakung"],
        "Pasar Jambi"   => ["Beringin", "Orang Kayo Hitam", "Pasar Jambi", "Sungai Asam"],
        "Pelayangan"    => ["Arab Melayu", "Jelmu", "Mudung Laut", "Tahtul Yaman", "Tanjung Johor", "Tengah"],
        "Telanaipura"   => ["Aur Kenali", "Buluran Kenali", "Pematang Sulur", "Penyengat Rendah", "Simpang Empat Sipin", "Telanaipura", "Teluk Kenali"]
    ];

    /**
     * Menampilkan daftar permohonan di halaman internal kelola edukasi.
     */
    public function index()
    {
        $permohonan = PermohonanEdukasi::orderBy('created_at', 'desc')->get();
        return view('internal.pencegahan.kelola_edukasi', compact('permohonan'));
    }

    /**
     * Menampilkan rincian detail permohonan berdasarkan ID.
     */
    public function show($id)
    {
        $edukasi = PermohonanEdukasi::findOrFail($id);
        return view('internal.pencegahan.detail_edukasi', compact('edukasi'));
    }

    /**
     * Menyimpan data permohonan baru dari form publik.
     */
    public function store(Request $request)
    {
        $kecamatanValid = array_keys($this->dataWilayah);

        $validatedData = $request->validate([
            'institusi'          => 'required|string|max:150',
            'alamat_institusi'   => 'required|string',
            'kecamatan'          => ['required', 'string', Rule::in($kecamatanValid)],
            'kelurahan'          => ['required', 'string', function ($attribute, $value, $fail) use ($request) {
                $kec = $request->input('kecamatan');
                if (isset($this->dataWilayah[$kec]) && !in_array($value, $this->dataWilayah[$kec])) {
                    $fail('Kelurahan tidak valid.');
                }
            }],
            'nama_pemohon'       => 'required|string|max:150',
            'jabatan_pemohon'    => 'required|string|max:100',
            'nik'                => 'required|string|max:16',
            'no_kontak'          => 'required|string|max:25',
            'tgl_kegiatan'       => 'required|date',
            'usia_3_6'           => 'nullable|integer|min:0',
            'usia_7_12'          => 'nullable|integer|min:0',
            'usia_13_18'         => 'nullable|integer|min:0',
            'usia_18_keatas'     => 'nullable|integer|min:0',
            'surat_permohonan'   => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'syarat_lainnya.*'   => 'nullable|file|mimes:pdf,jpg,jpeg,png,zip,rar|max:10240',
        ]);

        // Upload Surat Permohonan Wajib
        if ($request->hasFile('surat_permohonan')) {
            $fileSurat = $request->file('surat_permohonan');
            $filenameSurat = time() . '_edu_surat_' . uniqid() . '.' . $fileSurat->getClientOriginalExtension();
            // Simpan ke disk public agar bisa diakses via asset('storage/...')
            $validatedData['surat_permohonan'] = $fileSurat->storeAs('uploads/edukasi', $filenameSurat, 'public');
        }

        // Upload Syarat Lainnya (Menangani multiple files / array)
        if ($request->hasFile('syarat_lainnya')) {
            $uploadedFiles = [];
            foreach ($request->file('syarat_lainnya') as $fileLain) {
                $filenameLain = time() . '_edu_lain_' . uniqid() . '.' . $fileLain->getClientOriginalExtension();
                $path = $fileLain->storeAs('uploads/edukasi', $filenameLain, 'public');
                $uploadedFiles[] = $path;
            }
            // Simpan sebagai array/json jika kolom di database mendukung (atau ubah sesuai kebutuhan model)
            $validatedData['syarat_lainnya'] = $uploadedFiles;
        }

        $validatedData['status_permohonan'] = 'Pending';
        PermohonanEdukasi::create($validatedData);

        return redirect()->back()->with('success', 'Pengajuan Edukasi & Sosialisasi berhasil dikirim!');
    }

    // =========================================================================
    // FITUR TAMBAHAN: INPUT DATA OFFLINE OLEH ADMIN (PENCEGAHAN & SUPER USER)
    // =========================================================================

    /**
     * Menampilkan halaman form input edukasi offline untuk admin.
     */
    public function createOffline()
    {
        return view('internal.pencegahan.create_edukasi');
    }

    /**
     * Memproses penyimpanan data edukasi offline dari admin.
     */
    public function storeOffline(Request $request)
    {
        // Validasi input khusus form admin
        $request->validate([
            'nama_pemohon'     => 'required|string|max:150',
            'no_kontak'        => 'required|string|max:25',
            'institusi'        => 'required|string|max:150',
            'kecamatan'        => 'required|string',
            'tgl_kegiatan'     => 'required|date',
            'usia_3_6'         => 'nullable|integer|min:0',
            'usia_7_12'        => 'nullable|integer|min:0',
            'usia_13_18'       => 'nullable|integer|min:0',
            'usia_18_keatas'   => 'nullable|integer|min:0',
            'surat_permohonan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'syarat_lainnya'   => 'nullable|file|mimes:pdf,jpg,jpeg,png,zip,rar|max:10240'
        ]);

        // Validasi pencegahan error jika semua field peserta kosong
        $totalPeserta = ($request->usia_3_6 ?? 0) + 
                        ($request->usia_7_12 ?? 0) + 
                        ($request->usia_13_18 ?? 0) + 
                        ($request->usia_18_keatas ?? 0);

        if ($totalPeserta == 0) {
            return back()->withInput()->with('error', 'Total peserta tidak boleh kosong. Harap isi minimal 1 peserta.');
        }

        $data = $request->except(['_token', 'surat_permohonan', 'syarat_lainnya']);
        
        // Atur default nilai NULL agar masuk sebagai 0 ke database
        $data['usia_3_6'] = $request->usia_3_6 ?? 0;
        $data['usia_7_12'] = $request->usia_7_12 ?? 0;
        $data['usia_13_18'] = $request->usia_13_18 ?? 0;
        $data['usia_18_keatas'] = $request->usia_18_keatas ?? 0;

        // Dummy data untuk kolom yang tidak ada di form admin offline agar tidak error DB
        $data['alamat_institusi'] = '-'; 
        $data['kelurahan'] = '-'; 
        $data['jabatan_pemohon'] = '-'; 
        $data['nik'] = '-'; 
        
        // PERBAIKAN: Berikan default string jika file tidak diunggah agar MySQL tidak menolak
        $data['surat_permohonan'] = 'Tidak dilampirkan (Offline)'; 
        
        // Default langsung disetujui karena di-input langsung oleh admin
        $data['status_permohonan'] = 'Disetujui'; 

        // Upload Surat Permohonan (Jika admin memilih file)
        if ($request->hasFile('surat_permohonan')) {
            $fileSurat = $request->file('surat_permohonan');
            $filenameSurat = time() . '_edu_surat_off_' . uniqid() . '.' . $fileSurat->getClientOriginalExtension();
            $data['surat_permohonan'] = $fileSurat->storeAs('uploads/edukasi', $filenameSurat, 'public');
        }

        // Upload Syarat Lainnya (Opsional)
        if ($request->hasFile('syarat_lainnya')) {
            $fileLain = $request->file('syarat_lainnya');
            $filenameLain = time() . '_edu_lain_off_' . uniqid() . '.' . $fileLain->getClientOriginalExtension();
            $pathLain = $fileLain->storeAs('uploads/edukasi', $filenameLain, 'public');
            
            // Disimpan sebagai array untuk menyamakan struktur dengan pengajuan publik
            $data['syarat_lainnya'] = [$pathLain]; 
        }

        PermohonanEdukasi::create($data);

        return redirect('/internal/pencegahan/kelola-edukasi')->with('success', 'Data Kunjungan Edukasi Offline berhasil ditambahkan!');
    }

    /**
     * Menampilkan halaman edit untuk edukasi offline.
     */
    public function edit($id)
    {
        $edukasi = PermohonanEdukasi::findOrFail($id);
        
        return view('internal.pencegahan.edit_edukasi', compact('edukasi'));
    }

    /**
     * Memproses pembaruan data edukasi offline dari admin.
     */
    public function update(Request $request, $id)
    {
        $edukasi = PermohonanEdukasi::findOrFail($id);

        // Validasi input
        $request->validate([
            'institusi'        => 'required|string|max:150',
            'alamat_institusi' => 'required|string',
            'kecamatan'        => 'required|string',
            'kelurahan'        => 'required|string',
            'nama_pemohon'     => 'required|string|max:150',
            'jabatan_pemohon'  => 'required|string|max:100',
            'nik'              => 'required|string|max:16',
            'no_kontak'        => 'required|string|max:25',
            'tgl_kegiatan'     => 'required|date',
            'usia_3_6'         => 'nullable|integer|min:0',
            'usia_7_12'        => 'nullable|integer|min:0',
            'usia_13_18'       => 'nullable|integer|min:0',
            'usia_18_keatas'   => 'nullable|integer|min:0',
            'surat_permohonan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'syarat_lainnya.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,zip,rar|max:10240'
        ]);

        // Validasi pencegahan error jika semua field peserta kosong
        $totalPeserta = ($request->usia_3_6 ?? 0) + 
                        ($request->usia_7_12 ?? 0) + 
                        ($request->usia_13_18 ?? 0) + 
                        ($request->usia_18_keatas ?? 0);

        if ($totalPeserta == 0) {
            return back()->withInput()->with('error', 'Total peserta tidak boleh kosong. Harap isi minimal 1 peserta.');
        }

        $data = $request->except(['_token', '_method', 'surat_permohonan', 'syarat_lainnya']);

        // Set default 0 jika null
        $data['usia_3_6'] = $request->usia_3_6 ?? 0;
        $data['usia_7_12'] = $request->usia_7_12 ?? 0;
        $data['usia_13_18'] = $request->usia_13_18 ?? 0;
        $data['usia_18_keatas'] = $request->usia_18_keatas ?? 0;

        // Upload Surat Permohonan JIKA ada file baru yang diunggah
        if ($request->hasFile('surat_permohonan')) {
            // Hapus file lama jika ada di storage (hindari hapus text default "Tidak dilampirkan")
            if ($edukasi->surat_permohonan && Storage::disk('public')->exists($edukasi->surat_permohonan)) {
                Storage::disk('public')->delete($edukasi->surat_permohonan);
            }

            $fileSurat = $request->file('surat_permohonan');
            $filenameSurat = time() . '_edu_surat_off_' . uniqid() . '.' . $fileSurat->getClientOriginalExtension();
            $data['surat_permohonan'] = $fileSurat->storeAs('uploads/edukasi', $filenameSurat, 'public');
        }

        // Upload Syarat Lainnya JIKA ada file baru yang diunggah
        if ($request->hasFile('syarat_lainnya')) {
            // Proses hapus file multiple yang lama
            if ($edukasi->syarat_lainnya) {
                $oldFiles = is_array($edukasi->syarat_lainnya) ? $edukasi->syarat_lainnya : json_decode($edukasi->syarat_lainnya, true);
                if (is_array($oldFiles)) {
                    foreach ($oldFiles as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }
            }

            $uploadedFiles = [];
            foreach ($request->file('syarat_lainnya') as $fileLain) {
                $filenameLain = time() . '_edu_lain_off_' . uniqid() . '.' . $fileLain->getClientOriginalExtension();
                $path = $fileLain->storeAs('uploads/edukasi', $filenameLain, 'public');
                $uploadedFiles[] = $path;
            }
            $data['syarat_lainnya'] = $uploadedFiles;
        }

        $edukasi->update($data);

        return redirect('/internal/pencegahan/kelola-edukasi')->with('success', 'Data Kunjungan Edukasi berhasil diperbarui!');
    }
}
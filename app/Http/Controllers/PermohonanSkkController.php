<?php

namespace App\Http\Controllers;

use App\Models\PermohonanSkk;
use App\Models\PermohonanPerpanjangSkk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermohonanSkkController extends Controller
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

    public function store(Request $request)
    {
        $kecamatanValid = array_keys($this->dataWilayah);

        $validatedData = $request->validate([
            'jenis_permohonan'         => 'required|in:Baru,Perpanjangan',
            'nama_pemohon'             => 'required|string|max:150',
            'email_pemohon'            => 'required|email|max:100',
            'no_whatsapp'              => 'required|string|max:13|regex:/^[0-9]+$/',
            'nama_usaha'               => 'required|string|max:150',
            'nik_pemilik_usaha'        => 'required|string|size:16|regex:/^[0-9]+$/',
            'alamat_pemilik_usaha'     => 'required|string',
            'nama_bangunan'            => 'required|string|max:150',
            'kategori_bangunan'        => 'required|string|max:100',
            'konstruksi_bangunan'      => 'required|string|max:100',
            'nomor_imb'                => 'required|string|max:100',
            'alamat_bangunan'          => 'required|string',
            'kecamatan'                => ['required', 'string', Rule::in($kecamatanValid)],
            'kelurahan'                => ['required', 'string', function ($attribute, $value, $fail) use ($request) {
                $kec = $request->input('kecamatan');
                if (isset($this->dataWilayah[$kec]) && !in_array($value, $this->dataWilayah[$kec])) {
                    $fail('Kelurahan tidak valid untuk kecamatan yang dipilih.');
                }
            }],
            'luas_lahan'               => 'required|numeric|min:0',
            'luas_bangunan'            => 'required|numeric|min:0',
            'tinggi_bangunan'          => 'required|numeric|min:0',
            'jumlah_lantai'            => 'required|integer|min:1',
            // Validasi dinamis: file_skk_lama wajib diisi jika jenis permohonan adalah Perpanjangan
            'file_skk_lama'            => 'required_if:jenis_permohonan,Perpanjangan|nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_surat_permohonan'    => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_persyaratan_lainnya' => 'nullable|file|mimes:pdf,jpg,jpeg,png,zip,rar|max:10240',
        ], [
            'no_whatsapp.max'        => 'Nomor WhatsApp maksimal 13 digit.',
            'no_whatsapp.regex'      => 'Nomor WhatsApp hanya boleh berisi angka.',
            'nik_pemilik_usaha.size' => 'NIK harus berjumlah 16 digit.',
        ]);

        // Proses Upload File Surat Permohonan
        if ($request->hasFile('file_surat_permohonan')) {
            $fileSurat = $request->file('file_surat_permohonan');
            $filenameSurat = time() . '_skk_surat_' . uniqid() . '.' . $fileSurat->getClientOriginalExtension();
            $validatedData['file_surat_permohonan'] = $fileSurat->storeAs('uploads/skk', $filenameSurat, 'public');
        }

        // Proses Upload File SKK Lama (jika ada / perpanjangan)
        if ($request->hasFile('file_skk_lama')) {
            $fileSkkLama = $request->file('file_skk_lama');
            $filenameSkkLama = time() . '_skk_lama_' . uniqid() . '.' . $fileSkkLama->getClientOriginalExtension();
            $validatedData['file_skk_lama'] = $fileSkkLama->storeAs('uploads/skk', $filenameSkkLama, 'public');
        }

        // Proses Upload Persyaratan Lainnya
        if ($request->hasFile('file_persyaratan_lainnya')) {
            $fileLain = $request->file('file_persyaratan_lainnya');
            $filenameLain = time() . '_skk_lainnya_' . uniqid() . '.' . $fileLain->getClientOriginalExtension();
            $validatedData['file_persyaratan_lainnya'] = $fileLain->storeAs('uploads/skk', $filenameLain, 'public');
        }

        $validatedData['status_permohonan'] = 'Pending';

        // Memilah penyimpanan berdasarkan jenis permohonan (Baru atau Perpanjangan)
        if ($request->input('jenis_permohonan') === 'Perpanjangan') {
            PermohonanPerpanjangSkk::create($validatedData);
        } else {
            PermohonanSkk::create($validatedData);
        }

        return redirect()->back()->with('success', 'Permohonan Sertifikat Keamanan Kebakaran (SKK) berhasil dikirim!');
    }

    // =========================================================================
    // CEK STATUS PERMOHONAN SKK BARU & PERPANJANGAN (PUBLIK VIA AJAX)
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

        $statusMap = [
            'pending'   => 'Menunggu',
            'menunggu'  => 'Menunggu',
            'proses'    => 'Proses',
            'diproses'  => 'Proses',
            'disetujui' => 'Disetujui',
            'selesai'   => 'Disetujui',
            'ditolak'   => 'Ditolak',
        ];

        $formatRow = function ($row, $jenisDefault) use ($statusMap) {
            $rawStatus = strtolower(trim($row->status_permohonan ?? 'pending'));
            $statusTampil = $statusMap[$rawStatus] ?? ucfirst($row->status_permohonan);

            return [
                'jenis_permohonan' => $row->jenis_permohonan ?? $jenisDefault,
                'nama_bangunan'    => $row->nama_bangunan ?: $row->nama_usaha,
                'nama_pemohon'     => $row->nama_pemohon,
                'alamat_bangunan'  => $row->alamat_bangunan
                    . ($row->kelurahan ? ', Kel. ' . $row->kelurahan : '')
                    . ($row->kecamatan ? ', Kec. ' . $row->kecamatan : ''),
                'diajukan'         => $row->created_at ? $row->created_at->format('d M Y H:i') : '-',
                'timestamp'        => $row->created_at ? $row->created_at->timestamp : 0,
                'status'           => $statusTampil,
            ];
        };

        // 1. Ambil dari tabel Permohonan SKK Baru
        $skkBaru = PermohonanSkk::where('nik_pemilik_usaha', $kontak)
            ->orWhere('no_whatsapp', $kontak)
            ->get()
            ->map(function ($row) use ($formatRow) {
                return $formatRow($row, 'Baru');
            });

        // 2. Ambil dari tabel Permohonan Perpanjangan SKK
        $skkPerpanjang = PermohonanPerpanjangSkk::where('nik_pemilik_usaha', $kontak)
            ->orWhere('no_whatsapp', $kontak)
            ->get()
            ->map(function ($row) use ($formatRow) {
                return $formatRow($row, 'Perpanjangan');
            });

        // 3. Gabungkan kedua hasil dan urutkan dari pengajuan paling baru
        $items = $skkBaru->concat($skkPerpanjang)
            ->sortByDesc('timestamp')
            ->values();

        return response()->json([
            'data' => $items,
        ]);
    }
}
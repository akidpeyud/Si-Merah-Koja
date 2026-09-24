<?php

namespace App\Http\Controllers;

use App\Models\PermohonanSkk;
use App\Models\PermohonanPerpanjangSkk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermohonanSkkController extends Controller
{
    private $dataWilayah = [
        "Alam Barajo" => ["Bagan Pete", "Beliung", "Kenali Besar", "Mayang Mangurai", "Pinang Merah", "Rawa Sari", "Simpang Rimbo"],
        "Danau Sipin" => ["Legok", "Murni", "Selamat", "Solok Sipin", "Sungai Putri"],
        "Danau Teluk" => ["Olak Kemang", "Pasir Panjang", "Tanjung Pasir", "Tanjung Raden", "Ulu Gedong"],
        "Jambi Selatan" => ["Pakuan Baru", "Pasir Putih", "Tambak Sari", "The Hok", "Wijaya Pura"],
        "Jambi Timur" => ["Budiman", "Kasang", "Kasang Jaya", "Rajawali", "Sejinjang", "Sulanjana", "Talang Banjar", "Tanjung Pinang", "Tanjung Sari"],
        "Jelutung" => ["Cempaka Putih", "Handil Jaya", "Jelutung", "Kebun Handil", "Lebak Bandung", "Payo Lebar", "Talang Jauh"],
        "Kota Baru" => ["Kenali Asam", "Kenali Asam Atas", "Kenali Asam Bawah", "Paal Lima", "Simpang Tiga Sipin", "Sukakarya", "Talang Gulo"],
        "Paal Merah" => ["Bakung Jaya", "Eka Jaya", "Lingkar Selatan", "Paal Merah", "Payo Selincah", "Talang Bakung"],
        "Pasar Jambi" => ["Beringin", "Orang Kayo Hitam", "Pasar Jambi", "Sungai Asam"],
        "Pelayangan" => ["Arab Melayu", "Jelmu", "Mudung Laut", "Tahtul Yaman", "Tanjung Johor", "Tengah"],
        "Telanaipura" => ["Aur Kenali", "Buluran Kenali", "Pematang Sulur", "Penyengat Rendah", "Simpang Empat Sipin", "Telanaipura", "Teluk Kenali"]
    ];

    public function store(Request $request)
    {
        $kecamatanValid = array_keys($this->dataWilayah);

        $validatedData = $request->validate([
            'jenis_permohonan'         => 'required|in:Baru,Perpanjangan',
            'nama_pemohon'             => 'required|string|max:150',
            'email_pemohon'            => 'required|email|max:100',
            'no_whatsapp'              => 'required|string|max:25',
            'nama_usaha'               => 'required|string|max:150',
            'nik_pemilik_usaha'        => 'required|string|max:30',
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
            'file_persyaratan_lainnya' => 'nullable|file|mimes:pdf,jpg,jpeg,png,zip|max:10240',
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
}
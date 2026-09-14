<?php
namespace App\Http\Controllers;

use App\Models\PermohonanEdukasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermohonanEdukasiController extends Controller
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
            'nik'                => 'required|string|max:30',
            'no_kontak'          => 'required|string|max:25',
            'tgl_kegiatan'       => 'required|date',
            'usia_3_6'           => 'nullable|integer|min:0',
            'usia_7_12'          => 'nullable|integer|min:0',
            'usia_13_18'         => 'nullable|integer|min:0',
            'usia_18_keatas'     => 'nullable|integer|min:0',
            'surat_permohonan'   => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'syarat_lainnya'     => 'nullable|file|mimes:pdf,zip,rar|max:10240',
        ]);

        if ($request->hasFile('surat_permohonan')) {
            $fileSurat = $request->file('surat_permohonan');
            $filenameSurat = time() . '_edu_surat_' . uniqid() . '.' . $fileSurat->getClientOriginalExtension();
            $validatedData['surat_permohonan'] = $fileSurat->storeAs('uploads/edukasi', $filenameSurat, 'public');
        }

        if ($request->hasFile('syarat_lainnya')) {
            $fileLain = $request->file('syarat_lainnya');
            $filenameLain = time() . '_edu_lainnya_' . uniqid() . '.' . $fileLain->getClientOriginalExtension();
            $validatedData['syarat_lainnya'] = $fileLain->storeAs('uploads/edukasi', $filenameLain, 'public');
        }

        $validatedData['status_permohonan'] = 'Pending';
        PermohonanEdukasi::create($validatedData);

        return redirect()->back()->with('success', 'Pengajuan Edukasi & Sosialisasi berhasil dikirim!');
    }
}
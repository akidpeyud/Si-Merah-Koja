<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PermohonanRpkbgl;

class PermohonanRpkbglController extends Controller
{
    // =========================================================================
    // 1. TAMPILKAN HALAMAN UTAMA (INDEX ADMIN)
    // =========================================================================
// =========================================================================
    // 1. TAMPILKAN HALAMAN UTAMA (INDEX ADMIN)
    // =========================================================================
    public function index()
    {
        // Menggunakan Eloquent Model (Bukan DB::table)
        // Ini otomatis mengubah 'created_at' menjadi objek waktu (Carbon)
        // dan otomatis mengubah 'file_persyaratan_lainnya' menjadi Array.
        $permohonan = PermohonanRpkbgl::orderBy('created_at', 'desc')->get();

        return view('internal.pencegahan.kelola_rpkbgl', compact('permohonan'));
    }

    // =========================================================================
    // 2. TAMPILKAN FORM TAMBAH DATA (CREATE ADMIN)
    // =========================================================================
    public function create()
    {
        // Data wilayah Kota Jambi untuk logika dropdown dinamis
        $dataWilayah = [
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

        return view('internal.pencegahan.tambah_rpkbgl', compact('dataWilayah'));
    }

    // =========================================================================
    // 3. PROSES SIMPAN DATA (KODE ASLI ANDA)
    // =========================================================================
    public function store(Request $request)
    {
        // 1. Validasi input dari form HTML
        // Catatan: persyaratan_lainnya.* diubah menjadi nullable agar tidak error jika dikosongkan
        $request->validate([
            'nama_pemohon'          => 'required|string|max:150',
            'email_pemohon'         => 'required|email|max:100',
            'no_wa'                 => 'required|string|max:25',
            'nama_usaha'            => 'required|string|max:150',
            'nik'                   => 'required|string|max:30',
            'alamat_pemilik'        => 'required|string',
            'kategori'              => 'required|string|max:100',
            'alamat_bangunan'       => 'required|string',
            'kecamatan'             => 'required|string|max:100',
            'kelurahan'             => 'required|string|max:100',
            'luas_lahan'            => 'required|numeric',
            'luas_bangunan'         => 'required|numeric',
            'tinggi_bangunan'       => 'required|numeric',
            'surat_permohonan'      => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // Maks 5MB
            'persyaratan_lainnya.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'mimes'    => 'Format file :attribute harus PDF, JPG, JPEG, atau PNG.',
            'max'      => 'Ukuran file maksimal 5MB.'
        ]);

        try {
            // 2. Upload Surat Permohonan (1 File)
            $suratName = null;
            if ($request->hasFile('surat_permohonan')) {
                $fileSurat = $request->file('surat_permohonan');
                $suratName = time() . '_surat_' . str_replace(' ', '_', $fileSurat->getClientOriginalName());
                $fileSurat->move(public_path('uploads/rpkbgl/surat'), $suratName);
            }

            // 3. Upload Persyaratan Lainnya (Multiple Files)
            $persyaratanNames = [];
            if ($request->hasFile('persyaratan_lainnya')) {
                foreach ($request->file('persyaratan_lainnya') as $fileLain) {
                    $lainName = time() . '_lain_' . str_replace(' ', '_', $fileLain->getClientOriginalName());
                    $fileLain->move(public_path('uploads/rpkbgl/persyaratan'), $lainName);
                    $persyaratanNames[] = $lainName;
                }
            }
            
            // Karena di DB tipenya string, kita jadikan array nama file ke bentuk JSON string
            $filePersyaratanJson = json_encode($persyaratanNames);

            // 4. Simpan ke Database
            DB::table('permohonan_rpkbgl')->insert([
                'nama_pemohon'             => $request->nama_pemohon,
                'email_pemohon'            => $request->email_pemohon,
                'no_whatsapp'              => $request->no_wa,          
                'nama_usaha'               => $request->nama_usaha,
                'nik_pemilik_usaha'        => $request->nik,            
                'alamat_pemilik_usaha'     => $request->alamat_pemilik, 
                'kategori_bangunan'        => $request->kategori,       
                'alamat_bangunan'          => $request->alamat_bangunan,
                'kecamatan'                => $request->kecamatan,
                'kelurahan'                => $request->kelurahan,
                'luas_lahan'               => $request->luas_lahan,
                'luas_bangunan'            => $request->luas_bangunan,
                'tinggi_bangunan'          => $request->tinggi_bangunan,
                'file_surat_permohonan'    => $suratName,
                'file_persyaratan_lainnya' => $filePersyaratanJson,
                'status_permohonan'        => 'Pending',
                'created_at'               => now(),
                'updated_at'               => now(),
            ]);

            // 5. Sukses, kembali ke form dengan trigger SweetAlert
            return redirect()->back()->with('success', 'Permohonan RPKBGL Anda berhasil dikirim dan akan segera diproses dalam 14 hari kerja.');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['Gagal mengirim permohonan: ' . $e->getMessage()]);
        }
    }

    // =========================================================================
    // 4. PROSES UPDATE STATUS (ADMIN)
    // =========================================================================
    public function updateStatus(Request $request, $id)
    {
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
        // Ambil data spesifik
        $rpkbgl = DB::table('permohonan_rpkbgl')->where('id', $id)->first();

        if ($rpkbgl) {
            // Hapus file surat permohonan
            if ($rpkbgl->file_surat_permohonan && file_exists(public_path('uploads/rpkbgl/surat/' . $rpkbgl->file_surat_permohonan))) {
                unlink(public_path('uploads/rpkbgl/surat/' . $rpkbgl->file_surat_permohonan));
            }

            // Hapus file persyaratan lainnya (decode JSON dulu ke array)
            $files = json_decode($rpkbgl->file_persyaratan_lainnya, true);
            if (!empty($files) && is_array($files)) {
                foreach ($files as $file) {
                    if (file_exists(public_path('uploads/rpkbgl/persyaratan/' . $file))) {
                        unlink(public_path('uploads/rpkbgl/persyaratan/' . $file));
                    }
                }
            }

            // Hapus record dari database
            DB::table('permohonan_rpkbgl')->where('id', $id)->delete();
        }

        return redirect()->back()->with('success', 'Data dan berkas permohonan berhasil dihapus selamanya.');
    }
    // =========================================================================
    // 6. TAMPILKAN DETAIL DATA (SHOW ADMIN)
    // =========================================================================
    public function show($id)
    {
        // Cari data berdasarkan ID dan gunakan variabel $permohonan
        $permohonan = PermohonanRpkbgl::findOrFail($id);
        
        // Kembalikan ke tampilan detail dengan membawa data $permohonan
        return view('internal.pencegahan.detail_rpkbgl', compact('permohonan'));
    }
}

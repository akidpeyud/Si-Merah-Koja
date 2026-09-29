<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PermohonanRpkbgl;

class PermohonanRpkbglController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi input dari form HTML
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
            'persyaratan_lainnya.*' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            // Kustomisasi pesan error jika mau
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
            // Memetakan nama input form (kiri) ke nama kolom database (kanan)
            DB::table('permohonan_rpkbgl')->insert([
                'nama_pemohon'             => $request->nama_pemohon,
                'email_pemohon'            => $request->email_pemohon,
                'no_whatsapp'              => $request->no_wa,          // Beda nama
                'nama_usaha'               => $request->nama_usaha,
                'nik_pemilik_usaha'        => $request->nik,            // Beda nama
                'alamat_pemilik_usaha'     => $request->alamat_pemilik, // Beda nama
                'kategori_bangunan'        => $request->kategori,       // Beda nama
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
            // Jika ada error (misal folder upload tidak bisa ditulis), kembalikan error
            return redirect()->back()->withInput()->withErrors(['Gagal mengirim permohonan: ' . $e->getMessage()]);
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IzinKeramaian;
use Illuminate\Support\Facades\Storage;

class IzinKeramaianController extends Controller
{
    /**
     * ==============================================
     * FUNGSI UNTUK HALAMAN PUBLIK (PEMOHON)
     * ==============================================
     */

    public function index()
    {
        return view('layanan-fasilitas.izin_keramaian', [
            'tab_aktif' => 'keramaian'
        ]);
    }

    public function store(Request $request)
    {
        // 1. Validasi input yang disesuaikan dengan form
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            
            'nama_direktur' => 'required|string|max:255',
            'nama_usaha' => 'required|string|max:255',
            'no_izin_usaha' => 'required|string|max:255',
            
            'nama_acara' => 'required|string|max:255',
            'jenis_event' => 'required|in:hiburan,non_hiburan',
            'lokasi_acara' => 'required|string|max:255',
            'tgl_pelaksanaan' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'jumlah_penonton' => 'required|integer|min:1',
            
            'jumlah_apar' => 'required|integer|min:8',
            'jumlah_staff' => 'required|integer|min:4',
            
            // Validasi 5 File Dokumen
            'surat_permohonan' => 'required|mimes:pdf,jpeg,png,jpg|max:5120',
            'fotokopi_ktp' => 'required|mimes:pdf,jpeg,png,jpg|max:5120',
            'foto_jalur_evakuasi' => 'required|mimes:pdf,jpeg,png,jpg|max:5120',
            'bukti_pajak_bpprd' => 'required_if:jenis_event,hiburan|mimes:pdf,jpeg,png,jpg|max:5120',
            'surat_pernyataan' => 'required|mimes:pdf,jpeg,png,jpg|max:5120',
        ], [
            'jumlah_apar.min' => 'Jumlah APAR minimal harus 8 buah sesuai persyaratan.',
            'jumlah_staff.min' => 'Jumlah staff terlatih minimal harus 4 orang.',
            'nik.digits' => 'NIK harus berjumlah tepat 16 digit.',
            'bukti_pajak_bpprd.required_if' => 'Bukti pembayaran pajak BPPRD wajib dilampirkan untuk event hiburan.'
        ]);

        // 2. Proses upload file ke public storage
        $fileFields = [
            'surat_permohonan', 
            'fotokopi_ktp', 
            'foto_jalur_evakuasi', 
            'bukti_pajak_bpprd', 
            'surat_pernyataan'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $validatedData[$field] = $request->file($field)->store('uploads/izin_keramaian/' . $field, 'public');
            }
        }

        // Set status default
        $validatedData['status_permohonan'] = 'Pending';

        // 3. Simpan ke database
        IzinKeramaian::create($validatedData);

        return redirect()->back()->with('success', 'Permohonan Rekomendasi Izin Keramaian berhasil dikirim dan akan segera diproses.');
    }

    public function cekStatus(Request $request)
    {
        $request->validate([
            'kontak' => ['required', 'digits_between:9,20'],
        ], [
            'kontak.required'       => 'Masukkan NIK atau No HP/WA.',
            'kontak.digits_between' => 'Masukkan NIK (16 digit) atau nomor HP/WA yang valid.',
        ]);

        $kontak = $request->input('kontak');
        $label = ['Pending' => 'Menunggu'];

        $data = IzinKeramaian::where(function ($q) use ($kontak) {
                $q->where('nik', $kontak)->orWhere('no_hp', $kontak);
            })
            ->latest()
            ->limit(10)
            ->get()
            ->map(function ($r) use ($label) {
                $status = $r->status_permohonan ?: 'Pending';
                return [
                    'kegiatan' => $r->nama_acara,
                    'nama'     => $r->nama,
                    'lokasi'   => $r->lokasi_acara,
                    'tanggal'  => \Carbon\Carbon::parse($r->tgl_pelaksanaan)->translatedFormat('d F Y'),
                    'diajukan' => optional($r->created_at)->translatedFormat('d F Y'),
                    'status'   => $label[$status] ?? $status,
                ];
            });

        return response()->json(['data' => $data]);
    }

    /**
     * ==============================================
     * FUNGSI UNTUK DASHBOARD INTERNAL (ADMIN DAMTAN)
     * ==============================================
     */

    public function indexInternal()
    {
        $permohonan = IzinKeramaian::orderBy('created_at', 'desc')->get();
        return view('internal.damtan.kelola_izin_keramaian', compact('permohonan'));
    }

    public function showInternal($id)
    {
        $permohonan = IzinKeramaian::findOrFail($id);
        return view('internal.damtan.detail_izin_keramaian', compact('permohonan'));
    }

    public function updateStatusInternal(Request $request, $id)
    {
        $request->validate([
            'status_permohonan' => 'required|string'
        ]);

        IzinKeramaian::where('id', $id)->update([
            'status_permohonan' => $request->status_permohonan
        ]);

        return redirect()->back()->with('success', 'Status Izin Keramaian berhasil diperbarui!');
    }

    public function destroyInternal($id)
    {
        $permohonan = IzinKeramaian::findOrFail($id);
        
        $fileFields = [
            'surat_permohonan', 
            'fotokopi_ktp', 
            'foto_jalur_evakuasi', 
            'bukti_pajak_bpprd', 
            'surat_pernyataan'
        ];

        foreach ($fileFields as $field) {
            if ($permohonan->$field && Storage::disk('public')->exists($permohonan->$field)) {
                Storage::disk('public')->delete($permohonan->$field);
            }
        }

        $permohonan->delete();

        return redirect()->back()->with('success', 'Data Izin Keramaian berhasil dihapus!');
    }

    public function editInternal($id)
    {
        $permohonan = IzinKeramaian::findOrFail($id);
        return view('internal.damtan.edit_izin_keramaian', compact('permohonan'));
    }

    public function updateInternal(Request $request, $id)
    {
        $permohonan = IzinKeramaian::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'nama_direktur' => 'required|string|max:255',
            'nama_usaha' => 'required|string|max:255',
            'no_izin_usaha' => 'required|string|max:255',
            
            'nama_acara' => 'required|string|max:255',
            'jenis_event' => 'required|in:hiburan,non_hiburan',
            'lokasi_acara' => 'required|string|max:255',
            'tgl_pelaksanaan' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'jumlah_penonton' => 'required|integer|min:1',
            
            'jumlah_apar' => 'required|integer|min:8',
            'jumlah_staff' => 'required|integer|min:4',
            
            // Validasi file opsional (jika admin ingin mengganti dokumen)
            'surat_permohonan' => 'nullable|mimes:pdf,jpeg,png,jpg|max:5120',
            'fotokopi_ktp' => 'nullable|mimes:pdf,jpeg,png,jpg|max:5120',
            'foto_jalur_evakuasi' => 'nullable|mimes:pdf,jpeg,png,jpg|max:5120',
            'bukti_pajak_bpprd' => 'nullable|mimes:pdf,jpeg,png,jpg|max:5120',
            'surat_pernyataan' => 'nullable|mimes:pdf,jpeg,png,jpg|max:5120',
        ]);

        // Proses ganti file untuk 5 kolom dokumen (Hanya jika admin mengunggah file baru)
        $fileFields = [
            'surat_permohonan', 
            'fotokopi_ktp', 
            'foto_jalur_evakuasi', 
            'bukti_pajak_bpprd', 
            'surat_pernyataan'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama jika file baru diunggah
                if ($permohonan->$field && Storage::disk('public')->exists($permohonan->$field)) {
                    Storage::disk('public')->delete($permohonan->$field);
                }
                
                // Simpan file baru
                $validatedData[$field] = $request->file($field)->store('uploads/izin_keramaian/' . $field, 'public');
            }
        }

        $permohonan->update($validatedData);

        return redirect()->route('internal.izin-keramaian.index')->with('success', 'Data permohonan berhasil diperbarui!');
    }
}
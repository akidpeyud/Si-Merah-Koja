<?php

namespace App\Http\Controllers;

use App\Exports\TitikSigapExport;
use App\Models\TitikSigap;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class PetaController extends Controller
{
    /**
     * Aturan validasi bersama untuk store & update.
     * Kategori diambil dari TitikSigap::KATEGORI.
     */
    private function rules(): array
    {
        return [
            'kategori' => ['required', Rule::in(array_keys(TitikSigap::KATEGORI))],
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'keterangan' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ];
    }

    // ==========================================
    // FUNGSI HALAMAN PUBLIK
    // ==========================================

    public function sigap()
    {
        return view('public.sigap');
    }

    // ==========================================
    // FUNGSI DASHBOARD ADMIN (CRUD)
    // ==========================================

    /**
     * READ: Tampilkan Halaman Daftar Data (Tabel)
     */
    public function data()
    {
        $titikSigaps = TitikSigap::orderBy('created_at', 'desc')->get();

        return view('internal.peta-sigap.data_peta', compact('titikSigaps'));
    }

    /**
     * CREATE: Tampilkan Halaman Input
     */
    public function input()
    {
        // Opsional: jika input dan tabel digabung dalam 1 halaman
        $titikSigaps = TitikSigap::orderBy('created_at', 'desc')->get();

        return view('internal.peta-sigap.inputdata_peta', compact('titikSigaps'));
    }

    private function formatKeterangan(Request $request): ?string
    {
        $keterangan = $request->keterangan;

        if ($request->kategori === 'zona_rawan' && $request->filled('tingkat_risiko')) {
            $tingkat = in_array($request->tingkat_risiko, ['Tinggi', 'Sedang'], true) ? $request->tingkat_risiko : 'Tinggi';
            $bersih = preg_replace('/Tingkat\s*Risiko\s*:\s*(Tinggi|Sedang)\s*\|?\s*/i', '', (string) $keterangan);
            $bersih = trim($bersih);
            $keterangan = "Tingkat Risiko: {$tingkat}".($bersih !== '' ? " | {$bersih}" : '');
        }

        return $keterangan;
    }

    /**
     * CREATE: Simpan Data Titik Baru
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate($this->rules());

        TitikSigap::create([
            'kategori' => $request->kategori,
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'keterangan' => $this->formatKeterangan($request),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->back()->with('success', 'Titik SIGAP berhasil ditambahkan!');
    }

    /**
     * UPDATE: Tampilkan Form Edit Data
     */
    public function edit($id)
    {
        $titik = TitikSigap::findOrFail($id);

        return view('internal.peta-sigap.edit_peta', compact('titik'));
    }

    /**
     * UPDATE: Simpan Perubahan Data
     */
    public function update(Request $request, $id)
    {
        $request->validate($this->rules());

        $titik = TitikSigap::findOrFail($id);

        $titik->update([
            'kategori' => $request->kategori,
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'keterangan' => $this->formatKeterangan($request),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        // Arahkan kembali ke halaman data setelah berhasil edit
        return redirect('/internal/peta-sigap/data')->with('success', 'Data Titik SIGAP berhasil diperbarui!');
    }

    /**
     * DELETE: Hapus Data Titik
     */
    public function destroy($id)
    {
        $titik = TitikSigap::findOrFail($id);
        $titik->delete();

        return redirect()->back()->with('success', 'Titik berhasil dihapus!');
    }

    /**
     * EXPORT: Download Data as PDF
     */
    public function exportPdf()
    {
        // Ambil data dari database
        $titikSigaps = TitikSigap::orderBy('created_at', 'desc')->get();

        // Load view khusus untuk format PDF (pastikan file ini sudah dibuat)
        $pdf = \PDF::loadView('internal.peta-sigap.pdf', compact('titikSigaps'));

        // Kembalikan response berupa unduhan file PDF
        return $pdf->download('Data_Titik_SIGAP.pdf');
    }

    // ==========================================
    // FUNGSI API (UNTUK PETA PUBLIK)
    // ==========================================

    /**
     * API Endpoint
     */
    public function apiData()
    {
        // Hanya kategori aktif; data lama (kebakaran, penyelamatan) tidak dikirim ke peta publik
        $titiks = TitikSigap::whereIn('kategori', array_keys(TitikSigap::KATEGORI))->get();

        $formattedTitik = $titiks->map(function ($titik) {
            return [
                'id' => $titik->id,
                'kategori' => $titik->kategori,
                'tingkat_risiko' => $titik->tingkat_risiko,
                'nama' => $titik->nama,
                'lokasi' => $titik->lokasi,
                'keterangan' => $titik->keterangan, // Tambahkan keterangan agar bisa dibaca di popup Maps Publik
                'lat' => (float) $titik->latitude,
                'lng' => (float) $titik->longitude,
            ];
        });

        return response()->json($formattedTitik);
    }

    /**
     * EXPORT: Download Data as Excel
     */
    public function exportExcel()
    {
        // Pastikan Anda mengimport class TitikSigapExport di bagian atas controller jika tidak pakai namespace penuh
        return Excel::download(new TitikSigapExport, 'Data_Titik_SIGAP.xlsx');
    }
}

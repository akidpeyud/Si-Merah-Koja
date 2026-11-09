<?php

namespace App\Http\Controllers;

use App\Models\PetaJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PetaJabatanController extends Controller
{
    /**
     * Pastikan hanya role berwenang yang dapat memodifikasi data.
     */
    private function pastikanAksesCrud(): void
    {
        $user = auth()->user();
        if (! $user || ! method_exists($user, 'hasAnyRole') || ! $user->hasAnyRole(['Super User', 'Sekretariat', 'Operator'])) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk mengelola Data Peta Jabatan.');
        }
    }

    /**
     * Menampilkan halaman daftar dokumen Peta Jabatan (CRUD internal).
     */
    public function index(Request $request)
    {
        $query = PetaJabatan::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('tahun', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        $dokumen = $query->latest()->paginate(15)->withQueryString();
        $totalDokumen = PetaJabatan::count();

        return view('internal.kepegawaian.peta-jabatan.index', compact('dokumen', 'totalDokumen'));
    }

    /**
     * Menyimpan data dokumen Peta Jabatan baru.
     */
    public function store(Request $request)
    {
        $this->pastikanAksesCrud();

        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'nullable|digits:4',
            'keterangan' => 'nullable|string',
            'file_dokumen' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ], [
            'judul.required' => 'Judul Peta Jabatan wajib diisi.',
            'file_dokumen.required' => 'File dokumen wajib diunggah.',
            'file_dokumen.mimes' => 'File dokumen harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_dokumen.max' => 'Ukuran file dokumen maksimal 10MB.',
        ]);

        $path = $request->file('file_dokumen')->store('peta-jabatan', 'public');

        PetaJabatan::create([
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
            'file_dokumen' => $path,
        ]);

        return redirect()->route('kepegawaian.peta-jabatan.index')
            ->with('success', 'Dokumen Peta Jabatan berhasil ditambahkan!');
    }

    /**
     * Memperbarui data dokumen Peta Jabatan.
     */
    public function update(Request $request, $id)
    {
        $this->pastikanAksesCrud();

        $item = PetaJabatan::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'nullable|digits:4',
            'keterangan' => 'nullable|string',
            'file_dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ], [
            'judul.required' => 'Judul Peta Jabatan wajib diisi.',
            'file_dokumen.mimes' => 'File dokumen harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_dokumen.max' => 'Ukuran file dokumen maksimal 10MB.',
        ]);

        $dataUpdate = [
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
        ];

        if ($request->hasFile('file_dokumen')) {
            if ($item->file_dokumen && Storage::disk('public')->exists($item->file_dokumen)) {
                Storage::disk('public')->delete($item->file_dokumen);
            }
            $dataUpdate['file_dokumen'] = $request->file('file_dokumen')->store('peta-jabatan', 'public');
        }

        $item->update($dataUpdate);

        return redirect()->route('kepegawaian.peta-jabatan.index')
            ->with('success', 'Dokumen Peta Jabatan berhasil diperbarui!');
    }

    /**
     * Menghapus dokumen Peta Jabatan.
     */
    public function destroy($id)
    {
        $this->pastikanAksesCrud();

        $item = PetaJabatan::findOrFail($id);

        if ($item->file_dokumen && Storage::disk('public')->exists($item->file_dokumen)) {
            Storage::disk('public')->delete($item->file_dokumen);
        }

        $item->delete();

        return redirect()->route('kepegawaian.peta-jabatan.index')
            ->with('success', 'Dokumen Peta Jabatan berhasil dihapus!');
    }

    /**
     * Menampilkan / preview file dokumen.
     */
    public function viewFile(Request $request, $id)
    {
        $item = PetaJabatan::findOrFail($id);

        if (! $item->file_dokumen || ! Storage::disk('public')->exists($item->file_dokumen)) {
            abort(404, 'File dokumen tidak ditemukan.');
        }

        $path = Storage::disk('public')->path($item->file_dokumen);

        if ($request->boolean('raw')) {
            $base64 = base64_encode(file_get_contents($path));

            return response()->json([
                'judul' => $item->judul,
                'base64' => $base64,
            ]);
        }

        return response()->file($path);
    }

    /**
     * Mengunduh file dokumen.
     */
    public function downloadFile($id)
    {
        $item = PetaJabatan::findOrFail($id);

        if (! $item->file_dokumen || ! Storage::disk('public')->exists($item->file_dokumen)) {
            abort(404, 'File dokumen tidak ditemukan.');
        }

        $ext = pathinfo($item->file_dokumen, PATHINFO_EXTENSION) ?: 'pdf';
        $filename = Str::slug($item->judul).'.'.$ext;

        return Storage::disk('public')->download($item->file_dokumen, $filename);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ProfilInstansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfilInstansiController extends Controller
{
    /**
     * Validasi apakah parameter slug kategori di URL terdaftar
     */
    private function cekKategori(string $kategori): string
    {
        $daftar = ProfilInstansi::daftarKategori();
        if (! array_key_exists($kategori, $daftar)) {
            abort(404, 'Kategori Profil tidak ditemukan.');
        }

        return $daftar[$kategori];
    }

    /**
     * Pastikan hanya Super User dan Operator yang bisa melakukan Create, Update, Delete
     */
    private function pastikanAksesCrud(): void
    {
        $user = auth()->user();
        if (! $user || ! method_exists($user, 'hasAnyRole') || ! $user->hasAnyRole(['Super User', 'Operator'])) {
            abort(403, 'Akses ditolak. Anda hanya memiliki izin baca (Read-Only).');
        }
    }

    /**
     * Menampilkan daftar data profil berdasarkan kategori
     */
    public function index(Request $request, string $kategori)
    {
        $judulKategori = $this->cekKategori($kategori);

        $query = ProfilInstansi::where('kategori', $kategori);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%")
                    ->orWhere('tahun', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('internal.profil-instansi.index', compact('data', 'kategori', 'judulKategori'));
    }

    /**
     * Menampilkan halaman form tambah profil instansi
     */
    public function create(string $kategori)
    {
        $this->pastikanAksesCrud();
        $judulKategori = $this->cekKategori($kategori);

        return view('internal.profil-instansi.create', compact('kategori', 'judulKategori'));
    }

    /**
     * Menyimpan data profil baru ke database
     */
    public function store(Request $request, string $kategori)
    {
        $this->pastikanAksesCrud();
        $judulKategori = $this->cekKategori($kategori);

        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'nullable|digits:4',
            'keterangan' => 'nullable|string',
            'file_dokumen' => 'required|file|mimes:pdf|max:10240', // Wajib PDF, Maks 10MB
        ], [
            'judul.required' => 'Judul wajib diisi.',
            'file_dokumen.required' => 'File dokumen PDF wajib diunggah.',
            'file_dokumen.mimes' => 'File dokumen wajib berformat PDF (.pdf).',
            'file_dokumen.max' => 'Ukuran file PDF maksimal 10MB.',
        ]);

        $path = $request->file('file_dokumen')->store("profil-instansi/{$kategori}", 'public');

        ProfilInstansi::create([
            'kategori' => $kategori,
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
            'file_dokumen' => $path,
        ]);

        return redirect()->route('internal.profil-instansi.index', $kategori)
            ->with('success', "Data {$judulKategori} berhasil ditambahkan.");
    }

    /**
     * Menampilkan halaman form edit profil instansi
     */
    public function edit(string $kategori, $id)
    {
        $this->pastikanAksesCrud();
        $judulKategori = $this->cekKategori($kategori);
        $item = ProfilInstansi::where('kategori', $kategori)->findOrFail($id);

        return view('internal.profil-instansi.edit', compact('kategori', 'judulKategori', 'item'));
    }

    /**
     * Memperbarui data profil instansi di database
     */
    public function update(Request $request, string $kategori, $id)
    {
        $this->pastikanAksesCrud();
        $judulKategori = $this->cekKategori($kategori);
        $item = ProfilInstansi::where('kategori', $kategori)->findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'nullable|digits:4',
            'keterangan' => 'nullable|string',
            'file_dokumen' => 'nullable|file|mimes:pdf|max:10240',
        ], [
            'judul.required' => 'Judul wajib diisi.',
            'file_dokumen.mimes' => 'File dokumen pengganti wajib berformat PDF (.pdf).',
            'file_dokumen.max' => 'Ukuran file PDF maksimal 10MB.',
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
            $dataUpdate['file_dokumen'] = $request->file('file_dokumen')->store("profil-instansi/{$kategori}", 'public');
        }

        $item->update($dataUpdate);

        return redirect()->route('internal.profil-instansi.index', $kategori)
            ->with('success', "Data {$judulKategori} berhasil diperbarui.");
    }

    /**
     * Menghapus data profil instansi beserta file PDF-nya
     */
    public function destroy(string $kategori, $id)
    {
        $this->pastikanAksesCrud();
        $this->cekKategori($kategori);
        $item = ProfilInstansi::where('kategori', $kategori)->findOrFail($id);

        if ($item->file_dokumen && Storage::disk('public')->exists($item->file_dokumen)) {
            Storage::disk('public')->delete($item->file_dokumen);
        }

        $item->delete();

        return back()->with('success', 'Data berhasil dihapus.');
    }

    /**
     * Mengirimkan data PDF sebagai JSON Base64 agar 100% tidak dicegat oleh IDM
     */
    public function viewFile(Request $request, string $kategori, $id)
    {
        $this->cekKategori($kategori);
        $item = ProfilInstansi::where('kategori', $kategori)->findOrFail($id);

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
     * Mengunduh file PDF secara resmi saat tombol Unduh diklik
     */
    public function downloadFile(string $kategori, $id)
    {
        $this->cekKategori($kategori);
        $item = ProfilInstansi::where('kategori', $kategori)->findOrFail($id);

        if (! $item->file_dokumen || ! Storage::disk('public')->exists($item->file_dokumen)) {
            abort(404, 'File dokumen tidak ditemukan.');
        }

        $filename = Str::slug($item->judul).'.pdf';

        return Storage::disk('public')->download($item->file_dokumen, $filename, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}

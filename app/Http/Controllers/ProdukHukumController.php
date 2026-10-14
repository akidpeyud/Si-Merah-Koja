<?php

namespace App\Http\Controllers;

use App\Models\ProdukHukum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukHukumController extends Controller
{
    /**
     * Validasi apakah parameter slug kategori di URL terdaftar
     */
    private function cekKategori(string $kategori): string
    {
        $daftar = ProdukHukum::daftarKategori();
        if (!array_key_exists($kategori, $daftar)) {
            abort(404, 'Kategori Produk Hukum tidak ditemukan.');
        }
        return $daftar[$kategori];
    }

    /**
     * Pastikan hanya Super User dan Operator yang bisa melakukan Create, Update, Delete
     */
    private function pastikanAksesCrud(): void
    {
        $user = auth()->user();
        if (!$user || !method_exists($user, 'hasAnyRole') || !$user->hasAnyRole(['Super User', 'Operator'])) {
            abort(403, 'Akses ditolak. Anda hanya memiliki izin baca (Read-Only).');
        }
    }

    /**
     * Menampilkan daftar produk hukum berdasarkan kategori
     */
    public function index(Request $request, string $kategori)
    {
        $judulKategori = $this->cekKategori($kategori);

        $query = ProdukHukum::where('kategori', $kategori);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('nomor', 'like', "%{$search}%")
                  ->orWhere('tahun', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('internal.produk-hukum.index', compact('data', 'kategori', 'judulKategori'));
    }

    /**
     * Menampilkan halaman form tambah produk hukum
     */
    public function create(string $kategori)
    {
        $this->pastikanAksesCrud();
        $judulKategori = $this->cekKategori($kategori);

        return view('internal.produk-hukum.create', compact('kategori', 'judulKategori'));
    }

    /**
     * Menyimpan produk hukum baru ke database (Hanya PDF)
     */
    public function store(Request $request, string $kategori)
    {
        $this->pastikanAksesCrud();
        $judulKategori = $this->cekKategori($kategori);

        $request->validate([
            'nomor'        => 'nullable|string|max:150',
            'tahun'        => 'nullable|digits:4',
            'judul'        => 'required|string|max:255',
            'keterangan'   => 'nullable|string',
            'file_dokumen' => 'required|file|mimes:pdf|max:10240', // Wajib PDF, Maks 10MB
        ], [
            'judul.required'        => 'Judul atau tentang peraturan wajib diisi.',
            'file_dokumen.required' => 'File dokumen PDF wajib diunggah.',
            'file_dokumen.mimes'    => 'File dokumen wajib berformat PDF (.pdf).',
            'file_dokumen.max'      => 'Ukuran file PDF maksimal 10MB.',
        ]);

        $path = $request->file('file_dokumen')->store("produk-hukum/{$kategori}", 'public');

        ProdukHukum::create([
            'kategori'     => $kategori,
            'nomor'        => $request->nomor,
            'tahun'        => $request->tahun,
            'judul'        => $request->judul,
            'keterangan'   => $request->keterangan,
            'file_dokumen' => $path,
        ]);

        return redirect()->route('internal.produk-hukum.index', $kategori)
            ->with('success', "Data {$judulKategori} berhasil ditambahkan.");
    }

    /**
     * Menampilkan halaman form edit produk hukum
     */
    public function edit(string $kategori, $id)
    {
        $this->pastikanAksesCrud();
        $judulKategori = $this->cekKategori($kategori);
        $item = ProdukHukum::where('kategori', $kategori)->findOrFail($id);

        return view('internal.produk-hukum.edit', compact('kategori', 'judulKategori', 'item'));
    }

    /**
     * Memperbarui data produk hukum di database (Hanya PDF)
     */
    public function update(Request $request, string $kategori, $id)
    {
        $this->pastikanAksesCrud();
        $judulKategori = $this->cekKategori($kategori);
        $item = ProdukHukum::where('kategori', $kategori)->findOrFail($id);

        $request->validate([
            'nomor'        => 'nullable|string|max:150',
            'tahun'        => 'nullable|digits:4',
            'judul'        => 'required|string|max:255',
            'keterangan'   => 'nullable|string',
            'file_dokumen' => 'nullable|file|mimes:pdf|max:10240', // Opsional saat edit, wajib PDF jika diisi
        ], [
            'judul.required'     => 'Judul atau tentang peraturan wajib diisi.',
            'file_dokumen.mimes' => 'File dokumen pengganti wajib berformat PDF (.pdf).',
            'file_dokumen.max'   => 'Ukuran file PDF maksimal 10MB.',
        ]);

        $dataUpdate = [
            'nomor'      => $request->nomor,
            'tahun'      => $request->tahun,
            'judul'      => $request->judul,
            'keterangan' => $request->keterangan,
        ];

        if ($request->hasFile('file_dokumen')) {
            if ($item->file_dokumen && Storage::disk('public')->exists($item->file_dokumen)) {
                Storage::disk('public')->delete($item->file_dokumen);
            }
            $dataUpdate['file_dokumen'] = $request->file('file_dokumen')->store("produk-hukum/{$kategori}", 'public');
        }

        $item->update($dataUpdate);

        return redirect()->route('internal.produk-hukum.index', $kategori)
            ->with('success', "Data {$judulKategori} berhasil diperbarui.");
    }

    /**
     * Menghapus data produk hukum beserta file PDF-nya
     */
    public function destroy(string $kategori, $id)
    {
        $this->pastikanAksesCrud();
        $this->cekKategori($kategori);
        $item = ProdukHukum::where('kategori', $kategori)->findOrFail($id);

        if ($item->file_dokumen && Storage::disk('public')->exists($item->file_dokumen)) {
            Storage::disk('public')->delete($item->file_dokumen);
        }

        $item->delete();

        return back()->with('success', 'Data dokumen berhasil dihapus.');
    }

    /**
     * Mengirimkan data PDF sebagai JSON Base64 agar 100% tidak dicegat oleh IDM
     */
    public function viewFile(Request $request, string $kategori, $id)
    {
        $this->cekKategori($kategori);
        $item = ProdukHukum::where('kategori', $kategori)->findOrFail($id);

        if (!$item->file_dokumen || !Storage::disk('public')->exists($item->file_dokumen)) {
            abort(404, 'File dokumen tidak ditemukan.');
        }

        $path = Storage::disk('public')->path($item->file_dokumen);

        // Jika diminta oleh modal preview (?raw=1), kirim dalam bentuk JSON Base64
        // sehingga IDM menganggapnya sebagai respon teks JSON biasa dan tidak mendownloadnya
        if ($request->boolean('raw')) {
            $base64 = base64_encode(file_get_contents($path));
            return response()->json([
                'judul'  => $item->judul,
                'base64' => $base64,
            ]);
        }

        $filename = Str::slug($item->judul) . '.pdf';

        return response()->file($path, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }

    /**
     * Mengunduh file PDF secara resmi saat tombol Unduh diklik
     */
    public function downloadFile(string $kategori, $id)
    {
        $this->cekKategori($kategori);
        $item = ProdukHukum::where('kategori', $kategori)->findOrFail($id);

        if (!$item->file_dokumen || !Storage::disk('public')->exists($item->file_dokumen)) {
            abort(404, 'File dokumen tidak ditemukan.');
        }

        $filename = Str::slug($item->judul) . '.pdf';

        return Storage::disk('public')->download($item->file_dokumen, $filename, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
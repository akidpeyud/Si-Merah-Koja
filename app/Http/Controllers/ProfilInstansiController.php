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
        $gambaranBesar = ProfilInstansi::getGambaranBesar($kategori);

        return view('internal.profil-instansi.index', compact('data', 'kategori', 'judulKategori', 'gambaranBesar'));
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

        $rules = [
            'judul' => 'required|string|max:255',
            'tahun' => 'nullable|digits:4',
            'keterangan' => 'nullable|string',
        ];

        if ($kategori === 'sotk') {
            $rules['sub_kategori'] = 'nullable|string|in:dinas,komando,sekretariat,bidang_pencegahan,bidang_sapra,bidang_damtan,pos_pelayanan';
            $rules['pos_pelayanan'] = 'nullable|string|max:100';
        }

        if ($request->filled('file_dokumen_base64')) {
            $rules['file_dokumen_base64'] = 'required|string';
            $rules['file_dokumen_name'] = 'required|string|max:255';
        } else {
            $rules['file_dokumen'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:10240';
        }

        $request->validate($rules, [
            'judul.required' => 'Judul wajib diisi.',
            'file_dokumen.required' => 'File dokumen wajib diunggah.',
            'file_dokumen.uploaded' => 'Ukuran file melebihi batas upload server PHP. Silakan unggah ulang.',
            'file_dokumen.mimes' => 'File wajib berformat PDF, JPG, JPEG, atau PNG.',
            'file_dokumen.max' => 'Ukuran file maksimal 10MB.',
        ]);

        $path = $this->simpanFileDokumen($request, $kategori);

        $createData = [
            'kategori' => $kategori,
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
            'file_dokumen' => $path,
        ];

        if ($kategori === 'sotk' && $request->filled('sub_kategori')) {
            $createData['sub_kategori'] = $request->sub_kategori;
            $createData['urutan'] = $this->hitungUrutanSotk($request->sub_kategori, $request->pos_pelayanan);
        }

        ProfilInstansi::create($createData);

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
            'file_dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'file_dokumen_base64' => 'nullable|string',
            'file_dokumen_name' => 'nullable|string|max:255',
        ], [
            'judul.required' => 'Judul wajib diisi.',
            'file_dokumen.uploaded' => 'Ukuran file melebihi batas upload server PHP. Silakan unggah ulang.',
            'file_dokumen.mimes' => 'File pengganti wajib berformat PDF, JPG, JPEG, atau PNG.',
            'file_dokumen.max' => 'Ukuran file maksimal 10MB.',
        ]);

        $dataUpdate = [
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
        ];

        if ($kategori === 'sotk' && $request->filled('sub_kategori')) {
            $dataUpdate['sub_kategori'] = $request->sub_kategori;
            $dataUpdate['urutan'] = $this->hitungUrutanSotk($request->sub_kategori, $request->pos_pelayanan);
        }

        $newPath = $this->simpanFileDokumen($request, $kategori);
        if ($newPath !== null) {
            if ($item->file_dokumen && Storage::disk('public')->exists($item->file_dokumen)) {
                Storage::disk('public')->delete($item->file_dokumen);
            }
            $dataUpdate['file_dokumen'] = $newPath;
        }

        $item->update($dataUpdate);

        return redirect()->route('internal.profil-instansi.index', $kategori)
            ->with('success', "Data {$judulKategori} berhasil diperbarui.");
    }

    /**
     * Hitung urutan kontainer SOTK (1 s/d 12) berdasarkan sub kategori & pilihan pos pelayanan
     */
    private function hitungUrutanSotk(?string $subKategori, ?string $posPelayanan): int
    {
        $urutanMap = [
            'dinas' => 1,
            'komando' => 2,
            'sekretariat' => 3,
            'bidang_pencegahan' => 4,
            'bidang_sapra' => 5,
            'bidang_damtan' => 6,
        ];

        $posUrutanMap = [
            'Alam Barajo' => 7,
            'Paal Merah' => 8,
            'Jambi Kota Seberang' => 9,
            'Jambi Timur' => 10,
            'Kota Baru' => 11,
            'Pelayangan' => 12,
        ];

        if ($subKategori === 'pos_pelayanan') {
            return $posUrutanMap[$posPelayanan] ?? 7;
        }

        return $urutanMap[$subKategori] ?? 1;
    }

    /**
     * Simpan file dokumen baik dari multipart file maupun fallback base64 (ketika upload_max_filesize PHP kecil)
     */
    private function simpanFileDokumen(Request $request, string $kategori): ?string
    {
        if ($request->hasFile('file_dokumen')) {
            return $request->file('file_dokumen')->store("profil-instansi/{$kategori}", 'public');
        }

        if (! $request->filled('file_dokumen_base64')) {
            return null;
        }

        $rawBase64 = (string) $request->input('file_dokumen_base64');
        if (str_contains($rawBase64, ',')) {
            [, $rawBase64] = explode(',', $rawBase64, 2);
        }

        $binary = base64_decode($rawBase64, true);
        if ($binary === false || strlen($binary) === 0) {
            abort(422, 'Format file tidak valid.');
        }

        if (strlen($binary) > 10 * 1024 * 1024) {
            abort(422, 'Ukuran file maksimal 10MB.');
        }

        $originalName = (string) $request->input('file_dokumen_name', 'dokumen.pdf');
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        if (! in_array($ext, ['pdf', 'jpg', 'jpeg', 'png'], true)) {
            abort(422, 'File wajib berformat PDF, JPG, JPEG, atau PNG.');
        }

        $filename = Str::random(40).'.'.$ext;
        $relativePath = "profil-instansi/{$kategori}/{$filename}";
        Storage::disk('public')->put($relativePath, $binary);

        return $relativePath;
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
     * Mengirimkan data dokumen (PDF/Gambar) atau JSON Base64 agar tidak dicegat oleh IDM
     */
    public function viewFile(Request $request, string $kategori, $id)
    {
        $this->cekKategori($kategori);
        $item = ProfilInstansi::where('kategori', $kategori)->findOrFail($id);

        if (! $item->file_dokumen || ! Storage::disk('public')->exists($item->file_dokumen)) {
            abort(404, 'File dokumen tidak ditemukan.');
        }

        $path = Storage::disk('public')->path($item->file_dokumen);
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION)) ?: 'pdf';
        $mime = match ($ext) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            default => 'application/pdf',
        };

        if ($request->boolean('raw')) {
            $base64 = base64_encode(file_get_contents($path));

            return response()->json([
                'judul' => $item->judul,
                'ext' => $ext,
                'mime' => $mime,
                'base64' => $base64,
            ]);
        }

        return response()->file($path, [
            'Content-Type' => $mime,
        ]);
    }

    /**
     * Mengunduh file dokumen secara resmi saat tombol Unduh diklik
     */
    public function downloadFile(string $kategori, $id)
    {
        $this->cekKategori($kategori);
        $item = ProfilInstansi::where('kategori', $kategori)->findOrFail($id);

        if (! $item->file_dokumen || ! Storage::disk('public')->exists($item->file_dokumen)) {
            abort(404, 'File dokumen tidak ditemukan.');
        }

        $ext = strtolower(pathinfo($item->file_dokumen, PATHINFO_EXTENSION)) ?: 'pdf';
        $mime = match ($ext) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            default => 'application/pdf',
        };
        $filename = Str::slug($item->judul).'.'.$ext;

        return Storage::disk('public')->download($item->file_dokumen, $filename, [
            'Content-Type' => $mime,
        ]);
    }

    /**
     * Memperbarui file gambaran besar / infografis visual untuk kategori profil tertentu
     */
    public function updateGambaranBesar(Request $request, string $kategori)
    {
        $this->pastikanAksesCrud();
        $judulKategori = $this->cekKategori($kategori);

        if ($request->filled('gambar_base64')) {
            $request->validate([
                'gambar_base64' => 'required|string',
                'gambar_name' => 'required|string|max:255',
            ]);

            $rawBase64 = (string) $request->input('gambar_base64');
            if (str_contains($rawBase64, ',')) {
                [, $rawBase64] = explode(',', $rawBase64, 2);
            }

            $binary = base64_decode($rawBase64, true);
            if ($binary === false || strlen($binary) === 0) {
                return back()->with('error', 'Format file gambar tidak valid.');
            }

            if (strlen($binary) > 10 * 1024 * 1024) {
                return back()->with('error', 'Ukuran gambar maksimal 10MB.');
            }

            $originalName = (string) $request->input('gambar_name', 'gambaran-besar.jpg');
            $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
            if (! in_array($ext, ['jpg', 'jpeg', 'png', 'webp'], true)) {
                return back()->with('error', 'File wajib berformat JPG, JPEG, PNG, atau WEBP.');
            }

            $dir = "profil-instansi/{$kategori}";
            if (! Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }

            foreach (Storage::disk('public')->files($dir) as $file) {
                if (str_starts_with(basename($file), "gambaran-besar-{$kategori}.")) {
                    Storage::disk('public')->delete($file);
                }
            }

            $targetName = "gambaran-besar-{$kategori}.{$ext}";
            Storage::disk('public')->put("{$dir}/{$targetName}", $binary);

            return back()->with('success', "Gambaran besar {$judulKategori} berhasil diperbarui.");
        }

        $request->validate([
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
        ], [
            'gambar.required' => 'File gambar wajib dipilih.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'gambar.max' => 'Ukuran gambar maksimal 10MB.',
            'gambar.uploaded' => 'Ukuran file melebihi batas upload server PHP. Silakan unggah ulang.',
        ]);

        $ext = strtolower($request->file('gambar')->getClientOriginalExtension()) ?: 'jpg';
        $dir = "profil-instansi/{$kategori}";

        if (! Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }

        foreach (Storage::disk('public')->files($dir) as $file) {
            if (str_starts_with(basename($file), "gambaran-besar-{$kategori}.")) {
                Storage::disk('public')->delete($file);
            }
        }

        $targetName = "gambaran-besar-{$kategori}.{$ext}";
        $request->file('gambar')->storeAs($dir, $targetName, 'public');

        return back()->with('success', "Gambaran besar {$judulKategori} berhasil diperbarui.");
    }
}

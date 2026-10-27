<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProgramKerjaController extends Controller
{
    // 1. Menampilkan Halaman Dashboard CRUD dengan Fitur Filter
    public function index(Request $request)
    {
        $query = Dokumen::where('kategori', 'SOP');

        // Filter berdasarkan sub_kategori jika dipilih
        if ($request->filled('sub_kategori')) {
            $query->where('sub_kategori', $request->sub_kategori);
        }

        $dokumen = $query->latest()->get();

        return view('internal.program-kerja.index', compact('dokumen'));
    }

    // 2. Menyimpan Data dan Upload File Baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_dokumen' => 'required|string|max:255',
            'kategori' => 'required|in:SOTK,SOP,Perencanaan,Pelaporan,Produk Hukum',
            'sub_kategori' => 'required|in:Pencegahan,Pemadaman Kebakaran,Penyelamatan dan Evakuasi,Sarana dan Prasarana,Kepegawaian,Keuangan',
            'file_dokumen' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Cek kembali form isian Anda. Pastikan file valid.');
        }

        try {
            $file = $request->file('file_dokumen');

            $namaFileAsli = str_replace([' ', '#', '%', '&'], '_', $file->getClientOriginalName());
            $namaFile = time().'_'.$namaFileAsli;

            $tujuan_upload = storage_path('app/public/dokumen');

            if (! file_exists($tujuan_upload)) {
                mkdir($tujuan_upload, 0755, true);
            }

            $file->move($tujuan_upload, $namaFile);

            Dokumen::create([
                'judul_dokumen' => $request->judul_dokumen,
                'kategori' => $request->kategori,
                'sub_kategori' => $request->kategori === 'SOP' ? $request->sub_kategori : null,
                'nama_file' => $namaFile,
            ]);

            return redirect()->back()->with('success', 'Dokumen SOP berhasil diunggah dan disimpan!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal sistem: '.$e->getMessage());
        }
    }

    // 3. Memperbarui Data dan File (Method untuk Modal Edit)
    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'judul_dokumen' => 'required|string|max:255',
            'kategori' => 'required|in:SOTK,SOP,Perencanaan,Pelaporan,Produk Hukum',
            'sub_kategori' => 'required|in:Pencegahan,Pemadaman Kebakaran,Penyelamatan dan Evakuasi,Sarana dan Prasarana,Kepegawaian,Keuangan',
            'file_dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Cek kembali form pembaruan Anda. Pastikan file valid.');
        }

        try {
            $dataUpdate = [
                'judul_dokumen' => $request->judul_dokumen,
                'kategori' => $request->kategori,
                'sub_kategori' => $request->kategori === 'SOP' ? $request->sub_kategori : null,
            ];

            // Jika user mengunggah file baru
            if ($request->hasFile('file_dokumen')) {
                $file = $request->file('file_dokumen');

                $namaFileAsli = str_replace([' ', '#', '%', '&'], '_', $file->getClientOriginalName());
                $namaFile = time().'_'.$namaFileAsli;

                $tujuan_upload = storage_path('app/public/dokumen');

                if (! file_exists($tujuan_upload)) {
                    mkdir($tujuan_upload, 0755, true);
                }

                // Pindahkan file baru
                $file->move($tujuan_upload, $namaFile);

                // Hapus file fisik lama jika ada
                if ($dokumen->nama_file && Storage::disk('public')->exists('dokumen/'.$dokumen->nama_file)) {
                    Storage::disk('public')->delete('dokumen/'.$dokumen->nama_file);
                }

                $dataUpdate['nama_file'] = $namaFile;
            }

            $dokumen->update($dataUpdate);

            return redirect()->back()->with('success', 'Dokumen SOP berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui sistem: '.$e->getMessage());
        }
    }

    // 4. Menghapus Data
    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        if ($dokumen->nama_file && Storage::disk('public')->exists('dokumen/'.$dokumen->nama_file)) {
            Storage::disk('public')->delete('dokumen/'.$dokumen->nama_file);
        }

        $dokumen->delete();

        return redirect()->back()->with('success', 'Dokumen beserta filenya berhasil dihapus!');
    }

    private function resolveFilePath(?string $namaFile): ?string
    {
        if (! $namaFile) {
            return null;
        }

        $candidates = [
            storage_path('app/public/dokumen/'.$namaFile),
            storage_path('app/public/sop/'.$namaFile),
            public_path('storage/dokumen/'.$namaFile),
            public_path('storage/sop/'.$namaFile),
            public_path('dokumen/'.$namaFile),
            public_path('sop/'.$namaFile),
        ];

        foreach ($candidates as $cand) {
            if (file_exists($cand)) {
                return $cand;
            }
        }

        return null;
    }

    // 5. Buka / Lihat File (Publik)
    public function viewFile($id)
    {
        $dokumen = Dokumen::find($id);

        if (! $dokumen) {
            return response('MOHON MAAF: Data dokumen tidak ditemukan di Database!', 404);
        }

        $path = $this->resolveFilePath($dokumen->nama_file);

        if (! $path) {
            return response('ERROR DETEKTOR: Data di database ada, TAPI file fisiknya HILANG di dalam folder. Sistem mencari file: '.$dokumen->nama_file.' di folder storage/app/public/dokumen/ atau public/storage/sop/', 404);
        }

        return response()->file($path);
    }

    // 6. Download File (Publik)
    public function download($id)
    {
        $dokumen = Dokumen::find($id);

        if (! $dokumen) {
            return response('MOHON MAAF: Data dokumen tidak ditemukan di Database!', 404);
        }

        $path = $this->resolveFilePath($dokumen->nama_file);

        if (! $path) {
            return response('ERROR DETEKTOR: Tidak bisa diunduh karena file fisiknya HILANG di dalam folder untuk file: '.$dokumen->nama_file, 404);
        }

        return response()->download($path);
    }

    // 7. Tampilan Publik untuk 6 Bagian SOP
    public function publicSop(string $subKategori)
    {
        $map = [
            'pencegahan' => ['view' => 'public.sop.pencegahan',   'sub' => 'Pencegahan'],
            'pemadaman' => ['view' => 'public.sop.pemadaman',    'sub' => 'Pemadaman Kebakaran'],
            'penyelamatan' => ['view' => 'public.sop.penyelamatan', 'sub' => 'Penyelamatan dan Evakuasi'],
            'sarpras' => ['view' => 'public.sop.sarpras',      'sub' => 'Sarana dan Prasarana'],
            'kepegawaian' => ['view' => 'public.sop.kepegawaian',  'sub' => 'Kepegawaian'],
            'keuangan' => ['view' => 'public.sop.keuangan',     'sub' => 'Keuangan'],
        ];

        if (! isset($map[$subKategori])) {
            abort(404);
        }

        $info = $map[$subKategori];
        $dokumenDB = Dokumen::where('kategori', 'SOP')
            ->where('sub_kategori', $info['sub'])
            ->get();

        $dokumen_list = [];
        foreach ($dokumenDB as $doc) {
            $dokumen_list[] = [
                'judul' => $doc->judul_dokumen,
                'url' => url('/dokumen/view/'.$doc->id),
                'url_download' => url('/dokumen/download/'.$doc->id),
                'ext' => pathinfo($doc->nama_file, PATHINFO_EXTENSION) ?: 'PDF',
            ];
        }

        return view($info['view'], compact('dokumen_list'));
    }
}

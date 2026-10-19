<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\DiklatF1;
use App\Models\DiklatF2;
use App\Models\DiklatInspektur;
use App\Models\DiklatMfr;
use App\Models\DiklatRescue;
use App\Models\DiklatOperator;
use App\Models\DiklatPpl;
use App\Models\InspeksiBangunan;
use App\Models\FireDrill;
use App\Models\PelatihanKeluarga;

class PencegahanController extends Controller
{
    // ==========================================
    // BAGIAN PENINGKATAN KAPASITAS (DIKLAT)
    // ==========================================
    public function indexDiksar()
    {
        // Pastikan nama tabel lu bener 'tbl_diksar'
        $data_diklat = DB::table('tbl_diksar')->orderBy('id', 'desc')->get();
        $judul_diklat = "DIKSAR";
        
        return view('internal.pencegahan.diksar', compact('data_diklat', 'judul_diklat'));
    }
    
    public function indexDiklatF1()
    {
        $data_diklat = DB::table('tbl_diklat_f1')->orderBy('id', 'desc')->get();
        $judul_diklat = "DIKLAT F1";
        return view('internal.pencegahan.diklat_f1', compact('data_diklat', 'judul_diklat'));
    }

    public function indexDiklatF2()
    {
        $data_diklat = DB::table('tbl_diklat_f2')->orderBy('id', 'desc')->get();
        $judul_diklat = "DIKLAT F2";
        return view('internal.pencegahan.diklat_f1', compact('data_diklat', 'judul_diklat'));
    }

    public function indexDiklatInspektur()
    {
        $data_diklat = DB::table('tbl_diklat_inspektur')->orderBy('id', 'desc')->get();
        $judul_diklat = "DIKLAT INSPEKTUR";
        return view('internal.pencegahan.diklat_f1', compact('data_diklat', 'judul_diklat'));
    }

    public function indexDiklatMfr()
    {
        $data_diklat = DB::table('tbl_diklat_mfr')->orderBy('id', 'desc')->get();
        $judul_diklat = "DIKLAT MFR";
        return view('internal.pencegahan.diklat_f1', compact('data_diklat', 'judul_diklat'));
    }

    public function indexDiklatRescue()
    {
        $data_diklat = DB::table('tbl_diklat_rescue')->orderBy('id', 'desc')->get();
        $judul_diklat = "DIKLAT RESCUE";
        return view('internal.pencegahan.diklat_f1', compact('data_diklat', 'judul_diklat'));
    }

    public function indexDiklatOperator()
    {
        $data_diklat = DB::table('tbl_diklat_operator')->orderBy('id', 'desc')->get();
        $judul_diklat = "DIKLAT OPERATOR";
        return view('internal.pencegahan.diklat_f1', compact('data_diklat', 'judul_diklat'));
    }

    public function indexDiklatPpl()
    {
        $data_diklat = DB::table('tbl_diklat_ppl')->orderBy('id', 'desc')->get();
        $judul_diklat = "DIKLAT PPL";
        return view('internal.pencegahan.diklat_f1', compact('data_diklat', 'judul_diklat'));
    }
    
    public function indexPeningkatanKapasitas()
    {
        $dataDiksar    = \Illuminate\Support\Facades\Schema::hasTable('tbl_diksar') ? DB::table('tbl_diksar')->orderBy('id', 'desc')->get() : [];
        $dataF1        = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_f1') ? DB::table('tbl_diklat_f1')->orderBy('id', 'desc')->get() : [];
        $dataF2        = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_f2') ? DB::table('tbl_diklat_f2')->orderBy('id', 'desc')->get() : [];
        $dataInspektur = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_inspektur') ? DB::table('tbl_diklat_inspektur')->orderBy('id', 'desc')->get() : [];
        $dataMfr       = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_mfr') ? DB::table('tbl_diklat_mfr')->orderBy('id', 'desc')->get() : [];
        $dataRescue    = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_rescue') ? DB::table('tbl_diklat_rescue')->orderBy('id', 'desc')->get() : [];
        $dataOperator  = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_operator') ? DB::table('tbl_diklat_operator')->orderBy('id', 'desc')->get() : [];
        $dataPpl       = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_ppl') ? DB::table('tbl_diklat_ppl')->orderBy('id', 'desc')->get() : [];

        return view('internal.pencegahan.peningkatan_kapasitas', compact(
            'dataDiksar', 'dataF1', 'dataF2', 'dataInspektur', 'dataMfr', 'dataRescue', 'dataOperator', 'dataPpl'
        ));
    }

    public function createDiklat(Request $request)
    {
        $jenis = $request->query('jenis');
        return view('internal.pencegahan.tambah_diklat', compact('jenis'));
    }

    public function storeDiklat(Request $request)
    {
        $jenis = strtoupper($request->jenis_diklat);
        $tabel_tujuan = 'tbl_diklat_f1'; // Default
        
        if ($jenis == 'DIKSAR') { $tabel_tujuan = 'tbl_diksar'; }
        elseif ($jenis == 'DIKLAT F1') { $tabel_tujuan = 'tbl_diklat_f1'; }
        elseif ($jenis == 'DIKLAT F2') { $tabel_tujuan = 'tbl_diklat_f2'; }
        elseif ($jenis == 'DIKLAT RESCUE') { $tabel_tujuan = 'tbl_diklat_rescue'; }
        elseif ($jenis == 'DIKLAT MFR') { $tabel_tujuan = 'tbl_diklat_mfr'; }
        elseif ($jenis == 'DIKLAT OPERATOR') { $tabel_tujuan = 'tbl_diklat_operator'; }
        elseif ($jenis == 'DIKLAT INSPEKTUR') { $tabel_tujuan = 'tbl_diklat_inspektur'; }
        elseif ($jenis == 'DIKLAT PPL') { $tabel_tujuan = 'tbl_diklat_ppl'; }

        $data = [
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jabatan' => $request->jabatan,
            'instansi' => $request->instansi_daerah ?? $request->instansi,
            'jenis_diklat' => $request->jenis_diklat,
            'instansi_penyelenggara' => $request->penyelenggara ?? $request->instansi_penyelenggara,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'tanggal_pelaksanaan' => $request->tgl_pelaksanaan ?? $request->tanggal_pelaksanaan,
            'nomor_sertifikat' => $request->nomor_sertifikat,
            'ditandatangani_oleh' => $request->ditanda_tangani ?? $request->ditandatangani_oleh,
            'jumlah_jam_pelajaran' => $request->jumlah_jp ?? $request->jumlah_jam_pelajaran,
            'kode_verifikasi' => $request->kode_verifikasi,
            'persentasi_penilaian' => $request->persentase_penilaian ?? $request->persentasi_penilaian,
            'ket' => $request->keterangan ?? $request->ket,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table($tabel_tujuan)->insert($data);
        return redirect('/internal/pencegahan/peningkatan-kapasitas')->with('success', 'Data Peningkatan Kapasitas berhasil ditambahkan!');
    }

    // ==========================================
    // FUNGSI DOWNLOAD EXCEL & PDF (DIKLAT)
    // ==========================================
    public function cetakExcel($jenis)
    {
        $map = [
            'diksar' => 'tbl_diksar', 
            'diklat-f1' => 'tbl_diklat_f1', 
            'diklat-f2' => 'tbl_diklat_f2', 
            'diklat-rescue' => 'tbl_diklat_rescue', 
            'diklat-mfr' => 'tbl_diklat_mfr', 
            'diklat-operator' => 'tbl_diklat_operator', 
            'diklat-inspektur' => 'tbl_diklat_inspektur', 
            'diklat-ppl' => 'tbl_diklat_ppl'
        ];
        $tabel = $map[$jenis] ?? 'tbl_diklat_f1';
        $data = DB::table($tabel)->orderBy('id', 'desc')->get();

        $filename = "Data_" . strtoupper(str_replace('-', '_', $jenis)) . "_" . date('Ymd') . ".csv";
        
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['NO', 'NAMA', 'TEMPAT LAHIR', 'TGL LAHIR', 'NIK', 'JABATAN', 'INSTANSI', 'DITANDA TANGANI OLEH', 'TANGGAL'];

        $callback = function() use($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($data as $index => $row) {
                fputcsv($file, [
                    $index + 1,
                    $row->nama ?? '-',
                    $row->tempat_lahir ?? '-',
                    $row->tgl_lahir ?? '-',
                    $row->nik ?? '-',
                    $row->jabatan ?? '-',
                    $row->instansi ?? '-',
                    $row->ditandatangani_oleh ?? '-',
                    $row->tanggal_pelaksanaan ?? '-'
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function cetakPdf($jenis)
    {
        $map = [
            'diksar' => 'tbl_diksar', 
            'diklat-f1' => 'tbl_diklat_f1', 
            'diklat-f2' => 'tbl_diklat_f2', 
            'diklat-rescue' => 'tbl_diklat_rescue', 
            'diklat-mfr' => 'tbl_diklat_mfr', 
            'diklat-operator' => 'tbl_diklat_operator', 
            'diklat-inspektur' => 'tbl_diklat_inspektur', 
            'diklat-ppl' => 'tbl_diklat_ppl'
        ];
        $tabel = $map[$jenis] ?? 'tbl_diklat_f1';
        $data = DB::table($tabel)->orderBy('id', 'asc')->get();
        
        $judul = strtoupper(str_replace('-', ' ', $jenis));

        return view('internal.pencegahan.cetak_pdf_diklat', compact('data', 'judul'));
    }


    // ==========================================
    // BAGIAN INSPEKSI BANGUNAN
    // ==========================================
    public function index()
    {
        // Ambil semua data untuk ditampilin di tabel
        $data_inspeksi = InspeksiBangunan::orderBy('tanggal_inspeksi', 'desc')->get();
        
        // Hitung total data untuk kotak "Semua Data"
        $total_inspeksi = InspeksiBangunan::count();
        $total_fire_drill = FireDrill::count(); 

        return view('internal.pencegahan.inspeksi_bangunan', compact('data_inspeksi', 'total_inspeksi', 'total_fire_drill'));
    }
    public function indexInspeksiBangunan()
    {
        $data_inspeksi = InspeksiBangunan::all();
        return view('internal.pencegahan.inspeksi_bangunan', compact('data_inspeksi'));
    }

    public function create()
    {
        return view('internal.pencegahan.tambah_inspeksi_bangunan');
    }

    public function store(Request $request)
    {
        $inspeksi = new InspeksiBangunan();
        $inspeksi->nama_tempat = $request->nama_tempat;
        $inspeksi->jenis_usaha = $request->jenis_usaha;
        $inspeksi->tanggal_inspeksi = $request->tanggal_inspeksi;

        // 1. Upload Surat Perintah Tugas
        if ($request->hasFile('surat_perintah_tugas')) {
            $file = $request->file('surat_perintah_tugas');
            $nama_file = time() . '_spt.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/inspeksi'), $nama_file);
            $inspeksi->surat_perintah_tugas = $nama_file;
        }

        // 2. Upload Berita Acara
        if ($request->hasFile('berita_acara')) {
            $file = $request->file('berita_acara');
            $nama_file = time() . '_ba.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/inspeksi'), $nama_file);
            $inspeksi->berita_acara = $nama_file;
        }

        // 3. Upload Hasil Penilaian
        if ($request->hasFile('hasil_penilaian')) {
            $file = $request->file('hasil_penilaian');
            $nama_file = time() . '_nilai.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/inspeksi'), $nama_file);
            $inspeksi->hasil_penilaian = $nama_file;
        }

        // 4. Upload Rekomendasi
        if ($request->hasFile('rekomendasi')) {
            $file = $request->file('rekomendasi');
            $nama_file = time() . '_rekom.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/inspeksi'), $nama_file);
            $inspeksi->rekomendasi = $nama_file;
        }

        // 5. Upload SKK
        if ($request->hasFile('skk')) {
            $file = $request->file('skk');
            $nama_file = time() . '_skk.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/inspeksi'), $nama_file);
            $inspeksi->skk = $nama_file;
        }

        $inspeksi->save();

        return redirect('/internal/pencegahan/inspeksi-kebakaran/bangunan')->with('success', 'Data berhasil ditambahkan!');
    }

    public function editInspeksiBangunan($id)
    {
        $item = InspeksiBangunan::findOrFail($id);
        return view('internal.pencegahan.edit_inspeksi_bangunan', compact('item'));
    }

    public function updateInspeksiBangunan(Request $request, $id)
    {
        // Cari data berdasarkan ID
        $inspeksi = InspeksiBangunan::find($id); 
        
        $inspeksi->nama_tempat = $request->nama_tempat;
        $inspeksi->jenis_usaha = $request->jenis_usaha;
        $inspeksi->tanggal_inspeksi = $request->tanggal_inspeksi;

        // 1. Upload Surat Perintah Tugas
        if ($request->hasFile('surat_perintah_tugas')) {
            $file = $request->file('surat_perintah_tugas');
            $nama_file = time() . '_spt.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/inspeksi'), $nama_file);
            $inspeksi->surat_perintah_tugas = $nama_file;
        }

        // 2. Upload Berita Acara
        if ($request->hasFile('berita_acara')) {
            $file = $request->file('berita_acara');
            $nama_file = time() . '_ba.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/inspeksi'), $nama_file);
            $inspeksi->berita_acara = $nama_file;
        }

        // 3. Upload Hasil Penilaian
        if ($request->hasFile('hasil_penilaian')) {
            $file = $request->file('hasil_penilaian');
            $nama_file = time() . '_nilai.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/inspeksi'), $nama_file);
            $inspeksi->hasil_penilaian = $nama_file;
        }

        // 4. Upload Rekomendasi
        if ($request->hasFile('rekomendasi')) {
            $file = $request->file('rekomendasi');
            $nama_file = time() . '_rekom.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/inspeksi'), $nama_file);
            $inspeksi->rekomendasi = $nama_file;
        }

        // 5. Upload SKK
        if ($request->hasFile('skk')) {
            $file = $request->file('skk');
            $nama_file = time() . '_skk.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/inspeksi'), $nama_file);
            $inspeksi->skk = $nama_file;
        }

        $inspeksi->save();

        return redirect('/internal/pencegahan/inspeksi-kebakaran/bangunan')->with('success', 'Data berhasil diupdate!');
    }

    public function destroyInspeksiBangunan($id)
    {
        $item = InspeksiBangunan::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    // ==========================================
    // BAGIAN FIRE DRILL
    // ==========================================
   // ==========================================
    // BAGIAN FIRE DRILL (REVISI DINAMIS & PESERTA)
    // ==========================================
    public function indexFireDrill()
    {
        // Urutkan dari tahun terbaru dan ID terbaru
        $data_fire_drill = FireDrill::orderBy('tahun', 'desc')->orderBy('id', 'desc')->get();
        
        // Ambil daftar tahun & instansi unik untuk dropdown filter
        $daftar_tahun = $data_fire_drill->pluck('tahun')->unique()->sortDesc()->values();
        $daftar_instansi = $data_fire_drill->pluck('nama_instansi')->unique()->sort()->values();

        return view('internal.pencegahan.fire_drill', compact('data_fire_drill', 'daftar_tahun', 'daftar_instansi'));
    }

    public function createFireDrill()
    {
        return view('internal.pencegahan.tambah_fire_drill');
    }

    public function storeFireDrill(Request $request)
    {
        // Bersihkan daftar nama peserta per baris (jika diisi)
        $listLaki = $this->bersihkanDaftarNama($request->nama_peserta_laki_laki);
        $listPerempuan = $this->bersihkanDaftarNama($request->nama_peserta_perempuan);

        // Jika daftar nama diisi, jumlah otomatis mengikuti banyaknya nama (atau pakai input angka jika kosong)
        $jmlLaki = count($listLaki) > 0 ? count($listLaki) : (int) ($request->peserta_laki_laki ?? 0);
        $jmlPerempuan = count($listPerempuan) > 0 ? count($listPerempuan) : (int) ($request->peserta_perempuan ?? 0);
        
        // Jika hanya mengisi total_peserta (seperti data arsip 2023-2024)
        $total = ($jmlLaki + $jmlPerempuan) > 0 
            ? ($jmlLaki + $jmlPerempuan) 
            : (int) ($request->total_peserta ?? 0);

        FireDrill::create([
            'nama_instansi'          => $request->nama_instansi,
            'tahun'                  => $request->tahun,
            'tanggal_pelaksanaan'    => $request->tanggal_pelaksanaan,
            'tempat_pelaksanaan'     => $request->tempat_pelaksanaan,
            'peserta_laki_laki'      => $jmlLaki,
            'peserta_perempuan'      => $jmlPerempuan,
            'nama_peserta_laki_laki' => count($listLaki) > 0 ? implode("\n", $listLaki) : null,
            'nama_peserta_perempuan' => count($listPerempuan) > 0 ? implode("\n", $listPerempuan) : null,
            'total_peserta'          => $total,
        ]);

        return redirect('/internal/pencegahan/inspeksi-kebakaran/fire-drill')->with('success', 'Data Fire Drill berhasil ditambahkan!');
    }

    public function editFireDrill($id)
    {
        $item = FireDrill::findOrFail($id);
        return view('internal.pencegahan.edit_fire_drill', compact('item'));
    }

    public function updateFireDrill(Request $request, $id)
    {
        $item = FireDrill::findOrFail($id);

        $listLaki = $this->bersihkanDaftarNama($request->nama_peserta_laki_laki);
        $listPerempuan = $this->bersihkanDaftarNama($request->nama_peserta_perempuan);

        $jmlLaki = count($listLaki) > 0 ? count($listLaki) : (int) ($request->peserta_laki_laki ?? 0);
        $jmlPerempuan = count($listPerempuan) > 0 ? count($listPerempuan) : (int) ($request->peserta_perempuan ?? 0);
        
        $total = ($jmlLaki + $jmlPerempuan) > 0 
            ? ($jmlLaki + $jmlPerempuan) 
            : (int) ($request->total_peserta ?? 0);

        $item->update([
            'nama_instansi'          => $request->nama_instansi,
            'tahun'                  => $request->tahun,
            'tanggal_pelaksanaan'    => $request->tanggal_pelaksanaan,
            'tempat_pelaksanaan'     => $request->tempat_pelaksanaan,
            'peserta_laki_laki'      => $jmlLaki,
            'peserta_perempuan'      => $jmlPerempuan,
            'nama_peserta_laki_laki' => count($listLaki) > 0 ? implode("\n", $listLaki) : null,
            'nama_peserta_perempuan' => count($listPerempuan) > 0 ? implode("\n", $listPerempuan) : null,
            'total_peserta'          => $total,
        ]);

        return redirect('/internal/pencegahan/inspeksi-kebakaran/fire-drill')->with('success', 'Data Fire Drill berhasil diperbarui!');
    }

    public function destroyFireDrill($id)
    {
        $item = FireDrill::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Data Fire Drill berhasil dihapus!');
    }

    /**
     * Helper: Memecah teks textarea per baris dan menghapus penomoran awal (misal "1. Zaky" -> "Zaky")
     */
    private function bersihkanDaftarNama($rawText)
    {
        if (empty($rawText)) return [];
        return collect(preg_split('/\r\n|\r|\n/', (string) $rawText))
            ->map(function ($line) {
                // Hapus angka urutan di depan jika user mengetik "1. Zaky" agar tidak dobel saat ditampilkan
                return trim(preg_replace('/^\d+[\.\)\-\s]+/', '', trim($line)));
            })
            ->filter()
            ->values()
            ->all();
    }
    // ==========================================
    // BAGIAN PELATIHAN KELUARGA (DAMKAR GOES TO RT)
    // Dokumentasi berupa LINK (Google Drive dll), bukan upload file
    // ==========================================
    public function indexPelatihanKeluarga()
    {
        $data_pelatihan = PelatihanKeluarga::orderBy('tanggal_pelaksanaan', 'desc')->get();
        return view('internal.pencegahan.pelatihan_keluarga', compact('data_pelatihan')); 
    }

    public function createPelatihanKeluarga()
    {
        return view('internal.pencegahan.tambah_pelatihan_keluarga'); 
    }

    public function storePelatihanKeluarga(Request $request)
    {
        $validated = $request->validate([
            'tanggal_pelaksanaan' => 'required|date',
            'kecamatan'           => 'required|string|max:100',
            'kelurahan'           => 'required|string|max:100',
            'rt'                  => 'required|string|max:255',
            'peserta_perempuan'   => 'required|integer|min:0',
            'peserta_laki_laki'   => 'required|integer|min:0',
            'link_dokumentasi'    => 'nullable|string|max:3000',
        ]);

        $links = $this->parseLinkDokumentasi($request->input('link_dokumentasi'));
        if ($links === false) {
            return back()->withInput()->withErrors([
                'link_dokumentasi' => 'Ada link yang tidak valid. Setiap link harus diawali http:// atau https://',
            ]);
        }

        $validated['link_dokumentasi'] = $links;

        PelatihanKeluarga::create($validated);

        return redirect()->route('pelatihan_keluarga.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function editPelatihanKeluarga($id)
    {
        $item = PelatihanKeluarga::findOrFail($id);
        return view('internal.pencegahan.edit_pelatihan_keluarga', compact('item')); 
    }

    public function updatePelatihanKeluarga(Request $request, $id)
    {
        $item = PelatihanKeluarga::findOrFail($id);

        $validated = $request->validate([
            'tanggal_pelaksanaan' => 'required|date',
            'kecamatan'           => 'required|string|max:100',
            'kelurahan'           => 'required|string|max:100',
            'rt'                  => 'required|string|max:255',
            'peserta_perempuan'   => 'required|integer|min:0',
            'peserta_laki_laki'   => 'required|integer|min:0',
            'link_dokumentasi'    => 'nullable|string|max:3000',
        ]);

        $links = $this->parseLinkDokumentasi($request->input('link_dokumentasi'));
        if ($links === false) {
            return back()->withInput()->withErrors([
                'link_dokumentasi' => 'Ada link yang tidak valid. Setiap link harus diawali http:// atau https://',
            ]);
        }

        $validated['link_dokumentasi'] = $links;

        $item->update($validated);

        return redirect()->route('pelatihan_keluarga.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroyPelatihanKeluarga($id)
    {
        $item = PelatihanKeluarga::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    /**
     * Pecah input link per baris.
     * Return: string (dipisah baris baru), null kalau kosong, atau false kalau ada link tidak valid.
     */
    private function parseLinkDokumentasi($raw)
    {
        $links = collect(preg_split('/\r\n|\r|\n/', (string) $raw))
            ->map(fn ($l) => trim($l))
            ->filter()
            ->values();

        foreach ($links as $l) {
            if (!preg_match('#^https?://#i', $l) || !filter_var($l, FILTER_VALIDATE_URL)) {
                return false;
            }
        }

        return $links->isEmpty() ? null : $links->implode("\n");
    }

    // ==========================================
    // FUNGSI DOWNLOAD EXCEL & PDF (INSPEKSI BANGUNAN)
    // ==========================================
    public function cetakExcelInspeksi()
    {
        $data = InspeksiBangunan::orderBy('tanggal_inspeksi', 'desc')->get();
        $filename = "Data_Inspeksi_Bangunan_" . date('Ymd') . ".csv";
        
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['NO', 'NAMA TEMPAT/BANGUNAN', 'TANGGAL INSPEKSI', 'JENIS USAHA'];

        $callback = function() use($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($data as $index => $row) {
                fputcsv($file, [
                    $index + 1,
                    $row->nama_tempat ?? '-',
                    $row->tanggal_inspeksi ?? '-',
                    $row->jenis_usaha ?? '-'
                ]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function cetakPdfInspeksi()
    {
        $data = InspeksiBangunan::orderBy('tanggal_inspeksi', 'asc')->get();
        return view('internal.pencegahan.cetak_pdf_inspeksi', compact('data'));
    }

    // ==========================================
    // FUNGSI DOWNLOAD EXCEL & PDF (FIRE DRILL)
    // ==========================================
   // ==========================================
    // FUNGSI DOWNLOAD EXCEL & PDF (FIRE DRILL)
    // ==========================================
   // ==========================================
    // FUNGSI DOWNLOAD EXCEL & PDF (FIRE DRILL)
    // ==========================================
    public function cetakExcelFireDrill(Request $request)
    {
        $tahunDipilih = $request->query('tahun');
        $instansiDipilih = $request->query('instansi');

        // Urutkan tahun dari terlama ke terbaru (2023, 2024, 2025, 2026) seperti Sheet1 Excel asli
        $query = FireDrill::orderBy('tahun', 'asc')->orderBy('id', 'asc');

        if (!empty($tahunDipilih)) {
            $query->where('tahun', $tahunDipilih);
        }
        if (!empty($instansiDipilih)) {
            $query->whereRaw('LOWER(nama_instansi) = ?', [strtolower($instansiDipilih)]);
        }

        $data = $query->get();
        $groupedByYear = $data->groupBy('tahun');

        $labelFile = !empty($tahunDipilih) ? "Tahun_{$tahunDipilih}" : "Semua_Tahun";
        $filename = "Data_Fire_Drill_{$labelFile}_" . date('Ymd') . ".xls";

        $headers = [
            "Content-Type"        => "application/vnd.ms-excel; charset=utf-8",
            "Content-Disposition" => "attachment; filename=\"$filename\"",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($groupedByYear, $tahunDipilih) {
            echo '<meta charset="UTF-8">';
            echo '<style>
                    table { border-collapse: collapse; font-family: Arial, sans-serif; font-size: 11pt; }
                    th, td { border: 1px solid #000000; padding: 6px 10px; }
                    .judul-utama { font-weight: bold; font-size: 12pt; text-align: center; border: none !important; }
                    .baris-kosong td { border: none !important; height: 14px; }
                    .th-abu { background-color: #d9d9d9; font-weight: bold; text-align: center; vertical-align: middle; }
                    .td-center { text-align: center; vertical-align: middle; }
                    .td-middle { vertical-align: middle; }
                    .td-top { vertical-align: top; }
                    .tr-total td { font-weight: bold; background-color: #f2f2f2; }
                  </style>';

            echo '<table>';

            if ($groupedByYear->isEmpty()) {
                echo '<tr><td colspan="5" class="judul-utama">BELUM ADA DATA FIRE DRILL</td></tr>';
            }

            $firstBlock = true;
            foreach ($groupedByYear as $tahun => $items) {
                // Cek apakah di tahun ini ada rincian Laki-laki/Perempuan atau Daftar Nama Peserta
                $adaGender = $items->contains(fn($i) => ($i->peserta_laki_laki > 0 || $i->peserta_perempuan > 0));
                $adaNamaPeserta = $items->contains(fn($i) => (!empty(trim($i->nama_peserta_laki_laki ?? '')) || !empty(trim($i->nama_peserta_perempuan ?? ''))));

                // Tentukan jumlah kolom tabel tahun ini (5 kolom untuk 2023-2024, 7 kolom untuk 2025+, 9 kolom jika ada daftar nama)
                $jmlKolom = 5;
                if ($adaGender) $jmlKolom = 7;
                if ($adaNamaPeserta) $jmlKolom = 9;

                if (!$firstBlock) {
                    echo '<tr class="baris-kosong"><td colspan="' . $jmlKolom . '"></td></tr>';
                    echo '<tr class="baris-kosong"><td colspan="' . $jmlKolom . '"></td></tr>';
                }

                // Judul Header seperti di Excel Disdamkartan
                if ($firstBlock) {
                    echo '<tr><td colspan="' . $jmlKolom . '" class="judul-utama">INSTANSI PEMERINTAH / SWASTA</td></tr>';
                    echo '<tr><td colspan="' . $jmlKolom . '" class="judul-utama">YANG MELAKSANAKAN PELATIHAN PEMADAM KEBAKARAN</td></tr>';
                }
                echo '<tr><td colspan="' . $jmlKolom . '" class="judul-utama">TAHUN ' . e($tahun) . '</td></tr>';
                echo '<tr class="baris-kosong"><td colspan="' . $jmlKolom . '"></td></tr>';

                // Header Kolom Tabel
                if (!$adaGender && !$adaNamaPeserta) {
                    // Format 5 Kolom (Persis Tahun 2023 & 2024 di Excel)
                    echo '<tr class="th-abu">
                            <th width="45">NO</th>
                            <th width="340">NAMA INSTANSI</th>
                            <th width="200">TANGGAL PELAKSANAAN</th>
                            <th width="340">TEMPAT PELAKSANAAN</th>
                            <th width="140">JUMLAH PESERTA</th>
                          </tr>';
                } elseif ($adaGender && !$adaNamaPeserta) {
                    // Format 7 Kolom (Persis Tahun 2025 & 2026 di Excel tanpa daftar nama individu)
                    echo '<tr class="th-abu">
                            <th width="45">NO</th>
                            <th width="320">NAMA INSTANSI</th>
                            <th width="190">TANGGAL PELAKSANAAN</th>
                            <th width="300">TEMPAT PELAKSANAAN</th>
                            <th width="100">Laki-laki</th>
                            <th width="100">Perempuan</th>
                            <th width="140">JUMLAH PESERTA</th>
                          </tr>';
                } else {
                    // Format 9 Kolom (Jika ada input daftar nama peserta Laki-laki & Perempuan)
                    echo '<tr class="th-abu">
                            <th rowspan="2" width="45">NO</th>
                            <th rowspan="2" width="280">NAMA INSTANSI</th>
                            <th rowspan="2" width="180">TANGGAL PELAKSANAAN</th>
                            <th rowspan="2" width="260">TEMPAT PELAKSANAAN</th>
                            <th colspan="3">JUMLAH PESERTA</th>
                            <th colspan="2">DAFTAR NAMA PESERTA</th>
                          </tr>
                          <tr class="th-abu">
                            <th width="90">Laki-laki</th>
                            <th width="90">Perempuan</th>
                            <th width="110">TOTAL</th>
                            <th width="220">PESERTA LAKI-LAKI</th>
                            <th width="220">PESERTA PEREMPUAN</th>
                          </tr>';
                }

                $totalLakiTahun = 0;
                $totalPerempuanTahun = 0;
                $totalPesertaTahun = 0;

                foreach ($items->values() as $idx => $item) {
                    $totalLakiTahun += (int) ($item->peserta_laki_laki ?? 0);
                    $totalPerempuanTahun += (int) ($item->peserta_perempuan ?? 0);
                    $totalPesertaTahun += (int) ($item->total_peserta ?? 0);

                    if (!$adaGender && !$adaNamaPeserta) {
                        echo '<tr>
                                <td class="td-center">' . ($idx + 1) . '</td>
                                <td class="td-middle">' . e($item->nama_instansi) . '</td>
                                <td class="td-middle">' . e($item->tanggal_pelaksanaan) . '</td>
                                <td class="td-middle">' . e($item->tempat_pelaksanaan) . '</td>
                                <td class="td-center">' . ($item->total_peserta ?: '') . '</td>
                              </tr>';
                    } elseif ($adaGender && !$adaNamaPeserta) {
                        $punyaLP = ($item->peserta_laki_laki > 0 || $item->peserta_perempuan > 0);
                        echo '<tr>
                                <td class="td-center">' . ($idx + 1) . '</td>
                                <td class="td-middle">' . e($item->nama_instansi) . '</td>
                                <td class="td-middle">' . e($item->tanggal_pelaksanaan) . '</td>
                                <td class="td-middle">' . e($item->tempat_pelaksanaan) . '</td>
                                <td class="td-center">' . ($punyaLP ? $item->peserta_laki_laki : '-') . '</td>
                                <td class="td-center">' . ($punyaLP ? $item->peserta_perempuan : '-') . '</td>
                                <td class="td-center">' . ($item->total_peserta ?: '') . '</td>
                              </tr>';
                    } else {
                        $listLaki = !empty($item->nama_peserta_laki_laki)
                            ? array_values(array_filter(preg_split('/\r\n|\r|\n/', trim($item->nama_peserta_laki_laki))))
                            : [];
                        $listPerempuan = !empty($item->nama_peserta_perempuan)
                            ? array_values(array_filter(preg_split('/\r\n|\r|\n/', trim($item->nama_peserta_perempuan))))
                            : [];
                        $punyaLP = ($item->peserta_laki_laki > 0 || $item->peserta_perempuan > 0 || count($listLaki) > 0 || count($listPerempuan) > 0);
                        $maxBaris = max(1, count($listLaki), count($listPerempuan));

                        for ($b = 0; $b < $maxBaris; $b++) {
                            echo '<tr>';
                            if ($b === 0) {
                                echo '<td rowspan="' . $maxBaris . '" class="td-center">' . ($idx + 1) . '</td>';
                                echo '<td rowspan="' . $maxBaris . '" class="td-middle">' . e($item->nama_instansi) . '</td>';
                                echo '<td rowspan="' . $maxBaris . '" class="td-middle">' . e($item->tanggal_pelaksanaan) . '</td>';
                                echo '<td rowspan="' . $maxBaris . '" class="td-middle">' . e($item->tempat_pelaksanaan) . '</td>';
                                echo '<td rowspan="' . $maxBaris . '" class="td-center">' . ($punyaLP ? ($item->peserta_laki_laki ?? 0) : '-') . '</td>';
                                echo '<td rowspan="' . $maxBaris . '" class="td-center">' . ($punyaLP ? ($item->peserta_perempuan ?? 0) : '-') . '</td>';
                                echo '<td rowspan="' . $maxBaris . '" class="td-center" style="font-weight:bold;">' . ($item->total_peserta ?? 0) . '</td>';
                            }
                            $namaL = isset($listLaki[$b]) ? (($b + 1) . '. ' . e($listLaki[$b])) : ($b === 0 && count($listLaki) === 0 ? '-' : '');
                            $namaP = isset($listPerempuan[$b]) ? (($b + 1) . '. ' . e($listPerempuan[$b])) : ($b === 0 && count($listPerempuan) === 0 ? '-' : '');
                            echo '<td class="td-top">' . $namaL . '</td>';
                            echo '<td class="td-top">' . $namaP . '</td>';
                            echo '</tr>';
                        }
                    }
                }

                // Baris JUMLAH TOTAL di bawah setiap tahun (Persis Excel Asli)
                if (!$adaGender && !$adaNamaPeserta) {
                    echo '<tr class="tr-total">
                            <td colspan="4" class="td-center">JUMLAH TOTAL</td>
                            <td class="td-center">' . $totalPesertaTahun . '</td>
                          </tr>';
                } elseif ($adaGender && !$adaNamaPeserta) {
                    echo '<tr class="tr-total">
                            <td colspan="4" class="td-center">JUMLAH TOTAL</td>
                            <td class="td-center">' . $totalLakiTahun . '</td>
                            <td class="td-center">' . $totalPerempuanTahun . '</td>
                            <td class="td-center">' . $totalPesertaTahun . '</td>
                          </tr>';
                } else {
                    echo '<tr class="tr-total">
                            <td colspan="4" class="td-center">JUMLAH TOTAL</td>
                            <td class="td-center">' . $totalLakiTahun . '</td>
                            <td class="td-center">' . $totalPerempuanTahun . '</td>
                            <td class="td-center">' . $totalPesertaTahun . '</td>
                            <td colspan="2"></td>
                          </tr>';
                }

                $firstBlock = false;
            }

            echo '</table>';
        };

        return response()->stream($callback, 200, $headers);
    }

    public function cetak(Request $request)
    {
        $tahunDipilih = $request->query('tahun');
        $instansiDipilih = $request->query('instansi');

        $query = FireDrill::orderBy('tahun', 'asc')->orderBy('id', 'asc');

        if (!empty($tahunDipilih)) {
            $query->where('tahun', $tahunDipilih);
        }
        if (!empty($instansiDipilih)) {
            $query->whereRaw('LOWER(nama_instansi) = ?', [strtolower($instansiDipilih)]);
        }

        $data = $query->get();
        $groupedByYear = $data->groupBy('tahun');

        return view('internal.pencegahan.cetak_pdf_fire_drill', compact('data', 'groupedByYear', 'tahunDipilih', 'instansiDipilih'));
    }   
}
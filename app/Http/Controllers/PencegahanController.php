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
        $data_inspeksi = InspeksiBangunan::orderBy('tanggal_inspeksi', 'desc')->get();
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

        if ($request->hasFile('surat_perintah_tugas')) {
            $file = $request->file('surat_perintah_tugas');
            $nama_file = time() . '_spt.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/inspeksi'), $nama_file);
            $inspeksi->surat_perintah_tugas = $nama_file;
        }

        if ($request->hasFile('berita_acara')) {
            $file = $request->file('berita_acara');
            $nama_file = time() . '_ba.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/inspeksi'), $nama_file);
            $inspeksi->berita_acara = $nama_file;
        }

        if ($request->hasFile('hasil_penilaian')) {
            $file = $request->file('hasil_penilaian');
            $nama_file = time() . '_nilai.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/inspeksi'), $nama_file);
            $inspeksi->hasil_penilaian = $nama_file;
        }

        if ($request->hasFile('rekomendasi')) {
            $file = $request->file('rekomendasi');
            $nama_file = time() . '_rekom.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/inspeksi'), $nama_file);
            $inspeksi->rekomendasi = $nama_file;
        }

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
        $inspeksi = InspeksiBangunan::find($id); 
        
        $inspeksi->nama_tempat = $request->nama_tempat;
        $inspeksi->jenis_usaha = $request->jenis_usaha;
        $inspeksi->tanggal_inspeksi = $request->tanggal_inspeksi;

        if ($request->hasFile('surat_perintah_tugas')) {
            $file = $request->file('surat_perintah_tugas');
            $nama_file = time() . '_spt.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/inspeksi'), $nama_file);
            $inspeksi->surat_perintah_tugas = $nama_file;
        }

        if ($request->hasFile('berita_acara')) {
            $file = $request->file('berita_acara');
            $nama_file = time() . '_ba.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/inspeksi'), $nama_file);
            $inspeksi->berita_acara = $nama_file;
        }

        if ($request->hasFile('hasil_penilaian')) {
            $file = $request->file('hasil_penilaian');
            $nama_file = time() . '_nilai.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/inspeksi'), $nama_file);
            $inspeksi->hasil_penilaian = $nama_file;
        }

        if ($request->hasFile('rekomendasi')) {
            $file = $request->file('rekomendasi');
            $nama_file = time() . '_rekom.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/inspeksi'), $nama_file);
            $inspeksi->rekomendasi = $nama_file;
        }

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
    // BAGIAN FIRE DRILL (REVISI DINAMIS & PESERTA)
    // ==========================================
    public function indexFireDrill()
    {
        // Urut tahun naik: 2023, 2024, 2025, 2026, dst.
        $data_fire_drill = FireDrill::orderBy('tahun', 'asc')->orderBy('id', 'asc')->get();
        $daftar_tahun = $data_fire_drill->pluck('tahun')->unique()->sort()->values();
        $daftar_instansi = $data_fire_drill->pluck('nama_instansi')->unique()->sort()->values();

        return view('internal.pencegahan.fire_drill', compact('data_fire_drill', 'daftar_tahun', 'daftar_instansi'));
    }

    public function createFireDrill()
    {
        return view('internal.pencegahan.tambah_fire_drill');
    }

    public function storeFireDrill(Request $request)
    {
        $listLaki = $this->bersihkanDaftarNama($request->nama_peserta_laki_laki);
        $listPerempuan = $this->bersihkanDaftarNama($request->nama_peserta_perempuan);

        $jmlLaki = count($listLaki) > 0 ? count($listLaki) : (int) ($request->peserta_laki_laki ?? 0);
        $jmlPerempuan = count($listPerempuan) > 0 ? count($listPerempuan) : (int) ($request->peserta_perempuan ?? 0);
        
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

    private function bersihkanDaftarNama($rawText)
    {
        if (empty($rawText)) return [];
        return collect(preg_split('/\r\n|\r|\n/', (string) $rawText))
            ->map(function ($line) {
                return trim(preg_replace('/^\d+[\.\)\-\s]+/', '', trim($line)));
            })
            ->filter()
            ->values()
            ->all();
    }

    // ==========================================
    // BAGIAN PELATIHAN KELUARGA (DAMKAR GOES TO RT)
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
    // FUNGSI DOWNLOAD EXCEL & PDF (FIRE DRILL - MULTI SHEET ASLI)
    // ==========================================
    public function cetakExcelFireDrill(Request $request)
    {
        $tahunDipilih = $request->query('tahun');
        $instansiDipilih = $request->query('instansi');

        $query = FireDrill::query();

        if (filled($tahunDipilih)) {
            $query->where('tahun', (int) $tahunDipilih);
        }
        if (filled($instansiDipilih)) {
            $query->whereRaw('LOWER(nama_instansi) = ?', [strtolower($instansiDipilih)]);
        }

        $data = $query->orderBy('tahun', 'asc')->orderBy('id', 'asc')->get();
        $groupedByYear = $data->groupBy('tahun')->sortKeys(); // urut 2023, 2024, 2025, 2026, ...

        $labelFile = filled($tahunDipilih) ? "Tahun_{$tahunDipilih}" : "Semua_Data_dan_Per_Tahun";
        $filename = "Data_Fire_Drill_{$labelFile}_" . date('Ymd') . ".xls";

        $headers = [
            "Content-Type"        => "application/vnd.ms-excel; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=\"$filename\"",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $esc = fn($v) => htmlspecialchars((string) $v, ENT_XML1 | ENT_QUOTES, 'UTF-8');

        // Helper membuat baris XML SpreadsheetML untuk 1 blok tahun
        $buatBarisTahunXml = function ($tahun, $items, $pakaiHeaderAtas, $modeSheet1 = false) use ($esc) {
            $adaGender = !$modeSheet1 && $items->contains(fn($i) => ($i->peserta_laki_laki > 0 || $i->peserta_perempuan > 0));
            $adaNama   = !$modeSheet1 && $items->contains(fn($i) => (!empty(trim($i->nama_peserta_laki_laki ?? '')) || !empty(trim($i->nama_peserta_perempuan ?? ''))));

            $jmlKolom = 5;
            if ($adaGender) $jmlKolom = 7;
            if ($adaNama)   $jmlKolom = 9;
            $mergeTitle = $jmlKolom - 1;

            $xml = '';
            if ($pakaiHeaderAtas) {
                $xml .= '<Row ss:Height="18"><Cell ss:MergeAcross="' . $mergeTitle . '" ss:StyleID="sTitle"><Data ss:Type="String">INSTANSI PEMERINTAH / SWASTA</Data></Cell></Row>';
                $xml .= '<Row ss:Height="18"><Cell ss:MergeAcross="' . $mergeTitle . '" ss:StyleID="sTitle"><Data ss:Type="String">YANG MELAKSANAKAN PELATIHAN PEMADAM KEBAKARAN</Data></Cell></Row>';
            }
            $xml .= '<Row ss:Height="18"><Cell ss:MergeAcross="' . $mergeTitle . '" ss:StyleID="sTitle"><Data ss:Type="String">TAHUN ' . $esc($tahun) . '</Data></Cell></Row>';
            $xml .= '<Row ss:Height="10"></Row>';

            // Header Tabel
            if (!$adaGender && !$adaNama) {
                $xml .= '<Row ss:Height="24">
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">NO</Data></Cell>
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">NAMA INSTANSI</Data></Cell>
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">TANGGAL PELAKSANAAN</Data></Cell>
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">TEMPAT PELAKSANAAN</Data></Cell>
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">JUMLAH PESERTA</Data></Cell>
                         </Row>';
            } elseif ($adaGender && !$adaNama) {
                $xml .= '<Row ss:Height="24">
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">NO</Data></Cell>
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">NAMA INSTANSI</Data></Cell>
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">TANGGAL PELAKSANAAN</Data></Cell>
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">TEMPAT PELAKSANAAN</Data></Cell>
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">Laki-laki</Data></Cell>
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">Perempuan</Data></Cell>
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">JUMLAH PESERTA</Data></Cell>
                         </Row>';
            } else {
                $xml .= '<Row ss:Height="24">
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">NO</Data></Cell>
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">NAMA INSTANSI</Data></Cell>
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">TANGGAL PELAKSANAAN</Data></Cell>
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">TEMPAT PELAKSANAAN</Data></Cell>
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">Laki-laki</Data></Cell>
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">Perempuan</Data></Cell>
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">JUMLAH PESERTA</Data></Cell>
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">DAFTAR NAMA LAKI-LAKI</Data></Cell>
                            <Cell ss:StyleID="sHead"><Data ss:Type="String">DAFTAR NAMA PEREMPUAN</Data></Cell>
                         </Row>';
            }

            $sumLaki = 0;
            $sumPerempuan = 0;
            $sumTotal = 0;

            foreach ($items->values() as $idx => $item) {
                $l = (int) ($item->peserta_laki_laki ?? 0);
                $p = (int) ($item->peserta_perempuan ?? 0);
                $t = (int) ($item->total_peserta ?? 0);
                $sumLaki += $l;
                $sumPerempuan += $p;
                $sumTotal += $t;

                if (!$adaGender && !$adaNama) {
                    $xml .= '<Row ss:AutoFitHeight="1">
                                <Cell ss:StyleID="sCenter"><Data ss:Type="Number">' . ($idx + 1) . '</Data></Cell>
                                <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($item->nama_instansi ?? '-') . '</Data></Cell>
                                <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($item->tanggal_pelaksanaan ?? '-') . '</Data></Cell>
                                <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($item->tempat_pelaksanaan ?? '-') . '</Data></Cell>
                                <Cell ss:StyleID="sCenter"><Data ss:Type="Number">' . $t . '</Data></Cell>
                             </Row>';
                } elseif ($adaGender && !$adaNama) {
                    $punyaLP = ($l > 0 || $p > 0);
                    $xml .= '<Row ss:AutoFitHeight="1">
                                <Cell ss:StyleID="sCenter"><Data ss:Type="Number">' . ($idx + 1) . '</Data></Cell>
                                <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($item->nama_instansi ?? '-') . '</Data></Cell>
                                <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($item->tanggal_pelaksanaan ?? '-') . '</Data></Cell>
                                <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($item->tempat_pelaksanaan ?? '-') . '</Data></Cell>
                                <Cell ss:StyleID="sCenter"><Data ss:Type="' . ($punyaLP ? 'Number' : 'String') . '">' . ($punyaLP ? $l : '-') . '</Data></Cell>
                                <Cell ss:StyleID="sCenter"><Data ss:Type="' . ($punyaLP ? 'Number' : 'String') . '">' . ($punyaLP ? $p : '-') . '</Data></Cell>
                                <Cell ss:StyleID="sCenter"><Data ss:Type="Number">' . $t . '</Data></Cell>
                             </Row>';
                } else {
                    $listLaki = !empty($item->nama_peserta_laki_laki)
                        ? array_values(array_filter(preg_split('/\r\n|\r|\n/', trim($item->nama_peserta_laki_laki))))
                        : [];
                    $listPerempuan = !empty($item->nama_peserta_perempuan)
                        ? array_values(array_filter(preg_split('/\r\n|\r|\n/', trim($item->nama_peserta_perempuan))))
                        : [];
                    $punyaLP = ($l > 0 || $p > 0 || count($listLaki) > 0 || count($listPerempuan) > 0);

                    $strLaki = count($listLaki) > 0
                        ? collect($listLaki)->map(fn($n, $i) => ($i + 1) . '. ' . $esc($n))->implode('&#10;')
                        : '-';
                    $strPerempuan = count($listPerempuan) > 0
                        ? collect($listPerempuan)->map(fn($n, $i) => ($i + 1) . '. ' . $esc($n))->implode('&#10;')
                        : '-';
                    $tinggiBaris = max(1, count($listLaki), count($listPerempuan)) * 16;

                    $xml .= '<Row ss:Height="' . $tinggiBaris . '">
                                <Cell ss:StyleID="sCenter"><Data ss:Type="Number">' . ($idx + 1) . '</Data></Cell>
                                <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($item->nama_instansi ?? '-') . '</Data></Cell>
                                <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($item->tanggal_pelaksanaan ?? '-') . '</Data></Cell>
                                <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($item->tempat_pelaksanaan ?? '-') . '</Data></Cell>
                                <Cell ss:StyleID="sCenter"><Data ss:Type="' . ($punyaLP ? 'Number' : 'String') . '">' . ($punyaLP ? $l : '-') . '</Data></Cell>
                                <Cell ss:StyleID="sCenter"><Data ss:Type="' . ($punyaLP ? 'Number' : 'String') . '">' . ($punyaLP ? $p : '-') . '</Data></Cell>
                                <Cell ss:StyleID="sTotalNum"><Data ss:Type="Number">' . $t . '</Data></Cell>
                                <Cell ss:StyleID="sWrapTop"><Data ss:Type="String">' . $strLaki . '</Data></Cell>
                                <Cell ss:StyleID="sWrapTop"><Data ss:Type="String">' . $strPerempuan . '</Data></Cell>
                             </Row>';
                }
            }

            // Baris JUMLAH TOTAL per tahun
            if (!$adaGender && !$adaNama) {
                $xml .= '<Row ss:Height="22">
                            <Cell ss:MergeAcross="3" ss:StyleID="sTotalLabel"><Data ss:Type="String">JUMLAH TOTAL</Data></Cell>
                            <Cell ss:StyleID="sTotalNum"><Data ss:Type="Number">' . $sumTotal . '</Data></Cell>
                         </Row>';
            } elseif ($adaGender && !$adaNama) {
                $xml .= '<Row ss:Height="22">
                            <Cell ss:MergeAcross="3" ss:StyleID="sTotalLabel"><Data ss:Type="String">JUMLAH TOTAL</Data></Cell>
                            <Cell ss:StyleID="sTotalNum"><Data ss:Type="Number">' . $sumLaki . '</Data></Cell>
                            <Cell ss:StyleID="sTotalNum"><Data ss:Type="Number">' . $sumPerempuan . '</Data></Cell>
                            <Cell ss:StyleID="sTotalNum"><Data ss:Type="Number">' . $sumTotal . '</Data></Cell>
                         </Row>';
            } else {
                $xml .= '<Row ss:Height="22">
                            <Cell ss:MergeAcross="3" ss:StyleID="sTotalLabel"><Data ss:Type="String">JUMLAH TOTAL</Data></Cell>
                            <Cell ss:StyleID="sTotalNum"><Data ss:Type="Number">' . $sumLaki . '</Data></Cell>
                            <Cell ss:StyleID="sTotalNum"><Data ss:Type="Number">' . $sumPerempuan . '</Data></Cell>
                            <Cell ss:StyleID="sTotalNum"><Data ss:Type="Number">' . $sumTotal . '</Data></Cell>
                            <Cell ss:StyleID="sTotalLabel"><Data ss:Type="String"></Data></Cell>
                            <Cell ss:StyleID="sTotalLabel"><Data ss:Type="String"></Data></Cell>
                         </Row>';
            }

            return [
                'xml' => $xml,
                'jmlKolom' => $jmlKolom,
                'sumLaki' => $sumLaki,
                'sumPerempuan' => $sumPerempuan,
                'sumTotal' => $sumTotal,
            ];
        };

        $callback = function () use ($groupedByYear, $tahunDipilih, $buatBarisTahunXml, $esc) {
            echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            echo '<?mso-application progid="Excel.Sheet"?>' . "\n";
            echo '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
                    xmlns:o="urn:schemas-microsoft-com:office:office"
                    xmlns:x="urn:schemas-microsoft-com:office:excel"
                    xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">' . "\n";

            // Definisi Styles Excel
            echo '<Styles>
                    <Style ss:ID="Default" ss:Name="Normal">
                        <Alignment ss:Vertical="Center"/>
                        <Font ss:FontName="Arial" ss:Size="10"/>
                    </Style>
                    <Style ss:ID="sTitle">
                        <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
                        <Font ss:FontName="Arial" ss:Size="12" ss:Bold="1"/>
                    </Style>
                    <Style ss:ID="sHead">
                        <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
                        <Borders>
                            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        </Borders>
                        <Font ss:FontName="Arial" ss:Size="10" ss:Bold="1"/>
                        <Interior ss:Color="#D9D9D9" ss:Pattern="Solid"/>
                    </Style>
                    <Style ss:ID="sText">
                        <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
                        <Borders>
                            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        </Borders>
                        <Font ss:FontName="Arial" ss:Size="10"/>
                    </Style>
                    <Style ss:ID="sWrapTop">
                        <Alignment ss:Horizontal="Left" ss:Vertical="Top" ss:WrapText="1"/>
                        <Borders>
                            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        </Borders>
                        <Font ss:FontName="Arial" ss:Size="10"/>
                    </Style>
                    <Style ss:ID="sCenter">
                        <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
                        <Borders>
                            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        </Borders>
                        <Font ss:FontName="Arial" ss:Size="10"/>
                    </Style>
                    <Style ss:ID="sTotalLabel">
                        <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
                        <Borders>
                            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        </Borders>
                        <Font ss:FontName="Arial" ss:Size="10" ss:Bold="1"/>
                        <Interior ss:Color="#F2F2F2" ss:Pattern="Solid"/>
                    </Style>
                    <Style ss:ID="sTotalNum">
                        <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
                        <Borders>
                            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        </Borders>
                        <Font ss:FontName="Arial" ss:Size="10" ss:Bold="1"/>
                        <Interior ss:Color="#F2F2F2" ss:Pattern="Solid"/>
                    </Style>
                    <Style ss:ID="sGrandTotal">
                        <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
                        <Borders>
                            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        </Borders>
                        <Font ss:FontName="Arial" ss:Size="10" ss:Bold="1"/>
                        <Interior ss:Color="#FFE699" ss:Pattern="Solid"/>
                    </Style>
                  </Styles>' . "\n";

            // 1. SHEET "Semua Data" (Jika Cetak Semua Tahun)
            if (!filled($tahunDipilih)) {
                echo '<Worksheet ss:Name="Semua Data"><Table>' . "\n";
                echo '<Column ss:Width="35"/>
                      <Column ss:Width="260"/>
                      <Column ss:Width="150"/>
                      <Column ss:Width="250"/>
                      <Column ss:Width="110"/>' . "\n";

                $first = true;
                $grandInstansi = 0;
                $grandPeserta = 0;

                foreach ($groupedByYear as $thn => $items) {
                    if (!$first) {
                        echo '<Row ss:Height="14"></Row>';
                    }
                    $blok = $buatBarisTahunXml($thn, $items, $first, true);
                    echo $blok['xml'];
                    $grandInstansi += $items->count();
                    $grandPeserta += $blok['sumTotal'];
                    $first = false;
                }

                // Rekap Total Keseluruhan di bawah Sheet Semua Data
                if ($groupedByYear->isNotEmpty()) {
                    echo '<Row ss:Height="16"></Row>';
                    echo '<Row ss:Height="24">
                            <Cell ss:MergeAcross="3" ss:StyleID="sGrandTotal"><Data ss:Type="String">JUMLAH TOTAL KESELURUHAN SEMUA TAHUN (' . $grandInstansi . ' INSTANSI)</Data></Cell>
                            <Cell ss:StyleID="sGrandTotal"><Data ss:Type="Number">' . $grandPeserta . '</Data></Cell>
                          </Row>';
                }

                echo '</Table></Worksheet>' . "\n";
            }

            // 2. SHEET MASING-MASING TAHUN (2023, 2024, 2025, 2026, dst.)
            foreach ($groupedByYear as $thn => $items) {
                $namaSheet = !filled($tahunDipilih) ? (string) $thn : 'Tahun ' . $thn;
                $blok = $buatBarisTahunXml($thn, $items, true, false);

                echo '<Worksheet ss:Name="' . $esc($namaSheet) . '"><Table>' . "\n";
                echo '<Column ss:Width="35"/>
                      <Column ss:Width="250"/>
                      <Column ss:Width="145"/>
                      <Column ss:Width="240"/>';
                if ($blok['jmlKolom'] === 5) {
                    echo '<Column ss:Width="110"/>';
                } elseif ($blok['jmlKolom'] === 7) {
                    echo '<Column ss:Width="80"/><Column ss:Width="80"/><Column ss:Width="110"/>';
                } else {
                    echo '<Column ss:Width="75"/><Column ss:Width="75"/><Column ss:Width="95"/><Column ss:Width="180"/><Column ss:Width="180"/>';
                }
                echo "\n" . $blok['xml'];
                echo '</Table></Worksheet>' . "\n";
            }

            // Jika database masih kosong
            if ($groupedByYear->isEmpty()) {
                echo '<Worksheet ss:Name="Data Kosong"><Table><Row><Cell><Data ss:Type="String">Belum ada data Fire Drill</Data></Cell></Row></Table></Worksheet>';
            }

            echo '</Workbook>';
        };

        return response()->stream($callback, 200, $headers);
    }

    public function cetak(Request $request)
    {
        $tahunDipilih = $request->query('tahun');
        $instansiDipilih = $request->query('instansi');

        $query = FireDrill::query();

        if (filled($tahunDipilih)) {
            $query->where('tahun', (int) $tahunDipilih);
        }
        if (filled($instansiDipilih)) {
            $query->whereRaw('LOWER(nama_instansi) = ?', [strtolower($instansiDipilih)]);
        }

        $data = $query->orderBy('tahun', 'asc')->orderBy('id', 'asc')->get();
        $groupedByYear = $data->groupBy('tahun')->sortKeys(); // urut 2023, 2024, 2025, 2026, ...

        return view('internal.pencegahan.cetak_pdf_fire_drill', compact('data', 'groupedByYear', 'tahunDipilih', 'instansiDipilih'));
    }
}
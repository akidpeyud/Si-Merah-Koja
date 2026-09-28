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
        $data_inspeksi = InspeksiBangunan::all();
        // Ubah kata 'inspeksi_kebakaran' jadi 'inspeksi_bangunan'
        return view('internal.pencegahan.inspeksi_bangunan', compact('data_inspeksi'));
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
        InspeksiBangunan::create([
            'nama_tempat'      => $request->nama_tempat,
            'tanggal_inspeksi' => $request->tanggal_inspeksi, 
            'jenis_usaha'      => $request->jenis_usaha,
        ]);

        return redirect('/internal/pencegahan/inspeksi-kebakaran/bangunan')->with('success', 'Data berhasil ditambahkan!');
    }

    public function editInspeksiBangunan($id)
    {
        $item = InspeksiBangunan::findOrFail($id);
        return view('internal.pencegahan.edit_inspeksi_bangunan', compact('item'));
    }

    public function updateInspeksiBangunan(Request $request, $id)
    {
        $item = InspeksiBangunan::findOrFail($id);
        $item->update([
            'nama_tempat' => $request->nama_tempat,
            'tanggal_inspeksi' => $request->tanggal_inspeksi,
            'jenis_usaha' => $request->jenis_usaha,
        ]);

        return redirect('/internal/pencegahan/inspeksi-kebakaran/bangunan')->with('success', 'Data berhasil diperbarui!');
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
    public function indexFireDrill()
    {
        $data_fire_drill = FireDrill::all();
        return view('internal.pencegahan.fire_drill', compact('data_fire_drill'));
    }

    public function createFireDrill()
    {
        return view('internal.pencegahan.tambah_fire_drill');
    }

    public function storeFireDrill(Request $request)
    {
        FireDrill::create([
            'nama_instansi'       => $request->nama_instansi,
            'tahun'               => $request->tahun,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'tempat_pelaksanaan'  => $request->tempat_pelaksanaan,
            'peserta_laki_laki'   => $request->peserta_laki_laki ?? 0,
            'peserta_perempuan'   => $request->peserta_perempuan ?? 0,
            'total_peserta'       => ($request->peserta_laki_laki + $request->peserta_perempuan),
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
        $item->update([
            'nama_instansi'       => $request->nama_instansi,
            'tahun'               => $request->tahun,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'tempat_pelaksanaan'  => $request->tempat_pelaksanaan,
            'peserta_laki_laki'   => $request->peserta_laki_laki ?? 0,
            'peserta_perempuan'   => $request->peserta_perempuan ?? 0,
            'total_peserta'       => ($request->peserta_laki_laki + $request->peserta_perempuan),
        ]);

        return redirect('/internal/pencegahan/inspeksi-kebakaran/fire-drill')->with('success', 'Data Fire Drill berhasil diperbarui!');
    }

    public function destroyFireDrill($id)
    {
        $item = FireDrill::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Data Fire Drill berhasil dihapus!');
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
        PelatihanKeluarga::create([
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'posyandu'            => $request->posyandu,
            'rt'                  => $request->rt,
            'kelurahan'           => $request->kelurahan,
            'kecamatan'           => $request->kecamatan,
            'peserta_perempuan'   => $request->peserta_perempuan ?? 0,
            'peserta_laki_laki'   => $request->peserta_laki_laki ?? 0,
        ]);

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
        $item->update([
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'posyandu'            => $request->posyandu,
            'rt'                  => $request->rt,
            'kelurahan'           => $request->kelurahan,
            'kecamatan'           => $request->kecamatan,
            'peserta_perempuan'   => $request->peserta_perempuan ?? 0,
            'peserta_laki_laki'   => $request->peserta_laki_laki ?? 0,
        ]);

        return redirect()->route('pelatihan_keluarga.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroyPelatihanKeluarga($id)
    {
        $item = PelatihanKeluarga::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
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
    public function cetakExcelFireDrill()
    {
        $data = FireDrill::orderBy('tanggal_pelaksanaan', 'desc')->get();
        $filename = "Data_Fire_Drill_" . date('Ymd') . ".csv";
        
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['NO', 'NAMA INSTANSI', 'TAHUN', 'TANGGAL PELAKSANAAN', 'TEMPAT PELAKSANAAN', 'PESERTA LAKI-LAKI', 'PESERTA PEREMPUAN', 'TOTAL PESERTA'];

        $callback = function() use($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($data as $index => $row) {
                fputcsv($file, [
                    $index + 1,
                    $row->nama_instansi ?? '-',
                    $row->tahun ?? '-',
                    $row->tanggal_pelaksanaan ?? '-',
                    $row->tempat_pelaksanaan ?? '-',
                    $row->peserta_laki_laki ?? '0',
                    $row->peserta_perempuan ?? '0',
                    $row->total_peserta ?? '0'
                ]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function cetakPdfFireDrill()
    {
        $data = FireDrill::orderBy('tanggal_pelaksanaan', 'asc')->get();
        return view('internal.pencegahan.cetak_pdf_fire_drill', compact('data'));
    }
}
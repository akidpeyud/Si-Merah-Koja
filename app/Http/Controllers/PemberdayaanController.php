<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PemberdayaanController extends Controller
{
    // 1. TAMPILKAN SEMUA DATA (INDEX) -> UNTUK TAB "SEMUA DATA" (STAT CARDS)
    public function index()
    {
        // Hitung total data untuk dimunculkan di kotak-kotak ringkasan (Stat Cards)
        $total_sosialisasi = DB::table('sosialisasi_edukasi')->count();
        // Asumsi nama tabel untuk pelatihan keluarga adalah 'pelatihan_keluarga'. Sesuaikan kalau beda!
        $total_pelatihan = DB::table('pelatihan_keluarga')->count();

        return view('internal.pencegahan.pemberdayaan_masyarakat', compact('total_sosialisasi', 'total_pelatihan'));
    }

    // 1.B TAMPILKAN TABEL -> UNTUK TAB "SOSIALISASI DAN EDUKASI"
    public function sosialisasi()
    {
        // Ambil data sosialisasi dari database
        $data_sosialisasi = DB::table('sosialisasi_edukasi')
                            ->orderBy('tanggal_pelaksanaan', 'desc')
                            ->get();

        // Kirim data ke view pemberdayaan_masyarakat
        return view('internal.pencegahan.pemberdayaan_masyarakat', compact('data_sosialisasi'));
    }

    // 2. TAMPILKAN FORM TAMBAH DATA (CREATE)
    public function create()
    {
        return view('internal.pencegahan.create_pemberdayaan');
    }

    // 3. PROSES SIMPAN DATA KE DATABASE (STORE)
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pelaksanaan' => 'required|date',
            'kecamatan'           => 'required|string|max:100',
            'kelurahan'           => 'required|string|max:100',
            'rt'                  => 'required|string|max:255',
            'posyandu_sekolah'    => 'required|string|max:150',
            'peserta_perempuan'   => 'required|integer|min:0',
            'peserta_laki_laki'   => 'required|integer|min:0',
            'foto_video'          => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov,webm|max:51200',
        ]);

        $data = [
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'kecamatan'           => $request->kecamatan,
            'kelurahan'           => $request->kelurahan,
            'rt'                  => $request->rt,
            'posyandu_sekolah'    => $request->posyandu_sekolah,
            'peserta_perempuan'   => $request->peserta_perempuan ?? 0,
            'peserta_laki_laki'   => $request->peserta_laki_laki ?? 0,
            'created_at'          => now(),
            'updated_at'          => now(),
        ];

        // Cek kalau user upload foto/video
        if ($request->hasFile('foto_video')) {
            $file = $request->file('foto_video');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/pemberdayaan'), $namaFile);
            $data['foto_video'] = $namaFile;
        }

        DB::table('sosialisasi_edukasi')->insert($data);

        return redirect('/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi')
            ->with('success', 'Data Sosialisasi & Edukasi berhasil ditambahkan!');
    }

    // 4. TAMPILKAN FORM EDIT DATA (EDIT)
    public function edit($id)
    {
        $data = DB::table('sosialisasi_edukasi')->where('id', $id)->first();

        if (!$data) {
            return redirect('/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi')->with('error', 'Data tidak ditemukan!');
        }

        return view('internal.pencegahan.edit_pemberdayaan', compact('data'));
    }

    // 5. PROSES UPDATE DATA KE DATABASE (UPDATE)
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_pelaksanaan' => 'required|date',
            'kecamatan'           => 'required|string|max:100',
            'kelurahan'           => 'required|string|max:100',
            'rt'                  => 'required|string|max:255',
            'posyandu_sekolah'    => 'required|string|max:150',
            'peserta_perempuan'   => 'required|integer|min:0',
            'peserta_laki_laki'   => 'required|integer|min:0',
            'foto_video'          => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov,webm|max:51200',
        ]);

        $updateData = [
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'kecamatan'           => $request->kecamatan,
            'kelurahan'           => $request->kelurahan,
            'rt'                  => $request->rt,
            'posyandu_sekolah'    => $request->posyandu_sekolah,
            'peserta_perempuan'   => $request->peserta_perempuan ?? 0,
            'peserta_laki_laki'   => $request->peserta_laki_laki ?? 0,
            'updated_at'          => now(),
        ];

        // Cek kalau user upload foto/video baru untuk mengganti yang lama
        if ($request->hasFile('foto_video')) {
            $file = $request->file('foto_video');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/pemberdayaan'), $namaFile);
            $updateData['foto_video'] = $namaFile;
        }

        DB::table('sosialisasi_edukasi')->where('id', $id)->update($updateData);

        return redirect('/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi')
            ->with('success', 'Data Sosialisasi & Edukasi berhasil diperbarui!');
    }

    // 6. PROSES HAPUS DATA (DESTROY)
    public function destroy($id)
    {
        DB::table('sosialisasi_edukasi')->where('id', $id)->delete();

        return redirect('/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi')
            ->with('success', 'Data Sosialisasi & Edukasi berhasil dihapus!');
    }

    // 7. CETAK PDF SOSIALISASI
    public function cetak()
    {
        $data = DB::table('sosialisasi_edukasi')->orderBy('tanggal_pelaksanaan', 'desc')->get();

        return view('internal.pencegahan.cetak_sosialisasi', compact('data'));
    }

    // 8. CETAK EXCEL SOSIALISASI
    public function cetakExcel()
    {
        $data = DB::table('sosialisasi_edukasi')->orderBy('tanggal_pelaksanaan', 'desc')->get();
        $filename = "Data_Sosialisasi_Edukasi_" . date('Ymd') . ".csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['NO', 'TANGGAL PELAKSANAAN', 'KECAMATAN', 'KELURAHAN', 'RT', 'POSYANDU / NAMA SEKOLAH', 'PESERTA LAKI-LAKI', 'PESERTA PEREMPUAN', 'TOTAL PESERTA'];

        $callback = function() use($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $index => $row) {
                // Hitung total peserta otomatis
                $total_peserta = ($row->peserta_laki_laki ?? 0) + ($row->peserta_perempuan ?? 0);

                fputcsv($file, [
                    $index + 1,
                    $row->tanggal_pelaksanaan ? \Carbon\Carbon::parse($row->tanggal_pelaksanaan)->translatedFormat('d F Y') : '-',
                    $row->kecamatan ?? '-',
                    $row->kelurahan ?? '-',
                    $row->rt ?? '-',
                    $row->posyandu_sekolah ?? '-',
                    $row->peserta_laki_laki ?? '0',
                    $row->peserta_perempuan ?? '0',
                    $total_peserta
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // 9. CETAK PELATIHAN KELUARGA
    public function cetakPelatihan()
    {
        $data = \App\Models\PelatihanKeluarga::orderBy('tanggal_pelaksanaan', 'desc')->get();

        return view('internal.pencegahan.cetak_pelatihan', compact('data'));
    }

    // 10. CETAK EXCEL PELATIHAN KELUARGA
    public function cetakExcelPelatihan()
    {
        $data = \App\Models\PelatihanKeluarga::orderBy('tanggal_pelaksanaan', 'desc')->get();
        $filename = "Data_Pelatihan_Keluarga_" . date('Ymd') . ".csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // Sesuai dengan kolom di tabel view kamu
        $columns = ['NO', 'HARI / TANGGAL', 'LOKASI / KELURAHAN', 'NAMA SEKOLAH', 'JUMLAH PESERTA', 'KETERANGAN'];

        $callback = function() use($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $index => $row) {
                fputcsv($file, [
                    $index + 1,
                    // Format l, d F Y akan menghasilkan: Senin, 01 Agustus 2026
                    $row->tanggal_pelaksanaan ? \Carbon\Carbon::parse($row->tanggal_pelaksanaan)->translatedFormat('l, d F Y') : '-',
                    $row->lokasi_kelurahan ?? ($row->kelurahan ?? '-'),
                    $row->nama_sekolah ?? '-',
                    $row->jumlah_peserta ?? '0',
                    $row->keterangan ?? '-'
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
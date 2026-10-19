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
    // Dokumentasi berupa LINK (Google Drive dll), bukan upload file
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pelaksanaan'    => 'required|date',
            'kecamatan'              => 'required|string|max:100',
            'kelurahan'              => 'required|string|max:100',
            'rt'                     => 'required|string|max:255',
            'posyandu_sekolah'       => 'required|string|max:150',
            'peserta_perempuan'      => 'required|integer|min:0',
            'nama_peserta_perempuan' => 'nullable|string',
            'peserta_laki_laki'      => 'required|integer|min:0',
            'nama_peserta_laki_laki' => 'nullable|string',
            'link_dokumentasi'       => 'nullable|string|max:3000',
        ]);

        $links = $this->parseLinkDokumentasi($request->input('link_dokumentasi'));
        if ($links === false) {
            return back()->withInput()->withErrors([
                'link_dokumentasi' => 'Ada link yang tidak valid. Setiap link harus diawali http:// atau https://',
            ]);
        }

        $namaLaki = $this->rapikanDaftarNama($request->input('nama_peserta_laki_laki'));
        $namaPerempuan = $this->rapikanDaftarNama($request->input('nama_peserta_perempuan'));

        // Jika ada daftar nama yang diisi, pastikan jumlah minimal sesuai banyaknya nama
        $jmlLaki = (int) ($request->peserta_laki_laki ?? 0);
        $jmlPerempuan = (int) ($request->peserta_perempuan ?? 0);

        if ($namaLaki !== null && $jmlLaki === 0) {
            $jmlLaki = count(explode("\n", $namaLaki));
        }
        if ($namaPerempuan !== null && $jmlPerempuan === 0) {
            $jmlPerempuan = count(explode("\n", $namaPerempuan));
        }

        DB::table('sosialisasi_edukasi')->insert([
            'tanggal_pelaksanaan'    => $request->tanggal_pelaksanaan,
            'kecamatan'              => $request->kecamatan,
            'kelurahan'              => $request->kelurahan,
            'rt'                     => $request->rt,
            'posyandu_sekolah'       => $request->posyandu_sekolah,
            'peserta_perempuan'      => $jmlPerempuan,
            'nama_peserta_perempuan' => $namaPerempuan,
            'peserta_laki_laki'      => $jmlLaki,
            'nama_peserta_laki_laki' => $namaLaki,
            'link_dokumentasi'       => $links,
            'created_at'             => now(),
            'updated_at'             => now(),
        ]);

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
            'tanggal_pelaksanaan'    => 'required|date',
            'kecamatan'              => 'required|string|max:100',
            'kelurahan'              => 'required|string|max:100',
            'rt'                     => 'required|string|max:255',
            'posyandu_sekolah'       => 'required|string|max:150',
            'peserta_perempuan'      => 'required|integer|min:0',
            'nama_peserta_perempuan' => 'nullable|string',
            'peserta_laki_laki'      => 'required|integer|min:0',
            'nama_peserta_laki_laki' => 'nullable|string',
            'link_dokumentasi'       => 'nullable|string|max:3000',
        ]);

        $links = $this->parseLinkDokumentasi($request->input('link_dokumentasi'));
        if ($links === false) {
            return back()->withInput()->withErrors([
                'link_dokumentasi' => 'Ada link yang tidak valid. Setiap link harus diawali http:// atau https://',
            ]);
        }

        $namaLaki = $this->rapikanDaftarNama($request->input('nama_peserta_laki_laki'));
        $namaPerempuan = $this->rapikanDaftarNama($request->input('nama_peserta_perempuan'));

        $jmlLaki = (int) ($request->peserta_laki_laki ?? 0);
        $jmlPerempuan = (int) ($request->peserta_perempuan ?? 0);

        if ($namaLaki !== null && $jmlLaki === 0) {
            $jmlLaki = count(explode("\n", $namaLaki));
        }
        if ($namaPerempuan !== null && $jmlPerempuan === 0) {
            $jmlPerempuan = count(explode("\n", $namaPerempuan));
        }

        DB::table('sosialisasi_edukasi')->where('id', $id)->update([
            'tanggal_pelaksanaan'    => $request->tanggal_pelaksanaan,
            'kecamatan'              => $request->kecamatan,
            'kelurahan'              => $request->kelurahan,
            'rt'                     => $request->rt,
            'posyandu_sekolah'       => $request->posyandu_sekolah,
            'peserta_perempuan'      => $jmlPerempuan,
            'nama_peserta_perempuan' => $namaPerempuan,
            'peserta_laki_laki'      => $jmlLaki,
            'nama_peserta_laki_laki' => $namaLaki,
            'link_dokumentasi'       => $links,
            'updated_at'             => now(),
        ]);

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

    /**
     * Bersihkan dan rapikan input daftar nama peserta (satu nama per baris).
     */
    private function rapikanDaftarNama($raw)
    {
        $names = collect(preg_split('/[\r\n,;]+/', (string) $raw))
            ->map(fn ($n) => trim($n))
            ->filter()
            ->values();

        return $names->isEmpty() ? null : $names->implode("\n");
    }

    /**
     * Format daftar nama untuk ditampilkan di sel Excel.
     */
    private function namaUntukExcel($raw, $jumlah)
    {
        $names = collect(preg_split('/[\r\n,;]+/', (string) $raw))
            ->map(fn ($n) => trim($n))
            ->filter()
            ->values();

        $teks = '<b>' . (int) $jumlah . ' Orang</b>';

        if ($names->isNotEmpty()) {
            $daftar = $names->map(fn ($n, $i) => ($i + 1) . '. ' . e($n))->implode('<br>');
            $teks .= '<br>' . $daftar;
        }

        return $teks;
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

    /**
     * Ubah teks link (banyak baris) jadi HTML aman untuk sel Excel.
     */
    private function linkUntukExcel($raw)
    {
        $links = collect(preg_split('/[\r\n,\s]+/', (string) $raw))
            ->map(fn ($u) => trim($u))
            ->filter(fn ($u) => preg_match('#^https?://#i', $u))
            ->values();

        if ($links->isEmpty()) {
            return '-';
        }

        return $links->map(fn ($u, $i) => ($links->count() > 1 ? ($i + 1) . '. ' : '') . e($u))
                     ->implode('<br>');
    }

    // 7. CETAK PDF SOSIALISASI
    public function cetak()
    {
        $data = DB::table('sosialisasi_edukasi')->orderBy('tanggal_pelaksanaan', 'desc')->get();

        return view('internal.pencegahan.cetak_sosialisasi', compact('data'));
    }

    // 8. CETAK EXCEL SOSIALISASI & EDUKASI (Format HTML Table bertingkat ke .xls)
    public function cetakExcel()
    {
        $data = DB::table('sosialisasi_edukasi')->orderBy('tanggal_pelaksanaan', 'desc')->get();
        $filename = "Data_Sosialisasi_Edukasi_" . date('Ymd') . ".xls";

        // Bikin struktur tabel HTML langsung di Controller
        $html = '<table border="1" cellpadding="5" cellspacing="0">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th rowspan="2" style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">NO</th>';
        $html .= '<th rowspan="2" style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">HARI / TGL</th>';
        $html .= '<th rowspan="2" style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">RT</th>';
        $html .= '<th rowspan="2" style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">KELURAHAN</th>';
        $html .= '<th rowspan="2" style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">KECAMATAN</th>';
        $html .= '<th rowspan="2" style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">POSYANDU / NAMA SEKOLAH</th>';
        $html .= '<th colspan="3" style="background-color: #0f172a; color: white; text-align: center;">JUMLAH &amp; DAFTAR PESERTA</th>';
        $html .= '<th rowspan="2" style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">LINK DOKUMENTASI</th>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<th style="background-color: #0f172a; color: white; text-align: center;">LAKI-LAKI</th>';
        $html .= '<th style="background-color: #0f172a; color: white; text-align: center;">PEREMPUAN</th>';
        $html .= '<th style="background-color: #0f172a; color: white; text-align: center;">TOTAL PESERTA</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        
        $html .= '<tbody>';
        
        $total_semua_lakilaki = 0;
        $total_semua_perempuan = 0;
        $total_semua_peserta = 0;

        foreach ($data as $index => $row) {
            $tanggal = $row->tanggal_pelaksanaan ? \Carbon\Carbon::parse($row->tanggal_pelaksanaan)->locale('id')->translatedFormat('d F Y') : '-';
            $lakilaki = (int) ($row->peserta_laki_laki ?? 0);
            $perempuan = (int) ($row->peserta_perempuan ?? 0);
            $total_peserta = $lakilaki + $perempuan;

            $total_semua_lakilaki += $lakilaki;
            $total_semua_perempuan += $perempuan;
            $total_semua_peserta += $total_peserta;

            $html .= '<tr>';
            $html .= '<td style="text-align: center; vertical-align: top;">' . ($index + 1) . '</td>';
            $html .= '<td style="text-align: center; vertical-align: top;">' . $tanggal . '</td>';
            $html .= '<td style="text-align: center; vertical-align: top;">' . e($row->rt ?? '-') . '</td>';
            $html .= '<td style="vertical-align: top;">' . e($row->kelurahan ?? '-') . '</td>';
            $html .= '<td style="vertical-align: top;">' . e($row->kecamatan ?? '-') . '</td>';
            $html .= '<td style="vertical-align: top;">' . e($row->posyandu_sekolah ?? '-') . '</td>';
            $html .= '<td style="vertical-align: top;">' . $this->namaUntukExcel($row->nama_peserta_laki_laki ?? '', $lakilaki) . '</td>';
            $html .= '<td style="vertical-align: top;">' . $this->namaUntukExcel($row->nama_peserta_perempuan ?? '', $perempuan) . '</td>';
            $html .= '<td style="text-align: center; vertical-align: top;"><b>' . $total_peserta . ' Orang</b></td>';
            $html .= '<td style="vertical-align: top;">' . $this->linkUntukExcel($row->link_dokumentasi ?? '') . '</td>';
            $html .= '</tr>';
        }

        // Baris Total Seluruh Peserta
        $html .= '<tr>';
        $html .= '<td colspan="6" style="text-align: center; font-weight: bold; background-color: #f3f4f6;">TOTAL SELURUH PESERTA</td>';
        $html .= '<td style="text-align: center; font-weight: bold; background-color: #f3f4f6;">' . $total_semua_lakilaki . ' Orang</td>';
        $html .= '<td style="text-align: center; font-weight: bold; background-color: #f3f4f6;">' . $total_semua_perempuan . ' Orang</td>';
        $html .= '<td style="text-align: center; font-weight: bold; background-color: #f3f4f6;">' . $total_semua_peserta . ' Orang</td>';
        $html .= '<td style="background-color: #f3f4f6;"></td>';
        $html .= '</tr>';

        $html .= '</tbody>';
        $html .= '</table>';

        return response($html)
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    // 9. CETAK PELATIHAN KELUARGA
    public function cetakPelatihan()
    {
        $data = \App\Models\PelatihanKeluarga::orderBy('tanggal_pelaksanaan', 'desc')->get();

        return view('internal.pencegahan.cetak_pelatihan', compact('data'));
    }

    // 10. CETAK EXCEL PELATIHAN KELUARGA (Format HTML Table bertingkat ke .xls)
    public function cetakExcelPelatihan()
    {
        $data = \App\Models\PelatihanKeluarga::orderBy('tanggal_pelaksanaan', 'desc')->get();
        $filename = "Data_Pelatihan_Keluarga_" . date('Ymd') . ".xls";

        // Bikin struktur tabel HTML langsung di Controller
        $html = '<table border="1" cellpadding="5" cellspacing="0">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th rowspan="2" style="background-color: #1f2937; color: white; text-align: center; vertical-align: middle;">NO</th>';
        $html .= '<th rowspan="2" style="background-color: #1f2937; color: white; text-align: center; vertical-align: middle;">HARI / TGL</th>';
        $html .= '<th rowspan="2" style="background-color: #1f2937; color: white; text-align: center; vertical-align: middle;">RT</th>';
        $html .= '<th rowspan="2" style="background-color: #1f2937; color: white; text-align: center; vertical-align: middle;">KELURAHAN</th>';
        $html .= '<th rowspan="2" style="background-color: #1f2937; color: white; text-align: center; vertical-align: middle;">KECAMATAN</th>';
        $html .= '<th colspan="3" style="background-color: #1f2937; color: white; text-align: center;">JUMLAH PESERTA</th>';
        $html .= '<th rowspan="2" style="background-color: #1f2937; color: white; text-align: center; vertical-align: middle;">LINK DOKUMENTASI</th>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<th style="background-color: #1f2937; color: white; text-align: center;">PEREMPUAN</th>';
        $html .= '<th style="background-color: #1f2937; color: white; text-align: center;">LAKI-LAKI</th>';
        $html .= '<th style="background-color: #1f2937; color: white; text-align: center;">TOTAL</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        
        $html .= '<tbody>';
        
        // Variabel untuk menghitung total seluruh peserta di bawah tabel
        $total_semua_perempuan = 0;
        $total_semua_lakilaki = 0;
        $total_semua_peserta = 0;

        foreach ($data as $index => $row) {
            $tanggal = $row->tanggal_pelaksanaan ? \Carbon\Carbon::parse($row->tanggal_pelaksanaan)->translatedFormat('d F Y') : '-';
            
            // Ambil data peserta (pastikan nama kolom di database sesuai, misal: peserta_perempuan)
            $perempuan = $row->peserta_perempuan ?? 0;
            $lakilaki = $row->peserta_laki_laki ?? 0;
            $total_peserta = $perempuan + $lakilaki;

            // Tambahkan ke total keseluruhan
            $total_semua_perempuan += $perempuan;
            $total_semua_lakilaki += $lakilaki;
            $total_semua_peserta += $total_peserta;
            
            $html .= '<tr>';
            $html .= '<td style="text-align: center;">' . ($index + 1) . '</td>';
            $html .= '<td>' . $tanggal . '</td>';
            $html .= '<td>' . e($row->rt ?? '-') . '</td>';
            $html .= '<td>' . e($row->kelurahan ?? '-') . '</td>';
            $html .= '<td>' . e($row->kecamatan ?? '-') . '</td>';
            $html .= '<td style="text-align: center;">' . $perempuan . '</td>';
            $html .= '<td style="text-align: center;">' . $lakilaki . '</td>';
            $html .= '<td style="text-align: center;"><b>' . $total_peserta . '</b></td>';
            $html .= '<td>' . $this->linkUntukExcel($row->link_dokumentasi ?? '') . '</td>';
            $html .= '</tr>';
        }

        // Baris untuk TOTAL SELURUH PESERTA
        $html .= '<tr>';
        $html .= '<td colspan="5" style="text-align: center; font-weight: bold; background-color: #f3f4f6;">TOTAL SELURUH PESERTA</td>';
        $html .= '<td style="text-align: center; font-weight: bold; background-color: #f3f4f6;">' . $total_semua_perempuan . '</td>';
        $html .= '<td style="text-align: center; font-weight: bold; background-color: #f3f4f6;">' . $total_semua_lakilaki . '</td>';
        $html .= '<td style="text-align: center; font-weight: bold; background-color: #f3f4f6;">' . $total_semua_peserta . '</td>';
        $html .= '<td style="background-color: #f3f4f6;"></td>';
        $html .= '</tr>';

        $html .= '</tbody>';
        $html .= '</table>';

        // Return HTML string dan paksa download sebagai Excel .xls
        return response($html)
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class PemberdayaanController extends Controller
{
    // 1. TAMPILKAN SEMUA DATA (INDEX) -> UNTUK TAB "SEMUA DATA" (STAT CARDS)
    public function index()
    {
        $total_sosialisasi = DB::table('sosialisasi_edukasi')->count();
        $total_pelatihan   = DB::table('pelatihan_keluarga')->count();
        
        // Hitung total kunjungan sekolah
        $total_kunjungan   = \App\Models\KunjunganSekolah::count();

        return view('internal.pencegahan.pemberdayaan_masyarakat', compact('total_sosialisasi', 'total_pelatihan', 'total_kunjungan'));
    }

    // 1.B TAMPILKAN TABEL -> UNTUK TAB "SOSIALISASI DAN EDUKASI"
    public function sosialisasi()
    {
        $data_sosialisasi = DB::table('sosialisasi_edukasi')
            ->orderBy('tanggal_pelaksanaan', 'desc')
            ->get();

        return view('internal.pencegahan.pemberdayaan_masyarakat', compact('data_sosialisasi'));
    }

    // 1.C TAMPILKAN TABEL -> UNTUK TAB "PELATIHAN KELUARGA TANGGAP KEBAKARAN"
    public function pelatihanKeluarga()
    {
        $data_pelatihan = DB::table('pelatihan_keluarga')
            ->orderBy('tanggal_pelaksanaan', 'desc')
            ->get();

        if (View::exists('internal.pencegahan.pelatihan_keluarga')) {
            return view('internal.pencegahan.pelatihan_keluarga', compact('data_pelatihan'));
        }

        return view('internal.pencegahan.pemberdayaan_masyarakat', compact('data_pelatihan'));
    }

    // ==========================================
    // MODUL: SOSIALISASI DAN EDUKASI
    // ==========================================

    public function create()
    {
        return view('internal.pencegahan.create_pemberdayaan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_kegiatan'         => 'required|in:Luar,Dalam',
            'tanggal_pelaksanaan'    => 'required|date',
            'kecamatan'              => 'nullable|string|max:100', // Nullable karena kalau ke Mako tidak diisi
            'kelurahan'              => 'nullable|string|max:100',
            'rt'                     => 'nullable|string|max:255',
            'posyandu_sekolah'       => 'required|string|max:150',
            'peserta_perempuan'      => 'required|integer|min:0',
            'nama_peserta_perempuan' => 'nullable|string',
            'peserta_laki_laki'      => 'required|integer|min:0',
            'nama_peserta_laki_laki' => 'nullable|string',
            'guru'                   => 'required|integer|min:0',
            'orang_tua'              => 'required|integer|min:0',
            'link_dokumentasi'       => 'nullable|string|max:3000',
        ]);

        $links = $this->parseLinkDokumentasi($request->input('link_dokumentasi'));
        if ($links === false) {
            return back()->withInput()->withErrors([
                'link_dokumentasi' => 'Ada link yang tidak valid. Setiap link harus diawali http:// atau https://',
            ]);
        }

        [$jmlLaki, $namaLaki]           = $this->prosesPeserta($request->input('peserta_laki_laki'), $request->input('nama_peserta_laki_laki'));
        [$jmlPerempuan, $namaPerempuan] = $this->prosesPeserta($request->input('peserta_perempuan'), $request->input('nama_peserta_perempuan'));

        // LOGIKA PINTAR: Kalau Kunjungan Dalam, otomatis set lokasi ke Mako Damkar
        $jenis     = $request->jenis_kegiatan;
        $kecamatan = $jenis === 'Dalam' ? 'Mako Damkar' : $request->kecamatan;
        $kelurahan = $jenis === 'Dalam' ? 'Mako Damkar' : $request->kelurahan;
        $rt        = $jenis === 'Dalam' ? '-' : $request->rt;

        DB::table('sosialisasi_edukasi')->insert([
            'tanggal_pelaksanaan'    => $request->tanggal_pelaksanaan,
            'kecamatan'              => $kecamatan,
            'kelurahan'              => $kelurahan,
            'rt'                     => $rt,
            'posyandu_sekolah'       => $request->posyandu_sekolah,
            'peserta_perempuan'      => $jmlPerempuan,
            'nama_peserta_perempuan' => $namaPerempuan,
            'peserta_laki_laki'      => $jmlLaki,
            'nama_peserta_laki_laki' => $namaLaki,
            'guru'                   => $request->guru,
            'orang_tua'              => $request->orang_tua,
            'link_dokumentasi'       => $links,
            'created_at'             => now(),
            'updated_at'             => now(),
        ]);

        return redirect('/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi')
            ->with('success', 'Data Sosialisasi & Edukasi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = DB::table('sosialisasi_edukasi')->where('id', $id)->first();

        if (!$data) {
            return redirect('/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi')
                ->with('error', 'Data tidak ditemukan!');
        }

        $item = $data;
        return view('internal.pencegahan.edit_pemberdayaan', compact('data', 'item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_kegiatan'         => 'required|in:Luar,Dalam',
            'tanggal_pelaksanaan'    => 'required|date',
            'kecamatan'              => 'nullable|string|max:100',
            'kelurahan'              => 'nullable|string|max:100',
            'rt'                     => 'nullable|string|max:255',
            'posyandu_sekolah'       => 'required|string|max:150',
            'peserta_perempuan'      => 'required|integer|min:0',
            'nama_peserta_perempuan' => 'nullable|string',
            'peserta_laki_laki'      => 'required|integer|min:0',
            'nama_peserta_laki_laki' => 'nullable|string',
            'guru'                   => 'required|integer|min:0',
            'orang_tua'              => 'required|integer|min:0',
            'link_dokumentasi'       => 'nullable|string|max:3000',
        ]);

        $links = $this->parseLinkDokumentasi($request->input('link_dokumentasi'));
        if ($links === false) {
            return back()->withInput()->withErrors([
                'link_dokumentasi' => 'Ada link yang tidak valid. Setiap link harus diawali http:// atau https://',
            ]);
        }

        [$jmlLaki, $namaLaki]           = $this->prosesPeserta($request->input('peserta_laki_laki'), $request->input('nama_peserta_laki_laki'));
        [$jmlPerempuan, $namaPerempuan] = $this->prosesPeserta($request->input('peserta_perempuan'), $request->input('nama_peserta_perempuan'));

        // LOGIKA PINTAR: Kalau Kunjungan Dalam, otomatis set lokasi ke Mako Damkar
        $jenis     = $request->jenis_kegiatan;
        $kecamatan = $jenis === 'Dalam' ? 'Mako Damkar' : $request->kecamatan;
        $kelurahan = $jenis === 'Dalam' ? 'Mako Damkar' : $request->kelurahan;
        $rt        = $jenis === 'Dalam' ? '-' : $request->rt;

        DB::table('sosialisasi_edukasi')->where('id', $id)->update([
            'tanggal_pelaksanaan'    => $request->tanggal_pelaksanaan,
            'kecamatan'              => $kecamatan,
            'kelurahan'              => $kelurahan,
            'rt'                     => $rt,
            'posyandu_sekolah'       => $request->posyandu_sekolah,
            'peserta_perempuan'      => $jmlPerempuan,
            'nama_peserta_perempuan' => $namaPerempuan,
            'peserta_laki_laki'      => $jmlLaki,
            'nama_peserta_laki_laki' => $namaLaki,
            'guru'                   => $request->guru,
            'orang_tua'              => $request->orang_tua,
            'link_dokumentasi'       => $links,
            'updated_at'             => now(),
        ]);

        return redirect('/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi')
            ->with('success', 'Data Sosialisasi & Edukasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('sosialisasi_edukasi')->where('id', $id)->delete();

        return redirect('/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi')
            ->with('success', 'Data Sosialisasi & Edukasi berhasil dihapus!');
    }


    // ==========================================
    // MODUL: PELATIHAN KELUARGA TANGGAP KEBAKARAN
    // ==========================================

    public function createPelatihan()
    {
        if (View::exists('internal.pencegahan.create_pelatihan_keluarga')) {
            return view('internal.pencegahan.create_pelatihan_keluarga');
        }
        return view('internal.pencegahan.create_pelatihan');
    }

    public function storePelatihan(Request $request)
    {
        $request->validate([
            'tanggal_pelaksanaan'    => 'required|date',
            'kecamatan'              => 'required|string|max:100',
            'kelurahan'              => 'required|string|max:100',
            'rt'                     => 'required|string|max:255',
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

        [$jmlLaki, $namaLaki]           = $this->prosesPeserta($request->input('peserta_laki_laki'), $request->input('nama_peserta_laki_laki'));
        [$jmlPerempuan, $namaPerempuan] = $this->prosesPeserta($request->input('peserta_perempuan'), $request->input('nama_peserta_perempuan'));

        DB::table('pelatihan_keluarga')->insert([
            'tanggal_pelaksanaan'    => $request->tanggal_pelaksanaan,
            'kecamatan'              => $request->kecamatan,
            'kelurahan'              => $request->kelurahan,
            'rt'                     => $request->rt,
            'peserta_perempuan'      => $jmlPerempuan,
            'nama_peserta_perempuan' => $namaPerempuan,
            'peserta_laki_laki'      => $jmlLaki,
            'nama_peserta_laki_laki' => $namaLaki,
            'link_dokumentasi'       => $links,
            'created_at'             => now(),
            'updated_at'             => now(),
        ]);

        return redirect('/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga')
            ->with('success', 'Data Pelatihan Keluarga berhasil ditambahkan!');
    }

    public function editPelatihan($id)
    {
        $item = DB::table('pelatihan_keluarga')->where('id', $id)->first();

        if (!$item) {
            return redirect('/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga')
                ->with('error', 'Data tidak ditemukan!');
        }

        $data = $item;
        if (View::exists('internal.pencegahan.edit_pelatihan_keluarga')) {
            return view('internal.pencegahan.edit_pelatihan_keluarga', compact('item', 'data'));
        }
        return view('internal.pencegahan.edit_pelatihan', compact('item', 'data'));
    }

    public function updatePelatihan(Request $request, $id)
    {
        $request->validate([
            'tanggal_pelaksanaan'    => 'required|date',
            'kecamatan'              => 'required|string|max:100',
            'kelurahan'              => 'required|string|max:100',
            'rt'                     => 'required|string|max:255',
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

        [$jmlLaki, $namaLaki]           = $this->prosesPeserta($request->input('peserta_laki_laki'), $request->input('nama_peserta_laki_laki'));
        [$jmlPerempuan, $namaPerempuan] = $this->prosesPeserta($request->input('peserta_perempuan'), $request->input('nama_peserta_perempuan'));

        DB::table('pelatihan_keluarga')->where('id', $id)->update([
            'tanggal_pelaksanaan'    => $request->tanggal_pelaksanaan,
            'kecamatan'              => $request->kecamatan,
            'kelurahan'              => $request->kelurahan,
            'rt'                     => $request->rt,
            'peserta_perempuan'      => $jmlPerempuan,
            'nama_peserta_perempuan' => $namaPerempuan,
            'peserta_laki_laki'      => $jmlLaki,
            'nama_peserta_laki_laki' => $namaLaki,
            'link_dokumentasi'       => $links,
            'updated_at'             => now(),
        ]);

        return redirect('/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga')
            ->with('success', 'Data Pelatihan Keluarga berhasil diperbarui!');
    }

    public function destroyPelatihan($id)
    {
        DB::table('pelatihan_keluarga')->where('id', $id)->delete();

        return redirect('/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga')
            ->with('success', 'Data Pelatihan Keluarga berhasil dihapus!');
    }


    // ==========================================
    // FUNGSI HELPER & CETAK (PDF / EXCEL)
    // ==========================================

    private function prosesPeserta($inputJumlah, $rawNama): array
    {
        $names = collect(preg_split('/[\r\n,;]+/', (string) $rawNama))
            ->map(fn ($n) => trim($n))
            ->filter()
            ->values();

        $cleanNama = $names->isEmpty() ? null : $names->implode("\n");
        $jumlah    = max(0, (int) ($inputJumlah ?? 0));

        if ($names->isNotEmpty() && $jumlah < $names->count()) {
            $jumlah = $names->count();
        }

        return [$jumlah, $cleanNama];
    }

    private function namaUntukExcel($raw, $jumlah)
    {
        $names = collect(preg_split('/[\r\n,;]+/', (string) $raw))
            ->map(fn ($n) => trim($n))
            ->filter()
            ->values();

        $teks = '<b>' . (int) $jumlah . ' Orang</b>';

        if ($names->isNotEmpty()) {
            $daftar = $names->map(fn ($n, $i) => ($i + 1) . '. ' . e(ucwords(strtolower($n))))->implode('<br>');
            $teks .= '<br>' . $daftar;
        }

        return $teks;
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

    public function cetak()
    {
        $data = DB::table('sosialisasi_edukasi')->orderBy('tanggal_pelaksanaan', 'desc')->get();
        return view('internal.pencegahan.cetak_sosialisasi', compact('data'));
    }

    public function cetakExcel()
    {
        $data     = DB::table('sosialisasi_edukasi')->orderBy('tanggal_pelaksanaan', 'desc')->get();
        $filename = "Data_Sosialisasi_Edukasi_" . date('Ymd') . ".xls";

        $html = '<table border="1" cellpadding="5" cellspacing="0">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th rowspan="2" style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">NO</th>';
        $html .= '<th rowspan="2" style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">HARI / TGL</th>';
        $html .= '<th rowspan="2" style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">RT</th>';
        $html .= '<th rowspan="2" style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">KELURAHAN</th>';
        $html .= '<th rowspan="2" style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">KECAMATAN</th>';
        $html .= '<th rowspan="2" style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">POSYANDU / NAMA SEKOLAH</th>';
        $html .= '<th colspan="5" style="background-color: #0f172a; color: white; text-align: center;">JUMLAH &amp; DAFTAR PESERTA</th>';
        $html .= '<th rowspan="2" style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">LINK DOKUMENTASI</th>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<th style="background-color: #0f172a; color: white; text-align: center;">LAKI-LAKI</th>';
        $html .= '<th style="background-color: #0f172a; color: white; text-align: center;">PEREMPUAN</th>';
        $html .= '<th style="background-color: #0f172a; color: white; text-align: center;">GURU</th>';
        $html .= '<th style="background-color: #0f172a; color: white; text-align: center;">ORTU</th>';
        $html .= '<th style="background-color: #0f172a; color: white; text-align: center;">TOTAL PESERTA</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $total_semua_lakilaki  = 0;
        $total_semua_perempuan = 0;
        $total_semua_guru      = 0;
        $total_semua_ortu      = 0;
        $total_semua_peserta   = 0;

        foreach ($data as $index => $row) {
            $tanggal       = $row->tanggal_pelaksanaan ? Carbon::parse($row->tanggal_pelaksanaan)->locale('id')->translatedFormat('d F Y') : '-';
            $lakilaki      = (int) ($row->peserta_laki_laki ?? 0);
            $perempuan     = (int) ($row->peserta_perempuan ?? 0);
            $guru          = (int) ($row->guru ?? 0);
            $ortu          = (int) ($row->orang_tua ?? 0);
            $total_peserta = $lakilaki + $perempuan + $guru + $ortu;

            $total_semua_lakilaki  += $lakilaki;
            $total_semua_perempuan += $perempuan;
            $total_semua_guru      += $guru;
            $total_semua_ortu      += $ortu;
            $total_semua_peserta   += $total_peserta;

            $html .= '<tr>';
            $html .= '<td style="text-align: center; vertical-align: top;">' . ($index + 1) . '</td>';
            $html .= '<td style="text-align: center; vertical-align: top;">' . $tanggal . '</td>';
            $html .= '<td style="text-align: center; vertical-align: top;">' . e($row->rt ?? '-') . '</td>';
            $html .= '<td style="vertical-align: top;">' . e($row->kelurahan ?? '-') . '</td>';
            $html .= '<td style="vertical-align: top;">' . e($row->kecamatan ?? '-') . '</td>';
            $html .= '<td style="vertical-align: top;">' . e($row->posyandu_sekolah ?? '-') . '</td>';
            $html .= '<td style="vertical-align: top;">' . $this->namaUntukExcel($row->nama_peserta_laki_laki ?? '', $lakilaki) . '</td>';
            $html .= '<td style="vertical-align: top;">' . $this->namaUntukExcel($row->nama_peserta_perempuan ?? '', $perempuan) . '</td>';
            $html .= '<td style="text-align: center; vertical-align: top;">' . $guru . '</td>';
            $html .= '<td style="text-align: center; vertical-align: top;">' . $ortu . '</td>';
            $html .= '<td style="text-align: center; vertical-align: top;"><b>' . $total_peserta . ' Orang</b></td>';
            $html .= '<td style="vertical-align: top;">' . $this->linkUntukExcel($row->link_dokumentasi ?? '') . '</td>';
            $html .= '</tr>';
        }

        $html .= '<tr>';
        $html .= '<td colspan="6" style="text-align: center; font-weight: bold; background-color: #f3f4f6;">TOTAL SELURUH PESERTA</td>';
        $html .= '<td style="text-align: center; font-weight: bold; background-color: #f3f4f6;">' . $total_semua_lakilaki . ' Orang</td>';
        $html .= '<td style="text-align: center; font-weight: bold; background-color: #f3f4f6;">' . $total_semua_perempuan . ' Orang</td>';
        $html .= '<td style="text-align: center; font-weight: bold; background-color: #f3f4f6;">' . $total_semua_guru . ' Orang</td>';
        $html .= '<td style="text-align: center; font-weight: bold; background-color: #f3f4f6;">' . $total_semua_ortu . ' Orang</td>';
        $html .= '<td style="text-align: center; font-weight: bold; background-color: #f3f4f6;">' . $total_semua_peserta . ' Orang</td>';
        $html .= '<td style="background-color: #f3f4f6;"></td>';
        $html .= '</tr>';

        $html .= '</tbody>';
        $html .= '</table>';

        return response($html)
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function cetakPelatihan()
    {
        $data = DB::table('pelatihan_keluarga')->orderBy('tanggal_pelaksanaan', 'desc')->get();
        return view('internal.pencegahan.cetak_pelatihan', compact('data'));
    }

    public function cetakExcelPelatihan()
    {
        $data     = DB::table('pelatihan_keluarga')->orderBy('tanggal_pelaksanaan', 'desc')->get();
        $filename = "Data_Pelatihan_Keluarga_" . date('Ymd') . ".xls";

        $html = '<table border="1" cellpadding="5" cellspacing="0">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th rowspan="2" style="background-color: #1f2937; color: white; text-align: center; vertical-align: middle;">NO</th>';
        $html .= '<th rowspan="2" style="background-color: #1f2937; color: white; text-align: center; vertical-align: middle;">HARI / TGL</th>';
        $html .= '<th rowspan="2" style="background-color: #1f2937; color: white; text-align: center; vertical-align: middle;">RT</th>';
        $html .= '<th rowspan="2" style="background-color: #1f2937; color: white; text-align: center; vertical-align: middle;">KELURAHAN</th>';
        $html .= '<th rowspan="2" style="background-color: #1f2937; color: white; text-align: center; vertical-align: middle;">KECAMATAN</th>';
        $html .= '<th colspan="3" style="background-color: #1f2937; color: white; text-align: center;">JUMLAH &amp; DAFTAR PESERTA</th>';
        $html .= '<th rowspan="2" style="background-color: #1f2937; color: white; text-align: center; vertical-align: middle;">LINK DOKUMENTASI</th>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<th style="background-color: #1f2937; color: white; text-align: center;">LAKI-LAKI</th>';
        $html .= '<th style="background-color: #1f2937; color: white; text-align: center;">PEREMPUAN</th>';
        $html .= '<th style="background-color: #1f2937; color: white; text-align: center;">TOTAL PESERTA</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $total_semua_lakilaki  = 0;
        $total_semua_perempuan = 0;
        $total_semua_peserta   = 0;

        foreach ($data as $index => $row) {
            $tanggal       = $row->tanggal_pelaksanaan ? Carbon::parse($row->tanggal_pelaksanaan)->locale('id')->translatedFormat('d F Y') : '-';
            $lakilaki      = (int) ($row->peserta_laki_laki ?? 0);
            $perempuan     = (int) ($row->peserta_perempuan ?? 0);
            $total_peserta = $lakilaki + $perempuan;

            $total_semua_lakilaki  += $lakilaki;
            $total_semua_perempuan += $perempuan;
            $total_semua_peserta   += $total_peserta;
            
            $html .= '<tr>';
            $html .= '<td style="text-align: center; vertical-align: top;">' . ($index + 1) . '</td>';
            $html .= '<td style="text-align: center; vertical-align: top;">' . $tanggal . '</td>';
            $html .= '<td style="text-align: center; vertical-align: top;">' . e($row->rt ?? '-') . '</td>';
            $html .= '<td style="vertical-align: top;">' . e($row->kelurahan ?? '-') . '</td>';
            $html .= '<td style="vertical-align: top;">' . e($row->kecamatan ?? '-') . '</td>';
            $html .= '<td style="vertical-align: top;">' . $this->namaUntukExcel($row->nama_peserta_laki_laki ?? '', $lakilaki) . '</td>';
            $html .= '<td style="vertical-align: top;">' . $this->namaUntukExcel($row->nama_peserta_perempuan ?? '', $perempuan) . '</td>';
            $html .= '<td style="text-align: center; vertical-align: top;"><b>' . $total_peserta . ' Orang</b></td>';
            $html .= '<td style="vertical-align: top;">' . $this->linkUntukExcel($row->link_dokumentasi ?? '') . '</td>';
            $html .= '</tr>';
        }

        $html .= '<tr>';
        $html .= '<td colspan="5" style="text-align: center; font-weight: bold; background-color: #f3f4f6;">TOTAL SELURUH PESERTA</td>';
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
}
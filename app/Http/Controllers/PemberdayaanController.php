<?php

namespace App\Http\Controllers;

use App\Models\KunjunganSekolah;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class PemberdayaanController extends Controller
{
    // 1. TAMPILKAN SEMUA DATA (INDEX) -> UNTUK TAB "SEMUA DATA" (STAT CARDS)
    public function index()
    {
        $total_sosialisasi = DB::table('sosialisasi_edukasi')->count();
        $total_pelatihan = DB::table('pelatihan_keluarga')->count();
        $total_kunjungan = KunjunganSekolah::count();

        return view('internal.pencegahan.pemberdayaan_masyarakat', compact('total_sosialisasi', 'total_pelatihan', 'total_kunjungan'));
    }

    // 1.B TAMPILKAN TABEL -> UNTUK TAB "SOSIALISASI DAN EDUKASI"
    public function sosialisasi()
    {
        $data_sosialisasi = DB::table('sosialisasi_edukasi')
            ->orderBy('tanggal_pelaksanaan', 'desc')
            ->orderBy('id', 'desc')
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
        $validated = $request->validate([
            'jenis_kegiatan' => 'required|in:Luar,Dalam',
            'no_tanggal_surat_permohonan' => 'required_if:jenis_kegiatan,Dalam|nullable|string|max:255',
            'nama_instansi' => 'required|string|max:255',
            'tempat_pelaksanaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'tanggal_pelaksanaan' => 'required|date',
            'jumlah_peserta' => 'required|integer|min:0',
            'nama_penanggung_jawab' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:50',
            'surat_perintah_tugas' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $filename = null;
        if ($request->hasFile('surat_perintah_tugas')) {
            $destinationPath = public_path('uploads/sosialisasi');
            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file = $request->file('surat_perintah_tugas');
            $filename = time().'_'.uniqid().'_spt.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
        }

        $jenis = $validated['jenis_kegiatan'];

        DB::table('sosialisasi_edukasi')->insert([
            'jenis_kegiatan' => $jenis,
            'no_tanggal_surat_permohonan' => $jenis === 'Dalam' ? ($validated['no_tanggal_surat_permohonan'] ?? null) : null,
            'nama_instansi' => $validated['nama_instansi'],
            'tempat_pelaksanaan' => $validated['tempat_pelaksanaan'],
            'alamat' => $validated['alamat'],
            'tanggal_pelaksanaan' => $validated['tanggal_pelaksanaan'],
            'jumlah_peserta' => (int) $validated['jumlah_peserta'],
            'nama_penanggung_jawab' => $validated['nama_penanggung_jawab'],
            'no_telepon' => $validated['no_telepon'],
            'surat_perintah_tugas' => $filename,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $tabQuery = $jenis === 'Dalam' ? '?tab=dalam' : '';

        return redirect('/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi'.$tabQuery)
            ->with('success', 'Data Sosialisasi & Edukasi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = DB::table('sosialisasi_edukasi')->where('id', $id)->first();

        if (! $data) {
            return redirect('/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi')
                ->with('error', 'Data tidak ditemukan!');
        }

        $item = $data;

        return view('internal.pencegahan.edit_pemberdayaan', compact('data', 'item'));
    }

    public function update(Request $request, $id)
    {
        $existing = DB::table('sosialisasi_edukasi')->where('id', $id)->first();

        if (! $existing) {
            return redirect('/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi')
                ->with('error', 'Data tidak ditemukan!');
        }

        $validated = $request->validate([
            'jenis_kegiatan' => 'required|in:Luar,Dalam',
            'no_tanggal_surat_permohonan' => 'required_if:jenis_kegiatan,Dalam|nullable|string|max:255',
            'nama_instansi' => 'required|string|max:255',
            'tempat_pelaksanaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'tanggal_pelaksanaan' => 'required|date',
            'jumlah_peserta' => 'required|integer|min:0',
            'nama_penanggung_jawab' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:50',
            'surat_perintah_tugas' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $filename = $existing->surat_perintah_tugas ?? null;
        if ($request->hasFile('surat_perintah_tugas')) {
            $destinationPath = public_path('uploads/sosialisasi');
            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            if ($filename && file_exists($destinationPath.'/'.$filename)) {
                unlink($destinationPath.'/'.$filename);
            }

            $file = $request->file('surat_perintah_tugas');
            $filename = time().'_'.uniqid().'_spt.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
        }

        $jenis = $validated['jenis_kegiatan'];

        DB::table('sosialisasi_edukasi')->where('id', $id)->update([
            'jenis_kegiatan' => $jenis,
            'no_tanggal_surat_permohonan' => $jenis === 'Dalam' ? ($validated['no_tanggal_surat_permohonan'] ?? null) : null,
            'nama_instansi' => $validated['nama_instansi'],
            'tempat_pelaksanaan' => $validated['tempat_pelaksanaan'],
            'alamat' => $validated['alamat'],
            'tanggal_pelaksanaan' => $validated['tanggal_pelaksanaan'],
            'jumlah_peserta' => (int) $validated['jumlah_peserta'],
            'nama_penanggung_jawab' => $validated['nama_penanggung_jawab'],
            'no_telepon' => $validated['no_telepon'],
            'surat_perintah_tugas' => $filename,
            'updated_at' => now(),
        ]);

        $tabQuery = $jenis === 'Dalam' ? '?tab=dalam' : '';

        return redirect('/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi'.$tabQuery)
            ->with('success', 'Data Sosialisasi & Edukasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $existing = DB::table('sosialisasi_edukasi')->where('id', $id)->first();
        $tabQuery = '';

        if ($existing) {
            if (($existing->jenis_kegiatan ?? 'Luar') === 'Dalam') {
                $tabQuery = '?tab=dalam';
            }

            $oldFile = $existing->surat_perintah_tugas ?? null;
            if ($oldFile) {
                $filePath = public_path('uploads/sosialisasi/'.$oldFile);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            DB::table('sosialisasi_edukasi')->where('id', $id)->delete();
        }

        return redirect('/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi'.$tabQuery)
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
            'tanggal_pelaksanaan' => 'required|date',
            'kecamatan' => 'required|string|max:100',
            'kelurahan' => 'required|string|max:100',
            'rt' => 'required|string|max:255',
            'peserta_perempuan' => 'required|integer|min:0',
            'nama_peserta_perempuan' => 'nullable|string',
            'peserta_laki_laki' => 'required|integer|min:0',
            'nama_peserta_laki_laki' => 'nullable|string',
            'link_dokumentasi' => 'nullable|string|max:3000',
        ]);

        $links = $this->parseLinkDokumentasi($request->input('link_dokumentasi'));
        if ($links === false) {
            return back()->withInput()->withErrors([
                'link_dokumentasi' => 'Ada link yang tidak valid. Setiap link harus diawali http:// atau https://',
            ]);
        }

        [$jmlLaki, $namaLaki] = $this->prosesPeserta($request->input('peserta_laki_laki'), $request->input('nama_peserta_laki_laki'));
        [$jmlPerempuan, $namaPerempuan] = $this->prosesPeserta($request->input('peserta_perempuan'), $request->input('nama_peserta_perempuan'));

        DB::table('pelatihan_keluarga')->insert([
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'rt' => $request->rt,
            'peserta_perempuan' => $jmlPerempuan,
            'nama_peserta_perempuan' => $namaPerempuan,
            'peserta_laki_laki' => $jmlLaki,
            'nama_peserta_laki_laki' => $namaLaki,
            'link_dokumentasi' => $links,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga')
            ->with('success', 'Data Pelatihan Keluarga berhasil ditambahkan!');
    }

    public function editPelatihan($id)
    {
        $item = DB::table('pelatihan_keluarga')->where('id', $id)->first();

        if (! $item) {
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
            'tanggal_pelaksanaan' => 'required|date',
            'kecamatan' => 'required|string|max:100',
            'kelurahan' => 'required|string|max:100',
            'rt' => 'required|string|max:255',
            'peserta_perempuan' => 'required|integer|min:0',
            'nama_peserta_perempuan' => 'nullable|string',
            'peserta_laki_laki' => 'required|integer|min:0',
            'nama_peserta_laki_laki' => 'nullable|string',
            'link_dokumentasi' => 'nullable|string|max:3000',
        ]);

        $links = $this->parseLinkDokumentasi($request->input('link_dokumentasi'));
        if ($links === false) {
            return back()->withInput()->withErrors([
                'link_dokumentasi' => 'Ada link yang tidak valid. Setiap link harus diawali http:// atau https://',
            ]);
        }

        [$jmlLaki, $namaLaki] = $this->prosesPeserta($request->input('peserta_laki_laki'), $request->input('nama_peserta_laki_laki'));
        [$jmlPerempuan, $namaPerempuan] = $this->prosesPeserta($request->input('peserta_perempuan'), $request->input('nama_peserta_perempuan'));

        DB::table('pelatihan_keluarga')->where('id', $id)->update([
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'rt' => $request->rt,
            'peserta_perempuan' => $jmlPerempuan,
            'nama_peserta_perempuan' => $namaPerempuan,
            'peserta_laki_laki' => $jmlLaki,
            'nama_peserta_laki_laki' => $namaLaki,
            'link_dokumentasi' => $links,
            'updated_at' => now(),
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
        $jumlah = max(0, (int) ($inputJumlah ?? 0));

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

        $teks = '<b>'.(int) $jumlah.' Orang</b>';

        if ($names->isNotEmpty()) {
            $daftar = $names->map(fn ($n, $i) => ($i + 1).'. '.e(ucwords(strtolower($n))))->implode('<br>');
            $teks .= '<br>'.$daftar;
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
            if (! preg_match('#^https?://#i', $l) || ! filter_var($l, FILTER_VALIDATE_URL)) {
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

        return $links->map(fn ($u, $i) => ($links->count() > 1 ? ($i + 1).'. ' : '').e($u))
            ->implode('<br>');
    }

    public function cetak(Request $request)
    {
        $tahun = $request->query('tahun');
        $jenis = $request->query('jenis');

        $query = DB::table('sosialisasi_edukasi')->orderBy('tanggal_pelaksanaan', 'desc')->orderBy('id', 'desc');

        if ($tahun) {
            $query->whereYear('tanggal_pelaksanaan', $tahun);
        }

        if (in_array($jenis, ['Luar', 'Dalam'], true) && Schema::hasColumn('sosialisasi_edukasi', 'jenis_kegiatan')) {
            $query->where('jenis_kegiatan', $jenis);
        }

        $data = $query->get();

        return view('internal.pencegahan.cetak_sosialisasi', compact('data', 'tahun', 'jenis'));
    }

    public function cetakExcel(Request $request)
    {
        $tahun = $request->query('tahun');
        $jenis = $request->query('jenis');

        $query = DB::table('sosialisasi_edukasi')->orderBy('tanggal_pelaksanaan', 'desc')->orderBy('id', 'desc');

        if ($tahun) {
            $query->whereYear('tanggal_pelaksanaan', $tahun);
        }

        if (in_array($jenis, ['Luar', 'Dalam'], true) && Schema::hasColumn('sosialisasi_edukasi', 'jenis_kegiatan')) {
            $query->where('jenis_kegiatan', $jenis);
        }

        $data = $query->get();
        $dataLuar = $data->filter(fn ($row) => ($row->jenis_kegiatan ?? 'Luar') !== 'Dalam')->values();
        $dataDalam = $data->filter(fn ($row) => ($row->jenis_kegiatan ?? 'Luar') === 'Dalam')->values();

        $filename = 'Data_Sosialisasi_Edukasi_'.($tahun ?: date('Ymd')).'.xls';
        $html = '';

        if ($jenis !== 'Dalam') {
            $html .= '<h3 style="margin-bottom:6px;">A. SOSIALISASI DAN PENYULUHAN</h3>';
            $html .= '<table border="1" cellpadding="5" cellspacing="0">';
            $html .= '<thead><tr>';
            $html .= '<th style="background-color: #0f172a; color: white; text-align: center;">NO</th>';
            $html .= '<th style="background-color: #0f172a; color: white; text-align: center;">NAMA INSTANSI/LEMBAGA</th>';
            $html .= '<th style="background-color: #0f172a; color: white; text-align: center;">TEMPAT PELAKSANAAN</th>';
            $html .= '<th style="background-color: #0f172a; color: white; text-align: center;">ALAMAT</th>';
            $html .= '<th style="background-color: #0f172a; color: white; text-align: center;">TANGGAL PELAKSANAAN</th>';
            $html .= '<th style="background-color: #0f172a; color: white; text-align: center;">JUMLAH PESERTA</th>';
            $html .= '<th style="background-color: #0f172a; color: white; text-align: center;">NAMA PENANGGUNG JAWAB</th>';
            $html .= '<th style="background-color: #0f172a; color: white; text-align: center;">NO TELFON/WA PENANGGUNG JAWAB</th>';
            $html .= '<th style="background-color: #0f172a; color: white; text-align: center;">UPLOAD SPT</th>';
            $html .= '</tr></thead><tbody>';

            $totalPesertaLuar = 0;
            foreach ($dataLuar as $index => $row) {
                $tglRaw = $row->tanggal_pelaksanaan ?? null;
                $tanggal = $tglRaw ? Carbon::parse($tglRaw)->locale('id')->translatedFormat('d F Y') : '-';
                $peserta = (int) ($row->jumlah_peserta ?? 0);
                $totalPesertaLuar += $peserta;
                $sptRaw = $row->surat_perintah_tugas ?? null;
                $spt = $sptRaw ? url('/uploads/sosialisasi/'.$sptRaw) : '-';

                $html .= '<tr>';
                $html .= '<td style="text-align: center;">'.($index + 1).'</td>';
                $html .= '<td>'.e($row->nama_instansi ?? '-').'</td>';
                $html .= '<td>'.e($row->tempat_pelaksanaan ?? '-').'</td>';
                $html .= '<td>'.e($row->alamat ?? '-').'</td>';
                $html .= '<td style="text-align: center;">'.e($tanggal).'</td>';
                $html .= '<td style="text-align: center;">'.$peserta.' Orang</td>';
                $html .= '<td>'.e($row->nama_penanggung_jawab ?? '-').'</td>';
                $html .= '<td style="mso-number-format:\'\@\';">'.e($row->no_telepon ?? '-').'</td>';
                $html .= '<td style="text-align: center;">'.e($spt).'</td>';
                $html .= '</tr>';
            }

            if ($dataLuar->isEmpty()) {
                $html .= '<tr><td colspan="9" style="text-align: center;">Belum ada data Sosialisasi dan Penyuluhan.</td></tr>';
            } else {
                $html .= '<tr>';
                $html .= '<td colspan="5" style="text-align: right; font-weight: bold; background-color: #f3f4f6;">TOTAL PESERTA</td>';
                $html .= '<td style="text-align: center; font-weight: bold; background-color: #f3f4f6;">'.$totalPesertaLuar.' Orang</td>';
                $html .= '<td colspan="3" style="background-color: #f3f4f6;"></td>';
                $html .= '</tr>';
            }
            $html .= '</tbody></table><br>';
        }

        if ($jenis !== 'Luar') {
            $html .= '<h3 style="margin-bottom:6px;">B. KUNJUNGAN DAN EDUKASI</h3>';
            $html .= '<table border="1" cellpadding="5" cellspacing="0">';
            $html .= '<thead><tr>';
            $html .= '<th style="background-color: #164e63; color: white; text-align: center;">NO</th>';
            $html .= '<th style="background-color: #164e63; color: white; text-align: center;">NO DAN TANGGAL SURAT PERMOHONAN</th>';
            $html .= '<th style="background-color: #164e63; color: white; text-align: center;">NAMA INSTANSI/LEMBAGA (TK/SD/SLTP/SLTA/PERGURUAN TINGGI)</th>';
            $html .= '<th style="background-color: #164e63; color: white; text-align: center;">TEMPAT PELAKSANAAN</th>';
            $html .= '<th style="background-color: #164e63; color: white; text-align: center;">ALAMAT</th>';
            $html .= '<th style="background-color: #164e63; color: white; text-align: center;">TANGGAL PELAKSANAAN</th>';
            $html .= '<th style="background-color: #164e63; color: white; text-align: center;">JUMLAH PESERTA</th>';
            $html .= '<th style="background-color: #164e63; color: white; text-align: center;">NAMA PENANGGUNG JAWAB</th>';
            $html .= '<th style="background-color: #164e63; color: white; text-align: center;">NO TELFON/WA PENANGGUNG JAWAB</th>';
            $html .= '<th style="background-color: #164e63; color: white; text-align: center;">UPLOAD SPT</th>';
            $html .= '</tr></thead><tbody>';

            $totalPesertaDalam = 0;
            foreach ($dataDalam as $index => $row) {
                $tglRaw = $row->tanggal_pelaksanaan ?? null;
                $tanggal = $tglRaw ? Carbon::parse($tglRaw)->locale('id')->translatedFormat('d F Y') : '-';
                $peserta = (int) ($row->jumlah_peserta ?? 0);
                $totalPesertaDalam += $peserta;
                $sptRaw = $row->surat_perintah_tugas ?? null;
                $spt = $sptRaw ? url('/uploads/sosialisasi/'.$sptRaw) : '-';

                $html .= '<tr>';
                $html .= '<td style="text-align: center;">'.($index + 1).'</td>';
                $html .= '<td>'.e($row->no_tanggal_surat_permohonan ?? '-').'</td>';
                $html .= '<td>'.e($row->nama_instansi ?? '-').'</td>';
                $html .= '<td>'.e($row->tempat_pelaksanaan ?? '-').'</td>';
                $html .= '<td>'.e($row->alamat ?? '-').'</td>';
                $html .= '<td style="text-align: center;">'.e($tanggal).'</td>';
                $html .= '<td style="text-align: center;">'.$peserta.' Orang</td>';
                $html .= '<td>'.e($row->nama_penanggung_jawab ?? '-').'</td>';
                $html .= '<td style="mso-number-format:\'\@\';">'.e($row->no_telepon ?? '-').'</td>';
                $html .= '<td style="text-align: center;">'.e($spt).'</td>';
                $html .= '</tr>';
            }

            if ($dataDalam->isEmpty()) {
                $html .= '<tr><td colspan="10" style="text-align: center;">Belum ada data Kunjungan dan Edukasi.</td></tr>';
            } else {
                $html .= '<tr>';
                $html .= '<td colspan="6" style="text-align: right; font-weight: bold; background-color: #f3f4f6;">TOTAL PESERTA</td>';
                $html .= '<td style="text-align: center; font-weight: bold; background-color: #f3f4f6;">'.$totalPesertaDalam.' Orang</td>';
                $html .= '<td colspan="3" style="background-color: #f3f4f6;"></td>';
                $html .= '</tr>';
            }
            $html .= '</tbody></table>';
        }

        return response($html)
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }

    public function cetakPelatihan(Request $request)
    {
        $tahun = $request->query('tahun');

        $query = DB::table('pelatihan_keluarga')
            ->orderBy('tanggal_pelaksanaan', 'asc')
            ->orderBy('id', 'asc');

        if (filled($tahun)) {
            $query->whereYear('tanggal_pelaksanaan', (int) $tahun);
        }

        $data = $query->get();

        return view('internal.pencegahan.cetak_pelatihan', compact('data', 'tahun'));
    }

    public function cetakExcelPelatihan(Request $request)
    {
        $tahun = $request->query('tahun');

        $query = DB::table('pelatihan_keluarga')
            ->orderBy('tanggal_pelaksanaan', 'asc')
            ->orderBy('id', 'asc');

        if (filled($tahun)) {
            $query->whereYear('tanggal_pelaksanaan', (int) $tahun);
        }

        $data = $query->get();
        $labelTahun = filled($tahun) ? 'Tahun_'.$tahun : 'Semua_Tahun';
        $filename = 'Data_Pelatihan_Keluarga_'.$labelTahun.'_'.date('Ymd').'.xls';

        $html = '<table border="1" cellpadding="5" cellspacing="0">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">NO</th>';
        $html .= '<th style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">NAMA PESERTA</th>';
        $html .= '<th style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">JENIS KELAMIN</th>';
        $html .= '<th style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">KELURAHAN</th>';
        $html .= '<th style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">KECAMATAN</th>';
        $html .= '<th style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">HARI/TANGGAL PELAKSANAAN</th>';
        $html .= '<th style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">TEMPAT PELAKSANAAN</th>';
        $html .= '<th style="background-color: #0f172a; color: white; text-align: center; vertical-align: middle;">ALAMAT PELAKSANAAN</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $totalLaki = 0;
        $totalPerempuan = 0;

        foreach ($data as $index => $row) {
            $hariTanggal = ! empty($row->tanggal_pelaksanaan)
                ? mb_strtoupper(Carbon::parse($row->tanggal_pelaksanaan)->locale('id')->translatedFormat('l, d F Y'))
                : '-';

            $jk = trim((string) ($row->jenis_kelamin ?? ''));
            if (mb_strtolower($jk) === 'laki-laki') {
                $totalLaki++;
            } elseif (mb_strtolower($jk) === 'perempuan') {
                $totalPerempuan++;
            }

            $html .= '<tr>';
            $html .= '<td style="text-align: center; vertical-align: middle;">'.($index + 1).'</td>';
            $html .= '<td style="vertical-align: middle;">'.e($row->nama_peserta ?? '-').'</td>';
            $html .= '<td style="text-align: center; vertical-align: middle;">'.e($jk !== '' ? $jk : '-').'</td>';
            $html .= '<td style="text-align: center; vertical-align: middle;">'.e($row->kelurahan ?? '-').'</td>';
            $html .= '<td style="text-align: center; vertical-align: middle;">'.e($row->kecamatan ?? '-').'</td>';
            $html .= '<td style="text-align: center; vertical-align: middle;">'.e($hariTanggal).'</td>';
            $html .= '<td style="text-align: center; vertical-align: middle;">'.e($row->tempat_pelaksanaan ?? '-').'</td>';
            $html .= '<td style="vertical-align: middle;">'.e($row->alamat_pelaksanaan ?? '-').'</td>';
            $html .= '</tr>';
        }

        if ($data->isEmpty()) {
            $html .= '<tr><td colspan="8" style="text-align: center;">Belum ada data Pelatihan Keluarga Tanggap Kebakaran.</td></tr>';
        } else {
            $html .= '<tr>';
            $html .= '<td colspan="8" style="text-align: right; font-weight: bold; background-color: #f3f4f6;">TOTAL PESERTA: '.$data->count().' ORANG (LAKI-LAKI: '.$totalLaki.' | PEREMPUAN: '.$totalPerempuan.')</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';

        return response($html)
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }
}

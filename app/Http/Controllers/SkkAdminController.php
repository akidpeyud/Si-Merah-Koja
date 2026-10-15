<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermohonanSkk;
use App\Models\PermohonanPerpanjangSkk;
use Illuminate\Support\Facades\Storage;

class SkkAdminController extends Controller
{
    /** Field khusus perpanjangan (tidak dipakai di SKK Baru). */
    private const FIELD_PERPANJANG = [
        'nomor_skk_lama',
        'tanggal_terbit_skk_lama',
        'masa_berlaku_skk_lama',
        'file_skk_lama',
    ];

    /** Aturan validasi data utama (dipakai store & update). */
    private function aturanDasar(): array
    {
        return [
            'nama_pemohon'           => 'required|string|max:150',
            'email_pemohon'          => 'required|email|max:100',
            'no_whatsapp'            => 'required|string|max:25',
            'nama_usaha'             => 'required|string|max:150',
            'nik_pemilik_usaha'      => 'required|string|max:30',
            'alamat_pemilik_usaha'   => 'required|string',
            'kategori_bangunan'      => 'required|string|max:100',
            'alamat_bangunan'        => 'required|string',
            'kecamatan'              => 'required|string|max:100',
            'kelurahan'              => 'required|string|max:100',
            'luas_lahan'             => 'required|numeric',
            'luas_bangunan'          => 'required|numeric',
            'tinggi_bangunan'        => 'required|numeric',
            'status_permohonan'      => 'required|in:Pending,Diproses,Memenuhi Syarat,Tidak Memenuhi Syarat',
            'file_surat_permohonan'  => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];
    }

    /** Aturan tambahan khusus perpanjangan. */
    private function aturanPerpanjang(bool $wajib): array
    {
        $req = $wajib ? 'required' : 'nullable';

        return [
            'nomor_skk_lama'          => $req . '|string|max:100',
            'tanggal_terbit_skk_lama' => $req . '|date',
            'masa_berlaku_skk_lama'   => $req . '|date',
            'file_skk_lama'           => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];
    }

    /** Ambil model sesuai tipe (baru / perpanjang). */
    private function cariData(string $tipe, $id)
    {
        return $tipe === 'perpanjang'
            ? PermohonanPerpanjangSkk::findOrFail($id)
            : PermohonanSkk::findOrFail($id);
    }

    /** Hapus file di storage publik jika benar-benar ada. */
    private function hapusFile(?string $path): void
    {
        if ($path && $path !== 'offline_registered' && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    // 1. Menampilkan halaman rekap daftar permohonan SKK
    public function index()
    {
        $skk_baru = PermohonanSkk::orderBy('created_at', 'desc')->get();
        $skk_perpanjang = PermohonanPerpanjangSkk::orderBy('created_at', 'desc')->get();

        return view('internal.pencegahan.kelola_skk', compact('skk_baru', 'skk_perpanjang'));
    }

    // 2. Menampilkan Form Tambah Permohonan SKK
    public function create()
    {
        return view('internal.pencegahan.tambah_skk');
    }

    // 3. Menyimpan Data Permohonan SKK (Baru / Perpanjangan)
    public function store(Request $request)
    {
        $perpanjang = $request->input('tipe_permohonan') === 'perpanjang';

        $request->validate(array_merge(
            ['tipe_permohonan' => 'required|in:baru,perpanjang'],
            $this->aturanDasar(),
            $this->aturanPerpanjang($perpanjang)
        ));

        $data = $request->except(['_token', 'tipe_permohonan']);

        $data['file_surat_permohonan'] = $request->hasFile('file_surat_permohonan')
            ? $request->file('file_surat_permohonan')->store('skk_surat', 'public')
            : 'offline_registered';

        if ($perpanjang) {
            if ($request->hasFile('file_skk_lama')) {
                $data['file_skk_lama'] = $request->file('file_skk_lama')->store('skk_lama', 'public');
            }
            PermohonanPerpanjangSkk::create($data);
            $pesan = 'Data Perpanjangan SKK berhasil ditambahkan!';
        } else {
            // field khusus perpanjangan tidak disimpan ke SKK Baru
            $data = array_diff_key($data, array_flip(self::FIELD_PERPANJANG));
            PermohonanSkk::create($data);
            $pesan = 'Data Permohonan SKK baru berhasil ditambahkan!';
        }

        return redirect('/internal/pencegahan/kelola-skk')->with('success', $pesan);
    }

    // 4. Menampilkan Form Edit Data SKK
    public function edit(Request $request, $id)
    {
        $tipe = $request->query('tipe', 'baru');
        $p = $this->cariData($tipe, $id);

        return view('internal.pencegahan.edit_skk', compact('p', 'tipe'));
    }

    // 5. Memproses Pembaruan (Update) Data SKK
    public function update(Request $request, $id)
    {
        $tipe = $request->query('tipe', 'baru');
        $perpanjang = $tipe === 'perpanjang';
        $p = $this->cariData($tipe, $id);

        $aturan = $this->aturanDasar();
        if ($perpanjang) {
            // di form edit, field SKK lama baru divalidasi jika memang dikirim
            $aturan = array_merge($aturan, $this->aturanPerpanjang(false));
        }
        $request->validate($aturan);

        $data = $request->except(['_token', '_method', 'tipe', 'tipe_permohonan']);

        if ($request->hasFile('file_surat_permohonan')) {
            $this->hapusFile($p->file_surat_permohonan);
            $data['file_surat_permohonan'] = $request->file('file_surat_permohonan')->store('skk_surat', 'public');
        }

        if ($perpanjang && $request->hasFile('file_skk_lama')) {
            $this->hapusFile($p->file_skk_lama);
            $data['file_skk_lama'] = $request->file('file_skk_lama')->store('skk_lama', 'public');
        }

        if (!$perpanjang) {
            $data = array_diff_key($data, array_flip(self::FIELD_PERPANJANG));
        }

        $p->update($data);

        return redirect('/internal/pencegahan/kelola-skk')->with('success', 'Data Permohonan SKK berhasil diperbarui!');
    }

    // 6. Menghapus Data SKK dari Sistem
    public function destroy(Request $request, $id)
    {
        $tipe = $request->query('tipe', 'baru');
        $p = $this->cariData($tipe, $id);

        $this->hapusFile($p->file_surat_permohonan);
        if ($tipe === 'perpanjang') {
            $this->hapusFile($p->file_skk_lama);
        }

        $p->delete();

        return back()->with('success', 'Data Permohonan SKK berhasil dihapus dari sistem.');
    }

    // 7. Menampilkan Detail Data SKK (Tampilan Read-only)
    public function show(Request $request, $id)
    {
        $tipe = $request->query('tipe', 'baru');
        $permohonan = $this->cariData($tipe, $id);
        $jenis_layanan = $tipe === 'perpanjang' ? 'Perpanjangan SKK' : 'SKK Baru';

        return view('internal.pencegahan.detail_skk', compact('permohonan', 'tipe', 'jenis_layanan'));
    }

    // 8. Update Status SKK Baru
    public function updateStatus(Request $request, $id)
    {
        PermohonanSkk::where('id', $id)->update(['status_permohonan' => $request->status_permohonan]);
        return redirect()->back()->with('success', 'Status Permohonan SKK Baru berhasil diperbarui!');
    }

    // 9. Update Status SKK Perpanjang
    public function updateStatusPerpanjang(Request $request, $id)
    {
        PermohonanPerpanjangSkk::where('id', $id)->update(['status_permohonan' => $request->status_permohonan]);
        return redirect()->back()->with('success', 'Status Permohonan Perpanjangan SKK berhasil diperbarui!');
    }
}
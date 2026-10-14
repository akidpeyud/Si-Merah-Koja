<?php

namespace App\Http\Controllers;

use App\Models\PenggunaanSarana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PenggunaanSaranaController extends Controller
{
    // Daftar sarana yang boleh dimohonkan (samakan dengan $daftar_sarana di blade)
    private const DAFTAR_SARANA = ['Mobil Damkar'];

    // Status permohonan (default saat pemohon submit: "Menunggu")
    private const DAFTAR_STATUS = ['Menunggu', 'Proses', 'Disetujui', 'Ditolak'];

    // =====================================================================
    // SISI PEMOHON
    // =====================================================================
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'                  => 'required|string|max:255',
            'nik'                   => 'required|digits:16',
            'no_hp'                 => 'required|string|max:20',
            'alamat'                => 'required|string|max:255',
            'jenis_pemohon'         => ['required', Rule::in(['perorangan', 'fasum', 'instansi'])],
            'nama_penanggung_jawab' => 'required|string|max:255',
            'nama_instansi'         => 'required|string|max:255',
            'alamat_instansi'       => 'required|string|max:255',
            'sarana'                => ['required', Rule::in(self::DAFTAR_SARANA)],
            'kegunaan'              => 'required|string|max:1000',
            'nama_kegiatan'         => 'required|string|max:255',
            'lokasi_kegiatan'       => 'required|string|max:255',
            'tgl_pelaksanaan'       => 'required|date|after_or_equal:today',
            'waktu_mulai'           => 'required|date_format:H:i',
            'waktu_selesai'         => 'required|date_format:H:i|after:waktu_mulai',
            'foto_lokasi'           => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'surat_permohonan'      => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            'required'     => ':attribute wajib diisi.',
            'digits'       => ':attribute harus :digits digit.',
            'max'          => ':attribute terlalu panjang atau ukurannya melebihi batas.',
            'in'           => ':attribute tidak valid.',
            'date'         => ':attribute bukan tanggal yang valid.',
            'after_or_equal' => ':attribute tidak boleh sebelum hari ini.',
            'after'        => ':attribute harus setelah waktu mulai.',
            'date_format'  => 'Format :attribute tidak valid.',
            'image'        => ':attribute harus berupa gambar.',
            'mimes'        => ':attribute harus berformat :values.',
        ], $this->attributeLabels());

        $data['foto_lokasi']      = $request->file('foto_lokasi')->store('penggunaan-sarana/foto', 'public');
        $data['surat_permohonan'] = $request->file('surat_permohonan')->store('penggunaan-sarana/surat', 'public');
        $data['pemohon_id']       = session('pemohon_id');
        $data['status']           = 'Menunggu';

        PenggunaanSarana::create($data);

        return redirect()->route('penggunaan-sarana')
            ->with('success', 'Permohonan berhasil dikirim.');
    }

    // =====================================================================
    // SISI ADMIN / PEGAWAI INTERNAL
    // =====================================================================

    // Daftar semua permohonan (semua role yang login)
    public function indexInternal()
    {
        $permohonan = PenggunaanSarana::latest()->get();

        return view('internal.damtan.kelola_penggunaan_sarana', compact('permohonan'));
    }

    // Detail permohonan (semua role yang login)
    public function showInternal($id)
    {
        $row = PenggunaanSarana::findOrFail($id);

        return view('internal.damtan.detail_penggunaan_sarana', compact('row'));
    }

    // Form edit (Damtan & Super User)
    public function editInternal($id)
    {
        $row          = PenggunaanSarana::findOrFail($id);
        $daftarSarana = self::DAFTAR_SARANA;
        $daftarStatus = self::DAFTAR_STATUS;

        return view('internal.damtan.edit_penggunaan_sarana', compact('row', 'daftarSarana', 'daftarStatus'));
    }

    // Simpan perubahan (Damtan & Super User)
    public function updateInternal(Request $request, $id)
    {
        $row = PenggunaanSarana::findOrFail($id);

        $data = $request->validate([
            'nama'                  => 'required|string|max:255',
            'nik'                   => 'required|digits:16',
            'no_hp'                 => 'required|string|max:20',
            'alamat'                => 'required|string|max:255',
            'jenis_pemohon'         => ['required', Rule::in(['perorangan', 'fasum', 'instansi'])],
            'nama_penanggung_jawab' => 'required|string|max:255',
            'nama_instansi'         => 'required|string|max:255',
            'alamat_instansi'       => 'required|string|max:255',
            'sarana'                => ['required', Rule::in(self::DAFTAR_SARANA)],
            'kegunaan'              => 'required|string|max:1000',
            'nama_kegiatan'         => 'required|string|max:255',
            'lokasi_kegiatan'       => 'required|string|max:255',
            // Admin boleh mengedit acara yang tanggalnya sudah lewat
            'tgl_pelaksanaan'       => 'required|date',
            'waktu_mulai'           => 'required|date_format:H:i',
            'waktu_selesai'         => 'required|date_format:H:i|after:waktu_mulai',
            'status'                => ['required', Rule::in(self::DAFTAR_STATUS)],
            // File opsional saat edit: kosong = pakai file lama
            'foto_lokasi'           => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'surat_permohonan'      => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            'required'    => ':attribute wajib diisi.',
            'digits'      => ':attribute harus :digits digit.',
            'max'         => ':attribute terlalu panjang atau ukurannya melebihi batas.',
            'in'          => ':attribute tidak valid.',
            'date'        => ':attribute bukan tanggal yang valid.',
            'after'       => ':attribute harus setelah waktu mulai.',
            'date_format' => 'Format :attribute tidak valid.',
            'image'       => ':attribute harus berupa gambar.',
            'mimes'       => ':attribute harus berformat :values.',
        ], $this->attributeLabels() + ['status' => 'Status']);

        if ($request->hasFile('foto_lokasi')) {
            $this->hapusFile($row->foto_lokasi);
            $data['foto_lokasi'] = $request->file('foto_lokasi')->store('penggunaan-sarana/foto', 'public');
        } else {
            unset($data['foto_lokasi']);
        }

        if ($request->hasFile('surat_permohonan')) {
            $this->hapusFile($row->surat_permohonan);
            $data['surat_permohonan'] = $request->file('surat_permohonan')->store('penggunaan-sarana/surat', 'public');
        } else {
            unset($data['surat_permohonan']);
        }

        $row->update($data);

        return redirect()->route('internal.penggunaan-sarana.index')
            ->with('success', 'Data permohonan berhasil diperbarui.');
    }

    // Ubah status dari dropdown di tabel (Damtan & Super User)
    public function updateStatusInternal(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', Rule::in(self::DAFTAR_STATUS)],
        ]);

        PenggunaanSarana::findOrFail($id)->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status permohonan berhasil diperbarui.');
    }

    // Hapus permohonan beserta file-nya (Damtan & Super User)
    public function destroyInternal($id)
    {
        $row = PenggunaanSarana::findOrFail($id);

        $this->hapusFile($row->foto_lokasi);
        $this->hapusFile($row->surat_permohonan);
        $row->delete();

        return redirect()->route('internal.penggunaan-sarana.index')
            ->with('success', 'Permohonan berhasil dihapus.');
    }

    // =====================================================================
    // CEK STATUS PERMOHONAN (SISI PEMOHON, dipanggil via fetch/AJAX)
    // =====================================================================
    public function cekStatus(Request $request)
    {
        $request->validate([
            'kontak' => 'required|string|max:20',
        ], [
            'kontak.required' => 'Masukkan NIK atau nomor HP/WA.',
            'kontak.max'      => 'NIK atau nomor HP/WA terlalu panjang.',
        ]);

        $kontak = preg_replace('/\D/', '', $request->kontak);

        if (strlen($kontak) < 9) {
            return response()->json(['message' => 'NIK (16 digit) atau nomor HP/WA tidak valid.'], 422);
        }

        // Variasi penulisan nomor HP: 08xx / 628xx
        $varian = [$kontak];
        if (str_starts_with($kontak, '62')) {
            $varian[] = '0' . substr($kontak, 2);
        } elseif (str_starts_with($kontak, '0')) {
            $varian[] = '62' . substr($kontak, 1);
        }

        $hasil = PenggunaanSarana::where(function ($q) use ($kontak, $varian) {
                $q->where('nik', $kontak)->orWhereIn('no_hp', $varian);
            })
            ->latest()
            ->limit(10)
            ->get()
            ->map(fn ($r) => [
                // Data pribadi disamarkan: hanya info yang perlu untuk mengenali permohonan
                'nama'     => $this->maskNama($r->nama),
                'kegiatan' => $r->nama_kegiatan,
                'sarana'   => $r->sarana,
                'tanggal'  => \Carbon\Carbon::parse($r->tgl_pelaksanaan)->translatedFormat('d F Y'),
                'diajukan' => optional($r->created_at)->translatedFormat('d M Y'),
                'status'   => $r->status,
            ]);

        return response()->json(['data' => $hasil]);
    }

    private function maskNama(string $nama): string
    {
        return collect(preg_split('/\s+/', trim($nama)))
            ->map(fn ($kata) => mb_substr($kata, 0, 2) . str_repeat('*', max(mb_strlen($kata) - 2, 0)))
            ->implode(' ');
    }

    // =====================================================================
    // HELPER
    // =====================================================================
    private function hapusFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function attributeLabels(): array
    {
        return [
            'nama'                  => 'Nama',
            'nik'                   => 'NIK',
            'no_hp'                 => 'No HP/WA',
            'alamat'                => 'Alamat',
            'jenis_pemohon'         => 'Jenis pemohon',
            'nama_penanggung_jawab' => 'Nama penanggung jawab',
            'nama_instansi'         => 'Nama instansi/fasilitas umum/perorangan',
            'alamat_instansi'       => 'Alamat instansi',
            'sarana'                => 'Sarana',
            'kegunaan'              => 'Kegunaan sarana',
            'nama_kegiatan'         => 'Nama kegiatan',
            'lokasi_kegiatan'       => 'Lokasi kegiatan',
            'tgl_pelaksanaan'       => 'Tanggal pelaksanaan',
            'waktu_mulai'           => 'Waktu mulai',
            'waktu_selesai'         => 'Waktu selesai',
            'foto_lokasi'           => 'Foto lokasi kegiatan',
            'surat_permohonan'      => 'Surat permohonan',
        ];
    }
}
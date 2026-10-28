<?php

namespace App\Http\Controllers;

use App\Models\IzinKeramaian;
use App\Models\PenggunaanSarana;
use App\Models\PermohonanEdukasi;
use App\Models\PermohonanPerpanjangSkk;
use App\Models\PermohonanRpkbgl;
use App\Models\PermohonanSkk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PemohonDashboardController extends Controller
{
    /**
     * Menampilkan dashboard terpadu pemohon (Monitoring Berkas & Profil).
     */
    public function index(Request $request)
    {
        $pemohonId = session('pemohon_id');
        if (! $pemohonId) {
            return redirect()->route('pemohon.login')
                ->with('error', 'Sesi login telah berakhir. Silakan masuk kembali.');
        }

        $pemohon = DB::table('pemohons')->where('id', $pemohonId)->first();
        if (! $pemohon) {
            session()->forget(['pemohon_id', 'pemohon_nama', 'pemohon_email', 'pemohon_role']);

            return redirect()->route('pemohon.login')
                ->with('error', 'Data akun tidak ditemukan.');
        }

        $nik = trim((string) $pemohon->nik);
        $waRaw = preg_replace('/\D/', '', (string) $pemohon->no_whatsapp);

        $waVariants = array_filter(array_unique([
            $waRaw,
            str_starts_with($waRaw, '62') ? '0'.substr($waRaw, 2) : $waRaw,
            str_starts_with($waRaw, '0') ? '62'.substr($waRaw, 1) : $waRaw,
            '+'.(str_starts_with($waRaw, '0') ? '62'.substr($waRaw, 1) : $waRaw),
            (string) $pemohon->no_whatsapp,
        ]));

        // 1. Permohonan SKK Baru
        $skkBaru = PermohonanSkk::where(function ($q) use ($nik, $waVariants) {
            if ($nik !== '') {
                $q->where('nik_pemilik_usaha', $nik);
            }
            if (! empty($waVariants)) {
                $q->orWhereIn('no_whatsapp', $waVariants);
            }
        })->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'layanan' => 'Sertifikat Keselamatan Kebakaran (SKK) Baru',
                'layanan_singkat' => 'SKK Baru',
                'kategori_layanan' => 'skk',
                'kode' => 'SKK-B-'.str_pad($item->id, 4, '0', STR_PAD_LEFT),
                'judul' => $item->nama_usaha ?: ($item->nama_pemohon ?? '-'),
                'subjudul' => 'Kategori: '.($item->kategori_bangunan ?? '-'),
                'lokasi' => $item->alamat_bangunan ?? '-',
                'status' => $this->normalizeStatus($item->status_permohonan),
                'status_raw' => $item->status_permohonan ?? 'Pending',
                'tanggal' => $item->created_at,
                'detail' => [
                    'Nama Pemohon' => $item->nama_pemohon,
                    'Nama Usaha / Bangunan' => $item->nama_usaha,
                    'Kategori Bangunan' => $item->kategori_bangunan,
                    'Alamat Bangunan' => $item->alamat_bangunan,
                    'Kecamatan' => $item->kecamatan,
                    'Kelurahan' => $item->kelurahan,
                    'Luas Bangunan' => $item->luas_bangunan ? $item->luas_bangunan.' m²' : '-',
                ],
            ];
        });

        // 2. Permohonan Perpanjangan SKK
        $skkPerpanjang = PermohonanPerpanjangSkk::where(function ($q) use ($nik, $waVariants) {
            if ($nik !== '') {
                $q->where('nik_pemilik_usaha', $nik);
            }
            if (! empty($waVariants)) {
                $q->orWhereIn('no_whatsapp', $waVariants);
            }
        })->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'layanan' => 'Perpanjangan SKK',
                'layanan_singkat' => 'Perpanjang SKK',
                'kategori_layanan' => 'skk',
                'kode' => 'SKK-P-'.str_pad($item->id, 4, '0', STR_PAD_LEFT),
                'judul' => $item->nama_usaha ?: ($item->nama_pemohon ?? '-'),
                'subjudul' => 'No. SKK Lama: '.($item->nomor_skk_lama ?? '-'),
                'lokasi' => $item->alamat_bangunan ?? '-',
                'status' => $this->normalizeStatus($item->status_permohonan),
                'status_raw' => $item->status_permohonan ?? 'Pending',
                'tanggal' => $item->created_at,
                'detail' => [
                    'Nama Pemohon' => $item->nama_pemohon,
                    'Nama Usaha' => $item->nama_usaha,
                    'No. SKK Lama' => $item->nomor_skk_lama,
                    'Alamat Bangunan' => $item->alamat_bangunan,
                ],
            ];
        });

        // 3. Permohonan RPKBGL
        $rpkbgl = PermohonanRpkbgl::where(function ($q) use ($nik, $waVariants) {
            if ($nik !== '') {
                $q->where('nik_pemilik_usaha', $nik);
            }
            if (! empty($waVariants)) {
                $q->orWhereIn('no_whatsapp', $waVariants);
            }
        })->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'layanan' => 'Rekomendasi Proteksi Kebakaran (RPKBGL)',
                'layanan_singkat' => 'RPKBGL',
                'kategori_layanan' => 'rpkbgl',
                'kode' => 'RPK-'.str_pad($item->id, 4, '0', STR_PAD_LEFT),
                'judul' => $item->nama_usaha ?: ($item->nama_pemohon ?? '-'),
                'subjudul' => 'Kategori: '.($item->kategori_bangunan ?? '-'),
                'lokasi' => $item->alamat_bangunan ?? '-',
                'status' => $this->normalizeStatus($item->status_permohonan),
                'status_raw' => $item->status_permohonan ?? 'Pending',
                'tanggal' => $item->created_at,
                'detail' => [
                    'Nama Pemohon' => $item->nama_pemohon,
                    'Nama Usaha' => $item->nama_usaha,
                    'Alamat Bangunan' => $item->alamat_bangunan,
                    'Jadwal Pemeriksaan' => $item->tgl_pemeriksaan ? Carbon::parse($item->tgl_pemeriksaan)->format('d M Y') : 'Menunggu Penjadwalan',
                ],
            ];
        });

        // 4. Izin Keramaian
        $izinKeramaian = IzinKeramaian::where(function ($q) use ($nik, $waVariants) {
            if ($nik !== '') {
                $q->where('nik', $nik);
            }
            if (! empty($waVariants)) {
                $q->orWhereIn('no_hp', $waVariants);
            }
        })->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'layanan' => 'Izin Rekomendasi Keramaian',
                'layanan_singkat' => 'Izin Keramaian',
                'kategori_layanan' => 'keramaian',
                'kode' => 'KRM-'.str_pad($item->id, 4, '0', STR_PAD_LEFT),
                'judul' => $item->nama_acara ?: ($item->nama ?? '-'),
                'subjudul' => 'Event: '.ucfirst($item->jenis_event ?? 'Acara'),
                'lokasi' => $item->lokasi_acara ?? '-',
                'status' => $this->normalizeStatus($item->status_permohonan),
                'status_raw' => $item->status_permohonan ?? 'Pending',
                'tanggal' => $item->created_at,
                'detail' => [
                    'Nama Pemohon' => $item->nama,
                    'Nama Acara' => $item->nama_acara,
                    'Jenis Event' => ucfirst($item->jenis_event ?? '-'),
                    'Lokasi Acara' => $item->lokasi_acara,
                    'Tgl Pelaksanaan' => $item->tgl_pelaksanaan ? Carbon::parse($item->tgl_pelaksanaan)->format('d M Y') : '-',
                    'Waktu Acara' => ($item->waktu_mulai ?? '-').' s/d '.($item->waktu_selesai ?? '-'),
                ],
            ];
        });

        // 5. Penggunaan Sarana Damkar
        $sarana = PenggunaanSarana::where(function ($q) use ($pemohon, $nik, $waVariants) {
            $q->where('pemohon_id', $pemohon->id);
            if ($nik !== '') {
                $q->orWhere('nik', $nik);
            }
            if (! empty($waVariants)) {
                $q->orWhereIn('no_hp', $waVariants);
            }
        })->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'layanan' => 'Permohonan Penggunaan Sarana Pemadam',
                'layanan_singkat' => 'Sarana Damkar',
                'kategori_layanan' => 'sarana',
                'kode' => 'SRN-'.str_pad($item->id, 4, '0', STR_PAD_LEFT),
                'judul' => $item->nama_kegiatan ?: ($item->sarana ?? '-'),
                'subjudul' => 'Sarana: '.($item->sarana ?? '-'),
                'lokasi' => $item->lokasi_kegiatan ?? '-',
                'status' => $this->normalizeStatus($item->status),
                'status_raw' => $item->status ?? 'Menunggu',
                'tanggal' => $item->created_at,
                'detail' => [
                    'Nama Pemohon' => $item->nama,
                    'Sarana Dimohon' => $item->sarana,
                    'Nama Kegiatan' => $item->nama_kegiatan,
                    'Lokasi Kegiatan' => $item->lokasi_kegiatan,
                    'Tgl Pelaksanaan' => $item->tgl_pelaksanaan ? Carbon::parse($item->tgl_pelaksanaan)->format('d M Y') : '-',
                ],
            ];
        });

        // 6. Edukasi & Sosialisasi
        $edukasi = PermohonanEdukasi::where(function ($q) use ($nik, $waVariants) {
            if ($nik !== '') {
                $q->where('nik', $nik);
            }
            if (! empty($waVariants)) {
                $q->orWhereIn('no_kontak', $waVariants);
            }
        })->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'layanan' => 'Edukasi & Sosialisasi Kebakaran',
                'layanan_singkat' => 'Edukasi Damkar',
                'kategori_layanan' => 'edukasi',
                'kode' => 'EDU-'.str_pad($item->id, 4, '0', STR_PAD_LEFT),
                'judul' => $item->institusi ?: ($item->nama_pemohon ?? '-'),
                'subjudul' => 'Pemohon: '.($item->nama_pemohon ?? '-'),
                'lokasi' => $item->alamat_institusi ?? '-',
                'status' => $this->normalizeStatus($item->status_permohonan),
                'status_raw' => $item->status_permohonan ?? 'Pending',
                'tanggal' => $item->created_at,
                'detail' => [
                    'Institusi / Lembaga' => $item->institusi,
                    'Nama Pemohon' => $item->nama_pemohon,
                    'Jabatan' => $item->jabatan_pemohon,
                    'Alamat Institusi' => $item->alamat_institusi,
                    'Tgl Kegiatan' => $item->tgl_kegiatan ? Carbon::parse($item->tgl_kegiatan)->format('d M Y') : '-',
                ],
            ];
        });

        // Gabungkan seluruh permohonan dan urutkan dari yang terbaru
        $semuaPermohonan = $skkBaru
            ->concat($skkPerpanjang)
            ->concat($rpkbgl)
            ->concat($izinKeramaian)
            ->concat($sarana)
            ->concat($edukasi)
            ->sortByDesc(fn ($it) => $it['tanggal'] ? $it['tanggal']->timestamp : 0)
            ->values();

        $stats = [
            'total' => $semuaPermohonan->count(),
            'menunggu' => $semuaPermohonan->where('status', 'Menunggu')->count(),
            'proses' => $semuaPermohonan->where('status', 'Diproses')->count(),
            'disetujui' => $semuaPermohonan->where('status', 'Disetujui')->count(),
            'ditolak' => $semuaPermohonan->where('status', 'Ditolak')->count(),
        ];

        $tabAktif = $request->query('tab', 'monitoring');

        return view('pemohon.dashboard', compact('pemohon', 'semuaPermohonan', 'stats', 'tabAktif'));
    }

    /**
     * Memperbarui profil pemohon (Nama, Nomor WhatsApp, Email).
     */
    public function updateProfil(Request $request)
    {
        $pemohonId = session('pemohon_id');
        if (! $pemohonId) {
            return redirect()->route('pemohon.login');
        }

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_whatsapp' => 'required|string|min:10|max:15|regex:/^[0-9+]+$/',
            'email' => 'required|email|max:255|unique:pemohons,email,'.$pemohonId.',id',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'no_whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'no_whatsapp.min' => 'Nomor WhatsApp minimal 10 digit.',
            'no_whatsapp.max' => 'Nomor WhatsApp maksimal 15 digit.',
            'no_whatsapp.regex' => 'Format nomor WhatsApp tidak valid.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh akun lain.',
        ]);

        DB::table('pemohons')->where('id', $pemohonId)->update([
            'nama_lengkap' => $validated['nama_lengkap'],
            'no_whatsapp' => $validated['no_whatsapp'],
            'email' => $validated['email'],
            'updated_at' => now(),
        ]);

        session([
            'pemohon_nama' => $validated['nama_lengkap'],
            'pemohon_email' => $validated['email'],
        ]);

        return redirect()->route('pemohon.dashboard', ['tab' => 'profil'])
            ->with('success', 'Profil akun Anda berhasil diperbarui!');
    }

    /**
     * Memperbarui kata sandi akun pemohon.
     */
    public function updatePassword(Request $request)
    {
        $pemohonId = session('pemohon_id');
        if (! $pemohonId) {
            return redirect()->route('pemohon.login');
        }

        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi baru minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        $pemohon = DB::table('pemohons')->where('id', $pemohonId)->first();
        if (! $pemohon || ! Hash::check($request->current_password, $pemohon->password)) {
            return redirect()->route('pemohon.dashboard', ['tab' => 'profil'])
                ->withErrors(['current_password' => 'Kata sandi saat ini yang Anda masukkan salah.'])
                ->withInput();
        }

        DB::table('pemohons')->where('id', $pemohonId)->update([
            'password' => Hash::make($request->password),
            'updated_at' => now(),
        ]);

        return redirect()->route('pemohon.dashboard', ['tab' => 'profil'])
            ->with('success', 'Kata sandi Anda berhasil diperbarui!');
    }

    /**
     * Normalisasi status permohonan ke 4 kategori standar.
     */
    private function normalizeStatus(?string $status): string
    {
        $s = strtolower(trim((string) $status));

        return match ($s) {
            'disetujui', 'selesai', 'memenuhi syarat', 'diterima' => 'Disetujui',
            'proses', 'diproses' => 'Diproses',
            'ditolak', 'tidak memenuhi syarat' => 'Ditolak',
            default => 'Menunggu',
        };
    }
}

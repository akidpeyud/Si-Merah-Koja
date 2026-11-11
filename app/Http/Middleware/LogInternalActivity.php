<?php

namespace App\Http\Middleware;

use App\Models\ActivityLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class LogInternalActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Hanya catat jika user login dan request melakukan manipulasi data (POST, PUT, PATCH, DELETE)
        $method = strtoupper($request->method());
        if (! Auth::check() || in_array($method, ['GET', 'HEAD', 'OPTIONS'])) {
            return $response;
        }

        // Jangan catat jika request gagal / error (status code >= 400 atau terdapat validation error di session)
        $statusCode = $response->getStatusCode();
        if ($statusCode >= 400 || session()->has('errors')) {
            return $response;
        }

        $path = trim($request->path(), '/');

        // Lewati rute non-CRUD internal atau preview
        if ($this->shouldIgnore($path)) {
            return $response;
        }

        try {
            $action = $this->determineAction($method, $path);
            $module = $this->determineModule($path);
            $description = $this->generateDescription($action, $module, $request);

            // Filter data sensitif dan objek file sebelum disimpan ke properties
            $rawInput = $request->except(['password', 'password_confirmation', 'password_baru', 'password_baru_confirmation', '_token', '_method']);
            $safeInput = [];
            foreach ($rawInput as $key => $val) {
                if ($val instanceof UploadedFile) {
                    $safeInput[$key] = '[File: '.$val->getClientOriginalName().']';
                } elseif (is_scalar($val) || is_array($val) || is_null($val)) {
                    $safeInput[$key] = $val;
                }
            }

            ActivityLog::record(
                action: $action,
                module: $module,
                description: $description,
                properties: ! empty($safeInput) ? array_slice($safeInput, 0, 10) : null,
                user: Auth::user()
            );
        } catch (\Throwable $e) {
            // Jangan biarkan kegagalan logging menghentikan alur aplikasi
            report($e);
        }

        return $response;
    }

    /**
     * Cek apakah rute harus diabaikan dari pencatatan log
     */
    protected function shouldIgnore(string $path): bool
    {
        $ignoredPatterns = [
            'login',
            'logout',
            'lupa-password',
            'fetch-link-preview',
            'preview',
            'cek-status',
        ];

        foreach ($ignoredPatterns as $pattern) {
            if (str_contains($path, $pattern)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Tentukan jenis aksi (Tambah, Ubah, Hapus)
     */
    protected function determineAction(string $method, string $path): string
    {
        if ($method === 'DELETE' || str_contains($path, 'hapus') || str_contains($path, 'delete')) {
            return 'Hapus';
        }

        if ($method === 'PUT' || $method === 'PATCH' || str_contains($path, 'update') || str_contains($path, 'edit')) {
            return 'Ubah';
        }

        if ($method === 'POST' || str_contains($path, 'store') || str_contains($path, 'tambah') || str_contains($path, 'create') || str_contains($path, 'simpan') || str_contains($path, 'import')) {
            return 'Tambah';
        }

        return 'Proses';
    }

    /**
     * Tentukan nama modul yang ramah manusia
     */
    protected function determineModule(string $path): string
    {
        $moduleMap = [
            'internal/kelola-user' => 'Kelola Pengguna',
            'internal/kelola-pemohon' => 'Kelola Akun Pemohon',
            'internal/profil-instansi' => 'Profil Instansi',
            'internal/profil' => 'Profil Pengguna',
            'internal/operator/kelola-berita' => 'Berita',
            'internal/operator/background-beranda' => 'Background Beranda',
            'internal/operator/infografis' => 'Info Grafis',
            'internal/operator/berita-medsos' => 'Berita Medsos',
            'internal/operator/ujung-damkar' => 'Ujung-Ujung Damkar',
            'internal/operator/edu-damkar' => 'Edu Damkar',
            'internal/operator/kejadian' => 'Kejadian',
            'internal/operator/pengumuman' => 'Pengumuman',
            'internal/operator/ikm' => 'Survei IKM',

            // Pencegahan
            'pks' => 'Pencegahan - PKS',
            'fire-drill' => 'Pencegahan - Fire Drill',
            'internal/pencegahan/kelola-edukasi' => 'Pencegahan - Edukasi',
            'redkar' => 'Pencegahan - Redkar',
            'internal/pencegahan/kelola-rpkbgl' => 'Pencegahan - RPKBGL',
            'internal/pencegahan/kelola-skk' => 'Pencegahan - SKK',
            'internal/pencegahan/inspeksi-kebakaran' => 'Pencegahan - Inspeksi',
            'internal/pencegahan/layanan-inspeksi' => 'Pencegahan - Layanan Inspeksi',
            'internal/pencegahan/layanan-sosialisasi' => 'Pencegahan - Layanan Sosialisasi',
            'internal/pencegahan/pelatihan' => 'Pencegahan - Pelatihan',
            'internal/pencegahan/pembinaan-pengembangan' => 'Pencegahan - Pembinaan Pengembangan',
            'internal/pencegahan/peningkatan-kapasitas' => 'Pencegahan - Aparatur',
            'internal/pencegahan/pemberdayaan-masyarakat' => 'Pencegahan - Pemberdayaan',

            // Damtan
            'internal/damtan/rekap-objek' => 'Damtan - Rekap Objek',
            'internal/damtan/rekap-layanan' => 'Damtan - Rekap Layanan',
            'internal/damtan/kelola-penggunaan-sarana' => 'Damtan - Penggunaan Sarana',
            'internal/damtan/kelola-izin-keramaian' => 'Damtan - Izin Keramaian',
            'internal/izin-keramaian' => 'Damtan - Izin Keramaian',
            'internal/surat-korban' => 'Damtan - Surat Korban',
            'internal/damtan/data-laporan' => 'Damtan - Data Laporan',
            'internal/damtan/input-data' => 'Damtan - Data Laporan',
            'internal/damtan/update-data' => 'Damtan - Data Laporan',
            'internal/damtan/hapus-data' => 'Damtan - Data Laporan',

            // Sarpras
            'sapra/perbaikan-kendaraan' => 'Sarpras - Perbaikan Kendaraan',
            'sapra' => 'Sarana & Prasarana',

            // Kepegawaian & Dokumen
            'internal/kepegawaian/duk' => 'Kepegawaian - DUK',
            'internal/kepegawaian/peta-jabatan' => 'Kepegawaian - Peta Jabatan',
            'internal/data-asn' => 'Kepegawaian - Data ASN',
            'internal/program-kerja' => 'Kepegawaian - SOP & Dokumen',
            'internal/dokumen-publik' => 'Kepegawaian - Dokumen Publik',
            'dokumen-publik' => 'Kepegawaian - Dokumen Publik',

            // Profil, Hukum, Peta Sigap
            'internal/produk-hukum' => 'Produk Hukum',
            'internal/peta-sigap' => 'Peta Sigapkar',
        ];

        foreach ($moduleMap as $pattern => $name) {
            if (str_contains($path, $pattern)) {
                return $name;
            }
        }

        // Fallback dinamis
        $segments = explode('/', $path);
        $cleanSegments = array_filter($segments, fn ($s) => ! in_array($s, ['internal', 'store', 'update', 'hapus', 'tambah', 'delete']) && ! is_numeric($s));
        $fallback = implode(' ', array_slice($cleanSegments, -2));

        return ucwords(str_replace(['-', '_'], ' ', $fallback ?: 'Layanan Internal'));
    }

    /**
     * Buat ringkasan deskripsi aktivitas yang mudah dibaca
     */
    protected function generateDescription(string $action, string $module, Request $request): string
    {
        $identifiers = [
            'judul',
            'judul_dokumen',
            'nama_lengkap',
            'nama',
            'nama_kegiatan',
            'nama_perusahaan',
            'nomor_pks',
            'nopol_kendaraan',
            'merk_kendaraan',
            'nomor_pegawai',
            'nomor_surat',
            'nip',
            'nama_sarana',
            'nama_pos',
            'lokasi',
            'email',
        ];
        $subject = null;

        foreach ($identifiers as $key) {
            if ($request->filled($key)) {
                $subject = (string) $request->input($key);
                break;
            }
        }

        if ($subject) {
            // Potong jika terlalu panjang
            if (mb_strlen($subject) > 80) {
                $subject = mb_substr($subject, 0, 77).'...';
            }

            return "{$action} data pada {$module}: \"{$subject}\"";
        }

        return "{$action} data pada {$module}";
    }
}

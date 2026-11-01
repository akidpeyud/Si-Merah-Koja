<?php

namespace App\Http\Middleware;

use App\Models\ActivityLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class LogPemohonActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Hanya catat untuk request penginputan (POST)
        if (strtoupper($request->method()) !== 'POST') {
            return $response;
        }

        // Jangan catat jika request gagal atau terdapat error validasi di session
        $statusCode = $response->getStatusCode();
        if ($statusCode >= 400 || session()->has('errors')) {
            return $response;
        }

        $path = trim($request->path(), '/');

        // Lewati pengecekan status (ajax / fetch)
        if (str_contains($path, 'cek-status')) {
            return $response;
        }

        try {
            $metadata = $this->resolveMetadata($path, $request);
            if (! $metadata) {
                return $response;
            }

            // Bersihkan properti agar tidak menyimpan objek file atau field rahasia
            $rawInput = $request->except(['password', 'password_confirmation', '_token', '_method']);
            $safeInput = [];
            foreach ($rawInput as $key => $val) {
                if ($val instanceof UploadedFile) {
                    $safeInput[$key] = '[File: '.$val->getClientOriginalName().']';
                } elseif (is_array($val)) {
                    $cleanArr = [];
                    foreach ($val as $subKey => $subVal) {
                        if ($subVal instanceof UploadedFile) {
                            $cleanArr[$subKey] = '[File: '.$subVal->getClientOriginalName().']';
                        } elseif (is_scalar($subVal) || is_null($subVal)) {
                            $cleanArr[$subKey] = $subVal;
                        }
                    }
                    $safeInput[$key] = $cleanArr;
                } elseif (is_scalar($val) || is_null($val)) {
                    $safeInput[$key] = $val;
                }
            }

            if (session()->has('pemohon_id')) {
                $safeInput['pemohon_id'] = session('pemohon_id');
            }

            ActivityLog::record(
                action: 'Tambah',
                module: $metadata['module'],
                description: $metadata['description'],
                properties: ! empty($safeInput) ? array_slice($safeInput, 0, 15) : null,
                actorName: $metadata['actor_name'],
                actorRole: 'Pemohon'
            );
        } catch (\Throwable $e) {
            // Jangan biarkan kegagalan logging menghentikan jalannya respon aplikasi
            report($e);
        }

        return $response;
    }

    /**
     * Resolusi modul, nama pemohon, dan deskripsi ramah manusia berdasarkan rute permohonan surat.
     *
     * @return array{module: string, actor_name: string, description: string}|null
     */
    protected function resolveMetadata(string $path, Request $request): ?array
    {
        $namaPemohon = (string) (
            session('pemohon_nama')
            ?: $request->input('nama_pemohon')
            ?: $request->input('nama')
            ?: 'Pemohon'
        );

        // 1. RPKBGL
        if (str_contains($path, 'layanan_perizinan')) {
            $usaha = (string) $request->input('nama_usaha', 'Usaha Pemohon');

            return [
                'module' => 'Permohonan RPKBGL',
                'actor_name' => $namaPemohon,
                'description' => "Pengajuan surat rekomendasi RPKBGL \"{$usaha}\" oleh {$namaPemohon}",
            ];
        }

        // 2. SKK (Baru / Perpanjangan)
        if (str_contains($path, 'permohonan-skk') || str_contains($path, 'skk')) {
            $jenis = (string) $request->input('jenis_permohonan', 'Baru');
            $usaha = (string) $request->input('nama_usaha', 'Usaha/Bangunan');

            return [
                'module' => 'Permohonan SKK',
                'actor_name' => $namaPemohon,
                'description' => "Pengajuan surat permohonan SKK ({$jenis}) \"{$usaha}\" oleh {$namaPemohon}",
            ];
        }

        // 3. Izin Keramaian
        if (str_contains($path, 'izin-keramaian')) {
            $acara = (string) ($request->input('nama_acara') ?: $request->input('nama_usaha') ?: 'Acara');

            return [
                'module' => 'Permohonan Izin Keramaian',
                'actor_name' => $namaPemohon,
                'description' => "Pengajuan surat rekomendasi izin keramaian \"{$acara}\" oleh {$namaPemohon}",
            ];
        }

        // 4. Penggunaan Sarana Pemadam
        if (str_contains($path, 'penggunaan-sarana')) {
            $kegiatan = (string) $request->input('nama_kegiatan', 'Kegiatan');
            $sarana = (string) $request->input('sarana', 'Sarana');

            return [
                'module' => 'Permohonan Sarana Damkar',
                'actor_name' => $namaPemohon,
                'description' => "Pengajuan surat permohonan sarana pemadam \"{$kegiatan}\" ({$sarana}) oleh {$namaPemohon}",
            ];
        }

        // 5. Edukasi & Sosialisasi
        if (str_contains($path, 'edukasi_sosialisasi')) {
            $institusi = (string) $request->input('institusi', 'Institusi/Sekolah');

            return [
                'module' => 'Permohonan Edukasi & Sosialisasi',
                'actor_name' => $namaPemohon,
                'description' => "Pengajuan surat permohonan edukasi & sosialisasi \"{$institusi}\" oleh {$namaPemohon}",
            ];
        }

        return null;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Infografis extends Model
{
    use HasFactory;

    protected $table = 'infografis';

    // Tambahkan baris ini untuk mengizinkan mass assignment
    protected $fillable = ['judul', 'gambar'];

    protected static function booted(): void
    {
        static::retrieved(function (self $item): void {
            $item->syncMissingImage();
        });
    }

    /**
     * Sinkronisasi otomatis file gambar infografis ke storage/app/public/infografis
     * dan public/images/infografis apabila file lokal belum ada di komputer.
     */
    public function syncMissingImage(): void
    {
        $raw = trim((string) $this->gambar);
        if ($raw === '' || preg_match('#^https?://#i', $raw)) {
            return;
        }

        $clean = ltrim(preg_replace('#^/?(public/|storage/)#', '', $raw), '/');
        $baseName = basename($clean);
        $disk = Storage::disk('public');
        $pubImgDir = public_path('images/infografis');
        $pubImgPath = $pubImgDir.DIRECTORY_SEPARATOR.$baseName;

        if ($disk->exists($clean)) {
            if (! File::exists($pubImgPath)) {
                if (! File::exists($pubImgDir)) {
                    @File::makeDirectory($pubImgDir, 0755, true);
                }
                @File::put($pubImgPath, $disk->get($clean));
            }

            return;
        }

        // 1. Cek di seed-files atau public/images/infografis
        $seedPath = storage_path('app/public/seed-files/infografis/'.$baseName);
        if (File::exists($seedPath)) {
            $bin = File::get($seedPath);
            $disk->put($clean, $bin);
            if (! File::exists($pubImgPath)) {
                if (! File::exists($pubImgDir)) {
                    @File::makeDirectory($pubImgDir, 0755, true);
                }
                @File::put($pubImgPath, $bin);
            }

            return;
        }

        if (File::exists($pubImgPath)) {
            $disk->put($clean, File::get($pubImgPath));

            return;
        }

        // 2. Unduh otomatis dari Instagram berdasarkan shortcode ig_{CODE}.jpg (seperti Media Informasi)
        if (! preg_match('/^ig_([A-Za-z0-9_-]+)\./', $baseName, $m)) {
            return;
        }

        $code = $m[1];
        $cacheKey = 'infografis_sync_fail_'.$code;
        if (cache()->has($cacheKey)) {
            return;
        }

        $bin = self::downloadInstagramMedia($code);
        if (! $bin) {
            cache()->put($cacheKey, true, now()->addMinutes(30));

            return;
        }

        $disk->put($clean, $bin);
        if (! File::exists($pubImgDir)) {
            @File::makeDirectory($pubImgDir, 0755, true);
        }
        @File::put($pubImgPath, $bin);
    }

    /**
     * Ambil biner gambar infografis dari lokal (storage / seed-files / public)
     * atau unduh otomatis dari Instagram (menggunakan mekanisme OpenGraph yang sama dengan Media Informasi),
     * lalu kembalikan sebagai Data URI (data:image/jpeg;base64,...) agar 100% tampil di semua komputer
     * tanpa bergantung pada storage:link atau konfigurasi URL.
     */
    public function getImageDataUri(): string
    {
        $raw = trim((string) $this->gambar);
        if (preg_match('#^https?://#i', $raw)) {
            return $raw;
        }

        $clean = ltrim(preg_replace('#^/?(public/|storage/)#', '', $raw), '/');
        $baseName = basename($clean);

        $candidates = [
            storage_path('app/public/'.$clean),
            storage_path('app/public/seed-files/infografis/'.$baseName),
            public_path('images/infografis/'.$baseName),
            public_path('storage/'.$clean),
        ];

        $bin = null;
        $mime = 'image/jpeg';

        foreach ($candidates as $path) {
            if ($baseName !== '' && is_file($path)) {
                $info = @getimagesize($path);
                if ($info !== false) {
                    $bin = @file_get_contents($path);
                    $mime = $info['mime'] ?? 'image/jpeg';
                    if (is_string($bin) && strlen($bin) > 1024) {
                        break;
                    }
                    $bin = null;
                }
            }
        }

        if (! $bin && preg_match('/^ig_([A-Za-z0-9_-]+)\./', $baseName, $m)) {
            $bin = self::downloadInstagramMedia($m[1]);
        }

        if ($bin) {
            try {
                $disk = Storage::disk('public');
                if (! $disk->exists($clean) || @getimagesize(storage_path('app/public/'.$clean)) === false) {
                    $disk->put($clean, $bin);
                }
            } catch (\Throwable $e) {
                // abaikan jika folder tidak writable
            }

            return 'data:'.$mime.';base64,'.base64_encode($bin);
        }

        return asset('storage/'.$clean);
    }

    public static function downloadInstagramMedia(string $code): ?string
    {
        $postUrl = "https://www.instagram.com/p/{$code}/";
        $mediaUrl = "https://www.instagram.com/p/{$code}/media/?size=l";

        // 1. Coba endpoint media/?size=l (resolusi penuh)
        if (function_exists('curl_init')) {
            $ch = curl_init($mediaUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 6);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36');
            $bin = curl_exec($ch);
            $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200 && is_string($bin) && strlen($bin) > 2048 && @getimagesizefromstring($bin) !== false) {
                return $bin;
            }
        }

        // 2. Fallback OpenGraph DOMDocument (identik 100% dengan BeritaMedsosSeeder / OperatorMedsosController)
        $userAgents = [
            'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)',
            'Twitterbot/1.0',
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
        ];

        foreach ($userAgents as $ua) {
            try {
                $htmlRes = Http::withoutVerifying()
                    ->timeout(12)
                    ->connectTimeout(6)
                    ->withHeaders([
                        'User-Agent' => $ua,
                        'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                        'Accept-Language' => 'id-ID,id;q=0.9,en;q=0.8',
                    ])
                    ->get($postUrl);

                if (! $htmlRes->ok()) {
                    continue;
                }

                $doc = new \DOMDocument;
                libxml_use_internal_errors(true);
                $doc->loadHTML('<?xml encoding="utf-8" ?>'.substr($htmlRes->body(), 0, 800000));
                libxml_clear_errors();

                $meta = [];
                foreach ($doc->getElementsByTagName('meta') as $m) {
                    $key = strtolower($m->getAttribute('property') ?: $m->getAttribute('name'));
                    $val = trim($m->getAttribute('content'));
                    if ($key !== '' && $val !== '' && ! isset($meta[$key])) {
                        $meta[$key] = $val;
                    }
                }

                $imgUrl = $meta['og:image:secure_url']
                    ?? $meta['og:image']
                    ?? $meta['twitter:image']
                    ?? $meta['twitter:image:src']
                    ?? null;

                if (! $imgUrl) {
                    continue;
                }

                $imgRes = Http::withoutVerifying()
                    ->timeout(15)
                    ->connectTimeout(6)
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
                        'Accept' => 'image/avif,image/webp,image/png,image/jpeg,image/*,*/*;q=0.8',
                        'Referer' => $postUrl,
                    ])
                    ->get($imgUrl);

                if ($imgRes->ok() && strlen($imgRes->body()) > 2048 && @getimagesizefromstring($imgRes->body()) !== false) {
                    return $imgRes->body();
                }
            } catch (\Throwable $e) {
                continue;
            }
        }

        return null;
    }
}

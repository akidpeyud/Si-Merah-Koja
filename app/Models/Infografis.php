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

    protected $fillable = ['judul', 'gambar'];

    protected static function booted(): void
    {
        static::retrieved(function (self $item): void {
            $item->syncMissingImage();
        });
    }

    public function getImageDataUri(): ?string
    {
        if (! $this->gambar) {
            return null;
        }

        $filename = basename($this->gambar);
        $candidates = [
            storage_path('app/public/' . ltrim($this->gambar, '/')),
            public_path('images/infografis/' . $filename),
            storage_path('app/public/seed-files/infografis/' . $filename),
        ];

        foreach ($candidates as $path) {
            if (File::exists($path) && @getimagesize($path) !== false) {
                $mime = File::mimeType($path) ?: 'image/jpeg';
                $data = base64_encode(File::get($path));

                return "data:{$mime};base64,{$data}";
            }
        }

        return null;
    }

    public function syncMissingImage(): void
    {
        if (! $this->gambar) {
            return;
        }

        $disk = Storage::disk('public');
        $filename = basename($this->gambar);
        $targetPath = storage_path('app/public/' . ltrim($this->gambar, '/'));

        if (File::exists($targetPath) && @getimagesize($targetPath) !== false) {
            return;
        }

        $fallbacks = [
            public_path('images/infografis/' . $filename),
            storage_path('app/public/seed-files/infografis/' . $filename),
        ];

        foreach ($fallbacks as $fallback) {
            if (File::exists($fallback) && @getimagesize($fallback) !== false) {
                $disk->put($this->gambar, File::get($fallback));
                return;
            }
        }

        if (preg_match('/^ig_([A-Za-z0-9_-]+)\./', $filename, $matches)) {
            $bin = self::downloadInstagramMedia($matches[1]);
            if ($bin) {
                $disk->put($this->gambar, $bin);
            }
        }
    }

    public static function downloadInstagramMedia(string $shortcode): ?string
    {
        $mediaUrl = "https://www.instagram.com/p/{$code}/media/?size=l";

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

            if ($httpCode === 200 && is_string($bin) && strlen($bin) > 2048) {
                $mime = (new \finfo(FILEINFO_MIME_TYPE))->buffer($bin);
                if (str_starts_with((string) $mime, 'image/')) {
                    return $bin;
                }
            }
        }

        // Fallback OpenGraph DOMDocument (identik 100% dengan BeritaMedsos)
        $postUrl = "https://www.instagram.com/p/{$code}/";
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
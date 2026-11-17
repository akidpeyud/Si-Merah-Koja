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

    public static function downloadInstagramMedia(string $code): ?string
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

        // Fallback via Http::withoutVerifying() + OpenGraph crawler (sama seperti BeritaMedsos)
        try {
            $postUrl = "https://www.instagram.com/p/{$code}/";
            $htmlRes = Http::withoutVerifying()
                ->timeout(12)
                ->withHeaders([
                    'User-Agent' => 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)',
                ])
                ->get($postUrl);

            if ($htmlRes->ok() && preg_match('/property=["\']og:image["\']\s+content=["\']([^"\']+)["\']/i', $htmlRes->body(), $m)) {
                $imgUrl = html_entity_decode($m[1], ENT_QUOTES | ENT_HTML5);
                $imgRes = Http::withoutVerifying()
                    ->timeout(15)
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                        'Referer' => $postUrl,
                    ])
                    ->get($imgUrl);

                if ($imgRes->ok() && strlen($imgRes->body()) > 2048) {
                    return $imgRes->body();
                }
            }
        } catch (\Throwable $e) {
            // abaikan error jaringan sementara
        }

        return null;
    }
}

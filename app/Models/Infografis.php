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
        try {
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
            ])->timeout(15)->get("https://www.instagram.com/p/{$shortcode}/media/?size=l");

            if ($response->successful() && str_starts_with((string) $response->header('Content-Type'), 'image/')) {
                return $response->body();
            }
        } catch (\Throwable $e) {
            // Ignore network failures during media fallback
        }

        return null;
    }
}
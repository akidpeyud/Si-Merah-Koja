<?php

namespace App\Http\Controllers;

use App\Models\BeritaMedsos;
use App\Models\EduDamkar;
use App\Models\Infografis;
use App\Models\UjungDamkar;
use Carbon\Carbon;
use GuzzleHttp\TransferStats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OperatorMedsosController extends Controller
{
    private const UA_BROWSER = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36';

    private const UA_FACEBOOK = 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)';

    private const UA_TWITTER = 'Twitterbot/1.0';

    /** Nama sumber yang rapi berdasarkan domain. Tambahkan domain baru di sini. */
    private const SITE_NAMES = [
        // Media sosial
        'instagram.com' => 'Instagram',
        'tiktok.com' => 'TikTok',
        'youtube.com' => 'YouTube',
        'youtu.be' => 'YouTube',
        'facebook.com' => 'Facebook',
        'fb.watch' => 'Facebook',
        'x.com' => 'X (Twitter)',
        'twitter.com' => 'X (Twitter)',
        // Media berita
        'jambione.com' => 'Jambi One',
        'jambiekspres.disway.id' => 'Jambi Ekspres',
        'jambitv.disway.id' => 'Jambi TV',
        'jambi.tribunnews.com' => 'Tribun Jambi',
        'bicarajambi.com' => 'Bicara Jambi',
        'sepucukjambi.id' => 'Sepucuk Jambi',
        'mattanews.co' => 'Matta News',
        'infojambi.com' => 'Info Jambi',
        'siginjaione.com' => 'Siginjai One',
        'metrojambi.com' => 'Metro Jambi',
        'detik.com' => 'Detik',
        'generasi-indonesia.com' => 'Generasi Indonesia',
        'reportasenusantara.com' => 'Reportase Nusantara',
        'detail.id' => 'Detail.id',
        'okezone.com' => 'Okezone',
        'inews.id' => 'iNews',
        'jambilink.id' => 'Jambilink',
        'jambiseru.com' => 'Jambi Seru',
        'jambibro.com' => 'Jambi Bro',
        'sekato.id' => 'Sekato',
        'signalberita.com' => 'Signal Berita',
        'dradio.id' => 'D Radio',
    ];

    // ================= INFOGRAFIS =================
    public function indexInfografis()
    {
        $infografis = Infografis::orderBy('created_at', 'desc')->get();

        return view('internal.operator.infografis', compact('infografis'));
    }

    public function storeInfografis(Request $request)
    {
        $request->validate([
            'judul' => ['nullable', 'string', 'max:255'],
            'gambar' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $path = $request->file('gambar')->store('infografis', 'public');

        Infografis::create([
            'judul' => $request->judul,
            'gambar' => $path,
        ]);

        return back()->with('success', 'Infografis baru berhasil ditambahkan!');
    }

    public function destroyInfografis($id)
    {
        $item = Infografis::findOrFail($id);
        if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
            Storage::disk('public')->delete($item->gambar);
        }
        $item->delete();

        return back()->with('success', 'Infografis berhasil dihapus!');
    }

    // ================= BERITA MEDSOS =================
    public function indexMedsos()
    {
        $medsos = BeritaMedsos::orderBy('created_at', 'desc')->get();

        // Mengambil data dari tabel kategori_berita
        $dataKategori = DB::table('kategori_berita')->orderBy('id', 'asc')->get();

        return view('internal.operator.berita_medsos', [
            'medsos' => $medsos,
            'kategori' => $dataKategori,
            'kategoris' => $dataKategori,
            'kategori_berita' => $dataKategori,
            'kategoriBerita' => $dataKategori,
        ]);
    }

    /**
     * Endpoint Tarik Data: POST /internal/fetch-link-preview
     * Body JSON: { "url": "https://..." }
     * Respon: { title, image, site_name, date, final_url } atau { error } (HTTP 422)
     */
    public function fetchLinkPreview(Request $request)
    {
        $request->validate(['url' => ['required', 'url', 'max:2000']]);

        $url = trim($request->input('url'));

        if (! $this->isSafeUrl($url)) {
            return response()->json(['error' => 'Alamat URL tidak diizinkan atau tidak dapat dijangkau.'], 422);
        }

        $url = $this->resolveShortUrl($url);
        $host = $this->hostOf($url);
        $result = [];

        try {
            // 1) Handler khusus per platform
            if ($this->hostIs($host, ['youtube.com', 'youtu.be'])) {
                $result = $this->previewYoutube($url);
            } elseif ($this->hostIs($host, ['tiktok.com'])) {
                $result = $this->previewTiktok($url);
            } elseif ($this->hostIs($host, ['x.com', 'twitter.com'])) {
                $result = $this->previewTwitter($url);
            }

            // 2) Fallback umum via Open Graph (berita web, Instagram, X, share.google, dll)
            if (empty($result['title']) || empty($result['image'])) {
                $og = $this->previewOpenGraph($url);
                foreach ($og as $key => $value) {
                    if (empty($result[$key]) && ! empty($value)) {
                        $result[$key] = $value;
                    }
                }
            }
        } catch (\Throwable $e) {
            report($e);

            return response()->json(['error' => 'Terjadi kesalahan saat mengambil data tautan.'], 422);
        }

        if (empty($result['title']) && empty($result['image'])) {
            $platform = $this->hostIs($host, ['instagram.com', 'tiktok.com', 'facebook.com', 'fb.watch', 'x.com', 'twitter.com'])
                ? 'Platform ini membatasi pengambilan data otomatis.'
                : 'Situs ini tidak mengizinkan pengambilan data otomatis.';

            return response()->json(['error' => $platform], 422);
        }

        return response()->json([
            'title' => $result['title'] ?? null,
            'image' => $result['image'] ?? null,
            'site_name' => $result['site_name'] ?? $this->sumberDariLink($url),
            'date' => $result['date'] ?? null,
            'final_url' => $result['final_url'] ?? $url,
        ]);
    }

    public function storeMedsos(Request $request)
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori_id' => ['required', 'integer', 'exists:kategori_berita,id'],
            'tanggal' => ['required', 'date'],
            'link' => ['required', 'url', 'max:2000'],
            'sumber' => ['nullable', 'string', 'max:255'],
            'gambar_url' => ['nullable', 'url', 'max:2000'],
            'gambar_manual' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'kategori_id.required' => 'Kategori berita wajib dipilih.',
            'link.required' => 'Link postingan wajib diisi.',
        ]);

        $path = null;

        if ($request->hasFile('gambar_manual')) {
            // Upload manual selalu diprioritaskan
            $path = $request->file('gambar_manual')->store('berita_medsos', 'public');
        } elseif ($request->filled('gambar_url')) {
            // Unduh gambar hasil Tarik Data agar tidak bergantung pada CDN luar
            $path = $this->downloadRemoteImage($request->gambar_url, $request->link);
        }

        if (! $path && $request->filled('link') && $this->isSafeUrl($request->link)) {
            $meta = $this->extractMetadataFromUrl($request->link);
            if (! empty($meta['image'])) {
                $path = $this->downloadRemoteImage($meta['image'], $request->link);
            }
        }

        if (! $path) {
            return back()
                ->withInput()
                ->with('error', 'Gambar tidak berhasil diambil otomatis. Silakan upload foto secara manual.');
        }

        BeritaMedsos::create([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'tanggal' => $request->tanggal,
            'sumber' => $request->filled('sumber') ? $request->sumber : $this->sumberDariLink($request->link),
            'link' => $request->link,
            'gambar' => $path,
        ]);

        return back()->with('success', 'Berita media sosial berhasil ditambahkan!');
    }

    public function updateMedsos(Request $request, $id)
    {
        $item = BeritaMedsos::findOrFail($id);

        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori_id' => ['required', 'integer', 'exists:kategori_berita,id'],
            'tanggal' => ['required', 'date'],
            'sumber' => ['required', 'string', 'max:255'],
            'link' => ['nullable', 'url', 'max:2000'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $item->judul = $request->judul;
        $item->kategori_id = $request->kategori_id;
        $item->tanggal = $request->tanggal;
        $item->sumber = $request->sumber;
        $item->link = $request->link;

        if ($request->hasFile('gambar')) {
            if ($item->gambar && $item->gambar !== 'berita_medsos/placeholder.png' && Storage::disk('public')->exists($item->gambar)) {
                Storage::disk('public')->delete($item->gambar);
            }
            $item->gambar = $request->file('gambar')->store('berita_medsos', 'public');
        }

        $item->save();

        if (! $request->hasFile('gambar') && ! empty($item->link)) {
            $this->syncImageFromLink($item);
        }

        return back()->with('success', 'Berita media sosial berhasil diperbarui!');
    }

    /**
     * Sinkronisasi foto otomatis dari link untuk daftar BeritaMedsos yang masih memakai placeholder / belum ada file gambarnya.
     */
    public function syncMissingImages(iterable $items): void
    {
        @set_time_limit(120);

        foreach ($items as $item) {
            if ($item instanceof BeritaMedsos) {
                $this->syncImageFromLink($item);
            }
        }
    }

    /**
     * Ambil dan simpan foto dari link apabila berita masih menggunakan placeholder atau file lokal belum tersedia.
     */
    public function syncImageFromLink(BeritaMedsos $item): bool
    {
        $g = trim((string) $item->gambar);
        if ($g !== '' && $g !== 'berita_medsos/placeholder.png') {
            if (preg_match('#^https?://#i', $g)) {
                return true;
            }
            $clean = ltrim(preg_replace('#^/?(public/|storage/)#', '', $g), '/');
            if (Storage::disk('public')->exists($clean)) {
                return true;
            }
        }

        if (empty($item->link)) {
            return false;
        }

        $cacheKey = 'medsos_img_sync_fail_'.($item->id ?: md5($item->link));
        if (cache()->has($cacheKey)) {
            return false;
        }

        $url = trim($item->link);
        if (! $this->isSafeUrl($url)) {
            cache()->put($cacheKey, true, now()->addHours(6));

            return false;
        }

        $meta = $this->extractMetadataFromUrl($url);
        $path = ! empty($meta['image']) ? $this->downloadRemoteImage($meta['image'], $url) : null;

        if (! $path) {
            cache()->put($cacheKey, true, now()->addHours(2));

            return false;
        }

        $updates = ['gambar' => $path];
        $item->gambar = $path;

        if (! empty($meta['title']) && str_starts_with(trim((string) $item->judul), 'Publikasi ')) {
            $newTitle = Str::limit(trim($meta['title']), 250, '');
            $updates['judul'] = $newTitle;
            $item->judul = $newTitle;
        }

        if ($item->exists) {
            BeritaMedsos::whereKey($item->getKey())->update($updates);
        }

        return true;
    }

    /**
     * Ekstrak metadata (title, image, site_name, date, final_url) dari URL.
     */
    private function extractMetadataFromUrl(string $url): array
    {
        $url = $this->resolveShortUrl($url);
        $host = $this->hostOf($url);
        $result = [];

        try {
            if ($this->hostIs($host, ['youtube.com', 'youtu.be'])) {
                $result = $this->previewYoutube($url);
            } elseif ($this->hostIs($host, ['tiktok.com'])) {
                $result = $this->previewTiktok($url);
            } elseif ($this->hostIs($host, ['x.com', 'twitter.com'])) {
                $result = $this->previewTwitter($url);
            }

            if (empty($result['title']) || empty($result['image'])) {
                $og = $this->previewOpenGraph($url);
                foreach ($og as $key => $value) {
                    if (empty($result[$key]) && ! empty($value)) {
                        $result[$key] = $value;
                    }
                }
            }
        } catch (\Throwable $e) {
            report($e);
        }

        return $result;
    }

    public function destroyMedsos($id)
    {
        $item = BeritaMedsos::findOrFail($id);
        if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
            Storage::disk('public')->delete($item->gambar);
        }
        $item->delete();

        return back()->with('success', 'Berita media sosial berhasil dihapus!');
    }

    // ================= UJUNG-UJUNG DAMKAR =================
    public function indexUjungDamkar()
    {
        $videos = UjungDamkar::orderBy('created_at', 'desc')->get();

        $viewName = view()->exists('internal.operator.ujung_damkar')
            ? 'internal.operator.ujung_damkar'
            : 'internal.operator.ujung-damkar';

        return view($viewName, compact('videos'));
    }

    public function storeUjungDamkar(Request $request)
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'link' => ['required', 'url'],
        ], [
            'judul.required' => 'Judul kegiatan / video wajib diisi.',
            'link.required' => 'Link video YouTube wajib diisi.',
            'link.url' => 'Format link tidak valid.',
        ]);

        $youtubeId = $this->extractYoutubeId($request->link);

        if (! $youtubeId) {
            return back()
                ->withInput()
                ->with('error', 'Link YouTube tidak dikenali! Pastikan menggunakan link video atau Shorts YouTube yang valid.');
        }

        UjungDamkar::create([
            'judul' => $request->judul,
            'youtube_id' => $youtubeId,
            'link_asli' => $request->link,
        ]);

        return back()->with('success', 'Video Ujung-Ujung Damkar berhasil ditambahkan!');
    }

    public function updateUjungDamkar(Request $request, $id)
    {
        $item = UjungDamkar::findOrFail($id);

        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'link' => ['required', 'url'],
        ]);

        $youtubeId = $this->extractYoutubeId($request->link);

        if (! $youtubeId) {
            return back()
                ->withInput()
                ->with('error', 'Link YouTube tidak dikenali! Pastikan menggunakan link video atau Shorts YouTube yang valid.');
        }

        $item->update([
            'judul' => $request->judul,
            'youtube_id' => $youtubeId,
            'link_asli' => $request->link,
        ]);

        return back()->with('success', 'Video Ujung-Ujung Damkar berhasil diperbarui!');
    }

    public function destroyUjungDamkar($id)
    {
        $item = UjungDamkar::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Video Ujung-Ujung Damkar berhasil dihapus!');
    }

    // ================= EDU DAMKAR (VIDEO EDUKASI) =================
    public function indexEduDamkar()
    {
        $videos = EduDamkar::orderBy('created_at', 'desc')->get();

        $viewName = view()->exists('internal.operator.edu_damkar')
            ? 'internal.operator.edu_damkar'
            : 'internal.operator.edu-damkar';

        return view($viewName, compact('videos'));
    }

    public function storeEduDamkar(Request $request)
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'link' => ['required', 'url'],
        ], [
            'judul.required' => 'Judul materi edukasi wajib diisi.',
            'link.required' => 'Link video YouTube wajib diisi.',
            'link.url' => 'Format link tidak valid.',
        ]);

        $youtubeId = $this->extractYoutubeId($request->link);

        if (! $youtubeId) {
            return back()
                ->withInput()
                ->with('error', 'Link YouTube tidak dikenali! Pastikan menggunakan link video atau Shorts YouTube yang valid.');
        }

        EduDamkar::create([
            'judul' => $request->judul,
            'youtube_id' => $youtubeId,
            'link_asli' => $request->link,
        ]);

        return back()->with('success', 'Video Edu Damkar berhasil ditambahkan!');
    }

    public function updateEduDamkar(Request $request, $id)
    {
        $item = EduDamkar::findOrFail($id);

        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'link' => ['required', 'url'],
        ]);

        $youtubeId = $this->extractYoutubeId($request->link);

        if (! $youtubeId) {
            return back()
                ->withInput()
                ->with('error', 'Link YouTube tidak dikenali! Pastikan menggunakan link video atau Shorts YouTube yang valid.');
        }

        $item->update([
            'judul' => $request->judul,
            'youtube_id' => $youtubeId,
            'link_asli' => $request->link,
        ]);

        return back()->with('success', 'Video Edu Damkar berhasil diperbarui!');
    }

    public function destroyEduDamkar($id)
    {
        $item = EduDamkar::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Video Edu Damkar berhasil dihapus!');
    }

    // =====================================================================
    //  HELPER: PREVIEW LINK (YouTube, TikTok, Open Graph)
    // =====================================================================

    /** YouTube: judul via oEmbed, thumbnail terbaik yang tersedia. */
    private function previewYoutube(string $url): array
    {
        $id = $this->extractYoutubeId($url);
        if (! $id) {
            return [];
        }

        $title = null;
        try {
            $res = Http::withoutVerifying()->timeout(8)->get('https://www.youtube.com/oembed', [
                'url' => 'https://www.youtube.com/watch?v='.$id,
                'format' => 'json',
            ]);
            if ($res->ok()) {
                $title = $res->json('title');
            }
        } catch (\Throwable $e) {
            // judul boleh kosong, thumbnail tetap dicoba
        }

        // maxresdefault tidak selalu ada, jatuh ke hqdefault bila 404
        $image = "https://img.youtube.com/vi/{$id}/maxresdefault.jpg";
        try {
            if (Http::withoutVerifying()->timeout(8)->head($image)->status() !== 200) {
                $image = "https://img.youtube.com/vi/{$id}/hqdefault.jpg";
            }
        } catch (\Throwable $e) {
            $image = "https://img.youtube.com/vi/{$id}/hqdefault.jpg";
        }

        return [
            'title' => $title,
            'image' => $image,
            'site_name' => 'YouTube',
        ];
    }

    /** TikTok: oEmbed publik (tanpa API key). */
    private function previewTiktok(string $url): array
    {
        try {
            $res = Http::withoutVerifying()->timeout(10)->get('https://www.tiktok.com/oembed', ['url' => $url]);
            if ($res->ok()) {
                return [
                    'title' => $res->json('title'),
                    'image' => $res->json('thumbnail_url'),
                    'site_name' => 'TikTok',
                ];
            }
        } catch (\Throwable $e) {
            // lanjut ke fallback Open Graph
        }

        return [];
    }

    /** X / Twitter: teks + foto lewat fxtwitter. */
    private function previewTwitter(string $url): array
    {
        if (! preg_match('~(?:x|twitter)\.com/([A-Za-z0-9_]+)/status(?:es)?/(\d+)~i', $url, $m)) {
            return [];
        }
        [, $user, $id] = $m;

        try {
            $res = Http::withoutVerifying()
                ->timeout(10)
                ->withHeaders(['User-Agent' => self::UA_BROWSER])
                ->get("https://api.fxtwitter.com/{$user}/status/{$id}");

            $tw = $res->ok() ? $res->json('tweet') : null;
            if ($tw) {
                $text = trim(preg_replace('/\s+/', ' ', $tw['text'] ?? ''));
                $image = $tw['media']['photos'][0]['url']
                      ?? $tw['media']['videos'][0]['thumbnail_url']
                      ?? null;

                return [
                    'title' => $text !== '' ? Str::limit($text, 200, '') : 'Postingan @'.$user,
                    'image' => $image,
                    'site_name' => 'X (Twitter)',
                ];
            }
        } catch (\Throwable $e) {
            // lanjut ke fallback Open Graph
        }

        return [];
    }

    /**
     * Fallback umum: baca tag Open Graph / Twitter Card.
     * Mencoba beberapa User-Agent karena sebagian situs (Instagram, X, Facebook)
     * hanya memberi meta tag ke crawler media sosial, sedangkan situs berita
     * biasanya butuh UA browser.
     */
    private function previewOpenGraph(string $url): array
    {
        $best = [];
        $host = $this->hostOf($url);
        $userAgents = $this->hostIs($host, ['instagram.com', 'facebook.com', 'fb.watch'])
            ? [self::UA_FACEBOOK, self::UA_TWITTER, self::UA_BROWSER]
            : [self::UA_BROWSER, self::UA_FACEBOOK, self::UA_TWITTER];

        foreach ($userAgents as $ua) {
            $fetched = $this->httpGet($url, $ua);
            $res = $fetched['res'];

            if (! $res || ! $res->ok()) {
                continue;
            }

            $parsed = $this->parseMeta($res->body(), $fetched['final']);
            $parsed['final_url'] = $fetched['final'];

            if (empty($best) || (empty($best['image']) && ! empty($parsed['image']))) {
                $best = $parsed;
            }

            if (! empty($best['title']) && ! empty($best['image'])) {
                break;
            }
        }

        return $best;
    }

    /** GET dengan header ala browser, batas redirect, dan pengecekan SSRF di setiap redirect. */
    private function httpGet(string $url, string $userAgent, ?string $referer = null): array
    {
        $final = $url;

        try {
            $res = Http::withoutVerifying()
                ->timeout(12)
                ->connectTimeout(6)
                ->withHeaders(array_filter([
                    'User-Agent' => $userAgent,
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                    'Accept-Language' => 'id-ID,id;q=0.9,en;q=0.8',
                    'Referer' => $referer,
                ]))
                ->withOptions([
                    'allow_redirects' => [
                        'max' => 5,
                        'on_redirect' => $this->redirectGuard(),
                    ],
                    'on_stats' => function (TransferStats $stats) use (&$final) {
                        $final = (string) $stats->getEffectiveUri();
                    },
                ])
                ->get($url);

            return ['res' => $res, 'final' => $final];
        } catch (\Throwable $e) {
            return ['res' => null, 'final' => $url];
        }
    }

    private function redirectGuard(): \Closure
    {
        return function ($request, $response, $uri) {
            if (! $this->isSafeUrl((string) $uri)) {
                throw new \RuntimeException('Redirect ke alamat yang tidak diizinkan.');
            }
        };
    }

    /** Ikuti redirect untuk link pendek/share supaya URL aslinya yang diproses. */
    private function resolveShortUrl(string $url): string
    {
        $host = $this->hostOf($url);
        $path = (string) parse_url($url, PHP_URL_PATH);

        $isShort = in_array($host, [
            'vm.tiktok.com', 'vt.tiktok.com', 't.co', 'bit.ly', 'fb.watch',
            'share.google', 'g.co', 'goo.gl', 'tinyurl.com', 's.id',
        ], true)
            || ($this->hostIs($host, ['tiktok.com']) && str_starts_with($path, '/t/'))
            || ($this->hostIs($host, ['facebook.com']) && str_starts_with($path, '/share/'));

        if (! $isShort) {
            return $url;
        }

        $fetched = $this->httpGet($url, self::UA_BROWSER);
        $final = $fetched['final'] ?? $url;

        return ($final && $this->isSafeUrl($final)) ? $final : $url;
    }

    /** Ambil judul, gambar, nama situs, dan tanggal terbit dari HTML. */
    private function parseMeta(string $html, string $baseUrl): array
    {
        $html = substr($html, 0, 800000); // meta tag ada di bagian atas, tidak perlu seluruh halaman

        $doc = new \DOMDocument;
        libxml_use_internal_errors(true);
        $doc->loadHTML('<?xml encoding="utf-8" ?>'.$html);
        libxml_clear_errors();

        $meta = [];
        foreach ($doc->getElementsByTagName('meta') as $m) {
            $key = strtolower($m->getAttribute('property') ?: $m->getAttribute('name'));
            $val = trim($m->getAttribute('content'));
            if ($key !== '' && $val !== '' && ! isset($meta[$key])) {
                $meta[$key] = $val;
            }
        }

        $title = $meta['og:title'] ?? $meta['twitter:title'] ?? null;
        if (! $title) {
            $t = $doc->getElementsByTagName('title')->item(0);
            $title = $t ? trim($t->textContent) : null;
        }

        // Abaikan halaman tantangan anti-bot
        if ($title && preg_match('/^(just a moment|attention required|access denied|403 forbidden|are you a robot|log in|login)/i', $title)) {
            $title = null;
        }

        $image = $meta['og:image:secure_url']
            ?? $meta['og:image']
            ?? $meta['twitter:image']
            ?? $meta['twitter:image:src']
            ?? null;

        $published = $meta['article:published_time']
            ?? $meta['og:article:published_time']
            ?? $meta['date']
            ?? null;

        $date = null;
        if ($published) {
            try {
                $date = Carbon::parse($published)->timezone('Asia/Jakarta')->format('Y-m-d\TH:i');
            } catch (\Throwable $e) {
                $date = null;
            }
        }

        return [
            'title' => $title ? Str::limit(trim($title), 250, '') : null,
            'image' => $image ? $this->absoluteUrl($image, $baseUrl) : null,
            'site_name' => $meta['og:site_name'] ?? null,
            'date' => $date,
        ];
    }

    /** Ubah URL relatif (//cdn/x.jpg, /img/x.jpg, x.jpg) menjadi absolut. */
    private function absoluteUrl(string $path, string $baseUrl): string
    {
        if (preg_match('#^https?://#i', $path)) {
            return $path;
        }

        $p = parse_url($baseUrl);
        $scheme = $p['scheme'] ?? 'https';

        if (str_starts_with($path, '//')) {
            return $scheme.':'.$path;
        }

        $origin = $scheme.'://'.($p['host'] ?? '').(isset($p['port']) ? ':'.$p['port'] : '');

        if (str_starts_with($path, '/')) {
            return $origin.$path;
        }

        $dir = rtrim(dirname($p['path'] ?? '/'), '/');

        return $origin.$dir.'/'.$path;
    }

    // =====================================================================
    //  HELPER: UNDUH GAMBAR REMOTE
    // =====================================================================

    /**
     * Unduh gambar dari URL, validasi tipe & ukuran, lalu simpan ke disk public.
     * Mengembalikan path relatif (mis. berita_medsos/xxxx.jpg) atau null bila gagal.
     */
    private function downloadRemoteImage(string $imageUrl, ?string $referer = null): ?string
    {
        if (! $this->isSafeUrl($imageUrl)) {
            return null;
        }

        try {
            $res = Http::withoutVerifying()
                ->timeout(15)
                ->connectTimeout(6)
                ->withHeaders(array_filter([
                    'User-Agent' => self::UA_BROWSER,
                    'Accept' => 'image/avif,image/webp,image/png,image/jpeg,image/*,*/*;q=0.8',
                    'Referer' => $referer,
                ]))
                ->withOptions([
                    'allow_redirects' => [
                        'max' => 3,
                        'on_redirect' => $this->redirectGuard(),
                    ],
                ])
                ->get($imageUrl);

            if (! $res->ok()) {
                return null;
            }

            $body = $res->body();
            $size = strlen($body);

            if ($size < 1024 || $size > 5 * 1024 * 1024) {
                return null;
            }

            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->buffer($body);

            $ext = match ($mime) {
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/webp' => 'webp',
                'image/gif' => 'gif',
                'image/avif' => 'avif',
                default => null,
            };

            if (! $ext) {
                return null;
            }

            $path = 'berita_medsos/'.Str::random(40).'.'.$ext;
            Storage::disk('public')->put($path, $body);

            return $path;
        } catch (\Throwable $e) {
            report($e);

            return null;
        }
    }

    // =====================================================================
    //  HELPER: URL / DOMAIN
    // =====================================================================

    /** Cegah SSRF: hanya http/https dan host harus resolve ke IP publik. */
    private function isSafeUrl(string $url): bool
    {
        $p = parse_url($url);

        if (! $p || empty($p['host'])
            || ! in_array(strtolower($p['scheme'] ?? ''), ['http', 'https'], true)) {
            return false;
        }

        $host = $p['host'];
        $ips = filter_var($host, FILTER_VALIDATE_IP) ? [$host] : (gethostbynamel($host) ?: []);

        if (empty($ips)) {
            return false;
        }

        foreach ($ips as $ip) {
            if (! filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                return false;
            }
        }

        return true;
    }

    private function hostOf(?string $url): string
    {
        $host = strtolower(parse_url($url ?? '', PHP_URL_HOST) ?? '');

        return preg_replace('/^www\./', '', $host);
    }

    private function hostIs(string $host, array $domains): bool
    {
        foreach ($domains as $d) {
            if ($host === $d || str_ends_with($host, '.'.$d)) {
                return true;
            }
        }

        return false;
    }

    /** Nama sumber yang rapi dari link (Instagram, TikTok, Jambi One, dst). */
    private function sumberDariLink(?string $url): string
    {
        $host = $this->hostOf($url);

        foreach (self::SITE_NAMES as $domain => $name) {
            if ($host === $domain || str_ends_with($host, '.'.$domain)) {
                return $name;
            }
        }

        return $host !== '' ? $host : 'Website';
    }

    /**
     * Helper pengekstrak 11 karakter ID YouTube dari berbagai format URL
     */
    private function extractYoutubeId(string $url): ?string
    {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts|live)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';

        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }

        return null;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Kejadian;
use Carbon\Carbon;
use GuzzleHttp\TransferStats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KejadianController extends Controller
{
    private const UA_BROWSER = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36';

    private const UA_FACEBOOK = 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)';

    private const UA_TWITTER = 'Twitterbot/1.0';

    /** Nama sumber yang rapi berdasarkan domain. Tambahkan domain baru di sini. */
    private const SITE_NAMES = [
        'instagram.com' => 'Instagram', 'tiktok.com' => 'TikTok',
        'youtube.com' => 'YouTube',   'youtu.be' => 'YouTube',
        'facebook.com' => 'Facebook',  'fb.watch' => 'Facebook',
        'x.com' => 'X (Twitter)', 'twitter.com' => 'X (Twitter)',
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

    // =====================================================================
    //  PUBLIK: /pemadaman-penyelamatan-evakuasi
    // =====================================================================
    public function publik(Request $request)
    {
        $jenis = $request->query('jenis');
        if (! array_key_exists((string) $jenis, Kejadian::JENIS)) {
            $jenis = null;
        }

        $daftar_kejadian = Kejadian::when($jenis, fn ($q) => $q->where('jenis', $jenis))
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->limit(24)
            ->get();

        $this->syncMissingImages($daftar_kejadian);

        return view('galery.berita.Kejadian', compact('daftar_kejadian', 'jenis'));
    }

    // =====================================================================
    //  OPERATOR: CRUD
    // =====================================================================
    public function index()
    {
        $kejadian = Kejadian::orderByDesc('tanggal')->orderByDesc('id')->get();

        $this->syncMissingImages($kejadian);

        return view('internal.operator.kejadian', [
            'kejadian' => $kejadian,
            'jenisList' => Kejadian::JENIS,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'jenis' => ['required', 'in:pemadaman,penyelamatan,evakuasi'],
            'tanggal' => ['required', 'date'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:3000'],
            'link' => ['nullable', 'url', 'max:2000'],
            'sumber' => ['nullable', 'string', 'max:255'],
            'gambar_url' => ['nullable', 'url', 'max:2000'],
            'gambar_manual' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'judul.required' => 'Judul kejadian wajib diisi.',
            'jenis.required' => 'Jenis kejadian wajib dipilih.',
        ]);

        $youtubeId = $request->filled('link') ? $this->extractYoutubeId($request->link) : null;
        $path = null;

        if ($request->hasFile('gambar_manual')) {
            // Upload manual selalu diprioritaskan
            $path = $request->file('gambar_manual')->store('kejadian', 'public');
        } elseif ($request->filled('gambar_url')) {
            // Unduh gambar hasil Tarik Data supaya tidak bergantung pada CDN luar
            $path = $this->downloadRemoteImage($request->gambar_url, $request->link);
        } elseif ($request->filled('link') && ! $youtubeId && $this->isSafeUrl($request->link)) {
            // Coba ambil gambar otomatis dari link jika form disubmit tanpa klik Tarik Data
            $og = $this->previewOpenGraph($this->resolveShortUrl($request->link));
            if (! empty($og['image'])) {
                $path = $this->downloadRemoteImage($og['image'], $request->link);
            }
        }

        Kejadian::create([
            'judul' => $request->judul,
            'jenis' => $request->jenis,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
            'sumber' => $request->filled('sumber')
                                ? $request->sumber
                                : ($request->filled('link') ? $this->sumberDariLink($request->link) : 'Dokumentasi Damkar'),
            'gambar' => $path,
            'youtube_id' => $youtubeId,
        ]);

        return back()->with('success', 'Data kejadian berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $item = Kejadian::findOrFail($id);

        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'jenis' => ['required', 'in:pemadaman,penyelamatan,evakuasi'],
            'tanggal' => ['required', 'date'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:3000'],
            'link' => ['nullable', 'url', 'max:2000'],
            'sumber' => ['nullable', 'string', 'max:255'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $item->fill([
            'judul' => $request->judul,
            'jenis' => $request->jenis,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
            'sumber' => $request->sumber,
            'youtube_id' => $request->filled('link') ? $this->extractYoutubeId($request->link) : null,
        ]);

        if ($request->hasFile('gambar')) {
            if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
                Storage::disk('public')->delete($item->gambar);
            }
            $item->gambar = $request->file('gambar')->store('kejadian', 'public');
        }

        $item->save();

        if (! $request->hasFile('gambar') && ! empty($item->link)) {
            $this->syncImageFromLink($item);
        }

        return back()->with('success', 'Data kejadian berhasil diperbarui!');
    }

    /**
     * Sinkronisasi foto otomatis dari link untuk daftar Kejadian yang file gambarnya belum ada di storage.
     */
    public function syncMissingImages(iterable $items): void
    {
        @set_time_limit(120);

        foreach ($items as $item) {
            if ($item instanceof Kejadian) {
                $this->syncImageFromLink($item);
            }
        }
    }

    /**
     * Ambil dan simpan foto dari link apabila file gambar lokal belum tersedia.
     */
    public function syncImageFromLink(Kejadian $item): bool
    {
        $g = trim((string) $item->gambar);
        if ($g !== '') {
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

        $cacheKey = 'kejadian_img_sync_fail_'.($item->id ?: md5($item->link));
        if (cache()->has($cacheKey)) {
            return false;
        }

        $url = trim($item->link);
        if (! $this->isSafeUrl($url)) {
            cache()->put($cacheKey, true, now()->addHours(6));

            return false;
        }

        $youtubeId = $item->youtube_id ?: $this->extractYoutubeId($url);
        $imageUrl = null;

        try {
            $resolvedUrl = $this->resolveShortUrl($url);
            $host = $this->hostOf($resolvedUrl);

            if ($youtubeId || $this->hostIs($host, ['youtube.com', 'youtu.be'])) {
                $yt = $this->previewYoutube($resolvedUrl);
                $imageUrl = $yt['image'] ?? null;
            } elseif ($this->hostIs($host, ['tiktok.com'])) {
                $tt = $this->previewTiktok($resolvedUrl);
                $imageUrl = $tt['image'] ?? null;
            } elseif ($this->hostIs($host, ['x.com', 'twitter.com'])) {
                $tw = $this->previewTwitter($resolvedUrl);
                $imageUrl = $tw['image'] ?? null;
            }

            if (! $imageUrl) {
                $og = $this->previewOpenGraph($resolvedUrl);
                $imageUrl = $og['image'] ?? null;
            }
        } catch (\Throwable $e) {
            report($e);
        }

        $path = $imageUrl ? $this->downloadRemoteImage($imageUrl, $url) : null;

        if (! $path && ! $youtubeId) {
            cache()->put($cacheKey, true, now()->addHours(2));

            return false;
        }

        $updates = [];
        if ($path) {
            $updates['gambar'] = $path;
            $item->gambar = $path;
        }
        if ($youtubeId && empty($item->youtube_id)) {
            $updates['youtube_id'] = $youtubeId;
            $item->youtube_id = $youtubeId;
        }

        if (! empty($updates) && $item->exists) {
            Kejadian::whereKey($item->getKey())->update($updates);
        }

        return true;
    }

    public function destroy($id)
    {
        $item = Kejadian::findOrFail($id);

        if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
            Storage::disk('public')->delete($item->gambar);
        }
        $item->delete();

        return back()->with('success', 'Data kejadian berhasil dihapus!');
    }

    // =====================================================================
    //  OPERATOR: TARIK DATA
    //  POST /internal/operator/kejadian/preview   body: { "url": "https://..." }
    //  Respon: { title, image, site_name, date, final_url } atau { error } (422)
    // =====================================================================
    public function preview(Request $request)
    {
        $request->validate(['url' => ['required', 'url', 'max:2000']]);

        $url = trim($request->input('url'));

        if (! $this->isSafeUrl($url)) {
            return response()->json(['error' => 'Alamat URL tidak diizinkan atau tidak dapat dijangkau.'], 422);
        }

        // Link pendek (vm.tiktok.com, t.co, fb.watch, share.google, dll) diikuti dulu ke alamat aslinya
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

            // 2) Fallback umum via Open Graph (berita web, Instagram, Facebook, dll)
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

        // 3) Tanggal otomatis dari ID postingan (TikTok, X, Instagram) bila belum ada
        if (empty($result['date'])) {
            $result['date'] = $this->dateFromPostId($url);
        }

        if (empty($result['title']) && empty($result['image'])) {
            $msg = $this->hostIs($host, ['instagram.com', 'tiktok.com', 'facebook.com', 'fb.watch', 'x.com', 'twitter.com'])
                ? 'Platform ini membatasi pengambilan data otomatis.'
                : 'Situs ini tidak mengizinkan pengambilan data otomatis.';

            return response()->json(['error' => $msg], 422);
        }

        return response()->json([
            'title' => $result['title'] ?? null,
            'image' => $result['image'] ?? null,
            'site_name' => $result['site_name'] ?? $this->sumberDariLink($url),
            'date' => $result['date'] ?? null,
            'final_url' => $result['final_url'] ?? $url,
        ]);
    }

    // =====================================================================
    //  HELPER: PREVIEW PER PLATFORM
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

        return ['title' => $title, 'image' => $image, 'site_name' => 'YouTube'];
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

    /** X / Twitter: teks + foto lewat fxtwitter (API publik pihak ketiga), fallback oEmbed resmi (teks saja). */
    private function previewTwitter(string $url): array
    {
        if (! preg_match('~(?:x|twitter)\.com/([A-Za-z0-9_]+)/status(?:es)?/(\d+)~i', $url, $m)) {
            return [];
        }
        [, $user, $id] = $m;

        // 1) fxtwitter: teks, foto, thumbnail video, waktu posting
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

                $date = null;
                if (! empty($tw['created_timestamp'])) {
                    $date = Carbon::createFromTimestamp((int) $tw['created_timestamp'])
                        ->timezone('Asia/Jakarta')->format('Y-m-d\TH:i');
                }

                return [
                    'title' => $text !== '' ? Str::limit($text, 200, '') : 'Postingan @'.$user,
                    'image' => $image,
                    'site_name' => 'X (Twitter)',
                    'date' => $date,
                ];
            }
        } catch (\Throwable $e) {
            // lanjut ke oEmbed
        }

        // 2) oEmbed resmi (tanpa gambar)
        try {
            $res = Http::withoutVerifying()->timeout(8)->get('https://publish.twitter.com/oembed', [
                'url' => "https://twitter.com/{$user}/status/{$id}",
                'omit_script' => 1,
            ]);

            if ($res->ok() && preg_match('~<p[^>]*>(.*?)</p>~s', (string) $res->json('html'), $mm)) {
                $text = html_entity_decode(strip_tags(preg_replace('~<br\s*/?>~i', ' ', $mm[1])));
                $text = trim(preg_replace('/\s+/', ' ', $text));

                return [
                    'title' => $text !== '' ? Str::limit($text, 200, '') : null,
                    'site_name' => 'X (Twitter)',
                ];
            }
        } catch (\Throwable $e) {
            // biarkan kosong, fallback Open Graph yang jalan
        }

        return [];
    }

    /**
     * Fallback umum: baca tag Open Graph / Twitter Card.
     * Mencoba beberapa User-Agent karena sebagian situs (Instagram, Facebook)
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

    /** Ambil judul, gambar, nama situs, dan tanggal terbit dari HTML. */
    private function parseMeta(string $html, string $baseUrl): array
    {
        $html = substr($html, 0, 800000); // meta tag ada di bagian atas

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

        // Abaikan halaman tantangan anti-bot / login
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
    //  HELPER: HTTP, REDIRECT, LINK PENDEK, TANGGAL
    // =====================================================================

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

    /**
     * Perkiraan waktu posting dari ID postingan:
     * TikTok (detik di 32 bit teratas), X (snowflake), Instagram (shortcode -> media id).
     * Hasilnya hanya saran awal, operator tetap bisa mengubah tanggalnya.
     */
    private function dateFromPostId(string $url): ?string
    {
        $ms = null;

        if (preg_match('~tiktok\.com/.*?/video/(\d{15,22})~i', $url, $m)) {
            $ms = ((int) $m[1] >> 32) * 1000;

        } elseif (preg_match('~(?:x|twitter)\.com/[^/]+/status(?:es)?/(\d{15,22})~i', $url, $m)) {
            $ms = (((int) $m[1]) >> 22) + 1288834974657;

        } elseif (preg_match('~instagram\.com/(?:[^/]+/)?(?:p|reel|reels|tv)/([A-Za-z0-9_-]+)~i', $url, $m)) {
            $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_';
            $id = 0;
            foreach (str_split($m[1]) as $char) {
                $pos = strpos($alphabet, $char);
                if ($pos === false || $id > (PHP_INT_MAX - 63) / 64) {
                    return null; // karakter asing / shortcode terlalu panjang
                }
                $id = $id * 64 + $pos;
            }
            $ms = ($id >> 23) + 1314220021721;
        }

        if (! $ms) {
            return null;
        }

        try {
            $dt = Carbon::createFromTimestamp((int) floor($ms / 1000))->timezone('Asia/Jakarta');
        } catch (\Throwable $e) {
            return null;
        }

        // Buang hasil yang tidak masuk akal
        if ($dt->year < 2010 || $dt->isAfter(now()->addDay())) {
            return null;
        }

        return $dt->format('Y-m-d\TH:i');
    }

    // =====================================================================
    //  HELPER: UNDUH GAMBAR REMOTE
    // =====================================================================

    /**
     * Unduh gambar dari URL, validasi tipe & ukuran, lalu simpan ke disk public.
     * Mengembalikan path relatif (mis. kejadian/xxxx.jpg) atau null bila gagal.
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
                    'Accept' => 'image/webp,image/png,image/jpeg,image/*,*/*;q=0.8',
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
            $ext = match ($finfo->buffer($body)) {
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

            $path = 'kejadian/'.Str::random(40).'.'.$ext;
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

    /** Ekstrak 11 karakter ID YouTube dari berbagai format URL (watch, youtu.be, shorts, live, embed). */
    private function extractYoutubeId(string $url): ?string
    {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts|live)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';

        return preg_match($pattern, $url, $m) ? $m[1] : null;
    }
}

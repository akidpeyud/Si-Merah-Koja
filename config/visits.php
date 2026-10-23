<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Timezone Perhitungan Kunjungan
    |--------------------------------------------------------------------------
    */

    'timezone' => env('VISIT_TIMEZONE', 'Asia/Jakarta'),

    /*
    |--------------------------------------------------------------------------
    | Jendela Cooldown per IP (Jam)
    |--------------------------------------------------------------------------
    |
    | Satu IP hanya dihitung 1 kunjungan dalam rentang jam ini.
    |
    */

    'cooldown_hours' => (int) env('VISIT_COOLDOWN_HOURS', 6),

    /*
    |--------------------------------------------------------------------------
    | Kunci Rahasia HMAC-SHA256 untuk Hash IP
    |--------------------------------------------------------------------------
    |
    | Wajib diisi melalui variabel environment VISIT_IP_SALT.
    |
    */

    'ip_salt' => env('VISIT_IP_SALT'),

    /*
    |--------------------------------------------------------------------------
    | Trusted Proxies
    |--------------------------------------------------------------------------
    |
    | Daftar IP/CIDR proxy tepercaya (dipisahkan koma) atau '*' jika berada
    | sepenuhnya di belakang Cloudflare/Nginx reverse proxy.
    |
    */

    'trusted_proxies' => env('TRUSTED_PROXIES', ''),

    /*
    |--------------------------------------------------------------------------
    | Whitelist Halaman yang Diizinkan
    |--------------------------------------------------------------------------
    */

    'allowed_pages' => [
        'simerahkoja',
    ],

    /*
    |--------------------------------------------------------------------------
    | Rate Limit Endpoint Pencatatan (Request per Menit per IP)
    |--------------------------------------------------------------------------
    */

    'rate_limit_per_minute' => (int) env('VISIT_RATE_LIMIT', 30),

    /*
    |--------------------------------------------------------------------------
    | Masa Retensi Log page_visits (Hari)
    |--------------------------------------------------------------------------
    */

    'retention_days' => (int) env('VISIT_RETENTION_DAYS', 7),

    /*
    |--------------------------------------------------------------------------
    | Daftar Keyword User-Agent Bot / Crawler yang Diabaikan
    |--------------------------------------------------------------------------
    */

    'bot_keywords' => [
        'googlebot',
        'bingbot',
        'slurp',
        'duckduckbot',
        'baiduspider',
        'yandexbot',
        'sogou',
        'exabot',
        'facebot',
        'facebookexternalhit',
        'ia_archiver',
        'twitterbot',
        'linkedinbot',
        'whatsapp',
        'telegrambot',
        'discordbot',
        'applebot',
        'ahrefsbot',
        'semrushbot',
        'mj12bot',
        'dotbot',
        'petalbot',
        'bytespider',
        'gptbot',
        'claudebot',
        'ccbot',
        'curl',
        'wget',
        'python-requests',
        'python-urllib',
        'aiohttp',
        'httpx',
        'scrapy',
        'httpclient',
        'go-http-client',
        'java/',
        'libwww-perl',
        'postmanruntime',
        'insomnia',
        'headlesschrome',
        'phantomjs',
        'selenium',
        'playwright',
        'puppeteer',
        'lighthouse',
        'gtmetrix',
        'pingdom',
        'uptimerobot',
        'statuscake',
        'crawler',
        'spider',
        'bot/',
        'bot;',
    ],

];

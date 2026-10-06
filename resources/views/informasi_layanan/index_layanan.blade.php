<?php
    $h = function ($v) { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); };

    /* ------------------------------------------------------------
       PENGATURAN HALAMAN
       Struktur kategori publikasi. Setiap kategori berisi daftar sub-menu.
       - Item dengan 'url'   : link biasa ke halaman lain.
       - Item dengan 'panel' : membuka panel data di sisi kanan (tanpa pindah halaman).
       Kategori tanpa 'items' tampil sebagai baris nonaktif (segera hadir).
       ------------------------------------------------------------ */
    $kategori = [
        'pencegahan' => [
            'label' => 'Bagian pencegahan',
            'items' => [
                ['panel' => 'kapasitas',    'label' => 'Peningkatan Kapasitas Aparatur',  'ico' => 'fa-arrow-trend-up'],
                ['panel' => 'inspeksi',     'label' => 'Pencegahan Kebakaran & Inspeksi', 'ico' => 'fa-magnifying-glass-chart'],
                ['panel' => 'pemberdayaan', 'label' => 'Pemberdayaan Masyarakat',         'ico' => 'fa-handshake-angle'],
            ],
        ],
        'pemadaman' => [
            'label' => 'Bagian pemadaman',
            'items' => [],
        ],
        'sapra' => [
            'label' => 'Bagian sapra',
            'items' => [
                ['url' => '/informasi-sarana',       'label' => 'Sarana pemadam',      'ico' => 'fa-fire-extinguisher'],
                ['url' => '/informasi-prasarana',    'label' => 'Prasarana pemadam',   'ico' => 'fa-building'],
                ['url' => '/informasi-penyelamatan', 'label' => 'Sarana penyelamatan', 'ico' => 'fa-life-ring'],
                ['url' => '/informasi-pemeriksaan',  'label' => 'Sarana pemeriksaan',  'ico' => 'fa-magnifying-glass'],
                ['url' => '/sumber-air',             'label' => 'Sumber Air',          'ico' => 'fa-droplet'],
                ['url' => '/hidrant-kota',           'label' => 'Data Hidrant Kota Jambi', 'ico' => 'fa-map-location-dot'],
            ],
        ],
    ];
    $kategori_aktif = $kategori_aktif ?? null; // Otomatis ngebuka menu Sapra
    $halaman_aktif  = $halaman_aktif ?? null;  // contoh: '/publik/sapra/sarana-pemadam'

    // Angka total dikirim dari controller, contoh:
    // ['diksar' => 12, 'f1' => 5, 'f2' => 3, 'rescue' => 0, 'mfr' => 0, 'operator' => 0,
    //  'inspektur' => 0, 'ppl' => 0, 'inspeksi' => 4, 'fire_drill' => 2, 'pelatihan' => 7, 'sosialisasi' => 9]
    // Kalau tidak dikirim, semua tampil 0.
    $stat = $stat ?? [];

    // Otomatis ambil total dari variabel yang sama dengan halaman internal
    // (Peningkatan Kapasitas Aparatur): $dataDiksar, $dataF1, $dataF2, dst.
    // Bisa berupa array, Collection, atau Paginator.
    $hitung = function ($d) {
        if ($d === null) return 0;
        if (is_object($d) && method_exists($d, 'total')) return $d->total();
        return count($d);
    };
    $sumber = [
        'diksar'    => $dataDiksar    ?? null,
        'f1'        => $dataF1        ?? null,
        'f2'        => $dataF2        ?? null,
        'rescue'    => $dataRescue    ?? null,
        'mfr'       => $dataMfr       ?? null,
        'operator'  => $dataOperator  ?? null,
        'inspektur' => $dataInspektur ?? null,
        'ppl'       => $dataPpl       ?? null,
        // Isi setelah variabel halaman internalnya diketahui:
        // 'inspeksi'    => $dataInspeksi    ?? null,
        // 'fire_drill'  => $dataFireDrill   ?? null,
        // 'pelatihan'   => $dataPelatihan   ?? null,
        // 'sosialisasi' => $dataSosialisasi ?? null,
    ];
    foreach ($sumber as $k => $d) {
        if (!isset($stat[$k]) && $d !== null) $stat[$k] = $hitung($d);
    }

    // Panel data (Bagian pencegahan). Format kartu: 'key' => [label, ikon]
    $panels = [
        'kapasitas' => [
            'title' => 'Peningkatan Kapasitas Aparatur',
            'desc'  => 'Data pendidikan dan pelatihan aparatur pemadam kebakaran.',
            'ico'   => 'fa-arrow-trend-up',
            'cards' => [
                'diksar'    => ['Data DIKSAR',      'fa-user-graduate'],
                'f1'        => ['Data DIKLAT F1',   'fa-fire-extinguisher'],
                'f2'        => ['Data DIKLAT F2',   'fa-fire'],
                'rescue'    => ['DIKLAT Rescue',    'fa-life-ring'],
                'mfr'       => ['DIKLAT MFR',       'fa-truck-medical'],
                'operator'  => ['DIKLAT Operator',  'fa-truck'],
                'inspektur' => ['DIKLAT Inspektur', 'fa-magnifying-glass'],
                'ppl'       => ['DIKLAT PPL',       'fa-chalkboard-user'],
            ],
        ],
        'inspeksi' => [
            'title' => 'Pencegahan Kebakaran & Inspeksi',
            'desc'  => 'Data inspeksi bangunan gedung, lingkungan, dan pelaksanaan fire drill.',
            'ico'   => 'fa-magnifying-glass-chart',
            'cards' => [
                'inspeksi'   => ['Inspeksi bangunan gedung', 'fa-building'],
                'fire_drill' => ['Fire drill',               'fa-fire'],
            ],
        ],
        'pemberdayaan' => [
            'title' => 'Pemberdayaan Masyarakat',
            'desc'  => 'Data sosialisasi, edukasi, dan pelatihan tanggap kebakaran.',
            'ico'   => 'fa-handshake-angle',
            'cards' => [
                'pelatihan'   => ['Pelatihan keluarga',    'fa-house'],
                'sosialisasi' => ['Sosialisasi & edukasi', 'fa-users'],
            ],
        ],
    ];

    // Menu Program kerja (dipakai oleh dropdown di header)
    $tabs = [
        'sotk'        => ['url' => '/sotk',        'label' => 'SOTK'],
        'sop'         => ['url' => '/sop',         'label' => 'SOP'],
        'perencanaan' => ['url' => '/perencanaan', 'label' => 'Perencanaan'],
        'pelaporan'   => ['url' => '/pelaporan',   'label' => 'Pelaporan'],
        'produkhukum' => ['url' => '/produkhukum', 'label' => 'Produk hukum'],
    ];
    $tab_aktif = null;

    $no_whatsapp    = "628117113113";
    $no_telepon     = "074141171";
    $telepon_tampil = "(0741) 41171";
    $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)%0A%0AMohon%20Isi%20Laporan%20Pengaduan%3A%20%0A%0ANama%20Pelapor%20%20%20%3A%0ANo.%20HP%20Pelapor%20%3A%0AAlamat%20Pelapor%20%3A%0AJenis%20Laporan%20%20%20%3A%20%20(Kebakaran%2FEvakuasi)%0A%0AAlamat%20Kejadian%20%3A%0A%0AKirim%20Peta%20Lokasi%20kejadian%20(Google%20Maps)%20%3A%0A%0AKirim%20Foto%20%26%20Video%20Kejadian%20%3A%0A%0ALaporan%20akan%20segera%20kami%20tindaklanjuti%20%F0%9F%9A%92%F0%9F%9A%92%F0%9F%9A%92%0ASalam%20YUDHA%20BRAMA%20JAYA%20Dinas%20Pemadam%20Kebakaran%20%26%20Penyelamatan%20Kota%20Jambi.";
    $wa_link   = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
    $maps_link = "https://www.google.com/maps/place/6PC59JJ2%2BQ76/@-1.6180875,103.6006406,871m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-1.6180875!4d103.6006406?entry=ttu&g_ep=EgoyMDI2MDkxNi4wIKXMDSoASAFQAw%3D%3D";

    // Isi dengan link Google Play jika aplikasi sudah tersedia. Kosong = badge disembunyikan.
    $play_store_url = "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <meta name="description" content="Informasi layanan dan fasilitas Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi: sarana, prasarana, dan aset pemadaman serta penyelamatan.">
    <title>Informasi layanan | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ==========================================================
           TOKENS (sama dengan halaman utama)
           ========================================================== */
        :root {
            --ink: #0d1b2a;
            --ink-2: #132a43;
            --ink-3: #1d3856;
            --paper: #f3f5f8;
            --white: #ffffff;
            --signal: #e5392d;
            --signal-d: #c22b20;
            --amber: #ffb627;
            --steel: #5b6c7f;
            --line: #dbe2ea;

            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;

            --r-lg: 28px;
            --r-md: 18px;
            --r-sm: 10px;
            --wrap: 1200px;
            --header-h: 64px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font-body);
            font-size: 1rem;
            line-height: 1.65;
            color: var(--ink);
            background: var(--white);
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }
        img { max-width: 100%; display: block; }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }

        :focus-visible { outline: 3px solid var(--amber); outline-offset: 3px; border-radius: 6px; }

        .wrap { max-width: var(--wrap); margin: 0 auto; padding-left: clamp(16px, 4vw, 32px); padding-right: clamp(16px, 4vw, 32px); }

        /* ==========================================================
           HEADER
           ========================================================== */
        .site-header {
            position: sticky; top: 0; z-index: 60;
            background: rgba(13, 27, 42, .85);
            -webkit-backdrop-filter: blur(14px) saturate(1.4);
            backdrop-filter: blur(14px) saturate(1.4);
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .nav {
            max-width: var(--wrap); margin: 0 auto; height: var(--header-h);
            padding: 0 clamp(16px, 4vw, 32px);
            display: flex; align-items: center; justify-content: space-between; gap: 24px;
        }
        .brand { display: flex; align-items: center; gap: 12px; }
        .brand img { height: 38px; width: auto; }

        .menu { display: flex; align-items: center; gap: 2px; }
        .menu > li { position: relative; }
        .menu-link, .menu-trigger {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 9px 14px; border-radius: 999px;
            color: rgba(255,255,255,.88); font-size: .92rem; font-weight: 500;
            transition: background .2s, color .2s;
        }
        .menu-link:hover, .menu-trigger:hover, .has-drop.open > .menu-trigger, .menu > li.current > .menu-trigger { background: rgba(255,255,255,.1); color: #fff; }
        .menu-trigger i { font-size: .65rem; transition: transform .2s; }
        .has-drop.open > .menu-trigger i { transform: rotate(180deg); }
        .menu .btn-login { background: var(--signal); color: #fff; margin-left: 10px; font-weight: 600; padding: 9px 22px; }
        .menu .btn-login:hover { background: var(--signal-d); }

        .dropdown {
            display: none; position: absolute; top: calc(100% + 10px); left: 0; min-width: 250px;
            background: var(--ink-2); border: 1px solid rgba(255,255,255,.1);
            border-radius: var(--r-md); padding: 6px; box-shadow: 0 24px 48px rgba(0,0,0,.45);
        }
        .dropdown::before { content: ""; position: absolute; left: 0; right: 0; top: -10px; height: 10px; }
        .dropdown a { display: block; padding: 11px 14px; border-radius: var(--r-sm); font-size: .92rem; color: rgba(255,255,255,.85); }
        .dropdown a:hover, .dropdown a[aria-current="page"] { background: rgba(255,255,255,.1); color: #fff; }
        .has-drop.open .dropdown { display: block; }
        @media (hover: hover) and (min-width: 992px) {
            .has-drop:hover .dropdown { display: block; }
        }

        .nav-toggle { display: none; width: 44px; height: 44px; border-radius: 12px; color: #fff; font-size: 1.15rem; }
        .nav-toggle:hover { background: rgba(255,255,255,.1); }

        @media (max-width: 991px) {
            .nav-toggle { display: inline-flex; align-items: center; justify-content: center; }
            .menu {
                display: none; position: fixed; top: var(--header-h); left: 0; right: 0;
                max-height: calc(100dvh - var(--header-h)); overflow-y: auto;
                flex-direction: column; align-items: stretch; gap: 4px;
                padding: 16px clamp(16px, 4vw, 32px) 28px; background: var(--ink);
                border-bottom: 1px solid rgba(255,255,255,.1);
            }
            .nav-open .menu { display: flex; }
            .menu-link, .menu-trigger { width: 100%; justify-content: space-between; padding: 14px 16px; border-radius: 14px; font-size: 1rem; }
            .dropdown { position: static; margin: 2px 0 8px 12px; box-shadow: none; background: transparent; border: 0; border-left: 2px solid rgba(255,255,255,.12); border-radius: 0; }
            .dropdown::before { display: none; }
            .menu .btn-login { margin: 8px 0 0; justify-content: center; padding: 14px; }
        }

        /* ==========================================================
           HERO HALAMAN
           ========================================================== */
        .page-hero {
            position: relative; isolation: isolate; color: #fff; background: var(--ink); overflow: hidden;
            padding: clamp(36px, 6vw, 72px) 0 clamp(72px, 10vw, 112px);
        }
        .page-hero::before {
            content: ""; position: absolute; inset: 0; z-index: -1;
            background:
                radial-gradient(55% 90% at 0% 100%, rgba(229,57,45,.4), transparent 70%),
                linear-gradient(100deg, rgba(13,27,42,.97) 0%, rgba(13,27,42,.86) 55%, rgba(13,27,42,.7) 100%),
                url('/images/background1.png') center / cover no-repeat;
        }
        .crumbs { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; font-size: .9rem; color: rgba(255,255,255,.7); margin-bottom: clamp(18px, 3vw, 28px); }
        .crumbs li { display: inline-flex; align-items: center; gap: 10px; }
        .crumbs li + li::before { content: "\203A"; opacity: .5; font-size: 1.1rem; line-height: 1; }
        .crumbs a:hover { color: #fff; text-decoration: underline; text-underline-offset: 4px; }
        .crumbs [aria-current="page"] { color: #fff; font-weight: 600; }
        .page-hero h1 {
            font-family: var(--font-display); font-weight: 800; font-stretch: 82%;
            font-size: clamp(2.8rem, 8vw, 5.5rem); line-height: .95; letter-spacing: -0.035em;
        }
        .page-hero p { margin-top: 18px; max-width: 56ch; color: rgba(255,255,255,.75); font-size: clamp(1rem, 1.5vw, 1.15rem); }

        .rise { animation: rise .8s cubic-bezier(.16,.84,.3,1) both; }
        .rise.d1 { animation-delay: .08s; } .rise.d2 { animation-delay: .18s; } .rise.d3 { animation-delay: .3s; }
        @keyframes rise { from { opacity: 0; transform: translateY(28px); } to { opacity: 1; transform: none; } }

        /* ==========================================================
           LAYOUT UTAMA
           ========================================================== */
        .page-body { background: var(--paper); padding-bottom: clamp(64px, 9vw, 112px); }
        .info-layout { display: grid; grid-template-columns: 300px minmax(0, 1fr); gap: 24px; align-items: start; margin-top: 40px; }
        @media (max-width: 900px) { .info-layout { grid-template-columns: 1fr; } }

        /* --- Sidebar kategori --- */
        .cat-panel { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); padding: 20px 16px; }
        .cat-panel h2 { padding: 4px 10px 16px; font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.05rem; letter-spacing: -0.01em; }
        .cat { border-top: 1px solid var(--line); }
        .cat:first-of-type { border-top: 0; }
        .cat-btn { display: flex; align-items: center; gap: 12px; width: 100%; padding: 14px 10px; text-align: left; border-radius: 12px; font-weight: 700; font-size: .9rem; color: var(--ink); transition: background .2s; }
        .cat-btn:hover { background: var(--paper); }
        .cat-btn i.chev { margin-left: auto; font-size: .7rem; color: var(--steel); transition: transform .2s; }
        .cat[data-open] .cat-btn i.chev { transform: rotate(180deg); }
        .cat[data-open] .cat-btn { color: var(--signal-d); }
        .cat-btn .dot { width: 8px; height: 8px; border-radius: 50%; background: var(--line); flex: none; }
        .cat-btn.has-items .dot { background: var(--signal); }
        .cat-btn:disabled { cursor: default; color: var(--steel); }
        .cat-btn:disabled:hover { background: transparent; }
        .cat-soon { margin-left: auto; font-size: .72rem; font-weight: 600; color: var(--steel); background: var(--paper); padding: 3px 10px; border-radius: 999px; }

        .cat-sub { list-style: none; overflow: hidden; max-height: 0; transition: max-height .3s ease; }
        .cat[data-open] .cat-sub { max-height: 400px; }
        .cat-sub li { padding: 2px 4px 8px; }
        .cat-sub a, .cat-sub button { display: flex; align-items: center; gap: 12px; width: 100%; text-align: left; padding: 11px 14px; border-radius: 12px; font-size: .9rem; font-weight: 600; color: var(--steel); transition: background .2s, color .2s; }
        .cat-sub a:hover, .cat-sub button:hover { background: var(--paper); color: var(--ink); }
        .cat-sub a i, .cat-sub button i { width: 20px; text-align: center; color: #b8c3d0; font-size: .95rem; flex: none; }
        .cat-sub a[aria-current="page"], .cat-sub button[aria-current="true"] { background: var(--signal); color: #fff; box-shadow: 0 10px 20px -8px rgba(229,57,45,.6); }
        .cat-sub a[aria-current="page"] i, .cat-sub button[aria-current="true"] i { color: #fff; }

        /* --- Panel konten kanan: landing --- */
        .welcome { position: relative; overflow: hidden; background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); min-height: 100%; padding: clamp(48px, 8vw, 96px) clamp(24px, 5vw, 56px); text-align: center; display: grid; place-items: center; }
        .welcome[hidden] { display: none; }
        .welcome::before { content: ""; position: absolute; inset: 0; background: radial-gradient(60% 50% at 50% 0%, rgba(229,57,45,.06), transparent 70%); pointer-events: none; }
        .welcome-inner { position: relative; max-width: 46ch; display: grid; gap: 18px; justify-items: center; }
        .welcome-logo { width: 88px; height: 88px; border-radius: 22px; background: #fff; border: 1px solid var(--line); box-shadow: 0 10px 24px -12px rgba(13,27,42,.35); display: grid; place-items: center; margin-bottom: 4px; padding: 14px; }
        .welcome-logo img { width: 100%; height: 100%; object-fit: contain; }
        .welcome h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: clamp(1.5rem, 3vw, 2rem); line-height: 1.2; letter-spacing: -0.015em; }
        .welcome p { color: var(--steel); line-height: 1.6; }
        .welcome .cue { display: inline-flex; align-items: center; gap: 10px; padding: 12px 22px; border-radius: 999px; background: #fdeceb; color: var(--signal-d); font-weight: 700; font-size: .95rem; }
        .welcome .cue i { animation: nudge 1.6s ease-in-out infinite; }
        @keyframes nudge { 0%, 100% { transform: translateX(0); } 50% { transform: translateX(-5px); } }

        /* --- Panel konten kanan: data Bagian pencegahan --- */
        .data-panel { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); overflow: hidden; }
        .data-panel[hidden] { display: none; animation: none; }
        .data-panel { animation: rise .5s cubic-bezier(.16,.84,.3,1) both; }

        .dp-head { position: relative; isolation: isolate; display: flex; align-items: center; gap: 18px; padding: clamp(22px, 3.5vw, 34px); color: #fff; background: var(--ink); }
        .dp-head::before { content: ""; position: absolute; inset: 0; z-index: -1; background: radial-gradient(70% 140% at 0% 100%, rgba(229,57,45,.45), transparent 70%), linear-gradient(100deg, var(--ink) 0%, var(--ink-3) 100%); }
        .dp-head-ico { flex: none; width: 56px; height: 56px; border-radius: 16px; display: grid; place-items: center; font-size: 1.35rem; background: var(--signal); box-shadow: 0 12px 24px -8px rgba(229,57,45,.7); }
        .dp-head-txt { flex: 1; min-width: 0; }
        .dp-head h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: clamp(1.3rem, 2.6vw, 1.75rem); line-height: 1.15; letter-spacing: -0.015em; }
        .dp-head p { margin-top: 4px; font-size: .92rem; color: rgba(255,255,255,.72); }
        .dp-total { flex: none; text-align: right; padding: 10px 18px; border-radius: 16px; background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.14); }
        .dp-total span { display: block; font-size: .7rem; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: rgba(255,255,255,.65); }
        .dp-total strong { font-family: var(--font-display); font-size: 1.8rem; line-height: 1.1; }
        @media (max-width: 640px) {
            .dp-head { flex-wrap: wrap; }
            .dp-total { width: 100%; text-align: left; display: flex; align-items: baseline; justify-content: space-between; }
        }

        .dp-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(210px, 1fr)); gap: 16px; padding: clamp(18px, 3vw, 30px); background: var(--paper); }
        .dp-card { --c: #e5392d; --t: #fdeceb; position: relative; overflow: hidden; display: grid; gap: 4px; align-content: start; padding: 22px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); transition: transform .25s, box-shadow .25s, border-color .25s; }
        .dp-card::before { content: ""; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: var(--c); opacity: .9; }
        .dp-card:hover { transform: translateY(-4px); border-color: var(--c); box-shadow: 0 18px 30px -18px rgba(13,27,42,.35); }
        .dp-card:nth-child(6n+2) { --c: #f59e0b; --t: #fef3d6; }
        .dp-card:nth-child(6n+3) { --c: #2563eb; --t: #e3ecfd; }
        .dp-card:nth-child(6n+4) { --c: #0d9488; --t: #d9f3f0; }
        .dp-card:nth-child(6n+5) { --c: #7c3aed; --t: #ece4fd; }
        .dp-card:nth-child(6n+6) { --c: #db2777; --t: #fbe3ee; }
        .dp-ico { width: 46px; height: 46px; border-radius: 14px; background: var(--t); color: var(--c); display: grid; place-items: center; font-size: 1.1rem; margin-bottom: 12px; }
        .dp-label { font-size: .8rem; font-weight: 600; color: var(--steel); }
        .dp-num { font-family: var(--font-display); font-weight: 800; font-stretch: 88%; font-size: 2.4rem; line-height: 1.05; letter-spacing: -0.02em; color: var(--ink); }
        .dp-bg { position: absolute; right: -10px; bottom: -14px; font-size: 5.5rem; color: var(--c); opacity: .07; pointer-events: none; transform: rotate(-12deg); transition: transform .3s, opacity .3s; }
        .dp-card:hover .dp-bg { opacity: .13; transform: rotate(-4deg) scale(1.08); }

        /* ==========================================================
           FOOTER
           ========================================================== */
        .footer { background: var(--ink); color: rgba(255,255,255,.7); padding: clamp(56px, 8vw, 96px) 0 32px; }
        .footer-grid { display: grid; grid-template-columns: 1.1fr 1.2fr .8fr; gap: clamp(32px, 5vw, 64px); }
        .footer h3 { font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; color: #fff; margin-bottom: 16px; }
        .footer-about img { height: 96px; width: auto; margin-bottom: 20px; }
        .footer-about p { max-width: 42ch; font-size: .95rem; }
        .map { position: relative; height: 190px; border-radius: var(--r-md); overflow: hidden; background: var(--ink-2); }
        .map iframe { width: 100%; height: 100%; border: 0; pointer-events: none; filter: grayscale(.3) contrast(1.05); transition: filter .3s; }
        .map-link { position: absolute; inset: 0; z-index: 2; display: flex; align-items: flex-end; justify-content: flex-end; padding: 12px; border-radius: var(--r-md); }
        .map-link span { display: inline-flex; align-items: center; gap: 8px; padding: 8px 14px; border-radius: 999px; background: var(--signal); color: #fff; font-size: .85rem; font-weight: 700; box-shadow: 0 8px 20px rgba(0,0,0,.35); transition: background .2s, transform .2s; }
        .map-link:hover span, .map-link:focus-visible span { background: var(--signal-d); transform: translateY(-2px); }
        .map:hover iframe { filter: none; }
        .find { margin-top: 14px; display: inline-flex; align-items: center; gap: 10px; font-weight: 600; color: #fff; transition: color .2s, gap .2s; }
        .find i { color: var(--signal); }
        .find:hover { color: var(--amber); gap: 14px; }
        .app-dl { margin-top: 22px; }
        .app-dl p { font-size: .88rem; margin-bottom: 10px; }
        .app-dl img { height: 44px; width: auto; }
        .footer-links li + li { margin-top: 8px; }
        .footer-links a { display: flex; align-items: center; gap: 10px; padding: 6px 0; font-size: .95rem; transition: color .2s, gap .2s; }
        .footer-links a i { font-size: .7rem; color: var(--signal); }
        .footer-links a:hover { color: #fff; gap: 14px; }
        .footer-bar { margin-top: clamp(40px, 6vw, 72px); padding-top: 28px; border-top: 1px solid rgba(255,255,255,.1); display: flex; flex-wrap: wrap; gap: 20px; justify-content: space-between; align-items: center; font-size: .88rem; }
        .footer .social a { background: rgba(255,255,255,.08); color: #fff; }
        .footer .social a:hover { background: var(--signal); }
        @media (max-width: 900px) { .footer-grid { grid-template-columns: 1fr; } }

        /* ==========================================================
           TOMBOL LAPOR MENGAMBANG
           ========================================================== */
        .beacon { position: relative; width: 12px; height: 12px; border-radius: 50%; background: #fff; flex: none; }
        .beacon::after { content: ""; position: absolute; inset: 0; border-radius: 50%; background: #fff; animation: ping 1.8s cubic-bezier(0,0,.2,1) infinite; }
        @keyframes ping { 0% { transform: scale(1); opacity: .7; } 100% { transform: scale(3.2); opacity: 0; } }
        .sos-fab { position: fixed; right: clamp(14px, 3vw, 28px); bottom: clamp(14px, 3vw, 28px); z-index: 70; display: flex; flex-direction: column; align-items: flex-end; gap: 12px; opacity: 0; visibility: hidden; transform: translateY(16px); transition: opacity .3s, transform .3s, visibility .3s; }
        .sos-fab.show { opacity: 1; visibility: visible; transform: none; }
        .sos-fab-btn { display: inline-flex; align-items: center; gap: 10px; padding: 14px 22px; border-radius: 999px; background: var(--signal); color: #fff; font-weight: 700; box-shadow: 0 14px 30px -6px rgba(229,57,45,.6); }
        .sos-fab-btn:hover { background: var(--signal-d); }
        .sos-sheet { display: none; width: min(320px, calc(100vw - 28px)); padding: 8px; border-radius: 20px; background: var(--ink); border: 1px solid rgba(255,255,255,.12); box-shadow: 0 24px 48px rgba(0,0,0,.45); }
        .sos-fab.open .sos-sheet { display: grid; gap: 6px; }
        .sos-sheet a { display: flex; align-items: center; gap: 14px; padding: 13px 14px; border-radius: 14px; color: #fff; font-weight: 600; }
        .sos-sheet a:hover { background: rgba(255,255,255,.1); }
        .sos-sheet a i { width: 22px; text-align: center; font-size: 1.15rem; }
        .sos-sheet .wa i { color: #25d366; } .sos-sheet .tel i { color: #38bdf8; } .sos-sheet .n112 i { color: #f87171; }

        /* ==========================================================
           REDUCED MOTION
           ========================================================== */
        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *, *::before, *::after { animation: none !important; transition: none !important; }
        }
    </style>
</head>
<body>

<!-- ==================== HEADER ==================== -->
<header class="site-header" id="siteHeader">
    <nav class="nav" aria-label="Navigasi utama">
        <a href="/" class="brand" aria-label="SIMERAH KOJA, beranda">
            <img src="/images/jambi.png" alt="Logo Pemkot Jambi">
            <img src="/images/logo.png" alt="Logo Damkar">
            <img src="/images/logo-redkar.png" alt="Logo Redkar">
        </a>

        <button class="nav-toggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="menu">
            <i class="fas fa-bars"></i>
        </button>

        <ul class="menu" id="menu">
            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan kedaruratan <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="<?= $h($wa_link) ?>" target="_blank" rel="noopener">WhatsApp</a></li>
                    <li><a href="tel:<?= $h($no_telepon) ?>">Telepon</a></li>
                    <li><a href="tel:112">Call Center 112</a></li>
                </ul>
            </li>
            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Program kerja <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <?php foreach (['sotk', 'perencanaan', 'pelaporan', 'sop', 'produkhukum'] as $k): ?>
                        <li><a href="<?= $h($tabs[$k]['url']) ?>" <?php if ($k === $tab_aktif): ?> aria-current="page" <?php endif; ?>><?= $h($tabs[$k]['label']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>

            <!-- MENU BAGIAN SAPRA DIHEADER PUBLIK -->

            <!-- AKHIR MENU BAGIAN SAPRA DIHEADER PUBLIK -->

            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/layanan-fasilitas/layanan_perizinan">RPKBGL</a></li>
                    <li><a href="/layanan-fasilitas/skk">SKK &amp; Perpanjang SKK</a></li>
                    <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Edukasi dan sosialisasi</a></li>
                    <li><a href="/public-sigap">SIGAP</a></li>
                    <li><a href="/informasi-layanan">Informasi layanan</a></li>
                </ul>
            </li>
             <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Kabar Damkar <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/edu-damkar">Edu Damkar</a></li>
                    <li><a href="#infografis">Info Grafis</a></li>
                    <li><a href="/media-informasi">Media Informasi</a></li>
                    <li><a href="/ujung-ujung-damkar">Ujung-ujung Damkar</a></li>
                </ul>
            </li>
            <li><a class="menu-link" href="/redkar">Redkar</a></li>
             @if(session()->has('pemohon_id'))
                <li class="has-drop">
                    <button class="menu-trigger btn-login" type="button" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> {{ strtok(session('pemohon_nama'), " ") }} <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown">
                        <li>
                            <form action="{{ route('pemohon.logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="btn-logout">
                                    <i class="fas fa-sign-out-alt"></i> Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <li><a class="menu-link btn-login" href="{{ route('pemohon.login') }}">Masuk</a></li>
            @endif
        </ul>
    </nav>
</header>

<main>

<!-- ==================== HERO HALAMAN ==================== -->
<section class="page-hero">
    <div class="wrap">
        <nav aria-label="Breadcrumb" class="rise">
            <ol class="crumbs">
                <li><a href="/">Beranda</a></li>
                <li><a href="/layanan-fasilitas/layanan_perizinan">Layanan &amp; fasilitas</a></li>
                <li><span aria-current="page">Informasi layanan</span></li>
            </ol>
        </nav>
        <h1 class="rise d1">Informasi layanan</h1>
        <p class="rise d2">Portal transparansi informasi fasilitas dan aset Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
    </div>
</section>

<div class="page-body">
    <div class="wrap">
        <div class="info-layout">

            <!-- Sidebar kategori -->
            <nav class="cat-panel" aria-label="Kategori publikasi">
                <h2>Kategori publikasi</h2>
                <?php foreach ($kategori as $slug => $kat):
                    $ada_isi = !empty($kat['items']);
                    $terbuka = $ada_isi && $kategori_aktif === $slug;
                ?>
                <div class="cat" <?php if ($terbuka): ?> data-open <?php endif; ?>>
                    <?php if ($ada_isi): ?>
                        <button type="button" class="cat-btn has-items" aria-expanded="<?= $terbuka ? 'true' : 'false' ?>">
                            <span class="dot"></span> <?= $h($kat['label']) ?>
                            <i class="fas fa-chevron-down chev"></i>
                        </button>
                        <ul class="cat-sub">
                            <?php foreach ($kat['items'] as $item): ?>
                                <li>
                                    <?php if (!empty($item['panel'])): ?>
                                        <button type="button" data-panel="<?= $h($item['panel']) ?>">
                                            <i class="fas <?= $h($item['ico']) ?>"></i> <?= $h($item['label']) ?>
                                        </button>
                                    <?php else: ?>
                                        <a href="<?= $h($item['url']) ?>" <?php if ($halaman_aktif === $item['url']): ?> aria-current="page" <?php endif; ?>>
                                            <i class="fas <?= $h($item['ico']) ?>"></i> <?= $h($item['label']) ?>
                                        </a>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <button type="button" class="cat-btn" disabled>
                            <span class="dot"></span> <?= $h($kat['label']) ?>
                            <span class="cat-soon">Segera hadir</span>
                        </button>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </nav>

            <!-- Panel landing -->
            <section class="welcome" aria-live="polite">
                <div class="welcome-inner">
                    <div class="welcome-logo"><img src="/images/logo.png" alt=""></div>
                    <h2>Selamat datang di Informasi Layanan Publik</h2>
                    <p>Jelajahi galeri armada, prasarana pos, sarana penyelamatan, dan aset pemadaman lainnya milik Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
                    <span class="cue"><i class="fas fa-arrow-left"></i> Pilih kategori di sebelah kiri untuk memulai</span>
                </div>
            </section>

            <!-- Panel data Bagian pencegahan (muncul saat bidang diklik) -->
            <?php foreach ($panels as $pk => $p):
                $total = 0;
                foreach ($p['cards'] as $key => $c) { $total += (int) ($stat[$key] ?? 0); }
            ?>
            <section class="data-panel" id="panel-<?= $h($pk) ?>" hidden>
                <header class="dp-head">
                    <span class="dp-head-ico"><i class="fas <?= $h($p['ico']) ?>"></i></span>
                    <div class="dp-head-txt">
                        <h2><?= $h($p['title']) ?></h2>
                        <p><?= $h($p['desc']) ?></p>
                    </div>
                    <div class="dp-total">
                        <span>Total data</span>
                        <strong><?= $h(number_format($total, 0, ',', '.')) ?></strong>
                    </div>
                </header>

                <div class="dp-grid">
                    <?php foreach ($p['cards'] as $key => $c): ?>
                        <article class="dp-card">
                            <span class="dp-ico"><i class="fas <?= $h($c[1]) ?>"></i></span>
                            <span class="dp-label"><?= $h($c[0]) ?></span>
                            <strong class="dp-num"><?= $h(number_format($stat[$key] ?? 0, 0, ',', '.')) ?></strong>
                            <i class="fas <?= $h($c[1]) ?> dp-bg" aria-hidden="true"></i>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endforeach; ?>

        </div>
    </div>
</div>

</main>



<!-- ==================== FOOTER ==================== -->
<footer class="footer">
    <div class="wrap">
        <div class="footer-grid">
            <div class="footer-about">
                <img src="/images/simerahkoja.png" alt="Logo SIMERAH KOJA" loading="lazy">
                <h3>Tentang kami</h3>
                <p>SIMERAH KOJA merupakan sistem informasi pemerintahan berbasis elektronik yang terintegrasi pada dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
            </div>

            <div>
                <div class="map">
                    <iframe
                        title="Lokasi Dinas Pemadam Kebakaran Kota Jambi"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.202353147814!2d103.600648!3d-1.618096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e22c8c6a234f6b1%3A0x4d537f0a82384f88!2sDinas%20Pemadam%20Kebakaran%20Kota%20Jambi!5e1!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                        tabindex="-1" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <a class="map-link" href="<?= $h($maps_link) ?>" target="_blank" rel="noopener" aria-label="Buka lokasi Dinas Pemadam Kebakaran Kota Jambi di Google Maps">
                        <span><i class="fas fa-location-arrow"></i> Buka di Google Maps</span>
                    </a>
                </div>
                <a class="find" href="<?= $h($maps_link) ?>" target="_blank" rel="noopener"><i class="fas fa-map-marker-alt"></i> Temukan kami di peta</a>

                <?php if ($play_store_url): ?>
                <div class="app-dl">
                    <p>Unduh aplikasi SIMERAH KOJA</p>
                    <a href="<?= $h($play_store_url) ?>" target="_blank" rel="noopener">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Dapatkan di Google Play">
                    </a>
                </div>
                <?php endif; ?>
            </div>

            <div class="footer-links">
                <h3>Link terkait</h3>
                <ul>
                    <li><a href="https://damkar.jambikota.go.id/" target="_blank" rel="noopener"><i class="fas fa-angle-right"></i> Official Damkar</a></li>
                    <li><a href="https://jambikota.go.id/" target="_blank" rel="noopener"><i class="fas fa-angle-right"></i> Website Jambikota</a></li>
                    <li><a href="https://sikoja.jambikota.go.id/" target="_blank" rel="noopener"><i class="fas fa-angle-right"></i> SIKOJA</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bar">
            <div>SIMERAH KOJA &copy; <?= $h(date('Y')) ?>. Hak cipta dilindungi.</div>
            <div class="social">
                <a href="mailto:damkar.jbi@gmail.com" title="Email" aria-label="Email"><i class="fas fa-envelope"></i></a>
                <a href="https://twitter.com/damkarkotajambi" target="_blank" rel="noopener" title="Twitter / X" aria-label="Twitter / X"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com/DamkarKotaJambi" target="_blank" rel="noopener" title="Facebook" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/@damkarkotajambi" target="_blank" rel="noopener" title="YouTube" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="https://www.tiktok.com/@damkar.kota.jambi" target="_blank" rel="noopener" title="TikTok" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                <a href="https://www.instagram.com/damkar.kotajambi/" target="_blank" rel="noopener" title="Instagram" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</footer>

<!-- ==================== TOMBOL LAPOR MENGAMBANG ==================== -->
<div class="sos-fab" id="sosFab">
    <div class="sos-sheet" id="sosSheet">
        <a class="wa" href="<?= $h($wa_link) ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Lapor lewat WhatsApp</a>
        <a class="tel" href="tel:<?= $h($no_telepon) ?>"><i class="fas fa-phone-alt"></i> Telepon <?= $h($telepon_tampil) ?></a>
        <a class="n112" href="tel:112"><i class="fas fa-headset"></i> Call Center 112</a>
    </div>
    <button class="sos-fab-btn" type="button" aria-expanded="false" aria-controls="sosSheet">
        <span class="beacon" aria-hidden="true"></span> Lapor darurat
    </button>
</div>

<script>
(function () {
    'use strict';

    /* ---------- Navigasi ---------- */
    var header = document.getElementById('siteHeader');
    var toggle = header.querySelector('.nav-toggle');
    var drops = header.querySelectorAll('.has-drop');

    function closeDrops(except) {
        drops.forEach(function (li) {
            if (li !== except) {
                li.classList.remove('open');
                li.querySelector('.menu-trigger').setAttribute('aria-expanded', 'false');
            }
        });
    }

    toggle.addEventListener('click', function () {
        var open = header.classList.toggle('nav-open');
        toggle.setAttribute('aria-expanded', open);
        toggle.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
        toggle.querySelector('i').className = open ? 'fas fa-times' : 'fas fa-bars';
    });

    drops.forEach(function (li) {
        var btn = li.querySelector('.menu-trigger');
        btn.addEventListener('click', function () {
            var open = li.classList.toggle('open');
            btn.setAttribute('aria-expanded', open);
            closeDrops(li);
        });
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.has-drop')) closeDrops(null);
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeDrops(null);
    });

    /* ---------- Tombol lapor mengambang (muncul setelah scroll) ---------- */
    var fab = document.getElementById('sosFab');
    var fabBtn = fab.querySelector('.sos-fab-btn');

    function updateFab() {
        var show = window.scrollY > 320;
        fab.classList.toggle('show', show);
        if (!show) { fab.classList.remove('open'); fabBtn.setAttribute('aria-expanded', 'false'); }
    }
    window.addEventListener('scroll', updateFab, { passive: true });
    updateFab();

    fabBtn.addEventListener('click', function () {
        var open = fab.classList.toggle('open');
        fabBtn.setAttribute('aria-expanded', open);
    });

    /* ---------- Akordion kategori ---------- */
    document.querySelectorAll('.cat-btn.has-items').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var cat = btn.closest('.cat');
            var nowOpen = !cat.hasAttribute('data-open');
            document.querySelectorAll('.cat[data-open]').forEach(function (c) { c.removeAttribute('data-open'); c.querySelector('.cat-btn').setAttribute('aria-expanded', 'false'); });
            if (nowOpen) { cat.setAttribute('data-open', ''); btn.setAttribute('aria-expanded', 'true'); }
        });
    });

    /* ---------- Panel data Bagian pencegahan ---------- */
    var welcome = document.querySelector('.welcome');
    var panelBtns = document.querySelectorAll('[data-panel]');
    var panelEls = document.querySelectorAll('.data-panel');

    panelBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            panelBtns.forEach(function (b) { b.removeAttribute('aria-current'); });
            btn.setAttribute('aria-current', 'true');
            welcome.hidden = true;
            panelEls.forEach(function (p) { p.hidden = true; });

            var panel = document.getElementById('panel-' + btn.dataset.panel);
            panel.hidden = false;
            if (window.innerWidth <= 900) panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });
})();
</script>
</body>
</html>
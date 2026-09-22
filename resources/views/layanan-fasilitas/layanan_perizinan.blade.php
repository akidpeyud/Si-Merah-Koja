<?php
    $h = function ($v) { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); };

    /* ------------------------------------------------------------
       PENGATURAN HALAMAN
       Dari controller bisa dikirim (semuanya opsional):
         $tab_aktif        : 'rpkbgl' | 'skk' | 'perpanjang_skk'
         $kecamatan_list   : [['id' => 1, 'nama' => 'Kota Baru'], ...]
         $kelurahan_list   : [['id' => 10, 'nama' => 'Suka Karya', 'kecamatan_id' => 1], ...]
         $old              : isian sebelumnya (mis. old() di Laravel) supaya tidak hilang saat gagal kirim
         $pesan_sukses     : teks sukses setelah formulir terkirim
         $galat            : array pesan galat validasi
         $url_surat_permohonan : link unduh templat surat permohonan
       ------------------------------------------------------------ */
    $layanan = [
        'rpkbgl' => ['url' => '/layanan-fasilitas/layanan_perizinan', 'label' => 'RPKBGL', 'ico' => 'fa-building', 'ket' => 'Layanan perizinan Rekomendasi Proteksi Kebakaran Bangunan Gedung dan Lingkungan'],
        'skk'    => ['url' => '/layanan-fasilitas/skk',                'label' => 'SKK (Baru & Perpanjangan)', 'ico' => 'fa-user-shield', 'ket' => 'Layanan perizinan penerbitan & perpanjangan Sertifikat Keamanan Kebakaran'],
    ];
    $tab_aktif = $tab_aktif ?? 'rpkbgl';

    $kecamatan_list = $kecamatan_list ?? [];
    $kelurahan_list = $kelurahan_list ?? [];
    $old            = $old ?? [];
    $pesan_sukses   = $pesan_sukses ?? '';
    $galat          = $galat ?? [];
    $url_surat_permohonan = $url_surat_permohonan ?? '';

    $to_arr = function ($d) { return (is_object($d) && method_exists($d, 'toArray')) ? $d->toArray() : (array) $d; };
    $val    = function ($k) use ($old, $h) { return $h($old[$k] ?? ''); };

    $kategori_list = ['1' => 'Rumah tinggal', '2' => 'Komersial', '3' => 'Industri'];

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
    <meta name="description" content="Ajukan <?= $h($layanan[$tab_aktif]['ket']) ?> secara daring di Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.">
    <title><?= $h($layanan[$tab_aktif]['label']) ?> - Layanan perizinan | SIMERAH KOJA</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ==========================================================
           TOKENS (sama dengan halaman utama & Program kerja)
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
        body:has(dialog[open]) { overflow: hidden; }
        img { max-width: 100%; display: block; }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }

        :focus-visible { outline: 3px solid var(--amber); outline-offset: 3px; border-radius: 6px; }

        .wrap { max-width: var(--wrap); margin: 0 auto; padding-left: clamp(16px, 4vw, 32px); padding-right: clamp(16px, 4vw, 32px); }
        .sr-only { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0 0 0 0); white-space: nowrap; }

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
        
        /* Tambahan Style untuk Tombol Logout Dropdown */
        .dropdown .btn-logout {
            width: 100%; text-align: left; padding: 11px 14px; border-radius: var(--r-sm); 
            font-size: .92rem; color: #ff8b8b; display: flex; align-items: center; gap: 8px; 
            transition: background .2s, color .2s; cursor: pointer;
        }
        .dropdown .btn-logout:hover { background: rgba(255, 255, 255, .1); color: #ffb8b8; }

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
                url('/images/background1.jpg') center / cover no-repeat;
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
           TAB LAYANAN (menempel di tepi hero)
           ========================================================== */
        .page-body { background: var(--paper); padding-bottom: clamp(64px, 9vw, 112px); }
        .tabs-wrap { position: relative; z-index: 2; margin-top: -30px; }
        .tabs {
            display: flex; gap: 6px; padding: 7px; width: max-content; max-width: 100%;
            background: #fff; border: 1px solid var(--line); border-radius: 999px;
            box-shadow: 0 18px 36px -20px rgba(13,27,42,.45);
            overflow-x: auto; scrollbar-width: none;
        }
        .tabs::-webkit-scrollbar { display: none; }
        .tab {
            display: inline-flex; align-items: center; gap: 10px; white-space: nowrap;
            padding: 11px 20px; border-radius: 999px; font-weight: 600; font-size: .92rem; color: var(--steel);
            transition: background .2s, color .2s;
        }
        .tab i { font-size: .95rem; }
        .tab:hover { background: var(--paper); color: var(--ink); }
        .tab[aria-current="page"] { background: var(--ink); color: #fff; }
        .tab[aria-current="page"] i { color: var(--amber); }

        /* ==========================================================
           RINGKASAN LAYANAN
           ========================================================== */
        .c-ico { flex: none; width: 40px; height: 40px; border-radius: 12px; display: grid; place-items: center; background: var(--paper); color: var(--signal-d); font-size: 1rem; }

        .facts { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-top: 28px; }
        .fact { display: flex; align-items: center; gap: 14px; padding: 18px 20px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); }
        .fact .c-ico { width: 46px; height: 46px; background: #fdeceb; font-size: 1.1rem; }
        .fact small { display: block; font-size: .8rem; color: var(--steel); line-height: 1.3; margin-bottom: 2px; }
        .fact strong, .fact a { display: block; font-weight: 600; font-size: .95rem; line-height: 1.4; }
        .fact a:hover { color: var(--signal-d); text-decoration: underline; text-underline-offset: 4px; }

        /* ==========================================================
           LAYOUT KONTEN
           ========================================================== */
        .perizinan-layout { display: grid; grid-template-columns: minmax(0, 1fr); gap: 24px; margin-top: 24px; align-items: start; }
        @media (min-width: 992px) {
            .perizinan-layout { grid-template-columns: minmax(300px, 380px) minmax(0, 1fr); gap: 32px; }
        }
        .info-stack { display: grid; gap: 16px; }
        #formulir { scroll-margin-top: calc(var(--header-h) + 16px); }

        .jump { display: none; align-items: center; justify-content: center; gap: 10px; padding: 13px 20px; border-radius: 999px; background: var(--ink); color: #fff; font-weight: 600; font-size: .92rem; }
        .jump i { color: var(--amber); }
        .jump:hover { background: var(--ink-3); }
        @media (max-width: 991px) { .jump { display: inline-flex; } }

        .side-card { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: clamp(20px, 3vw, 28px); }
        .card-head { display: flex; align-items: center; gap: 14px; margin-bottom: 18px; }
        .card-head h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.25rem; line-height: 1.15; letter-spacing: -0.015em; }

        .law-list { display: grid; gap: 10px; }
        .law-list li { position: relative; padding-left: 22px; font-size: .93rem; line-height: 1.5; }
        .law-list li::before { content: ""; position: absolute; left: 2px; top: .55em; width: 8px; height: 8px; border-radius: 50%; background: var(--signal); }
        .card-link { margin-top: 18px; display: inline-flex; align-items: center; gap: 8px; font-size: .9rem; font-weight: 600; color: var(--signal-d); }
        .card-link:hover { text-decoration: underline; text-underline-offset: 4px; }

        .checklist { display: grid; gap: 18px; }
        .checklist li { display: grid; grid-template-columns: 36px minmax(0, 1fr); gap: 14px; align-items: start; font-size: .93rem; line-height: 1.5; }
        .ck-ico { width: 36px; height: 36px; border-radius: 10px; display: grid; place-items: center; background: #fdeceb; color: var(--signal-d); font-size: .9rem; }
        .checklist a.inline { font-weight: 600; color: var(--signal-d); text-decoration: underline; text-underline-offset: 3px; }
        .checklist .muted { color: var(--steel); }
        .tool { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 38px; margin-top: 8px; padding: 0 16px; border-radius: 999px; background: var(--paper); font-size: .88rem; font-weight: 600; transition: background .2s, color .2s; }
        .tool:hover { background: var(--ink); color: #fff; }

        /* Mekanisme (details) */
        .disclose summary { list-style: none; cursor: pointer; display: inline-flex; align-items: center; gap: 10px; min-height: 40px; padding: 0 18px; border-radius: 999px; background: var(--paper); font-size: .9rem; font-weight: 600; transition: background .2s, color .2s; }
        .disclose summary::-webkit-details-marker { display: none; }
        .disclose summary:hover { background: var(--ink); color: #fff; }
        .disclose summary i { font-size: .7rem; transition: transform .2s; }
        .disclose[open] summary i { transform: rotate(180deg); }
        .disclose .when-open, .disclose[open] .when-closed { display: none; }
        .disclose[open] .when-open { display: inline; }
        .steps { margin-top: 22px; counter-reset: step; }
        .steps li { position: relative; padding: 2px 0 20px 46px; font-size: .93rem; line-height: 1.55; counter-increment: step; }
        .steps li::before { content: counter(step); position: absolute; left: 0; top: 0; width: 32px; height: 32px; border-radius: 50%; display: grid; place-items: center; background: var(--ink); color: #fff; font-family: var(--font-display); font-weight: 700; font-size: .85rem; }
        .steps li::after { content: ""; position: absolute; left: 15px; top: 36px; bottom: 4px; width: 2px; background: var(--line); }
        .steps li:last-child { padding-bottom: 0; }
        .steps li:last-child::after { display: none; }
        .steps li:last-child::before { background: var(--signal); }

        /* ==========================================================
           FORMULIR
           ========================================================== */
        .form-panel { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); overflow: hidden; }
        .form-bar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px 20px; padding: 18px clamp(18px, 3vw, 32px); border-bottom: 1px solid var(--line); }
        .form-title { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .form-title > i { flex: none; width: 44px; height: 44px; border-radius: 14px; display: grid; place-items: center; background: var(--ink); color: var(--amber); font-size: 1.05rem; }
        .form-title h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.3rem; line-height: 1.2; letter-spacing: -0.015em; }
        .form-title p { font-size: .85rem; color: var(--steel); line-height: 1.4; margin-top: 2px; }
        .form-note { padding: 6px 14px; border-radius: 999px; background: var(--paper); font-size: .85rem; font-weight: 600; color: var(--steel); }

        .form-body { padding: clamp(18px, 3vw, 32px); display: grid; gap: 36px; }
        .alert { display: flex; gap: 12px; align-items: flex-start; padding: 14px 16px; border-radius: 14px; font-size: .92rem; line-height: 1.5; }
        .alert i { margin-top: 3px; }
        .alert.ok { background: #e8f7ee; color: #14532d; border: 1px solid #bce5cb; }
        .alert.err { background: #fdeceb; color: #8f1d15; border: 1px solid #f5c3bf; }
        .alert ul { display: grid; gap: 2px; }

        .fs { border: 0; min-width: 0; }
        .fs legend { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; padding: 0; width: 100%; font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.15rem; letter-spacing: -0.01em; }
        .fs legend::after { content: ""; flex: 1; height: 1px; background: var(--line); }
        .fs legend i { width: 34px; height: 34px; border-radius: 10px; display: grid; place-items: center; background: #fdeceb; color: var(--signal-d); font-size: .85rem; }

        .fields { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px 20px; }
        .field { min-width: 0; }
        .field.full { grid-column: 1 / -1; }
        .field.third { grid-column: span 1; }
        @media (max-width: 640px) { .fields { grid-template-columns: minmax(0, 1fr); } }

        .label { display: block; margin-bottom: 8px; font-size: .9rem; font-weight: 600; line-height: 1.35; }
        .req { color: var(--signal-d); margin-left: 2px; }
        .hint { margin-top: 6px; font-size: .8rem; color: var(--steel); line-height: 1.4; }

        .input {
            display: block; width: 100%; height: 48px; padding: 0 16px;
            border: 1px solid var(--line); border-radius: 14px; background: #fff;
            font: inherit; font-size: .95rem; color: var(--ink);
            transition: border-color .2s, box-shadow .2s;
        }
        .input::placeholder { color: #93a1b1; }
        .input:hover { border-color: #b8c3d0; }
        .input:focus { outline: none; border-color: var(--ink); box-shadow: 0 0 0 3px rgba(255,182,39,.5); }
        .input:user-invalid { border-color: var(--signal); }
        select.input {
            appearance: none; -webkit-appearance: none; padding-right: 42px; cursor: pointer;
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='none' stroke='%235b6c7f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E") no-repeat right 16px center;
        }
        select.input:disabled { background-color: var(--paper); color: var(--steel); cursor: not-allowed; }
        .unit { position: relative; }
        .unit .input { padding-right: 54px; }
        .unit span { position: absolute; right: 16px; top: 50%; transform: translateY(-50%); font-size: .88rem; font-weight: 600; color: var(--steel); pointer-events: none; }

        /* Area unggah berkas */
        .dropzone {
            position: relative; display: grid; justify-items: center; gap: 8px; text-align: center;
            padding: 26px 20px; border: 2px dashed #b8c3d0; border-radius: var(--r-md);
            background: var(--paper); color: var(--steel); font-size: .92rem; line-height: 1.45;
            cursor: pointer; transition: border-color .2s, background .2s;
        }
        .dropzone:hover, .dropzone.is-over { border-color: var(--signal); background: #fdeceb; }
        .dropzone:focus-within { outline: 3px solid var(--amber); outline-offset: 3px; }
        .dropzone.has-files { border-style: solid; border-color: var(--ink); background: #fff; }
        .dropzone input { position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
        .dz-ico { width: 48px; height: 48px; border-radius: 14px; display: grid; place-items: center; background: #fff; border: 1px solid var(--line); color: var(--signal-d); font-size: 1.2rem; }
        .dz-text strong { color: var(--ink); }
        .dz-text u { text-underline-offset: 3px; color: var(--signal-d); font-weight: 600; }
        .dz-files { display: flex; flex-wrap: wrap; justify-content: center; gap: 8px; }
        .dz-files:empty { display: none; }
        .dz-files li { display: inline-flex; align-items: center; gap: 8px; padding: 5px 12px; border-radius: 999px; background: var(--paper); border: 1px solid var(--line); font-size: .82rem; font-weight: 600; color: var(--ink); overflow-wrap: anywhere; }

        .form-actions { display: flex; flex-wrap: wrap; align-items: center; gap: 14px 20px; padding-top: 4px; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 15px 30px; border-radius: 999px; font-weight: 700; font-size: 1rem; transition: background .2s, box-shadow .2s; }
        .btn-primary { background: var(--signal); color: #fff; box-shadow: 0 14px 30px -10px rgba(229,57,45,.6); }
        .btn-primary:hover { background: var(--signal-d); }
        .btn-dark { background: var(--ink); color: #fff; }
        .btn-dark:hover { background: var(--ink-3); }
        .form-actions p { font-size: .88rem; color: var(--steel); }
        @media (max-width: 640px) { .form-actions .btn { width: 100%; } }

        /* ==========================================================
           MODAL PERSYARATAN
           ========================================================== */
        .modal {
            margin: auto; padding: 0; border: 0; border-radius: var(--r-lg);
            width: min(760px, calc(100vw - 24px)); max-height: min(88vh, 820px);
            background: #fff; color: var(--ink); overflow: hidden;
            box-shadow: 0 32px 80px rgba(0,0,0,.5);
        }
        .modal[open] { display: flex; flex-direction: column; animation: pop .25s cubic-bezier(.16,.84,.3,1); }
        .modal::backdrop { background: rgba(13,27,42,.62); -webkit-backdrop-filter: blur(4px); backdrop-filter: blur(4px); }
        @keyframes pop { from { opacity: 0; transform: translateY(16px) scale(.98); } to { opacity: 1; transform: none; } }
        .modal-head { display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 20px clamp(18px, 3vw, 28px); border-bottom: 1px solid var(--line); }
        .modal-head h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.3rem; line-height: 1.2; letter-spacing: -0.015em; }
        .modal-x { flex: none; width: 40px; height: 40px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; }
        .modal-x:hover { background: var(--ink); color: #fff; }
        .modal-body { padding: 22px clamp(18px, 3vw, 28px); overflow-y: auto; font-size: .95rem; line-height: 1.6; }
        .modal-foot { padding: 16px clamp(18px, 3vw, 28px); border-top: 1px solid var(--line); background: var(--paper); }
        .req-list { counter-reset: r; display: grid; gap: 18px; }
        .req-list > li { position: relative; padding-left: 44px; counter-increment: r; }
        .req-list > li::before { content: counter(r); position: absolute; left: 0; top: 0; width: 30px; height: 30px; border-radius: 10px; display: grid; place-items: center; background: #fdeceb; color: var(--signal-d); font-family: var(--font-display); font-weight: 700; font-size: .85rem; }
        .req-list ul { margin-top: 8px; display: grid; gap: 6px; }
        .req-list ul li { position: relative; padding-left: 18px; }
        .req-list ul li::before { content: ""; position: absolute; left: 3px; top: .65em; width: 6px; height: 6px; border-radius: 50%; background: var(--steel); }
        .req-list ul ul { margin-top: 6px; }
        .req-list ul ul li::before { background: transparent; border: 1.5px solid var(--steel); }
        .req-list b { font-weight: 600; }

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
        .social { display: flex; flex-wrap: wrap; gap: 8px; }
        .social a { width: 42px; height: 42px; border-radius: 12px; display: grid; place-items: center; background: rgba(255,255,255,.08); color: #fff; transition: background .2s, transform .2s; }
        .social a:hover { background: var(--signal); transform: translateY(-3px); }
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
                    <li><a href="/sotk">SOTK</a></li>
                    <li><a href="/perencanaan">Perencanaan</a></li>
                    <li><a href="/pelaporan">Pelaporan</a></li>
                    <li><a href="/sop">SOP</a></li>
                    <li><a href="/produkhukum">Produk hukum</a></li>
                </ul>
            </li>
            <li class="has-drop current">
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan &amp; fasilitas <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/layanan-fasilitas/layanan_perizinan" aria-current="page">Layanan perizinan</a></li>
                    <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Edukasi dan sosialisasi</a></li>
                    <li><a href="/informasi-layanan">Informasi layanan</a></li>
                </ul>
            </li>
            <li><a class="menu-link" href="/redkar">Redkar</a></li>
            
            <!-- LOGIKA TOMBOL MASUK DAN KELUAR -->
            @if(session()->has('pemohon_id'))
                <li class="has-drop">
                    <button class="menu-trigger btn-login" type="button" aria-expanded="false">
                        <!-- strtok digunakan agar yg tampil hanya nama panggilan (kata pertama) -->
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
                <li><a href="/layanan-fasilitas/layanan_perizinan">Layanan perizinan</a></li>
                <li><span aria-current="page"><?= $h($layanan[$tab_aktif]['label']) ?></span></li>
            </ol>
        </nav>
        <h1 class="rise d1">Layanan perizinan</h1>
        <p class="rise d2">Ajukan rekomendasi proteksi kebakaran, sertifikat keamanan kebakaran, dan perpanjangannya secara daring ke Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
    </div>
</section>

<div class="page-body">
    <!-- Tab layanan -->
    <div class="wrap tabs-wrap">
        <nav class="tabs" aria-label="Jenis layanan perizinan">
            <?php foreach ($layanan as $key => $l): ?>
                <a class="tab" href="<?= $h($l['url']) ?>" title="<?= $h($l['ket']) ?>" <?php if ($key === $tab_aktif): ?> aria-current="page" <?php endif; ?>>
                    <i class="fas <?= $h($l['ico']) ?>"></i> <?= $h($l['label']) ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>

    <div class="wrap">

        <!-- Ringkasan -->
        <div class="facts">
            <div class="fact">
                <span class="c-ico"><i class="fas fa-clock"></i></span>
                <div>
                    <small>Waktu penyelesaian</small>
                    <strong>14 hari kerja</strong>
                </div>
            </div>
            <div class="fact">
                <span class="c-ico"><i class="fas fa-file-circle-check"></i></span>
                <div>
                    <small>Produk layanan</small>
                    <strong>Rekomendasi Kebakaran Bangunan Gedung dan Lingkungan</strong>
                </div>
            </div>
            <div class="fact">
                <span class="c-ico"><i class="fab fa-whatsapp"></i></span>
                <div>
                    <small>Pengaduan layanan</small>
                    <a href="https://wa.me/<?= $h($no_whatsapp) ?>" target="_blank" rel="noopener">WhatsApp +62 8117113113</a>
                </div>
            </div>
        </div>

        <div class="perizinan-layout">

            <!-- Informasi -->
            <aside class="info-stack" aria-label="Informasi layanan">
                <a class="jump" href="#formulir"><i class="fas fa-arrow-down"></i> Langsung ke formulir</a>

                <section class="side-card">
                    <div class="card-head">
                        <span class="c-ico"><i class="fas fa-scale-balanced"></i></span>
                        <h2>Dasar hukum</h2>
                    </div>
                    <ul class="law-list">
                        <li>UU No 28 Thn 2002</li>
                        <li>Permen Tenaga Kerja dan Transmigrasi No Per.04/MEN/1980</li>
                        <li>Permen PU No 26/PRT/M/2007</li>
                        <li>Permen PU No 20/PRT/M/2009</li>
                        <li>Permendagri No 114 Thn 2018</li>
                    </ul>
                    <a class="card-link" href="/produkhukum"><i class="fas fa-file-pdf"></i> Lihat produk hukum</a>
                </section>

                <section class="side-card">
                    <div class="card-head">
                        <span class="c-ico"><i class="fas fa-clipboard-check"></i></span>
                        <h2>Persyaratan</h2>
                    </div>
                    <ol class="checklist">
                        <li>
                            <span class="ck-ico"><i class="fas fa-pen-to-square"></i></span>
                            <div>Isi formulir rekomendasi proteksi kebakaran secara elektronik melalui <strong>simerah.jambikota.go.id</strong></div>
                        </li>
                        <li>
                            <span class="ck-ico"><i class="fas fa-file-signature"></i></span>
                            <div>
                                Unggah surat permohonan bermaterai
                                <?php if ($url_surat_permohonan): ?>
                                    <br><a class="inline" href="<?= $h($url_surat_permohonan) ?>" download>Unduh surat permohonan</a>
                                <?php else: ?>
                                    <br><span class="muted">Templat surat permohonan belum tersedia</span>
                                <?php endif; ?>
                            </div>
                        </li>
                        <li>
                            <span class="ck-ico"><i class="fas fa-folder-open"></i></span>
                            <div>
                                Unggah detail persyaratan RPKBGL lainnya
                                <br><button type="button" class="tool" data-open-modal><i class="fas fa-list-ul"></i> Lihat detail</button>
                            </div>
                        </li>
                    </ol>
                </section>

                <section class="side-card">
                    <div class="card-head">
                        <span class="c-ico"><i class="fas fa-route"></i></span>
                        <h2>Sistem, mekanisme, dan prosedur</h2>
                    </div>
                    <details class="disclose">
                        <summary>
                            <span class="when-closed">Tampilkan detail</span><span class="when-open">Sembunyikan detail</span>
                            <i class="fas fa-chevron-down"></i>
                        </summary>
                        <ol class="steps">
                            <li>Pemohon mendaftar secara daring, lalu mengunggah kelengkapan berkas yang dipersyaratkan</li>
                            <li>Tim Inspeksi memeriksa proteksi aktif kebakaran gedung pemohon</li>
                            <li>Tim Inspeksi merekomendasikan kepada Kepala Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi untuk menerima atau menolak permohonan, berdasarkan hasil inspeksi lapangan (memenuhi syarat atau tidak memenuhi syarat)</li>
                            <li>Kepala Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi memberikan jawaban berdasarkan hasil rekomendasi Tim Inspeksi</li>
                            <li>Sistem mengirim notifikasi lewat WhatsApp dari Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi</li>
                        </ol>
                    </details>
                </section>
            </aside>

            <!-- Formulir -->
            <section class="form-panel" id="formulir" aria-label="Formulir permohonan">
                <div class="form-bar">
                    <div class="form-title">
                        <i class="fas fa-file-pen"></i>
                        <div>
                            <h2>Formulir RPKBGL</h2>
                            <p>Rekomendasi Proteksi Kebakaran Bangunan Gedung &amp; Lingkungan</p>
                        </div>
                    </div>
                    <span class="form-note"><span class="req" aria-hidden="true">*</span> wajib diisi</span>
                </div>

                <?php /* Jika memakai Laravel: ganti action="#" dengan route tujuan dan tambahkan csrf_field() di dalam form. */ ?>
                <form class="form-body" action="#" method="POST" enctype="multipart/form-data">

                    <?php if ($pesan_sukses): ?>
                        <div class="alert ok" role="status"><i class="fas fa-circle-check"></i><div><?= $h($pesan_sukses) ?></div></div>
                    <?php endif; ?>
                    <?php if ($galat): ?>
                        <div class="alert err" role="alert">
                            <i class="fas fa-circle-exclamation"></i>
                            <div>
                                Permohonan belum terkirim. Periksa isian berikut:
                                <ul>
                                    <?php foreach ((array) $galat as $g): ?><li><?= $h($g) ?></li><?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>

                    <fieldset class="fs">
                        <legend><i class="fas fa-user"></i> Data pemohon</legend>
                        <div class="fields">
                            <div class="field full">
                                <label class="label" for="nama_pemohon">Nama pemohon <span class="req" aria-hidden="true">*</span></label>
                                <input class="input" type="text" id="nama_pemohon" name="nama_pemohon" value="<?= $val('nama_pemohon') ?>" autocomplete="name" required>
                            </div>
                            <div class="field">
                                <label class="label" for="email_pemohon">Email pemohon <span class="req" aria-hidden="true">*</span></label>
                                <input class="input" type="email" id="email_pemohon" name="email_pemohon" value="<?= $val('email_pemohon') ?>" autocomplete="email" required>
                            </div>
                            <div class="field">
                                <label class="label" for="no_wa">Nomor WhatsApp <span class="req" aria-hidden="true">*</span></label>
                                <input class="input" type="tel" id="no_wa" name="no_wa" value="<?= $val('no_wa') ?>" inputmode="tel" autocomplete="tel" placeholder="08xxxxxxxxxx" required aria-describedby="hint-wa">
                                <p class="hint" id="hint-wa">Notifikasi status permohonan dikirim ke nomor ini.</p>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="fs">
                        <legend><i class="fas fa-briefcase"></i> Data usaha</legend>
                        <div class="fields">
                            <div class="field full">
                                <label class="label" for="nama_usaha">Nama usaha <span class="req" aria-hidden="true">*</span></label>
                                <input class="input" type="text" id="nama_usaha" name="nama_usaha" value="<?= $val('nama_usaha') ?>" autocomplete="organization" required aria-describedby="hint-usaha">
                                <p class="hint" id="hint-usaha">PT, CV, UD, lembaga, toko, instansi, atau lainnya.</p>
                            </div>
                            <div class="field">
                                <label class="label" for="nik">NIK pemilik usaha <span class="req" aria-hidden="true">*</span></label>
                                <input class="input" type="text" id="nik" name="nik" value="<?= $val('nik') ?>" inputmode="numeric" pattern="[0-9]{16}" maxlength="16" placeholder="16 digit" required>
                            </div>
                            <div class="field">
                                <label class="label" for="alamat_pemilik">Alamat pemilik usaha <span class="req" aria-hidden="true">*</span></label>
                                <input class="input" type="text" id="alamat_pemilik" name="alamat_pemilik" value="<?= $val('alamat_pemilik') ?>" autocomplete="street-address" required>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="fs">
                        <legend><i class="fas fa-building"></i> Data bangunan</legend>
                        <div class="fields">
                            <div class="field">
                                <label class="label" for="kategori">Kategori bangunan <span class="req" aria-hidden="true">*</span></label>
                                <select class="input" id="kategori" name="kategori" required>
                                    <option value="">Pilih kategori bangunan</option>
                                    <?php foreach ($kategori_list as $kv => $kn): ?>
                                        <option value="<?= $h($kv) ?>" <?= (($old['kategori'] ?? '') == $kv) ? 'selected' : '' ?>><?= $h($kn) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="field">
                                <label class="label" for="alamat_bangunan">Alamat bangunan <span class="req" aria-hidden="true">*</span></label>
                                <input class="input" type="text" id="alamat_bangunan" name="alamat_bangunan" value="<?= $val('alamat_bangunan') ?>" required>
                            </div>
                            <div class="field">
                                <label class="label" for="kecamatan">Kecamatan <?php if ($kecamatan_list): ?><span class="req" aria-hidden="true">*</span><?php endif; ?></label>
                                <select class="input" id="kecamatan" name="kecamatan" <?= $kecamatan_list ? 'required' : '' ?>>
                                    <option value="">Pilih kecamatan</option>
                                    <?php foreach ($kecamatan_list as $kc): $kc = $to_arr($kc); ?>
                                        <option value="<?= $h($kc['id'] ?? '') ?>" <?= (($old['kecamatan'] ?? '') == ($kc['id'] ?? null)) ? 'selected' : '' ?>><?= $h($kc['nama'] ?? '') ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="field">
                                <label class="label" for="kelurahan">Kelurahan <?php if ($kelurahan_list): ?><span class="req" aria-hidden="true">*</span><?php endif; ?></label>
                                <select class="input" id="kelurahan" name="kelurahan" data-selected="<?= $val('kelurahan') ?>" <?= $kelurahan_list ? 'required' : '' ?>>
                                    <option value="">Pilih kelurahan</option>
                                    <?php foreach ($kelurahan_list as $kl): $kl = $to_arr($kl); ?>
                                        <option value="<?= $h($kl['id'] ?? '') ?>" data-kec="<?= $h($kl['kecamatan_id'] ?? '') ?>"><?= $h($kl['nama'] ?? '') ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="field">
                                <label class="label" for="luas_lahan">Luas lahan <span class="req" aria-hidden="true">*</span></label>
                                <div class="unit">
                                    <input class="input" type="number" id="luas_lahan" name="luas_lahan" value="<?= $val('luas_lahan') ?>" min="0" step="any" inputmode="decimal" required>
                                    <span aria-hidden="true">m&sup2;</span>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="luas_bangunan">Luas bangunan <span class="req" aria-hidden="true">*</span></label>
                                <div class="unit">
                                    <input class="input" type="number" id="luas_bangunan" name="luas_bangunan" value="<?= $val('luas_bangunan') ?>" min="0" step="any" inputmode="decimal" required>
                                    <span aria-hidden="true">m&sup2;</span>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="tinggi_bangunan">Tinggi bangunan <span class="req" aria-hidden="true">*</span></label>
                                <div class="unit">
                                    <input class="input" type="number" id="tinggi_bangunan" name="tinggi_bangunan" value="<?= $val('tinggi_bangunan') ?>" min="0" step="any" inputmode="decimal" required>
                                    <span aria-hidden="true">m</span>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="fs">
                        <legend><i class="fas fa-paperclip"></i> Berkas</legend>
                        <div class="fields">
                            <div class="field full">
                                <span class="label" id="lbl-surat">Surat permohonan bermaterai <span class="req" aria-hidden="true">*</span></span>
                                <label class="dropzone" data-dropzone>
                                    <input type="file" name="surat_permohonan" accept=".pdf,.jpg,.jpeg,.png" required aria-labelledby="lbl-surat">
                                    <span class="dz-ico"><i class="fas fa-cloud-arrow-up"></i></span>
                                    <span class="dz-text"><strong>Tarik berkas ke sini</strong> atau <u>pilih dari perangkat</u></span>
                                    <ul class="dz-files" aria-live="polite"></ul>
                                </label>
                            </div>
                            <div class="field full">
                                <span class="label" id="lbl-lain">Persyaratan lainnya <span class="req" aria-hidden="true">*</span></span>
                                <label class="dropzone" data-dropzone>
                                    <input type="file" name="persyaratan_lainnya[]" accept=".pdf,.jpg,.jpeg,.png" multiple required aria-labelledby="lbl-lain" aria-describedby="hint-lain">
                                    <span class="dz-ico"><i class="fas fa-cloud-arrow-up"></i></span>
                                    <span class="dz-text"><strong>Tarik beberapa berkas ke sini</strong> atau <u>pilih dari perangkat</u></span>
                                    <ul class="dz-files" aria-live="polite"></ul>
                                </label>
                                <p class="hint" id="hint-lain">Daftar berkas yang diminta ada di <button type="button" class="card-link" style="margin:0;display:inline" data-open-modal>detail persyaratan</button>.</p>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Kirim permohonan</button>
                        <p>Permohonan diproses dalam 14 hari kerja.</p>
                    </div>
                </form>
            </section>

        </div>
    </div>
</div>

</main>

<!-- ==================== MODAL PERSYARATAN ==================== -->
<dialog class="modal" id="modalPersyaratan" aria-labelledby="modalTitle">
    <div class="modal-head">
        <h2 id="modalTitle">Detail persyaratan RPKBGL lainnya</h2>
        <button type="button" class="modal-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
    </div>
    <div class="modal-body">
        <ol class="req-list">
            <li>Menginput Formulir Rekomendasi Proteksi Kebakaran Bangunan Gedung dan Lingkungan (RPKBGL) secara elektronik melalui simerah.jambikota.go.id</li>
            <li>
                <b>Identitas pemohon/penanggung jawab</b>
                <ul>
                    <li>WNI: scan asli Kartu Tanda Penduduk (KTP-el)</li>
                    <li>WNA: scan asli Kartu Izin Tinggal Terbatas (KITAS), visa, atau paspor</li>
                </ul>
            </li>
            <li>Jika dikuasakan: scan asli surat kuasa di atas kertas bermaterai sesuai peraturan yang berlaku, dan KTP-el orang yang diberi kuasa</li>
            <li>
                <b>Data usaha (scan asli)</b>
                <ul>
                    <li>Usaha perorangan: NPWP perorangan</li>
                    <li>
                        Badan usaha:
                        <ul>
                            <li>Akta pendirian dan perubahan (kantor pusat dan kantor cabang, jika ada)</li>
                            <li>SK pengesahan pendirian dan perubahan yang dikeluarkan oleh Kemenkumham</li>
                            <li>NPWP badan usaha</li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>Scan asli Izin Mendirikan Bangunan (IMB)</li>
            <li>Tanda Daftar Keahlian Keselamatan Kebakaran</li>
            <li>
                <b>Proposal teknis (scan asli), dilengkapi dengan:</b>
                <ul>
                    <li>
                        Gambar teknis yang ditandatangani oleh Izin Pelaku Teknis Bangunan (IPTB):
                        <ul>
                            <li>As built drawing site plan</li>
                            <li>As built drawing denah setiap lantai sarana proteksi kebakaran dalam gedung, meliputi titik fire alarm, titik sprinkler, titik hidran gedung, dan titik APAR</li>
                            <li>Gambar skematik instalasi proteksi kebakaran (single line diagram)</li>
                        </ul>
                    </li>
                    <li>
                        Spesifikasi teknis:
                        <ul>
                            <li>
                                Spesifikasi peralatan dan instalasi sistem proteksi kebakaran:
                                <ul>
                                    <li>Sistem alarm dan komunikasi darurat</li>
                                    <li>Sistem hidran dan pipa kebakaran</li>
                                    <li>Sistem pompa kebakaran</li>
                                    <li>Sistem sprinkler otomatis</li>
                                    <li>Alat Pemadam Api Ringan (APAR)</li>
                                </ul>
                            </li>
                            <li>Spesifikasi fasilitas sarana jalan keluar atau jalur penyelamatan</li>
                            <li>Spesifikasi akses penanggulangan kebakaran dan penyelamatan</li>
                        </ul>
                    </li>
                    <li>Dokumen penyelenggaraan sistem Manajemen Keselamatan Kebakaran Gedung (MKKG) / SOP</li>
                    <li>Data inventaris pengelolaan dan pemeliharaan Alat Pemadam Api Ringan (APAR)</li>
                    <li>Dokumen pemeliharaan dan laporan pemeriksaan internal sistem proteksi kebakaran oleh pemilik dan pengelola gedung yang memiliki tanda daftar keahlian keselamatan kebakaran</li>
                </ul>
            </li>
        </ol>
    </div>
    <div class="modal-foot">
        <button type="button" class="btn btn-dark" data-close>Tutup</button>
    </div>
</dialog>

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

    /* ---------- Modal persyaratan ---------- */
    var dlg = document.getElementById('modalPersyaratan');

    function openDlg() { if (dlg.showModal) dlg.showModal(); else dlg.setAttribute('open', ''); }
    function closeDlg() { if (dlg.close) dlg.close(); else dlg.removeAttribute('open'); }

    document.querySelectorAll('[data-open-modal]').forEach(function (b) {
        b.addEventListener('click', openDlg);
    });
    dlg.addEventListener('click', function (e) {
        // klik di area gelap (backdrop) atau tombol tutup
        if (e.target === dlg || e.target.closest('[data-close]')) closeDlg();
    });

    /* ---------- Kelurahan mengikuti kecamatan ---------- */
    var kec = document.getElementById('kecamatan');
    var kel = document.getElementById('kelurahan');
    var kelAll = Array.prototype.slice.call(kel.options, 1);

    function syncKelurahan(keep) {
        while (kel.options.length > 1) kel.remove(1);
        kelAll.filter(function (o) { return o.getAttribute('data-kec') === kec.value; })
              .forEach(function (o) { kel.add(o); });
        kel.disabled = !kec.value;
        kel.value = keep || '';
    }
    kec.addEventListener('change', function () { syncKelurahan(''); });
    syncKelurahan(kel.getAttribute('data-selected'));

    /* ---------- Area unggah berkas ---------- */
    function fmtSize(b) {
        return b < 1048576 ? Math.max(1, Math.round(b / 1024)) + ' KB' : (b / 1048576).toFixed(1) + ' MB';
    }

    document.querySelectorAll('[data-dropzone]').forEach(function (dz) {
        var input = dz.querySelector('input[type="file"]');
        var list = dz.querySelector('.dz-files');

        ['dragenter', 'dragover'].forEach(function (t) {
            dz.addEventListener(t, function () { dz.classList.add('is-over'); });
        });
        ['dragleave', 'drop'].forEach(function (t) {
            dz.addEventListener(t, function () { dz.classList.remove('is-over'); });
        });

        input.addEventListener('change', function () {
            list.textContent = '';
            Array.prototype.forEach.call(input.files, function (f) {
                var li = document.createElement('li');
                li.textContent = f.name + ' (' + fmtSize(f.size) + ')';
                list.appendChild(li);
            });
            dz.classList.toggle('has-files', input.files.length > 0);
        });
    });
})();
</script>
</body>
</html>
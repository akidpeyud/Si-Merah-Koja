@php
    $h = function ($v) { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); };

    /* ------------------------------------------------------------
       PENGATURAN HALAMAN
       ------------------------------------------------------------ */
    $layanan = [
        'rpkbgl'    => ['url' => '/layanan-fasilitas/layanan_perizinan', 'label' => 'RPKBGL', 'ico' => 'fa-building', 'ket' => 'Layanan perizinan Rekomendasi Proteksi Kebakaran Bangunan Gedung dan Lingkungan'],
        'skk'       => ['url' => '/layanan-fasilitas/skk',                'label' => 'SKK (Baru & Perpanjangan)', 'ico' => 'fa-user-shield', 'ket' => 'Layanan perizinan penerbitan & perpanjangan Sertifikat Keamanan Kebakaran'],
        'keramaian' => ['url' => '/layanan-fasilitas/izin-keramaian',     'label' => 'Izin Keramaian', 'ico' => 'fa-users', 'ket' => 'Pengajuan Rekomendasi Izin Keramaian'],
        'edukasi'   => ['url' => '/layanan-fasilitas/edukasi_sosialisasi', 'label' => 'Edukasi & Sosialisasi', 'ico' => 'fa-bullhorn', 'ket' => 'Pengajuan Kunjungan Edukasi & Sosialisasi'],
    ];
    $tab_aktif = 'skk';

    // URL Surat Permohonan SKK
    $url_surat_permohonan = asset('dokumen/FORMULIR-2.docx');

    // Data wilayah Kota Jambi
    $dataWilayah = [
        'Alam Barajo'   => ['Bagan Pete', 'Beliung', 'Kenali Besar', 'Mayang Mangurai', 'Pinang Merah', 'Rawa Sari', 'Simpang Rimbo'],
        'Danau Sipin'   => ['Legok', 'Murni', 'Selamat', 'Solok Sipin', 'Sungai Putri'],
        'Danau Teluk'   => ['Olak Kemang', 'Pasir Panjang', 'Tanjung Pasir', 'Tanjung Raden', 'Ulu Gedong'],
        'Jambi Selatan' => ['Pakuan Baru', 'Pasir Putih', 'Tambak Sari', 'The Hok', 'Wijaya Pura'],
        'Jambi Timur'   => ['Budiman', 'Kasang', 'Kasang Jaya', 'Rajawali', 'Sejinjang', 'Sulanjana', 'Talang Banjar', 'Tanjung Pinang', 'Tanjung Sari'],
        'Jelutung'      => ['Cempaka Putih', 'Handil Jaya', 'Jelutung', 'Kebun Handil', 'Lebak Bandung', 'Payo Lebar', 'Talang Jauh'],
        'Kota Baru'     => ['Kenali Asam', 'Kenali Asam Atas', 'Kenali Asam Bawah', 'Paal Lima', 'Simpang Tiga Sipin', 'Sukakarya', 'Talang Gulo'],
        'Paal Merah'    => ['Bakung Jaya', 'Eka Jaya', 'Lingkar Selatan', 'Paal Merah', 'Payo Selincah', 'Talang Bakung'],
        'Pasar Jambi'   => ['Beringin', 'Orang Kayo Hitam', 'Pasar Jambi', 'Sungai Asam'],
        'Pelayangan'    => ['Arab Melayu', 'Jelmu', 'Mudung Laut', 'Tahtul Yaman', 'Tanjung Johor', 'Tengah'],
        'Telanaipura'   => ['Aur Kenali', 'Buluran Kenali', 'Pematang Sulur', 'Penyengat Rendah', 'Simpang Empat Sipin', 'Telanaipura', 'Teluk Kenali'],
    ];
    $kategori_list = ['Rumah Tinggal', 'Komersial (Mall/Toko)', 'Fasilitas Layanan Kesehatan', 'Perkantoran', 'Hotel / Penginapan', 'Pabrik / Gudang', 'Pendidikan', 'Fasilitas Umum Lainnya'];

    $oldKec = old('kecamatan');
    $oldKel = old('kelurahan');
    $oldJenis = old('jenis_permohonan');

    $inv = function ($n) use ($errors) { return $errors->has($n) ? ' is-invalid' : ''; };
    $fe  = function ($n) use ($errors) {
        return $errors->has($n)
            ? '<p class="field-err"><i class="fas fa-circle-exclamation"></i> ' . e($errors->first($n)) . '</p>'
            : '';
    };

    $no_whatsapp    = "628117113113";
    $no_telepon     = "074141171";
    $telepon_tampil = "(0741) 41171";
    $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)%0A%0AMohon%20Isi%20Laporan%20Pengaduan%3A%20%0A%0ANama%20Pelapor%20%20%20%3A%0ANo.%20HP%20Pelapor%20%3A%0AAlamat%20Pelapor%20%3A%0AJenis%20Laporan%20%20%20%3A%20%20(Kebakaran%2FEvakuasi)%0A%0AAlamat%20Kejadian%20%3A%0A%0AKirim%20Peta%20Lokasi%20kejadian%20(Google%20Maps)%20%3A%0A%0AKirim%20Foto%20%26%20Video%20Kejadian%20%3A%0A%0ALaporan%20akan%20segera%20kami%20tindaklanjuti%20%F0%9F%9A%92%F0%9F%9A%92%F0%9F%9A%92%0ASalam%20YUDHA%20BRAMA%20JAYA%20Dinas%20Pemadam%20Kebakaran%20%26%20Penyelamatan%20Kota%20Jambi.";
    $wa_link   = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
    $maps_link = "https://www.google.com/maps/place/6PC59JJ2%2BQ76/@-1.6180875,103.6006406,871m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-1.6180875!4d103.6006406?entry=ttu&g_ep=EgoyMDI2MDkxNi4wIKXMDSoASAFQAw%3D%3D";

    $play_store_url = "";
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <meta name="description" content="Ajukan dan perpanjang Sertifikat Keamanan Kebakaran (SKK) secara daring di Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.">
    <title>SKK - Layanan perizinan | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ==========================================================
           TOKENS & BASE
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
            --wrap: 1300px;
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

        /* ==========================================================
           HEADER & NAVBAR (Sesuai Index)
           ========================================================== */
        .site-header {
            position: sticky; top: 0; z-index: 60;
            background: rgba(13, 27, 42, .88);
            -webkit-backdrop-filter: blur(14px) saturate(1.4);
            backdrop-filter: blur(14px) saturate(1.4);
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .nav {
            max-width: 1440px; margin: 0 auto; min-height: var(--header-h);
            padding: 0 clamp(16px, 3vw, 32px);
            display: flex; align-items: center; justify-content: space-between; gap: 24px;
        }

        .brand { display: flex; align-items: center; flex: none; }
        .brand a { display: flex; align-items: center; }
        .brand a + a { margin-left: 14px; padding-left: 14px; border-left: 1px solid rgba(255,255,255,.16); }
        .brand img { height: 36px; width: auto; }

        .nav-panel { flex: 1; min-width: 0; display: flex; align-items: center; justify-content: space-between; gap: 20px; }

        .menu { display: flex; align-items: center; justify-content: center; gap: 2px; flex: 1; min-width: 0; }
        .menu > li { position: relative; }

        .menu-link, .menu-trigger {
            position: relative; display: inline-flex; align-items: center; gap: 6px;
            padding: 10px 11px; color: rgba(255,255,255,.78);
            font-size: .875rem; font-weight: 500; letter-spacing: .005em; white-space: nowrap;
            transition: color .2s;
        }
        .menu-link::after, .menu-trigger::after {
            content: ""; position: absolute; left: 11px; right: 11px; bottom: 2px; height: 2px;
            border-radius: 2px; background: var(--amber);
            transform: scaleX(0); transform-origin: left; transition: transform .25s ease;
        }
        .menu-link:hover, .menu-trigger:hover, .has-drop.open > .menu-trigger, .menu-link.is-active { color: #fff; }
        .menu-link:hover::after, .menu-trigger:hover::after, .has-drop.open > .menu-trigger::after, .menu-link.is-active::after { transform: scaleX(1); }

        .menu-trigger i { font-size: .6rem; opacity: .6; transition: transform .2s, opacity .2s; }
        .has-drop.open > .menu-trigger i { transform: rotate(180deg); opacity: 1; }

        .nav-actions { display: flex; align-items: center; gap: 10px; flex: none; }
        .nav-actions > li { position: relative; }

        .btn-nav {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            height: 40px; padding: 0 16px; border-radius: 999px;
            font-size: .875rem; font-weight: 600; white-space: nowrap;
            transition: background .2s, border-color .2s, color .2s, transform .2s;
        }
        .btn-nav:active { transform: scale(.97); }
        .btn-nav i.fa-chevron-down { font-size: .6rem; opacity: .8; transition: transform .2s; }
        .has-drop.open > .btn-nav i.fa-chevron-down { transform: rotate(180deg); }

        .btn-nav--alert { background: var(--signal); color: #fff; }
        .btn-nav--alert:hover, .has-drop.open > .btn-nav--alert { background: var(--signal-d); }
        .btn-nav--alert .beacon { width: 8px; height: 8px; background: #fff; }
        .btn-nav--alert .beacon::after { background: #fff; }

        .btn-nav--ghost { border: 1.5px solid rgba(255,255,255,.3); color: #fff; }
        .btn-nav--ghost:hover, .has-drop.open > .btn-nav--ghost { border-color: #fff; background: rgba(255,255,255,.08); }

        .dropdown {
            position: absolute; top: calc(100% + 14px); left: 50%; min-width: 250px; width: max-content; max-width: 320px;
            background: var(--ink-2); border: 1px solid rgba(255,255,255,.1);
            border-radius: 16px; padding: 8px; box-shadow: 0 24px 48px rgba(0,0,0,.45);
            visibility: hidden; opacity: 0; pointer-events: none;
            transform: translate(-50%, 6px);
            transition: opacity .18s ease, transform .18s ease, visibility 0s linear .18s;
        }
        .nav-actions .dropdown { left: auto; right: 0; transform: translate(0, 6px); }
        .dropdown::before { content: ""; position: absolute; left: 0; right: 0; top: -14px; height: 14px; }
        .dropdown::after {
            content: ""; position: absolute; top: -6px; left: 50%; width: 10px; height: 10px; margin-left: -5px;
            background: var(--ink-2); border-top: 1px solid rgba(255,255,255,.1); border-left: 1px solid rgba(255,255,255,.1);
            transform: rotate(45deg);
        }
        .nav-actions .dropdown::after { left: auto; right: 24px; margin-left: 0; }

        .has-drop.open > .dropdown {
            visibility: visible; opacity: 1; pointer-events: auto;
            transform: translate(-50%, 0); transition-delay: 0s;
        }
        .nav-actions .has-drop.open > .dropdown { transform: translate(0, 0); }

        .dropdown a, .dropdown .btn-logout {
            display: flex; align-items: center; gap: 12px; width: 100%;
            padding: 10px 14px; border-radius: var(--r-sm);
            font-size: .9rem; line-height: 1.4; color: rgba(255,255,255,.85); text-align: left; white-space: normal;
            transition: background .15s, color .15s;
        }
        .dropdown a:hover, .dropdown a[aria-current="page"] { background: rgba(255,255,255,.08); color: #fff; }
        .dropdown a i { width: 18px; text-align: center; font-size: 1rem; flex: none; }
        .dropdown a .fa-phone-alt { color: #38bdf8; }
        .dropdown a .fa-whatsapp  { color: #25d366; }
        .dropdown a .fa-headset   { color: #f87171; }
        .dropdown .btn-logout { color: #ff8b8b; cursor: pointer; }
        .dropdown .btn-logout:hover { background: rgba(255,255,255,.08); color: #ffb8b8; }

        .has-sub { position: relative; }
        .has-sub > .sub-trigger {
            width: 100%; display: flex; align-items: center; justify-content: space-between; gap: 10px;
            padding: 10px 14px; border-radius: var(--r-sm); font-size: .9rem; line-height: 1.4; text-align: left;
            color: rgba(255,255,255,.85); transition: background .15s, color .15s;
        }
        .has-sub > .sub-trigger i { font-size: .65rem; opacity: .7; transition: transform .2s; }
        .has-sub > .sub-trigger:hover, .has-sub.open > .sub-trigger { background: rgba(255,255,255,.08); color: #fff; }

        .dropdown-sub {
            display: none; position: absolute; top: -8px; left: 100%; min-width: 230px; margin-left: 6px; z-index: 10;
            background: var(--ink-2); border: 1px solid rgba(255,255,255,.1);
            border-radius: 16px; padding: 8px; box-shadow: 0 24px 48px rgba(0,0,0,.45);
        }
        .dropdown-sub::before { content: ""; position: absolute; top: 0; bottom: 0; left: -12px; width: 12px; }
        .has-sub.open > .dropdown-sub { display: block; }

        .nav-toggle { display: none; width: 44px; height: 44px; border-radius: 12px; color: #fff; font-size: 1.15rem; align-items: center; justify-content: center; }
        .nav-toggle:hover { background: rgba(255,255,255,.1); }

        @media (hover: hover) and (min-width: 1201px) {
            .has-drop:hover > .dropdown { visibility: visible; opacity: 1; pointer-events: auto; transform: translate(-50%, 0); transition-delay: 0s; }
            .nav-actions .has-drop:hover > .dropdown { transform: translate(0, 0); }
            .has-drop:hover > .menu-trigger { color: #fff; }
            .has-drop:hover > .menu-trigger::after { transform: scaleX(1); }
            .has-sub:hover > .dropdown-sub { display: block; }
            .has-sub:hover > .sub-trigger { background: rgba(255,255,255,.08); color: #fff; }

            .dropdown-sub { left: auto; right: 100%; margin-left: 0; margin-right: 6px; }
            .dropdown-sub::before { left: auto; right: -12px; }
            .has-sub > .sub-trigger i { transform: rotate(180deg); }
        }

        @media (max-width: 1200px) {
            .nav { gap: 12px; }
            .nav-toggle { display: inline-flex; margin-left: auto; }

            .nav-panel {
                display: none; position: absolute; top: 100%; left: 0; right: 0;
                max-height: calc(100dvh - var(--header-h)); overflow-y: auto; overscroll-behavior: contain;
                flex-direction: column; align-items: stretch; justify-content: flex-start; gap: 20px;
                padding: 8px clamp(16px, 4vw, 32px) 28px;
                background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.1);
                box-shadow: 0 30px 40px rgba(0,0,0,.35);
            }
            .nav-open .nav-panel { display: flex; }

            .menu { flex-direction: column; align-items: stretch; justify-content: flex-start; gap: 0; flex: none; }
            .menu > li { border-bottom: 1px solid rgba(255,255,255,.08); }
            .menu-link, .menu-trigger { width: 100%; justify-content: space-between; padding: 16px 4px; font-size: 1rem; white-space: normal; color: rgba(255,255,255,.9); }
            .menu-link::after, .menu-trigger::after { display: none; }
            .menu-link.is-active { color: var(--amber); }
            .menu-trigger i { font-size: .7rem; }

            .nav-actions { flex-direction: column; align-items: stretch; gap: 10px; }
            .btn-nav { height: 48px; font-size: 1rem; }
            .nav-actions .has-drop > .btn-nav { width: 100%; }

            .dropdown, .nav-actions .dropdown {
                display: none; position: static; min-width: 0; width: auto; max-width: none; margin: 0 0 12px 4px; padding: 0 0 0 12px;
                background: transparent; border: 0; border-left: 2px solid rgba(255,255,255,.14); border-radius: 0; box-shadow: none;
                visibility: visible; opacity: 1; pointer-events: auto; transform: none; transition: none;
            }
            .dropdown::before, .dropdown::after { display: none; }
            .has-drop.open > .dropdown, .nav-actions .has-drop.open > .dropdown { display: block; transform: none; }
            .dropdown a, .dropdown .btn-logout { padding: 13px 12px; font-size: .95rem; }

            .has-sub > .sub-trigger { padding: 13px 12px; font-size: .95rem; }
            .has-sub.open > .sub-trigger i { transform: rotate(90deg); }
            .dropdown-sub { position: static; margin: 2px 0 6px 8px; padding: 0 0 0 10px; min-width: 0; background: transparent; border: 0; border-left: 2px solid rgba(255,255,255,.14); border-radius: 0; box-shadow: none; }
            .dropdown-sub::before { display: none; }
        }

        @media (max-width: 480px) {
            .brand img { height: 30px; }
            .brand a + a { margin-left: 10px; padding-left: 10px; }
        }
        body.nav-lock { overflow: hidden; }

        /* ==========================================================
           HERO HALAMAN
           ========================================================== */
        .page-hero {
            position: relative; isolation: isolate; color: #fff; background: var(--ink); overflow: hidden;
            padding: clamp(36px, 6vw, 72px) 0 clamp(50px, 8vw, 90px);
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
            font-size: clamp(2.5rem, 6vw, 4.5rem); line-height: 1; letter-spacing: -0.035em;
        }
        .page-hero p { margin-top: 18px; max-width: 60ch; color: rgba(255,255,255,.75); font-size: clamp(1rem, 1.5vw, 1.15rem); }

        .rise { animation: rise .8s cubic-bezier(.16,.84,.3,1) both; }
        .rise.d1 { animation-delay: .08s; } .rise.d2 { animation-delay: .18s; }
        @keyframes rise { from { opacity: 0; transform: translateY(28px); } to { opacity: 1; transform: none; } }

        /* BODY LAYOUT */
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

        /* RINGKASAN LAYANAN */
        .c-ico { flex: none; width: 40px; height: 40px; border-radius: 12px; display: grid; place-items: center; background: var(--paper); color: var(--signal-d); font-size: 1rem; }

        .facts { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-top: 28px; }
        .fact { display: flex; align-items: center; gap: 14px; padding: 18px 20px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); }
        .fact .c-ico { width: 46px; height: 46px; background: #fdeceb; font-size: 1.1rem; }
        .fact small { display: block; font-size: .8rem; color: var(--steel); line-height: 1.3; margin-bottom: 2px; }
        .fact strong, .fact a { display: block; font-weight: 600; font-size: .95rem; line-height: 1.4; }
        .fact a:hover { color: var(--signal-d); text-decoration: underline; text-underline-offset: 4px; }

        /* LAYOUT KONTEN */
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
        .text-link { font: inherit; font-weight: 600; color: var(--signal-d); text-decoration: underline; text-underline-offset: 3px; }

        .checklist { display: grid; gap: 18px; }
        .checklist li { display: grid; grid-template-columns: 36px minmax(0, 1fr); gap: 14px; align-items: start; font-size: .93rem; line-height: 1.5; }
        .ck-ico { width: 36px; height: 36px; border-radius: 10px; display: grid; place-items: center; background: #fdeceb; color: var(--signal-d); font-size: .9rem; }
        .checklist .muted { color: var(--steel); }
        .tool { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 38px; margin-top: 8px; padding: 0 16px; border-radius: 999px; background: var(--paper); font-size: .88rem; font-weight: 600; transition: background .2s, color .2s; }
        .tool:hover { background: var(--ink); color: #fff; }

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

        /* FORMULIR */
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
        .alert ul { display: grid; gap: 2px; margin-top: 4px; padding-left: 18px; list-style: disc; }

        .radio-group { display: flex; flex-wrap: wrap; gap: 16px; margin-top: 8px; }
        .radio-card { flex: 1; min-width: 200px; display: flex; align-items: center; gap: 12px; padding: 14px 18px; border: 1px solid var(--line); border-radius: 14px; cursor: pointer; transition: all .2s; }
        .radio-card:hover { border-color: var(--steel); background: var(--paper); }
        .radio-card input[type="radio"] { width: 18px; height: 18px; accent-color: var(--signal); cursor: pointer; }
        .radio-card span { font-weight: 600; font-size: .95rem; color: var(--ink); }
        .radio-card:has(input:checked) { border-color: var(--signal); background: #fdeceb; }

        .fs { border: 0; min-width: 0; }
        .fs legend { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; padding: 0; width: 100%; font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.15rem; letter-spacing: -0.01em; }
        .fs legend::after { content: ""; flex: 1; height: 1px; background: var(--line); }
        .fs legend i { width: 34px; height: 34px; border-radius: 10px; display: grid; place-items: center; background: #fdeceb; color: var(--signal-d); font-size: .85rem; }

        .fields { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px 20px; }
        .fields-4 { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 18px 20px; }
        .field { min-width: 0; }
        .field.full { grid-column: 1 / -1; }
        @media (max-width: 768px) { .fields, .fields-4 { grid-template-columns: minmax(0, 1fr); } }

        .label { display: block; margin-bottom: 8px; font-size: .9rem; font-weight: 600; line-height: 1.35; }
        .req { color: var(--signal-d); margin-left: 2px; }
        .hint { margin-top: 6px; font-size: .8rem; color: var(--steel); line-height: 1.4; }
        .field-err { margin-top: 6px; display: flex; gap: 8px; align-items: flex-start; font-size: .82rem; font-weight: 500; line-height: 1.4; color: var(--signal-d); }
        .field-err i { margin-top: 2px; }
        .field-err:empty { display: none; }

        .input {
            display: block; width: 100%; height: 48px; padding: 0 16px;
            border: 1px solid var(--line); border-radius: 14px; background: #fff;
            font: inherit; font-size: .95rem; color: var(--ink);
            transition: border-color .2s, box-shadow .2s;
        }
        .input::placeholder { color: #93a1b1; }
        .input:hover { border-color: #b8c3d0; }
        .input:focus { outline: none; border-color: var(--ink); box-shadow: 0 0 0 3px rgba(255,182,39,.5); }
        .input:user-invalid, .input.is-invalid { border-color: var(--signal); }
        select.input {
            appearance: none; -webkit-appearance: none; padding-right: 42px; cursor: pointer;
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='none' stroke='%235b6c7f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E") no-repeat right 16px center;
        }
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
        .dropzone.is-invalid { border-color: var(--signal); }
        .dropzone input { position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
        .dz-ico { width: 48px; height: 48px; border-radius: 14px; display: grid; place-items: center; background: #fff; border: 1px solid var(--line); color: var(--signal-d); font-size: 1.2rem; }
        .dz-text strong { color: var(--ink); }
        .dz-text u { text-underline-offset: 3px; color: var(--signal-d); font-weight: 600; }
        .dz-files { display: flex; flex-wrap: wrap; justify-content: center; gap: 8px; }
        .dz-files:empty { display: none; }
        .dz-files li { display: inline-flex; align-items: center; gap: 8px; padding: 5px 12px; border-radius: 999px; background: var(--paper); border: 1px solid var(--line); font-size: .82rem; font-weight: 600; color: var(--ink); overflow-wrap: anywhere; }

        .form-actions { display: flex; flex-wrap: wrap; align-items: center; gap: 14px 20px; padding-top: 4px; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 15px 30px; border-radius: 999px; font-weight: 700; font-size: 1rem; transition: background .2s, box-shadow .2s; cursor: pointer; }
        .btn-primary { background: var(--signal); color: #fff; box-shadow: 0 14px 30px -10px rgba(229,57,45,.6); }
        .btn-primary:hover { background: var(--signal-d); }
        .btn-dark { background: var(--ink); color: #fff; }
        .btn-dark:hover { background: var(--ink-3); }
        .form-actions p { font-size: .88rem; color: var(--steel); }
        @media (max-width: 640px) { .form-actions .btn { width: 100%; } }

        .toast {
            position: fixed; z-index: 80; left: 50%; top: calc(var(--header-h) + 16px);
            transform: translateX(-50%); width: max-content; max-width: calc(100vw - 28px);
            display: flex; align-items: center; gap: 14px; padding: 12px 12px 12px 14px;
            background: #fff; border: 1px solid var(--line); border-radius: 999px;
            box-shadow: 0 18px 36px -12px rgba(13,27,42,.45); font-weight: 600; font-size: .93rem; line-height: 1.4;
            animation: toastIn .5s cubic-bezier(.16,.84,.3,1) both;
        }
        .toast.leaving { animation: toastOut .35s ease forwards; }
        .toast-ico { flex: none; width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: #16a34a; color: #fff; font-size: .8rem; }
        .toast-x { flex: none; width: 32px; height: 32px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); font-size: .8rem; transition: background .2s, color .2s; }
        .toast-x:hover { background: var(--ink); color: #fff; }
        @keyframes toastIn { from { opacity: 0; transform: translate(-50%, -16px); } to { opacity: 1; transform: translate(-50%, 0); } }
        @keyframes toastOut { from { opacity: 1; transform: translate(-50%, 0); } to { opacity: 0; transform: translate(-50%, -16px); } }

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
        .req-list > li.req-key { padding: 14px 16px 14px 60px; border-radius: 14px; background: #fdeceb; }
        .req-list > li.req-key::before { left: 16px; top: 14px; background: var(--signal); color: #fff; }
        .req-list > li.req-key b { color: var(--signal-d); }
        .req-list ul { margin-top: 8px; display: grid; gap: 6px; }
        .req-list ul li { position: relative; padding-left: 18px; }
        .req-list ul li::before { content: ""; position: absolute; left: 3px; top: .65em; width: 6px; height: 6px; border-radius: 50%; background: var(--steel); }
        .req-list ul ul { margin-top: 6px; }
        .req-list ul ul li::before { background: transparent; border: 1.5px solid var(--steel); }
        .req-list b { font-weight: 600; }

        /* FOOTER */
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

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *, *::before, *::after { animation: none !important; transition: none !important; }
        }
    </style>
</head>
<body>

@if(session('success'))
    <div class="toast" id="toast" role="status">
        <span class="toast-ico"><i class="fas fa-check"></i></span>
        <span>{{ session('success') }}</span>
        <button type="button" class="toast-x" aria-label="Tutup notifikasi" data-toast-close><i class="fas fa-times"></i></button>
    </div>
@endif

<!-- ==================== HEADER ==================== -->
<header class="site-header" id="siteHeader">
    <nav class="nav" aria-label="Navigasi utama">
        <a href="/" class="brand" aria-label="SIMERAH KOJA, beranda">
            <img src="/images/jambi.png" alt="Logo Pemkot Jambi">
            <img src="/images/logo.png" alt="Logo Damkar">
            <img src="/images/logo-redkar.png" alt="Logo Redkar">
        </a>

        <button class="nav-toggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="navPanel">
            <i class="fas fa-bars"></i>
        </button>

        <div class="nav-panel" id="navPanel">
            <!-- ===== Menu utama ===== -->
            <ul class="menu">
                <li><a class="menu-link {{ request()->is('public-sigap*') ? 'is-active' : '' }}" href="/public-sigap">Sigapkar</a></li>

                <li class="has-drop current">
                    <button class="menu-trigger" type="button" aria-expanded="false">Layanan <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Kunjungan, Edukasi dan Sosialisasi</a></li>
                        <li><a href="/layanan-fasilitas/izin-keramaian">Rekomendasi Izin Pengamanan Event Keramaian</a></li>
                        <li><a href="/layanan-fasilitas/layanan_perizinan">Rekomendasi Kebakaran Bangunan Gedung dan Lingkungan</a></li>
                        <li><a href="#">Permohonan Penggunaan Sarana Pemadam Kebakaran</a></li>
                        <li><a href="/layanan-fasilitas/skk" aria-current="page">Permohonan Sertifikat Keselamatan Kebakaran</a></li>
                    </ul>
                </li>

                <li class="has-drop">
                    <button class="menu-trigger" type="button" aria-expanded="false">Produk Hukum <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/produkhukum">Undang-Undang</a></li>
                        <li><a href="/produkhukum">Peraturan Pemerintah</a></li>
                        <li><a href="/produkhukum">Peraturan Menteri</a></li>
                        <li><a href="/produkhukum">Peraturan Daerah</a></li>
                        <li><a href="/produkhukum">Peraturan Kepala Daerah</a></li>
                    </ul>
                </li>

                <li class="has-drop">
                    <button class="menu-trigger" type="button" aria-expanded="false">Profil <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="#">Visi Misi</a></li>
                        <li><a href="/sotk">SOTK</a></li>
                        <li><a href="#">Tupoksi</a></li>
                        <li><a href="#">Kepegawaian</a></li>
                        <li><a href="#">Program Kegiatan</a></li>
                        <li><a href="#">Cascading</a></li>
                    </ul>
                </li>

                <li class="has-drop">
                    <button class="menu-trigger" type="button" aria-expanded="false">SOP <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/sop/pencegahan">Pencegahan</a></li>
                        <li><a href="/sop/pemadaman">Pemadaman Kebakaran</a></li>
                        <li><a href="/sop/penyelamatan">Penyelamatan dan Evakuasi</a></li>
                        <li><a href="/sop/sarpras">Sarana dan Prasarana</a></li>
                        <li><a href="/sop/kepegawaian">Kepegawaian</a></li>
                        <li><a href="/sop/keuangan">Keuangan</a></li>
                    </ul>
                </li>

                <li class="has-drop">
                    <button class="menu-trigger" type="button" aria-expanded="false">Dokumen <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/dokumen/renstra">Renstra</a></li>
                        <li><a href="/dokumen/renja">Renja</a></li>
                        <li><a href="/dokumen/spm">SPM</a></li>
                        <li><a href="/dokumen/sakip">SAKIP</a></li>
                        <li><a href="/dokumen/lppd">LPPD</a></li>
                    </ul>
                </li>

                <li class="has-drop">
                    <button class="menu-trigger" type="button" aria-expanded="false">Sarpras <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="{{ route('sarpras.sarana') }}">Sarana</a></li>
                        <li><a href="{{ route('sarpras.prasarana') }}">Prasarana</a></li>
                    </ul>
                </li>

                <li class="has-drop">
                    <button class="menu-trigger" type="button" aria-expanded="false">Galeri <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/ikm">IKM (Indeks Kepuasan Masyarakat)</a></li>
                        <li><a href="/pengumuman">Pengumuman</a></li>
                        <li class="has-sub">
                            <button class="sub-trigger" type="button" aria-expanded="false">
                                Berita <i class="fas fa-chevron-right"></i>
                            </button>
                            <ul class="dropdown-sub">
                                <li><a href="/edu-damkar">Edu Damkar</a></li>
                                <li><a href="{{ route('publik.infografis') }}">Infografis</a></li>
                                <li><a href="/media-informasi">Media Informasi</a></li>
                                <li><a href="/ujung-ujung-damkar">Ujung-ujung Damkar</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li><a class="menu-link {{ request()->is('redkar*') ? 'is-active' : '' }}" href="/redkar">Redkar</a></li>
            </ul>

            <!-- ===== Tombol kanan: Lapor darurat + Masuk ===== -->
            <ul class="nav-actions">
                <li class="has-drop">
                    <button class="btn-nav btn-nav--alert menu-trigger-cta" type="button" aria-expanded="false">
                        <span class="beacon" aria-hidden="true"></span> Lapor darurat <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown">
                        <li><a href="tel:112"><i class="fas fa-headset"></i> Call Center 112</a></li>
                        <li><a href="tel:{{ $no_telepon }}"><i class="fas fa-phone-alt"></i> Telepon {{ $telepon_tampil }}</a></li>
                        <li><a href="{{ $wa_link }}" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a></li>
                    </ul>
                </li>

                @if(session()->has('pemohon_id'))
                    <li class="has-drop">
                        <button class="btn-nav btn-nav--ghost menu-trigger-cta" type="button" aria-expanded="false">
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
                    <li><a class="btn-nav btn-nav--ghost" href="{{ route('pemohon.login') }}">Masuk</a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>

<main>

<!-- ==================== HERO HALAMAN ==================== -->
<section class="page-hero">
    <div class="wrap">
        <nav aria-label="Breadcrumb" class="rise">
            <ol class="crumbs">
                <li><a href="/">Beranda</a></li>
                <li><a href="/layanan-fasilitas/layanan_perizinan">Layanan</a></li>
                <li><span aria-current="page">SKK</span></li>
            </ol>
        </nav>
        <h1 class="rise d1">Sertifikat Keamanan Kebakaran</h1>
        <p class="rise d2">Ajukan  Permohonan Sertifikat Keamanan Kebakaran secara daring ke Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
    </div>
</section>

<div class="page-body">
    <div class="wrap tabs-wrap">
        <nav class="tabs" aria-label="Jenis layanan perizinan">
            @foreach($layanan as $key => $l)
                <a class="tab" href="{{ $l['url'] }}" title="{{ $l['ket'] }}" @if($key === $tab_aktif) aria-current="page" @endif>
                    <i class="fas {{ $l['ico'] }}"></i> {{ $l['label'] }}
                </a>
            @endforeach
        </nav>
    </div>

    <div class="wrap">

        <div class="facts">
            <div class="fact">
                <span class="c-ico"><i class="fas fa-clock"></i></span>
                <div>
                    <small>Waktu penyelesaian</small>
                    <strong>14 hari kerja</strong>
                </div>
            </div>
            <div class="fact">
                <span class="c-ico"><i class="fas fa-certificate"></i></span>
                <div>
                    <small>Produk layanan</small>
                    <strong>Sertifikat Keamanan Kebakaran</strong>
                </div>
            </div>
            <div class="fact">
                <span class="c-ico"><i class="fab fa-whatsapp"></i></span>
                <div>
                    <small>Pengaduan layanan</small>
                    <a href="https://wa.me/{{ $no_whatsapp }}" target="_blank" rel="noopener">WhatsApp +62 8117113113</a>
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
                        <h2>Persyaratan Utama</h2>
                    </div>
                    <ol class="checklist">
                        <li>
                            <span class="ck-ico"><i class="fas fa-pen-to-square"></i></span>
                            <div>Pilih dan isi formulir Pembuatan Baru atau Perpanjangan Sertifikat Keamanan Kebakaran (SKK)</div>
                        </li>
                        <li>    
                            <span class="ck-ico"><i class="fas fa-file-signature"></i></span>
                            <div>
                                Unggah surat permohonan bermaterai
                                @if($url_surat_permohonan)
                                    <br><a class="text-link" href="{{ $url_surat_permohonan }}" download>Unduh surat permohonan</a>
                                @else
                                    <br><span class="muted">Templat surat permohonan belum tersedia</span>
                                @endif
                            </div>
                        </li>
                        <li>
                            <span class="ck-ico"><i class="fas fa-file-shield"></i></span>
                            <div>
                                Jika <b>Perpanjangan</b>, wajib unggah berkas Sertifikat (SKK) tahun sebelumnya.
                            </div>
                        </li>
                        <li>
                            <span class="ck-ico"><i class="fas fa-folder-open"></i></span>
                            <div>
                                Unggah detail persyaratan SKK lainnya (IMB, NIB, dll)
                                <br><button type="button" class="tool" data-open-modal><i class="fas fa-list-ul"></i> Lihat detail</button>
                            </div>
                        </li>
                    </ol>
                </section>
            </aside>

            <!-- Formulir -->
            <section class="form-panel" id="formulir" aria-label="Formulir permohonan">
                <div class="form-bar">
                    <div class="form-title">
                        <i class="fas fa-certificate"></i>
                        <div>
                            <h2>Formulir Permohonan SKK</h2>
                            <p>Sertifikat Keamanan Kebakaran (Baru & Perpanjangan)</p>
                        </div>
                    </div>
                    <span class="form-note"><span class="req" aria-hidden="true">*</span> wajib diisi</span>
                </div>

                <form class="form-body" action="{{ route('permohonan.skk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if($errors->any())
                        <div class="alert err" role="alert">
                            <i class="fas fa-triangle-exclamation"></i>
                            <div>
                                Mohon periksa kembali form Anda:
                                <ul>
                                    @foreach($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <fieldset class="fs">
                        <legend><i class="fas fa-list-check"></i> Jenis Permohonan</legend>
                        <div class="fields">
                            <div class="field full">
                                <label class="label">Pilih Jenis Layanan SKK <span class="req" aria-hidden="true">*</span></label>
                                <div class="radio-group">
                                    <label class="radio-card">
                                        <input type="radio" name="jenis_permohonan" value="Baru" required onchange="toggleSkkLama()" @if($oldJenis == 'Baru' || empty($oldJenis)) checked @endif>
                                        <span>Pembuatan SKK Baru</span>
                                    </label>
                                    <label class="radio-card">
                                        <input type="radio" name="jenis_permohonan" value="Perpanjangan" required onchange="toggleSkkLama()" @if($oldJenis == 'Perpanjangan') checked @endif>
                                        <span>Perpanjangan SKK</span>
                                    </label>
                                </div>
                                {!! $fe('jenis_permohonan') !!}
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="fs">
                        <legend><i class="fas fa-user"></i> Data Pemohon / Pemilik Gedung</legend>
                        <div class="fields">
                            <div class="field full">
                                <label class="label" for="nama_pemohon">Nama pemohon <span class="req" aria-hidden="true">*</span></label>
                                <input class="input{{ $inv('nama_pemohon') }}" type="text" id="nama_pemohon" name="nama_pemohon" value="{{ old('nama_pemohon') }}" autocomplete="name" required>
                                {!! $fe('nama_pemohon') !!}
                            </div>
                            <div class="field">
                                <label class="label" for="email_pemohon">Email pemohon <span class="req" aria-hidden="true">*</span></label>
                                <input class="input{{ $inv('email_pemohon') }}" type="email" id="email_pemohon" name="email_pemohon" value="{{ old('email_pemohon') }}" autocomplete="email" required>
                                {!! $fe('email_pemohon') !!}
                            </div>
                            <div class="field">
                                <label class="label" for="no_whatsapp">Nomor WhatsApp <span class="req" aria-hidden="true">*</span></label>
                                <input class="input{{ $inv('no_whatsapp') }}" type="tel" id="no_whatsapp" name="no_whatsapp" value="{{ old('no_whatsapp') }}" inputmode="tel" autocomplete="tel" placeholder="Contoh: 08123456789" required aria-describedby="hint-wa">
                                {!! $fe('no_whatsapp') !!}
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="fs">
                        <legend><i class="fas fa-briefcase"></i> Data Usaha / Perusahaan</legend>
                        <div class="fields">
                            <div class="field full">
                                <label class="label" for="nama_usaha">Nama Instansi / Perusahaan <span class="req" aria-hidden="true">*</span></label>
                                <input class="input{{ $inv('nama_usaha') }}" type="text" id="nama_usaha" name="nama_usaha" value="{{ old('nama_usaha') }}" autocomplete="organization" required aria-describedby="hint-usaha">
                                <p class="hint" id="hint-usaha">PT, CV, Lembaga, atau Perorangan pengelola gedung.</p>
                                {!! $fe('nama_usaha') !!}
                            </div>
                            <div class="field">
                                <label class="label" for="nik_pemilik_usaha">NIK Pemilik Usaha <span class="req" aria-hidden="true">*</span></label>
                                <input class="input{{ $inv('nik_pemilik_usaha') }}" type="text" id="nik_pemilik_usaha" name="nik_pemilik_usaha" value="{{ old('nik_pemilik_usaha') }}" inputmode="numeric" pattern="[0-9]{16}" maxlength="16" placeholder="16 digit NIK" required>
                                {!! $fe('nik_pemilik_usaha') !!}
                            </div>
                            <div class="field">
                                <label class="label" for="alamat_pemilik_usaha">Alamat Pemilik Usaha <span class="req" aria-hidden="true">*</span></label>
                                <input class="input{{ $inv('alamat_pemilik_usaha') }}" type="text" id="alamat_pemilik_usaha" name="alamat_pemilik_usaha" value="{{ old('alamat_pemilik_usaha') }}" autocomplete="street-address" required>
                                {!! $fe('alamat_pemilik_usaha') !!}
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="fs">
                        <legend><i class="fas fa-building"></i> Data Bangunan Gedung</legend>
                        <div class="fields">
                            <div class="field full">
                                <label class="label" for="nama_bangunan">Nama Bangunan Gedung <span class="req" aria-hidden="true">*</span></label>
                                <input class="input{{ $inv('nama_bangunan') }}" type="text" id="nama_bangunan" name="nama_bangunan" value="{{ old('nama_bangunan') }}" placeholder="Contoh: Gedung Perkantoran Abadi / Mall Jambi" required>
                                {!! $fe('nama_bangunan') !!}
                            </div>
                            <div class="field">
                                <label class="label" for="kategori_bangunan">Fungsi Bangunan Gedung <span class="req" aria-hidden="true">*</span></label>
                                <select class="input{{ $inv('kategori_bangunan') }}" id="kategori_bangunan" name="kategori_bangunan" required>
                                    <option value="" disabled @if(!old('kategori_bangunan')) selected @endif>Pilih fungsi bangunan</option>
                                    @foreach($kategori_list as $kat)
                                        <option value="{{ $kat }}" @if(old('kategori_bangunan') === $kat) selected @endif>{{ $kat }}</option>
                                    @endforeach
                                </select>
                                {!! $fe('kategori_bangunan') !!}
                            </div>
                            <div class="field">
                                <label class="label" for="konstruksi_bangunan">Konstruksi Bangunan <span class="req" aria-hidden="true">*</span></label>
                                <input class="input{{ $inv('konstruksi_bangunan') }}" type="text" id="konstruksi_bangunan" name="konstruksi_bangunan" value="{{ old('konstruksi_bangunan') }}" placeholder="Contoh: Cor Beton Bertulang / Baja" required>
                                {!! $fe('konstruksi_bangunan') !!}
                            </div>
                            <div class="field full">
                                <label class="label" for="nomor_imb">Nomor IMB / PBG <span class="req" aria-hidden="true">*</span></label>
                                <input class="input{{ $inv('nomor_imb') }}" type="text" id="nomor_imb" name="nomor_imb" value="{{ old('nomor_imb') }}" placeholder="Masukkan Nomor Izin Mendirikan Bangunan" required>
                                {!! $fe('nomor_imb') !!}
                            </div>
                            <div class="field full">
                                <label class="label" for="alamat_bangunan">Alamat Lengkap Bangunan Gedung <span class="req" aria-hidden="true">*</span></label>
                                <input class="input{{ $inv('alamat_bangunan') }}" type="text" id="alamat_bangunan" name="alamat_bangunan" value="{{ old('alamat_bangunan') }}" required>
                                {!! $fe('alamat_bangunan') !!}
                            </div>
                            <div class="field">
                                <label class="label" for="kecamatan">Kecamatan <span class="req" aria-hidden="true">*</span></label>
                                <select class="input{{ $inv('kecamatan') }}" id="kecamatan" name="kecamatan" required>
                                    <option value="" disabled @if(!$oldKec) selected @endif>Pilih kecamatan</option>
                                    @foreach(array_keys($dataWilayah) as $kc)
                                        <option value="{{ $kc }}" @if($oldKec === $kc) selected @endif>{{ $kc }}</option>
                                    @endforeach
                                </select>
                                {!! $fe('kecamatan') !!}
                            </div>
                            <div class="field">
                                <label class="label" for="kelurahan">Kelurahan <span class="req" aria-hidden="true">*</span></label>
                                <select class="input{{ $inv('kelurahan') }}" id="kelurahan" name="kelurahan" required>
                                    @if($oldKec && isset($dataWilayah[$oldKec]))
                                        <option value="" disabled @if(!$oldKel) selected @endif>Pilih kelurahan</option>
                                        @foreach($dataWilayah[$oldKec] as $kl)
                                            <option value="{{ $kl }}" @if($oldKel === $kl) selected @endif>{{ $kl }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled selected>Pilih kecamatan terlebih dahulu</option>
                                    @endif
                                </select>
                                {!! $fe('kelurahan') !!}
                            </div>
                            
                            <!-- SPESIFIKASI BANGUNAN -->
                            <div class="field full">
                                <div class="fields-4">
                                    <div class="field">
                                        <label class="label" for="luas_lahan">Luas Tanah <span class="req" aria-hidden="true">*</span></label>
                                        <div class="unit">
                                            <input class="input{{ $inv('luas_lahan') }}" type="number" id="luas_lahan" name="luas_lahan" value="{{ old('luas_lahan') }}" min="0" step="0.01" inputmode="decimal" required>
                                            <span aria-hidden="true">m&sup2;</span>
                                        </div>
                                        {!! $fe('luas_lahan') !!}
                                    </div>
                                    <div class="field">
                                        <label class="label" for="luas_bangunan">Luas Bangunan <span class="req" aria-hidden="true">*</span></label>
                                        <div class="unit">
                                            <input class="input{{ $inv('luas_bangunan') }}" type="number" id="luas_bangunan" name="luas_bangunan" value="{{ old('luas_bangunan') }}" min="0" step="0.01" inputmode="decimal" required>
                                            <span aria-hidden="true">m&sup2;</span>
                                        </div>
                                        {!! $fe('luas_bangunan') !!}
                                    </div>
                                    <div class="field">
                                        <label class="label" for="jumlah_lantai">Jumlah Lantai <span class="req" aria-hidden="true">*</span></label>
                                        <div class="unit">
                                            <input class="input{{ $inv('jumlah_lantai') }}" type="number" id="jumlah_lantai" name="jumlah_lantai" value="{{ old('jumlah_lantai') }}" min="1" step="1" inputmode="numeric" required>
                                            <span aria-hidden="true">Lantai</span>
                                        </div>
                                        {!! $fe('jumlah_lantai') !!}
                                    </div>
                                    <div class="field">
                                        <label class="label" for="tinggi_bangunan">Tinggi Bangunan <span class="req" aria-hidden="true">*</span></label>
                                        <div class="unit">
                                            <input class="input{{ $inv('tinggi_bangunan') }}" type="number" id="tinggi_bangunan" name="tinggi_bangunan" value="{{ old('tinggi_bangunan') }}" min="0" step="0.01" inputmode="decimal" required>
                                            <span aria-hidden="true">Meter</span>
                                        </div>
                                        {!! $fe('tinggi_bangunan') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="fs">
                        <legend><i class="fas fa-paperclip"></i> Berkas Pendukung</legend>
                        <div class="fields">

                            <!-- Kolom Dinamis: Khusus SKK Perpanjangan -->
                            <div class="field full" id="field_skk_lama" style="display: none;">
                                <span class="label" id="lbl-skklama">Sertifikat Keamanan Kebakaran (SKK) Tahun Lalu <span class="req" aria-hidden="true">*</span></span>
                                <label class="dropzone{{ $inv('file_skk_lama') }}" data-dropzone data-max="5">
                                    <input type="file" id="file_skk_lama" name="file_skk_lama" accept=".pdf,.jpg,.jpeg,.png" aria-labelledby="lbl-skklama">
                                    <span class="dz-ico"><i class="fas fa-file-shield"></i></span>
                                    <span class="dz-text"><strong>Tarik berkas SKK lama</strong> atau <u>pilih dari perangkat</u></span>
                                    <ul class="dz-files" aria-live="polite"></ul>
                                </label>
                                <p class="hint" style="color:var(--signal-d); font-weight:600;"><i class="fas fa-info-circle"></i> Wajib dilampirkan untuk permohonan Perpanjangan SKK.</p>
                                <p class="field-err dz-msg" role="alert"></p>
                                {!! $fe('file_skk_lama') !!}
                            </div>
                            
                            <div class="field full">
                                <span class="label" id="lbl-surat">Surat permohonan bermaterai <span class="req" aria-hidden="true">*</span></span>
                                <label class="dropzone{{ $inv('file_surat_permohonan') }}" data-dropzone data-max="5">
                                    <input type="file" id="file_surat" name="file_surat_permohonan" accept=".pdf,.jpg,.jpeg,.png" required aria-labelledby="lbl-surat" aria-describedby="hint-surat">
                                    <span class="dz-ico"><i class="fas fa-cloud-arrow-up"></i></span>
                                    <span class="dz-text"><strong>Tarik berkas ke sini</strong> atau <u>pilih dari perangkat</u></span>
                                    <ul class="dz-files" aria-live="polite"></ul>
                                </label>
                                <p class="hint" id="hint-surat">Format PDF, JPG, atau PNG. Maksimal 5 MB.</p>
                                <p class="field-err dz-msg" role="alert"></p>
                                {!! $fe('file_surat_permohonan') !!}
                            </div>
                            
                            <div class="field full">
                                <span class="label" id="lbl-lain">Persyaratan lainnya</span>
                                <label class="dropzone{{ $inv('file_persyaratan_lainnya') }}" data-dropzone data-max="10">
                                    <input type="file" id="file_lain" name="file_persyaratan_lainnya" accept=".pdf,.zip,.rar" aria-labelledby="lbl-lain" aria-describedby="hint-lain">
                                    <span class="dz-ico"><i class="fas fa-cloud-arrow-up"></i></span>
                                    <span class="dz-text"><strong>Tarik berkas ke sini</strong> atau <u>pilih dari perangkat</u></span>
                                    <ul class="dz-files" aria-live="polite"></ul>
                                </label>
                                <p class="hint" id="hint-lain">Format PDF atau ZIP, maksimal 10 MB. Daftar berkas yang diminta ada di <button type="button" class="text-link" data-open-modal>detail persyaratan</button>.</p>
                                <p class="field-err dz-msg" role="alert"></p>
                                {!! $fe('file_persyaratan_lainnya') !!}
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
        <h2 id="modalTitle">Detail persyaratan SKK & Perpanjangan</h2>
        <button type="button" class="modal-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
    </div>
    <div class="modal-body">
        <div style="margin-bottom: 15px; padding: 10px; background: #fffbe6; border-left: 4px solid #ffb627; font-size: 0.9rem;">
            <b>Khusus Perpanjangan:</b> Anda diwajibkan untuk mengunggah dokumen <b>SKK Tahun Lalu</b> pada kolom yang tersedia di formulir, di samping berkas persyaratan di bawah ini.
        </div>
        <ol class="req-list">
            <li>Menginput Formulir Sertifikat Keamanan Kebakaran secara elektronik melalui simerah.jambikota.go.id</li>
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
            <li class="req-key">
                <b>Scan asli Rekomendasi Proteksi Kebakaran Bangunan Gedung dan Lingkungan</b>
                <div>Belum punya? <a class="text-link" href="/layanan-fasilitas/layanan_perizinan">Ajukan RPKBGL lebih dulu</a>.</div>
            </li>
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

<!-- TOMBOL LAPOR MENGAMBANG -->
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

    /* ---------- Navigasi Menu Multi-Dropdown ---------- */
    var header = document.getElementById('siteHeader');
    var toggle = header.querySelector('.nav-toggle');
    var drops = header.querySelectorAll('.has-drop');
    var subs = header.querySelectorAll('.has-sub');
    var desktop = window.matchMedia('(hover: hover) and (min-width: 1201px)');

    function triggerOf(li) {
        return li.querySelector(':scope > .menu-trigger, :scope > .menu-trigger-cta');
    }

    function closeSubs() {
        subs.forEach(function (s) {
            s.classList.remove('open');
            s.querySelector('.sub-trigger').setAttribute('aria-expanded', 'false');
        });
    }

    function closeDrops(except) {
        drops.forEach(function (li) {
            if (li !== except) {
                li.classList.remove('open');
                triggerOf(li).setAttribute('aria-expanded', 'false');
            }
        });
        if (!except) closeSubs();
    }

    function setMobileMenu(open) {
        header.classList.toggle('nav-open', open);
        document.body.classList.toggle('nav-lock', open);
        toggle.setAttribute('aria-expanded', open);
        toggle.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
        toggle.querySelector('i').className = open ? 'fas fa-times' : 'fas fa-bars';
        if (!open) closeDrops(null);
    }

    toggle.addEventListener('click', function () {
        setMobileMenu(!header.classList.contains('nav-open'));
    });

    drops.forEach(function (li) {
        var btn = triggerOf(li);
        btn.addEventListener('click', function () {
            var open = li.classList.toggle('open');
            btn.setAttribute('aria-expanded', open);
            closeDrops(li);
        });
        
        li.addEventListener('mouseleave', function () {
            if (!desktop.matches) return;
            li.classList.remove('open');
            btn.setAttribute('aria-expanded', 'false');
            closeSubs();
        });
    });

    subs.forEach(function (li) {
        var btn = li.querySelector('.sub-trigger');
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var open = li.classList.toggle('open');
            btn.setAttribute('aria-expanded', open);
        });
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.has-drop')) closeDrops(null);
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeDrops(null);
            if (header.classList.contains('nav-open')) setMobileMenu(false);
        }
    });

    window.matchMedia('(min-width: 1201px)').addEventListener('change', function (e) {
        if (e.matches) setMobileMenu(false);
    });

    /* ---------- Tombol lapor mengambang ---------- */
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

    var toast = document.getElementById('toast');
    if (toast) {
        var hideToast = function () {
            toast.classList.add('leaving');
            setTimeout(function () { toast.remove(); }, 400);
        };
        toast.querySelector('[data-toast-close]').addEventListener('click', hideToast);
        setTimeout(hideToast, 5000);
    }

    var dlg = document.getElementById('modalPersyaratan');

    function openDlg() { if (dlg.showModal) dlg.showModal(); else dlg.setAttribute('open', ''); }
    function closeDlg() { if (dlg.close) dlg.close(); else dlg.removeAttribute('open'); }

    document.querySelectorAll('[data-open-modal]').forEach(function (b) {
        b.addEventListener('click', openDlg);
    });
    dlg.addEventListener('click', function (e) {
        if (e.target === dlg || e.target.closest('[data-close]')) closeDlg();
    });

    var dataWilayah = <?= json_encode($dataWilayah) ?>;
    var kec = document.getElementById('kecamatan');
    var kel = document.getElementById('kelurahan');

    kec.addEventListener('change', function () {
        kel.innerHTML = '';
        var ph = new Option('Pilih kelurahan', '', true, true);
        ph.disabled = true;
        kel.add(ph);
        (dataWilayah[kec.value] || []).forEach(function (nama) {
            kel.add(new Option(nama, nama));
        });
    });

    window.toggleSkkLama = function() {
        var radios = document.getElementsByName('jenis_permohonan');
        var isPerpanjang = false;
        
        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked && radios[i].value === 'Perpanjangan') {
                isPerpanjang = true;
                break;
            }
        }
        
        var wrap = document.getElementById('field_skk_lama');
        var input = document.getElementById('file_skk_lama');
        
        if(isPerpanjang) {
            wrap.style.display = 'block';
            input.setAttribute('required', 'required');
        } else {
            wrap.style.display = 'none';
            input.removeAttribute('required');
            input.value = '';
            var list = wrap.querySelector('.dz-files');
            if(list) list.innerHTML = '';
            wrap.querySelector('.dropzone').classList.remove('has-files', 'is-invalid');
        }
    };
    
    document.addEventListener('DOMContentLoaded', function() {
        toggleSkkLama();
    });

    function fmtSize(b) {
        return b < 1048576 ? Math.max(1, Math.round(b / 1024)) + ' KB' : (b / 1048576).toFixed(1) + ' MB';
    }

    document.querySelectorAll('[data-dropzone]').forEach(function (dz) {
        var input = dz.querySelector('input[type="file"]');
        var list = dz.querySelector('.dz-files');
        var maxMb = parseFloat(dz.getAttribute('data-max')) || 0;
        var msg = dz.parentNode.querySelector('.dz-msg');

        ['dragenter', 'dragover'].forEach(function (t) {
            dz.addEventListener(t, function () { dz.classList.add('is-over'); });
        });
        ['dragleave', 'drop'].forEach(function (t) {
            dz.addEventListener(t, function () { dz.classList.remove('is-over'); });
        });

        input.addEventListener('change', function () {
            list.textContent = '';
            if (msg) msg.textContent = '';
            dz.classList.remove('is-invalid');

            var files = Array.prototype.slice.call(input.files);
            var terlalubesar = files.some(function (f) { return maxMb && f.size > maxMb * 1048576; });

            if (terlalubesar) {
                input.value = '';
                dz.classList.remove('has-files');
                dz.classList.add('is-invalid');
                if (msg) msg.textContent = 'Ukuran berkas melebihi ' + maxMb + ' MB. Pilih berkas yang lebih kecil.';
                return;
            }

            files.forEach(function (f) {
                var li = document.createElement('li');
                li.textContent = f.name + ' (' + fmtSize(f.size) + ')';
                list.appendChild(li);
            });
            dz.classList.toggle('has-files', files.length > 0);
        });
    });
})();
</script>
</body>
</html>
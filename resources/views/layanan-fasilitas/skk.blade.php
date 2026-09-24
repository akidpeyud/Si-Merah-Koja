@php
    /* ------------------------------------------------------------
       PENGATURAN HALAMAN
       ------------------------------------------------------------ */
    $layanan = [
        'rpkbgl' => ['url' => '/layanan-fasilitas/layanan_perizinan', 'label' => 'RPKBGL', 'ico' => 'fa-building', 'ket' => 'Layanan perizinan Rekomendasi Proteksi Kebakaran Bangunan Gedung dan Lingkungan'],
        'skk'    => ['url' => '/layanan-fasilitas/skk',                'label' => 'SKK (Baru & Perpanjangan)', 'ico' => 'fa-user-shield', 'ket' => 'Layanan perizinan penerbitan & perpanjangan Sertifikat Keamanan Kebakaran'],
    ];
    $tab_aktif = 'skk';

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
    <title>Layanan Perizinan SKK - SIMERAH KOJA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
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

        .c-ico { flex: none; width: 40px; height: 40px; border-radius: 12px; display: grid; place-items: center; background: var(--paper); color: var(--signal-d); font-size: 1rem; }

        .facts { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-top: 28px; }
        .fact { display: flex; align-items: center; gap: 14px; padding: 18px 20px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); }
        .fact .c-ico { width: 46px; height: 46px; background: #fdeceb; font-size: 1.1rem; }
        .fact small { display: block; font-size: .8rem; color: var(--steel); line-height: 1.3; margin-bottom: 2px; }
        .fact strong, .fact a { display: block; font-weight: 600; font-size: .95rem; line-height: 1.4; }
        .fact a:hover { color: var(--signal-d); text-decoration: underline; text-underline-offset: 4px; }

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
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 15px 30px; border-radius: 999px; font-weight: 700; font-size: 1rem; transition: background .2s, box-shadow .2s; }
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
        #globalSuccessAlert .alert-icon { font-size: 22px; }
        .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; margin-left: 10px; cursor: pointer; }
        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
        @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }

        .alert-danger { background-color: #fef2f2; color: #991b1b; padding: 15px; border-radius: 8px; border: 1px solid #f87171; margin-bottom: 25px; font-size: 13px; }
        .alert-danger ul { padding-left: 20px; margin-top: 5px; }

        /* --- NAVBAR TEMA GELAP (STICKY) --- */
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 15px 50px; background-color: #0f172a; border-bottom: 4px solid #ef4444; position: sticky; top: 0; z-index: 9999; }
        .nav-logos { display: flex; gap: 15px; align-items: center; }
        .nav-logos a { display: block; text-decoration: none; }
        .nav-logos img { height: 40px; transition: transform 0.3s; }
        .nav-logos img:hover { transform: scale(1.05); }
        .nav-links { list-style: none; display: flex; gap: 30px; align-items: center; }
        .nav-links li { position: relative; padding-bottom: 15px; margin-bottom: -15px; }
        .nav-links a { color: #f8fafc; text-decoration: none; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s ease; }
        .nav-links a:hover { color: #ef4444; }
        .nav-links .btn-login { background-color: #ef4444; color: #ffffff; padding: 8px 24px; border-radius: 50px; margin-left: 10px; }
        .nav-links .btn-login:hover { background-color: #dc2626; color: #ffffff; }

        .dropdown-menu { display: none; position: absolute; top: 100%; left: 0; background-color: #0f172a; min-width: 220px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); border-radius: 0 0 8px 8px; overflow: hidden; z-index: 10; margin-top: 0; border: 1px solid #1e293b; border-top: none; }
        .dropdown:hover .dropdown-menu { display: block; animation: fadeIn 0.2s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
        .dropdown-menu li { list-style: none; padding-bottom: 0; margin-bottom: 0; }
        .dropdown-menu li a { color: #cbd5e1; padding: 14px 20px; display: block; font-size: 13px; border-bottom: 1px solid #1e293b; font-weight: 600; }
        .dropdown-menu li:last-child a { border-bottom: none; }
        .dropdown-menu li a:hover { background-color: #1e293b; color: #ef4444; padding-left: 26px; }

        /* --- HERO SECTION --- */
        .page-hero { background-image: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.95)), url('/images/background1.jpg'); background-size: cover; background-position: center; padding: 80px 20px; text-align: center; color: white; border-bottom: 4px solid #ef4444; }
        .page-hero h1 { font-size: 3rem; font-weight: 800; margin-bottom: 15px; letter-spacing: 1px; }
        .breadcrumb { font-size: 14px; font-weight: 600; color: #cbd5e1; justify-content: center; display: flex; align-items: center; }
        .breadcrumb a { color: #38bdf8; text-decoration: none; transition: 0.3s; }
        .breadcrumb a:hover { color: #bae6fd; text-decoration: underline; }
        .breadcrumb span { color: #ef4444; margin: 0 5px;}
        .breadcrumb .active { color: #ef4444; }

        /* --- IKON LAYANAN KLIKABEL --- */
        .service-icons-container { max-width: 900px; margin: -40px auto 50px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); position: relative; z-index: 5; }
        .service-icon-link { text-decoration: none; display: block; }
        .service-icon-box { display: flex; flex-direction: column; align-items: center; text-align: center; padding: 10px; transition: transform 0.3s ease; }
        .service-icon-box:hover { transform: translateY(-5px); }
        .icon-top-box { width: 70px; height: 70px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 35px; color: white; margin-bottom: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .bg-gray { background-color: #9ca3af; }
        .bg-pink { background-color: #ec4899; }
        .bg-orange { background-color: #f97316; }
        .service-icon-box h3 { font-size: 16px; font-weight: 800; color: #1e293b; margin-bottom: 8px; transition: color 0.3s; }
        .service-icon-box p { font-size: 11px; color: #64748b; line-height: 1.5; }
        .service-icon-link.active .service-icon-box h3 { color: #ef4444; }

        /* --- LAYOUT FORM & SIDEBAR --- */
        .content-wrapper { max-width: 1200px; margin: 0 auto 80px; display: flex; gap: 40px; padding: 0 20px; }
        .sidebar { width: 300px; flex-shrink: 0; }
        .sidebar-title { font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 5px; }
        .decor-line { display: flex; align-items: center; margin-bottom: 25px; }
        .decor-line::before { content: ""; height: 2px; width: 30px; background: #ef4444; }
        .decor-line i { color: #ef4444; font-size: 6px; margin: 0 5px; }
        .decor-line::after { content: ""; height: 2px; width: 10px; background: #ef4444; }

        .info-list { list-style: none; }
        .info-item { margin-bottom: 25px; }
        .info-header { display: flex; align-items: flex-start; gap: 15px; margin-bottom: 10px; }
        .info-header .icon-red { background: #ef4444; color: white; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; border-radius: 4px; font-size: 12px; flex-shrink: 0; margin-top: 2px; }
        .info-header h4 { font-size: 15px; font-weight: 700; color: #1e293b; line-height: 1.4;}
        .info-body { padding-left: 39px; font-size: 12px; color: #64748b; line-height: 1.6; }
        .info-body ul { padding-left: 15px; margin-bottom: 10px; }
        .info-body a { color: #ef4444; text-decoration: none; font-weight: 600; }
        
        .btn-detail { background: #ef4444; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 11px; font-weight: 600; cursor: pointer; margin-top: 5px; transition: 0.3s;}
        .btn-detail:hover { background: #dc2626; }

        .detail-content { display: none; margin-top: 10px; padding: 15px; border: 1px solid #e2e8f0; border-radius: 6px; background-color: #f8fafc; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .detail-content ul { padding-left: 20px; margin: 0; }
        .detail-content li { font-size: 12px; color: #64748b; line-height: 1.6; margin-bottom: 8px; list-style-type: circle; }
        .detail-content li:last-child { margin-bottom: 0; }

        /* --- MODAL POP-UP --- */
        .modal-overlay { display: none; position: fixed; z-index: 10000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.6); backdrop-filter: blur(3px); animation: fadeIn 0.3s; }
        .modal-box { background-color: #ffffff; margin: 5vh auto; padding: 0; border-radius: 8px; width: 85%; max-width: 800px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); position: relative; }
        .modal-header { padding: 20px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; }
        .modal-header h2 { font-size: 22px; font-weight: 800; color: #1f2937; }
        .modal-close-icon { color: #9ca3af; font-size: 28px; font-weight: bold; cursor: pointer; background: none; border: none; line-height: 1; }
        .modal-close-icon:hover { color: #111827; }
        .modal-body { padding: 25px 20px; font-size: 13px; color: #4b5563; line-height: 1.8; max-height: 60vh; overflow-y: auto; }
        .modal-body ol { padding-left: 20px; }
        .modal-body li { margin-bottom: 15px; }
        .modal-footer { padding: 15px 20px; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-start; }
        .btn-modal-tutup { background: #ef4444; color: white; border: none; padding: 10px 24px; border-radius: 6px; font-size: 14px; font-weight: 700; cursor: pointer; transition: 0.3s;}
        .btn-modal-tutup:hover { background: #dc2626; }
        .link-detail { color: #ef4444; font-weight: 600; cursor: pointer; text-decoration: none; }
        .link-detail:hover { text-decoration: underline; }

        .sidebar-social { padding-left: 39px; display: flex; gap: 8px; margin-top: 20px; }
        .sidebar-social a { background: #94a3b8; color: white; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border-radius: 4px; text-decoration: none; font-size: 13px; transition: 0.3s; }
        .sidebar-social a:hover { background: #ef4444; }

        /* Form */
        .form-container { flex-grow: 1; background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid #e5e7eb; }
        .form-title { font-size: 22px; font-weight: 800; color: #0f172a; line-height: 1.3; margin-bottom: 5px;}
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 8px; }
        .text-danger { color: #ef4444; }
        .form-control { width: 100%; padding: 12px 15px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px; color: #334155; outline: none; transition: border-color 0.3s; background-color: #f8fafc; }
        .form-control:focus { border-color: #ef4444; background-color: #ffffff; box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1); }
        select.form-control { appearance: auto; }

        .file-drop-area { border: 2px dashed #cbd5e1; background-color: #f8fafc; border-radius: 8px; padding: 30px; text-align: center; color: #64748b; font-size: 13px; font-weight: 600; transition: 0.3s; cursor: pointer; }
        .file-drop-area:hover { border-color: #ef4444; background-color: #fef2f2; }
        .file-drop-area p { margin: 0; }
        .file-drop-area span { color: #111827; text-decoration: underline; }
        .powered-by { text-align: right; font-size: 10px; color: #94a3b8; margin-top: 5px; }

        .btn-submit { background-color: #ef4444; color: white; border: none; padding: 12px 35px; width: 100%; font-size: 14px; font-weight: 800; border-radius: 6px; cursor: pointer; transition: 0.3s; margin-top: 10px; }
        .btn-submit:hover { background-color: #dc2626; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3); }

        /* --- FOOTER --- */
        .footer-bottom { background-color: #1a1a1a; color: #9ca3af; padding: 50px 5%; font-size: 13px; }
        .footer-grid { display: grid; grid-template-columns: 1fr 1.5fr 1fr; gap: 40px; max-width: 1100px; margin: 0 auto 40px; }
        .footer-logo { text-align: center; }
        .footer-logo img { height: 120px; margin-bottom: 15px; }
        .footer-about h3 { color: white; font-size: 18px; margin-bottom: 20px; font-weight: 700;}
        .footer-about p { line-height: 1.8; font-size: 12px; margin-bottom: 20px;}
        .footer-map-container { position: relative; width: 100%; height: 120px; background: #333; border-radius: 8px; overflow: hidden; margin-bottom: 15px;}
        .footer-map-container iframe { width: 100%; height: 100%; border: none;}
        .footer-find { font-weight: 700; color: white; margin-bottom: 20px; }
        .footer-find i { color: #ef4444; margin-right: 5px;}
        .footer-download p { font-size: 12px; color: #ef4444; margin-bottom: 10px; }
        .footer-download img { height: 40px; cursor: pointer;}
        .footer-links h3 { color: white; font-size: 18px; margin-bottom: 20px; font-weight: 700;}
        .footer-links ul { list-style: none; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a { color: #9ca3af; text-decoration: none; transition: color 0.3s; display: flex; align-items: center; gap: 10px;}
        .footer-links a:hover { color: white; }
        .footer-copyright { display: flex; justify-content: space-between; align-items: center; max-width: 1100px; margin: 0 auto; padding-top: 20px; border-top: 1px solid #333; }
        
        .footer-social { display: flex; gap: 5px; }
        .footer-social a { width: 35px; height: 35px; background: #333; color: white; display: flex; align-items: center; justify-content: center; border-radius: 4px; text-decoration: none; font-size: 13px; transition: 0.3s; }
        .footer-social a:hover { background: #ef4444; }
    </style>
</head>
<body>

    <!-- ALERT SUKSES FLOATING (Laravel) -->
    @if(session('success'))
        <div id="globalSuccessAlert">
            <i class="fas fa-check-circle alert-icon"></i>
            <span>{{ session('success') }}</span>
            <button class="btn-close-alert" onclick="closeAlert()"><i class="fas fa-times"></i></button>
        </div>
        <script>
            function closeAlert() {
                let alertBox = document.getElementById('globalSuccessAlert');
                if(alertBox) { 
                    alertBox.style.animation = 'fadeOutUpCenter 0.4s ease forwards'; 
                    setTimeout(() => alertBox.remove(), 400); 
                }
            }
            setTimeout(closeAlert, 5000);
        </script>
    @endif

    <?php
        $no_whatsapp = "628117113113"; 
        $no_telepon  = "074141171";
        $pesan_wa = "Terimakasih%20telah%20menghubungi%20SIMERAH%20KOJA...";
    ?>

    <!-- NAVBAR TEMA GELAP -->
    <nav class="navbar">
        <div class="nav-logos">
            <a href="/"><img src="/images/jambi.png" alt="Logo Pemkot"></a>
            <a href="/"><img src="/images/logo.png" alt="Logo Damkar"></a>
            <a href="/"><img src="/images/logo-redkar.png" alt="Logo Redkar"></a>
        </div>
        <ul class="nav-links">
            <li class="dropdown">
                <a href="#">Layanan Kedaruratan <i class="fas fa-chevron-down" style="font-size:10px; margin-left:4px;"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="https://wa.me/<?php echo $no_whatsapp; ?>?text=<?php echo $pesan_wa; ?>" target="_blank">WHATSAPP</a></li>
                    <li><a href="tel:<?php echo $no_telepon; ?>">TELEPHONE</a></li>
                    <li><a href="tel:112">CALL CENTER 112</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#">Program Kerja <i class="fas fa-chevron-down" style="font-size:10px; margin-left:4px;"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="/sotk">SOTK</a></li>
                    <li><a href="/perencanaan">PERENCANAAN</a></li>
                    <li><a href="/pelaporan">PELAPORAN</a></li>
                    <li><a href="/sop">SOP</a></li>
                    <li><a href="/produkhukum">PRODUK HUKUM</a></li>
                </ul>
            </li>
            <li class="has-drop current">
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan &amp; fasilitas <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/layanan-fasilitas/layanan_perizinan">Layanan perizinan</a></li>
                    <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Edukasi dan sosialisasi</a></li>
                    <li><a href="/informasi-layanan">Informasi layanan</a></li>
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

<!-- ==================== HERO HALAMAN ==================== -->
<section class="page-hero">
    <div class="wrap">
        <nav aria-label="Breadcrumb" class="rise">
            <ol class="crumbs">
                <li><a href="/">Beranda</a></li>
                <li><a href="/layanan-fasilitas/layanan_perizinan">Layanan perizinan</a></li>
                <li><span aria-current="page">{{ $layanan[$tab_aktif]['label'] }}</span></li>
            </ol>
        </nav>
        <h1 class="rise d1">Layanan perizinan</h1>
        <p class="rise d2">Ajukan dan perpanjang Sertifikat Keamanan Kebakaran (SKK) secara daring di Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
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
        </a>
        
        <!-- SKK (Aktif di halaman ini) -->
        <a href="/layanan-fasilitas/skk" class="service-icon-link active">
            <div class="service-icon-box">
                <div class="icon-top-box bg-pink"><i class="fas fa-user-shield"></i></div>
                <h3>SKK</h3>
                <p>Layanan Perizinan Penerbitan Sertifikat Keamanan Kebakaran</p>
            </div>
        </a>

        <!-- Perpanjang SKK -->
        <a href="/layanan-fasilitas/perpanjang_skk" class="service-icon-link">
            <div class="service-icon-box">
                <div class="icon-top-box bg-orange"><i class="fas fa-shield-alt"></i></div>
                <h3>Perpanjang SKK</h3>
                <p>Layanan Perizinan Perpanjangan Sertifikat Keamanan Kebakaran</p>
            </div>
        </a>
    </div>

    <!-- LAYOUT FORM & SIDEBAR -->
    <div class="content-wrapper">
        
        <!-- KIRI: INFORMASI SIDEBAR -->
        <div class="sidebar">
            <h3 class="sidebar-title">Informasi</h3>
            <div class="decor-line"><i class="fas fa-circle"></i></div>

            <ul class="info-list">
                <li class="info-item">
                    <div class="info-header">
                        <div class="icon-red"><i class="fas fa-gavel"></i></div>
                        <h4>Dasar Hukum</h4>
                    </div>
                    <div class="info-body">
                        - UU No 28 Thn 2002<br>
                        - Permen Tenaga Kerja dan Transmigrasi No Per.04/MEN/1980<br>
                        - Permen PU No 26/PRT/M/2007<br>
                        - Permen PU No 20/PRT/M/2009<br>
                        - Permendagri No 114 Thn 2018
                    </div>
                </li>
                
                <li class="info-item">
                    <div class="info-header">
                        <div class="icon-red"><i class="fas fa-file-alt"></i></div>
                        <h4>Persyaratan</h4>
                    </div>
                    <div class="info-body">
                        <ul>
                            <li>Menginput Formulir Sertifikat Keamanan Kebakaran (SKK) secara elektronik melalui simerah.jambikota.go.id</li>
                            <li>Upload Surat Permohonan Bermaterai (<a href="#">Download Surat Permohonan</a>)</li>
                            <li>Upload Detail Persyaratan SKK Lainnya<br>
                                <a class="link-detail" onclick="bukaModal()">(Liat Detail)</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="info-item">
                    <div class="info-header">
                        <div class="icon-red"><i class="fas fa-cogs"></i></div>
                        <h4>Sistem, Mekanisme dan Prosedur</h4>
                    </div>
                    <div class="info-body">
                        <button type="button" class="btn-detail" onclick="toggleDetail()">Tampilkan Detail</button>
                        
                        <div id="detailProsedur" class="detail-content">
                            <ul>
                                <li>Pemohon mendaftar secara online, setelah itu mengupload kelengkapan berkas yang dipersyaratkan;</li>
                                <li>Tim Inspeksi melakukan pemeriksaan proteksi aktif kebakaran gedung pemohon;</li>
                                <li>Tim inspeksi merekomendasikan kepada kepala dinas pemadam kebakaran dan penyelamatan kota jambi untuk menerima dan menolak kunjungan pemohon berdasarkan hasil inspeksi lapangan;</li>
                                <li>Kepala dinas pemadam kebakaran dan penyelamatan kota jambi memberikan jawaban berdasarkan hasil rekomendasi tim inspeksi;</li>
                                <li>Sistem akan memberikan notifkasi via Whatsapp;</li>
                            </ul>
                        </div>
                    </div>
                </li>

                <li class="info-item">
                    <div class="info-header">
                        <div class="icon-red"><i class="fas fa-clock"></i></div>
                        <h4>Waktu Penyelesaian</h4>
                    </div>
                    <div class="info-body">
                        14 Hari Kerja
                    </div>
                </li>

                <li class="info-item">
                    <div class="info-header">
                        <div class="icon-red"><i class="fas fa-certificate"></i></div>
                        <h4>Produk Layanan</h4>
                    </div>
                    <div class="info-body">
                        Sertifikat Keamanan Kebakaran
                    </div>
                </li>

                <li class="info-item">
                    <div class="info-header">
                        <div class="icon-red"><i class="fas fa-headset"></i></div>
                        <h4>Pengaduan Layanan</h4>
                    </div>
                    <div class="info-body">
                        Whatsapp - +62 8117113113
                    </div>
                </li>
            </ul>

            <div class="sidebar-social">
                <a href="https://twitter.com/damkarkotajambi" target="_blank" title="Twitter / X"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com/DamkarKotaJambi" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/@damkarkotajambi" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="https://www.tiktok.com/@damkar.kota.jambi" target="_blank" title="TikTok"><i class="fab fa-tiktok"></i></a>
                <a href="https://www.instagram.com/damkar.kotajambi/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <!-- KANAN: FORMULIR -->
        <div class="form-container">
            <h2 class="form-title">Sertifikat Keamanan Kebakaran (SKK)</h2>
            <div class="decor-line"><i class="fas fa-circle"></i></div>

            <!-- ALERT ERROR VALIDASI -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <div class="fw-bold mb-1"><i class="fas fa-exclamation-triangle me-1"></i> Mohon periksa kembali form Anda:</div>
                    <ul>
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('permohonan.skk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nama Pemohon <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama_pemohon" value="{{ old('nama_pemohon') }}" required>
                </div>
                
                <div class="form-group">
                    <label>Email Pemohon <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email_pemohon" value="{{ old('email_pemohon') }}" required>
                </div>

                <div class="form-group">
                    <label>No Whatsapp <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="no_whatsapp" value="{{ old('no_whatsapp') }}" placeholder="Contoh: 08123456789" required>
                </div>

                <div class="form-group">
                    <label>Nama Usaha (PT/CV/UD/Lembaga/Toko/Instansi dan lainnya) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama_usaha" value="{{ old('nama_usaha') }}" required>
                </div>

                <div class="form-group">
                    <label>NIK Pemilik Usaha <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nik_pemilik_usaha" value="{{ old('nik_pemilik_usaha') }}" placeholder="16 Digit NIK" required>
                </div>

                <div class="form-group">
                    <label>Alamat Pemilik Usaha <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="alamat_pemilik_usaha" value="{{ old('alamat_pemilik_usaha') }}" required>
                </div>

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
                            
                            <!-- SPESIFIKASI BANGUNAN (Termasuk Tinggi Bangunan yang baru ditambahkan) -->
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

                <div class="form-group">
                    <label>Alamat Bangunan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="alamat_bangunan" value="{{ old('alamat_bangunan') }}" required>
                </div>

                <div class="form-group">
                    <label>Kecamatan <span class="text-danger">*</span></label>
                    <select class="form-control" name="kecamatan" id="kecamatan" required>
                        <option value="" selected disabled>Pilih Kecamatan</option>
                        <option value="Alam Barajo">Alam Barajo</option>
                        <option value="Danau Sipin">Danau Sipin</option>
                        <option value="Danau Teluk">Danau Teluk</option>
                        <option value="Jambi Selatan">Jambi Selatan</option>
                        <option value="Jambi Timur">Jambi Timur</option>
                        <option value="Jelutung">Jelutung</option>
                        <option value="Kota Baru">Kota Baru</option>
                        <option value="Paal Merah">Paal Merah</option>
                        <option value="Pasar Jambi">Pasar Jambi</option>
                        <option value="Pelayangan">Pelayangan</option>
                        <option value="Telanaipura">Telanaipura</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Kelurahan <span class="text-danger">*</span></label>
                    <select class="form-control" name="kelurahan" id="kelurahan" required>
                        <option value="" selected disabled>Pilih Kelurahan</option>
                    </select>
                </div>

                <div class="form-group" style="display: flex; gap: 15px;">
                    <div style="flex: 1;">
                        <label>Luas Lahan (m²) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control" name="luas_lahan" value="{{ old('luas_lahan') }}" required>
                    </div>
                    <div style="flex: 1;">
                        <label>Luas Bangunan (m²) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control" name="luas_bangunan" value="{{ old('luas_bangunan') }}" required>
                    </div>
                    <div style="flex: 1;">
                        <label>Tinggi (m) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control" name="tinggi_bangunan" value="{{ old('tinggi_bangunan') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Upload Surat Permohonan <span class="text-danger">*</span></label>
                    <div class="file-drop-area" onclick="document.getElementById('file_surat').click()">
                        <p id="label_file_surat"><i class="fas fa-cloud-upload-alt me-1"></i> Drag & Drop your files or <span>Browse</span> (Max 5MB)</p>
                        <input type="file" id="file_surat" name="file_surat_permohonan" style="display: none;" accept=".pdf,.jpg,.jpeg,.png" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Upload Persyaratan Lainnya</label>
                    <div class="file-drop-area" onclick="document.getElementById('file_lain').click()">
                        <p id="label_file_lain"><i class="fas fa-cloud-upload-alt me-1"></i> Drag & Drop your files or <span>Browse</span> (.pdf / .zip, Max 10MB)</p>
                        <input type="file" id="file_lain" name="file_persyaratan_lainnya" style="display: none;" accept=".pdf,.zip,.rar">
                    </div>
                </div>

                <button type="submit" class="btn-submit"><i class="fas fa-paper-plane" style="margin-right: 8px;"></i> KIRIM PERMOHONAN</button>
            </form>
        </div>

    </div>

    <!-- FOOTER -->
    <div class="footer-bottom">
        <div class="footer-grid">
            <div class="footer-about">
                <div class="footer-logo">
                    <img src="/images/simerahkoja.png" alt="Logo Simerah Koja">
                </div>
                <h3>Tentang Kami</h3>
                <p>SIMERAH KOJA merupakan sistem informasi pemerintahan berbasis elektronik yang terintegrasi pada dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
            </div>
            
            <div class="footer-contact">
                <div class="footer-map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.202353147814!2d103.600648!3d-1.618096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e22c8c6a234f6b1%3A0x4d537f0a82384f88!2sDinas%20Pemadam%20Kebakaran%20Kota%20Jambi!5e1!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="footer-find">
                    <i class="fas fa-map-marker-alt"></i> Find us on Map
                </div>
                <div class="footer-download">
                    <p>Download Aplikasi SIMERAH KOJA :</p>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Get it on Google Play">
                </div>
            </div>
            
            <div class="footer-links">
                <h3>Link Terkait</h3>
                <ul>
                    <li><a href="https://damkar.jambikota.go.id/" target="_blank"><i class="fas fa-angle-double-right"></i> Official Damkar</a></li>
                    <li><a href="https://jambikota.go.id/" target="_blank"><i class="fas fa-angle-double-right"></i> Website Jambikota</a></li>
                    <li><a href="https://sikoja.jambikota.go.id/" target="_blank"><i class="fas fa-angle-double-right"></i> SIKOJA</a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer-copyright">
            <div>SIMERAHKOJA © 2026 / ALL RIGHTS RESERVED</div>
            <div class="footer-social">
                <a href="mailto:damkar.jbi@gmail.com" target="_blank" title="Email"><i class="fas fa-envelope"></i></a>
                <a href="https://twitter.com/damkarkotajambi" target="_blank" title="Twitter / X"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com/DamkarKotaJambi" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/@damkarkotajambi" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="https://www.tiktok.com/@damkar.kota.jambi" target="_blank" title="TikTok"><i class="fab fa-tiktok"></i></a>
                <a href="https://www.instagram.com/damkar.kotajambi/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>

    <!-- STRUKTUR MODAL POP-UP -->
    <div id="modalPersyaratan" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h2>Detail Persyaratan SKK Lainnya</h2>
                <button class="modal-close-icon" onclick="tutupModal()">&times;</button>
            </div>
            <div class="modal-body">
                <ol>
                    <li>Menginput Formulir Sertifikat Keamanan Kebakaran secara elektronik melalui simerah.jambikota.go.id</li>
                    <li>Identitas Pemohon/Penangung Jawab &bull; WNI : Scan Asli Kartu Tanda Penduduk (KTP-el) &bull; WNA : Scan Asli Kartu Izin Tinggal Terbatas (KITAS) atau VISA / Paspor</li>
                    <li>Jika dikuasakan Scan Asli Surat kuasa di atas kertas bermaterai sesuai peraturan yang berlaku dan KTP-el orang yang diberi kuasa</li>
                    <li>Jika Usaha Perorangan (Scan Asli) &bull; NPWP Perorangan Jika Badan Usaha (Scan Asli) &bull; Akta pendirian dan perubahan (Kantor Pusat dan Kantor Cabang, jika ada) &bull; SK pengesahan pendirian dan perubahan yang dikeluarkan oleh Kemenkumham &bull; NPWP Badan Usaha</li>
                    <li>Scan Asli Izin Mendirikan Bangunan (IMB)</li>
                    <li style="color: #ef4444; font-weight: 600;">Scan Asli Rekomendasi Proteksi Kebakaran Bangunan Gedung dan Lingkungan</li>
                    <li>Tanda Daftar Keahlian Keselamatan Kebakaran</li>
                    <li>Proposal teknis yang dilengkapi dengan (Scan Asli): &bull; Gambar teknis yang ditandangani oleh Izin Pelaku Teknis Bangunan (IPTB): &bull; As built drawing site plan &bull; As built drawing denah setiap lantai sarana proteksi kebakaran dalam gedung yang meliputi titik fire alarm, titik sprinkler, titik hidran gedung, dan titik APAR &bull; Gambar skematik instalasi proteksi kebakaran (single line diagram) ; &bull; Spesifikasi teknis: &bull; Spesifikasi peralatan dan instalasi sistem proteksi kebakaran &cir; Sistem alarm dan komunikasi darurat &cir; Sistem hidran dan pipa kebakaran &cir; Sistem pompa kebakaran &cir; Sistem sprinkler otomatis &cir; Alat Pemadam Api Ringan (APAR) &bull; Spesifikasi fasilitas sarana jalan keluar atau jalur penyelamatan &bull; Spesifikasi akses penanggulangan kebakaran dan penyelamatan ; &bull; Dokumen penyelenggaraan sistem Manajemen Keselamatan Kebakaran Gedung (MKKG) / SOP ; &bull; Data inventaris pengelolaan dan pemeliharaan Alat Pemadam Api Ringan (APAR) ; &bull; Dokumen pemeliharaan dan laporan pemeriksaan internal sistem proteksi kebakaran oleh pemilik dan pengelola gedung yang memiliki tanda daftar keahlian keselamatan kebakaran</li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal-tutup" onclick="tutupModal()">Tutup</button>
            </div>
        </div>
    </div>

    <!-- SCRIPT (DROPDOWN WILAYAH, MODAL, DAN PREVIEW FILE) -->
    <script>
        // Data Wilayah Kecamatan & Kelurahan Kota Jambi
        const dataWilayah = {
            "Alam Barajo": ["Bagan Pete", "Beliung", "Kenali Besar", "Mayang Mangurai", "Pinang Merah", "Rawa Sari", "Simpang Rimbo"],
            "Danau Sipin": ["Legok", "Murni", "Selamat", "Solok Sipin", "Sungai Putri"],
            "Danau Teluk": ["Olak Kemang", "Pasir Panjang", "Tanjung Pasir", "Tanjung Raden", "Ulu Gedong"],
            "Jambi Selatan": ["Pakuan Baru", "Pasir Putih", "Tambak Sari", "The Hok", "Wijaya Pura"],
            "Jambi Timur": ["Budiman", "Kasang", "Kasang Jaya", "Rajawali", "Sejinjang", "Sulanjana", "Talang Banjar", "Tanjung Pinang", "Tanjung Sari"],
            "Jelutung": ["Cempaka Putih", "Handil Jaya", "Jelutung", "Kebun Handil", "Lebak Bandung", "Payo Lebar", "Talang Jauh"],
            "Kota Baru": ["Kenali Asam", "Kenali Asam Atas", "Kenali Asam Bawah", "Paal Lima", "Simpang Tiga Sipin", "Sukakarya", "Talang Gulo"],
            "Paal Merah": ["Bakung Jaya", "Eka Jaya", "Lingkar Selatan", "Paal Merah", "Payo Selincah", "Talang Bakung"],
            "Pasar Jambi": ["Beringin", "Orang Kayo Hitam", "Pasar Jambi", "Sungai Asam"],
            "Pelayangan": ["Arab Melayu", "Jelmu", "Mudung Laut", "Tahtul Yaman", "Tanjung Johor", "Tengah"],
            "Telanaipura": ["Aur Kenali", "Buluran Kenali", "Pematang Sulur", "Penyengat Rendah", "Simpang Empat Sipin", "Telanaipura", "Teluk Kenali"]
        };

    var header = document.getElementById('siteHeader');
    var toggle = header.querySelector('.nav-toggle');
    var drops = header.querySelectorAll('.has-drop');

            kelurahanSelect.innerHTML = '<option value="" selected disabled>Pilih Kelurahan</option>';

            if (kecamatan && dataWilayah[kecamatan]) {
                dataWilayah[kecamatan].forEach(function(kelurahan) {
                    const option = document.createElement('option');
                    option.value = kelurahan;
                    option.textContent = kelurahan;
                    kelurahanSelect.appendChild(option);
                });
            }
        });

        // Script Menampilkan Nama File
        document.getElementById('file_surat').addEventListener('change', function() {
            const fileLabel = document.getElementById('label_file_surat');
            if (this.files && this.files[0]) {
                fileLabel.innerHTML = `<span style="color:#10b981"><i class="fas fa-check-circle"></i> File: <strong>${this.files[0].name}</strong></span>`;
            }
        });
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.has-drop')) closeDrops(null);
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeDrops(null);
    });

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

    var dataWilayah = @json($dataWilayah);
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

        var modal = document.getElementById("modalPersyaratan");
        function bukaModal() {
            modal.style.display = "block";
        }
        function tutupModal() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Support\Facades\DB;

    $h = function ($v) { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); };

    /* ------------------------------------------------------------
       PENGATURAN HALAMAN (6 TAB PROFIL INSTANSI)
       ------------------------------------------------------------ */
    $tabs = [
        'visi-misi'        => ['url' => '/profil/visi-misi',        'label' => 'Visi Misi',        'ico' => 'fa-bullseye',        'judul' => 'Visi dan Misi'],
        'sotk'             => ['url' => '/profil/sotk',             'label' => 'SOTK',             'ico' => 'fa-sitemap',         'judul' => 'Struktur Organisasi dan Tata Kerja (SOTK)'],
        'tupoksi'          => ['url' => '/profil/tupoksi',          'label' => 'Tupoksi',          'ico' => 'fa-list-check',      'judul' => 'Tugas Pokok dan Fungsi (Tupoksi)'],
        'kepegawaian'      => ['url' => '/profil/kepegawaian',      'label' => 'Kepegawaian',      'ico' => 'fa-id-badge',        'judul' => 'Data dan Dokumen Kepegawaian'],
        'program-kegiatan' => ['url' => '/profil/program-kegiatan', 'label' => 'Program Kegiatan', 'ico' => 'fa-calendar-check',  'judul' => 'Program dan Kegiatan'],
        'cascading'        => ['url' => '/profil/cascading',        'label' => 'Cascading',        'ico' => 'fa-diagram-project', 'judul' => 'Cascading Kinerja'],
    ];

    $segment     = request()->segment(2);
    $tab_aktif   = array_key_exists($segment, $tabs) ? $segment : 'kepegawaian';
    $label_aktif = $tabs[$tab_aktif]['label'];
    $judul_aktif = $tabs[$tab_aktif]['judul'];

    // ============================================================
    // 1. KHUSUS TAB KEPEGAWAIAN: AMBIL DUK, REKAP ASN & DOKUMEN PUBLIK
    // ============================================================
    $duk_list      = collect();
    $rekap_asn     = collect();
    $dokumen_list  = [];

    if ($tab_aktif === 'kepegawaian') {
        // A. Ambil Data Urut Kepangkatan (DUK)
        if (class_exists('\App\Models\Duk')) {
            $duk_list = \App\Models\Duk::orderBy('id', 'asc')->get();
        } elseif (Schema::hasTable('duks')) {
            $duk_list = DB::table('duks')->orderBy('id', 'asc')->get();
        } elseif (Schema::hasTable('duk')) {
            $duk_list = DB::table('duk')->orderBy('id', 'asc')->get();
        }

        // B. Ambil Rekap Data ASN
        if (class_exists('\App\Models\DataAsn')) {
            $rekap_asn = \App\Models\DataAsn::orderBy('id', 'asc')->get();
        } elseif (Schema::hasTable('data_asns')) {
            $rekap_asn = DB::table('data_asns')->orderBy('id', 'asc')->get();
        } elseif (Schema::hasTable('data_asn')) {
            $rekap_asn = DB::table('data_asn')->orderBy('id', 'asc')->get();
        }

        // C. Ambil Dokumen Publik (Kepegawaian)
        $dokPublikDB = collect();
        if (class_exists('\App\Models\DokumenPublik')) {
            $q = \App\Models\DokumenPublik::whereIn('kategori', ['Kepegawaian', 'kepegawaian', 'Dokumen Publik'])->latest()->get();
            $dokPublikDB = $q->isNotEmpty() ? $q : \App\Models\DokumenPublik::whereNotIn('kategori', ['Renstra', 'Renja', 'SPM', 'SAKIP', 'LPPD'])->latest()->get();
        }

        foreach ($dokPublikDB as $doc) {
            $judul_doc = $doc->judul_dokumen ?? $doc->judul ?? $doc->nama_dokumen ?? $doc->nama ?? 'Dokumen Publik';
            $nama_file = $doc->nama_file ?? $doc->file ?? $doc->file_pdf ?? $doc->dokumen ?? '';
            $url_view  = url('/dokumen-publik/view/' . $doc->id);
            $url_dl    = Route::has('publik.dokumen-publik.download')
                         ? route('publik.dokumen-publik.download', $doc->id)
                         : ($nama_file ? asset('storage/' . ltrim($nama_file, '/')) : $url_view);

            $dokumen_list[] = [
                'judul'        => $judul_doc,
                'url'          => $url_view,
                'url_download' => $url_dl,
                'ext'          => pathinfo($nama_file, PATHINFO_EXTENSION) ?: 'PDF'
            ];
        }

        // Gabungkan juga jika ada file yang diunggah lewat ProfilInstansi (kategori kepegawaian)
        if (class_exists('\App\Models\ProfilInstansi')) {
            $profDB = \App\Models\ProfilInstansi::whereIn('kategori', ['kepegawaian', 'Kepegawaian'])->latest()->get();
            foreach ($profDB as $doc) {
                $judul_doc = $doc->judul_dokumen ?? $doc->judul ?? $doc->nama_dokumen ?? 'Dokumen Kepegawaian';
                $nama_file = $doc->nama_file ?? $doc->file ?? $doc->file_pdf ?? '';
                $url_view  = Route::has('publik.profil.view') ? route('publik.profil.view', ['kategori' => 'kepegawaian', 'id' => $doc->id]) : url('/internal/profil-instansi/kepegawaian/' . $doc->id . '/view');
                $url_dl    = Route::has('publik.profil.download') ? route('publik.profil.download', ['kategori' => 'kepegawaian', 'id' => $doc->id]) : url('/internal/profil-instansi/kepegawaian/' . $doc->id . '/download');

                $dokumen_list[] = [
                    'judul'        => $judul_doc,
                    'url'          => $url_view,
                    'url_download' => $url_dl,
                    'ext'          => pathinfo($nama_file, PATHINFO_EXTENSION) ?: 'PDF'
                ];
            }
        }
    } else {
        // ============================================================
        // 2. TAB PROFIL LAINNYA (VISI MISI, SOTK, TUPOKSI, PROGRAM, CASCADING)
        // ============================================================
        $dokumenDB = collect();
        $kandidat  = array_unique([$tab_aktif, $label_aktif, $judul_aktif]);

        if (class_exists('\App\Models\ProfilInstansi')) {
            $dokumenDB = \App\Models\ProfilInstansi::whereIn('kategori', $kandidat)->latest()->get();
        } elseif (Schema::hasTable('profil_instansis')) {
            $dokumenDB = DB::table('profil_instansis')->whereIn('kategori', $kandidat)->orderBy('id', 'desc')->get();
        } elseif (class_exists('\App\Models\Dokumen')) {
            $dokumenDB = \App\Models\Dokumen::where('kategori', 'Profil')->whereIn('sub_kategori', $kandidat)->latest()->get();
        }

        foreach ($dokumenDB as $doc) {
            $judul_doc = $doc->judul_dokumen ?? $doc->judul ?? $doc->nama_dokumen ?? $doc->nama ?? 'Dokumen ' . $label_aktif;
            $nama_file = $doc->nama_file ?? $doc->file ?? $doc->file_pdf ?? $doc->dokumen ?? '';
            $url_view  = Route::has('publik.profil.view') ? route('publik.profil.view', ['kategori' => $tab_aktif, 'id' => $doc->id]) : url('/internal/profil-instansi/' . $tab_aktif . '/' . $doc->id . '/view');
            $url_dl    = Route::has('publik.profil.download') ? route('publik.profil.download', ['kategori' => $tab_aktif, 'id' => $doc->id]) : url('/internal/profil-instansi/' . $tab_aktif . '/' . $doc->id . '/download');

            $dokumen_list[] = [
                'judul'        => $judul_doc,
                'url'          => $url_view,
                'url_download' => $url_dl,
                'ext'          => pathinfo($nama_file, PATHINFO_EXTENSION) ?: 'PDF'
            ];
        }
    }

    $jumlah = count($dokumen_list);

    // Ambil data konten Visi Misi jika pada tab visi-misi
    $visi_teks = 'Mewujudkan Kota Perdagangan dan Jasa yang Bersih, Aman, Harmonis, Agamis, Inovatif dan Sejahtera';
    $misi_list = [
        'Penguatan Kualitas Sumberdaya Manusia;',
        'Penguatan Kapasitas Ekonomi Perkotaan;',
        'Penguatan Tata Kelola Pemerintah Yang Baik;',
        'Penguatan Ketertiban dan Ketentraman Lingkungan serta Partisipasi Masyarakat dalam Pembangunan; dan',
        'Penguatan Pengelolaan Infrastruktur dan Lingkungan Hidup yang Merata, Berkualitas dan Berkelanjutan.',
    ];
    $visi_judul = 'Visi & Misi Kota Jambi';

    if ($tab_aktif === 'visi-misi') {
        $vmRecord = null;
        if (class_exists('\App\Models\ProfilInstansi')) {
            $vmRecord = \App\Models\ProfilInstansi::where('kategori', 'visi-misi')->first();
        } elseif (Schema::hasTable('profil_instansis')) {
            $vmRecord = DB::table('profil_instansis')->where('kategori', 'visi-misi')->first();
        }

        if ($vmRecord) {
            if (!empty($vmRecord->judul)) {
                $visi_judul = $vmRecord->judul;
            }
            $ket = json_decode($vmRecord->keterangan ?? '', true);
            if (is_array($ket)) {
                if (!empty($ket['visi'])) {
                    $visi_teks = $ket['visi'];
                }
                if (!empty($ket['misi']) && is_array($ket['misi'])) {
                    $misi_list = $ket['misi'];
                }
            } elseif (!empty($vmRecord->keterangan)) {
                $visi_teks = $vmRecord->keterangan;
            }
        }
    }

    // Helper untuk merapikan tampilan tabel dinamis (menyembunyikan id & timestamp)
    $filterKolom = function ($row) {
        $arr = (array) $row;
        $skip = ['id', 'created_at', 'updated_at', 'deleted_at', 'user_id', 'password', 'remember_token'];
        $out = [];
        foreach ($arr as $k => $v) {
            if (!in_array(strtolower($k), $skip, true)) {
                $out[$k] = $v;
            }
        }
        return $out;
    };

    // Konfigurasi Kontak Default
    $no_whatsapp    = "628117113113";
    $no_telepon     = "074141171";
    $telepon_tampil = "(0741) 41171";
    $pesan_wa       = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)";
    $wa_link        = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
    $maps_link      = "https://www.google.com/maps/place/6PC59JJ2%2BQ76/@-1.6180875,103.6006406,871m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-1.6180875!4d103.6006406?entry=ttu";
    $play_store_url = "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <meta name="description" content="<?= $h($tabs[$tab_aktif]['judul']) ?> Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.">
    <title><?= $h($tabs[$tab_aktif]['label']) ?> - Profil | SIMERAH KOJA</title>

    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --ink: #0d1b2a; --ink-2: #132a43; --ink-3: #1d3856;
            --paper: #f3f5f8; --white: #ffffff;
            --signal: #e5392d; --signal-d: #c22b20;
            --amber: #ffb627; --steel: #5b6c7f; --line: #dbe2ea;
            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;
            --r-lg: 28px; --r-md: 18px; --r-sm: 10px;
            --wrap: 1300px; --header-h: 64px;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font-body); font-size: 1rem; line-height: 1.65; color: var(--ink); background: var(--white); -webkit-font-smoothing: antialiased; overflow-x: hidden; }
        img { max-width: 100%; display: block; }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
        :focus-visible { outline: 3px solid var(--amber); outline-offset: 3px; border-radius: 6px; }
        .wrap { max-width: var(--wrap); margin: 0 auto; padding-left: clamp(16px, 4vw, 32px); padding-right: clamp(16px, 4vw, 32px); }

        /* HEADER & NAVBAR */
        .site-header { position: sticky; top: 0; z-index: 1000; background: rgba(13, 27, 42, .88); -webkit-backdrop-filter: blur(14px) saturate(1.4); backdrop-filter: blur(14px) saturate(1.4); border-bottom: 1px solid rgba(255,255,255,.08); }
        .nav { max-width: 1440px; margin: 0 auto; min-height: var(--header-h); padding: 0 clamp(16px, 3vw, 32px); display: flex; align-items: center; justify-content: space-between; gap: 24px; }
        .brand { display: flex; align-items: center; flex: none; }
        .brand a { display: flex; align-items: center; }
        .brand a + a { margin-left: 14px; padding-left: 14px; border-left: 1px solid rgba(255,255,255,.16); }
        .brand img { height: 36px; width: auto; }
        .nav-panel { flex: 1; min-width: 0; display: flex; align-items: center; justify-content: space-between; gap: 20px; }
        .menu { display: flex; align-items: center; justify-content: center; gap: 2px; flex: 1; min-width: 0; }
        .menu > li { position: relative; }
        .menu-link, .menu-trigger { position: relative; display: inline-flex; align-items: center; gap: 6px; padding: 10px 11px; color: rgba(255,255,255,.78); font-size: .875rem; font-weight: 500; white-space: nowrap; transition: color .2s; }
        .menu-link::after, .menu-trigger::after { content: ""; position: absolute; left: 11px; right: 11px; bottom: 2px; height: 2px; border-radius: 2px; background: var(--amber); transform: scaleX(0); transform-origin: left; transition: transform .25s ease; }
        .menu-link:hover, .menu-trigger:hover, .has-drop.open > .menu-trigger, .has-drop.current > .menu-trigger, .menu-link.is-active { color: #fff; }
        .menu-link:hover::after, .menu-trigger:hover::after, .has-drop.open > .menu-trigger::after, .has-drop.current > .menu-trigger::after, .menu-link.is-active::after { transform: scaleX(1); }
        .menu-trigger i { font-size: .6rem; opacity: .6; transition: transform .2s, opacity .2s; }
        .has-drop.open > .menu-trigger i { transform: rotate(180deg); opacity: 1; }
        .nav-actions { display: flex; align-items: center; gap: 10px; flex: none; }
        .nav-actions > li { position: relative; }
        .btn-nav { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 16px; border-radius: 999px; font-size: .875rem; font-weight: 600; white-space: nowrap; transition: background .2s, border-color .2s, color .2s, transform .2s; }
        .btn-nav--alert { background: var(--signal); color: #fff; }
        .btn-nav--alert:hover, .has-drop.open > .btn-nav--alert { background: var(--signal-d); }
        .btn-nav--ghost { border: 1.5px solid rgba(255,255,255,.3); color: #fff; }
        .btn-nav--ghost:hover, .has-drop.open > .btn-nav--ghost { border-color: #fff; background: rgba(255,255,255,.08); }
        .dropdown { position: absolute; top: calc(100% + 14px); left: 50%; min-width: 250px; width: max-content; max-width: 320px; background: var(--ink-2); border: 1px solid rgba(255,255,255,.1); border-radius: 16px; padding: 8px; box-shadow: 0 24px 48px rgba(0,0,0,.45); visibility: hidden; opacity: 0; pointer-events: none; transform: translate(-50%, 6px); transition: opacity .18s ease, transform .18s ease, visibility 0s linear .18s; }
        .nav-actions .dropdown { left: auto; right: 0; transform: translate(0, 6px); }
        .dropdown::before { content: ""; position: absolute; left: 0; right: 0; top: -14px; height: 14px; }
        .dropdown::after { content: ""; position: absolute; top: -6px; left: 50%; width: 10px; height: 10px; margin-left: -5px; background: var(--ink-2); border-top: 1px solid rgba(255,255,255,.1); border-left: 1px solid rgba(255,255,255,.1); transform: rotate(45deg); }
        .nav-actions .dropdown::after { left: auto; right: 24px; margin-left: 0; }
        .has-drop.open > .dropdown { visibility: visible; opacity: 1; pointer-events: auto; transform: translate(-50%, 0); transition-delay: 0s; }
        .nav-actions .has-drop.open > .dropdown { transform: translate(0, 0); }
        .dropdown a, .dropdown .btn-logout { display: flex; align-items: center; gap: 12px; width: 100%; padding: 10px 14px; border-radius: var(--r-sm); font-size: .9rem; line-height: 1.4; color: rgba(255,255,255,.85); text-align: left; transition: background .15s, color .15s; }
        .dropdown a:hover, .dropdown a[aria-current="page"] { background: rgba(255,255,255,.08); color: #fff; }
        .dropdown a i { width: 18px; text-align: center; font-size: 1rem; flex: none; }
        .dropdown a .fa-phone-alt { color: #38bdf8; } .dropdown a .fa-whatsapp { color: #25d366; } .dropdown a .fa-headset { color: #f87171; }
        .dropdown .btn-logout { color: #ff8b8b; cursor: pointer; }
        .has-sub { position: relative; }
        .has-sub > .sub-trigger { width: 100%; display: flex; align-items: center; justify-content: space-between; gap: 10px; padding: 10px 14px; border-radius: var(--r-sm); font-size: .9rem; color: rgba(255,255,255,.85); }
        .dropdown-sub { display: none; position: absolute; top: -8px; left: 100%; min-width: 230px; margin-left: 6px; z-index: 10; background: var(--ink-2); border: 1px solid rgba(255,255,255,.1); border-radius: 16px; padding: 8px; box-shadow: 0 24px 48px rgba(0,0,0,.45); }
        .has-sub.open > .dropdown-sub { display: block; }
        .nav-toggle { display: none; width: 44px; height: 44px; border-radius: 12px; color: #fff; font-size: 1.15rem; align-items: center; justify-content: center; }

        @media (hover: hover) and (min-width: 1201px) {
            .has-drop:hover > .dropdown { visibility: visible; opacity: 1; pointer-events: auto; transform: translate(-50%, 0); transition-delay: 0s; }
            .nav-actions .has-drop:hover > .dropdown { transform: translate(0, 0); }
            .has-drop:hover > .menu-trigger { color: #fff; }
            .has-drop:hover > .menu-trigger::after { transform: scaleX(1); }
            .has-sub:hover > .dropdown-sub { display: block; }
            .dropdown-sub { left: auto; right: 100%; margin-left: 0; margin-right: 6px; }
        }
        @media (max-width: 1200px) {
            .nav-toggle { display: inline-flex; margin-left: auto; }
            .nav-panel { display: none; position: absolute; top: 100%; left: 0; right: 0; max-height: calc(100dvh - var(--header-h)); overflow-y: auto; flex-direction: column; align-items: stretch; gap: 20px; padding: 8px clamp(16px, 4vw, 32px) 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.1); }
            .nav-open .nav-panel { display: flex; }
            .menu { flex-direction: column; align-items: stretch; gap: 0; }
            .menu > li { border-bottom: 1px solid rgba(255,255,255,.08); }
            .menu-link, .menu-trigger { width: 100%; justify-content: space-between; padding: 16px 4px; font-size: 1rem; }
            .menu-link::after, .menu-trigger::after { display: none; }
            .dropdown, .nav-actions .dropdown, .dropdown-sub { display: none; position: static; width: auto; max-width: none; margin: 0 0 12px 4px; padding: 0 0 0 12px; background: transparent; border: 0; border-left: 2px solid rgba(255,255,255,.14); border-radius: 0; box-shadow: none; visibility: visible; opacity: 1; pointer-events: auto; transform: none; }
            .dropdown::before, .dropdown::after { display: none; }
            .has-drop.open > .dropdown, .has-sub.open > .dropdown-sub { display: block; transform: none; }
        }

        /* HERO */
        .page-hero { position: relative; isolation: isolate; color: #fff; background: var(--ink); overflow: hidden; padding: clamp(36px, 6vw, 72px) 0 clamp(72px, 10vw, 112px); }
        .page-hero::before { content: ""; position: absolute; inset: 0; z-index: -1; background: radial-gradient(55% 90% at 0% 100%, rgba(229,57,45,.4), transparent 70%), linear-gradient(100deg, rgba(13,27,42,.97) 0%, rgba(13,27,42,.86) 55%, rgba(13,27,42,.7) 100%), url('/images/background1.png') center / cover no-repeat; }
        .crumbs { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; font-size: .9rem; color: rgba(255,255,255,.7); margin-bottom: clamp(18px, 3vw, 28px); }
        .crumbs li { display: inline-flex; align-items: center; gap: 10px; }
        .crumbs li + li::before { content: "\203A"; opacity: .5; font-size: 1.1rem; }
        .crumbs [aria-current="page"] { color: #fff; font-weight: 600; }
        .page-hero h1 { font-family: var(--font-display); font-weight: 800; font-stretch: 82%; font-size: clamp(2.8rem, 8vw, 5.5rem); line-height: .95; letter-spacing: -0.035em; }
        .page-hero p { margin-top: 18px; max-width: 56ch; color: rgba(255,255,255,.75); font-size: clamp(1rem, 1.5vw, 1.15rem); }

        /* TABS & LAYOUT */
        .page-body { background: var(--paper); padding-bottom: clamp(64px, 9vw, 112px); }
        .tabs-wrap { position: relative; z-index: 2; margin-top: -30px; display: flex; justify-content: center; }
        .tabs { display: flex; flex-wrap: nowrap; gap: 4px; padding: 6px; max-width: 100%; background: #fff; border: 1px solid var(--line); border-radius: 999px; box-shadow: 0 18px 36px -20px rgba(13,27,42,.45); overflow-x: auto; scrollbar-width: none; }
        .tabs::-webkit-scrollbar { display: none; }
        .tab { flex: 0 0 auto; display: inline-flex; align-items: center; gap: 8px; white-space: nowrap; padding: 10px 15px; border-radius: 999px; font-weight: 600; font-size: .88rem; color: var(--steel); transition: background .2s, color .2s; }
        .tab:hover { background: var(--paper); color: var(--ink); }
        .tab[aria-current="page"] { background: var(--ink); color: #fff; }
        .tab[aria-current="page"] i { color: var(--amber); }

        .doc-layout { display: grid; gap: 28px; margin-top: 28px; }
        .doc-panel { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); overflow: hidden; }
        .doc-bar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px 20px; padding: 16px clamp(16px, 2.5vw, 26px); border-bottom: 1px solid var(--line); }
        .doc-title { display: flex; align-items: center; gap: 12px; font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; }
        .doc-title i { flex: none; width: 38px; height: 38px; border-radius: 12px; display: grid; place-items: center; background: var(--ink); color: var(--amber); font-size: .95rem; }
        .doc-filter { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; }
        .doc-count { padding: 6px 14px; border-radius: 999px; background: var(--paper); font-size: .85rem; font-weight: 600; color: var(--steel); }
        .doc-search { position: relative; display: block; }
        .doc-search i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--steel); font-size: .85rem; pointer-events: none; }
        .doc-search input { width: min(260px, 100%); height: 40px; padding: 0 16px 0 40px; border: 1px solid var(--line); border-radius: 999px; background: #fff; font: inherit; font-size: .9rem; }

        /* VISI & MISI KOTA JAMBI CARDS */
        .vm-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; align-items: stretch; }
        .vm-card { border-radius: var(--r-md); padding: clamp(24px, 3.5vw, 36px); display: flex; flex-direction: column; transition: transform .35s cubic-bezier(.16,.84,.3,1), box-shadow .35s ease, border-color .35s ease; }
        .vm-card--visi { background: linear-gradient(145deg, #f0f4f9 0%, #e2ebf5 100%); border: 1.5px solid #cbd8e6; box-shadow: 0 10px 25px -10px rgba(13,27,42,.08); }
        .vm-card--misi { background: #ffffff; border: 1.5px solid var(--line); box-shadow: 0 10px 25px -10px rgba(13,27,42,.05); }
        .vm-header { display: flex; align-items: center; gap: 14px; margin-bottom: 22px; padding-bottom: 14px; border-bottom: 1.5px dashed rgba(13,27,42,.12); }
        .vm-card--misi .vm-header { border-bottom-color: var(--line); }
        .vm-icon { width: 44px; height: 44px; border-radius: 12px; display: grid; place-items: center; font-size: 1.2rem; flex: none; }
        .vm-card--visi .vm-icon { background: var(--ink); color: var(--amber); }
        .vm-card--misi .vm-icon { background: rgba(229,57,45,.1); color: var(--signal-d); }
        .vm-title { font-family: var(--font-display); font-weight: 800; font-size: 1.5rem; color: var(--ink); letter-spacing: -0.01em; }
        .vm-visi-body { flex: 1; display: flex; flex-direction: column; justify-content: center; position: relative; padding: 12px 6px; }
        .vm-quote-icon { font-size: 2.2rem; line-height: 1; color: rgba(13,27,42,.15); margin-bottom: 12px; }
        .vm-visi-text { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.2rem, 1.8vw, 1.45rem); line-height: 1.55; color: var(--ink); font-style: italic; }
        .vm-misi-list { display: flex; flex-direction: column; gap: 14px; margin: 0; padding: 0; list-style: none; }
        .vm-misi-item { display: flex; align-items: flex-start; gap: 14px; }
        .vm-misi-badge { flex: none; width: 30px; height: 30px; border-radius: 8px; background: var(--paper); border: 1px solid var(--line); color: var(--ink); font-weight: 700; font-size: .88rem; display: grid; place-items: center; margin-top: 2px; }
        .vm-misi-item:hover .vm-misi-badge { background: var(--signal); border-color: var(--signal); color: #fff; }
        .vm-misi-text { font-size: 1rem; line-height: 1.55; color: var(--ink); font-weight: 500; }

        @media (max-width: 900px) {
            .vm-grid { grid-template-columns: 1fr; gap: 20px; }
        }
        @media (hover: hover) and (prefers-reduced-motion: no-preference) {
            .vm-card:hover { transform: translateY(-4px); box-shadow: 0 20px 38px -18px rgba(13,27,42,.18); }
        }

        /* TABEL DATA DUK & REKAP ASN */
        .table-wrap { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .data-table { width: 100%; border-collapse: collapse; font-size: .92rem; text-align: left; }
        .data-table th { background: var(--ink); color: #fff; font-weight: 600; font-size: .82rem; text-transform: uppercase; letter-spacing: .04em; padding: 14px 18px; white-space: nowrap; }
        .data-table td { padding: 14px 18px; border-bottom: 1px solid var(--line); color: var(--ink); vertical-align: middle; }
        .data-table tbody tr:last-child td { border-bottom: 0; }
        .data-table tbody tr:hover { background: var(--paper); }
        .data-table .col-no { width: 56px; text-align: center; font-weight: 700; color: var(--steel); }

        /* DAFTAR DOKUMEN */
        .doc-row { position: relative; display: grid; grid-template-columns: 52px minmax(0, 1fr) auto; gap: 18px; align-items: center; padding: 18px clamp(16px, 2.5vw, 26px); border-bottom: 1px solid var(--line); transition: background .2s; }
        .doc-row:last-child { border-bottom: 0; }
        .doc-row[hidden], .duk-row[hidden] { display: none; }
        .doc-row:not(.is-empty):hover { background: var(--paper); }
        .doc-ico { width: 52px; height: 52px; border-radius: 14px; display: grid; place-items: center; background: #fdeceb; color: var(--signal-d); font-size: 1.4rem; }
        .doc-name { font-family: var(--font-display); font-weight: 600; font-size: 1.1rem; line-height: 1.35; }
        .doc-name a::after { content: ""; position: absolute; inset: 0; }
        .doc-row:not(.is-empty):hover .doc-name a { color: var(--signal-d); }
        .doc-meta { margin-top: 2px; font-size: .85rem; color: var(--steel); }
        .doc-actions { position: relative; z-index: 1; display: flex; gap: 8px; }
        .tool { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 16px; border-radius: 999px; background: var(--paper); font-size: .88rem; font-weight: 600; transition: background .2s, color .2s; }
        .tool:hover { background: var(--ink); color: #fff; }
        .doc-empty { min-height: 220px; display: grid; place-content: center; justify-items: center; gap: 6px; padding: 36px 24px; text-align: center; color: var(--steel); background: repeating-linear-gradient(135deg, var(--paper) 0 14px, #eaeef3 14px 28px); }
        .doc-empty i { font-size: 2rem; color: #b8c3d0; margin-bottom: 6px; }
        .doc-empty h3 { font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; color: var(--ink); }

        /* KONTAK & FOOTER */
        .side-card { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: clamp(20px, 3vw, 28px); }
        .side-card h2 { font-family: var(--font-display); font-weight: 700; font-size: 1.35rem; margin-bottom: 20px; }
        .contact-list { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px 32px; }
        .contact-list li { display: grid; grid-template-columns: 40px 1fr; gap: 14px; align-items: start; }
        .c-ico { width: 40px; height: 40px; border-radius: 12px; display: grid; place-items: center; background: var(--paper); color: var(--signal-d); }
        .contact-list small { display: block; font-size: .8rem; color: var(--steel); margin-bottom: 2px; }
        .contact-list a { font-weight: 600; font-size: .95rem; }
        .social-title { margin: 24px 0 12px; padding-top: 20px; border-top: 1px solid var(--line); font-size: .85rem; color: var(--steel); }
        .social { display: flex; flex-wrap: wrap; gap: 8px; }
        .social a { width: 42px; height: 42px; border-radius: 12px; display: grid; place-items: center; background: var(--paper); color: var(--ink); transition: background .2s, color .2s, transform .2s; }
        .social a:hover { background: var(--signal); color: #fff; transform: translateY(-3px); }

        .footer { background: var(--ink); color: rgba(255,255,255,.7); padding: clamp(56px, 8vw, 96px) 0 32px; }
        .footer-grid { display: grid; grid-template-columns: 1.1fr 1.2fr .8fr; gap: clamp(32px, 5vw, 64px); }
        .footer h3 { font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; color: #fff; margin-bottom: 16px; }
        .footer-about img { height: 96px; width: auto; margin-bottom: 20px; }
        .map { position: relative; height: 190px; border-radius: var(--r-md); overflow: hidden; background: var(--ink-2); }
        .map iframe { width: 100%; height: 100%; border: 0; pointer-events: none; }
        .map-link { position: absolute; inset: 0; z-index: 2; display: flex; align-items: flex-end; justify-content: flex-end; padding: 12px; }
        .map-link span { display: inline-flex; align-items: center; gap: 8px; padding: 8px 14px; border-radius: 999px; background: var(--signal); color: #fff; font-size: .85rem; font-weight: 700; }
        .find { margin-top: 14px; display: inline-flex; align-items: center; gap: 10px; font-weight: 600; color: #fff; }
        .footer-links li + li { margin-top: 8px; }
        .footer-links a { display: flex; align-items: center; gap: 10px; padding: 6px 0; font-size: .95rem; }
        .footer-bar { margin-top: clamp(40px, 6vw, 72px); padding-top: 28px; border-top: 1px solid rgba(255,255,255,.1); display: flex; flex-wrap: wrap; gap: 20px; justify-content: space-between; align-items: center; font-size: .88rem; }
        .footer .social a { background: rgba(255,255,255,.08); color: #fff; }
        @media (max-width: 900px) { .footer-grid { grid-template-columns: 1fr; } }
        @media (max-width: 768px) {
            .table-wrap { border: 1px solid var(--line); border-radius: var(--r-sm); }
            .data-table th.col-no, .data-table td.col-no { position: sticky; left: 0; z-index: 2; background: var(--paper); }
            .data-table th.col-no { background: var(--ink); }
            .data-table th:nth-child(2), .data-table td:nth-child(2) { position: sticky; left: 56px; z-index: 2; background: #fff; box-shadow: 3px 0 6px -2px rgba(0,0,0,.1); }
            .data-table th:nth-child(2) { background: var(--ink); }
            .data-table tr:hover td:nth-child(2) { background: var(--paper); }
        }
        @media (max-width: 640px) {
            .doc-row { grid-template-columns: 52px minmax(0, 1fr); }
            .doc-actions { grid-column: 1 / -1; }
            .doc-actions .tool { flex: 1; }
        }

        .beacon { position: relative; width: 12px; height: 12px; border-radius: 50%; background: #fff; flex: none; }
        .beacon::after { content: ""; position: absolute; inset: 0; border-radius: 50%; background: #fff; animation: ping 1.8s cubic-bezier(0,0,.2,1) infinite; }
        @keyframes ping { 0% { transform: scale(1); opacity: .7; } 100% { transform: scale(3.2); opacity: 0; } }
        .sos-fab { position: fixed; right: clamp(14px, 3vw, 28px); bottom: clamp(14px, 3vw, 28px); z-index: 70; display: flex; flex-direction: column; align-items: flex-end; gap: 12px; opacity: 0; visibility: hidden; transform: translateY(16px); transition: .3s; }
        .sos-fab.show { opacity: 1; visibility: visible; transform: none; }
        .sos-fab-btn { display: inline-flex; align-items: center; gap: 10px; padding: 14px 22px; border-radius: 999px; background: var(--signal); color: #fff; font-weight: 700; box-shadow: 0 14px 30px -6px rgba(229,57,45,.6); }
        .sos-sheet { display: none; width: min(320px, calc(100vw - 28px)); padding: 8px; border-radius: 20px; background: var(--ink); border: 1px solid rgba(255,255,255,.12); box-shadow: 0 24px 48px rgba(0,0,0,.45); }
        .sos-fab.open .sos-sheet { display: grid; gap: 6px; }
        .sos-sheet a { display: flex; align-items: center; gap: 14px; padding: 13px 14px; border-radius: 14px; color: #fff; font-weight: 600; }
        .sr-only { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0 0 0 0); white-space: nowrap; }

        /* ==========================================================
           ANIMASI HOVER KARTU / KONTAINER
           ========================================================== */
        .doc-panel, .side-card { transition: transform .35s cubic-bezier(.16,.84,.3,1), box-shadow .35s ease, border-color .35s ease; }
        .doc-row { transition: background .25s ease, box-shadow .25s ease; }
        .doc-ico, .c-ico, .doc-title i { transition: transform .3s cubic-bezier(.34,1.56,.64,1), background .25s, color .25s; }
        .tool { transition: background .2s, color .2s, transform .2s; }
        @media (hover: hover) and (prefers-reduced-motion: no-preference) {
            .doc-panel:hover, .side-card:hover { transform: translateY(-4px); border-color: #c9d3de; box-shadow: 0 22px 44px -24px rgba(13,27,42,.35); }
            .doc-row:not(.is-empty):hover { box-shadow: inset 4px 0 0 var(--signal); }
            .doc-row:not(.is-empty):hover .doc-ico { transform: scale(1.08) rotate(-4deg); background: var(--signal); color: #fff; }
            .doc-panel:hover .doc-title i { transform: rotate(-8deg) scale(1.06); }
            .contact-list li:hover .c-ico { transform: translateY(-3px); background: var(--signal); color: #fff; }
            .tool:hover { transform: translateY(-2px); }
        }
    </style>
</head>
<body>

@include('layouts.partials.public-header')

<main>

<section class="page-hero">
    <div class="wrap">
        <nav aria-label="Breadcrumb">
            <ol class="crumbs">
                <li><a href="/">Beranda</a></li>
                <li><a href="/profil/visi-misi">Profil</a></li>
                <li><span aria-current="page"><?= $h($tab_aktif === 'visi-misi' ? $visi_judul : $tabs[$tab_aktif]['label']) ?></span></li>
            </ol>
        </nav>
        <h1><?= $h($tab_aktif === 'visi-misi' ? $visi_judul : $tabs[$tab_aktif]['label']) ?></h1>
        <p><?= $h($tab_aktif === 'visi-misi' ? 'Visi dan Misi Pembangunan Kota Jambi Dinas Pemadam Kebakaran dan Penyelamatan.' : ($tabs[$tab_aktif]['judul'] . ' Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.')) ?></p>
    </div>
    @include('layouts.partials.hero-logos', ['float' => true])
</section>

<div class="page-body">
    <div class="wrap tabs-wrap">
        <nav class="tabs" aria-label="Kategori Profil">
            <?php foreach ($tabs as $key => $tab): ?>
                <a class="tab" href="<?= $h($tab['url']) ?>" <?php if ($key === $tab_aktif): ?> aria-current="page" <?php endif; ?>>
                    <i class="fas <?= $h($tab['ico']) ?>"></i> <?= $h($tab['label']) ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>

    <div class="wrap">
        <div class="doc-layout">

            <?php if ($tab_aktif === 'visi-misi'): ?>
                <!-- ==============================================
                     KARTU TAMPILAN VISI & MISI KOTA JAMBI
                     ============================================== -->
                <div class="vm-grid" aria-label="Visi dan Misi Kota Jambi">
                    <!-- Kartu Visi -->
                    <div class="vm-card vm-card--visi">
                        <div class="vm-header">
                            <span class="vm-icon"><i class="fas fa-bullseye"></i></span>
                            <h2 class="vm-title">Visi</h2>
                        </div>
                        <div class="vm-visi-body">
                            <span class="vm-quote-icon"><i class="fas fa-quote-left"></i></span>
                            <blockquote class="vm-visi-text">
                                &ldquo; <?= $h($visi_teks) ?> &bdquo;
                            </blockquote>
                        </div>
                    </div>

                    <!-- Kartu Misi -->
                    <div class="vm-card vm-card--misi">
                        <div class="vm-header">
                            <span class="vm-icon"><i class="fas fa-list-ol"></i></span>
                            <h2 class="vm-title">Misi</h2>
                        </div>
                        <ol class="vm-misi-list">
                            <?php foreach ($misi_list as $idx => $misi_item): ?>
                            <li class="vm-misi-item">
                                <span class="vm-misi-badge"><?= $idx + 1 ?></span>
                                <span class="vm-misi-text"><?= $h($misi_item) ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>

            <?php elseif ($tab_aktif === 'kepegawaian'): ?>
                <!-- ==============================================
                     PANEL 1: DATA URUT KEPEGAWAIAN (DUK)
                     ============================================== -->
                <section class="doc-panel" aria-label="Data Urut Kepegawaian">
                    <div class="doc-bar">
                        <div class="doc-title">
                            <i class="fas fa-user-tie"></i>
                            <span>Data Urut Kepegawaian (DUK)</span>
                        </div>
                        <div class="doc-filter">
                            <span class="doc-count" id="dukCount"><?= $duk_list->count() ?> pegawai</span>
                            <?php if ($duk_list->count() > 5): ?>
                            <label class="doc-search">
                                <span class="sr-only">Cari pegawai</span>
                                <i class="fas fa-search"></i>
                                <input type="search" id="dukSearch" placeholder="Cari pegawai..." autocomplete="off">
                            </label>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if ($duk_list->isNotEmpty()):
                        $firstDuk = $filterKolom($duk_list->first());
                        $dukCols  = array_keys($firstDuk);
                    ?>
                    <div class="table-wrap">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th class="col-no">No</th>
                                    <?php foreach ($dukCols as $col): ?>
                                        <th><?= $h(ucwords(str_replace('_', ' ', $col))) ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($duk_list as $idx => $row):
                                    $cols = $filterKolom($row);
                                    $searchText = mb_strtolower(implode(' ', array_values($cols)));
                                ?>
                                <tr class="duk-row" data-search="<?= $h($searchText) ?>">
                                    <td class="col-no"><?= $idx + 1 ?></td>
                                    <?php foreach ($cols as $val): ?>
                                        <td><?= $h($val ?? '-') ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="doc-empty">
                        <i class="fas fa-user-clock"></i>
                        <h3>Belum ada Data Urut Kepegawaian</h3>
                        <p>Data DUK akan tampil di sini setelah diinput melalui dashboard kepegawaian.</p>
                    </div>
                    <?php endif; ?>
                </section>

                <!-- ==============================================
                     PANEL 2: REKAP DATA ASN
                     ============================================== -->
                <section class="doc-panel" aria-label="Rekap Data ASN">
                    <div class="doc-bar">
                        <div class="doc-title">
                            <i class="fas fa-users"></i>
                            <span>Rekap Data ASN</span>
                        </div>
                        <div class="doc-filter">
                            <span class="doc-count"><?= $rekap_asn->count() ?> data</span>
                        </div>
                    </div>

                    <?php if ($rekap_asn->isNotEmpty()):
                        $firstAsn = $filterKolom($rekap_asn->first());
                        $asnCols  = array_keys($firstAsn);
                    ?>
                    <div class="table-wrap">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th class="col-no">No</th>
                                    <?php foreach ($asnCols as $col): ?>
                                        <th><?= $h(ucwords(str_replace('_', ' ', $col))) ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rekap_asn as $idx => $row):
                                    $cols = $filterKolom($row);
                                ?>
                                <tr>
                                    <td class="col-no"><?= $idx + 1 ?></td>
                                    <?php foreach ($cols as $val): ?>
                                        <td><?= $h($val ?? '-') ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="doc-empty">
                        <i class="fas fa-chart-pie"></i>
                        <h3>Belum ada Rekap Data ASN</h3>
                        <p>Rekapitulasi data ASN akan tampil di sini setelah ditambahkan oleh petugas.</p>
                    </div>
                    <?php endif; ?>
                </section>
            <?php endif; ?>

            <?php if ($tab_aktif !== 'visi-misi'): ?>
            <!-- ==============================================
                 PANEL DOKUMEN (DOKUMEN PUBLIK / DOKUMEN PROFIL)
                 ============================================== -->
            <section class="doc-panel" aria-label="Daftar dokumen">
                <div class="doc-bar">
                    <div class="doc-title">
                        <i class="fas <?= $h($tab_aktif === 'kepegawaian' ? 'fa-file-lines' : $tabs[$tab_aktif]['ico']) ?>"></i>
                        <span><?= $h($tab_aktif === 'kepegawaian' ? 'Dokumen Publik Kepegawaian' : $tabs[$tab_aktif]['judul']) ?></span>
                    </div>
                    <div class="doc-filter">
                        <?php if ($jumlah): ?>
                        <span class="doc-count" id="docCount"><?= (int) $jumlah ?> dokumen</span>
                        <?php endif; ?>
                        <?php if ($jumlah > 5): ?>
                        <label class="doc-search">
                            <span class="sr-only">Cari dokumen</span>
                            <i class="fas fa-search"></i>
                            <input type="search" id="docSearch" placeholder="Cari dokumen..." autocomplete="off">
                        </label>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($jumlah): ?>
                <ul class="doc-list">
                    <?php foreach ($dokumen_list as $d):
                        $judul        = (string) ($d['judul'] ?? '');
                        $url          = (string) ($d['url'] ?? '');
                        $url_download = (string) ($d['url_download'] ?? $url);
                        $ada          = $url !== '';
                        $ext          = strtoupper($d['ext'] ?? 'PDF') ?: 'PDF';
                        $ico          = ['PDF' => 'fa-file-pdf', 'DOC' => 'fa-file-word', 'DOCX' => 'fa-file-word', 'XLS' => 'fa-file-excel', 'XLSX' => 'fa-file-excel'][$ext] ?? 'fa-file-lines';
                    ?>
                    <li class="doc-row <?= $ada ? '' : 'is-empty' ?>" data-name="<?= $h(mb_strtolower($judul)) ?>">
                        <span class="doc-ico"><i class="fas <?= $h($ada ? $ico : 'fa-file-circle-question') ?>"></i></span>
                        <div>
                            <p class="doc-name">
                                <?php if ($ada): ?>
                                    <a href="<?= $h($url) ?>" target="_blank" rel="noopener"><?= $h($judul) ?></a>
                                <?php else: ?>
                                    <?= $h($judul) ?>
                                <?php endif; ?>
                            </p>
                            <p class="doc-meta"><?= $ada ? 'Dokumen ' . $h($ext) : 'Berkas belum diunggah' ?></p>
                        </div>
                        <?php if ($ada): ?>
                        <div class="doc-actions">
                            <a class="tool" href="<?= $h($url) ?>" target="_blank" rel="noopener"><i class="fas fa-arrow-up-right-from-square"></i> Buka</a>
                            <a class="tool" href="<?= $h($url_download) ?>"><i class="fas fa-download"></i> Unduh</a>
                        </div>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                <div class="doc-empty">
                    <i class="far fa-folder-open"></i>
                    <h3>Belum ada dokumen</h3>
                    <p>Dokumen akan tampil di sini setelah petugas mengunggahnya melalui dashboard.</p>
                </div>
                <?php endif; ?>
            </section>
            <?php endif; ?>

            <!-- Kontak Dinas -->
            <aside aria-label="Kontak dinas">
                <div class="side-card">
                    <h2>Kontak dinas</h2>
                    <ul class="contact-list">
                        <li>
                            <span class="c-ico"><i class="fas fa-envelope-open-text"></i></span>
                            <div>
                                <small>Email resmi</small>
                                <a href="mailto:damkar.jbi@gmail.com">damkar.jbi@gmail.com</a>
                            </div>
                        </li>
                        <li>
                            <span class="c-ico"><i class="fas fa-phone-alt"></i></span>
                            <div>
                                <small>Telepon</small>
                                <a href="tel:<?= $h($no_telepon) ?>"><?= $h($telepon_tampil) ?></a>
                            </div>
                        </li>
                        <li>
                            <span class="c-ico"><i class="fas fa-map-marker-alt"></i></span>
                            <div>
                                <small>Alamat kantor</small>
                                <a href="<?= $h($maps_link) ?>" target="_blank" rel="noopener">Jl. HOS. Cokroaminoto, Suka Karya, Kec. Kota Baru</a>
                            </div>
                        </li>
                    </ul>

                    <p class="social-title">Ikuti kami</p>
                    <div class="social">
                        <a href="mailto:damkar.jbi@gmail.com" aria-label="Email"><i class="fas fa-envelope"></i></a>
                        <a href="https://twitter.com/damkarkotajambi" target="_blank" rel="noopener" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.facebook.com/DamkarKotaJambi" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.youtube.com/@damkarkotajambi" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.tiktok.com/@damkar.kota.jambi" target="_blank" rel="noopener" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                        <a href="https://www.instagram.com/damkar.kotajambi/" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</div>

</main>

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
                    <iframe title="Lokasi Dinas Pemadam Kebakaran Kota Jambi" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.202353147814!2d103.600648!3d-1.618096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e22c8c6a234f6b1%3A0x4d537f0a82384f88!2sDinas%20Pemadam%20Kebakaran%20Kota%20Jambi!5e1!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" tabindex="-1" loading="lazy"></iframe>
                    <a class="map-link" href="<?= $h($maps_link) ?>" target="_blank" rel="noopener">
                        <span><i class="fas fa-location-arrow"></i> Buka di Google Maps</span>
                    </a>
                </div>
                <a class="find" href="<?= $h($maps_link) ?>" target="_blank" rel="noopener"><i class="fas fa-map-marker-alt"></i> Temukan kami di peta</a>
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
        </div>
    </div>
</footer>

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
    var header = document.getElementById('siteHeader');
    var toggle = header.querySelector('.nav-toggle');
    var drops = header.querySelectorAll('.has-drop');
    var subs = header.querySelectorAll('.has-sub');
    var desktop = window.matchMedia('(hover: hover) and (min-width: 1201px)');

    function triggerOf(li) { return li.querySelector(':scope > .menu-trigger, :scope > .menu-trigger-cta'); }
    function closeSubs() { subs.forEach(function (s) { s.classList.remove('open'); s.querySelector('.sub-trigger').setAttribute('aria-expanded', 'false'); }); }
    function closeDrops(except) {
        drops.forEach(function (li) { if (li !== except) { li.classList.remove('open'); triggerOf(li).setAttribute('aria-expanded', 'false'); } });
        if (!except) closeSubs();
    }
    toggle.addEventListener('click', function () {
        var open = header.classList.toggle('nav-open');
        toggle.setAttribute('aria-expanded', open);
        toggle.querySelector('i').className = open ? 'fas fa-times' : 'fas fa-bars';
        if (!open) closeDrops(null);
    });
    drops.forEach(function (li) {
        var btn = triggerOf(li);
        btn.addEventListener('click', function () { var open = li.classList.toggle('open'); btn.setAttribute('aria-expanded', open); closeDrops(li); });
        li.addEventListener('mouseleave', function () { if (desktop.matches) { li.classList.remove('open'); btn.setAttribute('aria-expanded', 'false'); closeSubs(); } });
    });
    subs.forEach(function (li) {
        var btn = li.querySelector('.sub-trigger');
        btn.addEventListener('click', function (e) { e.preventDefault(); e.stopPropagation(); var open = li.classList.toggle('open'); btn.setAttribute('aria-expanded', open); });
    });
    document.addEventListener('click', function (e) { if (!e.target.closest('.has-drop')) closeDrops(null); });

    /* Pencarian Dokumen */
    var docSearch = document.getElementById('docSearch');
    if (docSearch) {
        var rows = document.querySelectorAll('.doc-row');
        var count = document.getElementById('docCount');
        docSearch.addEventListener('input', function () {
            var q = docSearch.value.trim().toLowerCase(), n = 0;
            rows.forEach(function (r) { var hit = r.dataset.name.indexOf(q) !== -1; r.hidden = !hit; if (hit) n++; });
            if (count) count.textContent = n + ' dokumen';
        });
    }

    /* Pencarian Pegawai DUK */
    var dukSearch = document.getElementById('dukSearch');
    if (dukSearch) {
        var dukRows = document.querySelectorAll('.duk-row');
        var dukCount = document.getElementById('dukCount');
        dukSearch.addEventListener('input', function () {
            var q = dukSearch.value.trim().toLowerCase(), n = 0;
            dukRows.forEach(function (r) { var hit = r.dataset.search.indexOf(q) !== -1; r.hidden = !hit; if (hit) n++; });
            if (dukCount) dukCount.textContent = n + ' pegawai';
        });
    }
})();
</script>
</body>
</html>
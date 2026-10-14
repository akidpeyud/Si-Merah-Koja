<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Support\Facades\DB;

    $h = function ($v) { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); };

    /* ------------------------------------------------------------
       PENGATURAN HALAMAN PROFIL
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
    // PENGAMBILAN DATA
    // ============================================================
    $rekap_asn    = collect();
    $rekap_info   = ['sumber' => null, 'dicek' => []];
    $dokumen_list = [];

    if ($tab_aktif === 'kepegawaian') {
        /* Isi manual HANYA jika nama tabel di dashboard internal sudah pasti.
           Contoh: $rekap_tabel_manual = 'rekap_asn';
           Jika dikosongkan, sistem mencari sendiri tabel yang punya kolom pns & pppk. */
        $rekap_tabel_manual   = 'data_asns';
        $rekap_koneksi_manual = null; // isi nama koneksi (config/database.php) jika dashboard memakai DB lain

        $punyaKolomAsn = function ($tabel) {
            try { $kolom = array_map('strtolower', Schema::getColumnListing($tabel)); }
            catch (\Throwable $e) { return false; }
            $pns = $pppk = false;
            foreach ($kolom as $k) {
                if (strpos($k, 'pppk') !== false) { $pppk = true; }
                elseif (strpos($k, 'pns') !== false) { $pns = true; }
            }
            return $pns && $pppk;
        };

        $daftarTabel = function () {
            try { return collect(Schema::getTables())->pluck('name')->all(); } catch (\Throwable $e) {}
            try {
                return collect(DB::select('SHOW TABLES'))->map(function ($r) { return array_values((array) $r)[0]; })->all();
            } catch (\Throwable $e) {}
            return [];
        };

        $query = null;

        // (a) tabel manual
        if ($rekap_tabel_manual) {
            try {
                if (Schema::connection($rekap_koneksi_manual)->hasTable($rekap_tabel_manual)) {
                    $query = DB::connection($rekap_koneksi_manual)->table($rekap_tabel_manual);
                    $tabel_dipakai = $rekap_tabel_manual;
                    $rekap_info['sumber'] = 'tabel ' . $rekap_tabel_manual . ($rekap_koneksi_manual ? ' (koneksi ' . $rekap_koneksi_manual . ')' : '');
                } else {
                    $rekap_info['dicek'][] = $rekap_tabel_manual . ' (TIDAK ADA di koneksi ini)';
                }
            } catch (\Throwable $e) { $rekap_info['error'] = $e->getMessage(); }
        }

        // (b) model Eloquent yang umum dipakai
        if (!$query) {
            $kandidatModel = [
                '\\App\\Models\\RekapDataAsn', '\\App\\Models\\RekapAsn', '\\App\\Models\\DataAsn',
                '\\App\\Models\\RekapPegawai', '\\App\\Models\\Kepegawaian', '\\App\\Models\\Asn',
                '\\App\\Models\\DataKepegawaian', '\\App\\Models\\RekapKepegawaian',
            ];
            foreach ($kandidatModel as $cls) {
                if (!class_exists($cls)) { continue; }
                try { $tbl = (new $cls)->getTable(); } catch (\Throwable $e) { continue; }
                $rekap_info['dicek'][] = $cls . ' → ' . $tbl;
                if (Schema::hasTable($tbl) && $punyaKolomAsn($tbl)) {
                    $query = $cls::query();
                    $rekap_info['sumber'] = 'model ' . $cls;
                    $tabel_dipakai = $tbl;
                    break;
                }
            }
        }

        // (c) cari otomatis: tabel mana pun yang punya kolom pns & pppk
        if (!$query) {
            $semua = $daftarTabel();
            usort($semua, function ($a, $b) {
                $skor = function ($n) { return (int) (strpos($n, 'asn') !== false) * 2 + (int) (strpos($n, 'rekap') !== false) + (int) (strpos($n, 'pegawai') !== false); };
                return $skor($b) <=> $skor($a);
            });
            foreach ($semua as $tbl) {
                if (in_array($tbl, ['migrations', 'failed_jobs', 'jobs', 'sessions', 'cache', 'password_reset_tokens'], true)) { continue; }
                $rekap_info['dicek'][] = $tbl;
                if ($punyaKolomAsn($tbl)) {
                    $query = DB::table($tbl);
                    $rekap_info['sumber'] = 'tabel ' . $tbl . ' (otomatis)';
                    $tabel_dipakai = $tbl;
                    break;
                }
            }
        }

        if ($query) {
            $tbl = $tabel_dipakai ?? $rekap_tabel_manual;
            try {
                $kolom = $tbl ? Schema::connection($rekap_tabel_manual && $tbl === $rekap_tabel_manual ? $rekap_koneksi_manual : null)->getColumnListing($tbl) : [];
                // hormati soft delete jika memakai query builder biasa
                if ($tbl && in_array('deleted_at', $kolom, true) && $query instanceof \Illuminate\Database\Query\Builder) {
                    $query->whereNull('deleted_at');
                }
                foreach (['urutan', 'no', 'nomor', 'id'] as $ord) {
                    if (in_array($ord, $kolom, true)) { $query->orderBy($ord, 'asc'); break; }
                }
                $rekap_asn = $query->get();
            } catch (\Throwable $e) {
                $rekap_info['error'] = $e->getMessage();
            }
        }
    } else {
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

    // ============================================================
    // OLAH DATA UNTUK VISUALISASI REKAP ASN
    // ============================================================
    $rekap_rows = [];
    $totPns = $totPppk = $totSemua = 0;
    $maxTotal = 1;
    $rekap_urut = [];

    // cari nilai kolom secara fleksibel (nama kolom bisa beda-beda)
    $ambilKolom = function (array $r, array $pasti, $mengandung = null, array $kecuali = []) {
        foreach ($pasti as $k) { if (array_key_exists($k, $r)) { return $r[$k]; } }
        if ($mengandung) {
            foreach ($r as $k => $v) {
                $kl = strtolower($k);
                if (strpos($kl, $mengandung) === false) { continue; }
                foreach ($kecuali as $x) { if (strpos($kl, $x) !== false) { continue 2; } }
                return $v;
            }
        }
        return null;
    };

    if ($tab_aktif === 'kepegawaian') {
        foreach ($rekap_asn as $idx => $row) {
            $r = (array) $row;
            $nama  = $ambilKolom($r, ['nama_jabatan', 'jabatan', 'nama'], 'jabatan') ?? 'Jabatan ' . ($idx + 1);
            $pns   = (int) $ambilKolom($r, ['pns', 'jumlah_pns'], 'pns', ['pppk', 'seluruh', 'total']);
            $pppk  = (int) $ambilKolom($r, ['pppk', 'jumlah_pppk'], 'pppk', ['seluruh', 'total']);
            $total = $pns + $pppk;

            $rekap_rows[] = ['nama' => trim((string) $nama), 'pns' => $pns, 'pppk' => $pppk, 'total' => $total];
            $totPns   += $pns;
            $totPppk  += $pppk;
            $totSemua += $total;
            if ($total > $maxTotal) { $maxTotal = $total; }
        }
        $rekap_urut = $rekap_rows;
        usort($rekap_urut, function ($a, $b) { return $b['total'] <=> $a['total']; });
    }

    $pctPns  = $totSemua > 0 ? round($totPns  / $totSemua * 100, 1) : 0;
    $pctPppk = $totSemua > 0 ? round($totPppk / $totSemua * 100, 1) : 0;
    $fmtPct  = function ($n) { return rtrim(rtrim(number_format($n, 1, ',', ''), '0'), ','); };

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
            --c-pns: #1d3856; --c-pppk: #e5392d;
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
            .has-drop.open > .dropdown, .has-sub.open > .dropdown-sub { display: block; }
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

        /* REKAP ASN */
        .asn-head { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 14px 24px; padding: clamp(18px, 2.6vw, 28px); border-bottom: 1px solid var(--line); }
        .asn-head .doc-title { font-size: 1.25rem; }
        .asn-head small { display: block; margin-top: 2px; font-family: var(--font-body); font-weight: 400; font-size: .85rem; color: var(--steel); }
        .asn-pill { display: inline-flex; align-items: center; gap: 8px; padding: 7px 14px; border-radius: 999px; background: var(--paper); color: var(--steel); font-size: .82rem; font-weight: 600; }
        .asn-pill i { color: var(--signal); }

        .rk-body { padding: clamp(16px, 2.6vw, 28px); display: grid; gap: 22px; }

        .kpis { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 14px; }
        .kpi { position: relative; padding: 18px 20px 18px 20px; border-radius: var(--r-md); background: #fff; border: 1px solid var(--line); display: grid; grid-template-columns: 1fr auto; align-items: center; gap: 2px 12px; }
        .kpi small { grid-column: 1; font-size: .8rem; font-weight: 600; color: var(--steel); letter-spacing: .01em; }
        .kpi strong { grid-column: 1; font-family: var(--font-display); font-weight: 800; font-size: clamp(1.8rem, 3vw, 2.4rem); line-height: 1.1; letter-spacing: -.02em; font-variant-numeric: tabular-nums; }
        .kpi span.sub { grid-column: 1 / -1; margin-top: 4px; font-size: .8rem; color: var(--steel); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .kpi-ico { grid-column: 2; grid-row: 1 / span 2; width: 44px; height: 44px; border-radius: 14px; display: grid; place-items: center; font-size: 1.05rem; }
        .kpi--main { background: linear-gradient(135deg, var(--ink) 0%, var(--ink-3) 100%); border-color: transparent; color: #fff; }
        .kpi--main small, .kpi--main span.sub { color: rgba(255,255,255,.72); }
        .kpi--main .kpi-ico { background: rgba(255,255,255,.12); color: var(--amber); }
        .kpi--pns .kpi-ico { background: #e6edf6; color: var(--c-pns); }
        .kpi--pppk .kpi-ico { background: #fdeceb; color: var(--c-pppk); }
        .kpi--jab .kpi-ico { background: #fff4d9; color: #b27a00; }
        .dot { width: 10px; height: 10px; border-radius: 50%; flex: none; display: inline-block; }
        .dot--pns { background: var(--c-pns); }
        .dot--pppk { background: var(--c-pppk); }

        .rk-grid { display: grid; grid-template-columns: minmax(250px, 320px) minmax(0, 1fr); gap: 18px; align-items: stretch; }
        .rk-card { border: 1px solid var(--line); border-radius: var(--r-md); padding: clamp(18px, 2.4vw, 26px); background: #fff; }
        .rk-card h3 { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; }
        .rk-card > p { margin: 2px 0 20px; font-size: .84rem; color: var(--steel); }

        .donut-box { display: grid; justify-items: center; gap: 22px; }
        .donut { --p: 20; position: relative; width: 200px; height: 200px; border-radius: 50%; background: conic-gradient(var(--c-pns) 0 calc(var(--p) * 1%), var(--c-pppk) calc(var(--p) * 1%) 100%); }
        .donut::after { content: ""; position: absolute; inset: 24px; border-radius: 50%; background: #fff; box-shadow: inset 0 0 0 1px var(--line); }
        .donut-center { position: absolute; inset: 0; z-index: 1; display: grid; place-content: center; text-align: center; line-height: 1.1; }
        .donut-center b { font-family: var(--font-display); font-size: 2.2rem; font-weight: 800; letter-spacing: -.02em; }
        .donut-center span { font-size: .78rem; color: var(--steel); }
        .legend { width: 100%; display: grid; gap: 8px; }
        .legend li { display: grid; grid-template-columns: 12px 1fr auto auto; gap: 10px; align-items: center; padding: 10px 14px; border-radius: 12px; background: var(--paper); font-size: .9rem; }
        .legend b { font-variant-numeric: tabular-nums; }
        .legend em { font-style: normal; color: var(--steel); font-size: .82rem; min-width: 46px; text-align: right; }

        .bars { display: grid; gap: 14px; }
        .bar-row { display: grid; gap: 6px; }
        .bar-top { display: flex; justify-content: space-between; align-items: baseline; gap: 12px; font-size: .88rem; }
        .bar-name { font-weight: 600; line-height: 1.3; }
        .bar-val { font-weight: 800; font-variant-numeric: tabular-nums; }
        .bar-val small { font-weight: 500; color: var(--steel); margin-left: 6px; font-size: .76rem; }
        .bar-track { height: 10px; border-radius: 999px; background: var(--paper); overflow: hidden; }
        .bar-fill { height: 100%; display: flex; min-width: 6px; border-radius: 999px; overflow: hidden; transform-origin: left; animation: grow .7s cubic-bezier(.2,.7,.2,1) both; }
        .bar-fill i { display: block; height: 100%; }
        .bar-fill .s-pns { background: var(--c-pns); }
        .bar-fill .s-pppk { background: var(--c-pppk); }
        .bar-legend { display: flex; flex-wrap: wrap; gap: 8px 18px; margin-top: 20px; padding-top: 14px; border-top: 1px solid var(--line); font-size: .82rem; color: var(--steel); }
        .bar-legend span { display: inline-flex; align-items: center; gap: 8px; }
        @keyframes grow { from { transform: scaleX(0); } }

        /* TABEL */
        .rk-table-card { border: 1px solid var(--line); border-radius: var(--r-md); overflow: hidden; background: #fff; }
        .rk-table-bar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px 20px; padding: 16px clamp(16px, 2.2vw, 24px); border-bottom: 1px solid var(--line); }
        .rk-table-bar h3 { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; }
        .table-wrap { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .data-table { width: 100%; border-collapse: collapse; font-size: .92rem; text-align: left; }
        .data-table th { background: #f7f9fc; color: var(--steel); font-weight: 700; font-size: .74rem; text-transform: uppercase; letter-spacing: .07em; padding: 13px 20px; white-space: nowrap; border-bottom: 1px solid var(--line); }
        .data-table td { padding: 14px 20px; border-bottom: 1px solid #eaeff4; color: var(--ink); vertical-align: middle; }
        .data-table tbody tr { transition: background .15s; }
        .data-table tbody tr:hover { background: #f7f9fc; }
        .data-table .col-no { width: 64px; text-align: center; color: var(--steel); font-weight: 600; font-variant-numeric: tabular-nums; }
        .data-table .col-name { font-weight: 600; }
        .data-table .col-num { text-align: right; font-variant-numeric: tabular-nums; width: 110px; }
        .data-table .col-bar { width: 200px; min-width: 150px; }
        .data-table .col-total { text-align: right; width: 130px; font-weight: 800; font-variant-numeric: tabular-nums; }
        .zero { color: #b3bdc9; font-weight: 400; }
        .mini { display: flex; height: 8px; border-radius: 999px; overflow: hidden; background: var(--paper); }
        .mini i { display: block; height: 100%; }
        .mini .s-pns { background: var(--c-pns); }
        .mini .s-pppk { background: var(--c-pppk); }
        .data-table tfoot td { background: #f7f9fc; border-bottom: 0; border-top: 2px solid var(--line); font-weight: 800; padding-top: 16px; padding-bottom: 16px; }
        .data-table tfoot .t-label { text-align: right; text-transform: uppercase; letter-spacing: .06em; font-size: .8rem; color: var(--steel); }
        .data-table tfoot .t-grand { color: var(--signal-d); font-size: 1.15rem; }
        .rk-nohit td { text-align: center; color: var(--steel); padding: 28px; }

        .dbg { margin: 0 clamp(16px, 2.6vw, 28px) clamp(16px, 2.6vw, 28px); padding: 12px 16px; border-radius: 12px; background: #fff8e1; border: 1px solid #ffe08a; color: #6b4e00; font-size: .8rem; line-height: 1.5; word-break: break-word; }

        @media (max-width: 1000px) { .kpis { grid-template-columns: repeat(2, minmax(0, 1fr)); } .rk-grid { grid-template-columns: 1fr; } }
        @media (max-width: 640px) {
            .kpis { gap: 10px; }
            .kpi { padding: 14px; grid-template-columns: 1fr; }
            .kpi-ico { display: none; }
            .data-table .col-bar { display: none; }
            .data-table th, .data-table td { padding: 12px 14px; }
            .donut { width: 170px; height: 170px; }
        }

        /* DAFTAR DOKUMEN */
        .doc-row { position: relative; display: grid; grid-template-columns: 52px minmax(0, 1fr) auto; gap: 18px; align-items: center; padding: 18px clamp(16px, 2.5vw, 26px); border-bottom: 1px solid var(--line); transition: background .2s; }
        .doc-row:last-child { border-bottom: 0; }
        .doc-row[hidden] { display: none; }
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
    </style>
</head>
<body>

<header class="site-header" id="siteHeader">
    <nav class="nav" aria-label="Navigasi utama">
        <div class="brand">
            <a href="/"><img src="/images/jambi.png" alt="Logo Pemkot Jambi"></a>
            <a href="/"><img src="/images/logo.png" alt="Logo Damkar"></a>
            <a href="/redkar"><img src="/images/logo-redkar.png" alt="Logo Redkar"></a>
        </div>

        <button class="nav-toggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="navPanel">
            <i class="fas fa-bars"></i>
        </button>

        <div class="nav-panel" id="navPanel">
            <ul class="menu">
                <li><a class="menu-link {{ request()->is('public-sigap*') ? 'is-active' : '' }}" href="/public-sigap">Sigapkar</a></li>

                <li class="has-drop">
                    <button class="menu-trigger" type="button" aria-expanded="false">Layanan <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Kunjungan, Edukasi dan Sosialisasi</a></li>
                        <li><a href="/layanan-fasilitas/izin-keramaian">Rekomendasi Izin Pengamanan Event Keramaian</a></li>
                        <li><a href="/layanan-fasilitas/layanan_perizinan">Rekomendasi Kebakaran Bangunan Gedung dan Lingkungan</a></li>
                        <li><a href="/layanan-fasilitas/penggunaan-sarana">Permohonan Penggunaan Sarana Pemadam Kebakaran</a></li>
                        <li><a href="/layanan-fasilitas/skk">Permohonan Sertifikat Keselamatan Kebakaran</a></li>
                    </ul>
                </li>

                <li class="has-drop">
                    <button class="menu-trigger" type="button" aria-expanded="false">Produk Hukum <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/produk-hukum/undang-undang">Undang-Undang</a></li>
                        <li><a href="/produk-hukum/peraturan-pemerintah">Peraturan Pemerintah</a></li>
                        <li><a href="/produk-hukum/peraturan-menteri">Peraturan Menteri</a></li>
                        <li><a href="/produk-hukum/peraturan-daerah">Peraturan Daerah</a></li>
                        <li><a href="/produk-hukum/peraturan-kepala-daerah">Peraturan Kepala Daerah</a></li>
                    </ul>
                </li>

                <li class="has-drop current">
                    <button class="menu-trigger" type="button" aria-expanded="false">Profil <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/profil/visi-misi" <?= $tab_aktif === 'visi-misi' ? 'aria-current="page"' : '' ?>>Visi Misi</a></li>
                        <li><a href="/profil/sotk" <?= $tab_aktif === 'sotk' ? 'aria-current="page"' : '' ?>>SOTK</a></li>
                        <li><a href="/profil/tupoksi" <?= $tab_aktif === 'tupoksi' ? 'aria-current="page"' : '' ?>>Tupoksi</a></li>
                        <li><a href="/profil/kepegawaian" <?= $tab_aktif === 'kepegawaian' ? 'aria-current="page"' : '' ?>>Kepegawaian</a></li>
                        <li><a href="/profil/program-kegiatan" <?= $tab_aktif === 'program-kegiatan' ? 'aria-current="page"' : '' ?>>Program Kegiatan</a></li>
                        <li><a href="/profil/cascading" <?= $tab_aktif === 'cascading' ? 'aria-current="page"' : '' ?>>Cascading</a></li>
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
                            <button class="sub-trigger" type="button" aria-expanded="false">Berita <i class="fas fa-chevron-right"></i></button>
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

            <ul class="nav-actions">
                <li class="has-drop">
                    <button class="btn-nav btn-nav--alert menu-trigger-cta" type="button" aria-expanded="false">
                        <span class="beacon" aria-hidden="true"></span> Lapor darurat <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown">
                        <li><a href="tel:112"><i class="fas fa-headset"></i> Call Center 112</a></li>
                        <li><a href="tel:{{ $no_telepon }}"><i class="fas fa-phone-alt"></i> Telepon <?= $telepon_tampil ?></a></li>
                        <li><a href="<?= $wa_link ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a></li>
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
                                    <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Keluar</button>
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

<section class="page-hero">
    <div class="wrap">
        <nav aria-label="Breadcrumb">
            <ol class="crumbs">
                <li><a href="/">Beranda</a></li>
                <li><a href="/profil/visi-misi">Profil</a></li>
                <li><span aria-current="page"><?= $h($tabs[$tab_aktif]['label']) ?></span></li>
            </ol>
        </nav>
        <h1><?= $h($tabs[$tab_aktif]['label']) ?></h1>
        <p><?= $h($tabs[$tab_aktif]['judul']) ?> Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
    </div>
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

            <?php if ($tab_aktif === 'kepegawaian'): ?>

                <!-- ==============================================
                     PANEL: REKAP DATA ASN (DARI DATABASE)
                     ============================================== -->
                <section class="doc-panel" aria-label="Rekap Data ASN">
                    <div class="asn-head">
                        <div class="doc-title">
                            <i class="fas fa-chart-column"></i>
                            <span>Rekapitulasi Data Pegawai ASN
                                <small>Jumlah PNS dan PPPK berdasarkan jabatan</small>
                            </span>
                        </div>
                        <span class="asn-pill"><i class="fas fa-briefcase"></i> <?= count($rekap_rows) ?> kategori jabatan</span>
                    </div>

                    <?php if (!empty($rekap_rows)): ?>
                    <div class="rk-body">

                        <!-- Angka kunci -->
                        <div class="kpis">
                            <div class="kpi kpi--main">
                                <small>Total ASN</small>
                                <strong><?= number_format($totSemua, 0, ',', '.') ?></strong>
                                <span class="sub">PNS dan PPPK</span>
                                <span class="kpi-ico"><i class="fas fa-users"></i></span>
                            </div>
                            <div class="kpi kpi--pns">
                                <small>PNS</small>
                                <strong><?= number_format($totPns, 0, ',', '.') ?></strong>
                                <span class="sub"><?= $fmtPct($pctPns) ?>% dari seluruh ASN</span>
                                <span class="kpi-ico"><i class="fas fa-user-tie"></i></span>
                            </div>
                            <div class="kpi kpi--pppk">
                                <small>PPPK</small>
                                <strong><?= number_format($totPppk, 0, ',', '.') ?></strong>
                                <span class="sub"><?= $fmtPct($pctPppk) ?>% dari seluruh ASN</span>
                                <span class="kpi-ico"><i class="fas fa-user-check"></i></span>
                            </div>
                            <div class="kpi kpi--jab">
                                <small>Jenis jabatan</small>
                                <strong><?= count($rekap_rows) ?></strong>
                                <span class="sub" title="<?= $h($rekap_urut[0]['nama']) ?>">Terbanyak: <?= $h($rekap_urut[0]['nama']) ?> (<?= $rekap_urut[0]['total'] ?>)</span>
                                <span class="kpi-ico"><i class="fas fa-briefcase"></i></span>
                            </div>
                        </div>

                        <div class="rk-grid">
                            <!-- Donut komposisi -->
                            <div class="rk-card">
                                <h3>Komposisi status</h3>
                                <p>Perbandingan PNS dan PPPK.</p>
                                <div class="donut-box">
                                    <div class="donut" style="--p: <?= $h($pctPns) ?>" role="img" aria-label="PNS <?= $fmtPct($pctPns) ?> persen, PPPK <?= $fmtPct($pctPppk) ?> persen">
                                        <div class="donut-center"><b><?= number_format($totSemua, 0, ',', '.') ?></b><span>Total ASN</span></div>
                                    </div>
                                    <ul class="legend">
                                        <li><span class="dot dot--pns"></span> PNS <b><?= $totPns ?></b> <em><?= $fmtPct($pctPns) ?>%</em></li>
                                        <li><span class="dot dot--pppk"></span> PPPK <b><?= $totPppk ?></b> <em><?= $fmtPct($pctPppk) ?>%</em></li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Batang per jabatan -->
                            <div class="rk-card">
                                <h3>Jumlah pegawai per jabatan</h3>
                                <p>Diurutkan dari yang terbanyak.</p>
                                <div class="bars">
                                    <?php foreach ($rekap_urut as $r):
                                        $wTotal = $maxTotal > 0 ? max(($r['total'] / $maxTotal) * 100, 1.5) : 0;
                                        $base   = max($r['pns'] + $r['pppk'], 1);
                                        $wPns   = $r['pns']  / $base * 100;
                                        $wPppk  = $r['pppk'] / $base * 100;
                                    ?>
                                    <div class="bar-row" title="<?= $h($r['nama']) ?>: PNS <?= $r['pns'] ?>, PPPK <?= $r['pppk'] ?>">
                                        <div class="bar-top">
                                            <span class="bar-name"><?= $h($r['nama']) ?></span>
                                            <span class="bar-val"><?= $r['total'] ?><small>PNS <?= $r['pns'] ?> · PPPK <?= $r['pppk'] ?></small></span>
                                        </div>
                                        <div class="bar-track">
                                            <div class="bar-fill" style="width: <?= round($wTotal, 2) ?>%">
                                                <i class="s-pns" style="width: <?= round($wPns, 2) ?>%"></i><i class="s-pppk" style="width: <?= round($wPppk, 2) ?>%"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="bar-legend">
                                    <span><span class="dot dot--pns"></span> PNS</span>
                                    <span><span class="dot dot--pppk"></span> PPPK</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel rinci -->
                        <div class="rk-table-card">
                            <div class="rk-table-bar">
                                <h3>Tabel rincian</h3>
                                <label class="doc-search">
                                    <span class="sr-only">Cari jabatan</span>
                                    <i class="fas fa-search"></i>
                                    <input type="search" id="rkSearch" placeholder="Cari jabatan..." autocomplete="off">
                                </label>
                            </div>
                            <div class="table-wrap">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th class="col-no">No</th>
                                            <th>Nama Jabatan</th>
                                            <th class="col-num">PNS</th>
                                            <th class="col-num">PPPK</th>
                                            <th class="col-bar">Komposisi</th>
                                            <th class="col-total">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody id="rkBody">
                                        <?php foreach ($rekap_rows as $idx => $r):
                                            $b = max($r['total'], 1);
                                        ?>
                                        <tr class="rk-row" data-name="<?= $h(mb_strtolower($r['nama'])) ?>">
                                            <td class="col-no"><?= $idx + 1 ?></td>
                                            <td class="col-name"><?= $h($r['nama']) ?></td>
                                            <td class="col-num"><?= $r['pns']  > 0 ? $r['pns']  : '<span class="zero">–</span>' ?></td>
                                            <td class="col-num"><?= $r['pppk'] > 0 ? $r['pppk'] : '<span class="zero">–</span>' ?></td>
                                            <td class="col-bar">
                                                <div class="mini" aria-hidden="true">
                                                    <i class="s-pns" style="width: <?= round($r['pns'] / $b * 100, 2) ?>%"></i><i class="s-pppk" style="width: <?= round($r['pppk'] / $b * 100, 2) ?>%"></i>
                                                </div>
                                            </td>
                                            <td class="col-total"><?= $r['total'] ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr class="rk-nohit" id="rkNoHit" hidden><td colspan="6">Jabatan tidak ditemukan.</td></tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="t-label">Total</td>
                                            <td class="col-num"><?= $totPns ?></td>
                                            <td class="col-num"><?= $totPppk ?></td>
                                            <td class="col-bar"></td>
                                            <td class="col-total t-grand"><?= $totSemua ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="doc-empty">
                        <i class="fas fa-chart-pie"></i>
                        <h3>Belum ada Rekap Data ASN</h3>
                        <p>Data akan tampil di sini setelah petugas mengisinya melalui dashboard.</p>
                    </div>
                    <?php endif; ?>
                    <?php if (config('app.debug') && request()->query('debug')):
                        $dbg = [];
                        try { $dbg[] = 'Koneksi default: <b>' . $h(config('database.default')) . '</b> | Database: <b>' . $h(DB::connection()->getDatabaseName()) . '</b>'; } catch (\Throwable $e) { $dbg[] = 'Gagal baca koneksi default: ' . $h($e->getMessage()); }
                        foreach (array_keys(config('database.connections', [])) as $kon) {
                            try {
                                $ada = Schema::connection($kon)->hasTable('data_asns');
                                $dbg[] = '[' . $h($kon) . '] data_asns: ' . ($ada ? '<b>' . DB::connection($kon)->table('data_asns')->count() . ' baris</b>' : 'tidak ada');
                            } catch (\Throwable $e) { $dbg[] = '[' . $h($kon) . '] tidak bisa diakses'; }
                        }
                    ?>
                    <div class="dbg">
                        <strong>Diagnosa (APP_DEBUG=true &amp; ?debug=1)</strong><br>
                        Sumber terpakai: <b><?= $h($rekap_info['sumber'] ?? 'tidak ada') ?></b> &middot; Baris terbaca: <b><?= count($rekap_rows) ?></b><br>
                        <?php if (!empty($rekap_info['error'])): ?>Error: <?= $h($rekap_info['error']) ?><br><?php endif; ?>
                        <?= implode('<br>', $dbg) ?>
                    </div>
                    <?php endif; ?>
                </section>

            <?php else: ?>
                <!-- ==============================================
                     PANEL DOKUMEN (UNTUK TAB PROFIL LAINNYA)
                     ============================================== -->
                <section class="doc-panel" aria-label="Daftar dokumen">
                    <div class="doc-bar">
                        <div class="doc-title">
                            <i class="fas <?= $h($tabs[$tab_aktif]['ico']) ?>"></i>
                            <span><?= $h($tabs[$tab_aktif]['judul']) ?></span>
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

    var fab = document.getElementById('sosFab');
    if (fab) {
        var fabBtn = fab.querySelector('.sos-fab-btn');
        var onScroll = function () { fab.classList.toggle('show', window.scrollY > 240); };
        window.addEventListener('scroll', onScroll, { passive: true }); onScroll();
        fabBtn.addEventListener('click', function () { var o = fab.classList.toggle('open'); fabBtn.setAttribute('aria-expanded', o); });
    }

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

    var rkSearch = document.getElementById('rkSearch');
    if (rkSearch) {
        var rkRows = document.querySelectorAll('.rk-row');
        var noHit = document.getElementById('rkNoHit');
        rkSearch.addEventListener('input', function () {
            var q = rkSearch.value.trim().toLowerCase(), n = 0;
            rkRows.forEach(function (r) { var hit = r.dataset.name.indexOf(q) !== -1; r.hidden = !hit; if (hit) n++; });
            if (noHit) noHit.hidden = n > 0;
        });
    }
})();
</script>
</body>
</html>
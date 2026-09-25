<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Dashboard internal | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ==========================================================
           DESIGN TOKENS
           Palet inti: ink (navy gelap) sebagai warna utama, navy
           (biru dongker medium) sebagai aksen interaktif/dekoratif —
           tombol, status aktif menu, ikon judul seksi — dan signal
           (merah) sebagai satu-satunya aksen darurat, dipakai konsisten
           hanya untuk status siaga/urgent, bukan didekorasi ke semua tempat.
           ========================================================== */
        :root {
            --ink: #0d1b2a;
            --ink-2: #132a43;
            --ink-3: #1d3856;
            --paper: #f7f9fc;
            --white: #ffffff;

            --navy: #1e3a5f;
            --navy-d: #14283f;
            --navy-tint: rgba(30, 58, 95, .09);

            --signal: #e5392d;
            --signal-d: #c22b20;
            --signal-tint: rgba(229, 57, 45, .09);

            --amber: #ffb627;
            --success: #10b981;
            --info: #2f6fed;
            --info-tint: rgba(47, 111, 237, .09);
            --ink-tint: rgba(13, 27, 42, .055);

            --steel: #64748b;
            --steel-soft: #94a3b8;
            --line: #e6eaf1;

            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;

            --r-lg: 20px;
            --r-md: 14px;
            --r-sm: 10px;

            --sidebar-w: 272px;
            --topbar-h: 72px;

            /* Skala shadow tunggal, dicampur dgn warna ink (bukan hitam polos)
               supaya terasa satu keluarga dgn palet, bukan default rgba(0,0,0,.1) */
            --shadow-xs: 0 1px 2px rgba(13, 27, 42, .05);
            --shadow-sm: 0 2px 8px -2px rgba(13, 27, 42, .08);
            --shadow-md: 0 12px 24px -8px rgba(13, 27, 42, .12);
            --shadow-lg: 0 24px 48px -16px rgba(13, 27, 42, .18);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font-body);
            font-size: 1rem;
            line-height: 1.6;
            color: var(--ink);
            background: var(--paper);
            -webkit-font-smoothing: antialiased;
        }
        img { max-width: 100%; display: block; }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; margin: 0; padding: 0; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
        :focus-visible { outline: 3px solid var(--amber); outline-offset: 2px; border-radius: 6px; }

        /* ==========================================================
           NOTIFIKASI (TOAST)
           ========================================================== */
        .toast-wrap { position: fixed; z-index: 200; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
        .toast {
            display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px;
            border-radius: 999px; background: #fff; border: 1px solid var(--line);
            box-shadow: var(--shadow-md); font-weight: 600; font-size: .92rem;
            animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both;
        }
        .toast.leaving { animation: toastOut .3s ease forwards; }
        .toast-ico { flex: none; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; color: #fff; font-size: .78rem; }
        .toast.ok .toast-ico { background: var(--success); }
        .toast.err .toast-ico { background: var(--signal); }
        .toast-x { flex: none; width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; }
        .toast-x:hover { background: var(--ink); color: #fff; }
        @keyframes toastIn { from { opacity: 0; transform: translateY(-14px); } to { opacity: 1; transform: none; } }
        @keyframes toastOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(-14px); } }

        /* ==========================================================
           TOPBAR
           ========================================================== */
        .topbar {
            position: sticky; top: 0; z-index: 60; height: var(--topbar-h);
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
            padding: 0 28px; background: rgba(255,255,255,.86);
            -webkit-backdrop-filter: blur(16px); backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--line);
        }
        .topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .side-toggle { display: none; width: 40px; height: 40px; border-radius: 12px; align-items: center; justify-content: center; font-size: 1.05rem; transition: background .2s; }
        .side-toggle:hover { background: var(--paper); }
        .brand { display: flex; align-items: center; gap: 12px; min-width: 0; }
        .brand img { height: 34px; width: auto; flex: none; }
        .brand span { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: 1.08rem; letter-spacing: -0.01em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        .topbar-right { display: flex; align-items: center; gap: 14px; }
        .user-chip { display: flex; align-items: center; gap: 10px; padding: 6px 16px 6px 6px; border-radius: 999px; background: var(--paper); border: 1px solid var(--line); }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--ink); color: #fff; display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
        .user-meta { display: grid; line-height: 1.25; }
        .user-meta strong { font-size: .85rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: var(--ink); }
        .user-meta small { font-size: .74rem; color: var(--steel); text-transform: capitalize; font-weight: 500; }
        .btn-logout { display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 18px; border-radius: 999px; background: var(--navy); color: #fff; font-weight: 600; font-size: .85rem; transition: background .2s, transform .1s; border: none; }
        .btn-logout:hover { background: var(--navy-d); }
        .btn-logout:active { transform: scale(.98); }

        @media (max-width: 900px) {
            .side-toggle { display: inline-flex; }
            .user-meta { display: none; }
        }

        /* ==========================================================
           SHELL: SIDEBAR + KONTEN
           ========================================================== */
        .shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }

        .sidebar {
            width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h);
            height: calc(100vh - var(--topbar-h)); overflow-y: auto;
            background: #fff; border-right: 1px solid var(--line);
            padding: 20px 14px 32px;
            scrollbar-width: thin;
            scrollbar-color: var(--line) transparent;
        }
        .sidebar::-webkit-scrollbar { width: 6px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background-color: var(--line); border-radius: 20px; }

        .side-link {
            display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm);
            font-size: .9rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s;
            margin-bottom: 4px;
        }
        .side-link:hover { background: var(--paper); }
        .side-link.active { background: var(--ink); color: #fff; }
        .side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: color .2s; }
        .side-link:hover i { color: var(--ink); }
        .side-link.active i { color: var(--amber); }

        .side-group + .side-group { margin-top: 6px; }
        .side-group summary {
            list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px;
            padding: 11px 14px; border-radius: var(--r-sm); font-size: .8rem; font-weight: 700;
            letter-spacing: .04em; text-transform: uppercase; color: var(--navy); transition: background .2s;
            user-select: none;
        }
        .side-group summary::-webkit-details-marker { display: none; }
        .side-group summary:hover { background: var(--paper); }
        .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); }
        .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; }
        .side-group[open] summary .chev { transform: rotate(180deg); }

        .side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
        .side-sub a {
            display: flex; align-items: center; gap: 12px; padding: 9px 12px; border-radius: var(--r-sm);
            font-size: .85rem; font-weight: 500; line-height: 1.4; color: var(--steel);
            transition: background .2s, color .2s, transform .2s;
        }
        .side-sub a:hover { background: var(--paper); color: var(--ink); transform: translateX(2px); }
        .side-sub a.active { background: var(--navy-tint); color: var(--navy-d); font-weight: 600; }
        .side-sub a i { width: 18px; text-align: center; font-size: .9rem; opacity: .75; }
        .side-sub a:hover i, .side-sub a.active i { opacity: 1; }

        .side-kicker { padding: 18px 14px 6px; font-size: .7rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase; color: var(--steel-soft); }

        .sidebar-backdrop { display: none; }

        @media (max-width: 900px) {
            .sidebar {
                position: fixed; z-index: 90; top: var(--topbar-h); left: 0;
                height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%);
                transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg);
            }
            body.side-open .sidebar { transform: none; }
            .sidebar-backdrop {
                display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80;
                background: rgba(13,27,42,.4); opacity: 0; pointer-events: none; transition: opacity .3s;
            }
            body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
        }

        /* ==========================================================
           KONTEN UTAMA
           ========================================================== */
        .content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }

        .page-head { margin-bottom: 28px; }
        .page-head h1 { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -0.02em; margin-bottom: 4px; color: var(--ink); }
        .page-head p { color: var(--steel); font-size: .98rem; }

        /* Welcome banner */
        .welcome {
            position: relative; overflow: hidden; border-radius: var(--r-lg);
            background: linear-gradient(135deg, var(--ink), var(--ink-2));
            padding: clamp(28px, 4.5vw, 40px); color: #fff; margin-bottom: 36px;
            box-shadow: var(--shadow-md);
        }
        .welcome::after {
            content: ""; position: absolute; right: -8%; top: -50%; width: 60%; aspect-ratio: 1;
            background: radial-gradient(closest-side, rgba(30,58,95,.18), transparent 70%); pointer-events: none;
        }
        .welcome-badge {
            position: relative; display: inline-flex; align-items: center; gap: 8px;
            padding: 7px 14px; border-radius: 999px; background: rgba(255,255,255,.12);
            font-size: .82rem; font-weight: 600; margin-bottom: 18px; border: 1px solid rgba(255,255,255,.14);
        }
        .welcome-badge i { color: var(--amber); font-size: .78rem; }
        .welcome h2 { position: relative; font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: clamp(1.35rem, 2.6vw, 1.75rem); line-height: 1.3; letter-spacing: -0.01em; max-width: 42ch; margin-bottom: 6px; }
        .welcome p { position: relative; max-width: 58ch; color: rgba(255,255,255,.75); font-size: 1rem; }

        /* Section headings — category header 1 baris, ikon navy blue */
        .section-heading { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; flex-wrap: nowrap; }
        .section-heading-ico { flex: none; width: 30px; height: 30px; border-radius: 9px; background: var(--navy); color: #fff; display: grid; place-items: center; font-size: .78rem; }
        .section-heading h3 { flex: none; font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: 1rem; color: var(--ink); letter-spacing: -0.01em; white-space: nowrap; }
        .section-heading .line { flex: 1 1 auto; min-width: 24px; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }

        /* Stat cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 16px;
            margin-bottom: 44px;
        }
        .welcome::after {
            content: ""; position: absolute; right: -6%; top: -30%; width: 60%; aspect-ratio: 1;
            background: radial-gradient(closest-side, rgba(229,57,45,.4), transparent); pointer-events: none;
        }
        .welcome-badge { position: relative; display: inline-flex; align-items: center; gap: 8px; padding: 6px 14px; border-radius: 999px; background: rgba(255,255,255,.1); font-size: .78rem; font-weight: 700; letter-spacing: .03em; text-transform: uppercase; margin-bottom: 16px; }
        .welcome-badge i { color: var(--amber); }
        .welcome h2 { position: relative; font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: clamp(1.35rem, 2.6vw, 1.75rem); line-height: 1.25; letter-spacing: -0.015em; max-width: 34ch; }
        .welcome p { position: relative; margin-top: 10px; max-width: 58ch; color: rgba(255,255,255,.72); font-size: .95rem; line-height: 1.6; }

        .stats-head { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 16px; }
        .stats-head h3 { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.1rem; letter-spacing: -0.01em; }

        .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 16px; }
        .stat-card {
            display: flex; flex-direction: column; align-items: flex-start;
            padding: 22px; background: #fff; border-radius: var(--r-md);
            border: 1px solid var(--line);
            box-shadow: var(--shadow-xs);
            transition: box-shadow .2s ease, border-color .2s ease, transform .2s ease;
            position: relative;
        }
        .stat-card:hover {
            box-shadow: var(--shadow-sm);
            border-color: #d7dee9;
            transform: translateY(-2px);
        }
        .stat-card::after {
            content: "\f061";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute; top: 22px; right: 20px;
            color: var(--steel-soft); font-size: .8rem;
            opacity: 0; transform: translateX(-6px);
            transition: opacity .2s ease, transform .2s ease;
        }
        .stat-card:hover::after { opacity: 1; transform: translateX(0); }

        .stat-ico {
            width: 46px; height: 46px; border-radius: var(--r-sm);
            display: grid; place-items: center; font-size: 1.1rem;
            margin-bottom: 18px;
        }
        .stat-title { font-size: .76rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--steel); margin-bottom: 6px; line-height: 1.4; }
        .stat-value { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: 1.9rem; line-height: 1; color: var(--ink); letter-spacing: -0.01em; }

        /* Palet ikon dibatasi 3 warna bermakna, bukan warna acak per kartu:
           - primer (navy tint)  -> data administratif/permohonan (default)
           - danger (merah tint) -> status siaga/darurat aktif
           - info (biru tint)    -> data sarana & sumber air */
        .ic-primary { background: var(--ink-tint); color: var(--ink-3); }
        .ic-danger  { background: var(--signal-tint); color: var(--signal-d); }
        .ic-info    { background: var(--info-tint); color: var(--info); }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *, *::before, *::after { animation: none !important; transition: none !important; }
        }
    </style>
</head>
<body>

<div class="toast-wrap" id="toastWrap" aria-live="polite">
    @if(session('success'))
        <div class="toast ok" data-toast>
            <span class="toast-ico"><i class="fas fa-check"></i></span>
            <span>{{ session('success') }}</span>
            <button type="button" class="toast-x" aria-label="Tutup notifikasi" data-toast-close><i class="fas fa-times"></i></button>
        </div>
    @endif
    @if(session('error'))
        <div class="toast err" data-toast>
            <span class="toast-ico"><i class="fas fa-triangle-exclamation"></i></span>
            <span>{{ session('error') }}</span>
            <button type="button" class="toast-x" aria-label="Tutup notifikasi" data-toast-close><i class="fas fa-times"></i></button>
        </div>
    @endif
</div>

<!-- ==================== TOPBAR ==================== -->
<header class="topbar">
    <div class="topbar-left">
        <button class="side-toggle" type="button" id="sideToggle" aria-label="Buka menu" aria-expanded="false" aria-controls="sidebar">
            <i class="fas fa-bars"></i>
        </button>
        <a href="/internal/index" class="brand">
            <img src="/images/simerahkoja.png" alt="Logo SIMERAH KOJA">
            <span>SIMERAH KOJA</span>
        </a>
    </div>
    <div class="topbar-right">
        <div class="user-chip">
            <span class="user-avatar">{{ strtoupper(substr(Auth::user()->nama_lengkap ?? 'R', 0, 1)) }}</span>
            <div class="user-meta">
                <strong>{{ Auth::user()->nama_lengkap ?? 'Rekan kerja' }}</strong>
                <small>{{ str_replace('_', ' ', Auth::user()->role ?? '') }}</small>
            </div>
        </div>
        <form action="/logout" method="POST" style="margin:0;">
            @csrf
            <button type="submit" class="btn-logout"><i class="fas fa-arrow-right-from-bracket"></i> Keluar</button>
        </form>
    </div>
</header>

<div class="shell">

    <div class="sidebar-backdrop" id="sideBackdrop"></div>

    <!-- ==================== SIDEBAR ==================== -->
    <aside class="sidebar" id="sidebar" aria-label="Navigasi internal">

        <a href="/internal/index" class="side-link {{ Request::is('internal/index') ? 'active' : '' }}">
            <i class="fas fa-house"></i> Dashboard utama
        </a>

        @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')

            <div class="side-kicker">Modul operasional</div>

            <!-- BAGIAN PENCEGAHAN -->
            <details class="side-group" {{ Request::is('internal/pencegahan*') ? 'open' : '' }}>
                <summary><i class="fas fa-shield-halved grp-ico"></i><span class="grp-label">Bagian pencegahan</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <!-- Menu Sesuai Foto -->
                    <a href="/internal/pencegahan/peningkatan-kapasitas" class="{{ Request::is('internal/pencegahan/peningkatan-kapasitas*') ? 'active' : '' }}">
                        <i class="fas fa-arrow-trend-up"></i> Peningkatan Kapasitas Aparatur
                    </a>
                    <a href="/internal/pencegahan/inspeksi-kebakaran" class="{{ Request::is('internal/pencegahan/inspeksi-kebakaran*') ? 'active' : '' }}">
                        <i class="fas fa-magnifying-glass-chart"></i> Pencegahan Kebakaran dan Inspeksi
                    </a>
                    <a href="/internal/pencegahan/pemberdayaan-masyarakat" class="{{ Request::is('internal/pencegahan/pemberdayaan-masyarakat*') ? 'active' : '' }}">
                        <i class="fas fa-handshake-angle"></i> Pemberdayaan Masyarakat dan Dunia Usaha
                    </a>

                    <!-- Menu Kelola -->
                    <a href="/internal/pencegahan/kelola-edukasi" class="{{ Request::is('internal/pencegahan/kelola-edukasi*') ? 'active' : '' }}">
                        <i class="fas fa-bullhorn"></i> Kelola Edukasi
                    </a>
                    <a href="/internal/pencegahan/kelola-redkar" class="{{ Request::is('internal/pencegahan/kelola-redkar*') ? 'active' : '' }}">
                        <i class="fas fa-users-rectangle"></i> Kelola Redkar
                    </a>
                    <a href="/internal/pencegahan/kelola-rpkbgl" class="{{ Request::is('internal/pencegahan/kelola-rpkbgl*') ? 'active' : '' }}">
                        <i class="fas fa-building-circle-check"></i> Kelola RPKBGL
                    </a>
                    <a href="/internal/pencegahan/kelola-skk" class="{{ Request::is('internal/pencegahan/kelola-skk*') ? 'active' : '' }}">
                        <i class="fas fa-file-shield"></i> Kelola SKK
                    </a>
                </div>
            </details>

            <!-- BAGIAN PEMADAMAN -->
            <details class="side-group" {{ Request::is('internal/damtan*') || Request::is('internal/surat-korban*') ? 'open' : '' }}>
                <summary><i class="fas fa-fire-extinguisher grp-ico"></i><span class="grp-label">Bagian pemadaman</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/damtan/input-data" class="{{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}">
                        <i class="fas fa-fire-extinguisher"></i> Input Data
                    </a>
                    <a href="/internal/damtan/data-laporan" class="{{ Request::is('internal/damtan/data-laporan*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i> Data Laporan
                    </a>
                    <a href="/internal/surat-korban/create" class="{{ Request::is('internal/surat-korban*') ? 'active' : '' }}">
                        <i class="fas fa-file-signature"></i> Buat Surat Korban
                    </a>
                </div>
            </details>

            <!-- BAGIAN KEPEGAWAIAN -->
            <details class="side-group" {{ Request::is('internal/kepegawaian*') ? 'open' : '' }}>
                <summary><i class="fas fa-user-tie grp-ico"></i><span class="grp-label">Kepegawaian</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/kepegawaian/duk" class="{{ Request::is('internal/kepegawaian/duk*') ? 'active' : '' }}">
                        <i class="fas fa-user-tie"></i> Data Urut Kepegawaian
                    </a>
                </div>
            </details>

            <!-- BAGIAN SAPRA -->
            <details class="side-group" {{ Request::is('sapra*') ? 'open' : '' }}>
                <summary><i class="fas fa-warehouse grp-ico"></i><span class="grp-label">Bagian sapra</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <span class="side-kicker" style="padding-left:2px;">Sarana &amp; Prasarana</span>
                       <a href="/sapra/sarana-mako"><i class="fas fa-fire-extinguisher"></i> Sarana pemadam kebakaran</a>
                    <a href="/sapra/prasarana-mako"><i class="fas fa-building"></i> Prasarana pemadam kebakaran</a>
                    <a href="/sapra/sarana-penyelamatan" class="{{ Request::is('sapra/sarana-penyelamatan*') ? 'active' : '' }}">
                        <i class="fas fa-life-ring"></i> Sarana Penyelamatan & Evakuasi

                    </a>
                    <a href="/sapra/sarana-pemeriksaan" class="{{ Request::is('sapra/sarana-pemeriksaan*') ? 'active' : '' }}">
                        <i class="fas fa-search-location"></i> Sarana Pemeriksaan Proteksi Kebakaran
                    </a>
                    <a href="/sapra/kelola-pos" class="{{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}">
                        <i class="fas fa-warehouse"></i> Kelola Data Pos
                    </a>

                    <span class="side-kicker" style="padding-left:2px;">Manajemen Air</span>
                    <a href="/sapra/data_hidrant_gedung" class="{{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}">
                        <i class="fas fa-droplet"></i> Sumber Air
                    </a>
                    <a href="/sapra/data-hidrant-kota" class="{{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}">
                        <i class="fas fa-map-location-dot"></i> Data Hidrant Kota Jambi
                    </a>

                    <span class="side-kicker" style="padding-left:2px;">Logistik & Distribusi</span>
                    <a href="/sapra/kebutuhan-sarpras" class="{{ Request::is('sapra/kebutuhan-sarpras*') ? 'active' : '' }}">
                        <i class="fas fa-boxes-stacked"></i> Mutu Baku Kebutuhan
                    </a>
                    <a href="/sapra/distribusi-staff" class="{{ Request::is('sapra/distribusi-staff*') ? 'active' : '' }}">
                        <i class="fas fa-people-carry-box"></i> Serah terima Barang
                    </a>
                </div>
            </details>
        @endif

        @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
            <div class="side-kicker">Konten publik</div>
            <details class="side-group" {{ Request::is('internal/operator*') ? 'open' : '' }}>
                <summary><i class="far fa-newspaper grp-ico"></i><span class="grp-label">Manajemen berita</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/operator/kelola-berita" class="{{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}">
                        <i class="far fa-newspaper"></i> Input &amp; Kelola Berita
                    </a>
                    <a href="/internal/operator/infografis" class="{{ Request::is('internal/operator/infografis*') ? 'active' : '' }}">
                        <i class="far fa-image"></i> Kelola Info Grafis
                    </a>
                    <a href="/internal/operator/berita-medsos" class="{{ Request::is('internal/operator/berita-medsos*') ? 'active' : '' }}">
                        <i class="fab fa-instagram"></i> Kelola Berita Medsos
                    </a>
                </div>
            </details>
        @endif

        <div class="side-kicker">Akun</div>
        <details class="side-group" {{ Request::is('internal/profil*') || Request::is('internal/kelola-user*') || Request::is('internal/kelola-pemohon*') ? 'open' : '' }}>
            <summary><i class="fas fa-user-gear grp-ico"></i><span class="grp-label">Pengaturan akun</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="/internal/profil" class="{{ Request::is('internal/profil*') ? 'active' : '' }}">
                    <i class="fas fa-user-pen"></i> Profil Saya
                </a>
                @if(Auth::user()->role === 'super_user')
                    <a href="/internal/kelola-user" class="{{ Request::is('internal/kelola-user*') ? 'active' : '' }}">
                        <i class="fas fa-users-gear"></i> Kelola Semua Pengguna
                    </a>
                    <a href="/internal/kelola-pemohon" class="{{ Request::is('internal/kelola-pemohon*') ? 'active' : '' }}">
                        <i class="fas fa-address-book"></i> Kelola Akun Pemohon
                    </a>
                @endif
            </div>
        </details>

    </aside>

    <!-- ==================== KONTEN ==================== -->
    <main class="content">

        <div class="page-head">
            <h1>Ruang kerja terintegrasi</h1>
            <p>Ringkasan sistem informasi internal Disdamkartan Kota Jambi.</p>
        </div>

        <section class="welcome">
            <span class="welcome-badge"><i class="fas fa-shield-halved"></i> {{ Auth::user()->role === 'super_user' ? 'Super user' : 'Pegawai internal' }}</span>
            <h2>Selamat bekerja, {{ Auth::user()->nama_lengkap ?? 'Rekan kerja' }}.</h2>
            @if(Auth::user()->role === 'super_user')
                <p>Anda memiliki kendali penuh untuk memantau dan mengelola seluruh modul operasional maupun sistem.</p>
            @else
                <p>Anda dapat berkolaborasi mengelola laporan dari seluruh modul layanan Disdamkartan.</p>
            @endif
        </section>

        @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')

        <!-- ==============================================
             STAT CARDS DIKELOMPOKKAN PER BAGIAN
             Warna ikon dibatasi 3 makna (navy = data administratif,
             merah = status darurat aktif, biru = sarana air), bukan
             warna berbeda-beda tiap kartu.
             ============================================== -->

        <!-- 1. BAGIAN PENCEGAHAN -->
        <div class="mb-5">
            <div class="section-heading">
                <span class="section-heading-ico"><i class="fas fa-shield-halved"></i></span>
                <h3>Bagian Pencegahan</h3>
                <span class="line"></span>
            </div>

            <div class="stats-grid">
                <a href="/internal/pencegahan/kelola-rpkbgl" class="stat-card">
                    <div class="stat-ico ic-primary"><i class="fas fa-building"></i></div>
                    <div>
                        <div class="stat-title">Permohonan RPKBGL</div>
                        <div class="stat-value">
                            {{ \Illuminate\Support\Facades\Schema::hasTable('permohonan_rpkbgl') ? \Illuminate\Support\Facades\DB::table('permohonan_rpkbgl')->count() : 0 }}
                        </div>
                    </div>
                </a>

                <a href="/internal/pencegahan/kelola-skk" class="stat-card">
                    <div class="stat-ico ic-primary"><i class="fas fa-shield-halved"></i></div>
                    <div>
                        <div class="stat-title">Permohonan SKK (Total)</div>
                        <div class="stat-value">
                            @php
                                $skkBaru = \Illuminate\Support\Facades\Schema::hasTable('permohonan_skk') ? \Illuminate\Support\Facades\DB::table('permohonan_skk')->count() : 0;
                                $skkPerpanjang = \Illuminate\Support\Facades\Schema::hasTable('permohonan_perpanjang_skk') ? \Illuminate\Support\Facades\DB::table('permohonan_perpanjang_skk')->count() : 0;
                            @endphp
                            {{ $skkBaru + $skkPerpanjang }}
                        </div>
                    </div>
                </a>

                <a href="/internal/pencegahan/kelola-edukasi" class="stat-card">
                    <div class="stat-ico ic-primary"><i class="fas fa-bullhorn"></i></div>
                    <div>
                        <div class="stat-title">Permohonan Edukasi</div>
                        <div class="stat-value">
                            {{ \Illuminate\Support\Facades\Schema::hasTable('permohonan_edukasi') ? \Illuminate\Support\Facades\DB::table('permohonan_edukasi')->count() : 0 }}
                        </div>
                    </div>
                </a>

                <a href="/internal/pencegahan/kelola-redkar" class="stat-card">
                    <div class="stat-ico ic-primary"><i class="fas fa-users"></i></div>
                    <div>
                        <div class="stat-title">Kelola Redkar</div>
                        <div class="stat-value">
                            {{ \Illuminate\Support\Facades\Schema::hasTable('redkar') ? \Illuminate\Support\Facades\DB::table('redkar')->count() : 0 }}
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- 2. BAGIAN PEMADAMAN -->
        <div class="mb-5">
            <div class="section-heading">
                <span class="section-heading-ico"><i class="fas fa-fire-extinguisher"></i></span>
                <h3>Bagian Pemadaman</h3>
                <span class="line"></span>
            </div>

            <div class="stats-grid">
                <a href="/internal/damtan/data-laporan" class="stat-card">
                    <div class="stat-ico ic-danger"><i class="fas fa-fire"></i></div>
                    <div>
                        <div class="stat-title">Siaga Darurat (Pemadaman)</div>
                        <div class="stat-value">0</div>
                    </div>
                </a>

                <a href="/internal/surat-korban/create" class="stat-card">
                    <div class="stat-ico ic-primary"><i class="fas fa-file-signature"></i></div>
                    <div>
                        <div class="stat-title">Surat Korban Terbit</div>
                        <div class="stat-value">0</div>
                    </div>
                </a>
            </div>
        </div>

        <!-- 3. BAGIAN SAPRA -->
        <div class="mb-4">
            <div class="section-heading">
                <span class="section-heading-ico"><i class="fas fa-warehouse"></i></span>
                <h3>Bagian Sarana &amp; Prasarana</h3>
                <span class="line"></span>
            </div>

            <div class="stats-grid">
                <a href="/sapra/data-hidrant-kota" class="stat-card">
                    <div class="stat-ico ic-info"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <div class="stat-title">Total Hidrant Kota</div>
                        <div class="stat-value">
                            {{ \Illuminate\Support\Facades\Schema::hasTable('hidran_kota') ? \Illuminate\Support\Facades\DB::table('hidran_kota')->count() : 0 }}
                        </div>
                    </div>
                </a>
            </div>
        </div>

        @endif

    </main>
</div>

<script>
(function () {
    'use strict';

    /* ---------- Notifikasi ---------- */
    document.querySelectorAll('[data-toast]').forEach(function (t) {
        var hide = function () {
            t.classList.add('leaving');
            setTimeout(function () { t.remove(); }, 350);
        };
        var x = t.querySelector('[data-toast-close]');
        if (x) x.addEventListener('click', hide);
        setTimeout(hide, 4500);
    });

    /* ---------- Sidebar (mobile) ---------- */
    var toggle = document.getElementById('sideToggle');
    var backdrop = document.getElementById('sideBackdrop');

    function closeSide() {
        document.body.classList.remove('side-open');
        if (toggle) toggle.setAttribute('aria-expanded', 'false');
    }
    if (toggle) {
        toggle.addEventListener('click', function () {
            var open = document.body.classList.toggle('side-open');
            toggle.setAttribute('aria-expanded', open);
        });
    }
    if (backdrop) backdrop.addEventListener('click', closeSide);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeSide(); });

    /* ---------- Hanya satu grup sidebar terbuka pada satu waktu ---------- */
    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) {
                groups.forEach(function (o) { if (o !== g) o.open = false; });
            }
        });
    });
})();
</script>
</body>
</html>
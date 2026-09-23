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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ==========================================================
           TOKENS
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
            --green: #16a34a;
            --teal: #0d9488;
            --blue: #2563eb;
            --purple: #9333ea;
            --steel: #5b6c7f;
            --line: #dbe2ea;

            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;

            --r-lg: 22px;
            --r-md: 16px;
            --r-sm: 10px;
            --sidebar-w: 272px;
            --topbar-h: 66px;
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
        ul, ol { list-style: none; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
        :focus-visible { outline: 3px solid var(--amber); outline-offset: 2px; border-radius: 6px; }

        /* ==========================================================
           NOTIFIKASI (TOAST)
           ========================================================== */
        .toast-wrap { position: fixed; z-index: 200; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
        .toast {
            display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px;
            border-radius: 999px; background: #fff; border: 1px solid var(--line);
            box-shadow: 0 20px 40px -16px rgba(13,27,42,.5); font-weight: 600; font-size: .92rem;
            animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both;
        }
        .toast.leaving { animation: toastOut .3s ease forwards; }
        .toast-ico { flex: none; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; color: #fff; font-size: .78rem; }
        .toast.ok .toast-ico { background: var(--green); }
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
            padding: 0 20px 0 clamp(16px, 2vw, 24px); background: rgba(255,255,255,.85);
            -webkit-backdrop-filter: blur(14px); backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--line);
        }
        .topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .side-toggle { display: none; width: 40px; height: 40px; border-radius: 12px; align-items: center; justify-content: center; font-size: 1.05rem; }
        .side-toggle:hover { background: var(--paper); }
        .brand { display: flex; align-items: center; gap: 12px; min-width: 0; }
        .brand img { height: 34px; width: auto; flex: none; }
        .brand span { font-family: var(--font-display); font-weight: 800; font-stretch: 90%; font-size: 1.05rem; letter-spacing: -0.01em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        .topbar-right { display: flex; align-items: center; gap: 14px; }
        .user-chip { display: flex; align-items: center; gap: 10px; padding: 6px 14px 6px 6px; border-radius: 999px; background: var(--paper); }
        .user-avatar { width: 34px; height: 34px; border-radius: 50%; background: var(--ink); color: #fff; display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .85rem; flex: none; }
        .user-meta { display: grid; line-height: 1.25; }
        .user-meta strong { font-size: .85rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .user-meta small { font-size: .72rem; color: var(--steel); text-transform: capitalize; }
        .btn-logout { display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 18px; border-radius: 999px; background: var(--signal); color: #fff; font-weight: 700; font-size: .85rem; transition: background .2s; }
        .btn-logout:hover { background: var(--signal-d); }

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
        }
        .side-link {
            display: flex; align-items: center; gap: 13px; padding: 12px 14px; border-radius: 13px;
            font-size: .87rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s;
        }
        .side-link:hover { background: var(--paper); }
        .side-link.active { background: var(--ink); color: #fff; }
        .side-link i { width: 18px; text-align: center; font-size: .95rem; color: var(--steel); }
        .side-link.active i { color: var(--amber); }

        .side-group + .side-group { margin-top: 6px; }
        .side-group summary {
            list-style: none; cursor: pointer; display: flex; align-items: center; gap: 10px;
            padding: 12px 14px; border-radius: 13px; font-size: .78rem; font-weight: 800;
            letter-spacing: .04em; text-transform: uppercase; color: var(--steel); transition: background .2s, color .2s;
        }
        .side-group summary::-webkit-details-marker { display: none; }
        .side-group summary:hover { background: var(--paper); color: var(--ink); }
        .side-group[open] > summary { color: var(--signal-d); }
        .side-group summary .chev { margin-left: auto; font-size: .68rem; transition: transform .2s; }
        .side-group[open] summary .chev { transform: rotate(180deg); }

        .side-sub { display: grid; gap: 2px; padding: 4px 2px 8px 10px; border-left: 2px solid var(--line); margin: 2px 0 4px 22px; }
        .side-sub a { display: flex; align-items: flex-start; gap: 11px; padding: 9px 12px; border-radius: 11px; font-size: .82rem; font-weight: 600; line-height: 1.4; color: var(--steel); transition: background .2s, color .2s; }
        .side-sub a:hover { background: var(--paper); color: var(--ink); }
        .side-sub a.active { background: #fdeceb; color: var(--signal-d); }
        .side-sub a i { width: 16px; text-align: center; font-size: .85rem; margin-top: 2px; color: inherit; opacity: .75; }
        .side-kicker { padding: 14px 12px 4px; font-size: .68rem; font-weight: 800; letter-spacing: .05em; text-transform: uppercase; color: #a9b6c4; }

        .sidebar-backdrop { display: none; }

        @media (max-width: 900px) {
            .sidebar {
                position: fixed; z-index: 90; top: var(--topbar-h); left: 0;
                height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%);
                transition: transform .3s ease; box-shadow: 24px 0 48px -24px rgba(13,27,42,.4);
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
        .content { flex: 1; min-width: 0; padding: clamp(20px, 3vw, 40px) clamp(18px, 3vw, 44px) 60px; }

        .page-head { margin-bottom: 24px; }
        .page-head h1 { font-family: var(--font-display); font-weight: 800; font-stretch: 88%; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.15; letter-spacing: -0.02em; }
        .page-head p { margin-top: 6px; color: var(--steel); font-size: .95rem; }

        .welcome {
            position: relative; overflow: hidden; border-radius: var(--r-lg);
            background: linear-gradient(120deg, var(--ink-2), var(--ink) 60%);
            padding: clamp(26px, 4vw, 40px); color: #fff; margin-bottom: 28px;
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
            position: relative; overflow: hidden; display: flex; flex-direction: column; gap: 14px;
            padding: 20px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md);
            transition: transform .25s, box-shadow .25s, border-color .25s;
        }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 20px 36px -18px rgba(13,27,42,.32); border-color: transparent; }
        .stat-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; }
        .stat-ico { width: 42px; height: 42px; border-radius: 12px; display: grid; place-items: center; font-size: 1.05rem; color: #fff; flex: none; }
        .stat-arrow { color: var(--steel); font-size: .8rem; opacity: 0; transform: translate(-3px, 3px); transition: opacity .2s, transform .2s; }
        .stat-card:hover .stat-arrow { opacity: 1; transform: none; }
        .stat-title { font-size: .78rem; font-weight: 700; letter-spacing: .02em; text-transform: uppercase; color: var(--steel); }
        .stat-value { font-family: var(--font-display); font-weight: 800; font-stretch: 85%; font-size: 1.9rem; line-height: 1; letter-spacing: -0.01em; }

        .ic-green  { background: var(--green); }
        .ic-teal   { background: var(--teal); }
        .ic-purple { background: var(--purple); }
        .ic-blue   { background: var(--blue); }
        .ic-orange { background: var(--amber); color: var(--ink); }
        .ic-red    { background: var(--signal); }

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

            <details class="side-group" {{ Request::is('internal/pencegahan*') ? 'open' : '' }}>
                <summary>Bagian pencegahan <i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/pencegahan/peningkatan-kapasitas" class="{{ Request::is('internal/pencegahan/peningkatan-kapasitas*') ? 'active' : '' }}">
                        <i class="fas fa-level-up-alt"></i> Peningkatan kapasitas aparatur
                    </a>
                    <a href="/internal/pencegahan/inspeksi-kebakaran" class="{{ Request::is('internal/pencegahan/inspeksi-kebakaran*') ? 'active' : '' }}">
                        <i class="fas fa-magnifying-glass"></i> Pencegahan kebakaran dan inspeksi
                    </a>
                    <a href="#">
                        <i class="fas fa-people-group"></i> Pemberdayaan masyarakat dan dunia usaha
                    </a>
                </div>
            </details>

            <details class="side-group" {{ Request::is('internal/damtan*') ? 'open' : '' }}>
                <summary>Bagian pemadaman <i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/damtan/input-data" class="{{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}">
                        <i class="fas fa-fire-extinguisher"></i> Input data
                    </a>
                    <a href="/internal/damtan/data-laporan" class="{{ Request::is('internal/damtan/data-laporan*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i> Data laporan
                    </a>
                </div>
            </details>

            <details class="side-group" {{ Request::is('sapra*') ? 'open' : '' }}>
                <summary>Bagian sapra <i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <span class="side-kicker" style="padding-left:2px;">Sarana &amp; Prasarana</span>
                     <a href="/sapra/sarana-mako" class="{{ Request::is('sapra/sarana-mako*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Sarana Pemadam Kebakaran</a>
                    <a href="/sapra/prasarana-mako" class="{{ Request::is('sapra/prasarana-mako*') ? 'active' : '' }}"><i class="fas fa-building"></i> Prasarana pemadam Kebakaran</a>
                    <a href="/sapra/sarana-penyelamatan" class="{{ Request::is('sapra/sarana-penyelamatan*') ? 'active' : '' }}"><i class="fas fa-life-ring"></i> Sarana penyelamatan & Evakuasi</a>
                          <a href="/sapra/sarana-pemeriksaan" class="sidebar-item"><i class="fas fa-search"></i> Sarana Pemeriksaan Proteksi Kebakaran</a> 
                    <a href="/sapra/kelola-pos" class="{{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}"><i class="fas fa-warehouse"></i> Kelola data pos</a>

                      <span class="side-kicker" style="padding-left:2px;">Manajemen air</span>
                    <a href="/sapra/data_hidrant_gedung" class="{{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}"><i class="fas fa-droplet"></i> Sumber air</a>
                    <a href="/sapra/data-hidrant-kota" class="{{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}"><i class="fas fa-map-marker-alt"></i> Data hidrant Kota Jambi</a>

                    <!-- LOGISTIK & DISTRIBUSI -->
                         <span class="side-kicker" style="padding-left:2px;">Logistik & Distribusi</span>
                        <a href="/sapra/kebutuhan-sarpras" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>
                        <a href="/sapra/distribusi-staff" class="sidebar-item"><i class="fas fa-user-check"></i> Distribusi Barang Staff</a>
                </div>
            </details>
        @endif

        @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
            <div class="side-kicker">Konten publik</div>
            <details class="side-group" {{ Request::is('internal/operator*') ? 'open' : '' }}>
                <summary>Manajemen berita <i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/operator/kelola-berita" class="{{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}"><i class="fas fa-newspaper"></i> Input &amp; kelola berita</a>
                    <a href="/internal/operator/infografis" class="{{ Request::is('internal/operator/infografis*') ? 'active' : '' }}"><i class="far fa-image"></i> Kelola info grafis</a>
                    <a href="/internal/operator/berita-medsos" class="{{ Request::is('internal/operator/berita-medsos*') ? 'active' : '' }}"><i class="fab fa-instagram"></i> Kelola berita medsos</a>
                </div>
            </details>
        @endif

        <div class="side-kicker">Akun</div>
        <details class="side-group" {{ Request::is('internal/profil*') || Request::is('internal/kelola-user*') ? 'open' : '' }}>
            <summary>Pengaturan akun <i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="/internal/profil" class="{{ Request::is('internal/profil*') ? 'active' : '' }}"><i class="fas fa-user-pen"></i> Profil saya</a>
                @if(Auth::user()->role === 'super_user')
                    <a href="/internal/kelola-user" class="{{ Request::is('internal/kelola-user*') ? 'active' : '' }}"><i class="fas fa-users-gear"></i> Kelola semua pengguna</a>
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
        <div class="stats-head">
            <h3>Ringkasan modul</h3>
        </div>
        <div class="stats-grid">

            <a href="/internal/pencegahan/kelola-rpkbgl" class="stat-card">
                <div class="stat-top">
                    <span class="stat-ico ic-green"><i class="fas fa-building"></i></span>
                    <i class="fas fa-arrow-right stat-arrow"></i>
                </div>
                <div>
                    <div class="stat-title">Permohonan RPKBGL</div>
                    <div class="stat-value">{{ \Illuminate\Support\Facades\DB::table('permohonan_rpkbgl')->count() }}</div>
                </div>
            </a>

            <a href="/internal/pencegahan/kelola-skk" class="stat-card">
                <div class="stat-top">
                    <span class="stat-ico ic-teal"><i class="fas fa-shield-halved"></i></span>
                    <i class="fas fa-arrow-right stat-arrow"></i>
                </div>
                <div>
                    <div class="stat-title">Permohonan SKK (total)</div>
                    <div class="stat-value">{{ \Illuminate\Support\Facades\DB::table('permohonan_skk')->count() + \Illuminate\Support\Facades\DB::table('permohonan_perpanjang_skk')->count() }}</div>
                </div>
            </a>

            <a href="/internal/pencegahan/kelola-edukasi" class="stat-card">
                <div class="stat-top">
                    <span class="stat-ico ic-purple"><i class="fas fa-bullhorn"></i></span>
                    <i class="fas fa-arrow-right stat-arrow"></i>
                </div>
                <div>
                    <div class="stat-title">Permohonan edukasi</div>
                    <div class="stat-value">{{ \Illuminate\Support\Facades\DB::table('permohonan_edukasi')->count() }}</div>
                </div>
            </a>

            <a href="/internal/pencegahan/layanan-inspeksi" class="stat-card">
                <div class="stat-top">
                    <span class="stat-ico ic-blue"><i class="fas fa-clipboard-check"></i></span>
                    <i class="fas fa-arrow-right stat-arrow"></i>
                </div>
                <div>
                    <div class="stat-title">Layanan inspeksi</div>
                    <div class="stat-value">24</div>
                </div>
            </a>

            <a href="/internal/pencegahan/pelatihan" class="stat-card">
                <div class="stat-top">
                    <span class="stat-ico ic-purple"><i class="fas fa-chalkboard-user"></i></span>
                    <i class="fas fa-arrow-right stat-arrow"></i>
                </div>
                <div>
                    <div class="stat-title">Pelatihan aktif</div>
                    <div class="stat-value">5</div>
                </div>
            </a>

            <a href="/internal/pencegahan/pembinaan-pengembangan" class="stat-card">
                <div class="stat-top">
                    <span class="stat-ico ic-orange"><i class="fas fa-chart-line"></i></span>
                    <i class="fas fa-arrow-right stat-arrow"></i>
                </div>
                <div>
                    <div class="stat-title">Pembinaan &amp; pengembangan</div>
                    <div class="stat-value">8</div>
                </div>
            </a>

            <a href="/internal/pencegahan/peningkatan-kapasitas" class="stat-card">
                <div class="stat-top">
                    <span class="stat-ico ic-red"><i class="fas fa-arrow-trend-up"></i></span>
                    <i class="fas fa-arrow-right stat-arrow"></i>
                </div>
                <div>
                    <div class="stat-title">Peningkatan kapasitas</div>
                    <div class="stat-value">3</div>
                </div>
            </a>

            <a href="/internal/damtan/data-laporan" class="stat-card">
                <div class="stat-top">
                    <span class="stat-ico ic-red"><i class="fas fa-fire"></i></span>
                    <i class="fas fa-arrow-right stat-arrow"></i>
                </div>
                <div>
                    <div class="stat-title">Siaga darurat (pemadaman)</div>
                    <div class="stat-value">3</div>
                </div>
            </a>

            <a href="/sapra/data-hidrant-kota" class="stat-card">
                <div class="stat-top">
                    <span class="stat-ico ic-blue"><i class="fas fa-map-marker-alt"></i></span>
                    <i class="fas fa-arrow-right stat-arrow"></i>
                </div>
                <div>
                    <div class="stat-title">Total hidrant kota</div>
                    <div class="stat-value">{{ \Illuminate\Support\Facades\DB::table('hidran_kota')->count() }}</div>
                </div>
            </a>

            <a href="/sapra/prasarana-mako" class="stat-card">
                <div class="stat-top">
                    <span class="stat-ico ic-orange"><i class="fas fa-warehouse"></i></span>
                    <i class="fas fa-arrow-right stat-arrow"></i>
                </div>
                <div>
                    <div class="stat-title">Prasarana mako &amp; pos</div>
                    <div class="stat-value">{{ \Illuminate\Support\Facades\DB::table('prasarana')->count() }}</div>
                </div>
            </a>

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
        toggle.setAttribute('aria-expanded', 'false');
    }
    toggle.addEventListener('click', function () {
        var open = document.body.classList.toggle('side-open');
        toggle.setAttribute('aria-expanded', open);
    });
    backdrop.addEventListener('click', closeSide);
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
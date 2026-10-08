@php abort_unless(auth()->check() && auth()->user()->hasAnyRole(['Operator', 'Super User']), 403); @endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Input Titik Peta | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Leaflet CSS untuk Peta Interaktif -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css">

    <style>
:root {
    --ink: #0d1b2a;
    --ink-2: #132a43;
    --ink-3: #1d3856;
    --navy: #163a63;
    --navy-dark: #0d2947;
    --navy-light: #eaf1f8;
    --navy-soft: rgba(22, 58, 99, .08);
    --paper: #f5f7fa;
    --white: #ffffff;
    --signal: #dc3545;
    --signal-dark: #b42332;
    --signal-soft: rgba(220, 53, 69, .09);
    --amber: #f4b740;
    --success: #198754;
    --info: #2563eb;
    --info-soft: rgba(37, 99, 235, .09);
    --steel: #64748b;
    --steel-soft: #94a3b8;
    --line: #e2e8f0;
    --line-dark: #d5dce6;
    --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
    --font-body: 'Instrument Sans', system-ui, sans-serif;
    --r-lg: 18px;
    --r-md: 14px;
    --r-sm: 10px;
    --sidebar-w: 272px;
    --topbar-h: 70px;
    --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
    --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
    --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
    --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body { font-family: var(--font-body); font-size: 1rem; line-height: 1.6; color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased; }
img { max-width: 100%; display: block; }
a { color: inherit; text-decoration: none; }
ul, ol { list-style: none; margin: 0; padding: 0; }
button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
:focus-visible { outline: 3px solid var(--amber); outline-offset: 2px; border-radius: 6px; }

/* TOAST */
.toast-wrap { position: fixed; z-index: 1090; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
.toast-item { display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px; border-radius: 999px; background: #ffffff; border: 1px solid var(--line); box-shadow: var(--shadow-md); font-weight: 600; font-size: .92rem; animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both; }
.toast-item.leaving { animation: toastOut .3s ease forwards; }
.toast-ico { flex: none; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; color: #fff; font-size: .78rem; }
.toast-item.ok .toast-ico { background: var(--success); }
.toast-item.err .toast-ico { background: var(--signal); }
.toast-x { flex: none; width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; }
.toast-x:hover { background: var(--ink); color: #fff; }
@keyframes toastIn { from { opacity: 0; transform: translateY(-14px); } to { opacity: 1; transform: none; } }
@keyframes toastOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(-14px); } }

/* TOPBAR */
.topbar { position: sticky; top: 0; z-index: 1000; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
.topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
.side-toggle { display: none; width: 40px; height: 40px; border-radius: 10px; align-items: center; justify-content: center; font-size: 1.05rem; color: #fff; transition: background .2s, transform .2s; }
.side-toggle:hover { background: rgba(255,255,255,.10); }
.brand { display: flex; align-items: center; gap: 12px; min-width: 0; color: #fff; }
.brand img { height: 34px; width: auto; flex: none; }
.brand span { font-family: var(--font-display); font-weight: 700; font-size: 1.08rem; letter-spacing: -.01em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: #fff; }
.topbar-right { display: flex; align-items: center; gap: 12px; }
.user-chip { display: flex; align-items: center; gap: 10px; padding: 5px 14px 5px 5px; border-radius: 999px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); }
.user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #ffffff; color: var(--ink); display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
.user-meta { display: grid; line-height: 1.25; }
.user-meta strong { font-size: .84rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #ffffff; }
.user-meta small { font-size: .72rem; color: rgba(255,255,255,.62); text-transform: capitalize; font-weight: 500; }
.btn-logout { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #ffffff; color: var(--ink); font-weight: 600; font-size: .84rem; transition: background .2s, transform .1s; }
.btn-logout:hover { background: #e8eef5; }

/* SHELL & SIDEBAR */
.shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
.sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
.side-link { display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .89rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s, transform .2s; margin-bottom: 4px; }
.side-link:hover { background: #f3f6fa; transform: translateX(1px); }
.side-link.active { background: var(--ink); color: #ffffff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
.side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); }
.side-link.active i { color: #ffffff; }
.side-group + .side-group { margin-top: 6px; }
.side-group summary { list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--navy); user-select: none; }
.side-group summary::-webkit-details-marker { display: none; }
.side-group summary:hover { background: #f3f6fa; }
.side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); }
.side-group summary .grp-label { flex: 1 1 auto; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; }
.side-group[open] summary .chev { transform: rotate(180deg); }
.side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
.side-sub a { display: flex; align-items: center; gap: 12px; padding: 9px 12px; border-radius: var(--r-sm); font-size: .84rem; font-weight: 500; line-height: 1.4; color: var(--steel); transition: background .2s, color .2s, transform .2s; }
.side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); transform: translateX(2px); }
.side-sub a.active { background: var(--navy-soft); color: var(--navy); font-weight: 600; }
.side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; }
.side-sub a:hover i, .side-sub a.active i { opacity: 1; }
.side-kicker { padding: 18px 14px 6px; font-size: .68rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--steel-soft); }
.sidebar-backdrop { display: none; }

@media (max-width: 900px) {
    .side-toggle { display: inline-flex; }
    .user-meta { display: none; }
    .sidebar { position: fixed; z-index: 90; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg); }
    body.side-open .sidebar { transform: none; }
    .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
    body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
}

/* CONTENT */
.content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
.page-head-bar { display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 18px; margin-bottom: 28px; }
.page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
.page-head p { color: var(--steel); font-size: .95rem; margin: 0; }

.section-heading { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; flex-wrap: nowrap; }
.section-heading-ico { flex: none; width: 32px; height: 32px; border-radius: 9px; background: var(--navy); color: #fff; display: grid; place-items: center; font-size: .78rem; box-shadow: 0 4px 8px rgba(22,58,99,.12); }
.section-heading h3 { flex: none; font-family: var(--font-display); font-weight: 700; font-size: 1rem; color: var(--ink); letter-spacing: -.01em; white-space: nowrap; margin: 0; }
.section-heading .line { flex: 1 1 auto; min-width: 24px; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }
.count-pill { flex: none; display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: 999px; background: var(--navy-soft); color: var(--navy); font-size: .78rem; font-weight: 700; }

/* BUTTONS & TABLE */
.btn-simerah-danger { background: var(--signal); color: #ffffff; font-weight: 600; font-size: .9rem; border-radius: var(--r-sm); padding: 11px 20px; display: inline-flex; align-items: center; justify-content: center; gap: 9px; border: none; box-shadow: 0 4px 12px rgba(220, 53, 69, .22); transition: background .2s, transform .15s, box-shadow .2s; }
.btn-simerah-danger:hover { background: var(--signal-dark); color: #ffffff; transform: translateY(-1px); }
.btn-simerah-secondary { background: var(--paper); color: var(--ink); font-weight: 600; font-size: .88rem; border-radius: var(--r-sm); padding: 10px 18px; border: 1px solid var(--line-dark); display: inline-flex; align-items: center; justify-content: center; gap: 8px; transition: background .2s; }
.btn-simerah-secondary:hover { background: var(--line); color: var(--ink); }

.card-box { background: #ffffff; border-radius: var(--r-md); border: 1px solid var(--line); box-shadow: var(--shadow-xs); overflow: hidden; }
.table-simerah { margin-bottom: 0; }
.table-simerah thead th { font-family: var(--font-display); font-size: .76rem; text-transform: uppercase; letter-spacing: .05em; font-weight: 700; color: var(--steel); background-color: #f8fafc; border-bottom: 1px solid var(--line); padding: 15px 20px; white-space: nowrap; }
.table-simerah tbody td { padding: 16px 20px; border-bottom: 1px solid var(--line); vertical-align: middle; }
.table-simerah tbody tr:last-child td { border-bottom: none; }
.table-simerah tbody tr:hover { background-color: #f9fbfd; }

.row-num { display: inline-grid; place-items: center; width: 30px; height: 30px; border-radius: 8px; background: var(--paper); color: var(--steel); font-family: var(--font-display); font-weight: 700; font-size: .84rem; }

.action-group { display: inline-flex; align-items: center; gap: 8px; }
.btn-edit-item { display: inline-flex; align-items: center; gap: 6px; padding: 8px 13px; border-radius: var(--r-sm); font-size: .82rem; font-weight: 600; color: var(--navy); background: var(--navy-soft); transition: background .2s, color .2s; }
.btn-edit-item:hover { background: var(--navy); color: #ffffff; }
.btn-delete-item { display: inline-flex; align-items: center; gap: 6px; padding: 8px 13px; border-radius: var(--r-sm); font-size: .82rem; font-weight: 600; color: var(--signal-dark); background: var(--signal-soft); transition: background .2s, color .2s; }
.btn-delete-item:hover { background: var(--signal); color: #ffffff; }

.empty-state { padding: 48px 24px; text-align: center; }
.empty-ico { width: 56px; height: 56px; border-radius: 16px; background: var(--navy-soft); color: var(--navy); display: grid; place-items: center; font-size: 1.5rem; margin: 0 auto 14px; }
.empty-state h4 { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; color: var(--ink); margin-bottom: 6px; }
.empty-state p { color: var(--steel); font-size: .88rem; max-width: 42ch; margin: 0 auto 18px; }

/* FORM (sama dengan modal Edu Damkar) */
.form-label { font-size: .84rem; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
.form-control, .form-select { border-radius: var(--r-sm); border: 1px solid var(--line-dark); padding: 10px 14px; font-size: .92rem; color: var(--ink); min-height: 44px; box-shadow: none; }
.form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
.form-control::placeholder { color: var(--steel-soft); }
textarea.form-control { min-height: 100px; }
.input-group-text { background: var(--paper); border-color: var(--line-dark); color: var(--steel); border-radius: var(--r-sm) 0 0 var(--r-sm); }
.input-group > .form-control, .input-group > .form-select { border-radius: 0 var(--r-sm) var(--r-sm) 0; }
.form-hint { display: block; font-size: .78rem; color: var(--steel); margin-top: 6px; }

.form-card { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 26px; box-shadow: var(--shadow-xs); height: 100%; }
.card-title-custom { display: flex; align-items: center; gap: 10px; margin-bottom: 22px; padding-bottom: 14px; border-bottom: 1px solid var(--line); font-family: var(--font-display); font-size: 1.05rem; font-weight: 700; color: var(--ink); }
.card-title-custom .section-heading-ico { box-shadow: none; }
.form-actions { display: flex; flex-wrap: wrap; gap: 10px; justify-content: flex-end; margin-top: 8px; padding-top: 18px; border-top: 1px solid var(--line); }
.form-alert { display: flex; gap: 12px; padding: 14px 18px; margin-bottom: 22px; border-radius: var(--r-md); background: var(--signal-soft); border: 1px solid rgba(220,53,69,.25); color: var(--signal-dark); font-size: .88rem; }
.form-alert i { margin-top: 4px; }
.form-alert ul { list-style: disc; padding-left: 18px; margin-top: 4px; }
.tip-box { display: flex; gap: 10px; padding: 12px 14px; border-radius: var(--r-sm); background: var(--navy-light); color: var(--navy-dark); font-size: .82rem; margin-bottom: 18px; }
.tip-box i { margin-top: 3px; }
#mapPicker { border: 1px solid var(--line-dark); border-radius: var(--r-md); z-index: 1; }

/* Badge kategori peta */
.badge-custom { display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; border-radius: 999px; font-weight: 700; font-size: .72rem; text-transform: uppercase; letter-spacing: .05em; background: var(--line); color: #475569; }
.bg-kebakaran { background: rgba(220, 53, 69, .10); color: #b42332; }
.bg-sumber_air { background: rgba(13, 110, 253, .10); color: #0d6efd; }
.bg-hydrant { background: rgba(25, 135, 84, .10); color: #198754; }
.bg-penyelamatan { background: rgba(244, 183, 64, .16); color: #9a6b00; }
.bg-pos { background: rgba(100, 116, 139, .12); color: #475569; }
.coord-text { font-size: .76rem; color: var(--steel); }

/* DataTables menyesuaikan gaya Edu Damkar */
div.dataTables_wrapper { padding: 18px 20px 14px; }
div.dataTables_wrapper div.dataTables_filter input, div.dataTables_wrapper div.dataTables_length select { border-radius: var(--r-sm); border: 1px solid var(--line-dark); padding: 7px 12px; font-size: .88rem; }
div.dataTables_wrapper div.dataTables_filter input:focus, div.dataTables_wrapper div.dataTables_length select:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
div.dataTables_wrapper div.dataTables_info, div.dataTables_wrapper label { font-size: .84rem; color: var(--steel); }
table.dataTable.table-simerah { border-collapse: collapse !important; margin-top: 14px !important; margin-bottom: 14px !important; }
table.dataTable.table-simerah > thead > tr > th { border-bottom: 1px solid var(--line); }
.page-item.active .page-link { background-color: var(--navy); border-color: var(--navy); }
.page-link { color: var(--navy); }

@media (max-width: 700px) {
    :root { --topbar-h: 64px; }
    .topbar { height: var(--topbar-h); padding: 0 14px; }
    .user-chip { padding: 3px; border: none; background: transparent; }
    .btn-logout { width: 38px; height: 38px; padding: 0; border-radius: 10px; font-size: 0; }
    .btn-logout i { font-size: .9rem; }
    .content { padding: 26px 16px 50px; }
    .form-card { padding: 20px; }
    .btn-simerah-danger.w-mobile-100 { width: 100%; }
    .form-actions > * { flex: 1 1 100%; }
}

    </style>
</head>
<body>

<!-- TOAST NOTIFICATION -->
<div class="toast-wrap" id="toastWrap" aria-live="polite">
    @if(session('success'))
        <div class="toast-item ok" data-toast>
            <span class="toast-ico"><i class="fas fa-check"></i></span>
            <span>{{ session('success') }}</span>
            <button type="button" class="toast-x" aria-label="Tutup" data-toast-close><i class="fas fa-times"></i></button>
        </div>
    @endif
    @if(session('error') || $errors->any())
        <div class="toast-item err" data-toast>
            <span class="toast-ico"><i class="fas fa-triangle-exclamation"></i></span>
            <span>{{ session('error') ?? $errors->first() }}</span>
            <button type="button" class="toast-x" aria-label="Tutup" data-toast-close><i class="fas fa-times"></i></button>
        </div>
    @endif
</div>

<!-- TOPBAR -->
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
            <span class="user-avatar">{{ strtoupper(substr(Auth::user()->nama_lengkap ?? 'O', 0, 1)) }}</span>
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

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar" aria-label="Navigasi internal">
        <a href="/internal/index" class="side-link {{ Request::is('internal/index') ? 'active' : '' }}">
            <i class="fas fa-house"></i><span class="lbl">Dashboard utama</span>
        </a>

        <!-- SEMUA MENU DITAMPILKAN KEPADA SEMUA ROLE -->
        @hasanyrole('Super User|Sapra|Damtan|Pencegahan|Sekretariat|Operator')

            <div class="side-kicker">Modul operasional</div>

            <!-- BAGIAN PENCEGAHAN -->
            <details class="side-group" {{ Request::is('internal/pencegahan*') ? 'open' : '' }}>
                <summary><i class="fas fa-shield-halved grp-ico"></i><span class="grp-label">Bagian pencegahan</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/pencegahan/peningkatan-kapasitas" class="{{ Request::is('internal/pencegahan/peningkatan-kapasitas*') ? 'active' : '' }}">
                        <i class="fas fa-arrow-trend-up"></i><span class="lbl">Peningkatan Kapasitas Aparatur</span>
                    </a>
                    <a href="/internal/pencegahan/inspeksi-kebakaran" class="{{ Request::is('internal/pencegahan/inspeksi-kebakaran*') ? 'active' : '' }}">
                        <i class="fas fa-magnifying-glass-chart"></i><span class="lbl">Pencegahan Kebakaran dan Inspeksi</span>
                    </a>
                    <a href="/internal/pencegahan/pemberdayaan-masyarakat" class="{{ Request::is('internal/pencegahan/pemberdayaan-masyarakat*') ? 'active' : '' }}">
                        <i class="fas fa-handshake-angle"></i><span class="lbl">Pemberdayaan Masyarakat dan Dunia Usaha</span>
                    </a>
                    <a href="/internal/pencegahan/kelola-edukasi" class="{{ Request::is('internal/pencegahan/kelola-edukasi*') ? 'active' : '' }}">
                        <i class="fas fa-bullhorn"></i><span class="lbl">Kelola Edukasi</span>
                    </a>
                    <a href="/internal/pencegahan/kelola-redkar" class="{{ Request::is('internal/pencegahan/kelola-redkar*') ? 'active' : '' }}">
                        <i class="fas fa-users-rectangle"></i><span class="lbl">Kelola Redkar</span>
                    </a>
                    <a href="/internal/pencegahan/kelola-rpkbgl" class="{{ Request::is('internal/pencegahan/kelola-rpkbgl*') ? 'active' : '' }}">
                        <i class="fas fa-building-circle-check"></i><span class="lbl">Kelola RPKBGL</span>
                    </a>
                    <a href="/internal/pencegahan/kelola-skk" class="{{ Request::is('internal/pencegahan/kelola-skk*') ? 'active' : '' }}">
                        <i class="fas fa-file-shield"></i><span class="lbl">Kelola SKK</span>
                    </a>
                </div>
            </details>

           <!-- BAGIAN PEMADAMAN -->
            <details class="side-group" {{ Request::is('internal/damtan*') || Request::is('internal/surat-korban*') || Request::is('internal/damtan/kelola-izin-keramaian*') ? 'open' : '' }}>
                <summary><i class="fas fa-fire-extinguisher grp-ico"></i><span class="grp-label">Bagian pemadaman</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/damtan/input-data" class="{{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}">
                        <i class="fas fa-fire-extinguisher"></i><span class="lbl">Input data</span>
                    </a>
                    <a href="/internal/damtan/rekap-layanan" class="{{ Request::is('internal/damtan/rekap-layanan*') ? 'active' : '' }}">
                        <i class="fas fa-truck-medical"></i><span class="lbl">Input Rekap Layanan</span>
                    </a>
                    <a href="/internal/damtan/rekap-objek" class="{{ Request::is('internal/damtan/rekap-objek*') ? 'active' : '' }}">
                        <i class="fas fa-house-chimney-crack"></i><span class="lbl">Input Rekap Objek Kebakaran</span>
                    </a>
                    <a href="/internal/surat-korban/create" class="{{ Request::is('internal/surat-korban/create*') ? 'active' : '' }}">
                        <i class="fas fa-file-signature"></i><span class="lbl">Buat Surat Korban</span>
                    </a>
                    <a href="/internal/damtan/data-laporan" class="{{ Request::is('internal/damtan/data-laporan*') || Request::is('internal/damtan/lihat-data*') || Request::is('internal/damtan/edit-data*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i><span class="lbl">Kelola Data Laporan</span>
                    </a>
                    <a href="/internal/surat-korban/data" class="{{ Request::is('internal/surat-korban/data*') || Request::is('internal/surat-korban/edit*') ? 'active' : '' }}">
                        <i class="fas fa-folder-open"></i><span class="lbl">Kelola Surat Korban</span>
                    </a>
                    <a href="{{ route('internal.izin-keramaian.index') }}" class="{{ Request::is('internal/damtan/kelola-izin-keramaian*') ? 'active' : '' }}">
                        <i class="fas fa-users-rectangle"></i><span class="lbl">Kelola Surat Keramaian</span>
                    </a>
                </div>
            </details>

            <!-- BAGIAN SAPRA -->
            <details class="side-group" {{ Request::is('sapra*') ? 'open' : '' }}>
                <summary><i class="fas fa-warehouse grp-ico"></i><span class="grp-label">Bagian sapra</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <span class="side-kicker" style="padding-left:2px;">Sarana &amp; Prasarana</span>
                    <a href="/sapra/sarana-mako" class="{{ Request::is('sapra/sarana-mako*') ? 'active' : '' }}">
                        <i class="fas fa-fire-extinguisher"></i><span class="lbl">Sarana pemadam kebakaran</span>
                    </a>
                    <a href="/sapra/prasarana-mako" class="{{ Request::is('sapra/prasarana-mako*') ? 'active' : '' }}">
                        <i class="fas fa-building"></i><span class="lbl">Prasarana pemadam kebakaran</span>
                    </a>
                    <a href="/sapra/sarana-penyelamatan" class="{{ Request::is('sapra/sarana-penyelamatan*') ? 'active' : '' }}">
                        <i class="fas fa-life-ring"></i><span class="lbl">Sarana Penyelamatan &amp; Evakuasi</span>
                    </a>
                    <a href="/sapra/sarana-pemeriksaan" class="{{ Request::is('sapra/sarana-pemeriksaan*') ? 'active' : '' }}">
                        <i class="fas fa-search-location"></i><span class="lbl">Sarana Pemeriksaan Proteksi Kebakaran</span>
                    </a>
                    <a href="/sapra/kelola-pos" class="{{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}">
                        <i class="fas fa-warehouse"></i><span class="lbl">Kelola Data Pos</span>
                    </a>

                    <span class="side-kicker" style="padding-left:2px;">Manajemen Air</span>
                    <a href="/sapra/data_hidrant_gedung" class="{{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}">
                        <i class="fas fa-droplet"></i><span class="lbl">Sumber Air</span>
                    </a>
                    <a href="/sapra/data-hidrant-kota" class="{{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}">
                        <i class="fas fa-map-location-dot"></i><span class="lbl">Data Hidrant Kota Jambi</span>
                    </a>

                    <span class="side-kicker" style="padding-left:2px;">Logistik &amp; Distribusi</span>
                    <a href="/sapra/kebutuhan-sarpras" class="{{ Request::is('sapra/kebutuhan-sarpras*') ? 'active' : '' }}">
                        <i class="fas fa-boxes-stacked"></i><span class="lbl">Mutu Baku Kebutuhan</span>
                    </a>
                    <a href="/sapra/distribusi-staff" class="{{ Request::is('sapra/distribusi-staff*') ? 'active' : '' }}">
                        <i class="fas fa-people-carry-box"></i><span class="lbl">Serah terima Barang</span>
                    </a>
                </div>
            </details>

            <!-- BAGIAN KEPEGAWAIAN -->
            <details class="side-group" {{ Request::is('internal/kepegawaian*') || Request::is('internal/program-kerja*') ? 'open' : '' }}>
                <summary><i class="fas fa-user-tie grp-ico"></i><span class="grp-label">Kepegawaian</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/kepegawaian/duk" class="{{ Request::is('internal/kepegawaian/duk*') ? 'active' : '' }}">
                        <i class="fas fa-user-tie"></i><span class="lbl">Data Urut Kepegawaian</span>
                    </a>
                    <a href="/internal/program-kerja" class="{{ Request::is('internal/program-kerja*') ? 'active' : '' }}">
                        <i class="fas fa-file-contract"></i><span class="lbl">Program Kerja</span>
                    </a>
                </div>
            </details>

            <!-- MANAJEMEN INFORMASI -->
            <div class="side-kicker">Konten publik</div>
            <details class="side-group" {{ Request::is('internal/operator*') || Request::is('internal/peta-sigap*') ? 'open' : '' }}>
                <summary><i class="far fa-newspaper grp-ico"></i><span class="grp-label">Manajemen Informasi</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/operator/kelola-berita" class="{{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}">
                        <i class="far fa-newspaper"></i><span class="lbl">Input &amp; Kelola Berita</span>
                    </a>
                    <a href="/internal/operator/infografis" class="{{ Request::is('internal/operator/infografis*') ? 'active' : '' }}">
                        <i class="far fa-image"></i><span class="lbl">Kelola Infografis</span>
                    </a>
                    <a href="/internal/operator/berita-medsos" class="{{ Request::is('internal/operator/berita-medsos*') ? 'active' : '' }}">
                        <i class="fab fa-instagram"></i><span class="lbl">Kelola Berita Medsos</span>
                    </a>
                    <a href="/internal/operator/ujung-damkar" class="{{ Request::is('internal/operator/ujung-damkar*') ? 'active' : '' }}">
                        <i class="fab fa-youtube"></i><span class="lbl">Ujung-Ujung Damkar</span>
                    </a>
                    <a href="/internal/operator/edu-damkar" class="{{ Request::is('internal/operator/edu-damkar*') ? 'active' : '' }}">
                        <i class="fas fa-graduation-cap"></i><span class="lbl">Edu Damkar</span>
                    </a>

                    <div class="side-kicker" style="padding: 12px 10px 4px; margin-left: 0; font-size: 0.65rem;">PEMETAAN SIGAP</div>
                    @hasanyrole('Operator|Super User')
                    <a href="/internal/peta-sigap/input" class="{{ Request::is('internal/peta-sigap/input*') ? 'active' : '' }}">
                        <i class="fas fa-plus"></i><span class="lbl">Input Titik Peta</span>
                    </a>
                    @endhasanyrole
                    <a href="/internal/peta-sigap/data" class="{{ Request::is('internal/peta-sigap/data*') || Request::is('internal/peta-sigap/edit*') ? 'active' : '' }}">
                        <i class="fas fa-table-list"></i><span class="lbl">Kelola Data Titik</span>
                    </a>
                </div>
            </details>

        @endhasanyrole

        <!-- PENGATURAN AKUN -->
        <div class="side-kicker">Akun</div>
        <details class="side-group" {{ request()->is('internal/profil*') || request()->is('internal/kelola-user*') || request()->is('internal/kelola-pemohon*') ? 'open' : '' }}>
            <summary><i class="fas fa-user-gear grp-ico"></i><span class="grp-label">Pengaturan akun</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="{{ url('/internal/profil') }}" class="{{ request()->is('internal/profil*') ? 'active' : '' }}">
                    <i class="fas fa-user-pen"></i><span class="lbl">Profil Saya</span>
                </a>

                @hasrole('Super User')
                    <a href="{{ url('/internal/kelola-user') }}" class="{{ request()->is('internal/kelola-user*') ? 'active' : '' }}">
                        <i class="fas fa-users-gear"></i><span class="lbl">Kelola Pengguna</span>
                    </a>
                    <a href="{{ url('/internal/kelola-pemohon') }}" class="{{ request()->is('internal/kelola-pemohon*') ? 'active' : '' }}">
                        <i class="fas fa-address-book"></i><span class="lbl">Kelola Akun Pemohon</span>
                    </a>
                @endhasrole
            </div>
        </details>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="content">
        <div class="page-head-bar">
            <div class="page-head">
                <h1>Input Titik Peta SIGAP</h1>
                <p>Tambahkan data lokasi operasional (kebakaran, hidrant, dll) untuk ditampilkan di peta publik.</p>
            </div>
            <a href="/internal/peta-sigap/data" class="btn-simerah-secondary w-mobile-100">
                <i class="fas fa-table-list"></i> Kelola Data Titik
            </a>
        </div>

        <div class="section-heading">
            <span class="section-heading-ico"><i class="fas fa-location-dot"></i></span>
            <h3>Form Titik Baru</h3>
            <span class="line"></span>
        </div>

        <form action="{{ url('/internal/peta-sigap/store') }}" method="POST">
            @csrf

            @if($errors->any())
                <div class="form-alert" role="alert">
                    <i class="fas fa-triangle-exclamation"></i>
                    <div>
                        <strong>Gagal menyimpan data!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="row g-4">

                <!-- KOLOM FORMULIR -->
                <div class="col-xl-7 col-lg-6">
                    <div class="form-card">
                        <div class="card-title-custom">
                            <span class="section-heading-ico"><i class="fas fa-clipboard-list"></i></span>
                            Informasi Lokasi
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori Peta <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                <select name="kategori" class="form-select" required>
                                    <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>Pilih Kategori...</option>
                                    <option value="kebakaran" {{ old('kategori') == 'kebakaran' ? 'selected' : '' }}>Kebakaran</option>
                                    <option value="sumber_air" {{ old('kategori') == 'sumber_air' ? 'selected' : '' }}>Sumber Air</option>
                                    <option value="hydrant" {{ old('kategori') == 'hydrant' ? 'selected' : '' }}>Hydrant</option>
                                    <option value="penyelamatan" {{ old('kategori') == 'penyelamatan' ? 'selected' : '' }}>Penyelamatan</option>
                                    <option value="pos" {{ old('kategori') == 'pos' ? 'selected' : '' }}>Pos Damkar</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama / Judul Titik <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-font"></i></span>
                                <input type="text" name="nama" class="form-control" placeholder="Cth: Kebakaran Lahan Alam Barajo" value="{{ old('nama') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map"></i></span>
                                <select name="kecamatan" class="form-select" required>
                                    <option value="" disabled {{ old('kecamatan') ? '' : 'selected' }}>Pilih Kecamatan...</option>
                                    <option value="Alam Barajo" {{ old('kecamatan') == 'Alam Barajo' ? 'selected' : '' }}>Alam Barajo</option>
                                    <option value="Danau Sipin" {{ old('kecamatan') == 'Danau Sipin' ? 'selected' : '' }}>Danau Sipin</option>
                                    <option value="Danau Teluk" {{ old('kecamatan') == 'Danau Teluk' ? 'selected' : '' }}>Danau Teluk</option>
                                    <option value="Jambi Selatan" {{ old('kecamatan') == 'Jambi Selatan' ? 'selected' : '' }}>Jambi Selatan</option>
                                    <option value="Jambi Timur" {{ old('kecamatan') == 'Jambi Timur' ? 'selected' : '' }}>Jambi Timur</option>
                                    <option value="Jelutung" {{ old('kecamatan') == 'Jelutung' ? 'selected' : '' }}>Jelutung</option>
                                    <option value="Kota Baru" {{ old('kecamatan') == 'Kota Baru' ? 'selected' : '' }}>Kota Baru</option>
                                    <option value="Paal Merah" {{ old('kecamatan') == 'Paal Merah' ? 'selected' : '' }}>Paal Merah</option>
                                    <option value="Pelayangan" {{ old('kecamatan') == 'Pelayangan' ? 'selected' : '' }}>Pelayangan</option>
                                    <option value="Telanaipura" {{ old('kecamatan') == 'Telanaipura' ? 'selected' : '' }}>Telanaipura</option>
                                    <option value="Pasar Jambi" {{ old('kecamatan') == 'Pasar Jambi' ? 'selected' : '' }}>Pasar Jambi</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea name="lokasi" class="form-control" placeholder="Masukkan detail lokasi atau nama jalan..." required>{{ old('lokasi') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan (Opsional)</label>
                            <textarea name="keterangan" class="form-control" placeholder="Tambahkan keterangan lebih lanjut jika ada...">{{ old('keterangan') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal (Kejadian / Update) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-days"></i></span>
                                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') ?? date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="tip-box">
                            <i class="fas fa-circle-info"></i>
                            <span><b>Tips:</b> Anda bisa langsung mem-paste koordinat dari Google Maps (misal: <code>-1.6180, 103.6006</code>) ke salah satu kolom di bawah ini.</span>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Latitude <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                    <input type="text" id="latInput" name="latitude" class="form-control" placeholder="-1.6180" value="{{ old('latitude') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Longitude <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                    <input type="text" id="lngInput" name="longitude" class="form-control" placeholder="103.6006" value="{{ old('longitude') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="/internal/peta-sigap/data" class="btn-simerah-secondary">Batal</a>
                            <button type="submit" class="btn-simerah-danger">
                                <i class="fas fa-floppy-disk"></i> Simpan Data Titik
                            </button>
                        </div>
                    </div>
                </div>

                <!-- KOLOM PETA INTERAKTIF -->
                <div class="col-xl-5 col-lg-6">
                    <div class="form-card">
                        <div class="card-title-custom">
                            <span class="section-heading-ico"><i class="fas fa-map-location-dot"></i></span>
                            Pilih Lokasi di Peta
                        </div>
                        <p class="form-hint" style="margin-top:-10px; margin-bottom:14px;">
                            Geser marker (pin) atau klik peta untuk mengisi kolom Latitude dan Longitude secara otomatis.
                        </p>

                        <div id="mapPicker" style="height: 450px;"></div>

                        <span class="form-hint"><i class="fas fa-magnifying-glass-plus me-1"></i> Gunakan tombol ( + ) dan ( - ) di peta, atau scroll mouse untuk zoom in/out.</span>
                    </div>
                </div>

            </div>
        </form>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script>
(function () {
    'use strict';

    document.querySelectorAll('[data-toast]').forEach(function (t) {
        var hide = function () {
            t.classList.add('leaving');
            setTimeout(function () { t.remove(); }, 350);
        };
        var x = t.querySelector('[data-toast-close]');
        if (x) x.addEventListener('click', hide);
        setTimeout(hide, 4500);
    });

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
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeSide();
    });

    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) {
                groups.forEach(function (o) {
                    if (o !== g) o.open = false;
                });
            }
        });
    });

    /* Titik awal: old input jika ada, selain itu pusat Kota Jambi */
    var defaultLat = -1.6180875;
    var defaultLng = 103.6006406;
    var initialLat = parseFloat('{{ old('latitude') }}');
    var initialLng = parseFloat('{{ old('longitude') }}');
    if (isNaN(initialLat) || isNaN(initialLng)) { initialLat = defaultLat; initialLng = defaultLng; }

    var latInput = document.getElementById('latInput');
    var lngInput = document.getElementById('lngInput');

    var map = L.map('mapPicker').setView([initialLat, initialLng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    var marker = L.marker([initialLat, initialLng], { draggable: true }).addTo(map);

    // Update peta dari input manual
    function updateMapFromInputs() {
        var lat = parseFloat(latInput.value);
        var lng = parseFloat(lngInput.value);
        if (!isNaN(lat) && !isNaN(lng)) {
            var p = new L.LatLng(lat, lng);
            marker.setLatLng(p);
            map.setView(p, 15);
        }
    }

    // Paste dari Google Maps (format: "-1.6180, 103.6006")
    function handlePaste(e) {
        var pastedText = (e.clipboardData || window.clipboardData).getData('text');
        if (pastedText.indexOf(',') !== -1) {
            var parts = pastedText.split(',');
            var parsedLat = parseFloat(parts[0].trim());
            var parsedLng = parseFloat(parts[1].trim());
            if (!isNaN(parsedLat) && !isNaN(parsedLng)) {
                e.preventDefault();
                latInput.value = parsedLat;
                lngInput.value = parsedLng;
                updateMapFromInputs();
            }
        }
    }

    latInput.addEventListener('input', updateMapFromInputs);
    lngInput.addEventListener('input', updateMapFromInputs);
    latInput.addEventListener('paste', handlePaste);
    lngInput.addEventListener('paste', handlePaste);

    marker.on('dragend', function () {
        var pos = marker.getLatLng();
        latInput.value = pos.lat.toFixed(6);
        lngInput.value = pos.lng.toFixed(6);
    });

    map.on('click', function (e) {
        marker.setLatLng(e.latlng);
        latInput.value = e.latlng.lat.toFixed(6);
        lngInput.value = e.latlng.lng.toFixed(6);
    });

    latInput.value = initialLat;
    lngInput.value = initialLng;
    updateMapFromInputs();
})();
</script>
</body>
</html>
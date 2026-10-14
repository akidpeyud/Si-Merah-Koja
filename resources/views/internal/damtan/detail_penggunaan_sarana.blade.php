<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Detail Penggunaan Sarana | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <!-- PRELOAD LOGO -->
    <link rel="preload" href="/images/logo.png" as="image">
    <link rel="preload" href="/images/jambi.png" as="image">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --ink: #0d1b2a; --ink-2: #132a43; --ink-3: #1d3856;
            --navy: #163a63; --navy-dark: #0d2947; --navy-light: #eaf1f8; --navy-soft: rgba(22, 58, 99, .08);
            --paper: #f5f7fa; --white: #ffffff;
            --signal: #dc3545; --signal-dark: #b42332; --signal-soft: rgba(220, 53, 69, .09);
            --amber: #f4b740; --success: #198754; --info: #2563eb; --info-soft: rgba(37, 99, 235, .09);
            --steel: #64748b; --steel-soft: #94a3b8;
            --line: #e2e8f0; --line-dark: #cbd5e1;
            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;
            --r-lg: 18px; --r-md: 14px; --r-sm: 10px;
            --sidebar-w: 272px; --topbar-h: 70px;
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

        /* GLOBAL ALERTS */
        #globalSuccessAlert, #globalErrorAlert { position: fixed; top: 30px; left: 50%; transform: translateX(-50%); color: white; padding: 16px 24px; border-radius: var(--r-md); z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        #globalSuccessAlert { background-color: var(--success); box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
        #globalErrorAlert { background-color: var(--signal); box-shadow: 0 10px 25px -5px rgba(229, 57, 45, 0.4); }
        .alert-icon { font-size: 22px; }
        .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s; }
        .btn-close-alert:hover { opacity: 1; }
        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
        @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }

        /* TOPBAR */
        .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
        .topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .side-toggle { display: none; width: 40px; height: 40px; border-radius: 10px; align-items: center; justify-content: center; font-size: 1.05rem; color: #fff; transition: background .2s, transform .2s; }
        .side-toggle:hover { background: rgba(255,255,255,.10); }
        .side-toggle:active { transform: scale(.95); }
        .brand { display: flex; align-items: center; gap: 12px; min-width: 0; color: #fff; }
        .brand img { height: 34px; width: auto; flex: none; }
        .brand span { font-family: var(--font-display); font-weight: 700; font-size: 1.08rem; letter-spacing: -.01em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: #fff; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .user-chip { display: flex; align-items: center; gap: 10px; padding: 5px 14px 5px 5px; border-radius: 999px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); transition: background .2s, border-color .2s; }
        .user-chip:hover { background: rgba(255,255,255,.12); border-color: rgba(255,255,255,.18); }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #ffffff; color: var(--ink); display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
        .user-meta { display: grid; line-height: 1.25; }
        .user-meta strong { font-size: .84rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #ffffff; }
        .user-meta small { font-size: .72rem; color: rgba(255,255,255,.62); text-transform: capitalize; font-weight: 500; }
        .btn-logout { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #ffffff; color: var(--ink); font-weight: 600; font-size: .84rem; border: none; transition: background .2s, color .2s, transform .1s, box-shadow .2s; }
        .btn-logout:hover { background: #e8eef5; color: var(--ink); box-shadow: 0 4px 10px rgba(0,0,0,.12); }
        .btn-logout:active { transform: scale(.97); }
        @media (max-width: 900px) { .side-toggle { display: inline-flex; } .user-meta { display: none; } }

        /* SIDEBAR */
        .shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
        .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
        .sidebar::-webkit-scrollbar { width: 6px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background-color: #d8dee8; border-radius: 20px; }

        .side-link { display: flex; align-items: flex-start; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .89rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s, transform .2s; margin-bottom: 4px; }
        .side-link:hover { background: #f3f6fa; color: var(--ink); transform: translateX(1px); }
        .side-link.active { background: var(--ink); color: #ffffff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
        .side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: color .2s; flex: none; margin-top: 3px; }
        .side-link:hover i { color: var(--ink); }
        .side-link.active i { color: #ffffff; }
        .lbl { flex: 1 1 auto; min-width: 0; overflow-wrap: break-word; line-height: 1.4; }

        .side-group + .side-group { margin-top: 6px; }
        .side-group summary { list-style: none; cursor: pointer; display: flex; align-items: flex-start; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--navy); transition: background .2s, color .2s; user-select: none; }
        .side-group summary::-webkit-details-marker { display: none; }
        .side-group summary:hover { background: #f3f6fa; }
        .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
        .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; line-height: 1.4; }
        .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
        .side-group[open] summary .chev { transform: rotate(180deg); }

        .side-sub { display: grid; gap: 3px; padding: 6px 0 10px 8px; border-left: 2px solid var(--line); margin: 2px 0 8px 18px; }
        .side-sub a { display: flex; align-items: flex-start; gap: 12px; padding: 9px 10px; border-radius: var(--r-sm); font-size: .84rem; font-weight: 500; line-height: 1.4; color: var(--steel); transition: background .2s, color .2s, transform .2s; }
        .side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); transform: translateX(2px); }
        .side-sub a.active { background: var(--navy-soft); color: var(--navy); font-weight: 600; }
        .side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; flex: none; margin-top: 3px; }
        .side-sub a:hover i, .side-sub a.active i { opacity: 1; }
        .side-kicker { padding: 18px 14px 6px; font-size: .68rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--steel-soft); }
        .sidebar-backdrop { display: none; }

        @media (max-width: 900px) {
            .sidebar { position: fixed; z-index: 1010; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg); }
            body.side-open .sidebar { transform: none; }
            .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 1000; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
            body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
        }

        /* MAIN CONTENT & TABLE */
        .content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
        .page-header { margin-bottom: 28px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; }
        .page-header-text h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
        .page-header-text p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }

        .card-custom { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); overflow: hidden; }

        .form-control, .form-select { font-family: var(--font-body); min-height: 42px; font-size: .9rem; color: var(--ink); background-color: var(--white); border: 1px solid var(--line-dark); border-radius: 8px; padding: 8px 14px; transition: all 0.2s ease; box-shadow: none; }
        .form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
        .form-control::placeholder { color: var(--steel-soft); }
        .input-group-text { background-color: #f8fafc; border: 1px solid var(--line-dark); color: var(--steel); font-weight: 600; border-radius: 8px; font-size: 0.9rem; }
        .input-group > .form-control { border-top-right-radius: 0; border-bottom-right-radius: 0; }
        .input-group > .input-group-text { border-top-left-radius: 0; border-bottom-left-radius: 0; }

        .btn-custom-light { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; background: var(--white); color: var(--ink); border: 1px solid var(--line-dark); border-radius: 8px; font-size: .92rem; font-weight: 600; transition: all .2s ease; }
        .btn-custom-light:hover { background: #f8fafc; border-color: var(--steel-soft); color: var(--ink); }

        /* Tombol Cetak PDF */
        .header-actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
        .btn-print { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; background: var(--signal); color: #ffffff; border: 1px solid var(--signal); border-radius: 8px; font-size: .92rem; font-weight: 600; transition: background .2s, border-color .2s, transform .1s, box-shadow .2s; }
        .btn-print:hover { background: var(--signal-dark); border-color: var(--signal-dark); color: #ffffff; box-shadow: 0 6px 14px rgba(220, 53, 69, .25); }
        .btn-print:active { transform: scale(.97); }

        .table { margin-bottom: 0; }
        .table th { background-color: #f8fafc; color: var(--ink-3); font-weight: 700; font-size: 13px; padding: 16px; border-bottom: 1px solid var(--line); font-family: var(--font-display); letter-spacing: 0.02em; }
        .table td { padding: 16px; font-size: 14px; color: var(--ink); vertical-align: middle; border-bottom: 1px solid var(--line); }
        .table tbody tr:hover { background-color: var(--paper); }

        .action-btn { width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; border: none; font-size: 13px; transition: all 0.2s; text-decoration: none; }
        .action-btn.view { background-color: var(--info-soft); color: var(--info); }
        .action-btn.view:hover { background-color: #dbeafe; }
        .action-btn.edit { background-color: rgba(255, 182, 39, 0.15); color: #d97706; margin: 0 5px; }
        .action-btn.edit:hover { background-color: rgba(255, 182, 39, 0.25); }
        .action-btn.delete { background-color: var(--signal-soft); color: var(--signal); margin-left: 5px; }
        .action-btn.delete:hover { background-color: #fecaca; }

        .badge-status { display: inline-block; padding: 6px 12px; font-weight: 600; font-size: 0.8rem; border-radius: 6px; }
        .badge-menunggu { background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
        .badge-proses { background-color: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
        .badge-disetujui { background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
        .badge-ditolak { background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }

        /* Dropdown ubah status (hanya Damtan & Super User) */
        .status-select { min-height: 34px; padding: 4px 28px 4px 10px; font-size: .8rem; font-weight: 600; border-radius: 6px; width: auto; min-width: 120px; cursor: pointer; }
        .status-select.s-Menunggu  { background-color: #fffbeb; color: #b45309; border-color: #fde68a; }
        .status-select.s-Proses    { background-color: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
        .status-select.s-Disetujui { background-color: #f0fdf4; color: #15803d; border-color: #bbf7d0; }
        .status-select.s-Ditolak   { background-color: #fef2f2; color: #b91c1c; border-color: #fecaca; }
            .badge-menunggu { background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
    .detail-label { font-size: .78rem; font-weight: 700; letter-spacing: .03em; text-transform: uppercase; color: var(--steel); margin-bottom: 2px; }
    .detail-value { font-size: .95rem; color: var(--ink); margin-bottom: 18px; word-break: break-word; }
    .detail-title { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; margin-bottom: 18px; padding-bottom: 10px; border-bottom: 1px solid var(--line); }
    .foto-lokasi { max-width: 100%; max-height: 320px; border-radius: var(--r-sm); border: 1px solid var(--line); object-fit: cover; }
        /* PAGE-STYLES */

        /* ==========================================================
           KOP & FOOTER CETAK (tersembunyi di layar, tampil saat dicetak)
           ========================================================== */
        .print-only { display: none; }

        .print-kop { align-items: center; gap: 16px; padding-bottom: 12px; margin-bottom: 18px; border-bottom: 3px double var(--ink); }
        .print-kop img { height: 64px; width: auto; flex: none; }
        .print-kop-text { flex: 1; text-align: center; line-height: 1.35; }
        .print-kop-text .kop-1 { font-size: 11pt; font-weight: 600; text-transform: uppercase; }
        .print-kop-text .kop-2 { font-size: 14pt; font-weight: 800; text-transform: uppercase; letter-spacing: .02em; }
        .print-kop-text .kop-3 { font-size: 9pt; color: #444; }
        .print-title { text-align: center; margin-bottom: 18px; }
        .print-title h2 { font-family: var(--font-display); font-size: 14pt; font-weight: 800; text-transform: uppercase; margin-bottom: 2px; }
        .print-title p { font-size: 10pt; color: #444; margin: 0; }
        .print-footer { margin-top: 24px; padding-top: 10px; border-top: 1px solid #999; font-size: 8.5pt; color: #555; justify-content: space-between; }

        /* ==========================================================
           PENGATURAN CETAK / SIMPAN PDF
           ========================================================== */
        @media print {
            /* margin 0 = header/footer bawaan browser (tanggal & judul) tidak muncul */
            @page { size: A4; margin: 0; }

            html, body { background: #ffffff !important; }
            body { padding: 14mm !important; font-size: 10.5pt; -webkit-print-color-adjust: exact; print-color-adjust: exact; }

            /* sembunyikan elemen antarmuka */
            .topbar, .sidebar, .sidebar-backdrop, .no-print,
            #globalSuccessAlert, #globalErrorAlert { display: none !important; }

            .shell { display: block; min-height: 0; }
            .content { padding: 0 !important; }

            /* tampilkan kop & footer cetak */
            .print-only { display: block; }
            .print-kop.print-only, .print-footer.print-only { display: flex; }

            /* judul halaman bawaan diganti kop cetak */
            .page-header { display: none !important; }

            /* dua kolom tetap berdampingan di kertas A4 */
            .row > .col-lg-6 { flex: 0 0 auto; width: 50%; }
            .row > .col-md-6 { flex: 0 0 auto; width: 50%; }
            .row { --bs-gutter-x: 14px; --bs-gutter-y: 14px; }

            .card-custom { box-shadow: none !important; border: 1px solid #bbb; break-inside: avoid; page-break-inside: avoid; }
            .card-custom.p-4 { padding: 14px !important; }
            .detail-title { font-size: 11pt; margin-bottom: 12px; }
            .detail-label { font-size: 8pt; }
            .detail-value { font-size: 10pt; margin-bottom: 10px; }
            .foto-lokasi { max-height: 200px; }

            a[href]:after { content: none !important; }
        }
    </style>
</head>
<body>

@if(session('success'))
    <div id="globalSuccessAlert">
        <i class="fas fa-check-circle alert-icon"></i>
        <span>{{ session('success') }}</span>
        <button class="btn-close-alert" onclick="closeAlert('globalSuccessAlert')"><i class="fas fa-times"></i></button>
    </div>
@endif

@if(session('error'))
    <div id="globalErrorAlert">
        <i class="fas fa-exclamation-triangle alert-icon"></i>
        <span>{{ session('error') }}</span>
        <button class="btn-close-alert" onclick="closeAlert('globalErrorAlert')"><i class="fas fa-times"></i></button>
    </div>
@endif

<script>
    function closeAlert(id) {
        let alertBox = document.getElementById(id);
        if (alertBox) {
            alertBox.style.animation = 'fadeOutUpCenter 0.4s ease forwards';
            setTimeout(() => alertBox.remove(), 400);
        }
    }
    setTimeout(() => closeAlert('globalSuccessAlert'), 4000);
    setTimeout(() => closeAlert('globalErrorAlert'), 4000);
</script>

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
            <span class="user-avatar">{{ strtoupper(substr(Auth::user()->nama_lengkap ?? 'A', 0, 1)) }}</span>
            <div class="user-meta">
                <strong>{{ Auth::user()->nama_lengkap ?? 'Admin Damkar' }}</strong>
                <small>{{ Auth::user()->getRoleNames()->first() ?? str_replace('_', ' ', Auth::user()->role ?? '') }}</small>
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
            <details class="side-group" {{ Request::is('internal/damtan*') || Request::is('internal/surat-korban*') ? 'open' : '' }}>
                <summary><i class="fas fa-fire-extinguisher grp-ico"></i><span class="grp-label">Bagian pemadaman</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">

                    @php
                        $aksesMenuRekap = false;
                        if (method_exists(Auth::user(), 'hasAnyRole')) {
                            $aksesMenuRekap = Auth::user()->hasAnyRole(['Damtan', 'Super User']);
                        }
                    @endphp

                    @if($aksesMenuRekap)
                    <a href="/internal/damtan/rekap-layanan" class="{{ Request::is('internal/damtan/rekap-layanan*') ? 'active' : '' }}">
                        <i class="fas fa-truck-medical"></i><span class="lbl">Kelola Rekap Layanan</span>
                    </a>
                    <a href="/internal/damtan/rekap-objek" class="{{ Request::is('internal/damtan/rekap-objek*') ? 'active' : '' }}">
                        <i class="fas fa-house-chimney-crack"></i><span class="lbl">Kelola Rekap Objek Kebakaran</span>
                    </a>
                    @endif

                    <a href="/internal/damtan/data-laporan" class="{{ Request::is('internal/damtan/data-laporan*') || Request::is('internal/damtan/lihat-data*') || Request::is('internal/damtan/edit-data*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i><span class="lbl">Kelola Data Laporan</span>
                    </a>
                    <a href="/internal/surat-korban/data" class="{{ Request::is('internal/surat-korban/data*') || Request::is('internal/surat-korban/edit*') ? 'active' : '' }}">
                        <i class="fas fa-folder-open"></i><span class="lbl">Kelola Surat Korban</span>
                    </a>
                    <a href="{{ route('internal.izin-keramaian.index') }}" class="{{ Request::is('internal/damtan/kelola-izin-keramaian*') ? 'active' : '' }}">
                        <i class="fas fa-users-rectangle"></i><span class="lbl">Kelola Surat Keramaian</span>
                    </a>
                    <a href="{{ route('internal.penggunaan-sarana.index') }}" class="{{ Request::is('internal/damtan/kelola-penggunaan-sarana*') ? 'active' : '' }}">
                        <i class="fas fa-truck-droplet"></i><span class="lbl">Kelola Penggunaan Sarana</span>
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
            <details class="side-group" {{ Request::is('internal/kepegawaian*') || Request::is('internal/program-kerja*') || Request::is('internal/data-asn*') ? 'open' : '' }}>
                <summary><i class="fas fa-user-tie grp-ico"></i><span class="grp-label">Kepegawaian</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/kepegawaian/duk" class="{{ Request::is('internal/kepegawaian/duk*') ? 'active' : '' }}">
                        <i class="fas fa-user-tie"></i><span class="lbl">Data Urut Kepegawaian</span>
                    </a>
                    <a href="/internal/data-asn" class="{{ Request::is('internal/data-asn*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i><span class="lbl">Rekap Data ASN</span>
                    </a>
                    <a href="/internal/program-kerja" class="{{ Request::is('internal/program-kerja*') ? 'active' : '' }}">
                        <i class="fas fa-file-contract"></i><span class="lbl">Program Kerja</span>
                    </a>
                </div>
            </details>

            <!-- MANAJEMEN INFORMASI: semua pegawai internal bisa melihat menu ini -->
            <div class="side-kicker">Konten publik</div>
            <details class="side-group" {{ Request::is('internal/operator*') || Request::is('internal/peta-sigap*') ? 'open' : '' }}>
                <summary><i class="far fa-newspaper grp-ico"></i><span class="grp-label">Manajemen Informasi</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/operator/kelola-berita" class="{{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}">
                        <i class="far fa-newspaper"></i><span class="lbl">Kelola Berita</span>
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

                    <!-- Khusus untuk Input Titik, dibatasi hanya untuk Super User & Operator -->
                    @hasanyrole('Super User|Operator')
                    <a href="/internal/peta-sigap/input" class="{{ Request::is('internal/peta-sigap/input*') ? 'active' : '' }}">
                        <i class="fas fa-plus"></i><span class="lbl">Input Titik Peta</span>
                    </a>
                    @endhasanyrole

                    <a href="/internal/peta-sigap/data" class="{{ Request::is('internal/peta-sigap/data*') ? 'active' : '' }}">
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
@php
    $badge = match($row->status) {
        'Menunggu'  => 'badge-menunggu',
        'Proses'    => 'badge-proses',
        'Disetujui' => 'badge-disetujui',
        'Ditolak'   => 'badge-ditolak',
        default     => '',
    };
    $suratIsPdf = \Illuminate\Support\Str::endsWith(strtolower($row->surat_permohonan), '.pdf');
    $namaFilePdf = 'Permohonan-Penggunaan-Sarana-' . \Illuminate\Support\Str::slug($row->nama);
@endphp

<!-- ===== KOP CETAK (hanya tampil saat dicetak / disimpan PDF) ===== -->
<div class="print-kop print-only">
    <img src="/images/jambi.png" alt="Logo Pemkot Jambi">
    <div class="print-kop-text">
        <div class="kop-1">Pemerintah Kota Jambi</div>
        <div class="kop-2">Dinas Pemadam Kebakaran dan Penyelamatan</div>
        <div class="kop-3">SIMERAH KOJA &middot; Sistem Informasi Penanggulangan Kebakaran dan Penyelamatan Daerah Kota Jambi</div>
    </div>
    <img src="/images/logo.png" alt="Logo Damkar">
</div>

<div class="print-title print-only">
    <h2>Detail Permohonan Penggunaan Sarana</h2>
    <p>Atas nama {{ $row->nama }} &middot; Status: <strong>{{ $row->status }}</strong></p>
</div>

<div class="page-header">
    <div class="page-header-text">
        <h1>Detail Penggunaan Sarana</h1>
        <p>Permohonan atas nama <strong>{{ $row->nama }}</strong> &middot; <span class="badge-status {{ $badge }}">{{ $row->status }}</span></p>
    </div>
    <div class="header-actions no-print">
        <a href="{{ route('internal.penggunaan-sarana.index') }}" class="btn-custom-light"><i class="fas fa-arrow-left"></i> Kembali</a>
        <button type="button" class="btn-print" onclick="cetakPdf()"><i class="fas fa-file-pdf"></i> Cetak PDF</button>
    </div>
</div>

<div class="row g-4">
    <!-- DATA PEMOHON -->
    <div class="col-lg-6">
        <div class="card-custom p-4 h-100">
            <div class="detail-title"><i class="fas fa-user me-2"></i>Data Pemohon</div>

            <div class="detail-label">Nama</div>
            <div class="detail-value">{{ $row->nama }}</div>

            <div class="detail-label">NIK</div>
            <div class="detail-value">{{ $row->nik }}</div>

            <div class="detail-label">No HP/WA</div>
            <div class="detail-value">{{ $row->no_hp }}</div>

            <div class="detail-label">Alamat</div>
            <div class="detail-value">{{ $row->alamat }}</div>

            <div class="detail-label">Jenis Pemohon</div>
            <div class="detail-value text-capitalize">{{ $row->jenis_pemohon }}</div>

            <div class="detail-label">Nama Penanggung Jawab</div>
            <div class="detail-value">{{ $row->nama_penanggung_jawab }}</div>

            <div class="detail-label">Nama Instansi / Fasilitas Umum / Perorangan</div>
            <div class="detail-value">{{ $row->nama_instansi }}</div>

            <div class="detail-label">Alamat Instansi</div>
            <div class="detail-value mb-0">{{ $row->alamat_instansi }}</div>
        </div>
    </div>

    <!-- DATA KEGIATAN -->
    <div class="col-lg-6">
        <div class="card-custom p-4 h-100">
            <div class="detail-title"><i class="fas fa-truck-droplet me-2"></i>Data Kegiatan & Sarana</div>

            <div class="detail-label">Sarana yang Dimohon</div>
            <div class="detail-value">{{ $row->sarana }}</div>

            <div class="detail-label">Kegunaan Sarana</div>
            <div class="detail-value">{{ $row->kegunaan }}</div>

            <div class="detail-label">Nama Kegiatan</div>
            <div class="detail-value">{{ $row->nama_kegiatan }}</div>

            <div class="detail-label">Lokasi Kegiatan</div>
            <div class="detail-value">{{ $row->lokasi_kegiatan }}</div>

            <div class="detail-label">Tanggal Pelaksanaan</div>
            <div class="detail-value">{{ \Carbon\Carbon::parse($row->tgl_pelaksanaan)->translatedFormat('l, d F Y') }}</div>

            <div class="detail-label">Waktu</div>
            <div class="detail-value">{{ substr($row->waktu_mulai, 0, 5) }} - {{ substr($row->waktu_selesai, 0, 5) }} WIB</div>

            <div class="detail-label">Diajukan Pada</div>
            <div class="detail-value mb-0">{{ $row->created_at?->translatedFormat('d F Y, H:i') }}</div>
        </div>
    </div>

    <!-- LAMPIRAN -->
    <div class="col-12">
        <div class="card-custom p-4">
            <div class="detail-title"><i class="fas fa-paperclip me-2"></i>Lampiran</div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="detail-label">Foto Lokasi Kegiatan</div>
                    <a href="{{ asset('storage/' . $row->foto_lokasi) }}" target="_blank">
                        <img src="{{ asset('storage/' . $row->foto_lokasi) }}" alt="Foto lokasi kegiatan" class="foto-lokasi">
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="detail-label">Surat Permohonan</div>
                    @if($suratIsPdf)
                        <a href="{{ asset('storage/' . $row->surat_permohonan) }}" target="_blank" class="btn-custom-light no-print">
                            <i class="fas fa-file-pdf"></i> Buka Surat (PDF)
                        </a>
                        <div class="detail-value print-only">Surat permohonan terlampir dalam format PDF pada sistem.</div>
                    @else
                        <a href="{{ asset('storage/' . $row->surat_permohonan) }}" target="_blank">
                            <img src="{{ asset('storage/' . $row->surat_permohonan) }}" alt="Surat permohonan" class="foto-lokasi">
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== FOOTER CETAK ===== -->
<div class="print-footer print-only">
    <span>Dicetak dari SIMERAH KOJA oleh {{ Auth::user()->nama_lengkap ?? 'Admin Damkar' }}</span>
    <span>{{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</span>
</div>

@hasanyrole('Damtan|Super User')
<div class="mt-4 no-print">
    <a href="{{ route('internal.penggunaan-sarana.edit', $row->id) }}" class="btn-custom-light"><i class="fas fa-edit"></i> Edit Data</a>
</div>
@endhasanyrole
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    (function () {
        'use strict';
        /* Sidebar Toggle */
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

        /* Accordion Sidebar */
        var groups = document.querySelectorAll('.side-group');
        groups.forEach(function (g) {
            g.addEventListener('toggle', function () {
                if (g.open) {
                    groups.forEach(function (o) { if (o !== g) o.open = false; });
                }
            });
        });
    })();

    /* Cetak / simpan PDF: nama file mengikuti nama pemohon */
    var judulAsli = document.title;
    function cetakPdf() {
        document.title = @json($namaFilePdf);
        window.print();
    }
    window.addEventListener('afterprint', function () { document.title = judulAsli; });
</script>
</body>
</html>
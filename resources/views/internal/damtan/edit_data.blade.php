<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Edit Laporan - SIMERAH KOJA</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Leaflet CSS (Untuk Peta) -->
=======
    <meta name="theme-color" content="#0d1b2a">
    <title>Edit Data Penyelamatan | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <!-- Fonts (Sesuai UI/UX Dashboard Utama) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Leaflet CSS -->
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        /* ==========================================================
           TOKENS & RESET
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

<<<<<<< HEAD
        /* --- GLOBAL ALERT STYLES --- */
        #globalSuccessAlert, #globalErrorAlert {
            position: fixed; top: 30px; left: 50%; transform: translateX(-50%);
            color: white; padding: 16px 24px; border-radius: 8px; z-index: 99999;
            display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px;
            animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        #globalSuccessAlert { background-color: #10b981; box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
        #globalErrorAlert { background-color: #ef4444; box-shadow: 0 10px 25px -5px rgba(239, 68, 68, 0.4); }
        
        .alert-icon { font-size: 22px; }
        .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s; }
        .btn-close-alert:hover { opacity: 1; }

        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
        @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }

        /* --- NAVBAR INTERNAL --- */
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .badge-internal { background: #10b981; color: white; font-size: 10px; padding: 3px 8px; border-radius: 4px; font-weight: 700; margin-left: 10px; vertical-align: middle; }
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 10px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .badge-role.super_user { background: #ef4444; }
=======
            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;

            --r-lg: 22px;
            --r-md: 16px;
            --r-sm: 10px;
            --sidebar-w: 272px;
            --topbar-h: 66px;
        }
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7

        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font-body);
            font-size: 1rem;
            line-height: 1.6;
            color: var(--ink);
            background: var(--paper);
            -webkit-font-smoothing: antialiased;
            margin: 0; padding: 0;
        }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; padding: 0; margin: 0; }
        button { font: inherit; cursor: pointer; }
        
<<<<<<< HEAD
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s; }
        .btn-logout:hover { background-color: #dc2626; }
=======
        /* ==========================================================
           GLOBAL ALERTS
           ========================================================== */
        #globalSuccessAlert, #globalErrorAlert {
            position: fixed; top: 30px; left: 50%; transform: translateX(-50%);
            color: white; padding: 16px 24px; border-radius: 8px; z-index: 99999;
            display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px;
            animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        #globalSuccessAlert { background-color: #10b981; box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
        #globalErrorAlert { background-color: #ef4444; box-shadow: 0 10px 25px -5px rgba(239, 68, 68, 0.4); }
        
        .alert-icon { font-size: 22px; }
        .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s; }
        .btn-close-alert:hover { opacity: 1; }
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7

        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
        @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }

        /* ==========================================================
           TOPBAR
           ========================================================== */
        .topbar {
            position: sticky; top: 0; z-index: 1020; height: var(--topbar-h);
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
            padding: 0 20px 0 clamp(16px, 2vw, 24px); background: rgba(255,255,255,.85);
            -webkit-backdrop-filter: blur(14px); backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--line);
        }
        .topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .side-toggle { display: none; background: none; border: 0; width: 40px; height: 40px; border-radius: 12px; align-items: center; justify-content: center; font-size: 1.05rem; }
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
        .btn-logout { background: none; border: 0; display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 18px; border-radius: 999px; background: var(--signal); color: #fff; font-weight: 700; font-size: .85rem; transition: background .2s; text-decoration: none;}
        .btn-logout:hover { background: var(--signal-d); color: #fff; }

        @media (max-width: 900px) {
            .side-toggle { display: inline-flex; }
            .user-meta { display: none; }
        }

        /* ==========================================================
           SHELL & SIDEBAR
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
        .side-link:hover { background: var(--paper); color: var(--ink); }
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
        .side-group[open] > summary { color: var(--blue); } 
        .side-group summary .chev { margin-left: auto; font-size: .68rem; transition: transform .2s; }
        .side-group[open] summary .chev { transform: rotate(180deg); }

        .side-sub { display: grid; gap: 2px; padding: 4px 2px 8px 10px; border-left: 2px solid var(--line); margin: 2px 0 4px 22px; }
        .side-sub a { display: flex; align-items: flex-start; gap: 11px; padding: 9px 12px; border-radius: 11px; font-size: .82rem; font-weight: 600; line-height: 1.4; color: var(--steel); transition: background .2s, color .2s; }
        .side-sub a:hover { background: var(--paper); color: var(--ink); }
        .side-sub a.active { background: #eff6ff; color: var(--blue); }
        .side-sub a i { width: 16px; text-align: center; font-size: .85rem; margin-top: 2px; color: inherit; opacity: .75; }
        .side-kicker { padding: 14px 12px 4px; font-size: .68rem; font-weight: 800; letter-spacing: .05em; text-transform: uppercase; color: #a9b6c4; }

        .sidebar-backdrop { display: none; }

        @media (max-width: 900px) {
            .sidebar {
                position: fixed; z-index: 1010; top: var(--topbar-h); left: 0;
                height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%);
                transition: transform .3s ease; box-shadow: 24px 0 48px -24px rgba(13,27,42,.4);
            }
            body.side-open .sidebar { transform: none; }
            .sidebar-backdrop {
                display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 1000;
                background: rgba(13,27,42,.4); opacity: 0; pointer-events: none; transition: opacity .3s;
            }
            body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
        }

<<<<<<< HEAD
        /* --- MAIN AREA --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; }
        .page-header { margin-bottom: 30px; display: flex; justify-content: space-between; align-items: flex-end;}
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin: 0; }
        
        /* Custom Tab Styles */
        .nav-tabs .nav-link { color: #6b7280; font-weight: 600; border: none; padding: 12px 20px; }
        .nav-tabs .nav-link:hover { color: #10b981; }
        .nav-tabs .nav-link.active { color: #111827 !important; border-bottom: 3px solid #10b981 !important; background: transparent; }

        #map { height: 400px; width: 100%; border-radius: 8px; border: 1px solid #e5e7eb; }
=======
        /* ==========================================================
           MAIN CONTENT & FORM STYLING
           ========================================================== */
        .content { flex: 1; min-width: 0; padding: clamp(20px, 3vw, 40px) clamp(18px, 3vw, 44px) 60px; }
        
        .page-head { margin-bottom: 24px; }
        .page-head h1 { font-family: var(--font-display); font-weight: 800; font-stretch: 88%; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.15; letter-spacing: -0.02em; color: var(--ink); margin-bottom: 6px;}
        .page-head p { color: var(--steel); font-size: .95rem; margin: 0; }

        /* Custom Card Form */
        .card-custom {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: var(--r-md);
            overflow: hidden;
            box-shadow: 0 10px 30px -10px rgba(13,27,42,.05);
        }

        /* Custom Tabs */
        .nav-tabs {
            border-bottom: 1px solid var(--line);
            padding: 0 20px;
            background: rgba(243, 245, 248, 0.4);
            flex-wrap: nowrap;
            overflow-x: auto;
            white-space: nowrap;
        }
        .nav-tabs::-webkit-scrollbar { height: 0px; }
        .nav-tabs .nav-item { margin-bottom: -1px; }
        .nav-tabs .nav-link {
            font-family: var(--font-display);
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--steel);
            border: none;
            border-bottom: 3px solid transparent;
            padding: 16px 24px;
            border-radius: 0;
            transition: all 0.2s ease;
        }
        .nav-tabs .nav-link:hover { color: var(--ink); border-bottom-color: var(--line); background: transparent; }
        .nav-tabs .nav-link.active {
            color: var(--blue);
            font-weight: 700;
            border-bottom-color: var(--blue);
            background: transparent;
        }

        /* Form Elements */
        .field-label { font-size: .85rem; font-weight: 700; color: var(--ink-3); margin-bottom: 8px; display: inline-flex; align-items: center; }
        .field-label i { margin-right: 8px; font-size: .9rem; color: var(--steel); }

        .form-control, .form-select {
            font-family: var(--font-body);
            font-size: .95rem;
            color: var(--ink);
            background-color: var(--paper);
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.2s ease-in-out;
            box-shadow: none;
        }
        .form-control:focus, .form-select:focus {
            background-color: #fff;
            border-color: var(--blue);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }
        .input-group-text { background-color: var(--line); border: 1px solid var(--line); color: var(--ink-3); font-weight: 700; border-radius: 12px; }
        .input-group > .form-control { border-top-right-radius: 0; border-bottom-right-radius: 0; }
        .input-group > .input-group-text { border-top-left-radius: 0; border-bottom-left-radius: 0; }
        
        .section-title {
            font-family: var(--font-display); font-weight: 700; color: var(--ink);
            margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px dashed var(--line);
            display: flex; align-items: center; gap: 12px; font-size: 1.25rem;
        }
        .section-title i { color: var(--blue); background: rgba(37, 99, 235, 0.1); padding: 10px; border-radius: 10px; font-size: 1.05rem; }

        .form-check-inline {
            background-color: var(--paper); border: 1px solid var(--line); padding: 10px 16px 10px 40px; 
            border-radius: 10px; margin-right: 8px; margin-bottom: 8px; transition: all 0.2s; position: relative;
            display: inline-flex; align-items: center;
        }
        .form-check-inline:hover { border-color: var(--blue); }
        .form-check-inline .form-check-input { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); margin: 0 !important; cursor: pointer; }
        .form-check-inline .form-check-label { cursor: pointer; font-size: .9rem; font-weight: 600; color: var(--ink-2); width: 100%; margin-bottom: 0; }

        /* Buttons */
        .btn-custom-primary {
            background-color: var(--blue); color: #fff; font-family: var(--font-body); font-weight: 700;
            border: none; padding: 12px 28px; border-radius: 12px; transition: background 0.2s; text-decoration: none;
        }
        .btn-custom-primary:hover { background-color: #1d4ed8; color: #fff; }
        
        .btn-custom-light {
            background-color: var(--paper); color: var(--ink); font-family: var(--font-body); font-weight: 700;
            border: 1px solid var(--line); padding: 12px 28px; border-radius: 12px; transition: background 0.2s; text-decoration: none;
            display: inline-flex; align-items: center;
        }
        .btn-custom-light:hover { background-color: #e2e8f0; color: var(--ink); }

        .btn-outline-primary { color: var(--blue); border-color: var(--blue); font-weight: 600; border-radius: 10px; background: transparent; }
        .btn-outline-primary:hover { background-color: var(--blue); color: #fff; }

        #map { height: 400px; width: 100%; border-radius: 12px; border: 1px solid var(--line); z-index: 1;}
        .modal-content { border-radius: var(--r-md); border: none; box-shadow: 0 20px 40px rgba(13,27,42,.15); }
        .modal-header { border-bottom: 1px solid var(--line); }
        .modal-title { font-family: var(--font-display); font-weight: 700; color: var(--ink); }
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7
    </style>
</head>
<body>

<<<<<<< HEAD
    <!-- NAVBAR INTERNAL -->
    <nav class="navbar-internal">
        <a href="#" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah">
            <span class="title">SIMERAH KOJA <span class="badge-internal">INTERNAL APP</span></span>
        </a>

        <div class="user-menu">
            <div class="user-profile">
                <span class="badge-role {{ Auth::user()->role ?? '' }}">
                    {{ str_replace('_', ' ', Auth::user()->role ?? 'PEGAWAI') }}
                </span>
                <span>{{ Auth::user()->nama_lengkap ?? 'Rekan Kerja' }}</span>
                <i class="fas fa-user-circle"></i>
            </div>
            
            <form action="/logout" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt me-2"></i> KELUAR</button>
            </form>
=======
<!-- ALERT SUCCESS GLOBAL -->
@if(session('success'))
    <div id="globalSuccessAlert">
        <i class="fas fa-check-circle alert-icon"></i>
        <span>{{ session('success') }}</span>
        <button class="btn-close-alert" onclick="closeAlert('globalSuccessAlert')"><i class="fas fa-times"></i></button>
    </div>
@endif

<!-- ALERT ERROR GLOBAL -->
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
        if(alertBox) {
            alertBox.style.animation = 'fadeOutUpCenter 0.4s ease forwards';
            setTimeout(() => alertBox.remove(), 400); 
        }
    }
    setTimeout(() => closeAlert('globalSuccessAlert'), 4000);
    setTimeout(() => closeAlert('globalErrorAlert'), 4000);
</script>

<!-- ==================== TOPBAR ==================== -->
<header class="topbar">
    <div class="topbar-left">
        <button class="side-toggle" type="button" id="sideToggle" aria-label="Buka menu" aria-expanded="false">
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
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7
        </div>
        <form action="/logout" method="POST" style="margin:0;">
            @csrf
            <button type="submit" class="btn-logout"><i class="fas fa-arrow-right-from-bracket"></i> Keluar</button>
        </form>
    </div>
</header>

<<<<<<< HEAD
    <!-- KONTEN UTAMA -->
    <div class="dashboard-container">
        
        <!-- SIDEBAR TERINTEGRASI -->
        <aside class="sidebar" id="sidebarAccordion">
            <a href="/internal/index" class="sidebar-item {{ Request::is('internal/index') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            <!-- BAGIAN KHUSUS USER & SUPER USER -->
            @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                
                <!-- ACCORDION PENCEGAHAN -->
                <button class="sidebar-collapse-btn {{ Request::is('internal/pencegahan*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencegahan" aria-expanded="{{ Request::is('internal/pencegahan*') ? 'true' : 'false' }}">
                    <span>Bagian Pencegahan</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('internal/pencegahan*') ? 'show' : '' }}" id="collapsePencegahan" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                        <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
                        <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                        <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                        <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
                        <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
                    </div>
=======
<div class="shell">
    <div class="sidebar-backdrop" id="sideBackdrop"></div>

    <!-- ==================== SIDEBAR TERINTEGRASI ==================== -->
    <aside class="sidebar" id="sidebar" aria-label="Navigasi internal">
        <a href="/internal/index" class="side-link {{ Request::is('internal/index') ? 'active' : '' }}">
            <i class="fas fa-house"></i> Dashboard utama
        </a>

        @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
            <div class="side-kicker">Modul operasional</div>

            <details class="side-group" {{ Request::is('internal/pencegahan*') ? 'open' : '' }}>
                <summary>Bagian pencegahan <i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/pencegahan/kelola-rpkbgl" class="{{ Request::is('internal/pencegahan/kelola-rpkbgl*') ? 'active' : '' }}"><i class="fas fa-building"></i> Kelola RPKBGL</a>
                    <a href="/internal/pencegahan/kelola-skk" class="{{ Request::is('internal/pencegahan/kelola-skk*') ? 'active' : '' }}"><i class="fas fa-shield-alt"></i> Kelola SKK</a> 
                    <a href="/internal/pencegahan/layanan-inspeksi" class="{{ Request::is('internal/pencegahan/layanan-inspeksi*') ? 'active' : '' }}"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                    <a href="/internal/pencegahan/kelola-edukasi" class="{{ Request::is('internal/pencegahan/kelola-edukasi*') ? 'active' : '' }}"><i class="fas fa-bullhorn"></i> Kelola Edukasi</a>
                    <a href="/internal/pencegahan/pelatihan" class="{{ Request::is('internal/pencegahan/pelatihan*') ? 'active' : '' }}"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                    <a href="/internal/pencegahan/pembinaan-pengembangan" class="{{ Request::is('internal/pencegahan/pembinaan-pengembangan*') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                    <a href="/internal/pencegahan/peningkatan-kapasitas" class="{{ Request::is('internal/pencegahan/peningkatan-kapasitas*') ? 'active' : '' }}"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
                    <a href="/internal/pencegahan/kelola-redkar" class="{{ Request::is('internal/pencegahan/kelola-redkar*') ? 'active' : '' }}"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7
                </div>
            </details>

<<<<<<< HEAD
                <!-- ACCORDION PEMADAMAN (DAMTAN) -->
                <button class="sidebar-collapse-btn {{ Request::is('internal/damtan*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman" aria-expanded="{{ Request::is('internal/damtan*') ? 'true' : 'false' }}">
                    <span>Bagian Pemadaman</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('internal/damtan*') || Request::is('internal/surat*') ? 'show' : '' }}" id="collapsePemadaman" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/damtan/input-data" class="sidebar-item {{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
<<<<<<< HEAD
<<<<<<< HEAD
                        <a href="/internal/damtan/data-laporan" class="sidebar-item {{ Request::is('internal/damtan/data-laporan*') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
                        <a href="/internal/surat-korban/create" class="sidebar-item {{ Request::is('internal/surat*') ? 'active' : '' }}"><i class="fas fa-file-signature"></i> Buat Surat Korban</a>
=======
                        <a href="/internal/damtan/data-laporan" class="sidebar-item {{ Request::is('internal/damtan/data-laporan*') || Request::is('internal/damtan/edit-data*') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
>>>>>>> 54d349b2f34ba1d90fd3fbf4f615f46b7fe9ffd6
=======
                        <a href="/internal/damtan/data-laporan" class="sidebar-item {{ Request::is('internal/damtan/data-laporan*') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
                        <a href="/internal/surat-korban/create" class="sidebar-item {{ Request::is('internal/surat*') ? 'active' : '' }}"><i class="fas fa-file-signature"></i> Buat Surat Korban</a>
>>>>>>> 9d64ab909d89535ce270e48403a9dcabc77c2bff
                    </div>
=======
 <!-- ACCORDION PEMADAMAN (DAMTAN) -->
            <details class="side-group" {{ Request::is('internal/damtan*') || Request::is('internal/surat-korban*') ? 'open' : '' }}>
                <summary>Bagian pemadaman <i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/damtan/input-data" class="{{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}">
                        <i class="fas fa-fire-extinguisher"></i> Input data
                    </a>
                    <a href="/internal/surat-korban/create" class="{{ Request::is('internal/surat-korban/create*') ? 'active' : '' }}">
                        <i class="fas fa-file-signature"></i> Buat Surat Korban
                    </a>
                    <a href="/internal/damtan/data-laporan" class="{{ Request::is('internal/damtan/data-laporan*') || Request::is('internal/damtan/lihat-data*') || Request::is('internal/damtan/edit-data*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i> Kelola Data Laporan
                    </a>
                    <a href="/internal/surat-korban/data" class="{{ Request::is('internal/surat-korban/data*') || Request::is('internal/surat-korban/edit*') ? 'active' : '' }}">
                        <i class="fas fa-folder-open"></i> Kelola Surat Korban
                    </a>
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7
                </div>
            </details>

<<<<<<< HEAD
                <!-- ACCORDION SAPRA -->
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra" aria-expanded="false">
                    <span>Bagian Sapra</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapseSapra" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
=======
            <details class="side-group" {{ Request::is('sapra*') ? 'open' : '' }}>
                <summary>Bagian sapra <i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <span class="side-kicker" style="padding-left:2px;">Sarana &amp; Prasarana</span>
                    <a href="/sapra/sarana-mako" class="{{ Request::is('sapra/sarana-mako*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Sarana Pemadam</a>
                    <a href="/sapra/prasarana-mako" class="{{ Request::is('sapra/prasarana-mako*') ? 'active' : '' }}"><i class="fas fa-building"></i> Prasarana Pemadam</a>
                    <a href="/sapra/sarana-penyelamatan" class="{{ Request::is('sapra/sarana-penyelamatan*') ? 'active' : '' }}"><i class="fas fa-life-ring"></i> Sarana Penyelamatan</a>
                    <a href="/sapra/sarana-pemeriksaan" class="{{ Request::is('sapra/sarana-pemeriksaan*') ? 'active' : '' }}"><i class="fas fa-search"></i> Sarana Pemeriksaan</a> 
                    <a href="/sapra/kelola-pos" class="{{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}"><i class="fas fa-warehouse"></i> Kelola data pos</a>
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7

                    <span class="side-kicker" style="padding-left:2px;">Manajemen air</span>
                    <a href="/sapra/data_hidrant_gedung" class="{{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}"><i class="fas fa-droplet"></i> Sumber air</a>
                    <a href="/sapra/data-hidrant-kota" class="{{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}"><i class="fas fa-map-marker-alt"></i> Hidrant Kota Jambi</a>

                    <span class="side-kicker" style="padding-left:2px;">Logistik & Distribusi</span>
                    <a href="/sapra/kebutuhan-sarpras" class="{{ Request::is('sapra/kebutuhan-sarpras*') ? 'active' : '' }}"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>
                    <a href="/sapra/distribusi-staff" class="{{ Request::is('sapra/distribusi-staff*') ? 'active' : '' }}"><i class="fas fa-user-check"></i> Distribusi Barang Staff</a>
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

    <!-- ==================== KONTEN UTAMA & FORM ==================== -->
    <main class="content">

        <div class="page-head">
            <h1>Edit Data Penyelamatan</h1>
            <p>Ubah data laporan penyelamatan yang sudah ada.</p>
        </div>

        <div class="card-custom">
            <!-- BOOTSTRAP TABS -->
            <div class="card-header bg-white pt-3 pb-0 border-0">
                <ul class="nav nav-tabs" id="formTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">1. Informasi Dasar</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="teknis-tab" data-bs-toggle="tab" data-bs-target="#teknis" type="button" role="tab">2. Teknis & Logistik</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="dokumentasi-tab" data-bs-toggle="tab" data-bs-target="#dokumentasi" type="button" role="tab">3. Dokumentasi & Validasi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="khusus-tab" data-bs-toggle="tab" data-bs-target="#khusus" type="button" role="tab">4. Kategori Khusus</button>
                    </li>
                </ul>
            </div>

            <div class="card-body p-4 p-md-5">
                <form action="{{ route('damtan.laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="tab-content" id="formTabsContent">
                        
<<<<<<< HEAD
                          <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 5px; margin-bottom: 3px; letter-spacing: 0.5px;">MANAJEMEN AIR</span>
                        <a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Sumber Air</a>
                        <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>

                        <!-- GRUP LOGISTIK & DISTRIBUSI -->
                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 15px; margin-bottom: 3px; letter-spacing: 0.5px;">LOGISTIK & DISTRIBUSI</span>
                        <a href="/sapra/kebutuhan-sarpras" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>
<<<<<<< HEAD
<<<<<<< HEAD
                        <a href="/sapra/distribusi-staff" class="sidebar-item"><i class="fas fa-user-check"></i> Distribusi Barang Staff</a>
=======
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
>>>>>>> 54d349b2f34ba1d90fd3fbf4f615f46b7fe9ffd6
=======
                        <a href="/sapra/distribusi-staff" class="sidebar-item"><i class="fas fa-user-check"></i> Distribusi Barang Staff</a>
>>>>>>> 9d64ab909d89535ce270e48403a9dcabc77c2bff
                    </div>
                </div>
            @endif

            <!-- BAGIAN KHUSUS OPERATOR & SUPER USER -->
            @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBerita" aria-expanded="false">
                    <span>Manajemen Berita</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapseBerita" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/operator/kelola-berita" class="sidebar-item"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
                        <a href="/internal/operator/infografis" class="sidebar-item"><i class="fas fa-image"></i> Kelola Info Grafis</a>
                        <a href="/internal/operator/berita-medsos" class="sidebar-item"><i class="fab fa-instagram"></i> Kelola Berita Medsos</a>
                    </div>
                </div>
            @endif

            <!-- ACCORDION PENGATURAN -->
            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePengaturan" aria-expanded="false">
                <span>Pengaturan Akun</span>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </button>
            <div class="collapse" id="collapsePengaturan" data-bs-parent="#sidebarAccordion">
                <div class="sidebar-submenu">
                    <a href="/internal/profil" class="sidebar-item"><i class="fas fa-user-edit"></i> Profil Saya</a>
                    @if(Auth::user()->role === 'super_user')
                        <a href="/internal/kelola-user" class="sidebar-item"><i class="fas fa-users"></i> Kelola Semua Pengguna</a>
                    @endif
                </div>
            </div>
        </aside>

        <!-- MAIN AREA (FORM EDIT) -->
        <main class="main-content">
            <div class="page-header">
                <div>
                    <h1>Edit Data Penyelamatan</h1>
                    <p>Memperbarui data untuk Nomor Laporan: <strong class="text-primary">{{ $laporan->nomor_laporan ?? 'N/A' }}</strong></p>
                </div>
                <div>
                    <a href="/internal/damtan/data-laporan" class="btn btn-outline-secondary fw-bold shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i> Batal / Kembali
                    </a>
                </div>
            </div>

            <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                <div class="card-header bg-white pt-4 pb-0 border-bottom" style="border-bottom: 2px solid #f3f4f6 !important;">
                    <ul class="nav nav-tabs border-0" id="formTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">1. Informasi Dasar</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="teknis-tab" data-bs-toggle="tab" data-bs-target="#teknis" type="button" role="tab">2. Teknis & Logistik</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="dokumentasi-tab" data-bs-toggle="tab" data-bs-target="#dokumentasi" type="button" role="tab">3. Dokumentasi & Validasi</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="khusus-tab" data-bs-toggle="tab" data-bs-target="#khusus" type="button" role="tab">4. Kategori Khusus</button>
                        </li>
                    </ul>
                </div>

                <div class="card-body p-4 bg-white">
                    <!-- INI BAGIAN YANG DIPERBAIKI (ACTION & METHOD) -->
                    <form action="/internal/damtan/update-data/{{ $laporan->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 
                        
                        <div class="tab-content" id="formTabsContent">
                            
                            <!-- TAB 1: INFORMASI DASAR -->
                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <h5 class="fw-bold mb-4 text-primary"><i class="fas fa-info-circle me-2"></i>Informasi Dasar Kejadian</h5>
                                
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Nomor Laporan (Auto)</label>
                                        <input type="text" class="form-control" name="nomor_laporan" value="{{ $laporan->nomor_laporan ?? '' }}" readonly style="background-color: #f9fafb;">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">ID Laporan (Auto)</label>
                                        <input type="text" class="form-control" name="id_laporan" value="{{ $laporan->id_laporan ?? '' }}" readonly style="background-color: #f9fafb;">
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label text-danger fw-bold" style="font-size: 13px;">Kategori Laporan (Kebakaran)</label>
                                        <select class="form-select" name="kategori_kebakaran">
                                            <option value="">-- Pilih Jenis Kebakaran --</option>
                                            <option value="rumah_tinggal" {{ ($laporan->kategori_kebakaran ?? '') == 'rumah_tinggal' ? 'selected' : '' }}>Rumah Tinggal</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-primary fw-bold" style="font-size: 13px;">Kategori Laporan (Non-Kebakaran)</label>
                                        <select class="form-select" name="kategori_non_kebakaran">
                                            <option value="">-- Pilih Jenis Evakuasi --</option>
                                            <option value="animal_rescue" {{ ($laporan->kategori_non_kebakaran ?? '') == 'animal_rescue' ? 'selected' : '' }}>Evakuasi Hewan (Animal Rescue)</option>
                                            <option value="pohon_tumbang" {{ ($laporan->kategori_non_kebakaran ?? '') == 'pohon_tumbang' ? 'selected' : '' }}>Pohon Tumbang</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold" style="font-size: 13px; color: #4b5563;">Kategori Kejadian Umum</label>
                                        <select class="form-select" name="kategori_kejadian">
                                            <option value="">-- Pilih Kategori Kejadian --</option>
                                            <option value="kebakaran" {{ ($laporan->kategori_kejadian ?? '') == 'kebakaran' ? 'selected' : '' }}>Kebakaran</option>
                                            <option value="penyelamatan_hewan" {{ ($laporan->kategori_kejadian ?? '') == 'penyelamatan_hewan' ? 'selected' : '' }}>Penyelamatan Hewan</option>
                                            <option value="bencana_alam" {{ ($laporan->kategori_kejadian ?? '') == 'bencana_alam' ? 'selected' : '' }}>Bencana Alam</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label d-block" style="font-size: 13px; font-weight: 600; color: #4b5563;">Tingkat Prioritas</label>
                                        @php $prio = $laporan->prioritas ?? ''; @endphp
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" value="rendah" {{ $prio == 'rendah' ? 'checked' : '' }}>
                                            <label class="form-check-label text-secondary fw-bold">Rendah</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" value="sedang" {{ $prio == 'sedang' ? 'checked' : '' }}>
                                            <label class="form-check-label text-primary fw-bold">Sedang</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" value="tinggi" {{ $prio == 'tinggi' ? 'checked' : '' }}>
                                            <label class="form-check-label text-warning fw-bold">Tinggi</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" value="darurat" {{ $prio == 'darurat' ? 'checked' : '' }}>
                                            <label class="form-check-label text-danger fw-bold">Darurat</label>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3 mt-4" style="font-size: 14px;">Detail Waktu Operasi</h6>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Waktu Kejadian</label>
                                        <input type="datetime-local" name="waktu_kejadian" class="form-control" value="{{ $laporan->waktu_kejadian ?? '' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Waktu Terima Laporan</label>
                                        <input type="datetime-local" name="waktu_terima" class="form-control" value="{{ $laporan->waktu_terima ?? '' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Waktu Berangkat Unit</label>
                                        <input type="datetime-local" name="waktu_berangkat" class="form-control" value="{{ $laporan->waktu_berangkat ?? '' }}">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Waktu Tiba di Lokasi</label>
                                        <input type="datetime-local" name="waktu_tiba" class="form-control" value="{{ $laporan->waktu_tiba ?? '' }}">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Waktu Operasi Selesai</label>
                                        <input type="datetime-local" name="waktu_selesai" class="form-control" value="{{ $laporan->waktu_selesai ?? '' }}">
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Alamat Lengkap</label>
                                        <textarea class="form-control" name="alamat" rows="3">{{ $laporan->alamat ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Titik Koordinat (Lat, Long)</label>
                                        @php $coords = $laporan->koordinat ?? '-1.60921, 103.58231'; @endphp
                                        <input type="text" class="form-control mb-2" id="inputKoordinat" name="koordinat" value="{{ $coords }}">
                                        <button type="button" class="btn btn-outline-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#mapModal">
                                            <i class="fas fa-map-marker-alt me-1"></i> Ubah Peta Interaktif
                                        </button>
=======
                        <!-- TAB 1: INFORMASI DASAR -->
                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                            <h5 class="section-title"><i class="fas fa-info-circle"></i> Informasi Dasar Kejadian</h5>
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-hashtag"></i> Nomor Laporan</label>
                                    <input type="text" class="form-control" name="nomor_laporan" value="{{ $laporan->nomor_laporan }}" readonly style="background-color: #e2e8f0;">
                                </div>
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-fingerprint"></i> ID Laporan</label>
                                    <input type="text" class="form-control" name="id_laporan" value="{{ $laporan->id_laporan }}" readonly style="background-color: #e2e8f0;">
                                </div>
                            </div>

                            <div class="row g-4 mb-4 pb-4 border-bottom">
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-user"></i> Nama Pelapor</label>
                                    <input type="text" class="form-control" name="nama_pelapor" value="{{ $laporan->nama_pelapor ?? '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-headset"></i> Layanan Pelaporan</label>
                                    <select class="form-select" name="media_pelaporan">
                                        <option value="">-- Pilih Layanan --</option>
                                        <option value="whatsapp" {{ ($laporan->media_pelaporan ?? '') == 'whatsapp' ? 'selected' : '' }}>Layanan WA Damkar</option>
                                        <option value="telepon" {{ ($laporan->media_pelaporan ?? '') == 'telepon' ? 'selected' : '' }}>Telepon Call Center</option>
                                        <option value="langsung" {{ ($laporan->media_pelaporan ?? '') == 'langsung' ? 'selected' : '' }}>Datang Langsung ke Mako/Pos</option>
                                        <option value="instansi_lain" {{ ($laporan->media_pelaporan ?? '') == 'instansi_lain' ? 'selected' : '' }}>Laporan Instansi Lain</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-route"></i> Jarak Tempuh</label>
                                    <div class="input-group">
                                        <input type="number" step="0.1" min="0" name="jarak_tempuh" class="form-control" value="{{ $laporan->jarak_tempuh ?? '' }}">
                                        <span class="input-group-text">Km</span>
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7
                                    </div>
                                </div>
                            </div>

<<<<<<< HEAD
                            <!-- TAB 2: TEKNIS & LOGISTIK -->
                            <div class="tab-pane fade" id="teknis" role="tabpanel">
                                <h5 class="fw-bold mb-4 text-primary"><i class="fas fa-tools me-2"></i>Teknis Penyelamatan & Logistik</h5>
                                
                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3" style="font-size: 14px;">Status Korban</h6>
                                <div class="row g-3 mb-2">
                                    <div class="col-md-3">
                                        <label class="form-label" style="font-size: 12px; font-weight: 600;">Manusia: Selamat</label>
                                        <input type="number" name="korban_selamat" class="form-control" value="{{ $teknis->korban_selamat ?? 0 }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" style="font-size: 12px; font-weight: 600;">Manusia: Luka Ringan</label>
                                        <input type="number" name="korban_ringan" class="form-control" value="{{ $teknis->korban_ringan ?? 0 }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" style="font-size: 12px; font-weight: 600;">Manusia: Luka Berat</label>
                                        <input type="number" name="korban_berat" class="form-control" value="{{ $teknis->korban_berat ?? 0 }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label text-danger" style="font-size: 12px; font-weight: 600;">Manusia: Meninggal</label>
                                        <input type="number" name="korban_meninggal" class="form-control" value="{{ $teknis->korban_meninggal ?? 0 }}">
                                    </div>
                                </div>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label" style="font-size: 12px; font-weight: 600;">Hewan / Aset (Jika relevan)</label>
                                        <input type="text" name="korban_hewan_aset" class="form-control" value="{{ $teknis->korban_hewan_aset ?? '' }}">
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3" style="font-size: 14px;">Detail Evakuasi & Lapangan</h6>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Status Evakuasi</label>
                                        <select class="form-select" name="status_evakuasi">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="selesai" {{ ($teknis->status_evakuasi ?? '') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="dalam_proses" {{ ($teknis->status_evakuasi ?? '') == 'dalam_proses' ? 'selected' : '' }}>Dalam Proses</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Objek Terdampak</label>
                                        <input type="text" name="objek_terdampak" class="form-control" value="{{ $teknis->objek_terdampak ?? '' }}">
                                    </div>
                                </div>
                                
                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Hambatan Lapangan</label>
                                        <textarea class="form-control" name="hambatan_lapangan" rows="2">{{ $teknis->hambatan_lapangan ?? '' }}</textarea>
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3 mt-4" style="font-size: 14px;">Alat, Logistik & Personel</h6>
                                <div class="row g-3 mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Konsumsi Alat Umum</label>
                                        <input type="text" name="konsumsi_alat" class="form-control" value="{{ $teknis->konsumsi_alat ?? '' }}">
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-8">
                                        @php $armadaData = json_decode($teknis->armada ?? '[]'); @endphp
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Unit Armada</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="armada[]" value="pompa" {{ is_array($armadaData) && in_array('pompa', $armadaData) ? 'checked' : '' }}>
                                            <label class="form-check-label">Unit Pompa</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="armada[]" value="rescue" {{ is_array($armadaData) && in_array('rescue', $armadaData) ? 'checked' : '' }}>
                                            <label class="form-check-label">Unit Rescue</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Jumlah Personel</label>
                                        <input type="number" name="jumlah_personel" class="form-control" value="{{ $teknis->jumlah_personel ?? 0 }}">
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Personel yang Terlibat</label>
                                        <textarea class="form-control" name="daftar_personel" rows="2">{{ $teknis->daftar_personel ?? '' }}</textarea>
=======
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="field-label text-danger"><i class="fas fa-fire"></i> Kategori Laporan (Kebakaran)</label>
                                    <select class="form-select" name="kategori_kebakaran">
                                        <option value="">-- Pilih Jenis Kebakaran --</option>
                                        <option value="rumah_tinggal" {{ $laporan->kategori_kebakaran == 'rumah_tinggal' ? 'selected' : '' }}>Rumah Tinggal</option>
                                        <option value="lahan" {{ $laporan->kategori_kebakaran == 'lahan' ? 'selected' : '' }}>Lahan</option>
                                        <option value="bangunan_publik" {{ $laporan->kategori_kebakaran == 'bangunan_publik' ? 'selected' : '' }}>Bangunan Publik</option>
                                        <option value="kendaraan" {{ $laporan->kategori_kebakaran == 'kendaraan' ? 'selected' : '' }}>Kendaraan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-life-ring"></i> Kategori Laporan (Non-Kebakaran)</label>
                                    <div class="d-flex gap-2">
                                        <select class="form-select" name="kategori_non_kebakaran" style="width: 50%;">
                                            <option value="">-- Pilih Jenis Evakuasi --</option>
                                            <option value="fire_rescue" {{ $laporan->kategori_non_kebakaran == 'fire_rescue' ? 'selected' : '' }}>Fire Rescue</option>
                                            <option value="water_rescue" {{ $laporan->kategori_non_kebakaran == 'water_rescue' ? 'selected' : '' }}>Water Rescue</option>
                                            <option value="land_rescue" {{ $laporan->kategori_non_kebakaran == 'land_rescue' ? 'selected' : '' }}>Land Rescue</option>
                                            <option value="evakuasi_liar" {{ $laporan->kategori_non_kebakaran == 'evakuasi_liar' ? 'selected' : '' }}>Evakuasi Hewan Liar</option>
                                            <option value="evakuasi_ternak" {{ $laporan->kategori_non_kebakaran == 'evakuasi_ternak' ? 'selected' : '' }}>Evakuasi Ternak</option>
                                            <option value="evakuasi_piaraan" {{ $laporan->kategori_non_kebakaran == 'evakuasi_piaraan' ? 'selected' : '' }}>Evakuasi Hewan Peliharaan</option>
                                            <option value="evakuasi_cincin" {{ $laporan->kategori_non_kebakaran == 'evakuasi_cincin' ? 'selected' : '' }}>Evakuasi Cincin / Anting</option>
                                            <option value="evakuasi_kendaraan" {{ $laporan->kategori_non_kebakaran == 'evakuasi_kendaraan' ? 'selected' : '' }}>Evakuasi Kendaraan Bermotor</option>
                                            <option value="lainnya" {{ $laporan->kategori_non_kebakaran == 'lainnya' ? 'selected' : '' }}>Lainnya (Sebutkan...)</option>
                                        </select>
                                        <input type="text" class="form-control" name="rincian_kategori_non_kebakaran" value="{{ $laporan->rincian_kategori_non_kebakaran }}" style="width: 50%;">
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7
                                    </div>
                                </div>
                            </div>

<<<<<<< HEAD
                            <!-- TAB 3: DOKUMENTASI & VALIDASI -->
                            <div class="tab-pane fade" id="dokumentasi" role="tabpanel">
                                <h5 class="fw-bold mb-4 text-primary"><i class="fas fa-search-dollar me-2"></i>Analisis Risiko & Penyebab</h5>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Dugaan Penyebab</label>
                                        <div class="d-flex gap-2">
                                            <select class="form-select" name="dugaan_penyebab" style="width: 50%;">
                                                <option value="">-- Pilih Penyebab --</option>
                                                <option value="faktor_alam" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'faktor_alam' ? 'selected' : '' }}>Faktor alam</option>
                                                <option value="lainnya" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                            <input type="text" class="form-control" name="dugaan_penyebab_lainnya" placeholder="Ketik jika 'Lainnya'..." value="{{ $dokumentasi->dugaan_penyebab_lainnya ?? '' }}" style="width: 50%;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Sumber Api / Titik Awal</label>
                                        <input type="text" name="sumber_api" class="form-control" value="{{ $dokumentasi->sumber_api ?? '' }}">
                                    </div>
=======
                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-layer-group"></i> Kategori Kejadian Umum</label>
                                    <select class="form-select" name="kategori_kejadian">
                                        <option value="">-- Pilih Kategori Kejadian --</option>
                                        <option value="kebakaran" {{ $laporan->kategori_kejadian == 'kebakaran' ? 'selected' : '' }}>Kebakaran</option>
                                        <option value="penyelamatan_hewan" {{ $laporan->kategori_kejadian == 'penyelamatan_hewan' ? 'selected' : '' }}>Penyelamatan Hewan</option>
                                        <option value="bencana_alam" {{ $laporan->kategori_kejadian == 'bencana_alam' ? 'selected' : '' }}>Bencana Alam</option>
                                        <option value="kecelakaan_lalu_lintas" {{ $laporan->kategori_kejadian == 'kecelakaan_lalu_lintas' ? 'selected' : '' }}>Kecelakaan Lalu Lintas</option>
                                        <option value="evakuasi_medis" {{ $laporan->kategori_kejadian == 'evakuasi_medis' ? 'selected' : '' }}>Evakuasi Medis</option>
                                    </select>
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7
                                </div>
                            </div>

<<<<<<< HEAD
                                <h5 class="fw-bold mb-4 text-primary border-top pt-4"><i class="fas fa-handshake me-2"></i>Kerjasama Lintas Sektoral</h5>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        @php $instansiData = json_decode($dokumentasi->instansi_pendukung ?? '[]'); @endphp
                                        <label class="form-label mb-2" style="font-size: 13px; font-weight: 600;">Instansi Pendukung di Lokasi</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inst_pln" name="instansi_pendukung[]" value="pln" {{ is_array($instansiData) && in_array('pln', $instansiData) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inst_pln" style="font-size: 13px;">PLN</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inst_relawan" name="instansi_pendukung[]" value="relawan_lokal" {{ is_array($instansiData) && in_array('relawan_lokal', $instansiData) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inst_relawan" style="font-size: 13px;">Relawan Lokal</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-8">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Tindakan Instansi Samping</label>
                                        <textarea class="form-control" name="tindakan_instansi" rows="2">{{ $dokumentasi->tindakan_instansi ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Nomor Kontak Saksi</label>
                                        <input type="text" name="kontak_saksi" class="form-control" value="{{ $dokumentasi->kontak_saksi ?? '' }}">
                                    </div>
                                </div>

                                <h5 class="fw-bold mb-4 text-primary border-top pt-4"><i class="fas fa-clipboard-check me-2"></i>Evaluasi & Rekomendasi</h5>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <label class="form-label d-block" style="font-size: 13px; font-weight: 600;">Ketepatan Alat (Skala 1-5)</label>
                                        @php $alat = $dokumentasi->ketepatan_alat ?? 5; @endphp
                                        <div class="btn-group" role="group">
                                            <input type="radio" class="btn-check" name="ketepatan_alat" id="alat_1" value="1" {{ $alat == 1 ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary btn-sm" for="alat_1">1</label>
                                            
                                            <input type="radio" class="btn-check" name="ketepatan_alat" id="alat_5" value="5" {{ $alat == 5 ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary btn-sm" for="alat_5">5</label>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="fw-bold mb-4 text-primary border-top pt-4"><i class="fas fa-camera me-2"></i>Dokumentasi & Catatan Akhir</h5>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Kronologi Kejadian Terperinci</label>
                                        <textarea class="form-control" name="kronologi_lengkap" rows="5">{{ $dokumentasi->kronologi_lengkap ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Update File Foto (Biarkan kosong jika tidak diubah)</label>
                                        <input class="form-control mb-2" type="file" name="foto[]" multiple accept="image/png, image/jpeg">
                                        @if(!empty($dokumentasi->foto))
                                            <small class="text-success"><i class="fas fa-check me-1"></i> Foto sudah terunggah sebelumnya.</small>
                                        @endif
=======
                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label w-100"><i class="fas fa-exclamation-circle"></i> Tingkat Prioritas</label>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="radio" name="prioritas" id="prio1" value="rendah" {{ $laporan->prioritas == 'rendah' ? 'checked' : '' }}>
                                        <label class="form-check-label text-secondary fw-bold" for="prio1">Rendah</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="radio" name="prioritas" id="prio2" value="sedang" {{ $laporan->prioritas == 'sedang' ? 'checked' : '' }}>
                                        <label class="form-check-label text-primary fw-bold" for="prio2">Sedang</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="radio" name="prioritas" id="prio3" value="tinggi" {{ $laporan->prioritas == 'tinggi' ? 'checked' : '' }}>
                                        <label class="form-check-label text-warning fw-bold" for="prio3">Tinggi</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="radio" name="prioritas" id="prio4" value="darurat" {{ $laporan->prioritas == 'darurat' ? 'checked' : '' }}>
                                        <label class="form-check-label text-danger fw-bold" for="prio4">Darurat</label>
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7
                                    </div>
                                </div>
                            </div>

<<<<<<< HEAD
                            <!-- TAB 4: KATEGORI KHUSUS -->
                            <div class="tab-pane fade" id="khusus" role="tabpanel">
                                <h5 class="fw-bold mb-4 text-primary"><i class="fas fa-paw me-2"></i>Kategori Khusus Penyelamatan Hewan</h5>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Jenis Hewan</label>
                                        <select class="form-select" name="jenis_hewan">
                                            <option value="">-- Pilih Jenis Hewan --</option>
                                            <option value="ular" {{ ($khusus->jenis_hewan ?? '') == 'ular' ? 'selected' : '' }}>Ular</option>
                                            <option value="tawon" {{ ($khusus->jenis_hewan ?? '') == 'tawon' ? 'selected' : '' }}>Tawon/Vespa</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Spesies / Nama Lokal</label>
                                        <input type="text" name="spesies_hewan" class="form-control" value="{{ $khusus->spesies_hewan ?? '' }}">
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Dimensi Hewan</label>
                                        <input type="text" name="dimensi_hewan" class="form-control" value="{{ $khusus->dimensi_hewan ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Status Hewan Pasca Evakuasi</label>
                                        <select class="form-select" name="status_hewan_pasca">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="dilepasliarkan" {{ ($khusus->status_hewan_pasca ?? '') == 'dilepasliarkan' ? 'selected' : '' }}>Dilepasliarkan ke habitat</option>
                                            <option value="diserahkan_bksda" {{ ($khusus->status_hewan_pasca ?? '') == 'diserahkan_bksda' ? 'selected' : '' }}>Diserahkan ke BKSDA</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Lokasi Habitat Pelepasan</label>
                                        <input type="text" name="lokasi_pelepasan" class="form-control" value="{{ $khusus->lokasi_pelepasan ?? '' }}">
                                    </div>
                                </div>
=======
                            <div class="row g-4 mb-4 p-4 rounded border" style="background: rgba(243, 245, 248, 0.5);">
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-calendar-alt"></i> Waktu Kejadian</label>
                                    <input type="datetime-local" name="waktu_kejadian" class="form-control" value="{{ $laporan->waktu_kejadian ? date('Y-m-d\TH:i', strtotime($laporan->waktu_kejadian)) : '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-clock"></i> Waktu Terima Laporan</label>
                                    <input type="datetime-local" name="waktu_terima" class="form-control" value="{{ $laporan->waktu_terima ? date('Y-m-d\TH:i', strtotime($laporan->waktu_terima)) : '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-truck-moving"></i> Waktu Berangkat Unit</label>
                                    <input type="datetime-local" name="waktu_berangkat" class="form-control" value="{{ $laporan->waktu_berangkat ? date('Y-m-d\TH:i', strtotime($laporan->waktu_berangkat)) : '' }}">
                                </div>
                                
                                <div class="col-md-4 mt-4">
                                    <label class="field-label"><i class="fas fa-map-marker-alt"></i> Waktu Tiba di Lokasi</label>
                                    <input type="datetime-local" name="waktu_tiba" class="form-control" value="{{ $laporan->waktu_tiba ? date('Y-m-d\TH:i', strtotime($laporan->waktu_tiba)) : '' }}">
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label class="field-label"><i class="fas fa-flag-checkered"></i> Waktu Operasi Selesai</label>
                                    <input type="datetime-local" name="waktu_selesai" class="form-control" value="{{ $laporan->waktu_selesai ? date('Y-m-d\TH:i', strtotime($laporan->waktu_selesai)) : '' }}">
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label class="field-label"><i class="fas fa-building"></i> Waktu Kembali ke Mako</label>
                                    <input type="datetime-local" name="waktu_kembali" class="form-control" value="{{ $laporan->waktu_kembali ? date('Y-m-d\TH:i', strtotime($laporan->waktu_kembali)) : '' }}">
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-8">
                                    <label class="field-label"><i class="fas fa-map-signs"></i> Alamat Lengkap</label>
                                    <textarea class="form-control" name="alamat" rows="2">{{ $laporan->alamat }}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-location-arrow"></i> Titik Koordinat</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" id="inputKoordinat" name="koordinat" value="{{ $laporan->koordinat }}">
                                    </div>
                                    <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#mapModal">
                                        <i class="fas fa-map-marked-alt me-1"></i> Buka Peta Interaktif
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: TEKNIS & LOGISTIK -->
                        <div class="tab-pane fade" id="teknis" role="tabpanel">
                            <h5 class="section-title"><i class="fas fa-tools"></i> Teknis Penyelamatan & Logistik</h5>
                            
                            <div class="row g-4 mb-5 border-bottom pb-4">
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-user-shield"></i> Pimpinan Operasi</label>
                                    <input type="text" name="pimpinan_operasi" class="form-control" value="{{ $teknis->pimpinan_operasi ?? '' }}" placeholder="Cth: Danru 4 Mako">
                                </div>
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-user-friends"></i> Pendamping Operasi</label>
                                    <input type="text" name="pendamping_operasi" class="form-control" value="{{ $teknis->pendamping_operasi ?? '' }}" placeholder="Opsional...">
                                </div>
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-users-cog"></i> Satuan Tugas / Regu</label>
                                    <input type="text" name="satuan_tugas" class="form-control" value="{{ $teknis->satuan_tugas ?? '' }}" placeholder="Cth: Pleton 1 Mako">
                                </div>
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-stopwatch"></i> Tim Respon Time</label>
                                    <input type="text" name="tim_respontime" class="form-control" value="{{ $teknis->tim_respontime ?? '' }}" placeholder="Cth: 15 Menit">
                                </div>
                            </div>

                            <h6 class="fw-bold mb-3" style="color: var(--steel);">Status Korban Manusia & Aset</h6>
                            <div class="row g-4 mb-4">
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-user-check text-success"></i> Selamat</label>
                                    <input type="number" min="0" name="korban_selamat" class="form-control" value="{{ $teknis->korban_selamat ?? 0 }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-user-injured text-warning"></i> Luka Ringan</label>
                                    <input type="number" min="0" name="korban_ringan" class="form-control" value="{{ $teknis->korban_ringan ?? 0 }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-procedures text-warning"></i> Luka Berat</label>
                                    <input type="number" min="0" name="korban_berat" class="form-control" value="{{ $teknis->korban_berat ?? 0 }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-user-times text-danger"></i> Meninggal Dunia</label>
                                    <input type="number" min="0" name="korban_meninggal" class="form-control" value="{{ $teknis->korban_meninggal ?? 0 }}">
                                </div>
                            </div>
                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-cat"></i> Hewan / Aset (Jika relevan)</label>
                                    <input type="text" name="korban_hewan_aset" class="form-control" value="{{ $teknis->korban_hewan_aset ?? '' }}" placeholder="Contoh: 1 ekor ular piton dievakuasi...">
                                </div>
                            </div>

                            <h6 class="fw-bold mb-3 mt-5 border-bottom pb-2" style="color: var(--steel);">Detail Evakuasi & Lapangan</h6>
                            <div class="row g-4 mb-4">
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-info-circle"></i> Status Evakuasi</label>
                                    <select class="form-select" name="status_evakuasi">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="selesai" {{ ($teknis->status_evakuasi ?? '') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="dalam_proses" {{ ($teknis->status_evakuasi ?? '') == 'dalam_proses' ? 'selected' : '' }}>Dalam Proses</option>
                                        <option value="dirujuk_ke_rs" {{ ($teknis->status_evakuasi ?? '') == 'dirujuk_ke_rs' ? 'selected' : '' }}>Dirujuk ke RS</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label class="field-label"><i class="fas fa-house-damage"></i> Objek Terdampak</label>
                                    <input type="text" name="objek_terdampak" class="form-control" value="{{ $teknis->objek_terdampak ?? '' }}">
                                </div>
                            </div>

                            <div class="row g-4 mb-4 p-4 rounded border" style="background: rgba(243, 245, 248, 0.5);">
                                @php $evakuasi = json_decode($teknis->metode_evakuasi ?? '[]', true) ?? []; @endphp
                                <div class="col-md-12 mb-2">
                                    <label class="field-label w-100"><i class="fas fa-route"></i> Metode Evakuasi</label>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="me_vr" name="metode_evakuasi[]" value="vertical_rescue" {{ in_array('vertical_rescue', $evakuasi) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="me_vr">Vertical Rescue</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="me_wr" name="metode_evakuasi[]" value="water_rescue" {{ in_array('water_rescue', $evakuasi) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="me_wr">Water Rescue</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="me_td" name="metode_evakuasi[]" value="tangga_darurat" {{ in_array('tangga_darurat', $evakuasi) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="me_td">Penggunaan Tangga Darurat</label>
                                    </div>
                                </div>

                                @php $penyelamatan = json_decode($teknis->metode_penyelamatan ?? '[]', true) ?? []; @endphp
                                <div class="col-md-12">
                                    <label class="field-label w-100"><i class="fas fa-hands-helping"></i> Metode Penyelamatan</label>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="mp_vr" name="metode_penyelamatan[]" value="vertical_rescue" {{ in_array('vertical_rescue', $penyelamatan) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="mp_vr">Vertical Rescue</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="mp_wr" name="metode_penyelamatan[]" value="water_rescue" {{ in_array('water_rescue', $penyelamatan) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="mp_wr">Water Rescue</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="mp_ps" name="metode_penyelamatan[]" value="pemadaman_statis" {{ in_array('pemadaman_statis', $penyelamatan) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="mp_ps">Pemadam Statis</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="mp_pd" name="metode_penyelamatan[]" value="pemadaman_dinamis" {{ in_array('pemadaman_dinamis', $penyelamatan) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="mp_pd">Pemadam Dinamis</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="mp_emd" name="metode_penyelamatan[]" value="evakuasi_medis_dasar" {{ in_array('evakuasi_medis_dasar', $penyelamatan) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="mp_emd">Evakuasi Medis Dasar</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-exclamation-triangle"></i> Hambatan Lapangan</label>
                                    <textarea class="form-control" name="hambatan_lapangan" rows="2">{{ $teknis->hambatan_lapangan ?? '' }}</textarea>
                                </div>
                            </div>
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-tasks"></i> Langkah Penanganan</label>
                                    <textarea class="form-control" name="langkah_penanganan" rows="2">{{ $teknis->langkah_penanganan ?? '' }}</textarea>
                                </div>
                            </div>
                            
                            <div class="row g-4 mb-4 border-bottom pb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-check-double"></i> Hasil Tindakan</label>
                                    <input type="text" name="hasil_tindakan" class="form-control" value="{{ $teknis->hasil_tindakan ?? '' }}">
                                </div>
                            </div>

                            <h6 class="fw-bold mb-3 mt-5 border-bottom pb-2" style="color: var(--steel);">Alat, Logistik & Personel</h6>
                            @php $alat = json_decode($teknis->peralatan ?? '[]', true) ?? []; @endphp
                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label w-100"><i class="fas fa-toolbox"></i> Peralatan Khusus yang Digunakan</label>
                                    <div class="btn-group" role="group">
                                        <input type="checkbox" class="btn-check" id="alat_scba" name="peralatan[]" value="SCBA" {{ in_array('SCBA', $alat) ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="alat_scba">SCBA</label>

                                        <input type="checkbox" class="btn-check" id="alat_thermal" name="peralatan[]" value="Thermal Camera" {{ in_array('Thermal Camera', $alat) ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="alat_thermal">Thermal Camera</label>

                                        <input type="checkbox" class="btn-check" id="alat_chainsaw" name="peralatan[]" value="Chainsaw" {{ in_array('Chainsaw', $alat) ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="alat_chainsaw">Chainsaw</label>

                                        <input type="checkbox" class="btn-check" id="alat_selam" name="peralatan[]" value="Alat Selam" {{ in_array('Alat Selam', $alat) ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="alat_selam">Alat Selam</label>
                                    </div>
                                    <input type="text" name="peralatan_lain" class="form-control mt-3" placeholder="Alat khusus lainnya..." value="{{ $teknis->peralatan_lain ?? '' }}">
                                </div>
                            </div>
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-spray-can"></i> Konsumsi Alat Umum</label>
                                    <input type="text" name="konsumsi_alat" class="form-control" value="{{ $teknis->konsumsi_alat ?? '' }}">
                                </div>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-tint"></i> Liter Air Digunakan</label>
                                    <div class="input-group">
                                        <input type="number" min="0" name="liter_air" class="form-control" value="{{ $teknis->liter_air ?? 0 }}">
                                        <span class="input-group-text">L</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-soap"></i> Liter Foam</label>
                                    <div class="input-group">
                                        <input type="number" min="0" name="liter_foam" class="form-control" value="{{ $teknis->liter_foam ?? 0 }}">
                                        <span class="input-group-text">L</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-gas-pump"></i> Liter BBM Unit</label>
                                    <div class="input-group">
                                        <input type="number" min="0" name="liter_bbm" class="form-control" value="{{ $teknis->liter_bbm ?? 0 }}">
                                        <span class="input-group-text">L</span>
                                    </div>
                                </div>
                            </div>

                            @php $armada = json_decode($teknis->armada ?? '[]', true) ?? []; @endphp
                            <div class="row g-4 mb-4">
                                <div class="col-md-8">
                                    <label class="field-label w-100"><i class="fas fa-truck"></i> Unit Armada Terlibat</label>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="arm_pompa" name="armada[]" value="pompa" {{ in_array('pompa', $armada) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="arm_pompa">Unit Pompa</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="arm_rescue" name="armada[]" value="rescue" {{ in_array('rescue', $armada) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="arm_rescue">Unit Rescue</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="arm_tangki" name="armada[]" value="tangki" {{ in_array('tangki', $armada) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="arm_tangki">Unit Tangki</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="arm_ambulans" name="armada[]" value="ambulans" {{ in_array('ambulans', $armada) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="arm_ambulans">Ambulans</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-users"></i> Jumlah Personel</label>
                                    <input type="number" min="0" name="jumlah_personel" class="form-control" value="{{ $teknis->jumlah_personel ?? 0 }}">
                                </div>
                            </div>
                            
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-user-tag"></i> Personel yang Terlibat</label>
                                    <textarea class="form-control" name="daftar_personel" rows="2">{{ $teknis->daftar_personel ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 3: DOKUMENTASI, EVALUASI & VALIDASI -->
                        <div class="tab-pane fade" id="dokumentasi" role="tabpanel">
                            <h5 class="section-title"><i class="fas fa-clipboard-list"></i> Analisis & Evaluasi Kejadian</h5>
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-bolt"></i> Dugaan Penyebab</label>
                                    <div class="d-flex gap-2">
                                        <select class="form-select" name="dugaan_penyebab" style="width: 50%;">
                                            <option value="">-- Pilih Penyebab --</option>
                                            <option value="arus_pendek" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'arus_pendek' ? 'selected' : '' }}>Arus pendek listrik</option>
                                            <option value="kebocoran_gas" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'kebocoran_gas' ? 'selected' : '' }}>Kebocoran gas</option>
                                            <option value="sambaran_petir" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'sambaran_petir' ? 'selected' : '' }}>Sambaran petir</option>
                                            <option value="kelalaian_manusia" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'kelalaian_manusia' ? 'selected' : '' }}>Kelalaian manusia</option>
                                            <option value="faktor_alam" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'faktor_alam' ? 'selected' : '' }}>Faktor alam</option>
                                            <option value="lainnya" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        <input type="text" class="form-control" name="dugaan_penyebab_lainnya" value="{{ $dokumentasi->dugaan_penyebab_lainnya ?? '' }}" style="width: 50%;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-fire-alt"></i> Sumber Api / Titik Awal</label>
                                    <input type="text" name="sumber_api" class="form-control" value="{{ $dokumentasi->sumber_api ?? '' }}">
                                </div>
                            </div>

                            <div class="row g-4 mb-4 border-bottom pb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-ruler-combined"></i> Luas Area Terdampak</label>
                                    <div class="input-group" style="width: 50%;">
                                        <input type="number" min="0" step="0.1" name="luas_area" class="form-control" value="{{ $dokumentasi->luas_area ?? '' }}">
                                        <span class="input-group-text">m²</span>
                                    </div>
                                </div>
                            </div>

                            <h6 class="fw-bold mb-3 mt-5 border-bottom pb-2" style="color: var(--steel);">Kerjasama Lintas Sektoral & Evaluasi</h6>
                            @php $instansi = json_decode($dokumentasi->instansi_pendukung ?? '[]', true) ?? []; @endphp
                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label w-100"><i class="fas fa-building"></i> Instansi Pendukung di Lokasi</label>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_pln" name="instansi_pendukung[]" value="pln" {{ in_array('pln', $instansi) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inst_pln">PLN</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_polisi" name="instansi_pendukung[]" value="polisi" {{ in_array('polisi', $instansi) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inst_polisi">Polisi</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_tni" name="instansi_pendukung[]" value="tni" {{ in_array('tni', $instansi) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inst_tni">TNI</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_pmi" name="instansi_pendukung[]" value="pmi" {{ in_array('pmi', $instansi) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inst_pmi">BPBD</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_relawan" name="instansi_pendukung[]" value="relawan_lokal" {{ in_array('relawan_lokal', $instansi) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inst_relawan">Relawan Lokal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 mb-4">
                                <div class="col-md-8">
                                    <label class="field-label"><i class="fas fa-tasks"></i> Tindakan Instansi Samping</label>
                                    <textarea class="form-control" name="tindakan_instansi" rows="2">{{ $dokumentasi->tindakan_instansi ?? '' }}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-phone-alt"></i> No. Kontak Saksi/Warga</label>
                                    <input type="text" name="kontak_saksi" class="form-control" value="{{ $dokumentasi->kontak_saksi ?? '' }}">
                                </div>
                            </div>

                            <div class="row g-4 mb-4 border-bottom pb-4">
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-plus-circle"></i> Kebutuhan Tambahan</label>
                                    <textarea class="form-control" name="kebutuhan_tambahan" rows="2">{{ $dokumentasi->kebutuhan_tambahan ?? '' }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-lightbulb"></i> Saran Mitigasi Warga</label>
                                    <textarea class="form-control" name="saran_mitigasi" rows="2">{{ $dokumentasi->saran_mitigasi ?? '' }}</textarea>
                                </div>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-hands-helping"></i> Cara Bertindak</label>
                                    <select class="form-select" name="cara_bertindak">
                                        <option value="5T" {{ ($dokumentasi->cara_bertindak ?? '') == '5T' ? 'selected' : '' }}>5 T (Terencana, Terukur, Terarah, Terlayani & Tuntas)</option>
                                        <option value="lainnya" {{ ($dokumentasi->cara_bertindak ?? '') == 'lainnya' ? 'selected' : '' }}>Lainnya...</option>
                                    </select>
                                </div>
                            </div>

                            <h6 class="fw-bold mb-3 mt-5 border-bottom pb-2" style="color: var(--steel);">Dokumentasi Akhir</h6>
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-align-left"></i> Kronologi Terperinci</label>
                                    <textarea class="form-control" name="kronologi_lengkap" rows="4">{{ $dokumentasi->kronologi_lengkap ?? '' }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="field-label"><i class="fas fa-images"></i> Upload Foto Baru (.jpg/.png)</label>
                                        <input class="form-control" type="file" name="foto[]" multiple accept="image/png, image/jpeg">
                                        <small class="text-muted d-block mt-1">*Abaikan jika tidak ingin mengubah foto</small>
                                    </div>
                                    <div>
                                        <label class="field-label"><i class="fas fa-video"></i> Upload Video Baru (.mp4)</label>
                                        <input class="form-control" type="file" name="video" accept="video/mp4">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 4: KATEGORI KHUSUS -->
                        <div class="tab-pane fade" id="khusus" role="tabpanel">
                            <h5 class="section-title"><i class="fas fa-star"></i> Modul Kategori Khusus</h5>
                            
                            <!-- Animal Rescue -->
                            <div class="row g-4 mb-4 p-4 rounded border" style="background: rgba(243, 245, 248, 0.5);">
                                <div class="col-12"><h6 class="fw-bold text-primary mb-0"><i class="fas fa-paw me-2"></i>Animal Rescue</h6></div>
                                <div class="col-md-4">
                                    <label class="field-label">Jenis Hewan</label>
                                    <select class="form-select" name="jenis_hewan">
                                        <option value="">-- Pilih --</option>
                                        <option value="ular" {{ ($khusus->jenis_hewan ?? '') == 'ular' ? 'selected' : '' }}>Ular</option>
                                        <option value="tawon" {{ ($khusus->jenis_hewan ?? '') == 'tawon' ? 'selected' : '' }}>Tawon/Vespa</option>
                                        <option value="kera" {{ ($khusus->jenis_hewan ?? '') == 'kera' ? 'selected' : '' }}>Kera</option>
                                        <option value="biawak" {{ ($khusus->jenis_hewan ?? '') == 'biawak' ? 'selected' : '' }}>Biawak</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label class="field-label"><i class="fas fa-tag"></i> Spesies/Lokal</label>
                                    <input type="text" name="spesies_hewan" class="form-control" value="{{ $khusus->spesies_hewan ?? '' }}">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="field-label"><i class="fas fa-ruler"></i> Dimensi</label>
                                    <input type="text" name="dimensi_hewan" class="form-control" value="{{ $khusus->dimensi_hewan ?? '' }}">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="field-label"><i class="fas fa-balance-scale"></i> Berat Hewan</label>
                                    <div class="input-group">
                                        <input type="number" step="0.1" min="0" name="berat_hewan" class="form-control" value="{{ $khusus->berat_hewan ?? '' }}">
                                        <span class="input-group-text">Kg</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="field-label"><i class="fas fa-share-square"></i> Status Pasca Evakuasi</label>
                                    <select class="form-select" name="status_hewan_pasca">
                                        <option value="">-- Pilih --</option>
                                        <option value="dilepasliarkan" {{ ($khusus->status_hewan_pasca ?? '') == 'dilepasliarkan' ? 'selected' : '' }}>Dilepasliarkan</option>
                                        <option value="diserahkan_bksda" {{ ($khusus->status_hewan_pasca ?? '') == 'diserahkan_bksda' ? 'selected' : '' }}>Diserahkan BKSDA</option>
                                        <option value="mati" {{ ($khusus->status_hewan_pasca ?? '') == 'mati' ? 'selected' : '' }}>Mati</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="field-label"><i class="fas fa-tree"></i> Lokasi Pelepasan</label>
                                    <input type="text" name="lokasi_pelepasan" class="form-control" value="{{ $khusus->lokasi_pelepasan ?? '' }}">
                                </div>
                            </div>

                            <!-- Pohon Tumbang -->
                            <div class="row g-4 mb-4 p-4 rounded border" style="background: rgba(243, 245, 248, 0.5);">
                                <div class="col-12"><h6 class="fw-bold text-primary mb-0"><i class="fas fa-tree me-2"></i>Pohon Tumbang / Bangunan</h6></div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-car-crash"></i> Jenis Objek</label>
                                    <select class="form-select" name="jenis_objek_tumbang">
                                        <option value="">-- Pilih --</option>
                                        <option value="pohon" {{ ($khusus->jenis_objek_tumbang ?? '') == 'pohon' ? 'selected' : '' }}>Pohon</option>
                                        <option value="baliho" {{ ($khusus->jenis_objek_tumbang ?? '') == 'baliho' ? 'selected' : '' }}>Baliho</option>
                                        <option value="tiang_listrik" {{ ($khusus->jenis_objek_tumbang ?? '') == 'tiang_listrik' ? 'selected' : '' }}>Tiang Listrik</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-expand-arrows-alt"></i> Dimensi Objek</label>
                                    <div class="input-group">
                                        <input type="number" min="0" step="0.1" name="dimensi_objek" class="form-control" value="{{ $khusus->dimensi_objek ?? '' }}">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-plug"></i> Utilitas Terkait</label>
                                    <select class="form-select" name="status_utilitas">
                                        <option value="">-- Tidak Ada --</option>
                                        <option value="kabel_pln" {{ ($khusus->status_utilitas ?? '') == 'kabel_pln' ? 'selected' : '' }}>Kabel PLN putus</option>
                                        <option value="pipa_pdam" {{ ($khusus->status_utilitas ?? '') == 'pipa_pdam' ? 'selected' : '' }}>Pipa PDAM bocor</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="field-label"><i class="fas fa-house-damage"></i> Dampak Properti</label>
                                    <textarea class="form-control" name="dampak_properti" rows="2">{{ $khusus->dampak_properti ?? '' }}</textarea>
                                </div>
                            </div>
                            
                            <!-- Water Rescue -->
                            <div class="row g-4 mb-4 p-4 rounded border" style="background: rgba(243, 245, 248, 0.5);">
                                <div class="col-12"><h6 class="fw-bold text-primary mb-0"><i class="fas fa-life-ring me-2"></i>Water Rescue</h6></div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-water"></i> Kondisi Perairan</label>
                                    <select class="form-select" name="kondisi_perairan">
                                        <option value="">-- Pilih --</option>
                                        <option value="arus_deras" {{ ($khusus->kondisi_perairan ?? '') == 'arus_deras' ? 'selected' : '' }}>Arus Deras</option>
                                        <option value="arus_tenang" {{ ($khusus->kondisi_perairan ?? '') == 'arus_tenang' ? 'selected' : '' }}>Arus Tenang</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-search-location"></i> Radius</label>
                                    <div class="input-group">
                                        <input type="number" min="0" name="radius_pencarian" class="form-control" value="{{ $khusus->radius_pencarian ?? '' }}">
                                        <span class="input-group-text">m</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-binoculars"></i> Metode Pencarian</label>
                                    <select class="form-select" name="metode_pencarian_air">
                                        <option value="">-- Pilih --</option>
                                        <option value="penyelaman" {{ ($khusus->metode_pencarian_air ?? '') == 'penyelaman' ? 'selected' : '' }}>Penyelaman</option>
                                        <option value="penyisiran" {{ ($khusus->metode_pencarian_air ?? '') == 'penyisiran' ? 'selected' : '' }}>Penyisiran Perahu</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="field-label"><i class="fas fa-swimmer"></i> Daftar Penyelam</label>
                                    <input type="text" name="daftar_penyelam" class="form-control" value="{{ $khusus->daftar_penyelam ?? '' }}">
                                </div>
                            </div>
                            
                            <!-- Ring/Object Removal & Geografis -->
                            <div class="row g-4 mb-4 p-4 rounded border" style="background: rgba(243, 245, 248, 0.5);">
                                <div class="col-12"><h6 class="fw-bold text-primary mb-0"><i class="fas fa-ring me-2"></i>Ring/Object Removal & Geografis</h6></div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-ring"></i> Jenis Benda</label>
                                    <input type="text" name="jenis_benda_bahaya" class="form-control" value="{{ $khusus->jenis_benda_bahaya ?? '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-hand-paper"></i> Kondisi Anggota Tubuh</label>
                                    <select class="form-select" name="kondisi_anggota_tubuh">
                                        <option value="">-- Pilih --</option>
                                        <option value="bengkak" {{ ($khusus->kondisi_anggota_tubuh ?? '') == 'bengkak' ? 'selected' : '' }}>Bengkak</option>
                                        <option value="luka_terbuka" {{ ($khusus->kondisi_anggota_tubuh ?? '') == 'luka_terbuka' ? 'selected' : '' }}>Luka Terbuka</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-cut"></i> Alat Potong</label>
                                    <select class="form-select" name="alat_potong_cincin">
                                        <option value="">-- Pilih --</option>
                                        <option value="gerinda_mini" {{ ($khusus->alat_potong_cincin ?? '') == 'gerinda_mini' ? 'selected' : '' }}>Gerinda Mini</option>
                                        <option value="tang_baja" {{ ($khusus->alat_potong_cincin ?? '') == 'tang_baja' ? 'selected' : '' }}>Tang Baja</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label class="field-label"><i class="fas fa-cloud-sun"></i> Cuaca Operasi</label>
                                    <select class="form-select" name="cuaca_operasi">
                                        <option value="">-- Pilih --</option>
                                        <option value="cerah" {{ ($khusus->cuaca_operasi ?? '') == 'cerah' ? 'selected' : '' }}>Cerah</option>
                                        <option value="hujan_lebat" {{ ($khusus->cuaca_operasi ?? '') == 'hujan_lebat' ? 'selected' : '' }}>Hujan Lebat</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label class="field-label"><i class="fas fa-mountain"></i> Jenis Medan</label>
                                    <select class="form-select" name="jenis_medan">
                                        <option value="">-- Pilih --</option>
                                        <option value="pemukiman_padat" {{ ($khusus->jenis_medan ?? '') == 'pemukiman_padat' ? 'selected' : '' }}>Pemukiman Padat</option>
                                        <option value="perkebunan" {{ ($khusus->jenis_medan ?? '') == 'perkebunan' ? 'selected' : '' }}>Perkebunan</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label class="field-label"><i class="fas fa-road"></i> Aksesibilitas Lokasi</label>
                                    <select class="form-select" name="akses_lokasi">
                                        <option value="">-- Pilih --</option>
                                        <option value="kendaraan_berat" {{ ($khusus->akses_lokasi ?? '') == 'kendaraan_berat' ? 'selected' : '' }}>Bisa dilalui Roda 4+</option>
                                        <option value="roda_dua" {{ ($khusus->akses_lokasi ?? '') == 'roda_dua' ? 'selected' : '' }}>Hanya Roda 2</option>
                                        <option value="jalan_kaki" {{ ($khusus->akses_lokasi ?? '') == 'jalan_kaki' ? 'selected' : '' }}>Hanya Jalan Kaki</option>
                                    </select>
                                </div>
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7
                            </div>
                        </div>

                        <!-- SUBMIT BUTTON -->
<<<<<<< HEAD
                        <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                            <a href="/internal/damtan/data-laporan" class="btn btn-light me-2 fw-bold text-secondary">Batal</a>
                            <button type="submit" class="btn btn-warning fw-bold px-4" style="color: #614000; border: none;">
                                <i class="fas fa-save me-2"></i> Update Data Laporan
=======
                        <div class="d-flex justify-content-end mt-5 pt-4 border-top">
                            <a href="/internal/damtan/data-laporan" class="btn-custom-light me-3">Batal</a>
                            <button type="submit" class="btn-custom-primary shadow-sm">
                                <i class="fas fa-save me-2"></i> Perbarui Data Penyelamatan
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<<<<<<< HEAD
    <!-- PETA MODAL -->
    <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-light">
            <h5 class="modal-title fw-bold" id="mapModalLabel"><i class="fas fa-map-marked-alt text-primary me-2"></i>Ubah Titik Lokasi Kejadian</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <div id="map"></div>
          </div>
          <div class="modal-footer bg-light d-flex justify-content-between">
            <span class="text-muted" style="font-size: 12px;">Geser pin merah atau klik peta untuk menentukan koordinat. <br>Koordinat saat ini: <strong id="latlngDisplay">{{ $coords }}</strong></span>
            <div>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="simpanKoordinat()">Simpan Perubahan</button>
            </div>
          </div>
=======
<!-- ==================== PETA MODAL ==================== -->
<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content p-2">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fs-5" id="mapModalLabel"><i class="fas fa-map-marked-alt text-primary me-2"></i>Pilih Titik Lokasi Kejadian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="map"></div>
      </div>
      <div class="modal-footer border-0 pt-0 d-flex justify-content-between align-items-center">
        <span class="text-muted" style="font-size: 13px; line-height: 1.4;">
            Geser pin merah atau klik peta untuk menentukan koordinat.<br>
            Koordinat saat ini: <strong id="latlngDisplay" class="text-dark">-1.61157, 103.57860</strong>
        </span>
        <div class="d-flex gap-2">
            <button type="button" class="btn-custom-light" style="padding: 8px 16px;" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="btn-custom-primary" style="padding: 8px 16px;" onclick="simpanKoordinat()">Gunakan Koordinat</button>
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7
        </div>
      </div>
    </div>
  </div>
</div>

<<<<<<< HEAD
    <!-- Script Bootstrap & Leaflet -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        let map;
        let marker;
        const myModalEl = document.getElementById('mapModal');
        // Gunakan titik yang ada di DB untuk setting marker
        const mapCoords = [{{ $coords }}];
=======
<!-- ==================== SCRIPTS ==================== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
(function () {
    'use strict';
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7

    /* ---------- Sidebar (Mobile Toggle) ---------- */
    var toggle = document.getElementById('sideToggle');
    var backdrop = document.getElementById('sideBackdrop');

    function closeSide() {
        document.body.classList.remove('side-open');
        if(toggle) toggle.setAttribute('aria-expanded', 'false');
    }
    if (toggle) {
        toggle.addEventListener('click', function () {
            var open = document.body.classList.toggle('side-open');
            toggle.setAttribute('aria-expanded', open);
        });
    }
    if (backdrop) backdrop.addEventListener('click', closeSide);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeSide(); });

    /* ---------- Eksklusivitas Accordion Sidebar ---------- */
    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) {
                groups.forEach(function (o) { if (o !== g) o.open = false; });
            }
        });
    });

    /* ---------- Leaflet Map Logic ---------- */
    let map;
    let marker;
    const myModalEl = document.getElementById('mapModal');

    if (myModalEl) {
        myModalEl.addEventListener('shown.bs.modal', event => {
            if(!map) {
                map = L.map('map').setView(mapCoords, 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

<<<<<<< HEAD
                marker = L.marker(mapCoords, {draggable: true}).addTo(map);

                marker.on('dragend', function (e) {
                    document.getElementById('latlngDisplay').innerText = marker.getLatLng().lat.toFixed(5) + ', ' + marker.getLatLng().lng.toFixed(5);
=======
                marker = L.marker([lat, lng], {draggable: true}).addTo(map);
                document.getElementById('latlngDisplay').innerText = lat.toFixed(5) + ', ' + lng.toFixed(5);

                marker.on('dragend', function (e) {
                    let newLat = marker.getLatLng().lat.toFixed(5);
                    let newLng = marker.getLatLng().lng.toFixed(5);
                    document.getElementById('latlngDisplay').innerText = newLat + ', ' + newLng;
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7
                });

                map.on('click', function(e){
                    marker.setLatLng(e.latlng);
                    document.getElementById('latlngDisplay').innerText = e.latlng.lat.toFixed(5) + ', ' + e.latlng.lng.toFixed(5);
                });
            }
            setTimeout(function() { map.invalidateSize(); }, 10);
        });
    }

    /* ---------- Simpan Koordinat ke Input ---------- */
    window.simpanKoordinat = function() {
        if(marker) {
            const lat = marker.getLatLng().lat.toFixed(5);
            const lng = marker.getLatLng().lng.toFixed(5);
            document.getElementById('inputKoordinat').value = lat + ', ' + lng;
        }
        let modalInstance = bootstrap.Modal.getInstance(myModalEl);
        if(modalInstance) modalInstance.hide();
    }
})();
</script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Form Penginputan Data - SIMERAH KOJA</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
=======
    <meta name="theme-color" content="#0d1b2a">
    <title>Form Penginputan Data Penyelamatan | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <!-- Fonts (Sesuai UI/UX Dashboard Utama) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS (Struktur Grid Form, Tabs & Modal) -->
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<<<<<<< HEAD

    <!-- Leaflet CSS (Untuk Peta) -->
=======
    
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
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7

            --r-lg: 22px;
            --r-md: 16px;
            --r-sm: 10px;
            --sidebar-w: 272px;
            --topbar-h: 66px;
        }

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

<<<<<<< HEAD
        /* --- SIDEBAR & ACCORDION STYLES --- */
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar {
            width: 280px; background-color: #ffffff; border-right: 1px solid #e5e7eb;
            padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto;
        }
        
        .sidebar-item {
            display: flex; align-items: center; gap: 15px; padding: 12px 15px;
            color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600;
            border-radius: 8px; transition: all 0.2s;
        }
        .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-item.active i { color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; }
        
        .sidebar-collapse-btn {
            display: flex; justify-content: space-between; align-items: center;
            width: 100%; padding: 15px 15px 5px 15px; margin-top: 10px;
            background: transparent; border: none; border-top: 1px dashed #e5e7eb;
            text-align: left; font-size: 11px; font-weight: 800; color: #9ca3af;
            text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all 0.2s;
        }
        .sidebar-collapse-btn:hover { color: #4b5563; }
        
        .toggle-icon { transition: transform 0.3s ease; font-size: 12px; }
        .sidebar-collapse-btn.collapsed .toggle-icon { transform: rotate(0deg); }
        .sidebar-collapse-btn:not(.collapsed) .toggle-icon { transform: rotate(180deg); color: #0284c7; }
        .sidebar-collapse-btn:not(.collapsed) { color: #0284c7; }

        .sidebar-submenu {
            display: flex; flex-direction: column; gap: 4px; padding-left: 10px; margin-top: 8px;
        }
=======
        .topbar-right { display: flex; align-items: center; gap: 14px; }
        .user-chip { display: flex; align-items: center; gap: 10px; padding: 6px 14px 6px 6px; border-radius: 999px; background: var(--paper); }
        .user-avatar { width: 34px; height: 34px; border-radius: 50%; background: var(--ink); color: #fff; display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .85rem; flex: none; }
        .user-meta { display: grid; line-height: 1.25; }
        .user-meta strong { font-size: .85rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .user-meta small { font-size: .72rem; color: var(--steel); text-transform: capitalize; }
        .btn-logout { background: none; border: 0; display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 18px; border-radius: 999px; background: var(--signal); color: #fff; font-weight: 700; font-size: .85rem; transition: background .2s; text-decoration: none;}
        .btn-logout:hover { background: var(--signal-d); color: #fff; }
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7

        @media (max-width: 900px) {
            .side-toggle { display: inline-flex; }
            .user-meta { display: none; }
        }

<<<<<<< HEAD
        /* --- STYLING FORM MODERN --- */
        .field-label {
            font-size: 13px; font-weight: 700; color: #0284c7; margin-bottom: 8px;
            display: inline-flex; align-items: center;
        }
        .field-label i { margin-right: 8px; font-size: 14px; }
        
        .form-control, .form-select {
            border-radius: 8px; background-color: #f4f9ff; border: 1px solid #bfdbfe; 
            padding: 10px 15px; font-size: 14px; color: #1e293b;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); transition: all 0.2s ease-in-out;
        }
        .form-control:focus, .form-select:focus { background-color: #ffffff; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15); }
        .input-group-text { border-radius: 8px; background-color: #e0f2fe; border: 1px solid #bfdbfe; color: #0284c7; font-weight: 700; }
        
        .section-title {
            font-weight: 800; color: #111827; margin-bottom: 25px; padding-bottom: 15px;
            border-bottom: 2px solid #f3f4f6; display: flex; align-items: center; gap: 12px;
        }
        .section-title i { color: #10b981; background: #d1fae5; padding: 10px; border-radius: 8px; font-size: 16px; }

        .form-check-inline {
            padding: 8px 16px 8px 32px; border-radius: 8px; border: 1px solid transparent;
            transition: all 0.2s ease-in-out; margin-right: 10px; margin-bottom: 5px; cursor: pointer;
        }
        .form-check-inline:hover { background-color: #e0f2fe; border-color: #bfdbfe; }
        .form-check-input { cursor: pointer; margin-top: 4px; }
        .form-check-label { cursor: pointer; width: 100%; }
=======
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
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7

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
        .form-control::placeholder { color: #9ca3af; }
        .input-group-text {
            background-color: var(--line);
            border: 1px solid var(--line);
            color: var(--ink-3);
            font-weight: 700;
            border-radius: 12px;
        }
        .input-group > .form-control { border-top-right-radius: 0; border-bottom-right-radius: 0; }
        .input-group > .input-group-text { border-top-left-radius: 0; border-bottom-left-radius: 0; }
        
        .section-title {
            font-family: var(--font-display);
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px dashed var(--line);
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.25rem;
        }
        .section-title i {
            color: var(--blue);
            background: rgba(37, 99, 235, 0.1);
            padding: 10px;
            border-radius: 10px;
            font-size: 1.05rem;
        }

        /* Custom Checkboxes / Radios */
        .form-check-inline {
            background-color: var(--paper);
            border: 1px solid var(--line);
            padding: 10px 16px 10px 40px; 
            border-radius: 10px;
            margin-right: 8px;
            margin-bottom: 8px;
            transition: all 0.2s;
            position: relative;
            display: inline-flex; 
            align-items: center;
        }
        .form-check-inline:hover { 
            border-color: var(--blue); 
        }
        .form-check-inline .form-check-input {
            position: absolute; 
            left: 12px; 
            top: 50%;
            transform: translateY(-50%); 
            margin: 0 !important; 
            cursor: pointer;
        }
        .form-check-inline .form-check-label { 
            cursor: pointer; 
            font-size: .9rem; 
            font-weight: 600; 
            color: var(--ink-2); 
            width: 100%; 
            margin-bottom: 0;
        }

        /* Buttons */
        .btn-custom-primary {
            background-color: var(--blue);
            color: #fff;
            font-family: var(--font-body);
            font-weight: 700;
            border: none;
            padding: 12px 28px;
            border-radius: 12px;
            transition: background 0.2s;
        }
        .btn-custom-primary:hover { background-color: #1d4ed8; color: #fff; }
        
        .btn-custom-light {
            background-color: var(--paper);
            color: var(--ink);
            font-family: var(--font-body);
            font-weight: 700;
            border: 1px solid var(--line);
            padding: 12px 28px;
            border-radius: 12px;
            transition: background 0.2s;
        }
        .btn-custom-light:hover { background-color: #e2e8f0; color: var(--ink); }

        .btn-outline-primary {
            color: var(--blue); border-color: var(--blue); font-weight: 600; border-radius: 10px; background: transparent;
        }
        .btn-outline-primary:hover { background-color: var(--blue); color: #fff; }

        /* Map styling */
        #map { height: 400px; width: 100%; border-radius: 12px; border: 1px solid var(--line); z-index: 1;}
        .modal-content { border-radius: var(--r-md); border: none; box-shadow: 0 20px 40px rgba(13,27,42,.15); }
        .modal-header { border-bottom: 1px solid var(--line); }
        .modal-title { font-family: var(--font-display); font-weight: 700; color: var(--ink); }
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
        </div>
    </nav>

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
                        <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item {{ Request::is('internal/pencegahan/layanan-inspeksi*') ? 'active' : '' }}"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                        <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item {{ Request::is('internal/pencegahan/layanan-sosialisasi*') ? 'active' : '' }}"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
                        <a href="/internal/pencegahan/pelatihan" class="sidebar-item {{ Request::is('internal/pencegahan/pelatihan*') ? 'active' : '' }}"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                        <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item {{ Request::is('internal/pencegahan/pembinaan-pengembangan*') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                        <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item {{ Request::is('internal/pencegahan/peningkatan-kapasitas*') ? 'active' : '' }}"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
                        <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item {{ Request::is('internal/pencegahan/kelola-redkar*') ? 'active' : '' }}"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
                    </div>
                </div>

                <!-- ACCORDION PEMADAMAN (DAMTAN) -->
                <button class="sidebar-collapse-btn {{ Request::is('internal/damtan*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman" aria-expanded="{{ Request::is('internal/damtan*') ? 'true' : 'false' }}">
                    <span>Bagian Pemadaman</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('internal/damtan*') ? 'show' : '' }}" id="collapsePemadaman" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/damtan/input-data" class="sidebar-item {{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                        <a href="/internal/damtan/data-laporan" class="sidebar-item {{ Request::is('internal/damtan/data-laporan*') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
                    </div>
                </div>

                <!-- ACCORDION SAPRA -->
                <button class="sidebar-collapse-btn {{ Request::is('sapra*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra" aria-expanded="{{ Request::is('sapra*') ? 'true' : 'false' }}">
                    <span>Bagian Sapra</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('sapra*') ? 'show' : '' }}" id="collapseSapra" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 9d64ab909d89535ce270e48403a9dcabc77c2bff
                      
                        <!-- Sarana dan prasarana -->
                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 5px; margin-bottom: 3px; letter-spacing: 0.5px;">SARANA DAN PRASARANA</span>
                        <a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Sarana Pemadam Kebakaran</a>
                        <a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-building"></i> Prasarana Pemadam Kebakaran</a>
                        <a href="/sapra/sarana-penyelamatan" class="sidebar-item"><i class="fas fa-life-ring"></i> Sarana Penyelamatan & Evakuasi</a>
                        <a href="/sapra/sarana-pemeriksaan" class="sidebar-item"><i class="fas fa-search"></i> Sarana Pemeriksaan Proteksi Kebakaran</a>    
                        <a href="/sapra/kelola-pos" class="sidebar-item"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>
                        
                          <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 5px; margin-bottom: 3px; letter-spacing: 0.5px;">MANAJEMEN AIR</span>
<<<<<<< HEAD
=======
<<<<<<< HEAD
                        <a href="/sapra/data_hidrant_gedung" class="sidebar-item {{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> Data Hidrant</a>
                        <a href="/sapra/data-hidrant-kota" class="sidebar-item {{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>
                        <a href="/sapra/prasarana-mako" class="sidebar-item {{ Request::is('sapra/prasarana-mako*') ? 'active' : '' }}"><i class="fas fa-building"></i> Prasarana Mako & Pos</a>
                        <a href="/sapra/sarana-mako" class="sidebar-item {{ Request::is('sapra/sarana-mako*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Sarana Mako & Pos</a>
                        <a href="/sapra/logistik" class="sidebar-item {{ Request::is('sapra/logistik*') ? 'active' : '' }}"><i class="fas fa-box-open"></i> Logistik & Gudang</a>
=======
                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 5px; margin-bottom: 3px; letter-spacing: 0.5px;">MANAJEMEN AIR</span>
>>>>>>> 54d349b2f34ba1d90fd3fbf4f615f46b7fe9ffd6
=======
>>>>>>> 9d64ab909d89535ce270e48403a9dcabc77c2bff
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
                <!-- ACCORDION MANAJEMEN BERITA -->
                <button class="sidebar-collapse-btn {{ Request::is('internal/operator*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBerita" aria-expanded="{{ Request::is('internal/operator*') ? 'true' : 'false' }}">
                    <span>Manajemen Berita</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('internal/operator*') ? 'show' : '' }}" id="collapseBerita" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/operator/kelola-berita" class="sidebar-item {{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
                        <a href="/internal/operator/infografis" class="sidebar-item {{ Request::is('internal/operator/infografis*') ? 'active' : '' }}"><i class="fas fa-image"></i> Kelola Info Grafis</a>
                        <a href="/internal/operator/berita-medsos" class="sidebar-item {{ Request::is('internal/operator/berita-medsos*') ? 'active' : '' }}"><i class="fab fa-instagram"></i> Kelola Berita Medsos</a>
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

        <!-- MAIN AREA (FORM PENGINPUTAN) -->
        <main class="main-content">
            <div class="page-header">
                <h1>Form Penginputan Data Penyelamatan</h1>
                <p>Bagian Pemadaman & Penyelamatan - Disdamkartan Kota Jambi.</p>
            </div>

            <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                <div class="card-header bg-white pt-4 pb-0 border-bottom" style="border-bottom: 2px solid #f3f4f6 !important;">
                    <!-- BOOTSTRAP TABS -->
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
                   <form action="{{ route('damtan.laporan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="formTabsContent">
                            
                            <!-- TAB 1: INFORMASI DASAR -->
                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <h5 class="section-title"><i class="fas fa-info-circle"></i> Informasi Dasar Kejadian</h5>
                                
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-hashtag"></i> Nomor Laporan (Auto)</label>
                                        <input type="text" class="form-control" name="nomor_laporan" value="REG-20240101-001" readonly style="background-color: #e2e8f0;">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-fingerprint"></i> ID Laporan (Auto)</label>
                                        <input type="text" class="form-control" name="id_laporan" value="UUID-8A7B6C" readonly style="background-color: #e2e8f0;">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <label class="field-label text-danger"><i class="fas fa-fire"></i> Kategori Laporan (Kebakaran)</label>
                                        <select class="form-select" name="kategori_kebakaran">
                                            <option selected value="">-- Pilih Jenis Kebakaran --</option>
                                            <option value="rumah_tinggal">Rumah Tinggal</option>
                                            <option value="lahan">Lahan</option>
                                            <option value="bangunan_publik">Bangunan Publik</option>
                                            <option value="kendaraan">Kendaraan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-life-ring"></i> Kategori Laporan (Non-Kebakaran)</label>
                                        <div class="d-flex gap-2">
                                            <select class="form-select" name="kategori_non_kebakaran" style="width: 50%;">
                                                <option selected value="">-- Pilih Jenis Evakuasi --</option>
                                                <option value="fire_rescue">Fire Rescue</option>
                                                <option value="water_rescue">Water Rescue</option>
                                                <option value="land_rescue">Land Rescue</option>
                                                <option value="evakuasi_liar">Evakuasi Hewan Liar</option>
                                                <option value="evakuasi_ternak">Evakuasi Ternak</option>
                                                <option value="evakuasi_piaraan">Evakuasi Hewan Peliharaan</option>
                                                <option value="evakuasi_cincin">Evakuasi Cincin / Anting</option>
                                                <option value="evakuasi_kendaraan">Evakuasi Kendaraan Bermotor</option>
                                                <option value="lainnya">Lainnya (Sebutkan...)</option>
                                            </select>
                                            <input type="text" class="form-control" name="rincian_kategori_non_kebakaran" placeholder="Detail (Cth: Monyet / Sumur)..." style="width: 50%;">
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-layer-group"></i> Kategori Kejadian Umum</label>
                                        <select class="form-select" name="kategori_kejadian">
                                            <option selected value="">-- Pilih Kategori Kejadian --</option>
                                            <option value="kebakaran">Kebakaran</option>
                                            <option value="penyelamatan_hewan">Penyelamatan Hewan</option>
                                            <option value="bencana_alam">Bencana Alam</option>
                                            <option value="kecelakaan_lalu_lintas">Kecelakaan Lalu Lintas</option>
                                            <option value="evakuasi_medis">Evakuasi Medis</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label w-100"><i class="fas fa-exclamation-circle"></i> Tingkat Prioritas</label>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" id="prio1" value="rendah">
                                            <label class="form-check-label text-secondary fw-bold" for="prio1">Rendah</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" id="prio2" value="sedang">
                                            <label class="form-check-label text-primary fw-bold" for="prio2">Sedang</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" id="prio3" value="tinggi">
                                            <label class="form-check-label text-warning fw-bold" for="prio3">Tinggi</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" id="prio4" value="darurat">
                                            <label class="form-check-label text-danger fw-bold" for="prio4">Darurat</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-4 mb-4 p-3 bg-light rounded border">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-calendar-alt"></i> Waktu Kejadian</label>
                                        <input type="datetime-local" name="waktu_kejadian" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-clock"></i> Waktu Terima Laporan</label>
                                        <input type="datetime-local" name="waktu_terima" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-truck-moving"></i> Waktu Berangkat Unit</label>
                                        <input type="datetime-local" name="waktu_berangkat" class="form-control">
                                    </div>
                                    <div class="col-md-6 mt-4">
                                        <label class="field-label"><i class="fas fa-map-marker-alt"></i> Waktu Tiba di Lokasi</label>
                                        <input type="datetime-local" name="waktu_tiba" class="form-control">
                                    </div>
                                    <div class="col-md-6 mt-4">
                                        <label class="field-label"><i class="fas fa-flag-checkered"></i> Waktu Operasi Selesai</label>
                                        <input type="datetime-local" name="waktu_selesai" class="form-control">
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-8">
                                        <label class="field-label"><i class="fas fa-map-signs"></i> Alamat Lengkap</label>
                                        <textarea class="form-control" name="alamat" rows="2" placeholder="Nama jalan, RT/RW, Kecamatan..."></textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-location-arrow"></i> Titik Koordinat</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" id="inputKoordinat" name="koordinat" placeholder="-1.61157, 103.57860">
                                        </div>
                                        <button type="button" class="btn btn-outline-primary btn-sm w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#mapModal">
                                            <i class="fas fa-map-marked-alt me-1"></i> Buka Peta Interaktif
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 2: TEKNIS & LOGISTIK -->
                            <div class="tab-pane fade" id="teknis" role="tabpanel">
                                <h5 class="section-title"><i class="fas fa-tools"></i> Teknis Penyelamatan & Logistik</h5>
                                
                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3">Status Korban Manusia & Aset</h6>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-user-check"></i> Selamat</label>
                                        <input type="number" name="korban_selamat" class="form-control" value="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-user-injured"></i> Luka Ringan</label>
                                        <input type="number" name="korban_ringan" class="form-control" value="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-procedures"></i> Luka Berat</label>
                                        <input type="number" name="korban_berat" class="form-control" value="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="field-label text-danger"><i class="fas fa-user-times"></i> Meninggal Dunia</label>
                                        <input type="number" name="korban_meninggal" class="form-control" value="0">
                                    </div>
                                </div>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-cat"></i> Hewan / Aset (Jika relevan)</label>
                                        <input type="text" name="korban_hewan_aset" class="form-control" placeholder="Contoh: 1 ekor ular piton dievakuasi, 2 unit motor terbakar...">
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3 mt-5">Detail Evakuasi & Lapangan</h6>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-info-circle"></i> Status Evakuasi</label>
                                        <select class="form-select" name="status_evakuasi">
                                            <option selected value="">-- Pilih Status --</option>
                                            <option value="selesai">Selesai</option>
                                            <option value="dalam_proses">Dalam Proses</option>
                                            <option value="dirujuk_ke_rs">Dirujuk ke RS</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="field-label"><i class="fas fa-house-damage"></i> Objek Terdampak</label>
                                        <input type="text" name="objek_terdampak" class="form-control" placeholder="Contoh: Atap rumah warga, sumur tua, dsb.">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4 bg-light p-3 rounded border">
                                    <div class="col-md-12 mb-2">
                                        <label class="field-label w-100"><i class="fas fa-route"></i> Metode Evakuasi</label>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="me_vr" name="metode_evakuasi[]" value="vertical_rescue">
                                            <label class="form-check-label" for="me_vr">Vertical Rescue</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="me_wr" name="metode_evakuasi[]" value="water_rescue">
                                            <label class="form-check-label" for="me_wr">Water Rescue</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="me_td" name="metode_evakuasi[]" value="tangga_darurat">
                                            <label class="form-check-label" for="me_td">Penggunaan Tangga Darurat</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="field-label w-100"><i class="fas fa-hands-helping"></i> Metode Penyelamatan</label>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="mp_vr" name="metode_penyelamatan[]" value="vertical_rescue">
                                            <label class="form-check-label" for="mp_vr">Vertical Rescue</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="mp_wr" name="metode_penyelamatan[]" value="water_rescue">
                                            <label class="form-check-label" for="mp_wr">Water Rescue</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="mp_ps" name="metode_penyelamatan[]" value="pemadaman_statis">
                                            <label class="form-check-label" for="mp_ps">Pemadam Statis</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="mp_pd" name="metode_penyelamatan[]" value="pemadaman_dinamis">
                                            <label class="form-check-label" for="mp_pd">Pemadam Dinamis</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="mp_emd" name="metode_penyelamatan[]" value="evakuasi_medis_dasar">
                                            <label class="form-check-label" for="mp_emd">Evakuasi Medis Dasar</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-exclamation-triangle"></i> Hambatan Lapangan</label>
                                        <textarea class="form-control" name="hambatan_lapangan" rows="2" placeholder="Tuliskan hambatan spesifik saat operasi di lapangan..."></textarea>
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3 mt-5">Alat, Logistik & Personel</h6>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label w-100"><i class="fas fa-toolbox"></i> Peralatan Khusus yang Digunakan</label>
                                        <div class="btn-group" role="group" aria-label="Peralatan Khusus">
                                            <input type="checkbox" class="btn-check" id="alat_scba" name="peralatan[]" value="SCBA">
                                            <label class="btn btn-outline-primary btn-sm" for="alat_scba">SCBA</label>

                                            <input type="checkbox" class="btn-check" id="alat_thermal" name="peralatan[]" value="Thermal Camera">
                                            <label class="btn btn-outline-primary btn-sm" for="alat_thermal">Thermal Camera</label>

                                            <input type="checkbox" class="btn-check" id="alat_chainsaw" name="peralatan[]" value="Chainsaw">
                                            <label class="btn btn-outline-primary btn-sm" for="alat_chainsaw">Chainsaw</label>

                                            <input type="checkbox" class="btn-check" id="alat_selam" name="peralatan[]" value="Alat Selam">
                                            <label class="btn btn-outline-primary btn-sm" for="alat_selam">Alat Selam</label>
                                        </div>
                                        <input type="text" name="peralatan_lain" class="form-control form-control-sm mt-3" placeholder="Alat khusus lainnya (pisahkan dengan koma)...">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-spray-can"></i> Konsumsi Alat Umum</label>
                                        <input type="text" name="konsumsi_alat" class="form-control" placeholder="Contoh: penggunaan foam, jumlah liter air, atau combi tool...">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-tint"></i> Liter Air Digunakan</label>
                                        <div class="input-group">
                                            <input type="number" name="liter_air" class="form-control" placeholder="0">
                                            <span class="input-group-text">L</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-soap"></i> Liter Foam</label>
                                        <div class="input-group">
                                            <input type="number" name="liter_foam" class="form-control" placeholder="0">
                                            <span class="input-group-text">L</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-gas-pump"></i> Liter BBM Unit</label>
                                        <div class="input-group">
                                            <input type="number" name="liter_bbm" class="form-control" placeholder="0">
                                            <span class="input-group-text">L</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-8">
                                        <label class="field-label w-100"><i class="fas fa-truck"></i> Unit Armada Terlibat</label>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="arm_pompa" name="armada[]" value="pompa">
                                            <label class="form-check-label" for="arm_pompa">Unit Pompa</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="arm_rescue" name="armada[]" value="rescue">
                                            <label class="form-check-label" for="arm_rescue">Unit Rescue</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="arm_tangki" name="armada[]" value="tangki">
                                            <label class="form-check-label" for="arm_tangki">Unit Tangki</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="arm_ambulans" name="armada[]" value="ambulans">
                                            <label class="form-check-label" for="arm_ambulans">Ambulans</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-users"></i> Jumlah Personel</label>
                                        <input type="number" name="jumlah_personel" class="form-control" placeholder="0">
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-user-tag"></i> Personel yang Terlibat</label>
                                        <textarea class="form-control" name="daftar_personel" rows="2" placeholder="Contoh: Budi, Andi, Joko..."></textarea>
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
                                                <option selected value="">-- Pilih Penyebab --</option>
                                                <option value="arus_pendek">Arus pendek listrik</option>
                                                <option value="kebocoran_gas">Kebocoran gas</option>
                                                <option value="sambaran_petir">Sambaran petir</option>
                                                <option value="kelalaian_manusia">Kelalaian manusia</option>
                                                <option value="faktor_alam">Faktor alam</option>
                                                <option value="lainnya">Lainnya</option>
                                            </select>
                                            <input type="text" class="form-control" name="dugaan_penyebab_lainnya" placeholder="Ketik jika 'Lainnya'..." style="width: 50%;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-fire-alt"></i> Sumber Api / Titik Awal</label>
                                        <input type="text" name="sumber_api" class="form-control" placeholder="Contoh: Dapur, Panel Listrik utama...">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-ruler-combined"></i> Luas Area Terdampak</label>
                                        <div class="input-group">
                                            <input type="number" name="luas_area" class="form-control" placeholder="0">
                                            <span class="input-group-text">m²</span>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3 mt-5">Kerjasama Lintas Sektoral & Evaluasi</h6>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label w-100"><i class="fas fa-building"></i> Instansi Pendukung di Lokasi</label>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="inst_pln" name="instansi_pendukung[]" value="pln">
                                            <label class="form-check-label" for="inst_pln">PLN</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="inst_polisi" name="instansi_pendukung[]" value="polisi">
                                            <label class="form-check-label" for="inst_polisi">Polisi</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="inst_tni" name="instansi_pendukung[]" value="tni">
                                            <label class="form-check-label" for="inst_tni">TNI</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="inst_pmi" name="instansi_pendukung[]" value="pmi">
                                            <label class="form-check-label" for="inst_pmi">BPBD</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="inst_relawan" name="instansi_pendukung[]" value="relawan_lokal">
                                            <label class="form-check-label" for="inst_relawan">Relawan Lokal</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-8">
                                        <label class="field-label"><i class="fas fa-tasks"></i> Tindakan Instansi Samping</label>
                                        <textarea class="form-control" name="tindakan_instansi" rows="2" placeholder="Contoh: PLN melakukan pemutusan arus..."></textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-phone-alt"></i> No. Kontak Saksi/Warga</label>
                                        <input type="text" name="kontak_saksi" class="form-control" placeholder="08xx-xxxx-xxxx">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-plus-circle"></i> Kebutuhan Tambahan</label>
                                        <textarea class="form-control" name="kebutuhan_tambahan" rows="2" placeholder="Dibutuhkan drone thermal..."></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-lightbulb"></i> Saran Mitigasi Warga</label>
                                        <textarea class="form-control" name="saran_mitigasi" rows="2" placeholder="Sosialisasi APAR..."></textarea>
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3 mt-5">Dokumentasi Akhir</h6>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-align-left"></i> Kronologi Terperinci</label>
                                        <textarea class="form-control" name="kronologi_lengkap" rows="4" placeholder="Uraian singkat operasi..."></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="field-label"><i class="fas fa-images"></i> Upload Foto (.jpg/.png)</label>
                                            <input class="form-control" type="file" name="foto[]" multiple accept="image/png, image/jpeg">
                                        </div>
                                        <div>
                                            <label class="field-label"><i class="fas fa-video"></i> Upload Video (.mp4)</label>
                                            <input class="form-control" type="file" name="video" accept="video/mp4">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 4: KATEGORI KHUSUS -->
                            <div class="tab-pane fade" id="khusus" role="tabpanel">
                                <h5 class="section-title"><i class="fas fa-star"></i> Modul Kategori Khusus</h5>
                                
                                <div class="row g-4 mb-4 bg-light p-3 rounded border">
                                    <div class="col-12"><h6 class="fw-bold text-primary mb-0"><i class="fas fa-paw me-2"></i>Animal Rescue</h6></div>
                                    <div class="col-md-4">
                                        <label class="field-label">Jenis Hewan</label>
                                        <select class="form-select" name="jenis_hewan">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="ular">Ular</option>
                                            <option value="tawon">Tawon/Vespa</option>
                                            <option value="kera">Kera</option>
                                            <option value="biawak">Biawak</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-tag"></i> Spesies/Lokal</label>
                                        <input type="text" name="spesies_hewan" class="form-control" placeholder="Cth: King Cobra">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-ruler"></i> Dimensi</label>
                                        <input type="text" name="dimensi_hewan" class="form-control" placeholder="Panjang ±3 meter">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-share-square"></i> Status Pasca Evakuasi</label>
                                        <select class="form-select" name="status_hewan_pasca">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="dilepasliarkan">Dilepasliarkan</option>
                                            <option value="diserahkan_bksda">Diserahkan BKSDA</option>
                                            <option value="mati">Mati</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-tree"></i> Lokasi Pelepasan</label>
                                        <input type="text" name="lokasi_pelepasan" class="form-control" placeholder="Habitat...">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4 bg-light p-3 rounded border">
                                    <div class="col-12"><h6 class="fw-bold text-primary mb-0"><i class="fas fa-tree me-2"></i>Pohon Tumbang / Bangunan</h6></div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-car-crash"></i> Jenis Objek</label>
                                        <select class="form-select" name="jenis_objek_tumbang">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="pohon">Pohon</option>
                                            <option value="baliho">Baliho</option>
                                            <option value="tiang_listrik">Tiang Listrik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-expand-arrows-alt"></i> Dimensi Objek</label>
                                        <div class="input-group">
                                            <input type="number" name="dimensi_objek" class="form-control" placeholder="0">
                                            <span class="input-group-text">cm</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-plug"></i> Utilitas Terkait</label>
                                        <select class="form-select" name="status_utilitas">
                                            <option selected value="">-- Tidak Ada --</option>
                                            <option value="kabel_pln">Kabel PLN putus</option>
                                            <option value="pipa_pdam">Pipa PDAM bocor</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-house-damage"></i> Dampak Properti</label>
                                        <textarea class="form-control" name="dampak_properti" rows="2" placeholder="Menutup jalan, menimpa pagar..."></textarea>
                                    </div>
                                </div>

                                <div class="row g-4 mb-4 bg-light p-3 rounded border">
                                    <div class="col-12"><h6 class="fw-bold text-primary mb-0"><i class="fas fa-life-ring me-2"></i>Water Rescue</h6></div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-water"></i> Kondisi Perairan</label>
                                        <select class="form-select" name="kondisi_perairan">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="arus_deras">Arus Deras</option>
                                            <option value="arus_tenang">Arus Tenang</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-search-location"></i> Radius</label>
                                        <div class="input-group">
                                            <input type="number" name="radius_pencarian" class="form-control" placeholder="0">
                                            <span class="input-group-text">m</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-binoculars"></i> Metode Pencarian</label>
                                        <select class="form-select" name="metode_pencarian_air">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="penyelaman">Penyelaman</option>
                                            <option value="penyisiran">Penyisiran Perahu</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-swimmer"></i> Daftar Penyelam</label>
                                        <input type="text" name="daftar_penyelam" class="form-control" placeholder="Nama bersertifikasi...">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4 bg-light p-3 rounded border">
                                    <div class="col-12"><h6 class="fw-bold text-primary mb-0"><i class="fas fa-ring me-2"></i>Ring/Object Removal & Geografis</h6></div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-ring"></i> Jenis Benda</label>
                                        <input type="text" name="jenis_benda_bahaya" class="form-control" placeholder="Cincin, kaleng...">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-hand-paper"></i> Kondisi Anggota Tubuh</label>
                                        <select class="form-select" name="kondisi_anggota_tubuh">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="bengkak">Bengkak</option>
                                            <option value="luka_terbuka">Luka Terbuka</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-cut"></i> Alat Potong</label>
                                        <select class="form-select" name="alat_potong_cincin">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="gerinda_mini">Gerinda Mini</option>
                                            <option value="tang_baja">Tang Baja</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label class="field-label"><i class="fas fa-cloud-sun"></i> Cuaca Operasi</label>
                                        <select class="form-select" name="cuaca_operasi">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="cerah">Cerah</option>
                                            <option value="hujan_lebat">Hujan Lebat</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label class="field-label"><i class="fas fa-mountain"></i> Jenis Medan</label>
                                        <select class="form-select" name="jenis_medan">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="pemukiman_padat">Pemukiman Padat</option>
                                            <option value="perkebunan">Perkebunan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label class="field-label"><i class="fas fa-road"></i> Aksesibilitas Lokasi</label>
                                        <select class="form-select" name="akses_lokasi">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="kendaraan_berat">Bisa dilalui Roda 4+</option>
                                            <option value="roda_dua">Hanya Roda 2</option>
                                            <option value="jalan_kaki">Hanya Jalan Kaki</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SUBMIT BUTTON -->
                        <div class="d-flex justify-content-end mt-5 pt-3 border-top">
                            <button type="reset" class="btn btn-light me-3 fw-bold text-secondary px-4 py-2" style="border-radius: 8px;">Batal</button>
                            <button type="submit" class="btn btn-primary fw-bold px-4 py-2 shadow-sm" style="background-color: #0284c7; border: none; border-radius: 8px;">
                                <i class="fas fa-save me-2"></i> Simpan Data Penyelamatan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
=======
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
>>>>>>> 4e9b3114169ff4111dc67a1afb55e7ebb94ad9f7
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
                    <a href="/internal/pencegahan/peningkatan-kapasitas" class="{{ Request::is('internal/pencegahan/peningkatan-kapasitas*') ? 'active' : '' }}">
                        <i class="fas fa-level-up-alt"></i> Peningkatan kapasitas aparatur
                    </a>
                    <a href="/internal/pencegahan/inspeksi-kebakaran" class="{{ Request::is('internal/pencegahan/inspeksi-kebakaran*') ? 'active' : '' }}">
                        <i class="fas fa-magnifying-glass"></i> Pencegahan kebakaran & inspeksi
                    </a>
                    <a href="#">
                        <i class="fas fa-people-group"></i> Pemberdayaan masyarakat
                    </a>
                </div>
            </details>

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
                </div>
            </details>

            <details class="side-group" {{ Request::is('sapra*') ? 'open' : '' }}>
                <summary>Bagian sapra <i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <span class="side-kicker" style="padding-left:2px;">Sarana &amp; Prasarana</span>
                    <a href="/sapra/sarana-mako" class="{{ Request::is('sapra/sarana-mako*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Sarana Pemadam</a>
                    <a href="/sapra/prasarana-mako" class="{{ Request::is('sapra/prasarana-mako*') ? 'active' : '' }}"><i class="fas fa-building"></i> Prasarana Pemadam</a>
                    <a href="/sapra/sarana-penyelamatan" class="{{ Request::is('sapra/sarana-penyelamatan*') ? 'active' : '' }}"><i class="fas fa-life-ring"></i> Sarana Penyelamatan</a>
                    <a href="/sapra/sarana-pemeriksaan" class="{{ Request::is('sapra/sarana-pemeriksaan*') ? 'active' : '' }}"><i class="fas fa-search"></i> Sarana Pemeriksaan</a> 
                    <a href="/sapra/kelola-pos" class="{{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}"><i class="fas fa-warehouse"></i> Kelola data pos</a>

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
            <h1>Form Penginputan Data Penyelamatan</h1>
            <p>Bagian Pemadaman & Penyelamatan - Disdamkartan Kota Jambi.</p>
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
                <!-- PASTIKAN MENGGUNAKAN METHOD POST UNTUK INPUT DATA BARU -->
                <form action="{{ route('damtan.laporan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="tab-content" id="formTabsContent">
                        
                        <!-- TAB 1: INFORMASI DASAR -->
                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                            <h5 class="section-title"><i class="fas fa-info-circle"></i> Informasi Dasar Kejadian</h5>
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-hashtag"></i> Nomor Laporan (Auto)</label>
                                    <input type="text" class="form-control" name="nomor_laporan" value="REG-{{ date('Ymd') }}-XXXX" readonly style="background-color: #e2e8f0;">
                                </div>
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-fingerprint"></i> ID Laporan (Auto)</label>
                                    <input type="text" class="form-control" name="id_laporan" value="UUID-XXXXXX" readonly style="background-color: #e2e8f0;">
                                </div>
                            </div>

                            <div class="row g-4 mb-4 pb-4 border-bottom">
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-user"></i> Nama Pelapor</label>
                                    <input type="text" class="form-control" name="nama_pelapor" placeholder="Cth: Bapak Iskandar">
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-headset"></i> Layanan Pelaporan</label>
                                    <select class="form-select" name="media_pelaporan">
                                        <option selected value="">-- Pilih Layanan --</option>
                                        <option value="whatsapp">Layanan WA Damkar</option>
                                        <option value="telepon">Telepon Call Center</option>
                                        <option value="langsung">Datang Langsung ke Mako/Pos</option>
                                        <option value="instansi_lain">Laporan Instansi Lain</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-route"></i> Jarak Tempuh</label>
                                    <div class="input-group">
                                        <input type="number" step="0.1" min="0" name="jarak_tempuh" class="form-control" placeholder="Cth: 4.1">
                                        <span class="input-group-text">Km</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="field-label text-danger"><i class="fas fa-fire"></i> Kategori Laporan (Kebakaran)</label>
                                    <select class="form-select" name="kategori_kebakaran">
                                        <option selected value="">-- Pilih Jenis Kebakaran --</option>
                                        <option value="rumah_tinggal">Rumah Tinggal</option>
                                        <option value="lahan">Lahan</option>
                                        <option value="bangunan_publik">Bangunan Publik</option>
                                        <option value="kendaraan">Kendaraan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-life-ring"></i> Kategori Laporan (Non-Kebakaran)</label>
                                    <div class="d-flex gap-2">
                                        <select class="form-select" name="kategori_non_kebakaran" style="width: 50%;">
                                            <option selected value="">-- Pilih Jenis Evakuasi --</option>
                                            <option value="fire_rescue">Fire Rescue</option>
                                            <option value="water_rescue">Water Rescue</option>
                                            <option value="land_rescue">Land Rescue</option>
                                            <option value="evakuasi_liar">Evakuasi Hewan Liar</option>
                                            <option value="evakuasi_ternak">Evakuasi Ternak</option>
                                            <option value="evakuasi_piaraan">Evakuasi Hewan Peliharaan</option>
                                            <option value="evakuasi_cincin">Evakuasi Cincin / Anting</option>
                                            <option value="evakuasi_kendaraan">Evakuasi Kendaraan Bermotor</option>
                                            <option value="lainnya">Lainnya (Sebutkan...)</option>
                                        </select>
                                        <input type="text" class="form-control" name="rincian_kategori_non_kebakaran" placeholder="Detail (Cth: Monyet / Sumur)..." style="width: 50%;">
                                    </div>
                                </div>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-layer-group"></i> Kategori Kejadian Umum</label>
                                    <select class="form-select" name="kategori_kejadian">
                                        <option selected value="">-- Pilih Kategori Kejadian --</option>
                                        <option value="kebakaran">Kebakaran</option>
                                        <option value="penyelamatan_hewan">Penyelamatan Hewan</option>
                                        <option value="bencana_alam">Bencana Alam</option>
                                        <option value="kecelakaan_lalu_lintas">Kecelakaan Lalu Lintas</option>
                                        <option value="evakuasi_medis">Evakuasi Medis</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label w-100"><i class="fas fa-exclamation-circle"></i> Tingkat Prioritas</label>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="radio" name="prioritas" id="prio1" value="rendah" checked>
                                        <label class="form-check-label text-secondary" for="prio1">Rendah</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="radio" name="prioritas" id="prio2" value="sedang">
                                        <label class="form-check-label text-primary" for="prio2">Sedang</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="radio" name="prioritas" id="prio3" value="tinggi">
                                        <label class="form-check-label text-warning" for="prio3">Tinggi</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="radio" name="prioritas" id="prio4" value="darurat">
                                        <label class="form-check-label text-danger" for="prio4">Darurat</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-4 mb-4 p-4 rounded border" style="background: rgba(243, 245, 248, 0.5);">
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-calendar-alt"></i> Waktu Kejadian</label>
                                    <input type="datetime-local" name="waktu_kejadian" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-clock"></i> Waktu Terima Laporan</label>
                                    <input type="datetime-local" name="waktu_terima" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-truck-moving"></i> Waktu Berangkat Unit</label>
                                    <input type="datetime-local" name="waktu_berangkat" class="form-control">
                                </div>
                                
                                <div class="col-md-4 mt-4">
                                    <label class="field-label"><i class="fas fa-map-marker-alt"></i> Waktu Tiba di Lokasi</label>
                                    <input type="datetime-local" name="waktu_tiba" class="form-control">
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label class="field-label"><i class="fas fa-flag-checkered"></i> Waktu Operasi Selesai</label>
                                    <input type="datetime-local" name="waktu_selesai" class="form-control">
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label class="field-label"><i class="fas fa-building"></i> Waktu Kembali ke Mako</label>
                                    <input type="datetime-local" name="waktu_kembali" class="form-control">
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-8">
                                    <label class="field-label"><i class="fas fa-map-signs"></i> Alamat Lengkap</label>
                                    <textarea class="form-control" name="alamat" rows="2" placeholder="Nama jalan, RT/RW, Kecamatan..."></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-location-arrow"></i> Titik Koordinat</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" id="inputKoordinat" name="koordinat" placeholder="-1.61157, 103.57860">
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
                                    <input type="text" name="pimpinan_operasi" class="form-control" placeholder="Cth: Danru 4 Mako">
                                </div>
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-user-friends"></i> Pendamping Operasi</label>
                                    <input type="text" name="pendamping_operasi" class="form-control" placeholder="Opsional...">
                                </div>
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-users-cog"></i> Satuan Tugas / Regu</label>
                                    <input type="text" name="satuan_tugas" class="form-control" placeholder="Cth: Pleton 1 Mako">
                                </div>
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-stopwatch"></i> Tim Respon Time</label>
                                    <input type="text" name="tim_respontime" class="form-control" placeholder="Cth: 15 Menit">
                                </div>
                            </div>

                            <h6 class="fw-bold mb-3" style="color: var(--steel);">Status Korban Manusia & Aset</h6>
                            <div class="row g-4 mb-4">
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-user-check text-success"></i> Selamat</label>
                                    <input type="number" min="0" name="korban_selamat" class="form-control" value="0">
                                </div>
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-user-injured text-warning"></i> Luka Ringan</label>
                                    <input type="number" min="0" name="korban_ringan" class="form-control" value="0">
                                </div>
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-procedures text-warning"></i> Luka Berat</label>
                                    <input type="number" min="0" name="korban_berat" class="form-control" value="0">
                                </div>
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-user-times text-danger"></i> Meninggal Dunia</label>
                                    <input type="number" min="0" name="korban_meninggal" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-cat"></i> Hewan / Aset (Jika relevan)</label>
                                    <input type="text" name="korban_hewan_aset" class="form-control" placeholder="Contoh: 1 ekor ular piton dievakuasi, 2 unit motor terbakar...">
                                </div>
                            </div>

                            <h6 class="fw-bold mb-3 mt-5 border-bottom pb-2" style="color: var(--steel);">Detail Evakuasi & Lapangan</h6>
                            <div class="row g-4 mb-4">
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-info-circle"></i> Status Evakuasi</label>
                                    <select class="form-select" name="status_evakuasi">
                                        <option selected value="">-- Pilih Status --</option>
                                        <option value="selesai">Selesai</option>
                                        <option value="dalam_proses">Dalam Proses</option>
                                        <option value="dirujuk_ke_rs">Dirujuk ke RS</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label class="field-label"><i class="fas fa-house-damage"></i> Objek Terdampak</label>
                                    <input type="text" name="objek_terdampak" class="form-control" placeholder="Contoh: Atap rumah warga, sumur tua, dsb.">
                                </div>
                            </div>

                            <div class="row g-4 mb-4 p-4 rounded border" style="background: rgba(243, 245, 248, 0.5);">
                                <div class="col-md-12 mb-2">
                                    <label class="field-label w-100"><i class="fas fa-route"></i> Metode Evakuasi</label>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="me_vr" name="metode_evakuasi[]" value="vertical_rescue">
                                        <label class="form-check-label" for="me_vr">Vertical Rescue</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="me_wr" name="metode_evakuasi[]" value="water_rescue">
                                        <label class="form-check-label" for="me_wr">Water Rescue</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="me_td" name="metode_evakuasi[]" value="tangga_darurat">
                                        <label class="form-check-label" for="me_td">Penggunaan Tangga Darurat</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="field-label w-100"><i class="fas fa-hands-helping"></i> Metode Penyelamatan</label>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="mp_vr" name="metode_penyelamatan[]" value="vertical_rescue">
                                        <label class="form-check-label" for="mp_vr">Vertical Rescue</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="mp_wr" name="metode_penyelamatan[]" value="water_rescue">
                                        <label class="form-check-label" for="mp_wr">Water Rescue</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="mp_ps" name="metode_penyelamatan[]" value="pemadaman_statis">
                                        <label class="form-check-label" for="mp_ps">Pemadam Statis</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="mp_pd" name="metode_penyelamatan[]" value="pemadaman_dinamis">
                                        <label class="form-check-label" for="mp_pd">Pemadam Dinamis</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="mp_emd" name="metode_penyelamatan[]" value="evakuasi_medis_dasar">
                                        <label class="form-check-label" for="mp_emd">Evakuasi Medis Dasar</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-exclamation-triangle"></i> Hambatan Lapangan</label>
                                    <textarea class="form-control" name="hambatan_lapangan" rows="2" placeholder="Tuliskan hambatan spesifik saat operasi di lapangan..."></textarea>
                                </div>
                            </div>
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-tasks"></i> Langkah Penanganan</label>
                                    <textarea class="form-control" name="langkah_penanganan" rows="2" placeholder="Cth: Ular Sanca Berhasil Di Evakuasi Dengan Menggunakan Stik Hook..."></textarea>
                                </div>
                            </div>
                            
                            <div class="row g-4 mb-4 border-bottom pb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-check-double"></i> Hasil Tindakan</label>
                                    <input type="text" name="hasil_tindakan" class="form-control" placeholder="Cth: Evakuasi berhasil dengan aman dan lancar">
                                </div>
                            </div>

                            <h6 class="fw-bold mb-3 mt-5 border-bottom pb-2" style="color: var(--steel);">Alat, Logistik & Personel</h6>
                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label w-100"><i class="fas fa-toolbox"></i> Peralatan Khusus yang Digunakan</label>
                                    <div class="d-flex flex-wrap gap-2 mb-3">
                                        <input type="checkbox" class="btn-check" id="alat_scba" name="peralatan[]" value="SCBA">
                                        <label class="btn btn-outline-primary" for="alat_scba">SCBA</label>

                                        <input type="checkbox" class="btn-check" id="alat_thermal" name="peralatan[]" value="Thermal Camera">
                                        <label class="btn btn-outline-primary" for="alat_thermal">Thermal Camera</label>

                                        <input type="checkbox" class="btn-check" id="alat_chainsaw" name="peralatan[]" value="Chainsaw">
                                        <label class="btn btn-outline-primary" for="alat_chainsaw">Chainsaw</label>

                                        <input type="checkbox" class="btn-check" id="alat_selam" name="peralatan[]" value="Alat Selam">
                                        <label class="btn btn-outline-primary" for="alat_selam">Alat Selam</label>
                                    </div>
                                    <input type="text" name="peralatan_lain" class="form-control" placeholder="Alat khusus lainnya (pisahkan dengan koma)...">
                                </div>
                            </div>
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-spray-can"></i> Konsumsi Alat Umum</label>
                                    <input type="text" name="konsumsi_alat" class="form-control" placeholder="Contoh: penggunaan foam, jumlah liter air, atau combi tool...">
                                </div>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-tint"></i> Liter Air Digunakan</label>
                                    <div class="input-group">
                                        <input type="number" min="0" name="liter_air" class="form-control" placeholder="0">
                                        <span class="input-group-text">L</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-soap"></i> Liter Foam</label>
                                    <div class="input-group">
                                        <input type="number" min="0" name="liter_foam" class="form-control" placeholder="0">
                                        <span class="input-group-text">L</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-gas-pump"></i> Liter BBM Unit</label>
                                    <div class="input-group">
                                        <input type="number" min="0" name="liter_bbm" class="form-control" placeholder="0">
                                        <span class="input-group-text">L</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-8">
                                    <label class="field-label w-100"><i class="fas fa-truck"></i> Unit Armada Terlibat</label>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="arm_pompa" name="armada[]" value="pompa">
                                        <label class="form-check-label" for="arm_pompa">Unit Pompa</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="arm_rescue" name="armada[]" value="rescue">
                                        <label class="form-check-label" for="arm_rescue">Unit Rescue</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="arm_tangki" name="armada[]" value="tangki">
                                        <label class="form-check-label" for="arm_tangki">Unit Tangki</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="arm_ambulans" name="armada[]" value="ambulans">
                                        <label class="form-check-label" for="arm_ambulans">Ambulans</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-users"></i> Jumlah Personel</label>
                                    <input type="number" min="0" name="jumlah_personel" class="form-control" placeholder="0">
                                </div>
                            </div>
                            
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-user-tag"></i> Personel yang Terlibat</label>
                                    <textarea class="form-control" name="daftar_personel" rows="2" placeholder="Contoh: Budi, Andi, Joko..."></textarea>
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
                                            <option selected value="">-- Pilih Penyebab --</option>
                                            <option value="arus_pendek">Arus pendek listrik</option>
                                            <option value="kebocoran_gas">Kebocoran gas</option>
                                            <option value="sambaran_petir">Sambaran petir</option>
                                            <option value="kelalaian_manusia">Kelalaian manusia</option>
                                            <option value="faktor_alam">Faktor alam</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                        <input type="text" class="form-control" name="dugaan_penyebab_lainnya" placeholder="Ketik jika 'Lainnya'..." style="width: 50%;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-fire-alt"></i> Sumber Api / Titik Awal</label>
                                    <input type="text" name="sumber_api" class="form-control" placeholder="Contoh: Dapur, Panel Listrik utama...">
                                </div>
                            </div>

                            <div class="row g-4 mb-4 border-bottom pb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-ruler-combined"></i> Luas Area Terdampak</label>
                                    <div class="input-group" style="width: 50%;">
                                        <input type="number" min="0" step="0.1" name="luas_area" class="form-control" placeholder="0">
                                        <span class="input-group-text">m²</span>
                                    </div>
                                </div>
                            </div>

                            <h6 class="fw-bold mb-3 mt-5 border-bottom pb-2" style="color: var(--steel);">Kerjasama Lintas Sektoral & Evaluasi</h6>
                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label w-100"><i class="fas fa-building"></i> Instansi Pendukung di Lokasi</label>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_pln" name="instansi_pendukung[]" value="pln">
                                        <label class="form-check-label" for="inst_pln">PLN</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_polisi" name="instansi_pendukung[]" value="polisi">
                                        <label class="form-check-label" for="inst_polisi">Polisi</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_tni" name="instansi_pendukung[]" value="tni">
                                        <label class="form-check-label" for="inst_tni">TNI</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_pmi" name="instansi_pendukung[]" value="pmi">
                                        <label class="form-check-label" for="inst_pmi">BPBD</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_relawan" name="instansi_pendukung[]" value="relawan_lokal">
                                        <label class="form-check-label" for="inst_relawan">Relawan Lokal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 mb-4">
                                <div class="col-md-8">
                                    <label class="field-label"><i class="fas fa-tasks"></i> Tindakan Instansi Samping</label>
                                    <textarea class="form-control" name="tindakan_instansi" rows="2" placeholder="Contoh: PLN melakukan pemutusan arus..."></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-phone-alt"></i> No. Kontak Saksi/Warga</label>
                                    <input type="text" name="kontak_saksi" class="form-control" placeholder="08xx-xxxx-xxxx">
                                </div>
                            </div>
                            
                            <div class="row g-4 mb-4 border-bottom pb-4">
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-plus-circle"></i> Kebutuhan Tambahan</label>
                                    <textarea class="form-control" name="kebutuhan_tambahan" rows="2" placeholder="Dibutuhkan drone thermal..."></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-lightbulb"></i> Saran Mitigasi Warga</label>
                                    <textarea class="form-control" name="saran_mitigasi" rows="2" placeholder="Sosialisasi APAR..."></textarea>
                                </div>
                            </div>
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-hands-helping"></i> Cara Bertindak</label>
                                    <select class="form-select" name="cara_bertindak">
                                        <option selected value="5T">5 T (Terencana, Terukur, Terarah, Terlayani & Tuntas)</option>
                                        <option value="lainnya">Lainnya...</option>
                                    </select>
                                </div>
                            </div>

                            <h6 class="fw-bold mb-3 mt-5 border-bottom pb-2" style="color: var(--steel);">Dokumentasi Akhir</h6>
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-align-left"></i> Kronologi Terperinci</label>
                                    <textarea class="form-control" name="kronologi_lengkap" rows="4" placeholder="Uraian singkat operasi..."></textarea>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="field-label"><i class="fas fa-images"></i> Upload Foto (.jpg/.png)</label>
                                        <input class="form-control" type="file" name="foto[]" multiple accept="image/png, image/jpeg">
                                    </div>
                                    <div>
                                        <label class="field-label"><i class="fas fa-video"></i> Upload Video (.mp4)</label>
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
                                        <option selected value="">-- Pilih --</option>
                                        <option value="ular">Ular</option>
                                        <option value="tawon">Tawon/Vespa</option>
                                        <option value="kera">Kera</option>
                                        <option value="biawak">Biawak</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label class="field-label"><i class="fas fa-tag"></i> Spesies/Lokal</label>
                                    <input type="text" name="spesies_hewan" class="form-control" placeholder="Cth: King Cobra">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="field-label"><i class="fas fa-ruler"></i> Dimensi</label>
                                    <input type="text" name="dimensi_hewan" class="form-control" placeholder="Panjang ±3 meter">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="field-label"><i class="fas fa-balance-scale"></i> Berat Hewan</label>
                                    <div class="input-group">
                                        <input type="number" step="0.1" min="0" name="berat_hewan" class="form-control" placeholder="Cth: 5">
                                        <span class="input-group-text">Kg</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="field-label"><i class="fas fa-share-square"></i> Status Pasca Evakuasi</label>
                                    <select class="form-select" name="status_hewan_pasca">
                                        <option selected value="">-- Pilih --</option>
                                        <option value="dilepasliarkan">Dilepasliarkan</option>
                                        <option value="diserahkan_bksda">Diserahkan BKSDA</option>
                                        <option value="mati">Mati</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="field-label"><i class="fas fa-tree"></i> Lokasi Pelepasan</label>
                                    <input type="text" name="lokasi_pelepasan" class="form-control" placeholder="Habitat...">
                                </div>
                            </div>

                            <!-- Pohon Tumbang -->
                            <div class="row g-4 mb-4 p-4 rounded border" style="background: rgba(243, 245, 248, 0.5);">
                                <div class="col-12"><h6 class="fw-bold text-primary mb-0"><i class="fas fa-tree me-2"></i>Pohon Tumbang / Bangunan</h6></div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-car-crash"></i> Jenis Objek</label>
                                    <select class="form-select" name="jenis_objek_tumbang">
                                        <option selected value="">-- Pilih --</option>
                                        <option value="pohon">Pohon</option>
                                        <option value="baliho">Baliho</option>
                                        <option value="tiang_listrik">Tiang Listrik</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-expand-arrows-alt"></i> Dimensi Objek</label>
                                    <div class="input-group">
                                        <input type="number" min="0" step="0.1" name="dimensi_objek" class="form-control" placeholder="0">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-plug"></i> Utilitas Terkait</label>
                                    <select class="form-select" name="status_utilitas">
                                        <option selected value="">-- Tidak Ada --</option>
                                        <option value="kabel_pln">Kabel PLN putus</option>
                                        <option value="pipa_pdam">Pipa PDAM bocor</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="field-label"><i class="fas fa-house-damage"></i> Dampak Properti</label>
                                    <textarea class="form-control" name="dampak_properti" rows="2" placeholder="Menutup jalan, menimpa pagar..."></textarea>
                                </div>
                            </div>
                            
                            <!-- Water Rescue -->
                            <div class="row g-4 mb-4 p-4 rounded border" style="background: rgba(243, 245, 248, 0.5);">
                                <div class="col-12"><h6 class="fw-bold text-primary mb-0"><i class="fas fa-life-ring me-2"></i>Water Rescue</h6></div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-water"></i> Kondisi Perairan</label>
                                    <select class="form-select" name="kondisi_perairan">
                                        <option selected value="">-- Pilih --</option>
                                        <option value="arus_deras">Arus Deras</option>
                                        <option value="arus_tenang">Arus Tenang</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-search-location"></i> Radius</label>
                                    <div class="input-group">
                                        <input type="number" min="0" name="radius_pencarian" class="form-control" placeholder="0">
                                        <span class="input-group-text">m</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-binoculars"></i> Metode Pencarian</label>
                                    <select class="form-select" name="metode_pencarian_air">
                                        <option selected value="">-- Pilih --</option>
                                        <option value="penyelaman">Penyelaman</option>
                                        <option value="penyisiran">Penyisiran Perahu</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="field-label"><i class="fas fa-swimmer"></i> Daftar Penyelam</label>
                                    <input type="text" name="daftar_penyelam" class="form-control" placeholder="Nama bersertifikasi...">
                                </div>
                            </div>
                            
                            <!-- Ring/Object Removal & Geografis -->
                            <div class="row g-4 mb-4 p-4 rounded border" style="background: rgba(243, 245, 248, 0.5);">
                                <div class="col-12"><h6 class="fw-bold text-primary mb-0"><i class="fas fa-ring me-2"></i>Ring/Object Removal & Geografis</h6></div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-ring"></i> Jenis Benda</label>
                                    <input type="text" name="jenis_benda_bahaya" class="form-control" placeholder="Cincin, kaleng...">
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-hand-paper"></i> Kondisi Anggota Tubuh</label>
                                    <select class="form-select" name="kondisi_anggota_tubuh">
                                        <option selected value="">-- Pilih --</option>
                                        <option value="bengkak">Bengkak</option>
                                        <option value="luka_terbuka">Luka Terbuka</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-cut"></i> Alat Potong</label>
                                    <select class="form-select" name="alat_potong_cincin">
                                        <option selected value="">-- Pilih --</option>
                                        <option value="gerinda_mini">Gerinda Mini</option>
                                        <option value="tang_baja">Tang Baja</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label class="field-label"><i class="fas fa-cloud-sun"></i> Cuaca Operasi</label>
                                    <select class="form-select" name="cuaca_operasi">
                                        <option selected value="">-- Pilih --</option>
                                        <option value="cerah">Cerah</option>
                                        <option value="hujan_lebat">Hujan Lebat</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label class="field-label"><i class="fas fa-mountain"></i> Jenis Medan</label>
                                    <select class="form-select" name="jenis_medan">
                                        <option selected value="">-- Pilih --</option>
                                        <option value="pemukiman_padat">Pemukiman Padat</option>
                                        <option value="perkebunan">Perkebunan</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label class="field-label"><i class="fas fa-road"></i> Akses Lokasi</label>
                                    <select class="form-select" name="akses_lokasi">
                                        <option selected value="">-- Pilih --</option>
                                        <option value="kendaraan_berat">Bisa dilalui Roda 4+</option>
                                        <option value="roda_dua">Hanya Roda 2</option>
                                        <option value="jalan_kaki">Hanya Jalan Kaki</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- SUBMIT BUTTON -->
                    <div class="d-flex justify-content-end mt-5 pt-4 border-top">
                        <button type="reset" class="btn-custom-light me-3">Batal</button>
                        <button type="submit" class="btn-custom-primary shadow-sm">
                            <i class="fas fa-save me-2"></i> Simpan Data Penyelamatan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

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
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ==================== SCRIPTS ==================== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
(function () {
    'use strict';

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

    /* ---------- Eksklusivitas Accordion Sidebar (hanya satu grup terbuka) ---------- */
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
                map = L.map('map').setView([-1.61157, 103.57860], 13);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                marker = L.marker([-1.61157, 103.57860], {draggable: true}).addTo(map);

                marker.on('dragend', function (e) {
                    document.getElementById('latlngDisplay').innerText = marker.getLatLng().lat.toFixed(5) + ', ' + marker.getLatLng().lng.toFixed(5);
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
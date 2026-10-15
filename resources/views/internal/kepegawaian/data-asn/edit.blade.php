@extends('layouts.dashboard')

@section('content')
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Edit Data ASN | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root { --ink: #0d1b2a; --navy: #163a63; --navy-dark: #0d2947; --navy-light: #eaf1f8; --paper: #f5f7fa; --line: #e2e8f0; --line-dark: #d5dce6; --font-display: 'Bricolage Grotesque', system-ui, sans-serif; --font-body: 'Instrument Sans', system-ui, sans-serif; --topbar-h: 70px; --sidebar-w: 288px; }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-body); font-size: 1rem; line-height: 1.6; color: var(--ink); background: var(--paper); }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; margin: 0; padding: 0; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
        
        .toast-wrap { position: fixed; z-index: 200; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; }
        .toast { display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px; border-radius: 999px; background: #fff; border: 1px solid var(--line); box-shadow: 0 10px 25px rgba(13, 27, 42, .08); font-weight: 600; font-size: .92rem; }
        .toast-ico { flex: none; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; color: #fff; font-size: .78rem; }
        .toast.ok .toast-ico { background: #198754; } .toast.err .toast-ico { background: #dc3545; }
        .toast-x { flex: none; width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); border: none; cursor: pointer; }
        
        .topbar { position: sticky; top: 0; z-index: 60; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); }
        .topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .side-toggle { display: none; width: 40px; height: 40px; border-radius: 10px; align-items: center; justify-content: center; font-size: 1.05rem; color: #fff; }
        .brand { display: flex; align-items: center; gap: 12px; color: #fff; } .brand img { height: 34px; } .brand span { font-family: var(--font-display); font-weight: 700; font-size: 1.08rem; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .user-chip { display: flex; align-items: center; gap: 10px; padding: 5px 14px 5px 5px; border-radius: 999px; background: rgba(255,255,255,.08); color: #fff; }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #fff; color: var(--ink); display: grid; place-items: center; font-weight: 700; }
        .user-meta strong { display: block; font-size: .84rem; font-weight: 700; } .user-meta small { font-size: .72rem; color: rgba(255,255,255,.62); }
        .btn-logout { display: flex; align-items: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #fff; color: var(--ink); font-weight: 600; border: none; cursor: pointer; }
        
        .shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
        .sidebar-backdrop { display: none; }
        .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #fff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
        .side-link { display: flex; align-items: flex-start; gap: 14px; padding: 11px 14px; border-radius: 10px; font-size: .89rem; font-weight: 600; color: var(--ink); margin-bottom: 4px; transition: background .2s, color .2s; }
        .side-link:hover { background: #f3f6fa; }
        .side-link.active { background: var(--ink); color: #fff; }
        .side-link i { width: 20px; text-align: center; font-size: 1rem; color: #64748b; margin-top: 3px; }
        .side-link.active i { color: #fff; }
        .side-group + .side-group { margin-top: 6px; }
        .side-group summary { display: flex; align-items: flex-start; gap: 12px; padding: 11px 14px; border-radius: 10px; font-size: .78rem; font-weight: 700; text-transform: uppercase; color: var(--navy); cursor: pointer; list-style: none; transition: background .2s; }
        .side-group summary::-webkit-details-marker { display: none; }
        .side-group summary:hover { background: #f3f6fa; }
        .side-group summary .grp-ico { width: 20px; text-align: center; font-size: .95rem; margin-top: 3px; }
        .side-group summary .chev { margin-left: auto; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
        .side-group[open] summary .chev { transform: rotate(180deg); }
        .side-sub { display: grid; gap: 3px; padding: 6px 0 10px 8px; border-left: 2px solid var(--line); margin: 2px 0 8px 18px; }
        .side-sub a { display: flex; align-items: flex-start; gap: 12px; padding: 9px 10px; border-radius: 10px; font-size: .84rem; font-weight: 500; color: #64748b; transition: background .2s, color .2s; }
        .side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); }
        .side-sub a.active { background: rgba(22, 58, 99, .08); color: var(--navy); font-weight: 600; }
        .side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; margin-top: 3px; }
        .side-kicker { padding: 18px 14px 6px; font-size: .68rem; font-weight: 700; text-transform: uppercase; color: #94a3b8; }
        .content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
        .page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: 2.1rem; color: var(--ink); }

        @media (max-width: 900px) {
            .side-toggle { display: inline-flex; }
            .user-meta { display: none; }
            .sidebar { position: fixed; z-index: 1010; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); }
            body.side-open .sidebar { transform: none; }
            .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 1000; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
            body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
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
                <small>{{ Auth::user()->role ?? '' }}</small>
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

    <!-- ==================== SIDEBAR LENGKAP ==================== -->
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
                    <a href="/internal/damtan/rekap-layanan" class="{{ Request::is('internal/damtan/rekap-layanan*') ? 'active' : '' }}">
                        <i class="fas fa-truck-medical"></i><span class="lbl">Input Rekap Layanan</span>
                    </a>
                    <a href="/internal/damtan/rekap-objek" class="{{ Request::is('internal/damtan/rekap-objek*') ? 'active' : '' }}">
                        <i class="fas fa-house-chimney-crack"></i><span class="lbl">Input Rekap Objek Kebakaran</span>
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
        @endhasanyrole

        <!-- MANAJEMEN INFORMASI -->
        @hasanyrole('Super User|Sapra|Damtan|Pencegahan|Sekretariat|Operator')
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

    <!-- AREA KONTEN UTAMA (EDIT FORM) -->
    <main class="content">
        <div class="page-head mb-4">
            <h1 class="mb-1">Edit Data ASN</h1>
            <p class="text-muted">Perbarui rekapitulasi jumlah pegawai PNS dan PPPK berdasarkan jabatan.</p>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 14px; background: #fff;">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('data-asn.update', $dataAsn->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- BLOK NAMA JABATAN -->
                    @php
                        $default_jabatan = [
                            'STRUKTURAL',
                            'ANALIS KEBAKARAN AHLI MUDA',
                            'ARSIPARIS AHLI PERTAMA',
                            'ANALIS KEBAKARAN AHLI PERTAMA',
                            'PEMADAM KEBAKARAN MAHIR',
                            'PEMADAM KEBAKARAN TERAMPIL',
                            'PEMADAM KEBAKARAN PEMULA',
                            'PENELAAH TEKNIS KEBIJAKAN',
                            'PENATA LAYANAN OPERASIONAL',
                            'PENGADMINISTRASI PERKANTORAN'
                        ];
                        
                        $db_jabatan = \App\Models\DataAsn::select('nama_jabatan')->distinct()->pluck('nama_jabatan')->toArray();
                        $jabatan_list = array_unique(array_merge($default_jabatan, $db_jabatan));
                        
                        // Set nilai default dari database untuk halaman edit ini
                        $old_jabatan = old('nama_jabatan', $dataAsn->nama_jabatan);
                        if ($old_jabatan && !in_array($old_jabatan, $jabatan_list)) {
                            $jabatan_list[] = $old_jabatan;
                        }
                        
                        sort($jabatan_list);
                    @endphp

                    <!-- MODE DROPDOWN -->
                    <div class="mb-4" id="dropdown_mode">
                        <label for="select_nama_jabatan" class="form-label fw-bold" style="color: var(--ink);">
                            Nama Jabatan <span class="text-danger">*</span>
                        </label>
                        <select class="form-select form-control-lg @error('nama_jabatan') is-invalid @enderror" 
                                id="select_nama_jabatan" 
                                name="nama_jabatan" 
                                style="font-size: 0.95rem; border-radius: 8px;"
                                required autofocus
                                onchange="toggleJabatanMode(this)">
                            <option value="" disabled {{ $old_jabatan ? '' : 'selected' }}>-- Pilih Nama Jabatan --</option>
                            @foreach($jabatan_list as $jabatan)
                                <option value="{{ $jabatan }}" {{ $old_jabatan == $jabatan ? 'selected' : '' }}>
                                    {{ $jabatan }}
                                </option>
                            @endforeach
                            <option value="LAINNYA" class="fw-bold text-primary">&#43; Tambah Jabatan Baru...</option>
                        </select>
                        @error('nama_jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- MODE TEXT INPUT -->
                    <div class="mb-4" id="text_mode" style="display: none;">
                        <label for="input_nama_jabatan" class="form-label fw-bold" style="color: var(--ink);">
                            Ketik Nama Jabatan Baru <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control" id="input_nama_jabatan" style="font-size: 0.95rem; text-transform: uppercase;">
                            <button class="btn btn-outline-secondary" type="button" onclick="cancelJabatanMode()" style="border-top-right-radius: 8px; border-bottom-right-radius: 8px;">
                                <i class="fas fa-times"></i> Batal
                            </button>
                        </div>
                        <small class="text-muted mt-1 d-block"><i class="fas fa-info-circle me-1"></i>Jabatan ini akan otomatis tersimpan di pilihan dropdown untuk input selanjutnya.</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="pns" class="form-label fw-bold" style="color: var(--ink);">Jumlah PNS <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-lg @error('pns') is-invalid @enderror" id="pns" name="pns" value="{{ old('pns', $dataAsn->pns) }}" min="0" style="font-size: 0.95rem; border-radius: 8px;" required>
                            @error('pns') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="pppk" class="form-label fw-bold" style="color: var(--ink);">Jumlah PPPK <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-lg @error('pppk') is-invalid @enderror" id="pppk" name="pppk" value="{{ old('pppk', $dataAsn->pppk) }}" min="0" style="font-size: 0.95rem; border-radius: 8px;" required>
                            @error('pppk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <hr class="my-4" style="border-color: var(--line);">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn px-4 py-2 fw-semibold text-white" style="background-color: var(--navy); border-radius: 8px;">
                            <i class="fas fa-save me-2"></i> Perbarui Data
                        </button>
                        <a href="{{ route('data-asn.index') }}" class="btn btn-light px-4 py-2 fw-semibold border" style="border-radius: 8px; color: #64748b;">
                            <i class="fas fa-arrow-left me-2"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<script>
    // JS Handle Dropdown ke Text Input
    function toggleJabatanMode(selectObj) {
        if(selectObj.value === 'LAINNYA') {
            document.getElementById('dropdown_mode').style.display = 'none';
            selectObj.removeAttribute('name'); 
            
            document.getElementById('text_mode').style.display = 'block';
            let input = document.getElementById('input_nama_jabatan');
            input.setAttribute('name', 'nama_jabatan'); 
            input.focus();
        }
    }

    function cancelJabatanMode() {
        document.getElementById('text_mode').style.display = 'none';
        let input = document.getElementById('input_nama_jabatan');
        input.removeAttribute('name');
        input.value = '';

        document.getElementById('dropdown_mode').style.display = 'block';
        let select = document.getElementById('select_nama_jabatan');
        select.setAttribute('name', 'nama_jabatan');
        select.value = ''; 
    }

    // JS Sidebar & Toast
    (function () {
        'use strict';
        document.querySelectorAll('[data-toast]').forEach(function (t) {
            var hide = function () { t.classList.add('leaving'); setTimeout(function () { t.remove(); }, 350); };
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
        document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeSide(); });

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
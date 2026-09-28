<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Pelatihan Keluarga Tanggap Kebakaran - SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* DESIGN TOKENS */
        :root {
            --ink: #0d1b2a; --ink-2: #132a43; --ink-3: #1d3856;
            --paper: #f7f9fc; --white: #ffffff;
            --navy: #1e3a5f; --navy-d: #14283f; --navy-tint: rgba(30, 58, 95, .09);
            --signal: #e5392d; --signal-d: #c22b20; --signal-tint: rgba(229, 57, 45, .09);
            --amber: #ffb627; --success: #10b981; --info: #2f6fed;
            --steel: #64748b; --steel-soft: #94a3b8; --line: #e6eaf1;

            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;

            --r-md: 14px; --r-sm: 10px;
            --sidebar-w: 272px; --topbar-h: 72px;

            --shadow-xs: 0 1px 2px rgba(13, 27, 42, .05);
            --shadow-sm: 0 2px 8px -2px rgba(13, 27, 42, .08);
            --shadow-md: 0 12px 24px -8px rgba(13, 27, 42, .12);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font-body); font-size: 1rem; line-height: 1.6; color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased; }
        img { max-width: 100%; display: block; }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; margin: 0; padding: 0; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }

        /* TOAST */
        .toast-wrap { position: fixed; z-index: 200; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
        .toast { display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px; border-radius: 999px; background: #fff; border: 1px solid var(--line); box-shadow: var(--shadow-md); font-weight: 600; font-size: .92rem; animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both; }
        .toast.leaving { animation: toastOut .3s ease forwards; }
        .toast-ico { flex: none; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; color: #fff; font-size: .78rem; }
        .toast.ok .toast-ico { background: var(--success); }
        .toast.err .toast-ico { background: var(--signal); }
        .toast-x { flex: none; width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; }
        .toast-x:hover { background: var(--ink); color: #fff; }
        @keyframes toastIn { from { opacity: 0; transform: translateY(-14px); } to { opacity: 1; transform: none; } }
        @keyframes toastOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(-14px); } }

        /* TOPBAR */
        .topbar { position: sticky; top: 0; z-index: 60; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: rgba(255,255,255,.86); backdrop-filter: blur(16px); border-bottom: 1px solid var(--line); }
        .topbar-left { display: flex; align-items: center; gap: 14px; }
        .side-toggle { display: none; width: 40px; height: 40px; border-radius: 12px; align-items: center; justify-content: center; font-size: 1.05rem; transition: background .2s; }
        .side-toggle:hover { background: var(--paper); }
        .brand { display: flex; align-items: center; gap: 12px; }
        .brand img { height: 34px; width: auto; }
        .brand span { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: 1.08rem; letter-spacing: -0.01em; white-space: nowrap; }
        
        .topbar-right { display: flex; align-items: center; gap: 14px; }
        .user-chip { display: flex; align-items: center; gap: 10px; padding: 6px 16px 6px 6px; border-radius: 999px; background: var(--paper); border: 1px solid var(--line); }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--ink); color: #fff; display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; }
        .user-meta { display: grid; line-height: 1.25; }
        .user-meta strong { font-size: .85rem; font-weight: 700; color: var(--ink); }
        .user-meta small { font-size: .74rem; color: var(--steel); text-transform: capitalize; font-weight: 500; }
        .btn-logout { display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 18px; border-radius: 999px; background: var(--navy); color: #fff; font-weight: 600; font-size: .85rem; border: none; transition: background .2s, transform .1s; }
        .btn-logout:hover { background: var(--navy-d); }

        /* SIDEBAR */
        .shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
        .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #fff; border-right: 1px solid var(--line); padding: 20px 14px 32px; }
        .side-link { display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .9rem; font-weight: 600; color: var(--ink); margin-bottom: 4px; transition: background .2s; }
        .side-link:hover { background: var(--paper); }
        .side-link.active { background: var(--ink); color: #fff; }
        .side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); }
        .side-link.active i { color: var(--amber); }

        .side-group summary { list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .8rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--navy); transition: background .2s; }
        .side-group summary::-webkit-details-marker { display: none; }
        .side-group summary:hover { background: var(--paper); }
        .side-group[open] summary { background: var(--paper); color: var(--ink); }
        .side-group[open] summary .grp-ico { color: var(--ink); }
        .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; }
        .side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; margin-left: auto;}
        .side-group[open] summary .chev { transform: rotate(180deg); }
        .side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
        .side-sub a { display: flex; align-items: center; gap: 12px; padding: 9px 12px; border-radius: var(--r-sm); font-size: .85rem; font-weight: 500; color: var(--steel); transition: background .2s; }
        .side-sub a:hover { background: var(--paper); color: var(--ink); }
        .side-sub a.active { background: var(--navy-tint); color: var(--navy-d); font-weight: 600; }
        .side-sub a i { width: 18px; text-align: center; opacity: .75; }
        .side-sub a:hover i, .side-sub a.active i { opacity: 1; }
        .side-kicker { padding: 18px 14px 6px; font-size: .7rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase; color: var(--steel-soft); }

        /* KONTEN UTAMA & TABS */
        .content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
        .page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -0.02em; margin-bottom: 4px; color: var(--ink); }
        .page-head p { color: var(--steel); font-size: .98rem; }

        .custom-nav-tabs { border-bottom: 2px solid var(--line); margin-top: 15px; gap: 10px; flex-wrap: nowrap; overflow-x: auto; display: flex; margin-bottom: 24px; }
        .custom-nav-tabs .nav-link { border: none; color: var(--steel); font-weight: 700; font-size: 13px; padding: 12px 18px; background: transparent; white-space: nowrap; transition: color .2s; }
        .custom-nav-tabs .nav-link:hover { color: var(--ink); }
        .custom-nav-tabs .nav-link.active { color: var(--navy); border-bottom: 3px solid var(--navy); }

        .section-heading { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; margin-top: 24px; flex-wrap: nowrap; }
        .section-heading-ico { flex: none; width: 28px; height: 28px; border-radius: 8px; background: var(--navy); color: #fff; display: grid; place-items: center; font-size: .75rem; }
        .section-heading h3 { flex: none; font-family: var(--font-display); font-weight: 700; font-size: 1.1rem; color: var(--ink); margin: 0; }
        .section-heading .line { flex: 1 1 auto; min-width: 24px; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }

        /* TABEL PELATIHAN KELUARGA (HEADER SIMPLE 7 KOLOM) */
        .table-scroll-wrapper { width: 100%; overflow-x: auto; border-radius: var(--r-md); border: 1px solid var(--line); background: #fff; margin-bottom: 40px; box-shadow: var(--shadow-sm); }
        .table-detailed { width: 100%; border-collapse: collapse; min-width: 1000px; margin-bottom: 0; }
        .table-detailed thead { background-color: var(--ink); color: #fff; }
        .table-detailed th { font-size: 11px; font-weight: 700; padding: 16px 15px; white-space: nowrap; text-transform: uppercase; border-right: 1px solid var(--ink-3); vertical-align: middle; }
        .table-detailed td { font-size: 13px; padding: 14px 15px; vertical-align: middle; white-space: nowrap; border-bottom: 1px solid var(--line); border-right: 1px solid var(--paper); }
        .table-detailed tbody tr:hover { background-color: var(--paper); }
        
        .btn-action { width: 32px; height: 32px; display: inline-flex; justify-content: center; align-items: center; border-radius: 6px; font-size: 13px; color: white; border: none; transition: transform 0.1s; margin-right: 2px; }
        .btn-action:hover { transform: scale(1.05); }
        .btn-edit { background-color: var(--amber); }
        .btn-delete { background-color: var(--signal); }
    </style>
</head>
<body>

<div class="toast-wrap" id="toastWrap" aria-live="polite">
    @if(session('success'))
        <div class="toast ok" data-toast>
            <span class="toast-ico"><i class="fas fa-check"></i></span>
            <span>{{ session('success') }}</span>
            <button type="button" class="toast-x" data-toast-close><i class="fas fa-times"></i></button>
        </div>
    @endif
    @if(session('error'))
        <div class="toast err" data-toast>
            <span class="toast-ico"><i class="fas fa-triangle-exclamation"></i></span>
            <span>{{ session('error') }}</span>
            <button type="button" class="toast-x" data-toast-close><i class="fas fa-times"></i></button>
        </div>
    @endif
</div>

<!-- TOPBAR -->
<header class="topbar">
    <div class="topbar-left">
        <button class="side-toggle" type="button" id="sideToggle"><i class="fas fa-bars"></i></button>
        <a href="/internal/index" class="brand">
            <img src="/images/simerahkoja.png" alt="Logo"><span>SIMERAH KOJA</span>
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

    <!-- SIDEBAR LENGKAP -->
    <aside class="sidebar" id="sidebar">
        <a href="/internal/index" class="side-link"><i class="fas fa-house"></i> Dashboard utama</a>

        <div class="side-kicker">Modul operasional</div>
        
        <details class="side-group" open>
            <summary><i class="fas fa-shield-halved grp-ico"></i><span class="grp-label">Bagian pencegahan</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="/internal/pencegahan/peningkatan-kapasitas"><i class="fas fa-arrow-trend-up"></i> Peningkatan Kapasitas Aparatur</a>
                <a href="/internal/pencegahan/inspeksi-kebakaran"><i class="fas fa-magnifying-glass-chart"></i> Pencegahan Kebakaran dan Inspeksi</a>
                <a href="/internal/pencegahan/pemberdayaan-masyarakat" class="active"><i class="fas fa-handshake-angle"></i> Pemberdayaan Masyarakat dan Dunia Usaha</a>
                <a href="/internal/pencegahan/kelola-edukasi"><i class="fas fa-bullhorn"></i> Kelola Edukasi</a>
                <a href="/internal/pencegahan/kelola-redkar"><i class="fas fa-users-rectangle"></i> Kelola Redkar</a>
                <a href="/internal/pencegahan/kelola-rpkbgl"><i class="fas fa-building-circle-check"></i> Kelola RPKBGL</a>
                <a href="/internal/pencegahan/kelola-skk"><i class="fas fa-file-shield"></i> Kelola SKK</a>
            </div>
        </details>
        
        <details class="side-group">
            <summary><i class="fas fa-fire-extinguisher grp-ico"></i><span class="grp-label">Bagian pemadaman</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="/internal/damtan/input-data"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                <a href="/internal/damtan/data-laporan"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
                <a href="/internal/surat-korban/create"><i class="fas fa-file-signature"></i> Buat Surat Korban</a>
            </div>
        </details>
        
        <details class="side-group">
            <summary><i class="fas fa-user-tie grp-ico"></i><span class="grp-label">Kepegawaian</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="/internal/kepegawaian/duk"><i class="fas fa-user-tie"></i> Data Urut Kepegawaian</a>
            </div>
        </details>

        <details class="side-group">
            <summary><i class="fas fa-warehouse grp-ico"></i><span class="grp-label">Bagian sapra</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <span class="side-kicker" style="padding-left:2px;">Sarana &amp; Prasarana</span>
                <a href="/sapra/sarana-penyelamatan"><i class="fas fa-life-ring"></i> Sarana Penyelamatan & Evakuasi</a>
                <a href="/sapra/sarana-pemeriksaan"><i class="fas fa-search-location"></i> Sarana Pemeriksaan Proteksi Kebakaran</a>
                <a href="/sapra/kelola-pos"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>

                <span class="side-kicker" style="padding-left:2px;">Manajemen Air</span>
                <a href="/sapra/data_hidrant_gedung"><i class="fas fa-droplet"></i> Sumber Air</a>
                <a href="/sapra/data-hidrant-kota"><i class="fas fa-map-location-dot"></i> Data Hidrant Kota Jambi</a>

                <span class="side-kicker" style="padding-left:2px;">Logistik & Distribusi</span>
                <a href="/sapra/kebutuhan-sarpras"><i class="fas fa-boxes-stacked"></i> Mutu Baku Kebutuhan</a>
                <a href="/sapra/distribusi-staff"><i class="fas fa-people-carry-box"></i> Distribusi Barang Staff</a>
            </div>
        </details>

        <div class="side-kicker">Konten publik</div>
        <details class="side-group">
            <summary><i class="far fa-newspaper grp-ico"></i><span class="grp-label">Manajemen berita</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="/internal/operator/kelola-berita"><i class="far fa-newspaper"></i> Input &amp; Kelola Berita</a>
                <a href="/internal/operator/infografis"><i class="far fa-image"></i> Kelola Info Grafis</a>
                <a href="/internal/operator/berita-medsos"><i class="fab fa-instagram"></i> Kelola Berita Medsos</a>
            </div>
        </details>

        <div class="side-kicker">Akun</div>
        <details class="side-group">
            <summary><i class="fas fa-user-gear grp-ico"></i><span class="grp-label">Pengaturan akun</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="/internal/profil"><i class="fas fa-user-pen"></i> Profil Saya</a>
                @if(Auth::user()?->role === 'super_user')
                    <a href="/internal/kelola-user"><i class="fas fa-users-gear"></i> Kelola Semua Pengguna</a>
                    <a href="/internal/kelola-pemohon"><i class="fas fa-address-book"></i> Kelola Akun Pemohon</a>
                @endif
            </div>
        </details>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="content">
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
            <div class="page-head mb-0">
                <h1>Pemberdayaan Masyarakat</h1>
                <p>Kelola data sosialisasi, edukasi, dan pelatihan tanggap kebakaran.</p>
            </div>
            
            <div class="d-flex align-items-center gap-2">
                <div class="input-group" style="width: 260px;">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" class="form-control border-start-0 ps-0" placeholder="Cari kelurahan atau posyandu...">
                </div>
                <a href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/create" class="btn text-white fw-bold d-flex align-items-center gap-2" style="background-color: var(--navy); padding: 9px 16px; border-radius: 8px;">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                <a href="#" class="btn text-white fw-bold d-flex align-items-center gap-2" style="background-color: var(--success); padding: 9px 16px; border-radius: 8px;">
                    <i class="fas fa-file-excel"></i> Excel
                </a>
                <a href="#" class="btn text-white fw-bold d-flex align-items-center gap-2" style="background-color: var(--signal); padding: 9px 16px; border-radius: 8px;">
                    <i class="fas fa-file-pdf"></i> PDF
                </a>
            </div>
        </div>

        <!-- TABS PEMBERDAYAAN LENGKAP -->
        <ul class="nav custom-nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/pemberdayaan-masyarakat') && !Request::is('internal/pencegahan/pemberdayaan-masyarakat/pelatihan*') && !Request::is('internal/pencegahan/pemberdayaan-masyarakat/sosialisasi*') ? 'active' : '' }}" href="/internal/pencegahan/pemberdayaan-masyarakat">
                    Semua Data
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga*') ? 'active' : '' }}" href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga">
                    PELATIHAN KELUARGA TANGGAP KEBAKARAN
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/pemberdayaan-masyarakat/sosialisasi*') ? 'active' : '' }}" href="/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi">
                    SOSIALISASI DAN EDUKASI
                </a>
            </li>
        </ul>

        <div class="section-heading">
            <span class="section-heading-ico"><i class="fas fa-home"></i></span>
            <h3>Data Pelatihan Keluarga Tanggap Kebakaran</h3><span class="line"></span>
        </div>

        <!-- TABEL PELATIHAN KELUARGA (7 KOLOM) -->
        <div class="table-scroll-wrapper">
            <table class="table-detailed table-hover">
                <thead>
                    <tr>
                        <th class="text-center" width="60px">NO</th>
                        <th>HARI / TANGGAL</th>
                        <th>LOKASI / KELURAHAN</th>
                        <th>KECAMATAN</th>
                        <th>JUMLAH PESERTA</th>
                        <th>KETERANGAN</th>
                        <th class="text-center" width="100px">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data_pelatihan ?? [] as $index => $item)
                    <tr>
                        <td class="text-center fw-bold">{{ $index + 1 }}</td>
                        <td>{{ $item->tanggal_pelaksanaan ? \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->translatedFormat('d F Y') : ($item->hari_tgl ?? '-') }}</td>
                        <td class="fw-bold text-dark">{{ $item->lokasi ?? $item->kelurahan ?? '-' }}</td>
                        <td>{{ $item->kecamatan ?? '-' }}</td>
                        <td>{{ $item->jumlah_peserta ?? '-' }} Orang</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        <td class="text-center d-flex justify-content-center gap-1">
                            <a href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/edit/{{ $item->id }}" class="btn-action btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                            <form action="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/hapus/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');" style="margin:0; display:inline-block;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted fw-bold">
                            <i class="fas fa-folder-open mb-2" style="font-size: 28px; color: var(--steel-soft);"></i><br>
                            Belum ada data Pelatihan Keluarga Tanggap Kebakaran.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>

<script>
(function () {
    'use strict';
    document.querySelectorAll('[data-toast]').forEach(function (t) {
        var hide = function () { t.classList.add('leaving'); setTimeout(function () { t.remove(); }, 350); };
        var x = t.querySelector('[data-toast-close]'); if (x) x.addEventListener('click', hide);
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
})();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
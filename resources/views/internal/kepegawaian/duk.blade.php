<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Data Urut Kepegawaian (DUK) | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Khusus untuk Tabel dan Modal CRUD -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ==========================================================
           TOKENS & OVERRIDES (Mengikuti style Dashboard Utama)
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
            font-family: var(--font-body) !important;
            font-size: 1rem;
            line-height: 1.6;
            color: var(--ink);
            background: var(--paper) !important;
            -webkit-font-smoothing: antialiased;
        }
        img { max-width: 100%; display: block; }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; margin: 0; padding: 0; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
        :focus-visible { outline: 3px solid var(--amber); outline-offset: 2px; border-radius: 6px; }

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
        .brand span { font-family: var(--font-display); font-weight: 800; font-stretch: 90%; font-size: 1.05rem; letter-spacing: -0.01em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 0; }

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
           KONTEN UTAMA & KOMPONEN CRUD
           ========================================================== */
        .content { flex: 1; min-width: 0; padding: clamp(20px, 3vw, 40px) clamp(18px, 3vw, 44px) 60px; }

        .page-head h1 { font-family: var(--font-display); font-weight: 800; font-stretch: 88%; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.15; letter-spacing: -0.02em; margin-bottom: 0; }
        .page-head p { margin-top: 6px; color: var(--steel); font-size: .95rem; margin-bottom: 0;}

        /* Card Container & Table Customization */
        .card-container { background: #fff; border-radius: var(--r-md); border: 1px solid var(--line); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); padding: 25px; }
        .table th { white-space: nowrap; font-size: 0.85rem; text-transform: uppercase; color: var(--steel); font-family: var(--font-body); }
        .table td { white-space: nowrap; font-size: 0.9rem; vertical-align: middle; }
        
        /* Modal Custom Styling */
        .modal-header { background-color: var(--ink); color: #fff; border-bottom: none; }
        .modal-header .btn-close { filter: invert(1) grayscale(100%) brightness(200%); }
        .section-title { font-size: 0.95rem; font-weight: 700; color: var(--signal); border-bottom: 2px solid var(--line); padding-bottom: 8px; margin-bottom: 15px; margin-top: 20px; text-transform: uppercase; letter-spacing: 0.03em;}
        .form-label { font-size: 0.85rem; font-weight: 600; color: var(--ink-2); }
        .btn-tambah { background-color: var(--signal); color: #fff; border: none; padding: 10px 20px; border-radius: 999px; font-weight: 600; transition: 0.2s; }
        .btn-tambah:hover { background-color: var(--signal-d); color: #fff; }
    </style>
</head>
<body>

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
                    <a href="/internal/pencegahan/kelola-edukasi" class="{{ Request::is('internal/pencegahan/kelola-edukasi*') ? 'active' : '' }}"><i class="fas fa-bullhorn"></i> Kelola Edukasi</a>
                    <a href="/internal/pencegahan/kelola-redkar" class="{{ Request::is('internal/pencegahan/kelola-redkar*') ? 'active' : '' }}"><i class="fas fa-users"></i> Kelola Redkar</a>
                    <a href="/internal/pencegahan/kelola-rpkbgl" class="{{ Request::is('internal/pencegahan/kelola-rpkbgl*') ? 'active' : '' }}"><i class="fas fa-building"></i> Kelola RPKBGL</a>
                    <a href="/internal/pencegahan/kelola-skk" class="{{ Request::is('internal/pencegahan/kelola-skk*') ? 'active' : '' }}"><i class="fas fa-shield-halved"></i> Kelola SKK</a>
                </div>
            </details>

            <details class="side-group" {{ Request::is('internal/damtan*') ? 'open' : '' }}>
                <summary>Bagian pemadaman <i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/damtan/input-data" class="{{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Input data</a>
                    <a href="/internal/damtan/data-laporan" class="{{ Request::is('internal/damtan/data-laporan*') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> Data laporan</a>
                </div>
            </details>

            <!-- AKORDION KEPEGAWAIAN (MENGGUNAKAN STYLE BAWAAN DASHBOARD) -->
            <details class="side-group" {{ Request::is('internal/kepegawaian*') ? 'open' : '' }}>
                <summary>Kepegawaian <i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/kepegawaian/duk" class="{{ Request::is('internal/kepegawaian/duk*') ? 'active' : '' }}">
                        <i class="fas fa-users-tie"></i> Data Urut Kepegawaian
                    </a>
                </div>
            </details>

            <details class="side-group" {{ Request::is('sapra*') ? 'open' : '' }}>
                <summary>Bagian sapra <i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <span class="side-kicker" style="padding-left:2px;">Sarana &amp; Prasarana</span>
                    <a href="/sapra/sarana-penyelamatan" class="{{ Request::is('sapra/sarana-penyelamatan*') ? 'active' : '' }}"><i class="fas fa-life-ring"></i> Sarana penyelamatan & Evakuasi</a>
                    <a href="/sapra/sarana-pemeriksaan" class="sidebar-item"><i class="fas fa-search"></i> Sarana Pemeriksaan Proteksi</a> 
                    <a href="/sapra/kelola-pos" class="{{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}"><i class="fas fa-warehouse"></i> Kelola data pos</a>

                    <span class="side-kicker" style="padding-left:2px;">Manajemen air</span>
                    <a href="/sapra/data_hidrant_gedung" class="{{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}"><i class="fas fa-droplet"></i> Sumber air</a>
                    <a href="/sapra/data-hidrant-kota" class="{{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}"><i class="fas fa-map-marker-alt"></i> Data hidrant Kota Jambi</a>

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

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
            <div class="page-head mb-0">
                <h1>Daftar Urut Kepangkatan (DUK)</h1>
                <p>Manajemen data pegawai, kepangkatan, jabatan, dan pendidikan.</p>
            </div>
            <button type="button" class="btn-tambah" data-bs-toggle="modal" data-bs-target="#modalPegawai">
                <i class="fas fa-plus me-1"></i> Tambah Data Pegawai
            </button>
        </div>

        <div class="card-container">
            <!-- Tabel Responsif -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" width="5%">No. Urut</th>
                            <th>NIP</th>
                            <th>Nama Lengkap</th>
                            <th>Pangkat / Gol. Ruang</th>
                            <th>Jabatan</th>
                            <th>Masa Kerja</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Status Pegawai</th>
                            <th class="text-center" width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pegawais ?? [] as $pegawai)
                        <tr>
                            <td class="text-center fw-bold">{{ $pegawai->no_urut }}</td>
                            <td class="fw-bold">{{ $pegawai->nip }}</td>
                            <td>{{ $pegawai->nama }}</td>
                            <td>
                                {{ $pegawai->pangkat_gol_ruang }}<br>
                                <small class="text-muted">TMT: {{ $pegawai->pangkat_tmt }}</small>
                            </td>
                            <td>
                                {{ $pegawai->jabatan_nama }}<br>
                                <small class="text-muted">TMT: {{ $pegawai->jabatan_tmt }}</small>
                            </td>
                            <td>{{ $pegawai->masa_kerja_th }} Thn, {{ $pegawai->masa_kerja_bln }} Bln</td>
                            <td>
                                {{ $pegawai->pendidikan_tingkat_ijazah }} - {{ $pegawai->pendidikan_nama }}<br>
                                <small class="text-muted">Lulus: {{ $pegawai->pendidikan_tahun_lulus }}</small>
                            </td>
                            <td>
                                @if($pegawai->status_pegawai == 'Aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @elseif($pegawai->status_pegawai == 'Cuti')
                                    <span class="badge bg-warning text-dark">Cuti</span>
                                @elseif($pegawai->status_pegawai == 'Pensiun')
                                    <span class="badge bg-secondary">Pensiun</span>
                                @else
                                    <span class="badge bg-info">{{ $pegawai->status_pegawai }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></button>
                                <form action="#" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus pegawai ini?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open mb-3" style="font-size: 2rem; opacity: 0.5;"></i><br>
                                Belum ada data pegawai. Silakan tambah data baru.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

<!-- ==================== MODAL TAMBAH PEGAWAI ==================== -->
<div class="modal fade" id="modalPegawai" tabindex="-1" aria-labelledby="modalPegawaiLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalPegawaiLabel"><i class="fas fa-user-edit me-2 text-warning"></i> Form Data Pegawai (DUK)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Sesuaikan action route dengan controller Anda nanti, misalnya route('pegawai.store') -->
            <form action="#" method="POST">
                @csrf
                <div class="modal-body bg-light">
                    <div class="card border-0 shadow-sm p-4">
                        
                        <!-- 1. DATA PRIBADI -->
                        <div class="section-title mt-0"><i class="fas fa-id-card me-2"></i> Data Pribadi</div>
                        <div class="row g-3">
                            <div class="col-md-2">
                                <label class="form-label">No. Urut DUK</label>
                                <input type="number" name="no_urut" class="form-control" placeholder="Cth: 1">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">NIP <span class="text-danger">*</span></label>
                                <input type="text" name="nip" class="form-control" required placeholder="18 Digit NIP">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap (Beserta Gelar) <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control" required placeholder="Cth: Ir. Soekarno, M.Sc.">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tempat, Tanggal Lahir</label>
                                <input type="text" name="tempat_tanggal_lahir" class="form-control" placeholder="Cth: Jambi, 17 Agustus 1980">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select">
                                    <option value="">Pilih...</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Status Pegawai</label>
                                <select name="status_pegawai" class="form-select">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Cuti">Cuti</option>
                                    <option value="Pensiun">Pensiun</option>
                                    <option value="Pindah">Pindah Instansi</option>
                                </select>
                            </div>
                        </div>

                        <!-- 2. KEPANGKATAN & JABATAN -->
                        <div class="section-title"><i class="fas fa-medal me-2"></i> Kepangkatan & Jabatan</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Pangkat / Golongan Ruang</label>
                                <input type="text" name="pangkat_gol_ruang" class="form-control" placeholder="Cth: Penata Tk. I / III/d">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">TMT Pangkat</label>
                                <input type="date" name="pangkat_tmt" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Nama Jabatan</label>
                                <input type="text" name="jabatan_nama" class="form-control" placeholder="Cth: Kepala Bidang Pencegahan">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">TMT Jabatan</label>
                                <input type="date" name="jabatan_tmt" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Masa Kerja (Tahun)</label>
                                <div class="input-group">
                                    <input type="number" name="masa_kerja_th" class="form-control">
                                    <span class="input-group-text">Thn</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Masa Kerja (Bulan)</label>
                                <div class="input-group">
                                    <input type="number" name="masa_kerja_bln" class="form-control">
                                    <span class="input-group-text">Bln</span>
                                </div>
                            </div>
                        </div>

                        <!-- 3. PENDIDIKAN -->
                        <div class="section-title"><i class="fas fa-graduation-cap me-2"></i> Pendidikan Formal</div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Tingkat Ijazah</label>
                                <select name="pendidikan_tingkat_ijazah" class="form-select">
                                    <option value="">Pilih...</option>
                                    <option value="SMA/SMK">SMA/SMK</option>
                                    <option value="D3">D3</option>
                                    <option value="D4/S1">D4 / S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Jurusan / Pendidikan</label>
                                <input type="text" name="pendidikan_nama" class="form-control" placeholder="Cth: Ilmu Pemerintahan">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Tahun Lulus</label>
                                <input type="text" name="pendidikan_tahun_lulus" class="form-control" placeholder="Cth: 2012">
                            </div>
                        </div>

                        <!-- 4. DIKLAT / LATIHAN JABATAN -->
                        <div class="section-title"><i class="fas fa-chalkboard-teacher me-2"></i> Diklat / Latihan Jabatan</div>
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label class="form-label">Nama Latihan Jabatan</label>
                                <input type="text" name="latihan_jabatan_nama" class="form-control" placeholder="Cth: Diklat PIM III">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Tahun Lulus</label>
                                <input type="text" name="latihan_jabatan_tahun_lulus" class="form-control" placeholder="Cth: 2015">
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">Tempat Latihan</label>
                                <input type="text" name="latihan_jabatan_tempat" class="form-control" placeholder="Cth: BPSDM Provinsi Jambi">
                            </div>
                        </div>

                        <!-- 5. CATATAN TAMBAHAN -->
                        <div class="section-title"><i class="fas fa-clipboard-list me-2"></i> Lain-lain</div>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Catatan Mutasi Pegawai</label>
                                <textarea name="catatan_mutasi_pegawai" class="form-control" rows="3" placeholder="Tuliskan riwayat mutasi atau catatan tambahan di sini..."></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-tambah"><i class="fas fa-save me-1"></i> Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
    'use strict';

    /* ---------- Sidebar (mobile) ---------- */
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
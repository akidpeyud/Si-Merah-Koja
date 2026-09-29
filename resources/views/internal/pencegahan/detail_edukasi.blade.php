<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Detail Permohonan Edukasi | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
/* ==========================================================
   SIMERAH KOJA - CLEAN NAVY DASHBOARD (GLOBAL)
   ========================================================== */
:root {
    --ink: #0d1b2a;
    --ink-2: #132a43;
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
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: var(--font-body); font-size: 1rem; line-height: 1.6; color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased; }
img { max-width: 100%; display: block; }
a { color: inherit; text-decoration: none; }
ul, ol { list-style: none; margin: 0; padding: 0; }
button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }

/* ==========================================================
   TOPBAR
   ========================================================== */
.topbar { position: sticky; top: 0; z-index: 60; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
.topbar-left { display: flex; align-items: center; gap: 14px; }
.side-toggle { display: none; width: 40px; height: 40px; border-radius: 10px; align-items: center; justify-content: center; font-size: 1.05rem; color: #fff; transition: background .2s; }
.brand { display: flex; align-items: center; gap: 12px; color: #fff; }
.brand img { height: 34px; width: auto; }
.brand span { font-family: var(--font-display); font-weight: 700; font-size: 1.08rem; letter-spacing: -.01em; color: #fff; }
.topbar-right { display: flex; align-items: center; gap: 12px; }
.user-chip { display: flex; align-items: center; gap: 10px; padding: 5px 14px 5px 5px; border-radius: 999px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); }
.user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #ffffff; color: var(--ink); display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; }
.user-meta { display: grid; line-height: 1.25; }
.user-meta strong { font-size: .84rem; font-weight: 700; color: #ffffff; }
.user-meta small { font-size: .72rem; color: rgba(255,255,255,.62); text-transform: capitalize; font-weight: 500; }
.btn-logout { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #ffffff; color: var(--ink); font-weight: 600; font-size: .84rem; border: none; transition: background .2s; }
.btn-logout:hover { background: #e8eef5; }

@media (max-width: 900px) {
    .side-toggle { display: inline-flex; }
    .user-meta { display: none; }
}

/* ==========================================================
   SIDEBAR LENGKAP
   ========================================================== */
.shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
.sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: var(--line) transparent; }
.sidebar::-webkit-scrollbar { width: 6px; }
.sidebar::-webkit-scrollbar-track { background: transparent; }
.sidebar::-webkit-scrollbar-thumb { background-color: var(--line); border-radius: 20px; }

.side-link { display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .89rem; font-weight: 600; color: var(--ink); transition: background .2s; margin-bottom: 4px; }
.side-link:hover { background: #f3f6fa; }
.side-link.active { background: var(--ink); color: #ffffff; }
.side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); }
.side-link.active i { color: #ffffff; }
.side-group + .side-group { margin-top: 6px; }
.side-group summary { list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--navy); }
.side-group summary::-webkit-details-marker { display: none; }
.side-group summary:hover { background: #f3f6fa; }
.side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; }
.side-group summary .grp-label { flex: 1 1 auto; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; }
.side-group[open] summary .chev { transform: rotate(180deg); }
.side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
.side-sub a { display: flex; align-items: center; gap: 12px; padding: 9px 12px; border-radius: var(--r-sm); font-size: .84rem; font-weight: 500; color: var(--steel); transition: background .2s, color .2s; }
.side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); transform: translateX(2px); }
.side-sub a.active { background: var(--navy-soft); color: var(--navy); font-weight: 600; }
.side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; }
.side-sub a:hover i, .side-sub a.active i { opacity: 1; }
.side-kicker { padding: 18px 14px 6px; font-size: .68rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--steel-soft); }

@media (max-width: 900px) {
    .sidebar { position: fixed; z-index: 90; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s; }
    body.side-open .sidebar { transform: none; }
    .sidebar-backdrop { display: none; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80; background: rgba(13,27,42,.45); }
    body.side-open .sidebar-backdrop { display: block; }
}

/* ==========================================================
   KONTEN UTAMA & DETAIL DATA
   ========================================================== */
.content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
.btn-back { display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 16px; border-radius: 8px; color: var(--steel); font-weight: 600; font-size: .88rem; transition: background .2s, color .2s; margin-bottom: 24px; text-decoration: none; }
.btn-back:hover { background: #e2e8f0; color: var(--ink); }

.page-head { margin-bottom: 26px; }
.page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; color: var(--ink); margin: 0; }

.btn-print-rekap { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; background: var(--navy); color: #fff; border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s; border: none; cursor: pointer; }
.btn-print-rekap:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); }

.content-card { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 32px; box-shadow: var(--shadow-xs); }

/* Detail Section Styling */
.detail-section { margin-bottom: 32px; }
.detail-section:last-child { margin-bottom: 0; }
.detail-title { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; color: var(--ink); border-bottom: 1px solid var(--line); padding-bottom: 8px; }
.detail-title i { width: 34px; height: 34px; border-radius: 10px; display: grid; place-items: center; background: #eef2ff; color: #4f46e5; font-size: .85rem; }

.detail-label { font-size: .8rem; font-weight: 700; color: var(--steel-soft); text-transform: uppercase; letter-spacing: .04em; margin-bottom: 4px; }
.detail-value { font-size: .98rem; font-weight: 600; color: var(--ink); margin-bottom: 20px; line-height: 1.5; }

/* Status Badges */
.badge-status { display: inline-flex; align-items: center; padding: 6px 14px; border-radius: 6px; font-size: .8rem; font-weight: 700; text-transform: uppercase; letter-spacing: .02em; background: rgba(244, 183, 64, .15); color: #d97706; }

/* Attachment Link */
.attachment-box { display: inline-flex; align-items: center; gap: 12px; padding: 12px 18px; border-radius: 8px; background: var(--paper); border: 1px solid var(--line); color: var(--ink); font-weight: 600; font-size: .88rem; transition: all .2s; text-decoration: none; }
.attachment-box:hover { background: #ffffff; border-color: var(--line-dark); box-shadow: var(--shadow-xs); }
.attachment-box i { font-size: 1.2rem; color: var(--signal); }

/* Kop Surat Resmi Print (Tersembunyi saat di Web) */
.print-kop { display: none; }

/* ==========================================================
   CETAK DOKUMEN (PRINT STYLES - 1 HALAMAN PAS / FIT TO 1 PAGE)
   ========================================================== */
@media print {
    @page { 
        size: A4; 
        margin: 12mm 15mm; /* Mengurangi margin kertas agar area cetak lebih luas */
    }
    
    .topbar, .sidebar, .sidebar-backdrop, .btn-back, .btn-print-rekap, .no-print { 
        display: none !important; 
    }
    .shell { display: block !important; }
    .content { padding: 0 !important; margin: 0 !important; background: white !important; width: 100% !important; }
    .content-card { border: none !important; box-shadow: none !important; padding: 0 !important; margin: 0 !important; background: white !important; }
    
    /* Kop Surat Resmi Ringkas (Agar Hemat Ruang) */
    .print-kop {
        display: flex !important;
        align-items: center;
        justify-content: space-between;
        border-bottom: 2.5px double #000;
        padding-bottom: 8px;
        margin-bottom: 14px;
        text-align: center;
    }
    .print-kop img {
        height: 55px;
        width: auto;
    }
    .print-kop .kop-text h4 {
        font-size: 11px;
        font-weight: bold;
        text-transform: uppercase;
        margin: 0;
        color: #000;
    }
    .print-kop .kop-text h2 {
        font-size: 13px;
        font-weight: 900;
        text-transform: uppercase;
        margin: 2px 0;
        color: #000;
    }
    .print-kop .kop-text p {
        font-size: 8.5px;
        margin: 0;
        color: #000;
        line-height: 1.2;
    }
    
    .page-head { text-align: center; margin-bottom: 12px !important; display: block !important; }
    .page-head h1 { font-size: 13px !important; font-weight: bold !important; text-transform: uppercase; text-decoration: underline; margin: 0 !important; }
    
    /* Pengecilan Jarak Antar Section agar Pas 1 Halaman */
    .detail-section { margin-bottom: 10px !important; }
    .detail-title { 
        color: #000 !important; 
        border-bottom: 1px solid #000 !important; 
        font-size: 10.5px !important; 
        font-weight: bold !important; 
        margin-bottom: 6px !important; 
        padding-bottom: 2px !important; 
    }
    .detail-title i { display: none !important; }
    
    .detail-label { color: #444 !important; font-size: 9px !important; font-weight: bold !important; margin-bottom: 1px !important; }
    .detail-value { color: #000 !important; font-size: 10px !important; margin-bottom: 6px !important; }
    .badge-status { border: 1px solid #000; background: transparent !important; color: #000 !important; padding: 1px 6px; font-size: 9px; }

    /* Area Tanda Tangan Ringkas di Bawah */
    .print-signature {
        display: flex !important;
        justify-content: flex-end;
        margin-top: 15px !important;
    }
    .signature-box {
        text-align: center;
        width: 210px;
        font-size: 9.5px;
    }
    .signature-space {
        height: 45px; /* Ruang tanda tangan basah */
    }
}
    </style>
</head>
<body>

<!-- ==================== TOPBAR ==================== -->
<header class="topbar">
    <div class="topbar-left">
        <button class="side-toggle" type="button" id="sideToggle" aria-label="Buka menu">
            <i class="fas fa-bars"></i>
        </button>
        <a href="/internal/index" class="brand">
            <img src="/images/simerahkoja.png" alt="Logo SIMERAH KOJA">
            <span>SIMERAH KOJA</span>
        </a>
    </div>
    <div class="topbar-right">
        <div class="user-chip">
            <span class="user-avatar">{{ strtoupper(substr(Auth::user()->nama_lengkap ?? 'M', 0, 1)) }}</span>
            <div class="user-meta">
                <strong>{{ Auth::user()->nama_lengkap ?? 'Rekan Kerja' }}</strong>
                <small>{{ str_replace('_', ' ', Auth::user()->role ?? 'Pegawai') }}</small>
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
            <i class="fas fa-house"></i> Dashboard utama
        </a>

        @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')

            <div class="side-kicker">Modul operasional</div>

            <details class="side-group" {{ Request::is('internal/pencegahan*') ? 'open' : '' }}>
                <summary><i class="fas fa-shield-halved grp-ico"></i><span class="grp-label">Bagian pencegahan</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/pencegahan/peningkatan-kapasitas"><i class="fas fa-arrow-trend-up"></i> Peningkatan Kapasitas Aparatur</a>
                    <a href="/internal/pencegahan/inspeksi-kebakaran"><i class="fas fa-magnifying-glass-chart"></i> Pencegahan & Inspeksi</a>
                    <a href="/internal/pencegahan/pemberdayaan-masyarakat"><i class="fas fa-handshake-angle"></i> Pemberdayaan Masyarakat</a>
                    <!-- Menu Kelola Edukasi aktif -->
                    <a href="/internal/pencegahan/kelola-edukasi" class="active"><i class="fas fa-bullhorn"></i> Kelola Edukasi</a>
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
                </div>
            </details>
        @endif

        <div class="side-kicker">Akun</div>
        <details class="side-group">
            <summary><i class="fas fa-user-gear grp-ico"></i><span class="grp-label">Pengaturan akun</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="/internal/profil"><i class="fas fa-user-pen"></i> Profil Saya</a>
            </div>
        </details>
    </aside>

    <!-- ==================== KONTEN UTAMA ==================== -->
    <main class="content">
        
        <a href="/internal/pencegahan/kelola-edukasi" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Kelola Edukasi
        </a>

        <div class="page-head d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h1>Rincian Permohonan Kunjungan Edukasi</h1>
            
            <button onclick="window.print()" class="btn-print-rekap no-print">
                <i class="fas fa-print"></i> Cetak Dokumen
            </button>
        </div>

        <div class="content-card">
            
            <!-- KOP SURAT RESMI (Hanya Muncul Saat Dicetak) -->
            <div class="print-kop">
                <img src="/images/jambi.png" alt="Logo Pemkot">
                <div class="kop-text">
                    <h4>Pemerintah Kota Jambi</h4>
                    <h2>Dinas Pemadam Kebakaran dan Penyelamatan</h2>
                    <p>Jl. Jenderal Basuki Rahmat No.mor 41, Paal Lima, Kec. Kota Baru, Kota Jambi, Jambi 36129</p>
                </div>
                <img src="/images/logo.png" alt="Logo Damkar">
            </div>

            <!-- JUDUL DOKUMEN CETAK -->
            <div class="page-head d-none d-print-block text-center mb-4">
                <h1>Lembar Verifikasi Permohonan Kunjungan Edukasi &amp; Sosialisasi</h1>
            </div>

            <!-- SECTION 1: DATA INSTITUSI -->
            <div class="detail-section">
                <div class="detail-title">
                    <i class="fas fa-building"></i> Data Institusi
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="detail-label">Nama Institusi / Sekolah</div>
                        <div class="detail-value">{{ $edukasi->institusi }}</div>
                    </div>
                    <div class="col-md-12">
                        <div class="detail-label">Alamat Lengkap</div>
                        <div class="detail-value">{{ $edukasi->alamat_institusi }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">Kecamatan</div>
                        <div class="detail-value">{{ $edukasi->kecamatan }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">Kelurahan</div>
                        <div class="detail-value">{{ $edukasi->kelurahan }}</div>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: DATA PENANGGUNG JAWAB -->
            <div class="detail-section">
                <div class="detail-title" style="color: #059669;">
                    <i class="fas fa-user-tie" style="background: #ecfdf5; color: #059669;"></i> Penanggung Jawab &amp; Kegiatan
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-label">Nama Pemohon / PJ</div>
                        <div class="detail-value">{{ $edukasi->nama_pemohon }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">Jabatan</div>
                        <div class="detail-value">{{ $edukasi->jabatan_pemohon }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">NIK KTP</div>
                        <div class="detail-value">{{ $edukasi->nik }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">Nomor WhatsApp / Kontak</div>
                        <div class="detail-value">
                            {{ $edukasi->no_kontak }}
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $edukasi->no_kontak) }}" target="_blank" class="ms-2 badge bg-success text-decoration-none no-print">
                                Hubungi <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">Tanggal Rencana Kegiatan</div>
                        <div class="detail-value">{{ \Carbon\Carbon::parse($edukasi->tgl_kegiatan)->locale('id')->isoFormat('D MMMM Y') }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">Status Permohonan</div>
                        <div class="detail-value">
                            <span class="badge-status">{{ $edukasi->status_permohonan ?? 'Pending' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 3: JUMLAH PESERTA -->
            <div class="detail-section">
                <div class="detail-title" style="color: #4b5563;">
                    <i class="fas fa-users" style="background: #f3f4f6; color: #4b5563;"></i> Perkiraan Jumlah Peserta
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="detail-label">Usia 3 - 6 Tahun</div>
                        <div class="detail-value">{{ $edukasi->usia_3_6 }} Orang</div>
                    </div>
                    <div class="col-md-3">
                        <div class="detail-label">Usia 7 - 12 Tahun</div>
                        <div class="detail-value">{{ $edukasi->usia_7_12 }} Orang</div>
                    </div>
                    <div class="col-md-3">
                        <div class="detail-label">Usia 13 - 18 Tahun</div>
                        <div class="detail-value">{{ $edukasi->usia_13_18 }} Orang</div>
                    </div>
                    <div class="col-md-3">
                        <div class="detail-label">Usia &gt; 18 Tahun</div>
                        <div class="detail-value">{{ $edukasi->usia_18_keatas }} Orang</div>
                    </div>
                </div>
            </div>

            <!-- SECTION 4: BERKAS LAMPIRAN -->
            <div class="detail-section no-print">
                <div class="detail-title" style="color: #2563eb;">
                    <i class="fas fa-folder-open" style="background: #eff6ff; color: #2563eb;"></i> Berkas Lampiran
                </div>
                <div class="d-flex flex-column gap-2">
                    @if($edukasi->surat_permohonan)
                        <a href="{{ asset('storage/' . $edukasi->surat_permohonan) }}" target="_blank" class="attachment-box">
                            <i class="fas fa-file-pdf"></i>
                            <div>
                                <div>Surat Permohonan</div>
                                <small class="text-muted fw-normal" style="font-size: 11px;">Berkas Wajib</small>
                            </div>
                        </a>
                    @else
                        <span class="text-muted" style="font-size: 13px;">- Tidak ada berkas surat permohonan -</span>
                    @endif
                </div>
            </div>

            <!-- TANDA TANGAN CETAK RESMI (Hanya Muncul Saat Dicetak) -->
            <div class="print-signature">
                <div class="signature-box">
                    <div>Jambi, {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}</div>
                    <div style="font-weight: bold; margin-top: 2px;">An. Kepala Dinas Pemadam Kebakaran<br>dan Penyelamatan Kota Jambi</div>
                    <div class="signature-space"></div>
                    <div style="font-weight: bold; text-decoration: underline;">_______________________________</div>
                    <div>NIP. ___________________________</div>
                </div>
            </div>

        </div>

    </main>
</div>

<script>
(function () {
    'use strict';
    var toggle = document.getElementById('sideToggle');
    var backdrop = document.getElementById('sideBackdrop');

    function closeSide() { document.body.classList.remove('side-open'); }
    if (toggle) {
        toggle.addEventListener('click', function () { document.body.classList.toggle('side-open'); });
    }
    if (backdrop) backdrop.addEventListener('click', closeSide);
    
    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) { groups.forEach(function (o) { if (o !== g) o.open = false; }); }
        });
    });
})();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
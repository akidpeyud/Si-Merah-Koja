<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Kelola Perizinan RPKBGL | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
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
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: var(--font-body); font-size: 1rem; line-height: 1.6; color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased; }
img { max-width: 100%; display: block; }
a { color: inherit; text-decoration: none; }
ul, ol { list-style: none; margin: 0; padding: 0; }
button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
:focus-visible { outline: 3px solid var(--amber); outline-offset: 2px; border-radius: 6px; }

/* ==========================================================
   TOPBAR & SIDEBAR (IDENTIK DENGAN PROFIL)
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

.shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
.sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; }
.side-link { display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .89rem; font-weight: 600; color: var(--ink); transition: background .2s; margin-bottom: 4px; }
.side-link:hover { background: #f3f6fa; }
.side-link.active { background: var(--ink); color: #ffffff; }
.side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); }
.side-link.active i { color: #ffffff; }
.side-group + .side-group { margin-top: 6px; }
.side-group summary { list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--navy); }
.side-group summary::-webkit-details-marker { display: none; }
.side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; }
.side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; }
.side-group[open] summary .chev { transform: rotate(180deg); }
.side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
.side-sub a { display: flex; align-items: center; gap: 12px; padding: 9px 12px; border-radius: var(--r-sm); font-size: .84rem; font-weight: 500; color: var(--steel); transition: background .2s, color .2s; }
.side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); }
.side-sub a.active { background: var(--navy-soft); color: var(--navy); font-weight: 600; }
.side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; }
.side-sub a:hover i, .side-sub a.active i { opacity: 1; }
.side-kicker { padding: 18px 14px 6px; font-size: .68rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--steel-soft); }

@media (max-width: 900px) {
    .side-toggle { display: inline-flex; }
    .user-meta { display: none; }
    .sidebar { position: fixed; z-index: 90; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s; }
    body.side-open .sidebar { transform: none; }
    .sidebar-backdrop { display: none; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80; background: rgba(13,27,42,.45); }
    body.side-open .sidebar-backdrop { display: block; }
}

/* ==========================================================
   MAIN CONTENT (KELOLA RPKBGL)
   ========================================================== */
.content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
.page-head { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 26px; gap: 16px; flex-wrap: wrap; }
.page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
.page-head p { color: var(--steel); font-size: .95rem; }

.btn-print-rekap { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; background: var(--navy); color: #fff; border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s; }
.btn-print-rekap:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); }

.content-card { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 24px; box-shadow: var(--shadow-xs); overflow: hidden; }

/* Table Styles */
.table { margin-bottom: 0; }
.table > :not(caption) > * > * { padding: 14px 16px; border-bottom-color: var(--line); color: var(--ink); font-size: .92rem; vertical-align: middle; }
.table thead th { font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); background: var(--paper); border-bottom: 2px solid var(--line-dark); }
.table tbody tr { transition: background .2s; }
.table tbody tr:hover { background: #f8fafc; }

/* Status Badges */
.badge-status { display: inline-flex; align-items: center; padding: 5px 12px; border-radius: 6px; font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .02em; }
.status-pending { background: rgba(244, 183, 64, .15); color: #d97706; }
.status-diproses { background: var(--info-soft); color: var(--info); }
.status-memenuhi { background: rgba(25, 135, 84, .15); color: var(--success); }
.status-tidak { background: var(--signal-soft); color: var(--signal-dark); }

/* Action Buttons In Table */
.btn-action-group { display: flex; flex-direction: column; gap: 6px; }
.btn-action { display: inline-flex; align-items: center; justify-content: center; gap: 6px; padding: 6px 12px; border-radius: 6px; font-size: .8rem; font-weight: 600; transition: all .2s; text-decoration: none; border: none; }
.btn-lihat { background: var(--info-soft); color: var(--info); }
.btn-lihat:hover { background: var(--info); color: #ffffff; }
.btn-update { background: var(--navy-soft); color: var(--navy); }
.btn-update:hover { background: var(--navy); color: #ffffff; }

.attachment-link { display: inline-flex; align-items: center; gap: 6px; font-size: .82rem; color: var(--info); font-weight: 500; text-decoration: none; margin-bottom: 4px; transition: color .2s; }
.attachment-link:hover { color: var(--navy-dark); text-decoration: underline; }

/* Print Media */
@media print {
    .topbar, .sidebar, .btn-print-rekap, .no-print-col, .page-head p { display: none !important; }
    .content { padding: 0; background: white; }
    .content-card { padding: 0; border: none; box-shadow: none; }
    .page-head h1 { font-size: 1.5rem; text-align: center; width: 100%; margin-bottom: 20px; }
    .table thead th { background: transparent; color: #000; border-bottom: 2px solid #000; }
    .table td, .table th { border-color: #ddd; color: #000; font-size: .8rem; }
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
    <aside class="sidebar" id="sidebar">
        <a href="/internal/index" class="side-link">
            <i class="fas fa-house"></i> Dashboard utama
        </a>

        @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
            <div class="side-kicker">Modul operasional</div>
            
            <!-- BAGIAN PENCEGAHAN (Terbuka & Aktif) -->
            <details class="side-group" open>
                <summary><i class="fas fa-shield-halved grp-ico"></i><span class="grp-label">Bagian pencegahan</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/pencegahan/peningkatan-kapasitas"><i class="fas fa-arrow-trend-up"></i> Peningkatan Kapasitas</a>
                    <a href="/internal/pencegahan/inspeksi-kebakaran"><i class="fas fa-magnifying-glass-chart"></i> Pencegahan & Inspeksi</a>
                    <a href="/internal/pencegahan/pemberdayaan-masyarakat"><i class="fas fa-handshake-angle"></i> Pemberdayaan Masyarakat</a>
                    <a href="/internal/pencegahan/kelola-edukasi"><i class="fas fa-bullhorn"></i> Kelola Edukasi</a>
                    <a href="/internal/pencegahan/kelola-redkar"><i class="fas fa-users-rectangle"></i> Kelola Redkar</a>
                    
                    <!-- MENU AKTIF -->
                    <a href="/internal/pencegahan/kelola-rpkbgl" class="active"><i class="fas fa-building-circle-check"></i> Kelola RPKBGL</a>
                    
                    <a href="/internal/pencegahan/kelola-skk"><i class="fas fa-file-shield"></i> Kelola SKK</a>
                </div>
            </details>

            <!-- BAGIAN PEMADAMAN -->
            <details class="side-group">
                <summary><i class="fas fa-fire-extinguisher grp-ico"></i><span class="grp-label">Bagian pemadaman</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/damtan/input-data"><i class="fas fa-fire-extinguisher"></i> Input data</a>
                    <a href="/internal/surat-korban/create"><i class="fas fa-file-signature"></i> Buat Surat Korban</a>
                    <a href="/internal/damtan/data-laporan"><i class="fas fa-clipboard-list"></i> Kelola Data Laporan</a>
                    <a href="/internal/surat-korban/data"><i class="fas fa-folder"></i> Kelola Surat Korban</a>
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
        <div class="page-head">
            <div>
                <h1>Daftar Permohonan RPKBGL</h1>
                <p>Data pengajuan Rekomendasi Proteksi Kebakaran Bangunan Gedung & Lingkungan.</p>
            </div>
            <button onclick="window.print()" class="btn-print-rekap">
                <i class="fas fa-print"></i> Cetak Rekap
            </button>
        </div>

        <div class="content-card">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Pemohon</th>
                            <th>Nama Usaha</th>
                            <th>Kategori</th>
                            <th>Lokasi Bangunan</th>
                            <th>Status</th>
                            <th class="no-print-col">Berkas Lampiran</th>
                            <th class="text-center no-print-col" style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permohonan as $p)
                        <tr>
                            <td>
                                <strong>{{ $p->created_at->format('d M Y') }}</strong>
                                <div style="font-size: .8rem; color: var(--steel-soft);">{{ $p->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td>
                                <strong style="display: block; margin-bottom: 2px;">{{ $p->nama_pemohon }}</strong>
                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', $p->no_whatsapp) }}" target="_blank" style="font-size: .8rem; color: var(--success); text-decoration: none;">
                                    <i class="fab fa-whatsapp"></i> {{ $p->no_whatsapp }}
                                </a>
                            </td>
                            <td><strong>{{ $p->nama_usaha }}</strong></td>
                            <td>{{ $p->kategori_bangunan }}</td>
                            <td>
                                {{ $p->kecamatan }}<br>
                                <span style="font-size: .8rem; color: var(--steel);">Kel. {{ $p->kelurahan }}</span>
                            </td>
                            <td>
                                @if($p->status_permohonan == 'Pending')
                                    <span class="badge-status status-pending">Pending</span>
                                @elseif($p->status_permohonan == 'Diproses')
                                    <span class="badge-status status-diproses">Diproses Tim</span>
                                @elseif($p->status_permohonan == 'Memenuhi Syarat')
                                    <span class="badge-status status-memenuhi">Memenuhi</span>
                                @else
                                    <span class="badge-status status-tidak">Tidak Memenuhi</span>
                                @endif
                            </td>
                            <td class="no-print-col">
                                @if($p->file_surat_permohonan)
                                    <a href="{{ asset('storage/' . $p->file_surat_permohonan) }}" target="_blank" class="attachment-link d-block">
                                        <i class="fas fa-file-pdf"></i> Surat Permohonan
                                    </a>
                                @endif
                                
                                @if($p->file_persyaratan_lainnya)
                                    <a href="{{ asset('storage/' . $p->file_persyaratan_lainnya) }}" target="_blank" class="attachment-link d-block">
                                        <i class="fas fa-paperclip"></i> Syarat Lainnya
                                    </a>
                                @else
                                    <span style="font-size: .75rem; color: var(--steel-soft);">- Tidak ada tambahan</span>
                                @endif
                            </td>
                            <td class="no-print-col">
                                <div class="btn-action-group">
                                    <a href="/internal/pencegahan/kelola-rpkbgl/{{ $p->id }}" class="btn-action btn-lihat">
                                        <i class="fas fa-search"></i> Detail
                                    </a>
                                    <a href="#" class="btn-action btn-update">
                                        <i class="fas fa-edit"></i> Update
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted" style="font-size: .95rem;">
                                <i class="fas fa-folder-open mb-2" style="font-size: 2rem; color: var(--steel-soft);"></i><br>
                                Belum ada data permohonan RPKBGL yang masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
(function () {
    'use strict';
    /* ---------- Sidebar Mobile Toggle ---------- */
    var toggle = document.getElementById('sideToggle');
    var backdrop = document.getElementById('sideBackdrop');

    function closeSide() {
        document.body.classList.remove('side-open');
    }
    if (toggle) {
        toggle.addEventListener('click', function () {
            document.body.classList.toggle('side-open');
        });
    }
    if (backdrop) backdrop.addEventListener('click', closeSide);
    
    /* ---------- Accordion Sidebar Logic ---------- */
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
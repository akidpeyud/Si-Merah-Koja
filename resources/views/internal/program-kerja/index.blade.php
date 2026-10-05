<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Kelola Program Kerja | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
/* ==========================================================
   SIMERAH KOJA - CLEAN NAVY DASHBOARD
   ========================================================== */

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
ul, ol { list-style: none; margin: 0; padding: 0; }
button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
:focus-visible { outline: 3px solid var(--amber); outline-offset: 2px; border-radius: 6px; }

/* ==========================================================
   TOAST / NOTIFICATION
   ========================================================== */
.toast-wrap { position: fixed; z-index: 2000; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
.toast { display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px; border-radius: 999px; background: #ffffff; border: 1px solid var(--line); box-shadow: var(--shadow-md); font-weight: 600; font-size: .92rem; animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both; }
.toast.leaving { animation: toastOut .3s ease forwards; }
.toast-ico { flex: none; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; color: #fff; font-size: .78rem; }
.toast.ok .toast-ico { background: var(--success); }
.toast.err .toast-ico { background: var(--signal); }
.toast-x { flex: none; width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; }
.toast-x:hover { background: var(--ink); color: #fff; }
@keyframes toastIn { from { opacity: 0; transform: translateY(-14px); } to { opacity: 1; transform: none; } }
@keyframes toastOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(-14px); } }

/* ==========================================================
   TOPBAR
   ========================================================== */
.topbar { position: sticky; top: 0; z-index: 60; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
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

/* ==========================================================
   SHELL & SIDEBAR
   ========================================================== */
.shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
.sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
.sidebar::-webkit-scrollbar { width: 6px; }
.sidebar::-webkit-scrollbar-track { background: transparent; }
.sidebar::-webkit-scrollbar-thumb { background-color: #d8dee8; border-radius: 20px; }

.side-link { display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .89rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s, transform .2s; margin-bottom: 4px; }
.side-link:hover { background: #f3f6fa; color: var(--ink); transform: translateX(1px); }
.side-link.active { background: var(--ink); color: #ffffff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
.side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: color .2s; }
.side-link:hover i { color: var(--ink); }
.side-link.active i { color: #ffffff; }

.side-group + .side-group { margin-top: 6px; }
.side-group summary { list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--navy); transition: background .2s, color .2s; user-select: none; }
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

/* ==========================================================
   MAIN CONTENT (CRUD SPECIFIC)
   ========================================================== */
.content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
.page-head { margin-bottom: 26px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; }
.page-head-text h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
.page-head-text p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }

.base-card {
    background: #ffffff;
    border: 1px solid var(--line);
    border-radius: var(--r-md);
    padding: 26px;
    box-shadow: var(--shadow-xs);
    transition: box-shadow .2s ease;
}
.base-card:hover { box-shadow: var(--shadow-sm); }

.card-title-custom {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 22px; padding-bottom: 14px;
    border-bottom: 1px solid var(--line);
    font-family: var(--font-display);
    font-size: 1.05rem; font-weight: 700; color: var(--ink);
}
.card-title-custom .title-left { display: flex; align-items: center; gap: 10px; }
.card-title-custom .title-left::before {
    content: ""; width: 4px; height: 18px;
    background: var(--navy); border-radius: 4px;
}

/* Custom Table Styles */
.table-responsive { border-radius: var(--r-sm); border: 1px solid var(--line); overflow: hidden; }
.table { margin-bottom: 0; font-size: .92rem; }
.table thead th { 
    background: var(--paper); color: var(--steel); 
    font-size: .8rem; font-weight: 700; text-transform: uppercase; 
    letter-spacing: .04em; border-bottom: 1px solid var(--line-dark);
    padding: 14px 16px;
}
.table tbody td { padding: 14px 16px; vertical-align: middle; border-bottom: 1px solid var(--line); color: var(--ink); }
.table tbody tr:last-child td { border-bottom: none; }
.table tbody tr:hover { background-color: var(--navy-soft); }

.badge-kategori {
    display: inline-flex; align-items: center;
    padding: 5px 12px; border-radius: 6px;
    font-size: .75rem; font-weight: 700; text-transform: uppercase;
    background: var(--navy-soft); color: var(--navy);
}

/* Form Styles */
.form-label { font-size: .88rem; font-weight: 600; color: var(--ink); margin-bottom: 6px; }
.form-control, .form-select {
    min-height: 44px; font-size: .92rem;
    border: 1px solid var(--line-dark);
    border-radius: 8px; color: var(--ink);
    box-shadow: none; transition: all .2s ease;
}
.form-control:focus, .form-select:focus {
    border-color: var(--navy);
    box-shadow: 0 0 0 3px var(--navy-soft);
}
.form-control::file-selector-button {
    background: var(--paper); color: var(--ink);
    border: none; border-right: 1px solid var(--line-dark);
    padding: 0 16px; margin-right: 12px; height: 100%;
    font-weight: 600; transition: background .2s;
}
.form-control::file-selector-button:hover { background: var(--line); }

/* Buttons */
.btn-primary-custom {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    min-height: 44px; padding: 0 20px;
    background: var(--navy); color: #fff;
    border: none; border-radius: 8px;
    font-size: .9rem; font-weight: 600;
    transition: all .2s ease;
}
.btn-primary-custom:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); color: #fff; }

.btn-icon {
    display: inline-flex; align-items: center; justify-content: center;
    width: 34px; height: 34px; border-radius: 6px; border: none;
    font-size: .9rem; transition: all .2s ease;
}
.btn-icon.edit { background: var(--info-soft); color: var(--info); }
.btn-icon.edit:hover { background: var(--info); color: #fff; }
.btn-icon.delete { background: var(--signal-soft); color: var(--signal-dark); }
.btn-icon.delete:hover { background: var(--signal); color: #fff; }

/* Custom Modal */
.modal-content { border: none; border-radius: var(--r-md); box-shadow: var(--shadow-lg); }
.modal-header { border-bottom: 1px solid var(--line); padding: 20px 24px; }
.modal-title { font-family: var(--font-display); font-weight: 700; font-size: 1.2rem; }
.modal-body { padding: 24px; }
.modal-footer { border-top: 1px solid var(--line); padding: 16px 24px; background: var(--paper); border-radius: 0 0 var(--r-md) var(--r-md); }

@media (max-width: 700px) {
    .base-card { padding: 20px; }
    .card-title-custom { flex-direction: column; align-items: flex-start; gap: 14px; }
}
    </style>
</head>
<body>

<!-- BLOK TOAST ERROR HANDLING SUDAH DITAMBAHKAN -->
<div class="toast-wrap" id="toastWrap" aria-live="polite">
    <!-- Notifikasi Sukses -->
    @if(session('success'))
        <div class="toast ok" data-toast>
            <span class="toast-ico"><i class="fas fa-check"></i></span>
            <span>{{ session('success') }}</span>
            <button type="button" class="toast-x" aria-label="Tutup notifikasi" data-toast-close><i class="fas fa-times"></i></button>
        </div>
    @endif

    <!-- Notifikasi Error dari Catch Controller -->
    @if(session('error'))
        <div class="toast err" data-toast>
            <span class="toast-ico"><i class="fas fa-exclamation-triangle"></i></span>
            <span>{{ session('error') }}</span>
            <button type="button" class="toast-x" aria-label="Tutup notifikasi" data-toast-close><i class="fas fa-times"></i></button>
        </div>
    @endif

    <!-- Notifikasi Error dari Validasi Request -->
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="toast err" data-toast>
                <span class="toast-ico"><i class="fas fa-times"></i></span>
                <span>{{ $error }}</span>
                <button type="button" class="toast-x" aria-label="Tutup notifikasi" data-toast-close><i class="fas fa-times"></i></button>
            </div>
        @endforeach
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
            <span class="user-avatar">A</span>
            <div class="user-meta">
                <strong>Admin Website</strong>
                <small>Super User</small>
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
        <a href="/internal/index" class="side-link">
            <i class="fas fa-house"></i> Dashboard utama
        </a>

        <!-- Modul Publik Khusus Dokumen -->
        <div class="side-kicker">Konten publik</div>
        <details class="side-group" open>
            <summary><i class="far fa-newspaper grp-ico"></i><span class="grp-label">Manajemen Web</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <!-- LINK AKTIF UNTUK CRUD DOKUMEN -->
                <a href="/internal/program-kerja" class="active"><i class="fas fa-file-pdf"></i> Kelola Program Kerja</a>
                <a href="/internal/operator/kelola-berita"><i class="far fa-newspaper"></i> Kelola Berita</a>
            </div>
        </details>
        
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
            <div class="page-head-text">
                <h1>Kelola Program Kerja</h1>
                <p>Manajemen file SOTK, SOP, Perencanaan, Pelaporan, dan Produk Hukum untuk publik.</p>
            </div>
            <!-- Tombol Tambah Modal -->
            <button type="button" class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah Dokumen
            </button>
        </div>

        <!-- Tabel Data -->
        <div class="base-card">
            <div class="card-title-custom">
                <div class="title-left">Daftar Dokumen Terpublikasi</div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Judul Dokumen</th>
                            <th width="15%">Kategori</th>
                            <th width="15%">Sub Kategori</th>
                            <th width="15%">File</th>
                            <th width="12%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
    @forelse($dokumen as $index => $item)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td><strong>{{ $item->judul_dokumen }}</strong></td>
        <td><span class="badge-kategori">{{ $item->kategori }}</span></td>
        <td>
            @if($item->sub_kategori)
                {{ $item->sub_kategori }}
            @else
                <span class="text-muted">-</span>
            @endif
        </td>
        <td>
            <a href="/internal/program-kerja/download/{{ $item->id }}" class="text-primary text-decoration-none">
                <i class="fas fa-download"></i> Unduh File
            </a>
        </td>
        <td class="text-center">
            <!-- Form Hapus -->
            <form action="{{ route('program-kerja.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?');">
                @csrf
                @method('DELETE')
                <button type="button" class="btn-icon edit" title="Edit Data"><i class="fas fa-pen"></i></button>
                <button type="submit" class="btn-icon delete" title="Hapus Data"><i class="fas fa-trash"></i></button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6" class="text-center py-4 text-muted">Belum ada dokumen yang diunggah.</td>
    </tr>
    @endforelse
</tbody>
                </table>
            </div>

        </div>

    </main>
</div>

<!-- ==================== MODAL TAMBAH DATA ==================== -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Dokumen Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- ACTION FORM SUDAH DIPERBAIKI -->
            <form action="{{ route('program-kerja.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label class="form-label">Judul Dokumen</label>
                        <input type="text" name="judul_dokumen" class="form-control" placeholder="Contoh: SOP Penanganan Kebakaran 2026" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori Utama</label>
                        <select name="kategori" id="selectKategori" class="form-select" required>
                            <option value="" disabled selected>Pilih Kategori...</option>
                            <option value="SOTK">SOTK</option>
                            <option value="SOP">SOP</option>
                            <option value="Perencanaan">Perencanaan</option>
                            <option value="Pelaporan">Pelaporan</option>
                            <option value="Produk Hukum">Produk Hukum</option>
                        </select>
                    </div>

                    <!-- Input Sub Kategori (Awalnya Disembunyikan via JS) -->
                    <div class="mb-3" id="wrapperSubKategori" style="display: none;">
                        <label class="form-label">Sub Kategori <small class="text-muted">(Khusus SOP)</small></label>
                        <select name="sub_kategori" id="selectSubKategori" class="form-select">
                            <option value="" disabled selected>Pilih Sub Bagian...</option>
                            <option value="Sekretariat">Sekretariat</option>
                            <option value="Sapra">Sapra</option>
                            <option value="Damtan">Damtan</option>
                            <option value="Pencegahan">Pencegahan</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Upload File (PDF/JPG/PNG)</label>
                            <input type="file" name="file_dokumen" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                        <small class="text-muted mt-1 d-block">Maksimal ukuran file 5MB.</small>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal" style="min-height: 44px; border-radius: 8px;">Batal</button>
                    <button type="submit" class="btn-primary-custom">
                        <i class="fas fa-save"></i> Simpan Dokumen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script Bootstrap JS (Wajib untuk Modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
(function () {
    'use strict';

    /* ---------- Notifikasi (Toast) ---------- */
    document.querySelectorAll('[data-toast]').forEach(function (t) {
        var hide = function () {
            t.classList.add('leaving');
            setTimeout(function () { t.remove(); }, 350);
        };
        var x = t.querySelector('[data-toast-close]');
        if (x) x.addEventListener('click', hide);
        // Toast akan tertutup otomatis setelah 5 detik
        setTimeout(hide, 5000);
    });

    /* ---------- Sidebar Mobile Toggle ---------- */
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

    /* ---------- Accordion Sidebar Logic ---------- */
    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) {
                groups.forEach(function (o) { if (o !== g) o.open = false; });
            }
        });
    });

    /* ---------- LOGIK DYNAMIC SUB KATEGORI ---------- */
    var katSelect = document.getElementById('selectKategori');
    var subKatWrapper = document.getElementById('wrapperSubKategori');
    var subKatSelect = document.getElementById('selectSubKategori');

    if(katSelect && subKatWrapper && subKatSelect) {
        katSelect.addEventListener('change', function() {
            // Jika kategori yang dipilih adalah SOP, munculkan dropdown sub kategori
            if(this.value === 'SOP') {
                subKatWrapper.style.display = 'block';
                subKatSelect.setAttribute('required', 'required'); // Wajib diisi
            } else {
                // Jika selain SOP, sembunyikan dan reset value-nya
                subKatWrapper.style.display = 'none';
                subKatSelect.removeAttribute('required');
                subKatSelect.value = ''; // Kosongkan
            }
        });
    }
})();
</script>
</body>
</html>
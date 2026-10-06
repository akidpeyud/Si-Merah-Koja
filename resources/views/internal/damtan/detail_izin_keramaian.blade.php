<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Detail Izin Keramaian | SIMERAH KOJA</title>
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
        /* CSS Root sama dengan kelola_izin_keramaian.blade.php */
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
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; margin: 0; padding: 0; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }

        /* Global Alerts */
        #globalSuccessAlert { position: fixed; top: 30px; left: 50%; transform: translateX(-50%); color: white; padding: 16px 24px; border-radius: var(--r-md); z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; background-color: var(--success); box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .alert-icon { font-size: 22px; }
        .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; }
        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
        @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }

        /* TOPBAR & SIDEBAR (Persis sama dengan index) */
        .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
        .topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .side-toggle { display: none; width: 40px; height: 40px; border-radius: 10px; align-items: center; justify-content: center; font-size: 1.05rem; color: #fff; }
        .brand { display: flex; align-items: center; gap: 12px; min-width: 0; color: #fff; }
        .brand img { height: 34px; width: auto; flex: none; }
        .brand span { font-family: var(--font-display); font-weight: 700; font-size: 1.08rem; letter-spacing: -.01em; color: #fff; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .user-chip { display: flex; align-items: center; gap: 10px; padding: 5px 14px 5px 5px; border-radius: 999px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); color:#fff; }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #ffffff; color: var(--ink); display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
        .user-meta { display: grid; line-height: 1.25; }
        .user-meta strong { font-size: .84rem; font-weight: 700; }
        .user-meta small { font-size: .72rem; opacity: .7; text-transform: capitalize; font-weight: 500; }
        .btn-logout { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #ffffff; color: var(--ink); font-weight: 600; font-size: .84rem; }

        .shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
        .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; }
        
        /* ... Sisa CSS Sidebar persis sama ... */
        .side-link { display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .89rem; font-weight: 600; color: var(--ink); margin-bottom: 4px; }
        .side-link:hover { background: #f3f6fa; }
        .side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); }
        .side-group summary { list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700; text-transform: uppercase; color: var(--navy); }
        .side-group summary::-webkit-details-marker { display: none; }
        .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); }
        .side-group summary .grp-label { flex: 1 1 auto; }
        .side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; }
        .side-group[open] summary .chev { transform: rotate(180deg); }
        .side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
        .side-sub a { display: flex; align-items: center; gap: 12px; padding: 9px 12px; border-radius: var(--r-sm); font-size: .84rem; font-weight: 500; color: var(--steel); }
        .side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); }
        .side-sub a.active { background: var(--navy-soft); color: var(--navy); font-weight: 600; }
        .side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; }
        .side-kicker { padding: 18px 14px 6px; font-size: .68rem; font-weight: 700; text-transform: uppercase; color: var(--steel-soft); }
        @media (max-width: 900px) { .sidebar { position: fixed; z-index: 1010; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s; } body.side-open .sidebar { transform: none; } }

        /* CONTENT */
        .content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
        .page-header { margin-bottom: 28px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; }
        .page-header-text h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
        .page-header-text p { color: var(--steel); font-size: .95rem; margin-bottom: 0;}

        /* Card custom detail */
        .card-custom { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); overflow: hidden; height: 100%;}
        .card-custom .card-header { background: #f8fafc; border-bottom: 1px solid var(--line); padding: 16px 20px; font-weight: 700; color: var(--navy-dark); font-family: var(--font-display);}
        
        .detail-table th { color: var(--steel); font-weight: 600; font-size: 0.9rem; padding: 12px 0;}
        .detail-table td { color: var(--ink); font-weight: 500; font-size: 0.95rem; padding: 12px 0;}
        .detail-table hr { margin: 8px 0; border-color: var(--line); opacity: 1;}

        .btn-custom-outline { display: block; width: 100%; text-align: center; padding: 10px; border-radius: 8px; font-weight: 600; font-size: 0.9rem; transition: all 0.2s; margin-bottom: 15px;}
        .btn-custom-outline.primary { border: 1px solid var(--info); color: var(--info); }
        .btn-custom-outline.primary:hover { background: var(--info-soft); }
        .btn-custom-outline.danger { border: 1px solid var(--signal); color: var(--signal); }
        .btn-custom-outline.danger:hover { background: var(--signal-soft); }

        .btn-custom-fill { display: block; width: 100%; text-align: center; padding: 12px; border-radius: 8px; font-weight: 600; font-size: 0.9rem; transition: all 0.2s; border: none;}
        .btn-custom-fill.primary { background: var(--navy); color: #fff; }
        .btn-custom-fill.primary:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); }
        .btn-custom-fill.secondary { background: var(--line); color: var(--ink-3); margin-top: 10px;}
        .btn-custom-fill.secondary:hover { background: var(--line-dark); }
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

<script>
    function closeAlert(id) {
        let alertBox = document.getElementById(id);
        if(alertBox) {
            alertBox.style.animation = 'fadeOutUpCenter 0.4s ease forwards';
            setTimeout(() => alertBox.remove(), 400); 
        }
    }
    setTimeout(() => closeAlert('globalSuccessAlert'), 4000);
</script>

<header class="topbar">
    <div class="topbar-left">
        <a href="/internal/index" class="brand">
            <img src="/images/simerahkoja.png" alt="Logo">
            <span>SIMERAH KOJA</span>
        </a>
    </div>
    <div class="topbar-right">
        <div class="user-chip">
            <span class="user-avatar">{{ strtoupper(substr(Auth::user()->nama_lengkap ?? 'A', 0, 1)) }}</span>
            <div class="user-meta">
                <strong>{{ Auth::user()->nama_lengkap ?? 'Admin Damkar' }}</strong>
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
    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <a href="/internal/index" class="side-link"><i class="fas fa-house"></i> Dashboard utama</a>

        <div class="side-kicker">Modul operasional</div>
        <!-- PENCEGAHAN (Tutup) -->
        <details class="side-group">
            <summary><i class="fas fa-shield-halved grp-ico"></i><span class="grp-label">Bagian pencegahan</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <!-- ... isi ... -->
            </div>
        </details>

        <!-- PEMADAMAN (Buka - Aktif) -->
        <details class="side-group" open>
            <summary><i class="fas fa-fire-extinguisher grp-ico"></i><span class="grp-label">Bagian pemadaman</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/damtan/input-data"><i class="fas fa-fire-extinguisher"></i><span class="lbl">Input data</span></a>
                    <a href="/internal/damtan/rekap-layanan"><i class="fas fa-truck-medical"></i><span class="lbl">Input Rekap Layanan &amp; Penyelamatan</span></a>
                    <!-- Menu Objek diaktifkan class active nya -->
                    <a href="/internal/damtan/rekap-objek" class="active"><i class="fas fa-house-chimney-crack"></i><span class="lbl">Input Rekap Objek Kebakaran</span></a>
                    <a href="/internal/surat-korban/create"><i class="fas fa-file-signature"></i><span class="lbl">Buat Surat Korban</span></a>
                    <a href="/internal/damtan/data-laporan"><i class="fas fa-clipboard-list"></i><span class="lbl">Kelola Data Laporan</span></a>
                    <a href="/internal/surat-korban/data"><i class="fas fa-folder"></i><span class="lbl">Kelola Surat Korban</span></a>
                    <a href="{{ route('internal.izin-keramaian.index') }}"><i class="fas fa-users-rectangle"></i><span class="lbl">Kelola Surat Keramaian</span></a>
                </div>
        </details>
        <!-- ... Sisa Sidebar ... -->
    </aside>

    <main class="content">
        <div class="page-header">
            <div class="page-header-text">
                <h1>Detail Pemohon</h1>
                <p>Informasi lengkap pengajuan rekomendasi izin keramaian masyarakat.</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Kolom Detail Teks -->
            <div class="col-lg-8">
                <div class="card-custom h-100">
                    <div class="card-header"><i class="fas fa-list-alt me-2"></i> Data Lengkap Pemohon & Acara</div>
                    <div class="card-body p-4">
                        <table class="detail-table w-100">
                            <tr><th width="35%">Nama Pemohon</th><td>: {{ $permohonan->nama }}</td></tr>
                            <tr><th>NIK</th><td>: {{ $permohonan->nik }}</td></tr>
                            <tr><th>No HP/WA</th><td>: {{ $permohonan->no_hp }}</td></tr>
                            <tr><th>Alamat</th><td>: {{ $permohonan->alamat }}</td></tr>
                            <tr><td colspan="2"><hr></td></tr>
                            <tr><th>Nama Usaha/Instansi</th><td>: {{ $permohonan->nama_usaha }}</td></tr>
                            <tr><th>Nama Direktur/Penanggungjawab</th><td>: {{ $permohonan->nama_direktur }}</td></tr>
                            <tr><th>No Izin Usaha</th><td>: {{ $permohonan->no_izin_usaha }}</td></tr>
                            <tr><td colspan="2"><hr></td></tr>
                            <tr><th>Nama Acara</th><td>: {{ $permohonan->nama_acara }}</td></tr>
                            <tr><th>Lokasi Acara</th><td>: {{ $permohonan->lokasi_acara }}</td></tr>
                            <tr><th>Waktu Pelaksanaan</th><td>: {{ \Carbon\Carbon::parse($permohonan->tgl_pelaksanaan)->format('d F Y') }} <br>&nbsp; Pukul {{ $permohonan->waktu_mulai }} s/d {{ $permohonan->waktu_selesai }} WIB</td></tr>
                            <tr><th>Estimasi Penonton</th><td>: {{ $permohonan->jumlah_penonton }} Orang</td></tr>
                            <tr><td colspan="2"><hr></td></tr>
                            <tr><th>Ketersediaan APAR</th><td>: {{ $permohonan->jumlah_apar }} Buah</td></tr>
                            <tr><th>Staff Terlatih APAR</th><td>: {{ $permohonan->jumlah_staff }} Orang</td></tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Kolom File & Status -->
            <div class="col-lg-4">
                <!-- Box File Lampiran -->
                <div class="card-custom mb-4">
                    <div class="card-header"><i class="fas fa-paperclip me-2"></i> Dokumen Lampiran</div>
                    <div class="card-body p-4">
                        <p class="mb-2 text-muted fw-bold" style="font-size: 0.85rem;">FOTO JALUR EVAKUASI</p>
                        <a href="{{ asset('storage/' . $permohonan->foto_jalur_evakuasi) }}" target="_blank" class="btn-custom-outline primary">
                            <i class="fas fa-image me-2"></i> Buka Foto Jalur
                        </a>

                        <p class="mb-2 text-muted fw-bold mt-4" style="font-size: 0.85rem;">SURAT PERNYATAAN (MATERAI)</p>
                        <a href="{{ asset('storage/' . $permohonan->surat_pernyataan) }}" target="_blank" class="btn-custom-outline danger">
                            <i class="fas fa-file-pdf me-2"></i> Buka Surat PDF
                        </a>
                    </div>
                </div>

                <!-- Box Ubah Status -->
                <div class="card-custom">
                    <div class="card-header"><i class="fas fa-tasks me-2"></i> Verifikasi & Status</div>
                    <div class="card-body p-4 bg-light">
                        <form action="{{ route('internal.izin-keramaian.update_status', $permohonan->id) }}" method="POST">
                            @csrf
                            <label class="fw-bold mb-2 text-dark" style="font-size: 0.9rem;">Ubah Status Berkas:</label>
                            <select name="status_permohonan" class="form-select mb-4">
                                <option value="Pending" {{ $permohonan->status_permohonan == 'Pending' ? 'selected' : '' }}>🟡 Pending (Menunggu Review)</option>
                                <option value="Proses" {{ $permohonan->status_permohonan == 'Proses' ? 'selected' : '' }}>🔵 Proses (Sedang Inspeksi Lapangan)</option>
                                <option value="Disetujui" {{ $permohonan->status_permohonan == 'Disetujui' ? 'selected' : '' }}>🟢 Disetujui (Rekomendasi Terbit)</option>
                                <option value="Ditolak" {{ $permohonan->status_permohonan == 'Ditolak' ? 'selected' : '' }}>🔴 Ditolak (Berkas Tidak Lengkap)</option>
                            </select>
                            
                            <button type="submit" class="btn-custom-fill primary">
                                <i class="fas fa-save me-2"></i> Simpan Status Baru
                            </button>
                            <a href="{{ route('internal.izin-keramaian.index') }}" class="btn-custom-fill secondary">
                                Kembali ke Daftar
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
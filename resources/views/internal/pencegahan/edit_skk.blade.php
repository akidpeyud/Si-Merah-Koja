<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Edit SKK | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --ink: #0d1b2a;
            --navy: #163a63;
            --navy-dark: #0d2947;
            --navy-soft: rgba(22, 58, 99, .08);
            --paper: #f5f7fa;
            --signal: #dc3545;
            --signal-soft: rgba(220, 53, 69, .09);
            --steel: #64748b;
            --line: #e2e8f0;
            --line-dark: #d5dce6;

            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;
            
            --r-md: 14px;
            --r-sm: 10px;
            --topbar-h: 70px;
            --sidebar-w: 272px;

            --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
            --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
            --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-body); background: var(--paper); color: var(--ink); line-height: 1.6; }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; margin: 0; padding: 0; }
        button { border: 0; background: none; font: inherit; cursor: pointer; }
        img { max-width: 100%; display: block; }

        /* Topbar */
        .topbar { position: sticky; top: 0; z-index: 60; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; padding: 0 28px; background: var(--ink); color: #fff; box-shadow: 0 2px 12px rgba(13,27,42,.16); }
        .topbar-left { display: flex; align-items: center; gap: 14px; }
        .side-toggle { display: none; color: #fff; font-size: 1.2rem; }
        .brand { display: flex; align-items: center; gap: 12px; font-family: var(--font-display); font-weight: 700; font-size: 1.1rem; color: #fff; }
        .brand img { height: 34px; }
        .user-chip { display: flex; align-items: center; gap: 10px; padding: 5px 14px 5px 5px; border-radius: 99px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #fff; color: var(--ink); display: grid; place-items: center; font-weight: 700; }
        .user-meta { display: grid; line-height: 1.2; }
        .user-meta strong { font-size: .85rem; }
        .user-meta small { font-size: .7rem; color: rgba(255,255,255,.7); text-transform: capitalize; }
        .btn-logout { background: #fff; color: var(--ink); padding: 8px 16px; border-radius: 99px; font-weight: 600; font-size: .85rem; }

        /* Layout */
        .shell { display: flex; min-height: calc(100vh - var(--topbar-h)); }
        
        /* Sidebar */
        .sidebar { width: var(--sidebar-w); background: #fff; border-right: 1px solid var(--line); padding: 20px 14px; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; flex: none; }
        .side-link { display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .89rem; font-weight: 600; color: var(--ink); margin-bottom: 4px; transition: .2s; }
        .side-link:hover { background: #f3f6fa; }
        .side-link.active { background: var(--ink); color: #fff; }
        .side-link i { width: 20px; text-align: center; color: var(--steel); }
        .side-link.active i { color: #fff; }
        
        .side-group summary { display: flex; align-items: center; gap: 12px; padding: 11px 14px; font-size: .78rem; font-weight: 700; text-transform: uppercase; color: var(--navy); cursor: pointer; list-style: none; }
        .side-group summary::-webkit-details-marker { display: none; }
        .side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
        .side-sub a { display: flex; align-items: center; gap: 12px; padding: 9px 12px; border-radius: var(--r-sm); font-size: .84rem; font-weight: 500; color: var(--steel); }
        .side-sub a.active { background: var(--navy-soft); color: var(--navy); font-weight: 600; }
        .side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); }
        .side-kicker { padding: 18px 14px 6px; font-size: .68rem; font-weight: 700; text-transform: uppercase; color: var(--steel); }

        /* Content */
        .content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px); }
        .page-head { margin-bottom: 26px; }
        .page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.5rem, 3vw, 2rem); margin-bottom: 6px; }
        .page-head p { color: var(--steel); font-size: .95rem; }

        /* Form Card Custom */
        .form-card { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 30px; box-shadow: var(--shadow-xs); }
        .form-section-title { font-family: var(--font-display); font-weight: 700; font-size: 1.1rem; color: var(--navy); margin-bottom: 16px; padding-bottom: 10px; border-bottom: 2px solid var(--line); display: flex; align-items: center; gap: 8px; }
        
        .form-label { font-size: .88rem; font-weight: 600; color: var(--ink); margin-bottom: 6px; }
        .form-control, .form-select { border-color: var(--line-dark); padding: 10px 14px; border-radius: 8px; font-size: .92rem; color: var(--ink); box-shadow: none; transition: .2s; }
        .form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
        
        .btn-submit { background: var(--navy); color: #fff; padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: .95rem; border: none; display: inline-flex; align-items: center; gap: 8px; transition: .2s; }
        .btn-submit:hover { background: var(--navy-dark); transform: translateY(-1px); }
        
        .btn-back { background: #fff; color: var(--ink); border: 1px solid var(--line-dark); padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: .95rem; display: inline-flex; align-items: center; gap: 8px; transition: .2s; }
        .btn-back:hover { background: var(--paper); }

        .alert-error { background: var(--signal-soft); color: var(--signal); padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: .9rem; border: 1px solid rgba(220,53,69,.2); }

        @media (max-width: 991px) {
            .side-toggle { display: block; }
            .user-meta { display: none; }
            .sidebar { position: fixed; transform: translateX(-100%); z-index: 100; transition: transform .3s; }
            body.side-open .sidebar { transform: translateX(0); }
        }
    </style>
</head>
<body>

<!-- TOPBAR -->
<header class="topbar">
    <div class="topbar-left">
        <button class="side-toggle" id="sideToggle"><i class="fas fa-bars"></i></button>
        <a href="/internal/index" class="brand">
            <img src="/images/simerahkoja.png" alt="Logo">
            <span>SIMERAH KOJA</span>
        </a>
    </div>
    <div class="topbar-right">
        <div class="user-chip">
            <span class="user-avatar">{{ strtoupper(substr(Auth::user()->nama_lengkap ?? 'A', 0, 1)) }}</span>
            <div class="user-meta">
                <strong>{{ Auth::user()->nama_lengkap ?? 'Admin' }}</strong>
                <small>{{ str_replace('_', ' ', Auth::user()->role ?? '') }}</small>
            </div>
        </div>
    </div>
</header>

<div class="shell">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <a href="/internal/index" class="side-link"><i class="fas fa-house"></i> Dashboard utama</a>
        
        <div class="side-kicker">Modul operasional</div>
        <details class="side-group" open>
            <summary><i class="fas fa-shield-halved grp-ico"></i> Bagian pencegahan</summary>
            <div class="side-sub">
                <!-- Highlight Kelola SKK -->
                <a href="/internal/pencegahan/kelola-skk" class="active"><i class="fas fa-file-shield"></i> Kelola SKK</a>
                <a href="/internal/pencegahan/peningkatan-kapasitas"><i class="fas fa-arrow-trend-up"></i> Peningkatan Kapasitas</a>
                <a href="/internal/pencegahan/inspeksi-kebakaran"><i class="fas fa-magnifying-glass-chart"></i> Pencegahan & Inspeksi</a>
            </div>
        </details>
        
        <div class="side-kicker">Kembali</div>
        <a href="/internal/pencegahan/kelola-skk" class="side-link text-danger"><i class="fas fa-arrow-left"></i> Batal Edit</a>
    </aside>

    <!-- CONTENT -->
    <main class="content">
        <div class="page-head">
            <h1>Edit Permohonan SKK</h1>
            <p>Perbarui informasi dan data pengajuan Sertifikat Keamanan Kebakaran (SKK).</p>
        </div>

        <div class="form-card">
            @if($errors->any())
                <div class="alert-error">
                    <strong><i class="fas fa-exclamation-triangle"></i> Terdapat Kesalahan:</strong>
                    <ul class="mb-0 mt-1 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('skk.update', $p->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- SECTION: DATA PEMOHON -->
                <h4 class="form-section-title"><i class="fas fa-user-circle"></i> Data Pemohon</h4>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Nama Pemohon</label>
                        <input type="text" name="nama_pemohon" class="form-control" value="{{ old('nama_pemohon', $p->nama_pemohon) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NIK Pemohon / Pemilik</label>
                        <input type="text" name="nik_pemilik_usaha" class="form-control" value="{{ old('nik_pemilik_usaha', $p->nik_pemilik_usaha) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Pemohon</label>
                        <input type="email" name="email_pemohon" class="form-control" value="{{ old('email_pemohon', $p->email_pemohon) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nomor WhatsApp</label>
                        <input type="text" name="no_whatsapp" class="form-control" value="{{ old('no_whatsapp', $p->no_whatsapp) }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Alamat Pemilik (Sesuai KTP)</label>
                        <textarea name="alamat_pemilik_usaha" class="form-control" rows="2" required>{{ old('alamat_pemilik_usaha', $p->alamat_pemilik_usaha) }}</textarea>
                    </div>
                </div>

                <!-- SECTION: DATA USAHA & BANGUNAN -->
                <h4 class="form-section-title mt-4"><i class="fas fa-building"></i> Data Usaha & Bangunan</h4>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Nama Usaha / Gedung</label>
                        <input type="text" name="nama_usaha" class="form-control" value="{{ old('nama_usaha', $p->nama_usaha) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kategori Bangunan</label>
                        <input type="text" name="kategori_bangunan" class="form-control" value="{{ old('kategori_bangunan', $p->kategori_bangunan) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kecamatan</label>
                        <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan', $p->kecamatan) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kelurahan</label>
                        <input type="text" name="kelurahan" class="form-control" value="{{ old('kelurahan', $p->kelurahan) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Luas Lahan (m²)</label>
                        <input type="number" step="0.01" name="luas_lahan" class="form-control" value="{{ old('luas_lahan', $p->luas_lahan) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Luas Bangunan (m²)</label>
                        <input type="number" step="0.01" name="luas_bangunan" class="form-control" value="{{ old('luas_bangunan', $p->luas_bangunan) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tinggi Bangunan (m)</label>
                        <input type="number" step="0.01" name="tinggi_bangunan" class="form-control" value="{{ old('tinggi_bangunan', $p->tinggi_bangunan) }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Alamat Bangunan Lengkap</label>
                        <textarea name="alamat_bangunan" class="form-control" rows="2" required>{{ old('alamat_bangunan', $p->alamat_bangunan) }}</textarea>
                    </div>
                </div>

                <!-- SECTION: STATUS & LAMPIRAN -->
                <h4 class="form-section-title mt-4"><i class="fas fa-file-signature"></i> Status & Lampiran</h4>
                <div class="row g-3 mb-5">
                    <div class="col-md-6">
                        <label class="form-label">Status Permohonan</label>
                        <select name="status_permohonan" class="form-select" required>
                            <option value="Pending" {{ old('status_permohonan', $p->status_permohonan) == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Diproses" {{ old('status_permohonan', $p->status_permohonan) == 'Diproses' ? 'selected' : '' }}>Diproses Tim Inspeksi</option>
                            <option value="Memenuhi Syarat" {{ old('status_permohonan', $p->status_permohonan) == 'Memenuhi Syarat' ? 'selected' : '' }}>Memenuhi Syarat / Diterima</option>
                            <option value="Tidak Memenuhi Syarat" {{ old('status_permohonan', $p->status_permohonan) == 'Tidak Memenuhi Syarat' ? 'selected' : '' }}>Tidak Memenuhi Syarat / Ditolak</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Ganti Surat Permohonan (Opsional)</label>
                        <input type="file" name="file_surat_permohonan" class="form-control" accept=".pdf,.png,.jpg,.jpeg">
                        <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengubah surat. Maks 2MB.</small>
                        @if($p->file_surat_permohonan && $p->file_surat_permohonan !== 'offline_registered')
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $p->file_surat_permohonan) }}" target="_blank" class="badge bg-primary text-decoration-none px-2 py-1"><i class="fas fa-external-link-alt"></i> Lihat File Saat Ini</a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="d-flex gap-3 border-top pt-4">
                    <a href="/internal/pencegahan/kelola-skk" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </main>
</div>

<script>
    document.getElementById('sideToggle').addEventListener('click', function() {
        document.body.classList.toggle('side-open');
    });
</script>
</body>
</html>
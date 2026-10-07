<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Tambah Permohonan RPKBGL | SIMERAH KOJA</title>
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
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: var(--font-body); font-size: 1rem; line-height: 1.6; color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased; }
img { max-width: 100%; display: block; }
a { color: inherit; text-decoration: none; }
ul, ol { list-style: none; margin: 0; padding: 0; }
button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }

/* ==========================================================
   TOPBAR & SIDEBAR
   ========================================================== */
.topbar { position: sticky; top: 0; z-index: 60; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
.topbar-left { display: flex; align-items: center; gap: 14px; }
.side-toggle { display: none; width: 40px; height: 40px; border-radius: 10px; align-items: center; justify-content: center; font-size: 1.05rem; color: #fff; transition: background .2s; }
.brand { display: flex; align-items: center; gap: 12px; color: #fff; }
.brand img { height: 34px; width: auto; }
.brand span { font-family: var(--font-display); font-weight: 700; font-size: 1.08rem; color: #fff; }
.topbar-right { display: flex; align-items: center; gap: 12px; }
.user-chip { display: flex; align-items: center; gap: 10px; padding: 5px 14px 5px 5px; border-radius: 999px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); }
.user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #ffffff; color: var(--ink); display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; }
.user-meta { display: grid; line-height: 1.25; }
.user-meta strong { font-size: .84rem; font-weight: 700; color: #ffffff; }
.user-meta small { font-size: .72rem; color: rgba(255,255,255,.62); text-transform: capitalize; font-weight: 500; }
.btn-logout { display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #ffffff; color: var(--ink); font-weight: 600; font-size: .84rem; transition: .2s; }
.btn-logout:hover { background: #e8eef5; }

.shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
.sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; }
.side-link { display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .89rem; font-weight: 600; color: var(--ink); transition: background .2s; margin-bottom: 4px; }
.side-link:hover { background: #f3f6fa; }
.side-link.active { background: var(--ink); color: #ffffff; }
.side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); }
.side-link.active i { color: #ffffff; }
.side-group + .side-group { margin-top: 6px; }
.side-group summary { list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700; text-transform: uppercase; color: var(--navy); }
.side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
.side-sub a { display: flex; align-items: center; gap: 12px; padding: 9px 12px; border-radius: var(--r-sm); font-size: .84rem; font-weight: 500; color: var(--steel); transition: background .2s; }
.side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); }
.side-sub a.active { background: var(--navy-soft); color: var(--navy); font-weight: 600; }
.side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; }
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
   MAIN CONTENT & FORM STYLES
   ========================================================== */
.content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
.page-head { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 26px; flex-wrap: wrap; gap: 16px; }
.page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; color: var(--ink); margin-bottom: 5px; }
.page-head p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }

.content-card { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 32px; box-shadow: var(--shadow-xs); }

.section-title { font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; color: var(--navy); border-bottom: 2px solid var(--line); padding-bottom: 10px; margin-bottom: 24px; }
.form-label { font-weight: 600; color: var(--ink-2); font-size: 0.92rem; margin-bottom: 8px; }
.form-control, .form-select { border-radius: 8px; padding: 10px 14px; border: 1px solid var(--line-dark); font-size: 0.95rem; color: var(--ink); transition: all 0.2s; }
.form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); outline: none; }
.form-control::placeholder { color: var(--steel-soft); }

/* Buttons */
.btn-back { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; border-radius: 8px; background: var(--paper); color: var(--ink); font-weight: 600; font-size: .9rem; border: 1px solid var(--line-dark); transition: all .2s; text-decoration: none; }
.btn-back:hover { background: var(--line); color: var(--ink); }
.btn-submit { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 24px; border-radius: 8px; background: var(--navy); color: #fff; font-weight: 600; font-size: .9rem; border: none; transition: all .2s; }
.btn-submit:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); }
    </style>
</head>
<body>

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

    <aside class="sidebar" id="sidebar">
        <a href="/internal/index" class="side-link">
            <i class="fas fa-house"></i> Dashboard utama
        </a>

        @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
            <div class="side-kicker">Modul operasional</div>
            
            <details class="side-group" open>
                <summary><i class="fas fa-shield-halved grp-ico"></i><span class="grp-label">Bagian pencegahan</span></summary>
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

            <details class="side-group">
                <summary><i class="fas fa-fire-extinguisher grp-ico"></i><span class="grp-label">Bagian pemadaman</span></summary>
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
            <summary><i class="fas fa-user-gear grp-ico"></i><span class="grp-label">Pengaturan akun</span></summary>
            <div class="side-sub">
                <a href="/internal/profil"><i class="fas fa-user-pen"></i> Profil Saya</a>
            </div>
        </details>
    </aside>

    <!-- ==================== KONTEN UTAMA ==================== -->
    <main class="content">
        <div class="page-head">
            <div>
                <h1>Tambah Permohonan RPKBGL</h1>
                <p>Silakan isi form di bawah ini untuk menambahkan data permohonan baru secara manual.</p>
            </div>
            <a href="/internal/pencegahan/kelola-rpkbgl" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="content-card">
            
            <!-- Tampilkan Error Validasi jika ada -->
            @if ($errors->any())
                <div class="alert alert-danger" style="border-radius: 8px; font-size: 0.9rem;">
                    <strong class="d-block mb-1"><i class="fas fa-exclamation-triangle"></i> Terjadi kesalahan:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/internal/pencegahan/kelola-rpkbgl" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- ==================== BAGIAN 1: DATA PEMOHON ==================== -->
                <h5 class="section-title">Data Pemohon</h5>
                <div class="row g-3 mb-5">
                    <div class="col-md-6">
                        <label class="form-label">Nama Pemohon</label>
                        <input type="text" class="form-control" name="nama_pemohon" value="{{ old('nama_pemohon') }}" placeholder="Sesuai KTP" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NIK Pemilik Usaha</label>
                        <input type="text" class="form-control" name="nik" value="{{ old('nik') }}" placeholder="16 Digit NIK" required maxlength="16">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Pemohon</label>
                        <input type="email" class="form-control" name="email_pemohon" value="{{ old('email_pemohon') }}" placeholder="contoh@email.com" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. WhatsApp</label>
                        <input type="text" class="form-control" name="no_wa" value="{{ old('no_wa') }}" placeholder="Contoh: 081234567890" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Alamat Pemilik Usaha</label>
                        <textarea class="form-control" name="alamat_pemilik" rows="2" placeholder="Alamat lengkap sesuai KTP" required>{{ old('alamat_pemilik') }}</textarea>
                    </div>
                </div>

                <!-- ==================== BAGIAN 2: DATA USAHA ==================== -->
                <h5 class="section-title">Data Usaha & Lokasi</h5>
                <div class="row g-3 mb-5">
                    <div class="col-md-6">
                        <label class="form-label">Nama Usaha / Bangunan</label>
                        <input type="text" class="form-control" name="nama_usaha" value="{{ old('nama_usaha') }}" placeholder="Contoh: PT. Maju Bersama / Ruko Sentosa" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kategori Bangunan</label>
                        <select class="form-select" name="kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Perdagangan/Ruko" {{ old('kategori') == 'Perdagangan/Ruko' ? 'selected' : '' }}>Perdagangan / Ruko</option>
                            <option value="Perkantoran" {{ old('kategori') == 'Perkantoran' ? 'selected' : '' }}>Perkantoran</option>
                            <option value="Perhotelan" {{ old('kategori') == 'Perhotelan' ? 'selected' : '' }}>Perhotelan</option>
                            <option value="Pabrik/Gudang" {{ old('kategori') == 'Pabrik/Gudang' ? 'selected' : '' }}>Pabrik / Gudang</option>
                            <option value="Fasilitas Umum" {{ old('kategori') == 'Fasilitas Umum' ? 'selected' : '' }}>Fasilitas Umum</option>
                            <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    
                    <!-- DROPDOWN KECAMATAN DINAMIS -->
                    <div class="col-md-6">
                        <label class="form-label">Kecamatan</label>
                        <select class="form-select" name="kecamatan" id="kecamatan" required>
                            <option value="">-- Pilih Kecamatan --</option>
                            @foreach($dataWilayah as $kecamatan => $kelurahans)
                                <option value="{{ $kecamatan }}" {{ old('kecamatan') == $kecamatan ? 'selected' : '' }}>
                                    {{ $kecamatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- DROPDOWN KELURAHAN DINAMIS -->
                    <div class="col-md-6">
                        <label class="form-label">Kelurahan</label>
                        <select class="form-select" name="kelurahan" id="kelurahan" required>
                            <option value="">-- Pilih Kelurahan --</option>
                            <!-- Diisi via JavaScript -->
                        </select>
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label">Alamat Bangunan</label>
                        <textarea class="form-control" name="alamat_bangunan" rows="2" placeholder="Alamat lokasi bangunan berada" required>{{ old('alamat_bangunan') }}</textarea>
                    </div>
                </div>

                <!-- ==================== BAGIAN 3: TEKNIS & BERKAS ==================== -->
                <h5 class="section-title">Spesifikasi Teknis & Berkas</h5>
                <div class="row g-3 mb-5">
                    <div class="col-md-4">
                        <label class="form-label">Luas Lahan (m²)</label>
                        <input type="number" step="0.01" class="form-control" name="luas_lahan" value="{{ old('luas_lahan') }}" placeholder="Contoh: 150.5" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Luas Bangunan (m²)</label>
                        <input type="number" step="0.01" class="form-control" name="luas_bangunan" value="{{ old('luas_bangunan') }}" placeholder="Contoh: 300" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tinggi Bangunan (m)</label>
                        <input type="number" step="0.01" class="form-control" name="tinggi_bangunan" value="{{ old('tinggi_bangunan') }}" placeholder="Contoh: 12" required>
                    </div>
                    
                    <div class="col-md-6 mt-4">
                        <label class="form-label">Surat Permohonan <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="surat_permohonan" accept="application/pdf" required>
                        <div class="form-text mt-1" style="font-size: 0.8rem; color: var(--steel-soft);">
                            <i class="fas fa-info-circle"></i> Wajib diisi. Format PDF, maksimal 5 MB.
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label class="form-label">Persyaratan Lainnya (Opsional)</label>
                        <input type="file" class="form-control" name="persyaratan_lainnya[]" multiple accept=".pdf, .jpg, .jpeg, .png">
                        <div class="form-text mt-1" style="font-size: 0.8rem; color: var(--steel-soft);">
                            <i class="fas fa-info-circle"></i> Bisa upload >1 file. PDF/JPG/PNG. Maks 5 MB.
                        </div>
                    </div>
                </div>

                <!-- ==================== FOOTER ==================== -->
                <div class="d-flex justify-content-end gap-3 pt-4" style="border-top: 1px solid var(--line);">
                    <a href="/internal/pencegahan/kelola-rpkbgl" class="btn-back">Batal</a>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i> Simpan Data RPKBGL
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<!-- ==================== SCRIPTS ==================== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // 1. Script Sidebar Mobile Toggle
    var toggle = document.getElementById('sideToggle');
    var backdrop = document.getElementById('sideBackdrop');
    if (toggle) {
        toggle.addEventListener('click', function () {
            document.body.classList.toggle('side-open');
        });
    }
    if (backdrop) {
        backdrop.addEventListener('click', function() {
            document.body.classList.remove('side-open');
        });
    }

    // 2. Script Logika Dropdown Dinamis Kecamatan & Kelurahan Jambi
    document.addEventListener('DOMContentLoaded', function() {
        // Parsing array dari Controller ke JSON JS
        const dataWilayah = @json($dataWilayah);
        
        const selectKecamatan = document.getElementById('kecamatan');
        const selectKelurahan = document.getElementById('kelurahan');
        
        // Simpan 'old' input kelurahan jika ada validasi error
        const oldKelurahan = "{{ old('kelurahan') }}";

        function updateKelurahan() {
            const kecamatanPilih = selectKecamatan.value;
            
            // Kosongkan opsi kelurahan 
            selectKelurahan.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
            
            // Isi dropdown jika kecamatan dipilih
            if (kecamatanPilih && dataWilayah[kecamatanPilih]) {
                const daftarKelurahan = dataWilayah[kecamatanPilih];
                
                daftarKelurahan.forEach(function(kelurahan) {
                    const option = document.createElement('option');
                    option.value = kelurahan;
                    option.textContent = kelurahan;
                    
                    // Otomatis selected jika value kelurahan cocok dengan old input
                    if (oldKelurahan === kelurahan) {
                        option.selected = true;
                    }
                    
                    selectKelurahan.appendChild(option);
                });
            }
        }

        // Listener jika dropdown kecamatan diubah oleh pengguna
        selectKecamatan.addEventListener('change', updateKelurahan);

        // Jalankan saat halaman pertama kali load (menjaga old data saat error validasi)
        if (selectKecamatan.value) {
            updateKelurahan();
        }
    });
</script>

</body>
</html>
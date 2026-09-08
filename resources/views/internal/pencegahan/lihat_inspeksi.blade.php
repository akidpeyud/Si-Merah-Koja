<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Inspeksi - SIMERAH KOJA</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f8fafc; color: #1e293b; }
        .navbar-internal { background-color: #0f172a; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 0.5px; }
        .badge-internal { background: #10b981; color: white; font-size: 10px; padding: 4px 8px; border-radius: 6px; font-weight: 700; margin-left: 10px; }
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 12px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #f8fafc; font-size: 14px; font-weight: 600; }
        .user-profile i { font-size: 22px; color: #94a3b8; }
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 280px; background-color: #ffffff; border-right: 1px solid #e2e8f0; padding: 25px 20px; display: flex; flex-direction: column; gap: 5px; }
        .sidebar-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; color: #64748b; text-decoration: none; font-size: 14px; font-weight: 600; border-radius: 10px; transition: all 0.2s; }
        .sidebar-item.active { background-color: #eff6ff; color: #2563eb; border-left: 4px solid #2563eb; }
        .sidebar-title { font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin: 20px 0 10px 10px; letter-spacing: 1px; }
        .main-content { flex: 1; padding: 40px; }
        .page-header h1 { font-size: 26px; font-weight: 800; color: #0f172a; }
        .page-header p { color: #64748b; font-size: 15px; margin-top: 5px; }
        .content-card { background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); border: 1px solid #e2e8f0; padding: 30px; margin-top: 25px; }
        .detail-row { border-bottom: 1px solid #f1f5f9; padding: 15px 0; display: flex; }
        .detail-label { font-weight: 700; color: #475569; width: 30%; }
        .detail-value { color: #0f172a; width: 70%; font-weight: 500; }
    </style>
</head>
<body>
    <nav class="navbar-internal">
        <a href="#" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah" onerror="this.style.display='none'">
            <span class="title">SIMERAH KOJA <span class="badge-internal">INTERNAL APP</span></span>
        </a>
        <div class="user-menu">
            <div class="user-profile">
                <span class="badge-role {{ Auth::user()?->role ?? '' }}">{{ str_replace('_', ' ', Auth::user()?->role ?? 'PEGAWAI') }}</span>
                <span>{{ Auth::user()?->nama_lengkap ?? 'Rekan Kerja' }}</span>
                <i class="fas fa-user-circle"></i>
            </div>
        </div>
    </nav>
    
    <div class="dashboard-container">
        <aside class="sidebar">
            <a href="/internal/index" class="sidebar-item"><i class="fas fa-home"></i> Dashboard Utama</a>
            @if(Auth::user()?->role === 'pencegahan' || Auth::user()?->role === 'super_user')
                <div class="sidebar-title">Bagian Pencegahan</div>
                <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item active"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
            @endif
            <div class="sidebar-title">Pengaturan Akun</div>
            <a href="/internal/profil" class="sidebar-item"><i class="fas fa-user-edit"></i> Profil Saya</a>
        </aside>

        <main class="main-content">
            <div class="page-header d-flex justify-content-between align-items-end">
                <div>
                    <h1>Detail Data Inspeksi</h1>
                    <p>Rincian lengkap dari jadwal inspeksi yang dipilih.</p>
                </div>
                <a href="/internal/pencegahan/layanan-inspeksi" class="btn btn-secondary px-4 py-2" style="border-radius: 10px; font-weight: 600;">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>

            <div class="content-card">
                <h4 class="mb-4" style="font-weight: 700; color: #1e293b;"><i class="fas fa-building me-2 text-primary"></i> Informasi Objek</h4>
                
                <div class="detail-row">
                    <div class="detail-label">Nama Instansi / Objek</div>
                    <div class="detail-value">{{ $data->nama_instansi ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Tanggal Inspeksi</div>
                    <div class="detail-value">{{ $data->tanggal_inspeksi ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Tim Petugas</div>
                    <div class="detail-value">{{ $data->tim_petugas ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Alamat Lengkap</div>
                    <div class="detail-value">{{ $data->alamat ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Jml. Gedung Tinggi (>8 Lantai)</div>
                    <div class="detail-value">{{ $data->jml_gedung_tinggi ?? '0' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Jml. Gedung Sedang (5-8 Lantai)</div>
                    <div class="detail-value">{{ $data->jml_gedung_sedang ?? '0' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Jml. Gedung Rendah (1-4 Lantai)</div>
                    <div class="detail-value">{{ $data->jml_gedung_rendah ?? '0' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Catatan Tambahan</div>
                    <div class="detail-value">{{ $data->catatan ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Dokumen Pendukung</div>
                    <div class="detail-value">
                        @if($data->dokumen_pendukung)
                            <a href="/uploads/inspeksi/{{ $data->dokumen_pendukung }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-file-download me-1"></i> Lihat Dokumen
                            </a>
                        @else
                            <span class="text-muted">Tidak ada dokumen</span>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
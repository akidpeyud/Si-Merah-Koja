@extends('layouts.dashboard')

@section('title', 'Kelola Data Peta SIGAP')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css">
<style>
    .toast {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 12px 12px 16px;
        border-radius: 999px;
        background: #fff; border: 1px solid var(--line);
        box-shadow: var(--shadow-md);
        font-weight: 600; font-size: .92rem;
        animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both;
    }
    .user-avatar {
        width: 36px; height: 36px; border-radius: 50%;
        background: #fff; color: var(--ink);
        display: grid; place-items: center;
        font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none;
    }
    .user-meta strong {
        font-size: .84rem; font-weight: 700; max-width: 160px;
        overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #fff;
    }
    .btn-logout {
        display: inline-flex; align-items: center; justify-content: center;
        gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px;
        background: #fff; color: var(--ink);
        font-weight: 600; font-size: .84rem; border: none;
        transition: background .2s, color .2s, transform .1s, box-shadow .2s;
    }
    .sidebar {
        width: var(--sidebar-w); flex: none;
        position: sticky; top: var(--topbar-h);
        height: calc(100vh - var(--topbar-h));
        overflow-y: auto; overflow-x: hidden;
        background: #fff; border-right: 1px solid var(--line);
        padding: 20px 14px 32px;
        scrollbar-width: thin; scrollbar-color: #d8dee8 transparent;
    }
    .side-link.active { background: var(--ink); color: #fff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
    .side-link.active i { color: #fff; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label {
        flex: 1 1 auto; min-width: 0;
        white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4;
    }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    @media (max-width: 1100px) {
        .content { padding: 32px 26px 60px; }
        .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .overview { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .ov-item:nth-child(3n) { border-right: 0; }
        .ov-item:nth-child(n+4) { border-top: 1px solid rgba(255,255,255,.10); }
    }
    @media (max-width: 700px) {
        .content { padding: 26px 16px 50px; }
        .page-head { margin-bottom: 22px; }
        .page-head h1 { font-size: 1.55rem; }
        .page-head p { font-size: .88rem; }
        .welcome { padding: 25px 22px; margin-bottom: 30px; border-radius: 15px; }
        .welcome h2 { font-size: 1.3rem; }
        .welcome-sub { font-size: .88rem; }
        .overview { grid-template-columns: repeat(2, minmax(0, 1fr)); margin-top: 24px; }
        .ov-item { padding: 15px 16px; gap: 10px; }
        .ov-item:nth-child(3n) { border-right: 1px solid rgba(255,255,255,.10); }
        .ov-item:nth-child(2n) { border-right: 0; }
        .ov-item:nth-child(n+3) { border-top: 1px solid rgba(255,255,255,.10); }
        .ov-item strong { font-size: 1.6rem; }
        .section-heading { gap: 9px; }
        .section-heading-ico { width: 30px; height: 30px; }
        .section-heading h3 { font-size: .92rem; }
        .dash-section { margin-bottom: 32px; }
        .section-meta { margin-left: 0; }
        .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
        .stat-card { padding: 15px; gap: 12px; }
        .stat-title { font-size: .84rem; }
        .stat-value { font-size: 1.6rem; }
    }
    @media (max-width: 420px) {
        .content { padding-left: 13px; padding-right: 13px; }
        .welcome { padding: 22px 18px; }
        .stats-grid { grid-template-columns: 1fr; }
        .welcome h2 { font-size: 1.18rem; }
        .welcome-sub { font-size: .84rem; }
        .section-heading h3 { font-size: .86rem; }
    }
    @media print {
        .content { padding: 20px; }
        .welcome { box-shadow: none; border: 1px solid #ddd; }
        .stat-card { box-shadow: none; break-inside: avoid; }
    }
    .page-head-bar { display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 18px; margin-bottom: 28px; }
    .page-head p { color: var(--steel); font-size: .95rem; margin: 0; }
    .section-heading { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; flex-wrap: nowrap; }
    .section-heading-ico { flex: none; width: 32px; height: 32px; border-radius: 9px; background: var(--navy); color: #fff; display: grid; place-items: center; font-size: .78rem; box-shadow: 0 4px 8px rgba(22,58,99,.12); }
    .section-heading h3 { flex: none; font-family: var(--font-display); font-weight: 700; font-size: 1rem; color: var(--ink); letter-spacing: -.01em; white-space: nowrap; margin: 0; }
    .section-heading .line { flex: 1 1 auto; min-width: 24px; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }
    .count-pill { flex: none; display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: 999px; background: var(--navy-soft); color: var(--navy); font-size: .78rem; font-weight: 700; }
    .btn-simerah-danger { background: var(--signal); color: #ffffff; font-weight: 600; font-size: .9rem; border-radius: var(--r-sm); padding: 11px 20px; display: inline-flex; align-items: center; justify-content: center; gap: 9px; border: none; box-shadow: 0 4px 12px rgba(220, 53, 69, .22); transition: background .2s, transform .15s, box-shadow .2s; }
    .btn-simerah-danger:hover { background: var(--signal-dark); color: #ffffff; transform: translateY(-1px); }
    .btn-simerah-secondary { background: var(--paper); color: var(--ink); font-weight: 600; font-size: .88rem; border-radius: var(--r-sm); padding: 10px 18px; border: 1px solid var(--line-dark); transition: background .2s; }
    .btn-simerah-secondary:hover { background: var(--line); }
    .card-box { background: #ffffff; border-radius: var(--r-md); border: 1px solid var(--line); box-shadow: var(--shadow-xs); overflow: hidden; }
    .table-simerah { margin-bottom: 0; }
    .table-simerah thead th { font-family: var(--font-display); font-size: .76rem; text-transform: uppercase; letter-spacing: .05em; font-weight: 700; color: var(--steel); background-color: #f8fafc; border-bottom: 1px solid var(--line); padding: 15px 20px; white-space: nowrap; }
    .table-simerah tbody td { padding: 16px 20px; border-bottom: 1px solid var(--line); vertical-align: middle; }
    .table-simerah tbody tr:last-child td { border-bottom: none; }
    .table-simerah tbody tr:hover { background-color: #f9fbfd; }
    .row-num { display: inline-grid; place-items: center; width: 30px; height: 30px; border-radius: 8px; background: var(--paper); color: var(--steel); font-family: var(--font-display); font-weight: 700; font-size: .84rem; }
    .yt-thumb-link { position: relative; display: block; width: 148px; aspect-ratio: 16 / 9; border-radius: var(--r-sm); overflow: hidden; border: 1px solid var(--line); background: var(--ink); box-shadow: var(--shadow-xs); }
    .yt-thumb-link img { width: 100%; height: 100%; object-fit: cover; transition: transform .3s ease, opacity .3s ease; }
    .yt-thumb-play { position: absolute; inset: 0; display: grid; place-items: center; background: rgba(13, 27, 42, .35); color: #ffffff; font-size: 1.35rem; opacity: 0; transition: opacity .25s ease; }
    .yt-thumb-link:hover img { transform: scale(1.05); opacity: .88; }
    .yt-thumb-link:hover .yt-thumb-play { opacity: 1; }
    .video-title { font-family: var(--font-display); font-weight: 700; font-size: .98rem; color: var(--ink); margin-bottom: 6px; line-height: 1.35; }
    .video-meta { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; }
    .yt-watch-link { display: inline-flex; align-items: center; gap: 6px; font-size: .82rem; font-weight: 600; color: var(--signal); padding: 4px 10px; border-radius: 6px; background: var(--signal-soft); transition: background .2s, color .2s; }
    .yt-watch-link:hover { background: var(--signal); color: #ffffff; }
    .yt-id-code { font-size: .76rem; font-weight: 600; color: var(--steel); background: var(--paper); border: 1px solid var(--line); padding: 3px 8px; border-radius: 6px; }
    .action-group { display: inline-flex; align-items: center; gap: 8px; }
    .btn-edit-item { display: inline-flex; align-items: center; gap: 6px; padding: 8px 13px; border-radius: var(--r-sm); font-size: .82rem; font-weight: 600; color: var(--navy); background: var(--navy-soft); transition: background .2s, color .2s; }
    .btn-edit-item:hover { background: var(--navy); color: #ffffff; }
    .btn-delete-item { display: inline-flex; align-items: center; gap: 6px; padding: 8px 13px; border-radius: var(--r-sm); font-size: .82rem; font-weight: 600; color: var(--signal-dark); background: var(--signal-soft); transition: background .2s, color .2s; }
    .btn-delete-item:hover { background: var(--signal); color: #ffffff; }
    .empty-state { padding: 48px 24px; text-align: center; }
    .empty-ico { width: 56px; height: 56px; border-radius: 16px; background: var(--navy-soft); color: var(--navy); display: grid; place-items: center; font-size: 1.5rem; margin: 0 auto 14px; }
    .empty-state h4 { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; color: var(--ink); margin-bottom: 6px; }
    .empty-state p { color: var(--steel); font-size: .88rem; max-width: 42ch; margin: 0 auto 18px; }
    .modal-content { border-radius: var(--r-lg); border: 1px solid var(--line); box-shadow: var(--shadow-lg); overflow: hidden; }
    .modal-header { background: var(--ink); color: #ffffff; border-bottom: 1px solid rgba(255,255,255,.08); padding: 18px 24px; }
    .modal-title { font-family: var(--font-display); font-weight: 700; font-size: 1.02rem; color: #ffffff; display: flex; align-items: center; gap: 10px; }
    .modal-header .btn-close { filter: invert(1) grayscale(100%) brightness(200%); opacity: .75; }
    .modal-body { padding: 24px; }
    .modal-footer { background: #f8fafc; border-top: 1px solid var(--line); padding: 14px 24px; }
    .form-label { font-size: .84rem; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
    .form-control { border-radius: var(--r-sm); border: 1px solid var(--line-dark); padding: 10px 14px; font-size: .92rem; color: var(--ink); }
    .form-control:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .form-hint { display: block; font-size: .78rem; color: var(--steel); margin-top: 6px; }
    .yt-preview-card { background: var(--paper); border: 1px dashed var(--line-dark); border-radius: var(--r-md); padding: 14px; text-align: center; }
    .yt-preview-card img { width: 100%; max-width: 280px; aspect-ratio: 16 / 9; object-fit: cover; border-radius: var(--r-sm); margin: 0 auto; border: 1px solid var(--line); }
    @media (max-width: 700px) {
        .content { padding: 26px 16px 50px; }
        .btn-simerah-danger.w-mobile-100 { width: 100%; }
    }
    .page-head { margin-bottom: 26px; }
    .card-box { padding: 24px; margin-bottom: 24px; }
    .card-title { font-family: var(--font-display); font-size: 1.15rem; font-weight: 700; color: var(--ink); border-bottom: 1px solid var(--line); padding-bottom: 15px; margin-bottom: 20px; }
    .btn-simerah-primary { background: var(--info); color: #ffffff; font-weight: 600; border-radius: var(--r-sm); padding: 10px 20px; display: inline-flex; align-items: center; gap: 8px; border: none; transition: background .2s, transform .1s, box-shadow .2s; }
    .btn-simerah-primary:hover { background: #1d4ed8; color: #ffffff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(37, 99, 235, .2); }
    .form-control, .form-select { border-color: var(--line-dark); border-radius: 8px; font-size: 0.95rem; padding: 10px 14px; }
    .form-control:focus, .form-select:focus { border-color: var(--info); box-shadow: var(--info-soft); }
    #mapPreview { height: 350px; border-radius: var(--r-sm); border: 1px solid var(--line-dark); z-index: 1; }
    .coordinate-box { background: var(--paper); border: 1px solid var(--line); padding: 12px 16px; border-radius: var(--r-sm); font-family: monospace; font-size: 0.9rem; color: var(--steel); margin-top: 10px; }
    .table { font-size: .92rem; margin-bottom: 0; }
    .table thead th { font-family: var(--font-display); font-size: .8rem; text-transform: uppercase; letter-spacing: .04em; font-weight: 700; color: var(--steel); background-color: var(--paper); border-bottom: 1px solid var(--line); padding: 14px 16px; }
    .table tbody td { padding: 16px; border-bottom: 1px solid var(--line); vertical-align: middle; }
    .table-hover tbody tr:hover { background-color: #fafbfc; }
    .title-text { font-family: var(--font-display); font-weight: 700; color: var(--ink); font-size: .98rem; display: block; margin-bottom: 3px; }
    .location-text { font-size: .82rem; color: var(--steel); }
    .badge-kategori { font-size: 0.75rem; font-weight: 600; padding: 5px 10px; border-radius: 50px; display: inline-flex; align-items: center; gap: 5px; }
    .action-btn { width: 34px; height: 34px; display: inline-flex; justify-content: center; align-items: center; border-radius: 8px; border: none; color: #ffffff; font-size: .84rem; transition: transform .15s, filter .15s; }
    .action-btn:hover { transform: translateY(-1px); color: #ffffff; filter: brightness(.92); }
    .btn-view { background-color: var(--info); }
    .btn-edit { background-color: var(--amber); }
    .btn-delete { background-color: var(--signal); }
    .empty-state { color: var(--steel); }
    .empty-state i { font-size: 2.8rem; color: var(--steel-soft); margin-bottom: 12px; opacity: .6; }
</style>
@endpush

@section('content')
@section('content')

        <div class="page-head m-0 mb-4">
            <h1>Input Titik Peta SIGAP</h1>
            <p>Kelola dan tambahkan titik koordinat operasional pemadam kebakaran Kota Jambi.</p>
        </div>

        <div class="row">
            <!-- Kolom Form Input: Hanya bisa diakses/disimpan oleh Operator -->
            @hasanyrole('Operator|Super User')
            <div class="col-lg-5">
                <div class="card-box">
                    <h2 class="card-title">Detail Informasi Titik</h2>
                    
                    <form action="/internal/peta-sigap/store" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Kategori Titik *</label>
                            <select class="form-select" name="kategori" required>
                                <option value="" selected disabled>-- Pilih Kategori --</option>
                                <option value="kebakaran">Titik Kebakaran</option>
                                <option value="sumber_air">Titik Sumber Air</option>
                                <option value="hydrant">Titik Hydrant</option>
                                <option value="penyelamatan">Riwayat Penyelamatan</option>
                                <option value="pos">Pos / Mako Damkar</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Nama/Judul Titik *</label>
                            <input type="text" class="form-control" name="nama" placeholder="Contoh: Hydrant Simpang Pulai" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Kejadian/Pembangunan</label>
                            <input type="date" class="form-control" name="tanggal">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Lokasi / Alamat Lengkap *</label>
                            <textarea class="form-control" name="lokasi" rows="3" placeholder="Alamat lengkap lokasi..." required></textarea>
                        </div>

                        <!-- Input Hidden untuk menampung koordinat dari Peta -->
                        <input type="hidden" name="latitude" id="latInput" required>
                        <input type="hidden" name="longitude" id="lngInput" required>

                        <button type="submit" class="btn-simerah-primary w-100 justify-content-center mt-3">
                            <i class="fas fa-save"></i> Simpan Titik Peta
                        </button>
                    </form>
                </div>
            </div>
            @endhasanyrole

            <!-- Kolom Map Interaktif (Lebar menyesuaikan apakah form input muncul atau tidak) -->
            <div class="{{ Auth::user()->hasAnyRole('Operator|Super User') ? 'col-lg-7' : 'col-lg-12' }}">
                <div class="card-box h-100">
                    <h2 class="card-title">Penentuan Titik Koordinat (Klik pada Peta)</h2>
                    <p class="text-muted small mb-3">Silakan klik atau geser peta untuk menentukan titik koordinat lokasi yang tepat.</p>
                    
                    <div id="mapPreview"></div>
                    
                    <div class="coordinate-box d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Latitude: </strong> <span id="textLat">-1.610100</span>
                        </div>
                        <div>
                            <strong>Longitude: </strong> <span id="textLng">103.613100</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Riwayat Data Baru -->
        <div class="card-box mt-4">
            <h2 class="card-title">Data Titik Peta Terbaru</h2>
            <div class="table-responsive">
                <table class="table table-simerah align-middle">
                    <thead>
                        <tr>
                            <th style="width: 25%;">Kategori</th>
                            <th style="width: 35%;">Nama Titik</th>
                            <th style="width: 25%;">Koordinat</th>
                            
                            <!-- Header Aksi hanya muncul untuk Operator -->
                            @hasanyrole('Operator|Super User')
                            <th style="width: 15%;" class="text-center">Aksi</th>
                            @endhasanyrole
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contoh Dummy Data (Nanti diganti Foreach) -->
                        <tr>
                            <td>
                                <span class="badge-kategori text-light" style="background-color: #dc3545;">
                                    <i class="fas fa-fire"></i> Kebakaran
                                </span>
                            </td>
                            <td>
                                <span class="title-text">Kebakaran Ruko Pasar</span>
                                <span class="location-text">Pasar Jambi</span>
                            </td>
                            <td class="font-monospace text-muted small">
                                Lat: -1.5931<br>Lng: 103.6210
                            </td>
                            
                            <!-- Tombol Aksi (Edit & Hapus) hanya untuk Operator -->
                            @hasanyrole('Operator|Super User')
                            <td class="text-center">
                                <a href="#" class="action-btn btn-edit mx-1" title="Edit">
                                    <i class="fas fa-pen-to-square"></i>
                                </a>
                                <button class="action-btn btn-delete" title="Hapus">
                                    <i class="fas fa-trash-can"></i>
                                </button>
                            </td>
                            @endhasanyrole
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script>
(function () {
    'use strict';

    /* ---------- Leaflet Map Input Interaktif ---------- */
    var initialLat = -1.6101; 
    var initialLng = 103.6131;

    var map = L.map('mapPreview').setView([initialLat, initialLng], 12);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    var marker = L.marker([initialLat, initialLng], {
        draggable: true
    }).addTo(map);

    var latInput = document.getElementById('latInput');
    var lngInput = document.getElementById('lngInput');
    var textLat = document.getElementById('textLat');
    var textLng = document.getElementById('textLng');

    if (latInput && lngInput) {
        latInput.value = initialLat;
        lngInput.value = initialLng;
    }

    function updateCoordinate(lat, lng) {
        if (latInput) latInput.value = lat.toFixed(6);
        if (lngInput) lngInput.value = lng.toFixed(6);
        if (textLat) textLat.textContent = lat.toFixed(6);
        if (textLng) textLng.textContent = lng.toFixed(6);
    }

    marker.on('dragend', function (e) {
        var position = marker.getLatLng();
        updateCoordinate(position.lat, position.lng);
    });

    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        updateCoordinate(e.latlng.lat, e.latlng.lng);
    });

})();
</script>
@endpush

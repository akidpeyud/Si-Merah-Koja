@extends('layouts.dashboard')

@section('title', 'Input Titik Peta SIGAP')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css">
<style>
    /* Page & Header Styling */
    .page-header-box {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 24px;
    }
    .page-header-box h1 {
        font-family: var(--font-display);
        font-size: clamp(1.4rem, 2.5vw, 1.85rem);
        font-weight: 700;
        color: var(--ink);
        letter-spacing: -0.02em;
        margin-bottom: 4px;
    }
    .page-header-box p {
        color: var(--steel);
        font-size: 0.92rem;
        margin-bottom: 0;
    }

    /* Modern Card Styles */
    .form-panel {
        background: #ffffff;
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        box-shadow: var(--shadow-xs);
        transition: box-shadow .2s ease, border-color .2s ease;
        overflow: hidden;
    }
    .form-panel:hover {
        border-color: #cbd5e1;
        box-shadow: var(--shadow-sm);
    }
    .panel-header {
        padding: 18px 24px;
        background: #ffffff;
        border-bottom: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }
    .panel-title {
        font-family: var(--font-display);
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--ink);
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }
    .panel-title-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: var(--navy-soft);
        color: var(--navy);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
    }
    .panel-body {
        padding: 24px;
    }

    /* Section Divider in Form */
    .form-section-title {
        font-size: 0.76rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--steel-soft);
        margin: 20px 0 12px 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .form-section-title::after {
        content: "";
        flex: 1;
        height: 1px;
        background: var(--line);
    }
    .form-section-title:first-of-type {
        margin-top: 0;
    }

    /* Form Fields */
    .form-label {
        font-size: 0.86rem;
        font-weight: 600;
        color: var(--ink-2);
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .label-badge {
        font-size: 0.7rem;
        font-weight: 500;
        padding: 2px 7px;
        border-radius: 4px;
    }
    .badge-req { background: #fee2e2; color: #b91c1c; }
    .badge-opt { background: #f1f5f9; color: #64748b; }

    .input-group-text {
        background: #f8fafc;
        border-color: var(--line-dark);
        color: var(--steel);
        font-size: 0.9rem;
        padding: 0 14px;
        border-radius: 8px 0 0 8px;
    }
    .form-control, .form-select {
        min-height: 44px;
        font-size: 0.92rem;
        border: 1px solid var(--line-dark);
        border-radius: 8px;
        color: var(--ink);
        background-color: #fff;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .input-group .form-control, .input-group .form-select {
        border-radius: 0 8px 8px 0;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--navy);
        box-shadow: 0 0 0 3.5px var(--navy-soft);
    }
    .form-control::placeholder {
        color: #94a3b8;
        font-size: 0.88rem;
    }
    .mono-num {
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        font-weight: 600;
        letter-spacing: -0.01em;
    }

    /* Tingkat Risiko Box */
    .risk-level-card {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-left: 4px solid #ef4444;
        border-radius: 8px;
        padding: 14px 16px;
        transition: all 0.25s ease;
    }
    .risk-level-card.risk-sedang {
        background: #fffbeb;
        border-color: #fde68a;
        border-left-color: #f59e0b;
    }

    /* Map Box & Interactive Elements */
    .map-wrapper {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid var(--line-dark);
        box-shadow: inset 0 0 0 1px rgba(0,0,0,0.03);
    }
    #mapPicker {
        height: 480px;
        width: 100%;
        z-index: 1;
    }
    .map-badge-overlay {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 999;
        background: rgba(13, 27, 42, 0.85);
        backdrop-filter: blur(4px);
        color: #ffffff;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.78rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }
    .map-badge-overlay .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #10b981;
        animation: pulseLive 1.8s infinite;
    }
    @keyframes pulseLive {
        0% { transform: scale(0.95); opacity: 0.8; }
        50% { transform: scale(1.25); opacity: 1; }
        100% { transform: scale(0.95); opacity: 0.8; }
    }

    .map-quick-actions {
        display: flex;
        gap: 8px;
        margin-top: 10px;
        flex-wrap: wrap;
    }
    .btn-quick-loc {
        font-size: 0.8rem;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 6px;
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        color: var(--ink-2);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.15s ease;
    }
    .btn-quick-loc:hover {
        background: #e2e8f0;
        color: var(--ink);
    }

    /* Buttons */
    .btn-submit-main {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        height: 44px;
        padding: 0 24px;
        background: var(--navy);
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-size: 0.92rem;
        font-weight: 600;
        transition: all .2s ease;
    }
    .btn-submit-main:hover {
        background: var(--navy-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(22, 58, 99, 0.25);
        color: #ffffff;
    }
    .btn-cancel-main {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        height: 44px;
        padding: 0 20px;
        background: #ffffff;
        color: var(--steel);
        border: 1px solid var(--line-dark);
        border-radius: 8px;
        font-size: 0.92rem;
        font-weight: 600;
        text-decoration: none;
        transition: all .15s ease;
    }
    .btn-cancel-main:hover {
        background: #f8fafc;
        color: var(--ink);
        border-color: #cbd5e1;
    }

    /* Sticky container for map column on desktop */
    @media (min-width: 992px) {
        .sticky-map-col {
            position: sticky;
            top: calc(var(--topbar-h) + 20px);
        }
    }
</style>
@endpush

@section('content')
@hasanyrole('Super User|Operator|User')

    <!-- Header Section -->
    <div class="page-header-box">
        <div>
            <h1>Input Titik Peta SIGAP</h1>
            <p>Daftarkan data titik operasional untuk ditampilkan pada peta interaktif SIGAP.</p>
        </div>
        <div>
            <a href="{{ url('/internal/peta-sigap/data') }}" class="btn-cancel-main">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Titik
            </a>
        </div>
    </div>

    <!-- Alert Error Validasi -->
    @if($errors->any())
        <div class="alert alert-danger d-flex align-items-start gap-3 mb-4 rounded-3 shadow-xs">
            <i class="fas fa-circle-exclamation fs-5 mt-1 flex-shrink-0 text-danger"></i>
            <div class="flex-grow-1">
                <strong class="d-block mb-1">Gagal menyimpan data:</strong>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ url('/internal/peta-sigap/store') }}" method="POST">
        @csrf

        <div class="row g-4 align-items-start">
            
            <!-- KOLOM KIRI: FORMULIR INPUT -->
            <div class="col-xl-7 col-lg-6">
                <div class="form-panel">
                    <div class="panel-header">
                        <div class="panel-title">
                            <span class="panel-title-icon"><i class="fas fa-layer-group"></i></span>
                            Formulir Titik SIGAP
                        </div>
                        <span class="badge bg-light text-secondary border">Input Baru</span>
                    </div>

                    <div class="panel-body">
                        
                        <!-- BAGIAN 1: KLASIFIKASI -->
                        <div class="form-section-title">
                            <i class="fas fa-tags me-1"></i> Klasifikasi Titik
                        </div>

                        <!-- Kategori Titik -->
                        <div class="mb-3">
                            <label class="form-label" for="kategoriSelect">
                                <span>Kategori Peta</span>
                                <span class="label-badge badge-req">Wajib</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-folder-tree"></i></span>
                                <select name="kategori" id="kategoriSelect" class="form-select" required>
                                    <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>-- Pilih Kategori Titik --</option>
                                    @foreach (\App\Models\TitikSigap::KATEGORI as $nilai => $label)
                                        <option value="{{ $nilai }}" {{ old('kategori') === $nilai ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Dropdown Tambahan: Tingkat Risiko (Khusus Zona Rawan Kebakaran) -->
                        <div class="mb-3 d-none" id="containerTingkatRisiko">
                            <div class="risk-level-card" id="riskCardWrapper">
                                <label class="form-label mb-1" for="tingkatRisikoSelect">
                                    <span class="fw-bold text-dark"><i class="fas fa-fire-flame-curved text-danger me-1"></i> Tingkat Risiko Kebakaran</span>
                                    <span class="label-badge badge-req">Zona Rawan</span>
                                </label>
                                <p class="text-muted small mb-2">Pilih tingkat risiko untuk menentukan radius buffer zona rawan kebakaran di peta.</p>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-triangle-exclamation text-danger"></i></span>
                                    <select name="tingkat_risiko" id="tingkatRisikoSelect" class="form-select fw-semibold">
                                        <option value="Tinggi" {{ old('tingkat_risiko', 'Tinggi') === 'Tinggi' ? 'selected' : '' }}>Risiko Tinggi (Buffer Radius 1.200 m / 1,2 km)</option>
                                        <option value="Sedang" {{ old('tingkat_risiko') === 'Sedang' ? 'selected' : '' }}>Risiko Sedang (Buffer Radius 800 m)</option>
                                    </select>
                                </div>
                                <div id="bufferBadgeInfo" class="mt-2 small fw-semibold"></div>
                            </div>
                        </div>

                        <!-- BAGIAN 2: IDENTITAS & LOKASI -->
                        <div class="form-section-title">
                            <i class="fas fa-location-dot me-1"></i> Identitas & Keterangan
                        </div>

                        <!-- Nama/Judul Lokasi -->
                        <div class="mb-3">
                            <label class="form-label" for="namaInput">
                                <span>Nama / Judul Titik</span>
                                <span class="label-badge badge-req">Wajib</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                <input type="text" id="namaInput" name="nama" class="form-control" placeholder="Cth: Hydrant Pilar Jl. Sultan Thaha" value="{{ old('nama') }}" required>
                            </div>
                        </div>

                        <!-- Alamat Detail -->
                        <div class="mb-3">
                            <label class="form-label" for="lokasiInput">
                                <span>Alamat / Lokasi Lengkap</span>
                                <span class="label-badge badge-req">Wajib</span>
                            </label>
                            <textarea id="lokasiInput" name="lokasi" class="form-control" rows="2" placeholder="Masukkan detail lokasi, nama jalan, patokan, atau kelurahan..." required>{{ old('lokasi') }}</textarea>
                        </div>
                        
                        <!-- Keterangan (Opsional) -->
                        <div class="mb-4">
                            <label class="form-label" for="keteranganInput">
                                <span>Keterangan Tambahan</span>
                                <span class="label-badge badge-opt">Opsional</span>
                            </label>
                            <textarea id="keteranganInput" name="keterangan" class="form-control" rows="2" placeholder="Catatan kondisi fisik, kontak PIC, atau informasi operasional lainnya...">{{ old('keterangan') }}</textarea>
                        </div>

                        <!-- BAGIAN 3: KOORDINAT -->
                        <div class="form-section-title">
                            <i class="fas fa-crosshairs me-1"></i> Koordinat Geografis
                        </div>

                        <div class="p-3 bg-light rounded-3 border mb-3">
                            <div class="d-flex align-items-center gap-2 mb-2 text-dark small fw-semibold">
                                <i class="fas fa-wand-magic-sparkles text-primary"></i> Paste Cepat dari Google Maps:
                            </div>
                            <p class="text-muted small mb-0">
                                Anda dapat langsung menyalin koordinat gabungan (misal: <code>-1.618088, 103.600641</code>) lalu paste ke salah satu kolom di bawah, koordinat akan terpisah otomatis.
                            </p>
                        </div>

                        <div class="row g-3 mb-4">
                            <!-- Latitude -->
                            <div class="col-sm-6">
                                <label class="form-label" for="latInput">
                                    <span>Latitude (Lintang)</span>
                                    <span class="label-badge badge-req">Wajib</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-arrows-up-down"></i></span>
                                    <input type="text" id="latInput" name="latitude" class="form-control mono-num" placeholder="-1.618088" value="{{ old('latitude') }}" required>
                                </div>
                            </div>
                            
                            <!-- Longitude -->
                            <div class="col-sm-6">
                                <label class="form-label" for="lngInput">
                                    <span>Longitude (Bujur)</span>
                                    <span class="label-badge badge-req">Wajib</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-arrows-left-right"></i></span>
                                    <input type="text" id="lngInput" name="longitude" class="form-control mono-num" placeholder="103.600641" value="{{ old('longitude') }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex align-items-center gap-2 pt-3 border-top">
                            <button type="submit" class="btn-submit-main flex-grow-1">
                                <i class="fas fa-floppy-disk"></i> Simpan Data Titik
                            </button>
                            <a href="{{ url('/internal/peta-sigap/data') }}" class="btn-cancel-main">
                                Batal
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: PETA INTERAKTIF -->
            <div class="col-xl-5 col-lg-6">
                <div class="form-panel sticky-map-col">
                    <div class="panel-header">
                        <div class="panel-title">
                            <span class="panel-title-icon"><i class="fas fa-map-location-dot"></i></span>
                            Titik Pada Peta
                        </div>
                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">
                            <i class="fas fa-hand-pointer me-1"></i> Klik & Geser
                        </span>
                    </div>

                    <div class="panel-body">
                        <p class="text-muted small mb-2">
                            Klik pada peta atau geser pin merah ke titik lokasi yang tepat. Kolom koordinat akan terisi secara otomatis.
                        </p>

                        <!-- Peta Wrapper -->
                        <div class="map-wrapper">
                            <div id="mapPicker"></div>
                            <div class="map-badge-overlay">
                                <span class="dot"></span>
                                <span id="mapStatusText">Picker Aktif</span>
                            </div>
                        </div>

                        <!-- Tombol Pintas Peta -->
                        <div class="map-quick-actions">
                            <button type="button" class="btn-quick-loc" id="btnCenterJambi">
                                <i class="fas fa-bullseye text-primary"></i> Pusat Kota Jambi
                            </button>
                            <button type="button" class="btn-quick-loc" id="btnMyLoc">
                                <i class="fas fa-location-crosshairs text-success"></i> Lokasi Saya Saat Ini
                            </button>
                        </div>

                        <div class="mt-3 p-2 bg-light border rounded-2 d-flex align-items-center justify-content-between text-muted" style="font-size: 0.78rem;">
                            <span><i class="fas fa-circle-info text-info me-1"></i> Gunakan scroll / tombol +/- untuk zoom</span>
                            <span class="mono-num text-dark fw-bold" id="coordPreview">0.000000, 0.000000</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

@else
    <div class="alert alert-danger" role="alert">
        <i class="fas fa-lock me-2"></i> Anda tidak memiliki akses untuk membuka halaman ini.
    </div>
@endhasanyrole
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script>
(function () {
    'use strict';

    if (!document.getElementById('mapPicker')) return;

    var defaultLat = -1.6180875;
    var defaultLng = 103.6006406;

    var latInput = document.getElementById('latInput');
    var lngInput = document.getElementById('lngInput');
    var coordPreview = document.getElementById('coordPreview');
    var mapStatusText = document.getElementById('mapStatusText');

    var kategoriSelect = document.getElementById('kategoriSelect');
    var containerTingkatRisiko = document.getElementById('containerTingkatRisiko');
    var tingkatRisikoSelect = document.getElementById('tingkatRisikoSelect');
    var bufferBadgeInfo = document.getElementById('bufferBadgeInfo');
    var riskCardWrapper = document.getElementById('riskCardWrapper');

    var initialLat = latInput.value ? parseFloat(latInput.value) : defaultLat;
    var initialLng = lngInput.value ? parseFloat(lngInput.value) : defaultLng;

    var map = L.map('mapPicker', {
        zoomControl: true,
        scrollWheelZoom: true
    }).setView([initialLat, initialLng], 13);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    var marker = L.marker([initialLat, initialLng], {
        draggable: true
    }).addTo(map);

    var bufferCircle = null;

    var BUFFER_CONFIG = {
        'Tinggi': {
            radius: 1200,
            color: '#dc2626',
            fillColor: '#ef4444',
            fillOpacity: 0.18,
            weight: 2,
            dashArray: '6, 6',
            label: '<span class="text-danger"><i class="fas fa-bullseye me-1"></i> <strong>Buffer Risiko Tinggi:</strong> Radius 1.200 m (1,2 km) aktif di peta</span>',
            cardClass: 'risk-level-card'
        },
        'Sedang': {
            radius: 800,
            color: '#d97706',
            fillColor: '#f59e0b',
            fillOpacity: 0.18,
            weight: 2,
            dashArray: '6, 6',
            label: '<span class="text-warning text-darken-3"><i class="fas fa-bullseye me-1"></i> <strong>Buffer Risiko Sedang:</strong> Radius 800 m aktif di peta</span>',
            cardClass: 'risk-level-card risk-sedang'
        }
    };

    function updateCoordinatesDisplay(lat, lng) {
        var strLat = lat.toFixed(6);
        var strLng = lng.toFixed(6);
        latInput.value = strLat;
        lngInput.value = strLng;
        if (coordPreview) {
            coordPreview.textContent = strLat + ', ' + strLng;
        }
    }

    function updateBuffer() {
        var kat = kategoriSelect ? kategoriSelect.value : '';
        var isZonaRawan = (kat === 'zona_rawan');

        if (containerTingkatRisiko) {
            if (isZonaRawan) {
                containerTingkatRisiko.classList.remove('d-none');
            } else {
                containerTingkatRisiko.classList.add('d-none');
            }
        }

        var latLng = marker.getLatLng();

        if (isZonaRawan && latLng) {
            var tingkat = tingkatRisikoSelect ? tingkatRisikoSelect.value : 'Tinggi';
            var cfg = BUFFER_CONFIG[tingkat] || BUFFER_CONFIG['Tinggi'];

            if (riskCardWrapper) {
                riskCardWrapper.className = cfg.cardClass;
            }

            if (!bufferCircle) {
                bufferCircle = L.circle(latLng, {
                    radius: cfg.radius,
                    color: cfg.color,
                    fillColor: cfg.fillColor,
                    fillOpacity: cfg.fillOpacity,
                    weight: cfg.weight,
                    dashArray: cfg.dashArray
                }).addTo(map);
            } else {
                bufferCircle.setLatLng(latLng);
                bufferCircle.setRadius(cfg.radius);
                bufferCircle.setStyle({
                    color: cfg.color,
                    fillColor: cfg.fillColor,
                    fillOpacity: cfg.fillOpacity,
                    weight: cfg.weight,
                    dashArray: cfg.dashArray
                });
            }

            if (bufferBadgeInfo) {
                bufferBadgeInfo.innerHTML = cfg.label;
            }
        } else {
            if (bufferCircle) {
                map.removeLayer(bufferCircle);
                bufferCircle = null;
            }
            if (bufferBadgeInfo) {
                bufferBadgeInfo.innerHTML = '';
            }
        }
    }

    function updateMapFromInputs() {
        var lat = parseFloat(latInput.value);
        var lng = parseFloat(lngInput.value);
        
        if (!isNaN(lat) && !isNaN(lng)) {
            var newLatLng = new L.LatLng(lat, lng);
            marker.setLatLng(newLatLng);
            map.setView(newLatLng, 15);
            if (coordPreview) coordPreview.textContent = lat.toFixed(6) + ', ' + lng.toFixed(6);
            updateBuffer();
        }
    }

    function handlePaste(e) {
        var pastedText = (e.clipboardData || window.clipboardData).getData('text');
        if (pastedText && pastedText.includes(',')) {
            var parts = pastedText.split(',');
            var parsedLat = parseFloat(parts[0].trim());
            var parsedLng = parseFloat(parts[1].trim());

            if (!isNaN(parsedLat) && !isNaN(parsedLng)) {
                e.preventDefault(); 
                updateCoordinatesDisplay(parsedLat, parsedLng);
                updateMapFromInputs();
            }
        }
    }

    latInput.addEventListener('input', updateMapFromInputs);
    lngInput.addEventListener('input', updateMapFromInputs);
    latInput.addEventListener('paste', handlePaste);
    lngInput.addEventListener('paste', handlePaste);

    marker.on('drag', function () {
        var pos = marker.getLatLng();
        updateCoordinatesDisplay(pos.lat, pos.lng);
        updateBuffer();
    });

    marker.on('dragend', function () {
        var pos = marker.getLatLng();
        updateCoordinatesDisplay(pos.lat, pos.lng);
        updateBuffer();
    });

    map.on('click', function (e) {
        marker.setLatLng(e.latlng);
        updateCoordinatesDisplay(e.latlng.lat, e.latlng.lng);
        updateBuffer();
    });

    if (kategoriSelect) {
        kategoriSelect.addEventListener('change', updateBuffer);
    }
    if (tingkatRisikoSelect) {
        tingkatRisikoSelect.addEventListener('change', updateBuffer);
    }

    // Quick action buttons
    var btnCenterJambi = document.getElementById('btnCenterJambi');
    if (btnCenterJambi) {
        btnCenterJambi.addEventListener('click', function () {
            var centerLatLng = new L.LatLng(defaultLat, defaultLng);
            marker.setLatLng(centerLatLng);
            map.setView(centerLatLng, 14);
            updateCoordinatesDisplay(defaultLat, defaultLng);
            updateBuffer();
        });
    }

    var btnMyLoc = document.getElementById('btnMyLoc');
    if (btnMyLoc) {
        btnMyLoc.addEventListener('click', function () {
            if (navigator.geolocation) {
                btnMyLoc.disabled = true;
                btnMyLoc.innerHTML = '<i class="fas fa-spinner fa-spin text-success"></i> Mendeteksi...';
                navigator.geolocation.getCurrentPosition(function (position) {
                    btnMyLoc.disabled = false;
                    btnMyLoc.innerHTML = '<i class="fas fa-location-crosshairs text-success"></i> Lokasi Saya Saat Ini';
                    var myLat = position.coords.latitude;
                    var myLng = position.coords.longitude;
                    var myLatLng = new L.LatLng(myLat, myLng);
                    marker.setLatLng(myLatLng);
                    map.setView(myLatLng, 16);
                    updateCoordinatesDisplay(myLat, myLng);
                    updateBuffer();
                }, function (err) {
                    btnMyLoc.disabled = false;
                    btnMyLoc.innerHTML = '<i class="fas fa-location-crosshairs text-success"></i> Lokasi Saya Saat Ini';
                    alert('Gagal mendeteksi lokasi GPS Anda: ' + err.message);
                }, { enableHighAccuracy: true, timeout: 8000 });
            } else {
                alert('Browser Anda tidak mendukung deteksi lokasi Geolocation.');
            }
        });
    }

    // Initial setup
    updateCoordinatesDisplay(initialLat, initialLng);
    updateBuffer();
})();
</script>
@endpush

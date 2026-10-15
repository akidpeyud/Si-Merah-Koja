@extends('layouts.dashboard')

@section('title', 'Edit Titik Peta')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css">
<style>
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    @media (max-width: 900px) {
        .sidebar { position: fixed; z-index: 90; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg); }
        .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
    }
    .page-head { margin-bottom: 26px; }
    .page-head p { color: var(--steel); font-size: .95rem; }
    .form-card {
        background: #ffffff;
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        padding: 26px;
        box-shadow: var(--shadow-xs);
        height: 100%;
        transition: box-shadow .2s ease, border-color .2s ease;
    }
    .form-card:hover {
        box-shadow: var(--shadow-sm);
        border-color: #d2dae5;
    }
    .card-title-custom {
        display: flex; align-items: center; gap: 10px;
        margin-bottom: 22px; padding-bottom: 14px;
        border-bottom: 1px solid var(--line);
        font-family: var(--font-display);
        font-size: 1.05rem; font-weight: 700; color: var(--ink);
    }
    .card-title-custom::before {
        content: ""; width: 4px; height: 18px;
        background: var(--navy); border-radius: 4px;
    }
    .form-label { font-size: .88rem; font-weight: 600; color: var(--ink); margin-bottom: 6px; }
    .input-group-text { background: var(--paper); border-color: var(--line-dark); color: var(--steel); border-radius: 8px 0 0 8px; }
    .form-control, .form-select {
        min-height: 44px; font-size: .92rem;
        border: 1px solid var(--line-dark);
        color: var(--ink); box-shadow: none; transition: all .2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--navy);
        box-shadow: 0 0 0 3px var(--navy-soft);
    }
    .input-group .form-control, .input-group .form-select { border-radius: 0 8px 8px 0; }
    .form-control::placeholder { color: var(--steel-soft); }
    textarea.form-control { min-height: 100px; padding: 10px 14px; }
    .btn-submit {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        min-height: 44px; padding: 0 20px;
        background: var(--amber); color: var(--ink);
        border: none; border-radius: 8px;
        font-size: .9rem; font-weight: 600;
        transition: all .2s ease; width: 100%;
    }
    .btn-submit:hover { background: #e5a730; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); }
    .btn-submit:active { transform: translateY(0); }
    #mapPicker {
        border: 1px solid var(--line-dark);
        border-radius: 8px;
        z-index: 1; 
    }
    @media (max-width: 700px) {
        .form-card { padding: 20px; }
        .card-title-custom { font-size: 1rem; }
    }
</style>
@endpush

@section('content')
@section('content')

        <!-- Hanya Super User dan Operator yang boleh mengakses halaman Edit Peta -->
        @hasanyrole('Super User|Operator')
        <div class="page-head d-flex justify-content-between align-items-center">
            <div>
                <h1>Edit Titik Peta SIGAP</h1>
                <p>Perbarui data lokasi operasional untuk peta publik.</p>
            </div>
            <div>
                <a href="/internal/peta-sigap/data" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Kembali ke Data</a>
            </div>
        </div>

        <form action="{{ url('/internal/peta-sigap/update/' . $titik->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- BLOK PENAMPIL ERROR VALIDASI -->
            @if($errors->any())
                <div class="alert alert-danger mb-4" style="border-radius: 8px;">
                    <strong><i class="fas fa-exclamation-triangle"></i> Gagal menyimpan pembaruan!</strong>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-4">
                
                <!-- KOLOM FORMULIR INPUT -->
                <div class="col-xl-7 col-lg-6">
                    <div class="form-card">
                        <div class="card-title-custom">
                            Informasi Lokasi
                        </div>

                        <!-- Kategori Titik -->
                        <div class="mb-3">
                            <label class="form-label">Kategori Peta</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                <select name="kategori" class="form-select" required>
                                    <option value="" disabled>Pilih Kategori...</option>
                                    <option value="kebakaran" {{ (old('kategori') ?? $titik->kategori) == 'kebakaran' ? 'selected' : '' }}>Kebakaran</option>
                                    <option value="sumber_air" {{ (old('kategori') ?? $titik->kategori) == 'sumber_air' ? 'selected' : '' }}>Sumber Air</option>
                                    <option value="hydrant" {{ (old('kategori') ?? $titik->kategori) == 'hydrant' ? 'selected' : '' }}>Hydrant</option>
                                    <option value="penyelamatan" {{ (old('kategori') ?? $titik->kategori) == 'penyelamatan' ? 'selected' : '' }}>Penyelamatan</option>
                                    <option value="pos" {{ (old('kategori') ?? $titik->kategori) == 'pos' ? 'selected' : '' }}>Pos Damkar</option>
                                </select>
                            </div>
                        </div>

                        <!-- Nama/Judul Lokasi -->
                        <div class="mb-3">
                            <label class="form-label">Nama / Judul Titik</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-font"></i></span>
                                <input type="text" name="nama" class="form-control" placeholder="Cth: Kebakaran Lahan Alam Barajo" value="{{ old('nama') ?? $titik->nama }}" required>
                            </div>
                        </div>

                        <!-- Alamat Detail -->
                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="lokasi" class="form-control" placeholder="Masukkan detail lokasi atau nama jalan..." required>{{ old('lokasi') ?? $titik->lokasi }}</textarea>
                        </div>
                        
                        <!-- Keterangan (Opsional) -->
                        <div class="mb-3">
                            <label class="form-label">Keterangan (Opsional)</label>
                            <textarea name="keterangan" class="form-control" placeholder="Tambahkan keterangan lebih lanjut jika ada...">{{ old('keterangan') ?? $titik->keterangan }}</textarea>
                        </div>

                        <!-- Tanggal -->
                        <div class="mb-4">
                            <label class="form-label">Tanggal (Kejadian / Update)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') ?? $titik->tanggal }}" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12 mb-2">
                                <small class="text-muted"><i class="fas fa-info-circle"></i> <b>Tips:</b> Anda bisa langsung mem-paste koordinat dari Google Maps (misal: <code>-1.6180, 103.6006</code>) ke salah satu kolom di bawah ini.</small>
                            </div>
                            <!-- Latitude -->
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Latitude</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                    <input type="text" id="latInput" name="latitude" class="form-control" placeholder="-1.6180" value="{{ old('latitude') ?? $titik->latitude }}" required>
                                </div>
                            </div>
                            
                            <!-- Longitude -->
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Longitude</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                    <input type="text" id="lngInput" name="longitude" class="form-control" placeholder="103.6006" value="{{ old('longitude') ?? $titik->longitude }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>

                <!-- KOLOM PETA INTERAKTIF -->
                <div class="col-xl-5 col-lg-6">
                    <div class="form-card">
                        <div class="card-title-custom">
                            Pilih Lokasi di Peta
                        </div>
                        <p class="text-muted" style="font-size: 0.85rem; margin-top:-10px; margin-bottom:15px;">
                            Geser marker (pin) merah ke lokasi kejadian untuk mengisi kolom Latitude dan Longitude secara otomatis.
                        </p>
                        
                        <!-- Kontainer Peta -->
                        <div id="mapPicker" style="height: 450px;"></div>
                        
                        <div class="alert alert-info mt-3" style="font-size: 0.82rem; padding: 10px;">
                            <i class="fas fa-search-plus me-1"></i> Gunakan tombol ( + ) dan ( - ) di peta untuk melakukan zoom in/out, atau gunakan *scroll* mouse.
                        </div>
                    </div>
                </div>

            </div>
        </form>
        @else
        <div class="alert alert-danger" role="alert">
            <i class="fas fa-lock me-2"></i> Anda tidak memiliki akses untuk membuka halaman edit ini.
        </div>
        @endhasanyrole

<!-- ==================== SCRIPTS ==================== -->
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script>
(function () {
    'use strict';

    /* ---------- UI Behaviors ---------- */
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
    
    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) {
                groups.forEach(function (o) { if (o !== g) o.open = false; });
            }
        });
    });

    /* ---------- LEAFLET MAP PICKER ---------- */
    // Hanya inisialisasi peta jika elemen mapPicker ada (user punya akses)
    if(document.getElementById('mapPicker')) {
        // Nilai awal diambil dari database untuk halaman edit
        var initialLat = {{ $titik->latitude ?? -1.6180875 }};
        var initialLng = {{ $titik->longitude ?? 103.6006406 }};

        var latInput = document.getElementById('latInput');
        var lngInput = document.getElementById('lngInput');

        var map = L.map('mapPicker').setView([initialLat, initialLng], 14);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        var marker = L.marker([initialLat, initialLng], {
            draggable: true
        }).addTo(map);

        // Fungsi update peta dari input manual
        function updateMapFromInputs() {
            var lat = parseFloat(latInput.value);
            var lng = parseFloat(lngInput.value);
            
            if (!isNaN(lat) && !isNaN(lng)) {
                var newLatLng = new L.LatLng(lat, lng);
                marker.setLatLng(newLatLng);
                map.setView(newLatLng, 15);
            }
        }

        // Fungsi handle paste dari Google Maps (Format: "-1.6180, 103.6006")
        function handlePaste(e) {
            var pastedText = (e.clipboardData || window.clipboardData).getData('text');
            
            if (pastedText.includes(',')) {
                var parts = pastedText.split(',');
                var parsedLat = parseFloat(parts[0].trim());
                var parsedLng = parseFloat(parts[1].trim());

                if (!isNaN(parsedLat) && !isNaN(parsedLng)) {
                    e.preventDefault(); 
                    
                    latInput.value = parsedLat;
                    lngInput.value = parsedLng;
                    
                    updateMapFromInputs();
                }
            }
        }

        // Pasang event listener untuk input manual dan paste
        latInput.addEventListener('input', updateMapFromInputs);
        lngInput.addEventListener('input', updateMapFromInputs);
        latInput.addEventListener('paste', handlePaste);
        lngInput.addEventListener('paste', handlePaste);

        // Event ketika marker digeser
        marker.on('dragend', function (e) {
            var position = marker.getLatLng();
            latInput.value = position.lat.toFixed(6);
            lngInput.value = position.lng.toFixed(6);
        });

        // Event ketika peta di-klik
        map.on('click', function (e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            marker.setLatLng([lat, lng]);
            latInput.value = lat.toFixed(6);
            lngInput.value = lng.toFixed(6);
        });

        // Cek jika ada old input error
        if (latInput.value && lngInput.value) {
            updateMapFromInputs();
        }
    }

})();
</script>
@endpush

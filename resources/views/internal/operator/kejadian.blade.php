@extends('layouts.dashboard')

@section('title', 'Kelola Kejadian')

@push('styles')
<style>
    .page-head-bar { display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 18px; margin-bottom: 28px; }
    .page-head p { color: var(--steel); font-size: .95rem; margin: 0; }

    .section-heading { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; flex-wrap: nowrap; }
    .section-heading-ico { flex: none; width: 32px; height: 32px; border-radius: 9px; background: var(--navy); color: #fff; display: grid; place-items: center; font-size: .78rem; box-shadow: 0 4px 8px rgba(22,58,99,.12); }
    .section-heading h3 { flex: none; font-family: var(--font-display); font-weight: 700; font-size: 1rem; color: var(--ink); letter-spacing: -.01em; white-space: nowrap; margin: 0; }
    .section-heading .line { flex: 1 1 auto; min-width: 24px; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }
    .count-pill { flex: none; display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: 999px; background: var(--navy-soft); color: var(--navy); font-size: .78rem; font-weight: 700; }

    .btn-simerah-danger { background: var(--signal); color: #fff; font-weight: 600; font-size: .9rem; border-radius: var(--r-sm); padding: 11px 20px; display: inline-flex; align-items: center; justify-content: center; gap: 9px; border: none; box-shadow: 0 4px 12px rgba(220,53,69,.22); transition: background .2s, transform .15s; }
    .btn-simerah-danger:hover { background: var(--signal-dark); color: #fff; transform: translateY(-1px); }
    .btn-simerah-secondary { background: var(--paper); color: var(--ink); font-weight: 600; font-size: .88rem; border-radius: var(--r-sm); padding: 10px 18px; border: 1px solid var(--line-dark); transition: background .2s; }
    .btn-simerah-secondary:hover { background: var(--line); }

    .card-box { background: #fff; border-radius: var(--r-md); border: 1px solid var(--line); box-shadow: var(--shadow-xs); overflow: hidden; }
    .card-box .kj-toolbar { padding: 18px 20px 0; }

    .kj-filter { display: flex; flex-wrap: wrap; gap: 8px; }
    .kj-filter button { display: inline-flex; align-items: center; gap: 8px; padding: 7px 15px; border-radius: 999px; border: 1px solid var(--line-dark); background: #fff; font-size: .84rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s, border-color .2s; }
    .kj-filter button span { font-size: .74rem; opacity: .65; }
    .kj-filter button:hover { border-color: var(--ink); }
    .kj-filter button.active { background: var(--ink); border-color: var(--ink); color: #fff; }

    .table-simerah { margin-bottom: 0; }
    .table-simerah thead th { font-family: var(--font-display); font-size: .76rem; text-transform: uppercase; letter-spacing: .05em; font-weight: 700; color: var(--steel); background-color: #f8fafc; border-bottom: 1px solid var(--line); padding: 15px 20px; white-space: nowrap; }
    .table-simerah tbody td { padding: 16px 20px; border-bottom: 1px solid var(--line); vertical-align: middle; }
    .table-simerah tbody tr:last-child td { border-bottom: none; }
    .table-simerah tbody tr:hover { background-color: #f9fbfd; }
    .row-num { display: inline-grid; place-items: center; width: 30px; height: 30px; border-radius: 8px; background: var(--paper); color: var(--steel); font-family: var(--font-display); font-weight: 700; font-size: .84rem; }

    .kj-thumb-box { position: relative; display: block; width: 148px; aspect-ratio: 16 / 10; border-radius: var(--r-sm); overflow: hidden; border: 1px solid var(--line); background: var(--ink); box-shadow: var(--shadow-xs); }
    .kj-thumb-box img { width: 100%; height: 100%; object-fit: cover; transition: transform .3s ease, opacity .3s ease; }
    .kj-thumb-box .kj-ph { width: 100%; height: 100%; display: grid; place-items: center; color: rgba(255,255,255,.6); font-size: 1.4rem; }
    a.kj-thumb-box:hover img { transform: scale(1.05); opacity: .88; }

    .kj-title { font-family: var(--font-display); font-weight: 700; font-size: .98rem; color: var(--ink); margin-bottom: 6px; line-height: 1.35; }
    .kj-meta { display: flex; flex-wrap: wrap; align-items: center; gap: 8px 10px; }
    .kj-desc { font-size: .8rem; color: var(--steel); display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; margin-top: 6px; }
    .jenis-badge { display: inline-block; padding: 3px 10px; border-radius: 6px; font-size: .7rem; font-weight: 800; text-transform: uppercase; letter-spacing: .04em; }
    .jenis-pemadaman    { background: #fdecea; color: #bd241c; }
    .jenis-penyelamatan { background: #e8f1fb; color: #163a63; }
    .jenis-evakuasi     { background: #fff4dc; color: #9a6200; }
    .kj-loc { font-size: .8rem; color: var(--steel); }
    .kj-open-link { display: inline-flex; align-items: center; gap: 6px; font-size: .82rem; font-weight: 600; color: var(--signal); padding: 4px 10px; border-radius: 6px; background: var(--signal-soft); transition: background .2s, color .2s; }
    .kj-open-link:hover { background: var(--signal); color: #fff; }

    .action-group { display: inline-flex; align-items: center; gap: 8px; }
    .btn-edit-item { display: inline-flex; align-items: center; gap: 6px; padding: 8px 13px; border-radius: var(--r-sm); font-size: .82rem; font-weight: 600; color: var(--navy); background: var(--navy-soft); border: none; transition: background .2s, color .2s; }
    .btn-edit-item:hover { background: var(--navy); color: #fff; }
    .btn-delete-item { display: inline-flex; align-items: center; gap: 6px; padding: 8px 13px; border-radius: var(--r-sm); font-size: .82rem; font-weight: 600; color: var(--signal-dark); background: var(--signal-soft); border: none; transition: background .2s, color .2s; }
    .btn-delete-item:hover { background: var(--signal); color: #fff; }

    .empty-state { padding: 48px 24px; text-align: center; }
    .empty-ico { width: 56px; height: 56px; border-radius: 16px; background: var(--navy-soft); color: var(--navy); display: grid; place-items: center; font-size: 1.5rem; margin: 0 auto 14px; }
    .empty-state h4 { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; color: var(--ink); margin-bottom: 6px; }
    .empty-state p { color: var(--steel); font-size: .88rem; max-width: 46ch; margin: 0 auto 18px; }

    .modal-content { border-radius: var(--r-lg); border: 1px solid var(--line); box-shadow: var(--shadow-lg); overflow: hidden; font-family: var(--font-body); }
    .modal-header { background: var(--ink); color: #fff; border-bottom: 1px solid rgba(255,255,255,.08); padding: 18px 24px; }
    .modal-title { font-family: var(--font-display); font-weight: 700; font-size: 1.02rem; color: #fff; display: flex; align-items: center; gap: 10px; }
    .modal-header .btn-close { filter: invert(1) grayscale(100%) brightness(200%); opacity: .75; }
    
    /* PERBAIKAN SCROLL: Paksa body modal memiliki tinggi maksimal dan scroll */
    .modal-body { padding: 24px; max-height: 65vh; overflow-y: auto !important; }
    
    .modal-footer { background: #f8fafc; border-top: 1px solid var(--line); padding: 14px 24px; }
    .form-label { font-size: .84rem; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
    .form-control, .form-select { border-radius: var(--r-sm); border: 1px solid var(--line-dark); padding: 10px 14px; font-size: .92rem; color: var(--ink); }
    .form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .form-hint { display: block; font-size: .78rem; color: var(--steel); margin-top: 6px; }
    .kj-preview-card { background: var(--paper); border: 1px dashed var(--line-dark); border-radius: var(--r-md); padding: 14px; text-align: center; }
    .kj-preview-card img { width: 100%; max-width: 280px; aspect-ratio: 16 / 10; object-fit: cover; border-radius: var(--r-sm); margin: 0 auto; border: 1px solid var(--line); }
    .kj-upload-box { padding: 14px; background: var(--paper); border: 1px solid var(--line); border-radius: var(--r-md); transition: opacity .2s; }

    /* PERBAIKAN SCROLL TAMBAHAN */
    .modal { overflow-y: auto !important; }

    @media (max-width: 700px) {
        .btn-simerah-danger.w-mobile-100 { width: 100%; }
        .section-heading h3 { font-size: .92rem; white-space: normal; }
    }
</style>
@endpush

@section('content')

<div class="page-head-bar">
    <div class="page-head">
        <h1>Kelola Pemadaman, Penyelamatan &amp; Evakuasi</h1>
        <p>Tambah laporan kejadian dari link media sosial atau berita, atau upload foto secara manual.</p>
    </div>

    @hasanyrole('Operator|Super User')
    <button type="button" class="btn-simerah-danger w-mobile-100" data-bs-toggle="modal" data-bs-target="#modalTambahKejadian">
        <i class="fas fa-plus"></i> Tambah Kejadian
    </button>
    @endhasanyrole
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        <strong>Data belum bisa disimpan:</strong>
        <ul class="mb-0 mt-1">
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="section-heading">
    <span class="section-heading-ico"><i class="fas fa-truck-medical"></i></span>
    <h3>Daftar Kejadian Tayang</h3>
    <span class="line"></span>
    <span class="count-pill"><i class="fas fa-list"></i> {{ $kejadian->count() }} Kejadian</span>
</div>

<div class="card-box">

    <div class="kj-toolbar">
        <div class="kj-filter" id="kjFilter" role="group" aria-label="Saring berdasarkan jenis">
            <button type="button" class="active" data-filter="all">Semua <span>{{ $kejadian->count() }}</span></button>
            @foreach($jenisList as $val => $label)
                <button type="button" data-filter="{{ $val }}">{{ $label }} <span>{{ $kejadian->where('jenis', $val)->count() }}</span></button>
            @endforeach
        </div>
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-simerah align-middle">
            <thead>
                <tr>
                    <th style="width: 6%;">No</th>
                    <th style="width: 18%;">Foto</th>
                    <th style="width: 38%;">Kejadian</th>
                    <th style="width: 20%;">Tanggal &amp; Sumber</th>

                    @hasanyrole('Operator|Super User')
                    <th style="width: 18%;" class="text-center">Aksi</th>
                    @endhasanyrole
                </tr>
            </thead>
            <tbody>
                @forelse($kejadian as $index => $item)
                @php
                    $tglItem = \Carbon\Carbon::parse($item->tanggal);
                    $fotoItem = $item->thumb ?? null;
                @endphp
                <tr data-jenis="{{ $item->jenis }}">
                    <td><span class="row-num">{{ $index + 1 }}</span></td>
                    <td>
                        @if($item->link)
                            <a href="{{ $item->link }}" target="_blank" rel="noopener noreferrer" class="kj-thumb-box" title="Buka: {{ $item->judul }}">
                        @else
                            <div class="kj-thumb-box">
                        @endif
                            @if($fotoItem)
                                <img src="{{ $fotoItem }}" alt="Foto {{ $item->judul }}" loading="lazy" onerror="this.src='/images/placeholder.jpg'">
                            @else
                                <span class="kj-ph"><i class="fas fa-fire-extinguisher"></i></span>
                            @endif
                        @if($item->link)
                            </a>
                        @else
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="kj-title">{{ $item->judul }}</div>
                        <div class="kj-meta">
                            <span class="jenis-badge jenis-{{ $item->jenis }}">{{ $jenisList[$item->jenis] ?? $item->jenis }}</span>
                            @if($item->lokasi)
                                <span class="kj-loc"><i class="fas fa-location-dot me-1"></i>{{ $item->lokasi }}</span>
                            @endif
                            @if($item->link)
                                <a href="{{ $item->link }}" target="_blank" rel="noopener noreferrer" class="kj-open-link">
                                    <i class="fas fa-arrow-up-right-from-square"></i> Buka tautan
                                </a>
                            @endif
                        </div>
                        @if($item->deskripsi)
                            <div class="kj-desc">{{ $item->deskripsi }}</div>
                        @endif
                    </td>
                    <td>
                        <div class="small fw-semibold text-dark"><i class="far fa-calendar-alt text-muted me-1"></i>{{ $tglItem->format('d M Y H:i') }}</div>
                        <div class="small text-muted"><i class="fas fa-link me-1"></i>{{ $item->sumber ?? '-' }}</div>
                    </td>

                    @hasanyrole('Operator|Super User')
                    <td class="text-center">
                        <div class="action-group">
                            <button type="button" class="btn-edit-item" data-bs-toggle="modal" data-bs-target="#modalEditKejadian{{ $item->id }}">
                                <i class="fas fa-pen-to-square"></i> Edit
                            </button>
                            <form action="/internal/operator/kejadian/hapus/{{ $item->id }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus data kejadian ini?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete-item"><i class="fas fa-trash-can"></i> Hapus</button>
                            </form>
                        </div>
                    </td>
                    @endhasanyrole
                </tr>
                @empty
                <tr>
                    <td colspan="@hasanyrole('Operator|Super User') 5 @else 4 @endhasanyrole">
                        <div class="empty-state">
                            <div class="empty-ico"><i class="fas fa-truck-medical"></i></div>
                            <h4>Belum Ada Data Kejadian</h4>
                            <p>Tambahkan kejadian dari link YouTube, TikTok, Instagram, X, Facebook, atau berita web agar tampil di halaman utama.</p>

                            @hasanyrole('Operator|Super User')
                            <button type="button" class="btn-simerah-danger" data-bs-toggle="modal" data-bs-target="#modalTambahKejadian">
                                <i class="fas fa-plus"></i> Tambah Kejadian Pertama
                            </button>
                            @endhasanyrole
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <p class="text-center text-muted py-4 mb-0 d-none" id="kjFilterEmpty">Tidak ada data untuk jenis ini.</p>
</div>

@hasanyrole('Operator|Super User')

{{-- ================= MODAL EDIT (di luar tabel supaya HTML valid) ================= --}}
@foreach($kejadian as $item)
<div class="modal fade" id="modalEditKejadian{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form action="/internal/operator/kejadian/update/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-pen-to-square text-warning"></i> Edit Kejadian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="mb-3">
                        <label class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="judul" value="{{ $item->judul }}" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label">Jenis <span class="text-danger">*</span></label>
                            <select class="form-select" name="jenis" required>
                                @foreach($jenisList as $val => $label)
                                    <option value="{{ $val }}" {{ $item->jenis === $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Tanggal &amp; Waktu <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" name="tanggal" value="{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d\TH:i') }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lokasi Kejadian</label>
                        <input type="text" class="form-control" name="lokasi" value="{{ $item->lokasi }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3">{{ $item->deskripsi }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Link Postingan (Opsional)</label>
                        <input type="url" class="form-control" name="link" value="{{ $item->link }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sumber</label>
                        <input type="text" class="form-control" name="sumber" value="{{ $item->sumber }}">
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Ganti Foto (Opsional)</label>
                        @if(!empty($item->thumb))
                            <div class="mb-2">
                                <img src="{{ $item->thumb }}" alt="Foto saat ini" style="height:70px;border-radius:8px;border:1px solid var(--line);" onerror="this.style.display='none'">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="gambar" accept=".jpg,.jpeg,.png,.webp">
                        <span class="form-hint">Biarkan kosong bila foto tidak diganti. Maksimal 2 MB.</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-simerah-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-simerah-danger"><i class="fas fa-floppy-disk"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

{{-- ================= MODAL TAMBAH KEJADIAN (HYBRID) ================= --}}
<div class="modal fade" id="modalTambahKejadian" tabindex="-1" aria-labelledby="modalTambahKejadianLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form action="/internal/operator/kejadian/store" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_form" value="tambah">
                <input type="hidden" name="gambar_url" id="kjGambarUrl" value="{{ old('gambar_url') }}">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahKejadianLabel">
                        <i class="fas fa-truck-medical text-warning"></i> Tambah Kejadian
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body text-start">
                    <div class="mb-3">
                        <label for="kjLink" class="form-label">Link Postingan (YouTube / TikTok / Instagram / X / Facebook / Berita)</label>
                        <div class="input-group">
                            <input type="url" class="form-control" id="kjLink" name="link" value="{{ old('link') }}" placeholder="Tempel URL di sini (boleh dikosongkan bila upload foto manual)">
                            <button class="btn btn-primary fw-semibold" type="button" id="kjTarik" style="background:var(--navy);border:none;">Tarik Data</button>
                        </div>
                        <span class="form-hint"><i class="fas fa-circle-info me-1"></i> Klik "Tarik Data" untuk mengisi judul, tanggal, sumber, dan gambar secara otomatis.</span>
                    </div>

                    <div class="mb-3 d-none kj-preview-card" id="kjPreviewArea">
                        <div class="small fw-bold text-muted mb-2"><i class="fas fa-image me-1"></i>Pratinjau gambar</div>
                        <img src="" id="kjPreview" alt="Pratinjau gambar kejadian">
                    </div>

                    <div class="mb-3">
                        <label for="kjJudul" class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="kjJudul" name="judul" value="{{ old('judul') }}" placeholder="Tulis judul kejadian" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label">Jenis <span class="text-danger">*</span></label>
                            <select class="form-select" name="jenis" required>
                                <option value="">-- Pilih Jenis --</option>
                                @foreach($jenisList as $val => $label)
                                    <option value="{{ $val }}" {{ old('jenis') === $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Tanggal &amp; Waktu <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="kjTanggal" name="tanggal" value="{{ old('tanggal', now()->format('Y-m-d\TH:i')) }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lokasi Kejadian</label>
                        <input type="text" class="form-control" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Jl. Sultan Thaha, Kota Jambi">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi (Opsional)</label>
                        <textarea class="form-control" name="deskripsi" rows="3" placeholder="Ringkasan kejadian dan penanganan">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="kjSumber" class="form-label">Sumber</label>
                        <input type="text" class="form-control" id="kjSumber" name="sumber" value="{{ old('sumber') }}" placeholder="Terisi otomatis dari link, bisa diubah">
                    </div>

                    <div class="kj-upload-box" id="kjUploadArea">
                        <label for="kjGambarManual" class="form-label">Upload Foto Manual</label>
                        <input type="file" class="form-control" id="kjGambarManual" name="gambar_manual" accept=".jpg,.jpeg,.png,.webp">
                        <span class="form-hint text-danger fw-semibold">Wajib diisi bila Tarik Data tidak mendapat gambar (kecuali link YouTube). Maksimal 2 MB.</span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-simerah-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-simerah-danger"><i class="fas fa-floppy-disk"></i> Simpan Kejadian</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endhasanyrole
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    /* ---------- Saring tabel berdasarkan jenis ---------- */
    var filterBox = document.getElementById('kjFilter');
    if (filterBox) {
        var rows  = [].slice.call(document.querySelectorAll('tbody tr[data-jenis]'));
        var empty = document.getElementById('kjFilterEmpty');

        filterBox.addEventListener('click', function (e) {
            var b = e.target.closest('button[data-filter]');
            if (!b) return;

            var f = b.getAttribute('data-filter');
            [].forEach.call(filterBox.querySelectorAll('button'), function (x) { x.classList.toggle('active', x === b); });

            var shown = 0;
            rows.forEach(function (r) {
                var ok = f === 'all' || r.getAttribute('data-jenis') === f;
                r.style.display = ok ? '' : 'none';
                if (ok) shown++;
            });
            if (empty) empty.classList.toggle('d-none', shown > 0 || rows.length === 0);
        });
    }

    /* ---------- Tarik Data (hanya ada bila modal tambah dirender) ---------- */
    var btn = document.getElementById('kjTarik');
    if (!btn) return;

    var inLink   = document.getElementById('kjLink');
    var inJudul  = document.getElementById('kjJudul');
    var inTgl    = document.getElementById('kjTanggal');
    var inSumber = document.getElementById('kjSumber');
    var inUrl    = document.getElementById('kjGambarUrl');
    var inFile   = document.getElementById('kjGambarManual');
    var area     = document.getElementById('kjPreviewArea');
    var img      = document.getElementById('kjPreview');
    var upload   = document.getElementById('kjUploadArea');
    var modalEl  = document.getElementById('modalTambahKejadian');

    function showPreview(src) {
        img.src = src;
        area.classList.remove('d-none');
    }

    btn.addEventListener('click', function () {
        var url = inLink.value.trim();
        if (!url) { alert('Mohon tempelkan tautan postingan terlebih dahulu!'); return; }

        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Proses...';
        btn.disabled = true;

        fetch('/internal/operator/kejadian/preview', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ url: url })
        })
        .then(async function (res) {
            var isJson = (res.headers.get('content-type') || '').includes('application/json');
            var data = isJson ? await res.json() : null;
            if (!res.ok) throw new Error((data && data.error) ? data.error : 'Server menolak permintaan preview.');
            return data;
        })
        .then(function (data) {
            if (data.final_url) inLink.value   = data.final_url;   // link pendek diganti alamat aslinya
            if (data.title)     inJudul.value  = data.title;
            if (data.date)      inTgl.value    = data.date;
            if (data.site_name) inSumber.value = data.site_name;

            if (data.image) {
                inUrl.value = data.image;
                inFile.value = '';
                upload.style.opacity = '.5';
                showPreview(data.image);
            } else {
                alert('Gambar tidak dapat diekstrak otomatis. Silakan upload foto manual (kecuali link YouTube).');
            }
        })
        .catch(function (err) {
            alert('Gagal mengambil data otomatis (' + err.message + '). Silakan isi form dan upload gambar secara manual.');
        })
        .finally(function () {
            btn.innerHTML = 'Tarik Data';
            btn.disabled = false;
        });
    });

    /* ---------- Upload manual: tampilkan pratinjau & utamakan file ini ---------- */
    inFile.addEventListener('change', function () {
        if (!this.files.length) { upload.style.opacity = '1'; return; }
        var reader = new FileReader();
        reader.onload = function (e) { showPreview(e.target.result); };
        reader.readAsDataURL(this.files[0]);
        inUrl.value = '';
        upload.style.opacity = '1';
    });

    /* ---------- Reset pratinjau saat modal ditutup ---------- */
    modalEl.addEventListener('hidden.bs.modal', function () {
        area.classList.add('d-none');
        inUrl.value = '';
        upload.style.opacity = '1';
    });

    /* ---------- Buka kembali modal tambah bila validasi gagal ---------- */
    @if($errors->any() && old('_form') === 'tambah')
    window.addEventListener('load', function () {
        if (window.bootstrap) { new bootstrap.Modal(modalEl).show(); }
    });
    @endif
})();
</script>
@endpush
@extends('layouts.dashboard')

@section('title')Tambah {{ $judulKategori ?? 'Produk Hukum' }}@endsection

@push('styles')
<style>
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    .card-container { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 28px; box-shadow: var(--shadow-xs); }
    .form-label { font-weight: 600; font-size: .88rem; color: var(--ink); margin-bottom: 6px; }
    .form-control { border-radius: 8px; border: 1px solid var(--line-dark); padding: 10px 14px; font-size: .92rem; }
    .form-control:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .btn-simpan { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 42px; padding: 0 22px; background: var(--navy); color: #fff; border: none; border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s ease; }
    .btn-simpan:hover { background: var(--navy-dark); color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); }
    .btn-kembali { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 42px; padding: 0 18px; background: #fff; color: var(--ink); border: 1px solid var(--line-dark); border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s ease; }
    .btn-kembali:hover { background: #f3f6fa; color: var(--ink); }
</style>
@endpush

@section('content')
@section('content')

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px;">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
            <div class="page-head mb-0">
                <h1>Tambah {{ $judulKategori }}</h1>
                <p>Formulir penambahan dokumen {{ strtolower($judulKategori) }} baru.</p>
            </div>
            
            <a href="{{ route('internal.produk-hukum.index', $kategori) }}" class="btn-kembali text-decoration-none">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="card-container">
            <form action="{{ route('internal.produk-hukum.store', $kategori) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-md-8">
                        <label for="nomor" class="form-label">Nomor Peraturan</label>
                        <input type="text" name="nomor" id="nomor" class="form-control @error('nomor') is-invalid @enderror" placeholder="Contoh: Nomor 24 Tahun 2007" value="{{ old('nomor') }}">
                        @error('nomor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="tahun" class="form-label">Tahun Penetapan</label>
                        <input type="number" name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror" placeholder="Contoh: 2026" min="1945" max="2100" value="{{ old('tahun', date('Y')) }}">
                        @error('tahun')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="judul" class="form-label">Judul / Tentang <span class="text-danger">*</span></label>
                        <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" placeholder="Masukkan judul atau tentang peraturan..." value="{{ old('judul') }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="keterangan" class="form-label">Keterangan / Ringkasan</label>
                        <textarea name="keterangan" id="keterangan" rows="4" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Tuliskan keterangan atau ringkasan singkat peraturan (opsional)...">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="file_dokumen" class="form-label">Unggah Dokumen (Hanya PDF, Maks. 10MB) <span class="text-danger">*</span></label>
                        <input type="file" name="file_dokumen" id="file_dokumen" class="form-control @error('file_dokumen') is-invalid @enderror" accept="application/pdf,.pdf" required>
                        <small class="text-muted d-block mt-1">Format file wajib <b>.pdf</b> dan pastikan dokumen terbaca dengan jelas.</small>
                        @error('file_dokumen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 pt-2 border-top d-flex justify-content-end gap-2">
                        <a href="{{ route('internal.produk-hukum.index', $kategori) }}" class="btn-kembali text-decoration-none">Batal</a>
                        <button type="submit" class="btn-simpan">
                            <i class="fas fa-floppy-disk"></i> Simpan {{ $judulKategori }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    document.querySelectorAll('[data-toast]').forEach(function (t) {
        var hide = function () {
            t.classList.add('leaving');
            setTimeout(function () { t.remove(); }, 350);
        };
        var x = t.querySelector('[data-toast-close]');
        if (x) x.addEventListener('click', hide);
        setTimeout(hide, 4500);
    });

    var toggle = document.getElementById('sideToggle');
    var backdrop = document.getElementById('sideBackdrop');

    function closeSide() {
        document.body.classList.remove('side-open');
        if(toggle) toggle.setAttribute('aria-expanded', 'false');
    }
    if (toggle) {
        toggle.addEventListener('click', function () {
            var open = document.body.classList.toggle('side-open');
            toggle.setAttribute('aria-expanded', open);
        });
    }
    if (backdrop) backdrop.addEventListener('click', closeSide);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeSide(); });

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
@endpush

@extends('layouts.dashboard')

@section('title')Edit {{ $judulKategori ?? 'Profil Instansi' }}@endsection

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
                <h1>Edit {{ $judulKategori }}</h1>
                <p>Perbarui informasi atau berkas dokumen {{ strtolower($judulKategori) }}.</p>
            </div>
            
            <a href="{{ route('internal.profil-instansi.index', $kategori) }}" class="btn-kembali text-decoration-none">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="card-container">
            <form action="{{ route('internal.profil-instansi.update', [$kategori, $item->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    @if($kategori === 'sotk')
                    @php
                        $currentSubKat = old('sub_kategori', $item->sub_kategori);
                        $selectedPos = old('pos_pelayanan');
                        if (!$selectedPos && $currentSubKat === 'pos_pelayanan') {
                            foreach (['Alam Barajo', 'Paal Merah', 'Jambi Kota Seberang', 'Jambi Timur', 'Kota Baru', 'Pelayangan'] as $pName) {
                                if (str_contains($item->judul, $pName)) {
                                    $selectedPos = $pName;
                                    break;
                                }
                            }
                        }
                    @endphp
                    <div class="col-md-6">
                        <label for="sub_kategori" class="form-label">Kategori Kontainer SOTK <span class="text-danger">*</span></label>
                        <select name="sub_kategori" id="sub_kategori" class="form-select @error('sub_kategori') is-invalid @enderror" required>
                            <option value="">-- Pilih Kontainer SOTK --</option>
                            <option value="dinas" {{ $currentSubKat === 'dinas' ? 'selected' : '' }}>Struktur Organisasi Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi</option>
                            <option value="komando" {{ $currentSubKat === 'komando' ? 'selected' : '' }}>Struktur Organisasi Komando Kebakaran dan Penyelamatan Regu 1, Regu 2, Regu 3</option>
                            <option value="sekretariat" {{ $currentSubKat === 'sekretariat' ? 'selected' : '' }}>Struktur Organisasi Sekretariat</option>
                            <option value="bidang_pencegahan" {{ $currentSubKat === 'bidang_pencegahan' ? 'selected' : '' }}>Struktur Organisasi Bidang Pencegahan</option>
                            <option value="bidang_sapra" {{ $currentSubKat === 'bidang_sapra' ? 'selected' : '' }}>Struktur Organisasi Bidang Sapra</option>
                            <option value="bidang_damtan" {{ $currentSubKat === 'bidang_damtan' ? 'selected' : '' }}>Struktur Organisasi Bidang Damtan</option>
                            <option value="pos_pelayanan" {{ $currentSubKat === 'pos_pelayanan' ? 'selected' : '' }}>Struktur Organisasi Pos Pelayanan</option>
                        </select>
                        <small class="text-muted d-block mt-1">Pilih salah satu dari 7 kontainer SOTK.</small>
                        @error('sub_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6" id="wrap_pos_pelayanan" style="{{ $currentSubKat === 'pos_pelayanan' ? '' : 'display: none;' }}">
                        <label for="pos_pelayanan" class="form-label">Kategori Pos Pelayanan <span class="text-danger">*</span></label>
                        <select name="pos_pelayanan" id="pos_pelayanan" class="form-select @error('pos_pelayanan') is-invalid @enderror">
                            <option value="">-- Pilih Wilayah Pos Pelayanan --</option>
                            <option value="Alam Barajo" {{ $selectedPos === 'Alam Barajo' ? 'selected' : '' }}>Pos Pelayanan Alam Barajo</option>
                            <option value="Paal Merah" {{ $selectedPos === 'Paal Merah' ? 'selected' : '' }}>Pos Pelayanan Paal Merah</option>
                            <option value="Jambi Kota Seberang" {{ $selectedPos === 'Jambi Kota Seberang' ? 'selected' : '' }}>Pos Pelayanan Jambi Kota Seberang</option>
                            <option value="Jambi Timur" {{ $selectedPos === 'Jambi Timur' ? 'selected' : '' }}>Pos Pelayanan Jambi Timur</option>
                            <option value="Kota Baru" {{ $selectedPos === 'Kota Baru' ? 'selected' : '' }}>Pos Pelayanan Kota Baru</option>
                            <option value="Pelayangan" {{ $selectedPos === 'Pelayangan' ? 'selected' : '' }}>Pos Pelayanan Pelayangan</option>
                        </select>
                        <small class="text-muted d-block mt-1">Pilih wilayah pos pelayanan yang sesuai.</small>
                        @error('pos_pelayanan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif

                    <div class="col-md-8">
                        <label for="judul" class="form-label">Judul / Nama Dokumen <span class="text-danger">*</span></label>
                        <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $item->judul) }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="tahun" class="form-label">Tahun Periode / Penetapan</label>
                        <input type="number" name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror" placeholder="Contoh: 2026" min="1945" max="2100" value="{{ old('tahun', $item->tahun) }}">
                        @error('tahun')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="keterangan" class="form-label">Keterangan / Ringkasan</label>
                        <textarea name="keterangan" id="keterangan" rows="4" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $item->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="file_dokumen" class="form-label">Ganti Dokumen (Opsional, PDF / JPG / PNG, Maks. 10MB)</label>
                        <input type="file" name="file_dokumen" id="file_dokumen" class="form-control @error('file_dokumen') is-invalid @enderror" accept="application/pdf,.pdf,image/jpeg,image/png,.jpg,.jpeg,.png">
                        <input type="hidden" name="file_dokumen_base64" id="file_dokumen_base64">
                        <input type="hidden" name="file_dokumen_name" id="file_dokumen_name">
                        <small class="text-muted d-block mt-1">
                            Biarkan kosong jika tidak ingin mengganti dokumen lama (Format: <b>.pdf</b>, <b>.jpg</b>, <b>.jpeg</b>, atau <b>.png</b>).
                            @if($item->file_dokumen)
                                <a href="{{ route('internal.profil-instansi.download-file', [$kategori, $item->id]) }}" class="text-primary fw-semibold ms-1">
                                    <i class="fas fa-download"></i> Unduh File Saat Ini
                                </a>
                            @endif
                        </small>
                        @error('file_dokumen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 pt-2 border-top d-flex justify-content-end gap-2">
                        <a href="{{ route('internal.profil-instansi.index', $kategori) }}" class="btn-kembali text-decoration-none">Batal</a>
                        <button type="submit" class="btn-simpan">
                            <i class="fas fa-floppy-disk"></i> Simpan Perubahan
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

    // SOTK Dropdown & Autoname Judul
    var subKatSelect = document.getElementById('sub_kategori');
    var wrapPos = document.getElementById('wrap_pos_pelayanan');
    var posSelect = document.getElementById('pos_pelayanan');
    var judulInput = document.getElementById('judul');

    var sotkTitlesMap = {
        'dinas': 'Struktur Organisasi Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi',
        'komando': 'Struktur Organisasi Komando Kebakaran dan Penyelamatan Regu 1, Regu 2, Regu 3',
        'sekretariat': 'Struktur Organisasi Sekretariat',
        'bidang_pencegahan': 'Struktur Organisasi Bidang Pencegahan',
        'bidang_sapra': 'Struktur Organisasi Bidang Sapra',
        'bidang_damtan': 'Struktur Organisasi Bidang Damtan'
    };

    if (subKatSelect) {
        subKatSelect.addEventListener('change', function () {
            var val = subKatSelect.value;
            if (val === 'pos_pelayanan') {
                if (wrapPos) wrapPos.style.display = '';
                if (posSelect && posSelect.value) {
                    judulInput.value = 'Struktur Organisasi Pos Pelayanan ' + posSelect.value;
                }
            } else {
                if (wrapPos) wrapPos.style.display = 'none';
                if (sotkTitlesMap[val]) {
                    judulInput.value = sotkTitlesMap[val];
                }
            }
        });
    }

    if (posSelect) {
        posSelect.addEventListener('change', function () {
            if (posSelect.value && subKatSelect && subKatSelect.value === 'pos_pelayanan') {
                judulInput.value = 'Struktur Organisasi Pos Pelayanan ' + posSelect.value;
            }
        });
    }

    // Handle file upload fallback (Base64) to bypass small php.ini upload_max_filesize
    var fileInput = document.getElementById('file_dokumen');
    var base64Input = document.getElementById('file_dokumen_base64');
    var nameInput = document.getElementById('file_dokumen_name');

    if (fileInput && base64Input && nameInput) {
        fileInput.addEventListener('change', function () {
            var file = fileInput.files && fileInput.files[0];
            if (!file) {
                base64Input.value = '';
                nameInput.value = '';
                return;
            }
            if (file.size > 10 * 1024 * 1024) {
                alert('Ukuran file maksimal 10MB.');
                fileInput.value = '';
                base64Input.value = '';
                nameInput.value = '';
                return;
            }
            nameInput.value = file.name;
            var reader = new FileReader();
            reader.onload = function (e) {
                base64Input.value = e.target.result;
            };
            reader.readAsDataURL(file);
        });

        var form = fileInput.closest('form');
        if (form) {
            form.addEventListener('submit', function () {
                if (base64Input.value) {
                    fileInput.removeAttribute('name');
                }
            });
        }
    }
})();
</script>
@endpush

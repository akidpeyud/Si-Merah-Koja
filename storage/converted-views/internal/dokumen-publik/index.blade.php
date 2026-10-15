@extends('layouts.dashboard')

@section('title', 'Kelola Dokumen Publik')

@push('styles')
<style>
    .toast-wrap { position: fixed; z-index: 2000; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    @media (max-width: 900px) {
        .sidebar { position: fixed; z-index: 90; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg); }
        .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
    }
    .page-head { margin-bottom: 26px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; }
    .page-head-text h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-head-text p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }
    .base-card {
        background: #ffffff;
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        padding: 26px;
        box-shadow: var(--shadow-xs);
        transition: box-shadow .2s ease;
    }
    .base-card:hover { box-shadow: var(--shadow-sm); }
    .card-title-custom {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 22px; padding-bottom: 14px;
        border-bottom: 1px solid var(--line);
        font-family: var(--font-display);
        font-size: 1.05rem; font-weight: 700; color: var(--ink);
        flex-wrap: wrap; gap: 12px;
    }
    .card-title-custom .title-left { display: flex; align-items: center; gap: 10px; }
    .card-title-custom .title-left::before {
        content: ""; width: 4px; height: 18px;
        background: var(--navy); border-radius: 4px;
    }
    .table-responsive { border-radius: var(--r-sm); border: 1px solid var(--line); overflow: hidden; }
    .table { margin-bottom: 0; font-size: .92rem; }
    .table thead th { 
        background: var(--paper); color: var(--steel); 
        font-size: .8rem; font-weight: 700; text-transform: uppercase; 
        letter-spacing: .04em; border-bottom: 1px solid var(--line-dark);
        padding: 14px 16px;
    }
    .table tbody td { padding: 14px 16px; vertical-align: middle; border-bottom: 1px solid var(--line); color: var(--ink); }
    .table tbody tr:last-child td { border-bottom: none; }
    .table tbody tr:hover { background-color: var(--navy-soft); }
    .badge-kategori {
        display: inline-flex; align-items: center;
        padding: 5px 12px; border-radius: 6px;
        font-size: .75rem; font-weight: 700; text-transform: uppercase;
        background: var(--navy-soft); color: var(--navy);
    }
    .form-label { font-size: .88rem; font-weight: 600; color: var(--ink); margin-bottom: 6px; }
    .form-control, .form-select {
        min-height: 44px; font-size: .92rem;
        border: 1px solid var(--line-dark);
        border-radius: 8px; color: var(--ink);
        box-shadow: none; transition: all .2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--navy);
        box-shadow: 0 0 0 3px var(--navy-soft);
    }
    .form-control::file-selector-button {
        background: var(--paper); color: var(--ink);
        border: none; border-right: 1px solid var(--line-dark);
        padding: 0 16px; margin-right: 12px; height: 100%;
        font-weight: 600; transition: background .2s;
    }
    .form-control::file-selector-button:hover { background: var(--line); }
    .btn-primary-custom {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        min-height: 44px; padding: 0 20px;
        background: var(--navy); color: #fff;
        border: none; border-radius: 8px;
        font-size: .9rem; font-weight: 600;
        transition: all .2s ease;
    }
    .btn-primary-custom:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); color: #fff; }
    .btn-icon {
        display: inline-flex; align-items: center; justify-content: center;
        width: 34px; height: 34px; border-radius: 6px; border: none;
        font-size: .9rem; transition: all .2s ease;
    }
    .btn-icon.edit { background: var(--info-soft); color: var(--info); }
    .btn-icon.edit:hover { background: var(--info); color: #fff; }
    .btn-icon.delete { background: var(--signal-soft); color: var(--signal-dark); }
    .btn-icon.delete:hover { background: var(--signal); color: #fff; }
    .modal-content { border: none; border-radius: var(--r-md); box-shadow: var(--shadow-lg); }
    .modal-header { border-bottom: 1px solid var(--line); padding: 20px 24px; }
    .modal-title { font-family: var(--font-display); font-weight: 700; font-size: 1.2rem; }
    .modal-body { padding: 24px; }
    .modal-footer { border-top: 1px solid var(--line); padding: 16px 24px; background: var(--paper); border-radius: 0 0 var(--r-md) var(--r-md); }
    @media (max-width: 700px) {
        .base-card { padding: 20px; }
        .card-title-custom { flex-direction: column; align-items: flex-start; gap: 14px; }
    }
</style>
@endpush

@section('content')
@section('content')

        <div class="page-head">
            <div class="page-head-text">
                <h1>Dokumen Publik</h1>
                <p>Manajemen file dokumen publik (Renstra, Renja, SPM, SAKIP, dan LPPD).</p>
            </div>
            @hasanyrole('Super User|Sekretariat|Operator')
            <button type="button" class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah Dokumen
            </button>
            @endhasanyrole
        </div>

        <!-- Tabel Data & Filter -->
        <div class="base-card">
            <div class="card-title-custom">
                <div class="title-left">Daftar Dokumen Publik Terpublikasi</div>
                
                <!-- Form Filter Dropdown Berdasarkan Kategori Dokumen -->
                <form method="GET" action="{{ route('dokumen-publik.index') }}" class="d-flex align-items-center">
                    <select name="kategori" class="form-select form-select-sm" style="min-width: 220px;" onchange="this.form.submit()">
                        <option value="">-- Semua Kategori --</option>
                        <option value="Renstra" {{ request('kategori') == 'Renstra' ? 'selected' : '' }}>Renstra</option>
                        <option value="Renja" {{ request('kategori') == 'Renja' ? 'selected' : '' }}>Renja</option>
                        <option value="SPM" {{ request('kategori') == 'SPM' ? 'selected' : '' }}>SPM</option>
                        <option value="SAKIP" {{ request('kategori') == 'SAKIP' ? 'selected' : '' }}>SAKIP</option>
                        <option value="LPPD" {{ request('kategori') == 'LPPD' ? 'selected' : '' }}>LPPD</option>
                    </select>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Judul Dokumen</th>
                            <th width="15%">Kategori</th>
                            <th width="10%">Tahun</th>
                            <th width="18%">File</th>
                            <th width="12%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dokumens as $index => $item)
                        <tr>
                            <td>{{ $dokumens->firstItem() + $index }}</td>
                            <td>
                                <strong>{{ $item->judul }}</strong>
                                @if($item->deskripsi)
                                    <br><small class="text-muted">{{ Str::limit($item->deskripsi, 50) }}</small>
                                @endif
                            </td>
                            <td><span class="badge-kategori">{{ $item->kategori }}</span></td>
                            <td>{{ $item->tahun ?? '-' }}</td>
                            <td>
                                @if($item->file_path)
                                    <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="text-primary text-decoration-none">
                                        <i class="fas fa-download"></i> Unduh File
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada file</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @hasanyrole('Super User|Sekretariat|Operator')
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn-icon edit" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}" title="Edit Data">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <form action="{{ route('dokumen-publik.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?');" style="margin:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon delete" title="Hapus Data"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                                @else
                                    <span class="text-muted" style="font-size: .8rem;"><i>Tidak ada akses</i></span>
                                @endhasanyrole
                            </td>
                        </tr>

                        <!-- MODAL EDIT DATA -->
                        @hasanyrole('Super User|Sekretariat|Operator')
                        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditLabel{{ $item->id }}">Edit Dokumen Publik</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('dokumen-publik.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body text-start">
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Judul Dokumen</label>
                                                <input type="text" name="judul" class="form-control" value="{{ $item->judul }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Kategori</label>
                                                <select name="kategori" class="form-select" required>
                                                    <option value="Renstra" {{ $item->kategori == 'Renstra' ? 'selected' : '' }}>Renstra</option>
                                                    <option value="Renja" {{ $item->kategori == 'Renja' ? 'selected' : '' }}>Renja</option>
                                                    <option value="SPM" {{ $item->kategori == 'SPM' ? 'selected' : '' }}>SPM</option>
                                                    <option value="SAKIP" {{ $item->kategori == 'SAKIP' ? 'selected' : '' }}>SAKIP</option>
                                                    <option value="LPPD" {{ $item->kategori == 'LPPD' ? 'selected' : '' }}>LPPD</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Tahun</label>
                                                <input type="number" name="tahun" class="form-control" value="{{ $item->tahun }}" placeholder="Contoh: 2026">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Ganti File (Opsional)</label>
                                                <input type="file" name="file_dok" class="form-control" accept=".pdf,.doc,.docx">
                                                <small class="text-muted mt-1 d-block">Format: PDF, DOC, DOCX. Maksimal 10MB.</small>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label">Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control" rows="3" placeholder="Keterangan singkat dokumen...">{{ $item->deskripsi }}</textarea>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light border" data-bs-dismiss="modal" style="min-height: 44px; border-radius: 8px;">Batal</button>
                                            <button type="submit" class="btn-primary-custom">
                                                <i class="fas fa-save"></i> Perbarui Dokumen
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endhasanyrole

                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada data dokumen publik yang tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            @if(method_exists($dokumens, 'links'))
                <div class="mt-4">
                    {{ $dokumens->withQueryString()->links() }}
                </div>
            @endif

        </div>

<!-- ==================== MODAL TAMBAH DATA ==================== -->
@hasanyrole('Super User|Sekretariat|Operator')
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Dokumen Publik Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dokumen-publik.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body text-start">
                    
                    <div class="mb-3">
                        <label class="form-label">Judul Dokumen</label>
                        <input type="text" name="judul" class="form-control" placeholder="Contoh: Renstra Dinas Tahun 2026-2031" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="" disabled selected>Pilih Kategori...</option>
                            <option value="Renstra">Renstra</option>
                            <option value="Renja">Renja</option>
                            <option value="SPM">SPM</option>
                            <option value="SAKIP">SAKIP</option>
                            <option value="LPPD">LPPD</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" name="tahun" class="form-control" placeholder="Contoh: 2026">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload File Dokumen</label>
                        <input type="file" name="file_dok" class="form-control" accept=".pdf,.doc,.docx" required>
                        <small class="text-muted mt-1 d-block">Format: PDF, DOC, DOCX. Maksimal ukuran file 10MB.</small>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Deskripsi (Opsional)</label>
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Keterangan singkat dokumen..."></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal" style="min-height: 44px; border-radius: 8px;">Batal</button>
                    <button type="submit" class="btn-primary-custom">
                        <i class="fas fa-save"></i> Simpan Dokumen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endhasanyrole

<!-- Script Bootstrap JS -->
@endsection

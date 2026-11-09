@extends('layouts.dashboard')

@section('title', 'Kelola Data Peta Jabatan')

@push('styles')
<style>
    .page-head { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 26px; gap: 16px; flex-wrap: wrap; }
    .page-head-text h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-head-text p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }
    
    .btn-add { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s; border: none; text-decoration: none; cursor: pointer; background: var(--success); color: #fff; }
    .btn-add:hover { background: #146c43; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(25, 135, 84, .15); color: #fff; }

    .rekap-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; margin-bottom: 22px; }
    .rekap-item { display: flex; align-items: center; gap: 14px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 16px 18px; box-shadow: var(--shadow-xs); border-left-width: 4px; }
    .rekap-ico { flex: none; width: 44px; height: 44px; border-radius: 10px; display: grid; place-items: center; font-size: 1.15rem; }
    .rekap-num { font-family: var(--font-display); font-weight: 700; font-size: 1.7rem; line-height: 1; color: var(--ink); }
    .rekap-label { font-size: .74rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); margin-top: 4px; }
    .rekap-sub { font-size: .72rem; color: var(--steel); margin-top: 2px; }
    
    .rekap-total { border-left-color: var(--navy); }
    .rekap-total .rekap-ico { background: rgba(22, 58, 99, .10); color: var(--navy); }

    .base-card { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 26px; box-shadow: var(--shadow-xs); transition: box-shadow .2s ease; overflow: hidden; }
    .base-card:hover { box-shadow: var(--shadow-sm); }
    
    .card-title-custom {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 22px; padding-bottom: 14px; border-bottom: 1px solid var(--line);
        font-family: var(--font-display); font-size: 1.05rem; font-weight: 700; color: var(--ink);
        flex-wrap: wrap; gap: 12px;
    }
    .card-title-custom .title-left { display: flex; align-items: center; gap: 10px; }
    .card-title-custom .title-left::before { content: ""; width: 4px; height: 18px; background: var(--navy); border-radius: 4px; }
    
    .table-responsive { border-radius: var(--r-sm); border: 1px solid var(--line); overflow: hidden; }
    .table { margin-bottom: 0; font-size: .92rem; }
    .table thead th { background: var(--paper); color: var(--steel); font-size: .8rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; border-bottom: 1px solid var(--line-dark); padding: 14px 16px; }
    .table tbody td { padding: 14px 16px; vertical-align: middle; border-bottom: 1px solid var(--line); color: var(--ink); }
    .table tbody tr:last-child td { border-bottom: none; }
    .table tbody tr:hover { background-color: var(--navy-soft); }
    
    .badge-tahun { display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 6px; font-size: .78rem; font-weight: 700; background: var(--navy-soft); color: var(--navy); }
    
    .form-label { font-size: .88rem; font-weight: 600; color: var(--ink); margin-bottom: 6px; }
    .form-control, .form-select { min-height: 44px; font-size: .92rem; border: 1px solid var(--line-dark); border-radius: 8px; color: var(--ink); box-shadow: none; transition: all .2s ease; }
    .form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .form-control::file-selector-button { background: var(--paper); color: var(--ink); border: none; border-right: 1px solid var(--line-dark); padding: 0 16px; margin-right: 12px; height: 100%; font-weight: 600; transition: background .2s; }
    
    .btn-action-group { display: flex; align-items: center; justify-content: center; gap: 6px; }
    .btn-icon { display: inline-flex; align-items: center; justify-content: center; width: 34px; height: 34px; border-radius: 6px; border: none; font-size: .9rem; transition: all .2s ease; cursor: pointer; text-decoration: none; }
    .btn-icon.edit { background: var(--info-soft); color: var(--info); }
    .btn-icon.edit:hover { background: var(--info); color: #fff; }
    .btn-icon.delete { background: var(--signal-soft); color: var(--signal-dark); }
    .btn-icon.delete:hover { background: var(--signal); color: #fff; }

    .btn-file-view { display: inline-flex; align-items: center; gap: 5px; padding: 5px 10px; border-radius: 6px; font-size: .82rem; font-weight: 600; background: #e0f2fe; color: #0284c7; text-decoration: none; transition: all .2s; }
    .btn-file-view:hover { background: #0284c7; color: #fff; }
    .btn-file-dl { display: inline-flex; align-items: center; gap: 5px; padding: 5px 10px; border-radius: 6px; font-size: .82rem; font-weight: 600; background: #ecfdf5; color: #059669; text-decoration: none; transition: all .2s; }
    .btn-file-dl:hover { background: #059669; color: #fff; }
    
    .modal-content { border: none; border-radius: var(--r-md); box-shadow: var(--shadow-lg); }
    .modal-header { border-bottom: 1px solid var(--line); padding: 20px 24px; }
    .modal-title { font-family: var(--font-display); font-weight: 700; font-size: 1.2rem; }
    .modal-body { padding: 24px; }
    .modal-footer { border-top: 1px solid var(--line); padding: 16px 24px; background: var(--paper); border-radius: 0 0 var(--r-md) var(--r-md); }
    
    .search-input-wrap { position: relative; width: 280px; }
    .search-input-wrap input { padding-left: 36px; min-height: 38px; font-size: .85rem; border-radius: 8px; }
    .search-input-wrap i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--steel); font-size: .85rem; }

    @media (max-width: 700px) {
        .base-card { padding: 20px; }
        .card-title-custom { flex-direction: column; align-items: flex-start; gap: 14px; }
        .search-input-wrap { width: 100%; }
    }
</style>
@endpush

@section('content')
    <div class="page-head">
        <div class="page-head-text">
            <h1>Kelola Data Peta Jabatan</h1>
            <p>Manajemen file dan dokumen Peta Jabatan Kepegawaian Disdamkartan Kota Jambi.</p>
        </div>
        
        @hasanyrole('Super User|Sekretariat|Operator')
        <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="fas fa-plus"></i> Tambah Peta Jabatan
        </button>
        @endhasanyrole
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius: 10px;">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 10px;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- STATISTIK KARTU DOKUMEN -->
    <div class="rekap-grid">
        <div class="rekap-item rekap-total">
            <div class="rekap-ico"><i class="fas fa-sitemap"></i></div>
            <div>
                <div class="rekap-num">{{ $totalDokumen }}</div>
                <div class="rekap-label">Total Peta Jabatan</div>
                <div class="rekap-sub">Terpublikasi di kepegawaian</div>
            </div>
        </div>
    </div>

    <!-- TABEL DATA & FILTER -->
    <div class="base-card">
        <div class="card-title-custom">
            <div class="title-left">Daftar Dokumen Peta Jabatan</div>
            
            <form method="GET" action="{{ route('kepegawaian.peta-jabatan.index') }}" class="d-flex align-items-center gap-2">
                <div class="search-input-wrap">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" class="form-control" placeholder="Cari judul atau tahun..." value="{{ request('search') }}">
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Judul Dokumen</th>
                        <th width="12%" class="text-center">Tahun</th>
                        <th width="28%">Keterangan</th>
                        <th width="20%">File Dokumen</th>
                        @hasanyrole('Super User|Sekretariat|Operator')
                        <th width="12%" class="text-center">Aksi</th>
                        @endhasanyrole
                    </tr>
                </thead>
                <tbody>
                    @forelse($dokumen as $index => $item)
                    <tr>
                        <td class="text-center">{{ $dokumen->firstItem() + $index }}</td>
                        <td><strong>{{ $item->judul }}</strong></td>
                        <td class="text-center">
                            @if($item->tahun)
                                <span class="badge-tahun">{{ $item->tahun }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-muted">{{ $item->keterangan ?: '-' }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <a href="{{ route('kepegawaian.peta-jabatan.view', $item->id) }}" class="btn-file-view" target="_blank" rel="noopener">
                                    <i class="fas fa-arrow-up-right-from-square"></i> Buka
                                </a>
                                <a href="{{ route('kepegawaian.peta-jabatan.download', $item->id) }}" class="btn-file-dl">
                                    <i class="fas fa-download"></i> Unduh
                                </a>
                            </div>
                        </td>
                        @hasanyrole('Super User|Sekretariat|Operator')
                        <td class="text-center">
                            <div class="btn-action-group">
                                <button type="button" class="btn-icon edit" title="Edit Data"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdit"
                                    data-action="{{ route('kepegawaian.peta-jabatan.update', $item->id) }}"
                                    data-judul="{{ $item->judul }}"
                                    data-tahun="{{ $item->tahun }}"
                                    data-keterangan="{{ $item->keterangan }}">
                                    <i class="fas fa-pen"></i>
                                </button>

                                <form action="{{ route('kepegawaian.peta-jabatan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen Peta Jabatan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon delete" title="Hapus Data"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                        @endhasanyrole
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-folder-open mb-2" style="font-size: 2.2rem; color: var(--steel-soft);"></i><br>
                            Belum ada dokumen Peta Jabatan yang diunggah.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($dokumen->hasPages())
        <div class="mt-4">
            {{ $dokumen->links() }}
        </div>
        @endif
    </div>

    <!-- ==================== MODAL TAMBAH DATA ==================== -->
    @hasanyrole('Super User|Sekretariat|Operator')
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Dokumen Peta Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kepegawaian.peta-jabatan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul Dokumen <span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control" placeholder="Contoh: Peta Jabatan Disdamkartan 2026" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tahun (Opsional)</label>
                            <input type="number" name="tahun" class="form-control" placeholder="Contoh: 2026" min="2000" max="2100">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan (Opsional)</label>
                            <textarea name="keterangan" class="form-control" rows="3" placeholder="Keterangan atau ringkasan dokumen..."></textarea>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Upload File (PDF / Gambar) <span class="text-danger">*</span></label>
                            <input type="file" name="file_dokumen" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                            <small class="text-muted mt-1 d-block">Maksimal ukuran file 10MB.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal" style="min-height: 44px; border-radius: 8px;">Batal</button>
                        <button type="submit" class="btn btn-primary" style="background: var(--navy); border: none; min-height: 44px; border-radius: 8px; font-weight: 600;">
                            <i class="fas fa-save me-1"></i> Simpan Peta Jabatan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ==================== MODAL EDIT DATA ==================== -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Edit Dokumen Peta Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEditPetaJabatan" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul Dokumen <span class="text-danger">*</span></label>
                            <input type="text" id="editJudul" name="judul" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tahun (Opsional)</label>
                            <input type="number" id="editTahun" name="tahun" class="form-control" min="2000" max="2100">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan (Opsional)</label>
                            <textarea id="editKeterangan" name="keterangan" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Ganti File Dokumen (Opsional)</label>
                            <input type="file" name="file_dokumen" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            <small class="text-muted mt-1 d-block">Biarkan kosong jika tidak ingin mengubah file dokumen. Maksimal 10MB.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal" style="min-height: 44px; border-radius: 8px;">Batal</button>
                        <button type="submit" class="btn btn-primary" style="background: var(--navy); border: none; min-height: 44px; border-radius: 8px; font-weight: 600;">
                            <i class="fas fa-save me-1"></i> Perbarui Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endhasanyrole
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var modalEdit = document.getElementById('modalEdit');
    if (modalEdit) {
        modalEdit.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            if (!button) return;

            var form = document.getElementById('formEditPetaJabatan');
            form.action = button.getAttribute('data-action');

            document.getElementById('editJudul').value = button.getAttribute('data-judul') || '';
            document.getElementById('editTahun').value = button.getAttribute('data-tahun') || '';
            document.getElementById('editKeterangan').value = button.getAttribute('data-keterangan') || '';
        });
    }
});
</script>
@endpush

@extends('layouts.dashboard')

@section('title', 'Kelola Perizinan RPKBGL')

@push('styles')
<style>
    .topbar {
        position: sticky; top: 0; z-index: 1020;
        height: var(--topbar-h);
        display: flex; align-items: center; justify-content: space-between;
        gap: 16px; padding: 0 28px;
        background: var(--ink);
        border-bottom: 1px solid rgba(255,255,255,.08);
        box-shadow: 0 2px 12px rgba(13, 27, 42, .16);
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
    .page-head { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 26px; gap: 16px; flex-wrap: wrap; }
    .page-head-title h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-head-title p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }
    .btn-print-rekap, .btn-add { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s; border: none; text-decoration: none; cursor: pointer; }
    .btn-print-rekap { background: var(--navy); color: #fff; }
    .btn-print-rekap:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); color: #fff; }
    .btn-add { background: var(--success); color: #fff; }
    .btn-add:hover { background: #146c43; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(25, 135, 84, .15); color: #fff; }
    .content-card { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 24px; box-shadow: var(--shadow-xs); overflow: hidden; transition: box-shadow .2s ease, border-color .2s ease; }
    .content-card:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; }
    .table > :not(caption) > * > * { padding: 14px 16px; border-bottom-color: var(--line); color: var(--ink); font-size: .92rem; vertical-align: middle; }
    .table thead th { font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); background: var(--paper); border-bottom: 2px solid var(--line-dark); }
    .table tbody tr { transition: background .2s; }
    .table tbody tr:hover { background: #f8fafc; }
    .badge-status { display: inline-flex; align-items: center; padding: 5px 12px; border-radius: 6px; font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .02em; }
    .status-pending { background: rgba(244, 183, 64, .15); color: #d97706; }
    .status-diproses { background: var(--info-soft); color: var(--info); }
    .status-memenuhi { background: rgba(25, 135, 84, .15); color: var(--success); }
    .status-tidak { background: var(--signal-soft); color: var(--signal-dark); }
    .btn-action-group { display: flex; flex-direction: column; gap: 6px; }
    .btn-action { display: inline-flex; align-items: center; justify-content: flex-start; gap: 6px; padding: 6px 12px; border-radius: 6px; font-size: .8rem; font-weight: 600; transition: all .2s; text-decoration: none; border: none; width: 100%; cursor: pointer; }
    .btn-lihat { background: var(--info-soft); color: var(--info); }
    .btn-lihat:hover { background: var(--info); color: #ffffff; }
    .btn-update { background: var(--navy-soft); color: var(--navy); }
    .btn-update:hover { background: var(--navy); color: #ffffff; }
    .btn-delete { background: var(--signal-soft); color: var(--signal-dark); }
    .btn-delete:hover { background: var(--signal); color: #ffffff; }
    .attachment-link { display: inline-flex; align-items: center; gap: 6px; font-size: .82rem; color: var(--info); font-weight: 500; text-decoration: none; margin-bottom: 4px; transition: color .2s; }
    .attachment-link:hover { color: var(--navy-dark); text-decoration: underline; }
    @media (max-width: 700px) {
        :root { --topbar-h: 64px; }
        .topbar { height: var(--topbar-h); padding: 0 14px; gap: 10px; }
        .brand { gap: 9px; }
        .brand img { height: 30px; }
        .brand span { font-size: .95rem; }
        .topbar-right { gap: 7px; }
        .user-chip { padding: 3px; border: none; background: transparent; }
        .user-avatar { width: 34px; height: 34px; }
        .btn-logout { width: 38px; height: 38px; padding: 0; border-radius: 10px; font-size: 0; }
        .btn-logout i { font-size: .9rem; }
        .content { padding: 26px 16px 50px; }
        .page-head-title h1 { font-size: 1.55rem; }
        .page-head-title p { font-size: .88rem; }
    }
    @media (max-width: 420px) {
        .brand span { display: none; }
        .content { padding-left: 13px; padding-right: 13px; }
    }
    @media print {
        .topbar, .sidebar, .btn-print-rekap, .btn-add, .no-print-col, .page-head-title p { display: none !important; }
        .shell { display: block; }
        .content { padding: 0 !important; margin: 0 !important; background: white; }
        .content-card { padding: 0; border: none; box-shadow: none; }
        body { background-color: white; margin: 0; padding: 0; }
        .page-head-title h1 { font-size: 1.5rem; text-align: center; width: 100%; margin-bottom: 20px; }
        .table thead th { background: transparent; color: #000; border-bottom: 2px solid #000; }
        .table td, .table th { border-color: #ddd; color: #000; font-size: .8rem; }
    }
</style>
@endpush

@section('content')
@section('content')

        <div class="page-head">
            <div class="page-head-title">
                <h1>Daftar Permohonan RPKBGL</h1>
                <p>Data pengajuan Rekomendasi Penilaian Proteksi Kebakaran Bangunan Gedung dan Lingkungan.</p>
            </div>
            
            <div class="d-flex gap-2 flex-wrap">
                <!-- ==============================================
                     TOMBOL TAMBAH DIBUNGKUS HAK AKSES PENCEGAHAN
                     ============================================== -->
                @hasanyrole('Pencegahan|Super User')
                <a href="/internal/pencegahan/kelola-rpkbgl/create" class="btn-add no-print-col">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                @endhasanyrole

                <button onclick="window.print()" class="btn-print-rekap no-print-col">
                    <i class="fas fa-print"></i> Cetak Rekap
                </button>
            </div>
        </div>

        <div class="content-card">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Pemohon</th>
                            <th>Nama Usaha</th>
                            <th>Kategori</th>
                            <th>Lokasi Bangunan</th>
                            <th>Status</th>
                            <th class="no-print-col">Berkas Lampiran</th>
                            <th class="no-print-col" style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permohonan as $p)
                        <tr>
                            <td>
                                <strong>{{ $p->created_at->format('d M Y') }}</strong>
                                <div style="font-size: .8rem; color: var(--steel-soft);">{{ $p->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td>
                                <strong style="display: block; margin-bottom: 2px;">{{ $p->nama_pemohon }}</strong>
                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', $p->no_whatsapp) }}" target="_blank" style="font-size: .8rem; color: var(--success); text-decoration: none;">
                                    <i class="fab fa-whatsapp"></i> {{ $p->no_whatsapp }}
                                </a>
                            </td>
                            <td><strong>{{ $p->nama_usaha }}</strong></td>
                            <td>{{ $p->kategori_bangunan }}</td>
                            <td>
                                {{ $p->kecamatan }}<br>
                                <span style="font-size: .8rem; color: var(--steel);">Kel. {{ $p->kelurahan }}</span>
                            </td>
                            <td>
                                @if($p->status_permohonan == 'Pending')
                                    <span class="badge-status status-pending">Pending</span>
                                @elseif($p->status_permohonan == 'Diproses')
                                    <span class="badge-status status-diproses">Diproses Tim</span>
                                @elseif($p->status_permohonan == 'Memenuhi Syarat')
                                    <span class="badge-status status-memenuhi">Memenuhi</span>
                                @else
                                    <span class="badge-status status-tidak">Tidak Memenuhi</span>
                                @endif
                            </td>
                            
                            <!-- Kolom Lampiran dengan Kondisi Offline -->
                            <td class="no-print-col">
                                @if($p->file_surat_permohonan)
                                    @if($p->file_surat_permohonan == 'Tidak dilampirkan (Offline)')
                                        <a href="javascript:void(0)" onclick="alert('Tidak ada data lampiran Surat Permohonan.');" class="attachment-link d-block text-secondary">
                                            <i class="fas fa-file-pdf"></i> Surat Permohonan (Offline)
                                        </a>
                                    @else
                                        <a href="{{ asset('uploads/rpkbgl/surat/' . $p->file_surat_permohonan) }}" target="_blank" class="attachment-link d-block">
                                            <i class="fas fa-file-pdf"></i> Surat Permohonan
                                        </a>
                                    @endif
                                @endif
                                
                                @if(!empty($p->file_persyaratan_lainnya) && is_array($p->file_persyaratan_lainnya))
                                    @foreach($p->file_persyaratan_lainnya as $index => $fileLain)
                                        @if($fileLain == 'Tidak dilampirkan (Offline)')
                                            <a href="javascript:void(0)" onclick="alert('Tidak ada data lampiran Syarat Lainnya.');" class="attachment-link d-block text-secondary">
                                                <i class="fas fa-paperclip"></i> Syarat Lainnya (Offline)
                                            </a>
                                        @else
                                            <a href="{{ asset('uploads/rpkbgl/persyaratan/' . $fileLain) }}" target="_blank" class="attachment-link d-block">
                                                <i class="fas fa-paperclip"></i> Syarat Lainnya {{ $index + 1 }}
                                            </a>
                                        @endif
                                    @endforeach
                                @else
                                    <span style="font-size: .75rem; color: var(--steel-soft);">- Tidak ada tambahan</span>
                                @endif
                            </td>

                            <!-- Kolom Aksi -->
                            <td class="no-print-col">
                                <div class="btn-action-group">
                                    <a href="/internal/pencegahan/kelola-rpkbgl/{{ $p->id }}" class="btn-action btn-lihat">
                                        <i class="fas fa-search" style="width: 14px;"></i> Detail
                                    </a>
                                    
                                    <!-- ==============================================
                                         TOMBOL UPDATE & HAPUS DIBUNGKUS HAK AKSES
                                         ============================================== -->
                                    @hasanyrole('Pencegahan|Super User')
                                    <button type="button" class="btn-action btn-update" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalUpdateStatus" 
                                        data-id="{{ $p->id }}" 
                                        data-nama="{{ $p->nama_pemohon }}" 
                                        data-status="{{ $p->status_permohonan }}">
                                        <i class="fas fa-edit" style="width: 14px;"></i> Update
                                    </button>
                                    
                                    <button type="button" class="btn-action btn-delete" onclick="confirmDelete({{ $p->id }}, '{{ addslashes($p->nama_pemohon) }}')">
                                        <i class="fas fa-trash" style="width: 14px;"></i> Hapus
                                    </button>
                                    @endhasanyrole
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted" style="font-size: .95rem;">
                                <i class="fas fa-folder-open mb-2" style="font-size: 2rem; color: var(--steel-soft);"></i><br>
                                Belum ada data permohonan RPKBGL yang masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ==============================================
             MODAL UPDATE STATUS DIBUNGKUS HAK AKSES
             ============================================== -->
        @hasanyrole('Pencegahan|Super User')
        <div class="modal fade" id="modalUpdateStatus" tabindex="-1" aria-labelledby="modalUpdateStatusLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: none; border-radius: var(--r-md); box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                    <form id="formUpdateStatus" method="POST" action="">
                        @csrf
                        <div class="modal-header" style="background: var(--paper); border-bottom: 1px solid var(--line);">
                            <h5 class="modal-title" id="modalUpdateStatusLabel" style="font-family: var(--font-display); font-weight: 700; color: var(--ink);">
                                <i class="fas fa-edit text-primary me-2"></i> Update Status
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <p class="text-muted mb-3" style="font-size: 0.9rem;">
                                Ubah status permohonan RPKBGL atas nama <strong id="modalPemohonName" class="text-dark"></strong>.
                            </p>
                            
                            <div class="mb-2">
                                <label for="selectStatus" class="form-label fw-bold" style="font-size: 0.9rem; color: var(--ink);">Status Baru</label>
                                <select class="form-select shadow-sm" id="selectStatus" name="status_permohonan" required style="border-radius: 8px; cursor: pointer;">
                                    <option value="Pending">Pending</option>
                                    <option value="Diproses">Diproses Tim</option>
                                    <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                    <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer" style="background: var(--paper); border-top: 1px solid var(--line);">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Batal</button>
                            <button type="submit" class="btn btn-primary" style="background: var(--navy); border-color: var(--navy); border-radius: 8px; font-weight: 600;">
                                <i class="fas fa-save me-1"></i> Simpan Status
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endhasanyrole

<!-- Script Bootstrap & SweetAlert -->
@endsection

@push('scripts')
<script>
(function () {
    'use strict';
    /* ---------- Modal Update Status Logic ---------- */
    var modalUpdateStatus = document.getElementById('modalUpdateStatus');
    if (modalUpdateStatus) {
        modalUpdateStatus.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; 
            var id = button.getAttribute('data-id');
            var nama = button.getAttribute('data-nama');
            var status = button.getAttribute('data-status');

            var form = document.getElementById('formUpdateStatus');
            form.action = '/internal/pencegahan/kelola-rpkbgl/update-status/' + id;

            document.getElementById('modalPemohonName').textContent = nama;
            
            var select = document.getElementById('selectStatus');
            if(!status || status == '') status = 'Pending';
            select.value = status;
        });
    }

    /* ---------- SweetAlert Success Notif ---------- */
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{!! session('success') !!}",
            confirmButtonColor: '#163a63',
            confirmButtonText: 'Tutup'
        });
    @endif
})();

/* ---------- Fungsi Konfirmasi Hapus dengan SweetAlert2 ---------- */
function confirmDelete(id, namaPemohon) {
    Swal.fire({
        title: 'Hapus Data?',
        html: `Anda yakin ingin menghapus data permohonan atas nama <strong>${namaPemohon}</strong>?<br>Data tidak dapat dikembalikan.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Membuat form virtual (dinamis) untuk mengirim request DELETE ke Laravel
            const form = document.createElement('form');
            form.method = 'POST';
            
            // Sesuaikan Route ini ke endpoint Delete controller Anda
            form.action = `/internal/pencegahan/kelola-rpkbgl/${id}`; 

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';

            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            
            form.submit();
        }
    });
}
</script>
@endpush

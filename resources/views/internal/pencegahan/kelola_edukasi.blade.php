@extends('layouts.dashboard')

@section('title', 'Kelola Kunjungan Edukasi & Sosialisasi')

@push('styles')
<style>
    .toast-wrap {
        position: fixed; z-index: 2000; top: 18px; left: 50%;
        transform: translateX(-50%);
        display: grid; gap: 10px;
        width: max-content; max-width: calc(100vw - 24px);
    }
    .toast {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 12px 12px 16px;
        border-radius: 999px;
        background: #fff; border: 1px solid var(--line);
        box-shadow: var(--shadow-md);
        font-weight: 600; font-size: .92rem;
        animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both;
    }
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
    .page-head { margin-bottom: 26px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; }
    .page-head-title h1 {
        font-family: var(--font-display); font-weight: 700;
        font-size: clamp(1.6rem, 3vw, 2.1rem);
        line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink);
    }
    .page-head-title p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }
    .content-card { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 26px; box-shadow: var(--shadow-xs); transition: box-shadow .2s ease, border-color .2s ease; overflow: hidden;}
    .content-card:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; }
    .table-custom { margin-bottom: 0; }
    .table-custom th { background-color: var(--paper); color: var(--steel); font-size: .75rem; text-transform: uppercase; letter-spacing: .04em; font-weight: 700; padding: 14px 12px; border-bottom: 2px solid var(--line-dark) !important; border-top: none; }
    .table-custom td { padding: 16px 12px; vertical-align: middle; font-size: .88rem; color: var(--ink); border-bottom: 1px solid var(--line); }
    .badge-status { padding: 6px 12px; border-radius: 6px; font-size: .75rem; font-weight: 700; display: inline-flex; align-items: center; justify-content: center; }
    .status-pending { background-color: #fef3c7; color: #d97706; }
    .status-disetujui { background-color: #d1fae5; color: #059669; }
    .status-ditolak { background-color: #fee2e2; color: #dc2626; }
    .btn-print-rekap { display: inline-flex; align-items: center; gap: 8px; background-color: var(--navy); color: white; font-weight: 600; font-size: .9rem; padding: 10px 20px; border-radius: 8px; border: none; transition: 0.2s; cursor: pointer; }
    .btn-print-rekap:hover { background-color: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); }
    .btn-action-group { display: flex; flex-direction: column; gap: 6px; }
    .btn-action { display: inline-flex; align-items: center; justify-content: center; gap: 6px; width: 100%; padding: 7px 10px; border-radius: 6px; font-weight: 700; font-size: .75rem; border: none; text-decoration: none; transition: all 0.2s; cursor: pointer; color: white; }
    .btn-action:hover { opacity: 0.9; color: white; transform: translateY(-1px); }
    .bg-detail { background-color: var(--info); }
    .bg-edit { background-color: var(--amber); color: var(--ink-3) !important; }
    .bg-status { background-color: var(--success); }
    .bg-cetak { background-color: var(--steel); }
    .modal-content { font-family: var(--font-body); border: none; border-radius: var(--r-md); box-shadow: var(--shadow-lg); }
    .modal-header { border-bottom: 1px solid var(--line); padding: 18px 24px; }
    .modal-title { font-family: var(--font-display); font-weight: 700; color: var(--ink); }
    .modal-body { padding: 24px; }
    .modal-footer { border-top: 1px solid var(--line); padding: 16px 24px; }
    .form-label { font-weight: 600; color: var(--ink-2); font-size: .88rem; margin-bottom: 8px; }
    .form-select { border-radius: 8px; border-color: var(--line-dark); min-height: 42px; font-size: .9rem; color: var(--ink); box-shadow: none; }
    .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
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
        .topbar, .sidebar, .btn-print-rekap, .page-head-title p { display: none !important; }
        .no-print-col { display: none !important; }
        .shell { display: block; }
        .content { padding: 0 !important; margin: 0 !important; background-color: white; }
        .content-card { border: none; box-shadow: none; padding: 0; }
        body { background-color: white; margin: 0; padding: 0; }
    }
</style>
@endpush

@section('content')
    <div class="page-head">
        <div class="page-head-title">
            <h1>Daftar Kunjungan Edukasi & Sosialisasi</h1>
            <p>Kelola pengajuan layanan edukasi dan sosialisasi ke masyarakat dan instansi.</p>
        </div>
        <div>
            <!-- TOMBOL TAMBAH DATA (DIKUNCI HANYA UNTUK PENCEGAHAN & SUPER USER) -->
            @hasanyrole('Pencegahan|Super User')
            <a href="/internal/pencegahan/kelola-edukasi/tambah" class="btn btn-primary shadow-sm" style="font-weight: 600; border-radius: 8px; padding: 10px 20px; margin-right: 8px; background-color: var(--info); border: none;">
                <i class="fas fa-plus"></i> Tambah Data Offline
            </a>
            @endhasanyrole

            <button onclick="window.print()" class="btn-print-rekap"><i class="fas fa-print"></i> Cetak Rekap</button>
        </div>
    </div>

    <div class="content-card">
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Diajukan Pada</th>
                        <th>Institusi</th>
                        <th>Pemohon</th>
                        <th>Jadwal Kegiatan</th>
                        <th>Status</th>
                        <th class="no-print-col text-center">Lampiran</th>
                        <th class="text-center no-print-col" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permohonan as $p)
                    @php
                        // Handle jika no_kontak tidak sengaja tersimpan sebagai array/JSON
                        $kontak = is_array($p->no_kontak) ? ($p->no_kontak[0] ?? '') : (string) $p->no_kontak;
                    @endphp
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $p->created_at->format('d M Y') }}</div>
                            <div style="font-size: .75rem; color: var(--steel);">{{ $p->created_at->format('H:i') }} WIB</div>
                        </td>
                        <td>
                            <div class="fw-bold">{{ $p->institusi }}</div>
                            <div style="font-size: .75rem; color: var(--steel);">Kec. {{ $p->kecamatan }}</div>
                        </td>
                        <td>
                            <div class="fw-bold" style="color: var(--info);">{{ $p->nama_pemohon }}</div>
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $kontak) }}" target="_blank" class="text-decoration-none" style="font-size: .75rem; font-weight:600; color: var(--success);"><i class="fab fa-whatsapp"></i> {{ $kontak }}</a>
                        </td>
                        <td>
                            <div class="fw-bold" style="color: var(--amber);">{{ \Carbon\Carbon::parse($p->tgl_kegiatan)->format('d F Y') }}</div>
                            <div style="font-size: .75rem; color: var(--steel);">
                                Total: {{ $p->usia_3_6 + $p->usia_7_12 + $p->usia_13_18 + $p->usia_18_keatas }} Peserta
                            </div>
                        </td>
                        <td>
                            @if($p->status_permohonan == 'Pending') 
                                <span class="badge-status status-pending">Pending</span>
                            @elseif($p->status_permohonan == 'Disetujui') 
                                <span class="badge-status status-disetujui">Disetujui</span>
                            @else 
                                <span class="badge-status status-ditolak">Ditolak</span>
                            @endif
                        </td>
                            <td class="no-print-col text-center">
                                @foreach(\Illuminate\Support\Arr::wrap($p->surat_permohonan) as $file)
                                    <a href="{{ asset('storage/' . $file) }}" target="_blank" class="badge bg-danger text-decoration-none mb-1"><i class="fas fa-file-pdf"></i> Surat</a>
                                @endforeach
                                @foreach(\Illuminate\Support\Arr::wrap($p->syarat_lainnya) as $file)
                                    <br><a href="{{ asset('storage/' . $file) }}" target="_blank" class="badge bg-secondary text-decoration-none"><i class="fas fa-paperclip"></i> Syarat {{ $loop->count > 1 ? $loop->iteration : '' }}</a>
                                @endforeach
                            </td>   
                        <td class="no-print-col">
                            <div class="btn-action-group">
                                <a href="/internal/pencegahan/kelola-edukasi/{{ $p->id }}" class="btn-action bg-detail"><i class="fas fa-search"></i> Detail</a>
                                
                                <!-- TOMBOL EDIT DAN STATUS HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                                @hasanyrole('Pencegahan|Super User')
                                <a href="{{ route('edukasi.offline.edit', $p->id) }}" class="btn-action bg-edit"><i class="fas fa-pen"></i> Edit</a>
                                <button type="button" class="btn-action bg-status" data-bs-toggle="modal" data-bs-target="#modalStatus{{ $p->id }}"><i class="fas fa-edit"></i> Status</button>
                                @endhasanyrole

                                <a href="/internal/pencegahan/kelola-edukasi/{{ $p->id }}?auto_print=true" target="_blank" class="btn-action bg-cetak"><i class="fas fa-print"></i> Cetak</a>
                            </div>
                        </td>
                    </tr>

                    <!-- MODAL UPDATE STATUS HANYA DIBACA OLEH PENCEGAHAN DAN SUPER USER -->
                    @hasanyrole('Pencegahan|Super User')
                    <div class="modal fade" id="modalStatus{{ $p->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update Status Edukasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="/internal/pencegahan/kelola-edukasi/update-status/{{ $p->id }}" method="POST">
                                    @csrf
                                    <div class="modal-body text-start">
                                        <p class="mb-4" style="font-size: .9rem; color: var(--steel);">Ubah status pengajuan jadwal dari <strong style="color: var(--ink);">{{ $p->institusi }}</strong>.</p>
                                        <div class="mb-2">
                                            <label class="form-label">Pilih Status Baru</label>
                                            <select name="status_permohonan" class="form-select" required>
                                                <option value="Pending" {{ $p->status_permohonan == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Disetujui" {{ $p->status_permohonan == 'Disetujui' ? 'selected' : '' }}>Disetujui / Diterima</option>
                                                <option value="Ditolak" {{ $p->status_permohonan == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" style="font-weight:600; border-radius: 8px;" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary" style="font-weight:600; border-radius: 8px; background: var(--navy); border:none;"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endhasanyrole

                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="fas fa-folder-open mb-3" style="font-size: 32px; color: var(--line-dark);"></i><br>
                            <span style="color: var(--steel); font-weight: 500;">Belum ada pengajuan Kunjungan Edukasi & Sosialisasi.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
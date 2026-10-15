@extends('layouts.dashboard')

@section('title', 'Rekap Data ASN')

@push('styles')
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
    .page-head { margin-bottom: 26px; }
    .page-head p { color: var(--steel); font-size: .95rem; }
</style>
@endpush

@section('content')
@section('content')

        <div class="page-head d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="mb-1">Rekap Data ASN</h1>
                <p class="mb-0 text-muted">Kelola rekapitulasi jumlah pegawai PNS dan PPPK.</p>
            </div>
            @can('asn-create')
            <a href="{{ route('data-asn.create') }}" class="btn fw-semibold text-white px-4 py-2" style="background-color: var(--navy); border-radius: 8px;">
                <i class="fas fa-plus me-2"></i> Tambah Data
            </a>
            @endcan
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 14px; background: #fff;">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle" style="font-size: 0.95rem;">
                        <thead style="background-color: var(--navy-light); color: var(--navy-dark);">
                            <tr>
                                <th width="5%" class="text-center py-3 rounded-start">NO</th>
                                <th class="py-3">NAMA JABATAN</th>
                                <th width="15%" class="text-center py-3">PNS</th>
                                <th width="15%" class="text-center py-3">PPPK</th>
                                <th width="15%" class="text-center py-3">JUMLAH SELURUH</th>
                                <th width="15%" class="text-center py-3 rounded-end">AKSI</th>
                            </tr>
                        </thead>
                        <tbody style="border-top: none;">
                            @forelse($dataAsn as $key => $asn)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="fw-medium" style="color: var(--ink);">{{ $asn->nama_jabatan }}</td>
                                <td class="text-center">{{ $asn->pns ?: '-' }}</td>
                                <td class="text-center">{{ $asn->pppk ?: '-' }}</td>
                                <td class="text-center fw-bold">{{ $asn->jumlah_seluruh }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        @can('asn-edit')
                                        <a href="{{ route('data-asn.edit', $asn->id) }}" class="btn btn-sm btn-light border text-primary" style="border-radius: 6px;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endcan
                                        
                                        @can('asn-delete')
                                        <form action="{{ route('data-asn.destroy', $asn->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border text-danger" style="border-radius: 6px;">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Belum ada rekap data ASN.</td>
                            </tr>
                            @endforelse
                        </tbody>
                        @if($dataAsn->count() > 0)
                        <tfoot style="background-color: var(--paper); border-top: 2px solid var(--line-dark);">
                            <tr>
                                <td colspan="2" class="text-end fw-bold py-3">TOTAL :</td>
                                <td class="text-center fw-bold py-3 text-primary">{{ $totalPns }}</td>
                                <td class="text-center fw-bold py-3 text-primary">{{ $totalPppk }}</td>
                                <td class="text-center fw-bold py-3 text-danger fs-5">{{ $totalSeluruh }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>
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
})();
</script>
@endpush

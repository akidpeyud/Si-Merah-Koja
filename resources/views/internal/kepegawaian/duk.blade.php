@extends('layouts.dashboard')

@section('title', 'Data Urut Kepegawaian (DUK)')

@push('styles')
<style>
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    @media (max-width: 900px) {
        .sidebar { position: fixed; z-index: 90; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg); }
        .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
    }
    .table td { white-space: nowrap; font-size: 0.9rem; vertical-align: middle; border-color: var(--line); }
    .badge.bg-success { background-color: var(--success) !important; }
    .badge.bg-warning { background-color: var(--amber) !important; color: #fff !important; }
    .badge.bg-secondary { background-color: var(--steel) !important; }
</style>
@endpush

@section('content')
@section('content')

        <!-- Error Messages (Optional, if toast fails) -->
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
                <h1>Daftar Urut Kepangkatan (DUK)</h1>
                <p>Manajemen data pegawai, kepangkatan, jabatan, dan pendidikan.</p>
            </div>
            
            <!-- Pembatasan akses CRUD Create -->
            @hasanyrole('Super User|Sekretariat')
            <a href="{{ route('kepegawaian.duk.create') }}" class="btn-tambah text-decoration-none">
                <i class="fas fa-plus me-1"></i> Tambah Data Pegawai
            </a>
            @endhasanyrole
        </div>

        <div class="card-container">
            <!-- Tabel Responsif -->
            <div class="table-responsive">
                <table class="table table-hover align-middle border-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No. Urut</th>
                            <th>NIP</th>
                            <th>Nama Lengkap</th>
                            <th>Pangkat / Gol. Ruang</th>
                            <th>Jabatan</th>
                            <th>Masa Kerja</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Status Pegawai</th>
                            @hasanyrole('Sekretariat|Super User')
                            <th class="text-center" width="10%">Aksi</th>
                            @endhasanyrole
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pegawais ?? [] as $pegawai)
                        <tr>
                            <td class="text-center fw-bold text-secondary">{{ $pegawai->no_urut }}</td>
                            <td class="fw-bold">{{ $pegawai->nip }}</td>
                            <td class="fw-semibold">{{ $pegawai->nama }}</td>
                            <td>
                                {{ $pegawai->pangkat_gol_ruang }}<br>
                                <small class="text-muted">TMT: {{ $pegawai->pangkat_tmt }}</small>
                            </td>
                            <td>
                                {{ $pegawai->jabatan_nama }}<br>
                                <small class="text-muted">TMT: {{ $pegawai->jabatan_tmt }}</small>
                            </td>
                            <td>{{ $pegawai->masa_kerja_th }} Thn, {{ $pegawai->masa_kerja_bln }} Bln</td>
                            <td>
                                {{ $pegawai->pendidikan_tingkat_ijazah }} - {{ $pegawai->pendidikan_nama }}<br>
                                <small class="text-muted">Lulus: {{ $pegawai->pendidikan_tahun_lulus }}</small>
                            </td>
                            <td>
                                @if($pegawai->status_pegawai == 'Aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @elseif($pegawai->status_pegawai == 'Cuti')
                                    <span class="badge bg-warning">Cuti</span>
                                @elseif($pegawai->status_pegawai == 'Pensiun')
                                    <span class="badge bg-secondary">Pensiun</span>
                                @else
                                    <span class="badge bg-info">{{ $pegawai->status_pegawai }}</span>
                                @endif
                            </td>
                            
                            @hasanyrole('Sekretariat|Super User')
                            <td class="text-center">
                                <a href="{{ route('kepegawaian.duk.edit', $pegawai->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 6px;" title="Edit"><i class="fas fa-edit"></i></a>
                                
                                <form action="{{ route('kepegawaian.duk.destroy', $pegawai->id ?? 1) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 6px;" title="Hapus" onclick="return confirm('Yakin ingin menghapus pegawai ini?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                            @endhasanyrole
                        </tr>
                        @empty
                        <tr>
                            <td colspan="@hasanyrole('Sekretariat|Super User') 9 @else 8 @endhasanyrole" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-folder-open mb-3" style="font-size: 2.5rem; color: var(--steel-soft); opacity: 0.7;"></i><br>
                                    Belum ada data pegawai. Silakan tambah data baru.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
@endsection

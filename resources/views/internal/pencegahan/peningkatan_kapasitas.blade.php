@extends('layouts.dashboard')

@section('title', 'Peningkatan Kapasitas Aparatur')

@push('styles')
<style>
    .toast-wrap { position: fixed; z-index: 1100; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
    .toast { display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px; border-radius: 999px; background: #fff; border: 1px solid var(--line); box-shadow: var(--shadow-md); font-weight: 600; font-size: .92rem; animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both; }
    .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
    .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #fff; color: var(--ink); display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
    .user-meta strong { font-size: .84rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #fff; }
    .btn-logout { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #fff; color: var(--ink); font-weight: 600; font-size: .84rem; border: none; transition: background .2s, color .2s, transform .1s, box-shadow .2s; }
    .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; overflow-x: hidden; background: #fff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
    .side-link.active { background: var(--ink); color: #fff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
    .side-link.active i { color: #fff; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    .page-head { margin-bottom: 26px; }
    .page-head p { color: var(--steel); font-size: .95rem; }
    .btn-navy { display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px; border-radius: 999px; background: var(--navy); color: #fff; font-weight: 600; font-size: .86rem; border: none; transition: background .2s, transform .1s, box-shadow .2s; }
    .btn-navy:hover { background: var(--navy-dark); color: #fff; box-shadow: 0 4px 12px rgba(22,58,99,.22); }
    .btn-navy:active { transform: scale(.97); }
    .btn-add { display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px; border-radius: 999px; background: var(--success); color: #fff; font-weight: 600; font-size: .86rem; border: none; transition: background .2s, transform .1s, box-shadow .2s; }
    .btn-add:hover { background: #148f65; color: #fff; box-shadow: 0 4px 12px rgba(25,135,84,.25); }
    .btn-add:active { transform: scale(.97); }
    .custom-nav-tabs { display: flex; flex-wrap: nowrap; gap: 6px; overflow-x: auto; margin: 6px 0 30px; border-bottom: 1px solid var(--line); scrollbar-width: thin; }
    .custom-nav-tabs .nav-link { border: none; border-bottom: 3px solid transparent; border-radius: 0; color: var(--steel); font-weight: 700; font-size: .8rem; letter-spacing: .02em; padding: 12px 16px; background: transparent; white-space: nowrap; transition: color .2s, border-color .2s, background .2s; }
    .custom-nav-tabs .nav-link:hover { color: var(--ink); background: #f3f6fa; }
    .custom-nav-tabs .nav-link.active { color: var(--navy); border-bottom-color: var(--navy); background: transparent; }
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 16px; margin-bottom: 44px; }
    .stat-card { display: flex; flex-direction: column; align-items: flex-start; padding: 22px; background: #fff; border-radius: var(--r-md); border: 1px solid var(--line); box-shadow: var(--shadow-xs); transition: box-shadow .2s ease, border-color .2s ease, transform .2s ease; position: relative; overflow: hidden; }
    .stat-card:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; transform: translateY(-3px); }
    .stat-card::after { content: "\f061"; font-family: "Font Awesome 6 Free"; font-weight: 900; position: absolute; top: 22px; right: 20px; color: var(--steel-soft); font-size: .8rem; opacity: 0; transform: translateX(-6px); transition: opacity .2s ease, transform .2s ease; }
    .stat-card:hover::after { opacity: 1; transform: translateX(0); }
    .stat-ico { width: 46px; height: 46px; border-radius: var(--r-sm); display: grid; place-items: center; font-size: 1.05rem; margin-bottom: 18px; }
    .ic-primary { background: var(--navy-soft); color: var(--navy); }
    .ic-danger { background: var(--signal-soft); color: var(--signal-dark); }
    .ic-info { background: var(--info-soft); color: var(--info); }
    .stat-title { font-size: .74rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--steel); margin-bottom: 6px; line-height: 1.4; }
    .stat-value { font-family: var(--font-display); font-weight: 700; font-size: 1.9rem; line-height: 1; color: var(--ink); letter-spacing: -.01em; }
    @media (max-width: 1100px) {
        .topbar { padding: 0 20px; }
        .content { padding: 32px 26px 60px; }
        .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
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
        .page-head { margin-bottom: 22px; }
        .page-head h1 { font-size: 1.55rem; }
        .page-head p { font-size: .88rem; }
        .stats-grid { grid-template-columns: 1fr; gap: 12px; margin-bottom: 34px; }
        .stat-card { padding: 19px; }
        .stat-ico { width: 42px; height: 42px; margin-bottom: 14px; }
        .stat-value { font-size: 1.7rem; }
    }
    @media (max-width: 420px) {
        .brand span { display: none; }
        .content { padding-left: 13px; padding-right: 13px; }
    }
    @media (prefers-reduced-motion: reduce) {
        html { scroll-behavior: auto; }
        *, *::before, *::after { animation: none !important; transition: none !important; }
    }
    @media print {
        .topbar { position: static; background: #fff !important; color: #000 !important; box-shadow: none; border-bottom: 1px solid #ddd; }
        .brand span { color: #000 !important; }
        .sidebar, .btn-logout, .btn-navy, .btn-add, .custom-nav-tabs, .toast-wrap { display: none !important; }
        .shell { display: block; }
        .content { padding: 20px; }
        .stat-card { box-shadow: none; break-inside: avoid; }
    }
</style>
@endpush

@section('content')
@section('content')

        <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-2">
            <div class="page-head mb-0">
                <h1>Peningkatan Kapasitas Aparatur</h1>
                <p>Kelola data diklat dan peningkatan kapasitas aparatur pemadam kebakaran.</p>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <!-- TOMBOL TAMBAH HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                @hasanyrole('Pencegahan|Super User')
                <a href="/internal/pencegahan/peningkatan-kapasitas/tambah" class="btn-add">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                @endhasanyrole

                <!-- TOMBOL CETAK TERBUKA UNTUK SEMUA ROLE -->
                <button type="button" onclick="window.print()" class="btn-navy">
                    <i class="fas fa-print"></i> Cetak Rekap
                </button>
            </div>
        </div>

        <!-- TABS -->
        <ul class="nav custom-nav-tabs">
            <li class="nav-item"><a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas">Semua Data</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diksar*') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diksar">DIKSAR</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-f1*') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-f1">DIKLAT F1</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-f2*') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-f2">DIKLAT F2</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-rescue*') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-rescue">DIKLAT RESCUE</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-mfr*') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-mfr">DIKLAT MFR</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-operator*') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-operator">DIKLAT OPERATOR</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-inspektur*') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-inspektur">DIKLAT INSPEKTUR</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-ppl*') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-ppl">DIKLAT PPL</a></li>
        </ul>

        <!-- STAT CARDS (LIHAT DATA: TERBUKA UNTUK SEMUA ROLE) -->
        <div class="stats-grid">
            <a href="/internal/pencegahan/peningkatan-kapasitas/diksar" class="stat-card">
                <div class="stat-ico ic-primary"><i class="fas fa-user-graduate"></i></div>
                <div>
                    <div class="stat-title">Data DIKSAR</div>
                    <div class="stat-value">{{ count($dataDiksar ?? []) }}</div>
                </div>
            </a>
            <a href="/internal/pencegahan/peningkatan-kapasitas/diklat-f1" class="stat-card">
                <div class="stat-ico ic-primary"><i class="fas fa-fire-extinguisher"></i></div>
                <div>
                    <div class="stat-title">Data DIKLAT F1</div>
                    <div class="stat-value">{{ count($dataF1 ?? []) }}</div>
                </div>
            </a>
            <a href="/internal/pencegahan/peningkatan-kapasitas/diklat-f2" class="stat-card">
                <div class="stat-ico ic-primary"><i class="fas fa-fire"></i></div>
                <div>
                    <div class="stat-title">Data DIKLAT F2</div>
                    <div class="stat-value">{{ count($dataF2 ?? []) }}</div>
                </div>
            </a>
            <a href="/internal/pencegahan/peningkatan-kapasitas/diklat-rescue" class="stat-card">
                <div class="stat-ico ic-primary"><i class="fas fa-life-ring"></i></div>
                <div>
                    <div class="stat-title">Diklat Rescue</div>
                    <div class="stat-value">{{ count($dataRescue ?? []) }}</div>
                </div>
            </a>
            <a href="/internal/pencegahan/peningkatan-kapasitas/diklat-mfr" class="stat-card">
                <div class="stat-ico ic-primary"><i class="fas fa-truck-medical"></i></div>
                <div>
                    <div class="stat-title">Diklat MFR</div>
                    <div class="stat-value">{{ count($dataMfr ?? []) }}</div>
                </div>
            </a>
            <a href="/internal/pencegahan/peningkatan-kapasitas/diklat-operator" class="stat-card">
                <div class="stat-ico ic-primary"><i class="fas fa-truck"></i></div>
                <div>
                    <div class="stat-title">Diklat Operator</div>
                    <div class="stat-value">{{ count($dataOperator ?? []) }}</div>
                </div>
            </a>
            <a href="/internal/pencegahan/peningkatan-kapasitas/diklat-inspektur" class="stat-card">
                <div class="stat-ico ic-primary"><i class="fas fa-magnifying-glass-chart"></i></div>
                <div>
                    <div class="stat-title">Diklat Inspektur</div>
                    <div class="stat-value">{{ count($dataInspektur ?? []) }}</div>
                </div>
            </a>
            <a href="/internal/pencegahan/peningkatan-kapasitas/diklat-ppl" class="stat-card">
                <div class="stat-ico ic-primary"><i class="fas fa-chalkboard-user"></i></div>
                <div>
                    <div class="stat-title">Diklat PPL</div>
                    <div class="stat-value">{{ count($dataPpl ?? []) }}</div>
                </div>
            </a>
        </div>
@endsection

@extends('layouts.dashboard')

@section('title', 'Input Penggunaan Sarana')

@push('styles')
<style>
.ik{
            --ink:#0d1b2a;--ink-2:#132a43;--ink-3:#1d3856;
            --bg:#eef1f5;--card:#fff;--paper:#f5f7fa;
            --signal:#e5392d;--signal-d:#c22b20;--signal-bg:#fdeceb;
            --amber:#ffb627;--steel:#5b6c7f;--line:#e1e7ee;--line-2:#cfd8e2;
            --ok:#16a34a;--ok-bg:#e8f7ee;--warn:#b45309;--warn-bg:#fef3c7;
            --r-lg:18px;--r-md:12px;--r-sm:8px;
            --font-display:'Bricolage Grotesque',system-ui,sans-serif;
            --font-body:'Instrument Sans',system-ui,sans-serif;
            --shadow:0 1px 2px rgba(13,27,42,.04),0 8px 24px -12px rgba(13,27,42,.12);
        }
.ik *,.ik *::before,.ik *::after{box-sizing:border-box;margin:0;padding:0}
.ik{font-family:var(--font-body);font-size:15px;line-height:1.6;color:var(--ink);-webkit-font-smoothing:antialiased}
.ik a{color:inherit;text-decoration:none}
.ik ul{list-style:none}
.ik button{font:inherit;cursor:pointer;border:0;background:none;color:inherit}
.ik :focus-visible{outline:3px solid var(--amber);outline-offset:2px;border-radius:6px}
.ik /* ---------- Top bar ---------- */
        .topbar{background:var(--ink);color:#fff;position:sticky;top:0;z-index:20;border-bottom:1px solid rgba(255,255,255,.08)}
.ik /* ---------- Page ---------- */
        .page{max-width:1240px;margin:0 auto;padding:clamp(20px,3vw,32px) clamp(16px,3vw,32px) 72px}
.ik .crumbs{display:flex;flex-wrap:wrap;align-items:center;gap:8px;font-size:.84rem;color:var(--steel);margin-bottom:10px}
.ik .crumbs a:hover{color:var(--ink);text-decoration:underline;text-underline-offset:3px}
.ik .crumbs i{font-size:.6rem;opacity:.6}
.ik .crumbs [aria-current]{color:var(--ink);font-weight:600}
.ik .page-head{display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:12px 24px;margin-bottom:24px}
.ik .page-head h1{font-family:var(--font-display);font-weight:800;font-stretch:88%;font-size:clamp(1.6rem,3.4vw,2.2rem);line-height:1.1;letter-spacing:-.03em}
.ik .page-head p{margin-top:6px;color:var(--steel);font-size:.95rem;max-width:62ch}
.ik .req-note{font-size:.84rem;font-weight:600;color:var(--steel);padding:6px 14px;border-radius:999px;background:#fff;border:1px solid var(--line)}
.ik .req{color:var(--signal-d)}
.ik .ik-layout{display:grid;grid-template-columns:minmax(0,1fr);gap:24px;align-items:start}
@media(min-width:1060px){.ik .ik-layout{grid-template-columns:minmax(0,1fr) 340px}}
.ik .ik-main{display:grid;gap:20px;min-width:0}
.ik .ik-side{display:grid;gap:16px;min-width:0}
@media(min-width:1060px){.ik .ik-side{position:sticky;top:calc(var(--topbar-h, 70px) + 16px)}}
.ik /* ---------- Cards ---------- */
        .ik-card{background:var(--card);border:1px solid var(--line);border-radius:var(--r-lg);box-shadow:var(--shadow);overflow:hidden}
.ik .ik-head{display:flex;align-items:center;gap:14px;padding:18px clamp(18px,2.4vw,28px);border-bottom:1px solid var(--line);background:linear-gradient(180deg,#fff,#fafbfc)}
.ik .ik-step{flex:none;width:34px;height:34px;border-radius:10px;display:grid;place-items:center;background:var(--ink);color:var(--amber);font-family:var(--font-display);font-weight:800;font-size:.95rem}
.ik .ik-head h2{font-family:var(--font-display);font-weight:700;font-stretch:92%;font-size:1.1rem;line-height:1.25;letter-spacing:-.01em}
.ik .ik-head p{font-size:.82rem;color:var(--steel);line-height:1.4;margin-top:1px}
.ik .ik-body{padding:clamp(18px,2.4vw,28px)}
.ik .ik-alert{display:flex;gap:12px;align-items:flex-start;padding:14px 16px;border-radius:var(--r-md);font-size:.9rem;line-height:1.5}
.ik .ik-alert i{margin-top:3px;flex:none}
.ik .ik-alert.err{background:var(--signal-bg);color:#8f1d15;border:1px solid #f5c3bf}
.ik .ik-alert.info{background:#eaf1f8;color:var(--ink-3);border:1px solid #d3e1ef}
.ik .ik-alert ul{margin-top:4px;padding-left:18px;list-style:disc}
.ik /* ---------- Fields ---------- */
        .fields{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px 20px}
.ik .field{min-width:0;display:flex;flex-direction:column}
.ik .field.full{grid-column:1/-1}
@media(max-width:700px){.ik .fields{grid-template-columns:minmax(0,1fr)}}
.ik .label{display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:7px;font-size:.86rem;font-weight:600;line-height:1.35}
.ik .hint{margin-top:6px;font-size:.78rem;color:var(--steel);line-height:1.4}
.ik .hint i{margin-right:4px}
.ik .field-err{margin-top:6px;display:flex;gap:7px;font-size:.8rem;font-weight:500;line-height:1.4;color:var(--signal-d)}
.ik .field-err i{margin-top:2px}
.ik .field-err:empty{display:none}
.ik .input{display:block;width:100%;height:46px;padding:0 14px;border:1px solid var(--line-2);border-radius:var(--r-md);background:#fff;font:inherit;font-size:.93rem;color:var(--ink);transition:border-color .15s,box-shadow .15s,background .15s}
.ik .input::placeholder{color:#9aa8b7}
.ik .input:hover{border-color:#aebbc9}
.ik .input:focus{outline:none;border-color:var(--ink);box-shadow:0 0 0 3px rgba(255,182,39,.45)}
.ik .input.is-invalid{border-color:var(--signal);background:#fffafa}
.ik .input.is-valid{border-color:var(--ok)}
.ik .input-select{appearance:none;-webkit-appearance:none;cursor:pointer;padding-right:42px;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%235b6c7f' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 15px center}
@media(max-width:640px){.ik .input{font-size:16px}}
.ik .unit{position:relative}
.ik .unit .input{padding-right:70px}
.ik .unit span{position:absolute;right:14px;top:50%;transform:translateY(-50%);font-size:.82rem;font-weight:600;color:var(--steel);pointer-events:none;padding-left:10px;border-left:1px solid var(--line)}
.ik .time-range{display:grid;grid-template-columns:minmax(0,1fr) auto minmax(0,1fr);align-items:center;gap:10px}
.ik .time-range>span{font-size:.85rem;color:var(--steel);font-weight:600}
.ik .pw-badge{display:none;align-items:center;gap:4px;padding:2px 9px;border-radius:999px;font-size:.7rem;font-weight:700;white-space:nowrap}
.ik .pw-badge.show{display:inline-flex}
.ik .pw-badge.match{background:var(--ok-bg);color:var(--ok)}
.ik .pw-badge.warn{background:var(--warn-bg);color:var(--warn)}
.ik .pw-badge.mismatch{background:var(--signal-bg);color:var(--signal-d)}
.ik .pw-status{margin-top:6px;display:none;align-items:center;gap:6px;font-size:.78rem;font-weight:600;line-height:1.35}
.ik .pw-status.show{display:inline-flex}
.ik .pw-status.match{color:var(--ok)}
.ik .pw-status.warn{color:var(--warn)}
.ik .pw-status.mismatch{color:var(--signal-d)}
.ik /* ---------- Berkas (baris ringkas) ---------- */
        .upload-list{display:grid;gap:12px}
.ik .upload-card{min-width:0}
.ik .upload-card.is-off{opacity:.55}
.ik .upload-card.is-off .dropzone{pointer-events:none;background:var(--paper);border-style:dotted}
.ik .badge-khusus{display:inline-block;margin-left:8px;padding:1px 8px;border-radius:6px;background:var(--signal-bg);color:var(--signal-d);font-size:.68rem;font-weight:700;vertical-align:middle;white-space:nowrap}
.ik .dropzone{position:relative;display:flex;align-items:center;min-height:76px;padding:12px 16px;border:1.5px dashed var(--line-2);border-radius:var(--r-md);background:#fbfcfd;cursor:pointer;transition:border-color .2s,background .2s,box-shadow .2s}
.ik .dropzone:hover,.ik .dropzone.is-over{border-color:var(--signal);background:#fff8f7}
.ik .dropzone:focus-within{outline:3px solid var(--amber);outline-offset:2px}
.ik .dropzone.has-files{border-style:solid;border-color:#b7e2c6;background:#f6fcf8;cursor:default}
.ik .dropzone.is-invalid{border-color:var(--signal);background:#fffafa}
.ik .dropzone input[type=file]{position:absolute;inset:0;width:100%;height:100%;opacity:0;cursor:pointer;z-index:1}
.ik .dropzone.has-files input[type=file]{pointer-events:none}
.ik .dz-prompt,.ik .dz-preview{display:flex;align-items:center;gap:14px;width:100%;min-width:0}
.ik .dropzone.has-files .dz-prompt{display:none}
.ik .dz-preview{display:none;position:relative;z-index:2}
.ik .dropzone.has-files .dz-preview{display:flex}
.ik .dz-ico{flex:none;width:44px;height:44px;border-radius:12px;display:grid;place-items:center;background:var(--signal-bg);color:var(--signal-d);font-size:1.05rem}
.ik .dz-info{flex:1;min-width:0}
.ik .dz-title{display:block;font-weight:600;font-size:.9rem;line-height:1.35}
.ik .dz-hint{display:block;margin-top:2px;font-size:.78rem;color:var(--steel);line-height:1.4}
.ik .dz-cta{flex:none;display:inline-flex;align-items:center;gap:7px;height:36px;padding:0 14px;border-radius:999px;background:var(--ink);color:#fff;font-size:.8rem;font-weight:700;transition:background .2s}
.ik .dropzone:hover .dz-cta{background:var(--signal)}
.ik .dz-thumb{flex:none;position:relative;width:56px;height:56px;border-radius:10px;overflow:hidden;background:var(--ink);border:1px solid var(--line);display:grid;place-items:center;color:#fff;font-size:1.3rem}
.ik .dz-thumb img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}
.ik .dz-thumb img[hidden]{display:none}
.ik .dz-thumb .ico-pdf{color:#ff8b8b}
.ik .dz-thumb.is-img .ico-pdf{display:none}
.ik .dz-ok{display:inline-flex;align-items:center;gap:5px;font-size:.72rem;font-weight:700;color:var(--ok);margin-bottom:1px}
.ik .dz-files{display:block;min-width:0}
.ik .dz-files li{display:flex;align-items:center;gap:8px;min-width:0;font-size:.82rem;font-weight:600}
.ik .f-name{min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.ik .f-size{flex:none;color:var(--steel);font-weight:500;font-size:.76rem;white-space:nowrap}
.ik .dz-actions{flex:none;display:flex;gap:6px}
.ik .btn-dz{display:inline-flex;align-items:center;justify-content:center;gap:6px;height:34px;padding:0 12px;border-radius:var(--r-sm);font-size:.76rem;font-weight:700;transition:.15s;white-space:nowrap}
.ik .btn-dz--change{background:#fff;border:1px solid var(--line-2)}
.ik .btn-dz--change:hover{background:var(--ink);color:#fff;border-color:var(--ink)}
.ik .btn-dz--remove{background:var(--signal-bg);color:var(--signal-d)}
.ik .btn-dz--remove:hover{background:var(--signal);color:#fff}
@media(max-width:560px){.ik .dropzone{padding:12px}
.ik .dz-prompt{flex-wrap:wrap}
.ik .dz-cta{width:100%;justify-content:center}
.ik .dz-preview{flex-wrap:wrap}
.ik .dz-actions{width:100%}
.ik .btn-dz{flex:1}}
.ik /* ---------- Sidebar ---------- */
        .ik-side .ik-body{padding:18px 20px}
.ik .ik-side h3{font-family:var(--font-display);font-weight:700;font-stretch:92%;font-size:1rem;letter-spacing:-.01em;margin-bottom:12px;display:flex;align-items:center;gap:10px}
.ik .ik-side h3 i{width:28px;height:28px;border-radius:8px;display:grid;place-items:center;background:var(--signal-bg);color:var(--signal-d);font-size:.78rem}
.ik .upl-top{display:flex;align-items:baseline;justify-content:space-between;gap:10px;font-size:.84rem;font-weight:600;color:var(--steel);margin-bottom:8px}
.ik .upl-top strong{color:var(--ink);font-family:var(--font-display);font-size:1.15rem}
.ik .upl-bar{height:8px;border-radius:999px;background:var(--line);overflow:hidden;margin-bottom:14px}
.ik .upl-bar i{display:block;height:100%;width:0;border-radius:inherit;background:linear-gradient(90deg,var(--amber),var(--ok));transition:width .5s cubic-bezier(.16,1,.3,1)}
.ik .ck{display:grid;gap:2px}
.ik .ck li{display:flex;align-items:center;gap:10px;padding:7px 0;font-size:.84rem;line-height:1.35;color:var(--steel);border-bottom:1px dashed var(--line)}
.ik .ck li:last-child{border-bottom:0}
.ik .ck li .dot{flex:none;width:20px;height:20px;border-radius:50%;display:grid;place-items:center;font-size:.6rem;border:1.5px solid var(--line-2);color:transparent;background:#fff}
.ik .ck li.done{color:var(--ink)}
.ik .ck li.done .dot{background:var(--ok);border-color:var(--ok);color:#fff}
.ik .ck li.off{opacity:.55}
.ik .ck li.off .dot{background:var(--paper);border-style:dotted}
.ik .ck li small{margin-left:auto;font-size:.7rem;font-weight:600;color:var(--steel);white-space:nowrap}
.ik .rules{display:grid;gap:10px;font-size:.84rem;line-height:1.45;color:var(--steel)}
.ik .rules li{display:flex;gap:10px}
.ik .rules li i{flex:none;width:20px;margin-top:3px;text-align:center;color:var(--signal-d)}
.ik .rules strong{color:var(--ink)}
.ik .ik-actions{display:grid;gap:10px}
.ik .ik-btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;height:50px;padding:0 24px;border-radius:999px;font-weight:700;font-size:.95rem;border:0;transition:background .2s,transform .15s,box-shadow .2s;cursor:pointer;width:100%}
.ik .ik-btn:active:not(:disabled){transform:scale(.985)}
.ik .ik-btn-primary{background:var(--signal);color:#fff;box-shadow:0 14px 28px -12px rgba(229,57,45,.65)}
.ik .ik-btn-primary:hover:not(:disabled){background:var(--signal-d)}
.ik .ik-btn-primary:disabled{background:#f3a7a1;cursor:not-allowed;box-shadow:none}
.ik .ik-btn-light{background:#fff;border:1.5px solid var(--line-2);color:var(--ink)}
.ik .ik-btn-light:hover{background:var(--paper);border-color:var(--ink)}
.ik .spin{animation:spin .8s linear infinite}
@keyframes spin{to{transform:rotate(360deg)}}
@media(prefers-reduced-motion:reduce){.ik *,.ik *::before,.ik *::after{animation:none!important;transition:none!important}}
.ik textarea.input{height:auto;min-height:104px;padding:12px 14px;line-height:1.5;resize:vertical;font-family:inherit}
.ik .choices{display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:10px}
.ik .choice{position:relative;display:block;cursor:pointer}
.ik .choice input{position:absolute;inset:0;width:100%;height:100%;opacity:0;cursor:pointer;z-index:1}
.ik .choice span{display:flex;align-items:center;gap:10px;min-height:48px;padding:0 16px;border:1.5px solid var(--line-2);border-radius:var(--r-md);background:#fff;font-weight:600;font-size:.9rem;transition:.15s}
.ik .choice span i{width:18px;text-align:center;color:var(--steel)}
.ik .choice:hover span{border-color:var(--ink)}
.ik .choice input:checked + span{border-color:var(--signal);background:var(--signal-bg);color:var(--signal-d)}
.ik .choice input:checked + span i{color:var(--signal-d)}
.ik .choice input:focus-visible + span{outline:3px solid var(--amber);outline-offset:2px}
.ik .ik-alert + .upload-list{margin-top:16px}
</style>
@endpush

@section('content')

@php
    $inv = fn ($n) => $errors->has($n) ? ' is-invalid' : '';
    $fe  = fn ($n) => $errors->has($n)
        ? '<p class="field-err"><i class="fas fa-circle-exclamation"></i> ' . e($errors->first($n)) . '</p>'
        : '';

    $daftar_sarana = $daftarSarana ?? ['Mobil Damkar'];
    $daftar_status = $daftarStatus ?? ['Menunggu', 'Proses', 'Disetujui', 'Ditolak'];

    // Jenis pemohon => label, ikon & keterangan berkas (sama dengan formulir publik)
    $jenis_pemohon = [
        'perorangan' => ['label' => 'Perorangan',     'ico' => 'fa-user',             'berkas' => 'Surat permohonan penggunaan sarana pemadam.'],
        'fasum'      => ['label' => 'Fasilitas Umum', 'ico' => 'fa-people-roof',      'berkas' => 'Surat permohonan yang diketahui oleh Ketua RT dan Lurah.'],
        'instansi'   => ['label' => 'Instansi',       'ico' => 'fa-building-columns', 'berkas' => 'Surat permohonan dari pimpinan instansi.'],
    ];
    $jenis_terpilih = old('jenis_pemohon', 'perorangan');
    if (!isset($jenis_pemohon[$jenis_terpilih])) { $jenis_terpilih = 'perorangan'; }

    $acc_umum  = '.pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png';
    $acc_surat = '.pdf,.jpg,.jpeg,.png,.zip,.rar,application/pdf,image/jpeg,image/png,application/zip,application/x-zip-compressed';

    // [kolom, judul, ikon, ekstensi, accept, keterangan]
    $berkas = [
        ['surat_permohonan',  'Surat Permohonan',               'fa-envelope-open-text', 'pdf,jpg,jpeg,png,zip,rar', $acc_surat, 'Surat permohonan resmi sesuai jenis pemohon. PDF, JPG, PNG, atau ZIP/RAR (maks. 5 MB)'],
        ['fotokopi_ktp',      'Fotokopi KTP Penanggung Jawab',  'fa-id-card',            'pdf,jpg,jpeg,png',         $acc_umum,  'Harus terbaca jelas dan masih berlaku. PDF, JPG, atau PNG (maks. 5 MB)'],
        ['sket_denah_lokasi', 'Sket Denah Lokasi Kegiatan',     'fa-map-location-dot',   'pdf,jpg,jpeg,png',         $acc_umum,  'Memuat titik lokasi kegiatan dan akses menuju lokasi. PDF, JPG, atau PNG (maks. 5 MB)'],
    ];
@endphp

<div class="ik">
    <nav aria-label="Breadcrumb">
        <ol class="crumbs" style="list-style:none">
            <li><a href="{{ route('internal.penggunaan-sarana.index') }}">Kelola Penggunaan Sarana</a></li>
            <li><i class="fas fa-chevron-right"></i></li>
            <li aria-current="page">Input Data</li>
        </ol>
    </nav>

    <div class="page-head">
        <div>
            <h1>Input Penggunaan Sarana</h1>
            <p>Permohonan penggunaan sarana pemadam kebakaran. Gunakan formulir ini untuk mencatat permohonan yang datang langsung atau melalui surat.</p>
        </div>
        <span class="req-note"><span class="req">*</span> wajib diisi</span>
    </div>

    <form class="ik-layout" action="{{ route('internal.penggunaan-sarana.store') }}" method="POST" enctype="multipart/form-data" id="form_sarana">
        @csrf

        <div class="ik-main">

            @if($errors->any())
                <div class="ik-alert err" role="alert">
                    <i class="fas fa-triangle-exclamation"></i>
                    <div>
                        Data belum tersimpan. Mohon periksa kembali:
                        <ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
                    </div>
                </div>
            @endif

            {{-- 1. DATA PEMOHON --}}
            <section class="ik-card" aria-labelledby="h-pemohon">
                <div class="ik-head">
                    <span class="ik-step">1</span>
                    <div><h2 id="h-pemohon">Data Pemohon</h2><p>Identitas orang yang mengajukan permohonan</p></div>
                </div>
                <div class="ik-body">
                    <div class="fields">
                        <div class="field full">
                            <label class="label" for="nama"><span>Nama Lengkap <span class="req">*</span></span></label>
                            <input class="input{{ $inv('nama') }}" type="text" id="nama" name="nama" value="{{ old('nama') }}" autocomplete="off" required>
                            {!! $fe('nama') !!}
                        </div>
                        <div class="field">
                            <label class="label" for="nik"><span>NIK <span class="req">*</span></span><span class="pw-badge" id="nik_badge"></span></label>
                            <input class="input{{ $inv('nik') }}" type="text" id="nik" name="nik" value="{{ old('nik') }}" inputmode="numeric" maxlength="16" placeholder="16 digit NIK" autocomplete="off" required>
                            <p class="pw-status" id="nik_msg" aria-live="polite"></p>
                            {!! $fe('nik') !!}
                        </div>
                        <div class="field">
                            <label class="label" for="no_hp"><span>No HP/WA <span class="req">*</span></span><span class="pw-badge" id="wa_badge"></span></label>
                            <input class="input{{ $inv('no_hp') }}" type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" inputmode="tel" maxlength="14" placeholder="Contoh: 081234567890" autocomplete="off" required>
                            <p class="pw-status" id="wa_msg" aria-live="polite"></p>
                            {!! $fe('no_hp') !!}
                        </div>
                        <div class="field full">
                            <label class="label" for="alamat"><span>Alamat <span class="req">*</span></span></label>
                            <input class="input{{ $inv('alamat') }}" type="text" id="alamat" name="alamat" value="{{ old('alamat') }}" autocomplete="off" required>
                            {!! $fe('alamat') !!}
                        </div>
                    </div>
                </div>
            </section>

            {{-- 2. DATA INSTANSI / FASUM / PERORANGAN --}}
            <section class="ik-card" aria-labelledby="h-instansi">
                <div class="ik-head">
                    <span class="ik-step">2</span>
                    <div><h2 id="h-instansi">Data Instansi / Fasilitas Umum / Perorangan</h2><p>Jenis pemohon dan penanggung jawab kegiatan</p></div>
                </div>
                <div class="ik-body">
                    <div class="fields">
                        <div class="field full">
                            <span class="label" id="lbl-jenis"><span>Jenis Pemohon <span class="req">*</span></span></span>
                            <div class="choices" role="radiogroup" aria-labelledby="lbl-jenis">
                                @foreach($jenis_pemohon as $key => $jp)
                                    <label class="choice">
                                        <input type="radio" name="jenis_pemohon" value="{{ $key }}" data-berkas="{{ $jp['berkas'] }}" @checked($jenis_terpilih === $key) required>
                                        <span><i class="fas {{ $jp['ico'] }}"></i> {{ $jp['label'] }}</span>
                                    </label>
                                @endforeach
                            </div>
                            {!! $fe('jenis_pemohon') !!}
                        </div>
                        <div class="field full">
                            <label class="label" for="nama_penanggung_jawab"><span>Nama Penanggung Jawab <span class="req">*</span></span></label>
                            <input class="input{{ $inv('nama_penanggung_jawab') }}" type="text" id="nama_penanggung_jawab" name="nama_penanggung_jawab" value="{{ old('nama_penanggung_jawab') }}" autocomplete="off" required>
                            {!! $fe('nama_penanggung_jawab') !!}
                        </div>
                        <div class="field full">
                            <label class="label" for="nama_instansi"><span>Nama Instansi / Fasilitas Umum / Perorangan <span class="req">*</span></span></label>
                            <input class="input{{ $inv('nama_instansi') }}" type="text" id="nama_instansi" name="nama_instansi" value="{{ old('nama_instansi') }}" autocomplete="off" required>
                            {!! $fe('nama_instansi') !!}
                        </div>
                        <div class="field full">
                            <label class="label" for="alamat_instansi"><span>Alamat Instansi <span class="req">*</span></span></label>
                            <input class="input{{ $inv('alamat_instansi') }}" type="text" id="alamat_instansi" name="alamat_instansi" value="{{ old('alamat_instansi') }}" autocomplete="off" required>
                            {!! $fe('alamat_instansi') !!}
                        </div>
                    </div>
                </div>
            </section>

            {{-- 3. SARANA --}}
            <section class="ik-card" aria-labelledby="h-sarana">
                <div class="ik-head">
                    <span class="ik-step">3</span>
                    <div><h2 id="h-sarana">Sarana yang Diajukan</h2><p>Jenis sarana dan kegunaannya</p></div>
                </div>
                <div class="ik-body">
                    <div class="fields">
                        <div class="field full">
                            <label class="label" for="sarana"><span>Sarana <span class="req">*</span></span></label>
                            <select class="input input-select{{ $inv('sarana') }}" id="sarana" name="sarana" required>
                                <option value="" disabled {{ old('sarana') ? '' : 'selected' }}>Pilih sarana</option>
                                @foreach($daftar_sarana as $s)
                                    <option value="{{ $s }}" {{ old('sarana') === $s ? 'selected' : '' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                            {!! $fe('sarana') !!}
                        </div>
                        <div class="field full">
                            <label class="label" for="kegunaan"><span>Kegunaan Sarana <span class="req">*</span></span></label>
                            <textarea class="input{{ $inv('kegunaan') }}" id="kegunaan" name="kegunaan" rows="3" maxlength="1000" placeholder="Contoh: pelayanan air bersih untuk bencana kekeringan" required>{{ old('kegunaan') }}</textarea>
                            <p class="hint"><i class="fas fa-circle-info"></i>Diperuntukkan pelayanan air bersih: bencana kekeringan, pasca bencana, gotong royong, dan kegiatan sosial lainnya.</p>
                            {!! $fe('kegunaan') !!}
                        </div>
                    </div>
                </div>
            </section>

            {{-- 4. LOKASI KEGIATAN --}}
            <section class="ik-card" aria-labelledby="h-lokasi">
                <div class="ik-head">
                    <span class="ik-step">4</span>
                    <div><h2 id="h-lokasi">Data Lokasi Kegiatan</h2><p>Nama kegiatan, lokasi, tanggal, dan waktu pelaksanaan</p></div>
                </div>
                <div class="ik-body">
                    <div class="fields">
                        <div class="field full">
                            <label class="label" for="nama_kegiatan"><span>Nama Kegiatan <span class="req">*</span></span></label>
                            <input class="input{{ $inv('nama_kegiatan') }}" type="text" id="nama_kegiatan" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" autocomplete="off" required>
                            {!! $fe('nama_kegiatan') !!}
                        </div>
                        <div class="field full">
                            <label class="label" for="lokasi_kegiatan"><span>Lokasi Kegiatan <span class="req">*</span></span></label>
                            <input class="input{{ $inv('lokasi_kegiatan') }}" type="text" id="lokasi_kegiatan" name="lokasi_kegiatan" value="{{ old('lokasi_kegiatan') }}" autocomplete="off" required>
                            <p class="hint"><i class="fas fa-circle-info"></i>Lokasi kegiatan harus berada di wilayah Kota Jambi.</p>
                            {!! $fe('lokasi_kegiatan') !!}
                        </div>
                        <div class="field">
                            <label class="label" for="tgl_pelaksanaan"><span>Tanggal Pelaksanaan <span class="req">*</span></span><span class="pw-badge" id="tgl_badge"></span></label>
                            <input class="input{{ $inv('tgl_pelaksanaan') }}" type="date" id="tgl_pelaksanaan" name="tgl_pelaksanaan" value="{{ old('tgl_pelaksanaan') }}" required>
                            <p class="pw-status" id="tgl_msg" aria-live="polite"></p>
                            {!! $fe('tgl_pelaksanaan') !!}
                        </div>
                        <div class="field">
                            <label class="label"><span>Waktu Pelaksanaan <span class="req">*</span></span></label>
                            <div class="time-range">
                                <input class="input{{ $inv('waktu_mulai') }}" type="time" name="waktu_mulai" value="{{ old('waktu_mulai') }}" aria-label="Waktu mulai" required>
                                <span>s/d</span>
                                <input class="input{{ $inv('waktu_selesai') }}" type="time" name="waktu_selesai" value="{{ old('waktu_selesai') }}" aria-label="Waktu selesai" required>
                            </div>
                            {!! $fe('waktu_mulai') !!}
                            {!! $fe('waktu_selesai') !!}
                        </div>
                    </div>
                </div>
            </section>

            {{-- 5. BERKAS --}}
            <section class="ik-card" aria-labelledby="h-berkas">
                <div class="ik-head">
                    <span class="ik-step">5</span>
                    <div><h2 id="h-berkas">Berkas Persyaratan Administrasi</h2><p>Unggah dokumen persyaratan (maks. 5 MB per berkas)</p></div>
                </div>
                <div class="ik-body">
                    <div class="ik-alert info" role="note">
                        <i class="fas fa-circle-info"></i>
                        <div><strong>Ketentuan surat permohonan:</strong> <span id="berkas-info">{{ $jenis_pemohon[$jenis_terpilih]['berkas'] }}</span></div>
                    </div>

                    <div class="upload-list">
                        @foreach($berkas as [$nm, $judul, $ikon, $ext, $accept, $ket])
                            <div class="upload-card" data-field="{{ $nm }}">
                                <div class="dropzone{{ $inv($nm) }}" data-dropzone data-max="5" data-ext="{{ $ext }}">
                                    <input type="file" id="{{ $nm }}" name="{{ $nm }}" accept="{{ $accept }}" required aria-labelledby="lbl-{{ $nm }}">

                                    <div class="dz-prompt">
                                        <span class="dz-ico"><i class="fas {{ $ikon }}"></i></span>
                                        <span class="dz-info">
                                            <span class="dz-title" id="lbl-{{ $nm }}">{{ $judul }} <span class="req">*</span></span>
                                            <span class="dz-hint">{{ $ket }}</span>
                                        </span>
                                        <span class="dz-cta"><i class="fas fa-arrow-up-from-bracket"></i> Pilih berkas</span>
                                    </div>

                                    <div class="dz-preview">
                                        <span class="dz-thumb">
                                            <img alt="Pratinjau {{ $judul }}" data-dz-img hidden>
                                            <i class="fas fa-file-pdf ico-pdf"></i>
                                        </span>
                                        <span class="dz-info">
                                            <span class="dz-ok"><i class="fas fa-circle-check"></i> Siap diunggah &middot; {{ $judul }}</span>
                                            <ul class="dz-files" aria-live="polite"></ul>
                                        </span>
                                        <span class="dz-actions">
                                            <button type="button" class="btn-dz btn-dz--change" data-dz-change><i class="fas fa-arrows-rotate"></i> Ganti</button>
                                            <button type="button" class="btn-dz btn-dz--remove" data-dz-remove><i class="fas fa-trash-can"></i> Hapus</button>
                                        </span>
                                    </div>
                                </div>
                                <p class="field-err dz-msg" role="alert"></p>
                                {!! $fe($nm) !!}
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>

        {{-- ========== SIDEBAR ========== --}}
        <aside class="ik-side" aria-label="Ringkasan formulir">
            <section class="ik-card">
                <div class="ik-body">
                    <h3><i class="fas fa-list-check"></i> Kelengkapan Berkas</h3>
                    <div class="upl-top" aria-live="polite">
                        <span id="uplCount">0 dari 3 berkas</span>
                        <strong id="uplPct">0%</strong>
                    </div>
                    <div class="upl-bar" aria-hidden="true"><i id="uplBar"></i></div>
                    <ul class="ck" id="ckList">
                        @foreach($berkas as [$nm, $judul])
                            <li data-ck="{{ $nm }}">
                                <span class="dot"><i class="fas fa-check"></i></span>
                                <span>{{ $judul }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>

            <section class="ik-card">
                <div class="ik-body">
                    <h3><i class="fas fa-flag"></i> Status Permohonan</h3>
                    <label class="label" for="status"><span>Status awal</span></label>
                    <select class="input input-select{{ $inv('status') }}" id="status" name="status">
                        @foreach($daftar_status as $st)
                            <option value="{{ $st }}" {{ old('status', 'Menunggu') === $st ? 'selected' : '' }}>{{ $st }}</option>
                        @endforeach
                    </select>
                    <p class="hint"><i class="fas fa-circle-info"></i>Default <strong>Menunggu</strong>, sama seperti pengajuan dari pemohon.</p>
                    {!! $fe('status') !!}
                </div>
            </section>

            <section class="ik-card">
                <div class="ik-body">
                    <h3><i class="fas fa-scale-balanced"></i> Ketentuan Layanan</h3>
                    <ul class="rules">
                        <li><i class="fas fa-calendar-day"></i><span>Permohonan paling lambat <strong>H-7</strong> sebelum kegiatan. Untuk input petugas, tanggal tidak dibatasi namun diberi peringatan.</span></li>
                        <li><i class="fas fa-location-dot"></i><span>Lokasi kegiatan di wilayah <strong>Kota Jambi</strong>.</span></li>
                        <li><i class="fas fa-file-signature"></i><span>Surat permohonan menyesuaikan <strong>jenis pemohon</strong>.</span></li>
                    </ul>
                </div>
            </section>

            <div class="ik-actions">
                <button type="submit" class="ik-btn ik-btn-primary" id="btn_submit"><i class="fas fa-floppy-disk"></i> Simpan data</button>
                <a class="ik-btn ik-btn-light" href="{{ route('internal.penggunaan-sarana.index') }}">Batal</a>
            </div>
        </aside>
    </form>
</div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';
    var $ = function (id) { return document.getElementById(id); };
    var btn = $('btn_submit');

    function setUI(input, badge, msg, state, badgeHtml, msgHtml) {
        input.classList.remove('is-valid', 'is-invalid');
        if (state === 'match') input.classList.add('is-valid');
        if (state === 'mismatch') input.classList.add('is-invalid');
        badge.className = 'pw-badge' + (badgeHtml ? ' show ' + state : '');
        badge.innerHTML = badgeHtml || '';
        msg.className = 'pw-status' + (msgHtml ? ' show ' + state : '');
        msg.innerHTML = msgHtml || '';
    }

    /* Keterangan surat mengikuti jenis pemohon */
    var berkasInfo = $('berkas-info');
    document.querySelectorAll('input[name="jenis_pemohon"]').forEach(function (r) {
        r.addEventListener('change', function () {
            if (r.checked && berkasInfo) berkasInfo.textContent = r.getAttribute('data-berkas');
        });
    });

    /* NIK */
    var nik = $('nik');
    function vNik() {
        var v = nik.value.replace(/\D/g, '').slice(0, 16);
        nik.value = v;
        if (!v) return setUI(nik, $('nik_badge'), $('nik_msg'), '', '', '');
        if (v.length < 16) return setUI(nik, $('nik_badge'), $('nik_msg'), 'mismatch', v.length + '/16', '<i class="fas fa-circle-exclamation"></i> Kurang ' + (16 - v.length) + ' digit lagi');
        setUI(nik, $('nik_badge'), $('nik_msg'), 'match', '<i class="fas fa-check"></i> 16/16', '<i class="fas fa-circle-check"></i> Format NIK sesuai');
    }
    nik.addEventListener('input', vNik); if (nik.value) vNik();

    /* No HP/WA */
    var wa = $('no_hp');
    function vWa() {
        var v = wa.value.replace(/\D/g, '');
        if (v.indexOf('628') === 0) v = '08' + v.slice(3); else if (v.charAt(0) === '8') v = '08' + v.slice(1);
        v = v.slice(0, 14); wa.value = v;
        if (!v) return setUI(wa, $('wa_badge'), $('wa_msg'), '', '', '');
        if (v.indexOf('08') !== 0) return setUI(wa, $('wa_badge'), $('wa_msg'), 'mismatch', 'Format salah', '<i class="fas fa-circle-xmark"></i> Nomor harus diawali 08');
        if (v.length < 10) return setUI(wa, $('wa_badge'), $('wa_msg'), 'mismatch', v.length + ' digit', '<i class="fas fa-circle-exclamation"></i> Nomor terlalu pendek (min. 10 digit)');
        setUI(wa, $('wa_badge'), $('wa_msg'), 'match', '', '<i class="fas fa-circle-check"></i> Nomor valid (' + v.length + ' digit)');
    }
    wa.addEventListener('input', vWa); if (wa.value) vWa();

    /* Tanggal: hanya peringatan H-7 (tidak memblokir untuk input petugas) */
    var tgl = $('tgl_pelaksanaan');
    function vTgl() {
        if (!tgl.value) return setUI(tgl, $('tgl_badge'), $('tgl_msg'), '', '', '');
        var sel = new Date(tgl.value + 'T00:00:00'), min = new Date();
        min.setHours(0, 0, 0, 0); min.setDate(min.getDate() + 7);
        if (sel < min) setUI(tgl, $('tgl_badge'), $('tgl_msg'), 'warn', '<i class="fas fa-triangle-exclamation"></i> Kurang dari H-7', '<i class="fas fa-circle-exclamation"></i> Tidak memenuhi ketentuan H-7 (tetap bisa disimpan)');
        else setUI(tgl, $('tgl_badge'), $('tgl_msg'), 'match', '<i class="fas fa-check"></i> Sesuai', '<i class="fas fa-calendar-check"></i> Memenuhi ketentuan H-7');
        tgl.classList.remove('is-invalid');
    }
    tgl.addEventListener('change', vTgl); if (tgl.value) vTgl();

    /* ---------- Dropzone ---------- */
    function fmt(b) { return b < 1048576 ? Math.max(1, Math.round(b / 1024)) + ' KB' : (b / 1048576).toFixed(2) + ' MB'; }
    var dzs = document.querySelectorAll('[data-dropzone]');

    function refresh() {
        var cards = document.querySelectorAll('.upload-list .upload-card'), total = 0, done = 0;
        cards.forEach(function (c) {
            var ok = c.querySelector('.dropzone').classList.contains('has-files');
            var li = document.querySelector('#ckList [data-ck="' + c.dataset.field + '"]');
            if (li) li.classList.toggle('done', ok);
            total++; if (ok) done++;
        });
        var pct = total ? Math.round(done / total * 100) : 0;
        $('uplCount').textContent = done + ' dari ' + total + ' berkas';
        $('uplPct').textContent = pct + '%';
        $('uplBar').style.width = pct + '%';
        btn.disabled = !!document.querySelector('.dropzone.is-invalid:not([data-srv])');
    }

    dzs.forEach(function (dz) {
        var input = dz.querySelector('input[type=file]'), list = dz.querySelector('.dz-files'),
            img = dz.querySelector('[data-dz-img]'), thumb = dz.querySelector('.dz-thumb'),
            icon = dz.querySelector('.ico-pdf'),
            max = parseFloat(dz.dataset.max) || 5, exts = dz.dataset.ext.split(','),
            msg = dz.parentNode.querySelector('.dz-msg');

        if (dz.classList.contains('is-invalid')) dz.dataset.srv = '1';

        function reset() {
            input.value = ''; list.innerHTML = '';
            if (img._url) { URL.revokeObjectURL(img._url); img._url = null; }
            img.removeAttribute('src'); img.hidden = true; thumb.classList.remove('is-img');
            dz.classList.remove('has-files', 'is-over');
        }
        function bad(text) { reset(); dz.classList.add('is-invalid'); msg.innerHTML = '<i class="fas fa-circle-exclamation"></i> ' + text; refresh(); }

        function handle(files) {
            list.innerHTML = ''; msg.innerHTML = ''; dz.classList.remove('is-invalid'); delete dz.dataset.srv;
            if (!files || !files.length) { reset(); return refresh(); }
            var f = files[0], ext = (f.name.split('.').pop() || '').toLowerCase();
            if (exts.indexOf(ext) === -1) return bad('Format "' + f.name + '" tidak didukung. Gunakan: ' + exts.join(', ').toUpperCase() + '.');
            if (f.size > max * 1048576) return bad('Ukuran "' + f.name + '" (' + fmt(f.size) + ') melebihi batas ' + max + ' MB.');

            var isImg = ['jpg', 'jpeg', 'png'].indexOf(ext) > -1;
            if (img._url) URL.revokeObjectURL(img._url);
            if (isImg) { img._url = URL.createObjectURL(f); img.src = img._url; img.hidden = false; thumb.classList.add('is-img'); }
            else {
                img.removeAttribute('src'); img.hidden = true; thumb.classList.remove('is-img');
                icon.className = 'fas ' + ((ext === 'zip' || ext === 'rar') ? 'fa-file-zipper' : 'fa-file-pdf') + ' ico-pdf';
            }

            var li = document.createElement('li'), n = document.createElement('span'), s = document.createElement('span');
            n.className = 'f-name'; n.textContent = f.name; n.title = f.name;
            s.className = 'f-size'; s.textContent = fmt(f.size);
            li.appendChild(n); li.appendChild(s); list.appendChild(li);
            dz.classList.add('has-files'); refresh();
        }

        input.addEventListener('change', function () { handle(input.files); });
        ['dragenter', 'dragover'].forEach(function (e) { dz.addEventListener(e, function (ev) { ev.preventDefault(); dz.classList.add('is-over'); }); });
        ['dragleave', 'dragend'].forEach(function (e) { dz.addEventListener(e, function () { dz.classList.remove('is-over'); }); });
        dz.addEventListener('drop', function (ev) {
            ev.preventDefault(); dz.classList.remove('is-over');
            var f = ev.dataTransfer && ev.dataTransfer.files; if (!f || !f.length) return;
            try { var dt = new DataTransfer(); dt.items.add(f[0]); input.files = dt.files; } catch (e) { input.files = f; }
            handle(input.files);
        });
        dz.querySelector('[data-dz-change]').addEventListener('click', function (e) { e.preventDefault(); input.click(); });
        dz.querySelector('[data-dz-remove]').addEventListener('click', function (e) {
            e.preventDefault(); reset(); msg.innerHTML = ''; dz.classList.remove('is-invalid'); refresh();
        });
    });
    refresh();

    /* Cegah kirim ganda */
    $('form_sarana').addEventListener('submit', function () {
        setTimeout(function () { btn.disabled = true; btn.innerHTML = '<i class="fas fa-circle-notch spin"></i> Menyimpan...'; }, 0);
    });
})();
</script>
@endpush
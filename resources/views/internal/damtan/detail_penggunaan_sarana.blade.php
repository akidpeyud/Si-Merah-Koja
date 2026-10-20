@extends('layouts.dashboard')

{{-- Judul halaman --}}
@section('title', 'Permohonan-Penggunaan-Sarana_PS-' . ($row->created_at ? $row->created_at->format('Y') : date('Y')) . '-' . str_pad($row->id, 4, '0', STR_PAD_LEFT) . '_' . \Illuminate\Support\Str::slug($row->nama))

@push('styles')
<style>
    :root {
        --ink: #0d1b2a; --ink-2: #132a43; --ink-3: #1d3856;
        --navy: #163a63; --navy-dark: #0d2947; --navy-light: #eaf1f8; --navy-soft: rgba(22, 58, 99, .08);
        --paper: #f5f7fa; --white: #ffffff;
        --signal: #dc3545; --signal-dark: #b42332; --signal-soft: rgba(220, 53, 69, .09);
        --amber: #f4b740; --success: #198754; --info: #2563eb; --info-soft: rgba(37, 99, 235, .09);
        --steel: #64748b; --steel-soft: #94a3b8;
        --line: #e2e8f0; --line-dark: #cbd5e1;
        --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
        --font-body: 'Instrument Sans', system-ui, sans-serif;
        --r-lg: 18px; --r-md: 14px; --r-sm: 10px;
        --sidebar-w: 272px; --topbar-h: 70px;
        --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
        --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
        --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
        --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);
    }
    #globalSuccessAlert, #globalErrorAlert { position: fixed; top: 30px; left: 50%; transform: translateX(-50%); color: white; padding: 16px 24px; border-radius: var(--r-md); z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    #globalSuccessAlert { background-color: var(--success); box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
    #globalErrorAlert { background-color: var(--signal); box-shadow: 0 10px 25px -5px rgba(229, 57, 45, 0.4); }
    .alert-icon { font-size: 22px; }
    .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s; }
    .btn-close-alert:hover { opacity: 1; }
    @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
    @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }
    .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    .page-header { margin-bottom: 24px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; }
    .page-header-text h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-header-text p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }
    .btn-custom-light { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 22px; background: var(--white); color: var(--ink); border: 1px solid var(--line-dark); border-radius: 8px; font-size: .92rem; font-weight: 600; text-decoration: none; transition: all .2s ease; }
    .btn-custom-light:hover { background: #f8fafc; border-color: var(--steel-soft); color: var(--ink); }
    .header-actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
    .btn-print { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 22px; background: var(--signal); color: #ffffff; border: 1px solid var(--signal); border-radius: 8px; font-size: .92rem; font-weight: 600; transition: background .2s, border-color .2s, transform .1s, box-shadow .2s; cursor: pointer; }
    .btn-print:hover { background: var(--signal-dark); border-color: var(--signal-dark); color: #ffffff; box-shadow: 0 6px 14px rgba(220, 53, 69, .25); }
    .btn-print:active { transform: scale(.97); }

    /* TAMPILAN LAYAR */
    .badge-status { display: inline-flex; align-items: center; gap: 7px; padding: 6px 14px; font-weight: 700; font-size: .8rem; border-radius: 999px; line-height: 1.2; }
    .badge-status::before { content: ""; width: 7px; height: 7px; border-radius: 50%; background: currentColor; }
    .badge-menunggu  { background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
    .badge-proses    { background-color: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .badge-disetujui { background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .badge-ditolak   { background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }

    .dt-hero { --accent: var(--navy); display: flex; justify-content: space-between; align-items: center; gap: 20px 32px; flex-wrap: wrap; background: #fff; border: 1px solid var(--line); border-left: 5px solid var(--accent); border-radius: var(--r-md); padding: 24px 28px; box-shadow: var(--shadow-xs); margin-bottom: 20px; }
    .dt-hero.st-Menunggu  { --accent: #f59e0b; }
    .dt-hero.st-Proses    { --accent: #2563eb; }
    .dt-hero.st-Disetujui { --accent: #16a34a; }
    .dt-hero.st-Ditolak   { --accent: #dc2626; }
    .dt-hero-main { min-width: 0; flex: 1 1 320px; }
    .dt-eyebrow { font-size: .75rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: var(--steel); margin-bottom: 6px; }
    .dt-hero h2 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.25rem, 2.4vw, 1.65rem); line-height: 1.25; letter-spacing: -.015em; color: var(--ink); margin: 0 0 8px; overflow-wrap: anywhere; }
    .dt-hero-sub { color: var(--steel); font-size: .92rem; margin: 0; }
    .dt-hero-sub strong { color: var(--ink); }
    .dt-hero-side { display: grid; gap: 8px; justify-items: end; text-align: right; }
    .dt-hero-note { font-size: .84rem; color: var(--steel); max-width: 34ch; line-height: 1.45; }

    .dt-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 14px; margin-bottom: 20px; }
    .dt-stat { display: flex; align-items: center; gap: 14px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 16px 18px; box-shadow: var(--shadow-xs); min-width: 0; }
    .dt-stat-ico { flex: none; width: 44px; height: 44px; border-radius: 12px; display: grid; place-items: center; background: var(--navy-light); color: var(--navy); font-size: 1.05rem; }
    .dt-stat small { display: block; font-size: .74rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase; color: var(--steel); margin-bottom: 2px; }
    .dt-stat strong { display: block; font-size: .95rem; font-weight: 600; color: var(--ink); line-height: 1.35; overflow-wrap: anywhere; }

    .dt-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; align-items: start; }
    @media (max-width: 991px) { .dt-grid { grid-template-columns: minmax(0, 1fr); } }
    .dt-col { display: grid; gap: 20px; min-width: 0; }

    .dt-card { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); overflow: hidden; }
    .dt-card-head { display: flex; align-items: center; gap: 12px; padding: 16px 22px; background: #fbfcfe; border-bottom: 1px solid var(--line); }
    .dt-card-head i { flex: none; width: 34px; height: 34px; border-radius: 10px; display: grid; place-items: center; background: var(--navy); color: #fff; font-size: .85rem; }
    .dt-card-head h3 { font-family: var(--font-display); font-weight: 700; font-size: 1.02rem; letter-spacing: -.005em; color: var(--ink); margin: 0; }
    .dt-card-body { padding: 6px 22px 8px; }

    .dt-dl { margin: 0; }
    .dt-row { display: grid; grid-template-columns: 172px minmax(0, 1fr); gap: 4px 18px; padding: 13px 0; border-bottom: 1px dashed var(--line); }
    .dt-row:last-child { border-bottom: 0; }
    .dt-row dt { font-size: .82rem; font-weight: 600; color: var(--steel); line-height: 1.5; }
    .dt-row dd { margin: 0; font-size: .93rem; font-weight: 500; color: var(--ink); line-height: 1.55; overflow-wrap: anywhere; }
    @media (max-width: 575px) { .dt-row { grid-template-columns: minmax(0, 1fr); } }

    /* Lampiran: 3 berkas (surat, KTP, sket denah), otomatis 1-3 kolom sesuai lebar */
    .dt-attach { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 22px; padding: 20px 22px 22px; }
    .dt-attach-item { min-width: 0; }
    .dt-attach-label { display: flex; align-items: center; gap: 8px; font-size: .76rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase; color: var(--steel); margin-bottom: 10px; }
    .dt-attach-label i { color: var(--navy); }
    .dt-photo { display: block; border: 1px solid var(--line); border-radius: var(--r-sm); overflow: hidden; background: var(--ink); }
    .dt-photo img { display: block; width: 100%; max-height: 300px; object-fit: contain; background: #0d1b2a; transition: transform .3s ease; }
    .dt-photo:hover img { transform: scale(1.02); }
    .dt-file { display: flex; align-items: center; gap: 14px; flex-wrap: wrap; padding: 16px; border: 1px solid var(--line); border-radius: var(--r-sm); background: #fbfcfe; }
    .dt-file-ico { flex: none; width: 48px; height: 48px; border-radius: 12px; display: grid; place-items: center; background: var(--signal-soft); color: var(--signal); font-size: 1.3rem; }
    .dt-file-ico.is-zip { background: rgba(244, 183, 64, .18); color: #b45309; }
    .dt-file-info { min-width: 0; flex: 1 1 120px; }
    .dt-file-info strong { display: block; font-size: .9rem; color: var(--ink); overflow-wrap: anywhere; line-height: 1.4; }
    .dt-file-info span { font-size: .8rem; color: var(--steel); }
    .dt-file-btn { flex: none; display: inline-flex; align-items: center; gap: 8px; padding: 9px 16px; border-radius: 8px; background: var(--navy); color: #fff; font-size: .84rem; font-weight: 600; text-decoration: none; transition: background .2s; }
    .dt-file-btn:hover { background: var(--navy-dark); color: #fff; }
    .dt-missing { padding: 14px 16px; border: 1px dashed var(--line-dark); border-radius: var(--r-sm); font-size: .88rem; color: var(--steel); text-align: center; }

    /* TAMPILAN CETAK / PDF (Disembunyikan di layar, aktif saat html2pdf merender) */
    .print-only { display: none; }
</style>
@endpush

@section('content')

@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;

    $badge = match($row->status) {
        'Menunggu'  => 'badge-menunggu',
        'Proses'    => 'badge-proses',
        'Disetujui' => 'badge-disetujui',
        'Ditolak'   => 'badge-ditolak',
        default     => '',
    };

    $keteranganStatus = match($row->status) {
        'Menunggu'  => 'Permohonan telah diterima dan menunggu verifikasi petugas.',
        'Proses'    => 'Permohonan sedang diproses oleh petugas.',
        'Disetujui' => 'Permohonan telah disetujui.',
        'Ditolak'   => 'Permohonan tidak dapat disetujui.',
        default     => '',
    };

    $jenisLabel = [
        'perorangan' => 'Perorangan',
        'fasum'      => 'Fasilitas Umum',
        'instansi'   => 'Instansi',
    ][$row->jenis_pemohon] ?? ucfirst($row->jenis_pemohon);

    $tglKegiatan  = Carbon::parse($row->tgl_pelaksanaan)->locale('id')->translatedFormat('l, d F Y');
    $tglSingkat   = Carbon::parse($row->tgl_pelaksanaan)->locale('id')->translatedFormat('d M Y');
    $waktu        = substr($row->waktu_mulai, 0, 5) . ' - ' . substr($row->waktu_selesai, 0, 5) . ' WIB';
    $diajukan     = $row->created_at ? $row->created_at->locale('id')->translatedFormat('d F Y, H:i') . ' WIB' : '-';
    $diajukanTgl  = $row->created_at ? $row->created_at->locale('id')->translatedFormat('d F Y') : '-';
    $noReg        = 'PS-' . ($row->created_at ? $row->created_at->format('Y') : date('Y')) . '-' . str_pad($row->id, 4, '0', STR_PAD_LEFT);
    $tglCetak     = Carbon::now()->locale('id')->translatedFormat('d F Y');
    $jamCetak     = Carbon::now()->locale('id')->translatedFormat('d F Y, H:i');
    $petugas      = Auth::user()->nama_lengkap ?? 'Admin Damkar';

    // Berkas lampiran (kolom di tabel: surat_permohonan, fotokopi_ktp, sket_denah_lokasi)
    $lampiran = [];
    foreach ([
        'surat_permohonan'  => ['Surat Permohonan',               'fa-envelope-open-text'],
        'fotokopi_ktp'      => ['Fotokopi KTP Penanggung Jawab',  'fa-id-card'],
        'sket_denah_lokasi' => ['Sket Denah Lokasi Kegiatan',     'fa-map-location-dot'],
    ] as $kolom => [$label, $ikon]) {
        $path = $row->{$kolom};
        $ext  = $path ? strtolower(pathinfo($path, PATHINFO_EXTENSION)) : '';
        $lampiran[] = [
            'kolom' => $kolom,
            'label' => $label,
            'ikon'  => $ikon,
            'ada'   => (bool) $path,
            'url'   => $path ? asset('storage/' . $path) : null,
            'nama'  => $path ? basename($path) : '-',
            'ext'   => $ext,
            'image' => in_array($ext, ['jpg', 'jpeg', 'png']),
            'arsip' => in_array($ext, ['zip', 'rar']),
        ];
    }

    $namaFilePdf = 'Permohonan-Penggunaan-Sarana_' . $noReg . '_' . Str::slug($row->nama);

    $seksi = [
        [
            'judul' => 'Data Pemohon', 'ikon' => 'fa-user',
            'baris' => [
                ['Nama Lengkap', $row->nama],
                ['NIK', $row->nik],
                ['No. HP / WhatsApp', $row->no_hp],
                ['Alamat', $row->alamat],
            ],
        ],
        [
            'judul' => 'Data Instansi / Fasilitas Umum / Perorangan', 'ikon' => 'fa-building-columns',
            'baris' => [
                ['Jenis Pemohon', $jenisLabel],
                ['Penanggung Jawab', $row->nama_penanggung_jawab],
                ['Nama Instansi / Fasum / Perorangan', $row->nama_instansi],
                ['Alamat', $row->alamat_instansi],
            ],
        ],
        [
            'judul' => 'Sarana yang Dimohonkan', 'ikon' => 'fa-truck-droplet',
            'baris' => [
                ['Sarana', $row->sarana],
                ['Kegunaan Sarana', $row->kegunaan],
            ],
        ],
        [
            'judul' => 'Data Kegiatan', 'ikon' => 'fa-location-dot',
            'baris' => [
                ['Nama Kegiatan', $row->nama_kegiatan],
                ['Lokasi Kegiatan', $row->lokasi_kegiatan],
                ['Tanggal Pelaksanaan', $tglKegiatan],
                ['Waktu Pelaksanaan', $waktu],
            ],
        ],
    ];
@endphp

{{-- =====================================================================
     TAMPILAN LAYAR (SCREEN)
     ===================================================================== --}}
<div class="screen-only">

    <div class="page-header">
        <div class="page-header-text">
            <h1>Detail Penggunaan Sarana</h1>
            <p>Rincian lengkap permohonan penggunaan sarana pemadam kebakaran.</p>
        </div>
        <div class="header-actions no-print">
            <a href="{{ route('internal.penggunaan-sarana.index') }}" class="btn-custom-light"><i class="fas fa-arrow-left"></i> Kembali</a>
            @hasanyrole('Damtan|Super User')
            <a href="{{ route('internal.penggunaan-sarana.edit', $row->id) }}" class="btn-custom-light"><i class="fas fa-edit"></i> Edit Data</a>
            @endhasanyrole
            <button type="button" class="btn-print" onclick="cetakPdf()"><i class="fas fa-file-pdf"></i> Cetak PDF</button>
        </div>
    </div>

    <!-- Ringkasan -->
    <section class="dt-hero st-{{ $row->status }}">
        <div class="dt-hero-main">
            <div class="dt-eyebrow">No. Registrasi {{ $noReg }}</div>
            <h2>{{ $row->nama_kegiatan }}</h2>
            <p class="dt-hero-sub">Diajukan oleh <strong>{{ $row->nama }}</strong> &middot; {{ $diajukan }}</p>
        </div>
        <div class="dt-hero-side">
            <span class="badge-status {{ $badge }}">{{ $row->status }}</span>
            @if($keteranganStatus)
                <span class="dt-hero-note">{{ $keteranganStatus }}</span>
            @endif
        </div>
    </section>

    <div class="dt-stats">
        <div class="dt-stat">
            <span class="dt-stat-ico"><i class="fas fa-truck-droplet"></i></span>
            <div><small>Sarana</small><strong>{{ $row->sarana }}</strong></div>
        </div>
        <div class="dt-stat">
            <span class="dt-stat-ico"><i class="fas fa-calendar-day"></i></span>
            <div><small>Tanggal Kegiatan</small><strong>{{ $tglSingkat }}</strong></div>
        </div>
        <div class="dt-stat">
            <span class="dt-stat-ico"><i class="fas fa-clock"></i></span>
            <div><small>Waktu</small><strong>{{ $waktu }}</strong></div>
        </div>
        <div class="dt-stat">
            <span class="dt-stat-ico"><i class="fas fa-user-tag"></i></span>
            <div><small>Jenis Pemohon</small><strong>{{ $jenisLabel }}</strong></div>
        </div>
    </div>

    <!-- Rincian -->
    <div class="dt-grid">
        <div class="dt-col">
            @foreach([$seksi[0], $seksi[1]] as $s)
                <section class="dt-card">
                    <div class="dt-card-head"><i class="fas {{ $s['ikon'] }}"></i><h3>{{ $s['judul'] }}</h3></div>
                    <div class="dt-card-body">
                        <dl class="dt-dl">
                            @foreach($s['baris'] as $item)
                                <div class="dt-row"><dt>{{ $item[0] }}</dt><dd>{!! nl2br(e($item[1])) !!}</dd></div>
                            @endforeach
                        </dl>
                    </div>
                </section>
            @endforeach
        </div>

        <div class="dt-col">
            @foreach([$seksi[2], $seksi[3]] as $s)
                <section class="dt-card">
                    <div class="dt-card-head"><i class="fas {{ $s['ikon'] }}"></i><h3>{{ $s['judul'] }}</h3></div>
                    <div class="dt-card-body">
                        <dl class="dt-dl">
                            @foreach($s['baris'] as $item)
                                <div class="dt-row"><dt>{{ $item[0] }}</dt><dd>{!! nl2br(e($item[1])) !!}</dd></div>
                            @endforeach
                        </dl>
                    </div>
                </section>
            @endforeach
        </div>
    </div>

    <!-- Lampiran: surat permohonan, fotokopi KTP, sket denah lokasi -->
    <section class="dt-card" style="margin-top: 20px;">
        <div class="dt-card-head"><i class="fas fa-paperclip"></i><h3>Lampiran Persyaratan Administrasi</h3></div>
        <div class="dt-attach">
            @foreach($lampiran as $l)
                <div class="dt-attach-item">
                    <div class="dt-attach-label"><i class="fas {{ $l['ikon'] }}"></i> {{ $l['label'] }}</div>

                    @if(!$l['ada'])
                        <div class="dt-missing">Berkas belum diunggah.</div>
                    @elseif($l['image'])
                        <a href="{{ $l['url'] }}" target="_blank" rel="noopener" class="dt-photo" title="Klik untuk memperbesar">
                            <img src="{{ $l['url'] }}" alt="{{ $l['label'] }}">
                        </a>
                    @else
                        <div class="dt-file">
                            <span class="dt-file-ico {{ $l['arsip'] ? 'is-zip' : '' }}"><i class="fas {{ $l['arsip'] ? 'fa-file-zipper' : 'fa-file-pdf' }}"></i></span>
                            <div class="dt-file-info">
                                <strong>{{ $l['nama'] }}</strong>
                                <span>Berkas {{ strtoupper($l['ext']) }}</span>
                            </div>
                            <a href="{{ $l['url'] }}" target="_blank" rel="noopener" class="dt-file-btn" {{ $l['arsip'] ? 'download' : '' }}>
                                <i class="fas {{ $l['arsip'] ? 'fa-download' : 'fa-up-right-from-square' }}"></i> {{ $l['arsip'] ? 'Unduh' : 'Buka' }}
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>
</div>

{{-- =====================================================================
     TAMPILAN CETAK / PDF (Di-render khusus oleh html2pdf)
     ===================================================================== --}}
<div class="print-only" id="pdfPrintArea" style="background: #ffffff; color: #000; padding: 20px; font-family: 'Times New Roman', Times, serif; font-size: 11pt; line-height: 1.4;">

    <!-- Kop surat -->
    <div style="display: flex; align-items: center; gap: 14px; padding-bottom: 8px;">
        <img src="{{ asset('images/jambi.png') }}" alt="Logo Pemkot Jambi" style="height: 75px; width: auto;">
        <div style="flex: 1; text-align: center; line-height: 1.3;">
            <div style="font-size: 12pt; text-transform: uppercase;">Pemerintah Kota Jambi</div>
            <div style="font-size: 14.5pt; font-weight: 700; text-transform: uppercase; letter-spacing: .01em;">Dinas Pemadam Kebakaran dan Penyelamatan</div>
            <div style="font-size: 9pt;">Jl. Hos. Cokroaminoto No. 113 Telp. (0741) 41171 &middot; Jambi</div>
        </div>
        <img src="{{ asset('images/logo.png') }}" alt="Logo Damkar" style="height: 75px; width: auto;">
    </div>
    <div style="border-top: 3px solid #000; border-bottom: 1px solid #000; height: 3px; margin: 8px 0 16px 0;"></div>

    <!-- Judul -->
    <div style="text-align: center; margin-bottom: 15px;">
        <h2 style="font-size: 13pt; font-weight: 700; text-transform: uppercase; text-decoration: underline; margin: 0 0 4px 0;">Detail Permohonan Penggunaan Sarana Pemadam</h2>
        <p style="font-size: 10pt; margin: 0;">Nomor Registrasi: {{ $noReg }}</p>
    </div>

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 12px;">
        <tr><td style="width: 35mm; padding: 2px 0;">Tanggal Pengajuan</td><td style="width: 4mm;">:</td><td style="padding: 2px 0;">{{ $diajukanTgl }}</td></tr>
        <tr><td style="width: 35mm; padding: 2px 0;">Status Permohonan</td><td style="width: 4mm;">:</td><td style="padding: 2px 0;"><strong>{{ strtoupper($row->status) }}</strong>@if($keteranganStatus) &mdash; {{ $keteranganStatus }}@endif</td></tr>
    </table>

    <!-- Bagian A - D -->
    @foreach($seksi as $i => $s)
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">
            <thead>
                <tr><th colspan="3" style="background: #e6e6e6; border: 1px solid #000; padding: 5px 8px; font-size: 10.5pt; text-align: left;">{{ chr(65 + $i) }}. {{ $s['judul'] }}</th></tr>
            </thead>
            <tbody>
                @foreach($s['baris'] as $item)
                    <tr>
                        <td style="border: 1px solid #000; padding: 4px 8px; width: 50mm; vertical-align: top;">{{ $item[0] }}</td>
                        <td style="border: 1px solid #000; padding: 4px 8px; width: 4mm; text-align: center; vertical-align: top;">:</td>
                        <td style="border: 1px solid #000; padding: 4px 8px; vertical-align: top;">{!! nl2br(e($item[1])) !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    <!-- Bagian E - Lampiran -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px; page-break-inside: avoid;">
        <thead>
            <tr><th colspan="3" style="background: #e6e6e6; border: 1px solid #000; padding: 5px 8px; font-size: 10.5pt; text-align: left;">E. Lampiran Persyaratan Administrasi</th></tr>
        </thead>
        <tbody>
            @foreach($lampiran as $l)
                <tr>
                    <td style="border: 1px solid #000; padding: 4px 8px; width: 50mm; vertical-align: top;">{{ $l['label'] }}</td>
                    <td style="border: 1px solid #000; padding: 4px 8px; width: 4mm; text-align: center; vertical-align: top;">:</td>
                    <td style="border: 1px solid #000; padding: 4px 8px; vertical-align: top;">
                        @if($l['ada'])
                            {{ $l['nama'] }} (berkas {{ strtoupper($l['ext']) }}) &mdash; terlampir pada sistem
                        @else
                            Belum diunggah
                        @endif
                    </td>
                </tr>
            @endforeach

            {{-- Lampiran berupa gambar ikut dicetak sebagai gambar; PDF/ZIP hanya disebut namanya --}}
            @foreach($lampiran as $n => $l)
                @if($l['ada'] && $l['image'])
                    <tr>
                        <td colspan="3" style="border: 1px solid #000; padding: 10px; text-align: center;">
                            <figure style="margin: 0;">
                                <img src="{{ $l['url'] }}" alt="{{ $l['label'] }}" style="max-width: 100%; max-height: 70mm; border: 1px solid #000; display: block; margin: 0 auto;">
                                <figcaption style="font-size: 8.5pt; font-style: italic; margin-top: 4px;">Gambar {{ $n + 1 }}. {{ $l['label'] }}</figcaption>
                            </figure>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <!-- Tanda tangan -->
    <div style="display: flex; justify-content: space-between; margin-top: 20px; font-size: 10pt; page-break-inside: avoid;">
        <div style="width: 70mm; text-align: center;">
            <div>&nbsp;</div>
            <div>Pemohon,</div>
            <div style="height: 18mm;"></div>
            <div style="font-weight: 700; text-decoration: underline;">{{ $row->nama }}</div>
        </div>
        <div style="width: 70mm; text-align: center;">
            <div>Jambi, {{ $tglCetak }}</div>
            <div>Petugas Dinas Pemadam Kebakaran<br>dan Penyelamatan,</div>
            <div style="height: 14mm;"></div>
            <div style="font-weight: 700; text-decoration: underline;">{{ $petugas }}</div>
        </div>
    </div>

    <!-- Footer -->
    <div style="margin-top: 30px; display: flex; justify-content: space-between; font-size: 8pt; border-top: 1px solid #000; padding-top: 4px;">
        <span>Dicetak dari SIMERAH KOJA oleh {{ $petugas }}</span>
        <span>{{ $noReg }} &middot; {{ $jamCetak }} WIB</span>
    </div>
</div>

@endsection

@push('scripts')
<!-- Pustaka html2pdf.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
    (function () {
        'use strict';
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

    var namaFilePdf = @json($namaFilePdf) + '.pdf';

    function cetakPdf() {
        var element = document.getElementById('pdfPrintArea');

        // Tampilkan elemen cetak secara sementara agar html2pdf dapat membacanya
        element.style.display = 'block';

        var opt = {
            margin:       [10, 10, 10, 10],
            filename:     namaFilePdf,
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2, useCORS: true, letterRendering: true, scrollY: 0 },
            jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        // Eksekusi plugin html2pdf untuk mendownload file langsung
        html2pdf().from(element).set(opt).save().then(function () {
            // Sembunyikan kembali setelah selesai di-generate
            element.style.display = 'none';
        });
    }
</script>
@endpush
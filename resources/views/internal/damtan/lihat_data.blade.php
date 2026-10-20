@extends('layouts.dashboard')

@section('title', 'Rincian Data Penyelamatan')

@push('styles')
<style>
    :root {
                --ink: #0d1b2a;
                --ink-2: #132a43;
                --ink-3: #1d3856;
                --navy: #163a63;
                --navy-dark: #0d2947;
                --navy-light: #eaf1f8;
                --navy-soft: rgba(22, 58, 99, .08);
                --paper: #f5f7fa;
                --white: #ffffff;
                --signal: #dc3545;
                --amber: #f4b740;
                --success: #198754;
                --info: #2563eb;
                --steel: #64748b;
                --steel-soft: #94a3b8;
                --line: #e2e8f0;
                --line-dark: #cbd5e1;
    
                --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
                --font-body: 'Instrument Sans', system-ui, sans-serif;
    
                --r-lg: 18px;
                --r-md: 14px;
                --r-sm: 10px;
    
                --sidebar-w: 272px;
                --topbar-h: 70px;
                --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
                --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
                --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);
            }
    .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
    .brand span { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: 1.08rem; letter-spacing: -.01em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: #fff; }
    .topbar-right { display: flex; align-items: center; gap: 14px; }
    .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #fff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    .back-link { display: inline-flex; align-items: center; gap: 8px; font-size: .88rem; font-weight: 700; color: var(--steel); margin-bottom: 16px; padding: 8px 16px; border-radius: 8px; background: #fff; border: 1px solid var(--line-dark); transition: all .2s; }
    .back-link:hover { color: var(--navy); background: #f8fafc; }
    .page-head { margin-bottom: 26px; }
    .card-custom { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); padding: clamp(24px, 4vw, 40px); margin-bottom: 30px; }
    .btn-custom-light { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; background: var(--white); color: var(--ink); border: 1px solid var(--line-dark); border-radius: 8px; font-size: .92rem; font-weight: 600; transition: all .2s ease; cursor: pointer; text-decoration: none;}
    .btn-custom-light:hover { background: #f8fafc; border-color: var(--steel-soft); }
    .btn-custom-edit { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; background: rgba(255, 182, 39, 0.15); color: #d97706; border: none; border-radius: 8px; font-size: .92rem; font-weight: 700; transition: all .2s ease; text-decoration: none; }
    .btn-custom-edit:hover { background: rgba(255, 182, 39, 0.3); color: #d97706; }
    .tabel-kop { width: 100%; border-collapse: collapse; margin-bottom: 5px; }
    .tabel-kop td { vertical-align: middle; }
    .tabel-kop img { width: 80px; height: auto; }
    .kop-text { text-align: center; }
    .kop-text h2 { margin: 0; font-size: 14pt; font-weight: normal; font-family: 'Times New Roman', Times, serif; color: #000; }
    .kop-text h1 { margin: 0; font-size: 16pt; font-weight: bold; line-height: 1.1; font-family: 'Times New Roman', Times, serif; color: #000; }
    .kop-text p { margin: 2px 0 0 0; font-size: 10pt; font-family: 'Times New Roman', Times, serif; color: #000; }
    .garis-kop { border-top: 3px solid black; border-bottom: 1px solid black; height: 2px; margin-top: 5px; margin-bottom: 20px; }
    .judul-laporan { text-align: center; margin-bottom: 25px; line-height: 1.2; font-family: 'Times New Roman', Times, serif; color: #000; }
    .judul-laporan h3 { margin: 0; font-size: 14pt; font-weight: bold; text-decoration: underline; }
    .section-header { clear: both; display: flex; align-items: center; margin: 30px 0 14px; padding: 9px 16px; background: var(--navy-light); border-left: 5px solid var(--navy); border-radius: 0 6px 6px 0; page-break-after: avoid; break-after: avoid; page-break-inside: avoid; }
    .section-header h3 { font-family: var(--font-display); font-size: .98rem; font-weight: 700; margin: 0; color: var(--navy-dark); text-transform: uppercase; letter-spacing: .03em; }
    .sub-header { clear: both; display: block; width: 100%; font-family: var(--font-display); font-size: .9rem; font-weight: 700; color: var(--navy); text-transform: uppercase; letter-spacing: .03em; margin: 20px 0 6px; padding-bottom: 6px; border-bottom: 2px solid var(--navy); page-break-after: avoid; break-after: avoid; page-break-inside: avoid; }

    /* Grid 2 kolom: baris selalu sejajar kiri-kanan, item panjang melebar penuh */
    .pdf-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); column-gap: 40px; width: 100%; margin-bottom: 6px; }
    .pdf-item { min-width: 0; }
    .pdf-item-full { grid-column: 1 / -1; min-width: 0; }
    .data-row { display: flex; align-items: flex-start; width: 100%; padding: 7px 0; border-bottom: 1px dotted var(--line-dark); page-break-inside: avoid; break-inside: avoid; }
    .data-icon { display: none; }
    .data-label { width: 165px; flex-shrink: 0; font-weight: 500; color: var(--steel); font-size: .85rem; line-height: 1.5; }
    .data-colon { width: 16px; flex-shrink: 0; text-align: center; font-weight: 500; color: var(--steel); font-size: .85rem; line-height: 1.5; }
    .data-value { flex: 1 1 auto; min-width: 0; font-weight: 600; color: var(--ink); font-size: .88rem; line-height: 1.5; word-break: break-word; }
    .teks-panjang { white-space: pre-line; text-align: justify; font-weight: 500; }
    .text-capitalize { text-transform: capitalize; }
    .text-uppercase { text-transform: uppercase; }

    .badge-prio { display: inline-block; padding: 2px 12px; border-radius: 999px; font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; border: 1px solid transparent; }
    .badge-prio.prio-rendah  { background: #eef1f5; color: var(--steel); border-color: var(--line-dark); }
    .badge-prio.prio-sedang  { background: #e8effd; color: var(--info); border-color: #c3d4fa; }
    .badge-prio.prio-tinggi  { background: #fdf3dc; color: #a16207; border-color: #f4d38a; }
    .badge-prio.prio-darurat { background: #fbe5e8; color: var(--signal); border-color: #f1b3bb; }

    .dasar-hukum { margin-top: 6px; padding: 12px 16px; border: 1px solid var(--line-dark); border-left: 4px solid var(--navy); background: #f8fafc; border-radius: 4px; font-size: .85rem; line-height: 1.6; color: var(--ink-2); text-align: justify; font-style: italic; page-break-inside: avoid; }

    /* Blok tanda tangan: hanya muncul di PDF / cetak */
    .ttd-wrap { display: none; justify-content: space-between; gap: 40px; margin-top: 36px; page-break-inside: avoid; break-inside: avoid; }
    .ttd-col { width: 46%; text-align: center; font-size: .88rem; line-height: 1.5; color: #000; }
    .ttd-col p { margin: 0; }
    .ttd-space { height: 80px; }
    .ttd-nama { font-weight: 700; text-decoration: underline; }
    .ttd-nip { font-size: .8rem; margin-top: 2px !important; }

    /* Lampiran foto: 2 foto per baris, satu baris tidak terpotong antar halaman */
    .foto-wrap { margin-bottom: 18px; }
    .foto-row { display: flex; gap: 12px; margin-bottom: 12px; page-break-inside: avoid; break-inside: avoid; }
    .foto-item { flex: 1 1 0; min-width: 0; max-width: calc(50% - 6px); border: 1px solid var(--line-dark); border-radius: 4px; padding: 4px; background: #fff; }
    .foto-item img { display: block; width: 100%; height: 220px; object-fit: cover; border-radius: 2px; }
    .foto-cap { text-align: center; font-size: .75rem; color: var(--steel); padding-top: 4px; line-height: 1.2; }

    /* Mode PDF: kartu tanpa bingkai, kop surat tampil, huruf resmi (serif) */
    .card-custom.pdf-mode { box-shadow: none !important; border: none !important; padding: 0 !important; margin: 0 !important; border-radius: 0 !important; font-family: 'Times New Roman', Times, serif; }
    .card-custom.pdf-mode .section-header h3,
    .card-custom.pdf-mode .sub-header,
    .card-custom.pdf-mode .data-label,
    .card-custom.pdf-mode .data-colon,
    .card-custom.pdf-mode .data-value { font-family: 'Times New Roman', Times, serif; }
    .card-custom.pdf-mode .data-label, .card-custom.pdf-mode .data-colon { color: #222; font-weight: 400; }
    .card-custom.pdf-mode .data-value { color: #000; font-size: .9rem; }
    .card-custom.pdf-mode .data-row { border-bottom: 1px solid #ccc; }
    .card-custom.pdf-mode .ttd-wrap { display: flex; }
    /* Penyesuaian lebar A4 (konten dikunci 190 mm saat membuat PDF) */
    .card-custom.pdf-mode .pdf-grid { column-gap: 28px; }
    .card-custom.pdf-mode .data-label { width: 128px; }
    .card-custom.pdf-mode .data-colon { width: 12px; }
    .card-custom.pdf-mode .data-row { padding: 5px 0; }
    .card-custom.pdf-mode .section-header { margin: 22px 0 10px; padding: 7px 14px; }
    .card-custom.pdf-mode .sub-header { margin: 14px 0 4px; }
    .card-custom.pdf-mode .foto-cap { color: #333; font-family: 'Times New Roman', Times, serif; }
    .card-custom.pdf-mode .ttd-wrap { margin-top: 28px; }
    .card-custom.pdf-mode .ttd-space { height: 70px; }

    @media (max-width: 767.98px) {
        .pdf-grid { grid-template-columns: 1fr; }
        .data-label { width: 125px; }
    }

    @page { size: A4 portrait; margin: 12mm 10mm 14mm; }

    @media print {
        .topbar, .sidebar, .sidebar-backdrop, #action-buttons-container, .back-link, .d-print-none, .page-head { display: none !important; }
        #pdf-header { display: block !important; }
        .ttd-wrap { display: flex !important; }
        body, .content { background-color: white !important; padding: 0 !important; margin: 0 !important;}
        .card-custom { box-shadow: none !important; border: none !important; padding: 0 !important; margin: 0 !important; font-family: 'Times New Roman', Times, serif; }
        .pdf-grid { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
        * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
    }
</style>
@endpush

@section('content')

@php
    /* ==========================================================
       PENYESUAIAN DENGAN FORM INPUT (nama field = atribut name di form)
       ========================================================== */

    // Rincian objek kebakaran (unit_rumah, unit_gudang, unit_ruko, dst.)
    $objek_kb   = $laporan->objek_kebakaran ?? null;
    $unit_objek = $objek_kb ? ($laporan->{'unit_' . $objek_kb} ?? null) : null;

    $rincian_objek = [];
    if (!empty($laporan->tipe_bangunan_rumah))     $rincian_objek[] = 'Bangunan ' . ucwords(str_replace('_', ' ', $laporan->tipe_bangunan_rumah));
    if (!empty($unit_objek))                       $rincian_objek[] = $unit_objek . ' Unit';
    if (!empty($laporan->nama_pasar_tempat_usaha)) $rincian_objek[] = $laporan->nama_pasar_tempat_usaha;
    if (!empty($laporan->jenis_kendaraan))         $rincian_objek[] = strtoupper($laporan->jenis_kendaraan);
    if (!empty($laporan->jenis_objek_vital))       $rincian_objek[] = ucwords(str_replace('_', ' ', $laporan->jenis_objek_vital));

    // Field baru dari form yang mungkin belum masuk flag controller
    $x_dasar  = !empty($teknis->satgas_operasi) || !empty($teknis->tim_quick_respon)
                || (!empty($teknis->lama_operasi) && $teknis->lama_operasi > 0);
    $x_korban = !empty($teknis->jiwa_terdampak) && $teknis->jiwa_terdampak > 0;
    $x_logis  = (!empty($teknis->jumlah_air) && $teknis->jumlah_air > 0)
                || (!empty($teknis->jumlah_armada) && $teknis->jumlah_armada > 0);

    $has_teknis_dasar = ($has_teknis_dasar ?? false) || $x_dasar;
    $has_korban       = ($has_korban ?? false) || $x_korban;
    $has_logistik     = ($has_logistik ?? false) || $x_logis;
    $show_section_ii  = ($show_section_ii ?? false) || $x_dasar || $x_korban || $x_logis;

    // Label instansi sesuai form (value "pmi" tampil sebagai BPBD)
    $map_instansi = ['pmi' => 'BPBD'];
@endphp

            <a href="/internal/damtan/data-laporan" class="back-link d-print-none"><i class="fas fa-arrow-left me-2"></i> Kembali ke Data Laporan</a>
            <div class="page-head d-print-none mt-2">
                <h1 class="page-title">Rincian Laporan Tervalidasi</h1>
            </div>

            <div class="card-custom" id="report-content">
                
                <!-- KOP SURAT PDF -->
                <div id="pdf-header" style="display: none;">
                    <table class="tabel-kop">
                        <tr>
                            <td style="width: 15%; text-align: left;">
                                <img src="{{ asset('images/jambi.png') }}" alt="Logo Jambi">
                            </td>
                            <td style="width: 70%;" class="kop-text">
                                <h2>PEMERINTAH KOTA JAMBI</h2>
                                <h1>DINAS PEMADAM KEBAKARAN<br>DAN PENYELAMATAN</h1>
                                <p>Jl. Hos. Cokroaminoto No. 113 Telp. 0741-41171<br>JAMBI</p>
                            </td>
                            <td style="width: 15%; text-align: right;">
                                <img src="{{ asset('images/logo.png') }}" alt="Logo Damkar">
                            </td>
                        </tr>
                    </table>
                    
                    <div class="garis-kop"></div>

                    <div class="judul-laporan">
                        <h3>LAPORAN DATA PENYELAMATAN & KEBAKARAN</h3>
                    </div>
                </div>

                <!-- TAB 1: INFORMASI DASAR -->
                <div class="section-header" style="margin-top: 0;"><h3>I. Informasi Dasar & Lokasi</h3></div>
                
                <div class="pdf-grid">
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-hashtag"></i></div>
                            <div class="data-label">Nomor Laporan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->nomor_laporan }}</div>
                        </div>
                    </div>

                    @if(!empty($laporan->kategori_kejadian))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-layer-group"></i></div>
                            <div class="data-label">Kategori Umum</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->kategori_kejadian) }}</div>
                        </div>
                    </div>
                    @endif

                    {{-- Objek kebakaran (form: objek_kebakaran) --}}
                    @if(!empty($laporan->objek_kebakaran))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-fire"></i></div>
                            <div class="data-label">Objek Kebakaran</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->objek_kebakaran) }}</div>
                        </div>
                    </div>

                    @if(!empty($rincian_objek))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-building"></i></div>
                            <div class="data-label">Rincian Objek</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ implode(', ', $rincian_objek) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->keterangan_objek_kebakaran))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-align-left"></i></div>
                            <div class="data-label">Keterangan Objek</div>
                            <div class="data-colon">:</div>
                            <div class="data-value teks-panjang">{{ $laporan->keterangan_objek_kebakaran }}</div>
                        </div>
                    </div>
                    @endif
                    @endif

                    {{-- Non-kebakaran (form: kategori_non_kebakaran) --}}
                    @if(!empty($laporan->kategori_non_kebakaran))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-life-ring"></i></div>
                            <div class="data-label">Jenis Evakuasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->kategori_non_kebakaran) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->rincian_kategori_non_kebakaran))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="data-label">Rincian Kategori</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->rincian_kategori_non_kebakaran }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->prioritas))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-exclamation-circle"></i></div>
                            <div class="data-label">Tingkat Prioritas</div>
                            <div class="data-colon">:</div>
                            <div class="data-value"><span class="badge-prio prio-{{ strtolower($laporan->prioritas) }}">{{ $laporan->prioritas }}</span></div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->nama_pelapor))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user"></i></div>
                            <div class="data-label">Nama Pelapor</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->nama_pelapor }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->telepon_pelapor))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-phone"></i></div>
                            <div class="data-label">Telepon Pelapor</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->telepon_pelapor }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->media_pelaporan))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-headset"></i></div>
                            <div class="data-label">Media Pelaporan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->media_pelaporan) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->alamat))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-map-signs"></i></div>
                            <div class="data-label">Alamat Kejadian</div>
                            <div class="data-colon">:</div>
                            <div class="data-value teks-panjang">{{ $laporan->alamat }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->koordinat))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-location-arrow"></i></div>
                            <div class="data-label">Titik Koordinat</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->koordinat }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->jarak_tempuh) && $laporan->jarak_tempuh > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-route"></i></div>
                            <div class="data-label">Jarak Tempuh</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->jarak_tempuh }} Km</div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="sub-header">Data Waktu Operasional</div>
                <div class="pdf-grid">
                    @if(!empty($laporan->tanggal_kejadian))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-calendar-day"></i></div>
                            <div class="data-label">Hari, Tanggal</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ !empty($laporan->hari_kejadian) ? $laporan->hari_kejadian . ', ' : '' }}{{ \Carbon\Carbon::parse($laporan->tanggal_kejadian)->format('d M Y') }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_kejadian))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-calendar-alt"></i></div>
                            <div class="data-label">Waktu Kejadian</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ \Carbon\Carbon::parse($laporan->waktu_kejadian)->format('d M Y, H:i') }} WIB</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_terima))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-clock"></i></div>
                            <div class="data-label">Terima Laporan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ \Carbon\Carbon::parse($laporan->waktu_terima)->format('d M Y, H:i') }} WIB</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_berangkat))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-truck-moving"></i></div>
                            <div class="data-label">Berangkat Unit</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ \Carbon\Carbon::parse($laporan->waktu_berangkat)->format('d M Y, H:i') }} WIB</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_tiba))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="data-label">Tiba di Lokasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ \Carbon\Carbon::parse($laporan->waktu_tiba)->format('d M Y, H:i') }} WIB</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_selesai))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-flag-checkered"></i></div>
                            <div class="data-label">Operasi Selesai</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ \Carbon\Carbon::parse($laporan->waktu_selesai)->format('d M Y, H:i') }} WIB</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_kembali))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-building"></i></div>
                            <div class="data-label">Kembali ke Mako</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ \Carbon\Carbon::parse($laporan->waktu_kembali)->format('d M Y, H:i') }} WIB</div>
                        </div>
                    </div>
                    @endif

                    @if(isset($laporan->respon_time) && $laporan->respon_time !== '')
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-stopwatch"></i></div>
                            <div class="data-label">Respon Time</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->respon_time }} Menit</div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- TAB 2: TEKNIS & LOGISTIK -->
                @if($show_section_ii)
                <div class="section-header"><h3>II. Teknis Penyelamatan & Logistik Operasi</h3></div>

                @if($has_teknis_dasar)
                <div class="pdf-grid">
                    @if(!empty($teknis->pimpinan_operasi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-shield"></i></div>
                            <div class="data-label">Pimpinan Operasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->pimpinan_operasi }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->pendamping_operasi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-friends"></i></div>
                            <div class="data-label">Pendamping Operasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->pendamping_operasi }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->satgas_operasi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-users-cog"></i></div>
                            <div class="data-label">Satgas Operasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->satgas_operasi }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->tim_quick_respon))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-stopwatch"></i></div>
                            <div class="data-label">Tim Quick Respon</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->tim_quick_respon }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->lama_operasi) && $teknis->lama_operasi > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-hourglass-half"></i></div>
                            <div class="data-label">Lama Operasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->lama_operasi }} Menit</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->status_evakuasi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="data-label">Status Evakuasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', $teknis->status_evakuasi) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($arr_evakuasi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-route"></i></div>
                            <div class="data-label">Metode Evakuasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', implode(', ', $arr_evakuasi)) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($arr_penyelamatan))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-hands-helping"></i></div>
                            <div class="data-label">Met. Penyelamatan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', implode(', ', $arr_penyelamatan)) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->objek_terdampak))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-house-damage"></i></div>
                            <div class="data-label">Objek Terdampak</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->objek_terdampak }}</div>
                        </div>
                    </div>
                    @endif
                    
                    @if(!empty($teknis->jumlah_personel) && $teknis->jumlah_personel > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-users"></i></div>
                            <div class="data-label">Jumlah Anggota</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->jumlah_personel }} Personel</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->daftar_personel))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-tag"></i></div>
                            <div class="data-label">Anggota Terlibat</div>
                            <div class="data-colon">:</div>
                            <div class="data-value teks-panjang">{{ $teknis->daftar_personel }}</div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                @if($has_detail_lapangan)
                <div class="pdf-grid">
                    @if(!empty($teknis->langkah_penanganan))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-tasks"></i></div>
                            <div class="data-label">Langkah Penanganan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value teks-panjang">{{ $teknis->langkah_penanganan }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->hambatan_lapangan))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-exclamation-triangle"></i></div>
                            <div class="data-label">Hambatan Lapangan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value teks-panjang">{{ $teknis->hambatan_lapangan }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->hasil_tindakan))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-check-double"></i></div>
                            <div class="data-label">Hasil Tindakan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value teks-panjang">{{ $teknis->hasil_tindakan }}</div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                @if($has_korban)
                <div class="sub-header">Data Korban & Aset</div>
                <div class="pdf-grid">
                    @if(!empty($teknis->korban_selamat) && $teknis->korban_selamat > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-check"></i></div>
                            <div class="data-label">Korban Selamat</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->korban_selamat }} Jiwa</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->korban_ringan) && $teknis->korban_ringan > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-injured"></i></div>
                            <div class="data-label">Korban Luka Ringan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->korban_ringan }} Jiwa</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->korban_berat) && $teknis->korban_berat > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-procedures"></i></div>
                            <div class="data-label">Korban Luka Berat</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->korban_berat }} Jiwa</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->korban_meninggal) && $teknis->korban_meninggal > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-times"></i></div>
                            <div class="data-label">Korban Meninggal</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-danger">{{ $teknis->korban_meninggal }} Jiwa</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->jiwa_terdampak) && $teknis->jiwa_terdampak > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-users"></i></div>
                            <div class="data-label">Jiwa Terdampak</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->jiwa_terdampak }} Jiwa</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->korban_hewan_aset))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-cat"></i></div>
                            <div class="data-label">Korban Hewan/Aset</div>
                            <div class="data-colon">:</div>
                            <div class="data-value teks-panjang">{{ $teknis->korban_hewan_aset }}</div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                @if($has_logistik)
                <div class="sub-header">Alat & Logistik Terpakai</div>
                <div class="pdf-grid">
                    @if(!empty($arr_armada))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-truck"></i></div>
                            <div class="data-label">Armada Diturunkan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', implode(', ', $arr_armada)) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->jumlah_armada) && $teknis->jumlah_armada > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-truck-moving"></i></div>
                            <div class="data-label">Jumlah Armada</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->jumlah_armada }} Unit</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($arr_peralatan))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-toolbox"></i></div>
                            <div class="data-label">Peralatan Khusus</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ implode(', ', $arr_peralatan) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->peralatan_lain))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-tools"></i></div>
                            <div class="data-label">Peralatan Lainnya</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->peralatan_lain }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->jumlah_air) && $teknis->jumlah_air > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-tint"></i></div>
                            <div class="data-label">Konsumsi Air</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->jumlah_air }} Liter</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->liter_foam) && $teknis->liter_foam > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-soap"></i></div>
                            <div class="data-label">Konsumsi Foam</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->liter_foam }} Liter</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->liter_bbm) && $teknis->liter_bbm > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-gas-pump"></i></div>
                            <div class="data-label">Konsumsi BBM</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->liter_bbm }} Liter</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->konsumsi_alat))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-spray-can"></i></div>
                            <div class="data-label">Konsumsi Alat Umum</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->konsumsi_alat }}</div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif
                @endif <!-- End Section II -->

                <!-- TAB 3: DOKUMENTASI & EVALUASI -->
                @if($show_section_iii)
                <div class="section-header" style="margin-top: 20px;"><h3>III. Analisis, Evaluasi & Dokumentasi Kejadian</h3></div>

                @if($has_investigasi)
                <div class="sub-header">Investigasi Lapangan</div>
                <div class="pdf-grid">
                    @if(!empty($dokumentasi->dugaan_penyebab))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-bolt"></i></div>
                            <div class="data-label">Dugaan Penyebab</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', $dokumentasi->dugaan_penyebab) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->dugaan_penyebab_lainnya))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-search"></i></div>
                            <div class="data-label">Penyebab Lainnya</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->dugaan_penyebab_lainnya }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->sumber_api))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-fire-alt"></i></div>
                            <div class="data-label">Sumber Api / Awal</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->sumber_api }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->luas_area) && $dokumentasi->luas_area > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-ruler-combined"></i></div>
                            <div class="data-label">Luas Area Terdampak</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->luas_area }} m²</div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                @if($has_lintas_sektoral)
                <div class="sub-header">Kerjasama Lintas Sektoral</div>
                <div class="pdf-grid">
                    @if(!empty($arr_instansi))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-building"></i></div>
                            <div class="data-label">Instansi Pendukung</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-uppercase">{{ strtoupper(str_replace('_', ' ', implode(', ', array_map(fn($i) => $map_instansi[$i] ?? $i, $arr_instansi)))) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->tindakan_instansi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-hands-helping"></i></div>
                            <div class="data-label">Tindakan Instansi Lain</div>
                            <div class="data-colon">:</div>
                            <div class="data-value teks-panjang">{{ $dokumentasi->tindakan_instansi }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->kontak_saksi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-phone-alt"></i></div>
                            <div class="data-label">Kontak Saksi/Warga</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->kontak_saksi }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->cara_bertindak))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-clipboard-check"></i></div>
                            <div class="data-label">Cara Bertindak</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">
                                @if($dokumentasi->cara_bertindak === 'lainnya')
                                    {{ $dokumentasi->cara_bertindak_lainnya ?? 'Lainnya' }}
                                @elseif($dokumentasi->cara_bertindak === '5T')
                                    5 T (Terencana, Terukur, Terarah, Terlayani & Tuntas)
                                @else
                                    {{ $dokumentasi->cara_bertindak }}
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                @if($has_evaluasi)
                <div class="sub-header">Evaluasi Pasca Operasi</div>
                <div class="pdf-grid">
                    @if(!empty($dokumentasi->kebutuhan_tambahan))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-plus-circle"></i></div>
                            <div class="data-label">Kebutuhan Tambahan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value teks-panjang">{{ $dokumentasi->kebutuhan_tambahan }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->saran_mitigasi))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-lightbulb"></i></div>
                            <div class="data-label">Saran Mitigasi Warga</div>
                            <div class="data-colon">:</div>
                            <div class="data-value teks-panjang">{{ $dokumentasi->saran_mitigasi }}</div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                @if($has_kronologi)
                <div class="pdf-grid">
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-align-left"></i></div>
                            <div class="data-label">Kronologi Lengkap</div>
                            <div class="data-colon">:</div>
                            <div class="data-value teks-panjang">{{ $dokumentasi->kronologi_lengkap }}</div>
                        </div>
                    </div>
                </div>
                @endif
                @endif <!-- End Section III -->

                <!-- TAB 4: KATEGORI KHUSUS -->
                @if($show_section_iv)
                <div class="section-header"><h3>IV. Rincian Modul Kategori Khusus</h3></div>

                    @if($has_animal)
                    <div class="sub-header"><i class="fas fa-paw me-2"></i>Data Animal Rescue</div>
                    <div class="pdf-grid">
                        @if(!empty($khusus->jenis_hewan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-paw"></i></div>
                                <div class="data-label">Jenis Hewan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">
                                    {{ $khusus->jenis_hewan === 'lainnya' && !empty($khusus->jenis_hewan_lainnya)
                                        ? $khusus->jenis_hewan_lainnya
                                        : $khusus->jenis_hewan }}
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @if(!empty($khusus->spesies_hewan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-tag"></i></div>
                                <div class="data-label">Spesies / Lokal</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->spesies_hewan }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->dimensi_hewan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-ruler"></i></div>
                                <div class="data-label">Dimensi / Panjang</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->dimensi_hewan }}</div>
                            </div>
                        </div>
                        @endif
                        
                        @if(!empty($khusus->berat_hewan) && $khusus->berat_hewan > 0)
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-balance-scale"></i></div>
                                <div class="data-label">Berat Hewan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->berat_hewan }} Kg</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->status_hewan_pasca))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-share-square"></i></div>
                                <div class="data-label">Status Evakuasi</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->status_hewan_pasca) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->lokasi_pelepasan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div class="data-label">Lokasi Pelepasan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->lokasi_pelepasan }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if($has_pohon)
                    <div class="sub-header"><i class="fas fa-tree me-2"></i>Data Objek Tumbang/Bangunan</div>
                    <div class="pdf-grid">
                        @if(!empty($khusus->jenis_objek_tumbang))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-cube"></i></div>
                                <div class="data-label">Jenis Objek</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->jenis_objek_tumbang) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->dimensi_objek) && $khusus->dimensi_objek > 0)
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-expand-arrows-alt"></i></div>
                                <div class="data-label">Dimensi Objek</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->dimensi_objek }} cm</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->status_utilitas))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-plug"></i></div>
                                <div class="data-label">Utilitas Terkait</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->status_utilitas) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->dampak_properti))
                        <div class="pdf-item-full">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-house-damage"></i></div>
                                <div class="data-label">Dampak Properti</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->dampak_properti }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if($has_water)
                    <div class="sub-header"><i class="fas fa-water me-2"></i>Data Water Rescue</div>
                    <div class="pdf-grid">
                        @if(!empty($khusus->kondisi_perairan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-water"></i></div>
                                <div class="data-label">Kondisi Perairan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->kondisi_perairan) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->radius_pencarian) && $khusus->radius_pencarian > 0)
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-search-location"></i></div>
                                <div class="data-label">Radius Pencarian</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->radius_pencarian }} meter</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->metode_pencarian_air))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-binoculars"></i></div>
                                <div class="data-label">Metode Pencarian</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->metode_pencarian_air) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->daftar_penyelam))
                        <div class="pdf-item-full">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-swimmer"></i></div>
                                <div class="data-label">Daftar Penyelam</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->daftar_penyelam }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if($has_ring)
                    <div class="sub-header"><i class="fas fa-ring me-2"></i>Data Pelepasan Cincin & Geografis Lapangan</div>
                    <div class="pdf-grid">
                        @if(!empty($khusus->jenis_benda_bahaya))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-ring"></i></div>
                                <div class="data-label">Jenis Benda</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->jenis_benda_bahaya }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->kondisi_anggota_tubuh))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-hand-paper"></i></div>
                                <div class="data-label">Kondisi Tubuh</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->kondisi_anggota_tubuh) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->alat_potong_cincin))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-cut"></i></div>
                                <div class="data-label">Alat Potong</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->alat_potong_cincin) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->cuaca_operasi))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-cloud-sun"></i></div>
                                <div class="data-label">Cuaca Operasi</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->cuaca_operasi) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->jenis_medan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-mountain"></i></div>
                                <div class="data-label">Jenis Medan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->jenis_medan) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->akses_lokasi))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-road"></i></div>
                                <div class="data-label">Akses Lokasi</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->akses_lokasi) }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                @endif

                <!-- TAB 5: DOKUMENTASI FOTO & VIDEO -->
                @if(!empty($arr_foto) || !empty($dokumentasi->video))
                <div class="section-header"><h3>V. Dokumentasi Lapangan</h3></div>
                
                @if(!empty($arr_foto))
                    <div class="sub-header"><i class="fas fa-camera me-2"></i>Lampiran Foto</div>
                    @php $no_foto = 0; @endphp
                    <div class="foto-wrap">
                        @foreach(collect($arr_foto)->chunk(2) as $baris_foto)
                        <div class="foto-row">
                            @foreach($baris_foto as $foto)
                            <div class="foto-item">
                                <img src="{{ asset('storage/' . $foto) }}" alt="Foto Dokumentasi" onerror="this.onerror=null; this.src='https://placehold.co/600x400/e2e8f0/64748b?text=Gambar+Tidak+Ditemukan';">
                                <div class="foto-cap">Gambar {{ ++$no_foto }}</div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                @endif

                @if(!empty($dokumentasi->video))
                    <div class="sub-header"><i class="fas fa-video me-2"></i>Lampiran Video</div>
                    <div class="pdf-grid">
                        <div class="pdf-item-full">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-file-video"></i></div>
                                <div class="data-label">File Terlampir</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">
                                    <a href="{{ asset('storage/' . $dokumentasi->video) }}" target="_blank" style="color: var(--navy); text-decoration: underline; font-weight: 700;">
                                        <i class="fas fa-external-link-alt me-1"></i> Buka / Download Video
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @endif

                <!-- KESIMPULAN -->
                <div class="section-header"><h3>Kesimpulan & Dasar Pelaksanaan</h3></div>
                <div class="dasar-hukum">
                    Seluruh kegiatan Pelayanan Penyelamatan dan Pemadaman ini berpedoman pada Peraturan Menteri Dalam Negeri (Permendagri) Nomor 114 Tahun 2018 tentang Standar Teknis Pelayanan Dasar Pada Standar Pelayanan Minimal (SPM) Sub Urusan Kebakaran Daerah Kabupaten/Kota.
                </div>

                <!-- TANDA TANGAN (hanya tampil di PDF / cetak) -->
                <div class="ttd-wrap">
                    <div class="ttd-col">
                        <p>Mengetahui,<br>Kepala Bidang Pemadaman & Penyelamatan</p>
                        <div class="ttd-space"></div>
                        <p class="ttd-nama">( ................................................ )</p>
                        <p class="ttd-nip">NIP. ................................................</p>
                    </div>
                    <div class="ttd-col">
                        <p>Jambi, {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}<br>Pimpinan Operasi</p>
                        <div class="ttd-space"></div>
                        <p class="ttd-nama">( {{ !empty($teknis->pimpinan_operasi) ? $teknis->pimpinan_operasi : '................................................' }} )</p>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-5 pt-4 border-top d-print-none" id="action-buttons-container" data-html2canvas-ignore="true">
                    <!-- TOMBOL DOWNLOAD: HANYA PDF -->
                    <button type="button" class="btn-custom-light shadow-sm" onclick="downloadDetailPDF()">
                        <i class="fas fa-file-pdf text-danger"></i> Download PDF
                    </button>
                    <!-- TOMBOL EDIT: hanya Damtan & Super User -->
                    @hasanyrole('Damtan|Super User')
                    <a href="/internal/damtan/edit-data/{{ $laporan->id }}" class="btn btn-custom-edit shadow-sm">
                        <i class="fas fa-edit me-2"></i> Edit Data Ini
                    </a>
                    @endhasanyrole
                </div>
            </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    /* Download PDF (A4): konten dikunci selebar area cetak A4 (190 mm), kop surat tampil,
       judul bagian ditahan agar tidak terpisah dari isinya, nomor halaman ditambahkan. */
    function downloadDetailPDF() {
        var el = document.getElementById('report-content');
        var header = document.getElementById('pdf-header');
        var actions = document.getElementById('action-buttons-container');
        var nomor = @json($laporan->nomor_laporan);
        var wrappers = [];

        header.style.display = 'block';
        el.classList.add('pdf-mode');
        el.style.width = '718px';          /* 190 mm pada 96 dpi */
        el.style.maxWidth = 'none';
        actions.style.setProperty('display', 'none', 'important');

        /* Bungkus judul dengan ruang cadangan: bila judul jatuh di dasar halaman,
           ia dipindah ke halaman berikutnya bersama isi pertamanya. */
        el.querySelectorAll('.section-header, .sub-header').forEach(function (h) {
            var next = h.nextElementSibling;
            var need = (next && next.classList.contains('foto-wrap')) ? 270 : 60;
            var w = document.createElement('div');
            w.className = 'keep-next';
            w.style.paddingBottom = need + 'px';
            w.style.marginBottom = '-' + need + 'px';
            h.parentNode.insertBefore(w, h);
            w.appendChild(h);
            wrappers.push(w);
        });

        function pulihkan() {
            wrappers.forEach(function (w) {
                var h = w.firstElementChild;
                if (h) w.parentNode.insertBefore(h, w);
                w.parentNode.removeChild(w);
            });
            header.style.display = 'none';
            el.classList.remove('pdf-mode');
            el.style.width = '';
            el.style.maxWidth = '';
            actions.style.removeProperty('display');
        }

        var opt = {
            margin: [10, 10, 14, 10],
            filename: @json('Laporan-' . $laporan->nomor_laporan . '.pdf'),
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, useCORS: true, scrollY: 0 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
            pagebreak: { mode: ['css', 'legacy'], avoid: ['.data-row', '.keep-next', '.foto-row', '.dasar-hukum', '.ttd-wrap'] }
        };

        html2pdf().set(opt).from(el).toPdf().get('pdf').then(function (pdf) {
            var total = pdf.internal.getNumberOfPages();
            var w = pdf.internal.pageSize.getWidth();
            var h = pdf.internal.pageSize.getHeight();
            for (var i = 1; i <= total; i++) {
                pdf.setPage(i);
                pdf.setDrawColor(170);
                pdf.setLineWidth(0.2);
                pdf.line(10, h - 11, w - 10, h - 11);
                pdf.setFont('times', 'normal');
                pdf.setFontSize(8);
                pdf.setTextColor(100);
                pdf.text('Laporan No. ' + nomor, 10, h - 7);
                pdf.text('Halaman ' + i + ' dari ' + total, w - 10, h - 7, { align: 'right' });
            }
        }).save().then(pulihkan).catch(function (err) {
            pulihkan();
            console.error(err);
            alert('Gagal membuat PDF. Silakan coba lagi.');
        });
    }
</script>
@endpush
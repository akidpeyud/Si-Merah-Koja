@extends('layouts.dashboard')

@section('title')Detail {{ $jenis_layanan }}@endsection

@push('styles')
<style>
    :root {
        --ink: #0d1b2a;
        --paper: #f7f9fc;
        --navy: #1e3a5f;
        --navy-tint: rgba(30, 58, 95, .09);
        --signal: #e5392d;
        --steel: #64748b;
        --steel-soft: #94a3b8;
        --line: #e6eaf1;
        --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
        --r-lg: 20px;
        --r-sm: 10px;
        --shadow-sm: 0 2px 8px -2px rgba(13, 27, 42, .08);
    }

    .page-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 28px; flex-wrap: wrap; gap: 16px; }
    .page-header h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -0.02em; margin-bottom: 4px; color: var(--ink); }
    .page-header p { color: var(--steel); font-size: .98rem; margin: 0; }

    .detail-card { background: #fff; border-radius: var(--r-lg); border: 1px solid var(--line); padding: clamp(24px, 4vw, 36px); box-shadow: var(--shadow-sm); width: 100%; margin-bottom: 20px; }
    .detail-section-title { font-family: var(--font-display); font-size: 1.05rem; font-weight: 700; color: var(--navy); border-bottom: 2px solid var(--navy-tint); padding-bottom: 8px; margin-bottom: 20px; margin-top: 32px; }
    .row:first-child .detail-section-title { margin-top: 0; }
    .detail-label { font-size: .78rem; font-weight: 700; color: var(--steel); text-transform: uppercase; letter-spacing: .05em; margin-bottom: 4px; }
    .detail-value { font-size: .98rem; font-weight: 600; color: var(--ink); margin-bottom: 20px; }

    .badge-status { padding: 6px 12px; border-radius: 6px; font-size: .85rem; font-weight: 700; display: inline-block; }
    .status-pending { background-color: #fef3c7; color: #d97706; }
    .status-diproses { background-color: #dbeafe; color: #2563eb; }
    .status-memenuhi { background-color: #d1fae5; color: #059669; }
    .status-tidak-memenuhi { background-color: #fee2e2; color: #dc2626; }

    .btn-download-doc { background-color: var(--paper); border: 1px solid var(--line); padding: 12px 16px; border-radius: var(--r-sm); display: inline-flex; align-items: center; gap: 12px; color: var(--ink); text-decoration: none; font-weight: 600; font-size: .9rem; transition: background .2s, border-color .2s; }
    .btn-download-doc:hover { background-color: var(--line); border-color: var(--steel-soft); color: var(--ink); }
    .btn-download-doc i { color: var(--signal); font-size: 1.25rem; }

    /* Lembar surat: disembunyikan di layar, hanya muncul di kertas */
    .document-page-print { display: none; }

    @media print {
        @page { size: A4 portrait; margin: 0; }
        body { background: #fff !important; padding: 0 !important; margin: 0 !important; display: block; font-family: 'Times New Roman', Times, serif; color: #000; }
        .topbar, .sidebar, .shell > .sidebar-backdrop, .page-header, .detail-card, .no-print { display: none !important; }
        .shell { display: block !important; width: 100%; }
        .content { padding: 0 !important; margin: 0 !important; background: transparent !important; width: 100%; }

        .document-page-print { display: block !important; width: 100%; padding: 15mm 20mm; margin: 0; box-sizing: border-box; position: relative; }

        .kop-surat { display: flex; align-items: center; border-bottom: 3px double #000; padding-bottom: 8px; margin-bottom: 15px; }
        .kop-surat img { width: 70px; height: auto; }
        .kop-teks { flex: 1; text-align: center; padding: 0 10px; }
        .kop-teks h2 { margin: 0; font-size: 14pt; font-weight: bold; text-transform: uppercase; color: #000; }
        .kop-teks h1 { margin: 3px 0; font-size: 16pt; font-weight: bold; text-transform: uppercase; letter-spacing: .5px; color: #000; }
        .kop-teks p { margin: 1px 0 0; font-size: 9pt; font-family: Arial, sans-serif; color: #000; }

        .doc-title { text-align: center; font-size: 13pt; font-weight: bold; margin-bottom: 25px; text-decoration: underline; letter-spacing: .5px; color: #000; }

        .print-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; font-size: 11.5pt; line-height: 1.4; color: #000; }
        .print-table tr { break-inside: avoid; page-break-inside: avoid; }
        .print-table td { padding: 5px 3px; vertical-align: top; border: none; }
        .print-table .label-col { width: 35%; }
        .print-table .separator { width: 3%; text-align: center; }
        .print-table .value-col { width: 62%; font-weight: bold; text-transform: capitalize; }
        .print-table .section-title { font-weight: bold; font-size: 12pt; margin-top: 15px; text-decoration: underline; padding-top: 10px; padding-bottom: 5px; }

        .signature-section { margin-top: 35px; text-align: right; padding-right: 30px; font-size: 11.5pt; color: #000; break-inside: avoid; page-break-inside: avoid; }
        .signature-space { height: 65px; }
    }
</style>
@endpush

@section('content')
@php
    $tgl = fn($v) => $v ? \Carbon\Carbon::parse($v)->format('d F Y') : '-';
@endphp

        <!-- HEADER HALAMAN WEB -->
        <div class="page-header no-print">
            <div>
                <h1>Detail {{ $jenis_layanan }}</h1>
                <p>Menampilkan rincian data permohonan dari <strong>{{ $permohonan->nama_pemohon }}</strong></p>
            </div>
            <div class="d-flex gap-2">
                <a href="/internal/pencegahan/kelola-skk" class="btn btn-outline-secondary fw-bold shadow-sm" style="border-radius: 8px; padding: 10px 20px;">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
                <button onclick="window.print()" class="btn btn-primary fw-bold shadow-sm" style="border-radius: 8px; padding: 10px 20px; background: var(--navy); border: none;">
                    <i class="fas fa-print me-2"></i> Cetak Form
                </button>
            </div>
        </div>

        <!-- ==================== TAMPILAN KARTU WEB ==================== -->
        <div class="detail-card no-print">

            <div class="row">
                <div class="col-md-6">
                    <h3 class="detail-section-title"><i class="fas fa-user-circle text-primary me-2"></i>Informasi Pemohon</h3>

                    <div class="detail-label">Nama Pemohon</div>
                    <div class="detail-value">{{ $permohonan->nama_pemohon }}</div>

                    <div class="detail-label">Alamat Email</div>
                    <div class="detail-value">{{ $permohonan->email_pemohon }}</div>

                    <div class="detail-label">Nomor WhatsApp</div>
                    <div class="detail-value">
                        {{ $permohonan->no_whatsapp }}
                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $permohonan->no_whatsapp) }}" target="_blank" class="ms-2 badge bg-success text-decoration-none no-print">Hubungi <i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <div class="col-md-6">
                    <h3 class="detail-section-title"><i class="fas fa-store text-warning me-2"></i>Informasi Usaha</h3>

                    <div class="detail-label">Nama Usaha / Instansi</div>
                    <div class="detail-value">{{ $permohonan->nama_usaha }}</div>

                    <div class="detail-label">NIK Pemilik Usaha</div>
                    <div class="detail-value">{{ $permohonan->nik_pemilik_usaha }}</div>

                    <div class="detail-label">Alamat Pemilik Usaha</div>
                    <div class="detail-value">{{ $permohonan->alamat_pemilik_usaha }}</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h3 class="detail-section-title"><i class="fas fa-building text-success me-2"></i>Rincian Bangunan</h3>
                </div>
                <div class="col-md-3">
                    <div class="detail-label">Kategori Bangunan</div>
                    <div class="detail-value">{{ $permohonan->kategori_bangunan }}</div>
                </div>
                <div class="col-md-3">
                    <div class="detail-label">Luas Lahan</div>
                    <div class="detail-value">{{ $permohonan->luas_lahan }} m²</div>
                </div>
                <div class="col-md-3">
                    <div class="detail-label">Luas Bangunan</div>
                    <div class="detail-value">{{ $permohonan->luas_bangunan }} m²</div>
                </div>
                <div class="col-md-3">
                    <div class="detail-label">Tinggi Bangunan</div>
                    <div class="detail-value">{{ $permohonan->tinggi_bangunan }} m</div>
                </div>
                <div class="col-md-12">
                    <div class="detail-label">Alamat Lengkap Bangunan</div>
                    <div class="detail-value">
                        {{ $permohonan->alamat_bangunan }}<br>
                        Kecamatan {{ $permohonan->kecamatan }}, Kelurahan {{ $permohonan->kelurahan }}
                    </div>
                </div>
            </div>

            {{-- Khusus perpanjangan: data SKK sebelumnya --}}
            @if($tipe === 'perpanjang')
            <div class="row">
                <div class="col-md-12">
                    <h3 class="detail-section-title"><i class="fas fa-sync-alt text-warning me-2"></i>Data SKK Sebelumnya</h3>
                </div>
                <div class="col-md-6">
                    <div class="detail-label">Nomor SKK Lama</div>
                    <div class="detail-value">{{ $permohonan->nomor_skk_lama ?: '-' }}</div>
                </div>
                <div class="col-md-3">
                    <div class="detail-label">Tanggal Terbit</div>
                    <div class="detail-value">{{ $tgl($permohonan->tanggal_terbit_skk_lama) }}</div>
                </div>
                <div class="col-md-3">
                    <div class="detail-label">Berlaku Sampai</div>
                    <div class="detail-value">{{ $tgl($permohonan->masa_berlaku_skk_lama) }}</div>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <h3 class="detail-section-title"><i class="fas fa-info-circle text-danger me-2"></i>Status Permohonan</h3>
                    <div class="detail-label">Status Saat Ini</div>
                    <div class="detail-value">
                        @if($permohonan->status_permohonan == 'Pending')
                            <span class="badge-status status-pending">Pending</span>
                        @elseif($permohonan->status_permohonan == 'Diproses')
                            <span class="badge-status status-diproses">Diproses Tim</span>
                        @elseif($permohonan->status_permohonan == 'Memenuhi Syarat')
                            <span class="badge-status status-memenuhi">Memenuhi Syarat</span>
                        @else
                            <span class="badge-status status-tidak-memenuhi">Tidak Memenuhi Syarat</span>
                        @endif
                    </div>
                    <div class="detail-label">Tanggal Pengajuan</div>
                    <div class="detail-value">{{ $permohonan->created_at->format('d F Y, H:i') }} WIB</div>
                </div>

                <!-- Berkas lampiran: hanya di layar -->
                <div class="col-md-6 no-print">
                    <h3 class="detail-section-title"><i class="fas fa-folder-open text-info me-2"></i>Berkas Lampiran</h3>
                    <div class="d-flex flex-column gap-2">

                        @php
                            $surat = $permohonan->file_surat_permohonan;
                            $suratKosong = !$surat || in_array($surat, ['offline_registered', 'Tidak dilampirkan (Offline)']);
                            $syarat = $permohonan->file_persyaratan_lainnya;
                            $syaratKosong = !$syarat || $syarat === '["Tidak dilampirkan (Offline)"]';
                        @endphp

                        @if($suratKosong)
                            <a href="javascript:void(0)" onclick="alert('Tidak ada data lampiran Surat Permohonan (Data dimasukkan secara Offline).');" class="btn-download-doc bg-light text-secondary">
                                <i class="fas fa-file-pdf text-secondary"></i>
                                <div>
                                    <div style="line-height: 1;">Surat Permohonan</div>
                                    <small class="text-muted fw-normal" style="font-size: 11px;">Tidak dilampirkan</small>
                                </div>
                            </a>
                        @else
                            <a href="{{ asset('storage/' . $surat) }}" target="_blank" class="btn-download-doc">
                                <i class="fas fa-file-pdf"></i>
                                <div>
                                    <div style="line-height: 1;">Lihat Surat Permohonan</div>
                                    <small class="text-muted fw-normal" style="font-size: 11px;">Berkas Wajib</small>
                                </div>
                            </a>
                        @endif

                        @if(!$syaratKosong)
                            <a href="{{ asset('storage/' . $syarat) }}" target="_blank" class="btn-download-doc">
                                <i class="fas fa-file-archive" style="color: #8b5cf6;"></i>
                                <div>
                                    <div style="line-height: 1;">Lihat Persyaratan Lainnya</div>
                                    <small class="text-muted fw-normal" style="font-size: 11px;">Lampiran Opsional</small>
                                </div>
                            </a>
                        @else
                            <div class="text-muted" style="font-size: 13px; font-weight: 500;">
                                <i class="fas fa-minus-circle me-1"></i> Tidak ada berkas lampiran tambahan.
                            </div>
                        @endif

                        @if($tipe === 'perpanjang' && !empty($permohonan->file_skk_lama))
                            <a href="{{ asset('storage/' . $permohonan->file_skk_lama) }}" target="_blank" class="btn-download-doc">
                                <i class="fas fa-certificate" style="color: #d97706;"></i>
                                <div>
                                    <div style="line-height: 1;">Lihat Salinan SKK Lama</div>
                                    <small class="text-muted fw-normal" style="font-size: 11px;">Khusus perpanjangan</small>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!-- ==================== TAMPILAN KERTAS PRINT ==================== -->
        <!-- Disembunyikan di layar, HANYA MUNCUL DI KERTAS -->
        <div class="document-page-print">

            <!-- KOP SURAT -->
            <div class="kop-surat">
                <img src="/images/jambi.png" alt="Logo Jambi">
                <div class="kop-teks">
                    <h2>Pemerintah Kota Jambi</h2>
                    <h1>Dinas Pemadam Kebakaran dan Penyelamatan</h1>
                    <p>Jl. HOS. Cokroaminoto, Suka Karya, Kec. Kota Baru, Kota Jambi 36125</p>
                    <p>Email: damkar.jbi@gmail.com | Website: damkar.jambikota.go.id</p>
                </div>
                <img src="/images/logo.png" alt="Logo Damkar">
            </div>

            <div class="doc-title">
                DATA PERMOHONAN SERTIFIKAT KEAMANAN KEBAKARAN (SKK)<br>
                {{ strtoupper($jenis_layanan) }}
            </div>

            @php $tglId = fn($v) => $v ? \Carbon\Carbon::parse($v)->locale('id')->isoFormat('D MMMM Y') : '-'; @endphp

            <table class="print-table">
                <tr><td colspan="3" class="section-title" style="margin-top: 0;">A. Data Pemohon</td></tr>
                <tr><td class="label-col">1. Nama Pemohon</td><td class="separator">:</td><td class="value-col">{{ $permohonan->nama_pemohon }}</td></tr>
                <tr><td class="label-col">2. Alamat Email</td><td class="separator">:</td><td class="value-col" style="text-transform: none;">{{ $permohonan->email_pemohon }}</td></tr>
                <tr><td class="label-col">3. Nomor WhatsApp</td><td class="separator">:</td><td class="value-col">{{ $permohonan->no_whatsapp }}</td></tr>
                <tr><td class="label-col">4. Tanggal Pengajuan</td><td class="separator">:</td><td class="value-col">{{ $tglId($permohonan->created_at) }}</td></tr>

                <tr><td colspan="3" class="section-title">B. Data Usaha / Instansi</td></tr>
                <tr><td class="label-col">5. Nama Usaha</td><td class="separator">:</td><td class="value-col">{{ $permohonan->nama_usaha }}</td></tr>
                <tr><td class="label-col">6. NIK Pemilik Usaha</td><td class="separator">:</td><td class="value-col">{{ $permohonan->nik_pemilik_usaha }}</td></tr>
                <tr><td class="label-col">7. Alamat Pemilik</td><td class="separator">:</td><td class="value-col" style="line-height: 1.4;">{{ $permohonan->alamat_pemilik_usaha }}</td></tr>

                <tr><td colspan="3" class="section-title">C. Spesifikasi Bangunan</td></tr>
                <tr><td class="label-col">8. Kategori Bangunan</td><td class="separator">:</td><td class="value-col">{{ $permohonan->kategori_bangunan }}</td></tr>
                <tr><td class="label-col">9. Luas Lahan</td><td class="separator">:</td><td class="value-col" style="text-transform: none;">{{ $permohonan->luas_lahan }} m&sup2;</td></tr>
                <tr><td class="label-col">10. Luas Bangunan</td><td class="separator">:</td><td class="value-col" style="text-transform: none;">{{ $permohonan->luas_bangunan }} m&sup2;</td></tr>
                <tr><td class="label-col">11. Tinggi Bangunan</td><td class="separator">:</td><td class="value-col" style="text-transform: none;">{{ $permohonan->tinggi_bangunan }} m</td></tr>
                <tr>
                    <td class="label-col">12. Alamat Bangunan</td><td class="separator">:</td>
                    <td class="value-col" style="line-height: 1.4;">{{ $permohonan->alamat_bangunan }},<br>Kec. {{ $permohonan->kecamatan }}, Kel. {{ $permohonan->kelurahan }}</td>
                </tr>

                @if($tipe === 'perpanjang')
                <tr><td colspan="3" class="section-title">D. Data SKK Sebelumnya</td></tr>
                <tr><td class="label-col">13. Nomor SKK Lama</td><td class="separator">:</td><td class="value-col" style="text-transform: none;">{{ $permohonan->nomor_skk_lama ?: '-' }}</td></tr>
                <tr><td class="label-col">14. Tanggal Terbit</td><td class="separator">:</td><td class="value-col">{{ $tglId($permohonan->tanggal_terbit_skk_lama) }}</td></tr>
                <tr><td class="label-col">15. Berlaku Sampai</td><td class="separator">:</td><td class="value-col">{{ $tglId($permohonan->masa_berlaku_skk_lama) }}</td></tr>
                @endif
            </table>

            <div class="signature-section">
                <p>Jambi, {{ $tglId($permohonan->created_at) }}</p>
                <p style="margin-bottom: 0;">Pemohon SKK,</p>
                <div class="signature-space"></div>
                <p style="font-weight: bold; text-decoration: underline; text-transform: uppercase; margin: 0;">{{ $permohonan->nama_pemohon }}</p>
            </div>

        </div>
@endsection

@push('scripts')
<script>
    // Cetak otomatis jika dibuka dari tombol "Cetak" di halaman kelola (?auto_print=true)
    window.addEventListener('load', function () {
        if (new URLSearchParams(window.location.search).has('auto_print')) {
            setTimeout(function () { window.print(); }, 500);
        }
    });
</script>
@endpush
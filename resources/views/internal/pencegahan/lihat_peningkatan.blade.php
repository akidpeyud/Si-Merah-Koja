@extends('layouts.dashboard')

@section('title', 'Detail Data Peningkatan Kapasitas - SIMERAH KOJA')

@push('styles')
<style>
    .detail-card { background: #ffffff; border-radius: 14px; padding: 28px 32px; box-shadow: 0 4px 12px rgba(15,23,42,0.05); border: 1px solid #e2e8f0; }
    .detail-section-title { font-size: 13px; font-weight: 800; color: #0284c7; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 16px; padding-bottom: 10px; border-bottom: 2px dashed #e2e8f0; }
    .detail-label { font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 4px; }
    .detail-value { font-size: 14px; font-weight: 600; color: #0f172a; padding: 10px 14px; background: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0; min-height: 42px; display: flex; align-items: center; }
</style>
@endpush

@section('content')
    @php
        $tampilTanggal = function ($nilai) {
            $nilai = trim((string) $nilai);
            if ($nilai === '') {
                return '-';
            }

            return preg_match('/^\d{4}-\d{2}-\d{2}/', $nilai)
                ? \Carbon\Carbon::parse($nilai)->format('d-m-Y')
                : $nilai;
        };
        $judulJenis = strtoupper(str_replace('-', ' ', $jenis ?? 'DIKLAT'));
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="/internal/pencegahan/peningkatan-kapasitas/{{ strtolower($jenis ?? '') }}" class="text-decoration-none text-muted fw-bold" style="font-size: 14px;">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Data {{ $judulJenis }}
            </a>
            <h1 class="fw-bolder text-dark mt-2 mb-0" style="font-size: 24px;">Detail Peningkatan Kapasitas ({{ $judulJenis }})</h1>
        </div>
    </div>

    <div class="detail-card">
        <div class="detail-section-title"><i class="fas fa-user me-2"></i> Data Pegawai / Aparatur</div>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="detail-label">Nama</div>
                <div class="detail-value">{{ $data->nama ?? '-' }}</div>
            </div>
            <div class="col-md-6">
                <div class="detail-label">NIP</div>
                <div class="detail-value">{{ $data->nip ?? '-' }}</div>
            </div>
            <div class="col-md-4">
                <div class="detail-label">Tempat Lahir</div>
                <div class="detail-value">{{ $data->tempat_lahir ?? '-' }}</div>
            </div>
            <div class="col-md-4">
                <div class="detail-label">Tanggal Lahir</div>
                <div class="detail-value">{{ $tampilTanggal($data->tgl_lahir ?? null) }}</div>
            </div>
            <div class="col-md-4">
                <div class="detail-label">Pangkat / Golongan Ruang</div>
                <div class="detail-value">{{ $data->pangkat_golongan ?? '-' }}</div>
            </div>
            <div class="col-md-6">
                <div class="detail-label">Jabatan</div>
                <div class="detail-value">{{ $data->jabatan ?? '-' }}</div>
            </div>
            <div class="col-md-6">
                <div class="detail-label">Kualifikasi</div>
                <div class="detail-value">{{ $data->kualifikasi ?? '-' }}</div>
            </div>
        </div>

        <div class="detail-section-title"><i class="fas fa-calendar-check me-2"></i> Pelaksanaan Diklat</div>
        <div class="row g-3 mb-4">
            <div class="col-md-12">
                <div class="detail-label">Tempat Pelaksanaan</div>
                <div class="detail-value">{{ $data->tempat_pelaksanaan ?? '-' }}</div>
            </div>
            <div class="col-md-4">
                <div class="detail-label">Tanggal Pelaksanaan</div>
                <div class="detail-value">{{ $tampilTanggal($data->tanggal_pelaksanaan ?? null) }}</div>
            </div>
            <div class="col-md-4">
                <div class="detail-label">Tanggal Selesai Pelaksanaan</div>
                <div class="detail-value">{{ $tampilTanggal($data->tanggal_selesai_pelaksanaan ?? null) }}</div>
            </div>
            <div class="col-md-4">
                <div class="detail-label">Jumlah Jam Pelajaran</div>
                <div class="detail-value">{{ ! empty($data->jumlah_jam_pelajaran) ? $data->jumlah_jam_pelajaran . ' JP' : '-' }}</div>
            </div>
        </div>

        <div class="detail-section-title"><i class="fas fa-award me-2" style="color: #f59e0b;"></i> STTP &amp; Sertifikat</div>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="detail-label">No STTP</div>
                <div class="detail-value">{{ $data->no_sttp ?? '-' }}</div>
            </div>
            <div class="col-md-4">
                <div class="detail-label">Tanggal STTP</div>
                <div class="detail-value">{{ $tampilTanggal($data->tanggal_sttp ?? null) }}</div>
            </div>
            <div class="col-md-4">
                <div class="detail-label">Pejabat yang Menandatangani</div>
                <div class="detail-value">{{ $data->ditandatangani_oleh ?? '-' }}</div>
            </div>
            <div class="col-md-12">
                <div class="detail-label">Sertifikat</div>
                <div class="detail-value">
                    @if (! empty($data->file_sertifikat))
                        <a href="{{ asset('storage/' . $data->file_sertifikat) }}" target="_blank" rel="noopener" class="text-decoration-none">
                            <i class="fas fa-file-alt me-2"></i> Lihat / Unduh Sertifikat
                        </a>
                    @else
                        -
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

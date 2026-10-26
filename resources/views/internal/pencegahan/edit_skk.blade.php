@extends('layouts.dashboard')

@section('title', 'Edit SKK')

@push('styles')
<style>
    :root {
                --ink: #0d1b2a;
                --navy: #163a63;
                --navy-dark: #0d2947;
                --navy-soft: rgba(22, 58, 99, .08);
                --paper: #f5f7fa;
                --signal: #dc3545;
                --signal-soft: rgba(220, 53, 69, .09);
                --steel: #64748b;
                --line: #e2e8f0;
                --line-dark: #d5dce6;
    
                --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
                --font-body: 'Instrument Sans', system-ui, sans-serif;
                
                --r-md: 14px;
                --r-sm: 10px;
                --topbar-h: 70px;
                --sidebar-w: 288px;
    
                --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
                --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
                --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
                --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);
            }
    body { font-family: var(--font-body); background: var(--paper); color: var(--ink); line-height: 1.6; }
    a { text-decoration: none; color: inherit; }
    ul { list-style: none; margin: 0; padding: 0; }
    button { border: 0; background: none; font: inherit; cursor: pointer; }
    .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
    .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #fff; color: var(--ink); display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
    .user-meta strong { font-size: .84rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #fff; }
    .btn-logout { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #fff; color: var(--ink); font-weight: 600; font-size: .84rem; border: none; transition: background .2s, color .2s, transform .1s, box-shadow .2s; }
    .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; overflow-x: hidden; background: #fff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
    .side-link.active { background: var(--ink); color: #fff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
    .side-link.active i { color: #fff; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; margin-top: 4px; }
    .content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px); }
    .page-head { margin-bottom: 26px; }
    .page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.5rem, 3vw, 2rem); margin-bottom: 6px; }
    .page-head p { color: var(--steel); font-size: .95rem; }
    .form-card { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 30px; box-shadow: var(--shadow-xs); }
    .form-section-title { font-family: var(--font-display); font-weight: 700; font-size: 1.1rem; color: var(--navy); margin-bottom: 16px; padding-bottom: 10px; border-bottom: 2px solid var(--line); display: flex; align-items: center; gap: 8px; }
    .form-label { font-size: .88rem; font-weight: 600; color: var(--ink); margin-bottom: 6px; }
    .form-control, .form-select { border-color: var(--line-dark); padding: 10px 14px; border-radius: 8px; font-size: .92rem; color: var(--ink); box-shadow: none; transition: .2s; }
    .form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .btn-submit { background: var(--navy); color: #fff; padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: .95rem; border: none; display: inline-flex; align-items: center; gap: 8px; transition: .2s; }
    .btn-submit:hover { background: var(--navy-dark); transform: translateY(-1px); }
    .btn-back { background: #fff; color: var(--ink); border: 1px solid var(--line-dark); padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: .95rem; display: inline-flex; align-items: center; gap: 8px; transition: .2s; text-decoration: none;}
    .btn-back:hover { background: var(--paper); color: var(--ink); }
    .alert-error { background: var(--signal-soft); color: var(--signal); padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: .9rem; border: 1px solid rgba(220,53,69,.2); }
</style>
@endpush

@section('content')

        <div class="mb-4">
            <a href="/internal/pencegahan/kelola-skk" class="btn-back" style="padding: 8px 18px; font-size: 0.88rem;">
                <i class="fas fa-arrow-left"></i> Kembali ke Kelola SKK
            </a>
        </div>

        <div class="page-head">
            <h1>Edit Permohonan SKK</h1>
            <p>Perbarui informasi dan data pengajuan Sertifikat Keamanan Kebakaran (SKK).</p>
        </div>

        <div class="form-card mx-auto" style="max-width: 900px;">
            @if($errors->any())
                <div class="alert-error">
                    <strong><i class="fas fa-exclamation-triangle"></i> Terdapat Kesalahan:</strong>
                    <ul class="mb-0 mt-1 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- PEMBATASAN HAK AKSES UNTUK FORM EDIT -->
            @hasanyrole('Pencegahan|Super User')
            <form action="{{ route('skk.update', $p->id) }}{{ ($tipe ?? 'baru') === 'perpanjang' ? '?tipe=perpanjang' : '' }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="tipe" value="{{ $tipe ?? 'baru' }}">

                <!-- SECTION: DATA PEMOHON -->
                <h4 class="form-section-title"><i class="fas fa-user-circle"></i> Data Pemohon</h4>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Nama Pemohon</label>
                        <input type="text" name="nama_pemohon" class="form-control" value="{{ old('nama_pemohon', $p->nama_pemohon) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NIK Pemohon / Pemilik</label>
                        <input type="text" name="nik_pemilik_usaha" class="form-control" value="{{ old('nik_pemilik_usaha', $p->nik_pemilik_usaha) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Pemohon</label>
                        <input type="email" name="email_pemohon" class="form-control" value="{{ old('email_pemohon', $p->email_pemohon) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nomor WhatsApp</label>
                        <input type="text" name="no_whatsapp" class="form-control" value="{{ old('no_whatsapp', $p->no_whatsapp) }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Alamat Pemilik (Sesuai KTP)</label>
                        <textarea name="alamat_pemilik_usaha" class="form-control" rows="2" required>{{ old('alamat_pemilik_usaha', $p->alamat_pemilik_usaha) }}</textarea>
                    </div>
                </div>

                <!-- SECTION: DATA USAHA & BANGUNAN -->
                <h4 class="form-section-title mt-4"><i class="fas fa-building"></i> Data Usaha & Bangunan</h4>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Nama Usaha / Gedung</label>
                        <input type="text" name="nama_usaha" class="form-control" value="{{ old('nama_usaha', $p->nama_usaha) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kategori Bangunan</label>
                        <input type="text" name="kategori_bangunan" class="form-control" value="{{ old('kategori_bangunan', $p->kategori_bangunan) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kecamatan</label>
                        <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan', $p->kecamatan) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kelurahan</label>
                        <input type="text" name="kelurahan" class="form-control" value="{{ old('kelurahan', $p->kelurahan) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Luas Lahan (m²)</label>
                        <input type="number" step="0.01" name="luas_lahan" class="form-control" value="{{ old('luas_lahan', $p->luas_lahan) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Luas Bangunan (m²)</label>
                        <input type="number" step="0.01" name="luas_bangunan" class="form-control" value="{{ old('luas_bangunan', $p->luas_bangunan) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tinggi Bangunan (m)</label>
                        <input type="number" step="0.01" name="tinggi_bangunan" class="form-control" value="{{ old('tinggi_bangunan', $p->tinggi_bangunan) }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Alamat Bangunan Lengkap</label>
                        <textarea name="alamat_bangunan" class="form-control" rows="2" required>{{ old('alamat_bangunan', $p->alamat_bangunan) }}</textarea>
                    </div>
                </div>

                @if(($tipe ?? 'baru') === 'perpanjang')
                <!-- SECTION: DATA SKK SEBELUMNYA (KHUSUS PERPANJANGAN) -->
                <h4 class="form-section-title mt-4"><i class="fas fa-sync-alt"></i> Data SKK Sebelumnya</h4>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Nomor SKK Lama</label>
                        <input type="text" name="nomor_skk_lama" class="form-control" value="{{ old('nomor_skk_lama', $p->nomor_skk_lama) }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Terbit</label>
                        <input type="date" name="tanggal_terbit_skk_lama" class="form-control" value="{{ old('tanggal_terbit_skk_lama', $p->tanggal_terbit_skk_lama ? \Carbon\Carbon::parse($p->tanggal_terbit_skk_lama)->format('Y-m-d') : '') }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Masa Berlaku Sampai</label>
                        <input type="date" name="masa_berlaku_skk_lama" class="form-control" value="{{ old('masa_berlaku_skk_lama', $p->masa_berlaku_skk_lama ? \Carbon\Carbon::parse($p->masa_berlaku_skk_lama)->format('Y-m-d') : '') }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Ganti Salinan SKK Lama (Opsional)</label>
                        <input type="file" name="file_skk_lama" class="form-control" accept=".pdf,.png,.jpg,.jpeg">
                        <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengubah salinan SKK lama. Maks 2MB.</small>
                        @if($p->file_skk_lama && $p->file_skk_lama !== 'offline_registered' && $p->file_skk_lama !== 'Tidak dilampirkan (Offline)')
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $p->file_skk_lama) }}" target="_blank" class="badge bg-warning text-dark text-decoration-none px-2 py-1"><i class="fas fa-external-link-alt"></i> Lihat SKK Lama Saat Ini</a>
                            </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- SECTION: STATUS & LAMPIRAN -->
                <h4 class="form-section-title mt-4"><i class="fas fa-file-signature"></i> Status & Lampiran</h4>
                <div class="row g-3 mb-5">
                    <div class="col-md-6">
                        <label class="form-label">Status Permohonan</label>
                        <select name="status_permohonan" class="form-select" required>
                            <option value="Pending" {{ old('status_permohonan', $p->status_permohonan) == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Diproses" {{ old('status_permohonan', $p->status_permohonan) == 'Diproses' ? 'selected' : '' }}>Diproses Tim Inspeksi</option>
                            <option value="Memenuhi Syarat" {{ old('status_permohonan', $p->status_permohonan) == 'Memenuhi Syarat' ? 'selected' : '' }}>Memenuhi Syarat / Diterima</option>
                            <option value="Tidak Memenuhi Syarat" {{ old('status_permohonan', $p->status_permohonan) == 'Tidak Memenuhi Syarat' ? 'selected' : '' }}>Tidak Memenuhi Syarat / Ditolak</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Ganti Surat Permohonan (Opsional)</label>
                        <input type="file" name="file_surat_permohonan" class="form-control" accept=".pdf,.png,.jpg,.jpeg">
                        <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengubah surat. Maks 2MB.</small>
                        @if($p->file_surat_permohonan && $p->file_surat_permohonan !== 'offline_registered' && $p->file_surat_permohonan !== 'Tidak dilampirkan (Offline)')
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $p->file_surat_permohonan) }}" target="_blank" class="badge bg-primary text-decoration-none px-2 py-1"><i class="fas fa-external-link-alt"></i> Lihat File Saat Ini</a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 border-top pt-4">
                    <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Simpan Perubahan</button>
                </div>
            </form>
            @else
                <div class="alert alert-warning text-center mt-4">
                    <i class="fas fa-lock mb-2" style="font-size: 2rem;"></i><br>
                    <strong>Akses Ditolak!</strong> Anda tidak memiliki izin untuk mengedit data SKK.
                </div>
            @endhasanyrole
        </div>

<!-- ==================== SCRIPTS ==================== -->
@endsection

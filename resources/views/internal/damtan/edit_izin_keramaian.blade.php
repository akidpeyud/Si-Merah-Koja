@extends('layouts.dashboard')

@section('title', 'Edit Data Event Keramaian')

@push('styles')
<style>
    /* Mengadopsi CSS Variables dan Styling dari Kode 1 */
    :root {
        --ink: #0d1b2a; --ink-2: #132a43; --ink-3: #1d3856;
        --paper: #f3f5f8; --white: #ffffff;
        --signal: #e5392d; --signal-d: #c22b20;
        --amber: #ffb627; --steel: #5b6c7f;
        --line: #dbe2ea; --ok: #16a34a; --ok-bg: #dcfce7;
        --warn: #d97706; --warn-bg: #fef3c7;
        --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
        --font-body: 'Instrument Sans', system-ui, sans-serif;
        --r-lg: 28px; --r-md: 18px; --r-sm: 10px;
    }

    body { font-family: var(--font-body); color: var(--ink); background: var(--paper); }
    
    /* Layout Khusus Dashboard yang dipertahankan */
    .topbar { position: sticky; top: 0; z-index: 1020; height: 70px; display: flex; align-items: center; justify-content: space-between; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); }
    .sidebar { width: 272px; flex: none; position: sticky; top: 70px; height: calc(100vh - 70px); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; }

    /* Form Panel & Component */
    .form-panel { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); overflow: hidden; box-shadow: 0 10px 30px rgba(13, 27, 42, 0.03); margin-bottom: 32px; }
    .form-bar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px 20px; padding: 18px clamp(18px, 3vw, 32px); border-bottom: 1px solid var(--line); }
    .form-title { display: flex; align-items: center; gap: 14px; min-width: 0; }
    .form-title > i { flex: none; width: 44px; height: 44px; border-radius: 14px; display: grid; place-items: center; background: var(--ink); color: var(--amber); font-size: 1.05rem; }
    .form-title h2 { font-family: var(--font-display); font-weight: 700; font-size: 1.3rem; line-height: 1.2; letter-spacing: -0.015em; margin: 0; }
    .form-title p { font-size: .85rem; color: var(--steel); line-height: 1.4; margin: 2px 0 0; }
    
    .form-body { padding: clamp(18px, 3vw, 32px); display: grid; gap: 36px; }
    
    .fs { border: 0; min-width: 0; margin: 0; padding: 0; }
    .fs legend { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; padding: 0; width: 100%; font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; letter-spacing: -0.01em; color: var(--ink); }
    .fs legend::after { content: ""; flex: 1; height: 1px; background: var(--line); }
    .fs legend i { width: 34px; height: 34px; border-radius: 10px; display: grid; place-items: center; background: #fdeceb; color: var(--signal-d); font-size: .85rem; }

    .fields { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px 20px; }
    .field { min-width: 0; display: flex; flex-direction: column; }
    .field.full { grid-column: 1 / -1; }
    @media (max-width: 768px) { .fields { grid-template-columns: minmax(0, 1fr); } }

    .label { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; font-size: .9rem; font-weight: 600; color: var(--ink); }
    .req { color: var(--signal-d); margin-left: 2px; }
    
    .input { display: block; width: 100%; height: 48px; padding: 0 16px; border: 1px solid var(--line); border-radius: 14px; background: #fff; font-family: var(--font-body); font-size: .95rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
    .input:hover:not(:disabled) { border-color: #b8c3d0; }
    .input:focus { outline: none; border-color: var(--ink); box-shadow: 0 0 0 3px rgba(255,182,39,.5); }
    
    .time-range { display: flex; align-items: center; gap: 10px; }
    .time-range span { font-weight: 600; color: var(--steel); font-size: .9rem; }

    .upload-card { padding: 16px 20px; border: 1px solid var(--line); border-radius: var(--r-md); background: #fff; display: flex; flex-direction: column; justify-content: space-between; gap: 10px; }
    .upload-card .current-file { font-size: 0.85rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: var(--paper); border-radius: 8px; border: 1px solid var(--line); color: var(--steel); text-decoration: none; word-break: break-all;}
    .upload-card .current-file:hover { color: var(--signal-d); border-color: var(--signal); }

    .btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 12px 24px; border-radius: 999px; font-weight: 700; font-size: .95rem; transition: background .2s, transform .15s; cursor: pointer; border: none; text-decoration: none; }
    .btn:active { transform: scale(.98); }
    .btn-primary { background: var(--signal); color: #fff; box-shadow: 0 10px 25px -8px rgba(229,57,45,.6); }
    .btn-primary:hover { background: var(--signal-d); color: #fff; }
    .btn-dark { background: var(--ink); color: #fff; }
    .btn-dark:hover { background: var(--ink-3); color: #fff; }
    .btn-ghost { background: var(--paper); color: var(--ink); border: 1px solid var(--line); }
    .btn-ghost:hover { background: var(--line); color: var(--ink); }

    .alert { display: flex; gap: 12px; align-items: flex-start; padding: 14px 16px; border-radius: 14px; font-size: .92rem; line-height: 1.5; margin-bottom: 24px; }
    .alert.err { background: #fdeceb; color: #8f1d15; border: 1px solid #f5c3bf; }
    .alert ul { margin: 4px 0 0; padding-left: 18px; }
</style>
@endpush

@section('content')
<div class="form-panel">
    <div class="form-bar">
        <div class="form-title">
            <i class="fas fa-file-pen"></i>
            <div>
                <h2>Edit Data Event Keramaian</h2>
                <p>Ubah data permohonan atas nama <strong>{{ $permohonan->nama }}</strong>.</p>
            </div>
        </div>
        <a href="{{ route('internal.izin-keramaian.index') }}" class="btn btn-ghost">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form class="form-body" action="{{ route('internal.izin-keramaian.update', $permohonan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="alert err" role="alert">
                <i class="fas fa-triangle-exclamation" style="margin-top: 3px;"></i>
                <div>
                    <strong>Periksa kembali isian Anda:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- 1. DATA PEMOHON -->
        <fieldset class="fs">
            <legend><i class="fas fa-user"></i> 1. Data Pemohon</legend>
            <div class="fields">
                <div class="field full">
                    <label class="label">Nama Pemohon <span class="req">*</span></label>
                    <input class="input" type="text" name="nama" value="{{ old('nama', $permohonan->nama) }}" required>
                </div>
                <div class="field">
                    <label class="label">NIK <span class="req">*</span></label>
                    <input class="input" type="text" name="nik" maxlength="16" value="{{ old('nik', $permohonan->nik) }}" required>
                </div>
                <div class="field">
                    <label class="label">No HP/WA <span class="req">*</span></label>
                    <input class="input" type="text" name="no_hp" value="{{ old('no_hp', $permohonan->no_hp) }}" required>
                </div>
                <div class="field full">
                    <label class="label">Alamat Lengkap <span class="req">*</span></label>
                    <input class="input" type="text" name="alamat" value="{{ old('alamat', $permohonan->alamat) }}" required>
                </div>
            </div>
        </fieldset>

        <!-- 2. DATA USAHA -->
        <fieldset class="fs">
            <legend><i class="fas fa-briefcase"></i> 2. Data Usaha / Instansi</legend>
            <div class="fields">
                <div class="field full">
                    <label class="label">Nama Penanggung Jawab / Direktur <span class="req">*</span></label>
                    <input class="input" type="text" name="nama_direktur" value="{{ old('nama_direktur', $permohonan->nama_direktur) }}" required>
                </div>
                <div class="field">
                    <label class="label">Nama Usaha / Instansi <span class="req">*</span></label>
                    <input class="input" type="text" name="nama_usaha" value="{{ old('nama_usaha', $permohonan->nama_usaha) }}" required>
                </div>
                <div class="field">
                    <label class="label">No. Izin Usaha / Surat Tugas <span class="req">*</span></label>
                    <input class="input" type="text" name="no_izin_usaha" value="{{ old('no_izin_usaha', $permohonan->no_izin_usaha) }}" required>
                </div>
            </div>
        </fieldset>

        <!-- 3. DATA LOKASI & WAKTU ACARA -->
        <fieldset class="fs">
            <legend><i class="fas fa-map-marker-alt"></i> 3. Data Lokasi & Peralatan Acara</legend>
            <div class="fields">
                <div class="field full">
                    <label class="label">Nama Acara <span class="req">*</span></label>
                    <input class="input" type="text" name="nama_acara" value="{{ old('nama_acara', $permohonan->nama_acara) }}" required>
                </div>
                <div class="field full">
                    <label class="label">Jenis Event <span class="req">*</span></label>
                    <select class="input" name="jenis_event" required>
                        <option value="hiburan" {{ old('jenis_event', $permohonan->jenis_event) == 'hiburan' ? 'selected' : '' }}>Event Hiburan</option>
                        <option value="non_hiburan" {{ old('jenis_event', $permohonan->jenis_event) == 'non_hiburan' ? 'selected' : '' }}>Non-Hiburan</option>
                    </select>
                </div>
                <div class="field full">
                    <label class="label">Lokasi Acara <span class="req">*</span></label>
                    <input class="input" type="text" name="lokasi_acara" value="{{ old('lokasi_acara', $permohonan->lokasi_acara) }}" required>
                </div>
                <div class="field">
                    <label class="label">Tgl. Pelaksanaan <span class="req">*</span></label>
                    <input class="input" type="date" name="tgl_pelaksanaan" value="{{ old('tgl_pelaksanaan', \Carbon\Carbon::parse($permohonan->tgl_pelaksanaan)->format('Y-m-d')) }}" required>
                </div>
                <div class="field">
                    <label class="label">Waktu Pelaksanaan <span class="req">*</span></label>
                    <div class="time-range">
                        <input class="input" type="time" name="waktu_mulai" value="{{ old('waktu_mulai', substr($permohonan->waktu_mulai, 0, 5)) }}" required style="flex:1;">
                        <span>s/d</span>
                        <input class="input" type="time" name="waktu_selesai" value="{{ old('waktu_selesai', substr($permohonan->waktu_selesai, 0, 5)) }}" required style="flex:1;">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Jumlah Estimasi Penonton <span class="req">*</span></label>
                    <input class="input" type="number" name="jumlah_penonton" value="{{ old('jumlah_penonton', $permohonan->jumlah_penonton) }}" required>
                </div>
                <div class="field">
                    <label class="label">Jumlah APAR <span class="req">*</span></label>
                    <input class="input" type="number" name="jumlah_apar" value="{{ old('jumlah_apar', $permohonan->jumlah_apar) }}" min="8" required>
                </div>
                <div class="field">
                    <label class="label">Jumlah Staff Terlatih <span class="req">*</span></label>
                    <input class="input" type="number" name="jumlah_staff" value="{{ old('jumlah_staff', $permohonan->jumlah_staff) }}" min="4" required>
                </div>
            </div>
        </fieldset>

        <!-- 4. BERKAS PERSYARATAN -->
        <fieldset class="fs">
            <legend><i class="fas fa-file-signature"></i> 4. Lampiran <span style="font-size:.85rem; color:var(--steel); font-weight: normal; margin-left: auto;">(Biarkan kosong jika tidak ingin mengubah berkas)</span></legend>
            <div class="fields">
                
                <!-- Berkas 1: Surat Permohonan -->
                <div class="upload-card">
                    <label class="label">Surat Permohonan <br><span style="font-size: 0.8rem; font-weight: normal; color: var(--steel);">(PDF/JPG/PNG, maks 5 MB)</span></label>
                    <input type="file" name="surat_permohonan" class="input" accept=".pdf,.jpg,.jpeg,.png" style="padding-top: 10px;">
                    @if(!empty($permohonan->surat_permohonan))
                        <a href="{{ asset('storage/' . $permohonan->surat_permohonan) }}" target="_blank" class="current-file"><i class="fas fa-file-pdf"></i> Buka file saat ini</a>
                    @else
                        <span style="font-size: .85rem; color: var(--steel);">Belum ada file.</span>
                    @endif
                </div>

                <!-- Berkas 2: Fotokopi KTP -->
                <div class="upload-card">
                    <label class="label">Fotokopi KTP <br><span style="font-size: 0.8rem; font-weight: normal; color: var(--steel);">(PDF/JPG/PNG, maks 5 MB)</span></label>
                    <input type="file" name="fotokopi_ktp" class="input" accept=".pdf,.jpg,.jpeg,.png" style="padding-top: 10px;">
                    @if(!empty($permohonan->fotokopi_ktp))
                        <a href="{{ asset('storage/' . $permohonan->fotokopi_ktp) }}" target="_blank" class="current-file"><i class="fas fa-id-card"></i> Buka file saat ini</a>
                    @else
                        <span style="font-size: .85rem; color: var(--steel);">Belum ada file.</span>
                    @endif
                </div>

                <!-- Berkas 3: Sket Denah Lokasi -->
                <div class="upload-card">
                    <label class="label">Sket Denah Lokasi (Genset) <br><span style="font-size: 0.8rem; font-weight: normal; color: var(--steel);">(PDF/JPG/PNG, maks 5 MB)</span></label>
                    <input type="file" name="foto_jalur_evakuasi" class="input" accept=".pdf,.jpg,.jpeg,.png" style="padding-top: 10px;">
                    @if(!empty($permohonan->foto_jalur_evakuasi))
                        <a href="{{ asset('storage/' . $permohonan->foto_jalur_evakuasi) }}" target="_blank" class="current-file"><i class="fas fa-map-location-dot"></i> Buka file saat ini</a>
                    @else
                        <span style="font-size: .85rem; color: var(--steel);">Belum ada file.</span>
                    @endif
                </div>

                <!-- Berkas 4: Bukti Pajak BPPRD -->
                <div class="upload-card">
                    <label class="label">Bukti Pajak BPPRD <br><span style="font-size: 0.8rem; font-weight: normal; color: var(--steel);">(Khusus Hiburan - PDF/JPG, maks 5 MB)</span></label>
                    <input type="file" name="bukti_pajak_bpprd" class="input" accept=".pdf,.jpg,.jpeg,.png" style="padding-top: 10px;">
                    @if(!empty($permohonan->bukti_pajak_bpprd))
                        <a href="{{ asset('storage/' . $permohonan->bukti_pajak_bpprd) }}" target="_blank" class="current-file"><i class="fas fa-receipt"></i> Buka file saat ini</a>
                    @else
                        <span style="font-size: .85rem; color: var(--steel);">Belum ada file.</span>
                    @endif
                </div>

                <!-- Berkas 5: Surat Pernyataan -->
                <div class="upload-card">
                    <label class="label">Surat Pernyataan Mutlak <br><span style="font-size: 0.8rem; font-weight: normal; color: var(--steel);">(PDF/JPG/PNG, maks 5 MB)</span></label>
                    <input type="file" name="surat_pernyataan" class="input" accept=".pdf,.jpg,.jpeg,.png" style="padding-top: 10px;">
                    @if(!empty($permohonan->surat_pernyataan))
                        <a href="{{ asset('storage/' . $permohonan->surat_pernyataan) }}" target="_blank" class="current-file"><i class="fas fa-file-signature"></i> Buka file saat ini</a>
                    @else
                        <span style="font-size: .85rem; color: var(--steel);">Belum ada file.</span>
                    @endif
                </div>

            </div>
        </fieldset>

        <div style="display: flex; gap: 14px; margin-top: 10px;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
            <a href="{{ route('internal.izin-keramaian.index') }}" class="btn btn-dark">Batal</a>
        </div>
    </form>
</div>
@endsection
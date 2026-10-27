@extends('layouts.public')

@section('title', '404 - Halaman Tidak Ditemukan | SIMERAH KOJA')
@section('meta_description', 'Halaman yang Anda cari tidak ditemukan di SIMERAH KOJA Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.')

@push('styles')
<style>
    .error-hero {
        position: relative;
        isolation: isolate;
        color: #fff;
        background: var(--ink);
        overflow: hidden;
        min-height: calc(85svh - var(--header-h));
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: clamp(60px, 10vw, 120px) 0;
    }
    .error-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        z-index: -1;
        background:
            radial-gradient(60% 60% at 50% 50%, rgba(229,57,45,.28), transparent 75%),
            linear-gradient(135deg, rgba(13,27,42,.98) 0%, rgba(19,42,67,.92) 100%),
            url('/images/background1.png') center / cover no-repeat;
    }
    .error-box {
        max-width: 680px;
        margin: 0 auto;
    }
    .error-code {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: clamp(6rem, 18vw, 11rem);
        line-height: .9;
        letter-spacing: -0.05em;
        background: linear-gradient(135deg, #fff 30%, var(--amber) 70%, var(--signal) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 12px;
        filter: drop-shadow(0 18px 30px rgba(0,0,0,.45));
    }
    .error-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 18px;
        border-radius: 999px;
        background: rgba(229,57,45,.16);
        border: 1px solid rgba(229,57,45,.4);
        color: #ff8b8b;
        font-size: .9rem;
        font-weight: 600;
        margin-bottom: 22px;
    }
    .error-title {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: clamp(1.8rem, 4vw, 2.5rem);
        line-height: 1.2;
        margin-bottom: 14px;
        letter-spacing: -0.02em;
    }
    .error-desc {
        color: rgba(255,255,255,.75);
        font-size: clamp(1rem, 1.6vw, 1.15rem);
        max-width: 50ch;
        margin: 0 auto 32px;
    }
    .error-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: 14px;
    }
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        height: 48px;
        padding: 0 24px;
        border-radius: 999px;
        font-size: .95rem;
        font-weight: 600;
        transition: transform .2s, background .2s, color .2s, border-color .2s;
    }
    .btn-action:active { transform: scale(.97); }
    .btn-action--primary {
        background: var(--signal);
        color: #fff;
    }
    .btn-action--primary:hover {
        background: var(--signal-d);
        transform: translateY(-2px);
    }
    .btn-action--ghost {
        border: 1.5px solid rgba(255,255,255,.3);
        color: #fff;
    }
    .btn-action--ghost:hover {
        border-color: #fff;
        background: rgba(255,255,255,.08);
        transform: translateY(-2px);
    }
</style>
@endpush

@section('content')
<section class="error-hero">
    <div class="wrap">
        <div class="error-box">
            <div class="error-code">404</div>
            <div class="error-tag">
                <i class="fas fa-triangle-exclamation"></i> Halaman Tidak Ditemukan
            </div>
            <h1 class="error-title">Mohon Maaf, Halaman Tidak Ada</h1>
            <p class="error-desc">
                Tautan yang Anda tuju mungkin sudah dipindahkan, dihapus, atau alamat yang Anda masukkan kurang tepat.
            </p>
            <div class="error-actions">
                <a href="/" class="btn-action btn-action--primary">
                    <i class="fas fa-house"></i> Kembali ke Beranda
                </a>
                <a href="tel:112" class="btn-action btn-action--ghost">
                    <i class="fas fa-headset"></i> Panggilan Darurat 112
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

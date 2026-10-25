{{--
    Logo hero global.

    Dua cara pakai:

    1) Mode melayang (disarankan untuk semua halaman, tidak perlu mengubah struktur hero).
       Taruh tepat sebelum penutup </section> hero:
           @include('layouts.partials.hero-logos', ['float' => true])

    2) Mode inline, di dalam .hero-grid sejajar dengan .hero-text:
           <div class="hero-grid">
               <div class="hero-text"> ...judul... </div>
               @include('layouts.partials.hero-logos')
           </div>
--}}
@php $float = $float ?? false; @endphp

@once
<style>
    /* ----- Mode inline ----- */
    .hero-grid { display: flex; align-items: flex-end; justify-content: space-between; gap: 28px 40px; flex-wrap: wrap; }
    .hero-text { flex: 1 1 420px; min-width: 0; }

    /* ----- Kartu logo ----- */
    .hero-logos {
        display: flex; align-items: center; justify-content: center;
        gap: clamp(14px, 2vw, 26px);
        padding: 12px clamp(16px, 2vw, 26px);
        background: #fff; border-radius: 18px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, .25);
        flex: 0 1 auto;
    }
    .hero-logos img { height: clamp(32px, 4vw, 46px); width: auto; max-width: 100%; object-fit: contain; }
    .hero-logos img + img { padding-left: clamp(14px, 2vw, 26px); border-left: 1px solid #e2e8f0; }

    /* ----- Mode melayang ----- */
    .page-hero { position: relative; }
    .hero-logos-layer {
        position: relative; z-index: 2;
        width: min(1300px, calc(100% - 48px));
        margin: 20px auto 0;
    }
    .hero-logos-layer .hero-logos { width: 100%; justify-content: space-around; }

    /* Layar lebar: logo di pojok kanan atas hero, tidak menggeser isi hero */
    @media (min-width: 1101px) {
        .hero-logos-layer {
            position: absolute; z-index: 2;
            top: clamp(28px, 5vw, 48px); left: 50%; transform: translateX(-50%);
            margin: 0; display: flex; justify-content: flex-end;
            pointer-events: none;
        }
        .hero-logos-layer .hero-logos { width: auto; pointer-events: auto; }
    }

    @media (max-width: 991px) {
        .hero-logos { width: 100%; justify-content: space-around; }
    }
    @media (max-width: 640px) {
        .hero-logos-layer { width: calc(100% - 28px); }
        .hero-logos { padding: 10px 14px; gap: 12px; }
        .hero-logos img { height: 30px; }
        .hero-logos img + img { padding-left: 12px; }
    }
    @media (max-width: 380px) {
        .hero-logos img { height: 24px; }
    }

    /* ==========================================================
       ANIMASI ALA LAYANAN FASILITAS (GLOBAL HALAMAN PUBLIK)
       ========================================================== */
    @keyframes animInUp {
        from { opacity: 0; transform: translateY(32px) scale(0.985); }
        to   { opacity: 1; transform: none; }
    }
    @keyframes animInLeft {
        from { opacity: 0; transform: translateX(-28px); }
        to   { opacity: 1; transform: none; }
    }
    @keyframes animSubIn {
        from { opacity: 0; transform: translateX(-14px); }
        to   { opacity: 1; transform: none; }
    }

    /* Tab Navigasi Atas */
    .page-nav-wrap .page-nav,
    .tabs-wrap .tabs {
        animation: animInUp .75s cubic-bezier(.16, 1, .3, 1) .08s both;
    }

    /* Baris Ringkasan / Facts (Staggered animInUp + Hover Lift) */
    .facts > .fact:not([data-anim]) {
        animation: animInUp .75s cubic-bezier(.16, 1, .3, 1) both;
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }
    .facts > .fact:not([data-anim]):nth-child(1) { animation-delay: .05s; }
    .facts > .fact:not([data-anim]):nth-child(2) { animation-delay: .15s; }
    .facts > .fact:not([data-anim]):nth-child(3) { animation-delay: .25s; }
    .facts > .fact:not([data-anim]):nth-child(n+4) { animation-delay: .35s; }
    .fact {
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }
    .fact:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px -10px rgba(13, 27, 42, 0.12);
        border-color: #cbd5e1;
    }

    /* Kolom Kiri / Sidebar Kategori (animInLeft) */
    .side-card:not([data-anim]),
    .cat-panel:not([data-anim]) {
        animation: animInLeft .7s cubic-bezier(.16, 1, .3, 1) .15s both;
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }
    .info-stack > .side-card:not([data-anim]):nth-of-type(2) {
        animation-delay: .30s;
    }
    .side-card:hover,
    .cat-panel:hover {
        box-shadow: 0 14px 30px rgba(13, 27, 42, 0.06);
    }

    /* Poin Checklist & Kategori di Sidebar (Staggered animInUp) */
    .checklist > li:not([data-anim]),
    .cat-panel .cat:not([data-anim]) {
        animation: animInUp .75s cubic-bezier(.16, 1, .3, 1) both;
    }
    .checklist > li:not([data-anim]):nth-child(1),
    .cat-panel .cat:not([data-anim]):nth-of-type(1) { animation-delay: .22s; }
    .checklist > li:not([data-anim]):nth-child(2),
    .cat-panel .cat:not([data-anim]):nth-of-type(2) { animation-delay: .32s; }
    .checklist > li:not([data-anim]):nth-child(3),
    .cat-panel .cat:not([data-anim]):nth-of-type(3) { animation-delay: .42s; }
    .checklist > li:not([data-anim]):nth-child(n+4),
    .cat-panel .cat:not([data-anim]):nth-of-type(n+4) { animation-delay: .52s; }

    /* Sub-item Administrasi, Daftar Dokumen & Sub-menu (Staggered animSubIn + Hover Slide) */
    .admin-sublist li:not([data-anim]),
    .checklist ul li:not([data-anim]),
    .doc-row:not([data-anim]) {
        animation: animSubIn .55s cubic-bezier(.16, 1, .3, 1) both;
        transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
    }
    .admin-sublist li:not([data-anim]):nth-child(1),
    .checklist ul li:not([data-anim]):nth-child(1),
    .doc-row:not([data-anim]):nth-child(1) { animation-delay: .28s; }
    .admin-sublist li:not([data-anim]):nth-child(2),
    .checklist ul li:not([data-anim]):nth-child(2),
    .doc-row:not([data-anim]):nth-child(2) { animation-delay: .34s; }
    .admin-sublist li:not([data-anim]):nth-child(3),
    .checklist ul li:not([data-anim]):nth-child(3),
    .doc-row:not([data-anim]):nth-child(3) { animation-delay: .40s; }
    .admin-sublist li:not([data-anim]):nth-child(4),
    .checklist ul li:not([data-anim]):nth-child(4),
    .doc-row:not([data-anim]):nth-child(4) { animation-delay: .46s; }
    .admin-sublist li:not([data-anim]):nth-child(5),
    .checklist ul li:not([data-anim]):nth-child(5),
    .doc-row:not([data-anim]):nth-child(5) { animation-delay: .52s; }
    .admin-sublist li:not([data-anim]):nth-child(n+6),
    .checklist ul li:not([data-anim]):nth-child(n+6),
    .doc-row:not([data-anim]):nth-child(n+6) { animation-delay: .58s; }

    .admin-sublist li:hover,
    .doc-row:hover {
        transform: translateX(4px);
        border-color: var(--signal, #e5392d);
        box-shadow: 0 4px 12px rgba(229, 57, 45, 0.08);
    }

    /* Container / Panel Utama Kanan (animInUp) */
    .form-panel:not([data-anim]),
    .panel-card:not([data-anim]),
    .doc-panel:not([data-anim]),
    .data-panel:not([data-anim]),
    .page-body .container:not([data-anim]),
    .page-body > .wrap > section:not([data-anim]),
    .page-body > .wrap > article:not([data-anim]),
    .page-body > .wrap > .card:not([data-anim]) {
        animation: animInUp .75s cubic-bezier(.16, 1, .3, 1) .20s both;
    }

    /* Judul Bagian / Header di Dalam Container (animInLeft) */
    .fs:not([data-anim]) > legend,
    .doc-bar:not([data-anim]),
    .panel-head:not([data-anim]),
    .dp-head:not([data-anim]),
    .card-head:not([data-anim]),
    .sop-categories-nav:not([data-anim]) {
        animation: animInLeft .55s cubic-bezier(.16, 1, .3, 1) .22s both;
    }

    /* Setiap Kolom Input / Kartu / Baris di Dalam Container (Staggered animInUp) */
    .fs:not([data-anim]) .field,
    .upload-grid > .upload-card:not([data-anim]),
    .media-grid > .media-card:not([data-anim]),
    .dp-grid > .dp-card:not([data-anim]),
    .tbl-wrap tbody tr:not([data-anim]),
    .pos-info:not([data-anim]) {
        animation: animInUp .65s cubic-bezier(.16, 1, .3, 1) both;
    }
    .fs:not([data-anim]) .field:nth-child(1),
    .upload-grid > .upload-card:not([data-anim]):nth-child(1),
    .media-grid > .media-card:not([data-anim]):nth-child(1),
    .dp-grid > .dp-card:not([data-anim]):nth-child(1),
    .tbl-wrap tbody tr:not([data-anim]):nth-child(1) { animation-delay: .10s; }
    .fs:not([data-anim]) .field:nth-child(2),
    .upload-grid > .upload-card:not([data-anim]):nth-child(2),
    .media-grid > .media-card:not([data-anim]):nth-child(2),
    .dp-grid > .dp-card:not([data-anim]):nth-child(2),
    .tbl-wrap tbody tr:not([data-anim]):nth-child(2) { animation-delay: .17s; }
    .fs:not([data-anim]) .field:nth-child(3),
    .upload-grid > .upload-card:not([data-anim]):nth-child(3),
    .media-grid > .media-card:not([data-anim]):nth-child(3),
    .dp-grid > .dp-card:not([data-anim]):nth-child(3),
    .tbl-wrap tbody tr:not([data-anim]):nth-child(3) { animation-delay: .24s; }
    .fs:not([data-anim]) .field:nth-child(4),
    .upload-grid > .upload-card:not([data-anim]):nth-child(4),
    .media-grid > .media-card:not([data-anim]):nth-child(4),
    .dp-grid > .dp-card:not([data-anim]):nth-child(4),
    .tbl-wrap tbody tr:not([data-anim]):nth-child(4) { animation-delay: .31s; }
    .fs:not([data-anim]) .field:nth-child(5),
    .upload-grid > .upload-card:not([data-anim]):nth-child(5),
    .media-grid > .media-card:not([data-anim]):nth-child(5),
    .dp-grid > .dp-card:not([data-anim]):nth-child(5),
    .tbl-wrap tbody tr:not([data-anim]):nth-child(5) { animation-delay: .38s; }
    .fs:not([data-anim]) .field:nth-child(6),
    .upload-grid > .upload-card:not([data-anim]):nth-child(6),
    .media-grid > .media-card:not([data-anim]):nth-child(6),
    .dp-grid > .dp-card:not([data-anim]):nth-child(6),
    .tbl-wrap tbody tr:not([data-anim]):nth-child(6) { animation-delay: .45s; }
    .fs:not([data-anim]) .field:nth-child(n+7),
    .upload-grid > .upload-card:not([data-anim]):nth-child(n+7),
    .media-grid > .media-card:not([data-anim]):nth-child(n+7),
    .dp-grid > .dp-card:not([data-anim]):nth-child(n+7),
    .tbl-wrap tbody tr:not([data-anim]):nth-child(n+7) { animation-delay: .52s; }

    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            animation: none !important;
            transition: none !important;
        }
    }
</style>
@endonce

@if ($float)<div class="hero-logos-layer">@endif
    <div class="hero-logos" role="group" aria-label="Logo program Pemerintah Kota Jambi">
        <img src="{{ asset('images/bangga-melayani-bangsa.png') }}" alt="Bangga Melayani Bangsa" decoding="async">
        <img src="{{ asset('images/berakhlak.png') }}" alt="BerAKHLAK" decoding="async">
        <img src="{{ asset('images/jambibahagia.png') }}" alt="Kota Jambi Bahagia" decoding="async">
    </div>
@if ($float)</div>@endif
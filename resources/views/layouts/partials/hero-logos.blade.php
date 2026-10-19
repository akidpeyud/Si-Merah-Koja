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
</style>
@endonce

@if ($float)<div class="hero-logos-layer">@endif
    <div class="hero-logos" role="group" aria-label="Logo program Pemerintah Kota Jambi">
        <img src="{{ asset('images/bangga-melayani-bangsa.png') }}" alt="Bangga Melayani Bangsa" decoding="async">
        <img src="{{ asset('images/berakhlak.png') }}" alt="BerAKHLAK" decoding="async">
        <img src="{{ asset('images/jambibahagia.png') }}" alt="Kota Jambi Bahagia" decoding="async">
    </div>
@if ($float)</div>@endif
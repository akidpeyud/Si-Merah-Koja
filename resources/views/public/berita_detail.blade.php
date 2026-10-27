<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <meta name="description" content="Detail Berita dan Laporan Kejadian - SIMERAH KOJA Dinas Pemadam Kebakaran Kota Jambi.">
    <title>{{ $berita->judul }} - SIMERAH KOJA</title>

    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @include('layouts.partials.public-styles')

    <style>
        /* ================= HERO ================= */
        .page-hero{
            position:relative;isolation:isolate;overflow:hidden;color:#fff;
            padding:54px 0 110px;
            background:#0b1826;
        }
        .page-hero::before{
            content:"";position:absolute;inset:0;z-index:-2;
            background:
                linear-gradient(105deg,rgba(7,20,33,.97) 0%,rgba(8,24,39,.88) 45%,rgba(8,24,39,.62) 100%),
                url('/images/background1.jpg') center/cover no-repeat;
        }
        .page-hero::after{
            content:"";position:absolute;z-index:-1;inset:auto -10% -50% -10%;height:280px;
            background:radial-gradient(ellipse at center,rgba(229,57,45,.38),transparent 66%);
            pointer-events:none;
        }
        .crumbs{
            display:flex;flex-wrap:wrap;align-items:center;gap:9px;
            color:rgba(255,255,255,.66);font-size:.83rem;margin-bottom:24px
        }
        .crumbs li{display:inline-flex;align-items:center;gap:9px}
        .crumbs li+li::before{content:"/";opacity:.38}
        .crumbs a:hover{color:#fff}
        .crumbs [aria-current=page]{color:#fff;font-weight:700}

        .hero-kicker{
            display:inline-flex;align-items:center;gap:9px;
            padding:7px 11px;border:1px solid rgba(255,255,255,.14);
            border-radius:999px;background:rgba(255,255,255,.07);
            color:rgba(255,255,255,.82);font-size:.74rem;font-weight:700;
            text-transform:uppercase;letter-spacing:.08em;margin-bottom:16px
        }
        .hero-kicker i{color:#ff5a4d}
        .page-hero h1{
            font-family:var(--font-display, var(--display));font-weight:800;
            font-size:clamp(2.5rem,6vw,4.5rem);line-height:.95;
            letter-spacing:-.045em;max-width:760px
        }
        .hero-line{
            width:70px;height:4px;border-radius:99px;
            margin-top:25px;background:var(--signal)
        }

        .rise{animation:rise .75s cubic-bezier(.16,.84,.3,1) both}
        .rise.d1{animation-delay:.08s}.rise.d2{animation-delay:.16s}.rise.d3{animation-delay:.24s}
        @keyframes rise{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:none}}

        /* ================= ARTICLE CONTENT ================= */
        .page-body{background:var(--paper);min-height:50vh;padding-bottom:95px}
        
        .article-wrap {
            max-width: 900px;
            margin: -60px auto 0;
            background: #fff;
            border-radius: 24px;
            padding: 50px 60px;
            box-shadow: 0 18px 45px rgba(13,27,42,.09);
            position: relative;
            z-index: 10;
            border: 1px solid rgba(224,230,237,.95);
        }

        .btn-back {
            display: inline-flex; align-items: center; gap: 8px; 
            color: var(--steel); font-weight: 600; font-size: 0.95rem; 
            transition: all 0.2s ease; margin-bottom: 25px;
        }
        .btn-back:hover { color: var(--signal); transform: translateX(-4px); }

        .article-title {
            font-family: var(--font-display, var(--display));
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 800;
            color: var(--ink);
            line-height: 1.2;
            letter-spacing: -0.02em;
            margin-bottom: 24px;
        }

        .article-meta {
            display: flex; flex-wrap: wrap; gap: 12px;
            padding-bottom: 30px; margin-bottom: 35px;
            border-bottom: 1px solid var(--line);
        }
        .meta-pill {
            display: inline-flex; align-items: center; gap: 8px;
            background-color: var(--paper, #f4f6f9); color: var(--ink-2);
            padding: 8px 16px; border-radius: 50px;
            font-size: 0.85rem; font-weight: 600; border: 1px solid var(--line);
        }
        .meta-pill i { color: var(--signal); }

        .article-image-wrapper {
            width: 100%; border-radius: 18px; overflow: hidden; margin-bottom: 40px;
            background-color: var(--paper, #f4f6f9);
        }
        .article-image {
            width: 100%; max-height: 550px; object-fit: cover; display: block;
        }
        .no-image-placeholder {
            height: 250px; display: flex; flex-direction: column; align-items: center;
            justify-content: center; color: var(--steel); gap: 15px; font-weight: 600;
        }
        .no-image-placeholder i { font-size: 3rem; color: #cbd5e1;}

        .article-content-body {
            font-family: var(--font-body, var(--body));
            font-size: 1.08rem;
            line-height: 1.85;
            color: var(--ink-2);
            text-align: justify;
        }
        .article-content-body p { margin-bottom: 1.6em; }

        .article-footer {
            margin-top: 50px; padding-top: 25px; border-top: 1px solid var(--line);
            font-size: 0.9rem; color: var(--steel);
        }
        .article-footer p { margin-bottom: 5px; }
        .article-footer strong { color: var(--ink); font-weight: 700; }

        @media (max-width:768px){
            .article-wrap { padding: 30px 20px; margin-top: -40px; border-radius: 16px; }
            .page-hero h1 { font-size: clamp(2rem, 8vw, 3rem); }
        }
    </style>
</head>
<body>

@include('layouts.partials.public-header')

<main>

<!-- ==================== HERO HALAMAN ==================== -->
<section class="page-hero">
    <div class="wrap">
        <nav aria-label="Breadcrumb" class="rise">
            <ol class="crumbs">
                <li><a href="/">Beranda</a></li>
                <li><a href="{{ route('publik.kejadian') }}">Galeri Kejadian</a></li>
                <li><span aria-current="page">{{ Str::limit($berita->judul, 30) }}</span></li>
            </ol>
        </nav>
        <div class="hero-kicker rise"><i class="fas fa-newspaper"></i> Laporan Kejadian & Berita</div>
        <h1 class="rise d1">Detail Berita</h1>
        <div class="hero-line rise d3"></div>
    </div>
    @include('layouts.partials.hero-logos', ['float' => true])
</section>

<!-- ==================== BODY & KONTEN ==================== -->
<div class="page-body">
    <div class="wrap">
        <div class="article-wrap">
            
            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('publik.kejadian') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>

            <h1 class="article-title">{{ $berita->judul }}</h1>
            
            <div class="article-meta">
                <div class="meta-pill" title="Waktu Kejadian">
                    <i class="far fa-calendar-check"></i> 
                    {{ \Carbon\Carbon::parse($berita->tanggal_kejadian)->translatedFormat('d F Y') }}
                </div>
                <div class="meta-pill" title="Jam Kejadian">
                    <i class="far fa-clock"></i> 
                    {{ \Carbon\Carbon::parse($berita->waktu_kejadian)->format('H:i') }} WIB
                </div>
                <div class="meta-pill" title="Lokasi Kejadian">
                    <i class="fas fa-map-marker-alt"></i> 
                    {{ $berita->lokasi }}
                </div>
            </div>

            <div class="article-image-wrapper">
                @if($berita->gambar)
                    <img src="{{ Str::startsWith($berita->gambar, ['http://', 'https://']) ? $berita->gambar : asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="article-image">
                @else
                    <div class="no-image-placeholder">
                        <i class="fas fa-image"></i>
                        <span>Belum Ada Foto Dokumentasi</span>
                    </div>
                @endif
            </div>

            <div class="article-content-body">
                {!! nl2br(e($berita->detail_lengkap)) !!}
            </div>

            <div class="article-footer">
                @if(!empty($berita->sumber_informasi))
                    <p>Sumber Laporan: <strong>{{ $berita->sumber_informasi }}</strong></p>
                @endif
                @if(!empty($berita->pelapor))
                    <p>Dilaporkan Oleh: <strong>{{ $berita->pelapor }}</strong></p>
                @endif
            </div>

        </div>
    </div>
</div>

</main>

@include('layouts.partials.public-footer')
@include('layouts.partials.public-scripts')

</body>
</html>
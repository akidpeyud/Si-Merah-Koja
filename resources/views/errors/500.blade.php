<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>500 - Terjadi Gangguan Sistem | SIMERAH KOJA</title>

    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --ink: #0d1b2a;
            --ink-2: #132a43;
            --signal: #e5392d;
            --signal-d: #c22b20;
            --amber: #ffb627;
            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: var(--font-body);
            background: var(--ink);
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-x: hidden;
            position: relative;
            isolation: isolate;
        }
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: -1;
            background:
                radial-gradient(60% 60% at 50% 50%, rgba(229,57,45,.28), transparent 75%),
                linear-gradient(135deg, rgba(13,27,42,.98) 0%, rgba(19,42,67,.92) 100%),
                url('/images/background1.png') center / cover no-repeat;
        }
        header {
            padding: 24px 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid rgba(255,255,255,.08);
            backdrop-filter: blur(10px);
        }
        header img { height: 40px; width: auto; }
        .error-container {
            max-width: 680px;
            margin: auto;
            padding: 40px 24px;
            text-align: center;
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
            line-height: 1.6;
        }
        .error-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 14px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            height: 48px;
            padding: 0 24px;
            border-radius: 999px;
            font-size: .95rem;
            font-weight: 600;
            text-decoration: none;
            transition: transform .2s, background .2s, color .2s, border-color .2s;
        }
        .btn:active { transform: scale(.97); }
        .btn-primary { background: var(--signal); color: #fff; }
        .btn-primary:hover { background: var(--signal-d); transform: translateY(-2px); }
        .btn-ghost { border: 1.5px solid rgba(255,255,255,.3); color: #fff; }
        .btn-ghost:hover { border-color: #fff; background: rgba(255,255,255,.08); transform: translateY(-2px); }
        footer {
            padding: 20px;
            text-align: center;
            font-size: .85rem;
            color: rgba(255,255,255,.5);
            border-top: 1px solid rgba(255,255,255,.08);
        }
    </style>
</head>
<body>
    <header>
        <a href="/">
            <img src="/images/simerahkoja.png" alt="Logo SIMERAH KOJA">
        </a>
    </header>

    <main class="error-container">
        <div class="error-code">500</div>
        <div class="error-tag">
            <i class="fas fa-server"></i> Terjadi Gangguan Server
        </div>
        <h1 class="error-title">Sistem Sedang Dalam Penanganan</h1>
        <p class="error-desc">
            Terjadi kendala teknis internal pada server. Tim kami sedang menindaklanjuti hal ini. Silakan coba memuat ulang beberapa saat lagi.
        </p>
        <div class="error-actions">
            <a href="/" class="btn btn-primary">
                <i class="fas fa-house"></i> Kembali ke Beranda
            </a>
            <a href="tel:112" class="btn btn-ghost">
                <i class="fas fa-headset"></i> Panggilan Darurat 112
            </a>
        </div>
    </main>

    <footer>
        SIMERAH KOJA &copy; {{ date('Y') }} Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.
    </footer>
</body>
</html>

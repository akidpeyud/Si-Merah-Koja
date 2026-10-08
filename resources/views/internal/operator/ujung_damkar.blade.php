<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Kelola Ujung-Ujung Damkar | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
/* ==========================================================
   SIMERAH KOJA - CLEAN NAVY DASHBOARD
   ========================================================== */

/* ==========================================================
   1. DESIGN TOKENS
   ========================================================== */

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
    --signal-dark: #b42332;
    --signal-soft: rgba(220, 53, 69, .09);

    --amber: #f4b740;
    --success: #198754;
    --info: #2563eb;
    --info-soft: rgba(37, 99, 235, .09);

    --steel: #64748b;
    --steel-soft: #94a3b8;

    --line: #e2e8f0;
    --line-dark: #d5dce6;

    --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
    --font-body: 'Instrument Sans', system-ui, sans-serif;

    --r-lg: 18px;
    --r-md: 14px;
    --r-sm: 10px;

    --sidebar-w: 272px;
    --topbar-h: 70px;

    --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
    --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
    --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
    --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);
}


/* ==========================================================
   2. RESET
   ========================================================== */

*,
*::before,
*::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

html {
    scroll-behavior: smooth;
}

body {
    font-family: var(--font-body);
    font-size: 1rem;
    line-height: 1.6;
    color: var(--ink);
    background: var(--paper);
    -webkit-font-smoothing: antialiased;
}

img {
    max-width: 100%;
    display: block;
}

a {
    color: inherit;
    text-decoration: none;
}

ul,
ol {
    list-style: none;
    margin: 0;
    padding: 0;
}

button {
    font: inherit;
    color: inherit;
    background: none;
    border: 0;
    cursor: pointer;
}

:focus-visible {
    outline: 3px solid var(--amber);
    outline-offset: 2px;
    border-radius: 6px;
}


/* ==========================================================
   3. TOAST / NOTIFICATION
   ========================================================== */

.toast-wrap {
    position: fixed;
    z-index: 1090;
    top: 18px;
    left: 50%;
    transform: translateX(-50%);
    display: grid;
    gap: 10px;
    width: max-content;
    max-width: calc(100vw - 24px);
}

.toast-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 12px 12px 16px;
    border-radius: 999px;
    background: #ffffff;
    border: 1px solid var(--line);
    box-shadow: var(--shadow-md);
    font-weight: 600;
    font-size: .92rem;
    animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both;
}

.toast-item.leaving {
    animation: toastOut .3s ease forwards;
}

.toast-ico {
    flex: none;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    color: #fff;
    font-size: .78rem;
}

.toast-item.ok .toast-ico {
    background: var(--success);
}

.toast-item.err .toast-ico {
    background: var(--signal);
}

.toast-x {
    flex: none;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    background: var(--paper);
    transition: background .2s, color .2s;
}

.toast-x:hover {
    background: var(--ink);
    color: #fff;
}

@keyframes toastIn {
    from {
        opacity: 0;
        transform: translateY(-14px);
    }
    to {
        opacity: 1;
        transform: none;
    }
}

@keyframes toastOut {
    from {
        opacity: 1;
        transform: none;
    }
    to {
        opacity: 0;
        transform: translateY(-14px);
    }
}


/* ==========================================================
   4. TOPBAR
   ========================================================== */

.topbar {
    position: sticky;
    top: 0;
    z-index: 60;
    height: var(--topbar-h);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 0 28px;
    background: var(--ink);
    border-bottom: 1px solid rgba(255,255,255,.08);
    box-shadow: 0 2px 12px rgba(13, 27, 42, .16);
}

.topbar-left {
    display: flex;
    align-items: center;
    gap: 14px;
    min-width: 0;
}

.side-toggle {
    display: none;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    align-items: center;
    justify-content: center;
    font-size: 1.05rem;
    color: #fff;
    transition: background .2s, transform .2s;
}

.side-toggle:hover {
    background: rgba(255,255,255,.10);
}

.side-toggle:active {
    transform: scale(.95);
}

.brand {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
    color: #fff;
}

.brand img {
    height: 34px;
    width: auto;
    flex: none;
}

.brand span {
    font-family: var(--font-display);
    font-weight: 700;
    font-size: 1.08rem;
    letter-spacing: -.01em;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #fff;
}

.topbar-right {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-chip {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 5px 14px 5px 5px;
    border-radius: 999px;
    background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.12);
    transition: background .2s, border-color .2s;
}

.user-chip:hover {
    background: rgba(255,255,255,.12);
    border-color: rgba(255,255,255,.18);
}

.user-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #ffffff;
    color: var(--ink);
    display: grid;
    place-items: center;
    font-family: var(--font-display);
    font-weight: 700;
    font-size: .9rem;
    flex: none;
}

.user-meta {
    display: grid;
    line-height: 1.25;
}

.user-meta strong {
    font-size: .84rem;
    font-weight: 700;
    max-width: 160px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: #ffffff;
}

.user-meta small {
    font-size: .72rem;
    color: rgba(255,255,255,.62);
    text-transform: capitalize;
    font-weight: 500;
}

.btn-logout {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    height: 40px;
    padding: 0 17px;
    border-radius: 999px;
    background: #ffffff;
    color: var(--ink);
    font-weight: 600;
    font-size: .84rem;
    border: none;
    transition: background .2s, color .2s, transform .1s, box-shadow .2s;
}

.btn-logout:hover {
    background: #e8eef5;
    color: var(--ink);
    box-shadow: 0 4px 10px rgba(0,0,0,.12);
}

.btn-logout:active {
    transform: scale(.97);
}


/* ==========================================================
   5. MAIN SHELL & SIDEBAR
   ========================================================== */

.shell {
    display: flex;
    align-items: flex-start;
    min-height: calc(100vh - var(--topbar-h));
}

.sidebar {
    width: var(--sidebar-w);
    flex: none;
    position: sticky;
    top: var(--topbar-h);
    height: calc(100vh - var(--topbar-h));
    overflow-y: auto;
    background: #ffffff;
    border-right: 1px solid var(--line);
    padding: 20px 14px 32px;
    scrollbar-width: thin;
    scrollbar-color: #d8dee8 transparent;
}

.sidebar::-webkit-scrollbar {
    width: 6px;
}

.sidebar::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar::-webkit-scrollbar-thumb {
    background-color: #d8dee8;
    border-radius: 20px;
}

.side-link {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 11px 14px;
    border-radius: var(--r-sm);
    font-size: .89rem;
    font-weight: 600;
    color: var(--ink);
    transition: background .2s, color .2s, transform .2s;
    margin-bottom: 4px;
}

.side-link:hover {
    background: #f3f6fa;
    color: var(--ink);
    transform: translateX(1px);
}

.side-link.active {
    background: var(--ink);
    color: #ffffff;
    box-shadow: 0 4px 10px rgba(13,27,42,.10);
}

.side-link i {
    width: 20px;
    text-align: center;
    font-size: 1rem;
    color: var(--steel);
    transition: color .2s;
}

.side-link:hover i {
    color: var(--ink);
}

.side-link.active i {
    color: #ffffff;
}

.side-group + .side-group {
    margin-top: 6px;
}

.side-group summary {
    list-style: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px 14px;
    border-radius: var(--r-sm);
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .04em;
    text-transform: uppercase;
    color: var(--navy);
    transition: background .2s, color .2s;
    user-select: none;
}

.side-group summary::-webkit-details-marker {
    display: none;
}

.side-group summary:hover {
    background: #f3f6fa;
}

.side-group summary .grp-ico {
    flex: none;
    width: 20px;
    text-align: center;
    font-size: .95rem;
    color: var(--navy);
}

.side-group summary .grp-label {
    flex: 1 1 auto;
    min-width: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.side-group summary .chev {
    flex: none;
    font-size: .7rem;
    transition: transform .25s ease;
}

.side-group[open] summary .chev {
    transform: rotate(180deg);
}

.side-sub {
    display: grid;
    gap: 3px;
    padding: 6px 4px 10px 12px;
    border-left: 2px solid var(--line);
    margin: 2px 0 8px 22px;
}

.side-sub a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 9px 12px;
    border-radius: var(--r-sm);
    font-size: .84rem;
    font-weight: 500;
    line-height: 1.4;
    color: var(--steel);
    transition: background .2s, color .2s, transform .2s;
}

.side-sub a:hover {
    background: var(--navy-light);
    color: var(--navy-dark);
    transform: translateX(2px);
}

.side-sub a.active {
    background: var(--navy-soft);
    color: var(--navy);
    font-weight: 600;
}

.side-sub a i {
    width: 18px;
    text-align: center;
    font-size: .88rem;
    opacity: .75;
}

.side-sub a:hover i,
.side-sub a.active i {
    opacity: 1;
}

.side-kicker {
    padding: 18px 14px 6px;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: var(--steel-soft);
}

.sidebar-backdrop {
    display: none;
}

@media (max-width: 900px) {
    .side-toggle {
        display: inline-flex;
    }

    .user-meta {
        display: none;
    }

    .sidebar {
        position: fixed;
        z-index: 90;
        top: var(--topbar-h);
        left: 0;
        height: calc(100dvh - var(--topbar-h));
        transform: translateX(-100%);
        transition: transform .3s cubic-bezier(.4,0,.2,1);
        box-shadow: var(--shadow-lg);
    }

    body.side-open .sidebar {
        transform: none;
    }

    .sidebar-backdrop {
        display: block;
        position: fixed;
        inset: var(--topbar-h) 0 0 0;
        z-index: 80;
        background: rgba(13,27,42,.45);
        opacity: 0;
        pointer-events: none;
        transition: opacity .3s;
    }

    body.side-open .sidebar-backdrop {
        opacity: 1;
        pointer-events: auto;
    }
}


/* ==========================================================
   6. MAIN CONTENT & PAGE HEADER
   ========================================================== */

.content {
    flex: 1;
    min-width: 0;
    padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px;
}

.page-head-bar {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    justify-content: space-between;
    gap: 18px;
    margin-bottom: 28px;
}

.page-head h1 {
    font-family: var(--font-display);
    font-weight: 700;
    font-size: clamp(1.6rem, 3vw, 2.1rem);
    line-height: 1.2;
    letter-spacing: -.02em;
    margin-bottom: 5px;
    color: var(--ink);
}

.page-head p {
    color: var(--steel);
    font-size: .95rem;
    margin: 0;
}

.section-heading {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 18px;
    flex-wrap: nowrap;
}

.section-heading-ico {
    flex: none;
    width: 32px;
    height: 32px;
    border-radius: 9px;
    background: var(--navy);
    color: #fff;
    display: grid;
    place-items: center;
    font-size: .78rem;
    box-shadow: 0 4px 8px rgba(22,58,99,.12);
}

.section-heading h3 {
    flex: none;
    font-family: var(--font-display);
    font-weight: 700;
    font-size: 1rem;
    color: var(--ink);
    letter-spacing: -.01em;
    white-space: nowrap;
    margin: 0;
}

.section-heading .line {
    flex: 1 1 auto;
    min-width: 24px;
    height: 1px;
    background: linear-gradient(to right, var(--line), transparent 90%);
}

.count-pill {
    flex: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 12px;
    border-radius: 999px;
    background: var(--navy-soft);
    color: var(--navy);
    font-size: .78rem;
    font-weight: 700;
}


/* ==========================================================
   7. BUTTONS, CARD BOX & TABLE (UJUNG-UJUNG DAMKAR)
   ========================================================== */

.btn-simerah-danger {
    background: var(--signal);
    color: #ffffff;
    font-weight: 600;
    font-size: .9rem;
    border-radius: var(--r-sm);
    padding: 11px 20px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    border: none;
    box-shadow: 0 4px 12px rgba(220, 53, 69, .22);
    transition: background .2s, transform .15s, box-shadow .2s;
}

.btn-simerah-danger:hover {
    background: var(--signal-dark);
    color: #ffffff;
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(220, 53, 69, .28);
}

.btn-simerah-danger:active {
    transform: translateY(0);
}

.btn-simerah-secondary {
    background: var(--paper);
    color: var(--ink);
    font-weight: 600;
    font-size: .88rem;
    border-radius: var(--r-sm);
    padding: 10px 18px;
    border: 1px solid var(--line-dark);
    transition: background .2s, border-color .2s;
}

.btn-simerah-secondary:hover {
    background: var(--line);
}

.card-box {
    background: #ffffff;
    border-radius: var(--r-md);
    border: 1px solid var(--line);
    box-shadow: var(--shadow-xs);
    overflow: hidden;
}

.table-simerah {
    margin-bottom: 0;
}

.table-simerah thead th {
    font-family: var(--font-display);
    font-size: .76rem;
    text-transform: uppercase;
    letter-spacing: .05em;
    font-weight: 700;
    color: var(--steel);
    background-color: #f8fafc;
    border-bottom: 1px solid var(--line);
    padding: 15px 20px;
    white-space: nowrap;
}

.table-simerah tbody td {
    padding: 16px 20px;
    border-bottom: 1px solid var(--line);
    vertical-align: middle;
}

.table-simerah tbody tr:last-child td {
    border-bottom: none;
}

.table-simerah tbody tr {
    transition: background-color .15s ease;
}

.table-simerah tbody tr:hover {
    background-color: #f9fbfd;
}

.row-num {
    display: inline-grid;
    place-items: center;
    width: 30px;
    height: 30px;
    border-radius: 8px;
    background: var(--paper);
    color: var(--steel);
    font-family: var(--font-display);
    font-weight: 700;
    font-size: .84rem;
}

.yt-thumb-link {
    position: relative;
    display: block;
    width: 148px;
    aspect-ratio: 16 / 9;
    border-radius: var(--r-sm);
    overflow: hidden;
    border: 1px solid var(--line);
    background: var(--ink);
    box-shadow: var(--shadow-xs);
}

.yt-thumb-link img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .3s ease, opacity .3s ease;
}

.yt-thumb-play {
    position: absolute;
    inset: 0;
    display: grid;
    place-items: center;
    background: rgba(13, 27, 42, .35);
    color: #ffffff;
    font-size: 1.35rem;
    opacity: 0;
    transition: opacity .25s ease;
}

.yt-thumb-link:hover img {
    transform: scale(1.05);
    opacity: .88;
}

.yt-thumb-link:hover .yt-thumb-play {
    opacity: 1;
}

.video-title {
    font-family: var(--font-display);
    font-weight: 700;
    font-size: .98rem;
    color: var(--ink);
    margin-bottom: 6px;
    line-height: 1.35;
}

.video-meta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
}

.yt-watch-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: .82rem;
    font-weight: 600;
    color: var(--signal);
    padding: 4px 10px;
    border-radius: 6px;
    background: var(--signal-soft);
    transition: background .2s, color .2s;
}

.yt-watch-link:hover {
    background: var(--signal);
    color: #ffffff;
}

.yt-id-code {
    font-size: .76rem;
    font-weight: 600;
    color: var(--steel);
    background: var(--paper);
    border: 1px solid var(--line);
    padding: 3px 8px;
    border-radius: 6px;
}

.btn-delete-item {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 8px 14px;
    border-radius: var(--r-sm);
    font-size: .82rem;
    font-weight: 600;
    color: var(--signal-dark);
    background: var(--signal-soft);
    border: 1px solid transparent;
    transition: background .2s, color .2s, border-color .2s;
}

.btn-delete-item:hover {
    background: var(--signal);
    color: #ffffff;
}

/* Empty State */
.empty-state {
    padding: 48px 24px;
    text-align: center;
}

.empty-ico {
    width: 56px;
    height: 56px;
    border-radius: 16px;
    background: var(--signal-soft);
    color: var(--signal);
    display: grid;
    place-items: center;
    font-size: 1.5rem;
    margin: 0 auto 14px;
}

.empty-state h4 {
    font-family: var(--font-display);
    font-weight: 700;
    font-size: 1.05rem;
    color: var(--ink);
    margin-bottom: 6px;
}

.empty-state p {
    color: var(--steel);
    font-size: .88rem;
    max-width: 40ch;
    margin: 0 auto 18px;
}


/* ==========================================================
   8. MODAL & FORM STYLING
   ========================================================== */

.modal-content {
    border-radius: var(--r-lg);
    border: 1px solid var(--line);
    box-shadow: var(--shadow-lg);
    overflow: hidden;
}

.modal-header {
    background: var(--ink);
    color: #ffffff;
    border-bottom: 1px solid rgba(255,255,255,.08);
    padding: 18px 24px;
}

.modal-title {
    font-family: var(--font-display);
    font-weight: 700;
    font-size: 1.02rem;
    color: #ffffff;
    display: flex;
    align-items: center;
    gap: 10px;
}

.modal-header .btn-close {
    filter: invert(1) grayscale(100%) brightness(200%);
    opacity: .75;
}

.modal-header .btn-close:hover {
    opacity: 1;
}

.modal-body {
    padding: 24px;
}

.modal-footer {
    background: #f8fafc;
    border-top: 1px solid var(--line);
    padding: 14px 24px;
}

.form-label {
    font-size: .84rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 6px;
}

.form-control {
    border-radius: var(--r-sm);
    border: 1px solid var(--line-dark);
    padding: 10px 14px;
    font-size: .92rem;
    color: var(--ink);
    transition: border-color .2s, box-shadow .2s;
}

.form-control:focus {
    border-color: var(--navy);
    box-shadow: 0 0 0 3px var(--navy-soft);
}

.form-hint {
    display: block;
    font-size: .78rem;
    color: var(--steel);
    margin-top: 6px;
}

.yt-preview-card {
    background: var(--paper);
    border: 1px dashed var(--line-dark);
    border-radius: var(--r-md);
    padding: 14px;
    text-align: center;
}

.yt-preview-card img {
    width: 100%;
    max-width: 280px;
    aspect-ratio: 16 / 9;
    object-fit: cover;
    border-radius: var(--r-sm);
    margin: 0 auto;
    border: 1px solid var(--line);
    box-shadow: var(--shadow-xs);
}


/* ==========================================================
   9. RESPONSIVE TABLET & MOBILE
   ========================================================== */

@media (max-width: 1100px) {
    .topbar {
        padding: 0 20px;
    }

    .content {
        padding: 32px 26px 60px;
    }
}

@media (max-width: 700px) {
    :root {
        --topbar-h: 64px;
    }

    .topbar {
        height: var(--topbar-h);
        padding: 0 14px;
        gap: 10px;
    }

    .brand {
        gap: 9px;
    }

    .brand img {
        height: 30px;
    }

    .brand span {
        font-size: .95rem;
    }

    .topbar-right {
        gap: 7px;
    }

    .user-chip {
        padding: 3px;
        border: none;
        background: transparent;
    }

    .user-avatar {
        width: 34px;
        height: 34px;
    }

    .btn-logout {
        width: 38px;
        height: 38px;
        padding: 0;
        border-radius: 10px;
        font-size: 0;
    }

    .btn-logout i {
        font-size: .9rem;
    }

    .content {
        padding: 26px 16px 50px;
    }

    .page-head-bar {
        align-items: stretch;
        margin-bottom: 22px;
    }

    .page-head h1 {
        font-size: 1.55rem;
    }

    .page-head p {
        font-size: .88rem;
    }

    .btn-simerah-danger.w-mobile-100 {
        width: 100%;
    }

    .yt-thumb-link {
        width: 116px;
    }
}

@media (max-width: 420px) {
    .brand span {
        display: none;
    }

    .content {
        padding-left: 13px;
        padding-right: 13px;
    }

    .section-heading h3 {
        font-size: .86rem;
    }
}

@media (prefers-reduced-motion: reduce) {
    html {
        scroll-behavior: auto;
    }

    *,
    *::before,
    *::after {
        animation: none !important;
        transition: none !important;
    }
}

@media print {
    .topbar {
        position: static;
        background: #ffffff !important;
        color: #000000 !important;
        box-shadow: none;
        border-bottom: 1px solid #ddd;
    }

    .brand span {
        color: #000000 !important;
    }

    .sidebar,
    .btn-logout,
    .btn-simerah-danger,
    .btn-delete-item {
        display: none !important;
    }

    .content {
        padding: 20px;
    }
}
    </style>
</head>
<body>

<!-- ==================== TOAST NOTIFICATION ==================== -->
<div class="toast-wrap" id="toastWrap" aria-live="polite">
    @if(session('success'))
        <div class="toast-item ok" data-toast>
            <span class="toast-ico"><i class="fas fa-check"></i></span>
            <span>{{ session('success') }}</span>
            <button type="button" class="toast-x" aria-label="Tutup notifikasi" data-toast-close><i class="fas fa-times"></i></button>
        </div>
    @endif
    @if(session('error') || $errors->any())
        <div class="toast-item err" data-toast>
            <span class="toast-ico"><i class="fas fa-triangle-exclamation"></i></span>
            <span>{{ session('error') ?? $errors->first() }}</span>
            <button type="button" class="toast-x" aria-label="Tutup notifikasi" data-toast-close><i class="fas fa-times"></i></button>
        </div>
    @endif
</div>

<!-- ==================== TOPBAR ==================== -->
<header class="topbar">
    <div class="topbar-left">
        <button class="side-toggle" type="button" id="sideToggle" aria-label="Buka menu" aria-expanded="false" aria-controls="sidebar">
            <i class="fas fa-bars"></i>
        </button>
        <a href="/internal/index" class="brand">
            <img src="/images/simerahkoja.png" alt="Logo SIMERAH KOJA">
            <span>SIMERAH KOJA</span>
        </a>
    </div>
    <div class="topbar-right">
        <div class="user-chip">
            <span class="user-avatar">{{ strtoupper(substr(Auth::user()->nama_lengkap ?? 'O', 0, 1)) }}</span>
            <div class="user-meta">
                <strong>{{ Auth::user()->nama_lengkap ?? 'Operator Media' }}</strong>
                <small>{{ str_replace('_', ' ', Auth::user()->role ?? '') }}</small>
            </div>
        </div>
        <form action="/logout" method="POST" style="margin:0;">
            @csrf
            <button type="submit" class="btn-logout"><i class="fas fa-arrow-right-from-bracket"></i> Keluar</button>
        </form>
    </div>
</header>

<div class="shell">

    <div class="sidebar-backdrop" id="sideBackdrop"></div>

    <!-- ==================== SIDEBAR ==================== -->
    <aside class="sidebar" id="sidebar" aria-label="Navigasi internal">

        <a href="/internal/index" class="side-link {{ Request::is('internal/index') ? 'active' : '' }}">
            <i class="fas fa-house"></i> Dashboard utama
        </a>

        @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')

            <div class="side-kicker">Modul operasional</div>

            <!-- BAGIAN PENCEGAHAN -->
            <details class="side-group" {{ Request::is('internal/pencegahan*') ? 'open' : '' }}>
                <summary><i class="fas fa-shield-halved grp-ico"></i><span class="grp-label">Bagian pencegahan</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/pencegahan/peningkatan-kapasitas" class="{{ Request::is('internal/pencegahan/peningkatan-kapasitas*') ? 'active' : '' }}">
                        <i class="fas fa-arrow-trend-up"></i> Peningkatan Kapasitas Aparatur
                    </a>
                    <a href="/internal/pencegahan/inspeksi-kebakaran" class="{{ Request::is('internal/pencegahan/inspeksi-kebakaran*') ? 'active' : '' }}">
                        <i class="fas fa-magnifying-glass-chart"></i> Pencegahan Kebakaran dan Inspeksi
                    </a>
                    <a href="/internal/pencegahan/pemberdayaan-masyarakat" class="{{ Request::is('internal/pencegahan/pemberdayaan-masyarakat*') ? 'active' : '' }}">
                        <i class="fas fa-handshake-angle"></i> Pemberdayaan Masyarakat dan Dunia Usaha
                    </a>
                    <a href="/internal/pencegahan/kelola-edukasi" class="{{ Request::is('internal/pencegahan/kelola-edukasi*') ? 'active' : '' }}">
                        <i class="fas fa-bullhorn"></i> Kelola Edukasi
                    </a>
                    <a href="/internal/pencegahan/kelola-redkar" class="{{ Request::is('internal/pencegahan/kelola-redkar*') ? 'active' : '' }}">
                        <i class="fas fa-users-rectangle"></i> Kelola Redkar
                    </a>
                    <a href="/internal/pencegahan/kelola-rpkbgl" class="{{ Request::is('internal/pencegahan/kelola-rpkbgl*') ? 'active' : '' }}">
                        <i class="fas fa-building-circle-check"></i> Kelola RPKBGL
                    </a>
                    <a href="/internal/pencegahan/kelola-skk" class="{{ Request::is('internal/pencegahan/kelola-skk*') ? 'active' : '' }}">
                        <i class="fas fa-file-shield"></i> Kelola SKK
                    </a>
                </div>
            </details>

            <!-- BAGIAN PEMADAMAN -->
            <details class="side-group" {{ Request::is('internal/damtan*') || Request::is('internal/surat-korban*') ? 'open' : '' }}>
                <summary><i class="fas fa-fire-extinguisher grp-ico"></i><span class="grp-label">Bagian pemadaman</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/damtan/input-data" class="{{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}">
                        <i class="fas fa-fire-extinguisher"></i> Input data
                    </a>
                    <a href="/internal/surat-korban/create" class="{{ Request::is('internal/surat-korban/create*') ? 'active' : '' }}">
                        <i class="fas fa-file-signature"></i> Buat Surat Korban
                    </a>
                    <a href="/internal/damtan/data-laporan" class="{{ Request::is('internal/damtan/data-laporan*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i> Kelola Data Laporan
                    </a>
                    <a href="/internal/surat-korban/data" class="{{ Request::is('internal/surat-korban/data*') ? 'active' : '' }}">
                        <i class="fas fa-folder"></i> Kelola Surat Korban
                    </a>
                </div>
            </details>

            <!-- BAGIAN KEPEGAWAIAN -->
            <details class="side-group" {{ Request::is('internal/kepegawaian*') ? 'open' : '' }}>
                <summary><i class="fas fa-user-tie grp-ico"></i><span class="grp-label">Kepegawaian</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/kepegawaian/duk" class="{{ Request::is('internal/kepegawaian/duk*') ? 'active' : '' }}">
                        <i class="fas fa-user-tie"></i> Data Urut Kepegawaian
                    </a>
                </div>
            </details>

            <!-- BAGIAN SAPRA -->
            <details class="side-group" {{ Request::is('sapra*') ? 'open' : '' }}>
                <summary><i class="fas fa-warehouse grp-ico"></i><span class="grp-label">Bagian sapra</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <span class="side-kicker" style="padding-left:2px;">Sarana &amp; Prasarana</span>
                    <a href="/sapra/sarana-mako" class="{{ Request::is('sapra/sarana-mako*') ? 'active' : '' }}">
                        <i class="fas fa-fire-extinguisher"></i> Sarana pemadam kebakaran
                    </a>
                    <a href="/sapra/prasarana-mako" class="{{ Request::is('sapra/prasarana-mako*') ? 'active' : '' }}">
                        <i class="fas fa-building"></i> Prasarana pemadam kebakaran
                    </a>
                    <a href="/sapra/sarana-penyelamatan" class="{{ Request::is('sapra/sarana-penyelamatan*') ? 'active' : '' }}">
                        <i class="fas fa-life-ring"></i> Sarana Penyelamatan &amp; Evakuasi
                    </a>
                    <a href="/sapra/sarana-pemeriksaan" class="{{ Request::is('sapra/sarana-pemeriksaan*') ? 'active' : '' }}">
                        <i class="fas fa-search-location"></i> Sarana Pemeriksaan Proteksi Kebakaran
                    </a>
                    <a href="/sapra/kelola-pos" class="{{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}">
                        <i class="fas fa-warehouse"></i> Kelola Data Pos
                    </a>

                    <span class="side-kicker" style="padding-left:2px;">Manajemen Air</span>
                    <a href="/sapra/data_hidrant_gedung" class="{{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}">
                        <i class="fas fa-droplet"></i> Sumber Air
                    </a>
                    <a href="/sapra/data-hidrant-kota" class="{{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}">
                        <i class="fas fa-map-location-dot"></i> Data Hidrant Kota Jambi
                    </a>

                    <span class="side-kicker" style="padding-left:2px;">Logistik &amp; Distribusi</span>
                    <a href="/sapra/kebutuhan-sarpras" class="{{ Request::is('sapra/kebutuhan-sarpras*') ? 'active' : '' }}">
                        <i class="fas fa-boxes-stacked"></i> Mutu Baku Kebutuhan
                    </a>
                    <a href="/sapra/distribusi-staff" class="{{ Request::is('sapra/distribusi-staff*') ? 'active' : '' }}">
                        <i class="fas fa-people-carry-box"></i> Serah terima Barang
                    </a>
                </div>
            </details>
        @endif

        @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
            <div class="side-kicker">Konten publik</div>
            <details class="side-group" {{ Request::is('internal/operator*') ? 'open' : '' }} open>
                <summary><i class="far fa-newspaper grp-ico"></i><span class="grp-label">Manajemen berita</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">

                    @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
                        <a href="/internal/operator/kelola-berita" class="{{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}">
                            <i class="far fa-newspaper"></i><span class="lbl">Input &amp; Kelola Berita</span>
                        </a>
                        <a href="/internal/operator/infografis" class="{{ Request::is('internal/operator/infografis*') ? 'active' : '' }}">
                            <i class="far fa-image"></i><span class="lbl">Kelola Infografis</span>
                        </a>
                        <a href="/internal/operator/berita-medsos" class="{{ Request::is('internal/operator/berita-medsos*') ? 'active' : '' }}">
                            <i class="fab fa-instagram"></i><span class="lbl">Kelola Berita Medsos</span>
                        </a>
                        <a href="/internal/operator/ujung-damkar" class="{{ Request::is('internal/operator/ujung-damkar*') ? 'active' : '' }}">
                            <i class="fab fa-youtube"></i><span class="lbl">Ujung-Ujung Damkar</span>
                        </a>
                        <a href="/internal/operator/edu-damkar" class="{{ Request::is('internal/operator/edu-damkar*') ? 'active' : '' }}">
                            <i class="fas fa-graduation-cap"></i><span class="lbl">Edu Damkar</span>
                        </a>
                    @endif

                    @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                        <div class="side-kicker" style="padding: 12px 10px 4px; margin-left: 0; font-size: 0.65rem;">PEMETAAN SIGAP</div>
                        <a href="/internal/peta-sigap/input" class="{{ Request::is('internal/peta-sigap/input*') ? 'active' : '' }}">
                            <i class="fas fa-plus"></i><span class="lbl">Input Titik Peta</span>
                        </a>
                        <a href="/internal/peta-sigap/data" class="{{ Request::is('internal/peta-sigap/data*') ? 'active' : '' }}">
                            <i class="fas fa-table-list"></i><span class="lbl">Kelola Data Titik</span>
                        </a>
                    @endif

                </div>
            </details>
        @endif

        <!-- PENGATURAN AKUN -->
        <div class="side-kicker">Akun</div>
        <details class="side-group" {{ request()->is('internal/profil*') || request()->is('internal/kelola-user*') || request()->is('internal/kelola-pemohon*') ? 'open' : '' }}>
            <summary><i class="fas fa-user-gear grp-ico"></i><span class="grp-label">Pengaturan akun</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="{{ url('/internal/profil') }}" class="{{ request()->is('internal/profil*') ? 'active' : '' }}">
                    <i class="fas fa-user-pen"></i> Profil Saya
                </a>
                @if(auth()->user()->role === 'super_user')
                    <a href="{{ url('/internal/kelola-user') }}" class="{{ request()->is('internal/kelola-user*') ? 'active' : '' }}">
                        <i class="fas fa-users-gear"></i> Kelola Pengguna
                    </a>
                @endif
                <a href="{{ url('/internal/kelola-pemohon') }}" class="{{ request()->is('internal/kelola-pemohon*') ? 'active' : '' }}">
                    <i class="fas fa-address-book"></i> Kelola Akun Pemohon
                </a>
            </div>
        </details>

    </aside>

    <!-- ==================== KONTEN UTAMA ==================== -->
    <main class="content">

        <!-- Header Halaman & Tombol Aksi -->
        <div class="page-head-bar">
            <div class="page-head">
                <h1>Kelola Ujung-Ujung Damkar</h1>
                <p>Unggah dan kelola tautan video YouTube untuk ditampilkan pada bagian Ujung-Ujung Damkar di halaman utama.</p>
            </div>
            
            @role('Operator')
            <button type="button" class="btn-simerah-danger w-mobile-100" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah Video
            </button>
            @endrole
        </div>

        <!-- Section Heading dengan Indikator Jumlah Data -->
        <div class="section-heading">
            <span class="section-heading-ico"><i class="fab fa-youtube"></i></span>
            <h3>Daftar Video Tayang</h3>
            <span class="line"></span>
            <span class="count-pill">
                <i class="fas fa-film"></i> {{ isset($videos) ? count($videos) : 0 }} Video
            </span>
        </div>

        <!-- Tabel Data Video -->
        <div class="card-box">
            <div class="table-responsive">
                <table class="table table-simerah align-middle">
                    <thead>
                        <tr>
                            <th style="width: 6%;">No</th>
                            <th style="width: 22%;">Thumbnail</th>
                            <th style="width: 52%;">Judul Kegiatan &amp; Tautan</th>
                            
                            @role('Operator')
                            <th style="width: 20%;" class="text-center">Aksi</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($videos ?? [] as $index => $item)
                        <tr>
                            <td>
                                <span class="row-num">{{ $index + 1 }}</span>
                            </td>
                            <td>
                                <a href="{{ $item->link_asli }}" target="_blank" rel="noopener noreferrer" class="yt-thumb-link" title="Tonton: {{ $item->judul }}">
                                    <img src="https://i.ytimg.com/vi/{{ $item->youtube_id }}/hqdefault.jpg" alt="Thumbnail {{ $item->judul }}" loading="lazy">
                                    <span class="yt-thumb-play"><i class="fas fa-circle-play"></i></span>
                                </a>
                            </td>
                            <td>
                                <div class="video-title">{{ $item->judul }}</div>
                                <div class="video-meta">
                                    <a href="{{ $item->link_asli }}" target="_blank" rel="noopener noreferrer" class="yt-watch-link">
                                        <i class="fab fa-youtube"></i> Tonton di YouTube
                                    </a>
                                    @if(!empty($item->youtube_id))
                                        <span class="yt-id-code"><i class="fas fa-hashtag me-1"></i>{{ $item->youtube_id }}</span>
                                    @endif
                                </div>
                            </td>
                            
                            @role('Operator')
                            <td class="text-center">
                                <form action="/internal/operator/ujung-damkar/hapus/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus video ini dari daftar tayang?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete-item">
                                        <i class="fas fa-trash-can"></i> Hapus
                                    </button>
                                </form>
                            </td>
                            @endrole
                        </tr>
                        @empty
                        <tr>
                            <td colspan="@role('Operator') 4 @else 3 @endrole">
                                <div class="empty-state">
                                    <div class="empty-ico">
                                        <i class="fab fa-youtube"></i>
                                    </div>
                                    <h4>Belum Ada Video Ujung-Ujung Damkar</h4>
                                    <p>Tambahkan tautan video dokumentasi atau edukasi dari YouTube agar tampil di halaman publik SIMERAH KOJA[cite: 10].</p>
                                    
                                    @role('Operator')
                                    <button type="button" class="btn-simerah-danger" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                        <i class="fas fa-plus"></i> Tambah Video Pertama
                                    </button>
                                    @endrole
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

<!-- ==================== MODAL TAMBAH VIDEO (Hanya Dirender untuk Operator) ==================== -->
@role('Operator')
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/internal/operator/ujung-damkar/store" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">
                        <i class="fab fa-youtube text-danger"></i> Tambah Video Ujung-Ujung Damkar
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="ytLinkInput" class="form-label">Link Video YouTube <span class="text-danger">*</span></label>
                        <input type="url" class="form-control" name="link" id="ytLinkInput" placeholder="https://www.youtube.com/watch?v=..." required>
                        <span class="form-hint">Mendukung tautan YouTube standar, tautan bagikan (`youtu.be`), maupun YouTube Shorts.</span>
                    </div>

                    <!-- Preview Otomatis saat Paste Link -->
                    <div class="mb-3 d-none yt-preview-card" id="ytPreviewBox">
                        <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1" style="font-size: .74rem;">
                                <i class="fas fa-circle-check me-1"></i>ID Video Terdeteksi: <strong id="ytDetectedId">-</strong>
                            </span>
                        </div>
                        <img src="" id="ytPreviewImg" alt="Preview Thumbnail YouTube">
                    </div>

                    <div class="mb-1">
                        <label for="judulVideoInput" class="form-label">Judul Kegiatan / Video <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="judul" id="judulVideoInput" placeholder="Contoh: Evakuasi Cincin Warga di Mako Damkar Kota Jambi" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-simerah-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-simerah-danger">
                        <i class="fas fa-floppy-disk"></i> Simpan Video
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endrole

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
    'use strict';

    /* ---------- 1. Notifikasi Toast ---------- */
    document.querySelectorAll('[data-toast]').forEach(function (t) {
        var hide = function () {
            t.classList.add('leaving');
            setTimeout(function () { t.remove(); }, 350);
        };
        var x = t.querySelector('[data-toast-close]');
        if (x) x.addEventListener('click', hide);
        setTimeout(hide, 4500);
    });

    /* ---------- 2. Sidebar (Mobile Drawer) ---------- */
    var toggle = document.getElementById('sideToggle');
    var backdrop = document.getElementById('sideBackdrop');

    function closeSide() {
        document.body.classList.remove('side-open');
        if (toggle) toggle.setAttribute('aria-expanded', 'false');
    }
    if (toggle) {
        toggle.addEventListener('click', function () {
            var open = document.body.classList.toggle('side-open');
            toggle.setAttribute('aria-expanded', open);
        });
    }
    if (backdrop) backdrop.addEventListener('click', closeSide);
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeSide();
    });

    /* ---------- 3. Hanya satu grup sidebar terbuka pada satu waktu ---------- */
    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) {
                groups.forEach(function (o) {
                    if (o !== g) o.open = false;
                });
            }
        });
    });

    /* ---------- 4. Preview Thumbnail Otomatis saat Paste Link YouTube ---------- */
    var ytInput      = document.getElementById('ytLinkInput');
    var ytBox        = document.getElementById('ytPreviewBox');
    var ytImg        = document.getElementById('ytPreviewImg');
    var ytDetectedId = document.getElementById('ytDetectedId');

    if (ytInput) {
        ytInput.addEventListener('input', function () {
            var val = ytInput.value.trim();
            var match = val.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i);
            if (match && match[1]) {
                ytImg.src = 'https://i.ytimg.com/vi/' + match[1] + '/hqdefault.jpg';
                if (ytDetectedId) ytDetectedId.textContent = match[1];
                ytBox.classList.remove('d-none');
            } else {
                ytBox.classList.add('d-none');
                ytImg.src = '';
            }
        });
    }
})();
</script>
</body>
</html>
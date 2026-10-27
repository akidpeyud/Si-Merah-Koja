<style>
/* ==========================================================
   TOKENS & BASE (SIMERAH KOJA)
   ========================================================== */
:root {
    --ink: #0d1b2a;
    --ink-2: #132a43;
    --ink-3: #1d3856;
    --paper: #f3f5f8;
    --white: #ffffff;
    --signal: #e5392d;
    --signal-d: #c22b20;
    --amber: #ffb627;
    --steel: #5b6c7f;
    --line: #dbe2ea;

    --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
    --font-body: 'Instrument Sans', system-ui, sans-serif;

    --r-lg: 28px;
    --r-md: 18px;
    --r-sm: 10px;
    --wrap: 1300px;
    --header-h: 64px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body {
    font-family: var(--font-body);
    font-size: 1rem;
    line-height: 1.65;
    color: var(--ink);
    background: var(--white);
    -webkit-font-smoothing: antialiased;
    overflow-x: hidden;
}
body:has(dialog[open]) { overflow: hidden; }
img { max-width: 100%; display: block; }
a { color: inherit; text-decoration: none; }
ul, ol { list-style: none; }
button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }

:focus-visible { outline: 3px solid var(--amber); outline-offset: 3px; border-radius: 6px; }

.wrap { max-width: var(--wrap); margin: 0 auto; padding-left: clamp(16px, 4vw, 32px); padding-right: clamp(16px, 4vw, 32px); }

/* ==========================================================
   HEADER & NAVBAR MULTI-DROPDOWN
   ========================================================== */
.site-header {
    position: sticky; top: 0; z-index: 1000;
    background: rgba(13, 27, 42, .88);
    -webkit-backdrop-filter: blur(14px) saturate(1.4);
    backdrop-filter: blur(14px) saturate(1.4);
    border-bottom: 1px solid rgba(255,255,255,.08);
    transition: box-shadow .25s;
}
.nav {
    max-width: 1440px; margin: 0 auto; min-height: var(--header-h);
    padding: 0 clamp(16px, 3vw, 32px);
    display: flex; align-items: center; justify-content: space-between; gap: 24px;
}
.brand { display: flex; align-items: center; flex: none; }
.brand a { display: flex; align-items: center; }
.brand a + a { margin-left: 14px; padding-left: 14px; border-left: 1px solid rgba(255,255,255,.16); }
.brand img { height: 36px; width: auto; }
.nav-panel { flex: 1; min-width: 0; display: flex; align-items: center; justify-content: space-between; gap: 20px; }
.menu { display: flex; align-items: center; justify-content: center; gap: 2px; flex: 1; min-width: 0; }
.menu > li { position: relative; }
.menu-link, .menu-trigger {
    position: relative; display: inline-flex; align-items: center; gap: 6px;
    padding: 10px 11px; color: rgba(255,255,255,.78);
    font-size: .875rem; font-weight: 500; letter-spacing: .005em; white-space: nowrap;
    transition: color .2s;
}
.menu-link::after, .menu-trigger::after {
    content: ""; position: absolute; left: 11px; right: 11px; bottom: 2px; height: 2px;
    border-radius: 2px; background: var(--amber);
    transform: scaleX(0); transform-origin: left; transition: transform .25s ease;
}
.menu-link:hover, .menu-trigger:hover, .has-drop.open > .menu-trigger, .menu-link.is-active { color: #fff; }
.menu-link:hover::after, .menu-trigger:hover::after, .has-drop.open > .menu-trigger::after, .menu-link.is-active::after { transform: scaleX(1); }
.menu-trigger i { font-size: .6rem; opacity: .6; transition: transform .2s, opacity .2s; }
.has-drop.open > .menu-trigger i { transform: rotate(180deg); opacity: 1; }
.menu > li.current > .menu-trigger, .menu > li.current > .menu-link { color: #fff; }
.menu > li.current > .menu-trigger::after, .menu > li.current > .menu-link::after { transform: scaleX(1); }

.nav-actions { display: flex; align-items: center; gap: 10px; flex: none; }
.nav-actions > li { position: relative; }
.btn-nav {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    height: 40px; padding: 0 16px; border-radius: 999px;
    font-size: .875rem; font-weight: 600; white-space: nowrap;
    transition: background .2s, border-color .2s, color .2s, transform .2s;
}
.btn-nav:active { transform: scale(.97); }
.btn-nav i.fa-chevron-down { font-size: .6rem; opacity: .8; transition: transform .2s; }
.has-drop.open > .btn-nav i.fa-chevron-down { transform: rotate(180deg); }
.btn-nav--alert { background: var(--signal); color: #fff; }
.btn-nav--alert:hover, .has-drop.open > .btn-nav--alert { background: var(--signal-d); }
.btn-nav--alert .beacon { width: 8px; height: 8px; background: #fff; }
.btn-nav--alert .beacon::after { background: #fff; }
.btn-nav--ghost { border: 1.5px solid rgba(255,255,255,.3); color: #fff; }
.btn-nav--ghost:hover, .has-drop.open > .btn-nav--ghost { border-color: #fff; background: rgba(255,255,255,.08); }

.dropdown {
    position: absolute; top: calc(100% + 14px); left: 50%; min-width: 250px; width: max-content; max-width: 320px;
    background: var(--ink-2); border: 1px solid rgba(255,255,255,.1);
    border-radius: 16px; padding: 8px; box-shadow: 0 24px 48px rgba(0,0,0,.45);
    visibility: hidden; opacity: 0; pointer-events: none;
    transform: translate(-50%, 6px);
    transition: opacity .18s ease, transform .18s ease, visibility 0s linear .18s;
}
.nav-actions .dropdown { left: auto; right: 0; transform: translate(0, 6px); }
.dropdown::before { content: ""; position: absolute; left: 0; right: 0; top: -14px; height: 14px; }
.dropdown::after {
    content: ""; position: absolute; top: -6px; left: 50%; width: 10px; height: 10px; margin-left: -5px;
    background: var(--ink-2); border-top: 1px solid rgba(255,255,255,.1); border-left: 1px solid rgba(255,255,255,.1);
    transform: rotate(45deg);
}
.nav-actions .dropdown::after { left: auto; right: 24px; margin-left: 0; }
.has-drop.open > .dropdown {
    visibility: visible; opacity: 1; pointer-events: auto;
    transform: translate(-50%, 0); transition-delay: 0s;
}
.nav-actions .has-drop.open > .dropdown { transform: translate(0, 0); }

.dropdown a, .dropdown .btn-logout {
    display: flex; align-items: center; gap: 12px; width: 100%;
    padding: 10px 14px; border-radius: var(--r-sm);
    font-size: .9rem; line-height: 1.4; color: rgba(255,255,255,.85); text-align: left; white-space: normal;
    transition: background .15s, color .15s;
}
.dropdown a:hover, .dropdown a[aria-current="page"] { background: rgba(255,255,255,.08); color: #fff; }
.dropdown a i { width: 18px; text-align: center; font-size: 1rem; flex: none; }
.dropdown a .fa-phone-alt { color: #38bdf8; }
.dropdown a .fa-whatsapp  { color: #25d366; }
.dropdown a .fa-headset   { color: #f87171; }
.dropdown .btn-logout { color: #ff8b8b; cursor: pointer; }
.dropdown .btn-logout:hover { background: rgba(255,255,255,.08); color: #ffb8b8; }

.has-sub { position: relative; }
.has-sub > .sub-trigger {
    width: 100%; display: flex; align-items: center; justify-content: space-between; gap: 10px;
    padding: 10px 14px; border-radius: var(--r-sm); font-size: .9rem; line-height: 1.4; text-align: left;
    color: rgba(255,255,255,.85); transition: background .15s, color .15s;
}
.has-sub > .sub-trigger i { font-size: .65rem; opacity: .7; transition: transform .2s; }
.has-sub > .sub-trigger:hover, .has-sub.open > .sub-trigger { background: rgba(255,255,255,.08); color: #fff; }
.has-sub.current > .sub-trigger { background: rgba(255,255,255,.08); color: #fff; }

.dropdown-sub {
    display: none; position: absolute; top: -8px; left: 100%; min-width: 250px; margin-left: 6px; z-index: 10;
    background: var(--ink-2); border: 1px solid rgba(255,255,255,.1);
    border-radius: 16px; padding: 8px; box-shadow: 0 24px 48px rgba(0,0,0,.45);
}
.dropdown-sub::before { content: ""; position: absolute; top: 0; bottom: 0; left: -12px; width: 12px; }
.has-sub.open > .dropdown-sub { display: block; }
.dropdown-sub a[aria-current="page"] { background: rgba(255,255,255,.09); color: #fff; font-weight: 600; }

.nav-toggle { display: none; width: 44px; height: 44px; border-radius: 12px; color: #fff; font-size: 1.15rem; align-items: center; justify-content: center; }
.nav-toggle:hover { background: rgba(255,255,255,.1); }

@media (hover: hover) and (min-width: 1201px) {
    .has-drop:hover > .dropdown { visibility: visible; opacity: 1; pointer-events: auto; transform: translate(-50%, 0); transition-delay: 0s; }
    .nav-actions .has-drop:hover > .dropdown { transform: translate(0, 0); }
    .has-drop:hover > .menu-trigger { color: #fff; }
    .has-drop:hover > .menu-trigger::after { transform: scaleX(1); }
    .has-sub:hover > .dropdown-sub { display: block; }
    .has-sub:hover > .sub-trigger { background: rgba(255,255,255,.08); color: #fff; }
    .dropdown-sub { left: auto; right: 100%; margin-left: 0; margin-right: 6px; }
    .dropdown-sub::before { left: auto; right: -12px; }
    .has-sub > .sub-trigger i { transform: rotate(180deg); }
}

@media (max-width: 1200px) {
    .nav { gap: 12px; }
    .nav-toggle { display: inline-flex; margin-left: auto; }
    .nav-panel {
        display: none; position: absolute; top: 100%; left: 0; right: 0;
        max-height: calc(100dvh - var(--header-h)); overflow-y: auto; overscroll-behavior: contain;
        flex-direction: column; align-items: stretch; justify-content: flex-start; gap: 20px;
        padding: 8px clamp(16px, 4vw, 32px) 28px;
        background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.1);
        box-shadow: 0 30px 40px rgba(0,0,0,.35);
    }
    .nav-open .nav-panel { display: flex; }
    .menu { flex-direction: column; align-items: stretch; justify-content: flex-start; gap: 0; flex: none; }
    .menu > li { border-bottom: 1px solid rgba(255,255,255,.08); }
    .menu-link, .menu-trigger { width: 100%; justify-content: space-between; padding: 16px 4px; font-size: 1rem; white-space: normal; color: rgba(255,255,255,.9); }
    .menu-link::after, .menu-trigger::after { display: none; }
    .menu-link.is-active { color: var(--amber); }
    .menu-trigger i { font-size: .7rem; }
    .nav-actions { flex-direction: column; align-items: stretch; gap: 10px; }
    .btn-nav { height: 48px; font-size: 1rem; }
    .nav-actions .has-drop > .btn-nav { width: 100%; }
    .dropdown, .nav-actions .dropdown {
        display: none; position: static; min-width: 0; width: auto; max-width: none; margin: 0 0 12px 4px; padding: 0 0 0 12px;
        background: transparent; border: 0; border-left: 2px solid rgba(255,255,255,.14); border-radius: 0; box-shadow: none;
        visibility: visible; opacity: 1; pointer-events: auto; transform: none; transition: none;
    }
    .dropdown::before, .dropdown::after { display: none; }
    .has-drop.open > .dropdown, .nav-actions .has-drop.open > .dropdown { display: block; transform: none; }
    .dropdown a, .dropdown .btn-logout { padding: 13px 12px; font-size: .95rem; }
    .has-sub > .sub-trigger { padding: 13px 12px; font-size: .95rem; }
    .has-sub.open > .sub-trigger i { transform: rotate(90deg); }
    .dropdown-sub { position: static; margin: 2px 0 6px 8px; padding: 0 0 0 10px; min-width: 0; background: transparent; border: 0; border-left: 2px solid rgba(255,255,255,.14); border-radius: 0; box-shadow: none; }
    .dropdown-sub::before { display: none; }
}

@media (max-width: 480px) {
    .brand img { height: 30px; }
    .brand a + a { margin-left: 10px; padding-left: 10px; }
}
body.nav-lock { overflow: hidden; }

/* ==========================================================
   FOOTER
   ========================================================== */
.footer { background: var(--ink); color: rgba(255,255,255,.7); padding: clamp(56px, 8vw, 96px) 0 32px; }
.footer-grid { display: grid; grid-template-columns: 1.1fr 1.2fr .8fr; gap: clamp(32px, 5vw, 64px); }
.footer h3 { font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; color: #fff; margin-bottom: 16px; }
.footer-about img { height: 96px; width: auto; margin-bottom: 20px; }
.footer-about p { max-width: 42ch; font-size: .95rem; }
.map { position: relative; height: 190px; border-radius: var(--r-md); overflow: hidden; background: var(--ink-2); }
.map iframe { width: 100%; height: 100%; border: 0; pointer-events: none; filter: grayscale(.3) contrast(1.05); transition: filter .3s; }
.map-link { position: absolute; inset: 0; z-index: 2; display: flex; align-items: flex-end; justify-content: flex-end; padding: 12px; border-radius: var(--r-md); }
.map-link span { display: inline-flex; align-items: center; gap: 8px; padding: 8px 14px; border-radius: 999px; background: var(--signal); color: #fff; font-size: .85rem; font-weight: 700; box-shadow: 0 8px 20px rgba(0,0,0,.35); transition: background .2s, transform .2s; }
.map-link:hover span, .map-link:focus-visible span { background: var(--signal-d); transform: translateY(-2px); }
.map:hover iframe { filter: none; }
.find { margin-top: 14px; display: inline-flex; align-items: center; gap: 10px; font-weight: 600; color: #fff; transition: color .2s, gap .2s; }
.find i { color: var(--signal); }
.find:hover { color: var(--amber); gap: 14px; }
.app-dl { margin-top: 22px; }
.app-dl p { font-size: .88rem; margin-bottom: 10px; }
.app-dl img { height: 44px; width: auto; }
.footer-links li + li { margin-top: 8px; }
.footer-links a { display: flex; align-items: center; gap: 10px; padding: 6px 0; font-size: .95rem; transition: color .2s, gap .2s; }
.footer-links a i { font-size: .7rem; color: var(--signal); }
.footer-links a:hover { color: #fff; gap: 14px; }
.footer-bar { margin-top: clamp(40px, 6vw, 72px); padding-top: 28px; border-top: 1px solid rgba(255,255,255,.1); display: flex; flex-wrap: wrap; gap: 20px; justify-content: space-between; align-items: center; font-size: .88rem; }
.footer .social a { background: rgba(255,255,255,.08); color: #fff; }
.footer .social a:hover { background: var(--signal); }
.social { display: flex; flex-wrap: wrap; gap: 8px; }
.social a { width: 42px; height: 42px; border-radius: 12px; display: grid; place-items: center; background: rgba(255,255,255,.08); color: #fff; transition: background .2s, color .2s, transform .2s; }
.social a:hover { background: var(--signal); transform: translateY(-3px); }
@media (max-width: 900px) { .footer-grid { grid-template-columns: 1fr; } }

/* ==========================================================
   SOS FAB & BEACON
   ========================================================== */
.beacon { position: relative; width: 12px; height: 12px; border-radius: 50%; background: #fff; flex: none; }
.beacon::after { content: ""; position: absolute; inset: 0; border-radius: 50%; background: #fff; animation: ping 1.8s cubic-bezier(0,0,.2,1) infinite; }
@keyframes ping { 0% { transform: scale(1); opacity: .7; } 100% { transform: scale(3.2); opacity: 0; } }
.sos-fab { position: fixed; right: clamp(14px, 3vw, 28px); bottom: clamp(14px, 3vw, 28px); z-index: 70; display: flex; flex-direction: column; align-items: flex-end; gap: 12px; opacity: 0; visibility: hidden; transform: translateY(16px); transition: opacity .3s, transform .3s, visibility .3s; }
.sos-fab.show { opacity: 1; visibility: visible; transform: none; }
.sos-fab-btn { display: inline-flex; align-items: center; gap: 10px; padding: 14px 22px; border-radius: 999px; background: var(--signal); color: #fff; font-weight: 700; box-shadow: 0 14px 30px -6px rgba(229,57,45,.6); }
.sos-fab-btn:hover { background: var(--signal-d); }
.sos-sheet { display: none; width: min(320px, calc(100vw - 28px)); padding: 8px; border-radius: 20px; background: var(--ink); border: 1px solid rgba(255,255,255,.12); box-shadow: 0 24px 48px rgba(0,0,0,.45); }
.sos-fab.open .sos-sheet { display: grid; gap: 6px; }
.sos-sheet a { display: flex; align-items: center; gap: 14px; padding: 13px 14px; border-radius: 14px; color: #fff; font-weight: 600; }
.sos-sheet a:hover { background: rgba(255,255,255,.1); }
.sos-sheet a i { width: 22px; text-align: center; font-size: 1.15rem; }
.sos-sheet .wa i { color: #25d366; } .sos-sheet .tel i { color: #38bdf8; } .sos-sheet .n112 i { color: #f87171; }

@media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }
    *, *::before, *::after { animation: none !important; transition: none !important; }
}
</style>

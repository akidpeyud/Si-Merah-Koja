<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>waarld?</title>
<script>if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) document.documentElement.classList.add("js");</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;600;900&display=swap" rel="stylesheet">
<style>
  :root {
    --moss: #283618; --cream: #fefae0; --amber: #bc6c25;
    --font: "Archivo", "Helvetica Neue", Arial, sans-serif;
    box-sizing: border-box;
    padding-top: env(safe-area-inset-top, 0px);
    padding-bottom: env(safe-area-inset-bottom, 0px);
  }
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  html { scroll-padding-top: env(safe-area-inset-top, 0px); }
  body { background: var(--moss); color: var(--cream); font-family: var(--font); line-height: 1.5; overflow-x: hidden; }
  section { position: relative; overflow: hidden; }
  [data-speed] { will-change: transform; }

  /* NAVBAR */
  .nav { position: fixed; top: 0; left: 0; right: 0; z-index: 70; display: flex; align-items: center; justify-content: space-between; padding: calc(env(safe-area-inset-top, 0px) + 20px) 6vw 0; pointer-events: none; background: none; }
  .nav-home { pointer-events: auto; cursor: pointer; text-decoration: none; font-family: var(--font); color: var(--moss); font-weight: 900; font-size: 1.35rem; letter-spacing: -.03em; line-height: 1; padding: .6rem; margin: -.6rem; transition: color .3s, transform .25s; }
  .nav-home:hover { transform: scale(1.05); color: var(--amber); }
  .nav-home:focus-visible { outline: 2px solid var(--amber); outline-offset: 4px; border-radius: 6px; }
  .nav-logo { pointer-events: auto; cursor: pointer; background: none; border: 0; font: inherit; display: inline-flex; align-items: center; gap: 16px; padding: .6rem; margin: -.6rem; color: var(--moss); --bar: var(--amber); transition: color .3s, transform .25s; }
  .nav-logo svg { display: block; height: 22px; width: auto; overflow: visible; transition: opacity .15s; }
  .nav-logo .bar { fill: var(--bar); }
  .nav-logo:hover { transform: scale(1.05); }
  .nav-logo:focus-visible { outline: 2px solid var(--amber); outline-offset: 4px; border-radius: 6px; }
  .nav-close { font-weight: 600; font-size: .8rem; letter-spacing: .12em; text-transform: uppercase; opacity: 0; transform: translateX(8px); transition: opacity .3s, transform .3s; }
  .nav.on-dark .nav-logo { color: var(--cream); --bar: var(--amber); }
  .nav.on-dark .nav-home { color: var(--cream); }
  .nav.is-open .nav-logo { color: var(--cream); --bar: var(--amber); }
  .nav.is-open .nav-home { color: var(--cream); }
  .nav.is-open .nav-logo:focus-visible, .nav.is-open .nav-home:focus-visible { outline-color: var(--cream); }
  .nav.is-open .nav-close { opacity: 1; transform: none; }
  .nav.popping .nav-logo svg { opacity: 0; }

  /* MENU */
  .menu { position: fixed; inset: 0; z-index: 60; background: var(--moss); color: var(--cream); display: grid; place-items: center; align-content: center; padding: 14vh 8vw 12vh; clip-path: circle(0px at var(--x, 100%) var(--y, 0px)); visibility: hidden; transition: clip-path .85s cubic-bezier(.7, 0, .2, 1), visibility 0s .85s; }
  .menu.open { clip-path: circle(var(--r, 150vmax) at var(--x, 100%) var(--y, 0px)); visibility: visible; transition: clip-path .85s cubic-bezier(.7, 0, .2, 1), visibility 0s; }
  .menu ul { list-style: none; width: min(100%, 1100px); }
  .menu li { overflow: hidden; border-bottom: 2px solid var(--amber); }
  .menu li:first-child { border-top: 2px solid var(--amber); }
  .menu a { display: flex; align-items: baseline; justify-content: space-between; gap: 2rem; padding: .06em 0 .14em; color: var(--cream); text-decoration: none; font-weight: 900; letter-spacing: -.045em; line-height: .95; font-size: clamp(2.6rem, 12vw, 9rem); transform: translateY(110%); transition: transform .4s ease; }
  .menu a .n { font-size: 1rem; font-weight: 600; letter-spacing: .08em; }
  .menu.open a { transform: none; transition: transform .9s cubic-bezier(.2, .7, .1, 1) calc(.35s + var(--i) * .08s); }
  .menu.open a:hover, .menu.open a:focus-visible { transform: translateX(.12em); transition-delay: 0s; transition-duration: .3s; }
  .menu a:focus-visible { outline: 3px solid var(--cream); outline-offset: -3px; }
  .menu-foot { position: absolute; left: 8vw; bottom: calc(env(safe-area-inset-bottom, 0px) + 6vh); font-size: .95rem; font-weight: 600; }

  .ball { position: fixed; z-index: 65; width: 60px; height: 60px; pointer-events: none; background: var(--amber); border: 2px solid var(--cream); border-radius: 50%; }
  .ball::before { content: ""; position: absolute; left: 20%; top: 18%; width: 14px; height: 14px; border-radius: 50%; background: var(--cream); }
  .shard { position: fixed; z-index: 65; left: 0; top: 0; pointer-events: none; background: var(--amber); box-shadow: 0 0 0 1.5px var(--cream); }
  .pop-ring { position: fixed; z-index: 65; width: 60px; height: 60px; border-radius: 50%; border: 3px solid var(--amber); outline: 1.5px solid var(--cream); pointer-events: none; }

  @media (prefers-reduced-motion: reduce) {
    .menu { clip-path: none; opacity: 0; transition: opacity .25s, visibility 0s .25s; }
    .menu.open { clip-path: none; opacity: 1; transition: opacity .25s, visibility 0s; }
    .menu a, .menu.open a { transform: none; transition: none; }
  }

  /* 1. HERO */
  .hero { min-height: 100vh; min-height: 100svh; display: grid; place-items: center; background: var(--moss); color: var(--cream); }
  .hero h1 { font-weight: 900; line-height: 1; letter-spacing: -.045em; font-size: clamp(3.6rem, 17vw, 17rem); text-align: center; white-space: nowrap; text-transform: uppercase; position: relative; z-index: 2; padding: 0 .04em .06em; }
  .hero h1 .q { color: var(--amber); display: inline-block; margin-left: .03em; }
  .hero .sub { position: absolute; bottom: 8vh; left: 0; right: 0; text-align: center; z-index: 2; font-size: .95rem; font-weight: 600; letter-spacing: .14em; text-transform: uppercase; }
  .orb { position: absolute; border-radius: 50%; z-index: 1; }
  .orb.a { width: 38vw; height: 38vw; border: 2px solid var(--cream); top: -8vw; left: -10vw; }
  .orb.b { width: 22vw; height: 22vw; border: 2px solid var(--cream); right: 6vw; top: 18vh; }
  .orb.c { width: 9vw; height: 9vw; background: var(--amber); left: 14vw; bottom: 16vh; }
  .orb.d { width: 30vw; height: 30vw; border: 2px solid var(--amber); right: -9vw; bottom: -10vw; }

  /* 2. HORIZONTAL SCROLL — biodata 6 pilar */
  .hs { background: var(--moss); color: var(--cream); height: 400vh; overflow: visible; }
  .hs-sticky { position: sticky; top: 0; height: 100vh; height: 100svh; overflow: hidden; display: flex; flex-direction: column; justify-content: center; gap: 3vh; }
  .hs-head { padding: calc(env(safe-area-inset-top, 0px) + 40px) 8vw 0; font-size: clamp(1.4rem, 3.4vw, 2.6rem); font-weight: 900; letter-spacing: -.02em; line-height: 1.05; max-width: 24ch; }
  .track { display: flex; gap: 3vw; padding: 0 8vw; width: max-content; will-change: transform; }
  .card { flex: 0 0 auto; width: min(88vw, 760px); height: 68vh; min-height: 420px; padding: clamp(1.8rem, 3.5vw, 3rem); background: var(--cream); color: var(--moss); border-radius: 32px; display: flex; flex-direction: column; justify-content: space-between; }
  .card h3 { font-size: clamp(2rem, 4.4vw, 3.8rem); font-weight: 900; line-height: 1; letter-spacing: -.03em; }
  .card p { max-width: 34ch; font-size: clamp(1rem, 1.6vw, 1.2rem); margin-top: 1rem; }
  .card i { display: block; width: 72px; height: 10px; background: var(--amber); border-radius: 10px; }
  .card.blue { background: var(--amber); color: var(--cream); }
  .card.blue i { background: var(--cream); }

  /* 3. STATEMENT / QUOTE — 60% moss, 30% cream, 10% amber */
  .statement { min-height: 140vh; background: var(--moss); color: var(--cream); display: grid; place-items: center; padding: 20vh 8vw; margin-top: -100vh; margin-top: -100svh; z-index: 6; border-radius: 48px 48px 0 0; border-top: 4px solid var(--amber); }
  .quote { width: min(100%, 1240px); }
  .quote .mark { display: block; font-size: clamp(6rem, 14vw, 12rem); font-weight: 900; line-height: .7; height: .42em; margin-bottom: .1em; color: var(--amber); }
  .quote blockquote p { font-size: clamp(2.4rem, 8.4vw, 7.4rem); font-weight: 900; line-height: .98; letter-spacing: -.05em; max-width: 14ch; text-wrap: balance; }
  .quote figcaption { display: flex; align-items: center; gap: 1.2rem; margin-top: clamp(2rem, 5vw, 4rem); font-size: clamp(1rem, 1.5vw, 1.25rem); font-weight: 600; line-height: 1.3; }
  .quote .rule { flex: 0 0 clamp(48px, 7vw, 96px); height: 4px; background: var(--amber); border-radius: 4px; }
  .quote cite { font-style: normal; font-weight: 400; }
  .quote a { color: var(--cream); text-decoration: underline; text-decoration-color: var(--amber); text-decoration-thickness: 2px; text-underline-offset: .25em; transition: color .25s; }
  .quote a:hover, .quote a:focus-visible { color: var(--amber); outline: none; }

  /* 4. DOKUMENTASI + PENUTUP */
  .closing { background: var(--cream); color: var(--moss); min-height: 100vh; min-height: 100svh; padding: 16vh 0 10vh; text-align: left; }
  .arc-head { display: flex; justify-content: space-between; align-items: flex-end; gap: 2rem; padding: 0 8vw 1.6rem; position: relative; z-index: 2; }
  .arc-eyebrow { font-size: .75rem; font-weight: 600; letter-spacing: .22em; text-transform: uppercase; color: var(--amber); }
  .arc-title { margin-top: .7rem; font-size: clamp(2rem, 5vw, 4rem); font-weight: 900; letter-spacing: -.04em; line-height: 1; }
  .arc-count { font-size: clamp(2rem, 5vw, 4rem); font-weight: 900; letter-spacing: -.04em; line-height: 1; font-variant-numeric: tabular-nums; }

  .g-view { position: relative; z-index: 2; overflow: hidden; padding: 3rem 0 3.5rem; touch-action: pan-y; user-select: none; -webkit-user-select: none; cursor: grab; }
  .g-view.drag { cursor: grabbing; }
  .g-track { display: flex; align-items: flex-start; gap: clamp(18px, 2.4vw, 36px); width: max-content; will-change: transform; }
  .shot { flex: 0 0 auto; width: clamp(270px, 30vw, 460px); }
  .shot:nth-child(even) { width: clamp(240px, 25vw, 400px); margin-top: 80px; }

  /* Foto: tidak bisa diklik/diperbesar, tapi hidup saat disorot kursor */
  .shot .frame {
    aspect-ratio: 3 / 4; border-radius: 18px; overflow: hidden; background: var(--moss);
    display: grid; place-items: center;
    outline: 4px solid transparent; outline-offset: 6px;
    box-shadow: 0 0 0 rgba(40, 54, 24, 0);
    transform: perspective(900px) translateY(var(--ty, 0px)) rotateX(var(--rx, 0deg)) rotateY(var(--ry, 0deg)) scale(var(--s, 1));
    transition: transform .35s cubic-bezier(.2,.7,.1,1), outline-color .3s, outline-offset .3s, box-shadow .5s;
  }
  .shot:nth-child(even) .frame { aspect-ratio: 1 / 1; }
  .shot .frame img { width: 100%; height: 100%; object-fit: cover; display: block; pointer-events: none; -webkit-user-drag: none; transition: transform .9s cubic-bezier(.2,.7,.1,1); }
  .shot .frame:empty::after { content: ""; width: 72px; height: 10px; border-radius: 10px; background: var(--amber); transition: width .5s cubic-bezier(.2,.7,.1,1); }
  .shot:hover .frame {
    --s: 1.04; --ty: -12px;
    outline-color: var(--amber); outline-offset: 10px;
    box-shadow: 0 28px 40px -20px rgba(40, 54, 24, .6);
  }
  .shot:hover .frame img { transform: scale(1.1); }
  .shot:hover .frame:empty::after { width: 140px; }

  @media (prefers-reduced-motion: reduce) { .g-view { overflow-x: auto; cursor: auto; } }

  /* animasi muncul */
  .w { display: inline-block; overflow: hidden; vertical-align: top; padding-bottom: .12em; margin-bottom: -.12em; }
  .w > span { display: inline-block; }
  .js .w > span { transform: translateY(115%); transition: transform .9s cubic-bezier(.2,.7,.1,1) calc(var(--i) * 70ms + .15s); }
  .in .w > span { transform: none; }
  .js .ch { display: inline-block; opacity: 0; transform: translateY(45%); transition: opacity .8s ease calc(var(--i) * 90ms + .2s), transform 1.1s cubic-bezier(.2,.7,.1,1) calc(var(--i) * 90ms + .2s); }
  .in .ch { opacity: 1; transform: none; }
  .js .orb { opacity: 0; transition: opacity 1.6s ease .3s; }
  .in .orb { opacity: 1; }
  .js .card { opacity: 0; transform: translateY(70px) scale(.94); transition: opacity .8s ease, transform 1s cubic-bezier(.2,.7,.1,1); }
  .js .card.in { opacity: 1; transform: none; }
  .js .reveal { opacity: 0; transform: translateY(28px); transition: opacity .9s ease var(--d, 0s), transform .9s cubic-bezier(.2,.7,.1,1) var(--d, 0s); }
  .in .reveal { opacity: 1; transform: none; }

  @media (prefers-reduced-motion: reduce) {
    .hs { height: auto; }
    .hs-sticky { position: static; height: auto; padding: 12vh 0; }
    .track { overflow-x: auto; width: auto; scroll-snap-type: x mandatory; padding-bottom: 1.5rem; }
    .card { scroll-snap-align: start; }
    .statement { margin-top: 0; border-radius: 0; border-top: 0; }
  }
</style>
</head>
<body>

<nav class="nav" aria-label="Navigasi utama">
  <a href="/" class="nav-home" aria-label="Kembali ke beranda">Home</a>
  <button class="nav-logo" id="menuBtn" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="menu">
    <svg viewBox="0 0 522 80" aria-hidden="true" focusable="false">
      <defs><clipPath id="logo-clip"><rect x="-20" y="0" width="600" height="80"/></clipPath></defs>
      <g clip-path="url(#logo-clip)" fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10">
        <path d="M2 -5 L24 69 L44 33 L64 69 L86 -5"/>
        <g transform="translate(104 0)"><path d="M1 83 L40 10 L79 83"/><rect class="bar" x="29" y="49" width="22" height="5" stroke="none"/></g>
        <g transform="translate(199 0)"><path d="M1 83 L40 10 L79 83"/><rect class="bar" x="29" y="49" width="22" height="5" stroke="none"/></g>
        <g transform="translate(294 0)"><path d="M4 0 V80"/><path d="M4 4 H46 L62 20 V32 L47 47 H4"/><path d="M40 47 L65 84"/></g>
        <g transform="translate(378 0)"><path d="M4 -5 V76 H56"/></g>
        <g transform="translate(452 0)"><path d="M4 4 H44 L66 26 V54 L44 76 H4 Z"/></g>
      </g>
    </svg>
  </button>
</nav>

<div class="menu" id="menu" role="dialog" aria-label="Menu" aria-hidden="true">
  <ul>
    <li><a href="/" style="--i:0"><span class="t">Home</span><span class="n">01</span></a></li>
    <li><a href="#s4" style="--i:1"><span class="t">Footprint</span><span class="n">02</span></a></li>
  </ul>
</div>

<section class="hero" id="s1">
  <div class="orb a" data-speed="-0.15"></div>
  <div class="orb b" data-speed="0.25"></div>
  <div class="orb c" data-speed="0.5"></div>
  <div class="orb d" data-speed="-0.3"></div>
  <h1 data-speed="0.18" aria-label="waarld?"><span class="ch" style="--i:0" aria-hidden="true">w</span><span class="ch" style="--i:1" aria-hidden="true">a</span><span class="ch" style="--i:2" aria-hidden="true">a</span><span class="ch" style="--i:3" aria-hidden="true">r</span><span class="ch" style="--i:4" aria-hidden="true">l</span><span class="ch" style="--i:5" aria-hidden="true">d</span><span class="ch q" style="--i:6" aria-hidden="true">?</span></h1>
  <p class="sub reveal" style="--d:1.2s">Scroll untuk mulai bertanya.</p>
</section>

<section class="hs" id="s2">
  <div class="hs-sticky">
    <h2 class="hs-head" data-split>The Half-Dozen People</h2>
    <div class="track">
      <article class="card"><i></i><div><h3>Wanda</h3><p>Muhamad Suwanda, Mahasiswa Sistem Informasi Universitas Nurdin Hamzah</p></div></article>
      <article class="card"><i></i><div><h3>Arif</h3><p>M. Ariffan Hidayah, Mahasiswa Teknik Informatika Universitas Nurdin Hamzah</p></div></article>
      <article class="card"><i></i><div><h3>Akid</h3><p>Andika Dwi Putra, Mahasiswa Teknik Informatika Universitas Nurdin Hamzah</p></div></article>
      <article class="card"><i></i><div><h3>Rama</h3><p>Ramadhani Sanjaya, Mahasiswa Ilmu Pemerintahan Universitas Nurdin Hamzah</p></div></article>
      <article class="card"><i></i><div><h3>Lelek</h3><p>Ananda Gita April Yanto, Mahasiswa Teknik Informatika Universitas Nurdin Hamzah</p></div></article>
      <article class="card"><i></i><div><h3>Dimas</h3><p>Dimas Zaky Abiyyu, Mahasiswa Teknik Informatika Universitas Nurdin Hamzah.</p></div></article>
    </div>
  </div>
</section>

<section class="statement" id="s3">
  <figure class="quote">
    <span class="mark" aria-hidden="true">“</span>
    <blockquote>
      <p data-split>It takes something more than intelligence to act intelligently.</p>
    </blockquote>
    <figcaption class="reveal" style="--d:.9s">
      <span class="rule" aria-hidden="true"></span>
      <span>Fyodor Dostoyevsky, <cite><a>Crime and Punishment</a></cite></span>
    </figcaption>
  </figure>
</section>

<section class="closing" id="s4">
  <div class="arc-head">
    <div><h2 class="arc-title">Jejak yang tertinggal</h2></div>
  </div>
  <div class="g-view" id="gView" aria-label="Galeri dokumentasi waarld">
    <div class="g-track" id="gTrack">
        <!-- Ganti .frame dengan <img src="..." alt="..."> untuk foto asli -->
        <figure class="shot"><div class="frame"></div></figure>
        <figure class="shot"><div class="frame"></div></figure>
        <figure class="shot"><div class="frame"></div></figure>
        <figure class="shot"><div class="frame"></div></figure>
        <figure class="shot"><div class="frame"></div></figure>
        <figure class="shot"><div class="frame"></div></figure>
    </div>
  </div>
</section>

<script>
(function () {
  var reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  if (!reduce) {
    document.querySelectorAll("[data-split]").forEach(function (el) {
      var txt = el.textContent.trim();
      el.setAttribute("aria-label", txt);
      el.innerHTML = txt.split(/\s+/).map(function (w, i) {
        return '<span class="w" aria-hidden="true"><span style="--i:' + i + '">' + w + '</span></span>';
      }).join(" ");
    });
  }
  var items = Array.prototype.slice.call(document.querySelectorAll("[data-speed]"));
  var hs = document.getElementById("s2");
  var track = hs.querySelector(".track");
  var stick = hs.querySelector(".hs-sticky");
  var st = document.getElementById("s3");
  var ticking = false;

  function sizeHS() {
    if (reduce) return;
    hs.style.height = (track.scrollWidth - window.innerWidth + window.innerHeight * 2) + "px";
  }

  function update() {
    ticking = false;
    var vh = window.innerHeight;
    if (!reduce) {
      items.forEach(function (el) {
        var sec = el.closest("section");
        var r = sec.getBoundingClientRect();
        if (r.bottom < -200 || r.top > vh + 200) return;
        var d = (r.top + r.height / 2) - vh / 2;
        el.style.transform = "translate3d(0," + (d * parseFloat(el.dataset.speed)).toFixed(1) + "px,0)";
      });
      var hr = hs.getBoundingClientRect();
      var dist0 = Math.max(1, track.scrollWidth - window.innerWidth);
      var sr = st.getBoundingClientRect();
      var c = Math.min(1, Math.max(0, 1 - sr.top / vh));
      var p = Math.min(1, Math.max(0, -hr.top / dist0));
      track.style.transform = "translate3d(" + (-p * dist0).toFixed(1) + "px,0,0)";
      stick.style.transform = "scale(" + (1 - 0.08 * c).toFixed(3) + ")";
    }
  }

  function onScroll() { if (!ticking) { ticking = true; requestAnimationFrame(update); } }

  var targets = [].slice.call(document.querySelectorAll("#s1, #s3, #s4, .hs-sticky, .card"));
  var io = "IntersectionObserver" in window ? new IntersectionObserver(function (es) {
    es.forEach(function (e) {
      if (!e.isIntersecting) return;
      var t = e.target;
      (t.classList.contains("card") ? t : t.closest("section")).classList.add("in");
      io.unobserve(t);
    });
  }, { threshold: 0.15 }) : null;
  targets.forEach(function (t) {
    if (io) io.observe(t);
    else (t.classList.contains("card") ? t : t.closest("section")).classList.add("in");
  });

  window.addEventListener("scroll", onScroll, { passive: true });
  window.addEventListener("resize", function () { sizeHS(); onScroll(); });
  window.addEventListener("load", function () { sizeHS(); update(); });
  sizeHS(); update();
})();
</script>
<script>
(function () {
  var reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  var nav = document.querySelector(".nav");
  var btn = document.getElementById("menuBtn");
  var menu = document.getElementById("menu");
  var secs = ["s1", "s2", "s3", "s4"].map(function (id) { return document.getElementById(id); });
  var isOpen = false, busy = false, closeT = null, tick = false;

  function theme() {
    var light = false;
    secs.forEach(function (s) {
      var r = s.getBoundingClientRect();
      if (r.top <= 30 && r.bottom > 30) light = (s.id !== "s4");
    });
    nav.classList.toggle("on-dark", light);
  }
  function onScroll() { if (!tick) { tick = true; requestAnimationFrame(function () { tick = false; theme(); }); } }
  window.addEventListener("scroll", onScroll, { passive: true });
  window.addEventListener("resize", onScroll);
  window.addEventListener("load", theme);
  theme();

  function center() {
    var r = btn.querySelector("svg").getBoundingClientRect();
    return { x: r.left + r.width / 2, y: r.top + r.height / 2 };
  }
  function setFill(x, y) {
    var R = Math.hypot(Math.max(x, window.innerWidth - x), Math.max(y, window.innerHeight - y)) + 24;
    menu.style.setProperty("--x", x + "px");
    menu.style.setProperty("--y", y + "px");
    menu.style.setProperty("--r", R + "px");
  }
  function rand(a, b) { return a + Math.random() * (b - a); }

  function pop(x, y) {
    var N = 18;
    for (var i = 0; i < N; i++) {
      var el = document.createElement("div");
      var size = rand(7, 16), ang = (i / N) * Math.PI * 2 + rand(-.2, .2), dist = rand(90, 240);
      el.className = "shard";
      el.style.width = el.style.height = size + "px";
      if (i % 3 === 0) { el.style.clipPath = "polygon(50% 0, 100% 100%, 0 100%)"; el.style.boxShadow = "none"; }
      else el.style.borderRadius = "50%";
      document.body.appendChild(el);
      var dx = Math.cos(ang) * dist, dy = Math.sin(ang) * dist + 50;
      el.animate([
        { transform: "translate(" + (x - size / 2) + "px," + (y - size / 2) + "px) rotate(0deg) scale(1)", opacity: 1 },
        { transform: "translate(" + (x + dx - size / 2) + "px," + (y + dy - size / 2) + "px) rotate(" + rand(-300, 300) + "deg) scale(.3)", opacity: 0 }
      ], { duration: rand(350, 550), easing: "cubic-bezier(.15,.8,.3,1)", fill: "forwards" })
        .onfinish = (function (n) { return function () { n.remove(); }; })(el);
    }
    var ring = document.createElement("div");
    ring.className = "pop-ring";
    ring.style.left = (x - 30) + "px"; ring.style.top = (y - 30) + "px";
    document.body.appendChild(ring);
    ring.animate([
      { transform: "scale(.4)", opacity: .95 },
      { transform: "scale(5)", opacity: 0 }
    ], { duration: 380, easing: "cubic-bezier(.2,.7,.2,1)", fill: "forwards" })
      .onfinish = function () { ring.remove(); };
  }

  function show() {
    isOpen = true; busy = false;
    clearTimeout(closeT);
    nav.classList.remove("popping");
    nav.classList.add("is-open");
    menu.classList.add("open");
    menu.setAttribute("aria-hidden", "false");
    btn.setAttribute("aria-expanded", "true");
    setTimeout(function () { var a = menu.querySelector("a"); if (a && isOpen) a.focus({ preventScroll: true }); }, 400);
  }

  function openMenu() {
    if (busy || isOpen) return;
    var c = center();
    setFill(c.x, c.y);
    if (reduce) { show(); return; }
    busy = true;
    nav.classList.add("popping");
    var b = document.createElement("div");
    b.className = "ball";
    b.style.left = c.x + "px"; b.style.top = c.y + "px";
    document.body.appendChild(b);
    var t = "translate(-50%,-50%) ";
    var a = b.animate([
      { transform: t + "scale(0)", easing: "cubic-bezier(.2,.9,.3,1.2)" },
      { transform: t + "scale(1.1)", offset: .45, easing: "ease-out" },
      { transform: t + "scale(1.9)" }
    ], { duration: 280, fill: "forwards" });
    a.onfinish = function () { b.remove(); pop(c.x, c.y); show(); };
  }

  function closeMenu() {
    if (busy || !isOpen) return;
    isOpen = false;
    menu.classList.remove("open");
    menu.setAttribute("aria-hidden", "true");
    btn.setAttribute("aria-expanded", "false");
    btn.setAttribute("aria-label", "Buka menu");
    closeT = setTimeout(function () { nav.classList.remove("is-open"); }, reduce ? 0 : 750);
  }

  btn.addEventListener("click", function () { isOpen ? closeMenu() : openMenu(); });
  document.addEventListener("keydown", function (e) { if (e.key === "Escape") closeMenu(); });
  menu.addEventListener("wheel", function (e) { e.preventDefault(); }, { passive: false });
  menu.addEventListener("touchmove", function (e) { e.preventDefault(); }, { passive: false });

  menu.querySelectorAll("a").forEach(function (a) {
    a.addEventListener("click", function (e) {
      var id = a.getAttribute("href");
      if (id.charAt(0) !== "#") return;
      e.preventDefault();
      closeMenu();
      setTimeout(function () {
        var behavior = reduce ? "auto" : "smooth";
        if (id === "#s1") window.scrollTo({ top: 0, behavior: behavior });
        else document.querySelector(id).scrollIntoView({ behavior: behavior });
      }, 120);
    });
  });
})();
</script>
<script>
/* Galeri: bergerak sendiri ke kanan, jeda saat hover, bisa digeser, penghitung aktif */
(function () {
  var view = document.getElementById("gView"), track = document.getElementById("gTrack");
  var now = document.getElementById("cNow");
  if (!view || !track || window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

  var n = track.children.length;
  for (var k = 0; k < 2; k++) Array.prototype.slice.call(track.children, 0, n).forEach(function (el) {
    var c = el.cloneNode(true); c.setAttribute("aria-hidden", "true"); track.appendChild(c);
  });
  var shots = Array.prototype.slice.call(track.children);
  var x = 0, half = 0, speed = 0.28, hover = false, dragging = false, sx = 0, x0 = 0, vis = true, last = -1;

  function measure() { half = shots[n].offsetLeft - shots[0].offsetLeft; if (!x) x = -half + window.innerWidth * 0.08; }
  function wrap() { while (x > 0) x -= half; while (x < -half) x += half; }
  measure();
  window.addEventListener("resize", measure);
  window.addEventListener("load", measure);

  view.addEventListener("mouseenter", function () { hover = true; });
  view.addEventListener("mouseleave", function () { hover = false; });
  view.addEventListener("pointerdown", function (e) {
    dragging = true; sx = e.clientX; x0 = x; view.classList.add("drag");
    try { view.setPointerCapture(e.pointerId); } catch (err) {}
  });
  view.addEventListener("pointermove", function (e) { if (dragging) { x = x0 + (e.clientX - sx); wrap(); } });
  function end() { dragging = false; view.classList.remove("drag"); }
  view.addEventListener("pointerup", end);
  view.addEventListener("pointercancel", end);
  if ("IntersectionObserver" in window) new IntersectionObserver(function (es) { vis = es[0].isIntersecting; }).observe(view);

  function active() {
    var focus = window.innerWidth * 0.35, best = 0, bd = 1e9;
    shots.forEach(function (el, i) {
      var d = Math.abs(el.offsetLeft + x + el.offsetWidth / 2 - focus);
      if (d < bd) { bd = d; best = i; }
    });
    if (best === last) return;
    if (last >= 0) shots[last].classList.remove("is-active");
    shots[best].classList.add("is-active"); last = best;
    if (now) now.textContent = ("0" + ((best % n) + 1)).slice(-2);
  }
  function frame() {
    if (vis) {
      if (!hover && !dragging) { x += speed; wrap(); }
      track.style.transform = "translate3d(" + x.toFixed(1) + "px,0,0)";
      active();
    }
    requestAnimationFrame(frame);
  }
  requestAnimationFrame(frame);
})();
</script>
<script>
/* Efek miring halus pada foto saat kursor bergerak di atasnya */
(function () {
  var view = document.getElementById("gView");
  if (!view || window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;
  var cur = null;

  function reset(f) {
    if (!f) return;
    f.style.setProperty("--rx", "0deg");
    f.style.setProperty("--ry", "0deg");
  }
  view.addEventListener("pointermove", function (e) {
    if (e.pointerType !== "mouse") return;
    var f = e.target.closest ? e.target.closest(".frame") : null;
    if (f !== cur) { reset(cur); cur = f; }
    if (!f) return;
    var r = f.getBoundingClientRect();
    var px = (e.clientX - r.left) / r.width - 0.5;
    var py = (e.clientY - r.top) / r.height - 0.5;
    f.style.setProperty("--ry", (px * 12).toFixed(2) + "deg");
    f.style.setProperty("--rx", (-py * 12).toFixed(2) + "deg");
  });
  view.addEventListener("pointerleave", function () { reset(cur); cur = null; });
})();
</script>
</body>
</html>
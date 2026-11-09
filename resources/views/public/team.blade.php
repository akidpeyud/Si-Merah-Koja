<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Warld?</title>
<script>if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) document.documentElement.classList.add("js");</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;600;900&display=swap" rel="stylesheet">
<style>
  :root {
    /* 60% navy · 30% putih · 10% lime yellow */
    --navy: #0a1a44;
    --navy-2: #12275c;
    --white: #ffffff;
    --lime: #d4ff3a;
    --font: "Archivo", "Helvetica Neue", Arial, sans-serif;
    box-sizing: border-box;
    padding-top: env(safe-area-inset-top, 0px);
    padding-bottom: env(safe-area-inset-bottom, 0px);
  }
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  html { scroll-padding-top: env(safe-area-inset-top, 0px); }
  body { background: var(--navy); color: var(--white); font-family: var(--font); line-height: 1.5; overflow-x: hidden; }
  section { position: relative; overflow: hidden; }
  [data-speed] { will-change: transform; }

  /* ---------- 1. HERO ---------- */
  .hero { min-height: 100vh; min-height: 100svh; display: grid; place-items: center; background: var(--navy); }
  .hero h1 {
    font-weight: 900; line-height: .8; letter-spacing: -.04em;
    font-size: clamp(5rem, 24vw, 26rem); text-align: center; position: relative; z-index: 2;
  }
  .hero h1 .q { color: var(--lime); display: inline-block; }
  .hero .sub { position: absolute; bottom: 8vh; left: 0; right: 0; text-align: center; z-index: 2; font-size: 1rem; opacity: .75; }
  .orb { position: absolute; border-radius: 50%; z-index: 1; }
  .orb.a { width: 38vw; height: 38vw; background: var(--navy-2); top: -8vw; left: -10vw; }
  .orb.b { width: 22vw; height: 22vw; border: 2px solid var(--white); opacity: .5; right: 6vw; top: 18vh; }
  .orb.c { width: 9vw; height: 9vw; background: var(--lime); left: 14vw; bottom: 16vh; }
  .orb.d { width: 30vw; height: 30vw; background: var(--navy-2); right: -9vw; bottom: -10vw; }

  /* ---------- 2. HORIZONTAL SCROLL ---------- */
  .hs { background: var(--white); color: var(--navy); height: 400vh; overflow: visible; }
  .hs-sticky { position: sticky; top: 0; height: 100vh; height: 100svh; overflow: hidden; display: flex; flex-direction: column; justify-content: center; gap: 4vh; }
  .hs-head { padding: 0 8vw; font-size: clamp(1.6rem, 4vw, 3.2rem); font-weight: 900; letter-spacing: -.02em; line-height: 1.05; max-width: 20ch; }
  .track { display: flex; gap: 3vw; padding: 0 8vw; width: max-content; will-change: transform; }
  .card {
    flex: 0 0 auto; width: min(80vw, 480px); height: 52vh; min-height: 300px; padding: clamp(1.4rem, 3vw, 2.4rem);
    background: var(--navy); color: var(--white); border-radius: 28px;
    display: flex; flex-direction: column; justify-content: space-between;
  }
  .card h3 { font-size: clamp(1.8rem, 3.6vw, 3rem); font-weight: 900; line-height: 1; letter-spacing: -.03em; }
  .card p { max-width: 34ch; opacity: .85; }
  .card i { display: block; width: 56px; height: 8px; background: var(--lime); border-radius: 8px; }
  
  
  .progress { position: absolute; left: 8vw; right: 8vw; bottom: 5vh; height: 4px; background: rgba(10,26,68,.15); border-radius: 4px; }
  .progress b { display: block; height: 100%; width: 100%; background: var(--navy); border-radius: 4px; transform-origin: left; transform: scaleX(0); }

  .card.lime { background: var(--lime); color: var(--navy); }
  .card.lime i { background: var(--navy); }
  
  

  /* ---------- 3. PARALLAX STATEMENT ---------- */
  .statement { min-height: 140vh; background: var(--navy); display: grid; place-items: center; padding: 20vh 8vw; margin-top: -100vh; margin-top: -100svh; z-index: 6; border-radius: 48px 48px 0 0; box-shadow: 0 -30px 80px rgba(0,0,0,.35); }
  .statement p { position: relative; z-index: 2; font-size: clamp(2rem, 6.2vw, 6rem); font-weight: 900; line-height: 1; letter-spacing: -.03em; max-width: 16ch; }
  .ghost { position: absolute; font-weight: 900; letter-spacing: -.04em; line-height: .8; white-space: nowrap; z-index: 1; color: transparent; -webkit-text-stroke: 2px var(--navy-2); font-size: clamp(8rem, 32vw, 34rem); }
  .ghost.g1 { top: 4vh; left: -4vw; }
  .ghost.g2 { bottom: 2vh; right: -6vw; }
  .dot { position: absolute; width: 14px; height: 14px; border-radius: 50%; background: var(--lime); z-index: 2; }
  .dot.d1 { top: 22%; right: 14%; } .dot.d2 { bottom: 26%; left: 10%; width: 22px; height: 22px; }

  /* ---------- 4. CLOSING ---------- */
  .closing { min-height: 100vh; min-height: 100svh; background: var(--navy); display: grid; place-items: center; text-align: center; padding: 12vh 8vw; }
  .closing h2 { font-size: clamp(2.4rem, 8vw, 7rem); font-weight: 900; letter-spacing: -.04em; line-height: .95; position: relative; z-index: 2; }
  .closing p { margin: 1.5rem auto 2.2rem; max-width: 42ch; opacity: .8; position: relative; z-index: 2; }
  .btn { display: inline-block; background: var(--lime); color: var(--navy); font-weight: 900; text-decoration: none; padding: 1rem 2.2rem; border-radius: 999px; position: relative; z-index: 2; transition: transform .2s; }
  .btn:hover { transform: scale(1.06); }
  .btn:focus-visible { outline: 3px solid var(--white); outline-offset: 4px; }
  .ring { position: absolute; border-radius: 50%; border: 2px solid var(--navy-2); width: 70vw; height: 70vw; left: 15vw; top: 50%; margin-top: -35vw; z-index: 1; }

  /* ---------- animasi muncul ---------- */
  .w { display: inline-block; overflow: hidden; vertical-align: top; padding-bottom: .12em; margin-bottom: -.12em; }
  .w > span { display: inline-block; }
  .js .w > span { transform: translateY(115%); transition: transform .9s cubic-bezier(.2,.7,.1,1) calc(var(--i) * 70ms + .15s); }
  .in .w > span { transform: none; }
  .js .ch { display: inline-block; opacity: 0; transform: translateY(45%); transition: opacity .8s ease calc(var(--i) * 90ms + .2s), transform 1.1s cubic-bezier(.2,.7,.1,1) calc(var(--i) * 90ms + .2s); }
  .in .ch { opacity: 1; transform: none; }
  .js .orb, .js .ghost, .js .dot, .js .ring { opacity: 0; transition: opacity 1.6s ease .3s; }
  .in .orb, .in .ghost, .in .dot, .in .ring { opacity: 1; }
  .in .orb.b { opacity: .5; }
  .js .card { opacity: 0; transform: translateY(70px) scale(.94); transition: opacity .8s ease, transform 1s cubic-bezier(.2,.7,.1,1); }
  .js .card.in { opacity: 1; transform: none; }
  .js .reveal { opacity: 0; transform: translateY(28px); transition: opacity .9s ease var(--d, 0s), transform .9s cubic-bezier(.2,.7,.1,1) var(--d, 0s); }
  .in .reveal { opacity: 1; transform: none; }

  /* ---------- reduced motion ---------- */
  @media (prefers-reduced-motion: reduce) {
    .hs { height: auto; }
    .hs-sticky { position: static; height: auto; padding: 12vh 0; }
    .track { overflow-x: auto; width: auto; scroll-snap-type: x mandatory; padding-bottom: 1.5rem; }
    .card { scroll-snap-align: start; }
    .progress { display: none; }
    .statement { margin-top: 0; border-radius: 0; box-shadow: none; }
  }
</style>
</head>
<body>

<section class="hero" id="s1">
  <div class="orb a" data-speed="-0.15"></div>
  <div class="orb b" data-speed="0.25"></div>
  <div class="orb c" data-speed="0.5"></div>
  <div class="orb d" data-speed="-0.3"></div>
  <h1 data-speed="0.18" aria-label="WARLD?"><span class="ch" style="--i:0" aria-hidden="true">W</span><span class="ch" style="--i:1" aria-hidden="true">A</span><span class="ch" style="--i:2" aria-hidden="true">R</span><span class="ch" style="--i:3" aria-hidden="true">L</span><span class="ch" style="--i:4" aria-hidden="true">D</span><span class="ch q" style="--i:5" aria-hidden="true">?</span></h1>
  <p class="sub reveal" style="--d:1.2s">Scroll untuk mulai bertanya.</p>
</section>

<section class="hs" id="s2">
  <div class="hs-sticky">
    <h2 class="hs-head" data-split>Enam pertanyaan tentang dunia</h2>
    <div class="track">
      <article class="card"><i></i><div><h3>Di mana dunia dimulai?</h3><p>Dari kamar, dari kota, atau dari peta yang belum pernah kamu buka.</p></div></article>
      <article class="card"><i></i><div><h3>Siapa yang membuat aturannya?</h3><p>Setiap aturan pernah jadi pertanyaan sebelum menjadi kebiasaan.</p></div></article>
      <article class="card lime"><i></i><div><h3>Apa yang berubah kalau kamu pergi?</h3><p>Jarak mengubah cara kita melihat rumah dan orang-orang di dalamnya.</p></div></article>
      <article class="card"><i></i><div><h3>Apa yang kamu bawa pulang?</h3><p>Setiap perjalanan meninggalkan sesuatu, dan tidak selalu berupa barang.</p></div></article>
      <article class="card"><i></i><div><h3>Seberapa jauh itu jauh?</h3><p>Ada tempat yang hanya sepelemparan batu, tapi terasa seperti benua lain.</p></div></article>
      <article class="card"><i></i><div><h3>Kamu mau jadi bagian yang mana?</h3><p>Pertanyaan terakhir selalu milikmu sendiri.</p></div></article>
    </div>
    <div class="progress"><b></b></div>
  </div>
</section>

<section class="statement" id="s3">
  <div class="ghost g1" data-speed="0.2" aria-hidden="true">WARLD</div>
  <div class="ghost g2" data-speed="-0.2" aria-hidden="true">WARLD</div>
  <span class="dot d1" data-speed="0.6"></span>
  <span class="dot d2" data-speed="-0.5"></span>
  <p data-speed="0.08" data-split>Dunia bukan tempat. Dunia adalah pertanyaan yang kamu bawa ke mana-mana.</p>
</section>

<section class="closing" id="s4">
  <div class="ring" data-speed="0.12" aria-hidden="true"></div>
  <div>
    <h2 data-speed="0.06" data-split>Jadi, warld?</h2>
    <div class="reveal" style="--d:.9s">
      <p>Mulai dari satu pertanyaan kecil hari ini.</p>
      <a class="btn" href="#s1">Kembali ke atas</a>
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
  var bar = hs.querySelector(".progress b");
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
      
      var dist = dist0;
      track.style.transform = "translate3d(" + (-p * dist).toFixed(1) + "px,0,0)";
      bar.style.transform = "scaleX(" + p.toFixed(3) + ")";
      stick.style.transform = "scale(" + (1 - 0.08 * c).toFixed(3) + ")";
      stick.style.filter = "brightness(" + (1 - 0.35 * c).toFixed(3) + ")";
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
</body>
</html>

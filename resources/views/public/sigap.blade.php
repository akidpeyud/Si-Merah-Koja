<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peta Kecamatan Kota Jambi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root { --ink:#1d2b2a; --muted:#5c6b69; --bg:#f6f7f5; --line:#d9dedb; --river:#1f6f78; }
        * { box-sizing: border-box; }
        html, body { height: 100%; margin: 0; }
        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: var(--ink); background: var(--bg);
            display: grid; grid-template-columns: 320px 1fr;
        }
        aside { border-right: 1px solid var(--line); display: flex; flex-direction: column; min-height: 0; }
        header { padding: 1.25rem 1.25rem 1rem; }
        h1 { font-size: 1.25rem; line-height: 1.3; margin: 0 0 .25rem; }
        header p { margin: 0; color: var(--muted); font-size: .875rem; }
        #cari {
            margin: 0 1.25rem .75rem; padding: .6rem .75rem; font: inherit;
            border: 1px solid var(--line); border-radius: 6px; background: #fff; color: var(--ink);
        }
        #cari:focus-visible, .item:focus-visible { outline: 2px solid var(--river); outline-offset: 1px; }
        #daftar { list-style: none; margin: 0; padding: 0 .5rem 1rem; overflow: auto; flex: 1; }
        .item {
            all: unset; box-sizing: border-box; width: 100%; cursor: pointer;
            display: flex; align-items: center; gap: .75rem; padding: .6rem .75rem; border-radius: 6px;
        }
        .item:hover, .item.aktif { background: #e7ecea; }
        .item:focus-visible { outline: 2px solid var(--river); }
        .warna { width: 14px; height: 14px; border-radius: 3px; flex: none; }
        .kosong { padding: .75rem; color: var(--muted); font-size: .875rem; line-height: 1.5; }
        #map { height: 100%; min-height: 0; }
        .popup h3 { margin: 0 0 .4rem; font-size: 1rem; }
        .popup table { border-collapse: collapse; font-size: .8rem; }
        .popup td { padding: .15rem .6rem .15rem 0; vertical-align: top; }
        .popup td:first-child { color: var(--muted); }
        @media (max-width: 760px) {
            body { grid-template-columns: 1fr; grid-template-rows: 50% 1fr; }
            #map { order: -1; }
            aside { border-right: 0; border-top: 1px solid var(--line); }
        }
    </style>
</head>
<body>
    <aside>
        <header>
            <h1>Kecamatan Kota Jambi</h1>
            <p id="ringkas">Memuat data…</p>
        </header>
        <input id="cari" type="search" placeholder="Cari kecamatan" aria-label="Cari kecamatan">
        <ul id="daftar"></ul>
    </aside>
    <div id="map"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
    <script>
        // Nama kolom atribut dari QGIS yang berisi nama kecamatan (dicoba berurutan).
        const KOLOM_NAMA = ['kecamatan', 'KECAMATAN', 'Kecamatan', 'WADMKC', 'NAMOBJ', 'nama', 'NAME_3'];
        const PALET = ['#1f6f78', '#c8553d', '#e8a33d', '#6a8f3f', '#7b5ea7', '#3d7ac8',
                       '#b5527a', '#8a7a4a', '#2f9e8f', '#a66a3f', '#5c6b8a'];

        const map = L.map('map').setView([-1.6101, 103.6131], 12);
        const jalan = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19, attribution: '&copy; OpenStreetMap'
        }).addTo(map);
        const citra = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            maxZoom: 19, attribution: 'Esri'
        });
        L.control.layers({ 'Peta jalan': jalan, 'Citra satelit': citra }).addTo(map);

        const esc = s => String(s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
        const getNama = p => { for (const k of KOLOM_NAMA) if (p[k]) return p[k]; return 'Tanpa nama'; };

        const daftar = document.getElementById('daftar');
        const layers = {}, warnaNama = {}, tombol = {};
        let geojson;

        function sorot(nama, aktif) {
            (layers[nama] || []).forEach(l => aktif
                ? l.setStyle({ weight: 3, color: '#1d2b2a', fillOpacity: .8 })
                : geojson.resetStyle(l));
            tombol[nama]?.classList.toggle('aktif', aktif);
        }

        function pilih(nama) {
            map.fitBounds(L.featureGroup(layers[nama]).getBounds(), { padding: [30, 30] });
            layers[nama][0].openPopup();
        }

        function popupHtml(p, nama) {
            const baris = Object.entries(p).filter(([, v]) => v !== null && v !== '')
                .map(([k, v]) => `<tr><td>${esc(k)}</td><td>${esc(v)}</td></tr>`).join('');
            return `<div class="popup"><h3>${esc(nama)}</h3><table>${baris}</table></div>`;
        }

        fetch("{{ asset('geojson/kecamatan_jambi.geojson') }}")
            .then(r => { if (!r.ok) throw new Error(r.status); return r.json(); })
            .then(data => {
                const nama = [...new Set(data.features.map(f => getNama(f.properties)))].sort();
                nama.forEach((n, i) => warnaNama[n] = PALET[i % PALET.length]);

                geojson = L.geoJSON(data, {
                    style: f => ({ color: '#fff', weight: 1.5, fillColor: warnaNama[getNama(f.properties)], fillOpacity: .55 }),
                    onEachFeature: (f, layer) => {
                        const n = getNama(f.properties);
                        (layers[n] ||= []).push(layer);
                        layer.bindTooltip(n, { sticky: true });
                        layer.bindPopup(popupHtml(f.properties, n));
                        layer.on({ mouseover: () => sorot(n, true), mouseout: () => sorot(n, false), click: () => pilih(n) });
                    }
                }).addTo(map);
                map.fitBounds(geojson.getBounds());

                nama.forEach(n => {
                    const li = document.createElement('li');
                    li.innerHTML = `<button class="item"><span class="warna" style="background:${warnaNama[n]}"></span>${esc(n)}</button>`;
                    const b = li.firstChild;
                    tombol[n] = b;
                    b.addEventListener('click', () => pilih(n));
                    b.addEventListener('mouseenter', () => sorot(n, true));
                    b.addEventListener('mouseleave', () => sorot(n, false));
                    daftar.appendChild(li);
                });
                document.getElementById('ringkas').textContent = `${nama.length} kecamatan`;
            })
            .catch(() => {
                document.getElementById('ringkas').textContent = 'Data belum tersedia';
                daftar.innerHTML = '<li class="kosong">File GeoJSON tidak ditemukan. Simpan hasil ekspor QGIS di public/geojson/kecamatan_jambi.geojson.</li>';
            });

        document.getElementById('cari').addEventListener('input', e => {
            const q = e.target.value.toLowerCase();
            daftar.querySelectorAll('li').forEach(li => li.hidden = !li.textContent.toLowerCase().includes(q));
        });
    </script>
</body>
</html>
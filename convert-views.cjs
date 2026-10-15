#!/usr/bin/env node
/**
 * Mengubah halaman Blade "mandiri" (membawa topbar + sidebar sendiri)
 * menjadi halaman yang memakai layouts/dashboard.blade.php.
 *
 * Pakai (dari folder root proyek Laravel):
 *   node convert-views.js            -> DRY RUN: hasil ditulis ke storage/converted-views/
 *   node convert-views.js --apply    -> menimpa file asli (asli disalin ke storage/views-backup/)
 */
const fs = require("fs");
const path = require("path");

const ROOT = process.cwd();
const VIEWS = path.join(ROOT, "resources", "views");
const LAYOUT = path.join(VIEWS, "layouts", "dashboard.blade.php");
const APPLY = process.argv.includes("--apply");
const OUT_DIR = path.join(
    ROOT,
    "storage",
    APPLY ? "views-backup" : "converted-views",
);

if (!fs.existsSync(LAYOUT)) {
    console.error(
        "Tidak menemukan " +
            LAYOUT +
            "\nJalankan script ini dari folder root proyek Laravel.",
    );
    process.exit(1);
}

/* ------------------------------------------------------------------ */
/* Util: parser CSS sederhana                                          */
/* ------------------------------------------------------------------ */
const norm = (s) =>
    s
        .replace(/\s+/g, " ")
        .replace(/\s*([:;,{}])\s*/g, "$1")
        .replace(/;$/, "")
        .trim()
        .toLowerCase();

function stripCssComments(css) {
    return css.replace(/\/\*[\s\S]*?\*\//g, "");
}

// Pecah CSS menjadi blok top-level: { prelude, body, raw }
function parseBlocks(css) {
    const blocks = [];
    let depth = 0,
        start = 0,
        preludeEnd = -1;
    for (let i = 0; i < css.length; i++) {
        const ch = css[i];
        if (ch === "{") {
            if (depth === 0) preludeEnd = i;
            depth++;
        } else if (ch === "}") {
            depth--;
            if (depth === 0) {
                const prelude = css.slice(start, preludeEnd).trim();
                const body = css.slice(preludeEnd + 1, i);
                blocks.push({
                    prelude,
                    body,
                    raw: css.slice(start, i + 1).trim(),
                });
                start = i + 1;
            }
        }
    }
    return blocks;
}

const isNested = (prelude) =>
    /^@(media|supports|container|layer)\b/i.test(prelude);

// Kumpulkan "kunci" aturan dari CSS layout: prefix + selector -> Set(deklarasi ternormalisasi)
function collectKeys(css, prefix, map) {
    for (const b of parseBlocks(stripCssComments(css))) {
        if (isNested(b.prelude)) {
            collectKeys(b.body, prefix + norm(b.prelude) + ">>", map);
        } else {
            const key = prefix + norm(b.prelude);
            if (!map.has(key)) map.set(key, new Set());
            map.get(key).add(norm(b.body));
        }
    }
}

// Saring CSS halaman: buang aturan yang sudah identik dengan layout
function filterCss(css, prefix, map, stats) {
    const kept = [];
    for (const b of parseBlocks(stripCssComments(css))) {
        if (isNested(b.prelude)) {
            const inner = filterCss(
                b.body,
                prefix + norm(b.prelude) + ">>",
                map,
                stats,
            );
            if (inner.length)
                kept.push(
                    b.prelude +
                        " {\n" +
                        inner.map((x) => "    " + x).join("\n") +
                        "\n}",
                );
        } else {
            const key = prefix + norm(b.prelude);
            const set = map.get(key);
            if (set && set.has(norm(b.body))) {
                stats.dropped++;
            } else {
                stats.kept++;
                kept.push(b.raw);
            }
        }
    }
    return kept;
}

/* ------------------------------------------------------------------ */
/* Util: file                                                          */
/* ------------------------------------------------------------------ */
function walk(dir, list = []) {
    for (const f of fs.readdirSync(dir, { withFileTypes: true })) {
        const full = path.join(dir, f.name);
        if (f.isDirectory()) walk(full, list);
        else if (f.name.endsWith(".blade.php")) list.push(full);
    }
    return list;
}

const layoutSrc = fs.readFileSync(LAYOUT, "utf8");
const layoutMap = new Map();
for (const m of layoutSrc.matchAll(/<style[^>]*>([\s\S]*?)<\/style>/gi))
    collectKeys(m[1], "", layoutMap);

const KNOWN_LINK =
    /(bootstrap@5|font-awesome|fonts\.googleapis\.com|fonts\.gstatic\.com)/i;
const DUP_SCRIPT = /(bootstrap\.bundle|sweetalert2)/i;

/* ------------------------------------------------------------------ */
/* Hapus bagian JS yang mengurus sidebar/toast (sudah ada di layout)   */
/* ------------------------------------------------------------------ */
function stripSidebarJs(js) {
    const re = /\/\*\s*-{3,}[^*]*?-{3,}\s*\*\//g;
    const markers = [];
    let m;
    while ((m = re.exec(js))) markers.push({ idx: m.index, text: m[0] });
    if (!markers.length) return js;

    let out = js.slice(0, markers[0].idx);
    let lastRemoved = false;
    markers.forEach((mk, i) => {
        const end = i + 1 < markers.length ? markers[i + 1].idx : js.length;
        const chunk = js.slice(mk.idx, end);
        const remove = /sidebar|accordion|notifikasi|toast/i.test(mk.text);
        if (!remove) out += chunk;
        if (i === markers.length - 1) lastRemoved = remove;
    });
    if (lastRemoved) {
        const tail = js.match(/\}\)\(\);?\s*$/);
        if (tail) out += "\n" + tail[0];
    }
    return out;
}

/* ------------------------------------------------------------------ */
/* Konversi satu file                                                  */
/* ------------------------------------------------------------------ */
function convert(src, rel) {
    const warn = [];
    const info = { cssKept: 0, cssDropped: 0 };

    // buang semua @extends lama
    src = src.replace(/^[ \t]*@extends\([^\n]*\)[ \t]*\r?\n?/gm, "");

    const docIdx = src.search(/<!DOCTYPE|<html/i);
    const preamble = docIdx > 0 ? src.slice(0, docIdx).trim() : "";

    // judul
    let title = "";
    const tm = src.match(/<title>([\s\S]*?)<\/title>/i);
    if (tm)
        title = tm[1]
            .trim()
            .replace(/\s*\|\s*SIMERAH KOJA\s*$/i, "")
            .trim();
    if (/@yield|@section/.test(title)) title = "";

    // head
    const headM = src.match(/<head[^>]*>([\s\S]*?)<\/head>/i);
    const head = headM ? headM[1] : "";

    // CSS tambahan khusus halaman
    const stats = { kept: 0, dropped: 0 };
    let keptCss = [];
    for (const m of head.matchAll(/<style[^>]*>([\s\S]*?)<\/style>/gi)) {
        keptCss = keptCss.concat(filterCss(m[1], "", layoutMap, stats));
    }
    info.cssKept = stats.kept;
    info.cssDropped = stats.dropped;

    // <link> dan <script> tambahan di head
    const extraLinks = [];
    for (const m of head.matchAll(/<link\b[^>]*>/gi)) {
        const tag = m[0];
        if (!/rel=["']stylesheet["']/i.test(tag)) continue;
        if (KNOWN_LINK.test(tag)) continue;
        extraLinks.push(tag);
    }
    const headScripts = [];
    for (const m of head.matchAll(/<script\b[^>]*>[\s\S]*?<\/script>/gi)) {
        if (DUP_SCRIPT.test(m[0])) continue;
        headScripts.push(m[0]);
    }

    // main content
    const openM = src.match(
        /<main\b[^>]*class=["'][^"']*\bcontent\b[^"']*["'][^>]*>/i,
    );
    if (!openM) return { skip: 'tidak ada <main class="content">' };
    const openEnd = openM.index + openM[0].length;
    const closeIdx = src.indexOf("</main>", openEnd);
    if (closeIdx < 0) return { skip: "tidak ada </main>" };
    const content = src
        .slice(openEnd, closeIdx)
        .replace(/^\s*\n/, "")
        .replace(/\s+$/, "");

    // setelah </main>: tutup .shell, modal, script
    let tail = src.slice(closeIdx + "</main>".length);
    const bodyEnd = tail.search(/<\/body>/i);
    if (bodyEnd >= 0) tail = tail.slice(0, bodyEnd);
    if (/^\s*<\/div>/.test(tail)) tail = tail.replace(/^\s*<\/div>/, "");
    else
        warn.push(
            "penutup </div> .shell tidak ditemukan tepat setelah </main>, cek manual",
        );

    const firstScript = tail.search(/<script\b/i);
    const modals = (
        firstScript >= 0 ? tail.slice(0, firstScript) : tail
    ).trim();
    const scriptPart = firstScript >= 0 ? tail.slice(firstScript) : "";

    const scripts = [...headScripts];
    for (const m of scriptPart.matchAll(
        /<script\b([^>]*)>([\s\S]*?)<\/script>/gi,
    )) {
        const attrs = m[1],
            body = m[2];
        if (/\bsrc=/i.test(attrs)) {
            if (!DUP_SCRIPT.test(attrs)) scripts.push(m[0]);
            continue;
        }
        const cleaned = stripSidebarJs(body);
        const meaningful = cleaned
            .replace(
                /\(function\s*\(\)\s*\{|['"]use strict['"];?|\}\)\(\);?/g,
                "",
            )
            .replace(/\/\*[\s\S]*?\*\//g, "")
            .trim();
        if (!meaningful) continue;
        if (/getElementById\(['"]sideToggle['"]\)/.test(cleaned)) {
            warn.push(
                "script masih memuat logika sideToggle, hapus manual agar sidebar mobile tidak bentrok",
            );
        }
        scripts.push("<script" + attrs + ">" + cleaned + "</script>");
    }

    // rakit file baru
    const parts = [];
    parts.push("@extends('layouts.dashboard')\n");
    if (title) {
        parts.push(
            /[{}@$\\]/.test(title)
                ? "@section('title')" + title + "@endsection\n"
                : "@section('title', '" + title.replace(/'/g, "\\'") + "')\n",
        );
    }
    if (keptCss.length || extraLinks.length) {
        let p = "@push('styles')\n";
        if (extraLinks.length)
            p += extraLinks.map((l) => "    " + l).join("\n") + "\n";
        if (keptCss.length)
            p +=
                "<style>\n" +
                keptCss
                    .map((c) => "    " + c.replace(/\n/g, "\n    "))
                    .join("\n") +
                "\n</style>\n";
        p += "@endpush\n";
        parts.push(p);
    }
    let section = "@section('content')\n";
    if (preamble) section += preamble + "\n\n";
    section += content + "\n";
    if (modals) section += "\n" + modals + "\n";
    section += "@endsection\n";
    parts.push(section);
    if (scripts.length)
        parts.push("@push('scripts')\n" + scripts.join("\n") + "\n@endpush\n");

    return { out: parts.join("\n"), warn, info };
}

/* ------------------------------------------------------------------ */
/* Main                                                                */
/* ------------------------------------------------------------------ */
const files = walk(VIEWS).filter((f) => {
    const r = path.relative(VIEWS, f).replace(/\\/g, "/");
    return !r.startsWith("layouts/") && !r.startsWith("components/");
});

let converted = 0,
    skipped = 0;
console.log(
    (APPLY ? "[APPLY]" : "[DRY RUN]") +
        " memeriksa " +
        files.length +
        " file...\n",
);

for (const f of files) {
    const rel = path.relative(VIEWS, f).replace(/\\/g, "/");
    const src = fs.readFileSync(f, "utf8");

    const standalone =
        /<html/i.test(src) &&
        /<aside\b[^>]*class=["'][^"']*\bsidebar\b/i.test(src);
    if (!standalone) continue; // halaman biasa / login / publik, jangan diubah

    const res = convert(src, rel);
    if (res.skip) {
        skipped++;
        console.log("LEWATI   " + rel + " (" + res.skip + ")");
        continue;
    }

    const target = APPLY ? f : path.join(OUT_DIR, rel);
    if (APPLY) {
        const bak = path.join(OUT_DIR, rel);
        fs.mkdirSync(path.dirname(bak), { recursive: true });
        fs.writeFileSync(bak, src);
    }
    fs.mkdirSync(path.dirname(target), { recursive: true });
    fs.writeFileSync(target, res.out);
    converted++;

    console.log(
        "OK       " +
            rel +
            "  (css dipertahankan: " +
            res.info.cssKept +
            ", css duplikat dibuang: " +
            res.info.cssDropped +
            ")",
    );
    res.warn.forEach((w) => console.log("  ! " + w));
}

console.log(
    "\nSelesai. Dikonversi: " + converted + ", dilewati: " + skipped + ".",
);
if (!APPLY) {
    console.log(
        "Hasil ada di storage/converted-views/. Periksa 1-2 file, lalu jalankan: node convert-views.js --apply",
    );
} else {
    console.log(
        "Salinan file asli ada di storage/views-backup/. Jalankan: php artisan view:clear",
    );
}

<?php
/**
 * Menyisipkan logo hero ke semua view yang punya "page-hero".
 *
 * Jalankan dari folder root proyek Laravel:
 *   php tools/add-hero-logos.php            (simulasi, tidak mengubah file)
 *   php tools/add-hero-logos.php --apply    (benar-benar mengubah file, backup otomatis)
 */

$apply   = in_array('--apply', $argv, true);
$root    = getcwd() . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views';
$include = "@include('layouts.partials.hero-logos', ['float' => true])";
$backup  = getcwd() . '/storage/hero-logos-backup/' . date('Ymd-His');

if (!is_dir($root)) {
    fwrite(STDERR, "Folder resources/views tidak ditemukan. Jalankan dari root proyek Laravel.\n");
    exit(1);
}

$hasil = ['diubah' => [], 'sudah' => [], 'dilewati' => []];

$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS));
foreach ($it as $file) {
    if (!preg_match('/\.blade\.php$/i', $file->getFilename())) continue;

    $path = $file->getPathname();
    $rel  = str_replace('\\', '/', substr($path, strlen($root) + 1));

    if (strpos($rel, 'layouts/partials/') === 0) continue;

    $src = file_get_contents($path);
    if (stripos($src, 'page-hero') === false) continue;

    if (stripos($src, 'hero-logos') !== false) { $hasil['sudah'][] = $rel; continue; }

    // Cari tag pembuka elemen hero
    $re = '/<(section|header|div)\b[^>]*\bclass\s*=\s*"[^"]*(?<![\w-])page-hero(?![\w-])[^"]*"[^>]*>/i';
    if (!preg_match($re, $src, $m, PREG_OFFSET_CAPTURE)) { $hasil['dilewati'][] = "$rel (tag hero tidak ditemukan)"; continue; }

    $tag   = strtolower($m[1][0]);
    $start = $m[0][1] + strlen($m[0][0]);

    // Cari penutup yang cocok dengan menghitung kedalaman tag
    preg_match_all('#<(/?)' . $tag . '\b#i', $src, $mm, PREG_OFFSET_CAPTURE | PREG_SET_ORDER, $start);
    $depth = 1; $close = null;
    foreach ($mm as $t) {
        $depth += ($t[1][0] === '/') ? -1 : 1;
        if ($depth === 0) { $close = $t[0][1]; break; }
    }
    if ($close === null) { $hasil['dilewati'][] = "$rel (penutup hero tidak ditemukan)"; continue; }

    // Sisipkan sebelum penutup, ikuti indentasi dan jenis baris baru file
    $eol        = (strpos($src, "\r\n") !== false) ? "\r\n" : "\n";
    $lineStart  = strrpos(substr($src, 0, $close), "\n");
    $lineStart  = ($lineStart === false) ? 0 : $lineStart + 1;
    $before     = substr($src, $lineStart, $close - $lineStart);

    if (trim($before) === '') {
        $sisip = $before . '    ' . $include . $eol;
        $baru  = substr($src, 0, $lineStart) . $sisip . substr($src, $lineStart);
    } else {
        $baru = substr($src, 0, $close) . $include . substr($src, $close);
    }

    if ($apply) {
        $dest = $backup . '/' . $rel;
        if (!is_dir(dirname($dest))) mkdir(dirname($dest), 0777, true);
        copy($path, $dest);
        file_put_contents($path, $baru);
    }
    $hasil['diubah'][] = $rel;
}

echo ($apply ? "MODE APPLY" : "MODE SIMULASI (tambahkan --apply untuk mengubah file)") . "\n\n";
echo "Diubah (" . count($hasil['diubah']) . "):\n";   foreach ($hasil['diubah']   as $r) echo "  + $r\n";
echo "\nSudah ada logo (" . count($hasil['sudah']) . "):\n";   foreach ($hasil['sudah']   as $r) echo "  = $r\n";
echo "\nDilewati, edit manual (" . count($hasil['dilewati']) . "):\n"; foreach ($hasil['dilewati'] as $r) echo "  ! $r\n";
if ($apply && $hasil['diubah']) echo "\nBackup tersimpan di: $backup\n";
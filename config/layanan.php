<?php

/*
 * DAFTAR LAYANAN PERIZINAN (satu sumber untuk tab halaman + dropdown menu "Layanan")
 *
 * - Urutan array = urutan tampil di tab DAN dropdown.
 * - 'label' = teks pada tab, 'menu' = teks pada dropdown navbar.
 * - Tambah / hapus / ubah urutan layanan cukup di file ini.
 *
 * Setelah mengubah file ini jalankan:  php artisan config:clear
 */
return [
    'edukasi' => [
        'url'   => '/layanan-fasilitas/edukasi_sosialisasi',
        'label' => 'Edukasi & Sosialisasi',
        'menu'  => 'Kunjungan, Edukasi dan Sosialisasi',
        'ico'   => 'fa-bullhorn',
        'ket'   => 'Pengajuan Kunjungan Edukasi & Sosialisasi',
    ],
    'keramaian' => [
        'url'   => '/layanan-fasilitas/izin-keramaian',
        'label' => 'Event Keramaian',
        'menu'  => 'Rekomendasi Izin Pengamanan Event Keramaian',
        'ico'   => 'fa-users',
        'ket'   => 'Pengajuan Rekomendasi Event Keramaian',
    ],
    'rpkbgl' => [
        'url'   => '/layanan-fasilitas/layanan_perizinan',
        'label' => 'RPKBGL',
        'menu'  => 'Rekomendasi Kebakaran Bangunan Gedung dan Lingkungan',
        'ico'   => 'fa-building',
        'ket'   => 'Layanan perizinan Rekomendasi Proteksi Kebakaran Bangunan Gedung dan Lingkungan',
    ],
    'sarana' => [
        'url'   => '/layanan-fasilitas/penggunaan-sarana',
        'label' => 'Penggunaan Sarana Pemadam',
        'menu'  => 'Permohonan Penggunaan Sarana Pemadam Kebakaran',
        'ico'   => 'fa-truck-droplet',
        'ket'   => 'Permohonan Penggunaan Sarana Pemadam Kebakaran',
    ],
    'skk' => [
        'url'   => '/layanan-fasilitas/skk',
        'label' => 'SKK (Baru & Perpanjangan)',
        'menu'  => 'Permohonan Sertifikat Keselamatan Kebakaran',
        'ico'   => 'fa-user-shield',
        'ket'   => 'Layanan perizinan penerbitan & perpanjangan Sertifikat Keamanan Kebakaran',
    ],
];
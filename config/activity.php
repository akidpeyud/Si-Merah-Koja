<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Timezone Riwayat Aktivitas & Rekap Bulanan
    |--------------------------------------------------------------------------
    */

    'timezone' => env('ACTIVITY_LOG_TIMEZONE', 'Asia/Jakarta'),

    /*
    |--------------------------------------------------------------------------
    | Masa Retensi Log Detail (Bulan) Sebelum Diringkas & Dihapus
    |--------------------------------------------------------------------------
    |
    | Dibedakan antara aktivitas pegawai internal dan permohonan surat pemohon.
    | Log yang lebih tua dari batas awal bulan N bulan lalu akan diringkas ke
    | tabel monthly_activity_stats terlebih dahulu sebelum detailnya dihapus.
    |
    */

    'retention_months' => [
        'internal' => max(1, (int) env('ACTIVITY_RETENTION_INTERNAL_MONTHS', 6)),
        'pemohon' => max(1, (int) env('ACTIVITY_RETENTION_PEMOHON_MONTHS', 6)),
    ],

    /*
    |--------------------------------------------------------------------------
    | Ukuran Batch Agregasi & Penghapusan Log Lama
    |--------------------------------------------------------------------------
    */

    'prune_chunk_size' => 500,

];

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenggunaanSarana extends Model
{
    // Harus sama dengan Schema::create(...) di migration
    protected $table = 'penggunaan_sarana';

    protected $fillable = [
        'pemohon_id',

        // 1. Data pemohon
        'nama',
        'nik',
        'no_hp',
        'alamat',

        // 2. Data instansi / fasilitas umum / perorangan
        'jenis_pemohon',
        'nama_penanggung_jawab',
        'nama_instansi',
        'alamat_instansi',

        // 3. Sarana yang diajukan
        'sarana',
        'kegunaan',

        // 4. Data lokasi kegiatan
        'nama_kegiatan',
        'lokasi_kegiatan',
        'tgl_pelaksanaan',
        'waktu_mulai',
        'waktu_selesai',

        // 5. Berkas persyaratan administrasi
        'surat_permohonan',
        'fotokopi_ktp',
        'sket_denah_lokasi',

        // Status permohonan: Menunggu | Proses | Disetujui | Ditolak
        'status',
    ];

    // Nilai awal status jika tidak diisi (sama dengan default di migration)
    protected $attributes = [
        'status' => 'Menunggu',
    ];

    // Daftar kolom berkas: dipakai controller (simpan/hapus) dan view detail.
    public const KOLOM_BERKAS = ['surat_permohonan', 'fotokopi_ktp', 'sket_denah_lokasi'];

    // Catatan: kolom tgl_pelaksanaan sengaja TIDAK di-cast ke date.
    // Dibiarkan string "Y-m-d" agar langsung cocok dengan <input type="date">
    // di form edit, dan tetap aman dipakai dengan Carbon::parse() di view/controller.
}
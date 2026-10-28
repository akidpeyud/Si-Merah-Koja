<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit (opsional jika mengikuti standar jamak bahasa Inggris, tapi disarankan)
    protected $table = 'pegawais';

    // Mendaftarkan kolom-kolom yang diizinkan untuk diisi secara massal (Mass Assignment)
    protected $fillable = [
        'no_urut',
        'nip',
        'nama',
        'tempat_tanggal_lahir',
        'jenis_kelamin',
        'status_pegawai',
        'pangkat_gol_ruang',
        'pangkat_tmt',
        'jabatan_nama',
        'jabatan_tmt',
        'masa_kerja_th',
        'masa_kerja_bln',
        'pendidikan_tingkat_ijazah',
        'pendidikan_nama',
        'pendidikan_tahun_lulus',
        'latihan_jabatan_nama',
        'latihan_jabatan_tahun_lulus',
        'latihan_jabatan_tempat',
        'catatan_mutasi_pegawai',
    ];

    /**
     * Accessor untuk memisahkan tempat lahir dari kolom tempat_tanggal_lahir.
     */
    public function getTempatLahirAttribute(): ?string
    {
        if (empty($this->tempat_tanggal_lahir)) {
            return null;
        }

        $parts = explode(',', $this->tempat_tanggal_lahir, 2);

        return trim($parts[0] ?? '');
    }

    /**
     * Accessor untuk memisahkan tanggal lahir (format Y-m-d) dari kolom tempat_tanggal_lahir.
     */
    public function getTanggalLahirAttribute(): ?string
    {
        if (empty($this->tempat_tanggal_lahir)) {
            return null;
        }

        $parts = explode(',', $this->tempat_tanggal_lahir, 2);
        if (! isset($parts[1])) {
            return null;
        }

        $rawDate = trim($parts[1]);
        $cleaned = preg_replace('/\s+/', '', $rawDate);
        $cleaned = str_replace('/', '-', $cleaned);

        try {
            return Carbon::parse($cleaned)->format('Y-m-d');
        } catch (\Throwable $e) {
            return null;
        }
    }
}

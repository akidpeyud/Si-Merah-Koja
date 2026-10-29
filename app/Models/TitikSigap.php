<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitikSigap extends Model
{
    use HasFactory;

    /**
     * Daftar kategori titik yang aktif (nilai di database => label tampilan).
     * Satu-satunya sumber data kategori: dipakai oleh validasi di controller,
     * dropdown form input/edit, rekap & filter di halaman data.
     * Untuk menambah / mengubah kategori cukup edit di sini
     * (lalu sesuaikan juga KATEGORI di halaman peta publik).
     */
    public const KATEGORI = [
        'sumber_air' => 'Sumber Air',
        'hydrant' => 'Hydrant Kota',
        'hydrant_pilar' => 'Hydrant Pilar',
        'water_truck' => 'Water Truck',
        'pos' => 'Pos Damkar',
        'zona_rawan' => 'Zona Rawan Kebakaran',
    ];

    public const TINGKAT_RISIKO = [
        'Tinggi' => 'Risiko Tinggi (Buffer 1.2 km)',
        'Sedang' => 'Risiko Sedang (Buffer 800 m)',
    ];

    protected $fillable = [
        'kategori',
        'nama',
        'lokasi',
        'keterangan',
        'latitude',
        'longitude',
    ];

    /**
     * Label kategori yang rapi, mis. $titik->kategori_label.
     * Berguna juga untuk export PDF / Excel.
     * Kategori lama (kebakaran, penyelamatan) tampil dengan tanda "(lama)".
     */
    public function getKategoriLabelAttribute(): string
    {
        return self::KATEGORI[$this->kategori]
            ?? ucfirst(str_replace('_', ' ', (string) $this->kategori)).' (lama)';
    }

    /**
     * Mengambil tingkat risiko (Tinggi / Sedang) untuk titik zona rawan.
     */
    public function getTingkatRisikoAttribute(): ?string
    {
        if ($this->kategori !== 'zona_rawan') {
            return null;
        }

        if (preg_match('/Tingkat\s*Risiko\s*:\s*(Tinggi|Sedang)/i', (string) $this->keterangan, $m)) {
            return ucfirst(strtolower($m[1]));
        }

        if (stripos((string) $this->keterangan, 'tinggi') !== false) {
            return 'Tinggi';
        }

        if (stripos((string) $this->keterangan, 'sedang') !== false) {
            return 'Sedang';
        }

        return 'Tinggi';
    }
}

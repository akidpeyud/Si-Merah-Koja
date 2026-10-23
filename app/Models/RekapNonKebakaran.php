<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekapNonKebakaran extends Model
{
    protected $table = 'rekap_non_kebakarans';

    protected $fillable = [
        'tahun',
        'bulan',
        'bulan_angka',
        'total_kejadian',
        'rincian_bencana',
        'rincian_kecamatan',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tahun' => 'integer',
            'bulan_angka' => 'integer',
            'total_kejadian' => 'integer',
            'rincian_bencana' => 'array',
            'rincian_kecamatan' => 'array',
        ];
    }
}

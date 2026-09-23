<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelatihanKeluarga extends Model
{
    // Ganti 'pelatihan_keluargas' dengan nama tabel aslimu di database jika berbeda
    protected $table = 'pelatihan_keluargas'; 
    protected $guarded = [];
}
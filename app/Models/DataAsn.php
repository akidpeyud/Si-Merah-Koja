<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAsn extends Model
{
    use HasFactory;

    protected $table = 'data_asns';
    protected $fillable = ['nama_jabatan', 'pns', 'pppk'];

    // Menghitung jumlah seluruh (PNS + PPPK) otomatis
    public function getJumlahSeluruhAttribute()
    {
        return $this->pns + $this->pppk;
    }
}
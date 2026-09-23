<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedkarRegistration extends Model
{
    use HasFactory;

    protected $table = 'redkar_registrations';

    // TAMBAHKAN INI AGAR ID TEKS TIDAK BERUBAH JADI ANGKA 0
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = ['id'];
}
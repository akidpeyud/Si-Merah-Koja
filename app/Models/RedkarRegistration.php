<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedkarRegistration extends Model
{
    use HasFactory;

<<<<<<< HEAD
=======
    protected $table = 'redkar_registrations';

    // TAMBAHKAN INI AGAR ID TEKS TIDAK BERUBAH JADI ANGKA 0
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
    protected $guarded = ['id'];
}
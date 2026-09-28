<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EduDamkar extends Model
{
    use HasFactory;

    protected $table = 'edu_damkar';

    protected $fillable = [
        'judul',
        'youtube_id',
        'link_asli',
    ];
}
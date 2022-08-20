<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_keberangkatan',
        'waktu_keberangkatan',
        'waktu_perjalanan',
        'tujuan',
        'tlp',
        'rating',
        'catatan_user',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rencana extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_keberangkatan',
        'waktu_keberangkatan',
        'waktu_perjalanan',
        'tujuan',
        'tlp',
    ];
}

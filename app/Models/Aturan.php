<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aturan extends Model
{
    use HasFactory;

    protected $fillable = [
        'penilaian', 'kerajinan', 'kelebihan',
        'kekurangan', 'output'
    ];
}

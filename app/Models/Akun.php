<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Akun extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'username',
        'nik',
        'password',
        'jabatan',
        'divisi',
        'hak_akses',
    ];
}

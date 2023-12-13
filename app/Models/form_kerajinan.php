<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form_kerajinan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_penilaian', 'nik_karyawan', 'nama_penilai',
        'sakit', 'izin', 'tanpaizin', 'terlambat', 'pulangcepat', 'hasil'
    ];

    public function penilaian()
    {
        return $this->belongsTo(form_penilaian::class, 'id');
    }
}

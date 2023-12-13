<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hasil_fuzzy extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_penilaian',
        'nik_karyawan',
        'nama_penilai',
        'penilaian_him',
        'penilaian_a',
        'kerajinan_him',
        'kerajinan_a',
        'kelebihan_him',
        'kelebihan_a',
        'kekurangan_him',
        'kekurangan_a',
        'output',
        'hasil',
        'nilai',
    ];

    public function penilaian()
    {
        return $this->belongsTo(form_penilaian::class, 'id');
    }
}

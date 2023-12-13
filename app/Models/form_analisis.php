<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form_analisis extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_penilaian', 'nik_karyawan', 'nama_penilai',
        'kelebihan', 'kekurangan', 'rangkuman', 'kebutuhan', 'rekomendasi', 'catatan',
        'hasil_kelebihan', 'hasil_kekurangan'
    ];

    public function penilaian()
    {
        return $this->belongsTo(form_penilaian::class, 'id');
    }
}

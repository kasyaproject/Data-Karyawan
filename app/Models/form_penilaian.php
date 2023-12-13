<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form_penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_penilaian', 'nik_karyawan', 'nama_penilai',
        'kerajinan', 'loyalitas', 'inisiatif', 'kerjasama', 'integritas',
        'daqumethod', 'custrelation', 'kerapihan', 'verifikasi', 'hasil'
    ];

    public function formKerajinan()
    {
        return $this->hasOne(form_kerajinan::class, 'id');
    }

    public function formAnalisis()
    {
        return $this->hasOne(form_analisis::class, 'id');
    }
    public function formFuzzy()
    {
        return $this->hasOne(hasil_fuzzy::class, 'id');
    }
}

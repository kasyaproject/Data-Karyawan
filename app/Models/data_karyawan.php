<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nik',
        'mulaikerja',
        'jabatan',
        'unit',
        'posisi',
    ];


    //memanggil gambar dari table image sesuai dengan nik
    public function image()
    {
        return $this->hasOne(Image::class, 'nik', 'nik');
    }

    public function penilaians()
    {
        return $this->hasMany(form_penilaian::class, 'nik_karyawan', 'nik')
            ->orderBy('tgl_penilaian', 'desc');
    }

    public function hasilFuzzy()
    {
        return $this->hasOne(hasil_fuzzy::class, 'nik_karyawan', 'nik');
    }
}

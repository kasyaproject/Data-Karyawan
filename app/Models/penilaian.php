<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penilaian extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_penilaian';

    public function detail()
    {
        return $this->hasOne(detail_penilaian::class, 'id_detail', 'id_penilaian');
    }

    public function fuzzy()
    {
        return $this->hasOne(fuzzy::class, 'id_fuzzy', 'id_penilaian');
    }
}

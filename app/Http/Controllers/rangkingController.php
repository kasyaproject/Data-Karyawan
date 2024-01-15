<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data_karyawan;
use App\Models\form_penilaian;
use App\Models\hasil_fuzzy;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class rangkingController extends Controller
{
    //view halaman rangking
    public function index()
    {
        $user = Auth::user();

        if ($user->hak_akses === 'admin') {
            // Mengambil semua data karyawan beserta relasi gambar
            $data = data_karyawan::with('image')
                ->get();

            // Mengambil semua data penilaian
            $penilaian = form_penilaian::all();
        } elseif ($user->hak_akses === 'user') {
            // Jika user, tampilkan data karyawan berdasarkan divisi yang sama
            $data = data_karyawan::with('image')
                ->where('unit', $user->divisi)
                ->get();

            // Mengambil semua data penilaian
            $penilaian = form_penilaian::all();
        }

        // Mengurutkan data karyawan berdasarkan poin terbesar
        $data = $data->sortByDesc(function ($karyawan) {
            return optional($karyawan->penilaians->first())->formFuzzy->persentase ?? 0;
        });

        return view('rangking.lihat', compact('data', 'penilaian'));
    }
}

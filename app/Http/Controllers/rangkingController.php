<?php

namespace App\Http\Controllers;

use App\Models\data_karyawan;
use App\Models\penilaian;
use Illuminate\Support\Facades\Auth;

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
            $penilaian = penilaian::all();
        } elseif ($user->hak_akses === 'user') {
            // Jika user, tampilkan data karyawan berdasarkan divisi yang sama
            $data = data_karyawan::with('image')
                ->where('unit', $user->divisi)
                ->get();

            // Mengambil semua data penilaian
            $penilaian = penilaian::all();
        }

        // Mengurutkan data karyawan berdasarkan poin terbesar
        $data = $data->sortByDesc(function ($karyawan) {
            return optional($karyawan->penilaians->first())->fuzzy->probabilitas ?? 0;
        });

        return view('rangking.lihat', compact('data', 'penilaian'));
    }
}

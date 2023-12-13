<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\data_karyawan;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    //dashboard view
    public function index()
    {
        $user = Auth::user();

        if ($user->hak_akses === 'admin') {
            // Jika admin, tampilkan semua data karyawan
            $data = data_karyawan::with('image')
                ->orderBy('nama', 'asc')
                ->get();
        } elseif ($user->hak_akses === 'user') {
            // Jika user, tampilkan data karyawan berdasarkan divisi yang sama
            $data = data_karyawan::with('image')
                ->where('unit', $user->divisi) // Ubah 'divisi' sesuai dengan kolom yang sesuai di tabel users
                ->orderBy('nama', 'asc')
                ->get();
        }

        return view('/dashboard', compact('data'));
    }
    // app/Http/Controllers/SearchController.php
    public function search(Request $request)
    {
        $search = $request->get('search');
        $user = Auth::user();

        if ($user->hak_akses === 'admin') {
            $data = data_karyawan::with('image')
                ->where(function ($query) use ($search) {
                    $query->where('nama', 'like', '%' . $search . '%')
                        ->orWhere('nik', 'like', '%' . $search . '%');
                })
                ->orderBy('nama', 'asc')
                ->get();
        } elseif ($user->hak_akses === 'user') {
            $data = data_karyawan::with('image')
                ->where('unit', $user->divisi)
                ->where(function ($query) use ($search) {
                    $query->where('nama', 'like', '%' . $search . '%')
                        ->orWhere('nik', 'like', '%' . $search . '%');
                })
                ->orderBy('nama', 'asc')
                ->get();
        }

        return view('/dashboard', compact('data'));
    }
}

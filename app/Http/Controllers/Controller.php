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

    public function search(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');
        $output = NULL;

        if (!empty($search)) {
            $query = data_karyawan::with('image')
                ->where('nama', 'like', '%' . $search . '%');

            if ($user->hak_akses === 'admin') {
                $data = $query->orderBy('nama', 'asc')->get();
            } elseif ($user->hak_akses === 'user') {
                $data = $query
                    ->where('unit', $user->divisi)
                    ->get();
            }
        } else {
            $query = data_karyawan::with('image')
                ->orderBy('nama', 'asc')
                ->get();

            if ($user->hak_akses === 'admin') {
                $data = $query->orderBy('nama', 'asc')->get();
            } elseif ($user->hak_akses === 'user') {
                $data = $query
                    ->where('unit', $user->divisi)
                    ->orderBy('nama', 'asc')
                    ->get();
            }
        }

        foreach ($data as $item) {
            $output = view('card-karyawan', ['data' => $item])->render();
        }

        return response($output);
    }
}

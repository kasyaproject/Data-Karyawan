<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data_karyawan;
use App\Models\penilaian;

class notifController extends Controller
{
    //view halaman notifikasi
    public function index()
    {
        // Ambil data penilaian dengan verifikasi 'no'
        $penilaian = penilaian::where('verifikasi', 'no')->get();

        $jumlah = $penilaian->count();

        // Ambil data karyawan yang sesuai dengan data penilaian
        $data = data_karyawan::whereIn('nik', $penilaian->pluck('nik_karyawan'))->get();

        $dataPenilaian = $data;

        return view('notifikasi.lihat', compact('penilaian', 'data', 'dataPenilaian'));
    }
    //ubah verifikasi no menjadi yes
    public function update(Request $request, $nik)
    {
        $data = penilaian::where('nik_karyawan', $nik)->where('verifikasi', 'no')->first();

        // Ubah nilai kolom "verifikasi" menjadi "yes"
        $data->verifikasi = 'yes';
        $data->save();

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data_karyawan;
use App\Models\form_penilaian;

class notifController extends Controller
{
    //view halaman notifikasi
    public function index()
    {
        // Ambil data penilaian dengan verifikasi 'no'
        $penilaian = form_penilaian::where('verifikasi', 'no')->get();

        $jumlah = $penilaian->count();

        // Ambil data karyawan yang sesuai dengan data penilaian
        $data = data_karyawan::whereIn('nik', $penilaian->pluck('nik_karyawan'))->get();

        return view('notifikasi.lihat', compact('penilaian', 'data'));
    }
    //ubah verifikasi no menjadi yes
    public function update(Request $request, $nik)
    {
        $data = form_penilaian::where('nik_karyawan', $nik)->first();

        // Ubah nilai kolom "verifikasi" menjadi "yes"
        $data->verifikasi = 'yes';

        // Simpan perubahan
        $data->save();

        // Tambahkan pesan sukses atau logika lainnya yang Anda inginkan
        return redirect()->back();
    }
}

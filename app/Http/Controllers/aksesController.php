<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\divisi;
use Illuminate\Support\Facades\Hash;

class aksesController extends Controller
{
    //View Halaman utama akses
    public function index()
    {
        $akun = User::all();

        return view('akun.daftar_akses', compact('akun'));
    }

    //Menampilkan halaman tambah akun
    public function tambah()
    {
        $pilihan = divisi::all();

        return view('akun.tambah', compact('pilihan'));
    }

    //Menambah akun akses
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users',
            'nik' => 'required|unique:users',
            'password' => 'required',
            'jabatan' => 'required',
            'divisi' => 'required',
            'hak_akses' => 'required',
        ]);

        $hashedPassword = Hash::make($request->password);

        $akun = new User();
        $akun->nama = $request->input('nama');
        $akun->username = $request->input('username');
        $akun->nik = $request->input('nik');
        $akun->password = $hashedPassword;
        $akun->jabatan = $request->input('jabatan');
        $akun->divisi = $request->input('divisi');
        $akun->hak_akses = $request->input('hak_akses');
        $akun->save();

        return redirect('/daftar_akses')->with('success', 'Registrasi akun Berhasil! Silahkan login');
    }

    ////Menambah pilihan divisi/unit
    public function newOpt(Request $request)
    {
        $request->validate([
            'nama_divisi' => 'required|unique:divisis',
        ]);

        $option = new divisi();
        $option->nama_divisi = $request->input('nama_divisi');
        $option->save();

        return redirect('/daftar_akses/regist');
    }

    //Menghapus akun akses
    public function delete($id)
    {
        $akun = User::find($id);

        if (!$akun) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $akun->delete();

        return redirect('/daftar_akses')->with('success', 'Data berhasil dihapus.');
    }

    //Melihat detail akun
    public function detail($id)
    {
        $akun = User::find($id);
        $pilihan = divisi::all();

        if (!$akun) {
            return redirect('akun.daftar_akses')->with('error', 'Data tidak ditemukan.');
        }

        return view('akun.lihat', compact('akun', 'pilihan'));
    }

    // Edit data Akses
    public function update(Request $request, $id)
    {
        $akun = User::find($id);

        if (!$akun) {
            return redirect('akun.lihat')->with('error', 'Data tidak ditemukan.');
        }

        // Validasi data dari formulir
        $request->validate([
            'username' => 'required|string|max:255',
            'hak_akses' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'divisi' => 'required|string|max:255',
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);

        // Simpan perubahan data
        $akun->username = $request->input('username');
        $akun->hak_akses = $request->input('hak_akses');
        $akun->jabatan = $request->input('jabatan');
        $akun->divisi = $request->input('divisi');
        // Update data lainnya sesuai kebutuhan
        $akun->save();

        return redirect('/daftar_akses')->with('success', 'Data berhasil diperbarui.');
    }
}

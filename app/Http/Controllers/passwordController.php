<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class passwordController extends Controller
{
    public function update(Request $request, $id)
    {
        $akun = User::find($id);

        if (!$akun) {
            return redirect()->route('akun.lihat', ['id' => $id])->with('error', 'User tidak ditemukan.');
        }

        // Validasi data dari formulir
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required',
            'password_konfir' => 'required',
        ]);

        $password = $akun->password;
        $passwordLama = $request->password_lama;
        $passwordBaru = $request->password_baru;
        $passwordKonfir = $request->password_konfir;

        if (Hash::check($passwordLama, $password)) {
            if ($passwordBaru == $passwordKonfir) {
                // Encrypt password
                $hashedPassword = Hash::make($passwordBaru);

                $akun->password = $hashedPassword;
                $akun->save();

                return back()->route('akun.lihat', ['id' => $akun->id])->with('success', 'Password berhasil diperbarui!');
            } else {
                return back()->with('error', 'Konfirmasi Password harus sama!');
            }
        } else {
            return back()->with('error', 'Password lama tidak benar!');
        }
    }
}

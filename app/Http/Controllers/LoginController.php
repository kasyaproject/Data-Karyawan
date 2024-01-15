<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Login controll.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek akses level setelah berhasil login
            $user = Auth::user();

            if ($user->hak_akses === 'admin') {
                return redirect('/dashboard'); // Ganti dengan rute yang sesuai untuk admin
            } elseif ($user->hak_akses === 'user') {
                return redirect('/dashboard'); // Ganti dengan rute yang sesuai untuk user biasa
            }
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($karyawan)
    {

        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request,  $karyawan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($karyawan)
    {
        //
    }
}

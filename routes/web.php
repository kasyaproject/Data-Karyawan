<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\aksesController;
use App\Http\Controllers\karyawanController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\penilaianController;
use App\Http\Controllers\rangkingController;
use App\Http\Controllers\passwordController;
use App\Http\Controllers\notifController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [loginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [loginController::class, 'login'])->name('login.post');
Route::post('/logout', [loginController::class, 'logout']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //halaman awal
    Route::get('/dashboard', [Controller::class, 'index'])->name('dashboard');
    //mencari data karyawan
    Route::get('/search', [Controller::class, 'search']);

    //lihat detail data karyawan
    Route::get('/data/{nik}', [karyawanController::class, 'detail'])->name('detail');
    //tambah data karyawan
    Route::get('/tambah_data', [karyawanController::class, 'tambah']);
    Route::post('/tambah_data', [karyawanController::class, 'store']);
    //hapus data karyawan
    Route::delete('/data/{id}', [karyawanController::class, 'delete'])->name('karyawan.hapus');
    //edit data karyawan
    Route::get('/data/ubah/{nik}', [karyawanController::class, 'view'])->name('karyawan.lihat');
    Route::put('/data/ubah/{nik}', [karyawanController::class, 'update'])->name('karyawan.update');
    //hapus hasil penilaian
    Route::delete('/penilaian/{id}', [karyawanController::class, 'destroy'])->name('penilaian.hapus');

    //view notifikasi
    Route::get('/verifikasi', [notifController::class, 'index'])->name('verifikasi.lihat');
    //edit verifikasi
    Route::put('/verifikasi/ubah/{nik}', [notifController::class, 'update'])->name('verifikasi.update');

    //view daftar akun
    Route::get('/daftar_akses', [aksesController::class, 'index'])->name('akun.daftar_akses');
    //tambah akun
    Route::get('/daftar_akses/regist', [aksesController::class, 'tambah']);
    Route::post('/daftar_akses/regist', [aksesController::class, 'store']);
    //tambah pilihan divisi SDI
    Route::post('daftar_akses/pilihan', [aksesController::class, 'newOpt']);
    //hapus akun
    Route::delete('/akun/{id}', [aksesController::class, 'delete'])->name('akun.daftar_akses');
    //edit akun
    Route::get('/akun/{id}', [aksesController::class, 'detail'])->name('akun.lihat');
    Route::put('/akun/{id}', [aksesController::class, 'update'])->name('akun.update');
    //ganti password akun 
    Route::put('/akun/ubah/{id}', [passwordController::class, 'update'])->name('akun.ubah');

    //view form penilaian
    Route::get('/data/form/{nik}', [penilaianController::class, 'form'])->name('penilaian.form');
    //buat penilaian
    Route::post('/data/form/{nik}', [penilaianController::class, 'store']);

    //view halaman rangking
    Route::get('/rangking', [rangkingController::class, 'index']);

    //untuk membuat aturan 
    Route::get('/form2', [penilaianController::class, 'store_rule_view']);
    Route::post('/form2', [penilaianController::class, 'store_rule']);

    //test fuzzy
    Route::get('/test', [penilaianController::class, 'showtest']);
});

require __DIR__ . '/auth.php';

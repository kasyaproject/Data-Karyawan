<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data_karyawan;
use App\Models\form_penilaian;
use App\Models\divisi;
use App\Models\hasil_fuzzy;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class karyawanController extends Controller
{
    //view halaman tambah data karyawan
    public function tambah()
    {
        $pilihan = divisi::all();

        return view('karyawan.tambah', compact('pilihan'));
    }

    //view halaman detail data karyawan
    public function detail($nik)
    {
        $data = data_karyawan::with('image')->where('nik', $nik)->first();

        // Ubah format mulaikerja menjadi "d - F - Y"
        $data->mulaikerja_formatted = Carbon::parse($data->mulaikerja)->format('d - F - Y');
        // Hitung lama kerja dalam tahun dan bulan
        $tanggalMasuk = Carbon::parse($data->mulaikerja);
        $lamaKerja = $tanggalMasuk->diff(Carbon::now())->format('%y Tahun %m Bulan');

        // Tambahkan informasi lama kerja ke dalam data karyawan
        $data->lama_kerja = $lamaKerja;


        // pemanggilan data table penilaian
        $dataKaryawan = data_karyawan::where('nik', $nik)->firstOrFail();
        $dataPenilaian = $dataKaryawan->penilaians;

        // pemanggilan data untuk chartjs
        $dataPenilaianForChart = [];
        // Ambil 6 data terakhir dari $dataPenilaian
        $dataPenilaianLimited = $dataPenilaian->take(6);

        foreach ($dataPenilaianLimited as $penilaian) {
            $dataPenilaianForChart[] = [
                'tgl_penilaian' => $penilaian->tgl_penilaian,
                'point' => $penilaian->formFuzzy->point,
            ];
        }

        return view('karyawan.detail', compact('data', 'dataPenilaian', 'dataPenilaianForChart'));
    }

    //view halaman detail data karyawan untuk ubah data
    public function view($nik)
    {
        $data = data_karyawan::with('image')->where('nik', $nik)->first();

        $pilihan = divisi::all();

        if (!$data) {
            abort(404, 'Data not found');
        }

        return view('karyawan.ubah', compact('data', 'pilihan'));
    }

    //update data karyawan
    public function update(Request $request, $nik)
    {
        $data = data_karyawan::where('nik', $nik)->first();

        if (!$data) {
            abort(404, 'Data not found');
        }

        // Validasi data yang diinputkan
        $request->validate([
            'image' => 'image|mimes:jpeg,png|max:2048',
            'nama' => 'required',
            'mulaikerja' => 'required',
            'nik' => [
                'required',
                Rule::unique('data_karyawans')->ignore($nik, 'nik'),
            ],
            'jabatan' => 'required',
            'unit' => 'required',
            'posisi' => 'required',
        ]);

        // Update data karyawan
        $data->nama = $request->input('nama');
        $data->nik = $request->input('nik');
        $data->mulaikerja = $request->input('mulaikerja');
        $data->jabatan = $request->input('jabatan');
        $data->unit = $request->input('unit');
        $data->posisi = $request->input('posisi');

        // Cek apakah ada gambar baru diunggah
        if ($request->hasFile('image')) {
            // Validasi dan simpan gambar baru
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $imagePath = $request->file('image')->store('images', 'public');

            // Hapus gambar lama jika ada
            if ($data->image) {
                Storage::disk('public')->delete($data->image->path);
                $data->image()->update(['path' => $imagePath]);
            } else {
                $data->image()->create(['path' => $imagePath]);
            }
        }

        $data->save();

        return redirect()->route('detail', ['nik' => $data->nik])->with('success', 'Data karyawan berhasil diperbarui.');
    }

    //tambah data karyawan
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png|max:2048',
            'nama' => 'required',
            'mulaikerja' => 'required',
            'nik' => 'required|unique:data_karyawans',
            'jabatan' => 'required',
            'unit' => 'required',
            'posisi' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            // Tidak ada gambar yang diunggah, berikan nilai default
            $imagePath = '/asset/default-akun.jpg';
        }

        $akun = new data_karyawan();
        $akun->nama = $request->input('nama');
        $akun->nik = $request->input('nik');
        $akun->mulaikerja = $request->input('mulaikerja');
        $akun->jabatan = $request->input('jabatan');
        $akun->unit = $request->input('unit');
        $akun->posisi = $request->input('posisi');
        $akun->save();

        $image = new Image;
        $image->nik = $request->nik;
        $image->path = $imagePath;
        $image->save();

        return redirect('/dashboard')->with('success', 'Data karyawan baru berhasil ditambah.');
    }


    //hapus data karyawan
    public function delete($id)
    {
        // Cari data karyawan berdasarkan ID
        $data = data_karyawan::find($id);

        if (!$data) {
            return redirect('/dashboard')->with('error', 'Data karyawan tidak ditemukan.');
        }

        // Hapus gambar terkait dari storage
        $gambar = Image::where('nik', $data->nik)->first();
        if ($gambar) {
            Storage::disk('public')->delete($gambar->path);
            $gambar->delete();
        }

        // Hapus data karyawan
        $data->delete();

        return redirect('/dashboard')->with('error', 'Data karyawan berhasil dihapus.');
    }

    //hapus data penilaian
    public function destroy($id)
    {
        $formPenilaian = form_penilaian::find($id);

        if (!$formPenilaian) {
            return redirect()->back()->with('error', 'Penilaian tidak ditemukan.');
        }

        // Menghapus relasi terlebih dahulu
        $formPenilaian->formKerajinan()->delete();
        $formPenilaian->formAnalisis()->delete();
        $formPenilaian->formFuzzy()->delete();

        // Menghapus dirinya sendiri
        $formPenilaian->delete();

        return redirect()->back()->with('success', 'Data penilaian berhasil dihapus.');
    }
}

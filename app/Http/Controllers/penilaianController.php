<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data_karyawan;
use App\Models\penilaian;
use App\Models\detail_penilaian;
use App\Models\fuzzy;
use App\Models\aturan_baru;

use App\Models\form_analisis;
use App\Models\form_kerajinan;
use App\Models\form_penilaian;
use App\Models\Aturan;
use App\Models\hasil_fuzzy;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class penilaianController extends Controller
{
    //view halaman form penilaian data karyawan
    public function form($nik)
    {
        // cek jika ada penilaian yang belum di verifikasi 
        $cek_penilaian = penilaian::where('nik_karyawan', $nik)->where('verifikasi', 'no')->first();

        if ($cek_penilaian) {
            // kembali ke halaman dengan pesan
            return redirect()->route('detail', ['nik' => $nik])->with('error', 'Penilaian sedang menunggu Verifikasi.');
        } else {
            // jika penilaian yang sudah di verifikasi
            $data = data_karyawan::with('image')->where('nik', $nik)->first();

            $penilai = Auth::user();

            // Set zona waktu Jakarta (+7)
            $tanggalMasuk = Carbon::parse($data->mulaikerja)->setTimezone('Asia/Jakarta');
            $sekarang = Carbon::now()->setTimezone('Asia/Jakarta');

            // Hitung lama kerja dalam tahun dan bulan
            $lamaKerja = $tanggalMasuk->diff($sekarang)->format('%y Tahun %m Bulan');

            // Tambahkan informasi lama kerja ke dalam data karyawan
            $data->lama_kerja = $lamaKerja;

            return view('penilaian.form', compact('data', 'penilai'));
        }
    }

    // Menyimpan hasil & Detail Penilaian ke database
    public function store(Request $request)
    {
        $request->validate([
            // Tabel Penilaian
            'tgl_penilaian' => 'required',
            'nik_karyawan' => 'required',
            'nama_penilai' => 'required',
            'verifikasi' => 'required',
            // Tabel Detail Penilaian
            'sakit' => 'required',
            'izin' => 'required',
            'tanpaizin' => 'required',
            'terlambat' => 'required',
            'pulangcepat' => 'required',
            'produktif' => 'required',
            'custrelation' => 'required',
        ]);

        ///////////////////// Menyimpan data dalam database Tabel penilaian ////////////////////////////////
        $penilaian = new penilaian();
        $penilaian->tgl_penilaian = $request->input('tgl_penilaian');
        $penilaian->nik_karyawan = $request->input('nik_karyawan');
        $penilaian->nama_penilai = $request->input('nama_penilai');
        $penilaian->verifikasi = $request->input('verifikasi');
        $penilaian->save();


        ///////////////////// Menyimpan data dalam database Tabel detail_penilaian //////////////////////////
        $absensi = new detail_penilaian();
        $absensi->sakit = $request->input('sakit');
        $absensi->izin = $request->input('izin');
        $absensi->tanpa_izin = $request->input('tanpaizin');
        $absensi->terlambat = $request->input('terlambat');
        $absensi->pulang_cepat = $request->input('pulangcepat');

        // Menghitung point dari input sakit,izin,tanpaizin
        function hitungPoint1($jumlah)
        {
            if ($jumlah >= 0 && $jumlah <= 10) {
                return 100 - ($jumlah * 5);
            } elseif ($jumlah >= 11 && $jumlah <= 15) {
                return 50 - (($jumlah - 10) * 10);
            } else {
                return 0;
            }
        }
        // Menghitung point dari input terlambat,pulangcepat
        function hitungPoint2($jumlah)
        {
            if ($jumlah >= 0 && $jumlah <= 20) {
                return 100 - ($jumlah * 5);
            } else {
                return 0;
            }
        }

        // Menghitung point sakit,izin dan tanpaizin
        $nilai_sakit = hitungPoint1($absensi->sakit);
        $nilai_izin = hitungPoint1($absensi->izin);
        $nilai_tanpaizin = hitungPoint1($absensi->tanpaizin);
        // Menghitung point terlambat dan pulang cepat
        $nilai_terlambat = hitungPoint2($absensi->terlambat);
        $nilai_pulangcepat = hitungPoint2($absensi->pulangcepat);

        // Menghitung nilai total dari kelima input
        $nilaiAbsensi = ($nilai_sakit + $nilai_izin + $nilai_tanpaizin + $nilai_terlambat + $nilai_pulangcepat) / 5;

        $absensi->hasil_absensi = $nilaiAbsensi; // menyimpan nilai ke dalam objek
        $absensi->produktifitas = $request->input('produktif');
        $absensi->cust_relation = $request->input('custrelation');
        // Simpan dalam databse tabel detail_penilaian
        $absensi->save();


        /////////////////////////////////// PROSES PERHITUNGAN FUZZY TSUKAMOTO ///////////////////////////
        // Memanggil data input
        $nilai_absensi = $nilaiAbsensi;
        $nilai_produktif = $request->input('produktif');
        $nilai_custrelation = $request->input('custrelation');
        // Memasukan nilai input ke Grafik keanggotaan ( FUZZYFIKASI )
        // FUZZYFIKASI
        $absensi_grafik = $this->grafik_absensi($nilai_absensi);
        $produktif_grafik = $this->grafik_produktif($nilai_produktif);
        $custrelation_grafik = $this->grafik_custrelation($nilai_custrelation, $nilai_produktif);

        $A_Absensi = [];
        foreach ($absensi_grafik as $item) {
            $absensi_him[] = $item['him'];
            $absensi_a[] = $item['a'];
            $A_Absensi[$item['him']] = $item['a'];
        }

        $A_produktif = [];
        foreach ($produktif_grafik as $item) {
            $produktif_him[] = $item['him'];
            $produktif_a[] = $item['a'];
            $A_produktif[$item['him']] = $item['a'];
        }

        $A_custrelation = [];
        foreach ($custrelation_grafik as $item) {
            $custrelation_him[] = $item['him'];
            $custrelation_a[] = $item['a'];
            $A_custrelation[$item['him']] = $item['a'];
        }

        // INFERENNSI
        foreach ($absensi_grafik as $absensi) {
            foreach ($produktif_grafik as $produktif) {
                foreach ($custrelation_grafik as $custrelation) {
                    // Ambil aturan dari tabel Aturan berdasarkan jenis tipe
                    $rule = aturan_baru::where('absensi', $absensi['him'])
                        ->where('produktif', $produktif['him'])
                        ->where('custrelation', $custrelation['him'])
                        ->first();

                    $aValues = [
                        $A_Absensi[$absensi['him']],
                        $A_produktif[$produktif['him']],
                        $A_custrelation[$custrelation['him']],
                    ];
                    $aValuesString = json_encode($aValues);
                    $minA = min($aValues);

                    $probilitas[] = [
                        "absensi" => $absensi,
                        "produktif" => $produktif,
                        "custrelation" => $custrelation,
                        "rule" => $rule,
                        "a" => $aValuesString,
                        "min_probabilitas" => $minA, // Menyimpan nilai minimum probabilitas di setiap iterasi
                    ];
                }
            }
        }

        $inferensi = [];
        foreach ($probilitas as $data) {
            $output_rule = $data['rule']['keputusan'];
            $min_probabilitas = $data['min_probabilitas'];

            // Lakukan perhitungan berdasarkan output_rule dan min_probabilitas
            $hasil = 0; // Inisialisasi hasil perhitungan
            if ($output_rule == 'Tidak Terbaik') {
                $z = 50 - ($min_probabilitas * (100 - 50)); // linier Turun
            } elseif ($output_rule == 'Terbaik') {
                $z = 50 + ($min_probabilitas * (100 - 50)); // linier Naik
            }

            // Tambahkan hasil perhitungan ke dalam array
            $inferensi[] = [
                "absensi" => $absensi,
                "produktif" => $produktif,
                "custrelation" => $custrelation,
                "rule" => $data['rule'],
                "a" => $data['a'],
                "minProbabilitas" => $min_probabilitas,
                "z" => $z,
            ];
        }
        // Simpan output dari aturan dalam array allRuleOutputs
        $allRuleOutputs[] = $output_rule;
        // ( DEFUZZYFIASI )
        $defuzzyfikasi_numerator = 0; // Inisialisasi pembilang
        $defuzzyfikasi_denominator = 0; // Inisialisasi penyebut

        foreach ($inferensi as $data) {
            $min_probabilitas = $data['minProbabilitas'];
            $z = $data['z'];

            // Tambahkan nilai ke pembilang dan penyebut
            $defuzzyfikasi_numerator += ($min_probabilitas * $z);
            $defuzzyfikasi_denominator += $min_probabilitas;
        }

        // Hitung nilai defuzzyfikasi
        if ($defuzzyfikasi_denominator != 0) {
            $defuzzyfikasi = $defuzzyfikasi_numerator / $defuzzyfikasi_denominator;
        } else {
            $defuzzyfikasi = 0; // Atasi potensi pembagian oleh nol
        }

        $input  = $defuzzyfikasi;
        // Masukan point dari defuzzyfikasi ke dalam grafik Hasil(Output)
        $output_grafik = $this->grafik_keputusan($input);

        // Simpan hasil dari grafik ke dalam array
        $hasil = [];
        foreach ($output_grafik as $item) {
            $hasil[$item['him']] = $item['a'];
        }

        // Bandingkan himpunan dari variabel outpu yang tercipta
        $nilaiTerbesar = 0;
        $himTerbesar = '';

        foreach ($hasil as $him => $nilai) {
            if ($nilai > $nilaiTerbesar) {
                $nilaiTerbesar = $nilai;
                $himTerbesar = $him;
            }
        }

        ///////////////////// Menyimpan data dalam database Tabel fuzzy ////////////////////////////////
        // Simpan data ke database
        $fuzzy = new fuzzy();
        $fuzzy->absensi_a = json_encode($absensi_a);
        $fuzzy->absensi_him = json_encode($absensi_him);
        $fuzzy->produktifitas_a = json_encode($produktif_a);
        $fuzzy->produktifitas_him = json_encode($produktif_him);
        $fuzzy->custrelation_a = json_encode($custrelation_a);
        $fuzzy->custrelation_him = json_encode($custrelation_him);
        $fuzzy->keputusan = json_encode($allRuleOutputs);
        $fuzzy->probabilitas = $defuzzyfikasi;         // point fuzzy
        $fuzzy->probabilitas_him = $himTerbesar;           // point dalam himpunan variabel output
        $fuzzy->save();

        // Kembali ke view detail karawan setelah penilaian disimpan
        $nik = $request->input('nik_karyawan');
        return redirect()->route('detail', ['nik' => $nik])->with('success', 'Penilaian berhasil disimpan.');
    }

    //menyimpan hasil penilaian ke database
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'tgl_penilaian' => 'required',
    //         'nik_karyawan' => 'required',
    //         'nama_penilai' => 'required',
    //         //form_penilaian
    //         'kerajinan' => 'required',
    //         'loyalitas' => 'required',
    //         'inisiatif' => 'required',
    //         'kerjasama' => 'required',
    //         'integritas' => 'required',
    //         'daqumethod' => 'required',
    //         'custrelation' => 'required',
    //         'kerapihan' => 'required',
    //         //form_kerajinan
    //         'sakit' => 'required',
    //         'izin' => 'required',
    //         'tanpaizin' => 'required',
    //         'terlambat' => 'required',
    //         'pulangcepat' => 'required',
    //         //form_analisis
    //         'kelebihan' => 'required',
    //         'kekurangan' => 'required',
    //         'rangkuman' => 'required',
    //         'kebutuhan' => 'required',
    //         'rekomendasi' => 'required',
    //         'catatan' => 'required'
    //     ]);

    //     /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //     // menyimpan data ke table form_penilaian
    //     $penilaian = new form_penilaian();
    //     $penilaian->tgl_penilaian = $request->input('tgl_penilaian');
    //     $penilaian->nik_karyawan = $request->input('nik_karyawan');
    //     $penilaian->nama_penilai = $request->input('nama_penilai');
    //     $penilaian->kerajinan = $request->input('kerajinan');
    //     $penilaian->loyalitas = $request->input('loyalitas');
    //     $penilaian->inisiatif = $request->input('inisiatif');
    //     $penilaian->kerjasama = $request->input('kerjasama');
    //     $penilaian->integritas = $request->input('integritas');
    //     $penilaian->daqumethod = $request->input('daqumethod');
    //     $penilaian->custrelation = $request->input('custrelation');
    //     $penilaian->kerapihan = $request->input('kerapihan');
    //     $penilaian->verifikasi = $request->input('verifikasi');
    //     //mengiutung nilai dari penilaian
    //     $totalNilaiKriteria = $penilaian->kerajinan + $penilaian->loyalitas + $penilaian->inisiatif + $penilaian->kerjasama + $penilaian->integritas + $penilaian->daqumethod + $penilaian->custrelation + $penilaian->kerapihan;
    //     $nilaipenilaian = $totalNilaiKriteria / 8;
    //     $penilaian->hasil = $nilaipenilaian;
    //     //simpan data
    //     $penilaian->save();

    //     ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //     // menyimpan data ke table form_kerajinan
    //     $kerajinan = new form_kerajinan();
    //     $kerajinan->tgl_penilaian = $request->input('tgl_penilaian');
    //     $kerajinan->nik_karyawan = $request->input('nik_karyawan');
    //     $kerajinan->nama_penilai = $request->input('nama_penilai');
    //     $kerajinan->sakit = $request->input('sakit');
    //     $kerajinan->izin = $request->input('izin');
    //     $kerajinan->tanpaizin = $request->input('tanpaizin');
    //     $kerajinan->terlambat = $request->input('terlambat');
    //     $kerajinan->pulangcepat = $request->input('pulangcepat');
    //     // Menghitung point dari input sakit,izin,tanpaizin
    //     function hitungPoint1($jumlah)
    //     {
    //         if ($jumlah >= 0 && $jumlah <= 10) {
    //             return 100 - ($jumlah * 5);
    //         } elseif ($jumlah >= 11 && $jumlah <= 15) {
    //             return 50 - (($jumlah - 10) * 10);
    //         } else {
    //             return 0;
    //         }
    //     }
    //     // Menghitung point dari input terlambat,pulangcepat
    //     function hitungPoint2($jumlah)
    //     {
    //         if ($jumlah >= 0 && $jumlah <= 20) {
    //             return 100 - ($jumlah * 5);
    //         } else {
    //             return 0;
    //         }
    //     }

    //     // Menghitung point sakit,izin dan tanpaizin
    //     $nilai_sakit = hitungPoint1($kerajinan->sakit);
    //     $nilai_izin = hitungPoint1($kerajinan->izin);
    //     $nilai_tanpaizin = hitungPoint1($kerajinan->tanpaizin);
    //     // Menghitung point terlambat dan pulang cepat
    //     $nilai_terlambat = hitungPoint2($kerajinan->terlambat);
    //     $nilai_pulangcepat = hitungPoint2($kerajinan->pulangcepat);

    //     // Menghitung nilai total dari kelima input
    //     $nilaiKerajinan = ($nilai_sakit + $nilai_izin + $nilai_tanpaizin + $nilai_terlambat + $nilai_pulangcepat) / 5;

    //     $kerajinan->hasil = $nilaiKerajinan; // menyimpan nilai ke dalam objek
    //     //simpan data
    //     $kerajinan->save();

    //     ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //     // menyimpan data ke table form_analisis
    //     $analisis = new form_analisis();
    //     $analisis->tgl_penilaian = $request->input('tgl_penilaian');
    //     $analisis->nik_karyawan = $request->input('nik_karyawan');
    //     $analisis->nama_penilai = $request->input('nama_penilai');
    //     //menyimpan kelebihan & kekurangan yang di select
    //     $selectedKelebihan = $request->input('kelebihan');
    //     $selectedKekurangan = $request->input('kekurangan');
    //     $kelebihanJSON = json_encode($selectedKelebihan);
    //     $kekuranganJSON = json_encode($selectedKekurangan);

    //     $analisis->kelebihan = $kelebihanJSON;
    //     $analisis->kekurangan = $kekuranganJSON;

    //     $analisis->rangkuman = $request->input('rangkuman');
    //     $analisis->kebutuhan = $request->input('kebutuhan');
    //     $analisis->rekomendasi = $request->input('rekomendasi');
    //     $analisis->catatan = $request->input('catatan');

    //     // Bobot untuk kelebihan
    //     $bobotKelebihan = [
    //         'Kemampuan Berkomunikasi' => 9,
    //         'Kreativitas & Inovasi' => 8,
    //         'Kerja Tim Solid' => 9,
    //         'Pemecahan Masalah' => 11,
    //         'Inisiatif & Proaktif' => 12,
    //         'Kemampuan Analisis' => 11,
    //         'Pengelolaan Waktu' => 8,
    //         'Kepemimpinan' => 12,
    //         'Keterampilan Teknis' => 10,
    //         'Keandalan' => 10,
    //     ];

    //     // Bobot untuk kekurangan
    //     $bobotKekurangan = [
    //         'Ketidaktepatan Pekerjaan' => 10,
    //         'Kurang Kemauan Belajar' => 9,
    //         'Rendah Produktivitas' => 10,
    //         'Kurang Komitmen' => 9,
    //         'Kurang Berinisiatif' => 9,
    //         'Sulit Tangani Kritik' => 8,
    //         'Tidak Kuat Tekanan' => 8,
    //         'Kurang Kolaborasi' => 9,
    //         'Ketidaktaatan Aturan' => 10,
    //         'Ketidakefisienan Tugas' => 8,
    //     ];

    //     // Menghitung nilai kelebihan
    //     $nilaikelebihan = 0;
    //     foreach ($selectedKelebihan as $kelebihan) {
    //         $nilaikelebihan += $bobotKelebihan[$kelebihan];
    //     }

    //     // Menghitung nilai kekurangan
    //     $nilaikekurangan = 100;
    //     foreach ($selectedKekurangan as $kekurangan) {
    //         $nilaikekurangan -= $bobotKekurangan[$kekurangan];
    //     }
    //     // Menyimpan hasil kelebihan dan hasil kekurangan ke dalam objek
    //     $analisis->hasil_kelebihan = $nilaikelebihan;
    //     $analisis->hasil_kekurangan = $nilaikekurangan;
    //     //simpan data
    //     $analisis->save();

    //     //////////////// Menyimpan data ke table fuzzytsukamotons dengan logika fuzzy Tsukamoto /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //     // Memanggil data input
    //     $nilai_penilaian = $nilaipenilaian;
    //     $nilai_kerajinan = $nilaiKerajinan;
    //     $nilai_kelebihan = $nilaikelebihan;
    //     $nilai_kekurangan = $nilaikekurangan;
    //     // Memasukan nilai input ke Grafik keanggotaan ( FUZZYFIKASI )
    //     $penilaian_grafik = $this->grafik1($nilai_penilaian);
    //     $kerajinan_grafik = $this->grafik1($nilai_kerajinan);
    //     $kelebihan_grafik = $this->grafik2($nilai_kelebihan);
    //     $kekurangan_grafik = $this->grafik2($nilai_kekurangan);

    //     $APenilaian = [];
    //     foreach ($penilaian_grafik as $item) {
    //         $penilaian_him[] = $item['him'];
    //         $penilaian_a[] = $item['a'];
    //         $APenilaian[$item['him']] = $item['a'];
    //     }

    //     $AKerajinan = [];
    //     foreach ($kerajinan_grafik as $item) {
    //         $kerajinan_him[] = $item['him'];
    //         $kerajinan_a[] = $item['a'];
    //         $AKerajinan[$item['him']] = $item['a'];
    //     }

    //     $AKelebihan = [];
    //     foreach ($kelebihan_grafik as $item) {
    //         $kelebihan_him[] = $item['him'];
    //         $kelebihan_a[] = $item['a'];
    //         $AKelebihan[$item['him']] = $item['a'];
    //     }

    //     $AKekurangan = [];
    //     foreach ($kekurangan_grafik as $item) {
    //         $kekurangan_him[] = $item['him'];
    //         $kekurangan_a[] = $item['a'];
    //         $AKekurangan[$item['him']] = $item['a'];
    //     }
    //     // Membuat semua probilitas Aturan dari himpunan yang dipakai ( INFERENSI )
    //     foreach ($penilaian_grafik as $penilaian) {
    //         foreach ($kerajinan_grafik as $kerajinan) {
    //             foreach ($kelebihan_grafik as $kelebihan) {
    //                 foreach ($kekurangan_grafik as $kekurangan) {
    //                     // Ambil aturan dari tabel Aturan berdasarkan jenis tipe
    //                     $rule = Aturan::where('penilaian', $penilaian['him'])
    //                         ->where('kerajinan', $kerajinan['him'])
    //                         ->where('kelebihan', $kelebihan['him'])
    //                         ->where('kekurangan', $kekurangan['him'])
    //                         ->first();

    //                     $aValues = [
    //                         $APenilaian[$penilaian['him']],
    //                         $AKerajinan[$kerajinan['him']],
    //                         $AKelebihan[$kelebihan['him']],
    //                         $AKekurangan[$kekurangan['him']],
    //                     ];
    //                     $minA = min($aValues);

    //                     $probilitas[] = [
    //                         "penilaian" => $penilaian,
    //                         "kerajinan" => $kerajinan,
    //                         "kelebihan" => $kelebihan,
    //                         "kekurangan" => $kekurangan,
    //                         "rule" => $rule,
    //                         "min_probabilitas" => $minA, // Menyimpan nilai minimum probabilitas di setiap iterasi
    //                     ];
    //                 }
    //             }
    //         }
    //     }
    //     // lakukan perhitungan lanjutan mencari nilai Z setiap keanggotaan
    //     $inferensi = [];
    //     foreach ($probilitas as $data) {
    //         $output_rule = $data['rule']['output'];
    //         $min_probabilitas = $data['min_probabilitas'];

    //         // Lakukan perhitungan berdasarkan output_rule dan min_probabilitas
    //         if ($output_rule == 'buruk') {
    //             $z = 60 - ($min_probabilitas * (60 - 50)); // linier Turun
    //         } elseif ($output_rule == 'cukup_baik') {
    //             $z = 70 - ($min_probabilitas * (70 - 60)); // linier Turun
    //         } elseif ($output_rule == 'baik') {
    //             $z = 80 - ($min_probabilitas * (80 - 70)); // linier Turun
    //         } elseif ($output_rule == 'sangat_baik') {
    //             $z = ($min_probabilitas * (100 - 80)) + 80; // linier Naik
    //         }

    //         // Tambahkan hasil perhitungan ke dalam array
    //         $inferensi[] = [
    //             "penilaian" => $data['penilaian'],
    //             "kerajinan" => $data['kerajinan'],
    //             "kelebihan" => $data['kelebihan'],
    //             "kekurangan" => $data['kekurangan'],
    //             "rule" => $data['rule'],
    //             "minProbabilitas" => $min_probabilitas,
    //             "z" => $z,
    //         ];
    //         // Simpan output dari aturan dalam array allRuleOutputs
    //         $allRuleOutputs[] = $output_rule;
    //     }
    //     // menghitung nilai rata - rata dari $z dan $keanggotaan ( DEFUZZYFIASI )
    //     $defuzzyfikasi_numerator = 0; // Inisialisasi pembilang
    //     $defuzzyfikasi_denominator = 0; // Inisialisasi penyebut

    //     foreach ($inferensi as $data) {
    //         $min_probabilitas = $data['minProbabilitas'];
    //         $z = $data['z'];

    //         // Tambahkan nilai ke pembilang dan penyebut
    //         $defuzzyfikasi_numerator += ($min_probabilitas * $z);
    //         $defuzzyfikasi_denominator += $min_probabilitas;
    //     }

    //     // Hitung nilai defuzzyfikasi
    //     if ($defuzzyfikasi_denominator != 0) {
    //         $defuzzyfikasi = $defuzzyfikasi_numerator / $defuzzyfikasi_denominator;
    //     } else {
    //         $defuzzyfikasi = 0; // Atasi potensi pembagian oleh nol
    //     }

    //     // Masukan point dari defuzzyfikasi ke dalam grafik Hasil(Output)
    //     $output_grafik = $this->grafik3($defuzzyfikasi);

    //     // Simpan hasil dari grafik ke dalam array
    //     $hasil = [];
    //     foreach ($output_grafik as $item) {
    //         $hasil[$item['him']] = $item['a'];
    //     }

    //     // Bandingkan himpunan dari variabel outpu yang tercipta
    //     $nilaiTerbesar = 0;
    //     $himTerbesar = '';

    //     foreach ($hasil as $him => $nilai) {
    //         if ($nilai > $nilaiTerbesar) {
    //             $nilaiTerbesar = $nilai;
    //             $himTerbesar = $him;
    //         }
    //     }

    //     // Simpan data ke database
    //     $fuzzy = new hasil_fuzzy();
    //     $fuzzy->tgl_penilaian = $request->input('tgl_penilaian');
    //     $fuzzy->nik_karyawan = $request->input('nik_karyawan');
    //     $fuzzy->nama_penilai = $request->input('nama_penilai');
    //     $fuzzy->penilaian_him = json_encode($penilaian_him);
    //     $fuzzy->penilaian_a = json_encode($penilaian_a);
    //     $fuzzy->kerajinan_him = json_encode($kerajinan_him);
    //     $fuzzy->kerajinan_a = json_encode($kerajinan_a);
    //     $fuzzy->kelebihan_him = json_encode($kelebihan_him);
    //     $fuzzy->kelebihan_a = json_encode($kelebihan_a);
    //     $fuzzy->kekurangan_him = json_encode($kekurangan_him);
    //     $fuzzy->kekurangan_a = json_encode($kekurangan_a);
    //     $fuzzy->output = json_encode($allRuleOutputs);
    //     $fuzzy->point = $defuzzyfikasi;         // point fuzzy
    //     $fuzzy->persentase = $defuzzyfikasi;    // point probabilitas
    //     $fuzzy->nilai = $himTerbesar;           // point dalam himpunan variabel output
    //     $fuzzy->save();

    //     // Kembali ke view detail karawan setelah penilaian disimpan
    //     $nik = $request->input('nik_karyawan');
    //     return redirect()->route('detail', ['nik' => $nik])->with('success', 'Penilaian berhasil disimpan.');
    // }








































    //////////////// Fungsi keanggotaan untuk variabel Absensi ( Input ) /////////////////////////////////////////////////////
    private function grafik_absensi($value)
    {
        $himpunan = [];

        // Himpunan Buruk ( 0 - 50 )
        if ($value == 0) {
            $a = 1;
            $him = "Kurang";
        } else if (0 < $value && $value < 50) {
            $a = (50 - $value) / (50 - 0);
            $him = "Kurang";
        } else {
            $a = 0;
            $him = "";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
            ];
        }

        // Himpunan Cukup ( 0 - 100 )
        if (0 < $value && $value < 50) {
            $a = ($value - 0) / (50 - 0);
            $him = "Cukup";
        } else if ($value == 50) {
            $a = 1;
            $him = "Cukup";
        } else if (50 < $value && $value < 100) {
            $a = (100 - $value) / (100 - 50);
            $him = "Cukup";
        } else {
            $a = 0;
            $him = "";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
            ];
        }

        // Himpunan Bagus ( 50 - 100 )
        if ($value <= 50) {
            $a = 0;
            $him = "";
        } else if (50 < $value && $value < 100) {
            $a = ($value - 50) / (100 - 50);
            $him = "Bagus";
        } else {
            $a = 1;
            $him = "Bagus";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
            ];
        }

        return $himpunan;
    }
    //////////////// Fungsi keanggotaan untuk variabel Produktifitas ( Input ) /////////////////////////////////////////////////////
    private function grafik_produktif($value)
    {
        $himpunan = [];

        // Himpunan Buruk ( 0 - 900 )
        if ($value == 0) {
            $a = 1;
            $him = "Kurang";
        } else if (0 < $value && $value < 900) {
            $a = (900 - $value) / (900 - 0);
            $him = "Kurang";
        } else {
            $a = 0;
            $him = "";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
            ];
        }

        // Himpunan Cukup ( 0 - 1800 )
        if (0 < $value && $value < 900) {
            $a = ($value - 0) / (900 - 0);
            $him = "Cukup";
        } else if ($value == 900) {
            $a = 1;
            $him = "Cukup";
        } else if (900 < $value && $value < 1800) {
            $a = (1800 - $value) / (1800 - 900);
            $him = "Cukup";
        } else {
            $a = 0;
            $him = "";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
            ];
        }

        // Himpunan Bagus ( 80 - 100 )
        if ($value <= 900) {
            $a = 0;
            $him = "";
        } else if (900 < $value && $value < 1800) {
            $a = ($value - 900) / (1800 - 900);
            $him = "Bagus";
        } else {
            $a = 1;
            $him = "Bagus";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
            ];
        }

        return $himpunan;
    }
    //////////////// Fungsi keanggotaan untuk variabel Customer Relationship ( Input ) /////////////////////////////////////////////////////
    private function grafik_custrelation($value, $batas)
    {
        $b = 1 / 2 * $batas;
        $c = $batas;

        $himpunan = [];

        // Himpunan Kurang ( 0 - b )
        if ($value == 0) {
            $a = 1;
            $him = "Kurang";
        } else if (0 < $value && $value < $b) {
            $a = ($b - $value) / ($b - 0);
            $him = "Kurang";
        } else {
            $a = 0;
            $him = "";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
            ];
        }

        // Himpunan Cukup ( 0 - c )
        if (0 < $value && $value < $b) {
            $a = ($value - 0) / ($b - 0);
            $him = "Cukup";
        } else if ($value == $b) {
            $a = 1;
            $him = "Cukup";
        } else if ($b < $value && $value < $c) {
            $a = ($c - $value) / ($c - $b);
            $him = "Cukup";
        } else {
            $a = 0;
            $him = "";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
            ];
        }

        // Himpunan Bagus ( a - c )
        if ($value <= $b) {
            $a = 0;
            $him = "";
        } else if ($b < $value && $value < $c) {
            $a = ($value - $b) / ($c - $b);
            $him = "Bagus";
        } else {
            $a = 1;
            $him = "Bagus";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
            ];
        }

        return $himpunan;
    }
    //////////////// Fungsi keanggotaan untuk variabel Keputusan ( Output ) /////////////////////////////////////////////////////
    private function grafik_keputusan($value)
    {
        $himpunan = [];

        // Himpunan Buruk ( 0 - 75 )
        if ($value < 25) {
            $a = 1;
            $him = "Tidak Terbaik";
        } else if (25 <= $value && $value <= 75) {
            $a = (75 - $value) / (75 - 25);
            $him = "Tidak Terbaik";
        } else {
            $a = 0;
            $him = "";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
            ];
        }

        // Himpunan Terbaik ( 25 - 100 )
        if ($value < 25) {
            $a = 0;
            $him = "";
        } else if (25 <= $value && $value <= 75) {
            $a = ($value - 25) / (75 - 25);
            $him = "Terbaik";
        } else {
            $a = 1;
            $him = "Terbaik";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
            ];
        }

        return $himpunan;
    }

    //////////////// Fungsi keanggotaan untuk variabel penilaian dan kerajinan ( Input ) /////////////////////////////////////////////////////
    private function grafik1($value)
    {
        $himpunan = [];

        // Himpunan Buruk ( 0 - 60 )
        if ($value <= 50) {
            $a = 1;
            $him = "buruk";
        } else if ($value > 50 && $value < 60) {
            $a = (75 - $value) / (75 - 60);
            $him = "buruk";
        } else {
            $a = 0;
            $him = "";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
            ];
        }

        // Himpunan cukup_baik ( 50 - 75 )
        if ($value > 50 && $value <= 60) {
            $a = ($value - 50) / (60 - 50);
            $him = "cukup_baik";
        } else if ($value >= 60 && $value < 75) {
            $a = (75 - $value) / (75 - 60);
            $him = "cukup_baik";
        } else {
            $a = 0;
            $him = "";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
            ];
        }

        // Himpunan Baik ( 60 - 90 )
        if ($value > 60 && $value <= 75) {
            $a = ($value - 60) / (75 - 60);
            $him = "baik";
        } else if ($value > 75 && $value <= 80) {
            $a = 1;
            $him = "baik";
        } else if ($value > 80 && $value < 90) {
            $a = (90 - $value) / (90 - 80);
            $him = "baik";
        } else {
            $a = 0;
            $him = "";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
            ];
        }

        // Himpunan Sangat Baik ( 80 - 100 )
        if ($value <= 80) {
            $a = 0;
            $him = "";
        } else if ($value > 80 && $value <= 90) {
            $a = ($value - 80) / (90 - 80);
            $him = "sangat_baik";
        } else {
            $a = 1;
            $him = "sangat_baik";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
            ];
        }

        return $himpunan;
    }
    //////////////// Fungsi keanggotaan untuk variabel kelebihan dan kekurangan ( Input ) /////////////////////////////////////////////////////
    private function grafik2($value)
    {
        $himpunan = [];
        // Himpunan Bendah ( 0 - 40 )
        if ($value <= 30) { // 0 - 30
            $a = 1;
            $him = "buruk";
        } elseif ($value > 30 && $value < 40) { // 30 - 40
            $a = ($value - 30) / (40 - 30);
            $him = "buruk";
        } elseif ($value >= 40) { // 40 - 100
            $a = 0;
            $him = "";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
            ];
        }
        // Himpunan Cukup Baik ( 30 - 60 )
        if ($value <= 30) { // 0 - 40
            $a = 0;
            $him = "";
        } elseif ($value > 30 && $value < 40) { // 30 - 40
            $a = ($value - 30) / (40 - 30);
            $him = "cukup_baik";
        } elseif ($value >= 40 && $value <= 50) { // 40 - 50
            $a = 1;
            $him = "cukup_baik";
        } elseif ($value > 50 && $value < 60) { // 50 - 60
            $a = (60 - $value) / (60 - 50);
            $him = "cukup_baik";
        } elseif ($value >= 60) { // 60 - 100
            $a = 0;
            $him = "";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
            ];
        }
        // Himpunan Baik ( 50 - 80 )
        if ($value <= 50) { // 0 - 50
            $a = 0;
            $him = "";
        } elseif ($value > 50 && $value < 60) { // 50 - 60
            $a = ($value - 50) / (60 - 50);
            $him = "baik";
        } elseif ($value >= 60 && $value <= 70) { // 60 - 70
            $a = 1;
            $him = "baik";
        } elseif ($value > 70 && $value < 80) { // 70 - 80
            $a = (80 - $value) / (80 - 70);
            $him = "baik";
        } elseif ($value >= 80) { // 80 - 100
            $a = 0;
            $him = "";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
            ];
        }
        // Himpunan Sangat Baik ( 70 - 100 )
        if ($value <= 70) { // 0 - 70
            $a = 0;
            $him = "";
        } elseif ($value > 70 && $value < 80) { // 70 - 80
            $a = ($value - 70) / (80 - 70);
            $him = "sangat_baik";
        } elseif ($value >= 80) { // 80 - 100
            $a = 1;
            $him = "sangat_baik";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
            ];
        }
        return $himpunan;
    }
    //////////////// Fungsi keanggotaan untuk variabel Hasil ( Output ) /////////////////////////////////////////////////////
    private function grafik3($value)
    {
        $himpunan = [];

        // Himpunan Rendah ( 0 - 60 )
        if ($value <= 50) { // 0 - 50
            $a = 1;
            $him = "BR";
        } elseif ($value > 50 && $value < 60) { // 50 - 60
            $a = ($value - 50) / (60 - 50);
            $him = "BR";
        } else { // 60 - 100
            $a = 0;
            $him = "";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
                "value" => $value,
            ];
        }
        // Himpunan Cukup Baik ( 50 - 70 )
        if ($value > 50 && $value < 60) { // 50 - 60
            $a = ($value - 50) / (60 - 50);
            $him = "CB";
        } elseif ($value >= 60 && $value < 70) { // 60 - 70
            $a = (70 - $value) / (70 - 60);
            $him = "CB";
        } elseif ($value == 60) { // 60
            $a = 1;
            $him = "CB";
        } else { // selain 50 - 70
            $a = 0;
            $him = "";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
                "value" => $value,
            ];
        }
        // Himpunan Baik ( 60 - 80 )
        if ($value <= 60 && $value >= 80) { // selain 60 - 80
            $a = 0;
            $him = "";
        } elseif ($value > 60 && $value < 70) { // 60 - 70
            $a = ($value - 60) / (70 - 60);
            $him = "BA";
        } elseif ($value > 70 && $value < 80) { // 70 - 80
            $a = (80 - $value) / (80 - 70);
            $him = "BA";
        } elseif ($value == 70) { // 70
            $a = 1;
            $him = "BA";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
                "value" => $value,
            ];
        }
        // Himpunan Sangat Baik ( 70 - 100 )
        if ($value <= 70) { // 0 - 70
            $a = 0;
            $him = "";
        } elseif ($value > 70 && $value < 80) { // 70 - 80
            $a = ($value - 70) / (80 - 70);
            $him = "SB";
        } elseif ($value >= 80) { // 60 - 100
            $a = 1;
            $him = "SB";
        }

        if (!empty($him)) {
            $himpunan[] = [
                "a" => $a,
                "him" => $him,
                "value" => $value,
            ];
        }
        return $himpunan;
    }
    ////////// MEMBUAT ATURAN DENGAN LOOPING //////////////////////////
    public function store_rule_view()
    {
        return view('penilaian.form2');
    }
    public function store_rule(Request $request)
    {
        $him_level = ["Kurang", "Cukup", "Bagus"];
        $value_mapping = ["Kurang" => -10, "Cukup" => 1, "Bagus" => 2];

        $rules = [];

        foreach ($him_level as $absensi) {
            foreach ($him_level as $produktif) {
                foreach ($him_level as $custrelation) {
                    $input_values = [
                        $value_mapping[$absensi],
                        $value_mapping[$produktif],
                        $value_mapping[$custrelation]
                    ];

                    $total_count = array_sum($input_values);

                    if ($total_count >= 1) {
                        $output_level = "Terbaik";
                    } elseif ($total_count <= 0) {
                        $output_level = "Tidak Terbaik";
                    }

                    // Tambahkan aturan ke dalam array rules
                    $rules[] = [
                        "absensi" => $absensi,
                        "produktif" => $produktif,
                        "custrelation" => $custrelation,
                        "keputusan" => $output_level,
                    ];
                }
            }
        }

        // Simpan hasil aturan ke dalam tabel (contoh menggunakan Laravel Eloquent)
        foreach ($rules as $rule) {
            $newRule = new aturan_baru();
            $newRule->absensi = $rule['absensi'];
            $newRule->produktif = $rule['produktif'];
            $newRule->custrelation = $rule['custrelation'];
            $newRule->keputusan = $rule['keputusan'];
            $newRule->save();
        }
    }
    ////////// TEST PERHITUNGAN FUZZY /////////////////////////////////////
    public function showtest(Request $request)
    {
        $nilai_absensi = 100;
        $nilai_produktif = 1600;
        $nilai_custrelation = 1450;

        // FUZZYFIKASI
        $absensi_grafik = $this->grafik_absensi($nilai_absensi);
        $produktif_grafik = $this->grafik_produktif($nilai_produktif);
        $custrelation_grafik = $this->grafik_custrelation($nilai_custrelation, $nilai_produktif);

        $fuzzyfikasi = [
            "absensi" => $absensi_grafik,
            "produktif" => $produktif_grafik,
            "custrelation" => $custrelation_grafik,
        ];

        $A_Absensi = [];
        foreach ($absensi_grafik as $item) {
            $A_Absensi[$item['him']] = $item['a'];
        }

        $A_produktif = [];
        foreach ($produktif_grafik as $item) {
            $A_produktif[$item['him']] = $item['a'];
        }

        $A_custrelation = [];
        foreach ($custrelation_grafik as $item) {
            $A_custrelation[$item['him']] = $item['a'];
        }

        // INFERENNSI
        $minProbabilitas = null; // Initialize with null to find the minimum
        $minProbabilitasHim = null; // Initialize with null to store the 'him' associated with the minimum 'a'
        foreach ($absensi_grafik as $absensi) {
            foreach ($produktif_grafik as $produktif) {
                foreach ($custrelation_grafik as $custrelation) {
                    // Ambil aturan dari tabel Aturan berdasarkan jenis tipe
                    $rule = aturan_baru::where('absensi', $absensi['him'])
                        ->where('produktif', $produktif['him'])
                        ->where('custrelation', $custrelation['him'])
                        ->first();

                    $aValues = [
                        $A_Absensi[$absensi['him']],
                        $A_produktif[$produktif['him']],
                        $A_custrelation[$custrelation['him']],
                    ];
                    $aValuesString = json_encode($aValues);
                    $minA = min($aValues);

                    $probilitas[] = [
                        "absensi" => $absensi,
                        "produktif" => $produktif,
                        "custrelation" => $custrelation,
                        "rule" => $rule,
                        "a" => $aValuesString,
                        "min_probabilitas" => $minA, // Menyimpan nilai minimum probabilitas di setiap iterasi
                    ];
                }
            }
        }

        $inferensi = [];
        foreach ($probilitas as $data) {
            $output_rule = $data['rule']['keputusan'];
            $min_probabilitas = $data['min_probabilitas'];

            // Lakukan perhitungan berdasarkan output_rule dan min_probabilitas
            $hasil = 0; // Inisialisasi hasil perhitungan
            if ($output_rule == 'Tidak Terbaik') {
                $z = 50 - ($min_probabilitas * (100 - 50)); // linier Turun
            } elseif ($output_rule == 'Terbaik') {
                $z = 50 + ($min_probabilitas * (100 - 50)); // linier Naik
            }

            // Tambahkan hasil perhitungan ke dalam array
            $inferensi[] = [
                "absensi" => $absensi,
                "produktif" => $produktif,
                "custrelation" => $custrelation,
                "rule" => $data['rule'],
                "a" => $data['a'],
                "minProbabilitas" => $min_probabilitas,
                "z" => $z,
            ];
        }
        // ( DEFUZZYFIASI )
        $defuzzyfikasi_numerator = 0; // Inisialisasi pembilang
        $defuzzyfikasi_denominator = 0; // Inisialisasi penyebut

        foreach ($inferensi as $data) {
            $min_probabilitas = $data['minProbabilitas'];
            $z = $data['z'];

            // Tambahkan nilai ke pembilang dan penyebut
            $defuzzyfikasi_numerator += ($min_probabilitas * $z);
            $defuzzyfikasi_denominator += $min_probabilitas;
        }

        // Hitung nilai defuzzyfikasi
        if ($defuzzyfikasi_denominator != 0) {
            $defuzzyfikasi = $defuzzyfikasi_numerator / $defuzzyfikasi_denominator;
        } else {
            $defuzzyfikasi = 0; // Atasi potensi pembagian oleh nol
        }

        $input  = $defuzzyfikasi;
        // Masukan point dari defuzzyfikasi ke dalam grafik Hasil(Output)
        $output_grafik = $this->grafik_keputusan($input);

        // Simpan hasil dari grafik ke dalam array
        $hasil = [];
        foreach ($output_grafik as $item) {
            $hasil[$item['him']] = $item['a'];
        }

        // Bandingkan himpunan dari variabel outpu yang tercipta
        $nilaiTerbesar = 0;
        $himTerbesar = '';

        foreach ($hasil as $him => $nilai) {
            if ($nilai > $nilaiTerbesar) {
                $nilaiTerbesar = $nilai;
                $himTerbesar = $him;
            }
        }

        return view('test', compact('fuzzyfikasi', 'himTerbesar', 'nilaiTerbesar', 'hasil', 'probilitas', 'inferensi', 'defuzzyfikasi', 'defuzzyfikasi_numerator', 'defuzzyfikasi_denominator'));
    }
}

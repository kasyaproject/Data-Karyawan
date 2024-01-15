<x-app-layout title="Form Penilaian">
  @section('sidebar#2','bg-gray-100')
    @section('container')

    <div class="main ml-64 pt-14 px-4">
      <!-- Detail karyawan dan penilai -->
        <div class="flex flex-col md:flex-row bg-white p-4 px-12 mt-4 m-2 rounded-md shadow-md">
          <div class="flex md:w-1/2 items-center border-r-2">
            <img src="{{ asset('storage/' . $data->image->path) }}" 
            alt="" class="w-48 h-48 object-cover border-2 shadow-md rounded-xl">
            <div class="mx-2">
              <h3 class="text-2xl font-semibold mb-2 mx-2">{{ $data->nama }}</h3>
              <table class="text-gray-500 mx-4">
                <tr>
                  <td class="w-[8vw]">NIK</td>
                  <td>: {{ $data->nik }}</td>
                </tr>
                <tr>
                  <td class="w-[8vw]">Lama Bekerja</td>
                  <td>: {{ $data->lama_kerja }}</td>
                </tr>
                <tr>
                  <td class="w-[8vw]">Jabatan</td>
                  <td>: {{ $data->jabatan }}</td>
                </tr>
                <tr>
                  <td class="w-[8vw]">Unit / Divisi</td>
                  <td>: {{ $data->unit }}</td>
                </tr>
                <tr>
                  <td class="w-[8vw]">Posisi Terakhir</td>
                  <td>: {{ $data->posisi }}</td>
                </tr>
              </table>
            </div>
          </div>
          <div class="flex md:w-1/2 mt-2">
              <div class="justify-start">
                <h3 class="text-2xl font-semibold mx-4 mb-2">{{ $penilai->nama }}</h3>
                <table class="text-gray-500 mx-8">
                  <tr>
                    <td class="w-[8vw]">NIK</td>
                    <td>: {{ $penilai->nik }}</td>
                  </tr>
                  <tr>
                    <td class="w-[8vw]">Jabatan</td>
                    <td>: {{ $penilai->jabatan }}</td>
                  </tr>
                  <tr>
                    <td class="w-[8vw]">Unit / Divisi</td>
                    <td>: {{ $penilai->divisi }}</td>
                  </tr>
                </table>
              </div>
          </div>
        </div>
      <!-- Detail karyawan dan penilai END -->

      <form action="/data/form/{nik}" method="post" class="w-full pb-8">
        @csrf
        <!-- Data detail penilai -->
          <input type="hidden" name="tgl_penilaian" value="{{ now() }}">
          <input type="hidden" name="nik_karyawan" value="{{ $data->nik }}">
          <input type="hidden" name="nama_penilai" value="{{ $penilai->nama }}">
          @if ($penilai->hak_akses === 'admin')
              <input type="hidden" name="verifikasi" value="yes">
          @else
              <input type="hidden" name="verifikasi" value="no">
          @endif
        <!-- Data detail penilai END -->

        <!-- Form Penilaian Karyawan -->
          <div class="bg-white p-4 m-2 rounded-lg shadow-md">
            <div class="px-4 pb-2 border-b-2">
              <label class="font-bold text-xl ">Form Penilaian SDM</label>
              <p class="w-2/3 text-gray-600">Form penilaian SDM dibuat untuk menilai kinerja SDM yang dilakukan oleh atasan, dimana penilaian dilakukan secara subjektif. penilaian ini dilakukan dengan point dimulai dari 1 - 100 point yang menunjukan kinerja SDM tersebut.</p>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6 px-8 pt-8">
              <div class="relative z-0 w-full mb-6 group">
                <label for="kerajinan" class="block text-gray-600 text-sm mb-2">Kerajinan</label>  
                <input for="kerajinan" name="kerajinan" type="number" min="0" max="100" oninput="limitValue(this, 0, 100);" class="w-full px-4 py-2 rounded-md" placeholder="1 ~ 100 point" required>
              </div>
              <div class="relative z-0 w-full mb-6 group">
                <label for="loyalitas" class="block text-gray-600 text-sm mb-2">Loyalitas</label>  
                <input for="loyalitas" name="loyalitas" type="number" min="0" max="100" oninput="limitValue(this, 0, 100);" class="w-full px-4 py-2 rounded-md" placeholder="1 ~ 100 point" required>
              </div>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6 px-8">
              <div class="relative z-0 w-full mb-6 group">
                <label for="inisiatif" class="block text-gray-600 text-sm mb-2">Inisiatif</label>  
                <input for="inisiatif" name="inisiatif" type="number" min="0" max="100" oninput="limitValue(this, 0, 100);" class="w-full px-4 py-2 rounded-md" placeholder="1 ~ 100 point" required>
              </div>
              <div class="relative z-0 w-full mb-6 group">
                <label for="kerjasama" class="block text-gray-600 text-sm mb-2">Kerja Sama</label>  
                <input for="kerjasama" name="kerjasama" type="number" min="0" max="100" oninput="limitValue(this, 0, 100);" class="w-full px-4 py-2 rounded-md" placeholder="1 ~ 100 point" required>
              </div>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6 px-8">
              <div class="relative z-0 w-full mb-6 group">
                <label for="integritas" class="block text-gray-600 text-sm mb-2">Integritas</label>  
                <input for="integritas" name="integritas" type="number" min="0" max="100" oninput="limitValue(this, 0, 100);" class="w-full px-4 py-2 rounded-md" placeholder="1 ~ 100 point" required>
              </div>
              <div class="relative z-0 w-full mb-6 group">
                <label for="daqumethod" class="block text-gray-600 text-sm mb-2">Daqu Method</label>  
                <input for="daqumethod" name="daqumethod" type="number" min="0" max="100" oninput="limitValue(this, 0, 100);" class="w-full px-4 py-2 rounded-md" placeholder="1 ~ 100 point" required>
              </div>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6 px-8">
              <div class="relative z-0 w-full mb-6 group">
                <label for="custrelation" class="block text-gray-600 text-sm mb-2">Customer Relationship</label>  
                <input for="custrelation" name="custrelation" type="number" min="0" max="100" oninput="limitValue(this, 0, 100);" class="w-full px-4 py-2 rounded-md" placeholder="1 ~ 100 point" required>
              </div>
              <div class="relative z-0 w-full mb-6 group">
                <label for="kerapihan" class="block text-gray-600 text-sm mb-2">Kerapihan</label>  
                <input for="kerapihan" name="kerapihan" type="number" min="0" max="100" oninput="limitValue(this, 0, 100);" class="w-full px-4 py-2 rounded-md" placeholder="1 ~ 100 point" required>
              </div>
            </div>
          </div>
        <!-- Form Penilaian Karyawan END-->

        <!-- Form Kerajinan Karyawan -->
          <div class="bg-white m-2 p-4 rounded-lg shadow-md">
            <div class="px-4 pb-2 border-b-2">
              <label class="font-bold text-xl ">Form Kerajinan</label>
              <p class="w-2/3 text-gray-600">Identifikasikan tingkat kehadiran dan juga pelanggaran jam kerja dari SDM yang anda nilai.</p>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6 px-8 pt-8">
              <div class="relative z-0 w-full mb-6 group">
                <label for="sakit" class="block text-gray-600 text-sm mb-2">Sakit (dg Surat Keterangan Dokter)</label>  
                <input for="sakit" name="sakit" type="text" class="w-full px-4 py-2 rounded-md" placeholder="  /hari" required>
              </div>
              <div class="relative z-0 w-full mb-6 group">
                <label for="terlambat" class="block text-gray-600 text-sm mb-2">Datang Terlambat</label>  
                <input for="terlambat" name="terlambat" type="text" class="w-full px-4 py-2  rounded-md" placeholder="  /jam" required>
              </div>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6 px-8">
              <div class="relative z-0 w-full mb-6 group">
                <label for="izin" class="block text-gray-600 text-sm mb-2">Izin / Sakit (Tanpa SKD)</label>  
                <input for="izin" name="izin" type="text" class="w-full px-4 py-2 rounded-md" placeholder="  /hari" required>
              </div>
              <div class="relative z-0 w-full mb-6 group">
                <label for="pulangcepat" class="block text-gray-600 text-sm mb-2">Pulang Cepat</label>  
                <input for="pulangcepat" name="pulangcepat" type="text" class="w-full px-4 py-2 rounded-md" placeholder="  /jam" required>
              </div>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6 px-8">
              <div class="relative z-0 w-full mb-6 group">
                <label for="tanpaizin" class="block text-gray-600 text-sm mb-2">Tanpa Izin</label>  
                <input for="tanpaizin" name="tanpaizin" type="text" class="w-full px-4 py-2 rounded-md" placeholder="  /hari" required>
              </div>
              <div class="relative z-0 w-full mb-6 group">
                <label for=""></label>  
              </div>
            </div>
          </div>
        <!-- Form Kerajinan Karyawan -->

        <!-- Form Analisis Kekuatan dan Kelemahan -->
          <div class="bg-white m-2 p-4 rounded-lg shadow-md">
            <div class="px-4 pb-2 border-b-2">
              <label class="font-bold text-xl ">Form Analisis Kekuatan dan Kelemahan</label>
              <p class="w-2/3 text-gray-600">Identifikasikan kekuatan dan kelemahan dari SDM yang anda nilai. Dan kemukakan perkembangan apa yang anda inginkan untuk SDM tersebut pada periode mendatang.</p>
            </div>
            <!-- Kelebihan & Kekurangan-->
            <div class="mt-2">
              <div class="grid md:grid-cols-2 md:gap-6 px-8 pt-8">
                <div class="relative z-0 w-full mb-4 group">
                  <label for="kelebihan" class="block text-gray-600 text-sm mb-2">Kelebihan</label>  
                  <select name="kelebihan[]" id="kelebihan" multiple required>
                    <option value="Kemampuan Berkomunikasi">Kemampuan Berkomunikasi</option>
                    <option value="Kreativitas & Inovasi">Kreativitas & Inovasi</option>
                    <option value="Kerja Tim Solid">Kerja Tim Solid</option>
                    <option value="Pemecahan Masalah">Pemecahan Masalah</option>
                    <option value="Inisiatif & Proaktif">Inisiatif & Proaktif</option>
                    <option value="Kemampuan Analisis">Kemampuan Analisis</option>
                    <option value="Pengelolaan Waktu">Pengelolaan Waktu</option>
                    <option value="Kepemimpinan">Kepemimpinan</option>
                    <option value="Keterampilan Teknis">Keterampilan Teknis</option>
                    <option value="Keandalan">Keandalan</option>
                  </select>
                </div>
                <div class="relative z-0 w-full mb-4 group">
                  <label for="kekurangan" class="block text-gray-600 text-sm mb-2">Kekurangan</label>  
                  <select name="kekurangan[]" id="kekurangan" multiple required>
                    <option value="Ketidaktepatan Pekerjaan">Ketidaktepatan Pekerjaan</option>
                    <option value="Kurang Kemauan Belajar">Kurang Kemauan Belajar</option>
                    <option value="Rendah Produktivitas">Rendah Produktivitas</option>
                    <option value="Kurang Komitmen">Kurang Komitmen</option>
                    <option value="Kurang Berinisiatif">Kurang Berinisiatif</option>
                    <option value="Sulit Tangani Kritik">Sulit Tangani Kritik</option>
                    <option value="Tidak Kuat Tekanan">Tidak Kuat Tekanan</option>
                    <option value="Kurang Kolaborasi">Kurang Kolaborasi</option>
                    <option value="Ketidaktaatan Aturan">Ketidaktaatan Aturan</option>
                    <option value="Ketidakefisienan Tugas">Ketidakefisienan Tugas</option>
                  </select>
                </div>
              </div>
            </div>
            <!-- Kelebihan & Kekurangan END-->
            <!-- Rangkuman -->
            <div class="w-full px-8">
              <div class="w-full mb-4 group">
                <label for="rangkuman" class="block text-gray-600 text-sm mb-2">Rangkuman diskusi penilaian ini dengan SDM yang dinilai</label>  
                <textarea for="rangkuman" 
                type="text" name="rangkuman"
                class="w-full h-32 px-4 py-2 rounded-md resize-none" required></textarea>
              </div>
            </div>
            <!-- Rangkuman END-->
            <!-- Kebutuhan & Rekomendasi -->
            <div class="mt-2">
              <div class="grid md:grid-cols-2 md:gap-6 px-8">
                <div class="w-full mb-4 group">
                  <label for="kebutuhan" class="block text-gray-600 text-sm mb-2">Kebutuhan Training dan Development</label>  
                  <textarea for="kebutuhan" 
                  type="text" name="kebutuhan"
                  class="w-full h-32 px-4 py-2 rounded-md resize-none" required></textarea>
                </div>
                <div class="w-full mb-4 group">
                  <label for="rekomendasi" class="block text-gray-600 text-sm mb-2">Rekomendasi Terhadap SDM ini</label>  
                  <textarea for="rekomendasi" 
                  type="text" name="rekomendasi"
                  class="w-full h-32 px-4 py-2 rounded-md resize-none" required></textarea>
                </div>
              </div>
            </div>
            <!-- Kebutuhan & Rekomendasi END-->           
            <!-- Catatan Akhir -->
            <div class="mt-2">
              <label for="catatan" class="block text-gray-600 text-sm mb-2 px-8">Catatan Akhir</label>
              <div class="grid px-12">
                  <div class="flex items-center mb-1">
                      <input type="radio" id="option1" name="catatan" value="Dilanjut sebagai karyawan kontrak" class="form-radio text-indigo-600" required>
                      <label for="option1" class="ml-2 text-gray-700 text-sm  ">Dilanjut sebagai <label class="text-blue-600 font-semibold">Karyawan kontrak</label></label>
                  </div>            
                  <div class="flex items-center mb-1">
                      <input type="radio" id="option2" name="catatan" value="Dilanjut sebagai karyawan tetap" class="form-radio text-indigo-600">
                      <label for="option2" class="ml-2 text-gray-700 text-sm">Dilanjut sebagai <label class="text-blue-600 font-semibold">Karyawan tetap</label></label>
                  </div>            
                  <div class="flex items-center mb-1">
                      <input type="radio" id="option3" name="catatan" value="Tidak dilanjut" class="form-radio text-indigo-600">
                      <label for="option3" class="ml-2 text-gray-700 text-sm">Tidak dlanjut</label>
                  </div>
              </div>
            </div>          
            <!-- Catatan Akhir END-->
            <div class="flex justify-end px-4 mx-4 mt-4">
              <button type="submit" class="bg-blue-500 text-white font-bold px-4 py-2 rounded">Buat Penilaian</button>
            </div>
          </div>
        <!-- Form Analisis Kekuatan dan Kelemahan END-->
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
    <script>
      // Membatasi input nilai 0-100
      function limitValue(input, min, max) {
        if (input.value < min) {
          input.value = min;
        } else if (input.value > max) {
          input.value = max;
        }
      }

      // Kelebihan & kekurangan select tag
      new MultiSelectTag('kelebihan')  // id
      new MultiSelectTag('kekurangan')  // id
      new MultiSelectTag('catatan')  // id
    </script>

    @endsection
</x-app-layout>
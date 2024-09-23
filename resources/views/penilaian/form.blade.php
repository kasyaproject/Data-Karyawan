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
          <input type="hidden" name="tgl_penilaian" value="{{ now()->setTimezone('Asia/Jakarta') }}">
          <input type="hidden" name="nik_karyawan" value="{{ $data->nik }}">
          <input type="hidden" name="nama_penilai" value="{{ $penilai->nama }}">
          @if ($penilai->hak_akses === 'admin')
              <input type="hidden" name="verifikasi" value="yes">
          @else
              <input type="hidden" name="verifikasi" value="no">
          @endif

        <!-- Form Absensi Karyawan -->
          <div class="bg-white m-2 p-4 rounded-lg shadow-md">
            <div class="px-4 pb-2 border-b-2">
              <label class="font-bold text-xl ">Form Absensi</label>
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
        <!-- Form Absensi Karyawan -->

        <!-- Form Absensi Karyawan -->
        <div class="bg-white m-2 p-4 rounded-lg shadow-md">
          <div class="px-4 pb-2 border-b-2">
            <label class="font-bold text-xl">Form Produktifitas</label>
            <p class="w-2/3 text-gray-600">Identifikasikan jumlah pelayanan yang telah diselesaikan dari SDM yang anda nilai.</p>
          </div>

          <div class="flex px-8 pt-8">
            <div class="relative z-0 w-full mb-6 group">
              <label for="produktif" class="block text-gray-600 text-sm mb-2">Produktifitas</label>
              <input for="produktif" id="produktif" name="produktif" type="number" class="w-full px-4 py-2 rounded-md" min="100" max="1800" oninput="limitValue(this, 0, 1800);" placeholder="100 ~ 1800" required>
            </div>
          </div>
        </div>
        <!-- Form Produktif Karyawan END -->

        <!-- Form Custrelation Karyawan -->
        <div class="bg-white m-2 p-4 rounded-lg shadow-md">
          <div class="px-4 pb-2 border-b-2">
            <label class="font-bold text-xl">Form Customer Relationship</label>
            <p class="w-2/3 text-gray-600">Identifikasikan jumlah kepuasan dari pelayanan yang telah diselesaikan dari SDM yang anda nilai.</p>
          </div>

          <div class="flex px-8 pt-8">
            <div class="relative z-0 w-full mb-2 group">
              <label for="custrelation" class="block text-gray-600 text-sm mb-2">Customer Relationship</label>
              <input for="custrelation" id="custrelation" name="custrelation" type="number" class="w-full px-4 py-2 rounded-md" min="100" max="1800" oninput="CompareValue(this, 0, 1800);" placeholder="0 ~ 1800" required>
              <label for="custrelation" class="block text-gray-600 text-sm mt-3">Jumlah kepuasan pelayanan terhadap customer tidak akan melebihi jumlah dari inputan pada form Produktifitas</label>
            </div>
          </div>
        </div>
        <!-- Form Custrelation Karyawan END -->
        
        <!-- Button -->
        <div class="bg-white m-2 rounded-lg shadow-md">
          <div class="text-center">
            <button type="submit" class="w-full text-white font-semibold px-4 py-2 rounded-md bg-indigo-500 hover:bg-indigo-600 ">Buat Data</button>
          </div>
        </div>
        <!-- Button END -->
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

      function CompareValue(input, min, max) {
        var produktifValue = parseInt(document.getElementById('produktif').value, 10);

        if (input.value < min) {
          input.value = min;
        } else if (input.value > produktifValue) {
          input.value = produktifValue;
        }
      }
    </script>

    @endsection
</x-app-layout>
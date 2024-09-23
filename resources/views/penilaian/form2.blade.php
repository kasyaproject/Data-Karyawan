<x-app-layout title="Form Penilaian">
  @section('add_data','bg-gray-100')
    @section('container')

    <!-- DIGUNAKAN HAYNA UNTUK MEMBUAT ATURAN  -->
    <div class="main ml-64 pt-14 px-4">
      <!-- Detail karyawan dan penilai -->
        <div class="flex flex-col md:flex-row bg-white p-4 px-12 mt-4 m-2 rounded-md shadow-md">
          <div class="flex md:w-1/2 items-center border-r-2">
            <img src="" 
            alt="" class="w-48 h-48 object-cover border-2 shadow-md rounded-xl">
            <div class="mx-2">
              <h3 class="text-2xl font-semibold mb-2 mx-2"></h3>
              <table class="text-gray-500 mx-4">
                <tr>
                  <td class="w-[8vw]">NIK</td>
                  <td>: </td>
                </tr>
                <tr>
                  <td class="w-[8vw]">Lama Bekerja</td>
                  <td>: </td>
                </tr>
                <tr>
                  <td class="w-[8vw]">Jabatan</td>
                  <td>: </td>
                </tr>
                <tr>
                  <td class="w-[8vw]">Unit / Divisi</td>
                  <td>: </td>
                </tr>
                <tr>
                  <td class="w-[8vw]">Posisi Terakhir</td>
                  <td>: </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="flex md:w-1/2 mt-2">
              <div class="justify-start">
                <h3 class="text-2xl font-semibold mx-4 mb-2"></h3>
                <table class="text-gray-500 mx-8">
                  <tr>
                    <td class="w-[8vw]">NIK</td>
                    <td>: </td>
                  </tr>
                  <tr>
                    <td class="w-[8vw]">Jabatan</td>
                    <td>: </td>
                  </tr>
                  <tr>
                    <td class="w-[8vw]">Unit / Divisi</td>
                    <td>: </td>
                  </tr>
                </table>
              </div>
          </div>
        </div>
      <!-- Detail karyawan dan penilai END -->

      <form action="/form2" method="post" class="w-full pb-8">
        @csrf
        <div class="flex justify-end px-4 mx-4">
          <button type="submit" class="bg-blue-500 text-white font-bold px-4 py-2 rounded">Buat Penilaian</button>
        </div>
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
    </script>

    @endsection
</x-app-layout>
<x-app-layout title="Tambah Data">
  @section('sidebar#1','bg-gray-100')
    
    @section('container')

    <div class="main ml-60 pt-[56px] px-4">
      <div class="mx-auto p-4">
        <div class="flex flex-col md:flex-row bg-white shadow-md rounded-lg overflow-hidden">
          <form action="/tambah_data" method="post" enctype="multipart/form-data" class="flex w-full">
            @csrf
            <!-- Input Foto -->
            <div class="md:w-1/3 bg-white p-8 flex flex-col items-center border-r-2">
              <h2 class="text-2xl font-bold justify-center border-b- pb-2">Biodata Karyawan Baru</h2>
              <hr class="h-2 w-full bg-white border-b-2">
              <div class="relative rounded-full mb-4 w-56 h-56 justify-center bg-gray-900 bg-opacity-50 hover:bg-opacity- overflow-hidden mt-10">
                  <input id="image" name="image" type="file" class="hidden w-56 h-56" accept="image/png, image/jpeg" onchange="previewImage(event)" />
                  <img class="object-cover w-full h-full" src="/asset/default-akun.jpg" alt="" id="previewImage" />
              </div>
              <label for="image" class="cursor-pointer bg-indigo-500 hover-bg-indigo-600 text-white px-4 py-2 rounded-md block text-center w-full">Pilih Foto</label>
                       
              @if ($errors->has('image'))
                  <p id="image_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">Foto harus diisi.</p>
              @endif
          
              <label class="text-sm my-4 text-gray-600">
                  Foto membantu orang mengenali karyawan dan memberi tahu anda saat anda menilai kinerja karyawan tersebut,
                  Unggah file dari perangkat Anda. Gambar harus persegi, minimal 184px x 184px.
              </label>
            </div>          
            <!-- Input Foto END -->
    
            <!-- Input Biodata -->
              <div class="w-full md:w-2/3 p-4">
                  <div class="mb-4">
                    <label for="nama" class="block text-gray-600 text-sm mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" maxlength="30" value="{{ old('nama') }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Masukkan Nama Lengkap" required oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '');">
                    @error('nama')
                      <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-green-400">{{ $message }}</p>
                    @enderror
                  </div>
          
                  <div class="mb-4">
                    <label for="nik" class="block text-gray-600 text-sm mb-2">NIK</label>
                    <input type="text" name="nik" id="nik" maxlength="20" value="{{ old('nik') }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Masukkan NIK" required oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                    @error('nik')
                      <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-green-400">{{ $message }}</p>
                    @enderror
                  </div>
          
                  <div class="mb-4">
                    <label for="mulaikerja" class="block text-gray-600 text-sm mb-2">Mulai Bekerja</label>
                    <input type="date" name="mulaikerja" id="mulaikerja" value="{{ old('mulaikerja') }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Masukkan Email" required>
                    @error('mulaikerja')
                      <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-green-400">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="mb-4">
                    <label for="jabatan" class="block text-gray-600 text-sm mb-2">Jabatan</label>
                    <input type="text" name="jabatan" id="jabatan" maxlength="25" value="{{ old('jabatan') }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Masukkan Jabatan" required>
                    @error('jabatan')
                      <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-green-400">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="mb-4">
                    <label for="unit" class="block text-gray-600 text-sm mb-2">Unit / Divisi</label>
                    <select name="unit" id="unit" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-indigo-200 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                      <option selected>Pilih divisi/unit akun</option>
                      @foreach ($pilihan as $opt)
                        <option value="{{ $opt->nama_divisi }}" class="text-black">{{ $opt->nama_divisi }}</option>
                      @endforeach   
                    </select>
                    @error('unit')
                      <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-green-400">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="mb-4">
                    <label for="posisi" class="block text-gray-600 text-sm mb-2">Position Terahir</label>
                    <input type="text" name="posisi" id="posisi" maxlength="25" value="{{ old('posisi') }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Masukkan Posisi Terakhir" required>
                    @error('posisi')
                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-green-400">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="text-right">
                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md">Buat Data</button>
                  </div>
              </div>
            <!-- Input Biodata END -->
          </form>
        </div>
      </div>
    </div>

    <script>
      function previewImage(event) {
        const imageInput = event.target;
        const previewImage = document.getElementById('previewImage');
  
        if (imageInput.files && imageInput.files[0]) {
          const reader = new FileReader();
          reader.onload = function(e) {
            previewImage.src = e.target.result;
          }
          reader.readAsDataURL(imageInput.files[0]);
        }
      }
  
      const imageInput = document.getElementById('image');
      imageInput.addEventListener('change', previewImage);
    </script>

    @endsection
</x-app-layout>
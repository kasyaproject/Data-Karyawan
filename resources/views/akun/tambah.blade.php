<x-app-layout title="Tambah Akun">
  @section('sidebar#3','bg-gray-100')
    @section('container')

    <div class="main ml-60 pt-[56px] px-4">
      <div class="bg-white px-4 py-2 mx-4 my-8 rounded-lg shadow-md">
        <div class="flex py-4 m-8 border-b-2">
          <h3 class="text-3xl font-bold">Tambah Akses Login</h3>
        </div>

        <!-- Main tambah DIVISI/UNIT -->
          <div id="staticModal-divisi" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Divisi/Unit
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="staticModal-divisi">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <form action="/daftar_akses/pilihan" method="POST">
                      @csrf
                      <!-- Modal body -->
                      <div class="p-6 space-y-6">
                          <p class="text-base leading-relaxed dark:text-gray-400">
                            Buat Pilihan Divisi/Unit baru
                          </p>
                          <input name="nama_divisi" type="text" maxlength="50" class="w-full px-4 py-2 border-2 rounded-md ring-black" value="{{ old('pilihan') }}" placeholder="Masukan pilihan Divisi/Unit" required>
                      </div>
                      <!-- Modal footer -->
                      <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                          <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buat pilihan</button>
                          <button data-modal-hide="staticModal-divisi" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
                      </div>
                    </form>
                </div>
            </div>
          </div>
        <!-- Main tambah DIVISI/UNIT END -->

        <!-- FORM MEMBUAT AKSES LOGIN -->
        <form class="w-full p-4" action="/daftar_akses/regist" method="post">
          @csrf
          <div class="grid md:grid-cols-1 md:gap-6">
            <div class="relative z-0 w-full mb-6 group">
              <label for="nama" class="block text-gray-600 text-sm mb-2">Nama Lengkap</label>  
              <input name="nama" type="text" maxlength="30" class="w-full px-4 py-2 border-2 rounded-md ring-black" value="{{ old('nama') }}" placeholder="Masukan Nama Lengkap" required oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '');">
              @error('nama')
              <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-green-400">{{ $message }}</p>
              @enderror
            </div>     
          </div>            
            <div class="grid md:grid-cols-2 md:gap-6">
              <div class="relative z-0 w-full mb-6 group">
                <label for="username" class="block text-gray-600 text-sm mb-2">Username</label>  
                <input name="username" type="text" maxlength="50" class="w-full px-4 py-2 border-2 rounded-md ring-black" value="{{ old('username') }}" placeholder="Masukan username akun" required>
                @error('username')
                <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-green-400">{{ $message }}</p>
                @enderror
              </div>
              <div class="relative z-0 w-full mb-6 group">
                <label for="nik" class="block text-gray-600 text-sm mb-2">NIK</label>  
                <input name="nik" type="number" maxlength="20" class="w-full px-4 py-2 border-2 rounded-md ring-black appearance-none no-spin" value="{{ old('nik') }}" placeholder="Masukan NIK akun" required oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                @error('nik')
                <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-green-400">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
              <div class="relative z-0 w-full mb-6 group">
                <label for="password" class="block text-gray-600 text-sm mb-2">Password</label>  
                <input name="password" type="text" maxlength="25" class="w-full px-4 py-2 border-2 rounded-md ring-black" value="{{ old('password') }}" placeholder="Masukan password akun" required>
                @error('password')
                <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-green-400">{{ $message }}</p>
                @enderror
              </div>
              <div class="relative z-0 w-full mb-6 group">
                <label for="hak_akses" class="block text-gray-600 text-sm mb-2">Hak akses</label>  
                <select name="hak_akses" id="hak_akses" class="text-gray-600 border-2 rounded-md ring-black focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                  <option value="" disabled selected>Pilih hak akses akun</option>
                  <option value="admin" class="text-black">Admin</option>
                  <option value="user" class="text-black">User</option>
                </select>
                @error('hak_akses')
                <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-green-400">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
              <div class="relative z-0 w-full mb-6 group">
                <label for="jabatan" class="block text-gray-600 text-sm mb-2">Jabatan</label>  
                <input name="jabatan" type="text" maxlength="30" class="w-full px-4 py-2 border-2 rounded-md ring-black" value="{{ old('jabatan') }}" placeholder="Masukan jabatan akun" required>
                @error('jabatan')
                <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-green-400">{{ $message }}</p>
                @enderror
              </div>
              <div class="relative z-0 w-full mb-6 group">
                <label for="divisi" class="block text-gray-600 text-sm mb-2">Divisi / Unit</label>
                <div class="flex gap-1 items-center">  
                  <select name="divisi" id="divisi" class="text-gray-600 border-2 rounded-md ring-black focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option disabled selected>Pilih divisi/unit akun</option>
                    @foreach ($pilihan as $opt)
                      <option value="{{ $opt->nama_divisi }}" class="text-black">{{ $opt->nama_divisi }}</option>
                    @endforeach   
                  </select>
                  <button data-modal-target="staticModal-divisi" data-modal-toggle="staticModal-divisi" type="button">
                    <i class="flex bi bi-plus-lg items-center justify-center text-white p-2 bg-blue-400 rounded-md"></i></button>
                </div>
                @error('divisi')
                <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-green-400">Field Divisi / Unit harus diisi !</p>
                @enderror
              </div>
            </div>
            <div class="flex justify-end">
              <button type="submit" class="bg-blue-500 text-white font-bold w-full py-2 rounded" name="tambah_akun">Buat Akses</button>
            </div>
        </form>
      </div>
    </div>

    @endsection
</x-app-layout>
<x-app-layout title="Access List">
  @section('sidebar#3','bg-gray-100')
    @section('container')

    <div class="main ml-60 pt-[56px] px-4 pb-4">
      <div class="bg-white mx-4 rounded-lg shadow-md">      
          <!-- MASSAGE -->
              @if (session('success'))
                <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 transition-opacity duration-500" role="alert">
                  <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                  </svg>
                  <span class="sr-only">Info</span>
                  <div class="ml-3 text-sm font-medium">
                    {{ session('success') }}
                  </div>
                  <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                  </button>
                </div>
              @elseif (session('error'))
                <div id="alert-3" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-red-400 transition-opacity duration-500" role="alert">
                  <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                  </svg>
                  <span class="sr-only">Info</span>
                  <div class="ml-3 text-sm font-medium">
                    {{ session('error') }}
                  </div>
                  <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                  </button>
                </div>
            @endif
          <!-- MASSAGE END -->        
        <!-- Main modal -->
          <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-lg max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center px-4 pt-4 md:px-5 md:pt-5 rounded-t dark:border-gray-600">
                        <div class="flex w-full justify-center pt-1">
                          <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-center">
                              Ganti Password Anda
                          </h3>                          
                        </div>
                        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>                  
                    <!-- Modal body -->
                    <div class="px-4 pb-2 md:px-5 md:pb-4">
                        <form action="{{ route('akun.ubah', ['id' => $akun->id]) }}" class="space-y-4" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="flex w-full justify-center mb-4 ">
                                <label class="text-center">Masukan password lama dan password baru</label>
                            </div>
                            <div>
                                <label for="password_lama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukan Password Lama</label>
                                <input type="password" name="password_lama" id="password_lama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>                              </div>
                            <div>
                                <label for="password_baru" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukan Password Baru</label>
                                <input type="password" name="password_baru" id="password_baru" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <div>
                                <label for="password_konfir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi Password Baru</label>
                                <input type="password" name="password_konfir" id="password_konfir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <div class="flex w-full justify-end">
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
          </div> 
        <!-- Main modal END -->

        <!-- ... judul ... --> 
        <div class="flex m-8 border-b-4 w-48">
          <h3 class="text-3xl pt-4 pb-2 font-bold">Akun Setting</h3>
        </div>

        <form action="{{ route('akun.update', ['id' => $akun->id]) }}" method="POST">
          @csrf
          @method('PUT')
          <!-- ... avatar akun ... -->
          <div class="flex p-4 mx-8 justify-between">
            <div class="flex items-center">
              <img src="\asset\Untitled-1.jpg" alt="" class="w-36 h-36 rounded-md">
              <div class="">
                <h3 class="text-2xl font-semibold mx-4">{{ $akun->nama }}</h3>
                <p class="text-lg font-medium mx-4 ">{{ $akun->nik }}</p>
              </div>
            </div>
          </div>
          <!-- ... data lengkap akun ... -->
          <div class="mx-auto p-4 mb-4">
            <div class="flex flex-col md:flex-row overflow-hidden">
              <div class="md:w-3/5 px-8 flex flex-col border-r-2">
                <div class="mb-4">
                    <label for="username" class="block text-gray-600 text-sm mb-2">Username</label> 
                    <input type="text" name="username" id="username" value="{{ old('username', $akun->username) }}" class="w-full px-4 py-2 border-2 rounded-md ring-black">
                </div>
                
                <div class="mb-4">
                    <label for="hak_akses" class="block text-gray-600 text-sm mb-2">Hak Akses</label>
                    @if (Auth::user()->hak_akses === 'admin')
                        <select id="hak_akses" name="hak_akses" class="px-4 text-gray-600 border-2 rounded-md ring-black focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="user" {{ old('hak_akses', $akun->hak_akses) == 'user' ? 'selected' : '' }}>user</option>
                            <option value="admin" {{ old('hak_akses', $akun->hak_akses) == 'admin' ? 'selected' : '' }}>admin</option>
                        </select>
                    @else
                        <label for="hak_akses" class="w-full px-4 py-2 border-2 rounded-md ring-black">{{ $akun->hak_akses }}</label>
                        <input type="hak_akses" name="hak_akses" value="{{ old('divisi', $akun->hak_akses) }}" hidden>
                    @endif
                </div>
                
                <div class="mb-4">
                    <label for="jabatan" class="block text-gray-600 text-sm mb-2">Jabatan</label>
                    <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $akun->jabatan) }}" class="w-full px-4 py-2 border-2 rounded-md ring-black">
                </div>
                
                <div class="mb-2">
                    <label for="divisi" class="block text-gray-600 text-sm mb-2">Divisi</label>
                    @if (Auth::user()->hak_akses === 'admin')
                        <select id="divisi" name="divisi" class="px-4 text-gray-600 border-2 rounded-md ring-black focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($pilihan as $division)
                                <option value="{{ $division->nama_divisi }}" {{ old('divisi', $akun->divisi) == $division->nama_divisi ? 'selected' : '' }}>{{ $division->nama_divisi }}</option>
                            @endforeach
                        </select>
                    @else
                        <label for="divisi" class="w-full px-4 py-2 border-2 rounded-md ring-black">{{ $akun->divisi }}</label>
                        <input type="hidden" name="divisi" value="{{ old('divisi', $akun->divisi) }}">
                    @endif
                </div>
                <div class="">
                  <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 my-2 rounded">Simpan Perubahan</button>
                </div>
              </div>
              <div class="md:w-2/5 p-8 flex flex-col">
                {{-- info --}}
                <h3 class="text-2xl font-bold">Akun Profil</h3>
                <label class="text-base mt-2 mb-8 text-gray-600">
                  Atur profil nama dan detail, profil data mewakili anda dalam intansi.
                </label>
                {{-- ganti pass --}}
                <h3 class="text-2xl font-bold mb-2">Password dan Autentikasi</h3>
                <label data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="flex justify-start w-[165px] rounded-md px-4 py-2 mt-2 mb-3 text-white font-semibold bg-blue-500 hover:bg-blue-600 hover:cursor-pointer">Ubah Password</label>
                <label class="text-base text-gray-600">
                  Secara berkala mengganti password membantu meningkatkan keamanan akun dengan meminimalkan risiko kebocoran data dan akses yang tidak sah..
                </label>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  
@endsection
</x-app-layout>
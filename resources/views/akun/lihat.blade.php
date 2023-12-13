<x-app-layout title="Access List">
  @section('sidebar#3','bg-gray-100')
    @section('container')

    <div class="main ml-60 pt-[56px] px-4 pb-4">
      <div class="bg-white mx-4 rounded-lg shadow-md">
        <!-- ... judul ... --> 
        <div class="flex m-8 border-b-4 w-32">
          <h3 class="text-3xl pt-4 pb-2 font-bold">Akun#{{ $akun->id }}</h3>
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
            <div>
              <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 m-8 rounded">Simpan Perubahan</button>
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
                  <div class="bg-gray-100 rounded-md border-2 border-gray-600 px-4 p-2.5 dark:bg-gray-700 dark:text-white">
                      {{ $akun->hak_akses }}
                  </div>
                </div>
                <div class="mb-4">
                  <label for="jabatan" class="block text-gray-600 text-sm mb-2">Jabatan</label>
                  <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $akun->jabatan) }}" class="w-full px-4 py-2 border-2 rounded-md ring-black">
                </div>
                <div class="mb-4">
                  <label for="divisi" class="block text-gray-600 text-sm mb-2">Divisi</label>
                  <select id="divisi" name="divisi" class="px-4 text-gray-600 border-2 rounded-md ring-black focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="{{ old('divisi', $akun->divisi) }}">{{ old('divisi', $akun->divisi) }}</option>
                    @php
                        $selectedDivisi = old('divisi', $akun->divisi);
                    @endphp
                    @foreach ($pilihan as $division)
                        <option value="{{ $division->nama_divisi }}" @if ($selectedDivisi === $division) selected @endif>{{ $division->nama_divisi }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="md:w-2/5 p-8 flex flex-col">
                <h3 class="text-3xl font-bold">Akun Profil</h3>
                <label class="text-lg my-4 text-gray-600">
                  Atur profil nama dan detail, profil data mewakili anda dalam intansi.
                </label>
                <label class="text-lg text-gray-600">
                </label>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

@endsection
</x-app-layout>
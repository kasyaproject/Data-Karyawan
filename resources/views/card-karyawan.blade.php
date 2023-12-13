<!-- CARD KARYAWAN-->
  <div class="w-64 mb-4 mx-[-10px]">
    <div id="searchResults" class="transition max-w- mx-auto w-[200px] bg-white justify-start rounded-md shadow-md p-4 hover:-translate-y-1 hover:scale-100">
      <div class="flex justify-end">
        <div x-data="{ open: false }" @click.away="open = false" class="relative inline-block text-left">
          <button @click="open = !open" id="dropdownButton{{ $loop->index }}" data-dropdown-toggle="dropdown" class="inline-block ml- text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-0.5 -m-6" type="button">
              <span class="sr-only">Open dropdown</span>
              <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
          </button>
          <div x-show="open" x-cloak id="dropdown{{ $loop->index }}" class="z-10 -mt-2 -mr-10 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-28 dark:bg-gray-700 absolute right-0">
            <ul class="py-2" aria-labelledby="dropdownButton{{ $loop->index }}">
              <li>
                <a href="{{ route('detail', ['nik' => $data->nik]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                  <i class="bi bi-eye-fill mr-2"></i>Lihat
                </a>
              </li>
              <li>
                <button data-modal-target="popup-modal-{{ $data->id }}" data-modal-toggle="popup-modal-{{ $data->id }}" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                  <i class="bi bi-trash mr-2"></i>Hapus
                </button>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <a href="{{ route('detail', ['nik' => $data->nik]) }}">
        @if($data->image)
          <img src="{{ asset('storage/' . $data->image->path) }}" class="w-44 h-[155px] object-cover rounded-full shadow-md mt-[-12px] mb-4" alt="Foto Karyawan">
        @else
          <p>Foto tidak tersedia</p>
        @endif
        <h3 class="text-lg font-semibold mb-2">{{ $data->nama }}</h3>
        <p class="text-gray-500">{{ $data->nik }}</p>
        <p class="text-gray-500">{{ $data->unit }}</p>
      </a>
    </div>
  </div>                        
<!-- CARD KARYAWAN END-->
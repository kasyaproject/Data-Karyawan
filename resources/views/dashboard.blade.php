<x-app-layout title="Dashboard">
  @section('sidebar#1','bg-gray-100')
    @section('container')
        
      
      <div class="main md:lg:xl:ml-60 pt-[56px]">
        <!-- TOMBOL TAMBAH END-->
          <div class="flex justify-between">
              <div class="relative w-[30%] m-8">
                <!-- Search input
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>                
                  <input type="search" id="search" name="search" class="flex border rounded-lg w-full py-2 px-10" placeholder="Cari data...">
                -->
              </div>
              <a href="/tambah_data">
                  <button class="bg-blue-500 text-white font-bold px-4 py-2 m-8 rounded">Tambah Data</button>
              </a>
          </div>      
        <!-- TOMBOL TAMBAH END-->

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

        <div class="flex flex-wrap ml-8 mx-4 justify-start">
          @foreach ($data as $data)
          <!-- MODAL DELETE -->
            <form action="/data/{{ $data->id }}" method="POST">
              @csrf
              @method('DELETE')
              <div id="popup-modal-{{ $data->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md max-h-full">
                  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-{{ $data->id }}">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                      <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                      </svg>
                      <h3 class="mb-2 text-lg font-normal text-gray-500 dark:text-gray-400">Apa anda yakin ingin menghapus data ini?</h3>
                      <table class="w-64 mb-4 text-left mx-auto text-lg font-semibold text-gray-900 dark:text-gray-400">
                        <tr class="">
                            <td>Nama</td>
                            <td>{{ $data->nama }}</td>
                        </tr>
                        <tr>
                          <td>NIK</td>
                          <td>{{ $data->nik }}</td>
                        </tr>
                        <tr>
                          <td>Unit / Divisi</td>
                          <td>{{ $data->unit }}</td>
                        </tr>
                        <tr>
                          <td>Jabatan</td>
                          <td>{{ $data->jabatan }}</td>
                        </tr>
                      </table>
                      <button data-modal-hide="popup-modal-{{ $data->id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Iya, Hapus data
                      </button>
                      <button data-modal-hide="popup-modal-{{ $data->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tidak</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          <!-- MODAL DELETE END-->
             
          <!-- CARD KARYAWAN ALL-->
            <div id="alldata" class="alldata">
              @include('card-karyawan',['data' => $data])
            </div>
          <!-- CARD KARYAWAN END-->
          <!-- CARD KARYAWAN SEARCH-->
            <div id="searchResults" class="searchResults">
            </div>
          <!-- CARD KARYAWAN END-->
          @endforeach
        </div>
      </div>

      <!-- SCRIPT SEARCH -->
        <script type="text/javascript">
          $('#search').on('keyup',function()
          {
            $value=$(this).val();
            //alert($value);

            if($value){
              $('.alldata').hide();
              $('.searchResults').show();
            } else {
              $('.alldata').hide();
              $('.searchResults').show();
            }

            $.ajax({
              type:'get',
              url:'{{ URL::to('search') }}',
              data:{'search':$value},

              success:function(data){
                console.log(data);
                $('#searchResults').html(data);
              }
            })
          })
        </script>
      <!-- SCRIPT SEARCH END -->

  @endsection
</x-app-layout>
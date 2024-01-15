<x-app-layout title="Notification">
  @section('sidebar#4','bg-gray-100')
    @section('container')

    <div class="main ml-60 pt-[56px] px-4 pb-4">
      @if ($penilaian->count() > 0)
        
          <div class="w-full px-2 py-4">
            <div class="w-full bg-white rounded-lg p-4">
              <h1 class="font-bold text-2xl">Verifikasi Penilaian</h1>
              <p class="text-sm font-semibold text-gray-600">Daftar penilaian yang belum diverifikasi.</p>
              <div class="my-4">
                <div class="w-full flex py-2 px-8 rounded-md border-b">
                  <label for="" class="w-1/5 text-center font-semibold">Nama Lengkap</label>
                  <label for="" class="w-1/5 text-center font-semibold">NIK</label>
                  <label for="" class="w-1/5 text-center font-semibold">Divisi</label>
                  <label for="" class="w-1/5 text-center font-semibold">Jabatan</label>
                  <label for="" class="w-1/5 text-center font-semibold">Status</label>
                </div>      
                @foreach ($penilaian as $index => $penilaian)       
                    <button data-modal-target="staticModal-{{ $data[$index]->nik }}" data-modal-toggle="staticModal-{{ $data[$index]->nik }}" class="w-full flex py-2 px-8 rounded-md border-b hover:outline outline-gray-300 outline-1">
                      <label for="" class="w-1/5 text-center font-semibold cursor-pointer">{{ $data[$index]->nama }}</label>
                      <label for="" class="w-1/5 text-center cursor-pointer">{{ $data[$index]->nik }}</label>
                      <label for="" class="w-1/5 text-center cursor-pointer">{{ $data[$index]->unit }}</label>
                      <label for="" class="w-1/5 text-center cursor-pointer">{{ $data[$index]->jabatan }}</label>
                      <label for="" class="w-1/5 text-center font-semibold text-red-500 cursor-pointer">Belum Diverifikasi</label>
                    </button> 

                    
                    <!-- MODAL DETAIL PENILAIAN -->
                      <div id="staticModal-{{ $data[$index]->nik }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-4xl max-h-full">
                            <!-- Modal content -->
                              <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                  <!-- Modal header -->
                                  <div class="flex items-center justify-between px-4 py-2 border-b rounded-t dark:border-gray-600">
                                      <div class="my-1">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
                                          {{ $data[$index]->nama }}
                                        </h3>
                                        <p class="text-base font-semibold text-gray-500">{{ $data[$index]->nik }} / {{ $penilaian->tgl_penilaian }}</p>
                                      </div>
                                      <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="staticModal-{{ $data[$index]->nik }}">
                                          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                          </svg>
                                          <span class="sr-only">Close modal</span>
                                      </button>
                                  </div>
                                  <!-- Modal body -->
                                  <div class="flex flex-wrap px-4 py-2">
                                    <div class="relative bg-slate-00 w-full md:w-[70%] border-">
                                      <div id="indicators-carousel" class="relative w-full" data-carousel="static">
                                        <!-- Carousel wrapper -->
                                        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                                          <!-- Item 1 -->
                                            <div class="hidden duration-700 ease-in-out p-2 overflow-auto mb-8" data-carousel-item="active">
                                              <!-- Lihat Detail perhitungan FUZZY -->
                                              <div class="flex flex-wrap">                                    
                                                <div class="w-full h-full border-b-2">
                                                  <h1 class="text-xl font-semibold mx-2 mb-4 p-2 border-b-2">Detail Penilaian</h1>
                                                  <table id="tabel-akun" class="w-full border-collapse mb-4">
                                                    <thead class="bg-blue-400 text-white">
                                                      <tr class="text-center text-sm">
                                                        <th class="border p-2 w-20">Jenis</th>
                                                        <th class="border p-2 w-32">Point</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                      <tr class="text-center text-base">
                                                        <th class="border p-2 w-20">Kerajinan</th>
                                                        <th class="border p-2 w-32">{{ $penilaian->kerajinan }}</th>
                                                      </tr>
                                                      <tr class="text-center text-base">
                                                        <th class="border p-2 w-20">Loyalitas</th>
                                                        <th class="border p-2 w-32">{{ $penilaian->loyalitas }}</th>
                                                      </tr>
                                                      <tr class="text-center text-base">
                                                        <th class="border p-2 w-20">Inisiatif</th>
                                                        <th class="border p-2 w-32">{{ $penilaian->inisiatif }}</th>
                                                      </tr>
                                                      <tr class="text-center text-base">
                                                        <th class="border p-2 w-20">Kerja sama</th>
                                                        <th class="border p-2 w-32">{{ $penilaian->kerjasama }}</th>
                                                      </tr>
                                                      <tr class="text-center text-base">
                                                        <th class="border p-2 w-20">Integritas</th>
                                                        <th class="border p-2 w-32">{{ $penilaian->integritas }}</th>
                                                      </tr>
                                                      <tr class="text-center text-base">
                                                        <th class="border p-2 w-20">DQ Method</th>
                                                        <th class="border p-2 w-32">{{ $penilaian->daqumethod }}</th>
                                                      </tr>
                                                      <tr class="text-center text-base">
                                                        <th class="border p-2 w-20">Custemer Relationship</th>
                                                        <th class="border p-2 w-32">{{ $penilaian->custrelation }}</th>
                                                      </tr>
                                                      <tr class="text-center text-base">
                                                        <th class="border p-2 w-20">Kerapihan</th>
                                                        <th class="border p-2 w-32">{{ $penilaian->kerapihan }}</th>
                                                      </tr>
                                                    </tbody>
                                                  </table>                                        
                                                </div>
                                              </div>   
                                              <!-- Lihat Detail perhitungan FUZZY END -->
                                            </div>
                                          <!-- Item 1  END -->
                                          <!-- Item 2 -->
                                            <div class="hidden duration-700 ease-in-out p-2 mb-6 overflow-auto" data-carousel-item>
                                              <h1 class="text-xl font-semibold mx-2 mb-4 p-2 border-b-2">Detail Kerajinan</h1>
                                              <div class="border-b-2">
                                                <table id="tabel-akun" class="w-full border-collapse mb-4">
                                                  <thead class="bg-blue-400 text-white">
                                                    <tr class="text-center text-sm">
                                                      <th class="border p-2 w-44">Jenis</th>
                                                      <th class="border p-2 w-28"><i class="bi bi-pencil-square"></i></th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <tr class="text-center text-base">
                                                      <th class="border p-2">Sakit (dg Surat Keterangan Dokter)</th>
                                                      <th class="border p-2 ">{{ $penilaian->formKerajinan->sakit }} hari</th>
                                                    </tr>
                                                    <tr class="text-center text-base">
                                                      <th class="border p-2">Izin / Sakit (Tanpa SKD)</th>
                                                      <th class="border p-2">{{ $penilaian->formKerajinan->izin }} hari</th>
                                                    </tr>
                                                    <tr class="text-center text-base">
                                                      <th class="border p-2">Tanpa Izin</th>
                                                      <th class="border p-2">{{ $penilaian->formKerajinan->tanpaizin }} hari</th>
                                                    </tr>
                                                    <tr class="text-center text-base">
                                                      <th class="border p-2">Datang Terlambat</th>
                                                      <th class="border p-2">{{ $penilaian->formKerajinan->terlambat }} jam</th>
                                                    </tr>
                                                    <tr class="text-center text-base">
                                                      <th class="border p-2">Pulang Cepat</th>
                                                      <th class="border p-2">{{ $penilaian->formKerajinan->pulangcepat }} jam</th>
                                                    </tr>                                          
                                                  </tbody>
                                                </table>  
                                              </div>
                                            </div>
                                          <!-- Item 2  END -->
                                          <!-- Item 3  END -->
                                            <div class="hidden duration-700 ease-in-out p-2 mb-6 overflow-auto" data-carousel-item>
                                              <h1 class="text-xl font-semibold mx-2 mb-4 p-2 border-b-2">Detail Analisis</h1>
                                              <div class="border-b-2 pb-4">
                                                <div class="w-full px-">
                                                  <div class="w-full mb-4 group">
                                                    <label for="rangkuman" class="block text-gray-600 text-sm mb-2">Rangkuman diskusi penilaian dengan SDI</label>  
                                                    <textarea for="rangkuman" 
                                                    type="text" name="rangkuman"
                                                    class="w-full h-32 max-h-max px-4 py-2 rounded-md resize-none" required>{{ $penilaian->formAnalisis->rangkuman }}</textarea>
                                                  </div>
                                                </div>
                                                <div class="grid md:grid-cols-2 md:gap-6 px-">
                                                  <div class="w-full mb-4 group">
                                                    <label for="kebutuhan" class="block text-gray-600 text-sm mb-2">Kebutuhan Training dan Development</label>  
                                                    <textarea for="kebutuhan" 
                                                    type="text" name="kebutuhan"
                                                    class="w-full h-32 max-h-max px-4 py-2 rounded-md resize-none" required>{{ $penilaian->formAnalisis->kebutuhan }}</textarea>
                                                  </div>
                                                  <div class="w-full mb-4 group">
                                                    <label for="rekomendasi" class="block text-gray-600 text-sm mb-2">Rekomendasi Terhadap SDI</label>  
                                                    <textarea for="rekomendasi" 
                                                    type="text" name="rekomendasi"
                                                    class="w-full h-32 max-h-max px-4 py-2 rounded-md resize-none" required>{{ $penilaian->formAnalisis->rekomendasi }}</textarea>
                                                  </div>
                                                </div>
                                                <div class="flex items-center">
                                                  <i class="bi bi-info-circle px-2 "></i>
                                                  <p class="font-bold text-lg">{{ $penilaian->formAnalisis->catatan }}</p>
                                                </div>
                                              </div>
                                            </div>
                                          <!-- Item 3  END -->
                                        </div>
                                        <!-- Slider indicators -->
                                          <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-2 left-1/2">
                                              <button type="button" class="w-3 h-3 rounded-full bg-blue-200 border-1 border-blue-200" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                                              <button type="button" class="w-3 h-3 rounded-full bg-blue-200 border-1 border-blue-200" aria-current="true" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                                              <button type="button" class="w-3 h-3 rounded-full bg-blue-200 border-1 border-blue-200" aria-current="true" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                                          </div>
                                        <!-- Slider indicators END-->
                                      </div>
                                    </div>
                                    <!-- POINT / NILAI -->
                                      <div class="flex flex-col items-center w-full md:w-[30%]">
                                        <h1 class="text-2xl border-b-2 font-semibold mb-4 text-gray-600">Point Total</h1>
                                        <div class="flex flex-col h-44 w-44 rounded-full items-center border-8 border-blue-400">
                                          <p class="text-7xl font-semibold ml-6 mt-10 text-gray-600">{{ $penilaian->formFuzzy->point }}<label class="text-3xl">/{{ $penilaian->formFuzzy->nilai }}</label></p>
                                            <p class="text-xl font-semibold pt-2 text-gray-600">Point</p>
                                        </div>
                                      </div>                    
                                    <!-- POINT / NILAI END -->                
                                  </div>
                                  <!-- Modal footer -->
                                    <div class="flex justify-between px-6 py-2 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                      <p>Status : <label class="font-bold text-red-500">Belum Diverifikasi</label>
                                        <form action="{{ route('verifikasi.update', ['nik' => $data[$index]->nik]) }}" method="post">
                                          @csrf
                                          @method('PUT')
                                          <button class="bg-green-500 mx-2 px-2 py-0.5 text-white rounded-md">Verifikasi</button>
                                        </form>
                                        </p>                        
                                      <p>Nama Penilai : <label class="font-bold ">{{ $penilaian->nama_penilai }}</label></p>
                                    </div>
                            </div>
                        </div>
                      </div>
                    <!-- MODAL DETAIL PENILAIAN END -->
                @endforeach                                 
              </div>
            </div>        
          </div>
      @else
        <div class="w-full px-2 py-4">
            <div class="w-full bg-white rounded-lg p-4">
              <h1 class="font-bold text-2xl">Verifikasi Penilaian</h1>
              <p class="text-sm font-semibold text-gray-600">Daftar penilaian yang belum diverifikasi.</p>
              <div class="my-4">
                <div class="w-full flex py-2 px-8 rounded-md border-b">
                  <label for="" class="w-1/5 text-center font-semibold">Nama Lengkap</label>
                  <label for="" class="w-1/5 text-center font-semibold">NIK</label>
                  <label for="" class="w-1/5 text-center font-semibold">Divisi</label>
                  <label for="" class="w-1/5 text-center font-semibold">Jabatan</label>
                  <label for="" class="w-1/5 text-center font-semibold">Status</label>
                </div>             
                <div class="flex w-full h-52 justify-center items-center mt-4 bg-gray-200 rounded-lg">
                  <p class="text-xl font-semibold">Tidak ada data penilaian yang belum diverifikasi.</p>
                </div>                               
              </div>
            </div>        
          </div>
      @endif 
    </div>      
  @endsection
</x-app-layout>
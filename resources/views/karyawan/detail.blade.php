<x-app-layout title="Data Karyawan">
  @section('sidebar#1','bg-gray-100')
  
    @section('container')         
    <div class="main md:lg:xl:ml-64 pt-[56px]">
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
      <!-- Detail Profil -->
        <div class="flex flex-wrap m-4 bg-white rounded-md shadow-md">
            <!-- Bagian Poto -->
          <div class="w-full md:w-[20%]">
            <div class="p-4">
              <div class="flex justify-center">
                <img src="{{ asset('storage/' . $data->image->path) }}" 
                alt="Foto Profil" class="w-48 h-48 object-cover shadow-xl border-2 rounded-full mb-4">
              </div>
              <div class="flex justify-center">
                <a href="{{ route('karyawan.lihat', ['nik' => $data->nik]) }}" class="w-full">
                  <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                    Ubah Data
                  </button>
                </a>
              </div>
            </div>
          </div>
        
          <!-- Bagian Biodata -->
          <div class="w-full md:w-[30%]">
            <div class="p-4">
              <h3 class="text-2xl font-semibold mb-2">{{ $data->nama }}</h3>
              <table class="text-gray-500">
                <tr>
                  <td class="w-[8vw] py-2">NIK</td>
                  <td>: {{ $data->nik }}</td>
                </tr>
                <tr>
                  <td class="w-[8vw] py-2">Mulai Bekerja</td>
                  <td>: {{ $data->mulaikerja_formatted }}</td>
                </tr>
                <tr>
                  <td class="w-[8vw] py-2">Lama Bekerja</td>
                  <td>: {{ $data->lama_kerja }}</td>
                </tr>
                <tr>
                  <td class="w-[8vw] py-2">Jabatan</td>
                  <td>: {{ $data->jabatan }}</td>
                </tr>
                <tr>
                  <td class="w-[8vw] py-2">Unit / Divisi</td>
                  <td>: {{ $data->unit }}</td>
                </tr>
                <tr>
                  <td class="w-[8vw] py-2">Posisi Terakhir</td>
                  <td>: {{ $data->posisi }}</td>
                </tr>
              </table>
            </div>
          </div>
        
          <!-- Bagian Grafik -->
          <div class="w-full md:w-[50%]">
            <div class="bg-blue- rounded-r-md h-full p-4">
              <!-- Tempatkan grafik di sini -->
              <div id="grafik" class="h-full bg-gray- rounded-md">
                <p class="text-xl bg-blue- px-4 font-extrabold text-center">Grafik Kinerja SDI</p>
                <canvas id="lineChart"></canvas>
              </div>
            </div>
          </div>
        </div>
      <!-- Detail Profil END -->
    </div>

    <div class="md:lg:xl:ml-64 px-4 pb-4">
      <div class="bg-white rounded-lg shadow-md p-4">
        <div class="bg-white rounded-lg mb-2 flex justify-between items-center">
          <h3 class="text-2xl font-semibold mx-4">Table Penilaian</h3>
          <a href="{{ route('penilaian.form', ['nik' => $data->nik]) }}">
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
              Buat Penilaian
            </button>
          </a>
        </div class="overflow-x-auto">
          <table id="tabel-akun" class="w-full border-collapse mb-4">
            <thead class="bg-blue-400 text-white">
              <tr class="text-center text-sm">
                <th class="border p-2 w-28">Tanggal Penilaian</th>
                <th class="border p-2 w-32">Nama Penilaian</th>
                <th class="border p-2 w-20">Point Penilaian</th>
                <th class="border p-2 w-20">point Kerajinan</th>
                <th class="border p-2 w-56">Kelebihan</th>
                <th class="border p-2 w-56">Kekurangan</th>
                <th class="border p-2 w-28">Point Total</th>
                <th class="border p-2 w-32 text-center"><i class="bi bi-pencil-square"></i></th>
              </tr>
            </thead>
            <tbody class="text-center text-gray-500">
              @foreach ($dataPenilaian as $penilaian)
                  <tr class="text-sm">
                      <td class="border p-2">{{ $penilaian->tgl_penilaian }}</td>
                      <td class="border p-2">{{ $penilaian->nama_penilai }}</td>
                      <td class="border p-2">{{ $penilaian->hasil }}</td>
                      <td class="border p-2">{{ $penilaian->formKerajinan->hasil }}</td>
                      <td class="border p-2 align-text-top text-left">
                        @foreach(json_decode($penilaian->formAnalisis->kelebihan) ?? [] as $kelebihan)
                          <label class="text-xs bg-blue-200 text-blue-600 border-blue-600 border-1 rounded-full p-0.5 px-2 m-0.5"> {{ $kelebihan }}</label>
                        @endforeach
                      </td>
                      <td class="border p-2 align-text-top text-left">
                        @foreach(json_decode($penilaian->formAnalisis->kekurangan) ?? [] as $kekurangan)
                          <label class="text-xs bg-blue-200 text-blue-600 border-blue-600 border-1 rounded-full p-0.5 px-2 m-0.5"> {{ $kekurangan }}</label>
                        @endforeach
                      </td>
                      <td class="border p-2"> {{ $penilaian->formFuzzy->point }} / {{ $penilaian->formFuzzy->nilai }} 
                          @if ($penilaian->verifikasi === 'yes')
                            <i class="bi bi-patch-check-fill text-green-500 ml-2" title="Penilaian sudah di Verifikasi"></i>
                          @elseif ($penilaian->verifikasi === 'no') 
                            <i class="bi bi-x-octagon-fill text-red-500 ml-2" title="Penilaian belum di Verifikasi"></i>
                          @endif
                      </td>
                      <td class="border p-2 text-center">
                        <button data-modal-target="staticModal-{{ $penilaian->id }}" data-modal-toggle="staticModal-{{ $penilaian->id }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded">
                          <i class="bi bi-eye"></i>
                        </button>
                        <button data-modal-target="popup-modal-{{ $penilaian->id }}" data-modal-toggle="popup-modal-{{ $penilaian->id }}" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 rounded" 
                        type="button">
                          <i class="bi bi-trash"></i>
                        </button>
                      </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>

    <!-- MODAL -->
      <!-- MODAL DETAIL -->
        @foreach ($dataPenilaian as $penilaian)
          <div id="staticModal-{{ $penilaian->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-4xl max-h-full">
                <!-- Modal content -->
                  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                      <!-- Modal header -->
                      <div class="flex items-center justify-between px-4 py-2 border-b rounded-t dark:border-gray-600">
                          <div class="my-1">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                              Detail Penilaian
                            </h3>
                            <p class="text-base font-semibold text-gray-500">{{ $penilaian->tgl_penilaian }}</p>
                          </div>
                          <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="staticModal-{{ $penilaian->id }}">
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
                                      <h1 class="text-xl font-semibold mx-2 mb-4 p-2 border-b-2">Fuzzy Tsukamoto</h1>
                                      <table class="w-full border-collapse mb-4">
                                        <thead class="bg-blue-400 text-white">
                                          <tr class="text-center text-sm">
                                            <th class="border py-1">Variable</th>
                                            <th class="border py-1">Point</th>
                                            <th class="border py-1">Drajar Keanggotaan</th>                                          
                                          </tr>
                                        </thead>
                                        <tbody class="text-center text-gray-500">
                                          <tr>
                                            <td class="w-36">Penilaian</td>
                                            <td class="w-20">{{ $penilaian->hasil }}</td>
                                            <td class="w-full flex justify-center items-center flex-wrap">
                                              @foreach (json_decode($penilaian->formFuzzy->penilaian_him) ?? [] as $index => $penilaian_him)
                                                  @php
                                                      $penilaian_a = json_decode($penilaian->formFuzzy->penilaian_a)[$index] ?? null;                                             
                                                  @endphp
                                              
                                                  @if ($penilaian_him === 'buruk')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-red-400">
                                                          Buruk ({{ $penilaian_a ?? 0 }})
                                                      </p>
                                                  @endif
                                                  @if ($penilaian_him === 'cukup_baik')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-yellow-400">
                                                          Cukup Baik ({{ $penilaian_a ?? 0 }})
                                                      </p>
                                                  @endif
                                                  @if ($penilaian_him === 'baik')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-green-400">
                                                          Baik ({{ $penilaian_a ?? 0 }})
                                                      </p>
                                                  @endif
                                                  @if ($penilaian_him === 'sangat_baik')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-blue-400">
                                                          Sangat Baik ({{ $penilaian_a ?? 0 }})
                                                      </p>
                                                  @endif
                                              @endforeach                                            
                                            </td>
                                          </tr>
                                          <tr>
                                            <td class="w-24">Kerjaninan</td>
                                            <td class="w-12">{{ $penilaian->formKerajinan->hasil }}</td>
                                            <td class="w-full flex justify-center items-center flex-wrap">
                                              @foreach (json_decode($penilaian->formFuzzy->kerajinan_him) ?? [] as $index => $kerajinan_him)
                                                  @php
                                                      $kerajinan_a = json_decode($penilaian->formFuzzy->kerajinan_a)[$index] ?? null;                                             
                                                  @endphp
                                              
                                                  @if ($kerajinan_him === 'buruk')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-red-400">
                                                          Buruk ({{ $kerajinan_a ?? 0 }})
                                                      </p>
                                                  @endif
                                                  @if ($kerajinan_him === 'cukup_baik')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-yellow-400">
                                                          Cukup Baik ({{ $kerajinan_a ?? 0 }})
                                                      </p>
                                                  @endif
                                                  @if ($kerajinan_him === 'baik')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-green-400">
                                                          Baik ({{ $kerajinan_a ?? 0 }})
                                                      </p>
                                                  @endif
                                                  @if ($kerajinan_him === 'sangat_baik')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-blue-400">
                                                          Sangat Baik ({{ $kerajinan_a ?? 0 }})
                                                      </p>
                                                  @endif
                                              @endforeach                                                                                   
                                            </td>
                                          </tr>
                                          <tr>
                                            <td class="w-24">Kelebihan</td>
                                            <td class="w-12">{{ $penilaian->formAnalisis->hasil_kelebihan }}</td>
                                            <td class="w-full flex justify-center items-center flex-wrap">
                                              @foreach (json_decode($penilaian->formFuzzy->kelebihan_him) ?? [] as $index => $kelebihan_him)
                                                  @php
                                                      $kelebihan_a = json_decode($penilaian->formFuzzy->kelebihan_a)[$index] ?? null;                                             
                                                  @endphp
                                              
                                                  @if ($kelebihan_him === 'buruk')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-red-400">
                                                          Buruk ({{ $kelebihan_a ?? 0 }})
                                                      </p>
                                                  @endif
                                                  @if ($kelebihan_him === 'cukup_baik')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-yellow-400">
                                                          Cukup Baik ({{ $kelebihan_a ?? 0 }})
                                                      </p>
                                                  @endif
                                                  @if ($kelebihan_him === 'baik')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-green-400">
                                                          Baik ({{ $kelebihan_a ?? 0 }})
                                                      </p>
                                                  @endif
                                                  @if ($kelebihan_him === 'sangat_baik')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-blue-400">
                                                          Sangat Baik ({{ $kelebihan_a ?? 0 }})
                                                      </p>
                                                  @endif
                                              @endforeach
                                            </td>
                                          </tr>
                                          <tr>
                                            <td class="w-24">Kekurangan</td>
                                            <td class="w-12">{{ $penilaian->formAnalisis->hasil_kekurangan }}</td>
                                            <td class="w-full flex justify-center items-center flex-wrap">
                                              @foreach (json_decode($penilaian->formFuzzy->kekurangan_him) ?? [] as $index => $kekurangan_him)
                                                  @php
                                                      $kekurangan_a = json_decode($penilaian->formFuzzy->kekurangan_a)[$index] ?? null;                                             
                                                  @endphp
                                              
                                                  @if ($kekurangan_him === 'rendah')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-red-400">
                                                          Buruk ({{ $kekurangan_a ?? 0 }})
                                                      </p>
                                                  @endif
                                                  @if ($kekurangan_him === 'cukup_baik')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-yellow-400">
                                                          Cukup Baik ({{ $kekurangan_a ?? 0 }})
                                                      </p>
                                                  @endif
                                                  @if ($kekurangan_him === 'baik')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-green-400">
                                                          Baik ({{ $kekurangan_a ?? 0 }})
                                                      </p>
                                                  @endif
                                                  @if ($kekurangan_him === 'sangat_baik')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-blue-400">
                                                          Sangat Baik ({{ $kekurangan_a ?? 0 }})
                                                      </p>
                                                  @endif
                                              @endforeach
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>   
                                  <!-- Lihat Detail perhitungan FUZZY END -->
                                  <!-- Lihat Aturan -->
                                    <div class="w-full my-2 pb-2 border-b-2">
                                      <p>Probibilitas aturan yang tercipta : </p>
                                      @php
                                          $penilaian_him = json_decode($penilaian->formFuzzy->penilaian_him) ?? [];
                                          $kerajinan_him = json_decode($penilaian->formFuzzy->kerajinan_him) ?? [];
                                          $kelebihan_him = json_decode($penilaian->formFuzzy->kelebihan_him) ?? [];
                                          $kekurangan_him = json_decode($penilaian->formFuzzy->kekurangan_him) ?? [];
                                          $output = json_decode($penilaian->formFuzzy->output) ?? [];
                                          $n = 0;
                                      @endphp

                                      @foreach ($penilaian_him as $pen)
                                          @foreach ($kerajinan_him as $ker)
                                              @foreach ($kelebihan_him as $kele)
                                                  @foreach ($kekurangan_him as $kek)
                                                      <!-- Tampilkan probabilitas aturan yang tercipta -->
                                                      <div class="w-full py-1">
                                                        <p>R{{ $n + 1; }}: jika Penilaian <label class="font-semibold uppercase">{{ $pen }}</label> dan Kinerja <label class="font-semibold uppercase">{{ $ker }}</label> dan Kelebihan <label class="font-semibold uppercase">{{ $kele }}</label> dan Kekurangan <label class="font-semibold uppercase">{{ $kek }}</label> maka Output <label class="font-semibold uppercase">{{ $output[$n] }}</label></p>
                                                      </div>
                                                      @php
                                                          $n++;
                                                      @endphp
                                                  @endforeach
                                              @endforeach
                                          @endforeach
                                      @endforeach   
                                    </div>
                                  <!-- Lihat Aturan END -->
                                  <!-- Lihat Deffuzyfikasi -->
                                  <div class="w-full my-2 pb-6 border-b-2">
                                    <p class="text-lg">Output = ∑(ai x z) / ∑(ai) = <label class="font-bold text-xl">{{ $penilaian->formFuzzy->point }} / {{ $penilaian->formFuzzy->nilai }}</label></p>
                                  </div>
                                  <!-- Lihat Deffuzyfikasi END -->
                                </div>
                              <!-- Item 1  END -->
                              <!-- Item 2 -->
                                <div class="hidden duration-700 ease-in-out p-2 overflow-auto mb-8" data-carousel-item="active">
                                  <!-- Lihat Detail perhitungan FUZZY -->
                                  <div class="flex flex-wrap">                                    
                                    <div class="w-full h-full border-b-2">
                                      <h1 class="text-xl font-semibold mx-2 mb-4 p-2 border-b-2">Detail Penilaian</h1>
                                      <table id="tabel-akun" class="w-full border-collapse mb-4">
                                        <thead class="bg-blue-400 text-white">
                                          <tr class="text-center text-sm">
                                            <th class="border p-2 w-20">Keterangan</th>
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
                              <!-- Item 2  END -->
                              <!-- Item 3 -->
                                <div class="hidden duration-700 ease-in-out p-2 mb-6 overflow-auto" data-carousel-item>
                                  <h1 class="text-xl font-semibold mx-2 mb-4 p-2 border-b-2">Detail Kerajinan</h1>
                                  <div class="border-b-2">
                                    <table id="tabel-akun" class="w-full border-collapse mb-4">
                                      <thead class="bg-blue-400 text-white">
                                        <tr class="text-center text-sm">
                                          <th class="border p-2 w-44">Keterangan</th>
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
                              <!-- Item 3  END -->
                              <!-- Item 4 -->
                                <div class="hidden duration-700 ease-in-out p-2 mb-6 overflow-auto" data-carousel-item>
                                  <h1 class="text-xl font-semibold mx-2 mb-4 p-2 border-b-2">Detail Analisis</h1>
                                  <div class="border-b-2 pb-4">
                                    <div class="w-full">
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
                              <!-- Item 4  END -->                              
                            </div>
                            <!-- Slider indicators -->
                              <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-2 left-1/2">
                                  <button type="button" class="w-3 h-3 rounded-full bg-blue-200 border-1 border-blue-200" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                                  <button type="button" class="w-3 h-3 rounded-full bg-blue-200 border-1 border-blue-200" aria-current="true" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                                  <button type="button" class="w-3 h-3 rounded-full bg-blue-200 border-1 border-blue-200" aria-current="true" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                                  <button type="button" class="w-3 h-3 rounded-full bg-blue-200 border-1 border-blue-200" aria-current="true" aria-label="Slide 4" data-carousel-slide-to="3"></button>
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
                      <div class="flex items-center justify-between px-6 py-2 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <label>Status : <label>
                            @if ($penilaian->verifikasi === 'yes')
                              <label class="font-semibold text-green-700">Sudah di Verifikasi</label>
                            @elseif ($penilaian->verifikasi === 'no') 
                              <label class="font-semibold text-red-500">Belum di Verifikasi</label>
                            @endif
                          </label>
                        </label>
                        <label>Nama Penilai : {{ $penilaian->nama_penilai }}</label>
                      </div>
                  </div>
            </div>
          </div>
        @endforeach
      <!-- MODAL DETAIL END -->
      <!-- Modal HAPUS  -->
        @foreach ($dataPenilaian as $penilaian)
          <form action="{{ route('penilaian.hapus', $penilaian->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div id="popup-modal-{{ $penilaian->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
              <div class="relative w-full max-w-md max-h-full">
                  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                      <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-{{ $penilaian->id }}">
                          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                          </svg>
                          <span class="sr-only">Close modal</span>
                      </button>
                      <div class="py-6 text-center">
                          <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                          </svg>
                          <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apa anda yakin ingin menghapus data penilaian pada tanggal <label class="font-bold text-red-600 underline">{{ $penilaian->tgl_penilaian }}</label> ?</h3>
                          <button data-modal-hide="popup-modal-{{ $penilaian->id }}" type="Submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                              Iya, Hapus data!
                          </button>
                          <button data-modal-hide="popup-modal-{{ $penilaian->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                              Tidak, Batalkan!</button>
                      </div>
                  </div>
              </div>
            </div>
          </form>
        @endforeach
      <!-- Modal HAPUS END -->
    <!-- MODAL END-->

    <!-- SCRIPT DATATABLE -->
      <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
      <script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
      <script>
        $(document).ready(function(){
          $('#tabel-akun').DataTable({
            lengthChange: false,
            searching: false,
            columnDefs: [
                { targets: [7], orderable: false },
            ]
          });
        });
      </script>
    <!-- SCRIPT DATATABLE END-->

    <!-- SCRIPT DIAGRAM -->
      <script>
        // Ambil data dari dataPenilaianForChart
        const dataPenilaianForChart = @json($dataPenilaianForChart);

        // Konversi data menjadi format yang sesuai untuk Chart.js
        const chartLabels = [];
        const chartDataPoint = [];

        dataPenilaianForChart.forEach(item => {
            chartLabels.push(item.tgl_penilaian);
            chartDataPoint.push(item.point);
        });

        const ctx = document.getElementById('lineChart').getContext('2d');

        const lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Point Penilaian',
                    data: chartDataPoint,
                    borderColor: 'blue',
                    borderWidth: 2,
                    radius: 6,
                    tension: 0.4,
                    backgroundColor: 'rgba(0, 255, 0, 0.1)',
                    fill: 'start', // Memulai garis dari nilai 0
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                    },
                },
            },
        });
      </script>
    <!-- SCRIPT DIAGRAM END -->

    @endsection
</x-app-layout>
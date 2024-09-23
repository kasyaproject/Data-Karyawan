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
                <p class="text-xl bg-blue- px-4 font-extrabold text-center">Grafik Kinerja SDM</p>
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
                <th class="border p-2 w-32">Tanggal Penilaian</th>
                <th class="border p-2 w-32">Nama Penilaian</th>
                <th class="border p-2 w-28">Point Absensi</th>
                <th class="border p-2 w-52">Jumlah Produktifitas</th>
                <th class="border p-2 w-52">Kepuasan Customer</th>
                <th class="border p-2 w-28">Hasil Nilai</th>
                <th class="border p-2 w-32 text-center"><i class="bi bi-pencil-square"></i></th>
              </tr>
            </thead>
            <tbody class="text-center text-gray-500">
              @foreach ($dataPenilaian as $penilaian)
                  <tr class="text-sm">
                      <td class="border p-2">{{ $penilaian->tgl_penilaian }}</td>
                      <td class="border p-2">{{ $penilaian->nama_penilai }}</td>
                      <td class="border p-2">{{ $penilaian->detail->hasil_absensi }}</td>
                      <td class="border p-2">{{ $penilaian->detail->produktifitas }}</td>                      
                      <td class="border p-2">{{ $penilaian->detail->cust_relation }}</td>                      
                      <td class="border p-2"><p>{{ $penilaian->fuzzy->probabilitas }}</p><label>{{ $penilaian->fuzzy->probabilitas_him }}</label>
                          @if ($penilaian->verifikasi === 'yes')
                            <i class="bi bi-patch-check-fill text-green-500 ml-2" title="Penilaian sudah di Verifikasi"></i>
                          @elseif ($penilaian->verifikasi === 'no') 
                            <i class="bi bi-x-octagon-fill text-red-500 ml-2" title="Penilaian belum di Verifikasi"></i>
                          @endif
                      </td>
                      <td class="border p-2 text-center">
                        <button data-modal-target="staticModal-{{ $penilaian->id_penilaian }}" data-modal-toggle="staticModal-{{ $penilaian->id_penilaian }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded">
                          <i class="bi bi-eye"></i>
                        </button>
                        <button data-modal-target="popup-modal-{{ $penilaian->id_penilaian }}" data-modal-toggle="popup-modal-{{ $penilaian->id_penilaian }}" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 rounded" 
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
          <div id="staticModal-{{ $penilaian->id_penilaian }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
                          <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="staticModal-{{ $penilaian->id_penilaian }}">
                              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                              </svg>
                              <span class="sr-only">Close modal</span>
                          </button>
                      </div>
                      <!-- Modal body -->
                      <div class="flex flex-wrap px-4 py-2">
                        <div class="relative bg-slate-00 w-full md:w-[70%]">
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
                                            <td class="w-36">Absensi</td>
                                            <td class="w-20">{{ $penilaian->detail->hasil_absensi }}</td>
                                            <td class="w-full flex justify-center items-center flex-wrap">
                                              @foreach (json_decode($penilaian->fuzzy->absensi_him) ?? [] as $index => $absensi_him)
                                                  @php
                                                      $absensi_a = json_decode($penilaian->fuzzy->absensi_a)[$index] ?? null;                                             
                                                  @endphp
                                              
                                                  @if ($absensi_him === 'Kurang')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-red-400">
                                                          Kurang ({{ $absensi_a ?? 0 }})
                                                      </p>
                                                  @endif
                                                  @if ($absensi_him === 'Cukup')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-yellow-400">
                                                          Cukup ({{ $absensi_a ?? 0 }})
                                                      </p>
                                                  @endif
                                                  @if ($absensi_him === 'Bagus')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-green-400">
                                                          Bagus ({{ $absensi_a ?? 0 }})
                                                      </p>
                                                  @endif
                                              @endforeach                                            
                                            </td>
                                          </tr>
                                          <tr>
                                            <td class="w-24">Produktifitas</td>
                                            <td class="w-12">{{ $penilaian->detail->produktifitas }}</td>
                                            <td class="w-full flex justify-center items-center flex-wrap">
                                              @foreach (json_decode($penilaian->fuzzy->produktifitas_him	) ?? [] as $index => $produktifitas_him	)
                                                  @php
                                                      $produktif_a = json_decode($penilaian->fuzzy->produktifitas_a)[$index] ?? null;                                             
                                                  @endphp
                                              
                                                  @if ($produktifitas_him === 'Kurang')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-red-400">
                                                          Buruk ({{ $produktif_a ?? 0 }})
                                                      </p>
                                                  @endif
                                                  @if ($produktifitas_him === 'Cukup')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-yellow-400">
                                                          Cukup Baik ({{ $produktif_a ?? 0 }})
                                                      </p>
                                                  @endif
                                                  @if ($produktifitas_him === 'Bagus')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-green-400">
                                                          Baik ({{ $produktif_a ?? 0 }})
                                                      </p>
                                                  @endif
                                              @endforeach                                                                                   
                                            </td>
                                          </tr>
                                          <tr>
                                            <td class="w-24">Customer Relationship</td>
                                            <td class="w-12">{{ $penilaian->detail->cust_relation }}</td>
                                            <td class="w-full flex justify-center items-center flex-wrap">
                                              @foreach (json_decode($penilaian->fuzzy->custrelation_him) ?? [] as $index => $custrelation_him)
                                                  @php
                                                      $kelebihan_a = json_decode($penilaian->fuzzy->custrelation_a)[$index] ?? null;                                             
                                                  @endphp
                                              
                                                  @if ($custrelation_him === 'Kurang')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-red-400">
                                                          Buruk ({{ $kelebihan_a ?? 0 }})
                                                      </p>
                                                  @endif
                                                  @if ($custrelation_him === 'Cukup')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-yellow-400">
                                                          Cukup Baik ({{ $kelebihan_a ?? 0 }})
                                                      </p>
                                                  @endif
                                                  @if ($custrelation_him === 'Bagus')
                                                      <p class="ml-2 mt-2 px-2 py-0.5 text-sm text-white rounded-full bg-green-400">
                                                          Baik ({{ $kelebihan_a ?? 0 }})
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
                                          $absensi_him = json_decode($penilaian->fuzzy->absensi_him) ?? [];
                                          $produktifitas_him = json_decode($penilaian->fuzzy->produktifitas_him) ?? [];
                                          $custrelation_him = json_decode($penilaian->fuzzy->custrelation_him) ?? [];
                                          $output = json_decode($penilaian->fuzzy->keputusan) ?? [];
                                          $n = 0;
                                      @endphp

                                      @foreach ($absensi_him as $abs)
                                          @foreach ($produktifitas_him as $pro)
                                              @foreach ($custrelation_him as $cust)
                                                  @foreach ($output as $out)
                                                    <!-- Tampilkan probabilitas aturan yang tercipta -->
                                                    <div class="w-full py-1">
                                                      <p>R{{ $n + 1; }}: 
                                                        jika Absensi <label class="font-semibold uppercase">{{ $abs }}</label> 
                                                        dan Produktifitas <label class="font-semibold uppercase">{{ $pro }}</label> 
                                                        dan Customer Relationship <label class="font-semibold uppercase">{{ $cust }}</label> 
                                                        maka Keputusan <label class="font-semibold uppercase">{{ $out }}</label></p>
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
                                    <p class="text-lg">Output = ∑(ai x z) / ∑(ai) = <label class="font-bold text-xl">{{ $penilaian->fuzzy->probabilitas }} / {{ $penilaian->fuzzy->probabilitas_him }}</label></p>
                                  </div>
                                  <!-- Lihat Deffuzyfikasi END -->
                                </div>
                              <!-- Item 1  END -->
                              <!-- Item 2 -->
                                <div class="hidden duration-700 ease-in-out p-2 overflow-auto mb-8" data-carousel-item="">
                                  <!-- Lihat Detail perhitungan FUZZY -->
                                  <div class="flex flex-wrap">                                    
                                    <div class="w-full h-full border-b-2">
                                      <h1 class="text-xl font-semibold mx-2 mb-4 p-2 border-b-2">Detail Penilaian</h1>
                                      {{-- Tabel Absensi --}}
                                      <table id="tabel-akun" class="w-full border-collapse mb-4">
                                        <thead class="bg-blue-400 text-white">
                                          <tr class="text-center text-sm">
                                            <th class="border p-2 w-20">Keterangan</th>
                                            <th class="border p-2 w-32">Jumlah</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr class="text-center text-base">
                                            <th class="border p-2">Sakit (dg Surat Keterangan Dokter)</th>
                                            <th class="border p-2 ">{{ $penilaian->detail->sakit }} hari</th>
                                          </tr>
                                          <tr class="text-center text-base">
                                            <th class="border p-2">Izin / Sakit (Tanpa SKD)</th>
                                            <th class="border p-2">{{ $penilaian->detail->izin }} hari</th>
                                          </tr>
                                          <tr class="text-center text-base">
                                            <th class="border p-2">Tanpa Izin</th>
                                            <th class="border p-2">{{ $penilaian->detail->tanpa_izin }} hari</th>
                                          </tr>
                                          <tr class="text-center text-base">
                                            <th class="border p-2">Datang Terlambat</th>
                                            <th class="border p-2">{{ $penilaian->detail->terlambat }} jam</th>
                                          </tr>
                                          <tr class="text-center text-base">
                                            <th class="border p-2">Pulang Cepat</th>
                                            <th class="border p-2">{{ $penilaian->detail->pulang_cepat }} jam</th>
                                          </tr>  
                                        </tbody>
                                      </table> 

                                      {{-- Tabel Produktifitas --}}
                                      <table id="tabel-akun" class="w-full border-collapse mb-4">
                                        <thead class="bg-blue-400 text-white">
                                          <tr class="text-center text-sm">
                                            <th class="border p-2 w-20">Keterangan</th>
                                            <th class="border p-2 w-32">Jumlah</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr class="text-center text-base">
                                            <th class="border p-2">Produktifitas</th>
                                            <th class="border p-2 ">{{ $penilaian->detail->produktifitas }} jumlah</th>
                                          </tr>
                                        </tbody>
                                      </table>  

                                      {{-- Tabel Custrelation --}}
                                      <table id="tabel-akun" class="w-full border-collapse mb-4">
                                        <thead class="bg-blue-400 text-white">
                                          <tr class="text-center text-sm">
                                            <th class="border p-2 w-20">Keterangan</th>
                                            <th class="border p-2 w-32">Jumlah</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr class="text-center text-base">
                                            <th class="border p-2">Customer Relationship</th>
                                            <th class="border p-2 ">{{ $penilaian->detail->cust_relation }} jumlah</th>
                                          </tr>
                                        </tbody>
                                      </table>                                     
                                    </div>
                                  </div>   
                                  <!-- Lihat Detail perhitungan FUZZY END -->
                                </div>
                              <!-- Item 2  END -->                       
                            </div>
                            <!-- Slider indicators -->
                              <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-2 left-1/2">
                                  <button type="button" class="w-3 h-3 rounded-full bg-blue-200 border-1 border-blue-200" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                                  <button type="button" class="w-3 h-3 rounded-full bg-blue-200 border-1 border-blue-200" aria-current="true" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                              </div>
                            <!-- Slider indicators END-->
                          </div>
                        </div>
                        <!-- POINT / NILAI -->
                        <div class="flex flex-col items-center w-full md:w-[30%]">
                          <h1 class="text-2xl border-b-2 font-semibold mb-4 text-gray-600">Point Total</h1>
                          <div class="flex flex-col h-44 w-44 rounded-full items-center border-8 border-blue-400">
                              <p class="text-4xl font-semibold mt-14 text-gray-600">{{ $penilaian->fuzzy->probabilitas }}</p>
                              <p class="text-2xl font-semibold mt-2 text-gray-600">{{ $penilaian->fuzzy->probabilitas_him }}</p>
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
          <form action="{{ route('penilaian.hapus', $penilaian->id_penilaian) }}" method="POST">
            @csrf
            @method('DELETE')
            <div id="popup-modal-{{ $penilaian->id_penilaian }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
              <div class="relative w-full max-w-md max-h-full">
                  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                      <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-{{ $penilaian->id_penilaian }}">
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
                          <button data-modal-hide="popup-modal-{{ $penilaian->id_penilaian }}" type="Submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                              Iya, Hapus data!
                          </button>
                          <button data-modal-hide="popup-modal-{{ $penilaian->id_penilaian }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
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
            order: [[0, 'desc']],
            columnDefs: [
                { targets: [6], orderable: false },
            ]
          });
        });
      </script>
    <!-- SCRIPT DATATABLE END-->

    <!-- SCRIPT DIAGRAM -->
    <script>
      // Ambil data dari dataPenilaianForChart
      const dataPenilaianForChart = @json($dataPenilaianForChart);
  
      // Urutkan data berdasarkan tanggal penilaian (tgl_penilaian)
      dataPenilaianForChart.sort((a, b) => new Date(a.tgl_penilaian) - new Date(b.tgl_penilaian));
  
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
                  fill: 'start',
              }],
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true,
                      max: 100,
                  },
              },
              plugins: {
                  tooltip: {
                      callbacks: {
                          title: (tooltipItem) => tooltipItem[0].label,
                          label: (tooltipItem) => `Nilai: ${tooltipItem.formattedValue}`,
                      },
                  },
              },
          },
      });
    </script>
  
    <!-- SCRIPT DIAGRAM END -->

    @endsection
</x-app-layout>
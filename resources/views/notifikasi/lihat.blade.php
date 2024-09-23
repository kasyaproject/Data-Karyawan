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
                                      <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Detail Penilaian
                                      </h3>
                                      <p class="text-base font-semibold text-gray-500">{{ $penilaian->nik_karyawan }} / {{ $penilaian->tgl_penilaian }}</p>
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
                                  <form action="{{ route('verifikasi.update', $penilaian->nik_karyawan) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="m-2 px-2 py-0.5 text-sm font-medium text-white rounded-full bg-green-400 hover:bg-green-600">Verifikasi</button>
                                  </form>
                                  <label>Nama Penilai : {{ $penilaian->nama_penilai }}</label>
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
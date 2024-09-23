<x-app-layout title="Access List">
  @section('sidebar#2','bg-gray-100')
    @section('container')

    <div class="main md:lg:xl:ml-60 pt-[56px] px-4 pb-4">
      <div class="w-full px-2 py-4 bg-blue-">
        <h1 class="flex justify-center mb-4 text-5xl border-b-blue-400 font-black text-gray-900 dark:text-white">SDM Terbaik</h1>
        
        @php
          $n = 0;
        @endphp
        @foreach  ($data as $index => $item)
          {{-- Card Rangking --}}
            <a href="{{ route('detail', ['nik' => $item->nik]) }}" class="flex w-full h-32 my-2 px-4 py-2 justify-between items-center text-center bg-white border border-gray-200 rounded-full shadow-md dark:bg-gray-800 dark:border-gray-700 hover:-translate-y-1 hover:scale-100">
              {{-- Kiri --}}
              <div class="flex w-[40%] bg-slate-">
                <h5 class="my-auto mr-2 pr-4 text-5xl border-r-2 bg-blue- font-bold text-black dark:text-white">#{{ $n + 1 }}</h5>
                @php
                  $n++;
                @endphp
                <div class="flex h-24 w-24 justify-center mx-4 items-center rounded-full overflow-hidden bg-yellow-400">
                  @if($item->image)  
                    <img src="{{ asset('storage/' . $item->image->path) }}" alt="" class="w-full h-full object-cover">
                  @else
                    <p>Foto tidak tersedia</p>
                  @endif
                  </div>
                <div class="flex items-center">
                    <div class="justify-start">
                        <p class="text-xl text-left font-semibold text-gray-900 dark:text-gray-900">{{ $item->nama }} 
                          @if (optional($item->penilaians->first())->verifikasi === 'yes')
                            <i class="bi bi-patch-check-fill h-2 text-green-500" title="Penilaian sudah di Verifikasi"></i>
                          @elseif (optional($item->penilaians->first())->verifikasi === 'no') 
                            <i class="bi bi-x-octagon-fill w-4 text-red-500" title="Penilaian belum di Verifikasi"></i>
                          @endif
                        </p>
                        <p class="text-base text-left text-gray-700 dark:text-gray-700">{{ $item->nik }}</p>
                        <p class="text-base text-left text-gray-700 dark:text-gray-700">{{ $item->unit }}</p>
                    </div>
                </div>
              </div>
              {{-- Kiri END --}}
              {{-- Tengah --}}
              <div class="flex w-[35%]">
                <div class="mr-14">
                  <p class="text-3xl font-semibold mb-2">{{ optional($item->penilaians->first())->detail->hasil_absensi ?? '-' }}</p>
                  <label class="text-base">Absensi</label>
                </div>
                <div class="mr-6">
                  <p class="text-3xl font-semibold mb-2">{{ optional($item->penilaians->first())->detail->produktifitas ?? '-' }}</p>
                  <label class="text-base">Produktifitas</label>
                </div>
                <div class="mx-2">
                  <p class="text-3xl font-semibold mb-2">{{ optional($item->penilaians->first())->detail->cust_relation ?? '-' }}</p>
                  <label class="text-base">Customer Relationship</label>
                </div>
              </div>
              {{-- Tengah END --}}
              {{-- Kanan --}}
              <div class="mr-8">
                <p class="text-3xl font-extrabold mb-1">{{ optional($item->penilaians->first())->fuzzy->probabilitas ?? '-' }}</p>
                <label class="text-xl font-semibold">Probabilitas</label>
              </div>
              {{-- Kanan END --}}
            </a>
          {{-- Card Rangking END --}}
        @endforeach
      </div>
  @endsection
</x-app-layout>
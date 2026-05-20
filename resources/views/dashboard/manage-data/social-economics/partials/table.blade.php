 <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-xl">
     <div class="overflow-x-auto">
         <table class="w-full text-left border-collapse">
             <thead>
                 <tr class="text-xs font-semibold tracking-wider text-gray-500 uppercase border-b border-gray-100 bg-gray-50">
                     <th class="w-16 px-6 py-4 text-center">No</th>
                     <th class="px-6 py-4">NIK & Penduduk</th>
                     <th class="px-6 py-4">Pendidikan & Pekerjaan</th>
                     <th class="px-6 py-4">Estimasi Pendapatan</th>
                     <th class="px-6 py-4">Kondisi Rumah</th>
                     <th class="px-6 py-4">Tingkat Ekonomi</th>
                     <th class="px-6 py-4">Bansos & Bantuan</th>
                     <th class="w-32 px-6 py-4 text-center">Aksi</th>
                 </tr>
             </thead>
             <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                 @if($profiles->isNotEmpty())
                 @php $no = $profiles->firstItem(); @endphp
                 @foreach($profiles as $item)
                 <tr class="transition-colors hover:bg-gray-50/70">
                     <td class="px-6 py-4 font-medium text-center text-gray-400">{{ $no++ }}</td>
                     <td class="px-6 py-4">
                         @if($item->citizen)
                         <div class="font-semibold text-gray-900">{{ $item->citizen->full_name }}</div>
                         <div class="text-xs text-gray-400">
                             NIK:
                             <span x-show="openData">{{ $item->citizen->id_number }}</span>
                             <span x-show="!openData"><x-vaadin-ellipsis-h class="inline size-4 text-slate-400" /></span>
                         </div>
                         @else
                         <span class="text-xs italic text-gray-400">Data Warga dihapus</span>
                         @endif
                     </td>
                     <td class="px-6 py-4 text-gray-600">
                         <div class="font-medium text-gray-800">{{ $item->education_level?->label() ?? '-' }}</div>
                         <div class="text-xs text-gray-400">Pekerjaan: {{ $item->occupation }}</div>
                     </td>
                     <td class="px-6 py-4 font-medium text-gray-900">
                         <span x-show="openData">Rp. {{ number_format($item->monthly_income, 2, ',', '.') }}</span>
                         <span x-show="!openData"><x-vaadin-ellipsis-h class="inline size-5 text-slate-400" /></span>
                     </td>
                     <td class="px-6 py-4 text-gray-600">
                         <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full {{ $item->house_condition->value === 'proper' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700' }}">
                             {{ $item->house_condition?->label() ?? '-' }}
                         </span>
                     </td>
                     <td class="px-6 py-4">
                         @php
                            $eStatus = $item->economic_status;

                            $eLabel = $eStatus?->label() ?? '-';
                            $eClass = $eStatus?->style() ?? 'bg-gray-100 text-gray-800';
                         @endphp
                         <span class="inline-flex items-center px-2.5 py-1.5 text-xs font-semibold rounded-md border {{ $eClass }}">
                             {{ $eLabel }}
                         </span>
                     </td>
                     <td class="px-6 py-4">
                         @if($item->is_welfare_recipient)
                         <div class="flex flex-col gap-0.5">
                             <span class="inline-flex items-center w-fit px-2 py-0.5 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">
                                 Penerima Bansos
                             </span>
                             <span class="text-xs font-medium text-gray-500">{{ $item->assistance_type }}</span>
                         </div>
                         @else
                         <span class="inline-flex items-center px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-100 text-gray-500">
                             Bukan Penerima
                         </span>
                         @endif
                     </td>
                     <td class="px-6 py-4 text-center">
                         <div class="flex items-center justify-center gap-2">
                             <button @click='openModal(@json($item))' class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="Edit Data">
                                 <x-heroicon-o-pencil-square class="w-4 h-4" />
                             </button>
                             <form action="{{ route('social-economics.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus profil sosial ekonomi ini?');">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Hapus Data">
                                     <x-heroicon-o-trash class="w-4 h-4" />
                                 </button>
                             </form>
                         </div>
                     </td>
                 </tr>
                 @endforeach
                 @else
                 <tr>
                     <td colspan="8" class="py-10 text-center text-gray-500">
                         <div class="flex flex-col items-center justify-center gap-2 py-4">
                             <x-heroicon-o-folder-open class="text-gray-300 size-8" />
                             <p class="text-sm font-medium">Profil Sosial Ekonomi tidak ditemukan.</p>
                         </div>
                     </td>
                 </tr>
                 @endif
             </tbody>
         </table>
     </div>

     <div class="flex items-center justify-between px-6 py-4 text-xs text-gray-500 border-t border-gray-100 bg-gray-50/50">
         <p>Menampilkan {{ $profiles->firstItem() ?? 0 }} sampai {{ $profiles->lastItem() ?? 0 }} dari {{ $profiles->total() }} profil</p>
         <div class="inline-flex gap-1">
             @if ($profiles->onFirstPage())
             <button class="px-3 py-1.5 border border-gray-200 rounded bg-white opacity-50 text-gray-600" disabled>
                 Sebelumnya
             </button>
             @else
             <a href="{{ $profiles->previousPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
                 Sebelumnya
             </a>
             @endif

             @if ($profiles->hasMorePages())
             <a href="{{ $profiles->nextPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
                 Selanjutnya
             </a>
             @else
             <button class="px-3 py-1.5 border border-gray-200 rounded bg-white opacity-50 text-gray-600" disabled>
                 Selanjutnya
             </button>
             @endif
         </div>
     </div>
 </div>

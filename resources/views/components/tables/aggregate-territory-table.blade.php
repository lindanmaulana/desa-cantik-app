@props(['id', 'dataTable', 'reqTypeSubVillage'])

@php
$firstRow = collect($dataTable['data'] ?? [])->first();
$hasGender = isset($firstRow['male']);
@endphp

<div class="block w-full overflow-x-auto border border-gray-100 rounded-xl whitespace-nowrap snap-x">
    @if(request('rw') ?? false)
    <table class="w-full text-xs sm:text-sm text-left border-collapse table-fixed min-w-[800px]">
        <thead class="text-[11px] sm:text-xs font-bold text-white uppercase bg-[#1e293b]">
            <tr>
                {{-- 💡 DISINI KUNCI LEBARNYA: RW dan RT kita buat LEBAR (Masing-masing 25%) --}}
                <th class="w-[25%] px-4 py-3 text-center sm:py-4">RW</th>
                <th class="w-[25%] px-4 py-3 text-center sm:py-4">RT</th>

                {{-- Kolom Kategori dibuat lebih ramping/menyesuaikan --}}
                <th class="w-[20%] px-4 py-3 sm:px-6 sm:py-4 text-left">Kategori</th>

                @if($hasGender)
                <th class="w-[10%] px-3 py-3 text-center sm:py-4">L</th>
                <th class="w-[10%] px-3 py-3 text-center sm:py-4">P</th>
                @endif

                <th class="w-[15%] px-3 py-3 text-center sm:py-4">Jumlah</th>
                <th class="w-[15%] px-3 py-3 text-center sm:py-4">%</th>
            </tr>
        </thead>

        <tbody class="align-middle bg-white divide-y divide-gray-100">
            @if(!empty($dataTable["data"]))
            @foreach($dataTable["data"] as $row)
            <tr class="transition-colors hover:bg-gray-50/50">
                @if($row['is_first'])
                {{-- Baris RW/RT lebar dan teksnya otomatis turun ke bawah jika panjang --}}
                <td rowspan="{{ $row['rowspan_count'] }}"
                    class="px-4 py-3 font-bold text-center text-gray-800 break-words whitespace-normal border-r border-gray-100 bg-slate-50/70">
                    {{ $row['rw'] }}
                </td>
                <td rowspan="{{ $row['rowspan_count'] }}"
                    class="px-4 py-3 font-bold text-center text-gray-800 break-words whitespace-normal border-r border-gray-100 bg-slate-50/70">
                    {{ $row['rt'] }}
                </td>
                @endif

                <td class="px-4 py-3 font-medium text-left text-gray-700 break-words whitespace-normal">
                    {{ $row['category'] }}
                </td>

                @if($hasGender)
                <td class="px-3 py-3 text-center text-gray-600">{{ number_format($row['male'] ?? 0) }}</td>
                <td class="px-3 py-3 text-center text-gray-600">{{ number_format($row['female'] ?? 0) }}</td>
                @endif

                <td class="px-3 py-3 font-bold text-center text-gray-900">{{ number_format($row['total']) }}</td>
                <td class="px-3 py-3 font-semibold text-center text-indigo-600 bg-indigo-50/20">
                    {{ $row['percent'] }}%
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="{{ $hasGender ? 6 : 5 }}" class="py-10 text-center text-gray-500">
                    <div class="flex flex-col items-center justify-center gap-2 py-4">
                        <x-heroicon-o-folder-open class="text-gray-300 size-8" />
                        <p class="text-sm font-medium">Data Dusun tidak ditemukan.</p>
                    </div>
                </td>
            </tr>
            @endif
        </tbody>
    </table>
    @else
    <div class="min-h-[400px] flex flex-col items-center justify-center w-full gap-2 italic text-gray-400">
        <x-iconsax-bro-arrow-up-1 class="size-20" />
        <div class="text-sm font-medium">Pilih Dusun di atas terlebih dahulu.</div>
    </div>
    @endif
</div>

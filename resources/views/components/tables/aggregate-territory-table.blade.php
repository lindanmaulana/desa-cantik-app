@props(['id', 'dataTable', 'reqTypeSubVillage'])

<div class="block w-full overflow-x-auto border border-gray-100 rounded-xl whitespace-nowrap snap-x">
    @if(request('rw') ?? false)
    <table class="w-full text-xs sm:text-sm text-left border-collapse table-auto min-w-[650px]">
        <thead class="text-[11px] sm:text-xs font-bold text-white uppercase bg-[#1e293b]">
            <tr>
                <th class="w-16 px-3 py-3 text-center sm:px-5 sm:py-4">RW</th>
                <th class="w-16 px-3 py-3 text-center sm:px-5 sm:py-4">RT</th>
                <th class="px-4 py-3 sm:px-6 sm:py-4">Kategori</th>
                <th class="w-16 px-3 py-3 text-center sm:px-6 sm:py-4">L</th>
                <th class="w-16 px-3 py-3 text-center sm:px-6 sm:py-4">P</th>
                <th class="w-24 px-3 py-3 text-center sm:px-6 sm:py-4">Jumlah</th>
                <th class="w-20 px-3 py-3 text-center sm:px-6 sm:py-4">%</th>
            </tr>
        </thead>

        <tbody class="align-middle divide-y divide-gray-100">
            @if(!empty($dataTable["data"]))
            @foreach($dataTable["data"] as $row)
            <tr class="hover:bg-gray-50/30">
                @if($row['is_first'])
                <td rowspan="7"
                    class="px-3 py-3 font-bold text-center text-gray-800 border-r border-gray-100 sm:px-5 sm:py-4 bg-slate-50/50">
                    {{ $row['rw'] }}
                </td>
                <td rowspan="7"
                    class="px-3 py-3 font-bold text-center text-gray-800 border-r border-gray-100 sm:px-5 sm:py-4 bg-slate-50/50">
                    {{ $row['rt'] }}
                </td>
                @endif

                <td class="px-4 py-3 sm:px-6 sm:py-4 italic text-gray-600 max-w-[180px] truncate">{{ $row['category'] }}</td>
                <td class="px-3 py-3 text-center text-gray-600 sm:px-6 sm:py-4">{{ $row['male'] }}</td>
                <td class="px-3 py-3 text-center text-gray-600 sm:px-6 sm:py-4">{{ $row['female'] }}</td>
                <td class="px-3 py-3 font-bold text-center text-gray-800 sm:px-6 sm:py-4">{{ $row['total'] }}</td>
                <td class="px-3 py-3 font-medium text-center text-gray-400 sm:px-6 sm:py-4">{{ $row['percent'] }}%</td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="8" class="py-10 text-center text-gray-500">
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
        <div>Pilih Dusun di atas.</div>
    </div>
    @endif
</div>

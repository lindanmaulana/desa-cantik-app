@props(['id', 'dataTable', 'reqTypeSubVillage'])

<div class="w-full overflow-x-auto bg-white">
    @if(request('rw') ?? false)
    <table class="w-full text-sm text-left border-collapse">
        <thead class="text-xs font-bold text-white uppercase bg-[#1e293b]">
            <tr>
                <th class="px-6 py-4">RW</th>
                <th class="px-6 py-4">RT</th>
                <th class="px-6 py-4">Kategori</th>
                <th class="px-6 py-4 text-center">L</th>
                <th class="px-6 py-4 text-center">P</th>
                <th class="px-6 py-4 text-center">Jumlah</th>
                <th class="px-6 py-4 text-center">%</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
            @if(!empty($dataTable["data"]))
            @foreach($dataTable["data"] as $row)
            <tr>
                @if($row['is_first'])
                <td rowspan="7"
                    class="px-6 py-4 font-bold text-center text-gray-800 border-r border-gray-50 bg-gray-50/30">
                    {{ $row['rw'] }}
                </td>
                <td rowspan="7"
                    class="px-6 py-4 font-bold text-center text-gray-800 border-r border-gray-50 bg-gray-50/30">
                    {{ $row['rt'] }}
                </td>
                @endif

                <td class="px-6 py-4 italic text-gray-600">{{ $row['category'] }}</td>
                <td class="px-6 py-4 text-center text-gray-600">{{ $row['male'] }}</td>
                <td class="px-6 py-4 text-center text-gray-600">{{ $row['female'] }}</td>
                <td class="px-6 py-4 font-bold text-center text-gray-800">{{ $row['total'] }}</td>
                <td class="px-6 py-4 text-center text-gray-400">{{ $row['percent'] }}%</td>
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

@props(['id', 'dataTable', 'reqType'])

@if($reqType)
<div x-data="tableComponent('{{ $id }}', {{ Js::from($dataTable) }})" x-init="initTable()" class="p-6 space-y-4 overflow-hidden bg-white border border-gray-100 shadow-sm rounded-3xl">
    <div class="border-b border-gray-50">
        <h3 class="text-xs font-bold tracking-widest text-gray-400 uppercase">Agregat Desa</h3>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-xs font-bold text-white uppercase bg-[#1e293b]">
                <tr>
                    <th class="px-6 py-4 text-center">No</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4 text-center">Laki-laki</th>
                    <th class="px-6 py-4 text-center">Perempuan</th>
                    <th class="px-6 py-4 text-center">Jumlah</th>
                    <th class="px-6 py-4 text-center">% Desa</th>
                    <th class="px-6 py-4">Proporsi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($dataTable['data'] as $data)
                <tr class="transition-colors hover:bg-gray-50">
                    <td class="px-6 py-4 text-center text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 font-medium text-gray-700">{{ $data['category'] }}</td>
                    <td class="px-6 py-4 text-center text-gray-600">{{ $data['male'] }}</td>
                    <td class="px-6 py-4 text-center text-gray-600">{{ $data['female'] }}</td>
                    <td class="px-6 py-4 font-bold text-center text-gray-800">{{ $data['total'] }}</td>
                    <td class="px-6 py-4 text-center">
                        <span
                            class="px-3 py-1 rounded-full bg-indigo-50 text-indigo-500 font-bold text-[11px]">{{ $data['percent'] }}%</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="w-24 h-2 bg-gray-100 rounded-full" style="--bar-width: {{ $data['percentage'] ?? $data['persen'] ?? $data['percent'] ?? 0 }}%;">
                            <div class="h-2 bg-indigo-500 rounded-full" style="width: var(--bar-width);"></div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-gray-50/50">
                <tr class="font-bold text-gray-800">
                    <td class="py-4 pl-10 text-left" colspan="2">Total</td>
                    <td class="px-6 py-4 text-center">{{ $dataTable['maleTotal'] }}</td>
                    <td class="px-6 py-4 text-center">{{ $dataTable['femaleTotal'] }}</td>
                    <td class="px-6 py-4 text-center">{{ $dataTable['total'] }}</td>
                    <td class="px-6 py-4 text-center">100%</td>
                    <td class="px-6 py-4"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@else
<div class="w-full h-[400px] flex flex-col items-center justify-center text-gray-400 bg-white border border-gray-100 shadow-sm rounded-3xl italic gap-4">
    <x-tabler-table-spark class="size-20" />
    <div>Pilih Kategori di atas.</div>
</div>
@endif

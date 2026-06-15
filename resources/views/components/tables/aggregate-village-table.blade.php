@props(['id', 'dataTable'])

<div class="block w-full overflow-x-auto border border-gray-100 rounded-xl whitespace-nowrap snap-x">
    <table class="w-full text-xs sm:text-sm text-left table-auto min-w-[700px]">
        <thead class="text-[11px] sm:text-xs font-bold text-white uppercase bg-[#1e293b] sticky top-0">
            <tr>
                <th class="w-12 px-3 py-3 text-center sm:px-6 sm:py-4">No</th>
                <th class="px-4 py-3 sm:px-6 sm:py-4">Kategori</th>
                <th class="px-3 py-3 text-center sm:px-6 sm:py-4">Laki-laki</th>
                <th class="px-3 py-3 text-center sm:px-6 sm:py-4">Perempuan</th>
                <th class="px-3 py-3 text-center sm:px-6 sm:py-4">Jumlah</th>
                <th class="px-3 py-3 text-center sm:px-6 sm:py-4">% Desa</th>
                <th class="w-32 px-4 py-3 sm:px-6 sm:py-4">Proporsi</th>
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
                <td class="px-6 py-4 sm:px-6 sm:py-4">
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

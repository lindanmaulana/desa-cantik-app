<div class="overflow-x-auto">
    <table class="w-full text-sm text-left">
        <thead class="text-xs font-bold text-white uppercase bg-[#1e293b]">
            <tr>
                @if(header.isNotEmpty())
                    @foreach(header as head)
                        <th class="px-6 py-4 text-center">{{ head }}</th>
                    @endforeach
                @endif
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
            <tr class="transition-colors hover:bg-gray-50">
                <td class="px-6 py-4 text-center text-gray-500">1</td>
                <td class="px-6 py-4 font-medium text-gray-700">Pra Lansia (55-64)</td>
                <td class="px-6 py-4 text-center text-gray-600">366</td>
                <td class="px-6 py-4 text-center text-gray-600">353</td>
                <td class="px-6 py-4 font-bold text-center text-gray-800">719</td>
                <td class="px-6 py-4 text-center">
                    <span
                        class="px-3 py-1 rounded-full bg-indigo-50 text-indigo-500 font-bold text-[11px]">8.9%</span>
                </td>
                <td class="px-6 py-4">
                    <div class="w-24 h-2 bg-gray-100 rounded-full">
                        <div class="h-2 bg-indigo-500 rounded-full" style="width: 8.9%"></div>
                    </div>
                </td>
            </tr>

            <tr class="transition-colors hover:bg-gray-50">
                <td class="px-6 py-4 text-center text-gray-500">2</td>
                <td class="px-6 py-4 font-medium text-gray-700">Dewasa Produktif (25-54)</td>
                <td class="px-6 py-4 text-center text-gray-600">2.029</td>
                <td class="px-6 py-4 text-center text-gray-600">1.758</td>
                <td class="px-6 py-4 font-bold text-center text-gray-800">3.787</td>
                <td class="px-6 py-4 text-center">
                    <span
                        class="px-3 py-1 rounded-full bg-sky-50 text-sky-500 font-bold text-[11px]">46.8%</span>
                </td>
                <td class="px-6 py-4">
                    <div class="w-24 h-2 bg-gray-100 rounded-full">
                        <div class="h-2 rounded-full bg-sky-400 w-[46.8%]"></div>
                    </div>
                </td>
            </tr>

            <tr class="transition-colors hover:bg-gray-50">
                <td class="px-6 py-4 text-center text-gray-500">3</td>
                <td class="px-6 py-4 font-medium text-gray-700">Lansia (65+)</td>
                <td class="px-6 py-4 text-center text-gray-600">409</td>
                <td class="px-6 py-4 text-center text-gray-600">368</td>
                <td class="px-6 py-4 font-bold text-center text-gray-800">777</td>
                <td class="px-6 py-4 text-center">
                    <span
                        class="px-3 py-1 rounded-full bg-amber-50 text-amber-500 font-bold text-[11px]">9.6%</span>
                </td>
                <td class="px-6 py-4">
                    <div class="w-24 h-2 bg-gray-100 rounded-full">
                        <div class="h-2 rounded-full bg-amber-400 w-[9.6%]"></div>
                    </div>
                </td>
            </tr>
        </tbody>
        <tfoot class="bg-gray-50/50">
            <tr class="font-bold text-gray-800">
                <td class="py-4 pl-10 text-left" colspan="2">Total</td>
                <td class="px-6 py-4 text-center">4.243</td>
                <td class="px-6 py-4 text-center">3.844</td>
                <td class="px-6 py-4 text-center">8.087</td>
                <td class="px-6 py-4 text-center">100%</td>
                <td class="px-6 py-4"></td>
            </tr>
        </tfoot>
    </table>
</div>

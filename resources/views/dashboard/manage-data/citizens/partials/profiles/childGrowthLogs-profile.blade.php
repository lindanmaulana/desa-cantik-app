<div>
    @if(!$citizen->isToddler && !$citizen->chilGrowthLogs)
    <div class="flex flex-col items-center justify-center gap-2 py-8">
        <x-solar-square-academic-cap-2-broken class="size-6 text-primary" />
        <h5 class="text-sm font-semibold">Bukan Usia Balita (0 - 5 Tahun)</h5>
        <p class="text-xs text-center text-slate-400 max-w-64">Pemantauan log tumbuh kembang stunting di Posyandu hanya berlaku bagi warga usia balita..</p>
    </div>

    @else
    <div class="relative space-y-4">
        <button @click="childGrowthLog.openCreate = true" class="absolute right-0 flex items-center gap-2 px-4 py-2 text-xs font-semibold rounded-lg -top-[68px] bg-emerald-100 text-emerald-500"><x-vaadin-plus class="size-3" /> <span class="mb-px">Input Data Timbang</span></button>

        <div class="flex items-center justify-between p-4 border rounded-lg bg-emerald-50 border-emerald-200">
            <div class="space-y-1">
                <h3 class="text-xs font-semibold text-emerald-600">DIAGNOSA TERAKHIR (KEMENKES)</h3>
                <p class="text-xs text-slate-400">Berdasarkan data tinggi badan menurut umur</p>
            </div>
            <div class="flex items-center gap-2 px-2 py-px text-xs font-semibold border rounded-full text-amber-600 bg-amber-50 border-amber-200 animate-pulse">
                <span class="w-2.5 h-2.5 rounded-full bg-gradient-to-br from-amber-300 to-amber-500 shadow-sm"></span>
                <span>Pendek (Stunted)</span>
            </div>
        </div>

        <div class="w-full overflow-hidden bg-white border border-gray-100 shadow-sm rounded-2xl">
            <div class="w-full overflow-x-auto text-xs">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50/70">
                        <tr>
                            <th scope="col" class="px-4 py-3 font-bold tracking-wider text-left text-gray-500 uppercase">No</th>
                            <th scope="col" class="px-4 py-3 font-bold tracking-wider text-left text-gray-500 uppercase">Tgl Ukur</th>
                            <th scope="col" class="px-4 py-3 font-bold tracking-wider text-left text-gray-500 uppercase">BB (Kg)</th>
                            <th scope="col" class="px-4 py-3 font-bold tracking-wider text-left text-gray-500 uppercase">TB (Cm)</th>
                            <th scope="col" class="px-4 py-3 font-bold tracking-wider text-left text-gray-500 uppercase">Metode</th>
                            <th scope="col" class="px-4 py-3 font-bold tracking-wider text-left text-gray-500 uppercase">Vit A</th>
                            <th scope="col" class="px-4 py-3 font-bold tracking-wider text-left text-gray-500 uppercase">Hasil WHO</th>
                            <th scope="col" class="px-4 py-3 font-bold tracking-wider text-left text-gray-500 uppercase">Catatan</th>
                            <th scope="col" class="px-4 py-3 font-bold tracking-wider text-left text-gray-500 uppercase"></th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700 bg-white divide-y divide-gray-100">
                        @if($citizen->childGrowthLogs && $citizen->childGrowthLogs->isNotEmpty())
                        @foreach($citizen->childGrowthLogs as $item)
                        <tr class="transition-colors hover:bg-gray-50/50">
                            <td class="px-4 py-3.5 whitespace-nowrap font-medium text-gray-600">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-4 py-3.5 whitespace-nowrap font-medium text-gray-600">
                                {{ $item->measured_at->format('d M Y') }}
                            </td>

                            <td class="px-4 py-3.5 whitespace-nowrap">
                                <span class="text-sm font-extrabold text-gray-800">{{ $item->weight }}</span>
                                <span class="text-gray-400 block text-[10px] font-medium">Kg</span>
                            </td>

                            <td class="px-4 py-3.5 whitespace-nowrap">
                                <span class="text-sm font-extrabold text-gray-800">{{ $item->height }}</span>
                                <span class="text-gray-400 block text-[10px] font-medium">Cm</span>
                            </td>

                            <td class="px-4 py-3.5 whitespace-nowrap text-gray-600 font-medium">
                                <span class="inline-flex items-center gap-1.5 uppercase font-bold text-[11px] tracking-wide text-indigo-900/80">
                                    🛌 TELENTANG
                                </span>
                            </td>

                            <td class="px-4 py-3.5 whitespace-nowrap">
                                @if($item->vit_a_received)
                                <span class="inline-flex items-center gap-1.5 font-semibold text-gray-700">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 shadow-sm shadow-emerald-200"></span>
                                    Ya
                                </span>
                                @else
                                <span class="inline-flex items-center gap-1.5 font-semibold text-gray-700">
                                    <span class="w-2.5 h-2.5 rounded-full bg-red-400 shadow-sm shadow-red-200"></span>
                                    Tidak
                                </span>
                                @endif
                            </td>

                            <td class="px-4 py-3.5 whitespace-nowrap">
                                @if($item->stunting_status == $stuntingStatus::SEVERELY_STUNTED)
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50/60 px-3 py-1.5 text-xs font-bold text-red-800 border border-red-100/70">
                                    <span class="w-2.5 h-2.5 rounded-full bg-gradient-to-br from-red-300 to-red-500 shadow-sm"></span>
                                    {{ $item->stunting_status->label() }}
                                </span>
                                @elseif($item->stunting_status == $stuntingStatus::STUNTED)
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50/60 px-3 py-1.5 text-xs font-bold text-amber-800 border border-amber-100/70">
                                    <span class="w-2.5 h-2.5 rounded-full bg-gradient-to-br from-amber-300 to-amber-500 shadow-sm"></span>
                                    {{ $item->stunting_status->label() }}
                                </span>
                                @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50/60 px-3 py-1.5 text-xs font-bold text-green-800 border border-green-100/70">
                                    <span class="w-2.5 h-2.5 rounded-full bg-gradient-to-br from-green-300 to-green-500 shadow-sm"></span>
                                    {{ $item->stunting_status->label() }}
                                </span>
                                @endif
                            </td>

                            <td class="px-4 py-3.5 text-gray-500 max-w-[200px] truncate font-medium" title="Asupan gizi tambahan terus dipantau">
                                @if($item->notes)
                                {{ $item->notes }}
                                @else
                                ---
                                @endif
                            </td>
                            <td>
                                <a href="" class="p-1.5 text-emerald-600 hover:bg-blue-50 rounded-md transition-colors">
                                    <x-heroicon-o-eye class="w-4 h-4 mr-2" />
                                </a>
                            </td>
                        </tr>
                        @endforeach

                        @else
                        <tr>
                            <td colspan="8" class="py-2 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center gap-2 py-4">
                                    <x-heroicon-o-folder-open class="text-gray-300 size-8" />
                                    <p class="text-xs font-medium">Log Timbangan & Diagnosa Stunting tidak ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>

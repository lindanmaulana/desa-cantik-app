<div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-xs font-semibold tracking-wider text-gray-500 uppercase border-b border-gray-100 bg-gray-50">
                    <th class="w-16 px-6 py-4 max-md:px-3 max-md:py-2 text-center truncate">No</th>
                    <th class="px-6 py-4 max-md:px-3 max-md:py-2 truncate">Nama Sarana Prasarana</th>
                    <th class="px-6 py-4 max-md:px-3 max-md:py-2 truncate">Jenis Fasilitas</th>
                    <th class="px-6 py-4 max-md:px-3 max-md:py-2 truncate">Kondisi Kelayakan</th>
                    <th class="px-6 py-4 max-md:px-3 max-md:py-2 truncate text-center">Tahun Konstruksi</th>
                    <th class="px-6 py-4 max-md:px-3 max-md:py-2 truncate">Sumber Anggaran</th>
                    <th class="w-32 px-6 py-4 max-md:px-3 max-md:py-2 truncate text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                @if($infrastructures->isNotEmpty())
                @php $no = $infrastructures->firstItem(); @endphp
                @foreach($infrastructures as $item)
                <tr class="transition-colors hover:bg-gray-50/70">
                    <td class="px-6 py-4 max-md:px-3 max-md:py-2 font-medium text-center text-gray-400">{{ $no++ }}</td>
                    <td class="px-6 py-4 max-md:px-3 max-md:py-2">
                        <div class="font-semibold text-gray-900">{{ $item->facility_name }}</div>
                        <div class="text-xs text-gray-400">ID: {{ substr($item->id, 0, 8) }}...</div>
                    </td>
                    <td class="px-6 py-4 max-md:px-3 max-md:py-2 font-medium text-gray-900">
                        {{ $facilityType::tryFrom($item->facility_type->value)?->label() ?? '-' }}
                    </td>
                    <td class="px-6 py-4 max-md:px-3 max-md:py-2">
                        @if($item->condition->value === 'good')
                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100">
                            <span class="w-1.5 h-1.5 mr-1.5 bg-emerald-500 rounded-full"></span>
                            {{ $conditionInfrastructure::tryFrom($item->condition->value)?->label() }}
                        </span>
                        @elseif($item->condition->value === 'damaged_light')
                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-100">
                            <span class="w-1.5 h-1.5 mr-1.5 bg-amber-500 rounded-full"></span>

                            {{ $conditionInfrastructure::tryFrom($item->condition->value)?->label() }}
                        </span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-rose-50 text-rose-700 border border-rose-100">
                            <span class="w-1.5 h-1.5 mr-1.5 bg-rose-500 rounded-full"></span>
                            {{ $conditionInfrastructure::tryFrom($item->condition->value)?->label() }}
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 max-md:px-3 max-md:py-2 font-semibold text-center text-gray-900">
                        @if($item->construction_year)
                        <span x-show="openData">{{ $item->construction_year }}</span>
                        <span x-show="!openData"><x-vaadin-ellipsis-h class="inline size-4 text-slate-400" /></span>
                        @else
                        <span class="text-xs italic text-gray-400">Belum Tercatat</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 max-md:px-3 max-md:py-2 font-medium text-gray-800">
                        <span x-show="openData">{{ $item->funding_source }}</span>
                        <span x-show="!openData"><x-vaadin-ellipsis-h class="inline size-5 text-slate-400" /></span>
                    </td>
                    <td class="px-6 py-4 max-md:px-3 max-md:py-2 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button @click='openModal(@json($item))' class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="Edit Aset">
                                <x-heroicon-o-pencil-square class="w-4 h-4" />
                            </button>

                            <button type="button" @click.stop.prevent="openDeleteModal($event)"
                                data-url="{{ route('infrastructures.destroy', $item->id) }}"
                                class="p-1.5 text-red-500 hover:bg-red-50 rounded-md transition-colors"
                                title="Hapus Data">
                                <x-heroicon-o-trash class="w-4 h-4 pointer-events-none" />
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="7" class="py-10 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center gap-2 py-4">
                            <x-heroicon-o-folder-open class="text-gray-300 size-8" />
                            <p class="text-sm font-medium">Aset infrastruktur tidak ditemukan.</p>
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="flex items-center justify-between px-6 py-4 text-xs border-t text-textSecondary border-textTertiary/20 max-md:px-3 max-md:py-2 bg-tertiary/20">
        <p>Menampilkan {{ $infrastructures->firstItem() ?? 0 }} sampai {{ $infrastructures->lastItem() ?? 0 }} dari {{ $infrastructures->total() }} unit sarana</p>
        <div class="inline-flex gap-1">
            @if ($infrastructures->onFirstPage())
            <button class="px-3 py-1.5 border border-textTertiary/30 rounded bg-secondary opacity-50 text-textSecondary" disabled>
                Sebelumnya
            </button>
            @else
            <a href="{{ $infrastructures->previousPageUrl() }}" class="px-3 py-1.5 border border-textTertiary/40 rounded bg-secondary hover:bg-tertiary text-textPrimary">
                Sebelumnya
            </a>
            @endif

            @if ($infrastructures->hasMorePages())
            <a href="{{ $infrastructures->nextPageUrl() }}" class="px-3 py-1.5 border border-textTertiary/40 rounded bg-secondary hover:bg-tertiary text-textPrimary">
                Selanjutnya
            </a>
            @else
            <button class="px-3 py-1.5 border border-textTertiary/30 rounded bg-secondary opacity-50 text-textSecondary" disabled>
                Selanjutnya
            </button>
            @endif
        </div>
    </div>
</div>

<div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wider text-gray-500 uppercase border-b border-gray-100 bg-gray-50">
                    <th class="w-16 px-6 py-4 text-center truncate max-md:px-3 max-md:py-2">No</th>
                    <th class="px-6 py-4 truncate max-md:px-3 max-md:py-2">Nama Usaha / NIB</th>
                    <th class="px-6 py-4 truncate max-md:px-3 max-md:py-2">Kategori & Legalitas</th>
                    <th class="px-6 py-4 truncate max-md:px-3 max-md:py-2">Pemilik (Warga)</th>
                    <th class="px-6 py-4 text-center truncate max-md:px-3 max-md:py-2">Tenaga Kerja</th>
                    <th class="px-6 py-4 truncate max-md:px-3 max-md:py-2">Omset Bulanan</th>
                    <th class="px-6 py-4 text-center truncate max-md:px-3 max-md:py-2">Indikator</th>
                    <th class="w-32 px-6 py-4 text-center truncate max-md:px-3 max-md:py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                @if ($msmes->isNotEmpty())
                @php $no = $msmes->firstItem(); @endphp
                @foreach ($msmes as $item)
                <tr class="transition-colors hover:bg-gray-50/70">
                    <td class="px-6 py-4 font-medium text-center text-gray-400 max-md:px-3 max-md:py-2">
                        {{ $no++ }}
                    </td>

                    <td class="px-6 py-4 max-md:px-3 max-md:py-2">
                        <div class="font-semibold text-gray-900">{{ $item->business_name }}</div>
                        <div class="text-xs text-gray-400 mt-0.5">
                            NIB / Izin:
                            @if ($item->license_number)
                            <span x-show="openData"
                                class="font-mono text-gray-600">{{ $item->license_number }}</span>
                            <span x-show="!openData"><x-vaadin-ellipsis-h
                                    class="inline size-4 text-slate-400" /></span>
                            @else
                            <span class="italic text-gray-400">Tidak Ada</span>
                            @endif
                        </div>
                    </td>

                    <td class="px-6 py-4 max-md:px-3 max-md:py-2">
                        <div class="flex flex-col items-start gap-1">
                            <span
                                class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-500/10 text-blue-400 border border-emerald-100 truncate">
                                {{ $item->business_category?->label() ?? '-' }}
                            </span>
                            <span
                                class="text-[11px] px-2 py-0.5 rounded font-medium text-gray-500 bg-gray-100 border border-gray-200">
                                {{ $item->legal_entity_type->label() ?? 'Belum Berbadan Hukum' }}
                            </span>
                        </div>
                    </td>

                    <td class="px-6 py-4 max-md:px-3 max-md:py-2">
                        @if ($item->citizen)
                        <div class="font-medium text-gray-800">{{ $item->citizen->full_name }}</div>
                        <div class="text-xs text-gray-400 mt-0.5">
                            NIK:
                            <span x-show="openData"
                                class="font-mono text-gray-600">{{ $item->citizen->id_number }}</span>
                            <span x-show="!openData"><x-vaadin-ellipsis-h
                                    class="inline size-4 text-slate-400" /></span>
                        </div>
                        @else
                        <span class="text-xs italic text-gray-400">Data Warga dihapus</span>
                        @endif
                    </td>

                    <td class="px-6 py-4 font-medium text-center text-gray-900 max-md:px-3 max-md:py-2">
                        {{ $item->employee_count }} Orang
                    </td>

                    <td class="px-6 py-4 font-semibold text-gray-900 max-md:px-3 max-md:py-2">
                        <span x-show="openData">Rp
                            {{ number_format($item->monthly_revenue, 0, ',', '.') }}</span>
                        <span x-show="!openData"><x-vaadin-ellipsis-h
                                class="inline size-5 text-slate-400" /></span>
                    </td>

                    <td class="px-6 py-4 text-center max-md:px-3 max-md:py-2">
                        <div class="flex items-center justify-center gap-1.5">
                            @if ($item->uses_digital_payment)
                            <span class="p-1 text-blue-600 border border-blue-100 rounded-md bg-blue-50"
                                title="Mendukung Pembayaran Digital / QRIS">
                                <x-heroicon-s-credit-card class="size-4" />
                            </span>
                            @endif

                            @if ($item->is_environmentally_friendly)
                            <span class="p-1 text-teal-600 border border-teal-100 rounded-md bg-teal-50"
                                title="Lolos Standar Ramah Lingkungan">
                                <x-heroicon-s-globe-asia-australia class="size-4" />
                            </span>
                            @endif

                            @if (!$item->uses_digital_payment && !$item->is_environmentally_friendly)
                            <span class="text-xs italic text-gray-400">-</span>
                            @endif
                        </div>
                    </td>

                    <td class="px-6 py-4 text-center max-md:px-3 max-md:py-2">
                        <div class="flex items-center justify-center gap-2">
                            <button @click='openModal(@json($item))'
                                class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors"
                                title="Edit UMKM">
                                <x-heroicon-o-pencil-square class="w-4 h-4" />
                            </button>

                            <button type="button" @click.stop.prevent="openDeleteModal($event)"
                                data-url="{{ route('msmes.destroy', $item->id) }}"
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
                    <td colspan="8" class="py-10 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center gap-2 py-4">
                            <x-heroicon-o-folder-open class="text-gray-300 size-8" />
                            <p class="text-sm font-medium">Profil UMKM tidak ditemukan.</p>
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div
        class="flex items-center justify-between px-6 py-4 text-xs border-t text-textSecondary border-textTertiary/20 max-md:px-3 max-md:py-2 bg-tertiary/20">
        <p>Menampilkan {{ $msmes->firstItem() ?? 0 }} sampai {{ $msmes->lastItem() ?? 0 }} dari {{ $msmes->total() }}
            UMKM</p>
        <div class="inline-flex gap-1">
            @if ($msmes->onFirstPage())
            <button
                class="px-3 py-1.5 border border-textTertiary/30 rounded bg-secondary opacity-50 text-textSecondary"
                disabled>
                Sebelumnya
            </button>
            @else
            <a href="{{ $msmes->previousPageUrl() }}"
                class="px-3 py-1.5 border border-textTertiary/40 rounded bg-secondary hover:bg-tertiary text-textPrimary">
                Sebelumnya
            </a>
            @endif

            @if ($msmes->hasMorePages())
            <a href="{{ $msmes->nextPageUrl() }}"
                class="px-3 py-1.5 border border-textTertiary/40 rounded bg-secondary hover:bg-tertiary text-textPrimary">
                Selanjutnya
            </a>
            @else
            <button
                class="px-3 py-1.5 border border-textTertiary/30 rounded bg-secondary opacity-50 text-textSecondary"
                disabled>
                Selanjutnya
            </button>
            @endif
        </div>
    </div>
</div>

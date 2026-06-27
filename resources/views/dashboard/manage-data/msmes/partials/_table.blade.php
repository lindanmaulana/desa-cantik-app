<div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-xs font-semibold tracking-wider text-gray-500 uppercase border-b border-gray-100 bg-gray-50">
                    <th class="w-16 px-6 py-4 text-center truncate">No</th>
                    <th class="px-6 py-4 truncate">Nama Usaha / NIB</th>
                    <th class="px-6 py-4 truncate">Kategori & Legalitas</th>
                    <th class="px-6 py-4 truncate">Pemilik (Warga)</th>
                    <th class="px-6 py-4 text-center truncate">Tenaga Kerja</th>
                    <th class="px-6 py-4 truncate">Omset Bulanan</th>
                    <th class="px-6 py-4 text-center truncate">Indikator</th>
                    <th class="w-32 px-6 py-4 text-center truncate">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                @if($msmes->isNotEmpty())
                @php $no = $msmes->firstItem(); @endphp
                @foreach($msmes as $item)
                <tr class="transition-colors hover:bg-gray-50/70">
                    {{-- 1. Nomor --}}
                    <td class="px-6 py-4 font-medium text-center text-gray-400">{{ $no++ }}</td>

                    {{-- 2. Nama Usaha & NIB --}}
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-900">{{ $item->business_name }}</div>
                        <div class="text-xs text-gray-400 mt-0.5">
                            NIB / Izin:
                            @if($item->license_number)
                            <span x-show="openData" class="font-mono text-gray-600">{{ $item->license_number }}</span>
                            <span x-show="!openData"><x-vaadin-ellipsis-h class="inline size-4 text-slate-400" /></span>
                            @else
                            <span class="italic text-gray-400">Tidak Ada</span>
                            @endif
                        </div>
                    </td>

                    {{-- 3. Kategori & Legalitas --}}
                    <td class="px-6 py-4">
                        <div class="flex flex-col items-start gap-1">
                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-500/10 text-blue-400 border border-emerald-100 truncate">
                                {{ $businessCategory::tryFrom($item->business_category?->value ?? $item->business_category)->label() ?? '-' }}
                            </span>
                            <span class="text-[11px] px-2 py-0.5 rounded font-medium text-gray-500 bg-gray-100 border border-gray-200">
                                @switch($item->legal_entity_type)
                                @case('sole_proprietorship') Perorangan @break
                                @case('limited_partnership') CV @break
                                @case('limited_company') PT @break
                                @case('cooperative') Koperasi @break
                                @default Unregistered
                                @endswitch
                            </span>
                        </div>
                    </td>

                    {{-- 4. Pemilik --}}
                    <td class="px-6 py-4">
                        @if($item->citizen)
                        <div class="font-medium text-gray-800">{{ $item->citizen->full_name }}</div>
                        <div class="text-xs text-gray-400 mt-0.5">
                            NIK:
                            <span x-show="openData" class="font-mono text-gray-600">{{ $item->citizen->id_number }}</span>
                            <span x-show="!openData"><x-vaadin-ellipsis-h class="inline size-4 text-slate-400" /></span>
                        </div>
                        @else
                        <span class="text-xs italic text-gray-400">Data Warga dihapus</span>
                        @endif
                    </td>

                    {{-- 5. Tenaga Kerja --}}
                    <td class="px-6 py-4 font-medium text-center text-gray-900">
                        {{ $item->employee_count }} Orang
                    </td>

                    {{-- 6. Omset Bulanan (FIXED TYPO) --}}
                    <td class="px-6 py-4 font-semibold text-gray-900">
                        {{-- FIXED: Mengubah $item->mothly_revenue menjadi $item->monthly_revenue --}}
                        <span x-show="openData">Rp {{ number_format($item->monthly_revenue, 0, ',', '.') }}</span>
                        <span x-show="!openData"><x-vaadin-ellipsis-h class="inline size-5 text-slate-400" /></span>
                    </td>

                    {{-- 7. Indikator (Digital & Lingkungan) --}}
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-1.5">
                            {{-- Transaksi Digital --}}
                            @if($item->uses_digital_payment)
                            <span class="p-1 text-blue-600 border border-blue-100 rounded-md bg-blue-50" title="Mendukung Pembayaran Digital / QRIS">
                                <x-heroicon-s-credit-card class="size-4" />
                            </span>
                            @endif

                            {{-- Ramah Lingkungan --}}
                            @if($item->is_environmentally_friendly)
                            <span class="p-1 text-teal-600 border border-teal-100 rounded-md bg-teal-50" title="Lolos Standar Ramah Lingkungan">
                                <x-heroicon-s-globe-asia-australia class="size-4" />
                            </span>
                            @endif

                            @if(!$item->uses_digital_payment && !$item->is_environmentally_friendly)
                            <span class="text-xs italic text-gray-400">-</span>
                            @endif
                        </div>
                    </td>

                    {{-- 8. Tombol Aksi --}}
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button @click='openModal(@json($item))' class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="Edit UMKM">
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
</div>

<div class="flex items-center justify-between px-6 py-4 text-xs text-gray-500 border-t border-gray-100 bg-gray-50/50">
    <p>Menampilkan {{ $msmes->firstItem() ?? 0 }} sampai {{ $msmes->lastItem() ?? 0 }} dari {{ $msmes->total() }} UMKM</p>
    <div class="inline-flex gap-1">
        @if ($msmes->onFirstPage())
        <button class="px-3 py-1.5 border border-gray-200 rounded bg-white opacity-50 text-gray-600" disabled>
            Sebelumnya
        </button>
        @else
        <a href="{{ $msmes->previousPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
            Sebelumnya
        </a>
        @endif

        @if ($msmes->hasMorePages())
        <a href="{{ $msmes->nextPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
            Selanjutnya
        </a>
        @else
        <button class="px-3 py-1.5 border border-gray-200 rounded bg-white opacity-50 text-gray-600" disabled>
            Selanjutnya
        </button>
        @endif
    </div>
</div>

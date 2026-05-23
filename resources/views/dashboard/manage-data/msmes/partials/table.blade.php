<div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-xs font-semibold tracking-wider text-gray-500 uppercase border-b border-gray-100 bg-gray-50">
                    <th class="w-16 px-6 py-4 text-center">No</th>
                    <th class="px-6 py-4">Nama Usaha / NIB</th>
                    <th class="px-6 py-4">Kategori Usaha</th>
                    <th class="px-6 py-4">Pemilik (Warga)</th>
                    <th class="px-6 py-4 text-center">Tenaga Kerja</th>
                    <th class="px-6 py-4">Omset Bulanan</th>
                    <th class="w-32 px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                @if($msmes->isNotEmpty())
                @php $no = $msmes->firstItem(); @endphp
                @foreach($msmes as $item)
                <tr class="transition-colors hover:bg-gray-50/70">
                    <td class="px-6 py-4 font-medium text-center text-gray-400">{{ $no++ }}</td>
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-900">{{ $item->business_name }}</div>
                        <div class="text-xs text-gray-400">
                            NIB / Izin:
                            @if($item->license_number)
                            <span x-show="openData">{{ $item->license_number }}</span>
                            <span x-show="!openData"><x-vaadin-ellipsis-h class="inline size-4 text-slate-400" /></span>
                            @else
                            <span class="italic">Tidak Ada</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100">
                            {{ $businessCategory::tryFrom($item->business_category?->value)->label() ?? '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($item->citizen)
                        <div class="font-medium text-gray-800">{{ $item->citizen->full_name }}</div>
                        <div class="text-xs text-gray-400">
                            NIK:
                            <span x-show="openData">{{ $item->citizen->id_number }}</span>
                            <span x-show="!openData"><x-vaadin-ellipsis-h class="inline size-4 text-slate-400" /></span>
                        </div>
                        @else
                        <span class="text-xs italic text-gray-400">Data Warga dihapus</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-medium text-center text-gray-900">
                        {{ $item->employee_count }} Orang
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900">
                        <span x-show="openData">Rp. {{ number_format($item->mothly_revenue, 2, ',', '.') }}</span>
                        <span x-show="!openData"><x-vaadin-ellipsis-h class="inline size-5 text-slate-400" /></span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button @click='openModal(@json($item))' class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="Edit UMKM">
                                <x-heroicon-o-pencil-square class="w-4 h-4" />
                            </button>
                            <form action="{{ route('msmes.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus profil UMKM ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Hapus UMKM">
                                    <x-heroicon-o-trash class="w-4 h-4" />
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="7" class="py-10 text-center text-gray-500">
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
</div>

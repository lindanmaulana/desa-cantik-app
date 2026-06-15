<div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-xs font-semibold tracking-wider text-gray-500 uppercase border-b border-gray-100 bg-gray-50">
                    <th class="w-16 px-6 py-4 text-center">ID</th>
                    <th class="px-6 py-4">No Kartu Keluarga (KK)</th>
                    <th class="px-6 py-4">Wilayah Tinggal</th>
                    <th class="px-6 py-4">Detail Alamat</th>
                    <th class="px-6 py-4 text-center">Jumlah Anggota</th>
                    <th class="w-32 px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                @if($families->isNotEmpty())
                @php $no = $families->firstItem(); @endphp
                @foreach($families as $item)
                <tr class="transition-colors hover:bg-gray-50/70">
                    <td class="px-6 py-4 font-medium text-center text-gray-400">{{ $no++ }}</td>
                    <td x-show="openData" class="px-6 py-4 font-semibold text-gray-900">{{ $item->family_card_number }}</td>
                    <td x-show="!openData" class="px-6 py-4 font-semibold text-gray-900"><x-vaadin-ellipsis-h class="size-5 text-slate-400" /></td>
                    <td class="px-6 py-4 text-gray-600">
                        @if($item->territory)
                        Dusun {{ ucfirst($item->territory->sub_village) }} (RT {{ $item->territory->rt }} / RW {{ $item->territory->rw }})
                        @else
                        <span class="text-xs italic text-gray-400">Tidak dikaitkan</span>
                        @endif
                    </td>
                    <td class="max-w-xs px-6 py-4 text-gray-500 truncate">{{ $item->address_detail }}</td>
                    <td class="px-6 py-4 font-medium text-center">{{ $item->citizens->count() }} orang</td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button @click='openModal(@json($item))' class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="Edit Data">
                                <x-heroicon-o-pencil-square class="w-4 h-4" />
                            </button>
                            <form action="{{ route('families.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data keluarga ini? Seluruh data warga/penduduk yang terikat dengan KK ini mungkin akan mengalami kendala.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Hapus Data">
                                    <x-heroicon-o-trash class="w-4 h-4" />
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="8" class="py-10 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center gap-2 py-4">
                            <x-heroicon-o-folder-open class="text-gray-300 size-8" />
                            <p class="text-sm font-medium">Data Keluarga tidak ditemukan.</p>
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="flex items-center justify-between px-6 py-4 text-xs text-gray-500 border-t border-gray-100 bg-gray-50/50">
        <p>Menampilkan {{ $families->firstItem() ?? 0 }} sampai {{ $families->lastItem() ?? 0 }} dari {{ $families->total() }} keluarga</p>
        <div class="inline-flex gap-1">
            @if ($families->onFirstPage())
            <button class="px-3 py-1.5 border border-gray-200 rounded bg-white opacity-50 text-gray-600" disabled>
                Sebelumnya
            </button>
            @else
            <a href="{{ $families->previousPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
                Sebelumnya
            </a>
            @endif

            @if ($families->hasMorePages())
            <a href="{{ $families->nextPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
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
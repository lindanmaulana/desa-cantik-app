<div class="overflow-hidden bg-secondary border border-textTertiary/30 shadow-sm rounded-xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wider text-textSecondary uppercase border-b border-textTertiary/20 bg-tertiary/40">
                    <th class="w-16 px-6 py-4 text-center truncate max-md:px-3 max-md:py-2">ID</th>
                    <th class="px-6 py-4 truncate max-md:px-3 max-md:py-2">No Kartu Keluarga (KK)</th>
                    <th class="px-6 py-4 truncate max-md:px-3 max-md:py-2">Wilayah Tinggal</th>
                    <th class="px-6 py-4 truncate max-md:px-3 max-md:py-2">Detail Alamat</th>
                    <th class="px-6 py-4 text-center truncate max-md:px-3 max-md:py-2">Jumlah Anggota</th>
                    <th class="w-32 px-6 py-4 text-center truncate max-md:px-3 max-md:py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-textPrimary divide-y divide-textTertiary/20 max-md:text-xs">
                @if ($families->isNotEmpty())
                    @php $no = $families->firstItem(); @endphp
                    @foreach ($families as $item)
                        <tr class="transition-colors hover:bg-tertiary/30">
                            <td class="px-6 py-4 font-medium text-center text-textSecondary/70 max-md:px-3 max-md:py-2">
                                {{ $no++ }}</td>
                            <td x-show="openData"
                                class="px-6 py-4 font-semibold text-textPrimary max-md:px-3 max-md:py-2">
                                {{ $item->family_card_number }}</td>
                            <td x-show="!openData"
                                class="px-6 py-4 font-semibold text-textPrimary max-md:px-3 max-md:py-2">
                                <x-vaadin-ellipsis-h class="size-5 text-textSecondary/40" /></td>
                            <td class="px-6 py-4 text-textPrimary/90 max-md:px-3 max-md:py-2">
                                @if ($item->territory)
                                    Dusun {{ ucfirst($item->territory->sub_village) }} (RT {{ $item->territory->rt }} /
                                    RW {{ $item->territory->rw }})
                                @else
                                    <span class="text-xs italic text-textSecondary/60">Tidak dikaitkan</span>
                                @endif
                            </td>
                            <td class="max-w-xs px-6 py-4 text-textSecondary truncate max-md:px-3 max-md:py-2">
                                {{ $item->address_detail }}</td>
                            <td class="px-6 py-4 font-medium text-center max-md:px-3 max-md:py-2">
                                {{ $item->citizens->count() }} orang</td>
                            <td class="px-6 py-4 text-center max-md:px-3 max-md:py-2">
                                <div class="flex items-center justify-center gap-2">
                                    <button @click='openModal(@json($item))'
                                        class="p-1.5 text-primary hover:bg-primary/10 rounded-md transition-colors"
                                        title="Edit Data">
                                        <x-heroicon-o-pencil-square class="w-4 h-4" />
                                    </button>
                                    <form action="{{ route('families.destroy', $item->id) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data keluarga ini? Seluruh data warga/penduduk yang terikat dengan KK ini mungkin akan mengalami kendala.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-1.5 text-red-500 hover:bg-red-50 rounded-md transition-colors"
                                            title="Hapus Data">
                                            <x-heroicon-o-trash class="w-4 h-4" />
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="py-10 text-center text-textSecondary">
                            <div class="flex flex-col items-center justify-center gap-2 py-4">
                                <x-heroicon-o-folder-open class="text-textTertiary/60 size-8" />
                                <p class="text-sm font-medium">Data Keluarga tidak ditemukan.</p>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div
        class="flex items-center justify-between px-6 py-4 text-xs text-textSecondary border-t border-textTertiary/20 max-md:px-3 max-md:py-2 bg-tertiary/20">
        <p>Menampilkan {{ $families->firstItem() ?? 0 }} sampai {{ $families->lastItem() ?? 0 }} dari
            {{ $families->total() }} keluarga</p>
        <div class="inline-flex gap-1">
            @if ($families->onFirstPage())
                <button
                    class="px-3 py-1.5 border border-textTertiary/30 rounded bg-secondary opacity-50 text-textSecondary"
                    disabled>
                    Sebelumnya
                </button>
            @else
                <a href="{{ $families->previousPageUrl() }}"
                    class="px-3 py-1.5 border border-textTertiary/40 rounded bg-secondary hover:bg-tertiary text-textPrimary">
                    Sebelumnya
                </a>
            @endif
            @if ($families->hasMorePages())
                <a href="{{ $families->nextPageUrl() }}"
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

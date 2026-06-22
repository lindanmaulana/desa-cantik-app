<div class="overflow-hidden bg-secondary border border-textTertiary/30 shadow-sm rounded-xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wider text-textSecondary uppercase border-b border-textTertiary/20 bg-tertiary/40">
                    <th class="w-16 max-md:px-3 px-6 max-md:py-2 py-4 text-center truncate">ID</th>
                    <th class="max-md:px-3 px-6 max-md:py-2 py-4 truncate">Nama Dusun (`sub_village`)</th>
                    <th class="max-md:px-3 px-6 max-md:py-2 py-4 truncate">Nama Spesifik / Blok (`area_name`)</th>
                    <th class="max-md:px-3 px-6 max-md:py-2 py-4 text-center truncate">RW</th>
                    <th class="max-md:px-3 px-6 max-md:py-2 py-4 text-center truncate">RT</th>
                    <th class="w-32 max-md:px-3 px-6 max-md:py-2 py-4 text-center truncate">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-textPrimary divide-y divide-textTertiary/20">
                @if ($territories->isNotEmpty())

                    <?php $no = 1; ?>
                    @foreach ($territories as $territory)
                        <tr class="transition-colors hover:bg-tertiary/30">
                            <td class="max-md:px-3 px-6 max-md:py-2 py-4 font-medium text-center text-textSecondary/70">
                                {{ $no++ }}</td>
                            <td class="max-md:px-3 px-6 max-md:py-2 py-4 font-semibold text-textPrimary">
                                {{ $territory->sub_village }}</td>
                            <td class="max-md:px-3 px-6 max-md:py-2 py-4 text-textSecondary">{{ $territory->area_name }}
                            </td>
                            <td class="max-md:px-3 px-6 max-md:py-2 py-4 font-medium text-center">{{ $territory->rw }}
                            </td>
                            <td class="max-md:px-3 px-6 max-md:py-2 py-4 font-medium text-center">{{ $territory->rt }}
                            </td>
                            <td class="max-md:px-3 px-6 max-md:py-2 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button @click="openModal($event)" data-territory="{{ json_encode($territory) }}"
                                        class="p-1.5 text-primary hover:bg-primary/10 rounded-md transition-colors"
                                        title="Edit Data">
                                        <x-heroicon-o-pencil-square class="w-4 h-4" />
                                    </button>

                                    <button type="button" @click.stop.prevent="openDeleteModal($event)"
                                        data-url="{{ route('territories.destroy', $territory->id) }}"
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
                        <td colspan="8" class="py-10 text-center text-textSecondary">
                            <div class="flex flex-col items-center justify-center gap-2 py-4">
                                <x-heroicon-o-folder-open class="text-textTertiary/60 size-8" />
                                <p class="text-sm font-medium">Data Wilayah tidak ditemukan.</p>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div
        class="flex items-center justify-between max-md:px-3 px-6 max-md:py-2 py-4 text-xs text-textSecondary border-t border-textTertiary/20 bg-tertiary/20">
        <p>Menampilkan {{ $territories->firstItem() }} sampai {{ $territories->lastItem() }} dari
            {{ $territories->total() }} wilayah</p>
        <div class="inline-flex gap-1">
            @if ($territories->onFirstPage())
                <button
                    class="px-3 py-1.5 border border-textTertiary/30 rounded bg-secondary opacity-50 text-textSecondary"
                    disabled>
                    Sebelumnya
                </button>
            @else
                <a href="{{ $territories->previousPageUrl() }}"
                    class="px-3 py-1.5 border border-textTertiary/40 rounded bg-secondary hover:bg-tertiary text-textPrimary">
                    Sebelumnya
                </a>
            @endif

            @if ($territories->hasMorePages())
                <a href="{{ $territories->nextPageUrl() }}"
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

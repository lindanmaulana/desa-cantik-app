<div class="overflow-hidden bg-secondary border border-textTertiary/30 shadow-sm rounded-xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wider text-textSecondary uppercase border-b border-textTertiary/20 bg-tertiary/40">
                    <th class="w-16 px-6 py-4 text-center truncate max-md:px-3 max-md:py-2">No</th>
                    <th class="px-6 py-4 truncate max-md:px-3 max-md:py-2">NIK</th>
                    <th class="px-6 py-4 truncate max-md:px-3 max-md:py-2">Nama Lengkap</th>
                    <th class="px-6 py-4 truncate max-md:px-3 max-md:py-2">Jenis Kelamin</th>
                    <th class="px-6 py-4 truncate max-md:px-3 max-md:py-2">Hubungan</th>
                    <th class="px-6 py-4 truncate max-md:px-3 max-md:py-2">No. Kartu Keluarga</th>
                    <th class="px-6 py-4 truncate max-md:px-3 max-md:py-2">Status & Agama</th>
                    <th class="w-32 px-6 py-4 text-center truncate max-md:px-3 max-md:py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-textPrimary divide-y divide-textTertiary/20">
                @if ($citizens->isNotEmpty())
                    @php $no = $citizens->firstItem(); @endphp
                    @foreach ($citizens as $item)
                        <tr class="transition-colors hover:bg-tertiary/30">
                            <td class="px-6 py-4 font-medium text-center text-textSecondary/70 max-md:px-3 max-md:py-2">
                                {{ $no++ }}</td>
                            <td class="px-6 py-4 font-semibold text-textPrimary max-md:px-3 max-md:py-2">
                                <span x-show="openData">{{ $item->id_number }}</span>
                                <span x-show="!openData"><x-vaadin-ellipsis-h
                                        class="size-5 text-textSecondary/40" /></span>
                            </td>
                            <td class="px-6 py-4 font-medium text-textPrimary max-md:px-3 max-md:py-2">
                                {{ $item->full_name }}
                                <div class="text-xs text-textSecondary/70">
                                    {{ $item->birth_place }},
                                    {{ $item->birth_date ? \Carbon\Carbon::parse($item->birth_date)->translatedFormat('d F Y') : '-' }}
                                    @if ($item->blood_type)
                                        <span class="ml-1 px-1 bg-tertiary text-textSecondary rounded text-[10px]">Gol:
                                            {{ $item->blood_type }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-textPrimary/90 max-md:px-3 max-md:py-2">
                                @if ($item->gender)
                                    <span
                                        class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full {{ $item->gender->value === 'male' ? 'bg-blue-500/10 text-blue-400' : 'bg-rose-500/10 text-rose-400' }}">
                                        {{ $gender::tryFrom($item->gender->value)?->label() ?? '-' }}
                                    </span>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4 text-textPrimary/90 max-md:px-3 max-md:py-2">
                                {{ $familyRole::tryFrom($item->family_role->value)?->label() ?? '-' }}
                            </td>
                            <td class="px-6 py-4 font-medium text-textPrimary/90 max-md:px-3 max-md:py-2">
                                @if ($item->family)
                                    <span x-show="openData"
                                        class="font-mono text-xs">{{ $item->family->family_card_number }}</span>
                                    <span x-show="!openData"><x-vaadin-ellipsis-h
                                            class="size-4 text-textSecondary/40" /></span>
                                @else
                                    <span class="text-xs italic text-textSecondary/60">Tidak terikat</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-textSecondary max-md:px-3 max-md:py-2">
                                <div class="font-medium text-textPrimary/90">
                                    {{ App\Enums\MaritalStatus::tryFrom($item->marital_status->value)?->label() ?? '-' }}
                                </div>
                                <div>{{ $religion::tryFrom($item->religion->value)?->label() ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 text-center max-md:px-3 max-md:py-2">
                                <div class="flex items-center justify-center gap-2">
                                    <button @click="citizen.openModal($event)" data-profile="{{ json_encode($item) }}"
                                        class="p-1.5 text-primary hover:bg-primary/10 rounded-md transition-colors"
                                        title="Edit Data">
                                        <x-heroicon-o-pencil-square class="w-4 h-4" />
                                    </button>
                                    <a href="{{ route('dashboard.manage-data.citizens.detail', $item) }}"
                                        class="p-1.5 text-primary hover:bg-primary/10 rounded-md transition-colors"
                                        title="Lihat Detail">
                                        <x-heroicon-o-eye class="w-4 h-4" />
                                    </a>
                                    <form action="{{ route('citizens.destroy', $item->id) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data penduduk ini? Data akan disimpan dalam arsip.');">
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
                                <p class="text-sm font-medium">Data Penduduk tidak ditemukan.</p>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div
        class="flex items-center justify-between px-6 py-4 text-xs text-textSecondary border-t border-textTertiary/20 max-md:px-3 max-md:py-2 bg-tertiary/20">
        <p>Menampilkan {{ $citizens->firstItem() ?? 0 }} sampai {{ $citizens->lastItem() ?? 0 }} dari
            {{ $citizens->total() }} penduduk</p>
        <div class="inline-flex gap-1">
            @if ($citizens->onFirstPage())
                <button
                    class="px-3 py-1.5 border border-textTertiary/30 rounded bg-secondary opacity-50 text-textSecondary"
                    disabled>
                    Sebelumnya
                </button>
            @else
                <a href="{{ $citizens->previousPageUrl() }}"
                    class="px-3 py-1.5 border border-textTertiary/40 rounded bg-secondary hover:bg-tertiary text-textPrimary">
                    Sebelumnya
                </a>
            @endif

            @if ($citizens->hasMorePages())
                <a href="{{ $citizens->nextPageUrl() }}"
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

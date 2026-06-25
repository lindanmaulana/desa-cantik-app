<div class="overflow-hidden border shadow-sm bg-secondary border-textTertiary/30 rounded-xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-xs font-semibold tracking-wider uppercase border-b text-textSecondary border-textTertiary/20 bg-tertiary/40">
                    <th class="w-16 px-6 py-4 text-center truncate max-md:px-3 max-md:py-2">No</th>
                    <th class="px-6 py-4 truncate max-md:px-3 max-md:py-2">Username</th>
                    <th class="px-6 py-4 truncate max-md:px-3 max-md:py-2">Nama Lengkap</th>
                    <th class="px-6 py-4 truncate max-md:px-3 max-md:py-2">Peran</th>
                    <th class="px-6 py-4 truncate max-md:px-3 max-md:py-2">Tanggal Dibuat</th>
                    <th class="w-32 px-6 py-4 text-center truncate max-md:px-3 max-md:py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y text-textPrimary divide-textTertiary/20">
                @if ($users->isNotEmpty())
                @php $no = $users->firstItem(); @endphp
                @foreach ($users as $item)
                <tr class="transition-colors hover:bg-tertiary/30">
                    <td class="px-6 py-4 font-medium text-center text-textSecondary/70 max-md:px-3 max-md:py-2">
                        {{ $no++ }}
                    </td>

                    <td class="px-6 py-4 font-semibold text-textPrimary max-md:px-3 max-md:py-2">
                        {{ $item->username }}
                    </td>

                    <td class="px-6 py-4 font-medium text-textPrimary max-md:px-3 max-md:py-2">
                        {{ $item->fullname }}
                    </td>

                    <td class="px-6 py-4 max-md:px-3 max-md:py-2">
                        <span class="inline-flex items-center px-2 py-1 text-xs font-semibold tracking-wider uppercase rounded-full bg-primary/10 text-primary">
                            {{ $item->role }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-xs text-textSecondary max-md:px-3 max-md:py-2">
                        {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y, H:i') : '-' }}
                    </td>

                    <td class="px-6 py-4 text-center max-md:px-3 max-md:py-2">
                        <div class="flex items-center justify-center gap-2">

                            <button @click="openModal({{ json_encode($item) }})"
                                class="p-1.5 text-primary hover:bg-primary/10 rounded-md transition-colors"
                                title="Ubah Akses Admin">
                                <x-heroicon-o-pencil-square class="w-4 h-4" />
                            </button>

                            <form action="{{ route('super-admin.manage-admins.destroy', $item->id) }}" method="POST"
                                class="inline"
                                onsubmit="return confirm('Apakah Anda yakin ingin menonaktifkan akun admin ini?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="p-1.5 text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-md transition-colors"
                                    title="Nonaktifkan Akun">
                                    <x-heroicon-o-trash class="w-4 h-4" />
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="6" class="py-10 text-center text-textSecondary">
                        <div class="flex flex-col items-center justify-center gap-2 py-4">
                            <x-heroicon-o-folder-open class="text-textTertiary/60 size-8" />
                            <p class="text-sm font-medium">Data Admin tidak ditemukan.</p>
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="flex items-center justify-between px-6 py-4 text-xs border-t text-textSecondary border-textTertiary/20 max-md:px-3 max-md:py-2 bg-tertiary/20">
        <p>Menampilkan {{ $users->firstItem() ?? 0 }} sampai {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} admin</p>
        <div class="inline-flex gap-1">
            @if ($users->onFirstPage())
            <button class="px-3 py-1.5 border border-textTertiary/30 rounded bg-secondary opacity-50 text-textSecondary" disabled>
                Sebelumnya
            </button>
            @else
            <a href="{{ $users->previousPageUrl() }}" class="px-3 py-1.5 border border-textTertiary/40 rounded bg-secondary hover:bg-tertiary text-textPrimary">
                Sebelumnya
            </a>
            @endif

            @if ($users->hasMorePages())
            <a href="{{ $users->nextPageUrl() }}" class="px-3 py-1.5 border border-textTertiary/40 rounded bg-secondary hover:bg-tertiary text-textPrimary">
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

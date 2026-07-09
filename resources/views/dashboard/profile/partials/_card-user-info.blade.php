<div class="flex flex-col items-center p-6 text-center border shadow-sm rounded-2xl border-textTertiary/20 bg-secondary">
    <div class="relative flex items-center justify-center w-24 h-24 mb-4 rounded-full shadow-inner select-none text-primary/20 bg-primary/10 border-primary/20">
        <x-iconsax-bol-profile-circle class="size-42" />
    </div>

    <div class="flex flex-col items-center justify-center gap-2">
        <h2 class="text-lg font-bold tracking-tight text-textPrimary">{{ $user->fullname }}</h2>
        <div class="flex items-center gap-1 px-2 py-0.5 rounded-md bg-tertiary text-textSecondary font-mono text-[11px]">
            <x-heroicon-o-at-symbol class="w-3 h-3" />
            {{ $user->username }}
        </div>

        <span class="inline-flex items-center px-3 py-1 text-xs font-semibold tracking-wider text-white uppercase rounded-full shadow-sm bg-primary">
            {{ $user->role?->label() ?? 'Warga' }}
        </span>
    </div>

    <div class="w-full my-5 border-t border-textTertiary/10"></div>

    <div class="w-full space-y-3 text-xs text-left text-textSecondary">
        <div class="flex items-center justify-between py-1 border-b border-textTertiary/5">
            <span>ID Otoritas:</span>
            <span class="font-mono font-medium text-textPrimary text-[10px] bg-tertiary px-1.5 py-0.5 rounded border border-textTertiary/10">
                {{ Str::limit($user->id, 8, '') }}...
            </span>
        </div>
        <div class="flex items-center justify-between py-1 border-b border-textTertiary/5">
            <span>Wilayah Tugas:</span>
            <span class="font-semibold text-textPrimary">
                {{ $user->territory_id ? 'Tersemat' : 'Seluruh Desa' }}
            </span>
        </div>
        <div class="flex items-center justify-between py-1 border-b border-textTertiary/5">
            <span>Status Akun:</span>
            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-medium bg-green-500/10 text-green-600">
                <span class="w-1 h-1 bg-green-500 rounded-full"></span>
                Aktif
            </span>
        </div>
    </div>
</div>

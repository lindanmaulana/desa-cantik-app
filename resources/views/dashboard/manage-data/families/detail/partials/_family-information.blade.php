<article class="p-4 border border-t-8 shadow sm:p-6 lg:p-8 border-textTertiary/20 border-t-primary rounded-2xl sm:rounded-3xl bg-secondary">
    <div class="grid items-stretch grid-cols-1 gap-6 md:grid-cols-4">

        <div class="flex flex-col gap-5 p-6 border bg-secondary/40 border-textTertiary/10 rounded-2xl md:col-span-3">

            <div class="flex flex-col items-start gap-4 sm:flex-row sm:items-center">
                <div class="flex items-center justify-center p-3.5 text-primary border rounded-xl border-primary/20 bg-primary/10 shrink-0 shadow-sm">
                    <x-heroicon-s-home-modern class="w-8 h-8 sm:w-10 sm:h-10" />
                </div>

                <div class="space-y-1">
                    <dt class="text-[10px] font-bold tracking-widest uppercase text-textSecondary">Nomor Kartu Keluarga (KK)</dt>
                    <div class="flex items-center min-h-[32px]">
                        <h4 x-show="openData" class="font-mono text-xl font-bold tracking-wider text-textPrimary md:text-2xl">
                            {{ $family->family_card_number }}
                        </h4>
                        <h4 x-show="!openData" class="inline-flex items-center">
                            <x-vaadin-ellipsis-h class="tracking-widest size-6 text-textTertiary" />
                        </h4>
                    </div>

                    <div class="flex flex-wrap items-center text-xs gap-x-2 text-textSecondary sm:text-sm">
                        <span>Wilayah Tinggal:</span>
                        <span class="font-semibold text-textPrimary">
                            @if ($family->territory)
                            Dusun {{ ucfirst($family->territory->sub_village) }} (RT {{ $family->territory->rt }} / RW {{ $family->territory->rw }})
                            @else
                            <span class="text-xs italic text-textSecondary/50">Tidak dikaitkan</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <dl class="grid grid-cols-1 gap-4 pt-4 border-t border-textTertiary/10 sm:grid-cols-2">
                <div class="p-3 space-y-1 border rounded-xl bg-tertiary/40 border-textTertiary/5">
                    <dt class="text-[10px] font-bold tracking-wider uppercase text-textSecondary flex items-center gap-1.5">
                        <x-heroicon-o-users class="w-3.5 h-3.5 text-textTertiary" /> Jumlah Anggota Keluarga
                    </dt>
                    <dd class="text-sm font-semibold text-textPrimary">
                        {{ $family->citizens->count() }} Orang Terdaftar
                    </dd>
                </div>

                <div class="p-3 space-y-1 border rounded-xl bg-tertiary/40 border-textTertiary/5">
                    <dt class="text-[10px] font-bold tracking-wider uppercase text-textSecondary flex items-center gap-1.5">
                        <x-heroicon-o-map-pin class="w-3.5 h-3.5 text-textTertiary" /> Detail Alamat KK
                    </dt>
                    <dd class="text-sm font-semibold break-words text-textPrimary">
                        {{ $family->address_detail ?? '-' }}
                    </dd>
                </div>
            </dl>
        </div>

        <div class="flex flex-col justify-between gap-4 p-5 border border-textTertiary/10 bg-secondary/40 rounded-2xl md:col-span-1">

            <div class="flex flex-col items-center justify-center h-full p-4 text-center border rounded-xl bg-primary/5 border-primary/10">
                <dt class="text-[10px] font-bold tracking-widest text-textSecondary uppercase">Kepala Keluarga</dt>
                <dd class="text-sm font-extrabold text-primary mt-1.5 truncate max-w-full drop-shadow-sm">
                    {{ $family->citizens->where('family_role.value', 'head_of_family')->first()?->full_name ?? 'Belum Diatur' }}
                </dd>
            </div>

            <div class="pt-2 space-y-3 border-t border-textTertiary/10">
                <div class="space-y-0.5">
                    <dt class="text-[9px] font-bold tracking-wider uppercase text-textSecondary">Dibuat Pada</dt>
                    <dd class="text-xs font-semibold text-textPrimary">
                        {{ $family->created_at ? $family->created_at->translatedFormat('d F Y, H:i') . ' WIB' : '-' }}
                    </dd>
                </div>

                <div class="space-y-1">
                    <dt class="text-[9px] font-bold tracking-wider uppercase text-textSecondary">ID Referensi Keluarga (UUID)</dt>
                    <div class="min-h-[24px] flex items-center">
                        <dd x-show="openData" class="w-full">
                            <code class="text-[10px] font-mono text-textSecondary break-all bg-tertiary px-2 py-1 rounded border border-textTertiary/20 block text-center select-all">
                                {{ $family->id }}
                            </code>
                        </dd>
                        <dd x-show="!openData" class="inline-flex items-center">
                            <x-vaadin-ellipsis-h class="size-4 text-textTertiary" />
                        </dd>
                    </div>
                </div>
            </div>

        </div>
    </div>
</article>

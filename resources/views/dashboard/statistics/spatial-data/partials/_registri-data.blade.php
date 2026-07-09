<div class="flex flex-col border shadow-sm lg:col-span-1 rounded-xl border-textTertiary/10 bg-secondary max-h-[550px] overflow-hidden">
    <div class="p-6 pb-4 border-b border-textTertiary/10">
        <div class="flex items-center justify-between">
            <h3 class="text-sm font-bold tracking-wider uppercase text-textPrimary">Registri Data Spasial</h3>
            <span class="text-[10px] bg-primary/10 text-primary font-mono px-2 py-0.5 rounded font-medium">
                Total: {{ $spatialData->count() ?? 0 }}
            </span>
        </div>
        <p class="text-xs text-textSecondary mt-0.5">Indeks log spasial pemukiman warga, infrastruktur publik, dan klaster niaga desa.</p>
    </div>

    <div class="flex-1 px-6 overflow-y-auto space-y-2.5 custom-scrollbar py-2">
        @forelse($spatialData as $item)
        <div @click="activeId = '{{ $item->id }}'; activeLat = '{{ $item->latitude }}'; activeLng = '{{ $item->longitude }}'; isMapSelected = true"
            class="p-3 transition-all border rounded-lg cursor-pointer bg-tertiary group"
            :class="activeId == '{{ $item->id }}' && isMapSelected
            ? 'border-primary bg-primary/5 ring-1 ring-primary/30'
            : 'border-textTertiary/10 hover:bg-secondary hover:border-primary/50'">
            <div class="flex items-start justify-between gap-2">
                <div class="space-y-1">
                    @if($item->feature_type === $featureType::RESIDENT_HOUSE)
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-semibold tracking-wide text-amber-600 bg-amber-500/10 px-2 py-0.5 rounded">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Rumah Warga
                    </span>
                    <h4 class="mt-1 text-xs font-bold transition-colors text-textPrimary group-hover:text-primary">
                        Rumah {{ $item->citizen->full_name ?? ($item->family->family_card_number ?? 'Keluarga Terdata') }}
                    </h4>

                    @elseif($item->feature_type === $featureType::PUBLIC_FACILITY)
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-semibold tracking-wide text-sky-600 bg-sky-500/10 px-2 py-0.5 rounded">
                        <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>Fasilitas Umum
                    </span>
                    <h4 class="mt-1 text-xs font-bold transition-colors text-textPrimary group-hover:text-primary">
                        {{ $item->infrastructure->facility_name ?? 'Fasilitas Umum Terdata' }}
                    </h4>

                    @elseif($item->feature_type === $featureType::MSME_LOCATION)
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-semibold tracking-wide text-rose-600 bg-rose-500/10 px-2 py-0.5 rounded">
                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>Lapak UMKM
                    </span>
                    <h4 class="mt-1 text-xs font-bold transition-colors text-textPrimary group-hover:text-primary">
                        {{ $item->msme->business_name ?? 'Unit Usaha Terdata' }}
                    </h4>

                    @else
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-semibold tracking-wide text-emerald-600 bg-emerald-500/10 px-2 py-0.5 rounded">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Batas Wilayah
                    </span>
                    <h4 class="mt-1 text-xs font-bold transition-colors text-textPrimary group-hover:text-primary">
                        {{ $item->name ?? 'Batas Wilayah Terdata' }}
                    </h4>
                    @endif
                </div>

                <button class="p-1 transition-colors rounded text-textSecondary hover:text-primary hover:bg-tertiary" title="Fokuskan Peta">
                    <x-ri-focus-3-line class="size-3.5" />
                </button>
            </div>

            <div class="mt-2.5 pt-2 border-t border-textTertiary/5 flex items-center justify-between font-mono text-[10px] text-textSecondary">
                <span class="flex items-center gap-1">
                    <span class="text-textTertiary">LAT:</span>{{ number_format($item->latitude, 6) }}
                </span>
                <span class="flex items-center gap-1">
                    <span class="text-textTertiary">LONG:</span>{{ number_format($item->longitude, 6) }}
                </span>
            </div>
        </div>
        @empty
        <div class="p-6 text-center border border-dashed rounded-lg border-textTertiary/20">
            <p class="text-xs text-textSecondary">Belum ada registri data spasial terdata.</p>
        </div>
        @endforelse
    </div>

    @if($spatialData->hasPages())
    <div class="flex items-center justify-between px-6 py-4 text-xs border-t text-textSecondary border-textTertiary/20 max-md:px-3 max-md:py-2 bg-tertiary/20">
        <p>Menampilkan {{ $spatialData->firstItem() ?? 0 }} - {{ $spatialData->lastItem() ?? 0 }} dari {{ $spatialData->total() }} Data Spasial</p>

        <div class="inline-flex gap-1">
            @if ($spatialData->onFirstPage())
            <button class="px-3 py-1.5 border border-textTertiary/30 rounded bg-secondary opacity-50 text-textSecondary" disabled>
                Sebelumnya
            </button>
            @else
            <a href="{{ $spatialData->appends(request()->query())->previousPageUrl() }}" class="px-3 py-1.5 border border-textTertiary/40 rounded bg-secondary hover:bg-tertiary text-textPrimary">
                Sebelumnya
            </a>
            @endif

            @if ($spatialData->hasMorePages())
            <a href="{{ $spatialData->appends(request()->query())->nextPageUrl() }}" class="px-3 py-1.5 border border-textTertiary/40 rounded bg-secondary hover:bg-tertiary text-textPrimary">
                Selanjutnya
            </a>
            @else
            <button class="px-3 py-1.5 border border-textTertiary/30 rounded bg-secondary opacity-50 text-textSecondary" disabled>
                Selanjutnya
            </button>
            @endif
        </div>
    </div>
    @endif
</div>

<div class="flex flex-col p-6 border shadow-sm lg:col-span-2 rounded-xl border-textTertiary/10 bg-secondary h-[550px]">
    <div class="flex items-center justify-between pb-4 mb-4 border-b border-textTertiary/10">
        <div>
            <h3 class="text-sm font-bold tracking-wider uppercase text-textPrimary">Geoportal Engine Preview</h3>
            <p class="text-xs text-textSecondary mt-0.5">Sistem Informasi Geografis Terintegrasi {{ $settings->village_name ?? '-' }}.</p>
        </div>

        <div class="hidden sm:flex items-center gap-2 px-3 py-1 border border-textTertiary/20 rounded bg-tertiary font-mono text-[10px] text-textSecondary">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span class="font-medium" x-text="'LOC: ' + parseFloat(activeLat).toFixed(4) + ', ' + parseFloat(activeLng).toFixed(4)"></span>
        </div>
    </div>

    <div class="relative flex flex-col items-center justify-center flex-1 w-full overflow-hidden border rounded-lg border-textTertiary/20 bg-tertiary">
        <div x-show="!isMapSelected" class="z-10 max-w-sm p-6 space-y-4 text-center border shadow-md bg-secondary/95 border-textTertiary/10 rounded-xl">
            <div class="inline-flex p-2.5 rounded bg-primary/10 text-primary">
                <x-ri-global-line class="size-5" />
            </div>
            <div class="space-y-1.5">
                <h4 class="text-xs font-bold tracking-wider uppercase text-textPrimary">Interface Integrasi GIS</h4>
                <p class="text-xs leading-relaxed text-textSecondary">
                    Silahkan pilih salah satu entitas registri data spasial di panel sebelah kiri untuk memplot marka lokasi secara presisi di atas peta.
                </p>
            </div>
        </div>

        <template x-if="isMapSelected">
            <iframe
                :src="`https://maps.google.com/maps?q=${activeLat},${activeLng}&z=17&output=embed`"
                class="absolute inset-0 z-10 w-full h-full transition-opacity duration-300 border-0 opacity-90 hover:opacity-100"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </template>

        <div class="absolute inset-0 opacity-15 bg-[linear-gradient(to_right,#cbd5e1_1px,transparent_1px),linear-gradient(to_bottom,#cbd5e1_1px,transparent_1px)] bg-[size:40px_40px]"></div>

        <div class="absolute bottom-4 right-4 p-3.5 border shadow-md rounded border-textTertiary/10 bg-secondary text-left text-[10px] space-y-2 z-20 min-w-[150px]">
            <span class="block pb-1 mb-1 font-bold tracking-wider uppercase border-b text-textPrimary border-textTertiary/10">Layer Legend</span>
            <div class="flex items-center gap-2.5 text-textSecondary">
                <span class="w-2.5 h-2.5 rounded bg-amber-500 block"></span>
                <span>Sektor Pemukiman</span>
            </div>
            <div class="flex items-center gap-2.5 text-textSecondary">
                <span class="w-2.5 h-2.5 rounded bg-sky-500 block"></span>
                <span>Infrastruktur / Fasum</span>
            </div>
            <div class="flex items-center gap-2.5 text-textSecondary">
                <span class="w-2.5 h-2.5 rounded bg-rose-500 block"></span>
                <span>Klaster Niaga UMKM</span>
            </div>
        </div>
    </div>
</div>

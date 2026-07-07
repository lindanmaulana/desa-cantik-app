<div class="grid grid-cols-1 gap-5 py-8 sm:grid-cols-2 lg:grid-cols-4">
    <div class="relative flex items-center gap-4 p-6 transition-all duration-300 border shadow-sm group bg-secondary rounded-2xl border-tertiary hover:shadow-md hover:border-primary/50">
        <div class="p-3 transition-transform bg-primary/10 text-primary rounded-xl group-hover:scale-105">
            <x-heroicon-o-users class="w-6 h-6" />
        </div>
        <div>
            <span class="block text-xs font-bold tracking-wider uppercase text-textSecondary">Total Penduduk</span>
            <span class="block text-2xl font-extrabold tracking-tight sm:text-3xl text-textPrimary mt-0.5">{{ $stats['totalCitizens'] ?? '-' }}</span>
        </div>
    </div>

    <div class="relative flex items-center gap-4 p-6 transition-all duration-300 border shadow-sm group bg-secondary rounded-2xl border-tertiary hover:shadow-md hover:border-emerald-500/50">
        <div class="p-3 transition-transform bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-xl group-hover:scale-105">
            <x-heroicon-o-home class="w-6 h-6" />
        </div>
        <div>
            <span class="block text-xs font-bold tracking-wider uppercase text-textSecondary">Kepala Keluarga</span>
            <span class="block text-2xl font-extrabold tracking-tight sm:text-3xl text-textPrimary mt-0.5">{{ $stats['totalHeadOfFamily'] ?? '-' }}</span>
        </div>
    </div>

    <div class="relative flex items-center gap-4 p-6 transition-all duration-300 border shadow-sm group bg-secondary rounded-2xl border-tertiary hover:shadow-md hover:border-amber-500/50">
        <div class="p-3 transition-transform bg-amber-500/10 text-amber-600 dark:text-amber-400 rounded-xl group-hover:scale-105">
            <x-bi-building class="w-6 h-6" />
        </div>
        <div>
            <span class="block text-xs font-bold tracking-wider uppercase text-textSecondary">Unit Perumahan</span>
            <span class="block text-2xl font-extrabold tracking-tight sm:text-3xl text-textPrimary mt-0.5">{{ $stats['totalHouses'] ?? '-' }}</span>
        </div>
    </div>

    <div class="relative flex items-center gap-4 p-6 transition-all duration-300 border shadow-sm group bg-secondary rounded-2xl border-tertiary hover:shadow-md hover:border-cyan-500/50">
        <div class="p-3 transition-transform bg-cyan-500/10 text-cyan-600 dark:text-cyan-400 rounded-xl group-hover:scale-105">
            <x-heroicon-o-map class="w-6 h-6" />
        </div>
        <div>
            <span class="block text-xs font-bold tracking-wider uppercase text-textSecondary">Dusun Terdata</span>
            <span class="block text-2xl font-extrabold tracking-tight sm:text-3xl text-textPrimary mt-0.5">{{ $stats['totalHamles'] ?? '-' }}</span>
        </div>
    </div>
</div>

<div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
    <div>
        <h1 class="flex items-center gap-2 text-2xl font-bold max-md:text-lg text-textPrimary">
            <x-heroicon-o-map-pin class="w-6 h-6 text-primary" />
            Kelola Data Wilayah (Territories)
        </h1>
        <p class="mt-1 text-sm max-md:text-xs text-textSecondary">Manajemen data master Dusun, RW, dan RT untuk
            basis data warga.</p>
    </div>

    <div class="flex items-center gap-2">
        <button @click="openCreate = true"
            class="inline-flex items-center px-4 py-2 text-sm font-medium transition-colors rounded-lg shadow-sm text-secondary bg-primary hover:opacity-90">
            <x-heroicon-o-plus class="w-4 h-4 mr-2 max-lg:mr-0" />
            <span class="max-lg:hidden">Tambah Wilayah Baru</span>
        </button>
    </div>
</div>
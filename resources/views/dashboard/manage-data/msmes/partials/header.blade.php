<div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
    <div class="max-w-2xl">
        <h2 class="flex items-center gap-2 text-2xl max-lg:text-xl max-md:text-lg font-bold text-textPrimary">
            <x-bi-shop class="w-6 h-6 text-primary" />
            Kelola Sektor Produktif Ekonomi (UMKM / MSMEs)
        </h2>
        <p class="mt-1 text-sm max-md:text-xs text-textSecondary">Pemetaan dan pendataan kepemilikan usaha mikro, jumlah
            tenaga kerja lokal, serta estimasi omset bulanan warga desa.</p>
    </div>

    <div class="flex items-center gap-2">
        <button @click="openData = !openData"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-secondary transition-colors bg-textSecondary hover:opacity-90 rounded-lg shadow-sm">
            <span class="flex items-center" x-show="openData">
                <x-heroicon-o-eye class="w-4 h-4 mr-2 max-xl:mr-0" />
                <span class="max-xl:hidden">Sembunyikan Data Sensitif</span>
            </span>
            <span class="flex items-center" x-show="!openData">
                <x-heroicon-o-eye-slash class="w-4 h-4 mr-2 max-xl:mr-0" />
                <span class="max-xl:hidden">Tampilkan Data Sensitif</span>
            </span>
        </button>

        <button @click="openCreate = true"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-secondary transition-colors bg-primary rounded-lg shadow-sm hover:opacity-90">
            <x-heroicon-o-plus class="w-4 h-4 mr-2 max-xl:mr-0" />
            <span class="max-xl:hidden">Tambah UMKM Baru</span>
        </button>
    </div>
</div>

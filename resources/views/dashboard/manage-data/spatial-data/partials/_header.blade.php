<div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
    <div class="max-w-2xl">
        <h2 class="flex items-center gap-2 text-2xl max-md:text-lg font-bold text-gray-800">
            <x-iconsax-lin-map class="w-6 h-6 text-primary" />
            Manajemen Pemetaan Koordinat Spasial Geografis (GIS)
        </h2>
        <p class="mt-1 text-sm max-md:text-xs text-gray-500">Pemetaan koordinat digital desa terintegrasi. Menghubungkan titik lokasi
            rumah warga, fasilitas prasarana publik, dan titik UMKM.</p>
    </div>

    <button @click="openCreate = true"
        class="inline-flex items-center px-4 py-2 text-sm font-medium transition-colors rounded-lg shadow-sm text-secondary bg-primary hover:opacity-90">
        <x-heroicon-o-plus class="w-4 h-4 mr-2 max-xl:mr-0" />
        <span class="max-xl:hidden">Tambah Koordinat Baru</span>
    </button>
</div>

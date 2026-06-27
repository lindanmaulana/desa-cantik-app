<div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
    <div class="max-w-2xl">
        <h2 class="flex items-center gap-2 text-2xl max-md:text-lg font-bold text-textPrimary">
            <x-iconsax-lin-buildings class="w-6 h-6 text-primary" />
            Manajemen Logistik & Aset Fisik Desa (Infrastructures)
        </h2>
        <p class="mt-1 text-sm max-md:text-xs text-textSecondary">Pemetaan sarana umum, pencatatan status kelayakan infrastruktur fisik desa,
            tahun konstruksi, dan alokasi anggaran.</p>
    </div>

    <div class="flex items-center gap-2">
        <button @click="openData = !openData"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-secondary transition-colors bg-textSecondary hover:opacity-90 rounded-lg shadow-sm">
            <x-heroicon-o-eye class="w-4 h-4 mr-2 max-lg:mr-0" x-show="openData" />
            <x-heroicon-o-eye-slash class="w-4 h-4 mr-2 max-lg:mr-0" x-show="!openData" />
            <span x-show="openData" class="max-lg:hidden">Sembunyikan Data Anggaran</span>
            <span x-show="!openData" class="max-lg:hidden">Tampilkan Data Anggaran</span>
        </button>

        <button @click="openCreate = true"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-secondary transition-colors bg-primary rounded-lg shadow-sm hover:opacity-90">
            <x-heroicon-o-plus class="w-4 h-4 mr-2 max-lg:mr-0" />
            <span class="max-lg:hidden">Tambah Keluarga Baru</span>
        </button>
    </div>
</div>

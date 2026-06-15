<div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
    <div>
        <h1 class="flex items-center gap-2 text-2xl font-bold text-gray-800 max-md:text-lg">
            <x-heroicon-o-users class="w-6 h-6 text-teal-600" />
            Kelola Data Keluarga (Families)
        </h1>
        <p class="mt-1 text-sm text-gray-500 max-md:text-xs">Manajemen data nomor Kartu Keluarga (KK) dan wilayah tinggal warga desa.</p>
    </div>

    <div class="flex items-center gap-2">
        <button @click="openData = !openData" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700">
            <x-heroicon-o-eye class="w-4 h-4 mr-2 max-lg:mr-0" x-show="openData" />
            <x-heroicon-o-eye-slash class="w-4 h-4 mr-2 max-lg:mr-0" x-show="!openData" />
            <span x-show="openData" class="max-lg:hidden">Sembunyikan Data Sensitif</span>
            <span x-show="!openData" class="max-lg:hidden">Tampilkan Data Sensitif</span>
        </button>

        <button @click="openCreate = true" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700">
            <x-heroicon-o-plus class="w-4 h-4 mr-2 max-lg:mr-0" />
            <span class="max-lg:hidden">Tambah Keluarga Baru</span>
        </button>
    </div>
</div>
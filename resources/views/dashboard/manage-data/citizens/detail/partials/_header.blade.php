<div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
    <div>
        <h2 class="flex items-center gap-2 text-2xl font-bold max-lg:text-xl max-md:text-lg text-textPrimary">
            <x-heroicon-o-identification class="w-6 h-6 text-primary" />
            Detail Penduduk {{ $citizen->full_name ?? '-' }}
        </h2>
        <p class="mt-1 text-sm max-md:text-xs text-textSecondary">
            Manajemen data demografi warga desa, NIK, peran keluarga, dan status kependudukan.
        </p>
    </div>

    <div class="flex items-center gap-2">
        <button @click="openData = !openData"
            class="inline-flex items-center px-4 py-2 text-sm font-medium transition-colors rounded-lg shadow-sm text-secondary bg-primary hover:opacity-90">
            <span class="flex items-center" x-show="openData">
                <x-heroicon-o-eye class="w-4 h-4 mr-2 max-xl:mr-0" />
                <span class="max-xl:hidden">Sembunyikan Data Sensitif</span>
            </span>
            <span class="flex items-center" x-show="!openData">
                <x-heroicon-o-eye-slash class="w-4 h-4 mr-2 max-xl:mr-0" />
                <span class="max-xl:hidden">Tampilkan Data Sensitif</span>
            </span>
        </button>
        <a href="{{ route('dashboard.manage-data.citizens') }}"
            class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium transition-colors rounded-lg shadow-sm text-secondary bg-primary hover:opacity-90">
            <x-iconsax-lin-arrow-left class="mr-2 size-4 max-xl:mr-0" />
            <span class="max-xl:hidden">Kembali ke Daftar Penduduk</span>
        </a>
    </div>
</div>
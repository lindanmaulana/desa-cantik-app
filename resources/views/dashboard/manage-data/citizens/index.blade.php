<x-layouts.dashboard>
    <div class="p-6 max-md:p-3" x-data="citizenData()">

        <div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
            <div>
                <h1 class="flex items-center gap-2 text-2xl max-md:text-lg font-bold text-gray-800">
                    <x-heroicon-o-identification class="w-6 h-6 text-teal-600" />
                    Kelola Data Penduduk (Citizens)
                </h1>
                <p class="mt-1 text-sm max-md:text-xs text-gray-500">Manajemen data demografi warga desa, NIK, peran
                    keluarga, dan status kependudukan.</p>
            </div>

            <div class="flex items-center gap-2">
                <button @click="openData = !openData"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700">
                    <span class="flex items-center" x-show="openData">
                        <x-heroicon-o-eye class="w-4 h-4 mr-2 max-xl:mr-0" />
                        <span class="max-xl:hidden">Sembunyikan Data Sensitif</span>
                    </span>
                    <span class="flex items-center" x-show="!openData">
                        <x-heroicon-o-eye-slash class="w-4 h-4 mr-2 max-xl:mr-0" />
                        <span class="max-xl:hidden">Tampilkan Data Sensitif</span>
                    </span>
                </button>

                <button @click="citizen.openCreate = true"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700">
                    <x-heroicon-o-plus class="w-4 h-4 mr-2 max-xl:mr-0" />
                    <span class="max-xl:hidden">Tambah Penduduk Baru</span>
                </button>
            </div>
        </div>

        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        @include('dashboard.manage-data.citizens.partials.modal.citizen-create')
        @include('dashboard.manage-data.citizens.partials.modal.citizen-update')

        @include('dashboard.manage-data.citizens.partials.stats')
        @include('dashboard.manage-data.citizens.partials.filter')
        @include('dashboard.manage-data.citizens.partials.table')
    </div>
</x-layouts.dashboard>

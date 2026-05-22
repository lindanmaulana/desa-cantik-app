@php
$featureType = App\Enums\FeatureType::class;
@endphp

<x-layouts.dashboard>
    <div class="p-6 bg-gray-50" x-data="spatialData()">

        <div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
            <div class="max-w-2xl">
                <h2 class="flex items-center gap-2 text-2xl font-bold text-gray-800">
                    <x-iconsax-lin-map class="w-6 h-6 text-emerald-600" />
                    Manajemen Pemetaan Koordinat Spasial Geografis (GIS)
                </h2>
                <p class="mt-1 text-sm text-gray-500">Pemetaan koordinat digital desa terintegrasi. Menghubungkan titik lokasi rumah warga, fasilitas prasarana publik, dan titik UMKM.</p>
            </div>

            <button @click="openCreate = true" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg shadow-sm bg-emerald-600 hover:bg-emerald-700">
                <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                Tambah Koordinat Baru
            </button>
        </div>

        @if(session('success'))
        <x-alert type="success" :message="session('success')" />
        @endif

        @if(session('error'))
        <x-alert type="error" :message="session('error')" />
        @endif


        @include('dashboard.manage-data.spatial-data.partials.modal.create')
        @include('dashboard.manage-data.spatial-data.partials.modal.update')

        @include('dashboard.manage-data.spatial-data.partials.stats')
        @include('dashboard.manage-data.spatial-data.partials.filter')
        @include('dashboard.manage-data.spatial-data.partials.table')
    </div>
</x-layouts.dashboard>

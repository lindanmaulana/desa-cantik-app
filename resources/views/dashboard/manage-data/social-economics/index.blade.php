@php
$houseCondition = App\Enums\HouseCondition::cases();
$educationLevel = App\Enums\EducationLevel::cases();
$economicStatus = App\Enums\EconomicStatus::cases();
@endphp


<x-layouts.dashboard>
    <div class="p-6 bg-gray-50" x-data="socialEconomyData()">
        <div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
            <div>
                <h1 class="flex items-center gap-2 text-2xl font-bold text-gray-800">
                    <x-ri-heart-pulse-line class="w-6 h-6 text-emerald-600" />
                    Kelola Profil Sosial Ekonomi (Social Economics)
                </h1>
                <p class="mt-1 text-sm text-gray-500">Analisis profil kesejahteraan, bantuan pemerintah (bansos), kelayakan hunian, dan klasifikasi ekonomi warga desa.</p>
            </div>

            <div class="flex items-center gap-2">
                <button @click="openData = !openData" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg shadow-sm bg-emerald-600 hover:bg-emerald-700">
                    <span class="flex items-center" x-show="openData">
                        <x-heroicon-o-eye class="w-4 h-4 mr-2" />
                        Sembunyikan Data Sensitif
                    </span>
                    <span class="flex items-center" x-show="!openData">
                        <x-heroicon-o-eye-slash class="w-4 h-4 mr-2" />
                        Tampilkan Data Sensitif
                    </span>
                </button>

                <button @click="openCreate = true" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg shadow-sm bg-emerald-600 hover:bg-emerald-700">
                    <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                    Tambah Profil Baru
                </button>
            </div>
        </div>

        @if(session('success'))
        <x-alert type="success" :message="session('success')" />
        @endif

        @if(session('error'))
        <x-alert type="error" :message="session('error')" />
        @endif

        @include('dashboard.manage-data.social-economics.partials.modal.create')
        @include('dashboard.manage-data.social-economics.partials.modal.update')

        @include('dashboard.manage-data.social-economics.partials.stats')
        @include('dashboard.manage-data.social-economics.partials.filter')
        @include('dashboard.manage-data.social-economics.partials.table')
    </div>
</x-layouts.dashboard>

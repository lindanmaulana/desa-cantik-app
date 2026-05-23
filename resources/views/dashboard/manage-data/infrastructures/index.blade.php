    @php
        $conditionInfrastructure = App\Enums\ConditionInfrastructure::class;
        $facilityType = App\Enums\FacilityType::class;
    @endphp



    <x-layouts.dashboard>
        <div class="p-6 bg-gray-50" x-data="infrastructureData()">
            <div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
                <div class="max-w-2xl">
                    <h2 class="flex items-center gap-2 text-2xl font-bold text-gray-800">
                        <x-iconsax-lin-buildings class="w-6 h-6 text-emerald-600" />
                        Manajemen Logistik & Aset Fisik Desa (Infrastructures)
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">Pemetaan sarana umum, pencatatan status kelayakan infrastruktur fisik desa, tahun konstruksi, dan alokasi anggaran.</p>
                </div>

                <div class="flex items-center gap-2">
                    <button @click="openData = !openData" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg shadow-sm bg-primary hover:bg-secondary">
                        <span class="flex items-center" x-show="openData">
                            <x-heroicon-o-eye class="w-4 h-4 mr-2" />
                            Sembunyikan Data Anggaran
                        </span>
                        <span class="flex items-center" x-show="!openData">
                            <x-heroicon-o-eye-slash class="w-4 h-4 mr-2" />
                            Tampilkan Data Anggaran
                        </span>
                    </button>

                    <button @click="openCreate = true" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg shadow-sm bg-primary hover:bg-secondary">
                        <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                        Tambah Aset Baru
                    </button>
                </div>
            </div>

            @if(session('success'))
            <x-alert type="success" :message="session('success')" />
            @endif

            @if(session('error'))
            <x-alert type="error" :message="session('error')" />
            @endif

            @include('dashboard.manage-data.infrastructures.partials.modal.create')
            @include('dashboard.manage-data.infrastructures.partials.modal.update')

            @include('dashboard.manage-data.infrastructures.partials.stats')
            @include('dashboard.manage-data.infrastructures.partials.filter')
            @include('dashboard.manage-data.infrastructures.partials.table')
        </div>
    </x-layouts.dashboard>

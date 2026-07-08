<x-layouts.dashboard>
    <div class="p-6 space-y-2 max-md:p-3" x-data="citizenData()">
        @include('dashboard.manage-data.citizens.detail.partials._header')
        @include('dashboard.manage-data.citizens.detail.partials._alert')

        @include('dashboard.manage-data.citizens.detail.modals._health-profile-create')
        @include('dashboard.manage-data.citizens.detail.modals._health-profile-update')

        @include('dashboard.manage-data.citizens.detail.modals._education-profile-create')
        @include('dashboard.manage-data.citizens.detail.modals._education-profile-update')

        @include('dashboard.manage-data.citizens.detail.modals._employment-profile-create')
        @include('dashboard.manage-data.citizens.detail.modals._employment-profile-update')

        @include('dashboard.manage-data.citizens.detail.modals._child-growth-log-create')
        @include('dashboard.manage-data.citizens.detail.modals._child-growth-log-detail')

        <div class="flex flex-col gap-6">
            @include('dashboard.manage-data.citizens.detail.partials._citizen-information')

            <div class="flex flex-col gap-4">
                <x-citizen-profile-card title="Profile Pekerjaan & Status Ekonomi" class="w-full"
                    icon="solar-square-academic-cap-2-broken" color="text-amber-500" :isValue="$citizen->employmentProfile">
                    @include('dashboard.manage-data.citizens.detail.profiles._employment-profile')
                </x-citizen-profile-card>

                <div class="grid items-stretch grid-cols-1 gap-4 lg:grid-cols-2">
                    <x-citizen-profile-card title="Profile Kesehatan Individu" class="w-full" icon="iconsax-out-heart"
                        color="text-primary" :isValue="$citizen->healthProfile">
                        @include('dashboard.manage-data.citizens.detail.profiles._health-profile')
                    </x-citizen-profile-card>

                    <x-citizen-profile-card title="Profile Kualifikasi Pendidikan" class="w-full"
                        icon="solar-square-academic-cap-2-broken" color="text-blue-500" :isValue="$citizen->educationProfile">
                        @include('dashboard.manage-data.citizens.detail.profiles._education-profile')
                    </x-citizen-profile-card>
                </div>

                <x-citizen-profile-card type="childGrowthLogs" title="Log Timbangan & Diagnosa Stunting" class="w-full"
                    icon="heroicon-o-chart-bar" color="text-emerald-500" :isValue="$citizen->childGrowthLogs">
                    @include('dashboard.manage-data.citizens.detail.profiles._childGrowthLogs-profile')
                </x-citizen-profile-card>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
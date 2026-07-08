<x-layouts.dashboard>
    <div class="p-6 space-y-2 max-md:p-3" x-data="familyData()">

        @include('dashboard.manage-data.families.detail.partials._header')

        @if (session('success'))
        <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
        <x-alert type="error" :message="session('error')" />
        @endif

        @include('dashboard.manage-data.families.detail.modals._housing-profile-create')
        @include('dashboard.manage-data.families.detail.modals._housing-profile-update')

        <div class="flex flex-col gap-6">
            @include('dashboard.manage-data.families.detail.partials._family-information')
            @include('dashboard.manage-data.families.detail.partials._family-members')

            <div class="flex flex-col gap-4">
                <x-citizen-profile-card
                    type="housingProfile"
                    title="Profil Rumah Tinggal, Sanitasi & Akses Energi"
                    class="w-full"
                    icon="heroicon-o-home-modern"
                    color="text-blue-500"
                    :isValue="$family->housingProfile">

                    @include('dashboard.manage-data.families.detail.profiles._housing-profile')

                </x-citizen-profile-card>
            </div>
        </div>
    </div>
</x-layouts.dashboard>

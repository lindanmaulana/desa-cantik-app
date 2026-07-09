<x-layouts.dashboard>
    <div class="p-6 space-y-6" x-data="profileData()">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-textPrimary">Pengaturan Profil</h2>
                <p class="text-sm text-textSecondary">Kelola informasi kredensial akun dan otoritas wilayah Anda.</p>
            </div>
        </div>

        @include('dashboard.profile.partials._alert')

        @include('dashboard.profile.modals._profile-update')
        @include('dashboard.profile.modals._profile-update-password')

        <div class="grid items-start grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="space-y-6">
                @include('dashboard.profile.partials._card-user-info')
                @include('dashboard.profile.partials._card-system-log')
            </div>

            <div class="lg:col-span-2">
                @include('dashboard.profile.partials._card-credentials')
            </div>
        </div>
    </div>
</x-layouts.dashboard>

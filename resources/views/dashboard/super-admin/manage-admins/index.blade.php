<x-layouts.dashboard>
    <div class="p-6 max-md:p-3" x-data="manageAdminData()">
        <!-- Header -->
        @include('dashboard.super-admin.manage-admins.partials._header')

        @if (session('success'))
        <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
        <x-alert type="error" :message="session('error')" />
        @endif

        @include('dashboard.super-admin.manage-admins.partials._admin-create')
        @include('dashboard.super-admin.manage-admins.partials._admin-update')
        <!-- Modal Update -->

        <!-- Stats -->
        <!-- Filter -->
        <!-- Table -->
        @include('dashboard.super-admin.manage-admins.partials._table')
    </div>
</x-layouts.dashboard>

<x-layouts.dashboard>
    <div class="p-6 max-md:p-3" x-data="manageAdminData()">
        @include('dashboard.admin.manage-operators.partials._header')

        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        @include('dashboard.admin.manage-operators.partials._admin-create')
        @include('dashboard.admin.manage-operators.partials._admin-update')
        @include('dashboard.admin.manage-operators.partials._admin-delete')
        @include('dashboard.admin.manage-operators.partials._table')
    </div>
</x-layouts.dashboard>

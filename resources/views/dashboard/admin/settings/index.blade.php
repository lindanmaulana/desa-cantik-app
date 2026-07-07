<x-layouts.dashboard>
    <div class="max-w-5xl px-4 py-8 mx-auto sm:px-6 lg:px-8" x-data="{ isEdit: {{ $settings ? 'true' : 'false' }} }">

        @include('dashboard.admin.settings.partials._header')
        @include('dashboard.admin.settings.partials._alerts')
        @include('dashboard.admin.settings.partials._form-village-data')

        <template x-if="isEdit">
            <div class="pt-10 mt-12 space-y-10 border-t border-gray-200">
                @include('dashboard.admin.settings.partials._form-village-logo')
                @include('dashboard.admin.settings.partials._form-village-banner')
            </div>
        </template>

    </div>
</x-layouts.dashboard>

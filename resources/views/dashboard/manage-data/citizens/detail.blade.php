<x-layouts.dashboard>
    <div class="p-6 space-y-2 max-md:p-3" x-data="citizenData()">

        <!-- Header Section -->
        <div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
            <div>
                <h2 class="flex items-center gap-2 text-2xl font-bold max-lg:text-xl max-md:text-lg text-textPrimary">
                    <x-heroicon-o-identification class="w-6 h-6 text-primary" />
                    Detail Penduduk {{ $citizen->full_name ?? '-' }}
                </h2>
                <p class="mt-1 text-sm max-md:text-xs text-textSecondary">
                    Manajemen data demografi warga desa, NIK, peran keluarga, dan status kependudukan.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-2">
                <button @click="openData = !openData"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium transition-colors rounded-lg shadow-sm text-secondary bg-primary hover:opacity-90">
                    <span class="flex items-center" x-show="openData">
                        <x-heroicon-o-eye class="w-4 h-4 mr-2 max-xl:mr-0" />
                        <span class="max-xl:hidden">Sembunyikan Data Sensitif</span>
                    </span>
                    <span class="flex items-center" x-show="!openData">
                        <x-heroicon-o-eye-slash class="w-4 h-4 mr-2 max-xl:mr-0" />
                        <span class="max-xl:hidden">Tampilkan Data Sensitif</span>
                    </span>
                </button>
                <a href="{{ route('dashboard.manage-data.citizens') }}"
                    class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium transition-colors rounded-lg shadow-sm text-secondary bg-primary hover:opacity-90">
                    <x-iconsax-lin-arrow-left class="mr-2 size-4 max-xl:mr-0" />
                    <span class="max-xl:hidden">Kembali ke Daftar Penduduk</span>
                </a>
            </div>
        </div>

        @if (session('success'))
        <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
        <x-alert type="error" :message="session('error')" />
        @endif

        @include('dashboard.manage-data.citizens.partials.modal._health-profile-create')
        @include('dashboard.manage-data.citizens.partials.modal._health-profile-update')

        @include('dashboard.manage-data.citizens.partials.modal._education-profile-create')
        @include('dashboard.manage-data.citizens.partials.modal._education-profile-update')

        @include('dashboard.manage-data.citizens.partials.modal._employment-profile-create')
        @include('dashboard.manage-data.citizens.partials.modal._employment-profile-update')

        @include('dashboard.manage-data.citizens.partials.modal._child-growth-log-create')
        @include('dashboard.manage-data.citizens.partials.modal._child-growth-log-detail')

        <!-- Main Content Area -->
        <div class="flex flex-col gap-6">
            <article class="overflow-hidden bg-white border shadow-sm border-slate-200 rounded-xl">
                <div class="h-1.5 bg-indigo-600"></div>

                <div class="p-6 sm:p-8">
                    <div class="grid items-start grid-cols-1 gap-6 lg:grid-cols-12">

                        <div class="flex flex-col items-center gap-4 sm:flex-row sm:items-start lg:col-span-8">
                            <div class="flex items-center justify-center text-xl font-semibold tracking-wider text-indigo-700 uppercase border border-indigo-100 rounded-full shrink-0 size-16 bg-indigo-50">
                                {{ substr($citizen->full_name, 0, 2) }}
                            </div>

                            <div class="w-full space-y-3 text-center sm:text-left">
                                <div>
                                    <div class="flex flex-wrap items-center justify-center gap-2 sm:justify-start">
                                        <h4 class="text-xl font-bold tracking-tight break-words text-slate-900 md:text-2xl">
                                            {{ $citizen->full_name ?? '-' }}
                                        </h4>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100 whitespace-nowrap">
                                            {{ $citizen->family_role->label() ?? '-' }}
                                        </span>
                                    </div>

                                    <div class="flex flex-wrap items-center justify-center gap-2 mt-1 text-sm text-slate-500 sm:justify-start">
                                        <span x-show="openData" class="font-mono font-medium break-all text-slate-700">
                                            {{ $citizen->nik ?? '3208122005990004' }}
                                        </span>
                                        <span x-show="!openData" class="inline-flex items-center">
                                            <x-vaadin-ellipsis-h class="size-4 text-slate-400" />
                                        </span>
                                        <span class="hidden text-slate-300 sm:inline">•</span>
                                        <span class="font-medium text-slate-700 whitespace-nowrap">
                                            {{ $citizen->birth_date->age ?? '-' }} Tahun
                                        </span>
                                    </div>
                                </div>

                                <dl class="grid grid-cols-1 pt-3 border-t gap-x-6 gap-y-3 border-slate-100 sm:grid-cols-3">
                                    <div class="space-y-0.5">
                                        <dt class="text-xs font-medium tracking-wider uppercase text-slate-400">Jenis Kelamin</dt>
                                        <dd class="text-sm font-semibold text-slate-700">{{ $citizen->gender->label() ?? '-' }}</dd>
                                    </div>
                                    <div class="space-y-0.5">
                                        <dt class="text-xs font-medium tracking-wider uppercase text-slate-400">Hubungan KK</dt>
                                        <dd class="text-sm font-semibold text-slate-700">{{ $citizen->family_role->label() ?? '-' }}</dd>
                                    </div>
                                    <div class="space-y-0.5 sm:col-span-1">
                                        <dt class="text-xs font-medium tracking-wider uppercase text-slate-400">No. KK</dt>
                                        <dd x-show="openData" class="text-sm font-semibold break-all text-slate-700">
                                            {{ $citizen->family->family_card_number ?? '-' }}
                                        </dd>
                                        <dd x-show="!openData" class="inline-flex items-center">
                                            <x-vaadin-ellipsis-h class="size-4 text-slate-400" />
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <div class="grid w-full grid-cols-2 gap-3 lg:col-span-4 lg:border-l lg:border-slate-100 lg:pl-6">
                            <div class="flex flex-col items-center justify-center p-3 text-center border rounded-xl bg-slate-50 border-slate-100">
                                <dt class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Gol. Darah</dt>
                                <dd class="mt-1 text-lg font-bold text-slate-800">{{ $citizen->blood_type ?? '-' }}</dd>
                            </div>
                            <div class="flex flex-col items-center justify-center p-3 text-center border rounded-xl bg-slate-50 border-slate-100">
                                <dt class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Agama</dt>
                                <dd class="max-w-full mt-1 text-sm font-bold truncate text-slate-800">{{ $citizen->religion->label() ?? '-' }}</dd>
                            </div>
                        </div>

                    </div>

                    <hr class="my-6 border-slate-100">

                    <section class="w-full">
                        <dl class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2 lg:grid-cols-4">
                            <div class="space-y-1">
                                <dt class="text-xs font-medium tracking-wider uppercase text-slate-400">Tempat, Tanggal Lahir</dt>
                                <dd class="text-sm font-medium text-slate-800">
                                    {{ $citizen->birth_place ?? '-' }},
                                    <span class="inline-block font-semibold text-slate-900">{{ $citizen->birth_date->translatedFormat('d F Y') ?? '-' }}</span>
                                </dd>
                            </div>

                            <div class="space-y-1">
                                <dt class="text-xs font-medium tracking-wider uppercase text-slate-400">Status Pernikahan</dt>
                                <dd class="text-sm font-semibold text-slate-900">
                                    {{ $citizen->marital_status->label() ?? '-' }}
                                </dd>
                            </div>

                            <div class="space-y-1">
                                <dt class="text-xs font-medium tracking-wider uppercase text-slate-400">Alamat Keluarga</dt>
                                <dd class="text-sm font-medium break-words text-slate-800">
                                    {{ $citizen->family->territory->sub_village ?? '-' }}
                                    <span class="font-semibold text-slate-900">RT {{ $citizen->family->territory->rt ?? '-' }}/RW {{ $citizen->family->territory->rw ?? '-' }}</span>
                                </dd>
                            </div>

                            <div class="space-y-1">
                                <dt class="text-xs font-medium tracking-wider uppercase text-slate-400">ID Sistem (UUID)</dt>
                                <div>
                                    <dd x-show="openData" class="inline-block max-w-full">
                                        <code class="px-2 py-1 font-mono text-xs font-medium break-all border rounded select-all text-slate-600 bg-slate-50 border-slate-200">
                                            {{ $citizen->id ?? '-' }}
                                        </code>
                                    </dd>
                                    <dd x-show="!openData" class="inline-flex items-center">
                                        <x-vaadin-ellipsis-h class="size-4 text-slate-400" />
                                    </dd>
                                </div>
                            </div>
                        </dl>
                    </section>
                </div>
            </article>

            <div class="flex flex-col gap-4">
                <x-citizen-profile-card title="Profile Pekerjaan & Status Ekonomi" class="w-full"
                    icon="solar-square-academic-cap-2-broken" color="text-amber-500" :isValue="$citizen->employmentProfile">
                    @include('dashboard.manage-data.citizens.partials.profiles._employment-profile')
                </x-citizen-profile-card>

                <div class="grid items-stretch grid-cols-1 gap-4 lg:grid-cols-2">
                    <x-citizen-profile-card title="Profile Kesehatan Individu" class="w-full" icon="iconsax-out-heart"
                        color="text-primary" :isValue="$citizen->healthProfile">
                        @include('dashboard.manage-data.citizens.partials.profiles._health-profile')
                    </x-citizen-profile-card>

                    <x-citizen-profile-card title="Profile Kualifikasi Pendidikan" class="w-full"
                        icon="solar-square-academic-cap-2-broken" color="text-blue-500" :isValue="$citizen->educationProfile">
                        @include('dashboard.manage-data.citizens.partials.profiles._education-profile')
                    </x-citizen-profile-card>
                </div>

                <x-citizen-profile-card type="childGrowthLogs" title="Log Timbangan & Diagnosa Stunting" class="w-full"
                    icon="heroicon-o-chart-bar" color="text-emerald-500" :isValue="$citizen->childGrowthLogs">
                    @include('dashboard.manage-data.citizens.partials.profiles._childGrowthLogs-profile')
                </x-citizen-profile-card>
            </div>
        </div>
    </div>
</x-layouts.dashboard>

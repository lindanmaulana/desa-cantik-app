<x-layouts.dashboard>
    <div class="p-6 max-md:p-3 space-y-2" x-data="citizenData()">

        <div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
            <div>
                <h2 class="flex items-center gap-2 text-2xl max-lg:text-xl max-md:text-lg font-bold text-gray-800">
                    <x-heroicon-o-identification class="w-6 h-6 text-teal-600" />
                    Detail Penduduk {{ $citizen->full_name }}
                </h2>
                <p class="mt-1 text-sm max-md:text-xs text-gray-500">Manajemen data demografi warga desa, NIK, peran
                    keluarga, dan status kependudukan.</p>
            </div>

            <div class="flex items-center gap-2">
                <button @click="openData = !openData"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700">
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
                    class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700">
                    <x-iconsax-lin-arrow-left class="size-4 mr-2 max-xl:mr-0" /> <span class="max-xl:hidden">Kembali ke
                        Daftar Penduduk</span>
                </a>
            </div>
        </div>

        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        @include('dashboard.manage-data.citizens.partials.modal.health-profile-create')
        @include('dashboard.manage-data.citizens.partials.modal.health-profile-update')
        @include('dashboard.manage-data.citizens.partials.modal.education-profile-create')
        @include('dashboard.manage-data.citizens.partials.modal.education-profile-update')
        @include('dashboard.manage-data.citizens.partials.modal.employment-profile-create')
        @include('dashboard.manage-data.citizens.partials.modal.employment-profile-update')
        @include('dashboard.manage-data.citizens.partials.modal.child-growth-log-create')
        @include('dashboard.manage-data.citizens.partials.modal.child-growth-log-detail')

        <div class="flex flex-col gap-6">
            <article
                class="p-4 sm:p-6 lg:p-8 border border-t-8 shadow border-t-primary rounded-2xl sm:rounded-3xl bg-white">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 items-start">

                    <div
                        class="justify-self-start md:justify-self-center p-4 sm:p-5 text-3xl sm:text-4xl border-[1px] rounded-xl border-primary/30 bg-primary/10 shrink-0">
                        👦
                    </div>

                    <div class="space-y-4 md:col-span-2 lg:col-span-2 w-full">
                        <div class="space-y-1.5">
                            <div class="flex flex-wrap items-center gap-2">
                                <h4 class="text-xl md:text-2xl font-bold text-slate-800 break-words max-w-full">
                                    {{ $citizen->full_name }}
                                </h4>
                                <span
                                    class="px-2 py-0.5 text-xs font-semibold rounded-full text-primary bg-primary/10 whitespace-nowrap">
                                    {{ $citizen->family_role->label() }}
                                </span>
                            </div>

                            <div
                                class="flex flex-wrap items-center gap-x-2 gap-y-1 text-sm md:text-base text-slate-600">
                                <span x-show="openData"
                                    class="font-medium text-slate-800 break-all">{{ $citizen->nik ?? '3208122005990004' }}</span>
                                <span x-show="!openData" class="inline-flex items-center"><x-vaadin-ellipsis-h
                                        class="size-4 text-slate-400" /></span>
                                <span class="font-semibold text-slate-300 hidden sm:inline">|</span>
                                <span
                                    class="font-semibold text-primary whitespace-nowrap">{{ $citizen->birth_date->age }}
                                    Tahun</span>
                            </div>
                        </div>

                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2.5 pt-2 border-t border-slate-50">
                            <div class="space-y-0.5">
                                <dt class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Jenis Kelamin
                                </dt>
                                <dd class="text-sm font-medium text-slate-800">{{ $citizen->gender->label() }}</dd>
                            </div>

                            <div class="space-y-0.5">
                                <dt class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Hubungan KK
                                </dt>
                                <dd class="text-sm font-medium text-slate-800">{{ $citizen->family_role->label() }}</dd>
                            </div>

                            <div class="space-y-0.5 sm:col-span-2">
                                <dt class="text-xs font-semibold text-slate-400 uppercase tracking-wider">No KK
                                    (Keluarga)</dt>
                                <dd x-show="openData" class="text-sm font-medium text-primary break-all">
                                    {{ $citizen->family->family_card_number }}
                                </dd>
                                <dd x-show="!openData" class="inline-flex items-center"><x-vaadin-ellipsis-h
                                        class="size-4 text-slate-400" /></dd>
                            </div>
                        </dl>
                    </div>

                    <div
                        class="grid grid-cols-2 gap-3 w-full md:col-span-3 lg:col-span-1 border-t border-slate-100 pt-4 md:border-t-0 md:pt-0 lg:h-full lg:content-start">
                        <div
                            class="flex flex-col items-center justify-center p-3 border rounded-xl bg-primary/5 border-primary/5 min-w-[75px]">
                            <dt
                                class="text-[10px] md:text-xs text-slate-500 font-medium text-center uppercase tracking-wider">
                                Gol Darah</dt>
                            <dd class="text-base font-bold text-primary mt-0.5">{{ $citizen->blood_type ?? '-' }}</dd>
                        </div>

                        <div
                            class="flex flex-col items-center justify-center p-3 border rounded-xl bg-primary/5 border-primary/5 min-w-[95px]">
                            <dt
                                class="text-[10px] md:text-xs text-slate-500 font-medium text-center uppercase tracking-wider">
                                Agama</dt>
                            <dd class="text-base font-bold text-slate-800 mt-0.5">{{ $citizen->religion->label() }}
                            </dd>
                        </div>
                    </div>

                    <hr class="md:col-span-3 lg:col-span-4 border-slate-100 my-2">

                    <section class="md:col-span-3 lg:col-span-4 w-full">
                        <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-5 gap-x-6">
                            <div class="space-y-1 border-b border-slate-50 pb-2 sm:border-0 sm:pb-0">
                                <dt class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Tempat,
                                    Tanggal Lahir</dt>
                                <dd class="text-sm font-semibold text-slate-800">
                                    {{ $citizen->birth_place }},
                                    <span
                                        class="inline-block">{{ $citizen->birth_date->translatedFormat('d F Y') }}</span>
                                </dd>
                            </div>

                            <div class="space-y-1 border-b border-slate-50 pb-2 sm:border-0 sm:pb-0">
                                <dt class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Status
                                    Pernikahan</dt>
                                <dd class="text-sm font-semibold text-slate-800">
                                    {{ $citizen->marital_status->label() }}</dd>
                            </div>

                            <div class="space-y-1 border-b border-slate-50 pb-2 sm:border-0 sm:pb-0">
                                <dt class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Alamat Detail
                                    Keluarga</dt>
                                <dd class="text-sm font-semibold text-slate-800 break-words">
                                    {{ $citizen->family->territory->sub_village }}, RT
                                    {{ $citizen->family->territory->rt }}/RW {{ $citizen->family->territory->rw }}
                                </dd>
                            </div>

                            <div class="space-y-1 pb-1 sm:pb-0">
                                <dt class="text-xs text-slate-400 font-semibold uppercase tracking-wider">ID Referensi
                                    Sistem (UUID)</dt>
                                <div>
                                    <dd x-show="openData"
                                        class="text-xs font-mono font-medium text-slate-600 break-all bg-slate-50 p-1.5 rounded border border-slate-100 inline-block max-w-full">
                                        <code>{{ $citizen->id }}</code>
                                    </dd>
                                    <dd x-show="!openData" class="inline-flex items-center"><x-vaadin-ellipsis-h
                                            class="size-4 text-slate-400" /></dd>
                                </div>
                            </div>
                        </dl>
                    </section>

                </div>
            </article>

            <div class="flex flex-col gap-4">
                <x-citizen-profile-card title="Profile Pekerjaan & Status Ekonomi" class="w-full"
                    icon="solar-square-academic-cap-2-broken" color="text-amber-500" :isValue="$citizen->employmentProfile">
                    @include('dashboard.manage-data.citizens.partials.profiles.employment-profile')
                </x-citizen-profile-card>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-stretch">

                    <x-citizen-profile-card title="Profile Kesehatan Individu" class="w-full" icon="iconsax-out-heart"
                        color="text-primary" :isValue="$citizen->healthProfile">
                        @include('dashboard.manage-data.citizens.partials.profiles.health-profile')
                    </x-citizen-profile-card>

                    <x-citizen-profile-card title="Profile Kualifikasi Pendidikan" class="w-full"
                        icon="solar-square-academic-cap-2-broken" color="text-blue-500" :isValue="$citizen->educationProfile">
                        @include('dashboard.manage-data.citizens.partials.profiles.education-profile')
                    </x-citizen-profile-card>

                </div>

                <x-citizen-profile-card type="childGrowthLogs" title="Log Timbangan & Diagnosa Stunting" class="w-full"
                    icon="heroicon-o-chart-bar" color="text-emerald-500" :isValue="$citizen->childGrowthLogs">
                    @include('dashboard.manage-data.citizens.partials.profiles.childGrowthLogs-profile')
                </x-citizen-profile-card>
            </div>
        </div>
    </div>
</x-layouts.dashboard>

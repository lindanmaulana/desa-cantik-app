<x-layouts.dashboard>
    <div class="p-6 space-y-2" x-data="citizenData()">

        <div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
            <div>
                <h2 class="flex items-center gap-2 text-2xl font-bold text-gray-800">
                    <x-heroicon-o-identification class="w-6 h-6 text-teal-600" />
                    Detail Penduduk {{$citizen->full_name}}
                </h2>
                <p class="mt-1 text-sm text-gray-500">Manajemen data demografi warga desa, NIK, peran keluarga, dan status kependudukan.</p>
            </div>

            <div class="flex items-center gap-2">
                <button @click="openData = !openData" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700">
                    <span class="flex items-center" x-show="openData">
                        <x-heroicon-o-eye class="w-4 h-4 mr-2" />
                        Sembunyikan Data Sensitif
                    </span>
                    <span class="flex items-center" x-show="!openData">
                        <x-heroicon-o-eye-slash class="w-4 h-4 mr-2" />
                        Tampilkan Data Sensitif
                    </span>
                </button>
                <a href="{{ route('dashboard.manage-data.citizens') }}" class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700">
                    <x-iconsax-lin-arrow-left class="size-4" /> <span class="mb-px">Kembali ke Daftar Penduduk</span>
                </a>
            </div>
        </div>

        @if(session('success'))
        <x-alert type="success" :message="session('success')" />
        @endif

        @if(session('error'))
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
            <article class="col-span-2 p-8 space-y-6 border border-t-8 shadow border-t-primary rounded-3xl">
                <header class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="px-5 py-6 text-4xl border-[1px] rounded-xl border-primary/30 bg-primary/10">
                            👦
                        </div>

                        <div class="mb-1 space-y-2">
                            <h4 class="text-2xl font-bold">{{$citizen->full_name}} <small class="px-2 py-1 text-sm font-semibold rounded-full text-primary bg-primary/10">{{ $citizen->family_role->label() }}</small></h4>

                            <div class="space-x-1">
                                <span x-show="openData" class="text-base font-medium text-slate-800">3208122005990004</span>
                                <span x-show="!openData"><x-vaadin-ellipsis-h class="inline size-4 text-slate-400" /></span>
                                <span class="font-semibold text-slate-400">|</span>
                                <span class="text-sm font-semibold text-primary">{{ $citizen->birth_date->age }} Tahun</span>
                            </div>

                            <dl class="flex items-center gap-4">
                                <div class="flex items-center gap-2">
                                    <dt class="text-sm font-semibold">Jenis Kelamin: </dt>
                                    <dd class="text-sm text-slate-600">{{$citizen->gender->label()}}</dd>
                                </div>

                                <div class="flex items-center gap-2">
                                    <dt class="text-sm font-semibold">Hubungan KK: </dt>
                                    <dd class="text-sm text-slate-600">{{ $citizen->family_role->label() }}</dd>
                                </div>

                                <div class="flex items-center gap-2">
                                    <dt class="text-sm font-semibold">No KK (Keluarga): </dt>
                                    <dd x-show="openData" class="text-sm font-medium text-primary/60">{{ $citizen->family->family_card_number }}</dd>
                                    <dd x-show="!openData"><x-vaadin-ellipsis-h class="size-4 text-slate-400" /></dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 profile-quick-vitals">
                        <dl class="flex items-center gap-4">
                            <div class="flex flex-col items-center p-2 border rounded-lg bg-primary/5 border-primary/5">
                                <dt class="text-xs text-slate-600">Gol Darah</dt>
                                <dd class="text-base font-medium text-primary">{{ $citizen->blood_type ?? '-' }}</dd>
                            </div>

                            <div class="flex flex-col items-center p-2 border rounded-lg bg-primary/5 border-primary/5">
                                <dt class="text-xs text-slate-600">Agama</dt>
                                <dd class="text-base font-medium">{{ $citizen->religion->label() }}</dd>
                            </div>
                        </dl>
                    </div>
                </header>

                <hr>

                <section class="profile-extended-details">
                    <dl class="flex items-center justify-between grid-details">
                        <div>
                            <dt class="text-xs text-slate-600">Tempat, Tanggal Lahir</dt>
                            <dd class="text-sm font-medium">{{ $citizen->birth_place }}, {{ $citizen->birth_date->translatedFormat('d') }} {{$citizen->birth_date->translatedFormat('F')}} {{$citizen->birth_date->year}}</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-slate-600">Status Pernikahan</dt>
                            <dd class="text-sm font-medium">{{ $citizen->marital_status->label() }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-slate-600">Alamat Detail Keluarga</dt>
                            <dd class="text-sm font-medium">{{ $citizen->family->territory->sub_village }}, RT {{ $citizen->family->territory->rt }}/RW {{ $citizen->family->territory->rw }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-slate-600">ID Referensi Sistem (UUID)</dt>
                            <dd x-show="openData" class="text-sm font-medium"><code class="uuid-text">{{ $citizen->id }}</code></dd>
                            <dd x-show="!openData"><x-vaadin-ellipsis-h class="size-4 text-slate-400" /></dd>
                        </div>
                    </dl>
                </section>
            </article>

            <div class="flex flex-col gap-4">
                <x-citizen-profile-card title="Profile Pekerjaan & Status Ekonomi" class="w-full" icon="solar-square-academic-cap-2-broken" color="text-amber-500" :isValue="$citizen->employmentProfile">
                    @include('dashboard.manage-data.citizens.partials.profiles.employment-profile')
                </x-citizen-profile-card>

                <div class="flex items-center gap-4">
                    <x-citizen-profile-card title="Profile Kesehatan Individu" class="w-1/2" icon="iconsax-out-heart" color="text-primary" :isValue="$citizen->healthProfile">
                        @include('dashboard.manage-data.citizens.partials.profiles.health-profile')
                    </x-citizen-profile-card>

                    <x-citizen-profile-card title="Profile Kualifikasi Pendidikan" class="w-1/2" icon="solar-square-academic-cap-2-broken" color="text-blue-500" :isValue="$citizen->educationProfile">
                        @include('dashboard.manage-data.citizens.partials.profiles.education-profile')
                    </x-citizen-profile-card>
                </div>

                <x-citizen-profile-card type="childGrowthLogs" title="Log Timbangan & Diagnosa Stunting" icon="heroicon-o-chart-bar" color="text-emerald-500" :isValue="$citizen->childGrowthLogs">
                    @include('dashboard.manage-data.citizens.partials.profiles.childGrowthLogs-profile')
                </x-citizen-profile-card>
            </div>
        </div>
    </div>
</x-layouts.dashboard>

<x-layouts.dashboard>
    <div class="p-6 space-y-2 max-md:p-3" x-data="citizenData()">

        <!-- Header Section -->
        <div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
            <div>
                <h2 class="flex items-center gap-2 text-2xl max-lg:text-xl max-md:text-lg font-bold text-textPrimary">
                    <x-heroicon-o-identification class="w-6 h-6 text-primary" />
                    Detail Penduduk {{ $citizen->full_name }}
                </h2>
                <p class="mt-1 text-sm max-md:text-xs text-textSecondary">
                    Manajemen data demografi warga desa, NIK, peran keluarga, dan status kependudukan.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-2">
                <button @click="openData = !openData"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-secondary transition-colors bg-primary rounded-lg shadow-sm hover:opacity-90">
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
                    class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium text-secondary transition-colors bg-primary rounded-lg shadow-sm hover:opacity-90">
                    <x-iconsax-lin-arrow-left class="size-4 mr-2 max-xl:mr-0" />
                    <span class="max-xl:hidden">Kembali ke Daftar Penduduk</span>
                </a>
            </div>
        </div>

        <!-- Flash Alert Messages -->
        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        <!-- Includes Modals Form & Detail -->
        @include('dashboard.manage-data.citizens.partials.modal.health-profile-create')
        @include('dashboard.manage-data.citizens.partials.modal.health-profile-update')
        @include('dashboard.manage-data.citizens.partials.modal.education-profile-create')
        @include('dashboard.manage-data.citizens.partials.modal.education-profile-update')
        @include('dashboard.manage-data.citizens.partials.modal.employment-profile-create')
        @include('dashboard.manage-data.citizens.partials.modal.employment-profile-update')
        @include('dashboard.manage-data.citizens.partials.modal.child-growth-log-create')
        @include('dashboard.manage-data.citizens.partials.modal.child-growth-log-detail')

        <!-- Main Content Area -->
        <div class="flex flex-col gap-6">
            <!-- Biodata Card Utama -->
            <article
                class="p-4 sm:p-6 lg:p-8 border border-t-8 shadow border-textTertiary/20 border-t-primary rounded-2xl sm:rounded-3xl bg-secondary">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 items-start">
                    <!-- Avatar/Icon Placeholder -->
                    <div
                        class="justify-self-start md:justify-self-center p-4 sm:p-5 text-3xl sm:text-4xl border rounded-xl border-primary/30 bg-primary/10 shrink-0">
                        👦
                    </div>

                    <!-- Identitas Utama -->
                    <div class="space-y-4 md:col-span-2 lg:col-span-2 w-full">
                        <div class="space-y-1.5">
                            <div class="flex flex-wrap items-center gap-2">
                                <h4 class="text-xl md:text-2xl font-bold text-textPrimary break-words max-w-full">
                                    {{ $citizen->full_name }}
                                </h4>
                                <span
                                    class="px-2 py-0.5 text-xs font-semibold rounded-full text-primary bg-primary/10 whitespace-nowrap">
                                    {{ $citizen->family_role->label() }}
                                </span>
                            </div>

                            <div
                                class="flex flex-wrap items-center gap-x-2 gap-y-1 text-sm md:text-base text-textSecondary">
                                <span x-show="openData" class="font-medium text-textPrimary break-all">
                                    {{ $citizen->nik ?? '3208122005990004' }}
                                </span>
                                <span x-show="!openData" class="inline-flex items-center">
                                    <x-vaadin-ellipsis-h class="size-4 text-textTertiary" />
                                </span>
                                <span class="font-semibold text-textTertiary/40 hidden sm:inline">|</span>
                                <span class="font-semibold text-primary whitespace-nowrap">
                                    {{ $citizen->birth_date->age }} Tahun
                                </span>
                            </div>
                        </div>

                        <!-- Data Kependudukan KK -->
                        <dl
                            class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2.5 pt-2 border-t border-textTertiary/10">
                            <div class="space-y-0.5">
                                <dt class="text-xs font-semibold text-textSecondary uppercase tracking-wider">Jenis
                                    Kelamin</dt>
                                <dd class="text-sm font-medium text-textPrimary">{{ $citizen->gender->label() }}</dd>
                            </div>

                            <div class="space-y-0.5">
                                <dt class="text-xs font-semibold text-textSecondary uppercase tracking-wider">Hubungan
                                    KK</dt>
                                <dd class="text-sm font-medium text-textPrimary">{{ $citizen->family_role->label() }}
                                </dd>
                            </div>

                            <div class="space-y-0.5 sm:col-span-2">
                                <dt class="text-xs font-semibold text-textSecondary uppercase tracking-wider">No KK
                                    (Keluarga)</dt>
                                <dd x-show="openData" class="text-sm font-medium break-all text-primary">
                                    {{ $citizen->family->family_card_number }}
                                </dd>
                                <dd x-show="!openData" class="inline-flex items-center">
                                    <x-vaadin-ellipsis-h class="size-4 text-textTertiary" />
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Golongan Darah & Agama -->
                    <div
                        class="grid grid-cols-2 gap-3 w-full md:col-span-3 lg:col-span-1 border-t border-textTertiary/10 pt-4 md:border-t-0 md:pt-0 lg:h-full lg:content-start">
                        <div
                            class="flex flex-col items-center justify-center p-3 border rounded-xl bg-primary/5 border-primary/10 min-w-[75px]">
                            <dt
                                class="text-[10px] md:text-xs text-textSecondary font-medium text-center uppercase tracking-wider">
                                Gol Darah</dt>
                            <dd class="text-base font-bold text-primary mt-0.5">{{ $citizen->blood_type ?? '-' }}</dd>
                        </div>

                        <div
                            class="flex flex-col items-center justify-center p-3 border rounded-xl bg-primary/5 border-primary/10 min-w-[95px]">
                            <dt
                                class="text-[10px] md:text-xs text-textSecondary font-medium text-center uppercase tracking-wider">
                                Agama</dt>
                            <dd class="text-base font-bold text-textPrimary mt-0.5">{{ $citizen->religion->label() }}
                            </dd>
                        </div>
                    </div>

                    <hr class="md:col-span-3 lg:col-span-4 border-textTertiary/10 my-2">

                    <!-- Detail Lokasi & Sistem -->
                    <section class="md:col-span-3 lg:col-span-4 w-full">
                        <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-5 gap-x-6">
                            <div class="space-y-1 border-b border-textTertiary/10 pb-2 sm:border-0 sm:pb-0">
                                <dt class="text-xs text-textSecondary font-semibold uppercase tracking-wider">Tempat,
                                    Tanggal Lahir</dt>
                                <dd class="text-sm font-semibold text-textPrimary">
                                    {{ $citizen->birth_place }},
                                    <span
                                        class="inline-block">{{ $citizen->birth_date->translatedFormat('d F Y') }}</span>
                                </dd>
                            </div>

                            <div class="space-y-1 border-b border-textTertiary/10 pb-2 sm:border-0 sm:pb-0">
                                <dt class="text-xs text-textSecondary font-semibold uppercase tracking-wider">Status
                                    Pernikahan</dt>
                                <dd class="text-sm font-semibold text-textPrimary">
                                    {{ $citizen->marital_status->label() }}</dd>
                            </div>

                            <div class="pb-2 space-y-1 border-b border-textTertiary/10 sm:border-0 sm:pb-0">
                                <dt class="text-xs font-semibold tracking-wider uppercase text-textSecondary">Alamat
                                    Detail
                                    Keluarga</dt>
                                <dd class="text-sm font-semibold break-words text-textPrimary">
                                    {{ $citizen->family->territory->sub_village ?? '-' }} RT
                                    {{ $citizen->family->territory->rt ?? '-' }}/RW
                                    {{ $citizen->family->territory->rw ?? '-' }}
                                </dd>
                            </div>


                            <div class="pb-1 space-y-1 sm:pb-0">
                                <dt class="text-xs font-semibold tracking-wider uppercase text-textSecondary">ID
                                    Referensi
                                    Sistem (UUID)</dt>
                                <div>
                                    <dd x-show="openData"
                                        class="text-xs font-mono font-medium text-textSecondary break-all bg-tertiary p-1.5 rounded border border-textTertiary/20 inline-block max-w-full">
                                        <code>{{ $citizen->id }}</code>
                                    </dd>
                                    <dd x-show="!openData" class="inline-flex items-center">
                                        <x-vaadin-ellipsis-h class="size-4 text-textTertiary" />
                                    </dd>
                                </div>
                            </div>
                        </dl>
                    </section>

                </div>
            </article>

            <!-- Profil Sektoral (Pekerjaan, Kesehatan, Pendidikan, Stunting) -->
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

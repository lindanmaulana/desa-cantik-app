<x-layouts.dashboard>
    <div class="p-6" x-data="citizenData()">

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
        <div class="grid grid-cols-2 gap-6">
            <article class="col-span-2 p-8 space-y-6 border border-t-8 shadow border-t-primary rounded-3xl">
                <header class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="px-5 py-6 text-4xl border-[1px] rounded-xl border-primary/30 bg-primary/10">
                            👦
                        </div>

                        <div class="mb-1 space-y-2">
                            <h4 class="text-2xl font-bold">{{$citizen->full_name}} <small class="px-2 py-1 text-sm font-semibold rounded-full text-primary bg-primary/10">KEPALA KELUARGA</small></h4>

                            <div class="space-x-1">
                                <span class="text-base font-medium text-slate-800">3208122005990004</span>
                                <span class="font-semibold text-slate-400">|</span>
                                <span class="text-sm font-semibold text-primary">27 Tahun</span>
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
                                    <dd class="text-sm font-medium text-primary/60">{{ $citizen->family->family_card_number }}</dd>
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

                        <button type="button" class="flex items-center gap-2 px-4 py-2 text-sm font-medium border rounded-lg btn-edit bg-primary/5"><x-heroicon-o-pencil-square class="w-4 h-4" /> Edit Identitas</button>
                    </div>
                </header>

                <hr>

                <section class="profile-extended-details">
                    <dl class="flex items-center justify-between grid-details">
                        <div>
                            <dt class="text-xs text-slate-600">Tempat, Tanggal Lahir</dt>
                            <dd class="text-sm font-medium">Kuningan, 20 Mei 1999</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-slate-600">Status Pernikahan</dt>
                            <dd class="text-sm font-medium">Belum Kawin</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-slate-600">Alamat Detail Keluarga</dt>
                            <dd class="text-sm font-medium">Dusun Manis, RT 01/RW 01</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-slate-600">ID Referensi Sistem (UUID)</dt>
                            <dd class="text-sm font-medium"><code class="uuid-text">550e8400-e29b-41d4-a716-446655449999</code></dd>
                        </div>
                    </dl>
                </section>
            </article>

            <x-citizen-profile-card title="Profile Kesehatan Individu" icon="iconsax-out-heart" color="text-primary" :isValue="$citizen->healthProfile">
                @include('dashboard.manage-data.citizens.partials.profiles.health-profile')
            </x-citizen-profile-card>

            <x-citizen-profile-card title="Profile Kualifikasi Pendidikan" icon="solar-square-academic-cap-2-broken" color="text-blue-500" :isValue="$citizen->educationProfile">
                @include('dashboard.manage-data.citizens.partials.profiles.education-profile')
            </x-citizen-profile-card>

            <x-citizen-profile-card title="Profile Pekerjaan & Status Ekonomi" icon="solar-square-academic-cap-2-broken" color="text-orange-500" :isValue="$citizen->employmentProfile">
                @include('dashboard.manage-data.citizens.partials.profiles.employment-profile')
            </x-citizen-profile-card>

            <x-citizen-profile-card :isValue="$citizen->employmentProfile" type="childGrowthLogs">
                @include('dashboard.manage-data.citizens.partials.profiles.childGrowthLogs-profile')
            </x-citizen-profile-card>
        </div>
    </div>
</x-layouts.dashboard>

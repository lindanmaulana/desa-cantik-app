<x-layouts.dashboard>
    <div class="p-6 space-y-2 max-md:p-3" x-data="familyData()">

        <div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
            <div>
                <h2 class="flex items-center gap-2 text-2xl font-bold max-lg:text-xl max-md:text-lg text-textPrimary">
                    <x-heroicon-o-home class="w-6 h-6 text-primary" />
                    Detail Keluarga KK: {{ $family->family_card_number }}
                </h2>
                <p class="mt-1 text-sm max-md:text-xs text-textSecondary">
                    Manajemen data kartu keluarga, wilayah yurisdiksi tinggal, jumlah anggota, serta profil kelayakan hunian (housing profile).
                </p>
            </div>

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
                <a href="{{ route('dashboard.manage-data.families') }}"
                    class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium transition-colors rounded-lg shadow-sm text-secondary bg-primary hover:opacity-90">
                    <x-iconsax-lin-arrow-left class="mr-2 size-4 max-xl:mr-0" />
                    <span class="max-xl:hidden">Kembali</span>
                </a>
            </div>
        </div>

        @if (session('success'))
        <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
        <x-alert type="error" :message="session('error')" />
        @endif

        @include('dashboard.manage-data.families.partials.modal._housing-profile-create')
        @include('dashboard.manage-data.families.partials.modal._housing-profile-update')

        <div class="flex flex-col gap-6">
            <article class="p-4 border border-t-8 shadow sm:p-6 lg:p-8 border-textTertiary/20 border-t-primary rounded-2xl sm:rounded-3xl bg-secondary">
                <div class="grid items-stretch grid-cols-1 gap-6 md:grid-cols-4">

                    <div class="flex flex-col gap-5 p-6 border bg-secondary/40 border-textTertiary/10 rounded-2xl md:col-span-3">

                        <div class="flex flex-col items-start gap-4 sm:flex-row sm:items-center">
                            <div class="flex items-center justify-center p-3.5 text-primary border rounded-xl border-primary/20 bg-primary/10 shrink-0 shadow-sm">
                                <x-heroicon-s-home-modern class="w-8 h-8 sm:w-10 sm:h-10" />
                            </div>

                            <div class="space-y-1">
                                <dt class="text-[10px] font-bold tracking-widest uppercase text-textSecondary">Nomor Kartu Keluarga (KK)</dt>
                                <div class="flex items-center min-h-[32px]">
                                    <h4 x-show="openData" class="font-mono text-xl font-bold tracking-wider text-textPrimary md:text-2xl">
                                        {{ $family->family_card_number }}
                                    </h4>
                                    <h4 x-show="!openData" class="inline-flex items-center">
                                        <x-vaadin-ellipsis-h class="tracking-widest size-6 text-textTertiary" />
                                    </h4>
                                </div>

                                <div class="flex flex-wrap items-center text-xs gap-x-2 text-textSecondary sm:text-sm">
                                    <span>Wilayah Tinggal:</span>
                                    <span class="font-semibold text-textPrimary">
                                        @if ($family->territory)
                                        Dusun {{ ucfirst($family->territory->sub_village) }} (RT {{ $family->territory->rt }} / RW {{ $family->territory->rw }})
                                        @else
                                        <span class="text-xs italic text-textSecondary/50">Tidak dikaitkan</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <dl class="grid grid-cols-1 gap-4 pt-4 border-t border-textTertiary/10 sm:grid-cols-2">
                            <div class="p-3 space-y-1 border rounded-xl bg-tertiary/40 border-textTertiary/5">
                                <dt class="text-[10px] font-bold tracking-wider uppercase text-textSecondary flex items-center gap-1.5">
                                    <x-heroicon-o-users class="w-3.5 h-3.5 text-textTertiary" /> Jumlah Anggota Keluarga
                                </dt>
                                <dd class="text-sm font-semibold text-textPrimary">
                                    {{ $family->citizens->count() }} Orang Terdaftar
                                </dd>
                            </div>

                            <div class="p-3 space-y-1 border rounded-xl bg-tertiary/40 border-textTertiary/5">
                                <dt class="text-[10px] font-bold tracking-wider uppercase text-textSecondary flex items-center gap-1.5">
                                    <x-heroicon-o-map-pin class="w-3.5 h-3.5 text-textTertiary" /> Detail Alamat KK
                                </dt>
                                <dd class="text-sm font-semibold break-words text-textPrimary">
                                    {{ $family->address_detail ?? '-' }}
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <div class="flex flex-col justify-between gap-4 p-5 border border-textTertiary/10 bg-secondary/40 rounded-2xl md:col-span-1">

                        <div class="flex flex-col items-center justify-center h-full p-4 text-center border rounded-xl bg-primary/5 border-primary/10">
                            <dt class="text-[10px] font-bold tracking-widest text-textSecondary uppercase">Kepala Keluarga</dt>
                            <dd class="text-sm font-extrabold text-primary mt-1.5 truncate max-w-full drop-shadow-sm">
                                {{ $family->citizens->where('family_role.value', 'head_of_family')->first()?->full_name ?? 'Belum Diatur' }}
                            </dd>
                        </div>

                        <div class="pt-2 space-y-3 border-t border-textTertiary/10">
                            <div class="space-y-0.5">
                                <dt class="text-[9px] font-bold tracking-wider uppercase text-textSecondary">Dibuat Pada</dt>
                                <dd class="text-xs font-semibold text-textPrimary">
                                    {{ $family->created_at ? $family->created_at->translatedFormat('d F Y, H:i') . ' WIB' : '-' }}
                                </dd>
                            </div>

                            <div class="space-y-1">
                                <dt class="text-[9px] font-bold tracking-wider uppercase text-textSecondary">ID Referensi Keluarga (UUID)</dt>
                                <div class="min-h-[24px] flex items-center">
                                    <dd x-show="openData" class="w-full">
                                        <code class="text-[10px] font-mono text-textSecondary break-all bg-tertiary px-2 py-1 rounded border border-textTertiary/20 block text-center select-all">
                                            {{ $family->id }}
                                        </code>
                                    </dd>
                                    <dd x-show="!openData" class="inline-flex items-center">
                                        <x-vaadin-ellipsis-h class="size-4 text-textTertiary" />
                                    </dd>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </article>

            <div class="flex flex-col gap-4">
                <x-citizen-profile-card
                    type="housingProfile"
                    title="Profil Rumah Tinggal, Sanitasi & Akses Energi"
                    class="w-full"
                    icon="heroicon-o-home-modern"
                    color="text-blue-500"
                    :isValue="$family->housingProfile">

                    @include('dashboard.manage-data.families.partials.profiles._housing-profile')

                </x-citizen-profile-card>
            </div>
        </div>
    </div>
</x-layouts.dashboard>

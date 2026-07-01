<div class="relative w-full overflow-hidden bg-center bg-cover border shadow-lg rounded-2xl border-slate-200/60"
    @if (isset($villageSettings) && $villageSettings->hero_image) style="background-image: url('{{ asset('storage/' . $villageSettings->hero_image) }}');" @endif>

    <!-- Overlay -->
    <div
        class="absolute inset-0 z-0 bg-gradient-to-r from-slate-900/90 via-slate-900/60 to-slate-800/30 max-lg:bg-gradient-to-b max-lg:from-slate-900/95 max-lg:via-slate-900/75 max-lg:to-slate-900/40">
    </div>

    <div class="relative z-10 grid items-center grid-cols-1 gap-8 p-4 lg:grid-cols-2 lg:gap-12 sm:p-10 lg:p-12">

        <!-- Left Side: Hero Text -->
        <div class="space-y-4 text-left text-white sm:space-y-6 max-lg:pb-4">
            <div
                class="px-3 py-1 text-xs font-semibold tracking-wide capitalize rounded-md w-fit bg-white/20 text-white border border-white/30 flex items-center gap-1.5 backdrop-blur-sm">
                <span class="w-1.5 h-1.5 bg-primary rounded-full animate-ping"></span>
                Pemerintah Desa {{ $villageSettings->village_name ?? '-' }}
            </div>

            <h2
                class="flex flex-col text-2xl font-bold leading-none tracking-tight text-white uppercase sm:text-4xl md:text-5xl">
                <span>{{ $villageSettings->app_title ?? 'pandawa' }} statistik</span>
                <span class="mt-1 text-primary">desa {{ $villageSettings->village_name ?? '-' }}</span>
            </h2>

            <h3 class="text-sm font-bold sm:text-lg md:text-xl text-slate-200">
                Pusat Analisis dan Wawasan Data Statistik
            </h3>

            <p class="max-w-xl text-xs italic font-normal leading-relaxed sm:text-base text-slate-300">
                Orchestrating local data for data-driven policies: Empowering Villages through integrated,
                transparent, and evidence-based for impactful statistics.
            </p>

            <div class="flex flex-col items-stretch gap-3 pt-2 sm:flex-row sm:items-center">
                @auth
                <x-button-link :href="route('dashboard')" variant="primary" size="md" loading-key="hero-dashboard"
                    loading-text="Membuka Dashboard...">
                    <x-iconsax-bro-arrow-square-left class="w-5 h-5 rotate-180" />
                    <span>Dashboard</span>
                </x-button-link>
                @else
                <x-button-link :href="route('auth.login')" variant="primary" size="md" loading-key="hero-login"
                    loading-text="Menuju Login...">
                    <x-iconsax-bro-arrow-square-right class="w-5 h-5" />
                    <span>Login Petugas</span>
                </x-button-link>
                @endauth

                <a href="#pelajari-lebih" class="inline-block max-sm:w-full">
                    <x-button variant="ghost" size="md"
                        class="w-full text-white border bg-white/10 hover:bg-white/20 border-white/20 backdrop-blur-sm">
                        <x-iconsax-lin-arrow-down class="w-4 h-4 text-white" />
                        Pelajari Lebih
                    </x-button>
                </a>
            </div>
        </div>

        <!-- Right Side: Card & Map -->
        <div
            class="bg-white rounded-2xl shadow-xl overflow-hidden grid grid-cols-1 sm:grid-cols-12 min-h-fit sm:min-h-[420px]">

            <!-- Card Info -->
            <div class="flex flex-col justify-between p-5 space-y-6 sm:col-span-7 sm:p-6 sm:space-y-4">
                <div>
                    <div class="flex items-start gap-3 sm:items-center">
                        @if (!empty($villageSettings->village_logo))
                        <img src="{{ asset('storage/' . $villageSettings->village_logo) }}" alt="Logo Desa"
                            class="object-cover border rounded-full size-10 border-textTertiary/20">
                        @else
                        <div class="flex items-center justify-center rounded-lg shrink-0 text-primary">
                            <x-heroicon-o-square-3-stack-3d class="w-7 h-7" />
                        </div>
                        @endif
                        <div>
                            <h4 class="text-sm font-bold tracking-wide uppercase text-slate-800 sm:text-base">
                                {{ $villageSettings->app_title ?? 'pandawa' }}
                            </h4>
                            <p class="text-xs leading-tight text-slate-500">Sistem Orkestrasi dan Analisis Data
                                sebagai wawasan pengambilan keputusan</p>
                        </div>
                    </div>
                    <p class="mt-4 text-xs leading-relaxed text-slate-500">
                        Dibangun di atas 5 pilar data utama untuk mendukung kemajuan Desa
                        {{ $villageSettings->village_name ?? '-' }}:
                    </p>
                </div>

                <!-- 5 Pillars List -->
                <ul class="space-y-2.5 text-xs font-semibold text-slate-700">
                    <li class="flex items-center gap-3">
                        <span
                            class="flex items-center justify-center w-6 h-6 rounded-full bg-primary/10 text-primary shrink-0">
                            <x-heroicon-o-users class="w-3.5 h-3.5" />
                        </span>
                        <span>1. Data Demografi</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span
                            class="flex items-center justify-center w-6 h-6 rounded-full bg-emerald-50 text-emerald-500 shrink-0">
                            <x-iconsax-bul-chart-1 class="w-3.5 h-3.5" />
                        </span>
                        <span>2. Data Sosial & Ekonomi</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span
                            class="flex items-center justify-center w-6 h-6 rounded-full bg-amber-50 text-amber-500 shrink-0">
                            <x-iconsax-bro-shop class="w-3.5 h-3.5" />
                        </span>
                        <span>3. Data UMKM</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span
                            class="flex items-center justify-center w-6 h-6 rounded-full bg-cyan-50 text-cyan-500 shrink-0">
                            <x-iconsax-lin-buildings class="w-3.5 h-3.5" />
                        </span>
                        <span>4. Data Infrastruktur Desa</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span
                            class="flex items-center justify-center w-6 h-6 rounded-full bg-rose-50 text-rose-500 shrink-0">
                            <x-heroicon-o-map-pin class="w-3.5 h-3.5" />
                        </span>
                        <span>5. Data Spasial</span>
                    </li>
                </ul>
            </div>

            <!-- Map Embed -->
            <div class="hidden sm:block sm:col-span-5 bg-tertiary relative overflow-hidden min-h-[180px] sm:min-h-full">
                <iframe
                    src="https://maps.google.com/maps?q={{ $villageSettings->latitude ?? '-6.977484656144307' }},{{ $villageSettings->longitude ?? '108.48431009591388' }}&z=14&output=embed"
                    class="absolute inset-0 w-full h-full transition-opacity duration-300 border-0 opacity-90 hover:opacity-100"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <div
                    class="absolute inset-0 pointer-events-none bg-gradient-to-r from-secondary via-transparent to-transparent">
                </div>
                <div
                    class="absolute bottom-4 left-4 text-[10px] font-bold text-textSecondary uppercase tracking-widest pointer-events-none z-10 bg-secondary/80 px-2 py-0.5 rounded-md backdrop-blur-sm">
                    PETA WILAYAH AKTIF
                </div>
            </div>

        </div>
    </div>
</div>
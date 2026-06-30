<div class="relative w-full rounded-2xl overflow-hidden shadow-lg border border-slate-200/60 bg-cover bg-center"
    @if (isset($villageSettings) && $villageSettings->hero_image) style="background-image: url('{{ asset('storage/' . $villageSettings->hero_image) }}');" @endif>

    <!-- Overlay -->
    <div
        class="absolute inset-0 bg-gradient-to-r from-slate-900/90 via-slate-900/60 to-slate-800/30 max-lg:bg-gradient-to-b max-lg:from-slate-900/95 max-lg:via-slate-900/75 max-lg:to-slate-900/40 z-0">
    </div>

    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center p-4 sm:p-10 lg:p-12">

        <!-- Left Side: Hero Text -->
        <div class="space-y-4 sm:space-y-6 text-left text-white max-lg:pb-4">
            <div
                class="px-3 py-1 text-xs font-semibold tracking-wide capitalize rounded-md w-fit bg-white/20 text-white border border-white/30 flex items-center gap-1.5 backdrop-blur-sm">
                <span class="w-1.5 h-1.5 bg-primary rounded-full animate-ping"></span>
                Pemerintah Desa {{ $villageSettings->village_name ?? '-' }}
            </div>

            <h2
                class="flex flex-col text-2xl sm:text-4xl md:text-5xl font-bold uppercase tracking-tight text-white leading-none">
                <span>pandawa statistik</span>
                <span class="text-primary mt-1">desa {{ $villageSettings->village_name ?? '-' }}</span>
            </h2>

            <h3 class="text-sm sm:text-lg md:text-xl font-bold text-slate-200">
                Pusat Analisis dan Wawasan Data Statistik
            </h3>

            <p class="text-xs sm:text-base italic text-slate-300 font-normal leading-relaxed max-w-xl">
                Orchestrating local data for data-driven policies: Empowering Villages through integrated,
                transparent, and evidence-based for impactful statistics.
            </p>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 pt-2">
                @auth
                    <x-button-link :href="route('dashboard')" variant="primary" size="md" loading-key="hero-dashboard"
                        loading-text="Membuka Dashboard...">
                        <x-heroicon-o-arrow-left-on-rectangle class="w-5 h-5 rotate-180" />
                        <span>Dashboard</span>
                    </x-button-link>
                @else
                    <x-button-link :href="route('auth.login')" variant="primary" size="md" loading-key="hero-login"
                        loading-text="Menuju Login...">
                        <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5" />
                        <span>Login Petugas</span>
                    </x-button-link>
                @endauth

                <a href="#pelajari-lebih" class="inline-block max-sm:w-full">
                    <x-button variant="ghost" size="md"
                        class="w-full bg-white/10 hover:bg-white/20 text-white border border-white/20 backdrop-blur-sm">
                        <x-heroicon-o-chevron-down class="w-4 h-4 text-white" />
                        Pelajari Lebih
                    </x-button>
                </a>
            </div>
        </div>

        <!-- Right Side: Card & Map -->
        <div
            class="bg-white rounded-2xl shadow-xl overflow-hidden grid grid-cols-1 sm:grid-cols-12 min-h-fit sm:min-h-[420px]">

            <!-- Card Info -->
            <div class="sm:col-span-7 p-5 sm:p-6 flex flex-col justify-between space-y-6 sm:space-y-4">
                <div>
                    <div class="flex items-start sm:items-center gap-3">
                        @if (!empty($villageSettings->village_logo))
                            <img src="{{ asset('storage/' . $villageSettings->village_logo) }}" alt="Logo Desa"
                                class="object-cover border rounded-full size-10 border-textTertiary/20">
                        @else
                            <div class="flex items-center justify-center rounded-lg shrink-0 text-primary">
                                <x-heroicon-o-square-3-stack-3d class="w-7 h-7" />
                            </div>
                        @endif
                        <div>
                            <h4 class="font-bold text-slate-800 tracking-wide text-sm sm:text-base">PANDAWA</h4>
                            <p class="text-xs text-slate-500 leading-tight">Sistem Orkestrasi dan Analisis Data
                                sebagai wawasan pengambilan keputusan</p>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 mt-4 leading-relaxed">
                        Dibangun di atas 5 pilar data utama untuk mendukung kemajuan Desa
                        {{ $villageSettings->village_name ?? 'Sukaraja' }}:
                    </p>
                </div>

                <!-- 5 Pillars List -->
                <ul class="space-y-2.5 text-xs font-semibold text-slate-700">
                    <li class="flex items-center gap-3">
                        <span
                            class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center text-primary shrink-0">
                            <x-heroicon-o-users class="w-3.5 h-3.5" />
                        </span>
                        <span>1. Data Demografi</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span
                            class="w-6 h-6 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500 shrink-0">
                            <x-heroicon-o-chart-bar class="w-3.5 h-3.5" />
                        </span>
                        <span>2. Data Sosial & Ekonomi</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span
                            class="w-6 h-6 rounded-full bg-amber-50 flex items-center justify-center text-amber-500 shrink-0">
                            <x-heroicon-o-building-storefront class="w-3.5 h-3.5" />
                        </span>
                        <span>3. Data UMKM</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span
                            class="w-6 h-6 rounded-full bg-cyan-50 flex items-center justify-center text-cyan-500 shrink-0">
                            <x-heroicon-o-building-office class="w-3.5 h-3.5" />
                        </span>
                        <span>4. Data Infrastruktur Desa</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span
                            class="w-6 h-6 rounded-full bg-rose-50 flex items-center justify-center text-rose-500 shrink-0">
                            <x-heroicon-o-map-pin class="w-3.5 h-3.5" />
                        </span>
                        <span>5. Data Spasial</span>
                    </li>
                </ul>
            </div>

            <!-- Map Embed -->
            <div class="hidden sm:block sm:col-span-5 bg-tertiary relative overflow-hidden min-h-[180px] sm:min-h-full">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63362.13224381473!2d108.47197398521011!3d-6.993581459840739!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f105206de9acd%3A0x23809bb2c0f8e66e!2sSukaraja%2C%20Kec.%20Ciawigebang%2C%20Kabupaten%20Kuningan%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1781874424452!5m2!1sid!2sid"
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

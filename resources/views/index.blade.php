<x-layouts.client>
    <div x-data="{ isLoggingIn: false, isGoingToDashboard: false }" class="p-4 sm:p-6 lg:p-8 space-y-8 sm:space-y-12 bg-tertiary min-h-screen content-fade">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">

            <div class="space-y-4 sm:space-y-6 text-left">
                <div
                    class="px-3 py-1 text-xs font-semibold tracking-wide capitalize rounded-md w-fit bg-primary/10 text-primary border border-primary/20 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 bg-primary rounded-full animate-ping"></span>
                    Pemerintah Desa Sukaraja
                </div>

                <h2
                    class="flex flex-col text-3xl sm:text-4xl md:text-5xl font-bold uppercase tracking-tight text-textPrimary leading-none">
                    <span>pandawa statistik</span>
                    <span class="text-primary mt-1">desa sukaraja</span>
                </h2>

                <h3 class="text-base sm:text-lg md:text-xl font-bold text-textSecondary">
                    Pusat Analisis dan Wawasan Data Statistik
                </h3>

                <p class="text-sm sm:text-base italic text-textTertiary font-normal leading-relaxed max-w-xl">
                    Orchestrating local data for data-driven policies: Empowering Villages through integrated,
                    transparent, and evidence-based for impactful statistics.
                </p>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 pt-2">
                    @auth
                        <x-button variant="primary" size="md"
                            @click="isGoingToDashboard = true; setTimeout(() => window.location.href = '{{ route('dashboard') }}', 800)"
                            ::class="isGoingToDashboard ? 'opacity-90 pointer-events-none' : ''">

                            <x-heroicon-o-arrow-left-on-rectangle x-show="!isGoingToDashboard" class="w-5 h-5 rotate-180" />

                            <div x-show="isGoingToDashboard" x-cloak class="flex items-end gap-0.5 h-4 w-5 mb-0.5 shrink-0">
                                <div class="w-1 bg-white/40 rounded-full animate-[bounce_1s_infinite_100ms] h-2"></div>
                                <div class="w-1 bg-white rounded-full animate-[bounce_1s_infinite_200ms] h-4"></div>
                                <div class="w-1 bg-white/70 rounded-full animate-[bounce_1s_infinite_300ms] h-3"></div>
                            </div>

                            <span x-text="isGoingToDashboard ? 'Memuat Data...' : 'Dashboard'">Dashboard</span>
                        </x-button>
                    @else
                        <x-button variant="primary" size="md"
                            @click="isLoggingIn = true; setTimeout(() => window.location.href = '{{ route('auth.login') }}', 800)"
                            ::class="isLoggingIn ? 'opacity-90 pointer-events-none' : ''">

                            <x-heroicon-o-arrow-right-on-rectangle x-show="!isLoggingIn" class="w-5 h-5 rotate-180" />

                            <div x-show="isLoggingIn" x-cloak class="flex items-end gap-0.5 h-4 w-5 mb-0.5 shrink-0">
                                <div class="w-1 bg-white/40 rounded-full animate-[bounce_1s_infinite_100ms] h-2"></div>
                                <div class="w-1 bg-white rounded-full animate-[bounce_1s_infinite_200ms] h-4"></div>
                                <div class="w-1 bg-white/70 rounded-full animate-[bounce_1s_infinite_300ms] h-3"></div>
                            </div>

                            <span x-text="isLoggingIn ? 'Menghubungkan...' : 'Login Petugas'">Login Petugas</span>
                        </x-button>
                    @endauth

                    <a href="#pelajari-lebih">
                        <x-button variant="ghost" size="md">
                            <x-heroicon-o-chevron-down class="w-4 h-4 text-textSecondary" />
                            Pelajari Lebih
                        </x-button>
                    </a>
                </div>
            </div>

            <div
                class="bg-secondary border border-tertiary rounded-2xl shadow-xl shadow-textSecondary/5 overflow-hidden grid grid-cols-1 sm:grid-cols-12 min-h-fit sm:min-h-[420px]">

                <div class="sm:col-span-7 p-5 sm:p-6 flex flex-col justify-between space-y-6 sm:space-y-4">
                    <div>
                        <div class="flex items-start sm:items-center gap-3">
                            <div class="p-2 bg-primary/10 text-primary rounded-lg shrink-0">
                                <x-heroicon-o-square-3-stack-3d class="w-6 h-6" />
                            </div>
                            <div>
                                <h4 class="font-bold text-textPrimary tracking-wide text-sm sm:text-base">PANDAWA</h4>
                                <p class="text-xs text-textSecondary leading-tight">Sistem Orkestrasi dan Analisis Data
                                    asagai wawasan pengambilan keputusan</p>
                            </div>
                        </div>
                        <p class="text-xs text-textSecondary mt-4 leading-relaxed">
                            Dibangun di atas 5 pilar data utama untuk mendukung kemajuan Desa Sukaraja:
                        </p>
                    </div>

                    <ul class="space-y-2.5 text-xs font-semibold text-textPrimary">
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

                <div class="hidden sm:block sm:col-span-5 bg-tertiary relative bg-cover bg-center overflow-hidden border-t sm:border-t-0 sm:border-l border-tertiary min-h-[180px] sm:min-h-full"
                    style="background-image: url('https://vignette.wikia.nocookie.net/powerlisting/images/a/a3/Map.jpg/revision/latest?cb=20140517234608'); opacity: 0.85;">
                    <div class="absolute inset-0 bg-gradient-to-r from-secondary via-transparent to-transparent"></div>
                    <div
                        class="absolute top-1/4 right-8 w-16 h-16 md:w-24 md:h-24 rounded-full border-2 border-primary/40 bg-primary/10 animate-pulse">
                    </div>
                    <div
                        class="absolute bottom-4 left-4 text-[10px] font-bold text-textSecondary uppercase tracking-widest pointer-events-none">
                        PETA WILAYAH
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <div
                class="bg-secondary p-5 sm:p-6 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col items-center text-center justify-center min-h-[130px]">
                <div class="p-2.5 bg-primary/10 text-primary rounded-xl mb-2.5 shrink-0">
                    <x-heroicon-o-users class="w-6 h-6" />
                </div>
                <span class="text-2xl sm:text-3xl font-bold text-textPrimary tracking-tight">0</span>
                <span class="text-[11px] font-semibold text-textSecondary mt-1 uppercase tracking-wider">Total
                    Penduduk</span>
            </div>
            <div
                class="bg-secondary p-5 sm:p-6 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col items-center text-center justify-center min-h-[130px]">
                <div class="p-2.5 bg-emerald-50 text-emerald-500 rounded-xl mb-2.5 shrink-0">
                    <x-heroicon-o-home class="w-6 h-6" />
                </div>
                <span class="text-2xl sm:text-3xl font-bold text-textPrimary tracking-tight">1.849</span>
                <span class="text-[11px] font-semibold text-textSecondary mt-1 uppercase tracking-wider">Kepala
                    Keluarga</span>
            </div>
            <div
                class="bg-secondary p-5 sm:p-6 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col items-center text-center justify-center min-h-[130px]">
                <div class="p-2.5 bg-amber-50 text-amber-500 rounded-xl mb-2.5 shrink-0">
                    <x-heroicon-o-building-office-2 class="w-6 h-6" />
                </div>
                <span class="text-2xl sm:text-3xl font-bold text-textPrimary tracking-tight">0</span>
                <span class="text-[11px] font-semibold text-textSecondary mt-1 uppercase tracking-wider">Unit
                    Perumahan</span>
            </div>
            <div
                class="bg-secondary p-5 sm:p-6 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col items-center text-center justify-center min-h-[130px]">
                <div class="p-2.5 bg-cyan-50 text-cyan-500 rounded-xl mb-2.5 shrink-0">
                    <x-heroicon-o-map class="w-6 h-6" />
                </div>
                <span class="text-2xl sm:text-3xl font-bold text-textPrimary tracking-tight">5</span>
                <span class="text-[11px] font-semibold text-textSecondary mt-1 uppercase tracking-wider">Dusun
                    Terdata</span>
            </div>
        </div>

        <div id="pelajari-lebih" class="scroll-mt-24 space-y-6 sm:space-y-8">
            <div class="flex flex-col items-center text-center space-y-2.5 max-w-2xl mx-auto px-4">
                <div
                    class="px-3 py-1 text-xs font-semibold tracking-wide rounded-full w-fit bg-primary/10 text-primary border border-primary/20">
                    Wawasan Publik
                </div>
                <h2 class="text-2xl sm:text-3xl font-bold text-textPrimary tracking-tight">5 Pilar Data Desa Sukaraja
                </h2>
                <p class="text-xs sm:text-sm text-textSecondary leading-relaxed">
                    Setiap pilar dirancang untuk memberikan gambaran komprehensif dan transparan kepada masyarakat luas.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                <div
                    class="bg-secondary p-6 sm:p-8 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col justify-between min-h-[200px]">
                    <div class="space-y-3.5">
                        <div class="p-3 bg-primary/10 text-primary rounded-xl w-fit"><x-heroicon-o-users
                                class="w-6 h-6" /></div>
                        <h4 class="text-base sm:text-lg font-bold text-textPrimary">Data Demografi</h4>
                        <p class="text-xs text-textSecondary leading-relaxed font-normal">
                            Rekap menyeluruh jumlah penduduk, struktur usia, jenis kelamin, dan distribusi per
                            dusun/RT/RW. Fondasi utama perencanaan desa.
                        </p>
                    </div>
                </div>

                <div
                    class="bg-secondary p-6 sm:p-8 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col justify-between min-h-[200px]">
                    <div class="space-y-3.5">
                        <div class="p-3 bg-emerald-50 text-emerald-500 rounded-xl w-fit"><x-heroicon-o-chart-bar
                                class="w-6 h-6" /></div>
                        <h4 class="text-base sm:text-lg font-bold text-textPrimary">Data Sosial & Ekonomi</h4>
                        <p class="text-xs text-textSecondary leading-relaxed font-normal">
                            Potret kondisi sosial-ekonomi warga meliputi tingkat pendidikan, pekerjaan, penerima bantuan
                            sosial, dan kesejahteraan keluarga.
                        </p>
                    </div>
                </div>

                <div
                    class="bg-secondary p-6 sm:p-8 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col justify-between min-h-[200px]">
                    <div class="space-y-3.5">
                        <div class="p-3 bg-amber-50 text-amber-500 rounded-xl w-fit"><x-heroicon-o-building-storefront
                                class="w-6 h-6" /></div>
                        <h4 class="text-base sm:text-lg font-bold text-textPrimary">Data UMKM</h4>
                        <p class="text-xs text-textSecondary leading-relaxed font-normal">
                            Direktori usaha mikro, kecil, dan menengah yang ada di Desa Sukaraja — mendukung
                            pengembangan ekonomi lokal berbasis data.
                        </p>
                    </div>
                </div>

                <div
                    class="bg-secondary p-6 sm:p-8 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col justify-between min-h-[200px]">
                    <div class="space-y-3.5">
                        <div class="p-3 bg-cyan-50 text-cyan-500 rounded-xl w-fit"><x-heroicon-o-building-office
                                class="w-6 h-6" /></div>
                        <h4 class="text-base sm:text-lg font-bold text-textPrimary">Data Infrastruktur Desa</h4>
                        <p class="text-xs text-textSecondary leading-relaxed font-normal">
                            Inventarisasi fasilitas dan infrastruktur publik: jalan, sarana pendidikan, kesehatan, dan
                            fasilitas umum lainnya di wilayah desa.
                        </p>
                    </div>
                </div>

                <div
                    class="bg-secondary p-6 sm:p-8 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col justify-between min-h-[200px]">
                    <div class="space-y-3.5">
                        <div class="p-3 bg-rose-50 text-rose-500 rounded-xl w-fit"><x-heroicon-o-map-pin
                                class="w-6 h-6" /></div>
                        <h4 class="text-base sm:text-lg font-bold text-textPrimary">Data Spasial</h4>
                        <p class="text-xs text-textSecondary leading-relaxed font-normal">
                            Pemetaan geografis rumah tangga dan batas wilayah berbasis koordinat GPS — menghadirkan
                            visualisasi desa yang akurat dan interaktif.
                        </p>
                    </div>
                </div>

                <div
                    class="bg-primary p-6 sm:p-8 rounded-2xl shadow-lg shadow-primary/10 flex flex-col justify-between min-h-[200px] md:col-span-2 lg:col-span-1">
                    <div class="space-y-2">
                        <h4 class="text-base sm:text-lg font-bold text-secondary tracking-wide">Akses Data Lengkap</h4>
                        <p class="text-xs text-secondary/90 leading-relaxed font-normal">
                            Masuk sebagai petugas untuk mengakses, mengelola, dan menganalisis data secara mendalam.
                        </p>
                    </div>

                    <div class="pt-4 flex w-full">
                        @auth
                            <x-button variant="secondary" size="md" class="w-full"
                                @click="isGoingToDashboard = true; setTimeout(() => window.location.href = '{{ route('dashboard') }}', 800)">
                                <x-heroicon-o-arrow-right-on-rectangle x-show="!isGoingToDashboard" class="w-4 h-4" />
                                <div x-show="isGoingToDashboard" x-cloak
                                    class="flex items-end gap-0.5 h-3.5 w-4 mb-0.5 shrink-0">
                                    <div class="w-0.5 bg-primary/40 rounded-full animate-[bounce_1s_infinite_100ms] h-1.5">
                                    </div>
                                    <div class="w-0.5 bg-primary rounded-full animate-[bounce_1s_infinite_200ms] h-3.5">
                                    </div>
                                    <div class="w-0.5 bg-primary/70 rounded-full animate-[bounce_1s_infinite_300ms] h-2.5">
                                    </div>
                                </div>
                                <span x-text="isGoingToDashboard ? 'Memuat...' : 'Dashboard Petugas'">Dashboard
                                    Petugas</span>
                            </x-button>
                        @else
                            <x-button variant="secondary" size="md" class="w-full"
                                @click="isLoggingIn = true; setTimeout(() => window.location.href = '{{ route('auth.login') }}', 800)">
                                <x-heroicon-o-arrow-right-on-rectangle x-show="!isLoggingIn" class="w-4 h-4" />
                                <div x-show="isLoggingIn" x-cloak
                                    class="flex items-end gap-0.5 h-3.5 w-4 mb-0.5 shrink-0">
                                    <div class="w-0.5 bg-primary/40 rounded-full animate-[bounce_1s_infinite_100ms] h-1.5">
                                    </div>
                                    <div class="w-0.5 bg-primary rounded-full animate-[bounce_1s_infinite_200ms] h-3.5">
                                    </div>
                                    <div class="w-0.5 bg-primary/70 rounded-full animate-[bounce_1s_infinite_300ms] h-2.5">
                                    </div>
                                </div>
                                <span x-text="isLoggingIn ? 'Memuat...' : 'Login Sekarang'">Login Sekarang</span>
                            </x-button>
                        @endauth
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.client>

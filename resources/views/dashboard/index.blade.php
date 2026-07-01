<x-layouts.dashboard>
    <div class="p-4 space-y-8 sm:p-6 lg:p-8 sm:space-y-12 bg-tertiary content-fade">

        <div class="grid items-center grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-12">

            <div class="space-y-4 text-left sm:space-y-6">
                <div
                    class="px-3 py-1 text-xs font-semibold tracking-wide capitalize rounded-md w-fit bg-primary/10 text-primary border border-primary/20 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 bg-primary rounded-full animate-ping"></span>
                    Pemerintah {{ $villageSettings->village_name ?? '-' }}
                </div>

                <h2
                    class="flex flex-col text-3xl font-bold leading-none tracking-tight uppercase sm:text-4xl md:text-5xl text-textPrimary">
                    <span>pandawa statistik</span>
                    <span class="mt-1 text-primary">{{ $villageSettings->village_name ?? '-' }}</span>
                </h2>

                <h3 class="text-base font-bold sm:text-lg md:text-xl text-textSecondary">
                    Pusat Analisis dan Wawasan Data Statistik
                </h3>

                <p class="max-w-xl text-sm italic font-normal leading-relaxed sm:text-base text-textTertiary">
                    Orchestrating local data for data-driven policies: Empowering Villages through integrated,
                    transparent, and evidence-based for impactful statistics.
                </p>

                <div class="flex flex-col items-stretch gap-3 pt-2 sm:flex-row sm:items-center">
                    @auth
                    <x-button variant="primary" size="md">
                        {{ Auth::user()->fullname ?? 'Petugas' }}
                    </x-button>
                    @else
                    <x-button variant="primary" size="md">
                        <x-iconsax-bro-arrow-square-right class="w-5 h-5" />
                        Login Petugas
                    </x-button>
                    @endauth

                    <a href="#pelajari-lebih" class="inline-block max-sm:w-full">
                        <x-button variant="ghost" size="md">
                            <x-iconsax-lin-arrow-down class="w-4 h-4 text-textSecondary" />
                            Pelajari Lebih
                        </x-button>
                    </a>
                </div>
            </div>

            <div
                class="bg-secondary border border-tertiary rounded-2xl shadow-xl shadow-textSecondary/5 overflow-hidden grid grid-cols-1 sm:grid-cols-12 min-h-fit sm:min-h-[420px]">

                <div class="flex flex-col justify-between p-5 space-y-6 sm:col-span-7 sm:p-6 sm:space-y-4">
                    <div>
                        <div class="flex items-start gap-3 sm:items-center">
                            <div class="p-2 rounded-lg bg-primary/10 text-primary shrink-0">
                                <x-heroicon-o-square-3-stack-3d class="w-6 h-6" />
                            </div>
                            <div>
                                <h4 class="text-sm font-bold tracking-wide text-textPrimary sm:text-base">PANDAWA</h4>
                                <p class="text-xs leading-tight text-textSecondary">Sistem Orkestrasi dan Analisis Data
                                    sebagai wawasan pengambilan keputusan</p>
                            </div>
                        </div>
                        <p class="mt-4 text-xs leading-relaxed text-textSecondary">
                            Dibangun di atas 5 pilar data utama untuk mendukung kemajuan {{ $villageSettings->village_name ?? '-' }}:
                        </p>
                    </div>

                    <ul class="space-y-2.5 text-xs font-semibold text-textPrimary">
                        <li class="flex items-center gap-3">
                            <span
                                class="flex items-center justify-center w-6 h-6 rounded-full bg-primary/10 text-primary shrink-0"><x-heroicon-o-users
                                    class="w-3.5 h-3.5" /></span>
                            <span>1. Data Demografi</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span
                                class="flex items-center justify-center w-6 h-6 rounded-full bg-emerald-50 text-emerald-500 shrink-0"><x-iconsax-bul-chart-1
                                    class="w-3.5 h-3.5" /></span>
                            <span>2. Data Sosial & Ekonomi</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span
                                class="flex items-center justify-center w-6 h-6 rounded-full bg-amber-50 text-amber-500 shrink-0"><x-iconsax-bro-shop
                                    class="w-3.5 h-3.5" /></span>
                            <span>3. Data UMKM</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span
                                class="flex items-center justify-center w-6 h-6 rounded-full bg-cyan-50 text-cyan-500 shrink-0"><x-iconsax-lin-buildings
                                    class="w-3.5 h-3.5" /></span>
                            <span>4. Data Infrastruktur Desa</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span
                                class="flex items-center justify-center w-6 h-6 rounded-full bg-rose-50 text-rose-500 shrink-0"><x-heroicon-o-map-pin
                                    class="w-3.5 h-3.5" /></span>
                            <span>5. Data Spasial</span>
                        </li>
                    </ul>
                </div>

                <div
                    class="hidden sm:block sm:col-span-5 bg-tertiary relative overflow-hidden border-t sm:border-t-0 sm:border-l border-tertiary min-h-[180px] sm:min-h-full">

                    {{-- ganti iframe sesuaikan dengan desanya --}}
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

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 sm:gap-6">
            <div
                class="bg-secondary p-5 sm:p-6 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col items-center text-center justify-center min-h-[130px]">
                <div class="p-2.5 bg-primary/10 text-primary rounded-xl mb-2.5 shrink-0">
                    <x-heroicon-o-users class="w-6 h-6" />
                </div>
                <span class="text-2xl font-bold tracking-tight sm:text-3xl text-textPrimary">0</span>
                <span class="text-[11px] font-semibold text-textSecondary mt-1 uppercase tracking-wider">Total
                    Penduduk</span>
            </div>

            <div
                class="bg-secondary p-5 sm:p-6 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col items-center text-center justify-center min-h-[130px]">
                <div class="p-2.5 bg-emerald-50 text-emerald-500 rounded-xl mb-2.5 shrink-0">
                    <x-heroicon-o-home class="w-6 h-6" />
                </div>
                <span class="text-2xl font-bold tracking-tight sm:text-3xl text-textPrimary">1.849</span>
                <span class="text-[11px] font-semibold text-textSecondary mt-1 uppercase tracking-wider">Kepala
                    Keluarga</span>
            </div>

            <div
                class="bg-secondary p-5 sm:p-6 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col items-center text-center justify-center min-h-[130px]">
                <div class="p-2.5 bg-amber-50 text-amber-500 rounded-xl mb-2.5 shrink-0">
                    <x-bi-building class="w-6 h-6" />
                </div>
                <span class="text-2xl font-bold tracking-tight sm:text-3xl text-textPrimary">0</span>
                <span class="text-[11px] font-semibold text-textSecondary mt-1 uppercase tracking-wider">Unit
                    Perumahan</span>
            </div>

            <div
                class="bg-secondary p-5 sm:p-6 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col items-center text-center justify-center min-h-[130px]">
                <div class="p-2.5 bg-cyan-50 text-cyan-500 rounded-xl mb-2.5 shrink-0">
                    <x-heroicon-o-map class="w-6 h-6" />
                </div>
                <span class="text-2xl font-bold tracking-tight sm:text-3xl text-textPrimary">5</span>
                <span class="text-[11px] font-semibold text-textSecondary mt-1 uppercase tracking-wider">Dusun
                    Terdata</span>
            </div>
        </div>

        <div id="pelajari-lebih" class="space-y-6 sm:space-y-8">
            <div class="flex flex-col items-center text-center space-y-2.5 max-w-2xl mx-auto px-4">
                <div
                    class="px-3 py-1 text-xs font-semibold tracking-wide border rounded-full w-fit bg-primary/10 text-primary border-primary/20">
                    Wawasan Publik
                </div>
                <h2 class="text-2xl font-bold tracking-tight sm:text-3xl text-textPrimary">
                    5 Pilar Data {{ $villageSettings->village_name ?? '-' }}
                </h2>
                <p class="text-xs leading-relaxed sm:text-sm text-textSecondary">
                    Setiap pilar dirancang untuk memberikan gambaran komprehensif dan transparan kepada masyarakat luas.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3 sm:gap-6">

                <div
                    class="bg-secondary p-6 sm:p-8 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col justify-between min-h-[200px]">
                    <div class="space-y-3.5">
                        <div class="p-3 bg-primary/10 text-primary rounded-xl w-fit"><x-heroicon-o-users
                                class="w-6 h-6" /></div>
                        <h4 class="text-base font-bold sm:text-lg text-textPrimary">Data Demografi</h4>
                        <p class="text-xs font-normal leading-relaxed text-textSecondary">
                            Rekap menyeluruh jumlah penduduk, struktur usia, jenis kelamin, dan distribusi per
                            dusun/RT/RW. Fondasi utama perencanaan desa.
                        </p>
                    </div>
                </div>

                <div
                    class="bg-secondary p-6 sm:p-8 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col justify-between min-h-[200px]">
                    <div class="space-y-3.5">
                        <div class="p-3 bg-emerald-50 text-emerald-500 rounded-xl w-fit"><x-iconsax-bul-chart-1
                                class="w-6 h-6" /></div>
                        <h4 class="text-base font-bold sm:text-lg text-textPrimary">Data Sosial & Ekonomi</h4>
                        <p class="text-xs font-normal leading-relaxed text-textSecondary">
                            Potret kondisi sosial-ekonomi warga meliputi tingkat pendidikan, pekerjaan, penerima bantuan
                            sosial, dan kesejahteraan keluarga.
                        </p>
                    </div>
                </div>

                <div
                    class="bg-secondary p-6 sm:p-8 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col justify-between min-h-[200px]">
                    <div class="space-y-3.5">
                        <div class="p-3 bg-amber-50 text-amber-500 rounded-xl w-fit"><x-iconsax-bro-shop
                                class="w-6 h-6" /></div>
                        <h4 class="text-base font-bold sm:text-lg text-textPrimary">Data UMKM</h4>
                        <p class="text-xs font-normal leading-relaxed text-textSecondary">
                            Direktori usaha mikro, kecil, dan menengah yang ada di {{ $villageSettings->village_name ?? '-' }} — mendukung
                            pengembangan ekonomi lokal berbasis data.
                        </p>
                    </div>
                </div>

                <div
                    class="bg-secondary p-6 sm:p-8 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col justify-between min-h-[200px]">
                    <div class="space-y-3.5">
                        <div class="p-3 bg-cyan-50 text-cyan-500 rounded-xl w-fit"><x-iconsax-lin-buildings
                                class="w-6 h-6" /></div>
                        <h4 class="text-base font-bold sm:text-lg text-textPrimary">Data Infrastruktur Desa</h4>
                        <p class="text-xs font-normal leading-relaxed text-textSecondary">
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
                        <h4 class="text-base font-bold sm:text-lg text-textPrimary">Data Spasial</h4>
                        <p class="text-xs font-normal leading-relaxed text-textSecondary">
                            Pemetaan geografis rumah tangga dan batas wilayah berbasis koordinat GPS — menghadirkan
                            visualisasi desa yang akurat dan interaktif.
                        </p>
                    </div>
                </div>

                @guest
                <div
                    class="bg-primary p-6 sm:p-8 rounded-2xl shadow-lg shadow-primary/10 flex flex-col justify-between min-h-[200px] md:col-span-2 lg:col-span-1">
                    <div class="space-y-2">
                        <h4 class="text-base font-bold tracking-wide sm:text-lg text-secondary">Akses Data Lengkap</h4>
                        <p class="text-xs font-normal leading-relaxed text-secondary/90">
                            Masuk sebagai petugas untuk mengakses, mengelola, dan menganalisis data secara mendalam.
                        </p>
                    </div>

                    <div class="flex w-full pt-4">
                        @auth
                        <x-button variant="secondary" size="md" class="w-full">
                            <x-iconsax-bro-arrow-square-right class="w-4 h-4" />
                            Dashboard Petugas
                        </x-button>
                        @else
                        <x-button variant="secondary" size="md" class="w-full">
                            <x-iconsax-bro-arrow-square-right class="w-4 h-4" />
                            Login Sekarang
                        </x-button>
                        @endauth
                    </div>
                </div>
                @endguest

            </div>
        </div>
    </div>
</x-layouts.dashboard>
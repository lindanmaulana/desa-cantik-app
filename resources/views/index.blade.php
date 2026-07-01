<x-layouts.client>
    <div x-data="{}" class="p-2 space-y-8 sm:p-3 md:p-6 lg:p-8 sm:space-y-12 content-fade">

        <!-- Hero Section -->
        <x-hero-section />

        <!-- Stats Section -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 sm:gap-6">
            <!-- Stat 1 -->
            <div
                class="bg-secondary p-5 sm:p-6 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col items-center text-center justify-center min-h-[130px]">
                <div class="p-2.5 bg-primary/10 text-primary rounded-xl mb-2.5 shrink-0">
                    <x-heroicon-o-users class="w-6 h-6" />
                </div>
                <span class="text-2xl font-bold tracking-tight sm:text-3xl text-textPrimary">0</span>
                <span class="text-[11px] font-semibold text-textSecondary mt-1 uppercase tracking-wider">Total
                    Penduduk</span>
            </div>
            <!-- Stat 2 -->
            <div
                class="bg-secondary p-5 sm:p-6 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col items-center text-center justify-center min-h-[130px]">
                <div class="p-2.5 bg-emerald-50 text-emerald-500 rounded-xl mb-2.5 shrink-0">
                    <x-heroicon-o-home class="w-6 h-6" />
                </div>
                <span class="text-2xl font-bold tracking-tight sm:text-3xl text-textPrimary">1.849</span>
                <span class="text-[11px] font-semibold text-textSecondary mt-1 uppercase tracking-wider">Kepala
                    Keluarga</span>
            </div>
            <!-- Stat 3 -->
            <div
                class="bg-secondary p-5 sm:p-6 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col items-center text-center justify-center min-h-[130px]">
                <div class="p-2.5 bg-amber-50 text-amber-500 rounded-xl mb-2.5 shrink-0">
                    <x-iconsax-out-buildings class="w-6 h-6" />
                </div>
                <span class="text-2xl font-bold tracking-tight sm:text-3xl text-textPrimary">0</span>
                <span class="text-[11px] font-semibold text-textSecondary mt-1 uppercase tracking-wider">Unit
                    Perumahan</span>
            </div>
            <!-- Stat 4 -->
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

        <!-- Detail Section (Pelajari Lebih) -->
        <div id="pelajari-lebih" class="space-y-6 scroll-mt-24 sm:space-y-8">
            <div class="flex flex-col items-center text-center space-y-2.5 max-w-2xl mx-auto px-4">
                <div
                    class="px-3 py-1 text-xs font-semibold tracking-wide border rounded-full w-fit bg-primary/10 text-primary border-primary/20">
                    Wawasan Publik
                </div>
                <h2 class="text-2xl font-bold tracking-tight sm:text-3xl text-textPrimary">
                    5 Pilar Data Desa {{ $villageSettings->village_name ?? '-' }}
                </h2>
                <p class="text-xs leading-relaxed sm:text-sm text-textSecondary">
                    Setiap pilar dirancang untuk memberikan gambaran komprehensif dan transparan kepada masyarakat luas.
                </p>
            </div>

            <!-- Pillars Cards Grid -->
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3 sm:gap-6">
                <!-- Pillar 1 -->
                <div
                    class="bg-secondary p-6 sm:p-8 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col justify-between min-h-[200px]">
                    <div class="space-y-3.5">
                        <div class="p-3 bg-primary/10 text-primary rounded-xl w-fit">
                            <x-heroicon-o-users class="w-6 h-6" />
                        </div>
                        <h4 class="text-base font-bold sm:text-lg text-textPrimary">Data Demografi</h4>
                        <p class="text-xs font-normal leading-relaxed text-textSecondary">
                            Rekap menyeluruh jumlah penduduk, struktur usia, jenis kelamin, and distribusi per
                            dusun/RT/RW. Fondasi utama perencanaan desa.
                        </p>
                    </div>
                </div>

                <!-- Pillar 2 -->
                <div
                    class="bg-secondary p-6 sm:p-8 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col justify-between min-h-[200px]">
                    <div class="space-y-3.5">
                        <div class="p-3 bg-emerald-50 text-emerald-500 rounded-xl w-fit">
                            <x-iconsax-bul-chart-1 class="w-6 h-6" />
                        </div>
                        <h4 class="text-base font-bold sm:text-lg text-textPrimary">Data Sosial & Ekonomi</h4>
                        <p class="text-xs font-normal leading-relaxed text-textSecondary">
                            Potret kondisi sosial-ekonomi warga meliputi tingkat pendidikan, pekerjaan, penerima bantuan
                            sosial, dan kesejahteraan keluarga.
                        </p>
                    </div>
                </div>

                <!-- Pillar 3 -->
                <div
                    class="bg-secondary p-6 sm:p-8 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col justify-between min-h-[200px]">
                    <div class="space-y-3.5">
                        <div class="p-3 bg-amber-50 text-amber-500 rounded-xl w-fit">
                            <x-iconsax-bro-shop class="w-6 h-6" />
                        </div>
                        <h4 class="text-base font-bold sm:text-lg text-textPrimary">Data UMKM</h4>
                        <p class="text-xs font-normal leading-relaxed text-textSecondary">
                            Direktori usaha mikro, kecil, dan menengah yang ada di Desa
                            {{ $villageSettings->village_name ?? 'Sukaraja' }} — mendukung pengembangan ekonomi lokal
                            berbasis data.
                        </p>
                    </div>
                </div>

                <!-- Pillar 4 -->
                <div
                    class="bg-secondary p-6 sm:p-8 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col justify-between min-h-[200px]">
                    <div class="space-y-3.5">
                        <div class="p-3 bg-cyan-50 text-cyan-500 rounded-xl w-fit">
                            <x-iconsax-bro-buildings class="w-6 h-6" />
                        </div>
                        <h4 class="text-base font-bold sm:text-lg text-textPrimary">Data Infrastruktur Desa</h4>
                        <p class="text-xs font-normal leading-relaxed text-textSecondary">
                            Inventarisasi fasilitas dan infrastruktur publik: jalan, sarana pendidikan, kesehatan, dan
                            fasilitas umum lainnya di wilayah desa.
                        </p>
                    </div>
                </div>

                <!-- Pillar 5 -->
                <div
                    class="bg-secondary p-6 sm:p-8 rounded-2xl border border-tertiary shadow-sm hover:shadow-md transition-all flex flex-col justify-between min-h-[200px]">
                    <div class="space-y-3.5">
                        <div class="p-3 bg-rose-50 text-rose-500 rounded-xl w-fit">
                            <x-iconsax-bro-map-1 class="w-6 h-6" />
                        </div>
                        <h4 class="text-base font-bold sm:text-lg text-textPrimary">Data Spasial</h4>
                        <p class="text-xs font-normal leading-relaxed text-textSecondary">
                            Pemetaan geografis rumah tangga dan batas wilayah berbasis koordinat GPS — menghadirkan
                            visualisasi desa yang akurat dan interaktif.
                        </p>
                    </div>
                </div>

                <!-- Action Card / Call to Action -->
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
                            <x-button-link :href="route('dashboard')" variant="secondary" size="md" class="w-full"
                                loading-key="card-dashboard" loading-text="Membuka Dashboard...">
                                <x-iconsax-bro-arrow-square-right class="w-4 h-4" />
                                <span>Dashboard Petugas</span>
                            </x-button-link>
                        @else
                            <x-button-link :href="route('auth.login')" variant="secondary" size="md" class="w-full"
                                loading-key="card-login" loading-text="Menuju Login...">
                                <x-iconsax-bro-arrow-square-right class="w-4 h-4" />
                                <span>Login Sekarang</span>
                            </x-button-link>
                        @endauth
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layouts.client>

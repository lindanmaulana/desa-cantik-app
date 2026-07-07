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
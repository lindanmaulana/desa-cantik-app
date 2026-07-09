<div class="grid items-center grid-cols-1 gap-8 lg:grid-cols-12 lg:gap-12">

    <div class="space-y-6 text-left lg:col-span-6">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 text-xs font-semibold tracking-wide rounded-full bg-primary/10 text-primary border border-primary/20">
            <span class="relative flex w-2 h-2">
                <span class="absolute inline-flex w-full h-full rounded-full opacity-75 animate-ping bg-primary"></span>
                <span class="relative inline-flex w-2 h-2 rounded-full bg-primary"></span>
            </span>
            Pemerintah {{ $villageSettings->village_name ?? 'Desa' }}
        </div>

        <div class="space-y-2">
            <h1 class="text-3xl font-extrabold leading-tight tracking-tight text-textPrimary sm:text-4xl md:text-5xl">
                Pandawa Statistik <br class="hidden sm:inline" />
                <span class="text-transparent text-primary bg-gradient-to-r from-primary to-primary/80 bg-clip-text">
                    {{ $villageSettings->village_name ?? '-' }}
                </span>
            </h1>
            <p class="text-base font-semibold tracking-wide sm:text-lg text-textSecondary">
                Pusat Analisis dan Wawasan Data Statistik Terintegrasi
            </p>
        </div>

        <p class="max-w-xl text-sm antialiased font-medium leading-relaxed text-textTertiary">
            "Orchestrating local data for data-driven policies: Empowering Villages through integrated,
            transparent, and evidence-based for impactful statistics."
        </p>

        <div class="flex flex-col gap-3 pt-2 sm:flex-row sm:items-center">
            @auth
            <x-button variant="primary" size="md" class="font-semibold shadow-sm shadow-primary/20">
                {{ Auth::user()->fullname ?? 'Petugas' }}
            </x-button>
            @else
            <x-button variant="primary" size="md" class="flex items-center justify-center gap-2 font-semibold shadow-sm shadow-primary/20">
                <x-iconsax-bro-arrow-square-right class="w-4 h-4" />
                <span>Login Petugas</span>
            </x-button>
            @endauth

            <a href="#pelajari-lebih" class="inline-block max-sm:w-full">
                <x-button variant="ghost" size="md" class="w-full text-textSecondary font-medium flex items-center justify-center gap-1.5 hover:bg-secondary">
                    <x-iconsax-lin-arrow-down class="w-4 h-4" />
                    <span>Pelajari Lebih</span>
                </x-button>
            </a>
        </div>
    </div>

    <div class="bg-secondary border border-tertiary rounded-2xl shadow-xl shadow-textSecondary/5 overflow-hidden grid grid-cols-1 sm:grid-cols-12 min-h-fit sm:min-h-[420px] lg:col-span-6">

        <div class="flex flex-col justify-between p-6 space-y-6 sm:col-span-7 sm:p-7 sm:space-y-4">
            <div>
                <div class="flex items-start gap-3 sm:items-center">
                    <div class="p-2 rounded-lg bg-primary/10 text-primary shrink-0">
                        <x-heroicon-o-square-3-stack-3d class="w-6 h-6" />
                    </div>
                    <div>
                        <h4 class="text-sm font-bold tracking-wide text-textPrimary sm:text-base">PANDAWA</h4>
                        <p class="text-xs leading-tight text-textSecondary">Sistem Orkestrasi dan Analisis Data sebagai wawasan pengambilan keputusan</p>
                    </div>
                </div>
                <p class="mt-4 text-xs leading-relaxed text-textSecondary">
                    Dibangun di atas 5 pilar data utama untuk mendukung kemajuan {{ $villageSettings->village_name ?? '-' }}:
                </p>
            </div>

            <ul class="space-y-2.5 text-xs font-semibold text-textPrimary">
                <li class="flex items-center gap-3">
                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-primary/10 text-primary shrink-0">
                        <x-heroicon-o-users class="w-3.5 h-3.5" />
                    </span>
                    <span>1. Data Demografi</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-emerald-500/10 text-emerald-500 shrink-0">
                        <x-iconsax-bul-chart-1 class="w-3.5 h-3.5" />
                    </span>
                    <span>2. Data Sosial & Ekonomi</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-amber-500/10 text-amber-500 shrink-0">
                        <x-iconsax-bro-shop class="w-3.5 h-3.5" />
                    </span>
                    <span>3. Data UMKM</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-cyan-500/10 text-cyan-500 shrink-0">
                        <x-iconsax-lin-buildings class="w-3.5 h-3.5" />
                    </span>
                    <span>4. Data Infrastruktur Desa</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-rose-500/10 text-rose-500 shrink-0">
                        <x-heroicon-o-map-pin class="w-3.5 h-3.5" />
                    </span>
                    <span>5. Data Spasial</span>
                </li>
            </ul>
        </div>

        <div class="hidden sm:block sm:col-span-5 bg-tertiary relative overflow-hidden border-t sm:border-t-0 sm:border-l border-tertiary min-h-[180px] sm:min-h-full">
            <iframe
                src="https://maps.google.com/maps?q={{ $villageSettings->latitude ?? '-6.977484656144307' }},{{ $villageSettings->longitude ?? '108.48431009591388' }}&z=14&output=embed"
                class="absolute inset-0 w-full h-full transition-opacity duration-300 border-0 opacity-90 hover:opacity-100"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>

            <div class="absolute inset-0 pointer-events-none bg-gradient-to-r from-secondary via-transparent to-transparent"></div>

            <div class="absolute bottom-4 left-4 text-[10px] font-bold text-textSecondary uppercase tracking-widest pointer-events-none z-10 bg-secondary/80 px-2 py-0.5 rounded-md backdrop-blur-sm">
                PETA WILAYAH AKTIF
            </div>
        </div>

    </div>
</div>
